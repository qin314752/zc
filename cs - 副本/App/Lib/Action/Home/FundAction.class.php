<?php
// 金糯米内核类库，2014-06-11_listam
class FundAction extends HCommonAction {
    public function index(){
        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
		static $newpars;
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$per = C('DB_PREFIX');
        
		//网站公告
		$parm['type_id'] = 1;
		$parm['limit'] = 8;
		$this->assign("noticeList",getArticleList($parm));
		//网站公告
		
		
		$curl = $_SERVER['REQUEST_URI'];
		$urlarr = parse_url($curl);
		parse_str($urlarr['query'],$surl);//array获取当前链接参数，2.
		
		$urlArr = array('borrow_type','credit_limit','interest_rate','borrow_money','borrow_duration','progress');
		
		foreach($urlArr as $v){
			$newpars = $surl;//用新变量避免后面的连接受影响
			unset($newpars[$v],$newpars['type'],$newpars['order_sort'],$newpars['orderby']);//去掉公共参数，对掉当前参数
			foreach($newpars as $skey=>$sv){
				if($sv=="all") unset($newpars[$skey]);//去掉"全部"状态的参数,避免地址栏全满
			}
			
			$newurl = http_build_query($newpars);//生成此值的链接,生成必须是即时生成
			$searchUrl[$v]['url'] = $newurl;
			$searchUrl[$v]['cur'] = empty($_GET[$v])?"all":text($_GET[$v]);
		}
		
		
		$searchMap['credit_limit'] = array("all"=>"全部","0-200000"=>"20万以下","200000-500000"=>"20万-50万","500000-1000000"=>"50万-100万","1000000-1000000000"=>"100万以上");
		$searchMap['interest_rate'] = array("all"=>"全部","0-13"=>"13%以下","13-15"=>"13%-15%","15-100"=>"15%以上");
		$searchMap['borrow_money'] = array("all"=>"全部","0-100000"=>"10万以下","100000-1000000"=>"10万-100万","1000000-5000000"=>"100万-500万","5000000-100000000"=>"500万以上");
		$searchMap['borrow_duration'] = array("all"=>"全部","0-3"=>"3个月以内","3-6"=>"3-6个月","6-12"=>"6-12个月","12-24"=>"12-24个月");
		$searchMap['progress'] = array("all"=>"全部","50"=>"50%以上","75"=>"75%以上","90"=>"90%以上");
		

		$search = array();
		//搜索条件
		foreach($urlArr as $v){
			if($_GET[$v] && $_GET[$v]<>'all'){
				switch($v){
					case 'progress':
						$search["b.".$v] = array("egt",intval($_GET[$v]));
					break;
					case 'credit_limit':
						$barr = explode("-",text($_GET[$v]));
						$search["m.credit_limit"] = array("between",$barr);
					break;
					case 'borrow_type':
						$search["b.borrow_type"] = intval($_GET[$v]);
					break;
					case 'interest_rate':
						$barr = explode("-",text($_GET[$v]));
						$search["b.borrow_interest_rate"] = array("between",$barr);
					break;
					default:
						$barr = explode("-",text($_GET[$v]));
						$search["b.".$v] = array("between",$barr);
					break;
				}
			}
		}
		
		//searchMap
		//if(is_array($searchMap['borrow_status'])) $searchMap['collect_time']=array('gt',time());
		//$search['is_show'] = array("in",'0,1');
		//$search['b.is_show']=1;
		$search['b.is_jijin']=1;
		$search['b.on_off']=1;
		$search['b.online_time']=array("lt",time()+300);
		$parm['map'] = $search;
		$parm['pagesize'] = 5;
		
		//排序
		(strtolower($_GET['sort'])=="asc")?$sort="desc":$sort="asc";
		unset($surl['orderby'],$surl['sort']);
		$orderUrl = http_build_query($surl);
		if($_GET['orderby']){
			if(strtolower($_GET['orderby'])=="credits") $parm['orderby'] = "m.credits ".text($_GET['sort']);
			elseif(strtolower($_GET['orderby'])=="rate") $parm['orderby'] = "b.borrow_interest_rate ".text($_GET['sort']);
			elseif(strtolower($_GET['orderby'])=="borrow_money") $parm['orderby'] = "b.borrow_money ".text($_GET['sort']);
			else $parm['orderby']="b.id DESC";
		}else{
			$parm['orderby']="b.is_show desc,b.borrow_status ASC,b.borrow_duration ASC,b.online_time desc";
		}
		$Sorder['Corderby'] = strtolower(text($_GET['orderby']));
		$Sorder['Csort'] = strtolower(text($_GET['sort']));
		$Sorder['url'] = $orderUrl;
		$Sorder['sort'] = $sort;
		$Sorder['orderby'] = text($_GET['orderby']);
		//排序
		
		$list = getTBorrowList($parm);
		//投标排行
		$newinvest = M('transfer_borrow_investor i')->field("i.investor_capital,m.user_name,bi.borrow_name")->join("{$per}members m ON m.id=i.investor_uid")->join("{$per}transfer_borrow_info bi ON bi.id=i.borrow_id")->order('i.investor_capital DESC,i.id DESC')->limit(8)->select();
		//加入用户数
		$invest_num = M('transfer_borrow_investor')->where("is_jijin = 1")->group("investor_uid")->select();
		//dump(M()->GetLastsql());
		//累计总金额
		$invest_total = M('transfer_borrow_investor')->where("is_jijin = 1")->sum("investor_capital");
        //已为用户赚取
		$invest_interest = M('transfer_borrow_investor')->where("is_jijin = 1")->sum("investor_interest");
		$this->assign("newinvest",$newinvest);
		$this->assign("Sorder",$Sorder);
		$this->assign("searchUrl",$searchUrl);
		$this->assign("searchMap",$searchMap);
		$this->assign("Bconfig",$Bconfig);
		$this->assign("gloconf",$this->gloconf);
		$this->assign("list",$list);
		$this->assign("invest_num",count($invest_num));
		$this->assign("invest_total",$invest_total);
		$this->assign("invest_interest",$invest_interest);
		
		$this->display();
    }
	
