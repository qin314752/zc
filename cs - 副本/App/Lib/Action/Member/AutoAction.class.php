<?php
// 金糯米内核类库，2014-06-11_listam
class AutoAction extends MCommonAction {

    public function index(){
		$this->display();
    }

    public function auto(){
		$vo = M('auto_borrow')->field(true)->where("uid={$this->uid} AND borrow_type=1")->find();
		if($vo){
			$vocount = M()->query("SELECT count( `id` ) num FROM `nuomi_auto_borrow` WHERE `borrow_type` =1
				AND `invest_time` < ( 
				SELECT `invest_time` 
				FROM `nuomi_auto_borrow` 
				WHERE borrow_type=1 and uid ={$this->uid})"); 
		}
		
		$this->assign("num",$vocount['0']['num']);
		$this->assign("now",$vocount['0']['num']+1);
		$this->assign("vo",$vo);
		$vot = M('auto_borrow')->field(true)->where("uid={$this->uid} AND borrow_type=3")->find();
		if($vot){
			$votcount = M()->query("SELECT count( `id` ) tnum FROM `nuomi_auto_borrow` WHERE `borrow_type` =3
				AND `invest_time` < ( 
				SELECT `invest_time` 
				FROM `nuomi_auto_borrow` 
				WHERE borrow_type=3 and uid ={$this->uid})"); 
		}
		
		$this->assign("tnum",$votcount['0']['tnum']);
		$this->assign("tnow",$votcount['0']['tnum']+1);
		$this->assign("vot",$vot);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function autolong(){
	
		$vo = M('auto_borrow')->where("uid={$this->uid} AND borrow_type=1")->find();
		$vo['is_use_name'] = ($vo['is_use']==0)?"当前设置已暂停使用":"当前设置已启用";
		$x = M('members')->field("time_limit,user_leve")->find($this->uid);
		if($x['time_limit']>0 && $x['user_leve']==1) $is_vip=1;
		else $is_vip=0;
		
		$this->assign('isvip',$is_vip);
		$this->assign('vo',$vo);

		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
	
	public function setupauto(){
		$aid = intval($_POST['aid']);
		$s = intval($_POST['s']);
		$vo = M('auto_borrow')->where("uid={$this->uid} AND id={$aid}")->find();
		if(is_array($vo)){
			$newid = M('auto_borrow')->where("id={$aid}")->setField('is_use',$s);
			if($newid) exit("1");
			else exit("0");
		}else{
			exit("0");
		}
	}

	public function savelong(){
		$x = M('members')->field("time_limit,user_leve")->find($this->uid);
		($x['time_limit']>0 && $x['user_leve']==1)?$is_vip=1:$is_vip=0;
		(intval($_POST['tendAmount'])==0 && $is_vip==1)?$is_full=1:$is_full=0;
		
		$duration = explode(",",text($_POST['loancycle']));
		$data['uid'] = $this->uid;
		$data['account_money'] = floatval($_POST['miniamount']);
		$data['borrow_type'] = intval($_POST['borrowtype']);
		$data['interest_rate'] = intval($_POST['interest']);
		$data['duration_from'] = intval($duration[0]);
		if($_POST['expireddate'] != ''){
			$data['end_time'] = strtotime($_POST['expireddate']." 00:00:00");
		}else{
			$data['end_time'] = time()+60*60*24*365;
		}
		$data['duration_to'] = intval($duration[1]);
		$data['is_auto_full'] = $is_full;
		$data['invest_money'] = floatval($_POST['tendAmount']);
		$data['min_invest'] = floatval($_POST['mininvest']);
		$data['add_ip'] = get_client_ip();
		$data['add_time'] = time();
        $data['is_use'] = 1;

		$c = M('auto_borrow')->field('id')->where("uid={$this->uid} AND borrow_type={$data['borrow_type']}")->find();
		if(is_array($c)){
			$data['id'] = $c['id'];
			$newid = M('auto_borrow')->save($data);
			if($newid){
                ajaxmsg("修改成功",1);
            }else{
                ajaxmsg("修改失败，请重试",0);
            }
		}
		else{
			$data['invest_time'] = time();
			$newid = M('auto_borrow')->add($data);
			if($newid) ajaxmsg("添加成功",1);
			else ajaxmsg("添加失败，请重试",0);
		}
	}

    public function autotransferindex(){
	
		$vo = M('auto_borrow')->where("uid={$this->uid} AND borrow_type=3")->find();
		$vo['is_use_name'] = ($vo['is_use']==0)?"当前设置已暂停使用":"当前设置已启用";
		$x = M('members')->field("time_limit,user_leve")->find($this->uid);
		if($x['time_limit']>0 && $x['user_leve']==1) $is_vip=1;
		else $is_vip=0;
		
		$this->assign('isvip',$is_vip);
		$this->assign('vo',$vo);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

}