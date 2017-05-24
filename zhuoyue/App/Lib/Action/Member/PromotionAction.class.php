<?php
// 金糯米内核类库，2014-06-11_listam
class PromotionAction extends MCommonAction {

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

    public function promotion(){
		$_P_fee=get_global_setting();
		$this->assign("reward",$_P_fee);	
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function promotionlog(){
		$map['uid'] = $this->uid;
		$map['type'] = array("in","1,13");
		$list = getMoneyLog($map,15);
		
		$totalR = M('member_moneylog')->where("uid={$this->uid} AND type in(1,13)")->sum('affect_money');
		$this->assign("totalR",$totalR);		
		$this->assign("CR",M('members')->getFieldById($this->uid,'reward_money'));		
		$this->assign("list",$list['list']);		
		$this->assign("pagebar",$list['page']);		

		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

	public function promotionfriend(){
		$pre = C('DB_PREFIX');
		$uid=session('u_id');
		$field = " m.id,m.user_name,m.reg_time,sum(ml.affect_money) jiangli ";
		$field1 = " m.user_name,m.reg_time,m.user_phone,mi.real_name,m.id";
		$vm = M("members m")->field($field)->join(" nuomi_member_moneylog ml ON m.id = ml.target_uid ")->where(" m.recommend_id ={$uid} AND ml.type =13")->group("ml.target_uid")->select();
		$vm1 = M("members m")->field($field1)->join("{$pre}member_info mi on mi.uid = m.id")->where(" m.recommend_id ={$uid}")->group("m.id")->select();
		foreach($vm1 as $k=>$value){
            $count = M("member_moneylog")->where("uid = {$value['id']} and type in (15,37)")->count();
            $jiangli = M("member_moneylog")->where("target_uid = {$value['id']} and type =13")->sum("affect_money");
            $vm1[$k]['count'] = $count;
            $vm1[$k]['jiangli'] = $jiangli;
        }

        $this->assign("vm",$vm);
		$this->assign("vi",$vm1);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
}