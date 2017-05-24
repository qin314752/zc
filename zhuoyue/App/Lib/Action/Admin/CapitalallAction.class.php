<?php
// 全局设置
class CapitalallAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$map=array();
        $map_user=array();
        $map_vip=array();
        $map_bi=array();
        $map_tbi=array();
        $map_rbi=array();
        $map_rtbi=array();
        $map_exp = array();
		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['add_time'] = array("between",$timespan);
            $map_bi['add_time'] = array("between",$timespan);
            $map_tbi['add_time'] = array("between",$timespan);
            $map_rbi['repayment_time'] = array("between",$timespan);
            $map_exp['repayment_time'] = array("between",$timespan);
            $map_rtbi['repayment_time'] = array("between",$timespan);
            $map_user['reg_time'] = array("between",$timespan);
            $map_vip['va.deal_time'] = array("between",$timespan);
			$search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));	
			$search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['add_time'] = array("gt",$xtime);
            $map_bi['add_time'] = array("gt",$xtime);
            $map_tbi['add_time'] = array("gt",$xtime);
            $map_rbi['repayment_time'] = array("gt",$xtime);
            $map_exp['repayment_time'] = array("gt",$xtime);
            $map_rtbi['repayment_time'] = array("gt",$xtime);
            $map_user['reg_time']= array("gt",$xtime);
            $map_vip['va.deal_time'] = array("gt",$xtime);
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['add_time'] = array("lt",$xtime);
            $map_bi['add_time'] = array("lt",$xtime);
            $map_tbi['add_time'] = array("lt",$xtime);
            $map_rbi['repayment_time'] = array("lt",$xtime);
            $map_exp['repayment_time'] = array("lt",$xtime);
            $map_rtbi['repayment_time'] = array("lt",$xtime);
            $map_user['reg_time']= array("lt",$xtime);
            $map_vip['va.deal_time'] = array("lt",$xtime);
			$search['end_time'] = $xtime;	
		}else{
            $map_rbi['repayment_time'] = array("gt",0);
            $map_exp['repayment_time'] = array("gt",10000);
            $map_rtbi['repayment_time'] = array("gt",0);
        }
        $map_bi['borrow_status'] = array("in",array(6,7,8,9));
        $map_tbi['status'] = array("in",array(1,2,3,4,5));
        $sum_transfer_interest = M("transfer_borrow_investor")->where($map_rtbi)->sum("interest");
        $sum_transfer_receive_interest = M("transfer_borrow_investor")->where($map_rtbi)->sum("receive_interest");
        $this->assign("sum_transfer_interest",$sum_transfer_interest);
        $this->assign("sum_transfer_receive_interest",$sum_transfer_receive_interest);
