<?php
class PubAction extends Action
{


    public function Verify()
    {
        import("ORG.Util.Image");
        Image::buildImageVerify();
    }
    /**
     * 用户登录
     */
    public function login()
    {
        $hetong = M('hetong')->field('name,dizhi,tel')->find();
        $this->assign("web",$hetong);
        if($this->isPost()){
            //[username] => dsfsaf [password] => asdf [verify] => mebr
            if($_SESSION['verify'] != md5($_POST['verify'])) {
                $this->error('验证码错误！');
            }
            $user_name = $this->_post('username');
            $pass = $this->_post('password');
            $vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where("user_name='{$user_name}'")->find();
            if(!$vo){
                $this->error('没有此用户！');
            }
            if($vo['is_ban']==1){
                $this->error('您的帐户已被冻结，请联系客服处理！');
            }
            if($vo['user_pass'] != md5($pass)){
                $this->error('密码错误，请重新输入！');
            }

            session('u_id', $vo['id']);
            session('u_user_name', $vo['user_name']);
            $JumpUrl = session('JumpUrl')?session('JumpUrl'):U('M/user/index');
            session('JumpUrl','');
            $this->success("登录成功！", $JumpUrl);

        }else{
            if(session('u_id')){
                $this->redirect('M/user/index');
            }
            session('JumpUrl', $_SERVER['HTTP_REFERER']);
            $this->display();
        }

    }

    /**
     * 注销用户
     */
    public function Logout()
    {
        session(null);
        $this->success('安全退出!',U('M/index/index'));
    }
    //发送手机验证码
    public function sendphone() {
        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $phone = text($_POST['cellphone']);
        $xuid = M('members') -> getFieldByUserPhone($phone, 'id');
        if ($xuid > 0 && $xuid <> $this -> uid) ajaxmsg("", 2);

        $code = rand_string_reg(6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];
        $phoncode=text($_POST['phonecode']);
        $is_start=$datag['is_phone_code'];
        $is_start=intval($is_start);
        if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
            if($is_start == 1){
                if($phoncode !== ''){
                    $res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
                }
            }else{
                $res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
            }
        } else { // 否则，则由后台管理员来手动审核手机验证
            $res = true;
            $phonestatus = M('members_status') -> getFieldByUid($this -> uid, 'phone_status');
            if ($phonestatus == 1) ajaxmsg("手机已经通过验证", 1);
            $updata['phone_status'] = 3; //待审核
            $updata1['user_phone'] = $phone;
            $a = M('members') -> where("id = {$this->uid}") -> count('id');
            if ($a == 1) $newid = M("members") -> where("id={$this->uid}") -> save($updata1);
            else {
                M('members') -> where("id={$this->uid}") -> setField('user_phone', $phone);
            }

            $updata2['cell_phone'] = $phone;
            $b = M('member_info') -> where("uid = {$this->uid}") -> count('uid');
            if ($b == 1) $newid = M("member_info") -> where("uid={$this->uid}") -> save($updata2);
            else {
                $updata2['uid'] = $this -> uid;
                $updata2['cell_phone'] = $phone;
                M('member_info') -> add($updata2);
            }
            $c = M('members_status') -> where("uid = {$this->uid}") -> count('uid');
            if ($c == 1) $newid = M("members_status") -> where("uid={$this->uid}") -> save($updata);
            else {
                $updata['uid'] = $this -> uid;
                $newid = M('members_status') -> add($updata);
            }
            if ($newid) {
                ajaxmsg();
            } else ajaxmsg("验证失败", 0);
            // ////////////////////////////////////////////////////////////
        }

        if ($res) {
            session("temp_phone", $phone);
            ajaxmsg();
        } else ajaxmsg("", 0);
    }
    public  function phonecode(){
        if($_SESSION['verify'] != md5($_POST['phonecode'])) {
            ajaxmsg('fail',0);
        }else{
            ajaxmsg('fail',1);
        }
    }
    /**
     * 用户注册
     *
     */
    public function regist()
    {
        $hetong = M('hetong')->field('name,dizhi,tel')->find();
        $this->assign("web",$hetong);
        if(session('u_id')){
            $this->redirect('M/user/index');
        }
        if($this->isAjax()){
            $phone = $this->_post('phone');
            $username = $this->_post('username');
            $password = $this->_post('password');
            $verify = $this->_post('verify');
            $spread_name= $this->_post('spread');
            if(!$phone  || !$password || !$verify){
                die("数据不完整");
            }
            if(session('code_temp') != $verify) {
                die('验证码错误！');
            }
            if(M("members")->where("user_phone='{$phone}'")->count('id')){
                die("手机号已注册");
            }
//            if(M("members")->where("user_name='{$username}'")->count('id')){
//                die("用户名已注册");
//            }
            if($_POST["spread"]!=""){
                $info = M("members")->where("user_name = '{$spread_name}'")->find();
                if($info["id"]==""){
                    $infop = M("members")->where("user_phone = '{$spread_name}'")->find();
                    if($infop == ''){
                        die("推荐人不存在！");
                    }else{
                        $data['recommend_id'] = $infop["id"];
                        $data['recommend_time'] = time();
                    }
                }else{
                    $data['recommend_id'] = $info["id"];
                    $data['recommend_time'] = time();
                }
            }else{
                $data['recommend_id'] = "";
                $data['recommend_time'] = "";
            }
            $data = array(
                'user_name'=>$phone,
                'user_pass'=>md5($password),
                'user_phone'=>$phone,
                'reg_time'=>time(),
                'reg_ip' => get_client_ip(),
                'recommend_id'=>$data['recommend_id'],
                'recommend_time'=>$data['recommend_time'],
            );
            if($newid = M("members")->add($data)){
                //Notice(1,$newid,array('email',$data['user_email']));
                //更新手机认证状态
                $status['phone_status'] = 1;
                $status['phone_credits'] = 10;
                $status['uid'] = $newid;
                M("members_status")->add($status);
                //更新个人信息手机号
                $updata['uid'] = $newid;
                $updata['cell_phone'] = $phone;
                M('member_info')->add($updata);

                session('u_id', $newid);
                session('u_user_name', $username);
                echo '1';
            }else{
                die('注册失败');
            }
        }else{
            $data=get_global_setting();
            $is_start=$data['is_phone_code'];
            $is_start=intval($is_start);
            $this->assign('is_start',$is_start);
            $this->display();
        }
    }

}
?>
