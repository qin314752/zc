<?php
/**
 * DES加密解密类
 */
class desSecurity{
    var $key   = '12345678';

    public function __construct($key=''){
        if(!empty($key)){
            $this->key=	$key;
        }
    }

    //加密
    public function encrypt($str) {
        $cipher = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_ECB, '');
        $iv     = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES,MCRYPT_MODE_ECB), MCRYPT_RAND);
        if (mcrypt_generic_init($cipher, substr($this->key,0,8), $iv) != -1){
            $cipherText = mcrypt_generic($cipher,$this->pad($str));
            mcrypt_generic_deinit($cipher);
            //以十六进制字符显示加密后的字符
            $HcipherText=bin2hex($cipherText);
        }
        mcrypt_module_close($cipher);
        return strtoupper($HcipherText);
    }

    //解密
    public function decrypt($str) {
        $str    = pack('H*', $str);
        $cipher = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_ECB, '');
        $iv     = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES,MCRYPT_MODE_ECB), MCRYPT_RAND);
        if (mcrypt_generic_init($cipher, substr($this->key,0,8), $iv) != -1){
            $decrypted_data = mdecrypt_generic($cipher,$str);
            mcrypt_generic_deinit($cipher);
        }

        mcrypt_module_close($cipher);
        return trim($decrypted_data);
    }


    private function pad ($data)
    {
        return $data;
    }

    private function unpad ($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, - 1 * $pad);
    }
}
?>