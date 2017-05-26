<?php
// 金糯米内核类库，2014-06-11_listam
class HelpAction extends HCommonAction {
    public function index(){
        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
		$is_subsite=false;
		$typeinfo = get_type_infos();
		if(intval($typeinfo['typeid'])<1){
			$typeinfo = get_area_type_infos($this->siteInfo['id']);
			$is_subsite=true;
		}

		$typeid = $typeinfo['typeid'];
		$typeset = $typeinfo['typeset'];

		//left
		$listparm['type_id']=$typeid;
		$listparm['limit']=20;
		if($is_subsite===false) $leftlist = getTypeListActa($listparm);//getTypeList($listparm);

		else{
			$listparm['area_id'] = $this->siteInfo['id'];
			$leftlist = getAreaTypeList($listparm);
		}//var_dump($leftlist);exit();
		$this->assign("leftlist",$leftlist);
		$this->assign("cid",$typeid);

		if($typeset==1){
			$parm['pagesize']=4;
			$parm['type_id']=$typeid;
			if($is_subsite===false){
				$list = getArticleList($parm);
				$vo = D('Acategory')->find($typeid);
				if($vo['parent_id']<>0) $this->assign('cname',D('Acategory')->getFieldById($vo['parent_id'],'type_name'));
				else $this->assign('cname',$vo['type_name']);
			}
			else{
				$vo = D('Aacategory')->find($typeid);
				if($vo['parent_id']<>0) $this->assign('cname',D('Aacategory')->getFieldById($vo['parent_id'],'type_name'));
				else $this->assign('cname',$vo['type_name']);
				$parm['area_id']= $this->siteInfo['id'];
				$list = getAreaArticleList($parm);
			}
			$this->assign("vo",$vo);
			$this->assign("list",$list['list']);
			$this->assign("pagebar",$list['page']);
		}else{
			if($is_subsite===false){
				$vo = D('Acategory')->find($typeid);
				if($vo['parent_id']<>0) $this->assign('cname',D('Acategory')->getFieldById($vo['parent_id'],'type_name'));
				else $this->assign('cname',$vo['type_name']);
			}else{
				$vo = D('Aacategory')->find($typeid);
				if($vo['parent_id']<>0) $this->assign('cname',D('Aacategory')->getFieldById($vo['parent_id'],'type_name'));
				else $this->assign('cname',$vo['type_name']);
			}
			$this->assign("vo",$vo);
		}

		$this->display($typeinfo['templet']);
    }
	
	public function view(){
		$id = intval($_GET['id']);
		if($_GET['type']=="subsite") {
			$vo = M('article_area')->find($id);
		}else {
			$vo = M('article')->find($id);
			$tid = $vo['type_id'];
			$wo = M('article_category')->find($tid);
			$this->assign("wo",$wo);
		}
		$this->assign("vo",$vo);
		//left
		$typeid = $vo['type_id'];
		$listparm['type_id']=$typeid;
		$listparm['limit']=15;
		if($_GET['type']=="subsite"){
			$listparm['area_id'] = $this->siteInfo['id'];
			$leftlist = getAreaTypeList($listparm);
		}else	$leftlist = getTypeListActa($listparm);
		
		$this->assign("leftlist",$leftlist);
		$this->assign("cid",$typeid);

		if($_GET['type']=="subsite"){
			$vop = D('Aacategory')->field('type_name,parent_id')->find($typeid);
			if($vop['parent_id']<>0) $this->assign('cname',D('Aacategory')->getFieldById($vop['parent_id'],'type_name'));
			else $this->assign('cname',$vop['type_name']);
		}else{
			$vop = D('Acategory')->field('type_name,parent_id')->find($typeid);
			if($vop['parent_id']<>0) $this->assign('cname',D('Acategory')->getFieldById($vop['parent_id'],'type_name'));
			else $this->assign('cname',$vop['type_name']);
		}

		$this->display();
	}
	
	public function kf(){
		$kflist = M("ausers")->where("is_kf=1")->select();
		$this->assign("kflist",$kflist);
		//left
		$listparm['type_id']=0;
		$listparm['limit']=20;
		if($_GET['type']=="subsite"){
			$listparm['area_id'] = $this->siteInfo['id'];
			$leftlist = getAreaTypeList($listparm);
		}else	$leftlist = getTypeList($listparm);
		
		$this->assign("leftlist",$leftlist);
		$this->assign("cid",$typeid);
		
		if($_GET['type']=="subsite"){
			$vop = D('Aacategory')->field('type_name,parent_id')->find($typeid);
			if($vop['parent_id']<>0) $this->assign('cname',D('Aacategory')->getFieldById($vop['parent_id'],'type_name'));
			else $this->assign('cname',$vop['type_name']);
		}else{
			$vop = D('Acategory')->field('type_name,parent_id')->find($typeid);
			if($vop['parent_id']<>0) $this->assign('cname',D('Acategory')->getFieldById($vop['parent_id'],'type_name'));
			else $this->assign('cname',$vop['type_name']);
		}

		$this->display();
	}
	
	public function tuiguang(){
		$_P_fee=get_global_setting();
		$this->assign("reward",$_P_fee);	
		$field = " m.id,m.user_name,sum(ml.affect_money) jiangli ";
		$list = M("members m")->field($field)->join(" nuomi_member_moneylog ml ON m.id = ml.target_uid ")->where("ml.type=13")->group("ml.uid")->order('jiangli desc')->limit(10)->select();
		$this->assign("list",$list);	
		
		$this->display();
	}
	
	//秒标未能自动复审时，管理员手动处理方法之应急处理方案  
	//使用方法：直接在浏览器访问该方法。例如：http://www.xxx.com/help/domiao?borrow_id=15
	 public function domiao()
    {
		$borrow_id = intval($_REQUEST['borrow_id']);
		$vm = M('borrow_info')->field('borrow_uid,borrow_money,has_borrow,borrow_type,borrow_status')->find($borrow_id);
		if(($vm['borrow_status']==7) ||($vm['borrow_status']==9) || ($vm['borrow_status']==10)){
			$this->error('该标已还款完成，请不要重复还款！');
			exit;
		}
		
		//复审投标检测
		$capital_sum1=M('investor_detail')->where("borrow_id={$borrow_id}")->sum('capital');
		$capital_sum2=M('borrow_investor')->where("borrow_id={$borrow_id}")->sum('investor_capital');
		if(($vm['borrow_money']!=$capital_sum2) || ($capital_sum1 != $capital_sum2) || ($vm['borrow_money'] !=$vm['has_borrow'])){
			$this->error('投标金额不统一，请确认！');
			exit;
		}else{
		//dump($borrow_id);exit;
			if($vm['borrow_type']==3){
				borrowApproved($borrow_id); 
				$done = borrowRepayment($borrow_id,1);
				if(!$done){
					$this->error('还款失败，请确认！');exit;
				}else{
					$this->success('还款成功，请确认！');
					exit;
				}
			}else{
				$this->error('非秒标类型，不能执行此操作，请确认！');exit;
			}
		}
	}
	//秒标未能自动复审时，管理员手动处理方法之应急处理方案  fan  2013-10-22
}