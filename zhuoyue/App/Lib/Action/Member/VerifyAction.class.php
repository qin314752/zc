<?php

// 金糯米内核类库，2014-06-11_listam
class VerifyAction extends MVCommonAction {

    public function vcenter(){
        $this->checkinfo();
        $pre = C('DB_PREFIX');
        $vinfo = M("members m")
            ->field("m.user_phone,m.user_email,m.user_leve,m.time_limit,ms.id_status,ms.email_status
            ,ms.phone_status,ms.safequestion_status,mi.idcard")
            ->join("{$pre}members_status ms on ms.uid = m.id")
            ->join("{$pre}member_info mi on mi.uid = m.id")
            ->where("m.id = {$this->uid}")
            ->find();
        if($vinfo["user_leve"]>0 && $vinfo["time_limit"]>time()){
            $vinfo["vip_status"]=1;
        }
        if($vinfo["user_leve"]>0 && $vinfo["time_limit"]<time()){
            $vinfo["vip_status"]=2;
        }
        $this->assign("vinfo", $vinfo);
        $data['html'] = $this->fetch();
        exit(json_encode($data));

    }
    public function vip(){
        $this->checkinfo();
        $vip_status = 0;//未申请
        $vo = M('members')->field('user_leve,time_limit')->find($this->uid);
        if($vo['user_leve']>0 && $vo['time_limit']>time()){
            $vip_status = 2;//vip中
        }
        if($vo['user_leve']>0 && $vo['time_limit']<time()){
            $vip_status = 1;//过期
        }
        $vx = M('vip_apply')->where("uid={$this->uid} AND status=0")->count("id");
        if($vx>0){
            $vip_status = 3;//审核中
        }
        $map['is_kf'] = 1;
        $count = M('ausers')->where($map)->count('id');
        if($count==0) unset($map['area_id']);

        //分页处理
        import("ORG.Util.Page");
        $count = M('ausers')->where($map)->count('id');
        $p = new Page($count, 4);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理
        $list = M('ausers')->where($map)->limit($Lsql)->select();
        $this->assign("vipTime",$vo['time_limit']);
        $this->assign("vip_status",$vip_status);
        $this->assign("list",$list);
        $this->assign("count",$count);
        $this->assign("page",$page);
        $data['html'] = $this->fetch();
        ajaxmsg($data);
//        $this->display();
    }

    public function getkf(){

        $map['is_kf'] = 1;
        $count = M('ausers')->where($map)->count('id');
        if($count==0) unset($map['area_id']);

        //分页处理
        import("ORG.Util.Page");
        $count = M('ausers')->where($map)->count('id');
        $p = new Page($count, 4);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理
        $list = M('ausers')->where($map)->limit($Lsql)->select();

        $this->assign("list",$list);
        $this->assign("count",$count);
        $this->assign("page",$page);
        $data['html'] = $this->fetch();
        ajaxmsg($data);
    }

    public function vipapply(){
        $mmdata=M('member_money')->where("uid={$this->uid}")->find();
        $datag = get_global_setting();
        $mmpd=$mmdata['account_money']+$mmdata['back_money']-$datag['fee_vip'];
        if($mmpd<0){
            ajaxmsg("您的余额不足,请充值后再申请",0);
        }

        $kfid = intval($_POST['kfid']);
        $des = text($_POST['des']);
        $savedata['kfid'] = $kfid;
        $savedata['uid'] = $this->uid;
        $savedata['des'] = $des;
        $savedata['add_time'] = time();
        $savedata['status'] = 0;

        $newid = M('vip_apply')->add($savedata);
        if($newid) ajaxmsg();
        else ajaxmsg("保存失败，请重试",0);
    }
    function checkinfo(){
        $pre = C('DB_PREFIX');
        $checkinfo = M("members m")->field("m.pin_pass,s.id_status")->join("{$pre}members_status s ON s.uid=m.id")->where("m.id={$this->uid}")->find();
        //if ($checkinfo["id_status"] != 1&&$checkinfo["id_status"] != 3) {
        //    echo "<script>window.location.href='/member/verify/regverifyid';</script>";
        //    exit;
        //}
        //if (empty($checkinfo["pin_pass"])) {
        //    echo "<script>window.location.href='/member/verify/setpinpass';</script>";
        //    exit;
        //}
    }

    public function index(){
        $this->checkinfo();
		//if(!$_GET['id']) redirect(__APP__."/member/verify?id=1#fragment-1");
        $minfo =getMinfo($this->uid,true);
        $pin_pass = $minfo['pin_pass'];
        $has_pin = (empty($pin_pass))?"no":"yes";
        $this->assign("has_pin",$has_pin);
        $this->assign("memberinfo", M('members')->find($this->uid));
        $this->assign("memberdetail", M('member_info')->find($this->uid));
        $this->assign("minfo",$minfo);
		$this->display();
    }

    public function welcome(){
        $this->checkinfo();
		$data['content'] = $this->fetch();
		exit(json_encode($data));
    }

    public function email() {
        $email = M('members')->field('user_email')->find($this->uid);
        $this->assign("email_status", M('members_status')->getFieldByUid($this->uid, 'email_status'));
        $this->assign("email", M('members')->getFieldById($this->uid, 'user_email'));
        $sq = M('member_safequestion')->find($this->uid);
        $this->assign("sq", $sq);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    public function emailvalided() {
        $status = M("members_status")->getFieldByUid($this->uid, 'email_status');
        ajaxmsg('', $status);
    }

  	public function emailvsend1(){
		$status=Notice(8,$this->uid);
		if($status) ajaxmsg();
		else  ajaxmsg('',0);
    }
	
    public function emailvsend(){
		$data['user_email'] = text($_POST['email']);
		$data['last_log_time']=time();
		$newid = M('members')->where("id = {$this->uid}")->save($data);//更改邮箱，重新激活
		if($newid){
			$status=Notice(8,$this->uid);
			if($status) ajaxmsg('邮件已发送，请注意查收！',1);
			else ajaxmsg('邮件发送失败,请重试！',0);
		}else{
			 ajaxmsg('新邮件修改失败',2);
		}
    }

    public function ckemail() {
        $map['user_email'] = text($_POST['Email']);
        $count = M('members')->where($map)->count('id');
        //$id = M('members')->where($map)->find('id');
        $id = $this->uid;
        $map2['uid'] = text($_POST['Email']);
        $email_status = M('members_status')->where($map2)->find('email_status');

        if ($count > 0 && ($email_status == 1)) {
            $json['status'] = 0;
            exit(json_encode($json));
        } else {
            $json['status'] = 1;
            exit(json_encode($json));
        }
    }

    public function idcard() {
        $ids = M('members_status')->getFieldByUid($this->uid, 'id_status');
        if ($ids == 1) {
            $vo = M("member_info")->field('idcard,real_name')->find($this->uid);
            $this->assign("vo", $vo);
            $data['html'] = $this->fetch();
        }
        $id5config = FS("Dynamic/id5");
        
        $this->assign("id_status", $ids);
        $this->assign("id5_status", $id5config['enable']);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    private $des_key = '';
    public function saveid() {

        $isimg = session('idcardimg');
        $isimg2 = session('idcardimg2');
        $data['real_name'] = text($_POST['realname']);
        $data['idcard'] = text($_POST['idcard']);
        $data['up_time'] = time();
        /////////////////////////
        $data1['idcard'] = text($_POST['idcard']);
        $data1['up_time'] = time();
        $data1['uid'] = $this->uid;
        $data1['status'] = 0;
        $c = M('name_apply')->where("idcard = {$data1['idcard']}")->count('uid');
//        if($c > 0) ajaxmsg("该身份证号已被使用",0);
        $b = M('name_apply')->where("uid = {$this->uid}")->count('uid');
        if ($b == 1) {
            M('name_apply')->where("uid ={$this->uid}")->save($data1);
        } else {
            M('name_apply')->add($data1);
        }
        ////////////////////////
        if (empty($data['real_name']) || empty($data['idcard']))
            ajaxmsg("请填写真实姓名和身份证号码", 0);
        $xuid = M('member_info')->getFieldByIdcard($data['idcard'], 'uid');
        if ($xuid > 0 && $xuid != $this->uid)
            ajaxmsg("此身份证号码已被人使用", 0);

        $id5config = FS("Dynamic/id5");
        $nuomiid5config = FS("Dynamic/nuomiid5");
        if ($id5config['enable'] == 0 && $nuomiid5config['enable'] == 0) {
//            if ($isimg != 1)
//                ajaxmsg("请先上传身份证正面图片", 0);
//            if ($isimg2 != 1)
//                ajaxmsg("请先上传身份证反面图片", 0);


            $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
            if ($c == 1) {
                $newid = M('member_info')->where("uid = {$this->uid}")->save($data);
            } else {
                $data['uid'] = $this->uid;
                $newid = M('member_info')->add($data);
            }

            session('idcardimg', NULL);
            session('idcardimg2', NULL);
            if ($newid) {
                $ms = M('members_status')->where("uid={$this->uid}")->setField('id_status', 3);
                if ($ms == 1) {
                    ajaxmsg();
                } else {
                    $dt['uid'] = $this->uid;
                    $dt['id_status'] = 3;
                    M('members_status')->add($dt);
                }
                ajaxmsg();
            } else
                ajaxmsg("保存失败，请重试", 0);
        }elseif($id5config['enable'] == 1){
            $config['query_url'] = "http://121.40.136.150:8080/IdInDataAu/api/authenInfoApi.htm"; //请求地址
            $config['user_id'] = $id5config['ID5ID']; //商户ID
            $config['md5_key'] = $id5config['md5_key']; //MD5密钥
            $config['des_key'] = $id5config['des_key']; //DES密钥

            require C("APP_ROOT")."Lib/ID5/sendIdCardAuthen.php";
            $idcard = new sendIdCardAuthen($config);

            //var_dump($_REQUEST['realname']);
            //$name=iconv('GBK', 'UTF-8', $_REQUEST['realname']);
            $idcard->set($_REQUEST['realname'], $_REQUEST['idcard']);
            $id5_status=$idcard->checkOnline();
            if($id5_status==3){
                $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
                if ($c == 1) {
                    $newid = M('member_info')->where("uid = {$this->uid}")->save($data);
                } else {
                    $data['uid'] = $this->uid;
                    $newid = M('member_info')->add($data);
                }

                session('idcardimg', NULL);
                session('idcardimg2', NULL);
                if ($newid) {
                    $ms = M('members_status')->where("uid={$this->uid}")->setField('id_status', 1);
                    if ($ms == 1) {
                        ajaxmsg();
                    } else {
                        $dt['uid'] = $this->uid;
                        $dt['id_status'] = 1;
                        M('members_status')->add($dt);
                    }
                    ajaxmsg();
                } else
                    ajaxmsg("保存失败，请重试", 0);

            }else{
                ajaxmsg("实名认证失败。错误原因:".$id5_status, 0);
            }

        }elseif($nuomiid5config['enable'] == 1){
            $userid = $nuomiid5config['USERID'];//userid
            $pass = $nuomiid5config['KEY'];//password
            $realname = $_REQUEST['realname'];
            $idcard = $_REQUEST['idcard'];
            $nuomiid5_result = file_get_contents("http://realname.tuanshang.net/Api/api.php?userid={$userid}&password={$pass}&realname={$realname}&idcard={$idcard}",false);
            $result = json_decode($nuomiid5_result,true);
            if($result['code']==200){
                $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
                if ($c == 1) {
                    $newid = M('member_info')->where("uid = {$this->uid}")->save($data);
                } else {
                    $data['uid'] = $this->uid;
                    $newid = M('member_info')->add($data);
                }

                session('idcardimg', NULL);
                session('idcardimg2', NULL);
                if ($newid) {
                    $ms = M('members_status')->where("uid={$this->uid}")->setField('id_status', 1);
                    if ($ms == 1) {
                        ajaxmsg();
                    } else {
                        $dt['uid'] = $this->uid;
                        $dt['id_status'] = 1;
                        M('members_status')->add($dt);
                    }
                    ajaxmsg();
                } else
                    ajaxmsg("保存失败，请重试", 0);

            }else{
                ajaxmsg("实名认证失败。错误原因:".$result['message'], 0);
            }
        }
    }
//    public function saveid() {
//        $data['real_name'] = text($_POST['realname']);
//        $data['idcard'] = text($_POST['idcard']);
//        $data['up_time'] = time();
//        /////////////////////////
//        $data1['idcard'] = text($_POST['idcard']);
//        $data1['up_time'] = time();
//        $data1['uid'] = $this->uid;
//        $data1['status'] = 0;
//        $c = M('name_apply')->where("idcard = {$data1['idcard']}")->count('uid');
////        if($c > 0) ajaxmsg("该身份证号已被使用",0);
//        $b = M('name_apply')->where("uid = {$this->uid}")->count('uid');
//        if ($b == 1) {
//            M('name_apply')->where("uid ={$this->uid}")->save($data1);
//        } else {
//            M('name_apply')->add($data1);
//        }
//        ////////////////////////
//        if (empty($data['real_name']) || empty($data['idcard']))
//            ajaxmsg("请填写真实姓名和身份证号码", 0);
//        $xuid = M('member_info')->getFieldByIdcard($data['idcard'], 'uid');
//        if ($xuid > 0 && $xuid != $this->uid)
//            ajaxmsg("此身份证号码已被人使用", 0);
//
//        $id5config = FS("Dynamic/id5");
//        if ($id5config['enable'] == 0) {
////            if ($isimg != 1)
////                ajaxmsg("请先上传身份证正面图片", 0);
////            if ($isimg2 != 1)
////                ajaxmsg("请先上传身份证反面图片", 0);
////
//
//            $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
//            if ($c == 1) {
//                $newid = M('member_info')->where("uid = {$this->uid}")->save($data);
//            } else {
//                $data['uid'] = $this->uid;
//                $newid = M('member_info')->add($data);
//            }
//
////            session('idcardimg', NULL);
////            session('idcardimg2', NULL);
//            if ($newid) {
//                $ms = M('members_status')->where("uid={$this->uid}")->setField('id_status', 3);
//                if ($ms == 1) {
//                    ajaxmsg();
//                } else {
//                    $dt['uid'] = $this->uid;
//                    $dt['id_status'] = 3;
//                    M('members_status')->add($dt);
//                }
//                ajaxmsg();
//            } else
//                ajaxmsg("保存失败，请重试", 0);
//        }else {
//            $config['query_url'] = "http://121.40.136.150:8080/IdInDataAu/api/authenInfoApi.htm"; //请求地址
//            $config['user_id'] = $id5config['ID5ID']; //商户ID
//            $config['md5_key'] = $id5config['md5_key']; //MD5密钥
//            $config['des_key'] = $id5config['des_key']; //DES密钥
//
//            require C("APP_ROOT")."Lib/ID5/sendIdCardAuthen.php";
//            $idcard = new sendIdCardAuthen($config);
//
//            //var_dump($_REQUEST['realname']);
//            //$name=iconv('GBK', 'UTF-8', $_REQUEST['realname']);
//            $idcard->set($_REQUEST['realname'], $_REQUEST['idcard']);
//            $id5_status=$idcard->checkOnline();
//            if($id5_status==3){
//                $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
//                    if ($c == 1) {
//                        $newid = M('member_info')->where("uid = {$this->uid}")->save($data);
//                    } else {
//                        $data['uid'] = $this->uid;
//                        $newid = M('member_info')->add($data);
//                    }
//
//                    session('idcardimg', NULL);
//                    session('idcardimg2', NULL);
//                    if ($newid) {
//                        $ms = M('members_status')->where("uid={$this->uid}")->setField('id_status', 1);
//                        setMemberStatus($newid, 'id', 1, 10, '实名');
//                        if ($ms == 1) {
//                            ajaxmsg();
//                        } else {
//                            $dt['uid'] = $this->uid;
//                            $dt['id_status'] = 1;
//                            M('members_status')->add($dt);
//                        }
//                        ajaxmsg();
//                    } else
//                        ajaxmsg("保存失败，请重试", 0);
//
//            }else{
//                ajaxmsg("实名认证失败。错误原因:".$id5_status, 0);
//            }
//
//        }
//    }

    public function safequestion() {
        $isid = M('members_status')->getFieldByUid($this->uid, 'safequestion_status');
        if ($isid == 1) {
            $sq = M('member_safequestion')->find($this->uid);
            $this->assign("sq", $sq);
            $this->assign("userphone", M('members')->getFieldById($this->uid, 'user_phone'));
        }
        $this->assign("safe_question", $isid);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    public function questionsave() {
        $data['question1'] = text($_POST['q1']);
        $data['question2'] = text($_POST['q2']);
        $data['answer1'] = text($_POST['a1']);
        $data['answer2'] = text($_POST['a2']);
        $data['add_time'] = time();
        $c = M('member_safequestion')->where("uid = {$this->uid}")->count('uid');
        if ($c == 1)
            $newid = M("member_safequestion")->where("uid={$this->uid}")->save($data);
        else {
            $data['uid'] = $this->uid;
            $newid = M('member_safequestion')->add($data);
        }
        if ($newid) {
            M('members_status')->where("uid = {$this->uid}")->setField('safequestion_status', 1);
            $newid = setMemberStatus($this->uid, 'safequestion', 1, 6, '安全问题');
            if ($newid) {
                addInnerMsg($uid, "您的安全问题已设置", "您的安全问题已设置");
            }
            ajaxmsg();
        } else
            ajaxmsg("", 0);
    }

    public function cellphone() {
        $isid = M('members_status')->getFieldByUid($this->uid, 'phone_status');
        $phone = M('members')->getFieldById($this->uid, 'user_phone');
        $this->assign("phone", $phone);
        $sq = M('member_safequestion')->find($this->uid);
        $this->assign("sq", $sq);
        $this->assign("phone_status", $isid);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];
        $this->assign("is_manual", $is_manual);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    /* public function sendphone(){
      $smsTxt = FS("Dynamic/smstxt");
      $smsTxt=de_xie($smsTxt);
      $phone = text($_POST['cellphone']);
      $xuid = M('members')->getFieldByUserPhone($phone,'id');
      //if($xuid>0 && $xuid<>$this->uid) ajaxmsg("",2);

      $code = rand_string($this->uid,6,1,2);
      $res = sendsms($phone,str_replace(array("#UserName#","#CODE#"),array(session('u_user_name'),$code),$smsTxt['verify_phone']));
      if($res){
      session("temp_phone",$phone);
      ajaxmsg();
      }
      else ajaxmsg("",0);
      } */

    public function sendphone() {
        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $phone = text($_POST['cellphone']);
        $xuid = M('members')->getFieldByUserPhone($phone, 'id');
        if ($xuid > 0 && $xuid <> $this->uid)
            ajaxmsg("", 2);

        $code = rand_string($this->uid, 6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];
        if ($is_manual == 0) {//如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
            $res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
        } else {//否则，则由后台管理员来手动审核手机验证
            $res = true;
            $phonestatus = M('members_status')->getFieldByUid($this->uid, 'phone_status');
            if ($phonestatus == 1)
                ajaxmsg("手机已经通过验证", 1);
            $updata['phone_status'] = 3; //待审核

            $updata1['user_phone'] = $phone;
            $a = M('members')->where("id = {$this->uid}")->count('id');
            if ($a == 1)
                $newid = M("members")->where("id={$this->uid}")->save($updata1);
            else {
                M('members')->where("id={$this->uid}")->setField('user_phone', $phone);
            }

            $updata2['cell_phone'] = $phone;
            $b = M('member_info')->where("uid = {$this->uid}")->count('uid');
            if ($b == 1)
                $newid = M("member_info")->where("uid={$this->uid}")->save($updata2);
            else {
                $updata2['uid'] = $this->uid;
                $updata2['cell_phone'] = $phone;
                M('member_info')->add($updata2);
            }
            $c = M('members_status')->where("uid = {$this->uid}")->count('uid');
            if ($c == 1)
                $newid = M("members_status")->where("uid={$this->uid}")->save($updata);
            else {
                $updata['uid'] = $this->uid;
                $newid = M('members_status')->add($updata);
            }
            if ($newid) {
                ajaxmsg();
            } else
                ajaxmsg("验证失败", 0);

            //////////////////////////////////////////////////////////////
        }
        if ($res) {
            session("temp_phone", $phone);
            ajaxmsg();
        } else
            ajaxmsg("", 0);
    }

    public function done() {
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    public function validatephone() {
        $phonestatus = M('members_status')->getFieldByUid($this->uid, 'phone_status');
        if ($phonestatus == 1)
            ajaxmsg("手机已经通过验证", 1);
        if (is_verify($this->uid, text($_POST['code']), 2, 10 * 60)) {
            $updata['phone_status'] = 1;
            if (!session("temp_phone"))
                ajaxmsg("验证失败", 0);

            $updata1['user_phone'] = session("temp_phone");
            $a = M('members')->where("id = {$this->uid}")->count('id');
            if ($a == 1)
                $newid = M("members")->where("id={$this->uid}")->save($updata1);
            else {
                M('members')->where("id={$this->uid}")->setField('user_phone', session("temp_phone"));
            }

            $updata2['cell_phone'] = session("temp_phone");
            $b = M('member_info')->where("uid = {$this->uid}")->count('uid');
            if ($b == 1)
                $newid = M("member_info")->where("uid={$this->uid}")->save($updata2);
            else {
                $updata2['uid'] = $this->uid;
                $updata2['cell_phone'] = session("temp_phone");
                M('member_info')->add($updata2);
            }
            $c = M('members_status')->where("uid = {$this->uid}")->count('uid');
            if ($c == 1)
                $newid = M("members_status")->where("uid={$this->uid}")->save($updata);
            else {
                $updata['uid'] = $this->uid;
                $newid = M('members_status')->add($updata);
            }
            if ($newid) {
                $newid = setMemberStatus($this->uid, 'phone', 1, 10, '手机');
                ajaxmsg();
            } else
                ajaxmsg("验证失败", 0);
        }else {
            ajaxmsg("验证校验码不对，请重新输入！", 2);
        }
    }

    public function ajaxupimg() {
        if (!empty($_FILES['imgfile']['name'])) {
            $this->fix = false;
            $this->saveRule = date("YmdHis", time()) . rand(0, 1000) . "_{$this->uid}";
            $this->savePathNew = C('MEMBER_UPLOAD_DIR') . 'Idcard/';
            $this->thumbMaxWidth = "1000,1000";
            $this->thumbMaxHeight = "1000,1000";
            $info = $this->CUpload();
            $img = $info[0]['savepath'] . $info[0]['savename'];
        }
        if ($img) {
            $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
            if ($c == 1) {
                $newid = M("member_info")->where("uid={$this->uid}")->setField('card_img', $img);
            } else {
                $data['uid'] = $this->uid;
                $data['card_img'] = $img;
                $newid = M('member_info')->add($data);
            }
            session("idcardimg", "1");
            ajaxmsg('', 1);
        } else
            ajaxmsg('', 0);
    }

    public function ajaxupimg2() {
        if (!empty($_FILES['imgfile2']['name'])) {
            $this->fix = false;
            $this->saveRule = date("YmdHis", time()) . rand(0, 1000) . "_{$this->uid}_back";
            $this->savePathNew = C('MEMBER_UPLOAD_DIR') . 'Idcard/';
            $this->thumbMaxWidth = "1000,1000";
            $this->thumbMaxHeight = "1000,1000";
            $info = $this->CUpload();
            $img = $info[0]['savepath'] . $info[0]['savename'];
        }
        if ($img) {
            $c = M('member_info')->where("uid = {$this->uid}")->count('uid');
            if ($c == 1) {
                $newid = M("member_info")->where("uid={$this->uid}")->setField('card_back_img', $img);
            } else {
                $data['uid'] = $this->uid;
                $data['card_back_img'] = $img;
                $newid = M('member_info')->add($data);
            }
            session("idcardimg2", "1");
            ajaxmsg('', 1);
        } else
            ajaxmsg('', 0);
    }

    public function face(){
		$this->assign("face",M('members_status')->field("face_status")->where("uid=".$this->uid)->find());
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function video() {
        $this->assign("video", M('members_status')->field("video_status")->where("uid=" . $this->uid)->find());
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    ////////////////////////////
    public function changesafe() {
        $map['answer1'] = text($_POST['a1']);
        $map['answer2'] = text($_POST['a2']);
        $map['uid'] = $this->uid;
        $c = M('member_safequestion')->where($map)->count('uid');
        if ($c == 0)
            ajaxmsg('', 0);
        else {
            session('temp_safequestion', 1);
            ajaxmsg();
        }
    }

    public function changesafeact() {
        $is_can = session('temp_safequestion');
        if ($is_can == 1) {
            $data['uid'] = $this->uid;
            $data['question1'] = text($_POST['q1']);
            $data['question2'] = text($_POST['q2']);
            $data['answer1'] = text($_POST['a1']);
            $data['answer2'] = text($_POST['a2']);
            $newid = M('member_safequestion')->save($data);
            if ($newid) {
                session('temp_safequestion', NULL);
                ajaxmsg();
            } else
                ajaxmsg('', 0);
        }else {
            ajaxmsg('', 0);
        }
    }

    public function sendphonecode() {
        $r = Notice(3, $this->uid);
        if ($r)
            ajaxmsg();
        else
            ajaxmsg('', 0);
    }

    public function sendphonecodex() {
        $p = text($_POST['phone']);
        $c = M('members')->where("user_phone='{$p}'")->count('id');
        if ($c > 0)
            ajaxmsg('', 2);
        $r = Notice(4, $this->uid, array('phone' => $p));
        if ($r)
            ajaxmsg();
        else
            ajaxmsg('', 0);
    }

    public function changephone() {
        $vcode = text($_POST['code']);
        $pcode = is_verify($this->uid, $vcode, 4, 10 * 60);
        if ($pcode) {

            session('temp_phone', 1);
            ajaxmsg();
        } else
            ajaxmsg('', 0);
    }

    public function changephoneact() {
        $xs = session('temp_phone');
        $vcode = text($_POST['code']);
        $pcode = is_verify($this->uid, $vcode, 5, 10 * 60);
        if ($pcode && $xs == 1) {
            $newid = M('members')->where("id={$this->uid}")->setField('user_phone', text($_POST['phone']));
            $newid1 = M('members')->where("id={$this->uid}")->setField('user_name', text($_POST['phone']));
            $updata2['cell_phone'] = text($_POST['phone']);
            $newid = M("member_info")->where("uid={$this->uid}")->save($updata2);
            session('temp_phone', NULL);
            if ($newid && $newid1)
                ajaxmsg();
            else
                ajaxmsg('', 0);
        } else
            ajaxmsg('', 0);
    }

    public function sendemailtov() {
        $user_email=M('members')->field('user_email,user_name,user_phone')->find($this->uid);
        if($user_email['user_email'] == ''){
            ajaxmsg('未进行邮箱验证，无法发送', 3);
        }else{
            $r = Notice(5, $this->uid);
            if ($r)
                ajaxmsg();
            else
                ajaxmsg('', 0);
        }

    }

    public function doemailchangephone() {
        $code = text($_POST['safecode']);
        $r = is_verify($this->uid, $code, 6, 10 * 60);
        if (!$r)
            ajaxmsg("", 2);
        $map['answer1'] = text($_POST['qone']);
        $map['answer2'] = text($_POST['qtwo']);
        $map['uid'] = $this->uid;
        $c = M('member_safequestion')->where($map)->count('uid');
        if ($c == 0)
            ajaxmsg('', 0);
        session('temp_phone', 1);
        ajaxmsg();
    }

    public function sendverify() {
        $r = Notice(2, $this->uid);
        if ($r)
            echo(1);
        else
            echo(0);
    }

    public function verifyep() {
        $pcode = is_verify($this->uid, text($_POST['pcode']), 3, 10 * 60);
        $ecode = is_verify($this->uid, text($_POST['ecode']), 3, 10 * 60);

		if($pcode && $ecode){
			session('temp_safequestion',1);
			ajaxmsg();
		}else{
			ajaxmsg('',0);
		}
	}
	public function savepinpass(){
        $pin = MD5($_REQUEST['pinpass']);
        $pass = M('members')->where("id={$this->uid}")->find();
        if($pin == $pass['user_pass'])
        {
            ajaxmsg("支付密码不能和登录密码一致！请重新设置",0);
        }
        $newid = M('members')->where("id={$this->uid}")->setField('pin_pass',$pin);
        if($newid){
            ajaxmsg();
        }else{
            ajaxmsg("设置失败，请重试",0);
        }
    }
    public function regverifyid() {
        $member_info = M("members_status")->field("id_status")->where("uid = {$this->uid}")->find();
        $this->assign("id_status",$member_info['id_status']);
        $this->display();
    }

}
