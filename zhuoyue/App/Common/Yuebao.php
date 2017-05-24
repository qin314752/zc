<?php

/**
 * 转入余额宝
 */
function Yuebao_In($uid=0,$money=0){
//    $balanceconfig =  require C("ROOT_URL")."Dynamic/balance_config.php";

    $members_data = M('members')->find($uid);
    $member_money_data = M('member_money')->where(array(uid=>$uid))->find();

    /**
     * 操作前的检查
     * 转入余额宝的金额大于0
     * 检查转入余额宝的金额是否大于账户余额
     */
    if($money<=0){
        return array(code=>2,msg=>'转入聚财宝的金额必须大于0！');
    }
    if($member_money_data['account_money']+$member_money_data['back_money']<$money){
        return array(code=>2,msg=>'转入聚财宝的金额不能大于账户可用余额！');
    }

    $yuebao_info_dal = D("yuebao_info");
    $yuebao_info_dal->startTrans();

    $yuebao_info_data = $yuebao_info_dal->where(array(uid=>$uid))->find();
    if(!is_array($yuebao_info_data)){
        $yuebao_info_data = array();
        $yuebao_info_data['uid'] = $uid;
        $yuebao_info_data['money'] = 0;
        $yuebao_info_data['interest'] = 0;
        $yuebao_info_data['panny_interest'] = 0;
        $yuebao_info_data['add_time'] = time();
        $yuebao_info_rs = M("yuebao_info")->add($yuebao_info_data);
        $yuebao_info_data = $yuebao_info_dal->where(array(uid=>$uid))->find();
    }

    /**
     * 更新余额宝账户资金
     */
    $yuebao_info_value = array();
    $yuebao_info_value['interest'] = 0;
    $yuebao_info_value['money'] = $yuebao_info_data['money']+$yuebao_info_data['interest']+$money;
    $yuebao_info_rs = $yuebao_info_dal->where(array(uid=>$uid))->save($yuebao_info_value);

    /**
     * 增加余额宝账户操作记录
     */
    $yuebao_log_value = array();
    $yuebao_log_value['uid'] = $uid;
    $yuebao_log_value['type'] = 141;
    $yuebao_log_value['affect_money'] = $money;
    $yuebao_log_value['total_money'] = $yuebao_info_value['money'];
    $yuebao_log_value['info'] = "【{$members_data['id']}】号用户【{$members_data['user_name']}】向聚财宝转入【{$money}】元【".date('Y-m-d H:i:s',time())."】";
    $yuebao_log_value['add_time'] = time();
    $yuebao_log_value['ip'] = get_client_ip();
    $yuebao_log_rs = M("yuebao_log")->add($yuebao_log_value);

    /**
     * 更新账户资金
     */
    $member_money_value = array();
    if($member_money_data['account_money']<$money){
        $member_money_value['account_money'] = 0;
        $member_money_value['back_money'] = $member_money_data['account_money']+$member_money_data['back_money']-$money;
    }else{
        $member_money_value['account_money'] = $member_money_data['account_money'] - $money;
        $member_money_value['back_money'] = $member_money_data['back_money'];
    }
    $member_money_value['collect_money'] = $member_money_data['money_collect'];
    $member_money_value['freeze_money'] = $member_money_data['money_freeze'];
    $member_money_rs = M('member_money')->where(array(uid=>$uid))->save($member_money_value);

    /**
     * 增加账户操作记录
     */
    $member_moneylog_value = array();
    $member_moneylog_value['affect_money'] = -$money;
    $member_moneylog_value['account_money'] = $member_money_value['account_money'];
    $member_moneylog_value['back_money'] = $member_money_value['back_money'];
    $member_moneylog_value['collect_money'] = $member_money_value['collect_money'];
    $member_moneylog_value['freeze_money'] = $member_money_value['freeze_money'];

    $member_moneylog_value['uid'] = $uid;
    $member_moneylog_value['type'] = 141;
    $member_moneylog_value['info'] = "【{$members_data['id']}】号用户【{$members_data['user_name']}】向聚财宝转入【{$money}】元【".date('Y-m-d H:i:s',time())."】";
    $member_moneylog_value['target_uid'] = 0;
    $member_moneylog_value['target_uname'] = "@网站管理员@";
    $member_moneylog_value['add_time'] = time();
    $member_moneylog_value['add_ip'] = get_client_ip();
    $member_moneylog_rs = M('member_moneylog')->add($member_moneylog_value);

    if($yuebao_info_rs&&$yuebao_log_rs&&$member_money_rs&&$member_moneylog_rs){
        $yuebao_info_dal->commit();
        return array(code=>1,msg=>'存入成功');
    }else{
        $yuebao_info_dal->rollback();
        return array(code=>0,msg=>'存入失败');
    }
}

/**
 * 转出余额宝
 */
