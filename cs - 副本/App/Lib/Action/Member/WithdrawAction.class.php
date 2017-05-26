<?php

class WithdrawAction extends MCommonAction {

    public function index(){
    	        $minfo =getMinfo($this->uid,true);
        $pin_pass = $minfo['pin_pass'];
        $has_pin = (empty($pin_pass))?"no":"yes";
        $this->assign("has_pin",$has_pin);
        $this->assign("memberinfo", M('members')->find($this->uid));
        $this->assign("memberdetail", M('member_info')->find($this->uid));
        $this->assign("minfo",$minfo);
		$this->display();
    }

    public function withdraw(){
		$pre = C('DB_PREFIX');
		$field = "m.user_name,m.user_phone,(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money,i.real_name,b.bank_num,b.bank_name,b.bank_address";
		$vo = M('members m')->field($field)->join("{$pre}member_info i on i.uid = m.id")->join("{$pre}member_money mm on mm.uid = m.id")->join("{$pre}member_banks b on b.uid = m.id")->where("m.id={$this->uid}")->find();
		if(empty($vo['bank_num'])) $data['html'] = '<script type="text/javascript">alert("您还未绑定银行帐户，请先绑定");window.location.href="'.__APP__.'/member/bank#fragment-1";</script>';
		else{
			$tqfee = explode( "|", $this->glo['fee_tqtx']);
			$fee[0] = explode( "-", $tqfee[0]);
			$fee[1] = explode( "-", $tqfee[1]);
			$fee[2] = explode( "-", $tqfee[2]);
			$this->assign( "fee",$fee);
            $borrow_info = M("borrow_info")
                        ->field("sum(has_borrow+borrow_interest+borrow_fee) as borrow, sum(repayment_money+repayment_interest) as also")
                        ->where("borrow_uid = {$this->uid} and borrow_type=4 and borrow_status in (0,2,4,6,8,9,10)")
                        ->find();
            $vo['all_money'] -= $borrow_info['borrow'] + $borrow_info['also'];
            $this->assign("borrow_info", $borrow_info);
			$this->assign( "vo",$vo);
			$this->assign("memberinfo", M('members')->find($this->uid));
			$data['html'] = $this->fetch();
		}
		exit(json_encode($data));
    }
	
