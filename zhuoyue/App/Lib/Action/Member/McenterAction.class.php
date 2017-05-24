<?php
class McenterAction extends MMCommonAction {
    
    public function index(){
        $minfo =getMinfo($this->uid,true);
		$this->assign("minfo",$minfo);
		
		$uid=session("u_id");
		$vo=M('member_info m')->field("m.real_name,m.cell_phone")->where("m.uid={$uid}")->find();
	    $this->assign("vo",$vo);
		$this->display();
    }
	public function userinfo() {
	    $mess = array();
		$mess['uid'] = intval(session("u_id"));
		$vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where("id={$mess['uid']}")->find();
		$mess['username'] = $vo['user_name'];
		$mess['phone'] = intval(session("u_user_phone"));
		$mess['head'] = get_avatar($mess['uid']);//头像
		$minfo = getMinfo($mess['uid'],true);
		$mess['credits'] = getLeveIco($minfo['credits'],3);//会员等级
		$membermoney = M("member_money")->field(true)->where("uid={$mess['uid']}")->find();
		if(is_array($membermoney)){
			$mess['mayuse'] = $membermoney['account_money']+$membermoney['back_money'];//可用	
		    $mess['freeze'] = $membermoney['money_freeze'];//冻结
		    $mess['collect'] = $membermoney['money_collect'];//代收
			$mess['total'] = $mess['mayuse']+$mess['freeze']+$mess['collect'];//总额
		}else{
		    $mess['total'] = 0;
		    $mess['mayuse'] = 0;
			$mess['freeze'] = 0;
		    $mess['collect'] = 0;
		}
			    
		ajaxmsg($mess);
	}
	//个人资料
    public function minfo() {
		$jsoncode = file_get_contents("php://input");
		//alogsm("minfo",0,1,session("u_id").$jsoncode);
		$arr = array();
		$arr = json_decode($jsoncode,true);
//		if (!is_array($arr)||empty($arr)) {
//		   ajaxmsg("密码1！",0);
//		}
//		if (intval($arr['uid'])!=$this->uid){
//			ajaxmsg($arr['uid'],0);
//		}
		$minfo =getMinfo($this->uid,true);
		$user_name = session('u_user_name');
		//$this->assign("minfo",$minfo);
		$_minfo['credits'] = getLeveIco($minfo['credits'],3);
		$_minfo['credit_cuse'] = $minfo['credit_cuse'];
		$_minfo['borrow_vouch_cuse'] = $minfo['borrow_vouch_cuse'];
		if ($minfo['time_limit']>0){
		    $_minfo['time_limit'] = date('Y-m-d',$minfo['time_limit']);
		}else{
		    $_minfo['time_limit'] = "您还未申请VIP";
		}
		if ($_minfo['credit_cuse'] == null){
		    $_minfo['credit_cuse'] = 0;
		}
		if ($_minfo['borrow_vouch_cuse'] == null){
		    $_minfo['borrow_vouch_cuse'] = 0;
		}
		$_minfo['jingzichan'] = $minfo['account_money']+$minfo['back_money'];//净资产
		$_minfo['mayuse'] = $minfo['account_money']+$minfo['back_money'];//可用余额
		$_minfo['total'] = $minfo['account_money']+$minfo['back_money']+$minfo['money_collect']+$minfo['money_freeze'];//资产总额
		$_minfo['money_freeze'] = ($minfo['money_freeze']==null)?0:$minfo['money_freeze'];//冻结金额
		$_minfo['money_collect'] = ($minfo['money_collect']==null)?0:$minfo['money_collect'];//待收总额
		$benefit = get_personal_benefit($this->uid);//收入
		$out = get_personal_out($this->uid);//支出
		$_minfo['benefitinterest'] = $benefit['interest'];//净赚利息
		$_minfo['outinterest'] = ($out['interest']==null)?0:$out['interest'];//净付利息
		$_minfo['reward'] = $benefit['ireward'] + $benefit['spread_reward'] + $benefit['re_reward'] + $benefit['con_reward'];//奖励总额
		$_minfo['interest_collection'] = $benefit['interest_collection'];//待收利息
		$SX = M('investor_detail')->field('deadline,interest,capital')->where("investor_uid = {$this->uid} AND status=7")->order("deadline ASC")->find();
		if ($SX['deadline'] > 0){
			$_minfo['lastInvestdaishou'] = $SX['interest']+$SX['capital'];//最近待收金额
		    $_minfo['lastInvesttime'] = date('Y-m-d',$SX['deadline']);//最近待收时间
		}else {
		    $_minfo['lastInvestdaishou'] = 0;
			$_minfo['lastInvesttime'] = "无待收";
		}
		$_SX = M('investor_detail')->field('deadline,sum(interest) as interest,sum(capital) as capital')->where("borrow_uid = {$this->uid} AND status=7")->group("borrow_id,sort_order")->order("deadline ASC")->find();
		if ($_SX['deadline'] > 0){
		    $_minfo['lastBorrowdaihuan'] = $_SX['interest']+$_SX['capital'];//最近待还金额
		    $_minfo['lastBorrowtime'] = date('Y-m-d',$_SX['deadline']);//最近待还时间
			$_minfo['daihuanzonge'] = $_minfo['lastBorrowdaihuan'];//待还总额
		}else {
		    $_minfo['lastBorrowdaihuan'] = 0;
			$_minfo['lastBorrowtime'] = "无待收";
			$_minfo['daihuanzonge'] = 0;
		}
		$pcount = get_personal_count($this->uid);
		$_minfo['jrje'] = ($pcount['jrje']==null)?0:$pcount['jrje'];//累计借入金额
		
		
		
		
		
		
		//$this->assign("kflist",get_admin_name());
		$kflist = get_admin_name();
		
		$_kflist = $kflist[$minfo['customer_id']];
		if ($_kflist == null){
		    $_kflist = "暂未选择客服";
		}
		$list=array();
		$pre = C('DB_PREFIX');
		$rule = M('ausers u')->field('u.id,u.qq,u.phone')->join("{$pre}members m ON m.customer_id=u.id")->where("u.is_kf =1 and m.customer_id={$minfo['customer_id']}")->select();
		foreach($rule as $key=>$v){
			$list[$key]['qq']=$v['qq'];
			$list[$key]['phone']=$v['phone'];
		}
		if ($rule==0){
		    $list[0]['qq']='暂无QQ';
		    $list[0]['phone']='暂无客服电话';
		}
		//dump($list);
		$arr= array();
		$arr['user_name'] = $user_name;
		$arr['minfo'] = $_minfo;
		$arr['kflist'] = $_kflist;
		$arr['list'] = $list['0'];
		//echo addslashes(json_encode($arr));
		echo ajaxmsg($arr);
		//$this->assign("kfs",$list);
		
	    //$this->display();
	}
	//资金信息
	public function zjxx() {
		$jsoncode = file_get_contents("php://input");
		//alogsm("zjxx",0,1,session("u_id").$jsoncode);
		
	    $minfo =getMinfo($this->uid,true);
		//$this->assign("memberinfo", M('members')->find($this->uid));
		//$this->assign("minfo",$minfo);
		//$this->assign('benefit', get_personal_benefit($this->uid));
        //$this->assign('out', get_personal_out($this->uid));
        $benefit = get_personal_benefit($this->uid);
		$this->assign("bank",M('member_banks')->field('bank_num')->find($this->uid));
		$info = getMemberDetail($this->uid);
		$this->assign("info",$info);
		
		$this->assign("kflist",get_admin_name());
		$list=array();
		$pre = C('DB_PREFIX');
		$rule = M('ausers u')->field('u.id,u.qq,u.phone')->join("{$pre}members m ON m.customer_id=u.id")->where("u.is_kf =1 and m.customer_id={$minfo['customer_id']}")->select();
		foreach($rule as $key=>$v){
			$list[$key]['qq']=$v['qq'];
			$list[$key]['phone']=$v['phone'];
		}
		$this->assign("kfs",$list);
		
		$_SX = M('investor_detail')->field('deadline,interest,capital')->where("investor_uid = {$this->uid} AND status=7")->order("deadline ASC")->find();
		$lastInvest['gettime'] = $_SX['deadline'];
		$lastInvest['interest'] = $_SX['interest'];
		$lastInvest['capital'] = $_SX['capital'];
		$this->assign("lastInvest",$lastInvest);
		
		$_SX="";
		$_SX = M('investor_detail')->field('deadline,sum(interest) as interest,sum(capital) as capital')->where("borrow_uid = {$this->uid} AND status=7")->group("borrow_id,sort_order")->order("deadline ASC")->find();
		$lastBorrow['gettime'] = $_SX['deadline'];
		$lastBorrow['interest'] = $_SX['interest'];
		$lastBorrow['capital'] = $_SX['capital'];
		$this->assign("lastBorrow",$lastBorrow);
		$this->assign("memberdetail", M('member_info')->find($this->uid));
		//$this->assign("list",get_personal_count($this->uid));
		
		$list = get_personal_count($this->uid);
		//新加开始
		$_list['zichanzonge'] = $minfo['account_money']+$minfo['back_money']+$minfo['money_collect']+$minfo['money_freeze'];
		$_list['keyongyue'] = $minfo['account_money']+$minfo['back_money'];
		$_list['money_freeze'] = $minfo['money_freeze']!=null?$minfo['money_freeze']:"0.00";
		$_list['dsbx'] = $minfo['money_collect'];
		$_list['willgetInterest'] = $benefit['interest_collection'];
		$_list['withdraw_money'] = $list['withdraw']!=null?$list['withdraw']:"0.00";
		$_list['chongzhizonge'] = $list['payonline']!=null?$list['payonline']:"0.00";
		$_list['zuijindaihuanjine'] = getFloatvalue($lastBorrow['interest']+$lastBorrow['capital'],2);
		if ($lastBorrow['gettime'] > 0) {
		    $_list['zuijindaihuantime'] = date("Y-m-d",$lastBorrow['gettime']);
		}else{
		    $_list['zuijindaihuantime'] = "无待还";
		}
		$_list['zuijindaishoujine'] = getFloatvalue($lastInvest['capital']+$lastInvest['interest'],2);
		if ($lastInvest['gettime'] > 0) {
		    $_list['zuijindaishoutime'] = date("Y-m-d",$lastInvest['gettime']);
		}else{
		    $_list['zuijindaishoutime'] = "无待还";
		}
		
		echo ajaxmsg($_list);
		//$this->display();
	}
	public function zjxx2() {
		$jsoncode = file_get_contents("php://input");
		//alogsm("zjxx",0,1,session("u_id").$jsoncode);
		
	    $minfo =getMinfo($this->uid,true);
		$this->assign("minfo",$minfo);
		
		$this->assign("unread",$read=M("inner_msg")->where("uid={$this->uid} AND status=0")->count('id'));
		$minfo =getMinfo($this->uid,true);
		$this->assign("minfo",$minfo);
		$this->assign("MinfoDone",getMemberInfoDone($this->uid));
		$this->assign("mstatus", M('members_status')->field(true)->find($this->uid));
		$this->assign("capitalinfo", getMemberBorrowScan($this->uid));
		$this->assign("memberinfo", M('members')->find($this->uid));
		$this->assign("memberdetail", M('member_info')->find($this->uid));
		$_SX = M('investor_detail')->field('deadline,interest,capital')->where("investor_uid = {$this->uid} AND status=7")->order("deadline ASC")->find();
		$toubiaojl =M('borrow_investor')->where("borrow_uid={$this->uid}")->sum('reward_money');//支付投标奖励
		$this->assign("toubiaojl", $toubiaojl);//支付投标奖励
		
		//////////////////////////////////
		$moneylog = M("member_moneylog")->field("type,sum(affect_money) as money")->where("uid={$this->uid}")->group("type")->select();
		$row1=array();
		foreach($moneylog as $vs){
			$row1[$vs['type']]['money']= ($vs['money']>0)?$vs['money']:$vs['money']*(-1);
		}
		
		$map=array();
		$map['withdraw_status'] =2;
		$tx = M('member_withdraw')->field("uid,sum(withdraw_money) as withdraw_money,sum(withdraw_fee) as withdraw_fee")->where("uid={$this->uid} and withdraw_status=2")->group("uid")->select();
		foreach($tx as $vt){
			$row1['tx']['withdraw_money']= $vt['withdraw_money'];	//成功提现金额	
			$row1['tx']['withdraw_fee']= $vt['withdraw_fee'];	//提现手续费
		}
		
		$this->assign("list",$row1);
		$this->assign("bank",M('member_banks')->field('bank_num')->find($this->uid));
		$czfee = M('member_payonline')->where("uid={$uid} AND status=1")->sum('fee');//在线充值手续费总金额
		
		$capitalinfo = getMemberBorrowScan($this->uid);
		$intotal = $capitalinfo['tj']['earnInterest']+$row1['20']['money']+$row1['34']['money']+$row1['13']['money']+$row1['32']['money'];//收入总和
		//$outtotal = $capitalinfo['tj']['payInterest']+$toubiaojl+$row1['tx']['withdraw_money']+$row1['14']['money']+$row1['22']['money']+$row1['25']['money']+$row1['26']['money']+$row1['18']['money']+$row1['30']['money']+$row1['31']['money']-$czfee;//支出总和
		$outtotal = $capitalinfo['tj']['payInterest']+$toubiaojl+$row1['tx']['withdraw_fee']+$row1['14']['money']+$row1['22']['money']+$row1['25']['money']+$row1['26']['money']+$row1['18']['money']+$row1['30']['money']+$row1['31']['money']+$czfee;//支出总和
		$dsbx = $capitalinfo['tj']['dsze']+$capitalinfo['tj']['willgetInterest'];//待收本息
		
		$this->assign("dsbx",$dsbx);
		$this->assign("intotal",$intotal);
		$this->assign("outtotal",$outtotal);
		/////////////////////////////////
		$lastInvest['gettime'] = $_SX['deadline'];
		$lastInvest['interest'] = $_SX['interest'];
		$lastInvest['capital'] = $_SX['capital'];
		$this->assign("lastInvest",$lastInvest);
		
		$_SX="";
		$_SX = M('investor_detail')->field('deadline,sum(interest) as interest,sum(capital) as capital')->where("borrow_uid = {$this->uid} AND status=7")->group("borrow_id,sort_order")->order("deadline ASC")->find();
		$lastBorrow['gettime'] = $_SX['deadline'];
		$lastBorrow['interest'] = $_SX['interest'];
		$lastBorrow['capital'] = $_SX['capital'];
		$this->assign("lastBorrow",$lastBorrow);
		//新加开始
		$_list['zichanzonge'] = $minfo['account_money']+$minfo['back_money']+$minfo['money_collect']+$minfo['money_freeze'];
		$_list['keyongyue'] = $minfo['account_money']+$minfo['back_money'];
		$_list['money_freeze'] = $minfo['money_freeze']!=null?$minfo['money_freeze']:"0.00";
		$_list['dsbx'] = $dsbx;
		$_list['willgetInterest'] = $capitalinfo['tj']['willgetInterest'];
		$_list['withdraw_money'] = $list['tx']['withdraw_money']!=null?$list['tx']['withdraw_money']:"0.00";
		$_list['chongzhizonge'] = $list['27']['money']+$list['3']['money'];
		$_list['zuijindaihuanjine'] = getFloatvalue($lastBorrow['interest']+$lastBorrow['capital'],2);
		if ($lastBorrow['gettime'] > 0) {
		    $_list['zuijindaihuantime'] = date("Y-m-d",$lastBorrow['gettime']);
		}else{
		    $_list['zuijindaihuantime'] = "无待还";
		}
		$_list['zuijindaishoujine'] = getFloatvalue($lastInvest['capital']+$lastInvest['interest'],2);
		if ($lastInvest['gettime'] > 0) {
		    $_list['zuijindaishoutime'] = date("Y-m-d",$lastInvest['gettime']);
		}else{
		    $_list['zuijindaishoutime'] = "无待还";
		}
		
		echo ajaxmsg($_list);
		//$this->display();
	}
	
