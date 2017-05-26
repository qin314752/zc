<?php
// 全局设置
class RefereedetailAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
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
		/*import("ORG.Util.Page");
		$xcount =M('borrow_investor bi')->field("bi.*")->join("{$this->pre}members m ON m.id = bi.investor_uid")->where($map)->group('bi.investor_uid')->buildSql();
		$newxsql = M()->query("select count(*) as tc from {$xcount} as t");
		$count = $newxsql[0]['tc'];

		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";*/
		//分页处理
		
//		$field= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
//		$list = M('borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($field)->where($map)->group('bi.investor_uid')->limit($Lsql)->select();
//
//		$tfield= ' sum(bi.investor_capital) investor_capital,count(bi.id) total,bi.investor_uid,m.recommend_id,m.id,m.user_name';
//		$tlist = M('transfer_borrow_investor bi')->join("{$this->pre}members m ON m.id = bi.investor_uid")->field($tfield)->where($map)->group('bi.investor_uid')->limit($Lsql)->find();
//
//		foreach($list as $key => $v)
//		{
//			$list[$key]['investor_capital'] = $v['investor_capital']+$tlist['investor_capital'];
//			$list[$key]['total'] = $v['total']+$tlist['total'];
//		}

        //分页处理
        import("ORG.Util.Page");
        $size=10;
        $recomm['recommend_id']=array('neq','null');
        $count = M('members')->where($recomm)->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //$recomm['recommend_id']=array('neq','null');
        $recommend=M('members')->field('id,recommend_id')->where($recomm)->order('id DESC')->limit($Lsql)->select();
        foreach($recommend as $kay => $val){
            $user_investor=M('crowd_investor')->field('count(capital) as cou_cap, sum(capital) as capital')->where('user_id='.$val['id'].' and status=1')->find();
            $recommend[$kay]['cou_cap']=$user_investor['cou_cap'];
            $recommend[$kay]['capital']=$user_investor['capital'];
            $u_name=M('members')->field('user_name')->find($val['id']);
            $recommend[$kay]['tz_name']=$u_name['user_name'];
            $t_name=M('members')->field('user_name')->find($val['recommend_id']);
            $recommend[$kay]['tj_name']=$t_name['user_name'];
        }
		//$list=$this->_listFilter($list);
		//var_dump($recommend);
        $this->assign("list", $recommend);
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