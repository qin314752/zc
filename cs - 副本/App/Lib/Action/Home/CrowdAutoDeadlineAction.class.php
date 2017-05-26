<?php
/**
 * User: Administrator
 */
class CrowdAutoDeadlineAction extends HCommonAction
{
    public function  deadline()
    {
        //用来判断所有用户的预约是否到期，如果到了截至日期，还未使用，则自动取消预约
        $auto_list = M('crowd_auto')->where('status = 1')->select();
        foreach($auto_list as $key=>$v){
            if($v['deadline'] <= time()){
                self::AutoRefuse($v['id']);
            }
        }
    }
    public static function AutoRefuse($autoid)
    {
        //取消该预约,剩余预约额度返还到可用余额中，返回到充值资金池（未进行投资），减去冻结
        $auto_info = M('crowd_auto')->field(true)->where('id = '.$autoid)->find();
        if(!$auto_info) return;
        $uid = $auto_info['user_id'];
        $affect_money = $auto_info['surplus_money'];//变动资金
        $crowd_auto=M('crowd_auto');
        $crowd_auto->startTrans();
        $upcrowdauto = M('crowd_auto')->where('id = '.$autoid)->save(array('status'=>0));//取消该预约
        $accountMoney_investor=M('member_money')->field(true)->where('uid = '.$uid)->find();
        $datamoney_x['uid'] =$uid;//用户id
        $datamoney_x['type'] = 57;
        $datamoney_x['affect_money'] = $affect_money;//变动资金
        $datamoney_x['account_money'] = ($accountMoney_investor['account_money'] + $datamoney_x['affect_money']);//取消预约返回充值资金池
        $datamoney_x['collect_money'] = $accountMoney_investor['money_collect'];
        $datamoney_x['freeze_money'] = $accountMoney_investor['money_freeze'] - $datamoney_x['affect_money'];
        $datamoney_x['back_money'] = $accountMoney_investor['back_money'];

        //会员帐户
        $mmoney_x['money_freeze']=$datamoney_x['freeze_money'];
        $mmoney_x['money_collect']=$datamoney_x['collect_money'];
        $mmoney_x['account_money']=$datamoney_x['account_money'];
        $mmoney_x['back_money']=$datamoney_x['back_money'];

        $_xstr = "到达截至时间未投资，自动取消";
        $datamoney_x['info'] = "第{$autoid}号众筹预约".$_xstr."，返回剩余额度资金";
        $datamoney_x['add_time'] = time();
        $datamoney_x['add_ip'] = get_client_ip();
        $datamoney_x['target_uid'] = 0;
        $datamoney_x['target_uname'] = "@网站管理员@";
        $moneynewid_x = M('member_moneylog')->add($datamoney_x);
        if($moneynewid_x) $bxid = M('member_money')->where("uid={$datamoney_x['uid']}")->save($mmoney_x);
        if($upcrowdauto && $moneynewid_x && $bxid){
            $crowd_auto->commit();
        }else{
            $crowd_auto->rollback();
        }

    }
}