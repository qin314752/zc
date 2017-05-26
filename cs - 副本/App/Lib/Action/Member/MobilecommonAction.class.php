<?php
class MobilecommonAction extends MMCommonAction {
    var $notneedlogin=true;


	public function login(){
		$name = $_POST['name'];
		$password = $_POST['password'];
		//$android['password']=$password;
		//$android['android']=$name;
        //$suoid = M("android")->add($android);
		$content = array();
		$content['name']= $name;
		$content['password']= $password;
		echo json_encode($content);
    }
	
	//登录
	public function actlogin(){
		//setcookie('LoginCookie','',time()-10*60,"/");
		
		//if($_SESSION['verify'] != md5(strtolower($_POST['sVerCode']))) 
		//{
		//	ajaxmsg("验证码错误!",0);
		//}
		$jsoncode = file_get_contents("php://input");
		//alogsm("android_login",0,1,session("u_id").$jsoncode);
//		$arr2 = array();
//	    $arr2['type'] = 'actlogin';
//		
//	    $arr2['tstatus'] = '1';
//		$arr2['deal_time'] = time();
//	    $arr2['deal_info'] = $jsoncode;
//	    $newid = M("auser_dologs")->add($arr2);
		$arr = array();
		$arr = json_decode($jsoncode,true);
		(false!==strpos($arr['sUserName'],"@"))?$data['user_email'] = text($arr['sUserName']):$data['user_name'] = text($arr['sUserName']);
		$vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where($data)->find();
		if($vo['is_ban']==1) ajaxmsg("dd您的帐户已被冻结，请联系客服处理！",0);
		if(is_array($vo)){
				
			if($vo['user_pass'] == md5($arr['sPassword']) ){//本站登录成功
				
				$this->_memberlogin($vo['id']);
				//alogs("login",'','1',session("u_id")."登录成功");
				$arr2 = array();
	            $arr2['type'] = 'actlogin';
				$arr2['deal_user'] = $vo['user_name'];
	            $arr2['tstatus'] = '1';
				$arr2['deal_time'] = time();
	            $arr2['deal_info'] = $vo['user_name']."登录成功_".$jsoncode;
	            $newid = M("auser_dologs")->add($arr2);
				
				$mess = array();
			    $mess['uid'] = intval(session("u_id"));
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
			}else{//本站登录不成功
//			    $arr2 = array();
//	            $arr2['type'] = 'actlogin';
//				$arr2['deal_user'] = $vo['user_name'];
//	            $arr2['tstatus'] = '1';
//				$arr2['deal_time'] = time();
//	            $arr2['deal_info'] = $vo['user_name']."登录密码错误，登录失败_".$jsoncode;
//	            $newid = M("auser_dologs")->add($arr2);
				
				ajaxmsg("kk用户名或者密码错误！",0);
			}

		}else {
//		        $arr2 = array();
//	            $arr2['type'] = 'actlogin';
//				
//	            $arr2['tstatus'] = '1';
//				$arr2['deal_time'] = time();
//	            $arr2['deal_info'] = "用户名或密码错误，登录失败_".$jsoncode;
//	            $newid = M("auser_dologs")->add($arr2);
				
				ajaxmsg("kk用户名或者密码错误！",0);
		}
	}
	
	//注册
	public function regaction(){
		
		$jsoncode = file_get_contents("php://input");
		
		$arr = array();
		
		$arr = json_decode($jsoncode,true);
		
		if (!is_array($arr)||empty($arr)) {
		  ajaxmsg("提交信息错误，请重试.",0);
		}
		if ($arr['name']==""||$arr['password']==""||$arr['email']=="") {
		  ajaxmsg("提交信息错误，请重试!",0);
		}
		
		
		$data['user_name'] = text($arr['name']);
		$data['user_pass'] = md5($arr['password']);
		$data['user_email'] = text($arr['email']);
		
		$count = M('members')->where("user_email = '{$data['user_email']}' OR user_name='{$data['user_name']}'")->count('id');
		if($count>0) {
//			$arr2 = array();
//	        $arr2['type'] = 'regaction(';
//			$arr2['deal_user'] = $data['user_name'];
//	        $arr2['tstatus'] = '1';
//			$arr2['deal_time'] = time();
//	        $arr2['deal_info'] = $data['user_name']."注册失败，用户名或者邮件已经有人使用_".$jsoncode;
//	        $newid = M("auser_dologs")->add($arr2);
			ajaxmsg("kk注册失败，用户名或者邮件已经有人使用" ,0);
		}
		
		
		$data['reg_time'] = time();
		$data['reg_ip'] = get_client_ip();
		$data['lastlog_time'] = time();
		$data['lastlog_ip'] = get_client_ip();
		if(session("tmp_invite_user"))  $data['recommend_id'] = session("tmp_invite_user");
		$newid = M('members')->add($data);
		
		if($newid){
			//session('u_id',$newid);
			//session('u_user_name',$data['user_name']);
			//memberMoneyLog($newid,1,$this->glo['award_reg'],"注册奖励");
//			$arr2 = array();
//	        $arr2['type'] = 'regaction(';
//			$arr2['deal_user'] = $data['user_name'];
//	        $arr2['tstatus'] = '1';
//			$arr2['deal_time'] = time();
//	        $arr2['deal_info'] = $data['user_name']."注册成功_".$jsoncode;
//	        $newid = M("auser_dologs")->add($arr2);
			
			Notice(1,$newid,array('email',$data['user_email']));
			//$msg = array('uid'=>$newid);
			$mess = array();
			$mess['uid'] = $newid;
			$mess['username'] = $data['user_name'];
			$mess['head'] = get_avatar($newid);
			$mess['total'] = 0;
			$mess['mayuse'] = 0;
			$mess['freeze'] = 0;
			$mess['collect'] = 0;
			ajaxmsg($mess);
			//ajaxmsg();
		}
		else  ajaxmsg("注册失败，请重试",0);
	}
	
	public function mactlogout(){
		$this->_memberloginout();
		ajaxmsg("注销成功");
		
	}
	
	
}