	public function test(){
	  $temp = '{"user_name":"tsqy","minfo":{"credits":"1\u7ea7","credit_cuse":0,"borrow_vouch_cuse":0,"time_limit":"2014-12-12"},"kflist":"\u5ba2\u670d\u840c\u840c","list":{"qq":"2036383878","phone":"0753-2188608"}}';
	  $out = json_decode($temp,ture);
	  echo $temp;
	  dump($out);
	}
	//安全中心
	public function anquan() {
		$jsoncode = file_get_contents("php://input");
//		alogsm("anquan",0,1,session("u_id").$jsoncode);
	    //$minfo =getMinfo($this->uid,true);
		//$this->assign("minfo",$minfo);
		//$this->assign("MinfoDone",getMemberInfoDone($this->uid));
		//$this->assign("mstatus", M('members_status')->field(true)->find($this->uid));
		//$this->assign("capitalinfo", getMemberBorrowScan($this->uid));
		//$this->assign("memberinfo", M('members')->find($this->uid));
		//$this->assign("memberdetail", M('member_info')->find($this->uid));
		$mstatus=M('members_status')->field('safequestion_status,email_status')->find($this->uid);
		$memberinfo=M('members')->field('pin_pass,user_phone,user_email')->find($this->uid);
		$memberdetail=M('member_info')->field('real_name')->find($this->uid);
		if ($memberdetail['real_name']!=""){
			$arr['real_name'] = $memberdetail['real_name'];		
		}else{
		    $arr['real_name'] = '还未验证';
		}
		
		if ($mstatus['safequestion_status']!=0){
			$arr['safequestion_status'] = '已设置';		
		}else{
		    $arr['safequestion_status'] = '还未验证';
		}
		if ($memberinfo['pin_pass']!=""){
			$arr['pin_pass'] = "已设置";		
		}else{
		    $arr['pin_pass'] = '尚未设置';
		}
		if ($memberinfo['user_phone']!=""){
			$arr['user_phone'] = hidecard($memberinfo['user_phone'],2);		
		}else{
		    $arr['user_phone'] = '还未验证';
		}
		
		if ($mstatus['email_status']==1){
			$arr['user_email'] = "已验证";		
		}else{
		    $arr['user_email'] = '还未验证';
		}
		 $arr['denglu_pass'] = '已设置';
		echo ajaxmsg($arr);
		//$this->display();
	}
	//投资总表
	public function touzi() {
		$jsoncode = file_get_contents("php://input");
//		alogsm("touzi",0,1,session("u_id").$jsoncode);
		
	    $uid = $this->uid;
		$pre = C('DB_PREFIX');
		$dc = M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money');
		$mx = getMemberBorrowScan($this->uid);
		$list['web_name'] = $this->glo['web_name'];
		$list['dc'] = $dc!=null?$dc:"0.00";
		$list['jbztz'] = $mx['invest']['1']['investor_capital']!=null?$mx['invest']['1']['investor_capital']:"0.00";
		$list['hsztz'] = $mx['invest']['4']['investor_capital']!=null?$mx['invest']['4']['investor_capital']:"0.00";
		$list['swdtz'] = $mx['invest']['5']['investor_capital']!=null?$mx['invest']['5']['investor_capital']:"0.00";
		$list['expiredInvestMoney'] = $mx['tj']['expiredInvestMoney'];
		$list['borrowOut'] = $mx['tj']['borrowOut'];
		echo ajaxmsg($list);
		//$this->assign("dc",M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money'));
//		$this->assign("mx",getMemberBorrowScan($this->uid));
//		$data['html'] = $this->display();
	}
	//借款总表
	public function jiekuan() {
	    $pre = C('DB_PREFIX');
		
		$jsoncode = file_get_contents("php://input");
//		alogsm("jiekuan",0,1,session("u_id").$jsoncode);
		$arr = array();
		$arr = json_decode($jsoncode,true);
//		if (!is_array($arr)||empty($arr)) {
//		   ajaxmsg("密码1！",0);
//		}
//		if (intval($arr['uid'])!=$this->uid){
//			ajaxmsg($arr['uid'],0);
//		}
		
		$mx = getMemberBorrowScan($this->uid);
		$list['fbjr'] = $mx['borrow']['2']['money']!=null?$mx['borrow']['2']['money']:"0.00";
		$list['chjr'] = $mx['borrow']['6']['money']!=null?$mx['borrow']['6']['money']:"0.00";
		$list['hqjr'] = $mx['borrow']['7']['money']!=null?$mx['borrow']['7']['money']:"0.00";
		$list['expiredMoney'] = $mx['tj']['expiredMoney'];
		$list['jkze'] =  $mx['tj']['jkze'];
		echo ajaxmsg($list);
		//$this->assign("mx",getMemberBorrowScan($this->uid));
		//$data['html'] = $this->display();
	}
	//奖金记录
	 public function jiangjin(){
		$jsoncode = file_get_contents("php://input");
//		alogsm("jiangjin",0,1,session("u_id").$jsoncode);
		 
		$map['uid'] = $this->uid;
		$map['type'] = array("in","1,13");
		$list = getMoneyLog($map,10);
		foreach($list['list'] as $key=>$v) {
			$_list[$key]['add_time'] = date("Y-m-d",$v['add_time']);
			$_list[$key]['affect_money'] = $v['affect_money'];
			$_list[$key]['info'] = $v['info'];
		}
		$m_list['list'] = $_list;
		if(is_array($_list)&&!empty($_list)){
		    echo ajaxmsg($m_list);
		 }else{
		    echo ajaxmsg("暂无奖金纪录",0);
		}
		
		//$this->assign("list",$list['list']);		
		//$this->assign("pagebar",$list['page']);		

		//$data['html'] = $this->display();
		
    }
	//我要提现
	 public function tixian(){
		$jsoncode = file_get_contents("php://input");
//		alogsm("tixian",0,1,session("u_id").$jsoncode);
		$pre = C('DB_PREFIX');
		$field = "m.user_name,m.user_phone,(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money,i.real_name,b.bank_num,b.bank_name,b.bank_address";
		$vo = M('members m')->field($field)->join("{$pre}member_info i on i.uid = m.id")->join("{$pre}member_money mm on mm.uid = m.id")->join("{$pre}member_banks b on b.uid = m.id")->where("m.id={$this->uid}")->find();
		
		if(empty($vo['bank_num'])) echo ajaxmsg("您还未绑定银行帐户，请先绑定",0);
		else{
			$list['bank_num'] = substr($vo['bank_num'],-4);
			$list['bank_name'] = $vo['bank_name'];
			//$list['bank_address'] = $vo['bank_address'];
			$list['real_name'] = $vo['real_name'];
			$list['user_phone'] = $vo['user_phone'];
			$list['all_money'] = $vo['all_money'];
			$list['qixian'] = "72小时/24小时（72小时内打款，到帐时间因各个银行不同） ";
			echo ajaxmsg($list);
			
			//$tqfee = explode( "|", $this->glo['fee_tqtx']);
//			$fee[0] = explode( "-", $tqfee[0]);
//			$fee[1] = explode( "-", $tqfee[1]);
//			$fee[2] = explode( "-", $tqfee[2]);
//			$this->assign( "fee",$fee);
			//$this->assign( "vo",$vo);
			//$this->assign("memberinfo", M('members')->find($this->uid));
			//$data['html'] = $this->fetch();
		}
		//exit(json_encode($data));
    }
	
