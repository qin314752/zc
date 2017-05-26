<?php
class TborrowAction extends MCommonAction
{
	public function index()
	{
		$this->display( );
	}

    public function summary(){
        $uid = $this->uid;
        $pre = C('DB_PREFIX');
        //$this->assign("dc",M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money'));
        $this->assign("mx",getMemberBorrowScan($this->uid));
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
	public function tendbacking()
	{
		$map['i.investor_uid'] = $this->uid;
		$map['i.status'] = 1;
		$map['i.is_jijin'] = 0;
		$list = getttenderlist($map, 15);
		$this->assign("list", $list['list']);
		$this->assign("pagebar", $list['page']);
		$this->assign("total", $list['total_money']);
		$this->assign("num", $list['total_num']);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}

	public function tenddone()
	{
		$map['i.investor_uid'] = $this->uid;
		$map['i.status'] =2;
		$map['i.is_jijin'] = 0;
		$list = getttenderlist( $map, 15 );
		$this->assign("list", $list['list']);
		$this->assign("pagebar", $list['page']);
		$this->assign("total", $list['total_money']);
		$this->assign("num", $list['total_num']);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}

/*	public function tenddetail()
	{
		$map['d.investor_uid'] = $this->uid;
		$map['d.status'] = 7;
		$list = gettdtenderlist($map,15);
		$this->assign("list", $list['list']);
		$this->assign("pagebar", $list['page']);
		$this->assign("total", $list['total_money']);
		$this->assign("num", $list['total_num']);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}*/

	public function tenddetaildo()
	{
		$map['d.investor_uid'] = $this->uid;
		$map['d.status'] = 1;
		$list = gettdtenderlist( $map,15);
		$this->assign( "list", $list['list']);
		$this->assign( "pagebar", $list['page']);
		$this->assign( "total", $list['total_money']);
		$this->assign( "num", $list['total_num']);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}
    //未完成
    public function ajax_detail(){
	    $investid = $_GET['id'];
		$this->assign('investid', $investid);
		$data['content'] = $this->fetch();
		exit(json_encode($data));
	}
	//已完成
	public function ajax_done(){
	    $investid = $_GET['id'];
		$this->assign('investid', $investid);
		$data['content'] = $this->fetch();
		exit(json_encode($data));
	}
	//未完成详情
	public function tenddetail()
	{
		//$map['d.investor_uid'] = $this->uid;
		$map['d.status'] = 7;
		$map['d.invest_id'] = $_GET['id'];
		
		$list = gettdtenderlist($map,10);
		$this->assign("list", $list['list']);
		$this->assign("pagebar", $list['page']);
		$this->assign("total", $list['total_money']);
		$this->assign("num", $list['total_num']);
		//$data['content'] = $this->fetch();
		$this->display();
	}
	//已完成详情
    public function tenddetaildone()
	{
		//$map['d.investor_uid'] = $this->uid;
		$map['d.status'] = 1;
		$map['d.invest_id'] = $_GET['id'];
		
		$list = gettdtenderlist($map,10);
		$this->assign("list", $list['list']);
		$this->assign("pagebar", $list['page']);
		$this->assign("total", $list['total_money']);
		$this->assign("num", $list['total_num']);
		//$data['content'] = $this->fetch();
		$this->display();
	}
}

?>
