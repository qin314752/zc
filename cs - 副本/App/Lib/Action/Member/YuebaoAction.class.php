<?php

/**
 * Class YuebaoAction
 */
class YuebaoAction extends MCommonAction {

    public function test(){

        echo "<br/>".date('Y-m-d');
        echo "<br/>".mktime(0,0,0,date('m'),date('d'),date('Y'));
        echo "<br/>".time();
        echo date('Y-m-d H:i:s');

    }

    public function index(){
		$this->display();
    }

    public function log(){
        $logtype = C('MONEY_LOG');
        $this->assign('log_type',$logtype);

        $map['uid'] = $this->uid;
//        if($_GET['start_time']&&$_GET['end_time']){
//            $_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
//            $_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
//
//            if($_GET['start_time']<$_GET['end_time']){
//                $map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
//                $search['start_time'] = $_GET['start_time'];
//                $search['end_time'] = $_GET['end_time'];
//            }
//        }
//        if(!empty($_GET['log_type'])){
//            $map['type'] = intval($_GET['log_type']);
//            $search['log_type'] = intval($_GET['log_type']);
//        }

        $list = Yuebao_Log($map);

//        $this->assign('search',$search);
        $this->assign("list",$list['list']);
        $this->assign("pagebar",$list['page']);
//        $this->assign("query", http_build_query($search));
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    /**
     *
     */
    public function in(){
        $members_data = M('members')->find($this->uid);
        $member_money_data = M('member_money')->where(array(uid=>$this->uid))->find();
        $yuebao_info_data = M("yuebao_info")->where(array(uid=>$this->uid))->find();
        $this->assign('members_data',$members_data);
        $this->assign('member_money_data',$member_money_data);
        $this->assign('yuebao_info_data',$yuebao_info_data);
        $data['content'] = $this->fetch();
        ajaxmsg($data);
    }

    /**
     *
     */
    public function doin(){
        $money = $_REQUEST['money'];
        $pin_pass = M('members')->getFieldById($this->uid,'pin_pass');
        if($pin_pass != md5($_REQUEST['pin_pass'])){
            exit(json_encode(array(code=>2,msg=>'支付密码有误！')));
        }
        $data = Yuebao_In($this->uid,$money);
//        $data = array(code=>1,msg=>'ok');
        exit(json_encode($data));
    }

    /**
     *
     */
    public function out(){
        $members_data = M('members')->find($this->uid);
        $member_money_data = M('member_money')->where(array(uid=>$this->uid))->find();
        $yuebao_info_data = M("yuebao_info")->where(array(uid=>$this->uid))->find();
        $this->assign('members_data',$members_data);
        $this->assign('member_money_data',$member_money_data);
        $this->assign('yuebao_info_data',$yuebao_info_data);
        $data['content'] = $this->fetch();
        ajaxmsg($data);
    }

    /**
     *
     */
    public function doout(){
        $money = $_REQUEST['money'];
        $pin_pass = M('members')->getFieldById($this->uid,'pin_pass');
        if($pin_pass != md5($_REQUEST['pin_pass'])){
            exit(json_encode(array(code=>2,msg=>'支付密码有误！')));
        }
        $data = Yuebao_Out($this->uid,$money);
//        $data = array(code=>1,msg=>'ok');
        exit(json_encode($data));
    }

}