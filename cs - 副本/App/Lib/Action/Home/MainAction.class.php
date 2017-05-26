<?php

class MainAction extends HCommonAction {
		public function index(){

	   $jsoncode = file_get_contents("php://input"); 
	   $arr = array();
	   $arr = json_decode($jsoncode,true);
//	   $arr['id'] = 0;
//	   $arr['type'] = 0;
//	   $arr['num'] = 3;
//	   $arr['tid'] = 11;
//	   $arr['ttype'] = 1;
//	   $arr['tnum'] = 3;
       //普通标翻页
	   if(is_array($arr) && isset($arr['id']) && isset($arr['type']) && isset($arr['num'])){
	       $type = $arr['type'];
		   $id = intval($arr['id']);
		   $num = intval($arr['num']);
	   }else{
	       $type = 2;
		   $num = 5;
	   }
	   //流转标翻页
	   if(is_array($arr) && isset($arr['tid']) && isset($arr['ttype']) && isset($arr['tnum'])){
	       $ttype = $arr['ttype'];
		   $tid = intval($arr['tid']);
		   $tnum = intval($arr['tnum']);
	   }else{
	       $ttype = 2;
		   $tnum = 5;
	   }
		//alogsm("Main",0,1,$jsoncode);

		$per = C('DB_PREFIX');
		//普通标	
		if($type == 1){
			$searchMap['borrow_status']=array("in",'2,4,6,7');
			$searchMap['b.id']=array("gt",$id);
			$parm['map'] = $searchMap;
			$parm['limit'] = $num;
			$parm['orderby']="b.borrow_status ASC,b.id asc";
		}elseif($type == 0){
		    $searchMap['borrow_status']=array("in",'2,4,6,7');
			$searchMap['b.id']=array("lt",$id);
			$parm['map'] = $searchMap;
			$parm['limit'] = $num;
			$parm['orderby']="b.borrow_status ASC,b.id DESC";
		}else{
		    $searchMap['borrow_status']=array("in",'2,4,6,7');
			$parm['map'] = $searchMap;
			$parm['limit'] = $num ;
			$parm['orderby']="b.borrow_status ASC,b.id DESC";
		}
		
		$list = getBorrowList($parm);
		//$_list = $list;
		foreach($list['list'] as $key =>$v){
		  $_list[$key]['uid'] = intval($v['uid']);
		  $_list[$key]['type'] = getleixing($v);
		  $_list[$key]['id'] = intval($v['id']);
		  $_list[$key]['borrow_name'] = $v['borrow_name'];
		  $_list[$key]['borrow_interest_rate'] = $v['borrow_interest_rate'];
		  if($v['repayment_type']==1){
		      $_list[$key]['borrow_duration'] = $v['borrow_duration']."天";
		  }else{
		      $_list[$key]['borrow_duration'] = $v['borrow_duration']."个月";
		  }
		  
		  
		  $_list[$key]['repayment_type'] = $v['repayment_type'];
		  $_list[$key]['borrow_money'] =$v['borrow_money'];
		  $_list[$key]['progress'] =$v['progress'];
		  $_list[$key]['credits'] =$v['credits'];
		  $_list[$key]['user_name'] =$v['user_name'];
		  $_list[$key]['imgpath'] =get_avatar(intval($v['uid']));
		  $_list[$key]['suo'] = empty($v['password'])?0:1;//是否定向标
		  if($v['reward_type']==1){
		      $_list[$key]['reward']=$v['reward_num']."%";
		  }elseif($v['reward_type']==2){
		      $_list[$key]['reward']=$v['reward_num']."元";
		  }else{
		      $_list[$key]['reward']="0";
		  }
		}
		$m_list['list']= $_list;
		//企业直投
		$parmt = array();
		$searchMapt = array();
		//$searchMap['borrow_status']=2;
		if($ttype == 1){
			$searchMapt['is_show'] = array('in','0,1');
			$searchMapt['b.id']=array("gt",$tid);
			$parmt['map'] = $searchMapt;
			$parmt['limit'] = $tnum;
			$parmt['orderby'] = "b.is_show desc,b.id asc";
		}elseif($ttype == 0){
		    $searchMapt['is_show'] = array('in','0,1');
			$searchMapt['b.id']=array("lt",$tid);
			$parmt['map'] = $searchMapt;
			$parmt['limit'] = $tnum;
			$parmt['orderby'] = "b.is_show desc,b.id DESC";
		}else{
			$searchMapt['is_show'] = array('in','0,1');
			$parmt['map'] = $searchMapt;
			$parmt['limit'] = $tnum;
			$parmt['orderby'] = "b.is_show desc,b.id DESC";
		}

		$tlist = getTBorrowList($parmt);
		foreach($tlist['list'] as $key =>$v){
		  $_tlist[$key]['uid'] = intval($v['uid']);
		  $_tlist[$key]['type'] = 2;
		  $_tlist[$key]['id'] = intval($v['id']);
		  $_tlist[$key]['borrow_name'] = $v['borrow_name'];
		  $_tlist[$key]['borrow_interest_rate'] = $v['borrow_interest_rate'];
		  $_tlist[$key]['borrow_duration'] = $v['borrow_duration']."个月";
		  $_tlist[$key]['per_transfer'] = $v['per_transfer'];
		  $_tlist[$key]['borrow_money'] =$v['borrow_money'];
		  $_tlist[$key]['progress'] =$v['progress'];
		  $_tlist[$key]['credits'] =$v['credits'];
		  $_tlist[$key]['user_name'] =$v['user_name'];
		  $_tlist[$key]['imgpath'] =get_avatar(intval($v['uid']));
		  $_tlist[$key]['reward'] = $v['reward_rate']."%";
		}
		$m_list['tlist']= $_tlist;
		
		echo ajaxmsg($m_list);

    }
	//普通标详细信息
	public function detail(){
		$jsoncode = file_get_contents("php://input");
		//alogsm("detail",0,1,$jsoncode);
		$arr = array();
		$arr = json_decode($jsoncode,true);
		
		if (!is_array($arr)||empty($arr)||empty($arr['id'])||!in_array($arr['type'],array(3,4,5,6,7))) {
		   ajaxmsg("查询错误！",0);
		}


		$pre = C('DB_PREFIX');
		$id = intval($arr['id']);
		//$id = 30;
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		
		
		//borrowinfo
		
		$borrowinfo = M("borrow_info bi")->field('bi.id as bid,bi.*,ac.title,ac.id')->join('nuomi_article ac on ac.id= bi.danbao')->where('bi.id='.$id)->find();
		if(!is_array($borrowinfo) || ($borrowinfo['borrow_status']==0 && $this->uid!=$borrowinfo['borrow_uid']) ) ajaxmsg("数据有误",0);
		$borrowinfo['biao'] = $borrowinfo['borrow_times'];
		$borrowinfo['need'] = $borrowinfo['borrow_money'] - $borrowinfo['has_borrow'];
		$borrowinfo['lefttime'] =$borrowinfo['collect_time'] - time();
		$borrowinfo['progress'] = getFloatValue($borrowinfo['has_borrow']/$borrowinfo['borrow_money']*100,2);
		
		//$list['type'] = 1;
		$list['id'] = $id;
		$list['type'] = getleixing($borrowinfo);
		$list['borrow_name'] = $borrowinfo['borrow_name'];
		$list['borrow_money'] = $borrowinfo['borrow_money'];
		$list['borrow_interest_rate'] = $borrowinfo['borrow_interest_rate'];
		$list['repayment_type'] = $borrowinfo['repayment_type'];
		
		if($list['repayment_type']==1){
		    $list['borrow_duration'] = $borrowinfo['borrow_duration']."天";
		}else{
		    $list['borrow_duration'] = $borrowinfo['borrow_duration']."个月";
		}
		$list['huankuan_type'] = $Bconfig['REPAYMENT_TYPE'][$borrowinfo['repayment_type']];
		$list['borrow_use'] = $Bconfig['REPAYMENT_TYPE'][$borrowinfo['borrow_use']];
		$list['borrow_min'] = $borrowinfo['borrow_min'];
		$list['borrow_max'] = $borrowinfo['borrow_max']=="0"?"无":"{$borrowinfo['borrow_max']}";
		$list['progress'] = $borrowinfo['progress'];
		$list['need'] = $borrowinfo['need'];
		if($borrowinfo['progress'] >= 100 ){
		    $list['lefttime'] ="已结束";
		}elseif ($borrowinfo['lefttime'] > 0){
		    $left_tian = floor($borrowinfo['lefttime']/ (60 * 60 * 24));
			$left_hour = floor(($borrowinfo['lefttime'] - $left_tian * 24 * 60 * 60)/3600);
			$left_minute = floor(($borrowinfo['lefttime'] - $left_tian * 24 * 60 * 60 - $left_hour * 60 * 60)/60);
			$left_second = floor($borrowinfo['lefttime'] - $left_tian * 24 * 60 * 60 - $left_hour * 60 * 60 - $left_minute *60);
			$list['lefttime'] = $left_tian.",".$left_hour.",".$left_minute.",".$left_second;
		}else {
		    $list['lefttime'] ="已结束";
		}
		$list['borrow_info'] = $borrowinfo['borrow_info'];
		$list['invest_num'] = M("borrow_investor")->where("borrow_id={$id}")->count("id");
		
		$minfo = M("members")->where("id={$borrowinfo['borrow_uid']}")->find();
		$list['user_name'] = $minfo['user_name'];
		$list['imgpath'] = get_avatar($borrowinfo['borrow_uid']);
		$list['addtime'] = date("Y-m-d",$borrowinfo['add_time']);
		if($borrowinfo['reward_type']==1){
		    $list['reward'] = $borrowinfo['reward_num']."%";
		}elseif($borrowinfo['reward_type']==2){
		    $list['reward'] = $borrowinfo['reward_num'];
		}else{
		    $list['reward']="0";
		}
		echo ajaxmsg($list);
		
    }
	//普通标投标记录
	public function investlog(){
	    $jsoncode = file_get_contents("php://input");
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (!is_array($arr)||empty($arr)||empty($arr['id'])) {
		   ajaxmsg("查询错误！",0);
		}
		$pre = C('DB_PREFIX');
		$id = intval($arr['id']);
		//$id = 16;
		$fieldx = "bi.investor_capital,bi.add_time,m.user_name,bi.is_auto";
		$investinfo = M("borrow_investor bi")->field($fieldx)->join("{$pre}members m ON bi.investor_uid = m.id")->where("bi.borrow_id={$id}")->order("bi.id DESC")->select();
		foreach($investinfo as $key=>$v){
			$list[$key]['user_name'] = $v['user_name'];
			$list[$key]['investor_capital'] = $v['investor_capital'];
			$list[$key]['add_time'] = date("Y-m-d",$v['add_time']);
			
		}
		$_list['list'] = $list;
		if(is_array($list)&&!empty($list)){
		    echo ajaxmsg($_list);
		}else echo ajaxmsg("暂无投标记录",0);
		
	}
	//企业直投投标记录
	public function tinvestlog(){
	    $jsoncode = file_get_contents("php://input");
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (!is_array($arr)||empty($arr)||empty($arr['id'])) {
		   ajaxmsg("查询错误！",0);
		}
		$pre = C('DB_PREFIX');
		$id = intval($arr['id']);
		$id = 4;
		$fieldx = "bi.investor_capital,bi.add_time,m.user_name,bi.is_auto";
		$fieldx = "bi.investor_capital,bi.transfer_month,bi.transfer_num,bi.add_time,m.user_name,bi.is_auto,bi.final_interest_rate";
		$investinfo = M("transfer_borrow_investor bi")->field($fieldx)->join("{$pre}members m ON bi.investor_uid = m.id")->where("bi.borrow_id={$id}")->order("bi.id DESC")->select();
		foreach($investinfo as $key=>$v){
			$list[$key]['user_name'] = $v['user_name'];
			$list[$key]['investor_capital'] = $v['investor_capital'];
			$list[$key]['add_time'] = date("Y-m-d",$v['add_time']);
			
		}
		$_list['list'] = $list;
		if(is_array($list)&&!empty($list)){
		    echo ajaxmsg($_list);
		}else echo ajaxmsg("暂无投标记录",0);
	}
	
	
	
