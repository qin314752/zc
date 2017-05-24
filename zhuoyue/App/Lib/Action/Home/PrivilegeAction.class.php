<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/23
 * Time: 15:05
 */
class PrivilegeAction extends HCommonAction{
    public function index(){
        //if(!$this->uid) $this->error("请先登录",__APP__."/member/common/login");
        $isopen['isopen']=array('neq',1);
        $isopen['size']=3;

        $list = getTqjlist($isopen);

        for($i=0;$i<count($list['list']);$i++){
            $status=explode("-",$list['list'][$i]['status_approve']);
            for($j=0;$j<count($status);$j++){
                if($status[$j]==0){
                    $list['list'][$i]['shouji']="手机认证";
                }
                if($status[$j]==1){
                    $list['list'][$i]['shiming']="实名认证";
                }
                if($status[$j]==2){
                    $list['list'][$i]['youxiang']="邮箱认证";
                }
                if($status[$j]==3){
                    $list['list'][$i]['daishou']="在投金额";
                }
            }
        }

        $this->assign("count",$list['list']);
        $this->assign('pagebar',$list['page']);
        //var_dump(date("Y-m-d H:i:s",'1430744353'));
        $this->display();

    }
    public function receive(){
        $uid=$this->uid;//用户id
        if(!$this->uid){
            echo 4;
            return ;
        }
        $id=$_POST['id'];//特权金ID

        $underway=M('tqj_config')->find($id);
        if($underway['isopen']==1){
            echo 7;
            return ;
        }

        if($underway['begin_time']>time()){
            echo 5;
            return ;
        }
        if($underway['over_time']<time()){
            echo 6;
            return ;
        }

        $test['tqj_id']=$id;
        $test['user_id']=$uid;

        $cou=M('tqj_user')->where($test)->count(id);
        if($cou==1){
            echo 2;
            return;
        }else{
            $data=M('tqj_config')->find($id);
            $status=M('members_status')->find($uid);
            $sta=explode("-",$data['status_approve']);
            for($i=0;$i<count($sta);$i++){
                //手机认证
                if($sta[$i]==0){
                    if($status['phone_status']!=1){
                        echo 0;
                        return ;
                    }
                    //file_put_contents(mt_rand(1,99).".txt","通过手机认证");
                }
                //实名认证
                if($sta[$i]==1){
                    if($status['id_status']!=1){
                        echo 0;
                        return ;
                    }
                   //file_put_contents(mt_rand(1,99).".txt","通过实名认证");

                }
                //邮箱认证
                if($sta[$i]==2){
                    if($status['email_status']!=1){
                        echo 0;
                        return ;
                    }
                   // file_put_contents(mt_rand(1,99).".txt","通过邮箱认证");
                }
                //待收本金
                if($sta[$i]==3){
                    $benefit=get_personal_benefit($this->uid);
                    if($benefit['capital_collection']<$data['status_due_money']){
                        echo 3;
                        return ;
                    }
                   // file_put_contents(mt_rand(1,99).".txt","通过待收本金");
                }

            }
//            echo 1;exit;
//
//            switch($data['status_approve']){
//                case 0:
//                    //手机认证
//                    if($status['phone_status']==1){
//                        break;
//                    }else{
//                        echo 0;
//                        return ;
//                    }
//
//                case 1:
//                    //实名认证
//                    if($status['id_status']==1){
//                        break;
//                    }else{
//                        echo 0;
//                        return;
//                    }
//
//                case 2:
//                    //邮箱认证
//                    if($status['email_status']==1){
//                        break;
//                    }else{
//                        echo 0;
//                        return;
//                    }
//                    break;
//                case 3:
//                    //待收本金
//                    $benefit=get_personal_benefit($this->uid);
//                    if($benefit['capital_collection']>=$data['status_due_money']){
//                        break;
//                    }else{
//                        echo 3;
//                        return;
//                    }
//            }
            $user_tqj['tqj_id']=$id;
            $user_tqj['user_id']=$uid;
            $user_tqj['get_time']=time();
            $user_tqj['get_the_number']=$data['biggest'];
            $user_tqj['tqj_money']=$data['money'];
            $user_tqj['tqj_rate']=$data['rate'];
            $user_tqj['status']=1;
            $user_tqj['title']=$data['name'];
            $user_tqj['affect_money']=round($data['money']*$data['rate']*0.01/365,2);//每天收益
            //var_dump($user_tqj);
            M('tqj_user')->add($user_tqj);
            echo 1;
        }

    }
    //测试页面
    public function tequan() {
        $isopen['isopen']=array('neq',1);
        $isopen['size']=3;

        $list = getTqjlist($isopen);

        for($i=0;$i<count($list['list']);$i++){
            $status=explode("-",$list['list'][$i]['status_approve']);
            for($j=0;$j<count($status);$j++){
                if($status[$j]==0){
                    $list['list'][$i]['shouji']="手机认证";
                }
                if($status[$j]==1){
                    $list['list'][$i]['shiming']="实名认证";
                }
                if($status[$j]==2){
                    $list['list'][$i]['youxiang']="邮箱认证";
                }
                if($status[$j]==3){
                    $list['list'][$i]['daishou']="待收本金";
                }
            }
        }

        $this->assign("count",$list['list']);
        $this->assign('pagebar',$list['page']);
        //var_dump(date("Y-m-d H:i:s",'1430744353'));
        $this->display();
        
    }
    //计划任务
    public function Scheduler(){

        $privilege=file_get_contents("Privilege.txt");
        $Current=date("Y-m-d",time());
        $Current=strtotime($Current);
        //一天只能执行一次(正式环境下要把该判定放开)
//        if($Current==$privilege){
//            echo "一天只能执行一次";
//            return;
//        }
        echo "正在执行特权金计划任务";
        $status['status']=1;
        $data=M('tqj_user')->where($status)->select();
        foreach($data as $key=>$val){
            if($val['get_the_number']>$val['actual_the_number']){
                $uid['uid']=$val['user_id'];
                $back_money=M('member_money')->where($uid)->find();
                $back['back_money']=$back_money['back_money']+$val['affect_money'];
                //$users=M('member_money')->where($uid)->select();
                if($back_money==null){
                    $back['uid']=$val['user_id'];
                    $back['money_freeze']=0;
                    $back['money_collect']=0;
                    $back['account_money']=0;
                    $back['credit_limit']=0;
                    $back['credit_cuse']=0;
                    $back['borrow_vouch_cuse']=0;
                    $back['borrow_vouch_limit']=0;
                    $back['invest_vouch_limit']=0;
                    $back['invest_vouch_cuse']=0;
                    $member_money=M('member_money')->add($back);
                }else{
                    $member_money=M('member_money')->where($uid)->save($back);
                }

                echo  M('member_money')->getLastSql();
                unset($back);
                if(empty($member_money)){
                    echo "添加失败".empty($member_money);
                }else{
                    echo "添加成功".empty($member_money);
                }
                echo "<br/>===============================================================<br/>";
                $num['actual_the_number']=$val['actual_the_number']+1;
                $tqj_id['id']=$val['id'];

                M('tqj_user')->where($tqj_id)->save($num);
                echo  M('tqj_user')->getLastSql();


                //添加特权金记录
                $log['user_id']=$val['user_id'];
                $log['tqj_id']=$val['tqj_id'];
                $log['title']=$val['title'];
                $log['earnings']=$val['affect_money'];
                $log['get_time']=time();
                $log['tqj_rate']=$val['tqj_rate'];
                $log['tqj_money']=$val['tqj_money'];
                $tqj_log=M('tqj_log')->add($log);

                unset($log);
                if(empty($tqj_log)){
                    echo "特权金记录添加失败".empty($tqj_log);
                }else{
                    echo "特权金记录添加成功".empty($tqj_log);
                }
                echo "<br/>===============================================================<br/>";
                $user_moneylog=M('member_moneylog')->where($uid)->order('id desc')->limit(1)->find();
                if($user_moneylog==null){
                    $moneylog['account_money']=0;//可用余额
                    $moneylog['collect_money']=0;
                    $moneylog['freeze_money']=0;
                }else{
                    $moneylog['account_money']=$back_money['account_money'];//可用余额
                    $moneylog['collect_money']=$user_moneylog['collect_money'];//待收金额
                    $moneylog['freeze_money']=$user_moneylog['freeze_money'];//冻结金额
                }

                //更新总的资金记录表
                $moneylog['uid']=$val['user_id'];
                $moneylog['type']=49;
                $moneylog['affect_money']=$val['affect_money'];//影响金额
                $moneylog['back_money']=$back_money['back_money']+$val['affect_money'];//回款中的可用余额（特权金收益）
                $moneylog['info']=date("Y-m-d",time())."获得的红包收益";
                $moneylog['add_time']=time();
                $moneylog['add_ip']=get_client_ip();
                $moneylog['target_uid']=0;
                $moneylog['target_uname']='@网站管理员@';
                //var_dump($moneylog);exit;
                $member_moneylog=M('member_moneylog')->add($moneylog);
                echo  M('member_moneylog')->getLastSql();
                unset($moneylog);
                if(empty($member_moneylog)){
                    echo "资金记录表添加失败".empty($member_moneylog);
                }else{
                    echo "资金记录表添加成功".empty($member_moneylog);
                }
                echo "<br/>===============================================================<br/>";
            }
            //判定条件 结束时间  次数
            unset($id);
            $id=$val['tqj_id'];
            $over_time=M('tqj_config')->find($id);

            if($over_time['over_time']<time() && $val['get_the_number']==$val['actual_the_number']){
                $user_tqj['id']=$val['id'];
                $status['status']=2;
                M('tqj_user')->where($user_tqj)->save($status);
            }

        }
        
        $Current=strtotime(date("Y-m-d",time()));
        file_put_contents("Privilege.txt",$Current);



    }
}