<?php
// 金糯米内核类库，2014-06-11_listam
class MsgAction extends MCommonAction {

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

    public function sysmsg(){
		$map['uid'] = $this->uid;
		//分页处理
		import("ORG.Util.Page");
		$count = M('inner_msg')->where($map)->count('id');
		$p = new Page($count, 15);
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$list = M('inner_msg')->where($map)->order('id DESC')->limit($Lsql)->select();
	
		$read=M("inner_msg")->where("uid={$this->uid} AND status=1")->count('id');

		$this->assign("list",$list);
		$this->assign("pagebar",$page);
		$this->assign("read",$read);
		$this->assign("unread",$count-$read);
		$this->assign("count",$count);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
	
	public function viewmsg(){
		$id = intval($_GET['id']);
		$vo = M("inner_msg")->field('msg')->where("id={$id} AND uid={$this->uid}")->find();
		if(!is_array($vo)){
			$this->assign("msg","数据有误");
			$data['content'] = $this->fetch();
			exit(json_encode($data));
		}
		M("inner_msg")->where("id={$id} AND uid={$this->uid}")->setField("status",1);
		$this->assign("mid",$id);
		$this->assign("msg",$vo['msg']);
                
                $map['uid'] = $this->uid;
		$count = M('inner_msg')->where($map)->count('id');
		$read=M("inner_msg")->where("uid={$this->uid} AND status=1")->count('id');
		$this->assign("read",$read);
		$this->assign("unread",$count-$read);
		$this->assign("count",$count);
                
		$data['content'] = $this->fetch();
		exit(json_encode($data));
	}
	
	public function delmsg(){
		$id = text($_POST['idarr']);
		$wsql = "uid={$this->uid}";
		$up = M("inner_msg")->where("{$wsql} AND id in({$id})")->delete();
		if($up){
			$data['status'] = 1;
			$data['data'] = $id;
			echo json_encode($data);
		}else{
			$data['status'] = 0;
			echo json_encode($data);
		}
	}

}