	public function ajax_invest(){
		
        $jsoncode = file_get_contents("php://input");
		//alogsm("ajax_invest",0,1,session("u_id").$jsoncode);
		if(!$this->uid) {
			ajaxmsg("请先登录",0);
			exit;
		}
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("查询错误！",0);
		}
		if (!is_array($arr)||empty($arr)||empty($arr['id'])||!in_array($arr['type'],array(3,4,5,6,7))) {
		   ajaxmsg("查询错误！",0);
		}
		


		$pre = C('DB_PREFIX');
		$id=intval($arr['id']);
		//$id=23;
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$field = "id,borrow_uid,borrow_money,borrow_status,borrow_type,has_borrow,has_vouch,borrow_interest_rate,borrow_duration,repayment_type,collect_time,borrow_min,borrow_max,password,borrow_use,money_collect";
		$vo = M('borrow_info')->field($field)->find($id);
		if($this->uid == $vo['borrow_uid']) ajaxmsg("不能去投自己的标",0);
		if($vo['borrow_status'] <> 2) ajaxmsg("只能投正在借款中的标",0);
	
		
		$vo['need'] = $vo['borrow_money'] - $vo['has_borrow'];
		if($vo['need']<0){
			ajaxmsg("投标金额不能超出借款剩余金额",0);
		}
		$vo['lefttime'] =$vo['collect_time'] - time();
		$vo['progress'] = getFloatValue($vo['has_borrow']/$vo['borrow_money']*100,4);//ceil($vo['has_borrow']/$vo['borrow_money']*100);
		$vo['uname'] = M("members")->getFieldById($vo['borrow_uid'],'user_name');
		$time1 = microtime(true)*1000;
		$vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
		$amoney = $vm['account_money']+$vm['back_money'];
		
