<?php
/**
 * App众筹系统接口文件
 * @author 李广为
 * @time 2016-04-18
 */
class ServerAction extends HCommonAction
{
    /**
     * 生成token
     */
    private function getToken($id){
        $time = strtotime(date('Y-m-d',strtotime('+7 day')));
        $str = $id."_".$time."_xfqzappjhastehj";
        $st = base64_encode($str);
        return $st;
    }
    private function getPToken($code,$phone){
        $str = $code."_".$phone."_".(time()+600);
        $st = base64_encode($str);
        return $st;
    }
    private function is_PToken($token){
        $str = base64_decode($token);
        $arr = explode("_",$str);
        $code = $arr[0];
        $phone = $arr[1];
        $time = $arr[2];
        $res = time()>$time||$token==""||sizeof($arr)!=3?0:1;
        $data['pcode']= $code;
        $data['phone']= $phone;
        $data["res"] = $res;
        return $data;
    }
    private function is_Token($token){
        $str = base64_decode($token);
        $arr = explode("_",$str);

        $id = $arr[0];
        $time = $arr[1];
        $res = time()>$time||$token==""||sizeof($arr)!=3||$arr[2]!="xfqzappjhastehj"?0:1;
        $data['uid']= $id;
        $data["res"] = $res;
        return $data;
    }
    private function getLeveIco($num){
        $leveconfig = FS("Dynamic/leveconfig");
        foreach($leveconfig as $key=>$v){
            if($num>=$v['start'] && $num<=$v['end']){
                return $v['name'];
            }
        }
    }


    /**
     * 注册
     * 参数
     * phone
     * pcode
     * pwd
     */

    public function register(){

//        $object = json_decode(file_get_contents('php://input', true));
//        $obj = json_decode( json_encode( $object),true);
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $count = M("members")->where("user_name = '{$obj["phone"]}'")->count();
        if($count>0){
            $output = array('event'=>0,'msg'=>'用户名被使用');
            exit(json_encode($output));
        }
        $res = $this->is_PToken($obj['token']);
        if($res["res"]==0){
            $output = array('event'=>2,'msg'=>'验证码已过期');
            exit(json_encode($output));
        }
        if ($res['pcode'] != $obj['pcode']||$res["phone"]!=$obj["phone"]) {
            $output = array('event'=>1,'msg'=>'验证码错误');
            exit(json_encode($output));
        }
        if($obj["invitecode"]!=""&&extra_decode($obj["invitecode"],16)==0){
            $output = array('event'=>3,'msg'=>'邀请码错误'.$obj["invitecode"]);
            exit(json_encode($output));
        }

        $data['user_name'] = text($obj["phone"]);
        $data['user_phone'] = text($obj["phone"]);
        $data['user_pass'] = MD5(text($obj["pwd"]));
        $data['reg_time'] = time();
        $data['reg_ip'] = get_client_ip();
        $data['last_log_time'] = time();
        $data['last_log_ip'] = get_client_ip();
        $data['recommend_id'] = $obj["invitecode"]!=""?extra_decode($obj["invitecode"],16):0;
        $data['recommend_time'] = $obj["invitecode"]!=""?time():0;
        $newid = M('members')->add($data);
        if ($newid) {
            $updata['cell_phone'] = text($obj["phone"]);
            $b = M("member_info")->where("uid = {$newid}")->count('uid');
            if ($b == 1) {
                M("member_info")->where("uid={$newid}")->save($updata);
            } else {
                $updata['uid'] = $newid;
                $updata['cell_phone'] = text($obj["phone"]);
                $updata['email_status'] = 0;
                M("member_info")->add($updata);
            }

            $updata['phone_status'] =1;
            $updata['uid'] = $newid;
            M('members_status')->add($updata);
            $tken = $this->getToken($newid);

            setMemberStatus($newid, 'phone', 1, 10, '手机');

            $output = array('event'=>88,'msg'=>'注册成功','obj'=>array('token'=>$tken));
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'注册失败');
            exit(json_encode($output));
        }


    }

    /**
     * 发送手机验证码
     * 参数
     * phone 手机号
     */
    public function sendpcode(){

        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $phone = $obj["phone"];
        if(strlen($phone) == "11")
        {
            if(!preg_match("/^1[3|4|5|8][0-9]\\d{8}$/",$phone)){
                $output = array('event'=>0,'msg'=>'手机号格式错误');
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>1,'msg'=>"手机号长度错误".strlen($phone));
            exit(json_encode($output));
        }

        $count = M("members")->where("user_phone = {$phone}")->count();
        $countold = M("members_old")->where("phone = {$phone}")->count();
        if($count>0){
            $output = array('event'=>2,'msg'=>'手机号已被使用');
            exit(json_encode($output));
        }
        if($countold>0){
            $output = array('event'=>2,'msg'=>'手机号已被使用');
            exit(json_encode($output));
        }
        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $code = rand_string_reg(6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];
        if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
            $res = sendsms($phone, str_replace(array("#USERNAME#", "#CODE#"), array('', $code), $smsTxt['verify_phone']));
            if ($res) {
                $str = $this->getPToken($code,$phone);
                $output = array('event'=>88,'msg'=>'发送成功','obj'=>array("token"=>$str,"code"=>$code));
                exit(json_encode($output));

            } else{
                $output = array('event'=>90,'msg'=>'发送失败');
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>91,'msg'=>'未开启发送功能');
            exit(json_encode($output));
        }

    }

    /**
     * 登录
     * 参数
     * user_name
     * pwd
     */
    public function login(){
//        $object = json_decode(file_get_contents('php://input', true));
//        $obj = json_decode( json_encode( $object),true);
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        if (preg_match("/^1[34578]\d{9}$/", text($obj['user_name']))) {
            $data['user_phone'] = text($obj['user_name']);
            $phone = $data['user_phone'];
            $countold = M("members_old")->where("phone = {$phone} and status = 1")->count();
            if($countold>0){
                $output = array('event'=>90,'msg'=>'尊敬的老用户，请前往PC端进行账户升级');
                exit(json_encode($output));
            }
        } else {
            (false !== strpos($obj['user_name'], "@")) ? $data['user_email'] = text($obj['user_name']) : $data['user_name'] = text($obj['user_name']);
        }

        $vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where($data)->find();
        if($vo['is_ban']==1){
            $output = array('event'=>0,'msg'=>'用户已被锁定,请联系网站管理员');
            exit(json_encode($output));
        }

        $data['user_pass'] = MD5($obj['pwd']);

        $vm = M('members')->field('id,user_name')->where($data)->find();
        if(is_array($vm)){
            $up['uid'] = $vo['id'];
            $up['add_time'] = time();
            $up['ip'] = get_client_ip();
            M('member_login')->add($up);
            $tken = $this->getToken($vm['id']);
            $output = array('event'=>88,'msg'=>'登录成功','obj'=>array('token'=>$tken));
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'用户名密码错误');
            exit(json_encode($output));
        }

    }
    /**
     * memberinfo 用户信息
     * 参数
     * token
     */
    public function memberinfo(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }

        $pre = C('DB_PREFIX');
        $data['m.id'] = $res['uid'];
        $field="m.id,m.user_name,m.user_phone,m.user_leve,
                    ms.phone_status,m.pin_pass,ms.id_status,
                    ms.email_status,m.credits,m.integral,
                    mm.account_money,mm.back_money,mm.money_freeze,mm.money_collect";
        $vm = M('members m')
            ->join("{$pre}member_money mm on mm.uid = m.id")
            ->join("{$pre}members_status ms on ms.uid = m.id")
            ->join("{$pre}member_info mi on mi.uid = m.id")
            ->field($field)
            ->where($data)
            ->find();
