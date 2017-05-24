<?php
    /**
    * 手机版 用户中心
    */
    class UserAction extends MobileAction
    {
        
         public function index()
         {   
             $this->display();
         }
         
         /**
         * 个人资料
         */
         public function info()
         {
             $this->assign("kflist",get_admin_name());
             $pre = C('DB_PREFIX');
             $rule = M('ausers u')->field('u.id,u.qq,u.phone')->join("{$pre}members m ON m.customer_id=u.id")->where("u.is_kf =1 and m.customer_id={$minfo['customer_id']}")->select();
             foreach($rule as $key=>$v){
                $list[$key]['qq']=$v['qq'];
                $list[$key]['phone']=$v['phone'];
             }
             $this->assign("kfs",$list);
        
             $minfo =getMinfo($this->uid,true);

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
                    $this->error("请用电脑登录先绑定银行卡后申请体现！");
                    
                    
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
            
             $this->assign("dc",M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money'));
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
             $this->display();
         }
         /**
         * 设置支付密码
         */
         public function setPayPass()
         {
            if($this->isAjax()){
                $password = $this->_post('password');
                $paypass = $this->_post('paypass');
                $paypass2 = $this->_post('paypass2');
                if(!$password || !$paypass || !$paypass2){
                    die('数据不完整，请检查后再试');
                }
                $paypass == $password && die('不能和登陆密码相同，请重新输入');
                $paypass != $paypass2 && die('两次支付密码不一致，请重新输入');
                $user = M('members')->field('user_pass, pin_pass')->where('id='.$this->uid)->find();
                !$user  && die('数据有误');
                if($user['user_pass']!=md5($password)){
                    die('登陆密码不正确');   
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
        
    }
?>
