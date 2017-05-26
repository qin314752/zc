<?php
    /**
    * 手机版 用户中心
    */
    class UserAction extends MobileAction
    {
        
         public function index()
         {
            //实名认证验证
            $member_status = M("members_status")->field("id_status")->find($this->uid);
            if($member_status['id_status']=='0')$this->error("您还没有实名认证，请先进行实名认证!","/M/User/idcard");
            //支付密码设置验证
            $member_info = M("members")->field("pin_pass")->find($this->uid);
            if($member_info['pin_pass']=="")$this->error("您还没有设置支付密码，请先设置支付密码!","/M/User/setpaypass");
            $this->assign('pcount', get_personal_count($this->uid));
            $this->assign('benefit', get_personal_benefit($this->uid));   //收入
            $minfo =getMinfo($this->uid,true);
            $this->assign("minfo",$minfo);
            
            // 预约金额
            $s_money['user_id']=$this->uid;
            $s_money['status']=1;
            $surplus_money=M('crowd_auto')->field('sum(surplus_money) as surplus_money')->where($s_money)->find();
            $this->assign('surplus_money',$surplus_money['surplus_money']);
            
            // 在筹金额
            $pre = C("DB_PREFIX");
            $bj_status['cc.status'] = array("in",array('2','3','4'));
            $bj_status['ci.user_id']=$this->uid;
            $bj_crowds=M('crowd_investor ci')->field('count(cc.id) as id,sum(ci.capital) as capital')
                ->join("{$pre}crowd_info cc ON ci.crowd_id=cc.id")
                ->where($bj_status)
                ->find();
            $this->assign("bj_crowds",$bj_crowds);
            
            $this->display();
         }
         
         /**
         * 个人资料
         */
         public function info()
         {
             $minfo =getMinfo($this->uid,true);
             $this->assign("kflist",get_admin_name());


             $this->assign("minfo",$minfo);
             $this->display();
         }
         
         /**
         * 资金信息
         */
         public function fund()
         {
             $this->assign('pcount', get_personal_count($this->uid));   
             $this->assign('benefit', get_personal_benefit($this->uid));   //收入
             $minfo =getMinfo($this->uid,true);
             $this->assign("minfo",$minfo);
             
             // 预约金额
            $s_money['user_id']=$this->uid;
            $s_money['status']=1;
            $surplus_money=M('crowd_auto')->field('sum(surplus_money) as surplus_money')->where($s_money)->find();
            $this->assign('surplus_money',$surplus_money['surplus_money']);
            
            // 在筹金额
            $pre = C("DB_PREFIX");
            $bj_status['cc.status'] = array("in",array('2','3','4'));
            $bj_status['ci.user_id']=$this->uid;
            $bj_crowds=M('crowd_investor ci')->field('count(cc.id) as id,sum(ci.capital) as capital')
                ->join("{$pre}crowd_info cc ON ci.crowd_id=cc.id")
                ->where($bj_status)
                ->find();
            $this->assign("bj_crowds",$bj_crowds);
            
             $this->display();
         }
         
         /**
         * 我要提现
         */
         public function cash()
         {
             if($this->isAjax()){
                  $money = $this->_post('money');
                  $paypass = $this->_post('paypass');
                  $status = checkCash($this->uid, $money, $paypass);
                  if($status == 'TRUE'){
                      die('TRUE');
                  }else{
                      die('<font color=red>'.$status.'</font>');
                  }
             }else{
                 $pre = C('DB_PREFIX');
                 $field = "m.user_name,m.user_phone,(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money,i.real_name,b.bank_num,b.bank_name,b.bank_address";
                 $vo = M('members m')->field($field)->join("{$pre}member_info i on i.uid = m.id")->join("{$pre}member_money mm on mm.uid = m.id")->join("{$pre}member_banks b on b.uid = m.id")->where("m.id={$this->uid}")->find();
                 //print_r($vo);exit;
                 if(empty($vo['bank_num'])) 
                    $this->error("请用先绑定银行卡后再申请提现！","/M/User/bank");
                    
                    
                 $tqfee = explode( "|", $this->glo['fee_tqtx']);
                 $fee[0] = explode( "-", $tqfee[0]);
                 $fee[1] = explode( "-", $tqfee[1]);
                 $fee[2] = explode( "-", $tqfee[2]);
                 $this->assign( "fee",$fee);
                 $borrow_info = M("borrow_info")
                            ->field("sum(borrow_money+borrow_interest+borrow_fee) as borrow, sum(repayment_money+repayment_interest) as also")
                            ->where("borrow_uid = {$this->uid} and borrow_type=4 and borrow_status in (0,2,4,6,8,9,10)")
                            ->find();
                 $vo['all_money'] -= $borrow_info['borrow'] + $borrow_info['also'];
                 $this->assign("borrow_info", $borrow_info);
                 $this->assign( "vo",$vo);
                 $this->assign("memberinfo", M('members')->find($this->uid));
                 $this->display(); 
             }  
         }
         /**
         * 投资总表
         */
         public function invest()
         {
             $uid = $this->uid;
             $pre = C('DB_PREFIX');
            //认筹中的众筹
             $crowd_investor = M('crowd_investor cn')
                 ->join("{$pre}crowd_info ci ON ci.id=cn.crowd_id")
                 ->field("count(cn.id) as num,sum(cn.capital) as all_money")
                 ->where('cn.user_id = '.$this->uid.' AND ci.status = 1')->select();
            $this->assign('crowd_investor',$crowd_investor);
             //出售中的众筹
             $crowd_investor_sell = M('crowd_investor cn')
                 ->join("{$pre}crowd_info ci ON ci.id=cn.crowd_id")
                 ->field("count(cn.id) as num,sum(cn.capital) as all_money")
                 ->where('cn.user_id = '.$this->uid.' AND ci.status = 2')->select();
             $this->assign('crowd_investor_sell',$crowd_investor_sell);
             //投票中的众筹
             $crowd_investor_vote = M('crowd_investor cn')
                 ->join("{$pre}crowd_info ci ON ci.id=cn.crowd_id")
                 ->field("count(cn.id) as num,sum(cn.capital) as all_money")
                 ->where('cn.user_id = '.$this->uid.' AND ci.status = 3')->select();
             $this->assign('crowd_investor_vote',$crowd_investor_vote);
             //回款中的众筹
             $crowd_investor_repayment = M('crowd_investor cn')
                 ->join("{$pre}crowd_info ci ON ci.id=cn.crowd_id")
                 ->field("count(cn.id) as num,sum(cn.capital) as all_money")
                 ->where('cn.user_id = '.$this->uid.' AND ci.status = 4')->select();
             $this->assign('crowd_investor_repayment',$crowd_investor_repayment);
             //已完成中的众筹
             $crowd_investor_done = M('crowd_investor cn')
                 ->join("{$pre}crowd_info ci ON ci.id=cn.crowd_id")
                 ->field("count(cn.id) as num,sum(cn.capital) as all_money")
                 ->where('cn.user_id = '.$this->uid.' AND ci.status IN (5,9)')->select();
             $this->assign('crowd_investor_done',$crowd_investor_done);
             //已完成中的众筹
             $crowd_investor_withdraw = M('crowd_investor cn')
                 ->join("{$pre}crowd_info ci ON ci.id=cn.crowd_id")
                 ->field("count(cn.id) as num,sum(cn.capital) as all_money")
                 ->where('cn.user_id = '.$this->uid.' AND ci.status = 8')->select();
             $this->assign('crowd_investor_withdraw',$crowd_investor_withdraw);
             $this->assign("dc",M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money'));
             $mx =getMemberBorrowScan($this->uid);
             $all_crowd_investor = M('crowd_investor cn')
                 ->join("{$pre}crowd_info ci ON ci.id=cn.crowd_id")
                 ->where('cn.user_id = '.$this->uid.' AND ci.status <> 6')->sum("cn.capital");
             $all_money =$mx['tj']['borrowOut']+ $all_crowd_investor;
             $this->assign('all_money',$all_money);
             $this->assign("mx",getMemberBorrowScan($this->uid));
             $this->display();
         }
         public function loan()
         {
             $this->assign("mx",getMemberBorrowScan($this->uid));
             $this->display();   
         }
         /**
         * 安全中心
         */
         public function safe()
         {
             $this->assign("memberinfo", M('members')->find($this->uid));
             $this->assign("mstatus", M('members_status')->field(true)->find($this->uid)); 
             $this->assign("memberdetail", M('member_info')->find($this->uid));
             $paypass = M("members")->field('pin_pass')->where('id='.$this->uid)->find();
             $this->assign('paypass', $paypass['pin_pass']);
             $bank_info = M('member_banks')->field('bank_num')->where('uid = '.$this->uid)->find();
             $this->assign('bank',$bank_info['bank_num']);
             $this->display();
         }
         /**
         * 设置支付密码
         */
         public function setPayPass()
         {
            if($this->isAjax()){
                $paypass = $this->_post('paypass');
                $paypass2 = $this->_post('paypass2');
                if(!$paypass || !$paypass2){
                    die('数据不完整，请检查后再试');
                }
                $paypass != $paypass2 && die('两次支付密码不一致，请重新输入');
                $user = M('members')->field('user_pass, pin_pass')->where('id='.$this->uid)->find();
                !$user  && die('数据有误');
                if($user['user_pass']==md5($paypass)){
                    die('不能和登录密码相同，请重新输入');
                }
                if(M("members")->where('id='.$this->uid)->save(array('pin_pass'=>md5($paypass)))){
                    die('TRUE');
                }else{
                    echo '设置出错，刷新页面重试';   
                }
                
            }else{
                $this->display();
            } 
         }
         /**
         * 修改支付密码
         * 
         */
         public function editpaypass()
         {   
             if($this->isAjax()){
                $oldpass = $this->_post('oldpass');
                $paypass = $this->_post('paypass');
                $paypass2 = $this->_post('paypass2');
                if(!$oldpass || !$paypass || !$paypass2){
                    die('数据不完整，请检查后再试');
                }
                $paypass == $oldpass && die('新密码不能和旧密码相同，请重新输入');
                $paypass != $paypass2 && die('两次支付密码不一致，请重新输入');
                $user = M('members')->field('pin_pass')->where('id='.$this->uid)->find();
                !$user  && die('数据有误');
                if($user['pin_pass']!=md5($oldpass)){
                    die('支付密码不正确');   
                }
                if(M("members")->where('id='.$this->uid)->save(array('pin_pass'=>md5($paypass)))){
                    die('TRUE');
                }else{
                    echo '设置出错，刷新页面重试';   
                } 
                 
             }else{
                $this->display(); 
             }
         }
         
         /**
         * 修改登录密码
         * 
         */
         public function editpass()
         {
             if($this->isAjax()){
                $oldpass = $this->_post('oldpass');
                $password = $this->_post('password');
                $password2 = $this->_post('password2');
                if(!$oldpass || !$password || !$password2){
                    die('数据不完整，请检查后再试');
                }
                $password == $oldpass && die('新密码不能和旧密码相同，请重新输入');
                $password != $password2 && die('两次密码不一致，请重新输入');
                $user = M('members')->field('user_pass')->where('id='.$this->uid)->find();
                !$user  && die('数据有误');
                if($user['user_pass']!=md5($oldpass)){
                    die('旧密码不正确');   
                }
                if(M("members")->where('id='.$this->uid)->save(array('user_pass'=>md5($password)))){
                    die('TRUE');
                }else{
                    echo '设置出错，刷新页面重试';   
                } 
                 
             }else{
                $this->display(); 
             }
         }
         
         /**
         * 资金记录
         */
         public function  records()
         {
            $logtype = C('MONEY_LOG');
            $this->assign('log_type',$logtype);

            $map['uid'] = $this->uid;
            $list = getMoneyLog($map,15);
            $this->assign("list",$list['list']);        
            $this->assign("pagebar",$list['page']);    
            $this->assign("query", http_build_query($search));
            $this->display();
         }
         
         public function msg()
         {
             if($this->isAjax()){
                $id = $this->_get('id');
                $msg = M('inner_msg')->field('msg')->where('id='.$id.' and uid='.$this->uid)->find();
                if(count($msg)){
                    M('inner_msg')->where('id='.$id)->save(array('status'=>1));
                    echo $msg['msg'];
                }else{
                    echo '<font color=\'red\'>读取错误</font>';
                }

             }else{
                $map['uid'] = $this->uid;
                //分页处理
                import("ORG.Util.Page");
                $count = M('inner_msg')->where($map)->count('id');
                $p = new Page($count, 15);
                $page = $p->show();
                $Lsql = "{$p->firstRow},{$p->listRows}";
                //分页处理
                $list = M('inner_msg')->where($map)->order('status asc,id DESC')->limit($Lsql)->select();

                $this->assign("list",$list);
                $this->assign("pagebar",$page);
                $this->assign("count",$count);
                $this->display();     
             }
                
         }
        public function add(){

            require_once(C("APP_ROOT")."Lib/Sdk/Baofoo.class.php");
            $minfo = M("member_info")->field("idcard,real_name")->where("uid = {$this->uid}")->find();
            $baofoo = new Baofoo();
            $param = array(
                'id_card' => $minfo['idcard'],
                'id_holder' => $minfo['real_name'],
                'acc_no' => $_POST['acc_no'],
                'mobile' => $_POST['mobile'],
                'card_type' => 101,
                'PayCodeA' => $_POST['pay_code'],
            );
            $result = $baofoo->checkBank($param);
            if($result === false){
//                ajaxmsg('持卡人身份信息填写错误,验证失败',0);
                $this->error("持卡人身份信息填写错误,验证失败");
            }
            else {
                $data['uid'] = $this->uid;
                $data['acc_no'] = $_POST['acc_no'];
                $data['id_card'] = $minfo['idcard'];
                $data['id_holder'] = $minfo['real_name'];
                $data['pay_code'] = $_POST['pay_code'];
                $data['add_time'] = time();
                $data['mobile'] = $_POST['mobile'];
                $re = M("wap_bank")->add($data);
                $this->success("绑定成功");

            }
        }
        public function editbank(){
            $count = M("wap_bank")->where("uid = {$this->uid}")->count();
            if($count==0){
                $this->error("无法修改","/m/user");
            }
            $minfo = M("member_info")->field("idcard,real_name")->where("uid = {$this->uid}")->find();
            $bank = M("wap_bank")->where("uid = {$this->uid}")->find();
            $bankinfo = FS("Dynamic/wapbaofubank");

            $this->assign("bankinfo",$bankinfo);
            $this->assign("bank",$bank);
            $this->assign("minfo",$minfo);
            $this->display();
        }
        public function doeditbank(){
            $data['acc_no'] = $_POST['acc_no'];
            $data['pay_code'] = $_POST['pay_code'];
            $data['add_time'] = time();
            $data['mobile'] = $_POST['mobile'];
            $re = M("wap_bank")->where("uid = {$this->uid}")->save($data);
            if($re){
                $this->success("修改成功","/m/user/charge");
            }else{
                $this->error("修改失败","m/user/editbank");
            }
        }
        public function charge(){
            $count = M("wap_bank")->where("uid = {$this->uid}")->count();
            $wapbank = M("wap_bank")->where("uid = {$this->uid}")->find();
            $mstatus = M("members_status")->field("id_status")->where("uid = {$this->uid}")->find();
            if($mstatus['id_status'] !=1){
                $this->error("尚未完成实名认证");
            }
            $minfo = M("member_info")->field("idcard,real_name")->where("uid = {$this->uid}")->find();
            $minfo['idcard'] = hidecard($minfo['idcard'],1);
            $wapbank['pay_card'] = $wapbank['acc_no'];
            $wapbank['acc_no'] = hidecard($wapbank['acc_no'],1);

            $bankinfo = FS("Dynamic/wapbaofubank");
            $bank_config = FS("Dynamic/wapbaofubank_config");
            $this->assign("wapbank",$wapbank);
            $this->assign("count",$count);
            $this->assign("bankinfo",$bankinfo);
            $this->assign("bank_config",$bank_config);
            $this->assign("minfo",$minfo);
            $this->display();
        }
        //在线支付
        public function pay() {
            $map['uid'] = $this->uid;
            $account_money = M('member_money')->field('(account_money+back_money) account_money')->where($map)->find();
            $this->assign("account_money",$account_money['account_money']);
            $this->display();
        }
        
        public function baofuwappay(){
            if($_POST["pay_type"]==2){
                $this->kuaiqianpay();
                exit;
            }
            $payconfig = FS("Dynamic/wappayconfig");
            $baofu_config = $payconfig['baofuwap'];
            $path = C("APP_ROOT")."Lib/Pay/baofuwap/";
            $order = date("YmdHis").rand(10000,99999);
            $bank = M("wap_bank")->where("uid={$this->uid}")->find();
            $data_content["txn_sub_type"] = "01";
            $data_content["biz_type"] = "0000";
            $data_content["terminal_id"] = $baofu_config["TerminalID"];
            $data_content["member_id"] = $baofu_config["MemberID"];
            $data_content["pay_code"] = $bank['pay_code'];
            $data_content["acc_no"] = $bank['acc_no'];
            $data_content['id_card_type'] = "01";
            $data_content['id_card'] = $bank['id_card'];
            $data_content['id_holder'] = $bank['id_holder'];
            $data_content['mobile'] = $bank['mobile']==""?"":$bank['mobile'];
            $data_content['trans_id'] = $order;
            $data_content['txn_amt'] = $_POST['money']*100;//单位分
            $data_content['trade_date'] = Date("YmdHis",time());
            $data_content['commodity_name'] = "充值";
            $data_content['commodity_amount'] = "1";
//            $data_content['user_name'] = $bank['user_name'];
            $data_content['page_url'] = "http://".$_SERVER['HTTP_HOST']."/m/user";
            $data_content['return_url'] = "http://".$_SERVER['HTTP_HOST']."/m/user/paynotice";
            $data_content['additional_info'] = "";
            $json_data = trim(json_encode($data_content));

            $data['version'] = "4.0.0.0";
            $data['input_charset'] = 1;
            $data['language'] = 1;
            $data['terminal_id'] =$baofu_config["TerminalID"];
            $data['txn_type'] = "03311";
            $data['txn_sub_type'] = "01";
            $data["member_id"] = $baofu_config["MemberID"];
            $data['data_type'] = "json";
            require_once(C("APP_ROOT")."Lib/Pay/baofuwap/BaofooSdk.php");
            $baofooSdk = new BaofooSdk($baofu_config["MemberID"], $baofu_config["TerminalID"],"json",$path.'bfkey_100000178@@100000916.pfx',$path.'baofoo_pub.cer',$baofu_config["pkey"]);
            $encode =mb_detect_encoding($json_data, "UTF-8,GB2312,GBK");
            if (trim($encode) == "GBK" or trim($encode) == "GB2312")
            {
                $string = iconv($encode,"UTF-8",$json_data);
            }
            else
            {
                $string = $json_data;
            }
            $data["data_content"] = $baofooSdk->encryptedByPrivateKey($string);
            $data['back_url'] = "http://".$_SERVER['HTTP_HOST']."/m/user";
            $paydetail['uid'] = $this->uid;
            $paydetail['nid'] = "baofuwap".$order;
            $paydetail['money'] = $_POST['money'];
            $paydetail['status'] = 0;
            $paydetail['tran_id'] = $order;
            $paydetail['way'] = "baofuwap";
            $paydetail['add_time']=time();
            $paydetail['add_ip'] = get_client_ip();

            M( "member_payonline" )->add($paydetail);


            $this->submit($data,"https://tgw.baofoo.com/apipay/wap");

        }
        public function paynotice(){
            $payconfig = FS("Dynamic/wappayconfig");
            $baofu_config = $payconfig['baofuwap'];
            $path = C("APP_ROOT")."Lib/Pay/baofuwap/";
            $data_content = $_POST['data_content'];
            require_once(C("APP_ROOT")."Lib/Pay/baofuwap/BaofooSdk.php");
            ob_start();
            $baofooSdk = new BaofooSdk($baofu_config["MemberID"], $baofu_config["TerminalID"],"json",$path.'bfkey_100000178@@100000916.pfx',$path.'baofoo_pub.cer',$baofu_config["pkey"]);
            $endata_content = $baofooSdk->decryptByPublicKey($data_content);
            $data = json_decode($endata_content);
            if($data->resp_code=="0000"){
                $money = $data->succ_amt;
                $trans_id = $data->trans_id;
                $res = M("member_payonline")->where("tran_id = '{$trans_id}'")->save(array("status"=>1));
                $uid = M("member_payonline")->where("tran_id = '{$trans_id}'")->find();
                $rem = memberMoneyLog($uid['uid'],3,$money,"充值订单号:".$trans_id,0,'@网站管理员@');
                $vx = M("members")->field("user_phone,user_name")->find($uid['uid']);
                M("wap_bank")->where("uid={$uid['uid']}")->save(array("is_charge"=>1));
                SMStip("payonline",$vx['user_phone'],array("#USERANEM#","#DATE#","#MONEY#"),array($vx['user_name'],date('Y-m-d H:i:s'),$money));
                echo "OK";
            }
            ob_end_clean();

        }
        private function submit($data,$submitUrl){
            $inputstr = "";
            foreach($data as $key=>$v){
                $inputstr .= '
		<input type="hidden"  id="'.$key.'" name="'.$key.'" value="'.$v.'"/>
		';
            }

            $form = '
		<form action="'.$submitUrl.'" name="pay" id="pay" method="POST">
';
            $form.=	$inputstr;
            $form.=	'
</form>
		';

            $html = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>支付跳转中.....</title>
        </head>
<body>

        ';
            $html.=	$form;
            $html.=	'
        <script type="text/javascript">
			document.getElementById("pay").submit();
		</script>
        ';
            $html.= '
        </body>
</html>
		';

            Mheader('utf-8');
            echo $html;
            exit;
        }


        /**
         * 快钱支付
         */
        public function kuaiqianpay(){
            $members = M('members')->where(array(id=>$this->uid))->find();
            $member_info = M('member_info')->where(array(uid=>$this->uid))->find();
            $member_banks = M('member_banks')->where(array(uid=>$this->uid))->find();
            require_once(C("APP_ROOT")."Lib/Pay/kuaiqianpay/pci_query.php");
            require_once(C("APP_ROOT")."Lib/Pay/kuaiqianpay/DynNum.php");
            require_once(C("APP_ROOT")."Lib/Pay/kuaiqianpay/pur.php");
            $payconfig = FS("Dynamic/wappayconfig");
            $kuaiqian_config = $payconfig['kuaiqian'];
            $merchantId = $kuaiqian_config["merchantId"];
            $certPassword = $kuaiqian_config["pkey"];
            $customerId = $this->uid;
            $amount = $_POST["money"];
            $externalRefNumber = date("YmdHis").rand(10000,99999);
            $phone = $members["user_phone"];
            $pan = $member_banks["bank_num"];
            $cardHolderName = $member_info["real_name"];
            $cardHolderId = $member_info["idcard"];
            $bankId = $_POST["pay_code"];
            $query_xml = kuaiqian_query($merchantId,$certPassword,$customerId,$storablePan);
            $query_code = $this->getNodeVal("responseCode",$query_xml);
            if($query_code=="00"){
                $dynNum_xml = kuaiqian_dynNum($merchantId,$certPassword,$customerId,$phone,$amount,$pan,$cardHolderName,$cardHolderId,$externalRefNumber,$bankId);
                $dynNum_xml = str_replace('<MasMessage xmlns="http://www.99bill.com/mas_cnp_merchant_interface">',"",$dynNum_xml);
                $dynNum_xml = str_replace('</MasMessage>','',$dynNum_xml);
                $data = array();
                $data["merchantId"] = $this->getNodeVal("merchantId",$dynNum_xml);
                $data["certPassword"] = $certPassword;
                $data["customerId"] = $this->getNodeVal("customerId",$dynNum_xml);
                $data["cardNo"] = $pan;//$this->getNodeVal("cardno",$dynNum_xml);
                $data["externalRefNumber"] = $externalRefNumber;
                $data["token"] = $this->getNodeVal("token",$dynNum_xml);
                $data["bankId"] = $bankId;
            }else{
                echo '<script type="text/javascript:;">document.write("操作失败！");setTimeout(function(){window.location.href="/m";},2000);</script>';
            }
            $str = '<form name="frm" action="/M/user/kuaiqianpay2" method="post">';
            foreach($data as $key=>$value){
                $str .= '<input name="'.$key.'" type="hidden" value="'.$value.'"/><br/>';
            }
            $str .= '充值金额:<input name="amount" type="text" value="'.$amount.'"/><br/>';
            $str .= '手机号码:<input name="validCode" type="text" value="'.$phone.'"/><br/>';
            $str .= '手机验证码:<input name="phone" type="text" value=""/><br/>';
            $str .= '<input type="submit" value="充值"/>';
            $str .= '</form>';
            echo $str;
        }

        function kuaiqianpay2(){
            require_once(C("APP_ROOT")."Lib/Pay/kuaiqianpay/pci_query.php");
            require_once(C("APP_ROOT")."Lib/Pay/kuaiqianpay/DynNum.php");
            require_once(C("APP_ROOT")."Lib/Pay/kuaiqianpay/pur.php");
            $paydetail['uid'] = $this->uid;
            $paydetail['nid'] = "kuaiqianpay".$_POST["externalRefNumber"];
            $paydetail['money'] = $_POST["amount"];
            $paydetail['status'] = 0;
            $paydetail['tran_id'] = $_POST["externalRefNumber"];
            $paydetail['way'] = "kuaiqian";
            $paydetail['add_time']=time();
            $paydetail['add_ip'] = get_client_ip();
            M( "member_payonline" )->add($paydetail);
            $pur_xml = kuaiqian_pur($_POST["merchantId"],$_POST["certPassword"],$_POST["customerId"],$_POST["externalRefNumber"],$_POST["cardNo"],$_POST["amount"],$_POST["phone"],$_POST["validCode"],$_POST["token"]);
            if($this->getNodeVal("responseCode",$pur_xml)=="00"){
                $res = M("member_payonline")->where("tran_id = '{$_POST["externalRefNumber"]}'")->save(array("status"=>1));
                $uid = M("member_payonline")->where("tran_id = '{$_POST["externalRefNumber"]}'")->find();
                $rem = memberMoneyLog($uid['uid'],3,$_POST["amount"],"充值订单号:".$_POST["externalRefNumber"],0,'@网站管理员@');
                $vx = M("members")->field("user_phone,user_name")->find($uid['uid']);
                M("wap_bank")->where("uid={$uid['uid']}")->save(array("is_charge"=>1));
                SMStip("payonline",$vx['user_phone'],array("#USERANEM#","#DATE#","#MONEY#"),array($vx['user_name'],date('Y-m-d H:i:s'),$_POST["amount"]));
                echo '恭喜，充值成功！<a href="/m">返回</a>';
            }else{
                echo '充值失败！<script type="text/javascript:;">setTimeout(function(){window.location.href="/m";},2000););</script>';
            }
        }

        function getNodeVal($node,$xml){
            $preg = "/\<{$node}\>(.*)\<\/{$node}\>/";
            preg_match($preg,$xml,$matches);
            return $matches[1];
        }

        //实名认证
        public function idcard() {
            $ids = M('members_status')->getFieldByUid($this->uid, 'id_status');
            if ($ids == 1) {
                $vo = M("member_info")->field('idcard,real_name')->find($this->uid);
                $this->assign("vo", $vo);
            }
            $id5config = FS("Dynamic/id5");

            $this->assign("id_status", $ids);
            $this->assign("id5_status", $id5config['enable']);
            $this->display();
        }
        public function saveid() {
            $data['real_name'] = text($_POST['realname']);
            $data['idcard'] = text($_POST['idcard']);
            $data['up_time'] = time();
            $data1['idcard'] = text($_POST['idcard']);
            $data1['up_time'] = time();
            $data1['uid'] = $this->uid;
            $data1['status'] = 0;
            $c = M('name_apply')->where("idcard = {$data1['idcard']}")->count('uid');
            $b = M('name_apply')->where("uid = {$this->uid}")->count('uid');
            if ($b == 1) {
                M('name_apply')->where("uid ={$this->uid}")->save($data1);
            } else {
                M('name_apply')->add($data1);
            }
            if (empty($data['real_name']) || empty($data['idcard']))
                ajaxmsg("请填写真实姓名和身份证号码", 0);
            $xuid = M('member_info')->getFieldByIdcard($data['idcard'], 'uid');
            if ($xuid > 0 && $xuid != $this->uid)
                ajaxmsg("此身份证号码已被人使用", 0);

            $id5config = FS("Dynamic/id5");
            if ($id5config['enable'] == 0) {
                $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
                if ($c == 1) {
                    $newid = M('member_info')->where("uid = {$this->uid}")->save($data);
                } else {
                    $data['uid'] = $this->uid;
                    $newid = M('member_info')->add($data);
                }

                if ($newid) {
                    $ms = M('members_status')->where("uid={$this->uid}")->setField('id_status', 3);
                    if ($ms == 1) {
                        ajaxmsg();
                    } else {
                        $dt['uid'] = $this->uid;
                        $dt['id_status'] = 3;
                        M('members_status')->add($dt);
                    }
                    ajaxmsg();
                } else
                    ajaxmsg("保存失败，请重试", 0);
            }else {
                $config['query_url'] = "http://121.40.136.150:8080/IdInDataAu/api/authenInfoApi.htm"; //请求地址
                $config['user_id'] = $id5config['ID5ID']; //商户ID
                $config['md5_key'] = $id5config['md5_key']; //MD5密钥
                $config['des_key'] = $id5config['des_key']; //DES密钥

                require C("APP_ROOT")."Lib/ID5/sendIdCardAuthen.php";
                $idcard = new sendIdCardAuthen($config);

                $idcard->set($_REQUEST['realname'], $_REQUEST['idcard']);
                $id5_status=$idcard->checkOnline();
                if($id5_status==3){
                    $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
                    if ($c == 1) {
                        $newid = M('member_info')->where("uid = {$this->uid}")->save($data);
                    } else {
                        $data['uid'] = $this->uid;
                        $newid = M('member_info')->add($data);
                    }

                    session('idcardimg', NULL);
                    session('idcardimg2', NULL);
                    if ($newid) {
                        $ms = M('members_status')->where("uid={$this->uid}")->setField('id_status', 1);
                        setMemberStatus($newid, 'id', 1, 10, '实名');
                        if ($ms == 1) {
                            ajaxmsg();
                        } else {
                            $dt['uid'] = $this->uid;
                            $dt['id_status'] = 1;
                            M('members_status')->add($dt);
                        }
                        ajaxmsg();
                    } else
                        ajaxmsg("保存失败，请重试", 0);

                }else{
                    ajaxmsg("实名认证失败。错误原因:".$id5_status, 0);
                }

            }
        }
        //绑定银行卡
        public function bank(){
            $ids = M('members_status')->getFieldByUid($this->uid,'id_status');
            if($ids==1){
                $voinfo = M("member_info")->field('idcard,real_name')->find($this->uid);
                $vobank = M("member_banks")->field(true)->where("uid = {$this->uid} and bank_num !=''")->find();
                $vobank['bank_province'] = M('area')->getFieldByName("{$vobank['bank_province']}",'id');
                $vobank['bank_city'] = M('area')->getFieldByName("{$vobank['bank_city']}",'id');
                $borrowconfig = require C("ROOT_URL") . "Dynamic/borrowconfig.php";
                $bank_name = $borrowconfig['BANK_NAME'];
                $this->assign("voinfo",$voinfo);
                $this->assign("vobank",$vobank);
                $this->assign("bank_list",$bank_name);
                $this->assign('edit_bank', $this->glo['edit_bank']);
            }else{  
                $this->error("您还未完成身份验证，请先进行实名认证！","/M/User/idcard");
            }
            $this->display();
        }
        public function getarea(){
		$rid = intval($_GET['rid']);
		if(empty($rid)) return;
		$map['reid'] = $rid;
		$alist = M('area')->field('id,name')->order('sort_order DESC')->where($map)->select();
		if(count($alist)===0){
			$str="<option value=''>--该地区下无下级地区--</option>\r\n";
		}else{
			foreach($alist as $v){
				$str.="<option value='{$v['id']}'>{$v['name']}</option>\r\n";
			}
		}
		$data['option'] = $str;
		$res = json_encode($data);
		echo $res;
	}
        public function bindbank(){

	    $bank_info = M('member_banks')->field("uid, bank_num")->where("uid=".$this->uid)->find();
	
		!$bank_info['uid'] && $data['uid'] = $this->uid;
		$data['bank_num'] = text($_POST['account']);
		$data['bank_name'] = text($_POST['bankname']);
		$data['bank_address'] = text($_POST['bankaddress']);
		$data['bank_province'] = text($_POST['province']);
		$data['bank_city'] = text($_POST['cityName']);
		$data['add_ip'] = get_client_ip();
		$data['add_time'] = time();
//                $data['account_type']=$_POST['account_type'];
//                $data['pub_accname']=$_POST['pub_accname'];

		if($bank_info['uid']){
			/////////////////////新增银行卡修改锁定开关 开始 20130510 fans///////////////////////////
			if(intval($this->glo['edit_bank'])!= 1 && $bank_info['bank_num']){
				ajaxmsg("为了您的帐户资金安全，银行卡已锁定，如需修改，请联系客服", 0 );
			}
			/////////////////////新增银行卡修改锁定开关 结束 20130510 fans///////////////////////////
                        if($bank_info['bank_num']!=0){
                            if(session('code_temp')<>$_POST['phone_code'] || $_POST['phone_code']==""){
                                ajaxmsg("手机验证码输入错误！", 0 );
                            }
                        }
			$old = text($_POST['oldaccount']);
			if($bank_info['bank_num'] && $old <> $bank_info['bank_num']) ajaxmsg('原银卡号不对',0);
			$newid = M('member_banks')->where("uid=".$this->uid)->save($data);
		}else{
			$newid = M('member_banks')->add($data);
		}
		if($newid){
			MTip('chk2',$this->uid);
			ajaxmsg();
		}
		else ajaxmsg('操作失败，请重试',0);
	}
        public function sendphone() {
            
            $smsTxt = FS("Dynamic/smstxt");
            $smsTxt = de_xie($smsTxt);

            //手机认证验证
            $verify = M('members_status') -> getFieldByUid($this -> uid, 'phone_status');
            if ($verify == 0){
                ajaxmsg("您尚未进行手机验证,请<a href='/member/verify?id=1#fragment-2'><span style='color:red;'>【验证】</span></a>后再进行银行卡绑定！", 2);
            }else{
                $phone = M('members') -> getFieldById($this -> uid, 'user_phone');
                $code = rand_string_reg(6, 1, 2);
                $datag = get_global_setting();
                $is_manual = $datag['is_manual'];
                $res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
                if($res){
                    ajaxmsg('验证码发送成功！',1);
                }else{
                    ajaxmsg("验证码发送失败，请<a href='javascript:;' onclick='sendMobileValidSMSCode()' id='btnSendMsg'><span style='color:red;'>【重新发送】</span></a>！",0);
                }
            }

	}
        //手机认证
        public function cellphone(){
            $isid = M('members_status')->getFieldByUid($this->uid,'phone_status');
            $phone = M('members')->getFieldById($this->uid,'user_phone');
            $this->assign("phone",$phone);
            $this->assign("phone_status",$isid);
            $this->display();
        }
        public function validatephone(){
            $phonestatus = M('members_status')->getFieldByUid($this->uid,'phone_status');
            if($phonestatus==1) ajaxmsg("手机已经通过验证",1);
            if( is_verify($this->uid,text($_POST['code']),2,10*60) ){
                    $updata['phone_status'] = 1;
                    if(!session("temp_phone")) ajaxmsg("验证失败",0);

                    $updata1['user_phone'] = session("temp_phone");
                    $a = M('members')->where("id = {$this->uid}")->count('id');
                    if($a==1) $newid = M("members")->where("id={$this->uid}")->save($updata1);
                    else{
                            M('members')->where("id={$this->uid}")->setField('user_phone',session("temp_phone"));
                    }

                    $updata2['cell_phone'] = session("temp_phone");
                    $b = M('member_info')->where("uid = {$this->uid}")->count('uid');
                    if($b==1) $newid = M("member_info")->where("uid={$this->uid}")->save($updata2);
                    else{
                            $updata2['uid'] = $this->uid;
                            $updata2['cell_phone'] = session("temp_phone");
                            M('member_info')->add($updata2);
                    }
                    $c = M('members_status')->where("uid = {$this->uid}")->count('uid');
                    if($c==1) $newid = M("members_status")->where("uid={$this->uid}")->save($updata);
                    else{
                            $updata['uid'] = $this->uid;
                            $newid = M('members_status')->add($updata);
                    }
                    if($newid){
                            $newid = setMemberStatus($this->uid, 'phone', 1, 10, '手机');
                            ajaxmsg();

                    }
                    else  ajaxmsg("验证失败",0);
            }else{
                    ajaxmsg("验证校验码不对，请重新输入！",2);
            }
        }

    }
?>
