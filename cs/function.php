<?php 
	// 文件上传
function upload()
{
      $file_path = __ROOT__."Upload/";
        if (isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            $upload_file = $_FILES['Filedata'];
            $file_info = pathinfo($upload_file['name']);
            $file_type = $file_info['extension'];
            $save = $file_path . md5(uniqid($_FILES["Filedata"]['name'])) . '.' . $file_info['extension'];
            $name = $_FILES['Filedata']['tmp_name'];
            echo $save;
            if (!move_uploaded_file($name, $save)) {
                exit;
            }
            //将数组的输出存起来以供查看
        //    $fileName = 'test.txt';
        //    $postData = var_export($file_info, true);
        //    $file     = fopen('' . $fileName, "w");
        //    fwrite($file,$postData);
        //    fclose($file);
        }
        exit;
} 
// 上传文件删除
function upload_del($src)
{
    // 'WEB_ROOT'=>explode('App/Common',str_replace('\\', '/', dirname(__FILE__)),-1)[0],//网站根目录物理路径 
    if (file_exists(C('WEB_ROOT').substr($src ,1))){
        unlink(C('WEB_ROOT').substr($src ,1));
    }

 ?>