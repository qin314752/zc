<?php
function kuaiqian_query($merchantId,$certPassword,$customerId,$storablePan){
    header("content-type:text/html;charset=utf-8");
    $version = "1.0";
//    $merchantId = "104110045112012";
//    $customerId = "998877";
//    $storablePan = "4380880007";

    $xmlstr = null;
    $xmlstr .= "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>";
    $xmlstr .= "<MasMessage xmlns=\"http://www.99bill.com/mas_cnp_merchant_interface\">";
    $xmlstr .= "<version>".$version."</version>";
    $xmlstr .= "<PciQueryContent>";
    $xmlstr .= "<merchantId>".$merchantId."</merchantId>";
    $xmlstr .= "<customerId>".$customerId."</customerId>";
    $xmlstr .= "</PciQueryContent>";
    $xmlstr .= "</MasMessage>";
    return kuaiqian_query_send($merchantId,$certPassword,$xmlstr);
}

function kuaiqian_query_send($merchantId,$certPassword,$reqXml) {
//	$merchantId = "104110045112012";
//    $certPassword = "vpos123";

//	$certFileName = "D:/wamp/www/ShortCutpays/10411004511201290.pem";
    $certFileName = C("APP_ROOT")."/Lib/Pay/kuaiqianpay/10411004511201290.pem";
	$url = 'https://sandbox.99bill.com:9445/cnp/pci_query';
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	 
	//echo "$reqXml";
	$loginInfo = array(	"Authorization: Basic " . base64_encode($merchantId.":".$certPassword));

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
	curl_setopt($ch, CURLOPT_USERAGENT,$user_agent);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($ch, CURLOPT_CAINFO, $certFileName);
	curl_setopt($ch, CURLOPT_SSLCERT, $certFileName);
	curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certPassword);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $reqXml); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $loginInfo);
	$tr2Xml=curl_exec($ch);
	
//	echo "<html><body>结果：<br/>";//数据结果
//	echo "<textarea rows=\"20\" cols=\"100\">".$tr2Xml."</textarea></body></html>";
    
	if (curl_error($ch))
    printf("Error %s: %s", curl_errno($ch), curl_error($ch));
    curl_close ($ch);

	return $tr2Xml;
}


?>
