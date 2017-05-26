<?php
// 金糯米内核类库，2014-06-11_listam
class MarketAction extends HCommonAction {
	
	public function index(){
		//网站公告
		$parm['type_id'] = 1;
		$parm['limit'] = 8;
		$this->assign("noticeList",getArticleList($parm));
		
		
		$per = C('DB_PREFIX');
		$page_size = C('HOME_SHOP_PAGE_SIZE');
        $Market = M('market_goods');
        import("ORG.Util.Page");
        $condition = "is_sys=1";
        $count = $Market->where($condition)->count();
        $Page = new Page($count, $page_size);
        $show =  $Page->show();

		$list = M('market_goods')->where($condition)->order("order_sn DESC")->limit($Page->firstRow.', '.$Page->listRows)->select();
		
		$list_log = M('market_log l')->field("l.*,m.user_name")->join("{$per}members m ON m.id=l.uid")->where("l.type=1")->order("l.price DESC")->limit(10)->select();
		//dump($list_log);exit;
		$this->assign("list",$list);
		$this->assign("list_log",$list_log);
		$this->assign('pagebar', $show);
        $this->display();
	}

	public function detail(){
		if($_GET['type']=='commentlist'){
			//评论
			$cmap['tid'] = intval($_GET['id']);
			$clist = getCommentList($cmap,5);
			$this->assign("commentlist",$clist['list']);
			$this->assign("commentpagebar",$clist['page']);
			$this->assign("commentcount",$clist['count']);
			$data['html'] = $this->fetch('commentlist');
			exit(json_encode($data));
		}
		$pre = C('DB_PREFIX');

		$id = intval($_REQUEST['id']);
		$good = M('market_goods')->where("is_sys=1 AND id={$id}")->find();
		if(!is_array($good))	$this->error("数据出错");
		$imgArr = $good['middle_img'];
		$styleArr = explode("|", $good['style']);
		
		if(count($styleArr)==1 && $styleArr[0]=="" ){$isstyle=0;
		}else{
			$isstyle = 1;
		}
		$good['surplus'] = $good['number'] - $good['convert'];//剩余数量
	    $this->assign("vo", $good);
	    $this->assign("styleArr", $styleArr);
	    $this->assign("imgArr", $imgArr);
	    $this->assign("isstyle", $isstyle);
		
		
		$list = M('market_log l')->field("l.*,m.user_name")->join("{$pre}members m ON m.id=l.uid")->where("l.type=1")->order("l.price DESC")->limit(10)->select();
		$this->assign('list',$list);
		
		
		$cmap['tid'] = $id;
		$clist = getCommentList($cmap,5);
		$this->assign("Bconfig",$Bconfig);
		$this->assign("commentlist",$clist['list']);
		$this->assign("commentpagebar",$clist['page']);
		$this->assign("commentcount",$clist['count']);
        $this->display();
	}

	public function buyGood(){
		$id = intval($_REQUEST['id']);
		$good = M('market_goods')->where("is_sys=1 AND id={$id}")->find();
		if(!is_array($good))	$this->error("数据出错");

		$surplus= $good['number'] - $good['convert'];//剩余数量
		if($surplus<=0){//剩余数量必须大于0
			$this->error("对不起,兑换已结束！");
		}else{
			$data=array();
			$data['convert']=$good['convert']+1;//已兑换数量+1
			$res = M('market_goods')->where("is_sys=1 AND id={$id}")->save($data); 
		}
		
    	$user = M('members')->where("id={$this->uid}")->find();
		if($user['active_integral'] < $good['cost']) $this->error("对不起，您的积分不足！");
		$x = memberIntegralLog($this->uid,3,-$good['cost'],"兑换‘{$good[name]}’");
		
		
		
  		$log =array();
  		$log['uid'] = $this->uid;
  		$log['type'] = 1;
  		$log['style'] = (text($_REQUEST['style']) != "null") ? text($_REQUEST['style']) : "";

  		$log['gid'] = $good['id'];
  		$log['name'] = $good['name'];
  		$log['price'] = $good['price'];
  		$log['cost'] = $good['cost'];
  		$log['num'] = 1;
  		$log['info'] = "积分兑换‘{$good[name]}’";

  		$log['add_ip'] = get_client_ip();
  		$log['add_time'] = time();
  		$log['status'] = 0;//未领取
  		$log['way'] = 2;//快递
  		
  		addInnerMsg($this->uid,"兑换‘{$good[name]}’","兑换‘{$good[name]}’");
  		$y = M("market_log")->add($log);

		if ($x && $y) {
			$this->success("购买成功");
		}else{
			$this->error("购买失败");
		}
    }
	
	public function addcomment(){
		$data['comment'] = text($_POST['comment']);
		$tid = intval($_POST['tid']);
		if(!$this->uid){
			ajaxmsg("请先登录",0);
			exit;
		}

		if(empty($data['comment'])){
			ajaxmsg("留言内容不能为空",0);
			exit;
		}
        if(!M('jifen_choujiang')->where("uid='{$this->uid}' and jp_id='{$tid}'")->count('id')){
			ajaxmsg("您没有权限评论",0);
			exit;
		}
		$data['type'] = 3;
		$data['add_time'] = time();
		$data['uid'] = $this->uid;
		$data['uname'] = session("u_user_name");
		$data['tid'] = intval($tid);
		$data['name'] = M('market_goods')->getFieldById($data['tid'],'name');
		$newid = M('comment')->add($data);
		
		if($newid) ajaxmsg();
		else ajaxmsg("留言失败，请重试",0);
	}
	
