<?php
// 全局设置
class CapitalaccountAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
        if($_REQUEST['flag']%2==1) {
            $sc = " DESC";
        }else{
            $sc = " ASC";
        }
        if($_REQUEST['str']!=""){
            $order = "{$_REQUEST['str']}".$sc;
        }else{
            $order = "m.id DESC";
        }
		$map=array();
		if($_REQUEST['uname']){
			$map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		if($_REQUEST['realname']){
			$map['mi.real_name'] = urldecode($_REQUEST['realname']);
			$search['realname'] = $map['mi.real_name'];	
		}
		if(!empty($_REQUEST['bj']) && !empty($_REQUEST['lx']) && !empty($_REQUEST['money'])){
			if($_REQUEST['lx']=='allmoney'){
				if($_REQUEST['bj']=='gt'){
					$bj = '>';
				}else if($_REQUEST['bj']=='lt'){
					$bj = '<';
				}else if($_REQUEST['bj']=='eq'){
					$bj = '=';
				}
				$map['_string'] = "(mm.account_money+mm.back_money) ".$bj.$_REQUEST['money'];
			}else{
				$map[$_REQUEST['lx']] = array($_REQUEST['bj'],$_REQUEST['money']);
			}
			$search['bj'] = $_REQUEST['bj'];	
			$search['lx'] = $_REQUEST['lx'];	
			$search['money'] = $_REQUEST['money'];	
		}
		
		//分页处理
		import("ORG.Util.Page");
		$count = M('members m')->join("{$this->pre}member_money mm ON mm.uid=m.id")->join("{$this->pre}member_info mi ON mi.uid=m.id")->where($map)->count('m.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'm.id,m.reg_time,m.user_name,mi.real_name,mm.money_freeze,mm.money_collect,(mm.account_money+mm.back_money) total_money,mm.account_money,mm.back_money,(mm.account_money+mm.back_money+mm.money_freeze+mm.money_collect) total';
		$list = M('members m')->field($field)->join("{$this->pre}member_money mm ON mm.uid=m.id")->join("{$this->pre}member_info mi ON mi.uid=m.id")->where($map)->limit($Lsql)->order($order)->select();
		foreach($list as $key=>$v){
			$uid = $v['id'];
			$list[$key]['benefit'] = get_personal_benefit($uid);

			$list[$key]['out'] = get_personal_out($uid);
			$list[$key]['count'] = get_personal_count($uid);
			$money_log = get_money_log($uid);
			$list[$key]['glycz']=$money_log['7']['money'];

			$withdraw0 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=0")->sum('withdraw_money');//待提现
			$withdraw1 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=1")->sum('withdraw_money');//提现处理中
			$withdraw3 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=0")->sum('second_fee');//待提现手续费
			$withdraw4 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=1")->sum('second_fee');//处理中提现手续费
			$list[$key]['dshtx'] = $withdraw0 + $withdraw3;
			$list[$key]['chulizhong'] = $withdraw1+$withdraw4;
			
		}
        $this->assign("bj", array("gt"=>'大于',"eq"=>'等于',"lt"=>'小于'));
        $this->assign("lx", array("allmoney"=>'可用余额',"mm.money_freeze"=>'冻结金额',"mm.money_collect"=>'待收金额'));
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->assign("query", http_build_query($search));
        $this->assign("flag", $_REQUEST["flag"]);
        $this->display();
    }
	
	public function export(){
		import("ORG.Io.Excel");
		alogs("CapitalAccount",0,1,'执行了所有会员资金列表导出操作！');//管理员操作日志
		$map=array();
		if($_REQUEST['uname']){
			$map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		if($_REQUEST['realname']){
			$map['mi.real_name'] = urldecode($_REQUEST['realname']);
			$search['realname'] = $map['mi.real_name'];	
		}
		if(!empty($_REQUEST['bj']) && !empty($_REQUEST['lx']) && !empty($_REQUEST['money'])){
			if($_REQUEST['lx']=='allmoney'){
				if($_REQUEST['bj']=='gt'){
					$bj = '>';
				}else if($_REQUEST['bj']=='lt'){
					$bj = '<';
				}else if($_REQUEST['bj']=='eq'){
					$bj = '=';
				}
				$map['_string'] = "(mm.account_money+mm.back_money) ".$bj.$_REQUEST['money'];
			}else{
				$map[$_REQUEST['lx']] = array($_REQUEST['bj'],$_REQUEST['money']);
			}
			$search['bj'] = $_REQUEST['bj'];	
			$search['lx'] = $_REQUEST['lx'];	
			$search['money'] = $_REQUEST['money'];	
		}
		
		//分页处理
		import("ORG.Util.Page");
		$count = M('members m')->join("{$this->pre}member_money mm ON mm.uid=m.id")->join("{$this->pre}member_info mi ON mi.uid=m.id")->where($map)->count('m.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$pre = $this->pre;
		$field= 'm.id,m.reg_time,m.user_name,mi.real_name,mm.money_freeze,mm.money_collect,(mm.account_money+mm.back_money) total_money,mm.account_money,mm.back_money';
		$list = M('members m')->field($field)->join("{$this->pre}member_money mm ON mm.uid=m.id")->join("{$this->pre}member_info mi ON mi.uid=m.id")->where($map)->order("m.id DESC")->select();
		
		foreach($list as $key=>$v){
			$uid = $v['id'];
			//$umoney = M('members')->field('account_money,reward_money')->find($uid);
			
			//待确认投标
			$investing = M()->query("select sum(investor_capital) as capital from {$pre}borrow_investor where investor_uid={$uid} AND status=1");
			
			//待收金额
			$invest = M()->query("select sum(investor_capital-receive_capital) as capital,sum(reward_money) as jiangli,sum(investor_interest-receive_interest) as interest from {$pre}borrow_investor where investor_uid={$uid} AND status =4");
			//$invest = M()->query("SELECT sum(capital) as capital,sum(interest) as interest FROM {$pre}investor_detail WHERE investor_uid={$uid} AND `status` =7");
			//待付金额
			$borrow = M()->query("select sum(borrow_money-repayment_money) as repayment_money,sum(borrow_interest-repayment_interest) as repayment_interest from {$pre}borrow_info where borrow_uid={$uid} AND borrow_status=6");
			
			
			$withdraw0 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=0")->sum('withdraw_money');//待提现
			$withdraw1 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=1")->sum('withdraw_money');//提现处理中
			$withdraw2 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=2")->sum('withdraw_money');//已提现
			
			$withdraw3 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=0")->sum('second_fee');//待提现手续费
			$withdraw4 = M('member_withdraw')->where("uid={$uid} AND withdraw_status=1")->sum('second_fee');//处理中提现手续费
		
		
			$borrowANDpaid = M()->query("select status,sort_order,borrow_id,sum(capital) as capital,sum(interest) as interest from {$pre}investor_detail where borrow_uid={$uid} AND status in(1,2,3)");
			$investEarn = M('borrow_investor')->where("investor_uid={$uid} and status in(4,5,6)")->sum('receive_interest');
			$investPay = M('borrow_investor')->where("investor_uid={$uid} status<>2")->sum('investor_capital');
			$investEarn1 = M('borrow_investor')->where("investor_uid={$uid} and status in(4,5,6)")->sum('invest_fee');//投资者管理费
			
			$payonline = M('member_payonline')->where("uid={$uid} AND status=1")->sum('money');
			
			//累计支付佣金
			$commission1 = M('borrow_investor')->where("investor_uid={$uid}")->sum('paid_fee');
			$commission2 = M('borrow_info')->where("borrow_uid={$uid} AND borrow_status in(2,4)")->sum('borrow_fee');
			
			$uplevefee = M('member_moneylog')->where("uid={$uid} AND type=2")->sum('affect_money');
			$adminop = M('member_moneylog')->where("uid={$uid} AND type=7")->sum('affect_money');
			
			$txfee = M('member_withdraw')->where("uid={$uid} AND withdraw_status=2")->sum('second_fee');
			$czfee = M('member_payonline')->where("uid={$uid} AND status=1")->sum('fee');
		
			$interest_needpay = M()->query("select sum(borrow_interest-repayment_interest) as need_interest from {$pre}borrow_info where borrow_uid={$uid} AND borrow_status=6");
			$interest_willget = M()->query("select sum(investor_interest-receive_interest) as willget_interest from {$pre}borrow_investor where investor_uid={$uid} AND status=4");
			
			$interest_jiliang =M('borrow_investor')->where("borrow_uid={$uid}")->sum('reward_money');//累计支付投标奖励
			
			$moneylog = M("member_moneylog")->field("type,sum(affect_money) as money")->where("uid={$uid}")->group("type")->select();
			$listarray=array();
			foreach($moneylog as $vs){
				$listarray[$vs['type']]['money']= ($vs['money']>0)?$vs['money']:$vs['money']*(-1);
			}
	
			
			//$money['kyxjje'] = $umoney['account_money'];//可用现金金额
			$money['kyxjje'] = $v['account_money'];//可用现金金额
			$money['dsbx'] = floatval($invest[0]['capital']+$invest[0]['interest']);//待收本息
			$money['dsbj'] = $invest[0]['capital'];//待收本金
			$money['dslx'] = $invest[0]['interest'];//待收利息
			$money['dfbx'] = floatval($borrow[0]['repayment_money']+$borrow[0]['repayment_interest']);//待付本息
			$money['dfbj'] = $borrow[0]['repayment_money'];//待付本金
			$money['dflx'] = $borrow[0]['repayment_interest'];//待付利息
			$money['dxrtb'] = $investing[0]['capital'];//待确认投标
			
			$money['dshtx'] = $withdraw0+$withdraw3;//待审核提现
			$money['clztx'] = $withdraw1+$withdraw4;//处理中提现
			
			//$money['jzlx'] = $investEarn;//净赚利息
			$money['jzlx'] = $investEarn-$investEarn1;//净赚利息
			$money['jflx'] = $borrowANDpaid[0]['interest'];//净付利息
			$money['ljjj'] = $umoney['reward_money'];//累计收到奖金
			$money['ljhyf'] = $uplevefee;//累计支付会员费
			$money['ljtxsxf'] = $txfee;//累计提现手续费
			$money['ljczsxf'] = $czfee;//累计充值手续费
			$money['total_2'] = $money['jzlx']-$money['jflx']-$money['ljhyf']-$money['ljtxsxf']-$money['ljczsxf'];
			
			$money['ljtzje'] = $investPay;//累计投资金额
			$money['ljjrje'] = $borrowANDpaid[0]['borrow_money'];//累计借入金额
			$money['ljczje'] = $payonline;//累计充值金额
			$money['ljtxje'] = $withdraw2;//累计提现金额
			$money['ljzfyj'] = $commission1 + $commission2;//累计支付佣金
			$money['glycz'] = $listarray['7']['money'];//管理员操作资金
		//
			$money['dslxze'] = $interest_willget[0]['willget_interest'];//待收利息总额
			$money['dflxze'] = $interest_needpay[0]['need_interest'];//待付利息总额
			$money['ljtbjl'] = $listarray['20']['money'];//累计投标奖励
			
			$list[$key]['xmoney'] = $money;
			
			
		}

		$row=array();
		$row[0]=array('ID','用户名','真实姓名','总余额','可用余额','冻结金额','待收本息金额','待收本金金额','待收利息金额','待付本息金额','待付本金金额','待付利息金额','待确认投标','待审核提现+手续费','处理中提现+手续费','累计提现手续费','累计充值手续费','累计提现金额','累计充值金额','累计支付佣金','累计投标奖励','净赚利息','净付利息','管理员操作资金');
		$i=1;
		foreach($list as $v){
				$row[$i]['uid'] = $v['id'];
				$row[$i]['card_num'] = $v['user_name'];
				$row[$i]['card_pass'] = $v['real_name'];
				$row[$i]['card_mianfei'] = $v['money_freeze'] + $v['total_money'] + $v['money_collect'];
				$row[$i]['card_mianfei1'] = $v['total_money'];
				$row[$i]['card_mianfei2'] = $v['money_freeze'];
				$row[$i]['dsbx'] = $v['xmoney']['dsbx'];
				$row[$i]['dsbj'] = $v['xmoney']['dsbj'];
				$row[$i]['dslx'] = $v['xmoney']['dslx'];
				
				$row[$i]['dfbx'] = $v['xmoney']['dfbx'];
				$row[$i]['dfbj'] = $v['xmoney']['dfbj'];
				$row[$i]['dflx'] = $v['xmoney']['dflx'];
				$row[$i]['dxrtb'] = $v['xmoney']['dxrtb'];
				$row[$i]['dshtx'] = $v['xmoney']['dshtx'];
				$row[$i]['clztx'] = $v['xmoney']['clztx'];
				
				$row[$i]['ljtxsxf'] = $v['xmoney']['ljtxsxf'];
				$row[$i]['ljczsxf'] = $v['xmoney']['ljczsxf'];
				$row[$i]['ljtxje'] = $v['xmoney']['ljtxje'];
				$row[$i]['ljczje'] = $v['xmoney']['ljczje'];
				$row[$i]['ljzfyj'] = $v['xmoney']['ljzfyj'];
				$row[$i]['ljtbjl'] = $v['xmoney']['ljtbjl'];
				$row[$i]['jzlx'] = $v['xmoney']['jzlx'];
				$row[$i]['jflx'] = $v['xmoney']['jflx'];
				$row[$i]['glycz'] = $v['xmoney']['glycz'];
				$i++;
			}
		$xls = new Excel_XML('UTF-8', false, 'datalist');
		$xls->addArray($row);
		$xls->generateXML("datalistcard");
	}


	
}
?>