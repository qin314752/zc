<?php
function kuaiqian_pur($merchantId,$certPassword,$customerId,$externalRefNumber,$cardNo,$amount,$phone,$validCode,$token){
    header("content-type:text/html;charset=utf-8");

//    $merchantId = "104110045112012";
//            $customerId = "998877";
//    $customerId = $_REQUEST["customerId"];
//            $externalRefNumber = "99000021234001";
//    $externalRefNumber = $_REQUEST["order"];
//    $cardNo = "6225757519832522";
//    $amount = "50.00";
//            $phone = "15865463700";
//    $phone = $_REQUEST["phone"];
//            $validCode = "830050";
//    $validCode = $_REQUEST["code"];
//            $token = "335329";
//    $token = $_REQUEST["token"];

    $version = "1.0";
    $txnType = "PUR";
    $interactiveStatus = "TR1";
    $expiredDate = "1214";
    $terminalId = "00002012";
    $entryTime = date("YmdHis");
    $savePciFlag = "1";
    $payBatch = "1";
    $spFlag = "QuickPay";
//            $cvv2="562";
    $cvv2="";

    $storableCardNo = "";
    $cardHolderName = "";
    $cardHolderId = "";
    $idType = "0";

    if ($entryTime==null) $entryTime=date('YmdHis');
    if ($externalRefNumber==null) $externalRefNumber=date('YmdHis');

    $xmlstr = null;
    $str = "";
    $str.= "<extMap>";
    $str.= "<extDate><key>phone</key><value>".$phone."</value></extDate>";
    $str.= "<extDate><key>validCode</key><value>".$validCode."</value></extDate>";
    $str.= "<extDate><key>savePciFlag</key><value>".$savePciFlag."</value></extDate>";
    $str.= "<extDate><key>token</key><value>".$token."</value></extDate>";
    $str.= "<extDate><key>payBatch</key><value>".$payBatch."</value></extDate>";
    $str.= "</extMap>";

    $xmlstr = "";
    $xmlstr.= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    $xmlstr.= "<MasMessage xmlns=\"http://www.99bill.com/mas_cnp_merchant_interface\">";
    $xmlstr.= "<version>".$version."</version>";
    $xmlstr.= "<TxnMsgContent>";
    $xmlstr.= "<txnType>".$txnType."</txnType>";
    $xmlstr.= "<interactiveStatus>".$interactiveStatus."</interactiveStatus>";
    $xmlstr.= "<cardNo>".$cardNo."</cardNo>";
    $xmlstr.= "<expiredDate>".$expiredDate."</expiredDate>";
    $xmlstr.= "<cvv2>".$cvv2."</cvv2>";
    $xmlstr.= "<amount>".$amount."</amount>";
    $xmlstr.= "<merchantId>".$merchantId."</merchantId>";
    $xmlstr.= "<terminalId>".$terminalId."</terminalId>";
    $xmlstr.= "<entryTime>".$entryTime."</entryTime>";
    $xmlstr.= "<externalRefNumber>".$externalRefNumber."</externalRefNumber>";
    $xmlstr.= "<customerId>".$customerId."</customerId>";
    $xmlstr.= "<storableCardNo>".$storableCardNo."</storableCardNo>";
    $xmlstr.= "<cardHolderName>".$cardHolderName."</cardHolderName>";
    $xmlstr.= "<cardHolderId>".$cardHolderId."</cardHolderId>";
    $xmlstr.= "<idType>".$idType."</idType>";
    $xmlstr.= "<spFlag>".$spFlag."</spFlag>";
    $xmlstr.= $str;
    $xmlstr.= "</TxnMsgContent>";
    $xmlstr.= "</MasMessage>";

//            echo $xmlstr;


    return kuaiqian_pur_send($merchantId,$certPassword,$xmlstr);
}

function kuaiqian_pur_send($merchantId,$certPassword,$reqXml) {
//    $merchantId = "104110045112012";
//            $certFileName = "D:/wamp/www/ShortCutpays/10411004511201290.pem";
    $certFileName = C("APP_ROOT")."/Lib/Pay/kuaiqianpay/10411004511201290.pem";
//    echo "<br/>".$certFileName."<br/>";
//    $certPassword = "vpos123";
    $url = 'https://sandbox.99bill.com:9445/cnp/purchase';
    $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
//    echo "$reqXml";
//            $loginInfo = array(	"Authorization: Basic " . base64_encode($merchantId."104110045112012:vpos123"));
    $loginInfo = array(	"Authorization: Basic " . base64_encode($merchantId.":".$certPassword));
    echo "<br/><br/>merchantId:".$merchantId."<br/>";
    echo "<br/>certPassword:".$certPassword."<br/>";
    echo "<br/>loginInfo:";
    echo var_export($loginInfo,true);
    echo "<br/>";
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

//    echo "<html><body>结果：<br/>";//数据结果
//    echo "<textarea rows=\"20\" cols=\"100\">".$tr2Xml."</textarea></body></html>";

    if (curl_error($ch))
        printf("Error %s: %s", curl_errno($ch), curl_error($ch));
    curl_close ($ch);
    return $tr2Xml;
}





?>
