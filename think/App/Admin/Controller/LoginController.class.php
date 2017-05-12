<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
class LoginController extends Controller {
    public function index(){
        $this->display();
    }

    public  function verify_code()
    {
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 18;
    	$Verify->length   = 4;
    	$Verify->imageH  = 40;
    	$Verify->imageW  = 130;
      $Verify->codeSet = '0123456789';
      $Verify->useCurve = false;
    	$Verify->useNoise = false;
    	$Verify->entry();
    }

    public function check_verify($code)
    {
       $verify = new \Think\Verify(); 
       return $verify->check($code);

    }
   public function aa($code, $id = '')
   {
    return $code.$id;
   }
public function login()
    {
      $add = I();
      $User1 = D("Login"); 
      if (!$User1->create()){$this->error($User1->getError(),'Admin/login/index');}
       if(!empty($_POST)){
              $code = A('Admin/Login');
              $a = $code->check_verify($add['verify_code']);
              if($a == true){
                $data = array();
                $data['username'] =$add['username'];
                $data['password'] = md5($add['password']);
                $user=M('user_login')->where($data)->select();
                if($user){
                  session(null); 
                  // session('adminname',$user[0]['username']);  
                  session(C('USER_AUTH_KEY'),$user[0]['id']);
                  if($_SESSION['adminname'] ==C('RBAC_SUPERADMIN')){
                    session(C('ADMIN_AUTH_KEY'),true);
                  }
                  Rbac::saveAccessList();
                  $info['last_log'] = $user[0]['username'].'登陆后台';
                  $info['last_log_time'] = time();
                  $info['last_log_ip'] = get_client_ip();
                  $info['admin_user_name'] = $user[0]['username'];
                  if(!$ser = M('admin_user_log')->add($info)){
                    $this->error('日志记录失败','/Admin/login/index');
                  }
                  $this->assign('jumpUrl', "/Admin/index/index");
                 $this->success('登录成功，现在转向管理主页');
                }else{
                $this->error('填写正确用户名或密码','/Admin/login/index');
                }
              }else{
                $this->error('验证码错误','/Admin/login/index');
              }
        }else{
            $this->error('填写信息','/Admin/login/index');
        }
      
    }

}