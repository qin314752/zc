<?php
// 金糯米内核类库，2014-06-11_listam
class CreditAction extends MCommonAction {

    public function index(){
		$this->display();
    }
    public function auth()
    {
        $user = M('members')->where("id={$this->uid}")->find();
        if(!is_array($user)) $this->error("数据有误");
        $this->assign('user',$user);
        $this->getIntegration($this->uid);

        $leveconfig = FS("Dynamic/leveconfig");
        $this->assign('leveconfig', $leveconfig);

        //上传资料--积分
        $integration = FS("Dynamic/integration");
        $this->assign('integration', $integration);

        $uploadtype = FilterUploadType($integration);

        $this->assign('uploadtype', $uploadtype);
        $this->assign('upload_num', count($uploadtype));

        // 检查认证填写状态 $this->checkStatus（）
        $this->checkStatus();

        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function detail(){
		$user = M('members')->where("id={$this->uid}")->find();
		if(!is_array($user)) $this->error("数据有误");
		$this->assign('user',$user);

		$logtype = C('MONEY_LOG');
		$this->assign('log_type',$logtype);

		$map['uid'] = $this->uid;
		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['log_type'])){
				$map['type'] = intval($_GET['log_type']);
				$search['log_type'] = intval($_GET['log_type']);
		}

		$list = getCreditsLog($map,15);

		$this->assign('search',$search);
		$this->assign("list",$list['list']);		
		$this->assign("pagebar",$list['page']);	
        $this->assign("query", http_build_query($search));

		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
	
	public function integraldetail(){
    	$user = M('members')->where("id={$this->uid}")->find();
		if(!is_array($user)) $this->error("数据有误");
		$this->assign('user',$user);

		$logtype = C('INTEGRAL_LOG');
		$this->assign('log_type',$logtype);

		$map['uid'] = $this->uid;
		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}

		if(!empty($_GET['log_type'])){
				$map['type'] = intval($_GET['log_type']);
				$search['log_type'] = intval($_GET['log_type']);
		}

		$list = getIntegralLog($map,15);
		// var_dump($list);

		$this->assign('search',$search);
		$this->assign("list",$list['list']);		
		$this->assign("pagebar",$list['page']);	
        $this->assign("query", http_build_query($search));
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
	
	//信用积分记录导出
	public function export(){
		import("ORG.Io.Excel");

		$map=array();
		$map['uid'] = $this->uid;
		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['log_type'])){
				$map['type'] = intval($_GET['log_type']);
				$search['log_type'] = intval($_GET['log_type']);
		}

		$list = getMoneyLog($map,100000);
		
		$logtype = C('MONEY_LOG');
		$row=array();
		$row[0]=array('序号','发生日期','类型','影响金额','可用余额','冻结金额','待收金额','说明');
		$i=1;
		foreach($list['list'] as $v){
				$row[$i]['i'] = $i;
				$row[$i]['uid'] = date("Y-m-d H:i:s",$v['add_time']);
				$row[$i]['card_num'] = $v['type'];
				$row[$i]['card_pass'] = $v['affect_money'];
				$row[$i]['card_mianfei'] = $v['account_money']+$v['back_money'];
				$row[$i]['card_mianfei0'] = $v['freeze_money'];
				$row[$i]['card_mianfei1'] = $v['collect_money'];
				$row[$i]['card_mianfei2'] = $v['info'];
				$i++;
		}
		
		$xls = new Excel_XML('UTF-8', false, 'moneyLog');
		$xls->addArray($row);
		$xls->generateXML("moneyLog");
	}

	//投资积分记录导出
	public function integralexport(){
		import("ORG.Io.Excel");

		$map=array();
		$map['uid'] = $this->uid;
		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['log_type'])){
				$map['type'] = intval($_GET['log_type']);
				$search['log_type'] = intval($_GET['log_type']);
		}

		$list = getIntegralLog($map,100000);
		
		$logtype = C('INTEGRAL_LOG');
		$row=array();
		$row[0]=array('序号','发生日期','类型','影响积分','剩余活跃积分','总积分','说明');
		$i=1;
		foreach($list['list'] as $v){
				$row[$i]['i'] = $i;
				$row[$i]['uid'] = date("Y-m-d H:i:s",$v['add_time']);
				$row[$i]['card_num'] = $v['type'];
				$row[$i]['card_pass'] = $v['affect_integral'];
				$row[$i]['card_pass2'] = $v['active_integral'];
				$row[$i]['card_mianfei'] = $v['account_integral'];
				$row[$i]['card_mianfei2'] = $v['info'];
				$i++;
		}
		
		$xls = new Excel_XML('UTF-8', false, 'IntegralLog');
		$xls->addArray($row);
		$xls->generateXML("IntegralLog");
	}
    
    private function checkStatus()
    {
        $status = M("members_status")->where('uid='.$this->uid)->find();
                                         
        $status2 = $this->getDataInfo();
        $status = $status + $status2; 
        $this->assign('status', $status);
    }
    private function getDataInfo()
    {
        $arr = array();
        $model=M('member_data_info');
        $list = $model->field('id,status,type,deal_credits')->where("uid={$this->uid}")->select();
        if(count($list)){
            foreach($list as $key=>$val)
            {
                $arr[$val['type']] = $val;
            }
        }
        return $arr;
    }
    
    /**
    * 获取信用总积分和投标总积分
    * 
    * @param int    $uid   // 用户id
    */
    private function getIntegration($uid)
    {
        $array = array();
        $uid = intval($uid);
        // 上传资料积分
        $deal_credits = M("member_data_info")->where("uid='{$uid}' and status='1'")->sum('deal_credits');
        
        $data_credits = M("members_status")
                            ->where("uid='{$uid}'")
                            ->sum('phone_credits+
                                    id_credits+face_credits+
                                    email_credits+account_credits+
                                    credit_credits+
                                    safequestion_credits+
                                    video_credits+
                                    vip_credits');
       $array['credit'] =  $deal_credits + $data_credits;
       $bid = M('member_integrallog')->where("uid='{$uid}'")->sum('affect_integral');                            
       $array['bid'] = $bid;
       $this->assign('credits', $array);
    }
    
   
}