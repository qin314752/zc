<?PHP 
//该demo的功能是注册序列号。注意序列号只需注册一次，即可使用。
//如果您的系统是UTF-8。请转成GB2312后，再提交。否则，可能会乱码
//参考代码：iconv( "UTF-8", "gb2312//IGNORE" ,"你好，测试短信")
$flag = 0; 
        //要post的数据 
$argv = array( 
         'sn'=>'SDK-OFT-010-xxxxx', //提供的账号
     'pwd'=>'xxxxxx', //此处密码为6位明文，但有的方法需要加密 加密方式为 md5(sn+password) 32位大写，具体的请参考接口说明。
     'province'=> '省份',//需要您填自己的省份
     'city'=>'城市',//需要您填自己的市
     'trade'=>'行业',//请填您的行业
     'entname'=>'企业名称',//您的企业名称
     'linkman'=>'联系man',//联系人姓名
     'phone'=>'88888888',//联系电话（座机）
     'mobile'=>'12333333333',//手机
     'email'=>'11@qq.com',//邮箱地址
     'fax'=>'88888888',//传真
     'address'=>'地址',//所在地址
     'postcode'=>'100000',//邮编
    'sign'=>'',//企业签名，如果没有可不填
     ); 
//构造要post的字符串 
foreach ($argv as $key=>$value) { 
          if ($flag!=0) { 
                         $params .= "&"; 
                         $flag = 1; 
          } 
         $params.= $key."="; $params.= urlencode($value); 
         $flag = 1; 
          } 
         $length = strlen($params); 
                 //创建socket连接 
        $fp = fsockopen("sdk2.entinfo.cn",80,$errno,$errstr,10) or exit($errstr."--->".$errno); 
         //构造post请求的头 
         $header = "POST /webservice.asmx/Register HTTP/1.1\r\n"; 
         $header .= "Host:sdk2.entinfo.cn\r\n"; 
          $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
         $header .= "Content-Length: ".$length."\r\n"; 
         $header .= "Connection: Close\r\n\r\n"; 
         //添加post的字符串 
         $header .= $params."\r\n"; 
         //发送post的数据 
         fputs($fp,$header); 
         $inheader = 1; 
          while (!feof($fp)) { 
                         $line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据 
                         if ($inheader && ($line == "\n" || $line == "\r\n")) { 
                                 $inheader = 0; 
                          } 
                          if ($inheader == 0) { 
                                // echo $line; 
                          } 
          } 
      //<string xmlns="http://tempuri.org/">-5</string>
         $line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
         $line=str_replace("</string>","",$line);
       $result=explode(" ",$line);
       //print_r( $result);
    if  ( $result[0]=="0")
echo "注册成功！";
if ($result[0]=="-1")
echo "重复注册";
    
?>