	//提现前确认
	public function validate(){
		$jsoncode = file_get_contents("php://input");
//		alogsm("validate",0,1,session("u_id").$jsoncode);
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (!is_array($arr)||empty($arr)||empty($arr['amount'])||empty($arr['pwd'])) {
		   ajaxmsg("请求错误！",0);
		}
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("用户错误！",0);
		}
		$pre = C('DB_PREFIX');
		$withdraw_money = floatval($arr['amount']);
		$pwd = md5($arr['pwd']);
		//alogsm("validate",0,1,$arr['pwd']."-".$arr['amount']);
		$vo = M('members m')->field('mm.account_money,mm.back_money,m.user_leve,m.time_limit')->join("{$pre}member_money mm on mm.uid = m.id")->where("m.id={$this->uid} AND m.pin_pass='{$pwd}'")->find();
		//$this->display("Public:_footer");
		if(!is_array($vo)) ajaxmsg("密码错误kk！",0);
		//alogsm("validate_密码是否正确",0,1,is_array($vo));//
		if(($vo['account_money']+$vo['back_money'])<$withdraw_money) {
			//alogsm("validate",0,1,"提现额大于帐户余额");//
			ajaxmsg("提现额大于帐户余额",2);
		}
		$start = strtotime(date("Y-m-d",time())." 00:00:00");
		$end = strtotime(date("Y-m-d",time())." 23:59:59");
		$wmap['uid'] = $this->uid;
		$wmap['withdraw_status'] = array("neq",3);
		$wmap['add_time'] = array("between","{$start},{$end}");
		$today_money = M('member_withdraw')->where($wmap)->sum('withdraw_money');	
		$today_time = M('member_withdraw')->where($wmap)->count('id');	
		
