<?php
// 金糯米内核类库，2014-06-11_listam
class CommonAction extends MCommonAction {


	var $notneedlogin=true;
    public function index(){
		$this->display();
    }
	
    public function login(){
        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
		$loginconfig = FS("Dynamic/loginconfig");//判断快捷登录是否开启
		$this->assign("loginconfig",$loginconfig);
		$this->display();
    }

    public function getpwd(){
        $loginconfig = FS("Dynamic/loginconfig");//判断快捷登录是否开启
        $this->assign("loginconfig",$loginconfig);
        $this->display();
    }
	
    public function register(){
		$loginconfig = FS("Dynamic/loginconfig");//判断快捷登录是否开启
		$this->assign("loginconfig",$loginconfig);
		if($_GET['invite']){
			//$uidx = M('members')->getFieldByUserName(text($_GET['invite']),'id');
			//if($uidx>0) session("tmp_invite_user",$uidx);
			session("tmp_invite_user",$_GET['invite']);

		}
        $in = M("members")->field("user_name")->where("id={$_GET['invite']}")->find();
        $this->assign("in",$in['user_name']);
        $this->assign("invite",$_GET['invite']);
		$this->display();
    }
	
	private function actlogin_bak(){
		(false!==strpos($_POST['sUserName'],"@"))?$data['user_email'] = text($_POST['sUserName']):$data['user_name'] = text($_POST['sUserName']);
		$vo = M('members')->field('id,user_name,user_email,user_pass')->where($data)->find();
		if($vo){
			$this->_memberlogin($vo['id']);
			ajaxmsg();
		}else{
			ajaxmsg("用户名不存在",0);	
		}
	}
	
	
	public function actlogin(){
		setcookie('LoginCookie','',time()-10*60,"/");
		//uc登录
		
		$loginconfig = FS("Dynamic/loginconfig");
		$uc_mcfg  = $loginconfig['uc'];
		if($uc_mcfg['enable']==1){
			require_once C('APP_ROOT')."Lib/Uc/config.inc.php";
			require C('APP_ROOT')."Lib/Uc/uc_client/client.php";
		}
		
		//uc登录
		if($_SESSION['verify'] != md5(strtolower($_POST['sVerCode']))) 
		{
			ajaxmsg("验证码错误!",0);
		}

        if (preg_match("/^1[34578]\d{9}$/", text($_POST['sUserName']))) {
            $data['user_phone'] = text($_POST['sUserName']);
        } else {
            (false !== strpos($_POST['sUserName'], "@")) ? $data['user_email'] = text($_POST['sUserName']) : $data['user_name'] = text($_POST['sUserName']);
        }
        $vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where($data)->find();
		if($vo['is_ban']==1) ajaxmsg("您的帐户已被冻结，请联系客服处理！",0);
		if(!is_array($vo)){
			//本站登录不成功，偿试uc登录及注册本站
			if($uc_mcfg['enable']==1){
				list($uid, $username, $password, $email) = uc_user_login(text($_POST['sUserName']), text($_POST['sPassword']));
				if($uid > 0) {
					$regdata['txtUser'] = text($_POST['sUserName']);
					$regdata['txtPwd'] = text($_POST['sPassword']);
					$regdata['txtEmail'] = $email;
					$newuid = $this->ucreguser($regdata);
					if(is_numeric($newuid)&&$newuid>0){
						$logincookie = uc_user_synlogin($uid);//UC同步登录
						setcookie('LoginCookie',$logincookie,time()+10*60,"/");
						$this->_memberlogin($newuid);
						ajaxmsg();//登录成功
					}else{
						ajaxmsg($newuid,0);
					}
				}
			}
			//本站登录不成功，偿试uc登录及注册本站
			ajaxmsg("用户名或者密码错误！",0);
		}else{
			       
			if($vo['user_pass'] == md5($_POST['sPassword']) ){//本站登录成功，uc登录及注册UC
				//uc登录及注册UC
				if($uc_mcfg['enable']==1){
					$dataUC = uc_get_user($vo['user_name']);
					if($dataUC[0] > 0) {
						$logincookie = uc_user_synlogin($dataUC[0]);//UC同步登录
						setcookie('LoginCookie',$logincookie,time()+10*60,"/");
					}else{
						$uid = uc_user_register($vo['user_name'], $_POST['sPassword'], $vo['user_email']);
						if($uid>0){
							$logincookie = uc_user_synlogin($dataUC[0]);//UC同步登录
							setcookie('LoginCookie',$logincookie,time()+10*60,"/");
						}
					}
				}
				//uc登录及注册UC
				$this->_memberlogin($vo['id']);
               crowd_donate_money($vo['id']);
				ajaxmsg();
			}else{//本站登录不成功
				ajaxmsg("用户名或者密码错误！",0);
			}

		}
	}
	
