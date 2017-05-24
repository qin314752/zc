<?php
/**
 * 宝付身份验证接口
 * User: liang
 * Date: 2015/7/17
 * Time: 14:08
 */

if ( ! defined ( 'API_ROOT_PATH' ) )
{
    define ( 'API_ROOT_PATH', dirname( __FILE__));
}

require_once ( API_ROOT_PATH . '/BaoFooSdk/SdkXML.php' );
require_once ( API_ROOT_PATH . '/BaoFooSdk/BaofooSdk.php' );
$path = API_ROOT_PATH."/BaoFooSdk/CER/";	//证书路径

if(!file_exists($path."m_pri.pfx")) {
    throw new Exception('Private key certificate does not exist.');
}
if(!file_exists($path."baofoo_pub.cer")) {
    throw new Exception('Private key certificate does not exist.');
}
define('BAOFOO_PATH', $path);
class Baofoo {

    public $member_id   = '100000178';//536224
    public $terminal_id = '100000859';//25331
    public $txn_type   = '3001';
    public $biz_type    = '0000';
    public $txn_sub_type = '01351';
    public $txn_sub_bank_type = '01341';
    protected $version  = '4.0.0.0';
    protected $private_key_password = '123456';
    protected $client_ip;
    const data_type = 'json';
    //测试路径
    public $request_url = "https://tgw.baofoo.com/livesplatform/api/backTransRequest";
    //正式环境
    //public $request_url = "https://public.baofoo.com/livesplatform/api/backTransRequest";

    public function __construct(){
        $this->client_ip = get_client_ip();
    }

    /**
     * 验证身份证卡号是否存在
     * @param array $array
     */
    public function checkCard($array = array()) {

        $id_card_type = '02';//身份证类型
        $id_card = $array['id_card'];	//身份证号码
        $id_holder = $array['id_holder'];//真实姓名
        $additional_info = '';	//附加字段
        $txn_type = $this->txn_type;
        $system = $this->setParam();

        $request_url = $this->request_url;  //测试环境请求地址

        $systems = array (
            'id_card_type' => $id_card_type,
            'id_card' => $id_card,
            'id_holder' => $id_holder,
        );
        $parms = array_merge($system, $systems);

        if(self::data_type == "json")
        {
            $Encrypted_string = str_replace("\\/", "/",json_encode($parms));//转JSON
        }
        else
        {
            $toxml = new SdkXML();	//实例化XML转换类
            $Encrypted_string = $toxml->toXml($parms);//转XML
        }

        ob_start ();
        $baofoosdk = new BaofooSdk($system['member_id'], $system['terminal_id'], self::data_type, BAOFOO_PATH."m_pri.pfx", BAOFOO_PATH."baofoo_pub.cer", $this->private_key_password); //实例化加密类。

        $Encrypted = $baofoosdk->encryptedByPrivateKey(base64_encode($Encrypted_string));	//先BASE64进行编码再RSA加密

        $return = $baofoosdk->post($Encrypted, $request_url, $parms['txn_sub_type'], $this->version, $txn_type);  //发送请求到宝付服务器，并输出返回结果。

        $return_decode = base64_decode($baofoosdk->decryptByPublicKey($return));	//解密返回的报文
        ob_end_clean();
        writeLog($return_decode, 'baofoo_card_log.log');
        $result = json_decode($return_decode, true);
        if($result['resp_code'] === '0000') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 验证绑卡信息
     */
    public function checkBank($array){
        $id_card_type = '02';//身份证类型
        $id_card = $array['id_card'];	//身份证号码
        $id_holder = $array['id_holder'];//真实姓名

        $acc_no = isset($array['acc_no']) ?	$array['acc_no'] :"";		//卡号
        $mobile = isset($array['mobile']) ?	$array['mobile'] :"";	//银行预留手机号
        $card_type = isset($array['card_type']) ?	$array['card_type'] :"";	//卡类型


        if($card_type =="101"){//判断银行卡是否为信用卡
            $pay_code = isset($array['PayCodeA'])? $array['PayCodeA']:"";	//银行编码
        }else{
            $pay_code = isset($array['PayCodeB'])? $array['PayCodeB']:"";	//银行编码
        }

        $additional_info = '';	//附加字段
        $txn_type = $this->txn_type;
        $system = $this->setParam($this->txn_sub_bank_type);

        $request_url = $this->request_url;  //测试环境请求地址

        $systems = array (
            'id_card_type' => $id_card_type,
            'id_card' => $id_card,
            'id_holder' => $id_holder,
            'acc_no' => $acc_no,
            'id_card_type' => $id_card_type,
            'mobile' => $mobile,
            'card_type' => $card_type,
            'acc_pwd' => '',
            'pay_code' => $pay_code
        );
        $parms = array_merge($system, $systems);

        if(self::data_type == "json")
        {
            $Encrypted_string = str_replace("\\/", "/",json_encode($parms));//转JSON
        }
        else
        {
            $toxml = new SdkXML();	//实例化XML转换类
            $Encrypted_string = $toxml->toXml($parms);//转XML
        };
        ob_start ();

        $baofoosdk = new BaofooSdk($system['member_id'], $system['terminal_id'], self::data_type, BAOFOO_PATH."m_pri.pfx", BAOFOO_PATH."baofoo_pub.cer", $this->private_key_password); //实例化加密类。

        $Encrypted = $baofoosdk->encryptedByPrivateKey(base64_encode($Encrypted_string));	//先BASE64进行编码再RSA加密

        $return = $baofoosdk->post($Encrypted, $request_url, $parms['txn_sub_type'], $this->version, $txn_type);  //发送请求到宝付服务器，并输出返回结果。

        $return_decode = base64_decode($baofoosdk->decryptByPublicKey($return));	//解密返回的报文
        ob_end_clean();
//        writeLog($return_decode, 'yijidai_bank_log.log');
        $result = json_decode($return_decode, true);
        if($result['resp_code'] === '0000') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 系统公用参数
     * @return mixed
     */
    public function setParam($txn) {
        $param['txn_sub_type']      = isset($txn) ? $txn : $this->txn_sub_type;
        $param['trans_serial_no']   = "TSN".$this->getTransid().$this->randNum();	//商户流水号	8-20 位字母和数字，每次请求都不可重复(当天和历史均不可重复)
        $param['trans_id']          = "TI".$this->getTransid().$this->randNum();	//商户订单号
        $param['trade_date']        = $this->makesTime();	//订单日期
        $param['clientIp']          = $this->client_ip;	//商户ip
        $param['member_id']         = $this->member_id;	//商户号
        $param['terminal_id']       = $this->terminal_id;	//终端号
        $param['version']           = $this->version;  //版本号
        $param['biz_type']          = $this->biz_type;	//接入类型
        return $param;
    }

    /**
     * 生成时间戳
     * @return int
     */
    private function getTransid(){
        return strtotime(date('Y-m-d H:i:s',time()));
    }

    /**
     * 生成四位随机数
     * @return int
     */
    private function randNum(){
        return rand(1000,9999);
    }

    /**
     * 生成时间
     * @return bool|string
     */
    function makesTime(){
        return date('YmdHis',time());
    }
}