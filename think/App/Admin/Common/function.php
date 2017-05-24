<?php 
/**
 * 管理员权限数据重新排版
 *@param array $node
 *@param array $access
 *@param int pid 
 *@return array $arr 
 */
function node_merge($node,$access=null,$pid=0)
{
	$arr= [];
	foreach ($node as $k => $v) {
		if(is_array($access) ){
			$v['access'] = in_array($v['id'],$access)? 1 : 2;
		}
		if($v['pid']==$pid){
			$v['child'] = node_merge($node,$access,$v['id']);
			$arr[] = $v;
		}
	}
	return $arr;
}


/**
 * 格式化文件大小显示
 *
 * @param int $size
 * @return string
 */
function format_size($size)
{
    $prec = 3;
    $size = round(abs($size));
    $units = array(
        0 => " B ",
        1 => " KB",
        2 => " MB",
        3 => " GB",
        4 => " TB"
    );
    if ($size == 0)
    {
        return str_repeat(" ", $prec) . "0$units[0]";
    }
    $unit = min(4, floor(log($size) / log(2) / 10));
    $size = $size * pow(2, -10 * $unit);
    $digi = $prec - 1 - floor(log($size) / log(10));
    $size = round($size * pow(10, $digi)) * pow(10, -$digi);
 
    return $size . $units[$unit];
}

/**
 * 格式化容量大小
 */
function byteFormat($bytes, $unit = "", $decimals = 2) {
$units = array('B' => 0, 'KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4, 'PB' => 5, 'EB' => 6, 'ZB' => 7, 'YB' => 8);

$value = 0;
if ($bytes > 0) {
// Generate automatic prefix by bytes
// If wrong prefix given
if (!array_key_exists($unit, $units)) {
$pow = floor(log($bytes)/log(1024));
$unit = array_search($pow, $units);
}

// Calculate byte value by prefix
$value = ($bytes/pow(1024,floor($units[$unit])));
}

// If decimals is not numeric or decimals is less than 0
// then set default value
if (!is_numeric($decimals) || $decimals < 0) {
$decimals = 2;
}

// Format output
return sprintf('%.' . $decimals . 'f '.$unit, $value);
} 


//删除文件夹及文件夹下所有内容
function Rmall($dirname) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }

    $dir = dir($dirname);//如果对像是目录

    while (false !== $file = $dir->read()) {

        if ($file == '.' || $file == '..') {
            continue;
        }
        if(!is_dir($dirname."/".$file)){
            unlink($dirname."/".$file);
        }else{
            Rmall($dirname."/".$file);
        }
        
        rmdir($dirname."/".$file);
    }

    $dir->close();
    
    rmdir($dirname);

    return true;
}
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
            // 将数组的输出存起来以供查看
           $fileName = __ROOT__.'Upload/test.txt';
           $postData = var_export($file_info, true);
           $file     = fopen('' . $fileName, "w");
           fwrite($file,$postData);
           fclose($file);
        }
        exit;
} 
// 上传文件删除
function upload_del($src)
{
    
    if (file_exists(C('WEB_ROOT').substr($src ,1))){
        unlink(C('WEB_ROOT').substr($src ,1));
    }
}
 ?>