		////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
		if($binfo['money_collect']>0){
			if($vm['money_collect']<$binfo['money_collect']) {
				ajaxmsg("此标设置有投标待收金额限制，您账户里必须有足够的待收才能投此标",0);
			}
		}
		////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
		
		////////////////////投标时自动填写可投标金额在投标文本框 2013-07-03 fan////////////////////////
		
		if($amoney<floatval($vo['borrow_min'])){
			ajaxmsg("您的账户可用余额小于本标的最小投标金额限制，不能投标！",0);
		}elseif($amoney>=floatval($vo['borrow_max']) && floatval($vo['borrow_max'])>0){
			$toubiao = intval($vo['borrow_max']);
		}else if($amoney>=floatval($vo['need'])){
			$toubiao = intval($vo['need']);
		}else{
			$toubiao = floor($amoney);
		}
		$vo['toubiao'] =$toubiao;
		////////////////////投标时自动填写可投标金额在投标文本框 2013-07-03 fan////////////////////////
		$pin_pass = $vm['pin_pass'];
		$has_pin = (empty($pin_pass))?"no":"yes";
        $data['type'] = $arr['type'];
		$data['id'] = $id;
		$data['has_pin'] = $has_pin=='yes'?1:0;
		$data['borrow_min'] = $vo['borrow_min'];
		$data['borrow_max'] = $vo['borrow_max']=="0"?"无":"{$vo['borrow_max']}";
		$data['need'] = $vo['need'];
		$data['toubiao'] = $vo['toubiao'];
		$data['password'] = empty($vo['password'])?0:1;;
		$data['account_money'] = $amoney;
		
		
		ajaxmsg($data);
	}
	

	public function investcheck(){
		$jsoncode = file_get_contents("php://input");
		//alogsm("investcheck",0,1,session("u_id").$jsoncode);
		if(!$this->uid) {
			ajaxmsg('请先登录',0);
			exit;
		}
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (!is_array($arr)||empty($arr)||empty($arr['borrow_id'])||!in_array($arr['type'],array(3,4,5,6,7))) {
		   ajaxmsg("查询错误1！",0);
		}
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("查询错误2！",0);
		}
		$pre = C('DB_PREFIX');
		$_pin = $arr['pin'];
		$borrow_id = intval($arr['borrow_id']);
		$money = intval($arr['money']);
		//$_pin = "123456";