//            $bank_count = M('member_banks')->where("uid= {$vm['id']}")->count();

        //判断用户是否实名、是否设置交易密码
        $ids = M('members_status')->getFieldByUid($res['uid'],'id_status');
        if($ids != 1) {$list['ids'] = 0;}
        else $list['ids'] = $ids;
        $pin_pass=M('members')->field('pin_pass')->find($res['uid']);
        if($pin_pass['pin_pass'] == null) $list['pin_pass'] = 0;
        else $list['pin_pass'] = 1;

        $list['real_name']=M('member_info')->getFieldByUid($res['uid'],"real_name");
        $list['user_name'] = $vm['user_name'];
        $list['header_img'] = "http://".$_SERVER['HTTP_HOST'].get_avatar($vm['id']);
        $list['user_phone'] = $vm['user_phone'];
        //可用 预约  冻结  在筹
        $list['balance'] = floatval($vm['account_money']+$vm['back_money']);
        $list['money_freeze'] = ($vm['money_freeze'] == null)?0.00:$vm['money_freeze'];
        $s_money['user_id']=$res['uid'];
        $s_money['status']=1;
        $surplus_money=M('crowd_auto')->where($s_money)->sum('surplus_money');
        $list['surplus_money'] = ($surplus_money == null)?0.00:$surplus_money;

        $bj_status['cc.status'] = array("in",array('2','3','4'));
        $bj_status['ci.user_id']=$res['uid'];
        $bj_crowds=M('crowd_investor ci')
            ->join("{$pre}crowd_info cc ON ci.crowd_id=cc.id")
            ->where($bj_status)
            ->sum('ci.capital');
        $list['capital'] = ($bj_crowds == null)?0.00:$bj_crowds;
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));

    }

    /**
     * 首页
     */
    public function app_index(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        //众筹预约的项目
        $list2 = M('crowd_info')->where('status = 1 AND is_use = 1 and start_time>'.time())->order('id desc')->find();

        $imgarray2 = array();
        $imgarray2[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        if($list2){
            $list_auto['id']=$list2['id'];
            $list_auto['crowd_name']=$list2['crowd_name'];
            $list_auto['crowd_money']=$list2['crowd_money'];
            $info_img=unserialize($list2['crowd_picture'])?unserialize($list2['crowd_picture']):$imgarray2;
            $list_auto['img'] = $info_img[0]['img'];
            $list_auto['auto_remain_time'] = $list2['start_time']-time();
            $list_auto['status']=1;

        }else{
            $list_auto=null;
        }
        //众筹项目
        $list3 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_time,full_time')->where('is_use = 1 and status<>6 and start_time<='.time())->order('id desc')->limit(4)->select();
        foreach($list3 as $key=>$v){
//            var_dump($v['start_time']);var_dump($v['id']);var_dump(time());
//            if($v['start_time']>time()){
//                unset($list3[$key]);
//            }
            $info_img=unserialize($list3[$key]['crowd_picture'])?unserialize($list3[$key]['crowd_picture']):$imgarray2;
            $list3[$key]['img']=$info_img[0]['img'];
            $list3[$key]['rate'] = round((($list3[$key]['has_crowd_money']/ $list3[$key]['crowd_money'])*100),2);
            //状态 7-预告 1-众筹中 2-出售中 3-投票 4-待回款 5-已完成  8-溢价回购 9-溢价回购完成
            $list3[$key]['status'] =($list3[$key]['start_time']>time())?7:$list3[$key]['status'];
            if($v['status']==5){
                $list_voting= M('crowd_voting')->where('crowd_id = '.$v['id'].' AND status = 3')->find();
                $back_rate=M('crowd_info')->field('back_rate')->find($v['id']);
                $sy_time=ceil(($v['back_time']-$v['full_time'])/(3600*24));
                $sy=$list_voting['vote_money']-$list_voting['crowd_money'];
                //众筹收益X分配比例X360
                //众筹金额X（回款时间-满标时间）
                $list3[$key]['voting']=round(($sy*$back_rate['back_rate']/100*360)/($list_voting['crowd_money']*$sy_time)*100,2);
            }
            $list3[$key]['count']=M('crowd_investor')->where('crowd_id='.$v['id'])->count('id');
            unset($list3[$key]['crowd_picture']);
        }
        $output = array('event'=>88,'msg'=>'发送成功','obj'=>array("list_auto"=>$list_auto,"list_info"=>$list3));
        exit(json_encode($output));
    }

    /**
     *众筹列表
     * param['page','pagesize','status']
     */
    public function borrowlist(){
        $pre = C('DB_PREFIX');
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?5:$obj['pagesize'];
        $map=array();
        //$obj['status']=10;
        if($obj['status'] == 10) $obj['status']="";
        $map['b.status'] = $obj['status']==""?array("neq",6):$obj['status'];
        //$map['b.status'] = 1;
        if($map['b.status']==8){
            $map['b.status']=array('in',array('8','9'));
        }
        if($map['b.status']==1){
            $map['b.start_time']=array('elt',time());
        }
        $map['b.is_use'] = 1;
        $page_start = $pagesize*($page-1);
        $page_end = $pagesize;
        $limit = "$page_start,$page_end";
        header("text/xml; charset = utf-8");
        $field = "b.id,b.crowd_name,b.crowd_money,b.start_time,b.crowd_picture,b.back_time,b.full_time,
            b.has_crowd_money,b.status";
        $count = M("crowd_info b")->where($map)->count();
        $list =  M("crowd_info b")->field($field)->where($map)->order("b.id DESC")->limit($limit)->select();
        //var_dump( M("crowd_info b")->getLastSql());
        $imgarray2 = array();
        $imgarray2[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        foreach($list as $key=>$v){
//            if($v['start_time']>time()){
//                unset($list[$key]);
//            }
            $info_img=unserialize($v['crowd_picture'])?unserialize($v['crowd_picture']):$imgarray2;
            $list[$key]['img']=$info_img[0]['img'];
            $list[$key]['rate'] = round((($v['has_crowd_money']/ $v['crowd_money'])*100),2);
            //状态 7-预告 1-众筹中 2-出售中 3-投票 4-待回款 5-已完成  8-溢价回购 9-溢价回购完成
            $list[$key]['status'] =($v['start_time']>time())?7:$v['status'];

            $list[$key]['count']=M('crowd_investor')->where('crowd_id='.$v['id'])->count('id');
            unset($list[$key]['crowd_picture']);
            if($v['status']==5){
                $list_voting= M('crowd_voting')->where('crowd_id = '.$list[$key]['id'].' AND status = 3')->find();
                $back_rate=M('crowd_info')->field('back_rate')->find($list[$key]['id']);
                $sy_time=ceil(($list[$key]['back_time']-$list[$key]['full_time'])/(3600*24));
                $sy=$list_voting['vote_money']-$list_voting['crowd_money'];

                //众筹收益X分配比例X360
                //众筹金额X（回款时间-满标时间）
                $list[$key]['voting']=round(($sy*$back_rate['back_rate']/100*360)/($list_voting['crowd_money']*$sy_time)*100,2);
            }

        }
        $currentPage = $page;
        $pageSize = $pagesize;
        $maxCount = $count;
        $maxPage = ceil($count/$pagesize);
        if(!is_array($list)){
            $output = array('event'=>0,'msg'=>'nothing');
            exit(json_encode($output));
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list,'currentPage'=>$currentPage,'pageSize'=>$pageSize,'maxCount'=>$maxCount,'maxPage'=>$maxPage);
        exit(json_encode($output));
    }

    /**
     *版本升级接口
     */
    public function app_version(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $list = M('app_version')->order('id DESC')->find();
        if(empty($list)){
            $list=null;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));

    }

    /**
     * 项目详情
     * param['id','uid']
     */
    public function crowd_info_detail(){
        $pre = C('DB_PREFIX');
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);

        if(empty($obj['id'])){
            $output = array('event'=>0,'msg'=>'项目不存在');
            exit(json_encode($output));
        }
        header("text/xml; charset = utf-8");
        $crowd_detail=M('crowd_info')->find($obj['id']);
        $imgarray2 = array();
        $imgarray2[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        if($crowd_detail){
            $info_img=unserialize($crowd_detail['crowd_picture'])?unserialize($crowd_detail['crowd_picture']):$imgarray2;
            unset($crowd_detail['crowd_picture']);
            $crowd_detail['img']=$info_img;
            //状态 7-预告 1-众筹中 2-出售中 3-投票 4-待回款 5-已完成  8-溢价回购 9-溢价回购完成
            $crowd_detail['status'] =($crowd_detail['start_time']>time())?7:$crowd_detail['status'];
            if(!empty($crowd_detail['car_dealer'])){
                $crowd_detail['car_dealer']=M('article')->field('title')->find($crowd_detail['car_dealer']);
            }
//            $crowd_investor_list=M('crowd_investor ci')->field('m.user_name,ci.capital')
//                ->join("{$pre}members m on ci.user_id=m.id")
//                ->where('ci.crowd_id='.$crowd_detail['id'])->select();
//            if(!is_array($crowd_investor_list)){
//                $crowd_investor_list=null;
//            }
            $crowd_detail['user_count']=M('crowd_investor')->where('crowd_id='.$crowd_detail['id'].' and status=1')->count('id');
            if($crowd_detail['status']==3) {
               $nuomi_crowd_voting = M('crowd_voting')->field('vote_money,ratio,failure,deadline')->where('status=1 and crowd_id='.$crowd_detail['id'])->order("id DESC")->find();
            }
            if(!is_array($nuomi_crowd_voting)){
                $nuomi_crowd_voting=null;
            }
        }

        if($res['uid']){
            $pay_bid_userlog = M('pay_bid_userlog')->field('id,pay_money,bid_money')->where('status=1 and uid='.$res['uid'])->select();
            //判断用户是否实名、是否设置交易密码
            $ids = M('members_status')->getFieldByUid($res['uid'],'id_status');
            if($ids != 1) {$ids = 0;}
            $pin_pass=M('members')->field('pin_pass')->find($res['uid']);
            if($pin_pass['pin_pass'] == null) $pin_pass['pin_pass'] = 0;
            else $pin_pass['pin_pass'] = 1;
        }
        if(!is_array($pay_bid_userlog)){
            $pay_bid_userlog=null;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>array("list"=>$crowd_detail,'list_tp'=>$nuomi_crowd_voting,'list_hb'=>$pay_bid_userlog,'sm'=>$ids,'pin_pass'=>$pin_pass['pin_pass']));
        exit(json_encode($output));

    }

    /**
     * 众筹记录
     * param['id','page','pagesize']
     *
     */
    public function crowd_detail_voting(){
        $pre = C('DB_PREFIX');
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?10:$obj['pagesize'];
        if(empty($obj['id'])){
            $output = array('event'=>0,'msg'=>'项目不存在');
            exit(json_encode($output));
        }
        $map=array();
        $map['b.crowd_id'] = $obj['id'];
        $page_start = $pagesize*($page-1);
        $page_end = $pagesize;
        $limit = "$page_start,$page_end";
        header("text/xml; charset = utf-8");
        $count = M("crowd_investor b")->where($map)->count();

        $list = M("crowd_investor b")->field('m.user_name,b.capital')
            ->join("{$pre}members m ON m.id=b.user_id")
            ->where($map)->order("b.id DESC")->limit($limit)->select();

        $currentPage = $page;
        $pageSize = $pagesize;
        $maxCount = $count;
        $maxPage = ceil($count/$pagesize);

        if(!is_array($list)){
            $list=null;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list,'currentPage'=>$currentPage,'pageSize'=>$pageSize,'maxCount'=>$maxCount,'maxPage'=>$maxPage);
        exit(json_encode($output));
    }

    /**
     * 账户总览
     *
     */

    public function membermoney(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }

        $uid = $res["uid"];
        $all_money = M("member_moneylog")->where("uid = {$uid}
        and type in (100,241,49,42,41,40,34,32,20,13)")->sum("affect_money");
        $list['shouyi'] = $all_money==""?0:floatval($all_money); //累计收益
        $in_money = M("borrow_investor")->where("investor_uid = {$uid} and pay_status = 1 and status in (1,4)")
            ->sum("investor_capital");
        $list['in_money'] = $in_money==""?0:floatval($in_money);//在投金额
        $invest_all = M("borrow_investor")->where("investor_uid = {$uid} and pay_status = 1 and status in (1,4,5,6,7)")
            ->sum("investor_capital");
        $list['invest_all'] = $invest_all==""?0:$invest_all;//累计投资
        $has_shouyi = M("investor_detail")
            ->where("investor_uid = {$uid} and repayment_time = 0 and substitute_time = 0 and status <> 0")
            ->sum("interest-interest_fee");
        $list['has_shouyi'] = $has_shouyi==""?0:floatval($has_shouyi);//预期收益
        $money = M("member_moeny")->where("uid = {$uid}")
            ->sum("account_money+back_money+money_freeze+money_collect");
        $invest = M("borrow_investor")->where("investor_uid = {$uid} and pay_status = 1 and status = 0")
            ->sum("investor_capital");
        $list['all_money'] = ($money+$invest)==""?0:floatval($money+$invest);//总资产
        $account_money = M("member_money")->getFieldByUid($uid,"account_money");
        $back_money = M("member_money")->getFieldByUid($uid,"back_money");
        $u = $account_money+$back_money;
        $freeze_money = M("member_money")->getFieldByUid($uid,"money_freeze");
        $list['freeze_money'] = $freeze_money==""?0:floatval($freeze_money);//冻结
        $list["account_money"] = $u==""?0:floatval($u);//可用
        $list["jiangli"] = 0;


        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));


    }

    /**
     * 身份认证信息
     */

    public function realinfo(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }

        $uid = $res['uid'];
        $id_status = M("members_status")->getFieldByUid($uid,"id_status");
        if($id_status!=1){
            $output = array('event'=>1,'msg'=>'您尚未完成实名认证');
            exit(json_encode($output));
        }

        $list = M("member_info")->field("real_name,idcard")->where("uid = {$uid}")->find();

        $arr["real_name"] = hidecard($list["real_name"],4);
        $arr["idcard"] = hidecard($list["idcard"],5);
        $output = array('event'=>88,'msg'=>'success','obj'=>$arr);
        exit(json_encode($output));
    }

    /**
     * 实名认证
     * 参数
     * token
     * realname
     * cardno
     */
    public function nameverify(){

        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }

        $realname = trim($obj["realname"]);
        $cardno = $obj["cardno"];
        $uid = $res['uid'];
        if (empty($realname) || empty($cardno)){
            $output = array('event'=>1,'msg'=>'数据不能为空');
            exit(json_encode($output));
        }
        $xuid = M('member_info')->getFieldByIdcard($cardno, 'uid');
        if($xuid>0 && $xuid != $uid){
            $output = array('event'=>2,'msg'=>'身份证号被使用');
            exit(json_encode($output));
        }
        if(strlen($cardno)!=15&&strlen($cardno)!=18){
            $output = array('event'=>3,'msg'=>'身份证号长度错误');
            exit(json_encode($output));
        }
        $b = M('name_apply')->where("uid = {$uid}")->count('uid');
        $data['real_name'] = text($realname);
        $data['idcard'] = text($cardno);
        $data['up_time'] = time();
        $data1['idcard'] = text($cardno);
        $data1['up_time'] = time();
        $data1['uid'] = $uid;
        $data1['status'] = 0;
        if ($b == 1) {
            M('name_apply')->where("uid ={$uid}")->save($data1);
        } else {
            M('name_apply')->add($data1);
        }
        $id5config = FS("Dynamic/id5");
        if ($id5config['enable'] == 0) {
            $c = M('member_info')->where("uid = {$uid}")->count('uid');
            if ($c == 1) {
                $newid = M('member_info')->where("uid = {$uid}")->save($data);
            } else {
                $data['uid'] = $uid;
                $newid = M('member_info')->add($data);
            }

            if ($newid) {
                $ms = M('members_status')->where("uid={$uid}")->setField('id_status', 3);
                if ($ms == 1) {
                    $output = array('event'=>87,'msg'=>'身份证号提交成功等待审核');
                    exit(json_encode($output));
                } else {
                    $dt['uid'] = $uid;
                    $dt['id_status'] = 3;
                    M('members_status')->add($dt);
                }
                $output = array('event'=>87,'msg'=>'身份证号提交成功等待审核');
                exit(json_encode($output));
            } else{
                $output = array('event'=>5,'msg'=>'身份证号保存失败');
                exit(json_encode($output));
            }
        }else {
            $config['query_url'] = "http://121.40.136.150:8080/IdInDataAu/api/authenInfoApi.htm"; //请求地址
            $config['user_id'] = $id5config['ID5ID']; //商户ID
            $config['md5_key'] = $id5config['md5_key']; //MD5密钥
            $config['des_key'] = $id5config['des_key']; //DES密钥

            require C("APP_ROOT")."Lib/ID5/sendIdCardAuthen.php";
            $idcard = new sendIdCardAuthen($config);
            $idcard->set($realname, $cardno);
            $id5_status=$idcard->checkOnline();
            if($id5_status==3){
                $c = M('member_info')->where("uid = {$uid}")->count('uid');
                if ($c == 1) {
                    $newid = M('member_info')->where("uid = {$uid}")->save($data);
                } else {
                    $data['uid'] = $uid;
                    $newid = M('member_info')->add($data);
                }
                if ($newid) {
                    $ms = M('members_status')->where("uid={$uid}")->setField('id_status', 1);
                    setMemberStatus($newid, 'id', 1, 10, '实名');
                    if ($ms == 1) {
                        $output = array('event'=>88,'msg'=>'审核成功');
                        exit(json_encode($output));
                    } else {
                        $dt['uid'] = $uid;
                        $dt['id_status'] = 1;
                        M('members_status')->add($dt);
                    }
                    $output = array('event'=>88,'msg'=>'审核成功');
                    exit(json_encode($output));
                } else{
                    $output = array('event'=>90,'msg'=>'审核失败');
                    exit(json_encode($output));
                }
            }else{
                $output = array('event'=>90,'msg'=>'审核失败');
                exit(json_encode($output));
            }

        }
    }

    /**
     * 设置交易密码
     * 参数：type=类型  pcode=验证码  verify_code=有效期  pinpassnew=新密码
     *
     */

    public function pinpass(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }

        $type = $obj["type"];
        $uid = $res['uid'];
        $pcode = $obj["pcode"];
        if(strlen($obj["pinpassnew"])<6){
            $output = array('event'=>1,'msg'=>'新密码长度太短');
            exit(json_encode($output));
        }
        $pinpass = md5(trim($obj["pinpass"]));
        $pinpassnew = md5(trim($obj["pinpassnew"]));

        $user_pass = M("members")->field("user_pass,pin_pass")->where("id = {$uid}")->find();
        if($user_pass['user_pass']==$pinpassnew){
            $output = array('event'=>3,'msg'=>'登录密码和支付密码相同');
            exit(json_encode($output));
        }
        if($user_pass['pin_pass']==$pinpass){
            $output = array('event'=>3,'msg'=>'新密码和原密码相同');
            exit(json_encode($output));
        }

        if($type ==1){//type ==1,修改支付密码

        }
        else if($type == 2){//通过输入原支付密码修改
            $info = M("members")->field("pin_pass")->where("id = {$uid}")->find();
            if($info["pin_pass"] !=$pinpass){
                $output = array('event'=>4,'msg'=>'原密码错误');
                exit(json_encode($output));
            }

        }else if($type==3){//使用手机验证码验证

            $res1 = $this->is_PToken($obj['verify_code']);
            if($res1["res"]==0){
                $output = array('event'=>7,'msg'=>'验证码已过期');
                exit(json_encode($output));
            }
            if ($res1['pcode'] != $pcode) {
                $output = array('event'=>5,'msg'=>'验证码错误');
                exit(json_encode($output));
            }

        }else{
            $output = array('event'=>6,'msg'=>'参数type错误');
            exit(json_encode($output));
        }
        $data["pin_pass"] = $pinpassnew;
        $res = M("members")->where("id = {$uid}")->save($data);
        if($res){
            $output = array('event'=>88,'msg'=>'支付密码修改成功');
            exit(json_encode($output));
        }
        $output = array('event'=>90,'msg'=>'支付密码修改失败');
        exit(json_encode($output));
    }

    /**
     * 修改登录密码
     * @params['token','pwd'=>新密码,'old_pwd'=>原密码]
     */
    public function changepwd(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        $pwd = md5(text($obj['pwd']));
        $old_pwd = md5(text($obj['old_pwd']));
        $p = M("members")->getFieldById($uid,"user_pass");
        if($old_pwd != $p){
            $output = array('event'=>4,'msg'=>'原始密码输入错误');
            exit(json_encode($output));
        }
        $datax=array();
        $datax['id'] = $uid;
        $datax['user_pass'] = $pwd;
        $result = M("members")->save($datax);
        if($result !== false){
            $output = array('event'=>88,'msg'=>'登录密码修改成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'登录密码修改失败');
            exit(json_encode($output));
        }
    }

    /**
     * 忘记密码
     * 参数  pwd 密码 verify_code 验证码相关信息
     */
    public function wangpwd(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
//        $res = $this->is_Token($obj["token"]);
//        if($res['res']==0){
//            $output = array('event'=>0,'msg'=>'请重新登录');
//            exit(json_encode($output));
//        }
//        $uid = $res['uid'];
        $pwd = md5(text($obj['pwd']));
//        $old_pwd = md5(text($obj['old_pwd']));
//        $p = M("members")->getFieldById($uid,"user_pass");
//        if($old_pwd != $p){
//            $output = array('event'=>4,'msg'=>'原始密码输入错误');
//            exit(json_encode($output));
//        }
        $res1 = $this->is_PToken($obj['verify_code']);
        if($res1["res"]==0){
            $output = array('event'=>1,'msg'=>'验证码已过期');
            exit(json_encode($output));
        }

        if ($res1['pcode'] != $obj['pcode']) {
            $output = array('event'=>2,'msg'=>'验证码错误');
            exit(json_encode($output));
        }
        //$res1['phone'];
        $uid=M('members')->field('id')->where('user_name='.$res1['phone'])->find();
        if(empty($uid)){
            $output = array('event'=>2,'msg'=>'该用户不存在！');
            exit(json_encode($output));
        }
        $datax=array();
        $datax['id'] = $uid['id'];
        $datax['user_pass'] = $pwd;
        $result = M("members")->save($datax);
        if($result !== false){
            $output = array('event'=>88,'msg'=>'登录密码修改成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'登录密码修改失败');
            exit(json_encode($output));
        }
    }

    /**
     * 获取验证码
     */
    public function sendcode1(){

        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        //$obj["phone"]='15666472280';
        if(empty($obj["phone"])){
            $output = array('event'=>9,'msg'=>'手机号不能为空');
            exit(json_encode($output));
        }
        $sendphone = $obj["phone"];

        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $code = rand_string_reg(6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];
        if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
            $res = sendsms($sendphone, str_replace(array("#CODE#"), array($code), $smsTxt['verify_phone']));
            if ($res) {
                $str = $this->getPToken($code,$sendphone);
                $output = array('event'=>88,'msg'=>'发送成功','obj'=>array("token"=>$str,"code"=>$code));
                exit(json_encode($output));
            } else{
                $output = array('event'=>90,'msg'=>'发送失败');
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>2,'msg'=>'未开启手机验证码功能');
            exit(json_encode($output));
        }

    }

    /**
     * 众筹投资
     * params['money','id','pin','hid','token']
     */

    public function binvestor(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];//用户id
        $money = $obj['money'];//投资金额
        $borrow_id = $obj['id'];//众筹id
        $c_id = $obj['hid'];//红包
        $pin = md5($obj['pin']);
        $user_money=M('member_money')->where('uid='.$uid)->sum('account_money +back_money ');
        if($user_money<$money){
            $output = array('event'=>1,'msg'=>'账户余额不足，请充值！');
            exit(json_encode($output));
        }
        $binfo = M("crowd_info")->where("id={$borrow_id}")->find();

        //用户投资总金额
        $data['user_id']=$uid;
        $data['status']=1;
        $data['crowd_id']=$borrow_id;
        $user_invest=M('crowd_investor')->field('sum(capital) as money')->where($data)->find();
        if($binfo['user_id'] == $uid){
            $output = array('event'=>1,'msg'=>'不能投自己的标');
            exit(json_encode($output));
        }
        if($money<100){
            $output = array('event'=>1,'msg'=>'投资金额最低为100元');
            exit(json_encode($output));
        }
        if($money<$binfo['min_money']){
            $output = array('event'=>1,'msg'=>'投资金额不能小于最小投资额度');
            exit(json_encode($output));
        }
        if($money>$binfo['max_money']){
            $output = array('event'=>1,'msg'=>'投资金额不能大于最大投资额度');
            exit(json_encode($output));
        }
        if($binfo['start_time']>time()){
            $output = array('event'=>1,'msg'=>'众筹还未开始');
            exit(json_encode($output));
        }
        if($binfo['status']<>1){
            $output = array('event'=>1,'msg'=>'众筹还未开始或已经结束');
            exit(json_encode($output));
        }
        if(($user_invest['money']+$money)>($binfo['crowd_money']*0.5)){
            $output = array('event'=>1,'msg'=>'个人最多投资额度为总金额的50%');
            exit(json_encode($output));
        }
        if(($binfo['crowd_money']-$binfo['has_crowd_money'])<$money){
            $output = array('event'=>1,'msg'=>'投资金额大于众筹剩余金额');
            exit(json_encode($output));
        }
        if($money%100!=0){
            $output = array('event'=>4,'msg'=>'投资金额需为100整数倍');
            exit(json_encode($output));
        }

        //remain_money = 可投   input_enter = 输入金额  min_money = 最小金额
        $remain_money=round(($binfo['crowd_money']- $binfo['has_crowd_money']),2);
        if((($remain_money-$money)<$binfo['min_money']) && (($remain_money-$money)!=0)){
            //$.jBox.alert('投资金额不正确，您投资后剩余金额将小于最小投资额，您现在只能一次性投满或者放弃投资!','提示');
            $output = array('event'=>4,'msg'=>'您投资后剩余金额将小于最小投资额，您现在只能一次性投满或者放弃投资!');
            exit(json_encode($output));
        }

        $money_info = getMinfo($uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
        $pin_pass = $money_info['pin_pass'];
        if($pin<>$pin_pass){
            $output = array('event'=>3,'msg'=>'支付密码错误');
            exit(json_encode($output));
        }

        $done = crowdInvest($uid,$borrow_id,$money,0,$c_id);
        if($done){
            $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$uid)->find();
            addInnerMsg($uid,"恭喜认筹成功","尊敬的".$userinfo['user_name']."，您好，您成功对".$borrow_id."号众筹投资".$money."元");//发送站内信
            SMStip("crowdinvest",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$borrow_id,$money));//发送短信
            $output = array('event'=>88,'msg'=>"投资成功");
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>"投资失败");
            exit(json_encode($output));
        }

    }

    /**
     * 投票
     * params['crowd_id'=>众筹id,'vote'=>成功/失败,]
     */
    public function vote(){

        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $crowd_id=$obj['crowd_id'];//众筹标ID
        $uid = $res['uid'];//用户id
        //计算出总共需要几个人投票，单人多次投资，算一个人
        $sql = "SELECT COUNT(DISTINCT user_id) as count FROM nuomi_crowd_investor WHERE crowd_id =".$crowd_id;
        $model = M();
        $arr =$model->query($sql);
        $need_vote_people = $arr[0]['count'];//总共需要投票的人数
        //$need_vote_people = $_POST['need_vote_people'];
        $crowd_vote = D('crowd_voting');

        $is_agree = $obj['vote'];//1表示赞成  2表示反对
        if($is_agree!=1 && $is_agree!=2){
            $output = array('event'=>2,'msg'=>'状态不正确！');
            exit(json_encode($output));
        }
        //$crowd_id = $_POST['crowd_id'];
        $crowd_status = M('crowd_info')->field('status')->where('id = '.$crowd_id)->find();//获取该众筹所处状态
        if($crowd_status['status']!=3){
            //不在投票中状态
            $output = array('event'=>2,'msg'=>'该众筹非投票中状态，不能投票！');
            exit(json_encode($output));
        }
        //根据众筹ID 查出投票最新的一次投票
        $vote_id = M('crowd_voting')->where('crowd_id = '.$crowd_id)->order('id desc')->limit(1)->find();//查出最新的一次投票，未经测试
        if(!$vote_id){
            $output = array('event'=>2,'msg'=>'该众筹还未发起投票，不能投票！');
            exit(json_encode($output));
        }
        if($vote_id['status'] != 1){
            $output = array('event'=>2,'msg'=>'该众筹投票已经结束！');
            exit(json_encode($output));
        }
        //查一下该用户是否投资过该众筹，是否允许可以投票
        $user_id = $uid;//当前用户ID
        $is_can_vote = M('crowd_investor')->where('crowd_id = '.$crowd_id." AND user_id = ".$user_id)->find();
        if(!$is_can_vote){
            $output = array('event'=>2,'msg'=>'您未参与该众筹，不能投票！');
            exit(json_encode($output));
        }
        //算出投资所占比重
        $vote_ratio = M('crowd_investor')->where('crowd_id = '.$crowd_id." AND user_id = ".$user_id)->sum("ratio");
        //判断该用户是否已经投过票
        $is_has_vote = M('crowd_vote_detail')->where('vote_id = '.$vote_id['id']." AND user_id = ".$user_id)->find();
        if($is_has_vote){
            $is_agree_str = $is_has_vote['is_agree']==1?"赞成":"反对";
            $output = array('event'=>2,'msg'=>"您已经投过".$is_agree_str."票,不能重复投票！");
            exit(json_encode($output));
        }
        $crowd_vote->startTrans();
        if($is_agree == 1){
            //赞成票
            $vote_data['vote_id']=$vote_id['id'];
            $vote_data['user_id']=$user_id;
            $vote_data['ratio']=$vote_ratio;
            $vote_data['is_agree']=1;
            $vote_data['add_time']=time();
            $vote_data['add_ip']=get_client_ip();
            $vote_detail = M('crowd_vote_detail')->add($vote_data);
            if($vote_detail){
                $voting_ratio = M('crowd_voting')->where('id = '.$vote_id['id'])->find();
                $add_vote = round(($voting_ratio['ratio'] + $vote_ratio),4);
                $has_agree_people = $voting_ratio['has_vote_people']+1;
                $data['ratio'] = $add_vote;
                $data['has_vote_people'] = $has_agree_people;
                $voting = M('crowd_voting')->where('id = '.$vote_id['id'])->save($data);
                //dump(M('crowd_voting')->getLastSql());
            }
        }else{
            $vote_data['vote_id']=$vote_id['id'];
            $vote_data['user_id']=$user_id;
            $vote_data['ratio']=$vote_ratio;
            $vote_data['is_agree']=0;
            $vote_data['add_time']=time();
            $vote_data['add_ip']=get_client_ip();
            $vote_detail = M('crowd_vote_detail')->add($vote_data);
            if($vote_detail){
                $voting_ratio = M('crowd_voting')->where('id = '.$vote_id['id'])->find();
                $not_agree = $voting_ratio['not_agree_people']+1;
                $add_vote = round(($voting_ratio['failure'] + $vote_ratio),4);
                $has_agree_people = $voting_ratio['has_vote_people']+1;
                $voting = M('crowd_voting')->where('id = '.$vote_id['id'])->save(array('not_agree_people'=>$not_agree,'has_vote_people'=>$has_agree_people,"failure"=>$add_vote));
            }
        }
        $voting_arr = M('crowd_voting')->where('id = '.$vote_id['id'])->find();
        $has_vote_people = $voting_arr['has_vote_people'];//已经投票的总人数

        if($has_vote_people == $need_vote_people){
            $set_has_vote = false;
            //所有人都投票了，投票结束
            $ratio =  $voting_arr['ratio'];
            $not_agree_people =  $voting_arr['not_agree_people'];
            if($ratio > 0.5){
                //投赞成票大于50%，则通过
                $set_vote_status =  M('crowd_voting')->where('id = '.$vote_id['id'])->save(array('status'=>3));
                if($set_vote_status){
                    $set_crowd_status = M('crowd_info')->where('id = '.$crowd_id)->save(array('status'=>4));
                    if($set_crowd_status) $set_has_vote = true;
                    //给每个投资用户发送短信
                    $sql1="SELECT DISTINCT user_id FROM nuomi_crowd_investor WHERE crowd_id =".$crowd_id;
                    $model1=M();
                    $arr1 = $model1->query($sql1);
                    foreach($arr1 as $key=>$v){
                        $user_id = $arr1[$key]['user_id'];
                        $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$user_id)->find();
                        addInnerMsg($user_id,"您投资的众筹投票通过！","尊敬的".$userinfo['user_name']."，您好，您投资的".$crowd_id."号众筹众筹投票成功！投票金额".$vote_id['vote_money'].",该众筹正在回款中！");//发送站内信
                        SMStip("crowdvotesucc",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$crowd_id,$vote_id['vote_money']));//发送短信
                    }
                }
            }elseif($ratio == 0.5){
                $half_people = round(($need_vote_people/2),2);
                if($not_agree_people > $half_people){
                    //各占50% ，不同意人数大于一般人数时，则该投票失败,要做的是将该次投票状态设置为2，投票失败，
                    //并且将还众筹状态返回到2--出售中状态
                    $set_vote_status =  M('crowd_voting')->where('id = '.$vote_id['id'])->save(array('status'=>2));
                    if($set_vote_status){
                        $set_crowd_status = M('crowd_info')->where('id = '.$crowd_id)->save(array('status'=>2));
                        if($set_crowd_status) $set_has_vote = true;
                        $sql1="SELECT DISTINCT user_id FROM nuomi_crowd_investor WHERE crowd_id =".$crowd_id;
                        $model1=M();
                        $arr1 = $model1->query($sql1);
                        foreach($arr1 as $key=>$v){
                            $user_id = $arr1[$key]['user_id'];
                            $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$user_id)->find();
                            addInnerMsg($user_id,"您投资的众筹投票未成功通过！","尊敬的".$userinfo['user_name']."，您好，您投资的".$crowd_id."号众筹众筹投票失败！投票金额".$vote_id['vote_money']);//发送站内信
                            SMStip("crowdvotefail",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$crowd_id,$vote_id['vote_money']));//发送短信
                        }
                    }
                }else{
                    //反之成功
                    //成功要做的是将该次投票状态设置为3，投票成功,并且将还众筹状态返回到4--待回款状态
                    $set_vote_status =  M('crowd_voting')->where('id = '.$vote_id['id'])->save(array('status'=>3));
                    if($set_vote_status){
                        $set_crowd_status = M('crowd_info')->where('id = '.$crowd_id)->save(array('status'=>4));
                        if($set_crowd_status) $set_has_vote = true;
                        $sql1="SELECT DISTINCT user_id FROM nuomi_crowd_investor WHERE crowd_id =".$crowd_id;
                        $model1=M();
                        $arr1 = $model1->query($sql1);
                        foreach($arr1 as $key=>$v){
                            $user_id = $arr1[$key]['user_id'];
                            $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$user_id)->find();
                            addInnerMsg($user_id,"您投资的众筹投票通过！","尊敬的".$userinfo['user_name']."，您好，您投资的".$crowd_id."号众筹众筹投票成功！投票金额".$vote_id['vote_money'].",该众筹正在回款中！");//发送站内信
                            SMStip("crowdvotesucc",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$crowd_id,$vote_id['vote_money']));//发送短信
                        }
                    }
                }
            }else{
                //投票失败
                $set_vote_status =  M('crowd_voting')->where('id = '.$vote_id['id'])->save(array('status'=>2));
                if($set_vote_status){
                    $set_crowd_status = M('crowd_info')->where('id = '.$crowd_id)->save(array('status'=>2));
                    if($set_crowd_status) $set_has_vote = true;
                    $sql1="SELECT DISTINCT user_id FROM nuomi_crowd_investor WHERE crowd_id =".$crowd_id;
                    $model1=M();
                    $arr1 = $model1->query($sql1);
                    foreach($arr1 as $key=>$v){
                        $user_id = $arr1[$key]['user_id'];
                        $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$user_id)->find();
                        addInnerMsg($user_id,"您投资的众筹投票未成功通过！","尊敬的".$userinfo['user_name']."，您好，您投资的".$crowd_id."号众筹众筹投票失败！投票金额".$vote_id['vote_money']);//发送站内信
                        SMStip("crowdvotefail",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$crowd_id,$vote_id['vote_money']));//发送短信
                    }
                }
            }
        }else{
            $set_has_vote =true;
        }
        if($vote_detail && $voting && $set_has_vote){
            $crowd_vote->commit();
            $sql='select vote_money,ratio,failure,status from nuomi_crowd_voting where crowd_id='.$crowd_id.' and status in(1,3) limit 1';
            $moderl11=M();
            $arr11=$moderl11->query($sql);
            $list['vote_money']=$arr11[0]['vote_money'];
            $list['ratio']=$arr11[0]['ratio'];
            $list['failure']=$arr11[0]['failure'];
            $list['status']=$arr11[0]['status'];

            $output = array('event'=>88,'msg'=>'投票成功！','obj'=>$list);
            exit(json_encode($output));
        }else{
            $crowd_vote->rollback();
            $output = array('event'=>2,'msg'=>'投票失败！');
            exit(json_encode($output));
        }
    }

    /**
     * 众筹预约
     * params['money','user_money','remain_money','pin','deadline','token']
     */
    public function auto_money(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $pin = md5($obj['pin']);//获取过来的支付密码
        $money = intval($obj['money']);//获取预约金额
        if($money>floatval($obj['user_money'])){
            $output = array('event'=>3,'msg'=>'预约金额大于可用余额，请重试！');
            exit(json_encode($output));
        }
        if($money>floatval($obj['remain_money'])){
            $output = array('event'=>3,'msg'=>'预约金额大于可用额度，请重试！');
            exit(json_encode($output));
        }
        $vm = getMinfo($res['uid'],'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
        $amoney = $vm['account_money']+$vm['back_money'];
        $pin_pass = $vm['pin_pass'];//支付密码
        $amoney = floatval($amoney);//用户总资金
        //$deadline = strtotime($obj['deadline']."23:59:59");//预约截至时间
        $deadline = $obj['deadline'];
        $text['user_id']=$res['uid'];
        $text['status']=1;
        $c_id=M('crowd_auto')->where($text)->field('sum(surplus_money) as user_money')->find();
        $text = M('crowd_config')->field('text')->find('7');
        $text['text']=$text['text']*10000;
        $remain_money = $text['text']-$c_id['user_money'];
        if($pin<>$pin_pass){
            $output = array('event'=>3,'msg'=>'支付密码错误，请重试!');
            exit(json_encode($output));
        }
        if($money%1000 !=0){
            $output = array('event'=>3,'msg'=>'预约金额必须为1000的整数倍，请重试!');
            exit(json_encode($output));
        }
        if($money <=0 ){
            $output = array('event'=>3,'msg'=>'预约金额异常，请重试!');
            exit(json_encode($output));
        }
        if($money > $remain_money){
            $output = array('event'=>3,'msg'=>'预约金额大于可用预约额度，请重试!');
            exit(json_encode($output));
        }
        if($deadline < time()){
            $output = array('event'=>3,'msg'=>'预约截至时间不能小于当前时间，请重试!');
            exit(json_encode($output));
        }
        if($money > $amoney){
            $output = array('event'=>3,'msg'=>'可用预约不足，请充值!');
            exit(json_encode($output));
        }


        $crowd_auto=M('crowd_auto');
        $crowd_auto->startTrans();
        $data['user_id'] = $res['uid'];
        $data['auto_money'] = $money;
        $data['employ_money'] = 0;
        $data['surplus_money'] = $money;
        $data['add_time'] = time();
        $data['status'] = 1;
        $data['deadline'] = $deadline;
        $id = M('crowd_auto')->add($data);
        $member_money=M('member_money')->field('account_money,money_collect,money_freeze,back_money')->find($res['uid']);
        if($member_money['account_money']>=$money){
            $user_money['account_money']=$member_money['account_money']-$money;
            $user_money['back_money']=$member_money['back_money'];
        }
        elseif($member_money['back_money']>=$money){
            $user_money['back_money']=$member_money['back_money']-$money;
            $user_money['account_money']=$member_money['account_money'];
        }
        else{
            $residue_money=$money-$member_money['account_money'];
            if($residue_money>=0){
                $user_money['account_money']=0;
            }
            $user_money['back_money']=$member_money['back_money']-$residue_money;
        }
        $user_money['money_freeze']=$member_money['money_freeze']+$money;
        $money_id=M('member_money')->where('uid='.$res['uid'])->save($user_money);
        ////////////�ʽ��¼/////////////////
        $money_log['uid']=$res['uid'];//
        $money_log['affect_money']=-$money;//
        $money_log['account_money']=$user_money['account_money'];
        $money_log['back_money']=$user_money['back_money'];
        $money_log['freeze_money']=$user_money['money_freeze'];
        $money_log['type']=56;//������
        $money_log['collect_money']=$member_money['money_collect'];
        $money_log['info']="预约成功，冻结预约金".$money."元";
        $money_log['add_time']=time();
        $money_log['add_ip']=get_client_ip();
        $money_log['target_uid']=0;//
        $money_log['target_uname']="@网站管理员@";//
        $moneylog_id=M('member_moneylog')->add($money_log);
        if($id&&$money_id&&$moneylog_id){
            $crowd_auto->commit();
            $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$res['uid'])->find();
            SMStip("crowdauto",$userinfo['user_phone'],array("#USERANEM#","#MONEY#"),array($userinfo['user_name'],$_POST['amount']));//发送短信
            $output = array('event'=>88,'msg'=>"预约成功");
            exit(json_encode($output));
        }else{
            $crowd_auto->rollback();
            $output = array('event'=>99,'msg'=>"预约失败");
            exit(json_encode($output));
        }

    }

    /**
     * 预约取消
     *
     */
    public function auto_money_cancel(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        $auto_id = $obj['id'];//预约的ID
        $auto = M('crowd_auto')->where('id = '.$auto_id)->find();
        if(empty($auto)){
            $output = array('event'=>1,'msg'=>'该预约存在错误，请重新录入!');
            exit(json_encode($output));
        }
        $crowd_auto=M('crowd_auto');
        $crowd_auto->startTrans();
        $upcrowdauto = M('crowd_auto')->where('id = '.$auto_id)->save(array('status'=>2));//取消该预约
        $accountMoney_investor=M('member_money')->field(true)->where('uid = '.$uid)->find();
        $datamoney_x['uid'] =$uid;//用户id
        $datamoney_x['type'] = 57;
        $datamoney_x['affect_money'] = $auto['surplus_money'];//变动资金
        $datamoney_x['account_money'] = ($accountMoney_investor['account_money'] + $datamoney_x['affect_money']);//取消预约返回充值资金池
        $datamoney_x['collect_money'] = $accountMoney_investor['money_collect'];
        $datamoney_x['freeze_money'] = $accountMoney_investor['money_freeze'] - $datamoney_x['affect_money'];
        $datamoney_x['back_money'] = $accountMoney_investor['back_money'];

        //会员帐户
        $mmoney_x['money_freeze']=$datamoney_x['freeze_money'];
        $mmoney_x['money_collect']=$datamoney_x['collect_money'];
        $mmoney_x['account_money']=$datamoney_x['account_money'];
        $mmoney_x['back_money']=$datamoney_x['back_money'];

        $_xstr = "手动取消";
        $datamoney_x['info'] = "第{$auto_id}号众筹预约".$_xstr."，返回剩余额度资金";
        $datamoney_x['add_time'] = time();
        $datamoney_x['add_ip'] = get_client_ip();
        $datamoney_x['target_uid'] = 0;
        $datamoney_x['target_uname'] = "@网站管理员@";
        $moneynewid_x = M('member_moneylog')->add($datamoney_x);
        if($moneynewid_x) $bxid = M('member_money')->where("uid={$datamoney_x['uid']}")->save($mmoney_x);
        if($upcrowdauto && $moneynewid_x && $bxid){
            $crowd_auto->commit();
            $output = array('event'=>88,'msg'=>'success');
            exit(json_encode($output));
        }else{
            $crowd_auto->rollback();
            $output = array('event'=>88,'msg'=>'预约取消失败！');
            exit(json_encode($output));
        }
    }

    /**
     * 预约设置
     * params['money','pin','deadline','token']
     */
    public function auto_list(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $list['user_money']=M('member_money')->where('uid='.$res['uid'])->sum('account_money + back_money');//可用
        $text['user_id']=$res['uid'];
        $text['status']=1;
        $c_id=M('crowd_auto')->where($text)->field('sum(surplus_money) as user_money')->find();
        $text = M('crowd_config')->field('text')->find('7');
        $text['text']=$text['text']*10000;
        $list['remain_money'] = $text['text']-$c_id['user_money'];

        $list['all_count'] = M('crowd_auto')->count("id");
        $list['now_count'] = M('crowd_auto')->where('status = 1')->count('id');//当前预约中

        $list['now_people'] = M('crowd_auto')->where("status = 1")->count('DISTINCT user_id');
        $list['all_money'] = M('crowd_auto')->sum("auto_money");//预约总金额，包括使用和未使用的
        $list['now_money'] = M('crowd_auto')->where('status = 1')->sum("surplus_money");//前面排队资金
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));
    }

    /**
     * 预约列表
     * params['type','page','pagesize']
     */
    public function auto_user_list(){
        $pre = C('DB_PREFIX');
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?10:$obj['pagesize'];
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $map=array();
        $map['b.user_id'] = $res['uid'];
        $map['status'] = $obj['type'];
        $page_start = $pagesize*($page-1);
        $page_end = $pagesize;
        $limit = "$page_start,$page_end";
        header("text/xml; charset = utf-8");
        $count = M("crowd_auto b")->where($map)->count();

        $list = M("crowd_auto b")->field('id,auto_money,employ_money,surplus_money,deadline,add_time')->where($map)->order("b.id DESC")->limit($limit)->select();
        foreach($list as $key=>$val){
            $row_number=M('crowd_auto')->where('status = 1 and add_time<'.$val['add_time'])->count('id');
            $list[$key]['row_number']=$row_number+1;
        }

        $currentPage = $page;
        $pageSize = $pagesize;
        $maxCount = $count;
        $maxPage = ceil($count/$pagesize);

        if(!is_array($list)){
            $list=null;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list,'currentPage'=>$currentPage,'pageSize'=>$pageSize,'maxCount'=>$maxCount,'maxPage'=>$maxPage);
        exit(json_encode($output));
    }

    /**
     * 众筹红包
     */
    public function crowd_hb(){
        $pre = C('DB_PREFIX');
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?8:$obj['pagesize'];
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $map=array();
        $map['uid'] = $res['uid'];
        $page_start = $pagesize*($page-1);
        $page_end = $pagesize;
        $limit = "$page_start,$page_end";
        header("text/xml; charset = utf-8");
        $count = M("pay_bid_userlog")->where($map)->count();

        $list = M("pay_bid_userlog")->where($map)->order("id DESC")->limit($limit)->select();

        $currentPage = $page;
        $pageSize = $pagesize;
        $maxCount = $count;
        $maxPage = ceil($count/$pagesize);

        if(!is_array($list)){
            $list=null;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list,'currentPage'=>$currentPage,'pageSize'=>$pageSize,'maxCount'=>$maxCount,'maxPage'=>$maxPage);
        exit(json_encode($output));
    }

    /**
     * 红包使用记录
     */
    public function crowd_hb_list(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?10:$obj['pagesize'];
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $map=array();
        $map['uid'] = $res['uid'];
        $page_start = $pagesize*($page-1);
        $page_end = $pagesize;
        $limit = "$page_start,$page_end";
        header("text/xml; charset = utf-8");
        $count = M("crowd_user_log")->where($map)->count();

        $list = M("crowd_user_log")->where($map)->order("id DESC")->limit($limit)->select();

        $currentPage = $page;
        $pageSize = $pagesize;
        $maxCount = $count;
        $maxPage = ceil($count/$pagesize);

        if(!is_array($list)){
            $list=null;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list,'currentPage'=>$currentPage,'pageSize'=>$pageSize,'maxCount'=>$maxCount,'maxPage'=>$maxPage);
        exit(json_encode($output));
    }

    /**
     * 资金记录
     */
    public function moneyrecord_list(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?10:$obj['pagesize'];
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $map=array();
        $map['uid'] = $res['uid'];
        $page_start = $pagesize*($page-1);
        $page_end = $pagesize;
        $limit = "$page_start,$page_end";
        header("text/xml; charset = utf-8");
        $count = M("member_moneylog")->where($map)->count();

        $list = M("member_moneylog")->field('type,affect_money,account_money,back_money,add_time,freeze_money')->where($map)->order("id DESC")->limit($limit)->select();
        $logtype = C('MONEY_LOG');
        foreach($list as $k=>$v){
           $list[$k]['type']=$logtype[$v['type']];
        }
        
        $currentPage = $page;
        $pageSize = $pagesize;
        $maxCount = $count;
        $maxPage = ceil($count/$pagesize);

        if(!is_array($list)){
            $list=null;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list,'currentPage'=>$currentPage,'pageSize'=>$pageSize,'maxCount'=>$maxCount,'maxPage'=>$maxPage);
        exit(json_encode($output));
    }

    /**
     *个人信息
     */
    public function user_info(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $pre = C('DB_PREFIX');//$res['uid']=4;
        $member_info=M('members m')->field('m.user_name,mi.cell_phone,mi.real_name,mi.idcard')
            ->join("{$pre}member_info mi ON mi.uid=m.id")
            ->where('m.id='.$res['uid'])->find();
        $member_info['head']=get_avatar($res['uid']);
        $output = array('event'=>88,'msg'=>'success','obj'=>$member_info);
        exit(json_encode($output));
    }

    /**
     * 绑定银行卡
     * 参数
     * token
     * bank_name 银行代码
     * account 银行卡卡号
     * province 省
     * city 市
     * bank_branch 开户行
     */
    public function bindbank(){

        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        if(empty($obj['account']) || empty($obj['bank_name']) || empty($obj['bank_branch']) || empty($obj['province']) || empty($obj['city'])){
            $output = array('event'=>1,'msg'=>'输入的数据有误，请重新输入！');
            exit(json_encode($output));
        }

        if (strlen($obj['account'])<16) {
            $output = array('event'=>1,'msg'=>'卡号输入有误，请重新输入！');
            exit(json_encode($output));
        }

        $data['uid'] = $res['uid'];
        $data['bank_num'] = text($obj['account']);
        $data['bank_name'] = $obj['bank_name'];
        $data['bank_address'] = text($obj['bank_branch']);
        $data['bank_province'] = text($obj['province']);
        $data['bank_city'] = text($obj['city']);
        $data['add_ip'] = get_client_ip();
        $data['add_time'] = time();
        file_put_contents('type1.txt',$obj['type']);
        if(empty($obj['type'])){
            $nid = M('member_banks')->add($data);
            file_put_contents('member_banks.txt',M('member_banks')->getLastSql());
        }else{
            $nid = M('member_banks')->where('uid='.$data['uid'])->save($data);
            if(false !== $nid  || 0 !== $nid){
                $nid=true;
            }else{
                $nid=false;
            }
        }

        if($nid){
            $list['bank_name']=$obj['bank_name'];
            $list['account']=$obj['account'];
            $real_name=M('member_info')->field('real_name')->where('uid='.$res['uid'])->find();
            $list['user_name']=$real_name['real_name'];

            $output = array('event'=>88,'msg'=>'恭喜，您的银行卡更新成功！','obj'=>$list);
            exit(json_encode($output));
        }else{
            $output = array('event'=>0,'msg'=>'更新失败，请重试！');
            exit(json_encode($output));
        }

    }
    /**
     * 充值提现
     */
    public function paywithdraw(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $data['uid'] = $res['uid'];
        $data['withdraw_status'] = array('in',array('0','1'));
        //提现冻结
        $withdraw_money = M('member_withdraw ')->where($data)->sum('withdraw_money');
        //账户余额
        $money=M('member_money')->where('uid='.$res['uid'])->sum('account_money+back_money');

        $list['withdraw_money']=$withdraw_money;
        $list['money']=$money;
        $tqfee = explode("|",$this->glo['fee_tqtx']);

        $list['sx_0']=$tqfee[0];
        $list['sx_1']=$tqfee[1];
        $list['sx_2']=$tqfee[2];
        if(isset($list['sx_2'])){
            $back=M('member_money')->field('back_money')->where('uid='.$res['uid'])->find();
            $list['back_money']=$back['back_money'];
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));

    }

    /**
     * 修改用户头像
     */
    public function bankalter(){

    }

    /**
     * 银行卡信息
     */
    public function  bankinfo(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        //$res['uid'];
        $bank = M('member_banks')-> field('bank_num,bank_name,bank_province,bank_city,bank_address')->where('uid='.$res['uid'])->find();
        if(empty($bank['bank_num'])){
            $output = array('event'=>6,'msg'=>'未绑卡');
            exit(json_encode($output));
        }
        $list['bank_name']=$bank['bank_name'];
        $list['account']=$bank['bank_num'];
        $real_name=M('member_info')->field('real_name')->where('uid='.$res['uid'])->find();
        $list['user_name']=$real_name['real_name'];

//        $province = M("area")->field('id,name')->find($bank['bank_province']);
//        var_dump(M("area")->getLastSql());
//        $city = M("area")->field('id,name')->find($bank['bank_city']);
        $list['diqu']=text($bank['bank_province']).'-'.text($bank['bank_city']);
        $list['bank_address']=$bank['bank_address'];
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));
    }

    /**
     * 投资总表
     */
    public function investor_list(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        //认筹中  出售中   投票中   已完成   溢价回购   累计投资总额 crowd_info   crowd_investor
        $pre = C('DB_PREFIX');
        $crowd_list=array();
        for($i=1;$i<=9;$i++){
            if( $i==6 || $i==7) continue;
            $crowd_list[$i]=M('crowd_investor cr')->field('sum(cr.capital) as capital ,count(cr.id) as id')
                ->join("{$pre}crowd_info ci ON ci.id=cr.crowd_id")
                ->where('cr.user_id='.$res['uid'].' and ci.status='.$i)->find();
        }
        $crowd_list[0]=M('crowd_investor')->where('user_id='.$res['uid'].' and status=1')->sum('capital');
        $output = array('event'=>88,'msg'=>'success','obj'=>$crowd_list);
        exit(json_encode($output));

    }

    /**
     * 通过原密码修改密码
     * 参数
     * token
     * oldpwd
     * newpwd
     * type['login','pin']
     */
    public function changepwd_1(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }

        $uid = $res['uid'];

        $pininfo = M("members")->field("user_pass,pin_pass")->where("id = {$uid}")->find();

        $pwd = $pininfo["user_pass"];

        $pin = $pininfo["pin_pass"]==""?$pininfo["user_pass"]:$pininfo["pin_pass"];
        if($obj["type"]=="login"){
            if($pwd!=md5($obj["oldpwd"])){
                $output = array('event'=>1,'msg'=>'原密码错误');
                exit(json_encode($output));
            }else{
                if(md5($obj["newpwd"])==$pininfo["pin_pass"]){
                    $output = array('event'=>3,'msg'=>'新密码不能和支付密码相同');
                    exit(json_encode($output));
                }
                if(md5($obj["newpwd"])==$pininfo["user_pass"]){
                    $output = array('event'=>4,'msg'=>'新密码不能和原密码相同');
                    exit(json_encode($output));
                }
                $data["user_pass"] = md5($obj["newpwd"]);
                $nid = M("members")->where("id = {$uid}")->save($data);
                if($nid){
                    $output = array('event'=>88,'msg'=>'修改成功');
                    exit(json_encode($output));
                }else{
                    $output = array('event'=>90,'msg'=>'修改失败');
                    exit(json_encode($output));
                }
            }


        }elseif($obj["type"]=="pin"){

            if($pin!=md5($obj["oldpwd"])){
                $output = array('event'=>1,'msg'=>'原密码错误');
                exit(json_encode($output));
            }elseif($pin==md5($obj["newpwd"])){
                $output = array('event'=>2,'msg'=>'不能与原密码相同');
                exit(json_encode($output));
            }else{
                $data["pin_pass"] = md5($obj["newpwd"]);
                $nid = M("members")->where("id = {$uid}")->save($data);
                if($nid){
                    $output = array('event'=>88,'msg'=>'修改成功');
                    exit(json_encode($output));
                }else{
                    $output = array('event'=>90,'msg'=>'修改失败');
                    exit(json_encode($output));
                }
            }
        }else{
            $output = array('event'=>91,'msg'=>'参数type错误');
            exit(json_encode($output));
        }

    }

    /**
     * 更改手机认证
     * tip1:原手机发送验证码sendcode
     */

    /**
     * 更改手机认证
     * tip2:新手机发送验证码sendcode
     * type=2 忘记密码
     */
    public function sendcode(){

        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
            if($res['res']==0){
                $output = array('event'=>0,'msg'=>'请重新登录');
                exit(json_encode($output));
            }
        $uid = $res['uid'];
        $phone = M('members')->getFieldById($uid, 'user_phone');
        $uname = M('members')->getFieldById($uid, 'user_name');
        $sendphone = $obj["phone"]==""?$phone:$obj["phone"];


        if($obj['type'] == 1){
            $count = M("members")->where("user_phone = {$sendphone}")->count();
            if($obj["phone"]!=""&&$count!=0){
                $output = array('event'=>1,'msg'=>'手机号已被使用');
                exit(json_encode($output));
            }
        }

        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $code = rand_string_reg(6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];
        if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
            $res = sendsms($sendphone, str_replace(array("#UserName#", "#CODE#"), array($uname, $code), $smsTxt['verify_phone']));
            if ($res) {
                $str = $this->getPToken($code,$sendphone);
                $output = array('event'=>88,'msg'=>'发送成功','obj'=>array("token"=>$str,"code"=>$code));
                exit(json_encode($output));
            } else{
                $output = array('event'=>90,'msg'=>'发送失败');
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>2,'msg'=>'未开启手机验证码功能');
            exit(json_encode($output));
        }

    }

    /**
     * 修改认证手机号为新手机号，同时判断原用户名手机号是否一致，一致则修改用户名为新的手机号（修改认证手机第五步）
     * @params['token','phone','verify_code','pcode']
     */
    public function setnewphone(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $pcode = $obj['pcode'];
        $phone = $obj['phone'];
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        $info = M("members")->field("user_name,user_phone")->where("id = {$uid}")->find();
        if($info['user_phone']==$obj['phone']){
            $output = array('event'=>3,'msg'=>'新手机号与原手机号一致');
            exit(json_encode($output));
        }
        $pcount = M("members")->where("id <> {$uid} and user_phone = {$phone}")->count();
        if($pcount!=0){
            $output = array('event'=>4,'msg'=>'新手机号已被使用');
            exit(json_encode($output));
        }
        $res1 = $this->is_PToken($obj['verify_code']);
        if($res1["res"]==0){
            $output = array('event'=>1,'msg'=>'验证码已过期');
            exit(json_encode($output));
        }
        if ($res1['pcode'] != $pcode||$res1['phone'] != $phone) {
            $output = array('event'=>2,'msg'=>'验证码错误');
            exit(json_encode($output));
        }
        $data['user_name'] = $info['user_name']==$info['user_phone']?$phone:$info['user_name'];
        $data['user_phone'] = $phone;
        $data['id'] = $uid;
        $result = M("members")->save($data);
        if($result!==false){
            $updata['cell_phone'] = $phone;
            M("member_info")->where("uid = {$uid}")->save($updata);
            $output = array('event'=>88,'msg'=>'success');
            exit(json_encode($output));
        }
        $output = array('event'=>90,'msg'=>'修改失败');
        exit(json_encode($output));
    }

    /**
     *
     * 充值
     */
    public function pay_action(){

        $smsTxt = A("Home/Pay");

//        var url = "bankCode=" + bankCode + "&t_money=" + money;
//        window.open("/Pay/allinpay?" + url);
        $smsTxt->allinpay();exit;
    }

    /**
     * 提现申请
     * @params['token','money','pinpass','verify_code','pcode']
     */
    public function withdrawapply(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $pre = C('DB_PREFIX');
        $uid = $res['uid'];
        $withdraw_money = floatval($obj['money']);
        $pinpass = md5(text($obj['pinpass']));
        $vo = M('members m')->field('mm.account_money,mm.back_money,(mm.account_money+mm.back_money) all_money,m.user_leve,m.time_limit,m.pin_pass,b.bank_num,ms.id_status')
            ->join("{$pre}member_money mm on mm.uid = m.id")
            ->join("{$pre}member_banks b on b.uid = m.id")
            ->join("{$pre}members_status ms on ms.uid = m.id")
            ->where("m.id={$uid}")->find();
        if($vo['id_status'] != 1){
            $output = array('event'=>5,'msg'=>'未完成实名认证');
            exit(json_encode($output));
        }
        if(empty($vo['bank_num'])){
            $output = array('event'=>6,'msg'=>'未绑卡');
            exit(json_encode($output));
        }
        if($vo['pin_pass'] != $pinpass){
            $output = array('event'=>4,'msg'=>'支付密码错误');
            exit(json_encode($output));
        }
        $pcode = $obj['pcode'];
        $res1 = $this->is_PToken($obj['verify_code']);
        if($res1["res"]==0){
            $output = array('event'=>1,'msg'=>'验证码已过期');
            exit(json_encode($output));
        }
        if ($res1['pcode'] != $pcode) {
            $output = array('event'=>2,'msg'=>'验证码错误');
            exit(json_encode($output));
        }
        if($vo['all_money']<$withdraw_money){
            $output = array('event'=>7,'msg'=>'提现额大于可用余额');
            exit(json_encode($output));
        }
        $start = strtotime(date("Y-m-d",time())." 00:00:00");
        $end = strtotime(date("Y-m-d",time())." 23:59:59");
        $wmap['uid'] = $uid;
        $wmap['withdraw_status'] = array("neq",3);
        $wmap['add_time'] = array("between","{$start},{$end}");
        $today_money = M('member_withdraw')->where($wmap)->sum('withdraw_money');
        $today_time = M('member_withdraw')->where($wmap)->count('id');
        $tqfee = explode("|",$this->glo['fee_tqtx']);

        //////////////////////////////////修改提现手续费///////////////////////////////////////
        switch(count($tqfee)){
            case 2:
                $fee[0] = $tqfee[0];//手续费
                $fee[2] = explode("-",$tqfee[1]);//上限

                break;
            case 3:
                $fee[0] = explode("-",$tqfee[0]);
                $fee[1] = explode("-",$tqfee[1]);
                $fee[2] = explode("-",$tqfee[2]);
                break;
            default:
                $output = array('event'=>8,'msg'=>'提现规则设置有误');
                exit(json_encode($output));
        }
        $one_limit = $fee[2][0]*10000;
        if($withdraw_money<100){
            $output = array('event'=>9,'msg'=>'单笔提现金额最低100');
            exit(json_encode($output));
        }
        if($withdraw_money>$one_limit){
            $output = array('event'=>10,'msg'=>'单笔提现金额超过上限');
            exit(json_encode($output));
        }
        $today_limit = $fee[2][1]/$fee[2][0];
        if($today_time>=$today_limit){
            $output = array('event'=>11,'msg'=>'每日提现次数限定为'.$today_limit.'次');
            exit(json_encode($output));
        }
        if(1==1 || $vo['user_leve']>0 && $vo['time_limit']>time()){
            if(($today_money+$withdraw_money)>$fee[2][1]*10000){
                $output = array('event'=>12,'msg'=>'单日提现上限'.$fee[2][1].'万元');
                exit(json_encode($output));
            }
            $itime = strtotime(date("Y-m", time())."-01 00:00:00").",".strtotime( date( "Y-m-", time()).date("t", time())." 23:59:59");
            $wmapx['uid'] = $uid;
            $wmapx['withdraw_status'] = array("neq",3);
            $wmapx['add_time'] = array("between","{$itime}");
            $times_month = M("member_withdraw")->where($wmapx)->count("id");


            $tqfee1 = explode("|",$this->glo['fee_tqtx']);

            //////////////////////////////////修改提现手续费///////////////////////////////////////
            switch(count($tqfee1)) {
                case 2:
                    $fee = $tqfee1[0]; //手续费
                    //$fee=$withdraw_money*$fee1[0]/1000;
                    break;
                case 3:
                    $fee1[0] = explode("-",$tqfee1[0]);
                    $fee1[1] = explode("-",$tqfee1[1]);
                    if(($withdraw_money-$vo['back_money'])>=0){
                        $maxfee1 = ($withdraw_money-$vo['back_money'])*$fee1[0][0]/1000;
                        if($maxfee1>=$fee1[0][1]){
                            $maxfee1 = $fee1[0][1];
                        }

                        $maxfee2 = $vo['back_money']*$fee1[1][0]/1000;
                        if($maxfee2>=$fee1[1][1]){
                            $maxfee2 = $fee1[1][1];
                        }

                        $fee = $maxfee1+$maxfee2;
                        $money = $withdraw_money-$vo['back_money'];
                    }else{
                        //$fee = $vo['back_money']*$fee1[1][0]/1000;
                        $fee = $withdraw_money*$fee1[1][0]/1000;
                        if($fee>=$fee1[1][1]){
                            $fee = $fee1[1][1];
                        }
                    }
                    break;
                default :
                    $output = array('event'=>8,'msg'=>'提现规则设置有误');
                    exit(json_encode($output));

            }

            if(($vo['all_money']-$withdraw_money - $fee)<0 ){

                //$withdraw_money = ($withdraw_money - $fee);
                $moneydata['withdraw_money'] = $withdraw_money;
                $moneydata['withdraw_fee'] = $fee;
                $moneydata['second_fee'] = $fee;
                $moneydata['withdraw_status'] = 0;
                $moneydata['uid'] =$uid;
                $moneydata['add_time'] = time();
                $moneydata['add_ip'] = get_client_ip();
                $newid = M('member_withdraw')->add($moneydata);
                if($newid){
                    memberMoneyLog($uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',0);
                    MTip('chk6',$uid);
                    $output = array('event'=>88,'msg'=>'success');
                    exit(json_encode($output));
                }

            }else{
                $moneydata['withdraw_money'] = $withdraw_money;
                $moneydata['withdraw_fee'] = $fee;
                $moneydata['second_fee'] = $fee;
                $moneydata['withdraw_status'] = 0;
                $moneydata['uid'] =$uid;
                $moneydata['add_time'] = time();
                $moneydata['add_ip'] = get_client_ip();
                $newid = M('member_withdraw')->add($moneydata);
                if($newid){
                    memberMoneyLog($uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@');
                    MTip('chk6',$uid);
                    $output = array('event'=>88,'msg'=>'success');
                    exit(json_encode($output));
                }
            }
            $output = array('event'=>90,'msg'=>'提现申请失败');
            exit(json_encode($output));
        }

    }

    /**
     * 验证原手机的手机验证码
     */
    public function checkphone(){

        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        $phone = M("members")->getFieldById($uid,"user_phone");
        $resp = $this->is_PToken($obj['ptoken']);
        if($resp["res"]==0){
            $output = array('event'=>2,'msg'=>'验证码已过期');
            exit(json_encode($output));
        }
        if ($resp['pcode'] != $obj['pcode']||$resp["phone"]!=$phone) {
            $output = array('event'=>1,'msg'=>'验证码错误');
            exit(json_encode($output));
        }
        $output = array('event'=>88,'msg'=>'成功 ');
        exit(json_encode($output));

    }

    /**
     * 更改手机认证
     * tip3:更改绑定（同时更改第三方）
     */
    public function changephone(){

        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        $resp = $this->is_PToken($obj['ptoken']);
        if($resp["res"]==0){
            $output = array('event'=>2,'msg'=>'验证码已过期');
            exit(json_encode($output));
        }
        if ($resp['pcode'] != $obj['pcode']||$resp["phone"]!=$obj["phone"]) {
            $output = array('event'=>1,'msg'=>'验证码错误');
            exit(json_encode($output));
        }

        import("ORG.Escrow.Escrow");
        $info = M("sina_account")->where("uid = {$uid}")->find();
        $escrow = new Escrow();
        $params["identity_id"] = $info["identity_id"];
        $params["verify_type"] = "MOBILE";
        $res = $escrow->unbinding_verify($params);

        if($res["status"]==1){
            $escrowx = new Escrow();
            $params["verify_entity"] = $obj['phone'];
            $resx = $escrowx->binding_verify($params);
            if($resx["status"]==1){
                $newid1 = M('members')->where("id={$uid}")->setField('user_phone', text($_POST['phone']));
                $updata2['cell_phone'] = text($obj['phone']);
                $newid = M("member_info")->where("uid={$uid}")->save($updata2);
                $output = array('event'=>88,'msg'=>'修改成功');
                exit(json_encode($output));
            }else{
                $output = array('event'=>90,'msg'=>'修改失败:'.$resx["data"]["response_message"]);
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>90,'msg'=>'修改失败:'.$res["data"]["response_message"]);
            exit(json_encode($output));
        }

    }


    /**
     * 银行卡信息
     * 参数
     * token
     */
    public function bankinfo_1(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];


        $ids = M('members_status')->getFieldByUid($uid, 'id_status');
        if ($ids != 1) {
            $output = array('event'=>1,'msg'=>'请先进行实名认证');
            exit(json_encode($output));
        }
        $bconf = get_bconf_setting();



        $safe_count = M("member_banks")->where("uid = {$uid} and is_safe_card = 1 and status = 1")->count();
        if($safe_count==1){
            $card_list = M("member_banks")->field("card_id,bank_num,bank_name")->where("uid={$uid} and is_safe_card = 1 and status = 1")->select();
            import("ORG.Escrow.Escrow");
            $escrow = new Escrow();
            $info = M("sina_account")->where("uid = {$this->uid}")->find();

            $params["identity_id"] = $info["identity_id"];
            $params["account_type"] ="SAVING_POT";
            $res = $escrow->query_balance($params);
            $money = $res["data"]["available_balance"];
            foreach($card_list as $k => $v){
                $card_list[$k]["bank_num"] = hidecard($v["bank_num"],3);
                $card_list[$k]["allow_unbind"] = $money==0?1:0;
                $card_list[$k]["bank_name"] = $bconf["BANK_NAME"][$v["bank_name"]]."(安全卡)";
            }
            $output = array('event'=>88,'msg'=>'success','obj'=>$card_list,'is_safe'=>1);
            exit(json_encode($output));
        }else{
            $card_list = M("member_banks")->field("card_id,bank_num,bank_name")->where("uid={$uid} and status = 1")->select();

            foreach($card_list as $k => $v){
                $card_list[$k]["bank_num"] = hidecard($v["bank_num"],3);
                $card_list[$k]["allow_unbind"] = 1;
                $card_list[$k]["bank_name"] = $bconf["BANK_NAME"][$v["bank_name"]];
            }


            $output = array('event'=>88,'msg'=>'success','obj'=>$card_list,'is_safe'=>0);
            exit(json_encode($output));
        }


    }



    /**
     * 绑卡显示实名信息
     *
     */
    public function bindreal(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        $account_money = M("member_money")->getFieldByUid($uid,"account_money");
        $back_money = M("member_money")->getFieldByUid($uid,"back_money");
        $info = M("member_info")->field("real_name,idcard")->where("uid = {$uid}")->find();
        $info["idcard"] = hidecard($info["idcard"],5);
        $info["money"] = $account_money+$back_money;
        $bank = M("member_banks")
            ->field("id,uid,card_id,bank_num,bank_name")
            ->where("uid = {$uid} and status = 1")
            ->order("is_safe_card desc")
            ->find();
        if($bank["card_id"]==""){
            $info["pay_type"]="quick_pay";
        }else{
            $bconf = get_bconf_setting();
            $info["pay_type"]="binding_pay";
            $info["card_id"]=$bank["card_id"];
            $info["bank_num"]=hidecard($bank["bank_num"],5);
            $info["bank_name"]=$bconf["BANK_NAME"][$bank["bank_name"]];
        }

        $output = array('event'=>88,'msg'=>'success','obj'=>$info);
        exit(json_encode($output));
    }

    /**
     * 绑定银行卡
     * 参数
     * token
     * bank_name 银行代码
     * account 银行卡卡号
     * province 省
     * city 市
     * bank_branch 开户行
     * phone 预留手机号
     */
    public function bindbank_1(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        import("ORG.Escrow.Escrow");
        $escrow = new Escrow();
        $info = M("sina_account")->where("uid = {$uid}")->find();
        $params["request_no"] = "Bind".time().rand(1000,9999);
        $params["identity_id"] = $info["identity_id"];
        $params["bank_code"] = $obj['bank_name'];
        $params["bank_account_no"] = text($obj['account']);
        $params["card_type"] = "DEBIT";
        $params["card_attribute"] = "C";
        $params["phone_no"] = $obj['phone'];
        if($_POST['card_type']=="CREDIT"){
            $params["validity_period"] = text($obj['validity_period']);
            $params["verification_value"] = text($obj['verification_value']);
        }
        $params["province"] = text($obj['province']);
        $params["city"] = text($obj['city']);
        $params["bank_branch"] = text($obj['bank_branch']);


        $res = $escrow->binding_bank_card($params);
        if($res["status"]==1){
            $data['uid'] = $uid;
            $data['bank_num'] = text($obj['account']);
            $data['bank_name'] = $obj['bank_name'];
            $data['bank_address'] = text($obj['bank_branch']);
            $data['bank_province'] = text($obj['province']);
            $data['bank_city'] = text($obj['city']);
            $data['add_ip'] = get_client_ip();
            $data['add_time'] = time();
            $data['status'] = 0;
            $nid = M('member_banks')->add($data);
            $output = array('event'=>88,'msg'=>'发送成功','ticket'=>$res["data"]["ticket"],'bankcard_id'=>$nid);
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'操作失败:'.$res["data"]["response_message"],'obj'=>$obj);
            exit(json_encode($output));
        }

    }
    public function bindbankadvance(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        import("ORG.Escrow.Escrow");
        $escrow = new Escrow();
        $params["valid_code"] = text($obj['valid_code']);
        $params["ticket"] = $obj["ticket"];

        $res = $escrow->binding_bank_card_advance($params);
        if($res["status"]==1){
            $data["status"] = 1;
            $data['card_id'] = $res["data"]["card_id"];
            M('member_banks')->where("id = {$obj["bankcard_id"]} and uid ={$uid}")->save($data);
            $output = array('event'=>88,'msg'=>'绑定成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'绑定失败:'.$res["data"]["response_message"]);
            exit(json_encode($output));
        }
    }

    /**
     * 银行列表
     */
    public function getbanklist(){
        $bconf = get_bconf_setting();
        $list=array();$i=0;
        foreach($bconf['BANK_NAME'] as $v){
            $list[$i]=$v;
            $i++;
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));

    }
    /**
     * 省市区对应关系
     */
    public function getarea(){
        $list = M("area")->select();
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));

    }
    public function getprovince(){
        $list = M("area")->where("sort_order = 1")->select();
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));
    }
    public function getcity(){
        $obj = $_SERVER['REQUEST_METHOD']=='POST'?$_POST:$_REQUEST;
        $id = $obj['id'];
        $list = M("area")->where("reid = {$id}")->select();
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));
    }


    /**
     * 充值获取验证码
     *
     */
    public function sinapay(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        import("ORG.Escrow.Escrow");
        $escrow = new Escrow();

        $data = M("sina_account")->where("uid = {$uid}")->find();

        $pay_type = $obj["pay_type"];

        $params['notify_url'] = "http://".$_SERVER['HTTP_HOST']."/notify/paynotify";
        if($pay_type=="quick_pay"){
            $params['notify_url'] = "http://".$_SERVER['HTTP_HOST']."/notify/paynotify?sinaPnsVersion=v0.1";
        }
        $params['return_url'] = "http://".$_SERVER['HTTP_HOST']."/return/payreturn";
        $params["out_trade_no"] = "charge".time().rand(100,999);
        $params["summary"] = "charge";
        $params["identity_id"] = $data["identity_id"];
        $params["amount"] = $obj["amount"];
        $params["user_fee"] = "";
        $params["extend_param"] = "";
        $params["pay_method"] = $pay_type;
        if($pay_type=="online_bank"||$pay_type=="quick_pay"){
            $params["bank_code"] = $obj["bank_name"];
            $params["bank_card_type"] = "DEBIT";
            $params["bank_card_attribute"] = "C";
        }
        if($pay_type=="quick_pay"){
            $params["card_no"] = $obj["card_no"];
            $info = M("member_info")->field("real_name,idcard")->where("uid = {$uid}")->find();
            $params["account_name"] = $info["real_name"];
            $params["cert_no"] = $info["idcard"];
            $params["phone_num"] = $obj["phone"];
            $params["province"] = $obj["province"];
            $params["city"] = $obj["city"];

            $datax["bank_num"] = $obj["card_no"];
            $datax["bank_province"] = $obj["province"];
            $datax["bank_city"] = $obj["city"];
            $datax["bank_name"] = $obj["bank_name"];
            $datax["add_time"] = time();
            $datax["add_ip"] = get_client_ip();
            $datax["status"] = 0;
            $datax["uid"] = $uid;
            $bnid = M("member_banks")->add($datax);

        }
        if($pay_type=="binding_pay")
        {
            $params["card_id"] = $obj['card_id'];
        }

        $paydetail['tran_id'] = $params["out_trade_no"];
        $paydetail['nid'] = $pay_type=="quick_pay"?$bnid:"";
        $paydetail['money'] = $obj["amount"];
        $paydetail['fee'] = 0;
        $paydetail['add_time'] = time();
        $paydetail['add_ip'] = get_client_ip();
        $paydetail['status'] = 0;
        $paydetail['uid'] = $uid;
        $paydetail['fee'] = "";
        $paydetail['way'] = $obj["pay_type"];
        M("member_payonline")->add($paydetail);
        $res = $escrow->create_hosting_deposit($params);
        if($res["status"]==1){
            $output = array('event'=>88,'msg'=>'发送成功','ticket'=>$res["data"]["ticket"]);
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'操作失败:'.$res["data"]["response_message"]);
            exit(json_encode($output));
        }


    }
    public function payadvance(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        import("ORG.Escrow.Escrow");
        $escrow = new Escrow();
        $params["out_advance_no"] = "advance".time().rand(100,999);
        $params["validate_code"] = $obj['valid_code'];
        $params["ticket"] = $obj["ticket"];

        $res = $escrow->advance_hosting_pay($params);
        if($res["status"]==1){

            $card_id = $obj["card_id"];
            M("member_banks")->where("card_id = {$card_id}")->save(array("is_safe_card"=>1));

            $output = array('event'=>88,'msg'=>'充值成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'充值失败:'.$res["data"]["response_message"]);
            exit(json_encode($output));
        }
    }


    /**
     * 提现
     * 参数：token
     */
    public function withdrawinfo(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        import("ORG.Escrow.Escrow");
        $escrow = new Escrow();

        $data = M("sina_account")->where("uid = {$uid}")->find();
        $params["identity_id"] = $data["identity_id"];
        $params["account_type"]="SAVING_POT";
        $res = $escrow->query_balance($params);
        if($res["status"]==0){
            $output = array('event'=>90,'msg'=>$res["data"]["response_message"]);
            exit(json_encode($output));
        }
        $money = $res["data"]["available_balance"];
        $banklist = M("member_banks")->where("uid = {$uid} and status = 1")->order("is_safe_card desc")->find();
        $bconf = get_bconf_setting();
        $listt["card_id"] = $banklist["card_id"];
        $listt["bank_num"] = hidecard($banklist["bank_num"],3);
        $listt["bank_name"] = $bconf["BANK_NAME"][$banklist["bank_name"]];
        $listt["bank_name"] .= $banklist["is_safe_card"]==1?"(安全卡)":"";
        $listt["money"] =$money;
        $output = array('event'=>88,'msg'=>'success','obj'=>$listt,);
        exit(json_encode($output));

    }

    /**
     * 提现操作
     * 参数token;card_id,amount,pwd
     */
    public function sinawithdraw(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];



        import("ORG.Escrow.Escrow");
        $info = M("sina_account")->where("uid = {$uid}")->find();
        $pin_pass = M("members")->getFieldById($uid,"pin_pass");
        if($pin_pass!=md5(text($obj["pwd"]))&&$obj["pwd"]!=""){
            $output = array('event'=>1,'msg'=>'支付密码错误');
            exit(json_encode($output));
        }
        $escrowx = new Escrow();

        $paramsx["identity_id"] = $info["identity_id"];
        $paramsx["account_type"] = "SAVING_POT";

        $resxx = $escrowx->query_balance($paramsx);

        if($resxx["data"]["available_balance"]<$obj["amount"]){
            $output = array('event'=>2,'msg'=>'余额不足');
            exit(json_encode($output));
        }

        $escrow = new Escrow();

        $params["notify_url"] = "http://".$_SERVER['HTTP_HOST']."/notify/withdrawnotify";
        $params["out_trade_no"] = "withdraw".time().rand(100,999);
        $params["summary"] ="withdraw";
        $params["identity_id"] = $info["identity_id"];
        $params["account_type"] = "SAVING_POT";
        $params["amount"] = $obj["amount"];
        $params["user_fee"] ="";
        $params["card_id"] =$obj["card_id"];
        $params["withdraw_mode"] ="";
        $params["extend_param"] ="";



        $mm = M("member_money")->where("uid = {$uid}")->find();


        $moneydata['order_no'] = $params["out_trade_no"];
        $moneydata['withdraw_money'] = $obj["amount"];
        $moneydata['withdraw_fee'] = 0;
        $moneydata['withdraw_status'] = 0;
        $moneydata['uid'] =$uid;
        $moneydata['add_time'] = time();
        $moneydata['add_ip'] = get_client_ip();
        if($_POST["amount"]>$mm["back_money"]){
            $moneydata['back_num'] = $mm["back_money"];
            $moneydata['account_num'] =$obj["amount"]-$mm["back_money"];
        }else{
            $moneydata['account_num']=0;
            $moneydata['back_num'] = $obj["amount"];
        }
        $newid = M('member_withdraw')->add($moneydata);




        if($newid){
            $adddata["type"] = "withdraw";
            $adddata["order_no"] = $params["out_trade_no"];
            $adddata["info"] = "";
            $adddata["json_params"] = json_encode($params);
            $adddata["pay_status"] = 0;

            $res = $escrow->create_hosting_withdraw($params);
            if($res["status"]==1){
                M("order_info")->add($adddata);
                memberMoneyLog($uid,4,-$obj["amount"],"提现申请成功，资金平台冻结");
                $output = array('event'=>88,'msg'=>'提现成功，等待资金到账');
                exit(json_encode($output));
            }else{
                $output = array('event'=>89,'msg'=>$res["data"]["response_message"]);
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>90,'msg'=>'提交失败');
            exit(json_encode($output));
        }





    }

    /**
     * 校验
     * 参数：token
     */

    public function checkinfo(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        $ids = M("members_status")->getFieldByUid($uid,"id_status");
        if($ids!=1){
            $output = array('event'=>1,'msg'=>'尚未进行实名认证，请先进行实名认证');
            exit(json_encode($output));
        }
        $type = $obj["type"]==1?1:0;
        if($type==1){
            $count = M("member_banks")->where("uid = {$uid} and status = 1")->count();
            if($count==0){
                $output = array('event'=>3,'msg'=>'尚未绑定银行卡，请先绑定银行卡');
                exit(json_encode($output));
            }
            $pin = M("members")->getFieldById($uid,"pin_pass");
            if($pin==""){
                $output = array('event'=>2,'msg'=>'尚未修改支付密码，请先修改支付密码');
                exit(json_encode($output));
            }

        }
        $output = array('event'=>88,'msg'=>'校验成功');
        exit(json_encode($output));


    }
    /**
     * 忘记登录密码
     * 参数 phone
     */
    public function sendfindcode(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $phone = $obj["phone"];
        if(strlen($phone) == "11")
        {
            if(!preg_match("/^1[3|4|5|8][0-9]\\d{8}$/",$phone)){
                $output = array('event'=>0,'msg'=>'手机号格式错误');
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>1,'msg'=>"手机号长度错误".strlen($phone));
            exit(json_encode($output));
        }



        $count = M("members")->where("user_phone = {$phone}")->count();
        if($count==0){
            $output = array('event'=>2,'msg'=>'该手机号并未注册');
            exit(json_encode($output));
        }
        $smsTxt = FS("Dynamic/smstxt");
        $smsTxt = de_xie($smsTxt);
        $code = rand_string_reg(6, 1, 2);
        $datag = get_global_setting();
        $is_manual = $datag['is_manual'];
        if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
            $res = sendsms($phone, str_replace(array("#USERNAME#", "#CODE#"), array('', $code), $smsTxt['verify_phone']));
            if ($res) {
                $str = $this->getPToken($code,$phone);
                $output = array('event'=>88,'msg'=>'发送成功','token'=>$str);
                exit(json_encode($output));
            } else{
                $output = array('event'=>90,'msg'=>'发送失败');
                exit(json_encode($output));
            }
        }else{
            $output = array('event'=>91,'msg'=>'未开启发送功能');
            exit(json_encode($output));
        }
    }

    /**
     * 验证手机号和验证码并返回uid
     * 参数 phone pcode
     */
    public function checkfindphone(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_PToken($obj['token']);
        if($res["res"]==0){
            $output = array('event'=>2,'msg'=>'验证码已过期');
            exit(json_encode($output));
        }
        if ($res['pcode'] != $obj['pcode']||$res["phone"]!=$obj["phone"]) {
            $output = array('event'=>1,'msg'=>'验证码错误');
            exit(json_encode($output));
        }
        $output = array('event'=>88,'msg'=>'success');
        exit(json_encode($output));
    }
    /**
     * 修改登录密码
     * 参数 pwd phone
     */
    public function changeloginpwd(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);

        $pass = M("members")->getFieldByUserPhone($obj["phone"],"user_pass");
        if($pass==md5($obj["pwd"])){
            $output = array('event'=>1,'msg'=>'新旧密码相同');
            exit(json_encode($output));
        }
        $updata["user_pass"] = md5($obj["pwd"]);

        $nid = M("members")->where("user_phone = {$obj["phone"]}")->save($updata);
        if($nid){
            $output = array('event'=>88,'msg'=>'修改成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'修改失败');
            exit(json_encode($output));
        }
    }

    /**
     * 站内消息
     * 参数
     *
     */
    public function innermsg(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?8:$obj['pagesize'];
        $page_start = $pagesize*($page-1);
        $page_end = $pagesize;
        $limit = "$page_start,$page_end";

        $count = M("inner_msg")->where("uid = {$uid}")->count();
        $list = M("inner_msg")->where("uid = {$uid}")->order("id desc")->limit($limit)->select();
        if(is_array($list)){
            $currentPage = $page;
            $pageSize = $pagesize;
            $maxCount = $count;
            $maxPage = ceil($count/$pagesize);
            $output = array('event'=>88,'msg'=>'success','obj'=>$list,
                'currentPage'=>$currentPage,'pageSize'=>$pageSize,
                'maxCount'=>$maxCount,'maxPage'=>$maxPage);
            exit(json_encode($output));
        }
        else{
            $output = array('event'=>90,'msg'=>'暂无记录');
            exit(json_encode($output));
        }
    }

    /**
     * 阅读站内信
     * id
     */
    public function innermsgread(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        M("inner_msg")->where("id = {$obj["id"]}")->save(array("status"=>0));
    }
    /**
     * 首页幸福计划列表
     * 无参数
     */
    public function indexlist(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);


        //蜜糖月
        $search1["borrow_type"] = 6;
        $search1["borrow_duration"] = 1;
        $search1["borrow_status"] = array("in",array(2,4,6,7,8,9,10));
        $one = M("borrow_info")
            ->field("id,borrow_name,has_borrow,
                    borrow_duration,borrow_money,
                    borrow_interest_rate,borrow_status,
                    reward_num,online_time")
            ->where($search1)
            ->order("id DESC")->find();
        $one["progress"] = round($one["has_borrow"]/$one["borrow_money"]*100,2);
        $one["borrow_money"] = getMoneyFormt2($one["borrow_money"]);
        $one["invest"] = 100;
        $one["shouyi"] = $one["invest"]*$one["borrow_interest_rate"]/100/12;
        //阳光季
        $search3["borrow_type"] = 6;
        $search3["borrow_duration"] = 3;
        $search3["borrow_status"] = array("in",array(2,4,6,7,8,9,10));
        $three = M("borrow_info")
            ->field("id,borrow_name,has_borrow,
                    borrow_duration,borrow_money,
                    borrow_interest_rate,borrow_status,
                    reward_num,online_time")
            ->where($search3)
            ->order("id DESC")->find();
        $three["progress"] = round($three["has_borrow"]/$three["borrow_money"]*100,2);
        $three["borrow_money"] = getMoneyFormt2($three["borrow_money"]);
        $three["invest"] = 100;
        $three["shouyi"] = $three["invest"]*$three["borrow_interest_rate"]/100/4;
        //双季囍
        $search6["borrow_type"] = 6;
        $search6["borrow_duration"] = 6;
        $search6["borrow_status"] = array("in",array(2,4,6,7,8,9,10));
        $six = M("borrow_info")
            ->field("id,borrow_name,has_borrow,
                    borrow_duration,borrow_money,
                    borrow_interest_rate,borrow_status,
                    reward_num,online_time")
            ->where($search6)
            ->order("id DESC")->find();

        $six["progress"] = round($six["has_borrow"]/$six["borrow_money"]*100,2);
        $six["borrow_money"] = getMoneyFormt2($six["borrow_money"]);
        $six["invest"] = 100;
        $six["shouyi"] = $six["invest"]*$six["borrow_interest_rate"]/100/2;
        //美满年
        $search12["borrow_type"] = 6;
        $search12["borrow_duration"] = 12;
        $search12["borrow_status"] = array("in",array(2,4,6,7,8,9,10));
        $year = M("borrow_info")
            ->field("id,borrow_name,has_borrow,
                    borrow_duration,borrow_money,
                    borrow_interest_rate,borrow_status,
                    reward_num,online_time")
            ->where($search12)
            ->order("id DESC")->find();
        $year["progress"] = round($year["has_borrow"]/$year["borrow_money"]*100,2);
        $year["borrow_money"] = getMoneyFormt2($year["borrow_money"]);
        $year["invest"] = 100;
        $year["shouyi"] = $year["invest"]*$year["borrow_interest_rate"]/100;


        $list = array();
        $list[0] = is_array($one)?$one:"";
        $list[1] = is_array($three)?$three:"";
        $list[2] = is_array($six)?$six:"";
        $list[3] = is_array($year)?$year:"";

        foreach($list as $k => $v){
            if(is_array($v)){
                $list[$k]["need"]=$v["borrow_money"]-$v["has_borrow"];
                switch($v["borrow_status"]){
                    case 2:
                        if(time()<$v["online_time"]){
                            $list[$k]["borrow_status"]=1;
                            $list[$k]["text"]=date("Y-m-d H:i:s",$v["online_time"])."开放加入";
                        }else{
                            $list[$k]["text"]="立即抢购";
                        }
                        break;
                    case 3:
                        $list[$k]["text"]="已流标";
                        break;
                    case 4:
                        $list[$k]["text"]="审核中";
                        break;
                    case 6:
                        $list[$k]["text"]="收益中";
                        break;
                    case 7:
                    case 8:
                    case 9:
                    case 10:
                    $list[$k]["text"]="已完成";
                        break;

                }
            }
        }
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录','obj'=>$list);
            exit(json_encode($output));
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));
    }


    /**
     * 投资项目  幸福计划
     * 参数 无
     */
    public function crowdlist(){

        $arr = array(
            2=>'等额本息',
            4=>'先息后本',
            5=>'一次性还本付息'
            );
        $arrx = array(
            1=>0,
            3=>1,
            6=>2,
            12=>3
        );
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?6:$obj['pagesize'];
        $page_start = $pagesize*($page-1);
        $limit = "$page_start,$pagesize";



        $search["borrow_type"] = 6;
        $search["borrow_duration"] = array("in",array(1,3,6,12));
        if($obj['borrow_duration']){
            $search["borrow_duration"] = $obj['borrow_duration'];
        }
        $search["borrow_status"] = array("in",array(2,4,6,7));
        $count = M("borrow_info")
            ->where($search)
            ->count();
        $list = M("borrow_info")
            ->field("id,borrow_name,
                    borrow_duration,borrow_money,
                    borrow_interest_rate,borrow_status,
                    reward_num,online_time,has_borrow,repayment_type,borrow_type")
            ->where($search)
            ->order("borrow_status asc,id DESC")
            ->limit($limit)
            ->select();
        foreach($list as $k => $v){
            if(is_array($v)){
                $list[$k]["need"]=$v["borrow_money"]-$v["has_borrow"];
                switch($v["borrow_status"]){
                    case 2:
                        if(time()<$v["online_time"]){
                            $list[$k]["borrow_status"]=1;
                            $list[$k]["text"]="尚未开启";
                        }else{
                            $list[$k]["text"]="立即抢购";
                        }
                        break;
                    case 3:
                        $list[$k]["text"]="已流标";
                        break;
                    case 4:
                        $list[$k]["text"]="审核中";
                        break;
                    case 6:
                        $list[$k]["text"]="收益中";
                        break;
                    case 7:
                    case 8:
                    case 9:
                    case 10:
                        $list[$k]["text"]="已完成";
                        break;

                }
            }
            $list[$k]['has_borrow'] = getMoneyFormt3($v['has_borrow']);
            $list[$k]['borrow_money'] = getMoneyFormt2($v['borrow_money']);
            $list[$k]["progress"] = round($v["has_borrow"]/$v["borrow_money"],2);
            $list[$k]["repayment_type"] = $arr[$v["repayment_type"]];
            $list[$k]["type"] = $arrx[$v["borrow_duration"]];
        }

        if(is_array($list)){
            $currentPage = $page;
            $pageSize = $pagesize;
            $maxCount = $count;
            $maxPage = ceil($count/$pagesize);
            $output = array('event'=>88,'msg'=>'success','obj'=>$list,
                'currentPage'=>$currentPage,'pageSize'=>$pageSize,
                'maxCount'=>$maxCount,'maxPage'=>$maxPage);
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'尚未发布');
            exit(json_encode($output));
        }
    }

    /**
     * 投资项目  散标
     * 参数 无
     */
    public function borrowlist1(){
        $pre = C('DB_PREFIX');
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?6:$obj['pagesize'];
        $page_start = $pagesize*($page-1);
        $limit = "$page_start,$pagesize";
        $search["borrow_type"] = array("neq", 6);
        $search["borrow_status"] = array("in",array(2,4,6,7));
        $count = M("borrow_info")
            ->where($search)->count();
        $list = M("borrow_info b")
            ->field("b.id,b.borrow_name,
                    b.borrow_duration,b.borrow_money,
                    b.borrow_interest_rate,b.borrow_status,
                    b.repayment_type,b.borrow_type,
                    m.credits")
            ->join("{$pre}members m on m.id = b.borrow_uid")
            ->where($search)
            ->order("b.borrow_status asc,b.id DESC")
            ->limit($limit)
            ->select();
        foreach($list as $k => $v){
            $list[$k]['borrow_money'] = getMoneyFormt2($v['borrow_money']);
            $list[$k]['level'] = $this->getLeveIco($v['credits']);
            $list[$k]['borrow_type']=intval($v['borrow_type']);
            $list[$k]["borrow_duration"] .= $v["repayment_type"]==1?"天":"个月";
        }
        if(is_array($list)){
            $currentPage = $page;
            $pageSize = $pagesize;
            $maxCount = $count;
            $maxPage = ceil($count/$pagesize);
            $output = array('event'=>88,'msg'=>'success','obj'=>$list,
                'currentPage'=>$currentPage,'pageSize'=>$pageSize,
                'maxCount'=>$maxCount,'maxPage'=>$maxPage);
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'尚未发布');
            exit(json_encode($output));
        }
    }

    /**
     * 帮助中心
     */
    public function helpcenter(){
        /**
         * 账户相关
         */
        $zhxg = D('Acategory')->find(51);

        /**
         * 业务相关
         */
        $ywxg = D('Acategory')->find(52);

        /**
         * 活动相关
         */
        $hdxg = D('Acategory')->find(53);

        /**
         * 安全保障
         */
        $aqbz = D('Acategory')->find(54);

        $arr = array();
        $arr[0] = $zhxg==""?"":$zhxg;
        $arr[1] = $ywxg==""?"":$ywxg;
        $arr[2] = $hdxg==""?"":$hdxg;
        $arr[3] = $aqbz==""?"":$aqbz;
        $output = array('event'=>88,'msg'=>'success','obj'=>$arr);
        exit(json_encode($output));
    }

    /**
     * 意见反馈
     * 参数 token msg
     */
    public function feedback(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        $members = M("members")->find($uid);
        if(strlen($obj["msg"])<20){
            $output = array('event'=>1,'msg'=>'反馈意见不能少于20个字符');
            exit(json_encode($output));
        }

        $rs = M("feedback")->add(array(
            "name"=>$members["user_name"],
            "type"=>8,
            "contact"=>$members["user_phone"],
            "msg"=>$obj["msg"],
            "ip"=>get_client_ip(),
            "add_time"=>time(),
            "status"=>0,
        ));
        if($rs){
            $output = array('event'=>88,'msg'=>'反馈成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'反馈失败');
            exit(json_encode($output));
        }

    }

    /**
     * 幸福计划详情
     * 参数 id
     */
    public function crowd_detail(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $borrow_id = $obj["id"];
        $info = M("borrow_info")
            ->find($borrow_id);


        /// 加入上限
        if($info['borrow_max']==0){
            $info["jrsx"] = getMoneyFormt($info['borrow_money']);
        }else{
            $info["jrsx"] = getMoneyFormt($info['borrow_max']);
        }


        $list["borrow_name"] = $info["borrow_name"];
        $list["collect_info"]=$info["collect_info"];
        $list["rate"] = $info["borrow_interest_rate"];
        $list["reward"] = $info["reward_num"];
        $list["add_time"] = date("Y-m-d H:i",$info['add_time']);
        $list["collect_day"] = $info["collect_day"];
        $list["end_time"] = date("Y-m-d H:i",$info['collect_time']+$info['borrow_duration']*60*60*24*30);
        $list["add_condition"]="加入计划金额为".getMoneyFormt($info['borrow_min'])."元起，
        且以".getMoneyFormt($info['degrees'])."元的整数倍金额。";
        $list["max_money"]=$info["jrsx"];



        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));

    }


    /**
     * 加入记录
     * 参数 id
     */
    public function investdetail(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $pre = C('DB_PREFIX');
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?8:$obj['pagesize'];
        $page_start = $pagesize*($page-1);
        $limit = "$page_start,$pagesize";
        $count = M("borrow_investor")
            ->where("bi.borrow_id = {$obj["id"]} and bi.pay_status =1")
            ->count();
        $list = M("borrow_investor bi")
            ->field("m.user_name,bi.investor_capital,bi.add_time")
            ->join("{$pre}members m on m.id = bi.investor_uid")
            ->where("bi.borrow_id = {$obj["id"]} and bi.pay_status =1")
            ->limit($limit)
            ->select();

        foreach($list as $k => $v){
            $list[$k]["user_name"] = hidecard($v["user_name"],5);
            $list[$k]["add_time"] = date("Y-m-d",$v["add_time"]);
        }
        if(is_array($list)){
            $currentPage = $page;
            $pageSize = $pagesize;
            $maxCount = $count;
            $maxPage = ceil($count/$pagesize);
            $output = array('event'=>88,'msg'=>'success','obj'=>$list,
                'currentPage'=>$currentPage,'pageSize'=>$pageSize,
                'maxCount'=>$maxCount,'maxPage'=>$maxPage);
            exit(json_encode($output));
        }
        $output = array('event'=>90,'msg'=>'暂无投资记录');
        exit(json_encode($output));
    }






    /**
     * 邀请
     * token
     */
    public function invitation(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?6:$obj['pagesize'];
        $page_start = $pagesize*($page-1);
        $limit = "$page_start,$pagesize";
        $count = M("members")
            ->where("recommend_id = {$uid}")->count();
        $ulist = M("members")
            ->field("id,user_name,reg_time")
            ->where("recommend_id = {$uid}")->limit($limit)->select();
        foreach($ulist as $k=>$v){
            $ulist[$k]["reg_time"] = date("Y-m-d",$v["reg_time"]);
            $count = M("borrow_investor")->where("investor_uid = {$v["id"]} and pay_status=1")->count();
            $ulist[$k]["status"] = $count==0?"已注册":"已投资";
        }
        $money = M("member_moneylog")->where("uid = {$uid} and type = 13")->sum("affect_money");
        $invite = extra_encode($uid,16);
        $list["invitecode"] = $invite;
        $list["list"] = is_array($ulist)?$ulist:"";;
        $list["money"] = $money;
        $file = "Static/promotion/qrcode_{$uid}.png";
        if (!file_exists('Static/promotion')){ mkdir ("Static/promotion"); }
        if(!file_exists($file))
        {
            $url = "invitecode={$invite}_xbx=1";
            require_once( C("APP_ROOT")."Lib/Phpqrcode/phpqrcode.php");
            $errorCorrectionLevel = 'L';//容错级别
            $matrixPointSize = 6;//生成图片大小
            QRcode::png(text($url),"Static/promotion/qrcode_{$uid}.png", $errorCorrectionLevel, $matrixPointSize, 2);
        }
        $my_erweima = "http://".$_SERVER['HTTP_HOST']."/Static/promotion/qrcode_{$uid}.png";

        $list["erweima"] = $my_erweima;
        $currentPage = $page;
        $pageSize = $pagesize;
        $maxCount = $count;
        $maxPage = ceil($count/$pagesize);
        $output = array('event'=>88,'msg'=>'success','obj'=>$list,
            'currentPage'=>$currentPage,'pageSize'=>$pageSize,
            'maxCount'=>$maxCount,'maxPage'=>$maxPage);
        exit(json_encode($output));

    }


    /**
     * 我的投资
     * 参数 token
     */
    public function myinvest(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        $pre = C('DB_PREFIX');

        /**
         * 蜜糖月收益
         */
        $in1 = M("investor_detail sid")
            ->field("sum(sid.capital) as capital,sum(sid.interest-sid.interest_fee) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =1 and sid.repayment_time = 0 and sid.substitute_time = 0 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->find();
        $out1 = M("investor_detail sid")
            ->field("sum(sid.receive_capital) as capital,sum(sid.receive_interest) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =1 and sid.investor_uid = {$uid}")
            ->find();
        $on1 = M("investor_detail sid")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =1 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->sum("sid.capital");

        $one["shouyi"] = $in1["shouyi"]==""?0.00:$in1["shouyi"];
        $one["capital"] = $in1["capital"]==""?0.00:$in1["capital"];
        $one["had_shouyi"] = $out1["shouyi"]==""?0.00:$out1["shouyi"];
        $one["had_caital"] = $out1["capital"]==""?0.00:$out1["capital"];
        $one["all_capital"] = $on1==""?0.00:$on1;

        /**
         * 季季盈收益
         */
        $in3 = M("investor_detail sid")
            ->field("sum(sid.capital) as capital,sum(sid.interest-sid.interest_fee) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =3 and sid.repayment_time = 0 and sid.substitute_time = 0 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->find();
        $out3 = M("investor_detail sid")
            ->field("sum(sid.receive_capital) as capital,sum(sid.receive_interest) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =3 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->find();
        $on3 = M("investor_detail sid")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =3 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->sum("sid.capital");

        $three["shouyi"] = $in3["shouyi"]==""?0.00:$in3["shouyi"];
        $three["capital"] = $in3["capital"]==""?0.00:$in3["capital"];
        $three["had_shouyi"] = $out3["shouyi"]==""?0.00:$out3["shouyi"];
        $three["had_caital"] = $out3["capital"]==""?0.00:$out3["capital"];
        $three["all_capital"] = $on3==""?0.00:$on3;

        /**
         * 双季囍收益
         */
        $in6 = M("investor_detail sid")
            ->field("sum(sid.capital) as capital,sum(sid.interest-sid.interest_fee) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =6 and sid.repayment_time = 0 and sid.substitute_time = 0 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->find();
        $out6 = M("investor_detail sid")
            ->field("sum(sid.receive_capital) as capital,sum(sid.receive_interest) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =6 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->find();
        $on6 = M("investor_detail sid")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =6 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->sum("sid.capital");

        $six["shouyi"] = $in6["shouyi"]==""?0.00:$in6["shouyi"];
        $six["capital"] = $in6["capital"]==""?0.00:$in6["capital"];
        $six["had_shouyi"] = $out6["shouyi"]==""?0.00:$out6["shouyi"];
        $six["had_caital"] = $out6["capital"]==""?0.00:$out6["capital"];
        $six["all_capital"] = $on6==""?0.00:$on6;

        /**
         * 双季囍收益
         */
        $in12 = M("investor_detail sid")
            ->field("sum(sid.capital) as capital,sum(sid.interest-sid.interest_fee) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =12 and sid.repayment_time = 0 and sid.substitute_time = 0 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->find();
        $out12 = M("investor_detail sid")
            ->field("sum(sid.receive_capital) as capital,sum(sid.receive_interest) as shouyi")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =12 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->find();
        $on12 = M("investor_detail sid")
            ->join("{$pre}borrow_info sbi on sbi.id = sid.borrow_id")
            ->join("{$pre}borrow_investor bi on bi.id = sid.invest_id")
            ->where("sbi.borrow_type = 6 and sbi.borrow_duration =12 and sid.investor_uid = {$uid} and bi.pay_status = 1")
            ->sum("sid.capital");

        $year["shouyi"] = $in12["shouyi"]==""?0.00:$in12["shouyi"];
        $year["capital"] = $in12["capital"]==""?0.00:$in12["capital"];
        $year["had_shouyi"] = $out12["shouyi"]==""?0.00:$out12["shouyi"];
        $year["had_caital"] = $out12["capital"]==""?0.00:$out12["capital"];
        $year["all_capital"] = $on12==""?0.00:$on12;

        $arr = array();
        $arr[0]=$one;
        $arr[1]=$three;
        $arr[2]=$six;
        $arr[3]=$year;

        $output = array('event'=>88,'msg'=>"success",'obj'=>$arr);
        exit(json_encode($output));


    }


    public function moneylog(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res["uid"];
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?12:$obj['pagesize'];
        $page_start = $pagesize*($page-1);
        $limit = "$page_start,$pagesize";
        $count = M("member_moneylog")
            ->where("uid = {$uid}")
            ->count();
        $list = M("member_moneylog")
            ->field("type,affect_money,info,add_time,DATE_FORMAT(FROM_UNIXTIME( add_time, '%Y-%m-%d' ),'%Y-%m') as months")
            ->where("uid = {$uid}")
            ->limit($limit)
            ->order("add_time desc")
            ->select();
        $config = require C("APP_ROOT")."Conf/config.php";
        foreach($list as $k =>$v){
            $list[$k]["txt"] = $config["MONEY_LOG"][$v["type"]];
            if($v["type"] == 6){
                $img_type = 5;
            }elseif($v["type"] == 37){
                preg_match('/\d+/',$v["info"],$arr);
                $id = $arr[0];
                $arr = array(1=>1,3=>2,6=>3,12=>4);
                $tt = M("borrow_info")->getFieldById($id,"borrow_duration");
                $img_type = $arr[$tt];
            }else{
                $img_type = 0;
            }
            $list[$k]["type"] = $img_type==""?0:$img_type;
            $list[$k]["affect_money"] = getMoneyFormt($v["affect_money"]);
        }
        if(is_array($list)){
            $currentPage = $page;
            $pageSize = $pagesize;
            $maxCount = $count;
            $maxPage = ceil($count/$pagesize);
            $output = array('event'=>88,'msg'=>'success','obj'=>$list,
                'currentPage'=>$currentPage,'pageSize'=>$pageSize,
                'maxCount'=>$maxCount,'maxPage'=>$maxPage);
            exit(json_encode($output));
        }
        $output = array('event'=>90,'msg'=>'暂无投资记录');
        exit(json_encode($output));
    }

    /**
     * 忘记支付密码
     * 1使用sendcode;2使用checkphone;3使用此接口
     * 参数 token pwd
     */
    public function changepin(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];

        $pin = M("members")->getFieldById($uid,"pin_pass");
        if(md5($obj["pwd"]) == $pin){
            $output = array('event'=>1,'msg'=>'新旧密码相同');
            exit(json_encode($output));
        }
        $pass = M("members")->getFieldById($uid,"user_pass");
        if(md5($obj["pwd"]) == $pass){
            $output = array('event'=>2,'msg'=>'不能与登录密码相同');
            exit(json_encode($output));
        }
        $updata["pin_pass"] = md5($obj["pwd"]);
        $nid = M("members")->where("id = {$uid}")->save($updata);
        if($nid){
            $output = array('event'=>88,'msg'=>'修改成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'修改失败');
            exit(json_encode($output));
        }



    }


    /**
     * 解绑银行卡
     *
     * 参数  token card_id
     */

    public function unbind(){

        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);

        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $uid = $res['uid'];
        import("ORG.Escrow.Escrow");
        $escrow = new Escrow();
        $info = M("sina_account")->where("uid = {$uid}")->find();

        $params["identity_id"] = $info["identity_id"];
        $params["card_id"] = $obj['card_id'];

        $res = $escrow->unbinding_bank_card($params);
        if($res["status"]==1){
            $data['status'] = 2;
            $card_id = $params["card_id"];
            M('member_banks')->where("card_id = {$card_id}")->save($data);
            $output = array('event'=>88,'msg'=>'解绑成功');
            exit(json_encode($output));
        }else{
            $output = array('event'=>90,'msg'=>'解绑失败:'.$res["data"]["response_message"]);
            exit(json_encode($output));
        }
    }

    /**
     * 体验标
     */

    public function currency(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);


        $uid = $res["uid"];
        $map = array();
        $pre = C('DB_PREFIX');
        $map["b.status"] = 1;
        $fields = "b.id borrow_id,b.collect_day,b.title borrow_name,b.rate rate,b.money borrow_money,sum(bi.money) invest_money,count(distinct bi.uid) invest_count";
        $testtender = M("currency_info b")
            ->field($fields)
            ->join("{$pre}currency_investor bi on bi.borrow_id=b.id")
            ->where($map)
            ->find();
        $testtender["progress"] = getFloatValue($testtender['invest_money']/$testtender['borrow_money']*100,2);
        $uaccount = M("currency")->field(true)->where(array("uid"=>$uid))->find();
        $testtender["uaccount"] = $uaccount["money"];
        $testtender["need"] = $testtender["borrow_money"]-$testtender["invest_money"];
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'未登录','obj'=>$testtender);
            exit(json_encode($output));
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$testtender);
        exit(json_encode($output));
    }
    public function currencyinvest(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }

        $uid = $res["uid"];
        $id = intval($obj['borrow_id']);
        $invest_money = intval($obj['money']);

        $pre = C('DB_PREFIX');
        $map = array();
        $map["b.id"] = $id;
        $fields = "b.id borrow_id,b.start_time,b.collect_time,b.lock_days,b.title borrow_name,b.rate rate,b.money borrow_money,sum(bi.money) invest_money,count(distinct bi.uid) invest_count";
        $testtender = M("currency_info b")
            ->field($fields)
            ->join("{$pre}currency_investor bi on bi.borrow_id=b.id")
            ->where($map)
            ->find();
        if($id < 1||!is_numeric($invest_money)||$invest_money<=0||!is_array($testtender)) {
            $output = array('event'=>1,'msg'=>'数据错误');
            exit(json_encode($output));
        }

        /**
         * 是否在活动期内
         */
        if($testtender["start_time"]<time()&&$testtender["collect_time"]>time()){}else{
            $output = array('event'=>2,'msg'=>'未开始或已结束');
            exit(json_encode($output));
        }

        /**
         * 检查余额是否充足
         */
        $uaccount = M("currency")->field(true)->where(array("uid"=>$uid))->find();
        if($uaccount["money"]<$invest_money||$uaccount["money"]==""){
            $output = array('event'=>3,'msg'=>'体验金不足');
            exit(json_encode($output));
        }

        $sum_invest_money = M("currency_investor")->where(array("borrow_id"=>$id))->sum("money");
        $sum_invest_money = $sum_invest_money==""?0:$sum_invest_money;

        $need = $testtender['borrow_money'] - $sum_invest_money;

        if(($need-$invest_money)<0 ){
            $output = array('event'=>4,'msg'=>"您最多只能再投{$need}元");
            exit(json_encode($output));
        }

        if($need<=0){
            $output = array('event'=>5,'msg'=>'已投完');
            exit(json_encode($output));
        }



        ##############################################################################
        $currency_dal = D("currency");
        $currency_dal->startTrans();

        $currency_investor_data = array();
        $currency_investor_data["uid"]=$uid;
        $currency_investor_data["money"]=$invest_money;
        $currency_investor_data["interest"]=$invest_money*$testtender["rate"]/12/30*$testtender["lock_days"]/100;
        $currency_investor_data["add_time"]=time();
        $currency_investor_data["borrow_id"]=$id;
        $currency_investor_rs = M("currency_investor")->add($currency_investor_data);

        $currency_rs = $currency_dal->where(array(
            "uid"=>$uid
        ))->save(array(
            "money"=>$uaccount["money"]-$invest_money
        ));

        $member_money = M("member_money")->field(true)->where(array("uid"=>$uid))->find();

        $member_moneylog_value = array();
        $member_moneylog_value['affect_money'] = -$invest_money;
        $member_moneylog_value['account_money'] = $member_money['account_money'];
        $member_moneylog_value['back_money'] = $member_money['back_money'];
        $member_moneylog_value['collect_money'] = $member_money['money_collect'];
        $member_moneylog_value['freeze_money'] = $member_money['money_freeze'];
        $member_moneylog_value['uid'] = $uid;
        $member_moneylog_value['type'] = 240;
        $member_moneylog_value['info'] = "【{$uid}】号用户投【{$id}】号新手体验标【{$invest_money}】元【".date('Y-m-d H:i:s',time())."】";
        $member_moneylog_value['target_uid'] = 0;
        $member_moneylog_value['target_uname'] = "@网站管理员@";
        $member_moneylog_value['add_time'] = time();
        $member_moneylog_value['add_ip'] = get_client_ip();
        $member_moneylog_rs = M('member_moneylog')->add($member_moneylog_value);

        ###############################################################################

        if($currency_investor_rs!==false&&$currency_rs!==false&&$member_moneylog_rs!==false) {
            $currency_dal->commit();
            $output = array('event'=>88,'msg'=>'投标成功');
            exit(json_encode($output));
        }else{
            $currency_dal->rollback();
            $output = array('event'=>90,'msg'=>'投标失败');
            exit(json_encode($output));
        }
    }
    /**
     * 体验金投资列表
     * 参数 borrow_id
     */
    public function currencyilist(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $borrow_id = $obj["borrow_id"];
        $pre = C('DB_PREFIX');
        $page = $obj['page']==""?1:$obj['page'];
        $pagesize = $obj['pagesize']==""?12:$obj['pagesize'];
        $page_start = $pagesize*($page-1);
        $limit = "$page_start,$pagesize";
        $count = M("currency_investor")
            ->where("borrow_id = {$borrow_id}")
            ->count();
        $list = M("currency_investor ci")
            ->field("m.user_name,ci.money,FROM_UNIXTIME(ci.add_time, '%Y-%m-%d' ) as add_time ")
            ->join("{$pre}members m on m.id = ci.uid")
            ->where("ci.borrow_id = {$borrow_id}")
            ->limit($limit)
            ->select();

        if(is_array($list)){
            $currentPage = $page;
            $pageSize = $pagesize;
            $maxCount = $count;
            $maxPage = ceil($count/$pagesize);
            $output = array('event'=>88,'msg'=>'success','obj'=>$list,
                'currentPage'=>$currentPage,'pageSize'=>$pageSize,
                'maxCount'=>$maxCount,'maxPage'=>$maxPage);
            exit(json_encode($output));
        }
        $output = array('event'=>90,'msg'=>'暂无投资记录');
        exit(json_encode($output));

    }


    /**
     * more
     */
    public function more(){
        $object = json_decode(file_get_contents('php://input', true));
        $obj = json_decode( json_encode( $object),true);
        $res = $this->is_Token($obj["token"]);
        if($res['res']==0){
            $output = array('event'=>0,'msg'=>'请重新登录');
            exit(json_encode($output));
        }
        $output = array('event'=>88,'msg'=>'success');
        exit(json_encode($output));
    }


    public function about_us(){
        $list = M("article_category")->field("id,type_name,type_content")->where("parent_id=73")->select();
        foreach($list as $k=>$v){
            $list[$k]["type_content"] = str_replace("/Static","http://".$_SERVER['HTTP_HOST']."/Static",$v["type_content"]);
        }
        $output = array('event'=>88,'msg'=>'success','obj'=>$list);
        exit(json_encode($output));
    }

//APP上传图片。banner。介绍
    public function index_banner(){
        $info = M("app_manager")->where("id = 1")->find();
        foreach(unserialize($info["banner_img"]) as $k =>$v){
            $data[$k]["img"] ="http://".$_SERVER["HTTP_HOST"]."/".$v['img'];
            $data[$k]["url"] =$v['url'];
        }
        $output =  array('event'=>88,'msg'=>'success','obj'=>$data);
        exit(json_encode($output));
    }
}
?>
