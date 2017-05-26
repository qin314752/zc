<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=gb2312"); 
//----------------------------------------- start edit here ---------------------------------------------//
$script_location = "http://".$_SERVER['HTTP_HOST']."/style/ajax-image-uploader/"; // location fo the script
$maxlimit = 9048576; // maxim image limit
$folder = "images";    // folder where to save images

// requirements
$minwidth = 10; // minim width
$minheight = 10; // minim height
$maxwidth = 2560; // maxim width
$maxheight = 1920; // maxim height

// allowed extensions
$extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG', '.GIF', '.JPG', '.JPEG');
//----------------------------------------- end edit here ---------------------------------------------//

	// check that we have a file
	if((!empty($_FILES["uploadfile"])) && ($_FILES['uploadfile']['error'] == 0)) {

	// check extension
	$extension = strrchr($_FILES['uploadfile']['name'], '.');
	if (!in_array($extension, $extensions))	{
		echo '�ϴ���ʽ����, ֻ���� .png , .gif, .jpg, .jpeg��ʽ��ͼƬ�ϴ�
		<script language="javascript" type="text/javascript">window.top.window.formEnable();</script>';
	} else {

// get file size
$filesize = $_FILES['uploadfile']['size'];

	// check filesize
	if($filesize > $maxlimit){ 
		echo "�ļ�����.";
	} else if($filesize < 1){ 
		echo "�ļ�����Ϊ��.";
	} else {


// �����ַ������������������Ҫ���ַ�  
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
	$password = "";  
	for($i = 0; $i < 5; $i++){  
		//ȡ�ַ����� $chars ������Ԫ�� 
		$password.= $chars[ mt_rand(0, strlen($chars) - 1) ];  
	}  

// temporary file
$uploadedfile = $_FILES['uploadfile']['tmp_name'];

// capture the original size of the uploaded image
list($width,$height) = getimagesize($uploadedfile);

	// check if image size is lower
	if($width < $minwidth || $height < $minheight){ 
		echo 'ͼƬ̫С. ��С�ϴ�����Ϊ:'.$minwidth.'x'.$minheight.'
		<script language="javascript" type="text/javascript">window.top.window.formEnable();</script>';
	} else if($width > $maxwidth || $height > $maxheight){ 
		echo 'ͼƬ̫��. ����ϴ�����Ϊ:'.$maxwidth.'x'.$maxheight.'
		<script language="javascript" type="text/javascript">window.top.window.formEnable();</script>';
	} else {

// all characters lowercase



$filename = $password.$extension;//strtolower($_FILES['uploadfile']['name']);

// replace all spaces with _
$filename = preg_replace('/\s/', '_', $filename);

// extract filename and extension
$pos = strrpos($filename, '.'); 
$basename = substr($filename, 0, $pos); 
$ext = substr($filename, $pos+1);

// get random number
$rand = time();

// image name
$image = $basename .'-'. $rand . "." . $ext;

// check if file exists
$check = $folder . '/' . $image;
	if (file_exists($check)) {
		echo 'Image already exists';
	} else {

// check if it's animate gif
$frames = exec("identify -format '%n' ". $uploadedfile ."");
	if ($frames > 1) {
		// yes it's animate image
		// copy original image
		copy($_FILES['uploadfile']['tmp_name'], $folder . '/' . $image);

		// orignal image location
		$write_image = $folder . '/' . $image;
		//ennable form
		echo '<img src="' . $write_image . '" alt="'. $image .'" alt="'. $image .'" width="500" /><br />
<input type="text" name="location" value="'.$script_location.''.$write_image.'" class="location corners" />
<script language="javascript" type="text/javascript">window.top.window.formEnable();</script>';
	} else {

// create an image from it so we can do the resize
 switch(strtolower($ext)){
  case "gif":
	$src = imagecreatefromgif($uploadedfile);
  break;
  case "jpg":
	$src = imagecreatefromjpeg($uploadedfile);
  break;
  case "jpeg":
	$src = imagecreatefromjpeg($uploadedfile);
  break;
  case "png":
	$src = imagecreatefrompng($uploadedfile);
  break;
 }

// copy original image
copy($_FILES['uploadfile']['tmp_name'], $folder . '/' . $image);

// orignal image location
$write_image = $folder . '/' . $image;

// create first thumbnail image - resize original to 80 width x 80 height pixels 
$newheight = ($height/$width)*50;
$newwidth = 50;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagealphablending($tmp, false);
imagesavealpha($tmp,true);
$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
imagefilledrectangle($tmp, 0, 0, $newwidth, $newheight, $transparent);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

// write thumbnail to disk

$write_thumbimage = $folder .'/small-'. $image;
switch(strtolower($ext)){
  case "gif":
	imagegif($tmp,$write_thumbimage);
  break;
  case "jpg":
	imagejpeg($tmp,$write_thumbimage,100);
  break;
  case "jpeg":
	imagejpeg($tmp,$write_thumbimage,100);
  break;
  case "png":
	imagepng($tmp,$write_thumbimage);
  break;
 }

// create second thumbnail image - resize original to 125 width x 125 height pixels 
$newheight = ($height/$width)*350;
$newwidth = 350;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagealphablending($tmp, false);
imagesavealpha($tmp,true);
$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
imagefilledrectangle($tmp, 0, 0, $newwidth, $newheight, $transparent);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

// write thumbnail to disk
$write_thumb2image = $folder .'/middle-'. $image;
 switch(strtolower($ext)){
  case "gif":
	imagegif($tmp,$write_thumb2image);
  break;
  case "jpg":
	imagejpeg($tmp,$write_thumb2image,100);
  break;
  case "jpeg":
	imagejpeg($tmp,$write_thumb2image,100);
  break;
  case "png":
	imagepng($tmp,$write_thumb2image);
  break;
 }

// create third thumbnail image - resize original to 125 width x 125 height pixels 
$newheight = ($height/$width)*800;
$newwidth = 800;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagealphablending($tmp, false);
imagesavealpha($tmp,true);
$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
imagefilledrectangle($tmp, 0, 0, $newwidth, $newheight, $transparent);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

// write thumbnail to disk
$write_thumb3image = $folder .'/big-'. $image;
switch(strtolower($ext)){
  case "gif":
	imagegif($tmp,$write_thumb3image);
  break;
  case "jpg":
	imagejpeg($tmp,$write_thumb3image,100);
  break;
  case "jpeg":
	imagejpeg($tmp,$write_thumb3image,100);
  break;
  case "png":
	imagepng($tmp,$write_thumb3image);
  break;
 }

// all is done. clean temporary files
imagedestroy($src);
imagedestroy($tmp);

// image preview
echo "<span style='color:#fc8936;font_size:14px'>�ϴ��ɹ��������رշ��أ�</span><br/><img src='" . $write_thumbimage . "' alt='". $image ."' /><br />
<input type='text' name='location' value='".$script_location."". $write_thumbimage ."' class='location corners' /><br />
<br />
<img src='" . $write_thumb2image . "' alt='". $image ."' /><br />
<input type='text' name='location' value='".$script_location."". $write_thumb2image ."' class='location corners' /><br />
<br />
<img src='" . $write_thumb3image . "' alt='". $image ."' /><br />
<input type='text' name='location' value='".$script_location."". $write_thumb3image ."' class='location corners' /><br />
<br />
<img src='" . $write_image . "' alt='". $image ."' alt='". $image ."' width='500' /><br />
<input type='text' name='location' value='".$script_location."".$write_image."' class='location corners' />
<script language='javascript' type='text/javascript'>window.top.window.formEnable();</script>
<div class='clear'></div>";
	  }
	}
  }
}
	// database connection
	include('inc/db.inc.php');
	$shopid = intval($_POST['shopid']);
			// insert into mysql database and show success message
			//mysql_query("INSERT INTO `lzh_image_upload` (`id`,`shopid`,`image`, `thumbnail`, `thumbnail2`, `thumbnail3` ) VALUES (NULL, ". $shopid .",'". $image ."', 'small-". $image ."', 'middle-". $image ."', 'big-". $image ."')");
			mysql_query("update `lzh_market_goods` set img ='". $image ."',small_img ='small-". $image ."',middle_img = 'middle-". $image ."',big_img =  'big-".$image."' where id ='".$shopid."'");
	  }
		// error all fileds must be filled
	} else {
		echo '<div class="wrong">You must to fill all fields!</div>'; }
?>