	public function actlogout(){
		$this->_memberloginout();
		//uc登录
		$loginconfig = FS("Dynamic/loginconfig");
		$uc_mcfg  = $loginconfig['uc'];
		if($uc_mcfg['enable']==1){
			require_once C('APP_ROOT')."Lib/Uc/config.inc.php";
			require C('APP_ROOT')."Lib/Uc/uc_client/client.php";
			$logout = uc_user_synlogout();
		}
		//uc登录
		$this->assign("uclogout",de_xie($logout));
		$this->success("注销成功",__APP__."/");
	}
	
	private function ucreguser($reg){
		$data['user_name'] = text($reg['txtUser']);
		$data['user_pass'] = md5($reg['txtPwd']);
		$data['user_email'] = text($reg['txtEmail']);
		$count = M('members')->where("user_email = '{$data['user_email']}' OR user_name='{$data['user_name']}'")->count('id');
		if($count>0) return "登录失败,UC用户名冲突,用户名或者邮件已经有人使用";
		$data['reg_time'] = time();
		$data['reg_ip'] = get_client_ip();
		$data['last_log_time'] = time();
		$data['last_log_ip'] = get_client_ip();
		$newid = M('members')->add($data);
		
		if($newid){
			session('u_id',$newid);
			session('u_user_name',$data['user_name']);
			return $newid;
		}
		return "登录失败,UC用户名冲突";
	}
	
	public function regtemp(){
        session('phone_temp', text($_POST['txtPhone']));
//        session('name_temp', text($_POST['txtUser']));
        session('pwd_temp', md5($_POST['txtPwd']));
        session('code_temp', $_POST['Pcode']);
        session('rec_temp', text($_POST['txtRec']));
		ajaxmsg();
	}
    public function regaction() {
//        $data['user_email'] = session('email_temp2');
        $data['user_phone'] = text($_POST['txtPhone']);
        $data['user_name'] = text($_POST['txtPhone']);
        $data['user_pass'] = md5($_POST['txtPwd']);
        if(session("tmp_invite_user")==""){
            if($_POST["spread"]!=""){
                $info = M("members")->where("user_name = {$_POST["spread"]}")->find();
                if($info["id"]==""){
                    $infop = M("members")->where("user_phone = {$_POST["spread"]}")->find();
                    $data['recommend_id'] = $infop["id"];
                    $data['recommend_time'] = time();
                }else{
                    $data['recommend_id'] = $info["id"];
                    $data['recommend_time'] = time();
                }
            }
        }else{
            $data['recommend_id'] = session("tmp_invite_user");
            $data['recommend_time'] = time();
        }


//        $_POST['Pcode'];
//        if (session('temp_phone')) {
//            $data['user_phone'] = session('temp_phone');
//        }
        if (session('code_temp') != $_POST['Pcode']) {
            ajaxmsg('非法提交', 0);
        }

        //uc注册
//        $loginconfig = FS("Dynamic/loginconfig");
//        $uc_mcfg = $loginconfig['uc'];
//        if ($uc_mcfg['enable'] == 1) {
//            require_once C('APP_ROOT') . "Lib/Uc/config.inc.php";
//            require C('APP_ROOT') . "Lib/Uc/uc_client/client.php";
//            $uid = uc_user_register($data['user_name'], $_POST['txtPwd'], $data['user_email']);
//            if ($uid <= 0) {
//                if ($uid == -1) {
//                    ajaxmsg('用户名不合法', 0);
//                } elseif ($uid == -2) {
//                    ajaxmsg('包含不允许注册的词语', 0);
//                } elseif ($uid == -3) {
//                    ajaxmsg('用户名已经存在', 0);
//                } elseif ($uid == -4) {
//                    ajaxmsg('Email 格式有误', 0);
//                } elseif ($uid == -5) {
//                    ajaxmsg('Email 不允许注册', 0);
//                } elseif ($uid == -6) {
//                    ajaxmsg('该 Email 已经被注册', 0);
//                } else {
//                    ajaxmsg('未定义', 0);
//                }
//            }
//        }
        //uc注册

        $data['reg_time'] = time();
        $data['reg_ip'] = get_client_ip();
        $data['last_log_time'] = time();
        $data['last_log_ip'] = get_client_ip();
        //$global = get_global_setting();
        //$data['reward_money'] = $global['reg_reward'];//新注册用户奖励

//        if (session("tmp_invite_user")) {
//            $data['recommend_id'] = session("tmp_invite_user");
//        } else if (session('rec_temp')) {
//            $Rectemp = session('rec_temp');
//            $Retemp1 = M('members')->field("id")->where("user_name = '{$Rectemp}'")->find();
//            if ($Retemp1['id'] > 0) {
//                $data['recommend_id'] = $Retemp1['id']; //推荐人为投资人
//            }
//        }

//        if($data['user_email']==null){
//            $data['user_email']='';
//        }
        $newid = M('members')->add($data);
        
        if ($newid) {
            crowd_donate_money($newid);
            $updata['cell_phone'] = text($_POST['txtPhone']);
            $b = M('member_info')->where("uid = {$newid}")->count('uid');
            if ($b == 1) {
                M("member_info")->where("uid={$newid}")->save($updata);
            } else {
                $updata['uid'] = $newid;
                $updata['cell_phone'] = text($_POST['txtPhone']);
                $updata['email_status'] = 0;
                M('member_info')->add($updata);
            }
            session('u_id', $newid);
            session('u_user_name', $data['user_name']);
            $updata['phone_status'] =1;
            $updata['uid'] = $newid;
            M('members_status')->add($updata);
            ajaxmsg('success', 1);
        }else{
            ajaxmsg('注册失败，请重试', 0);
        }
    }

