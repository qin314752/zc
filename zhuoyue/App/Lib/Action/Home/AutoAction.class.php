<?php 
// 金糯米内核类库，2014-06-11_listam
class AutoAction {
	private $updir = null;
	public function _MyInit() {
		$this -> updir = dirname(C("APP_ROOT")) . "/CORE/Auto/";
	}

        //余额宝
        public function autoyuebao(){
            header("Content-type: text/html; charset=utf-8");
            Yuebao_Autointerest();
        }
        
	public function autorepayment() {
        header("Content-type:text/html;charset=utf-8");
        $key = $_GET['key'];
		$arg = file_get_contents(dirname(C("APP_ROOT")) . "/CORE/Auto/" . "config.txt");
		$arga = explode("|", $arg);
		$rate = intval($arga[1]);
		if ($key != $arga[2]) exit("fail|key wrong");

		$glodata = get_global_setting();
		$pre = C("DB_PREFIX");
		$strOut = "<br/>-----------正在执行企业直投自动还款程序：服务器当前时间" . date("Y-m-d H:i:s", time()) . "---------------<br/>";
		$map = array();
		$map['deadline'] = array("lt", time() + 86400);
        //$map['deadline'] = array("egt", time() + 86400);
		$map['status'] = 7;
		$list = M("transfer_investor_detail")
            -> field("id,invest_id,interest,investor_uid,borrow_uid,borrow_id,capital,interest_fee,sort_order,total")
            ->where($map)-> select();
        
		if (is_array($list) && !empty($list)) {
			$of = fopen(dirname(C("APP_ROOT")) ."/CORE/Auto/AutoRepayment/log/AutoRepayMent-".date("Y-m-d-H-i-s", time()).".txt",'w');
			$moneynewid_x_temp = true;
			$bxid_temp = true;
            $investor_temp = true;
			$summary_temp = true;
			$detail_temp = true;
			$moneynewid_temp = true;
			$xid_temp = true;
			fwrite($of, "\nlist=\n");
			fwrite($of, var_export($list, true));
			foreach ($list as $v) {
                    $Updateb = M('transfer_investor_detail');
                    $Updateb -> startTrans();
                    $datamoney_x = array();
                    $mmoney_x = array();
                    $updetail = array();
                    $datamoney = array();
                    $mmoney = array();
                    $accountMoney_borrower = M('member_money') -> field('money_freeze,money_collect,account_money,back_money') -> find($v['borrow_uid']);
                    /*				if (($accountMoney_borrower['account_money'] + $accountMoney_borrower['back_money']) < ($v['capital'] + $v['interest'])) {
                                        return "帐户可用余额不足，本期还款共需" . ($v['capital'] + $v['interest']) . "元，请先充值!";
                                    } */
                    // 借款者减少
                    $datamoney_x['uid'] = $v['borrow_uid'];
                    $datamoney_x['type'] = 11;
                    $datamoney_x['affect_money'] = - ($v['capital'] + $v['interest']);
                    if (($datamoney_x['affect_money'] + $accountMoney_borrower['back_money']) < 0) { // 如果需要还款的金额大于回款资金池资金总额
                        $datamoney_x['account_money'] = floatval($accountMoney_borrower['account_money'] + $accountMoney_borrower['back_money'] + $datamoney_x['affect_money']);
                        $datamoney_x['back_money'] = 0;
                    } else {
                        $datamoney_x['account_money'] = $accountMoney_borrower['account_money'];
                        $datamoney_x['back_money'] = floatval($accountMoney_borrower['back_money']) + $datamoney_x['affect_money']; //回款资金注入回款资金池
                    }
                    $datamoney_x['collect_money'] = $accountMoney_borrower['money_collect'];
                    $datamoney_x['freeze_money'] = $accountMoney_borrower['money_freeze'];
                    // 会员帐户
                    $mmoney_x['money_freeze'] = $datamoney_x['freeze_money'];
                    $mmoney_x['money_collect'] = $datamoney_x['collect_money'];
                    $mmoney_x['account_money'] = $datamoney_x['account_money'];
                    $mmoney_x['back_money'] = $datamoney_x['back_money'];
                    // 会员帐户
                    $datamoney_x['info'] = "对{$v['borrow_id']}号企业直投进行还款";
                    $datamoney_x['add_time'] = time();
                    $datamoney_x['add_ip'] = get_client_ip();
                    $datamoney_x['target_uid'] = $v['investor_uid'];
                    //$datamoney_x['target_uname'] = '@网站管理员@';
                    $moneynewid_x = M('member_moneylog') -> add($datamoney_x);
                    if ($moneynewid_x) $bxid = M('member_money') -> where("uid={$datamoney_x['uid']}") -> save($mmoney_x);
                    // 借款者减少
                    $vo = M("transfer_borrow_investor") -> field("transfer_month,transfer_num") -> where("id={$v['invest_id']}") -> find();

                    $update_investor = array();
                    $update_investor['id'] = $v['invest_id'];
                    if ($v['sort_order'] == $v['total']) {
                        $update_investor['status'] = 2; //还款完成
                    }

                    $update_investor['receive_capital'] = array("exp", "`receive_capital`+{$v['capital']}");
                    $update_investor['receive_interest'] = array("exp", "`receive_interest`+{$v['interest']}-{$v['interest_fee']}");
                    $update_investor['back_time'] = time();
                    $investor = M("transfer_borrow_investor") -> save($update_investor);

                    if ($v['sort_order'] == $v['total']) {
                        $update_borrow = array();
                        $info = M("transfer_borrow_info") -> find($v['borrow_id']);
                        $update_borrow['id'] = $v['borrow_id'];
                        $update_borrow['transfer_back'] = array("exp", "`transfer_back`+{$vo['transfer_num']}");
                        if(($info['transfer_back']+$vo['transfer_num']-$info['transfer_total']) == 0){
                            $update_borrow['borrow_status'] = 7; //还款完成
                        }
                        $summary = M("transfer_borrow_info") -> save($update_borrow);
                    } else {
                        $summary = true;
                    }
                    $mapdetail['id'] = $v['id'];
                    $updetail['status'] = 1; //还款完成
                    $updetail['receive_capital'] = array("exp", "`receive_capital`+{$v['capital']}");
                    $updetail['receive_interest'] = array("exp", "`receive_interest`+{$v['interest']}-{$v['interest_fee']}");
                    $updetail['repayment_time'] = time();
                    $detail = M("transfer_investor_detail") -> where($mapdetail) -> save($updetail);
                    // $strOut .= "成功还款第{$v['borrow_id']}号企业直投<br/>";
                    // //////////////////////////////////////////////////对投资帐户进行增加  开始//////////////////////////////////////////////////
                    if ($investor && $summary && $detail) {
                        $accountMoney = M('member_money') -> field('money_freeze,money_collect,account_money,back_money') -> find($v['investor_uid']);
                        $datamoney['uid'] = $v['investor_uid'];
                        $datamoney['type'] = "44";
                        $datamoney['affect_money'] = ($v['capital'] + $v['interest'] - $v['interest_fee']); //收利息加本金，并且扣管理费
                        $datamoney['account_money'] = $accountMoney['account_money'];
                        $datamoney['back_money'] = ($accountMoney['back_money'] + $datamoney['affect_money']);
                        $datamoney['collect_money'] = $accountMoney['money_collect'] - $datamoney['affect_money'];
                        $datamoney['freeze_money'] = $accountMoney['money_freeze'];
                        // 会员帐户
                        $mmoney['money_freeze'] = $datamoney['freeze_money'];
                        $mmoney['money_collect'] = $datamoney['collect_money'];
                        $mmoney['account_money'] = $datamoney['account_money'];
                        $mmoney['back_money'] = $datamoney['back_money'];
                        // 会员帐户
                        $datamoney['info'] = "收到借款人对{$v['borrow_id']}号企业直投的还款";
                        $datamoney['add_time'] = time();
                        $datamoney['add_ip'] = get_client_ip();

                        $datamoney['target_uid'] = $v['borrow_uid'];
                        $minfob = M('members')->where("id={$v['borrow_uid']}")->find();
                        $datamoney['target_uname'] = $minfob['user_name'];

                        $moneynewid = M('member_moneylog') -> add($datamoney);
                        if ($moneynewid) {
                            $xid = M('member_money') -> where("uid={$datamoney['uid']}") -> save($mmoney);
                        }
                    }
				$moneynewid_x_temp = $moneynewid_x_temp && $moneynewid_x;
			    $bxid_temp = $bxid_temp && $bxid;
				$investor_temp = $investor_temp && $investor;
				$summary_temp = $summary_temp && $summary;
				$detail_temp = $detail_temp && $detail;
				$moneynewid_temp = $moneynewid_temp && $moneynewid;
				$xid_temp = $xid_temp && $xid;
				/////
				fwrite($of, "\nborrow_id=".$v['borrow_id']);
				fwrite($of, "\ndetail_id=".$v['id']);
				fwrite($of, "\nborrow_uid=".$v['borrow_uid']);
				fwrite($of, "\ninvestor_uid=".$v['investor_uid']);
				fwrite($of, "\ndatamoney_x=\n");
				fwrite($of, var_export($datamoney_x, true));
				fwrite($of, "\nmmoney_x=\n");
				fwrite($of, var_export($mmoney_x, true));
				fwrite($of, "\nupdate_investor=\n");
				fwrite($of, var_export($update_investor, true));
				fwrite($of, "\nupdate_borrow=\n");
				fwrite($of, var_export($update_borrow, true));
				fwrite($of, "\nupdetail=\n");
				fwrite($of, var_export($updetail, true));
				fwrite($of, "\nupdate_borrow=\n");
				fwrite($of, var_export($update_borrow, true));
				fwrite($of, "\ndatamoney=\n");
				fwrite($of, var_export($datamoney, true));
				fwrite($of, "\nmmoney=\n");
				fwrite($of, var_export($mmoney, true));
				fwrite($of, "\nmoneynewid_x=".$moneynewid_x);
				fwrite($of, "\nbxid=".$bxid);
				fwrite($of, "\ninvestor=".$investor);
				fwrite($of, "\nsummary=".$summary);
				fwrite($of, "\ndetail=".$detail);
				fwrite($of, "\nmoneynewid=".$moneynewid);
				fwrite($of, "\nxid=".$xid);
				fwrite($of, "\n\n");
				if ($moneynewid_x && $bxid && $investor && $summary && $detail && $moneynewid && $xid) {
					$Updateb -> commit();
					$strOut .= "成功还款第{$v['borrow_id']}号企业直投<br/>";
				} else {
					$strOut .= "第{$v['borrow_id']}号企业直投还款失败<br/>";
					$Updateb -> rollback();
				} 
				// //////////////////////////////////////////////////对投资帐户进行增加 结束//////////////////////////////////////////////////
			}
			fwrite($of, "\nmoneynewid_x_temp=".$moneynewid_x_temp);
			fwrite($of, "\nbxid_temp=".$bxid_temp);
			fwrite($of, "\ninvestor_temp=".$investor_temp);
			fwrite($of, "\nsummary_temp=".$summary_temp);
			fwrite($of, "\ndetail_temp=".$detail_temp);
			fwrite($of, "\nmoneynewid_temp=".$moneynewid_temp);
			fwrite($of, "\nxid_temp=".$xid_temp);
			
			fclose($of); 
/*			if ($moneynewid_x_temp && $bxid_temp && $investor_temp && $summary_temp && $detail_temp && $moneynewid_temp && $xid_temp) {
				$Updateb -> commit();
				$strOut .= "成功还款第{$v['borrow_id']}号企业直投<br/>";
			} else {
				$strOut .= "第{$v['borrow_id']}号企业直投还款失败<br/>";
				$Updateb -> rollback();
			} */
		} 
		$data = $strOut . "\r\n" . date("Y-m-d H:i:s", time()); //服务器时间
		echo $data;
	} 
} 
