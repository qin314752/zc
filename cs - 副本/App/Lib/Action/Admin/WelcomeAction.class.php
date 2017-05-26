<?php
// 金糯米内核类库，2014-06-11_listam
class WelcomeAction extends ACommonAction {

	var $justlogin = true;
	
    public function index(){
		$row['borrow_1'] = M('borrow_info')->
where('borrow_status=0')->count('id');//初审
		$row['borrow_2'] = M('borrow_info')->where('borrow_status=4')->count('id');//复审
		$row['limit_a'] = M('member_apply')->where('apply_status=0')->count('id');//额度
		$row['data_up'] = M('member_data_info')->where('status=0')->count('id');//上传资料
		$row['vip_a'] = M('vip_apply')->where('status=0')->count('id');//VIP审核
		$row['video_a'] = M('video_apply')->where('apply_status=0')->count('id');//视频认证		
		$row['face_a'] = M('face_apply')->where('apply_status=0')->count('id');//现场认证		
		$row['real_a'] = M('members_status')->where('id_status=3')->count('uid');//现场认证		
		$row['withdraw'] = M('member_withdraw')->where('withdraw_status=0')->count('id');//待审核提现
               // $row['debt_a'] = M('invest_detb')->where('status=99')->count('id');//债权转让待审核
        $row['crowd_status'] = M('rowd_info')->where('status=3')->count('id');//众筹投票

       //逾期
        $map=array();
        $map['d.status'] = array("neq",0);
        $map['d.repayment_time'] = 0;
        $map['d.deadline'] = array("between","100000,".time());
        $buildSql = M('investor_detail d')->field("d.id")->join("{$this->pre}borrow_info b ON b.id=d.borrow_id")->join("{$this->pre}members m ON m.id=b.borrow_uid")->where($map)->group('d.sort_order,d.borrow_id')->buildSql();
        $newsql = M()->query("select count(*) as tc from {$buildSql} as t");
        $count = $newsql[0]['tc'];
        $row['borrow_8']=$count;
                //$row['borrow_8'] = M('borrow_info')->where('borrow_status=8')->count('id');//逾期

                $row['kuaisujiekuan'] = M('feedback')->where('type=7 and status=0')->count('id');//快速借款
		$this->assign("row",$row);
		
		/////////////////////////////////////////////////////////////
		$sql_chart_1 = "select count(x.t) as e  from (select count(*) as t from nuomi_borrow_info group by borrow_uid) as x";
		$chart1_borrow = M()->query($sql_chart_1);
		$memberCount = M("members")->count("*");
		$sql_chart_3 = "select count(x.t) as e  from (select count(*) as t from nuomi_borrow_investor group by investor_uid) as x";
		$chart1_invest = M()->query($sql_chart_3);
		$chart_1_total = intval($memberCount) + intval( $chart1_invest[0]['e']) + intval($chart1_borrow[0]['e']);
		$chart_1 = array(
						"register" => intval($memberCount),
						"invest" => intval($chart1_invest[0]['e']),
						"borrow" => intval($chart1_borrow[0]['e']),
						"register_rate" => getfloatvalue(intval($memberCount) / $chart_1_total * 100, 2),
						"invest_rate" => getfloatvalue(intval($chart1_invest[0]['e']) / $chart_1_total * 100, 2)
		);
		$this->assign("chart_one", $chart_1);
		
		$start = strtotime(date("Y-m-01", time())." 00:00:00");
		$end = strtotime(date("Y-m-t", time())." 23:59:59");
		$mapChart2 = array();
		$mapChart2['full_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$mapChart2['borrow_status'] = array("in", "6,7,8,9");
		$mapTChart2 = array();
		$mapTChart2['add_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$month = array();
		$moneyMonth = M("borrow_info")->where($mapChart2)->sum("borrow_money");
		$moneyMonth_t = M("transfer_borrow_info")->where($mapTChart2)->sum("borrow_money");
		$mapRChart2 = array();
		$mapRChart2['repayment_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$moneyMonth_r = M("investor_detail")->where($mapRChart2)->sum("receive_capital");
		$month['money_repayment'] = getFloatvalue($moneyMonth_r / 10000, 2);
		$month['money_normal'] = getFloatvalue($moneyMonth / 10000, 2);
		$month['money_transfer'] = getFloatvalue($moneyMonth_t / 10000, 2);
		$month['month'] = date("Y-m", $end);
		
		
		
		$start = strtotime("-1 months", strtotime(date("Y-m-01", time())." 00:00:00"));
		$end = strtotime(date("Y-m-t", strtotime("-1 months", time()))." 23:59:59");
		$mapChart2 = array();
		$mapChart2['full_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$mapChart2['borrow_status'] = array("in", "6,7,8,9");
		$mapTChart2 = array();
		$mapTChart2['add_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$month1 = array();
		$moneyMonth1 = M("borrow_info")->where($mapChart2 )->sum("borrow_money");
		$moneyMonth1_t = M("transfer_borrow_info")->where($mapTChart2)->sum("borrow_money");
		$mapRChart2 = array();
		$mapRChart2['repayment_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$moneyMonth1_r = M("investor_detail")->where($mapRChart2)->sum("receive_capital");
		$month1['money_repayment'] = getFloatvalue($moneyMonth1_r / 10000, 2);
		$month1['money_normal'] = getFloatvalue($moneyMonth1 / 10000, 2);
		$month1['money_transfer'] = getFloatvalue($moneyMonth1_t / 10000, 2);
		$month1['month'] = date("Y-m", $end);
		$start = strtotime("-2 months",strtotime( date( "Y-m-01", time())." 00:00:00"));
		$end = strtotime(date("Y-m-t", strtotime( "-2 months", time()))." 23:59:59");
		$mapChart2 = array();
		$mapChart2['full_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$mapChart2['borrow_status'] = array("in","6,7,8,9");
		$mapTChart2 = array();
		$mapTChart2['add_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$month2 = array();
		$moneyMonth2 = M("borrow_info")->where($mapChart2)->sum("borrow_money");
		$moneyMonth2_t =M("transfer_borrow_info")->where($mapTChart2)->sum("borrow_money");
		$mapRChart2 = array();
		$mapRChart2['repayment_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$moneyMonth2_r = M("investor_detail")->where($mapRChart2)->sum("receive_capital");
		$month2['money_repayment'] = getfloatvalue( $moneyMonth2_r / 10000, 2);
		$month2['money_normal'] = getfloatvalue( $moneyMonth2 / 10000, 2);
		$month2['money_transfer'] = getfloatvalue( $moneyMonth2_t / 10000, 2);
		$month2['month'] = date("Y-m", $end );
		$start = strtotime("-3 months", strtotime(date("Y-m-01", time())." 00:00:00"));
		$end = strtotime( date("Y-m-t", strtotime("-3 months", time()))." 23:59:59");
		$mapChart2 = array();
		$mapChart2['full_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$mapChart2['borrow_status'] = array("in","6,7,8,9");
		$mapTChart2 = array( );
		$mapTChart2['add_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$month3 = array();
		$moneyMonth3 = M("borrow_info")->where($mapChart2)->sum("borrow_money");
		$moneyMonth3_t = M("transfer_borrow_info")->where( $mapTChart2 )->sum("borrow_money");
		$mapRChart2 = array();
		$mapRChart2['repayment_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$moneyMonth3_r = M("investor_detail")->where($mapRChart2)->sum("receive_capital");
		$month3['money_repayment'] = getFloatvalue($moneyMonth3_r / 10000, 2);
		$month3['money_normal'] = getFloatvalue($moneyMonth3 / 10000, 2);
		$month3['money_transfer'] = getFloatvalue($moneyMonth3_t / 10000, 2);
		$month3['month'] = date( "Y-m", $end );
		$start = strtotime( "-4 months", strtotime( date( "Y-m-01", time( ) )." 00:00:00" ) );
		$end = strtotime( date( "Y-m-t", strtotime( "-4 months", time( ) ) )." 23:59:59" );
		$mapChart2 = array( );
		$mapChart2['full_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$mapChart2['borrow_status'] = array( "in", "6,7,8,9" );
		$mapTChart2 = array( );
		$mapTChart2['add_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$month4 = array( );
		$mapRChart2 = array( );
		$mapRChart2['repayment_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$moneyMonth4_r = M( "investor_detail" )->where( $mapRChart2 )->sum( "receive_capital" );
		$month4['money_repayment'] = getfloatvalue( $moneyMonth4_r / 10000, 2 );
		$moneyMonth4 = M( "borrow_info" )->where( $mapChart2 )->sum( "borrow_money" );
		$moneyMonth4_t = M( "transfer_borrow_info" )->where( $mapTChart2 )->sum( "borrow_money" );
		$month4['money_normal'] = getfloatvalue( $moneyMonth4 / 10000, 2 );
		$month4['money_transfer'] = getfloatvalue( $moneyMonth4_t / 10000, 2 );
		$month4['month'] = date( "Y-m", $end );
		
		$start = strtotime("-5 months", strtotime(date("Y-m-01", time())." 00:00:00"));
		$end = strtotime(date("Y-m-t", strtotime("-5 months", time()))." 23:59:59");
		$mapChart2 = array();
		$mapChart2['full_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$mapChart2['borrow_status'] = array("in", "6,7,8,9");
		$mapTChart2 = array();
		$mapTChart2['add_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$month5 = array();
		$moneyMonth5 = M("borrow_info")->where($mapChart2 )->sum("borrow_money");
		$moneyMonth5_t = M("transfer_borrow_info")->where($mapTChart2)->sum("borrow_money");
		$mapRChart2 = array();
		$mapRChart2['repayment_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$moneyMonth5_r = M("investor_detail")->where($mapRChart2)->sum("receive_capital");
		$month5['money_repayment'] = getFloatvalue($moneyMonth5_r / 10000, 2);
		$month5['money_normal'] = getFloatvalue($moneyMonth5 / 10000, 2);
		$month5['money_transfer'] = getFloatvalue($moneyMonth5_t / 10000, 2);
		$month5['month'] = date("Y-m", $end);
		
		$start = strtotime("-6 months", strtotime(date("Y-m-01", time())." 00:00:00"));
		$end = strtotime(date("Y-m-t", strtotime("-6 months", time()))." 23:59:59");
		$mapChart2 = array();
		$mapChart2['full_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$mapChart2['borrow_status'] = array("in", "6,7,8,9");
		$mapTChart2 = array();
		$mapTChart2['add_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$month6 = array();
		$moneyMonth6 = M("borrow_info")->where($mapChart2)->sum("borrow_money");
		$moneyMonth6_t = M("transfer_borrow_info")->where($mapTChart2)->sum("borrow_money");
		$mapRChart2 = array();
		$mapRChart2['repayment_time'] = array(
						"between",
						"{$start},{$end}"
		);
		$moneyMonth6_r = M("investor_detail")->where($mapRChart2)->sum("receive_capital");
		$month6['money_repayment'] = getFloatvalue($moneyMonth6_r / 10000, 2);
		$month6['money_normal'] = getFloatvalue($moneyMonth6 / 10000, 2);
		$month6['money_transfer'] = getFloatvalue($moneyMonth6_t / 10000, 2);
		$month6['month'] = date("Y-m", $end);
		
		$this->assign("month6", $month6);
		$this->assign("month5", $month5);
		$this->assign("month4", $month4);
		$this->assign("month3", $month3);
		$this->assign("month2", $month2);
		$this->assign("month1", $month1);
		$this->assign("month", $month);
		//dump($month2);exit;
		////////////////////////////////////////////////////////////
	
		$this->getServiceInfo();
        $this->getAdminInfo();
		$this->display();
    }
	
	private function getServiceInfo()
    {
        $service['service_name'] = php_uname('s');//服务器系统名称
        $service['service'] = $_SERVER['SERVER_SOFTWARE'];   //服务器版本
        $service['zend'] = 'Zend '.Zend_Version();    //zend版本号
        $service['ip'] = GetHostByName($_SERVER['SERVER_NAME']); //服务器ip
        $service['mysql'] = mysql_get_server_info();
        $service['filesize'] = ini_get("upload_max_filesize");
        
        $this->assign('service', $service);
    }
	
    private function getAdminInfo()
    {
        $id = $_SESSION['admin_id'];
        $userinfo = M('ausers a')
                    ->field('a.user_name, c.groupname')
                    ->join(C('DB_PREFIX').'acl as c on a.u_group_id = c.group_id')
                    ->where(" a.id={$id}")
                    ->find();                      
        $userinfo['last_log_time'] = $_SESSION['admin_last_log_time'];
        $userinfo['last_log_ip'] = $_SESSION['admin_last_log_ip'];
        $this->assign('user',$userinfo);
    }
	
}