<?php
/**
 +------------------------------------------------------------------------------
 * 微信端众筹预约
 +------------------------------------------------------------------------------
 * @date     2016-3-29
 +------------------------------------------------------------------------------ 
 */
class ReservationAction extends MobileAction {
    
    /**
     +----------------------------------------------------------
     * 预约设置
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function index() {
        
        $map['user_id'] = $this->uid;
        $map['status'] = 1;
        $size = 10;
        $order['add_time'] = 'ASC';
        $crowd_auto = M('crowd_auto');
        
        // 分页处理
        import("ORG.Util.Page");
        $count = $crowd_auto->where($map)->count('id');
        $p = new Page($count, $size);
        $page = $p->ajax_show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        // 预约列表
        $auto_model =  M();
        $sql_1 = "SET @row_number = 0;";
        $auto_model->query($sql_1);
        $sql= "SELECT * from(SELECT *,@row_number:=@row_number+1 AS row_number from nuomi_crowd_auto WHERE status = 1 ORDER BY add_time ASC ) kk where user_id =
        ".$map['user_id']." AND status = ".$map['status']." limit ".$Lsql."";
        $list = $auto_model->query($sql);
        $this->assign("page",$page);
        $this->assign('list',$list);
        if($this->isAjax()){
            exit($this->fetch('reservation_list'));
        }
        
        // 预约数据
        $all_count = M('crowd_auto')->count("id"); // 总预约
        $now_count = M('crowd_auto')->where('status = 1')->count('id'); //当前预约中
        $now_people = M('crowd_auto')->where("status = 1")->count('DISTINCT user_id'); // 预约人数
        $all_money = M('crowd_auto')->sum("auto_money");//预约总金额，包括使用和未使用的
        $now_money = M('crowd_auto')->where('status = 1')->sum("surplus_money");//前面排队资金
        
        $this->assign('all_count',$all_count);
        $this->assign('now_count',$now_count);
        $this->assign('now_people',$now_people);
        $this->assign('all_money',$all_money);
        $this->assign('now_money',$now_money);
        
        // 增加预约相关信息 
        $this->assign("investInfo", getMinfo($this->uid,true));//个人账户信息
        $text['user_id']=$this->uid;
        $text['status']=1;
        $c_id = M('crowd_auto')->where($text)->field('sum(surplus_money) as user_money')->find();
        $text = M('crowd_config')->field('text')->find('7');
        $text['text'] = $text['text']*10000;
        $remain_money = $text['text']-$c_id['user_money'];
        $this->assign('reservation_all_money',$text['text']);
        $this->assign('remain_money',$remain_money);
        $deadline = time()+10*24*3600;//当前时间的十天之后
        $this->assign('deadline',$deadline);
        
        $this->display();
    }
    
    /**
     +----------------------------------------------------------
     * 取消预约
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function cancle(){
        if(!$this->uid) exit;
        $uid = $this->uid;
        $auto_id = $_POST['id'];//预约的ID
        $auto = M('crowd_auto')->where('id = '.$auto_id)->find();
        if(!$auto) ajaxmsg('error',3);
        $crowd_auto = M('crowd_auto');
        $crowd_auto->startTrans();
        $upcrowdauto = M('crowd_auto')->where('id = '.$auto_id)->save(array('status'=>2));//取消该预约
        $accountMoney_investor = M('member_money')->field(true)->where('uid = '.$uid)->find();
        $datamoney_x['uid'] = $uid;//用户id
        $datamoney_x['type'] = 57;
        $datamoney_x['affect_money'] = $auto['surplus_money'];//变动资金
        $datamoney_x['account_money'] = ($accountMoney_investor['account_money'] + $datamoney_x['affect_money']);//取消预约返回充值资金池
        $datamoney_x['collect_money'] = $accountMoney_investor['money_collect'];
        $datamoney_x['freeze_money'] = $accountMoney_investor['money_freeze'] - $datamoney_x['affect_money'];
        $datamoney_x['back_money'] = $accountMoney_investor['back_money'];

        //会员帐户
        $mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
        $mmoney_x['money_collect'] = $datamoney_x['collect_money'];
        $mmoney_x['account_money'] = $datamoney_x['account_money'];
        $mmoney_x['back_money'] = $datamoney_x['back_money'];

        $_xstr = "手动取消";
        $datamoney_x['info'] = "第{$auto_id}号众筹预约".$_xstr."，返回剩余额度资金";
        $datamoney_x['add_time'] = time();
        $datamoney_x['add_ip'] = get_client_ip();
        $datamoney_x['target_uid'] = 0;
        $datamoney_x['target_uname'] = "@网站管理员@";
        $moneynewid_x = M('member_moneylog')->add($datamoney_x);
        if($moneynewid_x) $bxid = M('member_money')->where("uid={$datamoney_x['uid']}")->save($mmoney_x);
        if($upcrowdauto && $moneynewid_x && $bxid){
            $crowd_auto->commit();
            ajaxmsg('预约取消成功！',1);
        }else{
            $crowd_auto->rollback();
            ajaxmsg('预约取消失败！',3);
        }

    }
    
    /**
     +----------------------------------------------------------
     * 新增预约
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function add() {
        
        $pre = C('DB_PREFIX');
        if(!$this->uid) {
            ajaxmsg('请先登录',0);
            exit;
        }
        $pin = md5($_POST['pin_pass']);//获取过来的支付密码
        $money = intval($_POST['money']);//获取过来的投资金额
        $vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
        $amoney = $vm['account_money'] + $vm['back_money'];
        $uname = session('u_user_name');
        $pin_pass = $vm['pin_pass'];//支付密码
        $amoney = floatval($amoney);//用户总资金
        $deadline = strtotime($_POST['deadline']."23:59:59");//预约截至时间

        // 预约验证
        $text['user_id'] = $this->uid;
        $text['status'] = 1;
        $c_id = M('crowd_auto')->where($text)->field('sum(surplus_money) as user_money')->find();
        $text = M('crowd_config')->field('text')->find('7');
        $text['text'] = $text['text']*10000;
        $remain_money = $text['text']-$c_id['user_money'];
        if($pin <> $pin_pass) ajaxmsg("支付密码错误，请重试!",0);
        if($money%1000 != 0) ajaxmsg("预约金额必须为1000的整数倍，请重新输入",0);
        if($money <= 0 ) ajaxmsg("预约金额异常，请重新输入",0);
        if($money > $remain_money) ajaxmsg("预约金额大于可用预约额度，请重新输入预约金额！",0);
        if($deadline < time()) ajaxmsg("预约截至时间不能小于当前时间！",0);
        if($money > $amoney){
            $msg = "尊敬的{$uname}，您准备预约{$money}元，但您的账户可用余额为{$amoney}元，请先进行充值？";
            ajaxmsg($msg,0);
        }
        
        $member_money = M('member_money')->field('account_money,money_collect,money_freeze,back_money')->find($this->uid);
        $crowd_auto = M('crowd_auto');
        $crowd_auto->startTrans();
        $data['user_id'] = $this->uid;
        $data['auto_money'] = $_POST['money'];
        $data['employ_money'] = 0;
        $data['surplus_money'] = $_POST['money'];
        $data['add_time'] = time();
        $data['status'] = 1;
        $data['deadline'] = $deadline;
        $id = M('crowd_auto')->add($data);

        if($member_money['account_money'] >= $_POST['money']){
            $user_money['account_money'] = $member_money['account_money']-$_POST['money'];
            $user_money['back_money'] = $member_money['back_money'];
        }elseif($member_money['back_money'] >= $_POST['money']){
            $user_money['back_money'] = $member_money['back_money']-$_POST['money'];
            $user_money['account_money'] = $member_money['account_money'];
        }else{
            $residue_money = $_POST['money']-$member_money['account_money'];
            if($residue_money >= 0){
                $user_money['account_money'] = 0;
            }
            $user_money['back_money'] = $member_money['back_money']-$residue_money;
        }
        $user_money['money_freeze'] = $member_money['money_freeze']+$_POST['money'];
        $money_id = M('member_money')->where('uid='.$this->uid)->save($user_money);

        // 预约资金记录
        $money_log['uid'] = $this->uid;
        $money_log['affect_money'] = -$_POST['money'];
        $money_log['account_money'] = $user_money['account_money'];
        $money_log['back_money'] = $user_money['back_money'];
        $money_log['freeze_money'] = $user_money['money_freeze'];
        $money_log['type'] = 56;
        $money_log['collect_money'] = $member_money['money_collect'];
        $money_log['info'] = "预约成功，冻结预约金".$_POST['money']."元";
        $money_log['add_time'] = time();
        $money_log['add_ip'] = get_client_ip();
        $money_log['target_uid'] = 0;
        $money_log['target_uname'] = "@网站管理员@";
        $moneylog_id = M('member_moneylog')->add($money_log);
        if($id && $money_id && $moneylog_id){
            $crowd_auto->commit();
            ajaxmsg("预约成功！成功预约".$_POST['money']."元",1);
        }else{
            $crowd_auto->rollback();
            ajaxmsg('预约失败！',0);
        }

    }
}