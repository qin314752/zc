<?php

namespace Org\QQ;
use Org\QQ\ErrorCase;
// require_once(CLASS_PATH."ErrorCase.class.php");
class Recorder{
    private static $data;
    private $inc;
    private $error;

    public function __construct(){
        $this->error = new ErrorCase();

        //-------读取配置文件
        $this->inc ->appid = '101376735';
        $this->inc ->appkey = 'd83ee53a6f5845f2f5ed534b10c8cbdf';
        $this->inc ->callback = 'http://tp.cn/home/index/login';
        $this->inc ->scope = 'get_user_info';
        $this->inc ->errorReport = 'true';
        $this->inc ->storageType = 'file';
        $this->inc ->host = 'localhost';
        $this->inc ->user = 'root';
        $this->inc ->password = 'root';
        $this->inc ->database = 'test';

        if(empty($this->inc)){
            $this->error->showError("20001");
        }

        if(empty($_SESSION['QC_userData'])){
            self::$data = array();
        }else{
            self::$data = $_SESSION['QC_userData'];
        }
    }

    public function write($name,$value){
        self::$data[$name] = $value;
    }

    public function read($name){
        if(empty(self::$data[$name])){
            return null;
        }else{
            return self::$data[$name];
        }
    }

    public function readInc($name){
        if(empty($this->inc->$name)){
            return null;
        }else{
            return $this->inc->$name;
        }
    }

    public function delete($name){
        unset(self::$data[$name]);
    }

    function __destruct(){
        $_SESSION['QC_userData'] = self::$data;
    }
}
