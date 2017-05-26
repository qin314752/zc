<?php
/**
 * User: Administrator
 */
class InfoCrowdAction extends MCommonAction{
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
    public function crowdsell(){
        //出售中的众筹
        //认筹中的众筹
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        $list = M('crowd_investor ci')
            ->field("ci.*,cf.*")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where("cf.status = 2 AND ci.user_id = ".$uid)->select();
        foreach($list as $key=>$v){
            //筹资剩余时间
            $satrt_time = $list[$key]['start_time'];//开始时间
            $time_limit = $list[$key]['max_duration'];//最长持有期限
            $all_time = $satrt_time + ($time_limit*24*3600*30);
            if($all_time < time()){
                $remain_time = array( "day" => 0, "hour" => 0, "min" => 0, "sec" => 0 );
            }else{
                $timediff = $all_time - time();
                $days = intval( $timediff / 86400 );
                $remain = $timediff % 86400;
                $hours = intval( $remain / 3600 );
                $remain = $remain % 3600;
                $mins = intval( $remain / 60 );
                $secs = $remain % 60;
                $remain_time = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
            }
            $list[$key]['remain_time'] = $remain_time;//剩余时间
        }
        $this->assign('list',$list);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function crowdfrom(){
        //认筹中的众筹
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        $list = M('crowd_investor ci')
            ->field("ci.*,cf.*,ci.id as investor_id")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where("cf.status = 1 AND ci.user_id = ".$uid)->select();
        foreach($list as $key=>$v){
            //筹资剩余时间
            $satrt_time = $list[$key]['start_time'];//开始时间
            $time_limit = $list[$key]['crowd_duration'];//筹资期限
            $all_time = $satrt_time + ($time_limit*24*3600);
            if($all_time < time()){
                $remain_time = array( "day" => 0, "hour" => 0, "min" => 0, "sec" => 0 );
            }else{
                $timediff = $all_time - time();
                $days = intval( $timediff / 86400 );
                $remain = $timediff % 86400;
                $hours = intval( $remain / 3600 );
                $remain = $remain % 3600;
                $mins = intval( $remain / 60 );
                $secs = $remain % 60;
                $remain_time = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
            }
            $list[$key]['remain_time'] = $remain_time;//剩余时间
        }
        $this->assign('list',$list);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function crowdvote(){
        //投票中的众筹
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        $list = M('crowd_investor ci')
            ->field("ci.*,cf.*")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where("cf.status = 3 AND ci.user_id = ".$uid)
            ->select();
        foreach($list as $key=>$v){
            $vote_arr = M('crowd_voting')->where('crowd_id = '.$list[$key]['id'])->order('id desc')->limit(1)->find();
            $vote_id = $vote_arr['id'];
            $vote_detail = M('crowd_vote_detail')->where('vote_id = '.$vote_id.' AND user_id = '.$uid)->find();
            $list[$key]['vote_money'] = $vote_arr['vote_money'];
            if($vote_detail){
                $list[$key]['is_agree'] = $vote_detail['is_agree']==1?"已投赞成票":"已投反对票";
            }else{
                $list[$key]['is_agree'] = "投票中";
            }

            $deadline = $vote_arr['deadline'];//投票截至时间
            $start_time = $vote_arr['add_time'];//投票开始时间
            if($deadline < time()){
                $remain_time = array( "day" => 0, "hour" => 0, "min" => 0, "sec" => 0 );
            }else{
                $timediff = $deadline - time();
                $days = intval( $timediff / 86400 );
                $remain = $timediff % 86400;
                $hours = intval( $remain / 3600 );
                $remain = $remain % 3600;
                $mins = intval( $remain / 60 );
                $secs = $remain % 60;
                $remain_time = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
            }
            $list[$key]['remain_time'] = $remain_time;//剩余时间

        }
        $this->assign('list',$list);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function crowdrepayment(){
        //回款中的众筹
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        $list = M('crowd_investor ci')
            ->field("ci.*,cf.*")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where("cf.status = 4 AND ci.user_id = ".$uid)
            ->select();
        foreach($list as $key=>$v){
            $vote_arr = M('crowd_voting')->where('crowd_id = '.$list[$key]['id'])->order('id desc')->limit(1)->find();
            $vote_id = $vote_arr['id'];
            $list[$key]['vote_money'] = $vote_arr['vote_money'];
        }
        $this->assign('list',$list);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function crowddone(){
        //已完成的众筹
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        import("ORG.Util.Page");
        $count =M('crowd_investor ci')
            ->field("ci.*,cf.*")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where("cf.status in (5,9)  AND ci.user_id = ".$uid)
            ->count("ci.id");;
        $p = new Page($count, 10);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $list = M('crowd_investor ci')
            ->field("ci.*,cf.*")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where("cf.status in (5,9) AND ci.user_id = ".$uid)
            ->limit($Lsql)
            ->order("ci.id desc")
            ->select();
        foreach($list as $key=>$v){
            $vote_arr = M('crowd_voting')->where('crowd_id = '.$list[$key]['id'])->order('id desc')->limit(1)->find();
            $vote_id = $vote_arr['id'];
            $list[$key]['vote_money'] = $vote_arr['vote_money'];
        }
       // dump(M('crowd_investor ci')->getLastSql());
        $this->assign('list',$list);
        $this->assign('page',$page);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function crowdwithdraw(){
        //已完成的众筹
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        $list = M('crowd_investor ci')
            ->field("ci.*,cf.*")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->where("cf.status = 8  AND ci.user_id = ".$uid)
            ->select();
        foreach($list as $key=>$v){
            $vote_arr = M('crowd_voting')->where('crowd_id = '.$list[$key]['id'])->order('id desc')->limit(1)->find();
            $vote_id = $vote_arr['id'];
            $list[$key]['vote_money'] = $vote_arr['vote_money'];
        }
        $this->assign('list',$list);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
}