	public function validate(){
		$pre = C('DB_PREFIX');
		$withdraw_money = floatval($_POST['amount']);
		$pwd = md5($_POST['pwd']);
		$vo = M('members m')->field('mm.account_money,mm.back_money,m.user_leve,m.time_limit')->join("{$pre}member_money mm on mm.uid = m.id")->where("m.id={$this->uid} AND m.pin_pass='{$pwd}'")->find();
        $borrow_info = M("borrow_info")
                        ->field("sum(borrow_money+borrow_interest+borrow_fee) as borrow, sum(repayment_money+repayment_interest) as also")
                        ->where("borrow_uid = {$this->uid} and borrow_type=4 and borrow_status in (0,2,4,6,8,9,10)")
                        ->find();
		if(!is_array($vo)) ajaxmsg("",0);
        $borrow_money = $vo['account_money']+$vo['back_money']-($borrow_info['borrow']+$borrow_info['also']);
        if(($borrow_money - $withdraw_money)<0){
            ajaxmsg("存在净值标借款".($borrow_info['borrow']+$borrow_info['also'])."元未还，账户余额提现不足",2);
        }
		if(($vo['account_money']+$vo['back_money'])<$withdraw_money) ajaxmsg("提现额大于帐户余额",2);
		$start = strtotime(date("Y-m-d",time())." 00:00:00");
		$end = strtotime(date("Y-m-d",time())." 23:59:59");
		$wmap['uid'] = $this->uid;
		$wmap['withdraw_status'] = array("neq",3);
		$wmap['add_time'] = array("between","{$start},{$end}");
		$today_money = M('member_withdraw')->where($wmap)->sum('withdraw_money');	
		$today_time = M('member_withdraw')->where($wmap)->count('id');	

		$tqfee = explode("|",$this->glo['fee_tqtx']);

        //////////////////////////////////修改提现手续费///////////////////////////////////////
        switch(count($tqfee)){
            case 2:
                $fee[0] = $tqfee[0];//手续费
                $fee[2] = explode("-",$tqfee[1]);//上限

                break;
            case 3:
                $fee[0] = explode("-",$tqfee[0]);
                $fee[1] = explode("-",$tqfee[1]);
                $fee[2] = explode("-",$tqfee[2]);
                break;
            default:
                ajaxmsg("提现规则设置有误，请联系管理员",2);

        }
        //////////////////////////////////修改提现手续费（完）///////////////////////////////////////
//		$fee[0] = explode("-",$tqfee[0]);
//		$fee[1] = explode("-",$tqfee[1]);
//		$fee[2] = explode("-",$tqfee[2]);
		
		$one_limit = $fee[2][0]*10000;
		if($withdraw_money<100 ||$withdraw_money>$one_limit) ajaxmsg("单笔提现金额限制为100-{$one_limit}元",2);
		$today_limit = $fee[2][1]/$fee[2][0];
		if($today_time>$today_limit){
					$message = "一天最多只能提现{$today_limit}次";
					ajaxmsg($message,2);
		}
		
		if(1==1 || $vo['user_leve']>0 && $vo['time_limit']>time()){
		//////////////////////////////////////////
			$itime = strtotime(date("Y-m", time())."-01 00:00:00").",".strtotime( date( "Y-m-", time()).date("t", time())." 23:59:59");
			$wmapx['uid'] = $this->uid;
			$wmapx['withdraw_status'] = array("neq",3);
			$wmapx['add_time'] = array("between","{$itime}");
			$times_month = M("member_withdraw")->where($wmapx)->count("id");
			
			$tqfee1 = explode("|",$this->glo['fee_tqtx']);

            //////////////////////////////////修改提现手续费///////////////////////////////////////
            switch(count($tqfee1)){
                case 2:
                    $fee = $tqfee1[0]; //手续费
                    $message = "您好，您申请提现{$withdraw_money}元，收取提现手续费{$fee}元，确认要提现吗？";
                    break;
                case 3:
                    $fee1[0] = explode("-",$tqfee1[0]);
                    $fee1[1] = explode("-",$tqfee1[1]);
                    if(($withdraw_money-$vo['back_money'])>=0){
                        $maxfee1 = ($withdraw_money-$vo['back_money'])*$fee1[0][0]/1000;
                        if($maxfee1>=$fee1[0][1]){
                            $maxfee1 = $fee1[0][1];
                        }

                        $maxfee2 = $vo['back_money']*$fee1[1][0]/1000;
                        if($maxfee2>=$fee1[1][1]){
                            $maxfee2 = $fee1[1][1];
                        }

                        $fee = $maxfee1+$maxfee2;
                        $money = $withdraw_money-$vo['back_money'];
                    }else{
                        $fee = $vo['back_money']*$fee1[1][0]/1000;
                    }
                    $fee=round($fee,2);
                    if($withdraw_money <= $vo['back_money'])
                    {
                        $message = "您好，您申请提现{$withdraw_money}元，小于目前的回款总额{$vo['back_money']}元，因此无需手续费，确认要提现吗？";
                    }else{
                        $message = "您好，您申请提现{$withdraw_money}元，其中有{$vo['back_money']}元在回款之内，无需提现手续费，另有{$money}元需收取提现手续费{$fee}元，确认要提现吗？";
                    }

                    break;
                default:
                    ajaxmsg("提现规则设置有误，请联系管理员",2);

            }
            //////////////////////////////////修改提现手续费（完）///////////////////////////////////////
//			$fee1[0] = explode("-",$tqfee1[0]);
//			$fee1[1] = explode("-",$tqfee1[1]);
//			if(($withdraw_money-$vo['back_money'])>=0){
//				$maxfee1 = ($withdraw_money-$vo['back_money'])*$fee1[0][0]/1000;
//				if($maxfee1>=$fee1[0][1]){
//					$maxfee1 = $fee1[0][1];
//				}
//
//				$maxfee2 = $vo['back_money']*$fee1[1][0]/1000;
//				if($maxfee2>=$fee1[1][1]){
//					$maxfee2 = $fee1[1][1];
//				}
//
//				$fee = $maxfee1+$maxfee2;
//				$money = $withdraw_money-$vo['back_money'];
//			}else{
//				$fee = $vo['back_money']*$fee1[1][0]/1000;
//			}

//			if($withdraw_money <= $vo['back_money'])
//			{
//				$message = "您好，您申请提现{$withdraw_money}元，小于目前的回款总额{$vo['back_money']}元，因此无需手续费，确认要提现吗？";
//			}else{
//				$message = "您好，您申请提现{$withdraw_money}元，其中有{$vo['back_money']}元在回款之内，无需提现手续费，另有{$money}元需收取提现手续费{$fee}元，确认要提现吗？";
//			}


			ajaxmsg( "{$message}", 1 );
			
			if(($today_money+$withdraw_money)>$fee[2][1]*10000){
					$message = "单日提现上限为{$fee[2][1]}万元。您今日已经申请提现金额：{$today_money}元,当前申请金额为:{$withdraw_money}元,已超出单日上限，请您修改申请金额或改日再申请提现";
					ajaxmsg($message,2);
			}
			
		//////////////////////////////////////////////
				
		}else{//普通会员暂未使用
				if(($today_money+$withdraw_money)>300000){
					$message = "您是普通会员，单日提现上限为30万元。您今日已经申请提现金额：$today_money元,当前申请金额为:$withdraw_money元,已超出单日上限，请您修改申请金额或改日再申请提现";
					ajaxmsg($message,2);
				}
				$tqfee = $this->glo['fee_pttx'];
				$fee = getFloatValue($tqfee*$withdraw_money/100,2);

            //判断是否设置手续费
//            if(count($tqfee)==2){
//                $fee=$withdraw_money*$fee[0]/1000;
//            }
				
				if( ($vo['account_money']-$withdraw_money - $fee)<0 ){
					$message = "您好，您申请提现{$withdraw_money}元，提现手续费{$fee}元将从您的提现金额中扣除，确认要提现吗？";
				}else{
					$message = "您好，您申请提现{$withdraw_money}元，提现手续费{$fee}元将从您的帐户余额中扣除，确认要提现吗？";
				}
				ajaxmsg("{$message}",1);
		}
	}
	