//		$borrow_id = 23;
//		$money = 100;
        $pin = md5($_pin);
		$borrow_pass = $arr['borrow_pass'];
		$vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
		$amoney = $vm['account_money']+$vm['back_money'];
		$uname = session('u_user_name');
		$pin_pass = $vm['pin_pass'];
		$amoney = floatval($amoney);
		
		$binfo = M("borrow_info")->field('borrow_money,has_borrow,has_vouch,borrow_max,borrow_min,borrow_type,password,money_collect')->find($borrow_id);
		//if($binfo['has_vouch']<$binfo['borrow_money'] && $binfo['borrow_type'] == 2) ajaxmsg("此标担保还未完成，您可以担保此标或者等担保完成再投标",3);
		if(!empty($binfo['password'])){
			if(empty($borrow_pass)) ajaxmsg("此标是定向标，必须验证投标密码",3);
			else if($binfo['password']<>md5($borrow_pass)) ajaxmsg("投标密码不正确",3);
		}
		////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
		if($binfo['money_collect']>0){
			if($vm['money_collect']<$binfo['money_collect']) {
				ajaxmsg("此标设置有投标待收金额限制，您账户里必须有足够的待收才能投此标",3);
			}
		}
		////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
		//投标总数检测
		$capital = M('borrow_investor')->where("borrow_id={$borrow_id} AND investor_uid={$this->uid}")->sum('investor_capital');
		if(($capital+$money)>$binfo['borrow_max']&&$binfo['borrow_max']>0){
			$xtee = $binfo['borrow_max'] - $capital;
			ajaxmsg("您已投标{$capital}元，此投上限为{$binfo['borrow_max']}元，你最多只能再投{$xtee}",3);
		}
		
		$need = $binfo['borrow_money'] - $binfo['has_borrow'];
		$caninvest = $need - $binfo['borrow_min'];
		if( $money>$caninvest && ($need-$money)<>0 ){
			$msg = "尊敬的{$uname}，此标还差{$need}元满标,如果您投标{$money}元，将导致最后一次投标最多只能投".($need-$money)."元，小于最小投标金额{$binfo['borrow_min']}元，所以您本次可以选择<font color='#fc8936'>满标</font>或者投标金额必须<font color='#fc8936'>小于等于{$caninvest}元</font>";
			if($caninvest<$binfo['borrow_min']) $msg = "尊敬的{$uname}，此标还差{$need}元满标,如果您投标{$money}元，将导致最后一次投标最多只能投".($need-$money)."元，小于最小投标金额{$binfo['borrow_min']}元，所以您本次可以选择<font color='#fc8936'>满标</font>即投标金额必须<font color='#fc8936'>等于{$need}元</font>";

			ajaxmsg($msg,3);
		}
		
		if(($need-$money)<0 ){
			$this->error("尊敬的{$uname}，此标还差{$need}元满标,您最多只能再投{$need}元",3);
		}
		
		if($pin<>$pin_pass) ajaxmsg("支付密码错误，请重试!",0);
		if($money>$amoney){
			$msg = "尊敬的{$uname}，您准备投标{$money}元，但您的账户可用余额为{$amoney}元，请先去充值!";
			ajaxmsg($msg,2);
		}else{
			$msg = "尊敬的{$uname}，您的账户可用余额为{$amoney}元，您确认投标{$money}元吗？";
			
			$_msg['type'] = 1;
			$_msg['id'] = $borrow_id;
			$_msg['message'] = $msg;
			ajaxmsg($_msg,1);
		}
	}
	
	
	public function investmoney(){
		$jsoncode = file_get_contents("php://input");
		//alogsm("investmoney",0,1,session("u_id").$jsoncode);
		if(!$this->uid) {
			ajaxmsg('请先登录',0);
			exit;
		}
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("查询错误！",0);
		}
		if (!is_array($arr)||empty($arr)||empty($arr['pin'])||empty($arr['borrow_id'])||empty($arr['money'])||!in_array($arr['type'],array(3,4,5,6,7))) {
		   ajaxmsg("查询错误！",0);
		}
		
		$pre = C('DB_PREFIX');
		$_pin = $arr['pin'];
		$pin = md5($_pin);
		$borrow_id = intval($arr['borrow_id']);
		$money = intval($arr['money']);
