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
		$uploaddir = __APP__.'/upload/';
		$name = $_FILES['file']['name'];
		$uploadfile = $uploaddir . $name;
		$type = strtolower(substr(strrchr($name, '.'), 1));
		//获取文件类型


		var_dump($_FILES);
		var_dump($type);
		var_dump($uploadfile);
		var_dump(move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . $_FILES['file']['name']));
		die;

		$typeArr = array("jpg","png","gif");
		if (!in_array($type, $typeArr)) {
		    echo "请上传jpg,png或gif类型的图片！";
		    exit;
		}
		print "<pre>";
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . $_FILES['file']['name'])) {
		    print "File is valid, and was successfully uploaded.  Here's some more debugging info:\n";
		    print_r($_FILES);
		} else {
		    print "Possible file upload attack!  Here's some debugging info:\n";
		    print_r($_FILES);
		}
		print "</pre>";
   }


}