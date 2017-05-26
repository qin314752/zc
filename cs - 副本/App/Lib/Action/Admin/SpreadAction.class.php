<?php
// 全局设置
class SpreadAction extends ACommonAction
{
    public function doadd(){
        $rid = $_POST['id'];
//        $rid = $_GET['id'];
        $name = $_POST['name'];
//        $name = $_GET['name'];
        if(!$rid||!$name){
            echo 2;
            exit;
        }
        $id = M('members')->getFieldByUserName($name,'id');
        if($id == $rid){
            echo 5;
            exit;
        }
        if($id){
            $map2['id'] = $rid;
            $data['recommend_id'] = $id;
            $data['recommend_time']=time();

//            var_dump($data);
//            echo '<br/>'.date('Y-m-d',time());
//            echo '<br/>'.date('Y-m-d',$data['recommend_time']);
//            exit;

            $rs = M('members')->where($map2)->save($data);
            if($rs !== false){
                echo 1;
                exit;
            }else{
                echo 0;
                exit;
            }
        }else{
            echo 4;
            exit;
        }

    }
    /**
     * 建立关联
     */
    public function add(){
        $map['id'] = $_GET['uid'];
        $field = "id,user_name";
        $m = M('members')->field($field)->where($map)->find();
        $this->assign("m", $m);
        $this->display();
    }

    public function unlink(){
        $uid = $_POST['uid'];
//        $uid = $_GET['uid'];
        if(!$uid){
            echo 0;
            exit;
        }
        $map['id'] = $uid;
        $m = M('members')->where($map)->find();
        if(!$m){
            echo 1;
            exit;
        }
//        var_dump($m);
//        exit;
        $m['recommend_id'] = 0;
        $m['recommend_time'] = '';

        $rs = M('members')->where($map)->save($m);
        if($rs !== false){
            echo 2;
            exit;
        }else{
            echo 3;
            exit;
        }
    }
    /**
     * 用户列表
     */
    public function ulist(){
        $this->pre = C('DB_PREFIX');

        if($_REQUEST['rid']){
            $map['m.recommend_id'] = $_REQUEST['rid'];
            $search['rid'] = $map['m.recommend_id'];
        }
        if($_REQUEST['uname']){
            $map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
//            $where = " where m.user_name like '%".urldecode($_REQUEST['uname'])."%'";
            $search['uname'] = urldecode($_REQUEST['uname']);
        }

        //分页处理
        import("ORG.Util.Page");
        #$fields = "m.id id,m.user_name,m.user_email,m.recommend_id,m.recommend_time,m.reg_time,m2.user_name recommend_name";
        $fields = "m.id id";

        $xcount = M("members m")
            ->field($fields)
            ->join("{$this->pre}members m2 on m.recommend_id=m2.id")
            ->where($map)
            ->select();
        $count = count($xcount);

        $p = new Page($count, C('ADMIN_PAGE_SIZE'));
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理

        $fields = "m.id id,m.user_name,m.user_email,m.recommend_id,m.recommend_time,m.reg_time,m2.user_name recommend_name";

        $volist = M("members m")
                    ->field($fields)
                    ->join("{$this->pre}members m2 on m.recommend_id=m2.id")
                    ->where($map)
                    ->limit($Lsql)
                    ->select();

        $this->assign("list", $volist);
//        $this->assign("pagebar", $page);
//        $this->assign("search", $search);
//        $this->assign("query", http_build_query($search));

        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->display();

        /*
        $map=array();
        if(!empty($_REQUEST['runame'])){
            $ruid = M("members")->getFieldByUserName(text($_REQUEST['runame']),'id');
            $map['m.recommend_id'] = $ruid;
        }else{
            $map['m.recommend_id'] =array('neq','0');
        }
        if($_REQUEST['uname']){
            $map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
            $search['uname'] = urldecode($_REQUEST['uname']);
        }
        if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
            $timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
            $map['bi.add_time'] = array("between",$timespan);
            $search['start_time'] = urldecode($_REQUEST['start_time']);
            $search['end_time'] = urldecode($_REQUEST['end_time']);
        }elseif(!empty($_REQUEST['start_time'])){
            $xtime = strtotime(urldecode($_REQUEST['start_time']));
            $map['bi.add_time'] = array("gt",$xtime);
            $search['start_time'] = $xtime;
        }elseif(!empty($_REQUEST['end_time'])){
            $xtime = strtotime(urldecode($_REQUEST['end_time']));
            $map['bi.add_time'] = array("lt",$xtime);
            $search['end_time'] = $xtime;
        }
        if(session('admin_is_kf')==1 && m.customer_id!=0)	$map['m.customer_id'] = session('admin_id');
        //分页处理
        import("ORG.Util.Page");
        $xcount =M('borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->where($map)->group('bi.investor_uid')->buildSql();
        $newxsql = M()->query("select count(*) as tc from {$xcount} as t");
        $count = $newxsql[0]['tc'];

        $p = new Page($count, C('ADMIN_PAGE_SIZE'));
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理

        $field= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
        $list = M('borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($field)->where($map)->group('bi.investor_uid')->limit($Lsql)->select();

        $tfield= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
        $tlist = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($tfield)->where($map)->group('bi.investor_uid')->limit($Lsql)->find();

        foreach($list as $key => $v)
        {
            $list[$key]['investor_capital'] = $v['investor_capital']+$tlist['investor_capital'];
            $list[$key]['total'] = $v['total']+$tlist['total'];
        }

        $list=$this->_listFilter($list);

        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->assign("query", http_build_query($search));

        $this->display();
        */
    }

