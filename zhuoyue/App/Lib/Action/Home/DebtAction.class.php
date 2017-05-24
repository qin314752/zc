<?php
    /**
    * 普通标债权转让控制器类
    */
    class DebtAction extends HCommonAction
    {
        
        /**
        * 债权转让列表
        * 
        */
        public function index()
        {
			$curl = $_SERVER['REQUEST_URI'];
		$urlarr = parse_url($curl);
		parse_str($urlarr['query'],$surl);//array获取当前链接参数，2.
       $urlArr = array('borrow_type','borrow_status','borrow_duration','leve');
		$leveconfig = FS("Dynamic/leveconfig");
		foreach($urlArr as $v){
			$newpars = $surl;//用新变量避免后面的连接受影响
			unset($newpars[$v],$newpars['type'],$newpars['order_sort'],$newpars['orderby']);//去掉公共参数，对掉当前参数
			foreach($newpars as $skey=>$sv){
				if($sv=="all") unset($newpars[$skey]);//去掉"全部"状态的参数,避免地址栏全满
			}
			
			$newurl = http_build_query($newpars);//生成此值的链接,生成必须是即时生成
			$searchUrl[$v]['url'] = $newurl;
			$searchUrl[$v]['cur'] = empty($_GET[$v])?"all":text($_GET[$v]);
		}
        $searchMap['borrow_type'] = array("all"=>"不限","1"=>"信用标","2"=>"担保标","3"=>"秒还标","4"=>"净值标","5"=>'抵押标');
		$searchMap['borrow_status'] = array("all"=>"不限","2"=>"进行中","4"=>"复审中","6"=>"还款中","7"=>"已完成");
		$searchMap['borrow_duration'] = array("all"=>"不限","0-3"=>"3个月以内","3-6"=>"3-6个月","6-12"=>"6-12个月","12-24"=>"12-24个月");
		$searchMap['leve'] = array("all"=>"不限","{$leveconfig['1']['start']}-{$leveconfig['1']['end']}"=>"{$leveconfig['1']['name']}","{$leveconfig['2']['start']}-{$leveconfig['2']['end']}"=>"{$leveconfig['2']['name']}","{$leveconfig['3']['start']}-{$leveconfig['3']['end']}"=>"{$leveconfig['3']['name']}","{$leveconfig['4']['start']}-{$leveconfig['4']['end']}"=>"{$leveconfig['4']['name']}","{$leveconfig['5']['start']}-{$leveconfig['5']['end']}"=>"{$leveconfig['5']['name']}","{$leveconfig['6']['start']}-{$leveconfig['6']['end']}"=>"{$leveconfig['6']['name']}","{$leveconfig['7']['start']}-{$leveconfig['7']['end']}"=>"{$leveconfig['7']['name']}");

		$search = array();
		//搜索条件
		foreach($urlArr as $v){
			if($_GET[$v] && $_GET[$v]<>'all'){
				switch($v){
					case 'leve':
						$barr = explode("-",text($_GET[$v]));
						$search["m.credits"] = array("between",$barr);
					break;
                    case 'borrow_type':
                        $search["b.".$v] = intval($_GET[$v]);
                        break;
					case 'borrow_status':
						$search["b.".$v] = intval($_GET[$v]);
					break;
					default:
						$barr = explode("-",text($_GET[$v]));
						$search["b.".$v] = array("between",$barr);
					break;
				}
			}
		}
	
		if($search['b.borrow_status']==0){
			$search['b.borrow_status']=array("in","2,4,6,7");
		}

            if($_REQUEST['searchkeywords']!="输入项目标题或用户名"){
                $str = "%".urldecode($_REQUEST['searchkeywords'])."%";
//		if($_GET['is_keyword']=='1'){
//			$search['m.user_name']=array("like",$str);
//		}elseif($_GET['is_keyword']=='2'){
                $search['b.borrow_name']=array("like",$str);
            }

		
		$parm['map'] = $search;
         
       
        //dump(M()->GetLastsql());exit;
		
            D("DebtBehavior");
            $Debt = new DebtBehavior();
            $list = $Debt->listAll($parm,5,true);
            foreach($list['data'] as $key=>$v){
                $project_pic=unserialize($list['data'][$key]['updata']);
                $list['data'][$key]['project_pic_thumb']=$project_pic[0]['img'];
            }
            $this->assign("list", $list);
			$this->assign("searchUrl",$searchUrl);
        	$this->assign("searchMap",$searchMap);
            $this->display();  
        }
        
        /**
        * 购买债权提示框
        * 
        */
        public function buydebt()
        {
			if(!$this->uid)  ajaxmsg("请先登录",0);
            $invest_id = intval($_REQUEST['invest_id']);
            !$invest_id && ajaxmsg(L('参数错误'),0);
            $debt = M("invest_detb")->field("transfer_price, money")->where("invest_id={$invest_id}")->find();
            $buy_user = M("member_money")->field("account_money, back_money")->where("uid={$this->uid}")->find();
            $account =  $buy_user['account_money'] + $buy_user['back_money'];
            /**************增加支付密码判断*****************/
             $pin_pass = M("members")->field("pin_pass")->where("id = {$this->uid}")->find();
             $this->assign("pin_pass",$pin_pass);
            /**************增加支付密码判断*****************/
            $this->assign('debt', $debt);
            $this->assign('account', $account);
            $this->assign('invest_id', $invest_id);
            $d['content'] = $this->fetch();
            echo json_encode($d);
            
        }
        
        /**
        * 确认购买
        * 流程： 检测购买条件
        * 购买
        */
        public function buy()
        {
            $paypass = strval($_REQUEST['paypass']);
            $invest_id = intval($_REQUEST['invest_id']);
            
            D("DebtBehavior");
            $Debt = new DebtBehavior($this->uid);
            // 检测是否可以购买  密码是否正确，余额是否充足
            $result = $Debt->buy($paypass, $invest_id);

            if($result === 'TRUE'){
                ajaxmsg('购买成功');
            }else{
                ajaxmsg($result, 1);
            }
        }
    }
?>
