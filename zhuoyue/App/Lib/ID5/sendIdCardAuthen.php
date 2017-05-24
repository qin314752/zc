<?php
include_once("desSecurity.php");

class sendIdCardAuthen{
    protected $idcard='';
    protected $real_name='';
    protected $bankCardNo='';
    protected $authType='01';
    protected $uImage='';
    public $error=''; //错误信息

    private $url=''; //请求路径
    private $userId=0; //用户ID
    private $md5_key='';
    private $des_key='';
    public function __construct($config=array()) {
        //公用请求参数：配置账户
        $this->url=$config['query_url'];
        $this->userId=$config['user_id'];
        $this->md5_key=$config['md5_key'];
        $this->des_key=$config['des_key'];
    }

    /**
     * 设置检查对象
     * @access protected
     * @param  string $real_name 姓名
     * @param  string $id_card 身份证号
     * @return object
     */
    public function set($real_name='',$idcard='',$authType='',$bankCardNo='',$uImage=''){
        $this->real_name=$real_name;
        $this->idcard=strtoupper($idcard);
        $this->bankCardNo=$bankCardNo;
        $this->authType=$authType;
        $this->uImage=$uImage;
        //var_dump($this);
        return $this;
    }

    /**
     * 联网检查身份证
     * @access public
     * @return int
     */
    public function checkOnline(){
        $des=new desSecurity($this->des_key);
        $param=array(
            'userId'=>$this->userId,
            'coopOrderNo'=>date("YmdHis").mt_rand(1000,9999),
            'auName'=>$this->real_name,
            'auId'=>$this->idcard,
            'reqDate'=>date("Y-m-d H:i:s"),
            'ts'=>time(),
            'Sign'=>'',
        );

        //var_dump($param);
        $string='';
        $url=$this->url.'?';
        foreach($param as $k=>$v){
            if(empty($v)) continue;
            if($k!='reqDate'){
                $string .= $k.$v;
            }
            if($k=='auName' || $k=='auId'){
                $v=$des->encrypt($v);
            }
            $url .= $k.'='.str_replace('+', '%20',urlencode(($v))).'&'; //URLEncode(GBK编码)
        }
        $sign=md5($string.$this->md5_key);
        $url .= 'sign='.$sign.= '&authType='.$this->authType.= '&bankCardNo='.$this->bankCardNo.= '&uImage='.$this->uImage;

        try{
            set_time_limit(60);

            $result = file_get_contents($url);
            $result =  iconv("GB2312", "UTF-8//IGNORE", $result);

//            file_put_contents("result.txt",$result);
             //1-库中无此号, 2-不一致, 3-一致

            if(strstr($result,"<auResultInfo>一致</auResultInfo>")){
                return 3;
            }elseif(strstr($result,"<auResultInfo>库无记录</auResultInfo>")){
                $this->error='身份证库中无此号码';
                return '身份证库中无此号码';
            }elseif(strstr($result,"<auResultInfo>不一致</auResultInfo>")){
                $this->error='身份证号码和姓名不一致';
                return '身份证号码和姓名不一致';
            }elseif(strstr($result,"<auResultInfo>账户可用核验次数为0</auResultInfo>")){
                $this->error='账户可用核验次数为0';
                return '账户可用核验次数为0';
            }else{
                preg_match('/<auResultInfo>(.*?)<\/auResultInfo>/',$result,$msg);
                $this->error='查询出错';
                return '查询出错';
            }
        }catch(Exception $e) {
            $this->error=$e->getMessage();
        }
        return 0;
    }

    /**
     * 获取错误信息
     * @access public
     * @param string
     */
    public function getError(){
        return $this->error;
    }
}



?>