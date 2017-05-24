<?php
// �д��ں���⣬2014-06-11_listam
class CrowddonateAction extends MCommonAction {

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
    public function donate(){
        $p_list=M('pay_bid_userlog')->where('uid='.$this->uid.' and status=1')->select();
        foreach($p_list as $p){
            if(time()>$p['end_time'])
               $userlog= M('pay_bid_userlog')->where('id='.$p['id'])->save(array('status'=>3));
            if($userlog){
                $c_data['pid']=$p['id'];
                $c_data['uid']=$p['uid'];
                $c_data['add_time']=time();
                $c_data['info']="红包".$p['bid_money']."元已过期";
                $c_data['money']=$p['bid_money'];
                $c_data['status']=3;
                M('crowd_user_log')->add($c_data);
                var_dump(M('crowd_user_log')->getLastSql());
            }
        }
        $test['uid']=$this->uid;
        $test['size']=8;
        $list=getZClist($test);
        $this->assign("list",$list['list']);
        $this->assign('pagebar',$list['page']);
        $data['html'] = $this->fetch();
        //var_dump($list);
        exit(json_encode($data));
    }
    public function record(){
        $test['uid']=$this->uid;
        $list=get_user_bid_log($test);
        $this->assign("list",$list['list']);
        $this->assign('pagebar',$list['page']);
        $data['html'] = $this->fetch();

        exit(json_encode($data));
    }
}
