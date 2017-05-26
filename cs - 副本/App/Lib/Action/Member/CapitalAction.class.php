<?php
// 金糯米内核类库，2014-06-11_listam
class CapitalAction extends MCommonAction {

    public function index(){
    	        $minfo =getMinfo($this->uid,true);
        $pin_pass = $minfo['pin_pass'];
        $has_pin = (empty($pin_pass))?"no":"yes";
        $this->assign("has_pin",$has_pin);
        $this->assign("memberinfo", M('members')->find($this->uid));
        $this->assign("memberdetail", M('member_info')->find($this->uid));
        $this->assign("minfo",$minfo);
		$this->display();
    }

    public function summary(){
        $pre = C('DB_PREFIX');
		$vlist = getMemberMoneySummary($this->uid);
		$this->assign("vo",$vlist);

        $bj_status['cc.status'] = array("in",array('2','3','4'));
        $bj_status['ci.user_id']=$this->uid;
        $bj_crowds=M('crowd_investor ci')->field('count(cc.id) as id,sum(ci.capital) as capital')
            ->join("{$pre}crowd_info cc ON ci.crowd_id=cc.id")
            ->where($bj_status)
            ->find();
        $this->assign("bj_crowds",$bj_crowds);

        $repayment_money=0;
        $crowd_list_capital=0;
        //溢价收益= 投资本金*(溢价率/12)*该众筹最长持有期限
        $record_list = M('crowd_investor ci')
            ->field("ci.*,m.user_name,cf.has_crowd_money,cf.max_duration,cf.repayment_ratio")
            ->join("{$pre}members m ON m.id = ci.user_id")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where('cf.status = 9 and ci.user_id='.$this->uid)
            ->select();

        foreach($record_list as $key=>$v){
            $crowd_list_capital +=$v['capital'];
            $repayment_money += round(((($record_list[$key]['capital']*round(($record_list[$key]['repayment_ratio']/100),4))/12)*$record_list[$key]['max_duration']),4);
        }

        //正常还款
        $crowd_list_money=0;

        $crowd_list = M('crowd_investor ci')
            ->field("ci.*,m.user_name,cf.has_crowd_money,vo.vote_money,cf.repayment_ratio")
            ->join("{$pre}members m ON m.id = ci.user_id")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->join("{$pre}crowd_voting vo ON vo.crowd_id= cf.id")
            ->where('cf.status = 5 and ci.user_id='.$this->uid)
            ->select();
        foreach($crowd_list as $key=>$v){
            $crowd_list_capital +=$v['capital'];
            $crowd_list_money += round(($crowd_list[$key]['ratio']*round(($crowd_list[$key]['repayment_ratio']/100),4)*round(($crowd_list[$key]['vote_money']-$crowd_list[$key]['has_crowd_money']),4)),4);
        }

        $this->assign('crowd_list_capital',$crowd_list_capital);
        $this->assign('crowd_jzsy',round($repayment_money+$crowd_list_money,2));

        //已用红包统计
        $bid_ky_money=M('pay_bid_userlog')->field('sum(bid_money) as bid_money')->where('status=1 and uid='.$this->uid)->find();
        $this->assign("bid_ky_money",$bid_ky_money['bid_money']);

        //已用红包统计
        $bid_money=M('pay_bid_userlog')->field('sum(bid_money) as bid_money')->where('status=2 and uid='.$this->uid)->find();
        $this->assign("bid_money",$bid_money['bid_money']);
        //过期红包统计
        $bid_gq_money=M('pay_bid_userlog')->field('sum(bid_money) as bid_money')->where('status=3 and uid='.$this->uid)->find();
        $this->assign("bid_gq_money",$bid_gq_money['bid_money']);

        $this->assign('pcount', get_personal_count($this->uid)); 

		$minfo =getMinfo($this->uid,true);
        $this->assign("minfo",$minfo); 
        $this->assign('benefit', get_personal_benefit($this->uid));   //收入
        $this->assign('out', get_personal_out($this->uid));      //支出
		////////////////////////////////////////////////////////////////////
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function detail(){
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

		$list = getMoneyLog($map,15);

		$this->assign('search',$search);
		$this->assign("list",$list['list']);		
		$this->assign("pagebar",$list['page']);	
        $this->assign("query", http_build_query($search));
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
	
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
				$row[$i]['card_mianfei'] = ($v['account_money']+$v['back_money']);
				$row[$i]['card_mianfei0'] = $v['freeze_money'];
				$row[$i]['card_mianfei1'] = $v['collect_money'];
				$row[$i]['card_mianfei2'] = $v['info'];
				$i++;
		}
		
		$xls = new Excel_XML('UTF-8', false, 'moneyLog');
		$xls->addArray($row);
		$xls->generateXML("moneyLog");
	}


}