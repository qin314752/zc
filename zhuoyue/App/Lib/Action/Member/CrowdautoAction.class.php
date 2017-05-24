<?php
/**
 * User: Administrator
 */
class CrowdautoAction extends MCommonAction{
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
    public function autoset(){
        import("ORG.Util.Page");
        $uid = $this->uid;
        $sql_1 = "SET @row_number = 0;";
        $auto_model =  M();
        $auto_model->query($sql_1);
        $sql_count = "SELECT count(id) as count from nuomi_crowd_auto  where user_id =
        ".$uid." AND status = 1";
        $count =$auto_model->query($sql_count);
        $num_count = $count[0]['count'];
        $p = new Page($num_count, 5);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $sql= "SELECT * from(SELECT *,@row_number:=@row_number+1 AS row_number from nuomi_crowd_auto WHERE status = 1 ORDER BY add_time ASC ) kk where user_id =
        ".$uid." AND status = 1 limit ".$Lsql."";
        $auto_list = $auto_model->query($sql);
        $this->assign("pagebar",$page);
        $this->assign('auto_list',$auto_list);
        //总预约
        $all_count = M('crowd_auto')->count("id");
        $now_count = M('crowd_auto')->where('status = 1')->count('id');//当前预约中

        $now_people = M('crowd_auto')->where("status = 1")->count('DISTINCT user_id');
        $all_money = M('crowd_auto')->sum("auto_money");//预约总金额，包括使用和未使用的
        $now_money = M('crowd_auto')->where('status = 1')->sum("surplus_money");//前面排队资金
        $this->assign('all_count',$all_count);
        $this->assign('now_count',$now_count);
        $this->assign('now_people',$now_people);
        $this->assign('all_money',$all_money);
        $this->assign('now_money',$now_money);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function crowd_cancel(){
        if(!$this->uid) exit;
        $uid = $this->uid;
        $auto_id = $_POST['id'];//预约的ID
        $auto = M('crowd_auto')->where('id = '.$auto_id)->find();
        if(!$auto) ajaxmsg('error',3);
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
            ajaxmsg('预约取消成功！',1);
        }else{
            $crowd_auto->rollback();
            ajaxmsg('预约取消失败！',3);
        }

    }
    public function auto(){
        //总预约
        $all_count = M('crowd_auto')->count("id");
        $now_count = M('crowd_auto')->where('status = 1')->count('id');//当前预约中

        $now_people = M('crowd_auto')->where("status = 1")->count('DISTINCT user_id');
        $all_money = M('crowd_auto')->sum("auto_money");//预约总金额，包括使用和未使用的
        $now_money = M('crowd_auto')->where('status = 1')->sum("surplus_money");//前面排队资金
        $this->assign('all_count',$all_count);
        $this->assign('now_count',$now_count);
        $this->assign('now_people',$now_people);
        $this->assign('all_count_money',$all_money);
        $this->assign('now_money',$now_money);
        $this->assign("investInfo", getMinfo($this->uid,true));//个人账户信息
        $text['user_id']=$this->uid;
        $text['status']=1;
        $c_id=M('crowd_auto')->where($text)->field('sum(surplus_money) as user_money')->find();
        $text = M('crowd_config')->field('text')->find('7');
        $this->assign('all_money',$text['text']);
        $text['text']=$text['text']*10000;
        $remain_money = $text['text']-$c_id['user_money'];
        $this->assign('remain_money',$remain_money);
        $deadline = time()+10*24*3600;//当前时间的十天之后
        $this->assign('deadline',$deadline);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function ajax_invest(){
        $money = $_GET['money'];
        $deadline = $_GET['deadline'];
        $vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');//用户信息
        $this->assign("has_pin", (empty($vm['pin_pass']))?'no':'yes');
        $this->assign("investMoney", intval($money));
        $this->assign('deadline',$deadline);
        $data['content'] = $this->fetch();
        exit(json_encode($data));
    }
    public function autocheck(){
        $pre = C('DB_PREFIX');
        if(!$this->uid) {
            ajaxmsg('请先登录',3);
            exit;
        }
        $pin = md5($_POST['pin']);//获取过来的支付密码
        $money = intval($_POST['money']);//获取过来的投资金额
        $vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
        $amoney = $vm['account_money']+$vm['back_money'];
        $uname = session('u_user_name');
        $pin_pass = $vm['pin_pass'];//支付密码
        $amoney = floatval($amoney);//用户总资金
        $deadline = strtotime($_POST['deadline']."23:59:59");//预约截至时间
        $text['user_id']=$this->uid;
        $text['status']=1;
        $c_id=M('crowd_auto')->where($text)->field('sum(surplus_money) as user_money')->find();
        $text = M('crowd_config')->field('text')->find('7');
        $text['text']=$text['text']*10000;
        $remain_money = $text['text']-$c_id['user_money'];
        if($pin<>$pin_pass) ajaxmsg("支付密码错误，请重试!",0);
        if($money%1000 !=0) ajaxmsg("预约金额必须为1000的整数倍，请重新输入",0);
        if($money <=0 ) ajaxmsg("预约金额异常，请重新输入",0);
        if($money > $remain_money) ajaxmsg("预约金额大于可用预约额度，请重新输入预约金额！",0);
        if($deadline < time()) ajaxmsg("预约截至时间不能小于当前时间！",0);
        if($money > $amoney){
            $msg = "尊敬的{$uname}，您准备预约{$money}元，但您的账户可用余额为{$amoney}元，您要先去充值吗？";
            ajaxmsg($msg,2);
        }else{
            $msg = "尊敬的{$uname}，您的账户可用余额为{$amoney}元，您确认预约{$money}元吗？";
            ajaxmsg($msg,1);
        }
        ajaxmsg($msg,1);
    }
    public function autolong(){

        $text['user_id']=$this->uid;
        $text['status']=1;
        $c_id=M('crowd_auto')->where($text)->field('sum(surplus_money) as user_money')->find();
        $text = M('crowd_config')->field('text')->find('7');
        $text['text']=$text['text']*10000;
        $deadline = strtotime($_POST['deadline']."23:59:59");//预约截至时间
        if($deadline < time()){
            $this->error("预约截至时间不能小于当前时间！");
        }
        if($_POST['amount']%1000 != 0){
            $this->error("预约金额必须为1000的整数倍！");
        }
        if($_POST['amount'] <= 0){
            $this->error("预约金额异常！请重新输入!");
        }
        if($text['text']<($c_id['user_money']+$_POST['amount']))
        {
            $this->error("预约金额不能大于可用预约额度！");
        }else{
            $member_money=M('member_money')->field('account_money,money_collect,money_freeze,back_money')->find($this->uid);
            if(($member_money['account_money']+$member_money['back_money'])<$_POST['amount']){
                $this->error("余额不足以支付本次的预约金额！请充值后再预约！");
            }
            $crowd_auto=M('crowd_auto');
            $crowd_auto->startTrans();
            $data['user_id'] = $this->uid;
            $data['auto_money'] = $_POST['amount'];
            $data['employ_money'] = 0;
            $data['surplus_money'] = $_POST['amount'];
            $data['add_time'] = time();
            $data['status'] = 1;
            $data['deadline'] = $deadline;
            $id = M('crowd_auto')->add($data);

                if($member_money['account_money']>=$_POST['amount']){
                    $user_money['account_money']=$member_money['account_money']-$_POST['amount'];
                    $user_money['back_money']=$member_money['back_money'];
                }
                elseif($member_money['back_money']>=$_POST['amount']){
                    $user_money['back_money']=$member_money['back_money']-$_POST['amount'];
                    $user_money['account_money']=$member_money['account_money'];
                }
                else{
                    $residue_money=$_POST['amount']-$member_money['account_money'];
                    if($residue_money>=0){
                        $user_money['account_money']=0;
                    }
                    $user_money['back_money']=$member_money['back_money']-$residue_money;
                }
                $user_money['money_freeze']=$member_money['money_freeze']+$_POST['amount'];
                $money_id=M('member_money')->where('uid='.$this->uid)->save($user_money);
                ////////////�ʽ��¼/////////////////
                $money_log['uid']=$this->uid;//
                $money_log['affect_money']=-$_POST['amount'];//
                $money_log['account_money']=$user_money['account_money'];//��ֵ�ؿ���
                $money_log['back_money']=$user_money['back_money'];//�ؿ�ؿ���
                $money_log['freeze_money']=$user_money['money_freeze'];//������
                $money_log['type']=56;//������
                $money_log['collect_money']=$member_money['money_collect'];//����
                $money_log['info']="预约成功，冻结预约金".$_POST['amount']."元";//˵��
                $money_log['add_time']=time();
                $money_log['add_ip']=get_client_ip();//������
                $money_log['target_uid']=0;//
                $money_log['target_uname']="@网站管理员@";//
                $moneylog_id=M('member_moneylog')->add($money_log);
                if($id&&$money_id&&$moneylog_id){
                    $crowd_auto->commit();
                    $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$this->uid)->find();
                    SMStip("crowdauto",$userinfo['user_phone'],array("#USERANEM#","#MONEY#"),array($userinfo['user_name'],$_POST['amount']));//发送短信
                    $this->success("预约成功！成功预约".$_POST['amount']."元","__URL__/#fragment-1");
                }else{
                    $crowd_auto->rollback();
                    $this->error("预约失败!");
                }

        }

    }
    public function autodone()
    {
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        import("ORG.Util.Page");
        $count =M('crowd_auto')->where('user_id = '.$this->uid.' AND status = 0')->count('id');
        $p = new Page($count, 10);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        $list = M('crowd_auto')->where('user_id = '.$this->uid.' AND status = 0')->limit($Lsql)
            ->order('id desc')
            ->select();
        $this->assign('page',$page);
        $this->assign('list',$list);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
    public function autodone_cancel()
    {
        $pre = C('DB_PREFIX');
        $uid = $this->uid;//用户ID
        import("ORG.Util.Page");
        $count =M('crowd_auto')->where('user_id = '.$this->uid.' AND status = 2')->count('id');
        $p = new Page($count, 10);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        $list = M('crowd_auto')->where('user_id = '.$this->uid.' AND status = 2')->limit($Lsql)
            ->order('id desc')
            ->select();
        $this->assign('page',$page);
        $this->assign('list',$list);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
}