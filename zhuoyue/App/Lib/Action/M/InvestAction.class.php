<?php
    class InvestAction extends HCommonAction
    {
        public function detail()
        {   
            $pre = C('DB_PREFIX');
            $id = intval($_GET['id']);
            
            $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";

            $borrowinfo = M("borrow_info bi")
                            ->field('bi.*,ac.title,ac.id as aid')
                            ->join('nuomi_article ac on ac.id= bi.danbao')
                            ->where('bi.id='.$id)
                            ->find();
            
            if(!$borrowinfo || ($borrowinfo['borrow_status']==0 && $this->uid!=$borrowinfo['borrow_uid']) )
                $this->error("数据有误");
            $borrowinfo['biao'] = $borrowinfo['borrow_times'];
            $borrowinfo['need'] = $borrowinfo['borrow_money'] - $borrowinfo['has_borrow'];
            $borrowinfo['lefttime'] =$borrowinfo['collect_time'] - time();
            $borrowinfo['progress'] = getFloatValue($borrowinfo['has_borrow']/$borrowinfo['borrow_money']*100,2);
            $borrow_config = require C("APP_ROOT")."Conf/borrow_config.php";
            $repayment_type = $borrow_config['REPAYMENT_TYPE'];
            $this->assign("repayment_type",$repayment_type); 
//            dump($borrowinfo);
//            exit;
            $this->assign("vo",$borrowinfo);  
            //borrowinfo
       
            //此标借款利息还款相关情况
            //memberinfo
            $memberinfo = M("members")
                            ->field("id,customer_name,customer_id,user_name,reg_time,credits")
                            ->where("id={$borrowinfo['borrow_uid']}")
                            ->find();
            $this->assign("minfo",$memberinfo);
            //memberinfo
            $this->assign("Bconfig",$Bconfig);
            $this->assign("gloconf",$this->gloconf);
            
            //还款计划
            $repay_list = M("investor_detail")->field("sum(capital) as capital,sum(interest) as interest,deadline")->where("borrow_id={$id} and status <> 0")->group("sort_order")->select();
            $this->assign("repay_list",$repay_list);
            //还款计划
            //投资记录
            
            #分页处理#
            $list = M("borrow_investor as b")
                ->join(C(DB_PREFIX)."members as m on  b.investor_uid = m.id")
                ->join(C(DB_PREFIX)."borrow_info as i on  b.borrow_id = i.id")
                ->field('i.borrow_interest_rate, i.repayment_type, b.investor_capital, b.add_time, b.is_auto, m.user_name')
                ->where('b.borrow_id='.$id)->order('b.id')->select();
            
            $this->assign("invest_list",$list);
            //投资记录
            
            $this->display();
        }
        
        /**
        * 手机普通标投资
        */
        public function Invest()
        {   
            if(!$this->uid){
                if($this->isAjax()){
                    die("请先登录后投资");   
                }else{
                    $this->redirect('M/pub/login');       
                }
            }
            if($this->isAjax()){   // ajax提交投资信息
         
                $borrow_id = intval($this->_get('bid'));
                $invest_money = intval($this->_post('invest_money'));
                $paypass = $this->_post('paypass');
                $invest_pass = isset($_POST['invest_pass'])?$_POST['invest_pass']:'';

                $status = checkInvest($this->uid, $borrow_id, $invest_money, $paypass, $invest_pass);
                if($status == 'TRUE'){
                    $done = investMoney($this->uid,$borrow_id,$invest_money);
                    if($done === true){
                        die('TRUE');
                    }
                    elseif($done){
                        die($done);
                    }else{
                        die(L('investment_failure'));
                    }   
                }else{
                    die($status);   
                }
            }else{  
                $borrow_id = $this->_get('bid');
                $borrow_info = M("borrow_info")
                    ->field('borrow_duration, borrow_money, borrow_interest, borrow_interest_rate, has_borrow,
                             borrow_min, borrow_max, password, repayment_type')
                    ->where("id='{$borrow_id}'")
                    ->find();
                $this->assign('borrow_info', $borrow_info);    
                
                $user_info = M('member_money')
                                ->field("account_money+back_money as money ")
                                ->where("uid='{$this->uid}'")
                                ->find();
                $this->assign('user_info', $user_info);
                $paypass = M("members")->field('pin_pass')->where('id='.$this->uid)->find();
                $this->assign('paypass', $paypass['pin_pass']);
                $this->display();   
            }
        }
    }
?>