	////////////////////////////////////////////////////////////////////////////////////
    public function tdetail(){
		if($_GET['type']=='commentlist'){
			//评论
			$cmap['tid'] = intval($_GET['id']);
			$clist = getCommentList($cmap,5);
			$this->assign("commentlist",$clist['list']);
			$this->assign("commentpagebar",$clist['page']);
			$this->assign("commentcount",$clist['count']);
			$data['html'] = $this->fetch('commentlist');
			exit(json_encode($data));
		}


		$pre = C('DB_PREFIX');
		$id = intval($_GET['id']);
		$this->assign("borrow_id",$id);
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		
		//合同ID
		if($this->uid){
			$invs = M('transfer_borrow_investor')->field('id')->where("borrow_id={$id} AND (investor_uid={$this->uid} OR borrow_uid={$this->uid})")->find();
			if($invs['id']>0) $invsx=$invs['id'];
			elseif(!is_array($invs)) $invsx='no';
		}else{
			$invsx='login';
		}
		$this->assign("invid",$invsx);
		//帐户资金情况
		$this->assign("investInfo", getMinfo($this->uid,true));					
		//帐户资金情况
		//合同ID
		//borrowinfo
		//$borrowinfo = M("borrow_info")->field(true)->find($id);
		$borrowinfo = M("transfer_borrow_info b")->join("{$pre}transfer_detail d ON d.borrow_id=b.id")->field(true)->find($id);
		/*if(!is_array($borrowinfo) || $borrowinfo['is_show'] == 0){
			$this->error("数据有误或此标已认购完");
		}*/
		if($borrowinfo['is_jijin'] != 1){
		    $this->error("非法操作");
		}
		$borrowinfo['progress'] = getfloatvalue($borrowinfo['transfer_out']/$borrowinfo['transfer_total'] * 100, 2);
		$borrowinfo['need'] = getfloatvalue(($borrowinfo['transfer_total'] - $borrowinfo['transfer_out'])*$borrowinfo['per_transfer'], 2 );
		$borrowinfo['updata'] = unserialize($borrowinfo['updata']);
		
		
		if($borrowinfo['danbao']!=0 ){
			$danbao = M('article')->field('id,title')->where("type_id=7 and id={$borrowinfo['danbao']}")->find();
			$borrowinfo['danbao']=$danbao['title'];//担保机构
			$borrowinfo['danbaoid'] = $danbao['id'];
		}else{
			$borrowinfo['danbao']='暂无担保机构';//担保机构
		}
		$borrowinfo['restday'] = ceil(($borrowinfo['deadline'] - time())/(24*60*60));
		$borrowinfo['currentday'] = time();
		$now=time();
	    $borrowinfo['aa']=floor($borrowinfo['collect_day']-$now);
		$borrowinfo['leftday'] = ceil(($borrowinfo['collect_day']-$now)/3600/24);
	    $borrowinfo['leftdays'] = floor(($borrowinfo['collect_day']-$now)/3600/24).'天以上';
        $borrowinfo['max_money_l'] = $borrowinfo['borrow_max']*$borrowinfo['per_transfer'];
		//dump($borrowinfo);
		$this->assign("vo", $borrowinfo);
		//此标借款利息还款相关情况
		//memberinfo
		$memberinfo = M("members m")->field("m.id,m.customer_name,m.customer_id,m.user_name,m.reg_time,m.credits,fi.*,mi.*,mm.*")->join("{$pre}member_financial_info fi ON fi.uid = m.id")->join("{$pre}member_info mi ON mi.uid = m.id")->join("{$pre}member_money mm ON mm.uid = m.id")->where("m.id={$borrowinfo['borrow_uid']}")->find();
		$areaList = getArea();
		$memberinfo['location'] = $areaList[$memberinfo['province']].$areaList[$memberinfo['city']];
		$memberinfo['location_now'] = $areaList[$memberinfo['province_now']].$areaList[$memberinfo['city_now']];
		$this->assign("minfo",$memberinfo);
		//memberinfo
		
		//investinfo
		$fieldx = "bi.investor_capital,bi.transfer_month,bi.transfer_num,bi.add_time,m.user_name,bi.is_auto,bi.final_interest_rate";
		$investinfo = M("transfer_borrow_investor bi")->field($fieldx)->join("{$pre}members m ON bi.investor_uid = m.id")->where("bi.borrow_id={$id}")->order("bi.id DESC")->select();
		$this->assign("investinfo",$investinfo);
		$investnum = M("transfer_borrow_investor")->where("borrow_id={$id}")->count("id");
		$this->assign("investnum",$investnum);
		// 投资记录
        $this->investRecord($id);
		//investinfo
		//收益率
		$monthData['month_times'] = 12;
		$monthData['account'] = 100000;
		$monthData['year_apr'] = $borrowinfo['borrow_interest_rate'];
		$monthData['type'] = "all";
		$repay_detail = CompoundMonth($monthData);
		$this->assign("Compound",$repay_detail['shouyi']);
		//收益率结束
		$oneday = 86400;
		$time_1 = time() - 30 * $oneday.",".time();
		$time_6 = time() - 180 * $oneday.",".time();
		$time_12 = time() - 365 * $oneday.",".time();
		$mapxr['borrow_id'] = $id;
		$this->assign("time_all_out", M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		$mapxr['add_time'] = array("between","{$time_1}");
		$this->assign("time_1_out", M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		$mapxr['add_time'] = array("between","{$time_6}");
		$this->assign("time_6_out",M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		$mapxr['add_time'] = array("between","{$time_12}");
		$this->assign("time_12_out",M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		
		$mapxr = array();
		$mapxr['borrow_id'] = $id;
		$mapxr['status'] = 2;
		$this->assign("time_all_back", M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		$mapxr['back_time'] = array("between","{$time_1}");
		$this->assign("time_1_back",M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		$mapxr['back_time'] = array("between","{$time_6}");
		$this->assign("time_6_back", M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		$mapxr['back_time'] = array("between","{$time_12}");
		$this->assign("time_12_back", M("transfer_borrow_investor")->where($mapxr)->sum("transfer_num"));
		// 投资记录
        $this->investRecord($id);
		//investinfo
		//评论
		$cmap['tid'] = $id;
		$clist = getCommentList($cmap,5);
		$this->assign("Bconfig",$Bconfig);
		$this->assign("commentlist",$clist['list']);
		$this->assign("commentpagebar",$clist['page']);
		$this->assign("commentcount",$clist['count']);
		$this->display();
    }
	
	public function investcheck()
	{
		$pre = C("DB_PREFIX");
		if (!$this->uid)
		{
			ajaxmsg("", 3);
		}
		$pin = md5($_POST['pin']);
		$borrow_id = intval($_POST['borrow_id']);
		$tnum = intval($_POST['tnum']);
		$month = intval($_POST['month']);
		$m = M("member_money")->field('account_money,back_money,money_collect')->find($this->uid);
		$amoney = $m['account_money']+$m['back_money'];
		$uname = session("u_user_name");
		$vm = getMinfo($this->uid,"m.pin_pass");
		$pin_pass = $vm['pin_pass'];
		$amoney = floatval($amoney);
		$binfo = M("transfer_borrow_info")->field( "transfer_out,transfer_back,transfer_total,per_transfer,is_show,deadline,min_month,increase_rate,reward_rate,borrow_duration,collect_day,borrow_max")->find($borrow_id);
		$max_month = $binfo['borrow_duration'];//getTransferLeftmonth($binfo['deadline']);
		$min_month = $binfo['min_month'];
		$max_num = $binfo['transfer_total'] - $binfo['transfer_out'];
		
		$mo = M('members_status')->field("email_status,phone_status")->where("uid={$this->uid}")->find();
		

		if ($max_num < $tnum)
		{
			ajaxmsg( "本标还能认购最大份数为".$max_num."份，请重新输入认购份数", 3 );
		}
		if($tnum < 1) {
			ajaxmsg( "本标最少要投1份，请重新输入认购份数.".$tnum, 3);
		}
		if($binfo['borrow_max'] > 0){
		    if($binfo['borrow_max'] < $tnum){
		        ajaxmsg( "单人最大购买份数为".$binfo['borrow_max']."份，请重新输入认购份数。", 3 );
		    }
		}
		if($binfo['transfer_out'] > 0 && $binfo['borrow_max'] > 0){
		    $havebuy = M("transfer_borrow_investor")->where("investor_uid={$this->uid} and borrow_id={$borrow_id}")->sum("transfer_num");
		    if($binfo['borrow_max'] < $tnum + $havebuy){
		        ajaxmsg( "单人最大购买份数为".$binfo['borrow_max']."份，请重新输入认购份数!", 3 );
		    }
			
		}
		$money = $binfo['per_transfer'] * $tnum;
		if ($pin != $pin_pass)
		{
			ajaxmsg( "支付密码错误，请重试", 0);
		}
		if ($amoney < $money)
		{
			$msg = "尊敬的{$uname}，您准备认购{$money}元，但您的账户可用余额为{$amoney}元，您要先去充值吗？";
			ajaxmsg($msg, 2);
		}
		else
		{
			$msg = "尊敬的{$uname}，您的账户可用余额为{$amoney}元，您确认认购{$money}元吗？";
			ajaxmsg($msg, 1);
		}
	}
	
	public function investmoney()
	{
		if(!$this->uid){exit();}
		$borrow_id = intval($_POST['T_borrow_id']);
		$tnum = intval($_POST['transfer_invest_num']);
		$repayment_type = intval($_POST['chooseWay']);
		$m = M("member_money")->field('account_money,back_money,money_collect')->find($this->uid);
		$amoney = $m['account_money']+$m['back_money'];
		$uname = session("u_user_name");
		$binfo = M("transfer_borrow_info")->field( "borrow_uid,borrow_interest_rate,transfer_out,transfer_back,transfer_total,per_transfer,is_show,deadline,min_month,increase_rate,reward_rate,borrow_duration,collect_day,on_off,online_time,borrow_max")->find($borrow_id);

        $mo = M('members_status')->field("email_status,phone_status")->where("uid={$this->uid}")->find();
		if($binfo['on_off']!=1){
		    $this->error("此标无法投资！");
		}
/*		if($mo['email_status']!=1){
			$this->error("请先进行邮箱认证",__APP__."/member/verify?id=1#fragment-1");
		}
		if($mo['phone_status']!=1){
			$this->error("请先进行手机认证",__APP__."/member/verify?id=1#fragment-2");
		}*/
		if($binfo['online_time'] > time()) $this->error("未到上线时间，不能投标！");
//		if($binfo['collect_day'] < time()){
//		    $this->error("募集期已经结束！");
//		}
		if($this->uid == $binfo['borrow_uid']) ajaxmsg("不能去投自己的标",0);
		$month = $binfo['borrow_duration'];//getTransferLeftmonth($binfo['deadline']);
		$min_month = $binfo['min_month'];
		$max_num = $binfo['transfer_total'] - $binfo['transfer_out'];
//		if($month < $min_month || $max_month < $month){
//			$this->error( "本标认购期限只能在'".$min_month."个月---".$max_month."个月'之间" );
//		}
		if($tnum < 1) {
			$this->error( "本标最少要投已1份，请重新输入认购份数!" );
		}
		if($binfo['borrow_max'] > 0){
		    if($binfo['borrow_max'] -$tnum<0){
		        $this->error( "单人最大购买份数为".$binfo['borrow_max']."份，请重新输入认购份数");
		    }
		}
		if($binfo['transfer_out'] > 0 && $binfo['borrow_max'] > 0){
		    $havebuy = M("transfer_borrow_investor")->where("investor_uid={$this->uid} and borrow_id={$borrow_id}")->sum("transfer_num");
		    if($binfo['borrow_max'] - $tnum - $havebuy<0){
		        $this->error( "单人最大购买份数为".$binfo['borrow_max']."份，请重新输入认购份数!");
		    }
			
		}
		if($max_num < $tnum){
			$this->error( "本标还能认购最大份数为".$max_num."份，请重新输入认购份数" );
		}
		$money = $binfo['per_transfer'] * $tnum;
		if($amoney < $money){
			$this->error( "尊敬的{$uname}，您准备认购{$money}元，但您的账户可用余额为{$amoney}元，请先去充值再认购.",__APP__."/member/charge#fragment-1");
		}
		$vm = getMinfo($this->uid,"m.pin_pass,mm.invest_vouch_cuse,mm.money_collect");
		$pin_pass = $vm['pin_pass'];
		$pin = md5($_POST['T_pin']);
		if ($pin != $pin_pass){
			$this->error( "支付密码错误，请重试" );
		}
		$done = TinvestMoney($this->uid,$borrow_id,$tnum,$month,0,$repayment_type);//投流转标
                if($done === true){
			$this->success("恭喜成功认购{$tnum}份,共计{$money}元");
		}else if($done){
			$this->error($done);
		}else{
			$this->error("对不起，认购失败，请重试!");
		}
	}

	public function addcomment(){
		$data['comment'] = text($_POST['comment']);
		if(!$this->uid)  ajaxmsg("请先登录",0);
		if(empty($data['comment']))  ajaxmsg("留言内容不能为空",0);
		$data['type'] = 2;
		$data['add_time'] = time();
		$data['uid'] = $this->uid;
		$data['uname'] = session("u_user_name");
		$data['tid'] = intval($_POST['tid']);
		$data['name'] = M('transfer_borrow_info')->getFieldById($data['tid'],'borrow_name');
		$newid = M('comment')->add($data);
		//$this->display("Public:_footer");
		if($newid) ajaxmsg();
		else ajaxmsg("留言失败，请重试",0);
	}
	
	public function jubao(){
		if($_POST['checkedvalue']){
			$data['reason'] = text($_POST['checkedvalue']);
			$data['text'] = text($_POST['thecontent']);
			$data['uid'] = $this->uid;
			$data['uemail'] = text($_POST['uemail']);
			$data['b_uid'] = text($_POST['b_uid']);
			$data['b_uname'] = text($_POST['theuser']);
			$data['add_time'] = time();
			$data['add_ip'] = get_client_ip();
			$newid = M('jubao')->add($data);
			if($newid) exit("1");
			else exit("0");
		}else{
			$id=intval($_GET['id']);
			$u['id'] = $id;
			$u['uname']=M('members')->getFieldById($id,"user_name");
			$u['uemail']=M('members')->getFieldById($this->uid,"user_email");
			$this->assign("u",$u);
			$data['content'] = $this->fetch("Public:jubao");
			exit(json_encode($data));
		}
	}
	
	public function ajax_invest()
	{
		if ( !$this->uid )
		{
			ajaxmsg( "请先登录", 0 );
		}
		$pre = c( "DB_PREFIX" );
		$id = intval( $_GET['id'] );
		$num = intval( $_GET['num'] );
		$chooseWay = $_GET['chooseWay'];
		$Bconfig = require( C("APP_ROOT" )."Conf/borrow_config.php" );
		$field = "id,borrow_uid,borrow_money,borrow_interest_rate,borrow_duration,repayment_type,transfer_out,transfer_back,transfer_total,per_transfer,is_show,deadline,min_month,increase_rate,reward_rate,borrow_max";
		$vo = M("transfer_borrow_info" )->field($field)->find($id);
		if ($this->uid == $vo['borrow_uid'])
		{
			ajaxmsg("不能投自己的标", 0);
		}

		if ($vo['transfer_out'] == $vo['transfer_total'])
		{
			ajaxmsg( "此标可认购份数为0", 0 );
		}
		if ($vo['is_show'] == 0)
		{
			ajaxmsg( "只能投正在借款中的标", 0 );
		}
                //最大购买份数验证 #李振立#
//                if($num > $vo['borrow_max']){
//                    ajaxmsg( "您的购买份数为<span style='color:#ff0000;font-weight:bold;'>&nbsp;".$num."</span>&nbsp;份，超出了此标的最大购买份数<span style='color:#ff0000;font-weight:bold;'>&nbsp;".$vo['borrow_max']."</span>&nbsp;份!", 0);
//                }
                
		$vo['transfer_leve'] = $vo['transfer_total'] - $vo['transfer_out'];
		$vo['uname'] = M("members")->getFieldById($vo['borrow_uid'], "user_name");
		//$vo['leftday'] = ceil(($vo['collect_day']-time())/3600/24);
		$vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
		$amoney = $vm['account_money']+$vm['back_money'];
		$pin_pass = $vm['pin_pass'];
		$has_pin = empty( $pin_pass ) ? "no" : "yes";
		//收益开始
		$money = $vo['per_transfer'];
		//每月还息
		$monthData['month_times'] = $vo['borrow_duration'];
		$monthData['account'] = $money;
		$monthData['year_apr'] = $vo['borrow_interest_rate'];
		$monthData['type'] = "all";
		$repay_detail = EqualEndMonth($monthData);
		$vo['shouyi4'] =$repay_detail['repayment_account'] - $money;
			    
		//利息复投
		$monthData['month_times'] = $vo['borrow_duration'];
		$monthData['account'] = $money;
		$monthData['year_apr'] = $vo['borrow_interest_rate'];
		$monthData['type'] = "all";
		$repay_detail = CompoundMonth($monthData);
		$vo['shouyi6'] =$repay_detail['repayment_account'] - $money;
		
		//收益结束
		$this->assign( "has_pin", $has_pin);
		$this->assign( "vo", $vo );
		$this->assign( "account_money", $amoney);
		$this->assign( "Bconfig", $Bconfig);
		$this->assign( "num", $num);
		$this->assign("chooseway",$chooseWay);
		$data['content'] = $this->fetch();
		ajaxmsg($data);
	}
	public function ajax_tanchu(){
	    $id =intval( $_GET['id'] );
		$ziduan = $_GET['ziduan'];
		$field = "borrow_id,borrow_breif,borrow_capital,borrow_use,borrow_risk,borrow_jyjg,borrow_fxjgjs,borrow_jjld,borrow_hkly";
		
		$vo = M("transfer_detail")->field($field)->find($id);
		$this->assign("vo",$vo[$ziduan]);
		//$this->display();
		$data['content'] = $this->fetch();
		ajaxmsg($data);
	}			
	public function getarea(){
		$rid = intval($_GET['rid']);
		if(empty($rid)){
			$data['NoCity'] = 1;
			exit(json_encode($data));
		}
		$map['reid'] = $rid;
		$alist = M('area')->field('id,name')->order('sort_order DESC')->where($map)->select();

		if(count($alist)===0){
			$str="<option value=''>--该地区下无下级地区--</option>\r\n";
		}else{
			if($rid==1) $str.="<option value='0'>请选择省份</option>\r\n";
			foreach($alist as $v){
				$str.="<option value='{$v['id']}'>{$v['name']}</option>\r\n";
			}
		}
		$data['option'] = $str;
		$res = json_encode($data);
		echo $res;
	}	
	
	public function addfriend(){
		if(!$this->uid) ajaxmsg("请先登录",0);
		$fuid = intval($_POST['fuid']);
		$type = intval($_POST['type']);
		if(!$fuid||!$type) ajaxmsg("提交的数据有误",0);
		
		$save['uid'] = $this->uid;
		$save['friend_id'] = $fuid;
		$vo = M('member_friend')->where($save)->find();	
		
		if($type==1){//加好友
		if($this->uid == $fuid) ajaxmsg("您不能对自己进行好友相关的操作",0);
			if(is_array($vo)){
				if($vo['apply_status']==3){
					$msg="已经从黑名单移至好友列表";
					$newid = M('member_friend')->where($save)->setField("apply_status",1);
				}elseif($vo['apply_status']==1){
					$msg="已经在你的好友名单里，不用再次添加";
				}elseif($vo['apply_status']==0){
					$msg="已经提交加好友申请，不用再次添加";
				}elseif($vo['apply_status']==2){
					$msg="好友申请提交成功";
					$newid = M('member_friend')->where($save)->setField("apply_status",0);
				}
			}else{
				$save['uid'] = $this->uid;
				$save['friend_id'] = $fuid;
				$save['apply_status'] = 0;
				$save['add_time'] = time();
				$newid = M('member_friend')->add($save);	
				$msg="好友申请成功";
			}
		}elseif($type==2){//加黑名单
		if($this->uid == $fuid) ajaxmsg("您不能对自己进行黑名单相关的操作",0);
			if(is_array($vo)){
				if($vo['apply_status']==3) $msg="已经在黑名单里了，不用再次添加";
				else{
					$msg="成功移至黑名单";
					$newid = M('member_friend')->where($save)->setField("apply_status",3);	
				}
			}else{
				$save['uid'] = $this->uid;
				$save['friend_id'] = $fuid;
				$save['apply_status'] = 3;
				$save['add_time'] = time();
				$newid = M('member_friend')->add($save);	
				$msg="成功加入黑名单";
			}
		}
		if($newid) ajaxmsg($msg);
		else ajaxmsg($msg,0);
	}
	
	
	public function innermsg(){
		if(!$this->uid) ajaxmsg("请先登录",0);
		$fuid = intval($_GET['uid']);
		if($this->uid == $fuid) ajaxmsg("您不能对自己进行发送站内信的操作",0);
		$this->assign("touid",$fuid);
		$data['content'] = $this->fetch("Public:innermsg");
		ajaxmsg($data);
	}
	public function doinnermsg(){
		$touid = intval($_POST['to']);
		$msg = text($_POST['msg']);	
		$title = text($_POST['title']);	
		$newid = addMsg($this->uid,$touid,$title,$msg);
		if($newid) ajaxmsg();
		else ajaxmsg("发送失败",0);
		
	}
    public function investRecord($borrow_id=0)
    {
        
        isset($_GET['borrow_id']) && $borrow_id = intval($_GET['borrow_id']);
        $Page = D('Page');       
        import("ORG.Util.Page");       
        $count = M("transfer_borrow_investor")->where('borrow_id='.$borrow_id)->count('id');
        $Page     = new Page($count,20);
        
        
        $show = $Page->ajax_show();
        $this->assign('count', $count);
        $this->assign('page', $show);
        if($_GET['borrow_id']){
            $list = M("transfer_borrow_investor as b")
                        ->join(C(DB_PREFIX)."members as m on  b.investor_uid = m.id")
                        ->join(C(DB_PREFIX)."transfer_borrow_info as i on  b.borrow_id = i.id")
                        ->field('i.online_time,i.borrow_interest_rate, b.investor_capital, b.transfer_num, b.transfer_month, b.is_auto, m.user_name')
                        ->where('b.borrow_id='.$borrow_id)->order('b.id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
            $string = '';
            foreach($list as $k=>$v){
                $v['is_auto']==1?$investor_type="自动":$investor_type="手动";
                $string .= "<tr>
                  <td height='25' align='left' valign='middle'>".hidecard($v['user_name'],5)."</td>
                  <td align='left' valign='middle'>".$v['transfer_num']."份</td>
                  <td align='left' valign='middle'>".Fmoney($v['investor_capital'])."元</td>
                  <td align='left' valign='middle'>".$v['borrow_interest_rate']."%/年</td>
                  <td align='left' valign='middle'>".$v['transfer_month']."个月</td>
                  <td align='left' valign='middle'>".$investor_type."</td>
                  <td align='left' valign='middle'><img src='/Style/H/images/fund/zhangtai.png' /></td></tr>";

            }
            echo empty($string)?'暂时没有投资记录':$string;
        }
        
    }
}
?>