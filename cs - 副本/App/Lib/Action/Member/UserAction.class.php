<?php
// 金糯米内核类库，2014-06-11_listam
class UserAction extends MCommonAction {
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

    public function header(){
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function password(){
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function pinpass(){
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function changepass(){
		$old = md5($_POST['oldpwd']);
		$newpwd1 = md5($_POST['newpwd1']);
		$c = M('members')->where("id={$this->uid} AND user_pass = '{$old}'")->count('id');
		if($c==0) ajaxmsg('',2);
		$newid = M('members')->where("id={$this->uid}")->setField('user_pass',$newpwd1);
		if($newid){
			MTip('chk1',$this->uid);
			ajaxmsg();
		}
		else ajaxmsg('',0);
    }

    public function changepin(){
		$old = md5($_POST['oldpwd']);
		$newpwd1 = md5($_POST['newpwd1']);
                //接收修改方式和手机验证码 #李振立#
                $editWay = $_POST['editWay'];
                $phone_code = $_POST['phone_code'];
                
		$c = M('members')->where("id={$this->uid}")->find();
                
                //根据选择的支付密码修改方式选择验证方式
                if($editWay==1){
                    //输入原密码修改方式
                    if($old==$newpwd1){
                            ajaxmsg("设置失败，请勿让新密码与老密码相同。",0);
                    }
                    if(empty($c['pin_pass'])){
                            if($c['user_pass'] == $old){
                                    $newid = M('members')->where("id={$this->uid}")->setField('pin_pass',$newpwd1);
                                    if($newid) ajaxmsg();
                                    else ajaxmsg("设置失败，请重试",0);
                            }else{
                                    ajaxmsg("原支付密码(即登录密码)错误，请重试",0);
                            }
                    }else{
                            if($c['pin_pass'] == $old){
                                    $newid = M('members')->where("id={$this->uid}")->setField('pin_pass',$newpwd1);
                                    if($newid) ajaxmsg();
                                    else ajaxmsg("设置失败，请重试",0);
                            }else{
                                    ajaxmsg("原支付密码错误，请重试",0);
                            }
                    }
                }else{
                    //手机验证码修改 #李振立#
                    //验证手机验证码 
                    if(session('code_temp')<>$_POST['phone_code'] || $_POST['phone_code']==""){
                        ajaxmsg("手机验证码输入错误！", 0 );
                    }else{
                        //查询原支付密码
                        if(empty($c['pin_pass'])){
                            $oldPassword = $c['user_pass'];
                        }else{
                            $oldPassword = $c['pin_pass'];
                        }
                        //原支付密码与新支付密码是否相同验证
                        if($oldPassword != $newpwd1){
                            $newid = M('members')->where("id={$this->uid}")->setField('pin_pass',$newpwd1);
                            if($newid){
                                ajaxmsg();
                                //清空验证码session  #李振立#
                                session('code_temp',null);
                            }else{
                                ajaxmsg("设置失败，请重试",0); 
                            }
                        }else{
                            ajaxmsg("设置失败，请勿让新密码与老密码相同。",0);
                        }    
                    }
                    
                    
                }
    }

    public function msgset(){
		$this->assign("vo",M('sys_tip')->find($this->uid));
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
	
	public function savetip(){
		$oldtip = M('sys_tip')->where("uid={$this->uid}")->count('uid');
		$data['tipset'] = text($_POST['Params']);
		$data['uid'] = $this->uid;
		if($oldtip) $newid = M('sys_tip')->save($data);
		else $newid = M('sys_tip')->add($data);
		//$this->display('Public:_footer');
		if($newid) echo 1;
		else echo 0;
	}
    //发送手机验证码 #李振立#
    public function sendphone() {

        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);

        //手机认证验证
        $verify = M('members_status') -> getFieldByUid($this -> uid, 'phone_status');
        if ($verify == 0){
            ajaxmsg("您尚未进行手机验证,请<a href='/member/verify?id=1#fragment-2'><span style='color:red;'>【验证】</span></a>后再进行支付密码修改！", 2);
        }else{
            $phone = M('members') -> getFieldById($this -> uid, 'user_phone');
            $code = rand_string_reg(6, 1, 2);
            $datag = get_global_setting();
            $is_manual = $datag['is_manual'];
            $res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
            if($res){
                ajaxmsg('验证码发送成功！',1);
            }else{
                ajaxmsg("验证码发送失败，请<a href='javascript:;' onclick='sendMobileValidSMSCode()' id='btnSendMsg'><span style='color:red;'>【重新发送】</span></a>！",0);
            }
        }

    }    

}