    /**
     * 推广人列表
     */
    public function slist(){
        $this->pre = C('DB_PREFIX');


        if($_REQUEST['uname']){
//            $map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
            $where = " where m.user_name like '%".urldecode($_REQUEST['uname'])."%'";
            $search['uname'] = urldecode($_REQUEST['uname']);
        }

//        $fields = "m.id,m.user_name,count(m2.id) ucount,count(bi.id) icount";

        #投资
        $sql2 = "select m2.id,m2.recommend_id,count(bi.id) bi_id,sum(bi.investor_capital) bi_investor_capital,sum(bi.receive_capital) bi_receive_capital
                from {$this->pre}members m2
                left join {$this->pre}borrow_investor bi
                on bi.investor_uid=m2.id
                left join {$this->pre}borrow_info b
                on b.id=bi.borrow_id
                group by m2.id";

        #借款
        $sql3 = "select m3.id,m3.recommend_id,sum(b.has_pay) b_has_pay,sum(b.repayment_money) b_repayment_money
                from {$this->pre}members m3
                left join {$this->pre}borrow_info b
                on b.borrow_uid=m3.id
                group by m3.id";

        #推广奖励次数
        $sql4 = "select l.uid,count(l.target_uid) rcount from {$this->pre}member_moneylog l where l.type=13 group by l.uid";
//        member_moneylog l')->join("{$this->pre}members m ON m.id=l.uid")->where($map)->count('l.id');

        #       推广人             推荐数量           投资次数       充值资金池总额        回款资金池总额
$sql = "select m.id,m.user_name
              ,count(i.id) ucount,sum(i.bi_id) icount,sum(i.bi_investor_capital) bi_investor_capital,sum(i.bi_receive_capital) bi_receive_capital
              ,sum(b.b_has_pay) b_has_pay,sum(b.b_repayment_money) b_repayment_money
              ,r.rcount rcount
        from {$this->pre}members m
        left join ($sql2) i
        on i.recommend_id = m.id
        left join ($sql3) b
        on b.recommend_id = m.id  and i.id=b.id
        left join ($sql4) r
        on r.uid = m.id
        $where
        group by m.id,r.rcount
        having count(i.id)>0";

#####################################################
        #分页处理
        import("ORG.Util.Page");
        #$fields = "m.id id,m.user_name,m.user_email,m.recommend_id,m.recommend_time,m.reg_time,m2.user_name recommend_name";
        $fields = "m.id id";

        $xcount = M()->query($sql);
        $count = count($xcount);

        $p = new Page($count, C('ADMIN_PAGE_SIZE'));
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

#####################################################

        $volist = M()->query($sql.' limit ' . $Lsql);

//        var_dump($volist);
//        exit;
        $this->assign("pagebar", $page);
        $this->assign("list", $volist);
//        $this->assign("query", http_build_query($search));

        $this->assign("search", $search);
        $this->display();
    }

