<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
use Org\Util\Mail;
class SystemController extends CommonController {
    public function index(){
        $this->display();
    }
    public function data()
    {
    	$data = I();
    	var_dump($data);
    	$arr = [];
    	foreach ($data as $key => $value) {
    		if(empty($value)){unset($key);}else{

    		$arr[$key]=$value;
    		}
    	}
    	    L('SMTP_Port',$arr['SMTP_Port']);
    	var_dump(L('SMTP_Port'));
    	var_dump($arr);

    }
    public function upload()
    {
      upload();
    } 
   
   public function upload_del()
   {
     upload_del($_GET['src']);   

   }
}



