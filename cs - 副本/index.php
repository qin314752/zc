<?php


if(isset($_SERVER['HTTP_X_REWRITE_URL'])){
	$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
	$___s = explode(".",$_SERVER['REQUEST_URI']);
	$____s = explode("?",$_SERVER['REQUEST_URI']);
	$_SERVER['PATH_INFO'] = $____s[0];
	$GLOBALS['is_iis'] = true;
}  
    function is_mobile() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }
	$url = explode('/', $_SERVER['REQUEST_URI']);
	
//    if(is_mobile() && !(strtolower($url[1])=='m' or strtolower($url[1])=='m.html')){
//        Header("HTTP/1.1 301 Moved Permanently");
//        Header("Location: http://".$_SERVER['SERVER_NAME'].'/m.html');
//    }
    
    define('THINK_PATH',dirname(__FILE__).'/CORE/');
    define('APP_NAME',dirname(__FILE__).'App');
    define('APP_PATH',dirname(__FILE__).'/App/');
    define('APP_DEBUG',0);
    define('APP_PUBLIC_PATH',dirname(__FILE__).'./Public');

	define('BUILD_DIR_SECURE',true); 
	define('DIR_SECURE_FILENAME', 'default.html'); 
	define('DIR_SECURE_CONTENT', 'deney Access!'); 
    
	
    require(THINK_PATH.'Core.php');//exit('dd');

?>