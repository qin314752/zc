<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $this->display();
    }

    public  function verify_code()
    {
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 13;
    	$Verify->length   = 4;
    	$Verify->imageH  = 30;
    	$Verify->imageW  = 110;
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