    /**
     * 投资投资记录
     */
    public function plist(){
        $this->pre = C('DB_PREFIX');

        $where = " where 1=1 ";

        if($_REQUEST['rid']){
            $where .= " and m.recommend_id=".$_REQUEST['rid'];
            $search['rid'] = $_REQUEST['rid'];
        }

        if($_REQUEST['uname']){
//            $map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
            $where .= " and r.user_name like '%".urldecode($_REQUEST['uname'])."%'";
            $search['uname'] = urldecode($_REQUEST['uname']);
        }

        #投资
        $sql = "select m.id,m.recommend_id,m.user_name
                        ,bi.id bi_id,bi.investor_capital bi_investor_capital,bi.receive_capital bi_receive_capital
                        ,b.borrow_name b_borrow_name
                        ,r.user_name r_user_name
                from {$this->pre}members m
                left join {$this->pre}borrow_investor bi
                on bi.investor_uid=m.id
                left join {$this->pre}borrow_info b
                on b.id=bi.borrow_id
                left join {$this->pre}members r
                on r.id=m.recommend_id
                $where and bi.id>0";
//        $volist = M()->query($sql);
//        var_dump($volist);
//        exit;

#####################################################
        #分页处理
        import("ORG.Util.Page");

        $xcount = M()->query($sql);
        $count = count($xcount);

        $p = new Page($count, C('ADMIN_PAGE_SIZE'));
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

#####################################################

        $volist = M()->query($sql.' limit ' . $Lsql);

//        var_dump($volist);
//        exit;
        $this->assign("pagebar", $page);
        $this->assign("list", $volist);
//        $this->assign("query", http_build_query($search));

        $this->assign("search", $search);
        $this->display();

    }
    /**
     * 推广记录
     */
    public function log(){
        $map=array();
        if($_REQUEST['rid']){
            $map['l.uid'] = $_REQUEST['rid'];
            $search['rid'] = $map['l.uid'];
        }

        if($_REQUEST['uname']){
            $map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
            $search['uname'] = urldecode($_REQUEST['uname']);
        }

        if($_REQUEST['target_uname']){
            $map['l.target_uname'] = urldecode($_REQUEST['target_uname']);
            $search['target_uname'] = $map['l.target_uname'];
        }

        $map['l.type'] = 13;
        $search['type'] = 13;

        //if(session('admin_is_kf')==1)	$map['m.customer_id'] = session('admin_id');
        //分页处理
        import("ORG.Util.Page");
        $count = M('member_moneylog l')->join("{$this->pre}members m ON m.id=l.uid")->where($map)->count('l.id');
        $p = new Page($count, C('ADMIN_PAGE_SIZE'));
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理

        $field= 'l.id,l.add_time,m.user_name,l.affect_money,l.freeze_money,l.collect_money,(l.account_money+l.back_money) account_money,l.target_uname,l.type,l.info';
        $order = "l.id DESC";
        $list = M('member_moneylog l')->field($field)->join("{$this->pre}members m ON m.id=l.uid")->where($map)->limit($Lsql)->order($order)->select();
        $this->assign("bj", array("gt"=>'大于',"eq"=>'等于',"lt"=>'小于'));
        $this->assign("type", C('MONEY_LOG'));
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->assign("query", http_build_query($search));

        $this->display();
    }

    /**
     * 推广设置
     */
    public function set(){
        echo '***';
    }

