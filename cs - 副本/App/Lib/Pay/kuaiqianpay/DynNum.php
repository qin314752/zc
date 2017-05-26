<?php
function kuaiqian_dynNum($merchantId,$certPassword,$customerId,/*$cardNo,*/$phoneNO,$amount,$pan,$cardHolderName,$cardHolderId,$externalRefNumber,$bankId)
{
    header("content-type:text/html;charset=utf-8");
    $version = "1.0";
//    $merchantId = "104110045112012";
//    $customerId = "998877";
//    $externalRefNumber = "99000021234001";
//    $cardNo = "6225757519832522";
//    $phoneNO = "15861806195";//请填写自己手机号
//    $amount = "50.00";
//    $pan = "6225757519832522";
    $expiredDate = "1214";
    $cvv2 = "521";
//    $cardHolderName = "dongjian";
    $idType = "0";
//    $cardHolderId = "340827198512011810";
    $storableCardNo = "4380880007";
//    $bankId = "CCB";

    if ($entryTime == null) $entryTime = date('YmdHis');
    if ($externalRefNumber == null) $externalRefNumber = date('YmdHis');

    $xmlstr = null;
    $xmlstr .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    $xmlstr .= "<MasMessage xmlns=\"http://www.99bill.com/mas_cnp_merchant_interface\">";
    $xmlstr .= "<version>" . $version . "</version>";
    $xmlstr .= "<GetDynNumContent>";
    $xmlstr .= "<merchantId>" . $merchantId . "</merchantId>";
    $xmlstr .= "<customerId>" . $customerId . "</customerId>";
    $xmlstr .= "<externalRefNumber>" . $externalRefNumber . "</externalRefNumber>";
    $xmlstr .= "<cardHolderName>" . $cardHolderName . "</cardHolderName>";
    $xmlstr .= "<idType>" . $idType . "</idType>";
    $xmlstr .= "<cardHolderId>" . $cardHolderId . "</cardHolderId>";
    $xmlstr .= "<pan>" . $pan . "</pan>";
    $xmlstr .= "<storablePan></storablePan>";
    $xmlstr .= "<bankId></bankId>";
    $xmlstr .= "<expiredDate>" . $expiredDate . "</expiredDate>";
    $xmlstr .= "<phoneNO>" . $phoneNO . "</phoneNO>";
    $xmlstr .= "<cvv2>" . $cvv2 . "</cvv2>";
    $xmlstr .= "<amount>" . $amount . "</amount>";
    $xmlstr .= "</GetDynNumContent>";
    $xmlstr .= "</MasMessage>";
    return kuaiqian_dynNum_send($merchantId,$certPassword,$xmlstr);
}

function kuaiqian_dynNum_send($merchantId,$certPassword,$reqXml) {
//	$merchantId = "104110045112012";
//    $certPassword = "vpos123";
//	$certFileName = "D:/wamp/www/ShortCutpays/10411004511201290.pem";
    $certFileName = C("APP_ROOT")."/Lib/Pay/kuaiqianpay/10411004511201290.pem";
	$url = 'https://sandbox.99bill.com:9445/cnp/getDynNum';
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	//echo "$reqXml";
//    $loginInfo = array(	"Authorization: Basic " . base64_encode("104110045112012:vpos123"));
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
