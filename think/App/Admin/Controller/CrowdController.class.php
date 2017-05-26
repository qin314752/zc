<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
use Org\Util\Mail;
class CrowdController extends CommonController {
    public function index(){
        $this->display();
    }
   public function upload()
    {
      upload();
    } 
   
   public function upload_del()
   {
     upload_del($_GET['src']);   

   }
   public function data()
   {
   	$a = D('Project');
   	if (!$a->create()){     
   	// 如果创建失败 表示验证没有通过 输出错误提示信息    
   	 exit($a->getError());
   	}else{     
   	 // 验证通过 可以进行其他数据操作
   	 }
   	if(empty($_POST['car_img'])&&!implode($_POST['car_img']))$this->error('汽车图片未上传',U('index'));
   	$data = I();
   	$path = __ROOT__.'Car/'.date('YmdHis',time()).'/';
   	$content = array();
   	$content['project_brief'] = $_POST['project_brief'];//汽车简介
   	$content['car_parameters'] = $_POST['car_parameters'];//汽车参数
   	$content['project_pact'] = $_POST['project_pact'];//汽车合同
	foreach ($content as $key => $value) 
	{
	   $name = $key.'.txt';
	   if(!txt($path,$value,$name))
	   	{
	   		Rmall(C('WEB_ROOT').$path);
	   		$this->error($key.'写入失败',U('index'));
	   	}
	   	$data[$key] = '/'.$path.$name;
	}
	   	var_dump($data);
		   	
	
   	
   }

}