    public function index()
    {
		$this->pre = C('DB_PREFIX');
		$map=array();
		if(!empty($_REQUEST['runame'])){
			$ruid = M("members")->getFieldByUserName(text($_REQUEST['runame']),'id');
			$map['m.recommend_id'] = $ruid;
		}else{
			$map['m.recommend_id'] =array('neq','0');
		}
		if($_REQUEST['uname']){
			$map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['bi.add_time'] = array("between",$timespan);
			$search['start_time'] = urldecode($_REQUEST['start_time']);	
			$search['end_time'] = urldecode($_REQUEST['end_time']);	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['bi.add_time'] = array("gt",$xtime);
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['bi.add_time'] = array("lt",$xtime);
			$search['end_time'] = $xtime;	
		}
//		if(session('admin_is_kf')==1 && m.customer_id!=0)	$map['m.customer_id'] = session('admin_id');
		//分页处理
		import("ORG.Util.Page");
		$xcount =M('borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->where($map)->group('bi.investor_uid')->buildSql();
		$newxsql = M()->query("select count(*) as tc from {$xcount} as t");
		$count = $newxsql[0]['tc'];
		
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		
		$field= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
		$list = M('borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($field)->where($map)->group('bi.investor_uid')->limit($Lsql)->select();
		
		$tfield= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
		$tlist = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($tfield)->where($map)->group('bi.investor_uid')->limit($Lsql)->find();
		
		foreach($list as $key => $v)
		{
			$list[$key]['investor_capital'] = $v['investor_capital']+$tlist['investor_capital'];
			$list[$key]['total'] = $v['total']+$tlist['total'];		
		}
	
		$list=$this->_listFilter($list);
		
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->assign("query", http_build_query($search));
		
        $this->display();
    }
	
	
	public function _listFilter($list){
		$row=array();
		foreach($list as $key=>$v){
			 if($v['recommend_id']<>0){
				$v['recommend_name'] = M("members")->getFieldById($v['recommend_id'],"user_name");
			 }else{
				$v['recommend_name'] ="<span style='color:red'>无推荐人</span>";
			 }
			 $row[$key]=$v;
		 }
		return $row;
	}
	
	public function export(){
		import("ORG.Io.Excel");

		$this->pre = C('DB_PREFIX');
		$map=array();
		if(!empty($_REQUEST['runame'])){
			$ruid = M("members")->getFieldByUserName(text($_REQUEST['runame']),'id');
			$map['m.recommend_id'] = $ruid;
		}else{
			$map['m.recommend_id'] =array('neq','0');
		}
		if($_REQUEST['uname']){
			$map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['bi.add_time'] = array("between",$timespan);
			$search['start_time'] = urldecode($_REQUEST['start_time']);	
			$search['end_time'] = urldecode($_REQUEST['end_time']);	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['bi.add_time'] = array("gt",$xtime);
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['bi.add_time'] = array("lt",$xtime);
			$search['end_time'] = $xtime;	
		}
//		if(session('admin_is_kf')==1 && m.customer_id!=0)	$map['m.customer_id'] = session('admin_id');
		
		$field= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
		$list = M('borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($field)->where($map)->group('bi.investor_uid')->limit($Lsql)->select();
		
		$tfield= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
		$tlist = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($tfield)->where($map)->group('bi.investor_uid')->limit($Lsql)->find();
		
		foreach($list as $key => $v)
		{
			$list[$key]['investor_capital'] = $v['investor_capital']+$tlist['investor_capital'];
			$list[$key]['total'] = $v['total']+$tlist['total'];		
		}
		
		$list=$this->_listFilter($list);
		
		
		$row=array();
		$row[0]=array('序号','推广人','投资人','投资总金额','投资总笔数');
		$i=1;
		foreach($list as $v){
				$row[$i]['i'] = $i;
				$row[$i]['recommend_name'] = $v['recommend_name'];
				$row[$i]['user_name'] = $v['user_name'];
				$row[$i]['capital'] = $v['investor_capital'];
				$row[$i]['bishu'] = $v['total'];
				$i++;
		}
		
		$xls = new Excel_XML('UTF-8', false, 'datalist');
		$xls->addArray($row);
		$xls->generateXML("datalistcard");
	}


	
}
?>