function Yuebao_Out($uid=0,$money=0){
//    $balanceconfig =  require C("ROOT_URL")."Dynamic/balance_config.php";

    $yuebao_info_data = M("yuebao_info")->where(array(uid=>$uid))->find();
    $members_data = M('members')->find($uid);
    $member_money_data = M('member_money')->where(array(uid=>$uid))->find();

    /**
     * 操作前的检查
     * 转入余额宝的金额大于0
     * 检查转入余额宝的金额是否大于账户余额
     */
    if(!is_array($yuebao_info_data)){
        return array(code=>2,msg=>'聚财宝信息有误！');
    }
    if($money<=0){
        return array(code=>2,msg=>'转出聚财宝的金额必须大于0！');
    }
    $_current_day_charge = M('yuebao_log')->where(array(type=>141,uid=>$uid,add_time=>array('gt',mktime(0,0,0,date('m'),date('d'),date('Y')))))->sum('affect_money');

    $effective_money = $yuebao_info_data['money']+$yuebao_info_data['interest']-$_current_day_charge;

    if($effective_money<$money){
        return array(code=>2,msg=>'转入聚财宝的资金当天不能转出，转出聚财宝的金额不能大于聚财宝账户可转出余额！');
    }

    $yuebao_info_dal = D("yuebao_info");
    $yuebao_info_dal->startTrans();

    /**
     * 更新余额宝账户资金
     */
    $yuebao_info_value = array();
    $yuebao_info_value['interest'] = 0;
    $yuebao_info_value['money'] = $yuebao_info_data['money']+$yuebao_info_data['interest']-$money;
    $yuebao_info_rs = $yuebao_info_dal->where(array(uid=>$uid))->save($yuebao_info_value);

    /**
     * 增加余额宝账户操作记录
     */
    $yuebao_log_value = array();
    $yuebao_log_value['uid'] = $uid;
    $yuebao_log_value['type'] = 142;
    $yuebao_log_value['affect_money'] = -$money;
    $yuebao_log_value['total_money'] = $yuebao_info_value['money'];
    $yuebao_log_value['info'] = "【{$members_data['id']}】号用户【{$members_data['user_name']}】从聚财宝转出【{$money}】元【".date('Y-m-d H:i:s',time())."】";
    $yuebao_log_value['add_time'] = time();
    $yuebao_log_value['ip'] = get_client_ip();
    $yuebao_log_rs = M("yuebao_log")->add($yuebao_log_value);

    /**
     * 更新账户资金
     */
    $member_money_value = array();
    $member_money_value['account_money'] = $member_money_data['account_money'];
    $member_money_value['back_money'] = $member_money_data['back_money'] + $money;
    $member_money_value['collect_money'] = $member_money_data['money_collect'];
    $member_money_value['freeze_money'] = $member_money_data['money_freeze'];
    $member_money_rs = M('member_money')->where(array(uid=>$uid))->save($member_money_value);

    /**
     * 增加账户操作记录
     */
    $member_moneylog_value = array();
    $member_moneylog_value['affect_money'] = $money;
    $member_moneylog_value['account_money'] = $member_money_value['account_money'];
    $member_moneylog_value['back_money'] = $member_money_value['back_money'];
    $member_moneylog_value['collect_money'] = $member_money_value['collect_money'];
    $member_moneylog_value['freeze_money'] = $member_money_value['freeze_money'];

    $member_moneylog_value['uid'] = $uid;
    $member_moneylog_value['type'] = 142;
    $member_moneylog_value['info'] = "【{$members_data['id']}】号用户【{$members_data['user_name']}】从聚财宝转出【{$money}】元【".date('Y-m-d H:i:s',time())."】";
    $member_moneylog_value['target_uid'] = 0;
    $member_moneylog_value['target_uname'] = "@网站管理员@";
    $member_moneylog_value['add_time'] = time();
    $member_moneylog_value['add_ip'] = get_client_ip();
    $member_moneylog_rs = M('member_moneylog')->add($member_moneylog_value);

    if($yuebao_info_rs&&$yuebao_log_rs&&$member_money_rs&&$member_moneylog_rs){
        $yuebao_info_dal->commit();
        return array(code=>1,msg=>'转出成功');
    }else{
        $yuebao_info_dal->rollback();
        return array(code=>0,msg=>'转出失败');
    }
}

/**
 * 计划任务
 */