//		$_pin = "123456";
//		$pin = md5($_pin);
//		$borrow_id = 23;
//		$money = 60;
//		
		$borrow_pass = $arr['borrow_pass'];
				
		$m = M("member_money")->field('account_money,back_money,money_collect')->find($this->uid);
		$amoney = $m['account_money']+$m['back_money'];
		$uname = session('u_user_name');
		if($amoney<$money) ajaxmsg("尊敬的{$uname}，您准备投标{$money}元，但您的账户可用余额为{$amoney}元，请先去充值再投标.",3);
		
		$vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
		$pin_pass = $vm['pin_pass'];
		
		if($pin<>$pin_pass) ajaxmsg("支付密码错误，请重试",2);

		$binfo = M("borrow_info")->field('borrow_money,borrow_max,has_borrow,has_vouch,borrow_type,borrow_min,money_collect')->find($borrow_id);
		
		////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
		if($binfo['money_collect']>0){
			if($m['money_collect']<$binfo['money_collect']) {
				ajaxmsg("此标设置有投标待收金额限制，您账户里必须有足够的待收才能投此标",3);
			}
		}
		////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
		
		//投标总数检测
		$capital = M('borrow_investor')->where("borrow_id={$borrow_id} AND investor_uid={$this->uid}")->sum('investor_capital');
		if(($capital+$money)>$binfo['borrow_max']&&$binfo['borrow_max']>0){
			$xtee = $binfo['borrow_max'] - $capital;
			ajaxmsg("您已投标{$capital}元，此投上限为{$binfo['borrow_max']}元，你最多只能再投{$xtee}",3);
		}
		//if($binfo['has_vouch']<$binfo['borrow_money'] && $binfo['borrow_type'] == 2) $this->error("此标担保还未完成，您可以担保此标或者等担保完成再投标");
		$need = $binfo['borrow_money'] - $binfo['has_borrow'];
		$caninvest = $need - $binfo['borrow_min'];
		if( $money>$caninvest && ($need-$money)<>0 ){
			$msg = "尊敬的{$uname}，此标还差{$need}元满标,如果您投标{$money}元，将导致最后一次投标最多只能投".($need-$money)."元，小于最小投标金额{$binfo['borrow_min']}元，所以您本次可以选择<font color='#fc8936'>满标</font>或者投标金额必须<font color='#fc8936'>小于等于{$caninvest}元</font>";
			if($caninvest<$binfo['borrow_min']) $msg = "尊敬的{$uname}，此标还差{$need}元满标,如果您投标{$money}元，将导致最后一次投标最多只能投".($need-$money)."元，小于最小投标金额{$binfo['borrow_min']}元，所以您本次可以选择<font color='#fc8936'>满标</font>即投标金额必须<font color='#fc8936'>等于{$need}元</font>";

			ajaxmsg($msg,3);
		}
		if(($need-$money)<0 ){
			ajaxmsg("尊敬的{$uname}，此标还差{$need}元满标,您最多只能再投{$need}元",3);
		}else{
			$done = investMoney($this->uid,$borrow_id,$money);
		}
		if($done===true) {
			$_msg['type'] = $arr['type'];
			$_msg['id'] = $borrow_id;
			$_msg['message'] = "恭喜成功投标{$money}元";
			ajaxmsg($_msg,1);
			
		}else if($done){
			ajaxmsg($done,3);
		}else{
			ajaxmsg("对不起，投标失败，请重试!",3);
		}
	}
	
	public function tdetail(){
		
        $jsoncode = file_get_contents("php://input");
		//alogsm("tdetail",0,1,session("u_id").$jsoncode);
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (!is_array($arr)||empty($arr)||empty($arr['id'])||$arr['type']!=2) {
		   ajaxmsg("查询错误！",0);
		}

		$pre = C('DB_PREFIX');
		$id = intval($arr['id']);
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$borrowinfo = M("transfer_borrow_info b")->join("{$pre}transfer_detail d ON d.borrow_id=b.id")->field(true)->find($id);
		$borrowinfo['progress'] = getfloatvalue($borrowinfo['transfer_out']/$borrowinfo['transfer_total'] * 100, 2);
		$borrowinfo['need'] = getfloatvalue(($borrowinfo['transfer_total'] - $borrowinfo['transfer_out'])*$borrowinfo['per_transfer'], 2 );
		$borrowinfo['updata'] = unserialize($borrowinfo['updata']);
		$list['id'] = $id;
		$list['type'] = 2;
		$list['borrow_name'] = $borrowinfo['borrow_name'];
		$list['borrow_interest_rate'] = $borrowinfo['borrow_interest_rate'];
		$list['borrow_money'] = $borrowinfo['borrow_money'];
		$list['transfer_out'] = $borrowinfo['transfer_out'];
		$list['per_transfer'] = $borrowinfo['per_transfer'];
		$list['borrow_duration'] = $borrowinfo['borrow_duration']."个月";
		$list['progress'] = $borrowinfo['progress'];
		$list['borrow_max'] = $borrowinfo['borrow_max'];
		$list['transfer_total'] = $borrowinfo['transfer_total'];
		$list['transfer_leave'] = $borrowinfo['transfer_total']-$borrowinfo['transfer_out'];
		$list['transfer_back'] = $borrowinfo['transfer_back'];
		$list['borrow_breif'] = $borrowinfo['borrow_breif'];
		$list['reward'] = $borrowinfo['reward_rate']."%";
		$list['min_month'] = $borrowinfo['min_month'];
		$list['huankuan_type'] = "一次性还款";
		$minfo = M("members")->where("id={$borrowinfo['borrow_uid']}")->find();
		$list['user_name'] = $minfo['user_name'];
		$list['imgpath'] = get_avatar($borrowinfo['borrow_uid']);
		$list['addtime'] = date("Y-m-d",$borrowinfo['add_time']);
		ajaxmsg($list);
		
    }
	
		public function tajax_invest()	{
				
        $jsoncode = file_get_contents("php://input");
		if(!$this->uid) {
			ajaxmsg("请先登录",0);
			exit;
		}
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("查询错误！",0);
		}
		if (!is_array($arr)||empty($arr)||empty($arr['borrow_id'])||$arr['type']!=2) {
		   ajaxmsg("查询错误！",0);
		}
		$pre = c( "DB_PREFIX" );
		$id = intval( $arr['borrow_id'] );
		$Bconfig = require( C("APP_ROOT" )."Conf/borrow_config.php" );
		$field = "id,borrow_uid,borrow_money,borrow_interest_rate,borrow_duration,repayment_type,transfer_out,transfer_back,transfer_total,per_transfer,is_show,deadline,min_month,increase_rate,reward_rate";
		$vo = M("transfer_borrow_info" )->field($field)->find($id);
		if ($this->uid == $vo['borrow_uid'])
		{
			ajaxmsg("不能息投自己的标", 0);
		}
		if ($vo['transfer_out'] == $vo['transfer_total'])
		{
			ajaxmsg( "此标可认购份数为0", 0 );
		}
		if ($vo['is_show'] == 0)
		{
			ajaxmsg( "只能投正在借款中的标", 0 );
		}
		$vo['transfer_leve'] = $vo['transfer_total'] - $vo['transfer_out'];
		$vo['uname'] = M("members")->getFieldById($vo['borrow_uid'], "user_name");
		$vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
		$amoney = $vm['account_money']+$vm['back_money'];
		$pin_pass = $vm['pin_pass'];
		$has_pin = empty( $pin_pass ) ? 0 : 1;
		$rate = $vo['borrow_interest_rate'];
		$list['type'] = 2;
		$list['id'] = $id;
		//$list['has_pin'] = $has_pin ;//是否设置支付密码
		$list['account_money'] = $amoney;//可用余额
		$list['min_month'] = $vo['min_month'];//最小认购期限
		$list['borrow_duration'] = $vo['borrow_duration'];//最大认购期限
		$list['transfer_leave'] = $vo['transfer_total']-$vo['transfer_out'];//剩余多少份
		$list['per'] = $vo['per_transfer'];//每份多少钱
		
		if($has_pin == 0){
		    ajaxmsg("投标前请先设置支付密码", 0);
		}
		
		ajaxmsg($list);
	}
	
	public function tinvestcheck()
	{
		$jsoncode = file_get_contents("php://input");
		//alogsm("tinvestcheck",0,1,session("u_id").$jsoncode);
		if(!$this->uid) {
			ajaxmsg('请先登录',0);
			exit;
		}
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("查询错误！",0);
		}
		if (!is_array($arr)||empty($arr)||empty($arr['borrow_id'])||empty($arr['pin'])||empty($arr['num'])||empty($arr['month'])||$arr['type']!=2) {
		   ajaxmsg("查询错误！",0);
		}

		
		
		$pre = C("DB_PREFIX");
		
        $_pin = $arr['pin'];
		$_borrow_id = $arr['borrow_id'];
		$_tnum = $arr['num'];
		$_month = $arr['month'];
		$pin = md5($_pin);
		$borrow_id = intval($_borrow_id);
		$tnum = intval($_tnum);
		$month = intval($_month);
		$m = M("member_money")->field('account_money,back_money,money_collect')->find($this->uid);
		$amoney = $m['account_money']+$m['back_money'];
		$uname = session("u_user_name");
		$vm = getMinfo($this->uid,"m.pin_pass");
		$pin_pass = $vm['pin_pass'];
		$amoney = floatval($amoney);
		$binfo = M("transfer_borrow_info")->field( "transfer_out,transfer_back,transfer_total,per_transfer,is_show,deadline,min_month,increase_rate,reward_rate,borrow_duration")->find($borrow_id);
		$max_month = $binfo['borrow_duration'];//getTransferLeftmonth($binfo['deadline']);
		$min_month = $binfo['min_month'];
		$max_num = $binfo['transfer_total'] - $binfo['transfer_out'];
		if($tnum<1){
			ajaxmsg("购买份数必须大于等于1份！", 3);
		}
		if($month < $min_month || $max_month < $month)
		{
			ajaxmsg("本标认购期限只能在'".$min_month."个月---".$max_month."个月'之间", 3);
		}
		if ($max_num < $tnum)
		{
			ajaxmsg( "本标还能认购最大份数为".$max_num."份，请重新输入认购份数", 3 );
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
			$_msg['type'] = 2;
			$_msg['id'] = $borrow_id;
			$_msg['message'] = $msg;
			ajaxmsg($_msg, 1);
		}
	}
	
	public function tinvestmoney()
	{
		$jsoncode = file_get_contents("php://input");
		//alogsm("tinvestmoney",0,1,session("u_id").$jsoncode);
		if(!$this->uid) {
			ajaxmsg('请先登录',0);
			exit;
		}
		$arr = array();
		$arr = json_decode($jsoncode,true);
		if (intval($arr['uid'])!=$this->uid){
			ajaxmsg("查询错误！",0);
		}
		if (!is_array($arr)||empty($arr)||empty($arr['borrow_id'])||empty($arr['pin'])||empty($arr['num'])||empty($arr['month'])||$arr['type']!=2) {
		   ajaxmsg("查询错误！",0);
		}

		
        $_pin = $arr['pin'];
		$_borrow_id = $arr['borrow_id'];
		$_tnum = $arr['num'];
		$_month = $arr['month'];
		$borrow_id = intval($_borrow_id);
		$tnum = intval($_tnum);
		$month = intval($_month);
		$m = M("member_money")->field('account_money,back_money,money_collect')->find($this->uid);
		$amoney = $m['account_money']+$m['back_money'];
		$uname = session("u_user_name");
		$binfo = M("transfer_borrow_info")->field( "borrow_uid,borrow_interest_rate,transfer_out,transfer_back,transfer_total,per_transfer,is_show,deadline,min_month,increase_rate,reward_rate,borrow_duration")->find($borrow_id);
		
		if($this->uid == $binfo['borrow_uid']) ajaxmsg("不能去投自己的标",0);
		$max_month = $binfo['borrow_duration'];//getTransferLeftmonth($binfo['deadline']);
		$min_month = $binfo['min_month'];
		$max_num = $binfo['transfer_total'] - $binfo['transfer_out'];
		if($tnum<1){
			ajaxmsg("购买份数必须大于等于1份！", 3);
		}
		if($month < $min_month || $max_month < $month){
			ajaxmsg( "本标认购期限只能在'".$min_month."个月---".$max_month."个月'之间",3);
		}
		if($max_num < $tnum){
			ajaxmsg( "本标还能认购最大份数为".$max_num."份，请重新输入认购份数",3);
			
		}
		$money = $binfo['per_transfer'] * $tnum;
		if($amoney < $money){
			ajaxmsg( "尊敬的{$uname}，您准备认购{$money}元，但您的账户可用余额为{$amoney}元，请先去充值再认购.",__APP__."/member/charge#fragment-1",2);
			
		}
		$vm = getMinfo($this->uid,"m.pin_pass,mm.invest_vouch_cuse,mm.money_collect");
		$pin_pass = $vm['pin_pass'];
		$pin = md5($_pin);
		if ($pin != $pin_pass){
			ajaxmsg( "支付密码错误，请重试",0);
			
		}
		$done = TinvestMoney($this->uid,$borrow_id,$tnum,$month);//投企业直投
		if($done === true){
			
			$_msg['type'] = 2;
			$_msg['id'] = $borrow_id;
			$_msg['message'] = "恭喜成功认购{$tnum}份,共计{$money}元";
			ajaxmsg($_msg,1);
			
		}else if($done){
			ajaxmsg($done,3);
		}else{
			ajaxmsg("对不起，认购失败，请重试!",3);
			
		}
	}
	
	public function gg_list() {

       $id = M('article_category')->where("type_name = '网站公告'")->getField('id');
       $list=M('article')->where("type_id = {$id} ")->order('id desc')->limit('10')->select();

	   foreach ($list as $key=>$v){
		 $_list[$key]['id'] = $v['id'];
	     $_list[$key]['title'] = $v['title'];
	     $_list[$key]['art_time'] = date("Y-m-d",$v['art_time']);
	   }
	   $m_list['list']= $_list;
	   ajaxmsg($m_list);
		
	}
	public function gg_list_add() {
	   
	   $jsoncode = file_get_contents("php://input"); 
	   $arr = array();
	   $arr = json_decode($jsoncode,true);
//	   $arr['gtype'] = 0;
//	   $arr['num'] = 4;
//	   $arr['id'] = 98;
	   if(is_array($arr) && !empty($arr['id']) && isset($arr['gtype']) && !empty($arr['num'])){
	       $gtype = $arr['gtype'];
		   $id = intval($arr['id']);
		   $num = intval($arr['num']);
	   }else{
	       $gtype = 2;
		   $num = 3;
	   }
       $listid = M('article_category')->where("type_name = '网站公告'")->getField('id');
	   if($gtype == 1){  //往大查询
           $list=M('article')->where("type_id = {$listid} and id > {$id} ")->order('id asc')->limit("{$num}")->select();
	   }elseif($gtype == 0){  //往小查询
	       $list=M('article')->where("type_id = {$listid} and id < {$id} ")->order('id desc')->limit("{$num}")->select();
	   }elseif($gtype == 2){  //
	       $list=M('article')->where("type_id = {$listid} ")->order('id desc')->limit("{$num}")->select();
	   }
	   
	   
	   foreach ($list as $key=>$v){
		 $_list[$key]['id'] = $v['id'];
	     $_list[$key]['title'] = $v['title'];
	     $_list[$key]['art_time'] = date("Y-m-d",$v['art_time']);
		 
	   }
	   $m_list['list']= $_list;
	   if(is_array($m_list['list'])){
	       ajaxmsg($m_list);
	   }else{
	       ajaxmsg();
	   }
		
	}
	public function gg_show() {
	   //$id = 100;
		$jsoncode = file_get_contents("php://input");
		//alogsm("gg_show",0,1,$jsoncode);
		
		$arr = array();
		$arr = json_decode($jsoncode,true);
//		if (!is_array($arr)||empty($arr)||empty($arr['id'])) {
//		   ajaxmsg("查询错误！",0);
//		}
        $id = $arr["id"];
        $content=M('article')->find($id);
		$_content['id'] = $content['id'];
		$_content['title'] = $content['title'];
		$_content['art_time'] = date("Y-m-d H:i",$content['art_time']);
		$_content['art_content'] = $content['art_content'];
        ajaxmsg($_content);
		
		
	}
	//检测是否可以更新新版本
	public function version(){
		$jsoncode = file_get_contents("php://input");
		//alogsm("version",0,1,$jsoncode);
		$arr = array();
		$arr = json_decode($jsoncode,true);
		$datag = FS("Dynamic/msgconfig");//get_global_setting();
		$newversion = $datag['baidu']['apkVersion'];
		if(is_array($arr)&&(!empty($arr))&&(!empty($arr['version']))&&((float)$arr['version'])<((float)$newversion)){
		    $content['path'] = $datag['baidu']['apkPath'];
			ajaxmsg($content,0);
		}else{
		    ajaxmsg();
		}
		
	}
} 