//        $map_rtbi['status'] = 1;
        $sum_borrow = M("borrow_info")->where("borrow_status in (6,7,8,9,10)")->sum("has_borrow");
        $sum_transfer = M("transfer_borrow_investor")->where($map_tbi)->sum("investor_capital");
        $this->assign("sum_money",$sum_borrow);
        $this->assign("sum_transfer",$sum_transfer);
        $has_borrow = M("investor_detail")->where("status in (6,7)")->sum("capital");
        $has_transfer = M("transfer_investor_detail")->where($map_rtbi)->sum("capital");

        $this->assign("has_money",$has_borrow);
        $this->assign("has_transfer",$has_transfer);


        $list = M("member_moneylog")->field('type,sum(affect_money) as money')->where($map)->group('type')->select();
		$row=array();
		$name = C('MONEY_LOG');
		foreach($list as $v){
			$row[$v['type']]['money']= ($v['money']>0)?$v['money']:$v['money']*(-1);
			$row[$v['type']]['name']= $name[$v['type']];
		}
		$map['withdraw_status'] =2;
		$tx = M('member_withdraw')->where($map)->sum("second_fee");
		$row['tx']['name']= '提现手续费';
		$row['tx']['money']= $tx;

		
        $map1['status'] = 7;
        $map1['deadline'] =array("lt",time()-86400);
        $map2['repayment_time'] = $map_exp['repayment_time'];
        $map2['expired_days'] = array("gt",0);
        $map3['status']=4;
		//逾期
		$row['expired']['money'] = M('investor_detail')->where($map1)->sum('capital');
        $row['expired']['dai_money'] = M('investor_detail')->where($map3)->sum('capital');
		$row['expired']['re_money'] = M('investor_detail')->where($map2)->sum('capital');
		//逾期

        //众筹
        $crowd_info['crowd_id']=M('crowd_info')->count('id');
        $crowd_info['crowd_cg']=M('crowd_info')->where('status=5')->count('id');
        $crowd_info['crowd_yj']=M('crowd_info')->where('status in (8,9)')->count('id');
        $crowd_info['crowd_zc']=M('crowd_info')->where('status=1')->count('id');
        $crowd_info['crowd_lb']=M('crowd_info')->where('status=6')->count('id');
        $crowd_info['crowd_money']=M('crowd_info')->where('status<>6')->sum('has_crowd_money');
        $crowd_info['crowd_voting']=M('crowd_voting')->where('status=3')->sum('vote_money');
        $this->assign("crowd_info",$crowd_info);

        $hk_crowd_voting=0;
        //正常收益
        $pt_zc_sy=0;
        $pre = C('DB_PREFIX');
        $crowd_zc=M('crowd_info ci')->field("ci.id,ci.repayment_ratio")
            ->where('ci.status=5 ')
            ->select();
        foreach($crowd_zc as $kay=>$val){
            $pay_bid_list=M('crowd_voting')->field('crowd_money,vote_money')->where('status=3 and crowd_id='.$val['id'])
                ->limit(1)->order("id desc")->find();
            $pt_zc_sy+=(1-$val['repayment_ratio']/100)*($pay_bid_list['vote_money']-$pay_bid_list['crowd_money']);
            $hk_crowd_voting +=$pay_bid_list['vote_money'];

        }
        $this->assign('pt_zc_sy',$pt_zc_sy);
        //红包
        $hb_money=M('pay_bid_userlog')->where('status=2')->sum('bid_money');
		$this->assign("hb_money",$hb_money);
        //溢价支出
        $pt_yj=0;
        $crowd_yj=M('crowd_info ci')->field("ci.id,ci.repayment_ratio,ci.has_crowd_money,ci.max_duration")
            ->where('ci.status=9')
            ->select();
        foreach($crowd_yj as $kay=>$val){
            //投资本金*(溢价率/12)*该众筹最长持有期限
            $pt_yj+=round($val['has_crowd_money']*($val['repayment_ratio']/100/12)*$val['max_duration'],2);
            $hk_crowd_voting +=$val['has_crowd_money'];
        }
        $this->assign("pt_yj",$pt_yj);
        //还款金额= 正常还款的本金+收益+溢价的投资本金
        $this->assign("hk_crowd_voting",$hk_crowd_voting);
		//会员统计
		$mm = M('members')->where($map_user)->count("id");
		$row['mm']['name']= '会员数';
		$row['mm']['num']= $mm;

		$ms_phone = M('members_status')->where("phone_status=1")->count("uid");
		$ms_id = M('members_status')->where("id_status=1")->count("uid");
		$ms_video = M('members_status')->where("video_status=1")->count("uid");
		$ms_face = M('members_status')->where("face_status=1")->count("uid");
        $map_vip['m.user_leve'] =1;
        $map_vip['m.time_limit'] = array("gt",time());
		$ms_vip = M('members m')->join("nuomi_vip_apply va on va.uid = m.id")->where($map_vip)->count("m.id");
        $row['mm']['name']= '会员数';
		$row['mm']['num']= $mm;
		$row['mm']['ms_phone']= $ms_phone;
		$row['mm']['ms_id']= $ms_id;
		$row['mm']['ms_video']= $ms_video;
		$row['mm']['ms_face']= $ms_face;
		$row['mm']['ms_vip']= $ms_vip;
		
		$field = "sum(investor_capital) as investor_capital,sum(investor_interest) as investor_interest,sum(receive_capital) as receive_capital,sum(receive_interest) as receive_interest,sum(reward_money) as reward_money, sum(invest_fee) as invest_fee";
		$transfer = M("transfer_borrow_investor")->field($field)->find();

        $pre = C('DB_PREFIX');
        //众筹总收益
        $crowd_list = M('crowd_investor ci')
            ->field("ci.*,m.user_name,cf.has_crowd_money,vo.vote_money,cf.repayment_ratio")
            ->join("{$pre}members m ON m.id = ci.user_id")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->join("{$pre}crowd_voting vo ON vo.crowd_id= cf.id")
            ->where('cf.status = 5 and vo.status = 3')
            ->select();
        //M('crowd_info')->getLastSql()
        $crowd_list_money=0;
        foreach($crowd_list as $key=>$v){
            $crowd_list_money += round(($crowd_list[$key]['ratio']*round(($crowd_list[$key]['repayment_ratio']/100),4)*round(($crowd_list[$key]['vote_money']-$crowd_list[$key]['has_crowd_money']),4)),4);
        }
		$this->assign("crowd_list_money",$crowd_list_money);
		$this->assign("transfer", $transfer);
		//会员统计
		$this->assign("search",$search);
		$this->assign('list',$row);
        $this->display();
    }

	
}
?>