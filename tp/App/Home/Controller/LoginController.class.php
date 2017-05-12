<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function admin(){
        $this->display('Home/index/login');
    }

    public  function verify_code()
    {
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 20;
    	$Verify->length   = 4;
    	$Verify->imageH  = 40;
    	$Verify->imageW  = 140;
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
}