		$tqfee = explode("|",$this->glo['fee_tqtx']);

		$fee[0] = explode("-",$tqfee[0]);
		$fee[1] = explode("-",$tqfee[1]);
		$fee[2] = explode("-",$tqfee[2]);

		$one_limit = $fee[2][0]*10000;
		if($withdraw_money<100 ||$withdraw_money>$one_limit) ajaxmsg("单笔提现金额限制为100-{$one_limit}元",2);
		$today_limit = $fee[2][1]/$fee[2][0];
		if($today_time>$today_limit){
					$message = "一天最多只能提现{$today_limit}次";
					//alogsm("validate",0,1,$message);//
					ajaxmsg($message,2);
		}
		
		if(1==1 || $vo['user_leve']>0 && $vo['time_limit']>time()){
		//////////////////////////////////////////
			$itime = strtotime(date("Y-m", time())."-01 00:00:00").",".strtotime( date( "Y-m-", time()).date("t", time())." 23:59:59");
			$wmapx['uid'] = $this->uid;
			$wmapx['withdraw_status'] = array("neq",3);
			$wmapx['add_time'] = array("between","{$itime}");
			$times_month = M("member_withdraw")->where($wmapx)->count("id");
			
		
			if(($withdraw_money-$vo['back_money'])>=0){
				$maxfee1 = ($withdraw_money-$vo['back_money'])*$fee[0][0]/1000;
				if($maxfee1>=$fee[0][1]){
					$maxfee1 = $fee[0][1];
				}
				
				$maxfee2 = $vo['back_money']*$fee[1][0]/1000;
				if($maxfee2>=$fee[1][1]){
					$maxfee2 = $fee[1][1];
				}
				
				$fee = $maxfee1+$maxfee2;
				$money = $withdraw_money-$vo['back_money'];
			}else{
				$fee = $vo['back_money']*$fee[1][0]/1000;
			}
			
			if($withdraw_money <= $vo['back_money'])
			{
				$message = "您好，您申请提现{$withdraw_money}元，小于目前的回款总额{$vo['back_money']}元，因此无需手续费，确认要提现吗？";
			}else{
				$message = "您好，您申请提现{$withdraw_money}元，其中有{$vo['back_money']}元在回款之内，无需提现手续费，另有{$money}元需收取提现手续费{$fee}元，确认要提现吗？";
			}
			//alogsm("validate",0,1,$message);//
			ajaxmsg( "{$message}", 1 );
			
			if(($today_money+$withdraw_money)>$fee[2][1]*10000){
					$message = "单日提现上限为{$fee[2][1]}万元。您今日已经申请提现金额：{$today_money}元,当前申请金额为:{$withdraw_money}元,已超出单日上限，请您修改申请金额或改日再申请提现";
					//alogsm("validate",0,1,$message);//
					ajaxmsg($message,2);
			}
			
		//////////////////////////////////////////////
				
		}else{//普通会员暂未使用
				if(($today_money+$withdraw_money)>300000){
					$message = "您是普通会员，单日提现上限为30万元。您今日已经申请提现金额：$today_money元,当前申请金额为:$withdraw_money元,已超出单日上限，请您修改申请金额或改日再申请提现";
					//alogsm("validate",0,1,$message);//
					ajaxmsg($message,2);
				}
				$tqfee = $this->glo['fee_pttx'];
				$fee = getFloatValue($tqfee*$withdraw_money/100,2);
				
				if( ($vo['account_money']-$withdraw_money - $fee)<0 ){
					$message = "您好，您申请提现{$withdraw_money}元，提现手续费{$fee}元将从您的提现金额中扣除，确认要提现吗？";
				}else{
					$message = "您好，您申请提现{$withdraw_money}元，提现手续费{$fee}元将从您的帐户余额中扣除，确认要提现吗？";
				}
				//alogsm("validate",0,1,$message);//
				ajaxmsg("{$message}",1);
		}
	}
	//最后提现
	public function actwithdraw(){
		$jsoncode = file_get_contents("php://input");
//		alogsm("actwithdraw",0,1,session("u_id").$jsoncode);
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (!is_array($arr)||empty($arr)||empty($arr['amount'])||empty($arr['pwd'])) {
		   //alogsm("actwithdraw_fail",0,1,"请求错误！");//
		   ajaxmsg("请求错误！",0);
		}
		if (intval($arr['uid'])!=$this->uid){
			//alogsm("actwithdraw_fail",0,1,"用户错误！");//
			ajaxmsg("用户错误！",0);
		}
		$pre = C('DB_PREFIX');
		$withdraw_money = floatval($arr['amount']);
		$pwd = md5($arr['pwd']);
		//alogsm("actwithdraw_pwd",0,1,$arr['pwd']."-".$arr['amount']);//
		$vo = M('members m')->field('mm.account_money,mm.back_money,(mm.account_money+mm.back_money) all_money,m.user_leve,m.time_limit')->join("{$pre}member_money mm on mm.uid = m.id")->where("m.id={$this->uid} AND m.pin_pass='{$pwd}'")->find();
		if(!is_array($vo)) ajaxmsg("",0);
		//alogsm("actwithdraw_密码是否错误",0,1,is_array($vo));//
		if($vo['all_money']<$withdraw_money) ajaxmsg("提现额大于帐户余额",2);
		$start = strtotime(date("Y-m-d",time())." 00:00:00");
		$end = strtotime(date("Y-m-d",time())." 23:59:59");
		$wmap['uid'] = $this->uid;
		$wmap['withdraw_status'] = array("neq",3);
		$wmap['add_time'] = array("between","{$start},{$end}");
		$today_money = M('member_withdraw')->where($wmap)->sum('withdraw_money');	
		$today_time = M('member_withdraw')->where($wmap)->count('id');	
		$tqfee = explode("|",$this->glo['fee_tqtx']);
		$fee[0] = explode("-",$tqfee[0]);
		$fee[1] = explode("-",$tqfee[1]);
		$fee[2] = explode("-",$tqfee[2]);
		$one_limit = $fee[2][0]*10000;
		if($withdraw_money<100 ||$withdraw_money>$one_limit) {
			//alogsm("actwithdraw_fail",0,1,"单笔提现金额限制为100-{$one_limit}元");//
			ajaxmsg("单笔提现金额限制为100-{$one_limit}元",2);
		}
		$today_limit = $fee[2][1]/$fee[2][0];
		if($today_time>=$today_limit){
					$message = "一天最多只能提现{$today_limit}次";
					//alogsm("actwithdraw_fail",0,1,$message);//
					ajaxmsg($message,2);
		}
		
		if(1==1 || $vo['user_leve']>0 && $vo['time_limit']>time()){
			if(($today_money+$withdraw_money)>$fee[2][1]*10000){
				$message = "单日提现上限为{$fee[2][1]}万元。您今日已经申请提现金额：{$today_money}元,当前申请金额为:{$withdraw_money}元,已超出单日上限，请您修改申请金额或改日再申请提现";
				//alogsm("actwithdraw_fail",0,1,$message);//
				ajaxmsg($message,2);
			}
			$itime = strtotime(date("Y-m", time())."-01 00:00:00").",".strtotime( date( "Y-m-", time()).date("t", time())." 23:59:59");
			$wmapx['uid'] = $this->uid;
			$wmapx['withdraw_status'] = array("neq",3);
			$wmapx['add_time'] = array("between","{$itime}");
			$times_month = M("member_withdraw")->where($wmapx)->count("id");
			
		
			if(($withdraw_money-$vo['back_money'])>=0){
				$maxfee1 = ($withdraw_money-$vo['back_money'])*$fee[0][0]/1000;
				if($maxfee1>=$fee[0][1]){
					$maxfee1 = $fee[0][1];
				}
				
				$maxfee2 = $vo['back_money']*$fee[1][0]/1000;
				if($maxfee2>=$fee[1][1]){
					$maxfee2 = $fee[1][1];
				}
				
				$fee = $maxfee1+$maxfee2;
				$money = $withdraw_money-$vo['back_money'];
			}else{
				$fee = $vo['back_money']*$fee[1][0]/1000;
				if($fee>=$fee[1][1]){
					$fee = $fee[1][1];
				}
			}
		
			
			
			
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
					memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',0);
					MTip('chk6',$this->uid);
					//alogsm("actwithdraw_success",0,1,"恭喜，提现申请提交成功");//
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
					memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',0);
					MTip('chk6',$this->uid);
					//alogsm("actwithdraw_success",0,1,"恭喜，提现申请提交成功");//
					ajaxmsg("恭喜，提现申请提交成功",1);
				} 
			}
			ajaxmsg("对不起，提现出错，请重试",2);
		}else{//普通会员暂未使用
				if(($today_money+$withdraw_money)>300000){
					$message = "您是普通会员，单日提现上限为30万元。您今日已经申请提现金额：$today_money元,当前申请金额为:$withdraw_money元,已超出单日上限，请您修改申请金额或改日再申请提现";
					//alogsm("actwithdraw_fail",0,1,$message);//
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
						//alogsm("actwithdraw_success",0,1,"恭喜，提现申请提交成功");//
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
						//alogsm("actwithdraw_success",0,1,"恭喜，提现申请提交成功");//
						ajaxmsg("恭喜，提现申请提交成功",1);
					} 
				}
				//alogsm("actwithdraw_fail",0,1,"对不起，提现出错，请重试");//
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
			$res = memberMoneyLog($this->uid,5,$vo['withdraw_money'],"撤消提现",'0','@网站管理员@');
			
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
	//交易记录
	public function tradinglog(){
		$jsoncode = file_get_contents("php://input");
		
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("用户错误！",0);
		}
	    $map['uid'] = $this->uid;
		$list = getMoneyLog($map,15);
		$loglist = $list['list'];
		foreach($loglist as $key=>$v) {
			$_list[$key]['id'] = $v['id'];
			$_list[$key]['add_time'] = date("Y-m-d",$v['add_time']);
			$_list[$key]['affect_money'] = $v['affect_money'];
			$_list[$key]['info'] = $v['info'];
			$_list[$key]['type'] = $v['type'];
		}
		$m_list['list'] = $_list;
		if(is_array($_list)&&!empty($_list)){
		    echo ajaxmsg($m_list);
		 }else{
		    echo ajaxmsg("暂无交易纪录",0);
		}
	}
	
	//更多交易记录
	public function tradinglogadd(){
		$jsoncode = file_get_contents("php://input");
		
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("用户错误！",0);
		}
		if (!is_array($arr)||empty($arr)||empty($arr['id'])) {
		   ajaxmsg("查询错误！",0);
		}
		
		$id = $arr['id'];
		
		$map['id'] = array('lt',$id);
	    $map['uid'] = $this->uid;
		$list = getMoneyLog($map,15);
		if(is_array($list)&&!empty($list)){
		    $loglist = $list['list'];
		    foreach($loglist as $key=>$v) {
			    $_list[$key]['id'] = $v['id'];
			    $_list[$key]['add_time'] = date("Y-m-d",$v['add_time']);
			    $_list[$key]['affect_money'] = $v['affect_money'];
			    $_list[$key]['info'] = $v['info'];
			    $_list[$key]['type'] = $v['type'];
		    }
			$m_list['list'] = $_list;
		}
		
		if(is_array($_list)&&!empty($_list)){
		    echo ajaxmsg($m_list);
		 }else{
		    echo ajaxmsg("暂无交易纪录",0);
		}
	}
	//投标记录
	public function tendlog(){
	    $jsoncode = file_get_contents("php://input");
		
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("用户错误！",0);
		}
		$pre = C('DB_PREFIX');
		//普通标
		$fieldx = "bi.investor_capital,bi.add_time,m.user_name,bo.borrow_name";
		$investinfo = M("borrow_investor bi")->field($fieldx)->join("{$pre}members m ON bi.investor_uid = m.id")->join("{$pre}borrow_info bo ON bo.id =bi.borrow_id")->limit(10)->where("bi.investor_uid={$this->uid}")->order("bi.id DESC")->select();
		foreach($investinfo as $key=>$v){
			$list[$key]['borrow_name'] = $v['borrow_name'];
			$list[$key]['investor_capital'] = $v['investor_capital'];
			$list[$key]['add_time'] = date("Y-m-d",$v['add_time']);
			
		}
		//企业直投
		$_fieldx = "bi.investor_capital,bi.add_time,m.user_name,bo.borrow_name";
		$_investinfo = M("transfer_borrow_investor bi")->field($_fieldx)->join("{$pre}members m ON bi.investor_uid = m.id")->join("{$pre}transfer_borrow_info bo ON bo.id =bi.borrow_id")->limit(10)->where("bi.investor_uid={$this->uid}")->order("bi.id DESC")->select();
		foreach($_investinfo as $key=>$v){
			$_list[$key]['borrow_name'] = $v['borrow_name'];
			$_list[$key]['investor_capital'] = $v['investor_capital'];
			$_list[$key]['add_time'] = date("Y-m-d",$v['add_time']);
			
		}

		$tendlist["invest"] = $list;
		$tendlist["tinvest"] = $_list;

		if (!empty($list)||!empty($_list)){
			ajaxmsg($tendlist);						
		}else{
		    ajaxmsg("暂无记录",0);
		}
				
	}
	//修改密码
	public function changepwd(){
		$jsoncode = file_get_contents("php://input");
		$arr = array();
		$arr = json_decode($jsoncode,true);
		//alogsm("changepwd",0,1,$jsoncode);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("用户错误！",0);
		}
		if (!is_array($arr)||empty($arr)||empty($arr['oldpwd'])||empty($arr['newpwd'])) {
		   ajaxmsg("数据错误！",0);
		}
		$old = md5($arr['oldpwd']);
		$newpwd = md5($arr['newpwd']);
		$c = M('members')->where("id={$this->uid} AND user_pass = '{$old}'")->count('id');
		if($c==0) ajaxmsg("原密码错误",0);
		$newid = M('members')->where("id={$this->uid}")->setField('user_pass',$newpwd);
		if($newid){
			//MTip('chk1',$this->uid);
			ajaxmsg("密码修改成功");
		}else ajaxmsg('密码修改失败',0);
    }
}