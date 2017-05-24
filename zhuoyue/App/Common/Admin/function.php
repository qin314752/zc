<?php

//获取借款列表
function getTMemberList($search=array(),$size=''){
	$pre = C('DB_PREFIX');
	$map['m.is_transfer'] = '1';
	$map = array_merge($map,$search);


	//分页处理
	import("ORG.Util.Page");
	$count = M('members m')->where($map)->count('m.id');
	$p = new Page($count, $size);
	$page = $p->show();
	$Lsql = "{$p->firstRow},{$p->listRows}";
	//分页处理

	$field = "m.id,m.user_name,mf.info";
	$list = M('members m')->field($field)->join("{$pre}member_info mf ON m.id=mf.uid")->where($map)->limit($Lsql)->select();
	foreach($list as $key=>$v){
		$total = M('transfer_borrow_info')->field("sum(borrow_money) as tb,sum(transfer_out*per_transfer) as total")->where("borrow_uid={$v['id']}")->find();
		$list[$key]['transfer_total'] = $total['tb'];
		$list[$key]['transfer_total_out'] = $total['total'];
	}
	
	$row=array();
	$row['list'] = $list;
	$row['page'] = $page;
	return $row;
}

//获取借款列表
function getMemberInfoList($search=array(),$size=''){
	$pre = C('DB_PREFIX');
	$map = array();
	$map = array_merge($map,$search);


	//分页处理
	import("ORG.Util.Page");
	$count = M('members m')->where($map)->count('m.id');
	$p = new Page($count, $size);
	$page = $p->show();
	$Lsql = "{$p->firstRow},{$p->listRows}";
	//分页处理

	//$field = "m.id,m.id as uid,m.user_name,mbank.uid as mbank_id,mi.uid as mi_id,mci.uid as mci_id,mhi.uid as mhi_id,mdpi.uid as mdpi_id,mei.uid as mei_id,mfi.uid as mfi_id";
	$field = "m.id,m.id as uid,m.user_name,mbank.bank_num as mbank_bank_num,mi.idcard as mi_idcard,mci.address as mci_address,mhi.house_dizhi as mhi_house_dizhi,mdpi.department_name as mdpi_department_name,mei.ensuer1_name as mei_ensuer1_name,mfi.fin_house as mfi_fin_house";
        $list = M('members m')->field($field)->join("{$pre}member_banks mbank ON m.id=mbank.uid")->join("{$pre}member_contact_info mci ON m.id=mci.uid")->join("{$pre}member_department_info mdpi ON m.id=mdpi.uid")->join("{$pre}member_house_info mhi ON m.id=mhi.uid")->join("{$pre}member_ensure_info mei ON m.id=mei.uid")->join("{$pre}member_info mi ON m.id=mi.uid")->join("{$pre}member_financial_info mfi ON m.id=mfi.uid")->where($map)->limit($Lsql)->order('m.id DESC')->select();
	foreach($list as $key=>$v){
		$is_data = M('member_data_info')->where("uid={$v['uid']}")->count("id");
		$list[$key]['mbank'] = ($v['mbank_bank_num'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mci'] = ($v['mci_address'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mdi'] = ($is_data > 0)?"<span style='color:green'>已填写(<a href='".U('/admin/memberdata/index')."?uid={$v['uid']}'>查看</a>)</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mhi'] = ($v['mhi_house_dizhi'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mdpi'] = ($v['mdpi_department_name'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mei'] = ($v['mei_ensuer1_name'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mfi'] = ($v['mfi_fin_house'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mi'] = ($v['mi_idcard'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
	}
	
	$row=array();
	$row['list'] = $list;
	$row['page'] = $page;
	return $row;
}


//获取借款列表
function getMemberApplyList($search=array(),$size=''){
	$pre = C('DB_PREFIX');
	$map['ap.apply_status'] = '0';
	$map = array_merge($map,$search);


	//分页处理
	import("ORG.Util.Page");
	$count = M('member_apply ap')->where($map)->count('ap.id');
	$p = new Page($count, $size);
	$page = $p->show();
	$Lsql = "{$p->firstRow},{$p->listRows}";
	//分页处理

	//$field = "ap.id,ap.apply_type,m.id as uid,m.user_name,mbank.uid as mbank_id,mhi.uid as mhi_id,mi.uid as mi_id,mci.uid as mci_id,mdpi.uid as mdpi_id,mei.uid as mei_id,mfi.uid as mfi_id,ap.add_time";
	//$list = M('member_apply ap')->field($field)->join("{$pre}members m ON m.id=ap.uid")->join("{$pre}member_banks mbank ON m.id=mbank.uid")->join("{$pre}member_contact_info mci ON m.id=mci.uid")->join("{$pre}member_department_info mdpi ON m.id=mdpi.uid")->join("{$pre}member_ensure_info mei ON m.id=mei.uid")->join("{$pre}member_house_info mhi ON m.id=mhi.uid")->join("{$pre}member_info mi ON m.id=mi.uid")->join("{$pre}member_financial_info mfi ON m.id=mfi.uid")->where($map)->limit($Lsql)->order('ap.id DESC')->select();
	$field = "ap.id,ap.apply_type,ap.add_time,m.id as uid,m.user_name,mbank.bank_num as mbank_bank_num,mi.idcard as mi_idcard,mci.address as mci_address,mhi.house_dizhi as mhi_house_dizhi,mdpi.department_name as mdpi_department_name,mei.ensuer1_name as mei_ensuer1_name,mfi.fin_house as mfi_fin_house";
        $list = M('member_apply ap')->field($field)->join("{$pre}members m ON m.id=ap.uid")->join("{$pre}member_banks mbank ON ap.uid=mbank.uid")->join("{$pre}member_contact_info mci ON ap.uid=mci.uid")->join("{$pre}member_department_info mdpi ON ap.uid=mdpi.uid")->join("{$pre}member_house_info mhi ON ap.uid=mhi.uid")->join("{$pre}member_ensure_info mei ON ap.uid=mei.uid")->join("{$pre}member_info mi ON ap.uid=mi.uid")->join("{$pre}member_financial_info mfi ON ap.uid=mfi.uid")->where($map)->limit($Lsql)->order('ap.id DESC')->select();
        foreach($list as $key=>$v){
		$is_data = M('member_data_info')->where("uid={$v['uid']}")->count("id");
		$list[$key]['mbank'] = ($v['mbank_bank_num'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mci'] = ($v['mci_address'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mdi'] = ($is_data > 0)?"<span style='color:green'>已填写(<a href='".U('/admin/memberdata/index')."?uid={$v['uid']}'>查看</a>)</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mhi'] = ($v['mhi_house_dizhi'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mdpi'] = ($v['mdpi_department_name'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mei'] = ($v['mei_ensuer1_name'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mfi'] = ($v['mfi_fin_house'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
		$list[$key]['mi'] = ($v['mi_idcard'] != "")?"<span style='color:green'>已填写</span>":"<span style='color:black'>未填写</span>";
	}
        
	
	$row=array();
	$row['list'] = $list;
	$row['page'] = $page;
	return $row;
}


//获取借款列表
function getMemberInfoDetail($uid){
	$pre = C('DB_PREFIX');
	$map['m.id'] = $uid;
	$field = "*";
	$list = M('members m')->field($field)->join("{$pre}member_banks mbank ON m.id=mbank.uid")->join("{$pre}member_contact_info mci ON m.id=mci.uid")->join("{$pre}member_house_info mhi ON m.id=mhi.uid")->join("{$pre}member_department_info mdpi ON m.id=mdpi.uid")->join("{$pre}member_ensure_info mei ON m.id=mei.uid")->join("{$pre}member_info mi ON m.id=mi.uid")->join("{$pre}member_financial_info mfi ON m.id=mfi.uid")->where($map)->limit($Lsql)->find();
	return $list;
}

//在线客服
function get_qq($type){
    $list = M('qq')->where("type = $type and is_show = 1")->order("qq_order DESC")->select();
	return $list;
}

if(get_magic_quotes_gpc()){
    function stripslashes_deep($value)
    {
        $value = is_array($value)? array_map('stripslashes_deep', $value): stripslashes($value); 
        return $value;
    }
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}