function Yuebao_Autointerest(){
//    yuebao_rule
//    $balanceconfig=  require C("ROOT_URL")."Dynamic/balance_config.php";
    $glodata = get_global_setting();
    $yuebao_rule = explode("|",$glodata['yuebao_rule']);
    $yuebao_rule_enable = $yuebao_rule[0];
    $yuebao_rule_shouyi = $yuebao_rule[1];
    $yuebao_rule_name = "聚财宝";

    if($yuebao_rule_enable==0){
        $output = array('code'=>0,'msg'=>'计息未开启');
        exit(json_encode($output));
    }
    $rate = $yuebao_rule_shouyi;//万份收益

    $list = M("yuebao_info")
        ->field(true)
        ->where(array(status=>1))
        ->select();
    $of = fopen(dirname(C("APP_ROOT")) . "/CORE/Auto/Yuebao/log/Yuebao-".date("Y-m-d-H-i-s", time()).".txt",'w+');

    $strOut="==============正在执行{$yuebao_rule_name}计息程序=============="."\r\n<br/>";
    $pre = C("DB_PREFIX");

    foreach($list as $k=>$v){
        /**
         * 正式限制
         * 限制一个用户一天只能执行一次
         */
        $yuebao_log_data = M('yuebao_log')
            ->where(array(type=>143,uid=>$v['uid'],add_time=>array('between',array(mktime(0,0,0,date('m'),date('d'),date('Y')),mktime(23,59,59,date('m'),date('d'),date('Y'))))))
            ->select();

        $_current_day_charge = M('yuebao_log')
            ->where(array(type=>141,uid=>$v['uid'],add_time=>array('between',array(mktime(0,0,0,date('m'),date('d'),date('Y')),mktime(23,59,59,date('m'),date('d'),date('Y'))))))->sum('affect_money');

        $effective_money = $v['money']+$v['interest']-$_current_day_charge;

        echo "<br/>**********<br/>";
        echo $v['money'].'-'.$v['interest'].'-'.$_current_day_charge."<br/>";
//        var_dump($v);
        var_dump($yuebao_log_data);
        echo $effective_money;
        echo "<br/>**********<br/>";

        if(!is_array($yuebao_log_data)&&$effective_money>0){
            $minfo = M('members')->find($v['uid']);
            $yuebao_info_dal = D('yuebao_info');
            $yuebao_info_dal->startTrans();
            #实际利息
//            $interest =round($rate*$effective_money/10000+$v['panny_interest'],4);
            $interest =round($rate*$effective_money/360/100+$v['panny_interest'],4);
            $day_shouyi  = floor($interest*100)/100;
            $panny_interest = $interest-$day_shouyi;

            $yuebao_info_value = array();
            $yuebao_info_value['id'] = $v['id'];
            $yuebao_info_value['interest'] = $v['interest']+$day_shouyi;
            if($day_shouyi==0){
                $yuebao_info_value['panny_interest'] = $interest;
            }else{
                $yuebao_info_value['panny_interest'] = $panny_interest;
            }
            $yuebao_info_rs = M("yuebao_info")->save($yuebao_info_value);

            $yuebao_log_value = array();
            $yuebao_log_value['uid'] = $v['uid'];
            $yuebao_log_value['type'] = 143;
            $yuebao_log_value['affect_money'] = $day_shouyi;
            $yuebao_log_value['total_money'] = $v['money']+$v['interest'];
            $yuebao_log_value['info'] = "【{$v['uid']}】号用户【{$minfo['user_name']}】收到利息【{$day_shouyi}】元【".date('Y-m-d H:i:s',time())."】";
            $yuebao_log_value['add_time'] = time();
            $yuebao_log_value['ip'] = get_client_ip();
            $yuebao_log_rs = M("yuebao_log")->add($yuebao_log_value);
//            echo '<br/>***'.$yuebao_info_rs.'-'.$yuebao_log_rs.'<br/>';
            if($yuebao_info_rs!==false && $yuebao_log_rs!==false){
                $yuebao_info_dal->commit();
            }else{
                $yuebao_info_dal->rollback();
            }
//            $info = "【{$v['uid']}】号用户【{$minfo['user_name']}】收到利息【{$day_shouyi}】元【".date('Y-m-d H:i:s',time())."】"
            if($day_shouyi==0){
                $strOut.="<br/>【".date('Y-m-d H:i:s',time())."】-【{$v['uid']}】号用户【{$minfo['user_name']}】今日利息不足一分钱，将累计达到一分钱时给予利息\r\n<br/>";
            }else{
                $strOut.="<br/>【{$v['uid']}】号用户【{$minfo['user_name']}】收到利息【{$day_shouyi}】元\r\n<br/>";
            }

        }

    }

    fwrite($of, $strOut);
    fclose($of);
    echo $strOut;

}


function Yuebao_Log($map,$size=15){
    #分页处理
    import("ORG.Util.Page");
    $count = M('yuebao_log')->where($map)->count('id');
    $p = new Page($count, $size);
    $page = $p->show();
    $Lsql = "{$p->firstRow},{$p->listRows}";
    #分页处理

    $list = M('yuebao_log')->where($map)->order('id DESC')->limit($Lsql)->select();
//    $type_arr = C("MONEY_LOG");
//    foreach($list as $key=>$v){
//        $list[$key]['type'] = $type_arr[$v['type']];
//        /*if($v['affect_money']>0){
//            $list[$key]['in'] = $v['affect_money'];
//            $list[$key]['out'] = '';
//        }else{
//            $list[$key]['in'] = '';
//            $list[$key]['out'] = $v['affect_money'];
//        }*/
//    }

    $row=array();
    $row['list'] = $list;
    $row['page'] = $page;
    return $row;
}

?>