	///////////////////////////////////////////////////////积分抽奖  fan 2013-12-30//////////////////////////////////
	public function lottery(){
		
		$pre = C('DB_PREFIX');
		if($this->uid){
			$user = M('members')->find($this->uid);
			if(is_array($user))
				$this->assign('user',$user);
		}
		
		$jplist = M('market_jifenlist')->where("is_sys=1")->order("order_sn DESC")->limit(14)->select();
		
		$this->assign('jplist',$jplist);
		if ($_POST['lucky']){
			if($user['active_integral'] < $this->glo['lottery_cost'] )	ajaxmsg("您的积分不够继续抽奖",0);
		
			memberIntegralLog($this->uid,4,-$this->glo['lottery_cost'],"使用积分抽奖一次");//减少积分
			
			$check = $this->randNum();//抽奖

			unset($check['rate']);
			$this->lotteryLog($check);//积分商品记录

			exit(json_encode($check));
		}

		$list = M('market_log l')->field("l.*,m.user_name")->join("{$pre}members m ON m.id=l.uid")->where("l.type=2")->order("l.price DESC")->limit(10)->select();
		$mlist = M('market_log l')->field("l.*,m.user_name")->join("{$pre}members m ON m.id=l.uid")->where("l.type=2 and l.uid={$this->uid}")->order("l.price DESC")->limit(10)->select();
		$this->assign('list',$list);
		$this->assign('mlist',$mlist);
		$this->assign('cost',$this->glo['lottery_cost']);
        $this->display();
	}

	protected function randNum(){
		$total = 0;
		$average = 0;
		$list = M('market_jifenlist')->where("is_sys=1")->order("order_sn DESC")->limit(14)->select();
		$num = M('market_jifenlist')->where("is_sys=1")->count();
		foreach ($list as $k => $v) {
			$total += $v['rate'];
			$average += $v['rate']*$v['value'];
		}
		$average = $average/$total;
		$rand = mt_rand(1,$total);
		$to = 0; 
		$key = 7;
		for ($i=0; $i <= 13; $i++) { 
			$to +=$list[$i]['rate'];
			if ( $rand < $to) {
				$key = $i;
				break ;
			}
		}
		
        if(($key+1)>$num){
		    $list[$key]['fail'] = 1;
		}else{
		    $list[$key]['fail'] = 0;
		}
		$list[$key]['iid'] = $key;
		return $list[$key];
	}

	protected function lotteryLog($good){
  		$log =array();
  		$log['uid'] = $this->uid;
  		$log['type'] = 2;
  		$log['gid'] = $good['id'];
  		$log['name'] = $good['title'];
  		$log['price'] = $good['value'];
  		$log['cost'] = $this->glo['lottery_cost'];
  		$log['num'] = 1;
  		$log['info'] = "积分抽奖抽中";

  		$log['add_ip'] = get_client_ip();
  		$log['add_time'] = time();

  		$log['status'] = 2;//已领取
  		$log['way'] = 0;//直接领取
		
		if($good['category']=='1'){//抽中的是礼金
			memberMoneyLog($this->uid,45,$good['value'],"积分抽奖抽中‘{$good['title']}’一份");//抽中投资礼金
		}else if($good['category']=='2'){
			memberIntegralLog($this->uid,4,$good['value'],"积分抽奖抽中‘{$good['title']}’一份");//抽中积分
		}else{
			$log['status'] = 0;//未领取
  			$log['way'] = 2;//快递
		}
		
		addInnerMsg($this->uid,"积分抽奖抽中‘{$good['title']}’一份","积分抽奖抽中‘{$good['title']}’一份");
  		M("market_log")->add($log);
		
		//更新奖品列表
		$data = array();
		if($good['last_num']-1>=0){
			$data['last_num']=$good['last_num']-1;
			$data['hits']=$good['hits']+1;
		}else{
			$data['last_num']=0;
			$data['hits']=$good['num'];
			$data['is_sys']=0;
		}
		
		M("market_jifenlist")->where("id={$good['id']}")->save($data);
  		return true;
	}
	
	//////////////////////////////////////////填写收货人地址开始 ////////////////////////////////////////////
	public function addressinfo(){
		if($_POST['thecontent']){
			$data['province'] = $_POST['province'];
			$data['city'] = $_POST['city'];
			$data['area'] = $_POST['area'];
			$data['remark'] = text($_POST['fujia']);
			$data['address'] = text($_POST['thecontent']);
			$data['add_ip'] = get_client_ip();
			$data['add_time'] = time();
			$result = M('market_address')->field(true)->where("uid={$this->uid}")->find();
			if($result){
			    $newid = M('market_address')->where("uid={$this->uid}")->save($data);
			}else{
				$data['name']=M('members')->getFieldById($this->uid,"user_name");
				$data['uid'] = $this->uid;
			    $newid = M('market_address')->add($data);
			}
			
			if($newid) exit("1");
			else exit("0");
		}else{
			$u['uid'] = $this->uid;
			$u['uname']=M('members')->getFieldById($this->uid,"user_name");
			$list = M('market_address')->field(true)->where("uid={$this->uid}")->find();
			
			$this->assign("u",$u);
			$this->assign("vo",$list);
			$data['content'] = $this->fetch("address");
			exit(json_encode($data));
		}
	}
	
	public function getarea(){
		$rid = intval($_GET['rid']);
		if(empty($rid)){
			$data['NoCity'] = 1;
			exit(json_encode($data));
		}
		$map['reid'] = $rid;
		$alist = M('area')->field('id,name')->order('sort_order DESC')->where($map)->select();

		if(count($alist)===0){
			$str="<option value=''>--该地区下无下级地区--</option>\r\n";
		}else{
			if($rid==1) $str.="<option value='0'>请选择省份</option>\r\n";
			foreach($alist as $v){
				$str.="<option value='{$v['id']}'>{$v['name']}</option>\r\n";
			}
		}
		$data['option'] = $str;
		$res = json_encode($data);
		echo $res;
	}	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
}