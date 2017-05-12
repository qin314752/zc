<?php
namespace Admin\Controller;
use Think\Controller;
Class IndexController extends Controller 
{
    public function index()
    {     
   		   $this->assign('adminname',session('adminname'));
        $this->display('Admin/index/index');
    }
    
   public function login()
    {
      $add = I();
      $User = D("Login"); 
      if (!$User->create()){$this->error($User->getError(),'/Home/login/admin');}
       if(!empty($_POST)){
              $data['username'] =$add['username'];
              $data['password'] = md5($add['password']);
              $code = A('Home/Login');
              $a = $code->check_verify($add['verify_code']);
              if($a == true){
              	if($user=M('user_login')->where($data)->select()){
	                session('adminname',$user[0]['username']);
                  $info['last_log'] = $user[0]['username'].'登陆后台';
                  $info['last_log_time'] = time();
                  $info['last_log_ip'] = get_client_ip();
                  $info['admin_user_name'] = $user[0]['username'];
                  if(!$ser = M('admin_user_log')->add($info)){
                    $this->error('日志记录失败','/Home/login/admin');
                  }
	                $this->assign('jumpUrl', "/Admin/index/index");
					       $this->success('登录成功，现在转向管理主页');
              	}else{
                $this->error('填写正确用户名或密码','/Home/login/admin');
              	}
              }else{
                $this->error('验证码错误','/Home/login/admin');
              }
        }else{
            $this->error('填写信息','/Home/login/admin');
        }
      
    }
    public function out()
    {
    	session(null);
		$this->success('注销成功，现在转向首页','Home/index/index');
    }

    public function data($i,$j)
    {
      require(C('APP_ROOT')."Common/data.php");
    }

    public function clear_cache()
    {
      $dirName   =   array(C('APP_RUNTIME').'/Runtime/')[0];
      
  }



}