	public function actwithdraw(){
		$pre = C('DB_PREFIX');
		$withdraw_money = floatval($_POST['amount']);
		$pwd = md5($_POST['pwd']);
		$vo = M('members m')->field('mm.account_money,mm.back_money,(mm.account_money+mm.back_money) all_money,m.user_leve,m.time_limit')->join("{$pre}member_money mm on mm.uid = m.id")->where("m.id={$this->uid} AND m.pin_pass='{$pwd}'")->find();
		if(!is_array($vo)) ajaxmsg("",0);
		if($vo['all_money']<$withdraw_money) ajaxmsg("提现额大于帐户余额",2);
		$start = strtotime(date("Y-m-d",time())." 00:00:00");
		$end = strtotime(date("Y-m-d",time())." 23:59:59");
		$wmap['uid'] = $this->uid;
		$wmap['withdraw_status'] = array("neq",3);
		$wmap['add_time'] = array("between","{$start},{$end}");
		$today_money = M('member_withdraw')->where($wmap)->sum('withdraw_money');	
		$today_time = M('member_withdraw')->where($wmap)->count('id');	
		$tqfee = explode("|",$this->glo['fee_tqtx']);

        //////////////////////////////////修改提现手续费///////////////////////////////////////
        switch(count($tqfee)){
            case 2:
                $fee[0] = $tqfee[0];//手续费
                $fee[2] = explode("-",$tqfee[1]);//上限

                break;
            case 3:
                $fee[0] = explode("-",$tqfee[0]);
                $fee[1] = explode("-",$tqfee[1]);
                $fee[2] = explode("-",$tqfee[2]);
                break;
            default:
                ajaxmsg("提现规则设置有误，请联系管理员",2);
        }
        //////////////////////////////////修改提现手续费（完）///////////////////////////////////////

//		$fee[0] = explode("-",$tqfee[0]);
//		$fee[1] = explode("-",$tqfee[1]);
//		$fee[2] = explode("-",$tqfee[2]);

		$one_limit = $fee[2][0]*10000;
		if($withdraw_money<100 ||$withdraw_money>$one_limit) ajaxmsg("单笔提现金额限制为100-{$one_limit}元",2);
		$today_limit = $fee[2][1]/$fee[2][0];
		if($today_time>=$today_limit){
					$message = "一天最多只能提现{$today_limit}次";
					ajaxmsg($message,2);
		}
		
		if(1==1 || $vo['user_leve']>0 && $vo['time_limit']>time()){
			if(($today_money+$withdraw_money)>$fee[2][1]*10000){
				$message = "单日提现上限为{$fee[2][1]}万元。您今日已经申请提现金额：{$today_money}元,当前申请金额为:{$withdraw_money}元,已超出单日上限，请您修改申请金额或改日再申请提现";
				ajaxmsg($message,2);
			}
			$itime = strtotime(date("Y-m", time())."-01 00:00:00").",".strtotime( date( "Y-m-", time()).date("t", time())." 23:59:59");
			$wmapx['uid'] = $this->uid;
			$wmapx['withdraw_status'] = array("neq",3);
			$wmapx['add_time'] = array("between","{$itime}");
			$times_month = M("member_withdraw")->where($wmapx)->count("id");
			
		
			$tqfee1 = explode("|",$this->glo['fee_tqtx']);

            //////////////////////////////////修改提现手续费///////////////////////////////////////
            switch(count($tqfee1)) {
                case 2:
                    $fee = $tqfee1[0]; //手续费
                    //$fee=$withdraw_money*$fee1[0]/1000;
                    break;
                case 3:
                    $fee1[0] = explode("-",$tqfee1[0]);
                    $fee1[1] = explode("-",$tqfee1[1]);
                    if(($withdraw_money-$vo['back_money'])>=0){
                        $maxfee1 = ($withdraw_money-$vo['back_money'])*$fee1[0][0]/1000;
                        if($maxfee1>=$fee1[0][1]){
                            $maxfee1 = $fee1[0][1];
                        }

                        $maxfee2 = $vo['back_money']*$fee1[1][0]/1000;
                        if($maxfee2>=$fee1[1][1]){
                            $maxfee2 = $fee1[1][1];
                        }

                        $fee = $maxfee1+$maxfee2;
                        $money = $withdraw_money-$vo['back_money'];
                    }else{
                        //$fee = $vo['back_money']*$fee1[1][0]/1000;
                        $fee = $withdraw_money*$fee1[1][0]/1000;
                        if($fee>=$fee1[1][1]){
                            $fee = $fee1[1][1];
                        }
                    }
                    break;
                default :
                    ajaxmsg("提现规则设置有误，请联系管理员",2);

            }
            //////////////////////////////////修改提现手续费（完）///////////////////////////////////////


//			$fee1[0] = explode("-",$tqfee1[0]);
//			$fee1[1] = explode("-",$tqfee1[1]);
//			if(($withdraw_money-$vo['back_money'])>=0){
//				$maxfee1 = ($withdraw_money-$vo['back_money'])*$fee1[0][0]/1000;
//				if($maxfee1>=$fee1[0][1]){
//					$maxfee1 = $fee1[0][1];
//				}
//
//				$maxfee2 = $vo['back_money']*$fee1[1][0]/1000;
//				if($maxfee2>=$fee1[1][1]){
//					$maxfee2 = $fee1[1][1];
//				}
//
//				$fee = $maxfee1+$maxfee2;
//				$money = $withdraw_money-$vo['back_money'];
//			}else{
//				//$fee = $vo['back_money']*$fee1[1][0]/1000;
//				$fee = $withdraw_money*$fee1[1][0]/1000;
//				if($fee>=$fee1[1][1]){
//					$fee = $fee1[1][1];
//				}
//			}
			
			
			
			if(($vo['all_money']-$withdraw_money - $fee)<0 ){
			
				//$withdraw_money = ($withdraw_money - $fee);
				$moneydata['withdraw_money'] = $withdraw_money;
				$moneydata['withdraw_fee'] = $fee;
				$moneydata['second_fee'] = $fee;
				$moneydata['withdraw_status'] = 0;
				$moneydata['uid'] =$this->uid;
				$moneydata['add_time'] = time();
				$moneydata['add_ip'] = get_client_ip();
				$newid = M('member_withdraw')->add($moneydata);
				if($newid){
					memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',0,$newid);
					MTip('chk6',$this->uid);
					ajaxmsg("恭喜，提现申请提交成功",1);
				} 
				
			}else{
				$moneydata['withdraw_money'] = $withdraw_money;
				$moneydata['withdraw_fee'] = $fee;
				$moneydata['second_fee'] = $fee;
				$moneydata['withdraw_status'] = 0;
				$moneydata['uid'] =$this->uid;
				$moneydata['add_time'] = time();
				$moneydata['add_ip'] = get_client_ip();
				$newid = M('member_withdraw')->add($moneydata);
				if($newid){
					//memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',-$fee);
					memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',0,$newid);
					MTip('chk6',$this->uid);
					ajaxmsg("恭喜，提现申请提交成功",1);
				} 
			}
			ajaxmsg("对不起，提现出错，请重试",2);
		}else{//普通会员暂未使用
				if(($today_money+$withdraw_money)>300000){
					$message = "您是普通会员，单日提现上限为30万元。您今日已经申请提现金额：$today_money元,当前申请金额为:$withdraw_money元,已超出单日上限，请您修改申请金额或改日再申请提现";
					ajaxmsg($message,2);
				}
				$tqfee = $this->glo['fee_pttx'];
				$fee = getFloatValue($tqfee*$withdraw_money/100,2);
				
				if( ($vo['account_money']-$withdraw_money - $fee)<0 ){
				
					$withdraw_money = ($withdraw_money - $fee);
					$moneydata['withdraw_money'] = $withdraw_money;
					$moneydata['withdraw_fee'] = $fee;
					$moneydata['withdraw_status'] = 0;
					$moneydata['uid'] =$this->uid;
					$moneydata['add_time'] = time();
					$moneydata['add_ip'] = get_client_ip();
					$newid = M('member_withdraw')->add($moneydata);
					if($newid){
						memberMoneyLog($this->uid,4,-$withdraw_money - $fee,"提现,自动扣减手续费".$fee."元");
						MTip('chk6',$this->uid);
						ajaxmsg("恭喜，提现申请提交成功",1);
					} 
				}else{
					$moneydata['withdraw_money'] = $withdraw_money;
					$moneydata['withdraw_fee'] = $fee;
					$moneydata['withdraw_status'] = 0;
					$moneydata['uid'] =$this->uid;
					$moneydata['add_time'] = time();
					$moneydata['add_ip'] = get_client_ip();
					$newid = M('member_withdraw')->add($moneydata);
					if($newid){
						memberMoneyLog($this->uid,4,-$withdraw_money,"提现,自动扣减手续费".$fee."元",'0','@网站管理员@',-$fee);
						MTip('chk6',$this->uid);
						ajaxmsg("恭喜，提现申请提交成功",1);
					} 
				}
				ajaxmsg("对不起，提现出错，请重试",2);
		}
	}
	
	public function backwithdraw(){
		$id = intval($_GET['id']);
		$map['withdraw_status'] = 0;
		$map['uid'] = $this->uid;
		$map['id'] = $id;
                
		$vo = M('member_withdraw')->where($map)->find();
		if(!is_array($vo)) ajaxmsg('',0);
		///////////////////////////////////////////////
		$field = "(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money";
		$m = M('member_money mm')->field($field)->where("mm.uid={$this->uid}")->find();
		////////////////////////////////////////////////////
		$newid = M('member_withdraw')->where($map)->delete();
		if($newid){
			$res = memberMoneyLog($this->uid,5,$vo['withdraw_money'],"撤消提现",'0','@网站管理员@',0,$id,$vo['account_num'],$vo['back_num']);
		}
		if($res) ajaxmsg();
		else ajaxmsg("",0);
	}

    public function withdrawlog(){
		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}

		$map['uid'] = $this->uid;
		$list = getWithDrawLog($map,15);
		$this->assign('search',$search);
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['page']);
		
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

}