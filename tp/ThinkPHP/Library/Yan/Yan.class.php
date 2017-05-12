<?php 
namespace Yan;
use Think\Controller;
class Yan extends Controller
{
	public function _initialize()
    {
        if (!$this->isAuth()) {

          $this->redirectToLogin();
        }
    }
    
    private function isAuth()
    {
         if(empty(session('adminname'))){
            return false;
         }else{
            return true;
         }
      
    }
    
    private function redirectToLogin()
    {
        // echo  "<script>window.location.href = 'http://tp.cn/';</script>";
       $this->error('数据错误1','/Home/login/admin');
    }
}

 ?>