    public function ckphone(){
        $data['user_phone'] = text($_POST['Email']);
        $count = M('members')->where($data)->count('id');
        if ($count==1) {
            $json['status'] = 0;
            exit(json_encode($json));
        } else {
            $json['status'] = 1;
            exit(json_encode($json));
        }

    }

	public function sendphone() {
        if($_POST['code'] == ''){
            ajaxmsg("请先填写图形验证码",4);
        }
	
        if(md5($_POST['code'])!=$_SESSION['verify']){
                ajaxmsg("图形验证码不正确",3);
        }
		
        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $phone = text($_POST['cellphone']);
        $xuid = M('members')->getFieldByUserPhone($phone, 'id');
        if ($xuid > 0 && $xuid <> $this->uid)
            ajaxmsg("", 2);

        $code = rand_string_reg(6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];

        if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
            $res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
			//jaxmsg("", $phone);
        } else { // 否则，则由后台管理员来手动审核手机验证
            $res = true;
            $phonestatus = M('members_status')->getFieldByUid($this->uid, 'phone_status');
            if ($phonestatus == 1)
                ajaxmsg("手机已经通过验证", 1);
            $updata['phone_status'] = 3; //待审核
            $updata1['user_phone'] = $phone;
            $a = M('members')->where("id = {$this->uid}")->count('id');
            if ($a == 1)
                $newid = M("members")->where("id={$this->uid}")->save($updata1);
            else {
                M('members')->where("id={$this->uid}")->setField('user_phone', $phone);
            }

            $updata2['cell_phone'] = $phone;
            $b = M('member_info')->where("uid = {$this->uid}")->count('uid');
            if ($b == 1)
                $newid = M("member_info")->where("uid={$this->uid}")->save($updata2);
            else {
                $updata2['uid'] = $this->uid;
                $updata2['cell_phone'] = $phone;
                M('member_info')->add($updata2);
            }
            $c = M('members_status')->where("uid = {$this->uid}")->count('uid');
            if ($c == 1)
                $newid = M("members_status")->where("uid={$this->uid}")->save($updata);
            else {
                $updata['uid'] = $this->uid;
                $newid = M('members_status')->add($updata);
            }
            if ($newid) {
                ajaxmsg();
            } else
                ajaxmsg("验证失败", 0);
            // ////////////////////////////////////////////////////////////
        }
        if ($res) {
            session("temp_phone", $phone);
            ajaxmsg();
        } else
            ajaxmsg("", 0);
    }
	public function sendphone3() {
        if($_POST['code'] == ''){
            ajaxmsg("请先填写图形验证码",4);
        }
	
        if(md5($_POST['code'])!=$_SESSION['verify']){
                ajaxmsg("图形验证码不正确",3);
        }
		
        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $phone = text($_POST['cellphone']);
        $xuid = M('members')->getFieldByUserPhone($phone, 'id');
        
        $code = rand_string_reg(6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];

        if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
			$_SESSION['pcode'] = $code;
            $res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
			//jaxmsg("", $phone);
        } else { // 否则，则由后台管理员来手动审核手机验证
            $res = true;
            $phonestatus = M('members_status')->getFieldByUid($this->uid, 'phone_status');
            if ($phonestatus == 1)
                ajaxmsg("手机已经通过验证", 1);
            $updata['phone_status'] = 3; //待审核
            $updata1['user_phone'] = $phone;
            $a = M('members')->where("id = {$this->uid}")->count('id');
            if ($a == 1)
                $newid = M("members")->where("id={$this->uid}")->save($updata1);
            else {
                M('members')->where("id={$this->uid}")->setField('user_phone', $phone);
            }

            $updata2['cell_phone'] = $phone;
            $b = M('member_info')->where("uid = {$this->uid}")->count('uid');
            if ($b == 1)
                $newid = M("member_info")->where("uid={$this->uid}")->save($updata2);
            else {
                $updata2['uid'] = $this->uid;
                $updata2['cell_phone'] = $phone;
                M('member_info')->add($updata2);
            }
            $c = M('members_status')->where("uid = {$this->uid}")->count('uid');
            if ($c == 1)
                $newid = M("members_status")->where("uid={$this->uid}")->save($updata);
            else {
                $updata['uid'] = $this->uid;
                $newid = M('members_status')->add($updata);
            }
            if ($newid) {
                ajaxmsg();
            } else
                ajaxmsg("验证失败", 0);
            // ////////////////////////////////////////////////////////////
        }
        if ($res) {
            session("temp_phone", $phone);
            ajaxmsg();
        } else
            ajaxmsg("", 0);
    }

	
	public function validatephone() {
		if (session('code_temp')==text($_POST['code'])) {
			$updata['phone_status'] = 1;
			if (!session("temp_phone")) {
				ajaxmsg("验证失败", 0);
			}
            $mid = $this->regaction();
			
			$newid = setMemberStatus($mid, 'phone', 1, 10, '手机');
			if ($newid) {
				ajaxmsg();
			} else{
				ajaxmsg("验证失败", 0);
			}
		} else {
//			$this->regaction();
			ajaxmsg("验证校验码不对，请重新输入！", 2);
		} 
	} 
	
	public function emailverify(){
		$code = text($_GET['vcode']);
		$uk = is_verify(0,$code,1,60*1000);
		if(false===$uk){
			$this->error("验证失败");
		}else{
			$this->assign("waitSecond",3);
            setMemberStatus($uk, 'email', 1, 9, '邮箱');  
			$this->success("验证成功",__APP__."/member");
		}
	}
	
	public function getpasswordverify(){
		$code = text($_GET['vcode']);
		$uk = is_verify(0,$code,7,60*1000);
		if(false===$uk){
			$this->error("验证失败");
		}else{
			session("temp_get_pass_uid",$uk);
			$this->display('getpass');
		}
	}
	
	public function setnewpass(){
		$d['content'] = $this->fetch();
		echo json_encode($d);
	}
	
	public function dosetnewpass(){
		$per = C('DB_PREFIX');
		$uid = session("temp_get_pass_uid");
		$oldpass = M("members")->getFieldById($uid,'user_pass');
		if($oldpass == md5($_POST['pass'])){
			$newid = true;
		}else{
			$newid = M()->execute("update {$per}members set `user_pass`='".md5($_POST['pass'])."' where id={$uid}");
		}
		
		if($newid){
			session("temp_get_pass_uid",NULL);
			ajaxmsg();
		}else{
			ajaxmsg('',0);
		}
	}
	
	
	public function ckuser(){
		$map['user_name'] = text($_POST['UserName']);
		$count = M('members')->where($map)->count('id');
        $atstr="@";
        $pos=strpos($_POST['UserName'],$atstr);
		if ($count>0) {
			$json['status'] = 0;
			exit(json_encode($json));
        } elseif($pos !== false){
            $json['status'] = 2;
            exit(json_encode($json));
        }else {
			$json['status'] = 1;
			exit(json_encode($json));
        }
	}
	
	public function ckemail(){
		$map['user_email'] = text($_POST['Email']);
		$count = M('members')->where($map)->count('id');
        
		if ($count>0) {
			$json['status'] = 0;
			exit(json_encode($json));
        } else {
			$json['status'] = 1;
			exit(json_encode($json));
        }
	}
    public function ckemail3(){
        (false!==strpos($_POST['u'],"@"))?$data['user_email'] = text($_POST['u']):$data['user_name'] = text($_POST['u']);
        $vo = M('members')->field('user_email')->where($data)->find();
        if(is_array($vo)){
            if(isset($vo['user_email'])&&$vo['user_email']!=''){
                $json['email'] = $vo['user_email'];
                $json['status'] = 1;
                exit(json_encode($json));
            }
        }
        $json['status'] = 0;
        exit(json_encode($json));
    }
	public function emailvsend(){
		session('email_temp',text($_POST['email']));
		$mid = $this->regaction();
				
		$status=Notice(8,$mid);
		if($status) ajaxmsg('邮件已发送，请注意查收！',1);
		else ajaxmsg('邮件发送失败,请重试！',0);
		
    }
	public function ckcode(){
		if($_SESSION['verify'] != md5($_POST['sVerCode'])) {
			echo (0);
		 }else{
			echo (1);
        }
    }
    public function ckpcode() {

        if (session('code_temp') != text($_POST['sVerCode'])) {
            echo (0);
        } else {
            echo (1);
        }
    }

	public function getpassword(){
		$d['content'] = $this->fetch();
		echo json_encode($d);
	}


    public function resetPwd(){
        $per = C('DB_PREFIX');
        $pcode = $_POST['pcode'];
        $uphone = $_POST['uphone'];
        $pass = $_POST['pass'];

        if($_POST['pcode'] == $_SESSION['pcode'] && isset($_SESSION['pcode'])){
            $flag = M()->execute("update {$per}members set `user_pass`='".md5($pass)."' where user_phone={$uphone}");
            $json['status'] = 1;
            exit(json_encode($json));
        }else{
            $json['status'] = 2;
            exit(json_encode($json));
        }
    }

    public function verify() {
        import("ORG.Util.Image");
        Image::buildImageVerify();
    }

    public function regsuccess() {
        $this->assign('userEmail', M('members')->getFieldById($this->uid, 'user_email'));
        $d['content'] = $this->fetch();
        echo json_encode($d);
    }

    public function dogetpass() {
        (false !== strpos($_POST['u'], "@")) ? $data['user_email'] = text($_POST['u']) : $data['user_name'] = text($_POST['u']);
        $vo = M('members')->field('id')->where($data)->find();
        if (is_array($vo)) {
            $res = Notice(7, $vo['id']);
            if ($res)
                ajaxmsg();
            else
                ajaxmsg('', 0);
        }else {
            ajaxmsg('', 0);
        }
    }

    public function register2() {
        $this->display();
    }

    public function sendcode(){
        if(md5(strtolower(join('', $_POST['code'])))==$_SESSION['verify']){
            ajaxmsg();
        }else{
            ajaxmsg("图形验证码不正确",0);
        }
    }
	public function phone(){
		$this->assign("phone",$_GET['phone']);
		$data['content'] = $this->fetch();
		exit(json_encode($data));
		
	}
	
	//跳过手机验证
	public function skipphone(){
		$this->regaction();
		ajaxmsg();
		
	}
	//推荐人检测
    public function ckInviteUser() {
        $map['user_name'] = text($_POST['InviteUserName']);
        $map1['user_phone'] = text($_POST['InviteUserName']);
        $map2['user_name'] = text($_POST['InviteUserName']);
        $map2['u_group_id'] = 26;
        $count = M('members')->where($map)->count('id');
        $count1 = M('members')->where($map1)->count('id');
        $count2 = M('ausers')->where($map2)->count('id');

        if ($count == 1 || $count2 == 1||$count1==1) {
            $json['status'] = 1;
            exit(json_encode($json));
        } else {
            $json['status'] = 0;
            exit(json_encode($json));
        }
    }

}
