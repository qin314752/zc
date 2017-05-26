<?php
/**
 * User: Administrator
 */
class CrowdinvestAction extends HCommonAction{
    
    public function index() {
        
        // 众筹项目列表
        $parm = array();
        $Map['ci.status'] = array('neq','6');
        $Map['ci.is_use'] = 1;
        if($this->isAjax()){
            // 根据选择状态筛选众筹项目
            if($_REQUEST['status'] == 0 || $_REQUEST['status'] == 5){
                $_REQUEST['status'] == 0 or $Map['status'] = array('in','5,9');
            }else{
                $Map['status'] = $_REQUEST['status']; 
            }
            $this->assign('status',$_REQUEST['status']);
        }
        $parm['pagesize'] = 4;
        $parm['map'] = $Map;
        $parm['orderby'] = "ci.status ASC , ci.id DESC";
        $crowd_list = getCrowdlist($parm);
        foreach ($crowd_list['list'] as $key => $value) {
            if($crowd_list['list'][$key]['status']==5){
                $list_voting= M('crowd_voting')->where('crowd_id = '.$crowd_list['list'][$key]['id'].' AND status = 3')->find();
                $back_rate=M('crowd_info')->field('back_rate')->find($crowd_list['list'][$key]['id']);
                $sy_time=ceil(($crowd_list['list'][$key]['back_time']-$crowd_list['list'][$key]['full_time'])/(3600*24));
                $sy=$list_voting['vote_money']-$list_voting['crowd_money'];

                //众筹收益X分配比例X360
                //众筹金额X（回款时间-满标时间）
                $crowd_list['list'][$key]['voting']=round(($sy*$back_rate['back_rate']/100*360)/($list_voting['crowd_money']*$sy_time),2);
                //$list[$key]['voting']=round(($list_voting['vote_money']-$list_voting['crowd_money'])/$list_voting['crowd_money']/$sy_time*360,2);
            }
        }
        
        $this->assign('list',$crowd_list);
        
        if($this->isAjax()){
            // 获取更多众筹项目
            $data['html'] = $this->fetch('Index:project');
            $data['status'] = $_REQUEST['status'];
            $data['nowPage'] = $crowd_list['page']['nowPage'];
            $data['total'] = $crowd_list['page']['total'];
            exit(json_encode($data));
        }
        
        $this->display();
    }
    
    public function detail()
    {
        if(!$this->uid){
            redirect("/M/pub/login.html");
        }
        $pre = C('DB_PREFIX');
        $id = intval($_GET['id']);
        $list = M('crowd_info')->where('id = '.$id)->select();
        $imgarray = array();
        $imgarray[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        foreach($list as $key=>$v){
            $list[$key]['img']=unserialize($list[$key]['crowd_picture'])?unserialize($list[$key]['crowd_picture']):$imgarray;
            $list[$key]['rate'] = round((($list[$key]['has_crowd_money']/ $list[$key]['crowd_money'])*100),2);
            $list[$key]['remain_crowd_money'] = round((($list[$key]['crowd_money']- $list[$key]['has_crowd_money'])),2);
        }
        //判断是否登录，以及是否是自己的标
        if($this->uid){
            $invsx='yes';
        }else{
            $invsx='login';
        }
        //众筹记录以及众筹人次
        $crowd_record = M('crowd_investor')->where('crowd_id = '.$id." AND status = 1")->select();
        $record_count = count($crowd_record);//众筹人次
        $this->assign('crowd_record',$crowd_record);
        $this->assign('record_count',$record_count);
        //筹资剩余时间
        $satrt_time = $list[0]['start_time'];//开始时间
        $time_limit = $list[0]['crowd_duration'];//筹资期限
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
        $this->assign('remain_time',$remain_time);
        $limit_time = ($all_time - time())>0?($all_time - time()):0;
        $this->assign('limit_time',$limit_time);
        //是否开始认筹中
        if($list[0]['start_time'] > time()){
            $is_start = 0;
        }else{
            $is_start = 1;//开始认筹
        }
        $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
        $crowd_status =$Bconfig['CROWD_STATUS'];
        $list[0]["status_info"] = $crowd_status[$list[0]['status']];//该众筹的状态
        $list[0]['end_time'] = strtotime('+ '.$list[0]['crowd_duration'].' day',$list[0]['start_time']);

        //众筹记录
        // 投资记录
//        $this->investRecord($id);
//        $this->assign('crowd_id', $id);
        // 分页处理
        import("ORG.Util.Page");
        $count = M('crowd_investor')->where('crowd_id = '.$id)->count('id');
        $p = new Page($count, 10);
        $page = $p->ajax_show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        $record_list = M('crowd_investor ci')
            ->field("ci.*,m.user_name,cf.status as cfstatus,cf.start_time")
            ->join("{$pre}members m ON m.id = ci.user_id")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->order('id DESC')
            ->where('crowd_id = '.$id)
            ->limit($Lsql)
            ->select();
        $this->assign('record_list',$record_list);
        $this->assign('page',$page);
        
        if($_REQUEST['p']){
            exit($this->fetch('record'));
        }
        //计算出总共需要几个人投票，单人多次投资，算一个人
        $sql = "SELECT COUNT(DISTINCT user_id) as count FROM nuomi_crowd_investor WHERE crowd_id =".$id;
        $model = M();
        $arr =$model->query($sql);
        $need_vote_people = $arr[0]['count'];//总共需要投票的人数
        $this->assign("need_vote_people",$need_vote_people);
        //查出该众筹的投票记录以及投票百分比
        $vote_list = M('crowd_voting vo')
            ->join("{$pre}crowd_vote_detail vt ON vt.vote_id = vo.id")
            ->where('vo.crowd_id = '.$id." AND vo.status in (1,3)")
            ->select();//投票列表
        $agree_people = M('crowd_voting vo')
            ->join("{$pre}crowd_vote_detail vt ON vt.vote_id = vo.id")
            ->where('vo.crowd_id = '.$id." AND vo.status in (1,3) AND vt.is_agree = 1")
            ->count('vo.id');//投赞成票的人数
        $not_agree_people = M('crowd_voting vo')
            ->join("{$pre}crowd_vote_detail vt ON vt.vote_id = vo.id")
            ->where('vo.crowd_id = '.$id." AND vo.status in (1,3) AND vt.is_agree = 0")
            ->count('vo.id');//投不赞成票的人数
        $agree_vote_rate = intval(($agree_people/$need_vote_people)*100);
        $not_agree_vote_rate = intval(($not_agree_people/$need_vote_people)*100);
        $has_vote_people = $agree_people + $not_agree_people;
        foreach($vote_list as $key=>$v) {
            if ($vote_list[$key]['deadline'] > time()) {
                $vote_list[$key]['vote_remain_time'] = $vote_list[$key]['deadline'] - time();
            } else {
                $vote_list[$key]['vote_remain_time'] = 0;
            }
        }
        $this->assign('agree_people',$agree_people);
        $this->assign('not_agree_people',$not_agree_people);
        $this->assign('agree_vote_rate',$agree_vote_rate);
        $this->assign('not_agree_vote_rate',$not_agree_vote_rate);
        $this->assign('has_vote_people',$has_vote_people);
        $this->assign('vote_list',$vote_list);

        $this->assign('is_start',$is_start);
        //用户账户资金情况
        $this->assign("investInfo", getMinfo($this->uid,true));
        $this->assign("invid",$invsx);
        //dump($list[0]);
        $this->assign('crowd_info',$list[0]);
        
        // 判断本用户是否在此众筹项目中已使用红包
        $invest_data['uid'] = $this->uid;
        $invest_data['borrow_id'] = $id;
        $invest_data['status'] = 2;
        $use_num = M('pay_bid_userlog')->where($invest_data)->count('id');
        $this->assign('use_num',$use_num);
        
        // 红包列表（每个项目仅允许使用一个红包）
        if($use_num == 0){
            $bid_list=M('pay_bid_userlog')->field('id,pay_money,bid_money')->where('uid='.$this->uid.' and status=1')->select();
            $this->assign("bid",$bid_list);
        }
        
        $this->display();
    }
    
    public function invest()
    {
        if(!$this->uid){
            if($this->isAjax()){
                ajaxmsg("请先登录后投资",3);
            }else{
                $this->redirect('M/pub/login');
            }
        }
        if($this->isAjax()){   // ajax提交投资信息
            //var_dump(date('Y-m-d H:i:s','1463643624'));
            //var_dump(strtotime('2016-05-19 15:40:25'));
            $pin = md5($this->_post('paypass'));//获取过来的支付密码
            $crowd_id = intval($this->_post('crowd_id'));//标id
            $money = intval($this->_post('invest_money'));//获取过来的投资金额

            $add_time=M('crowd_investor')->where('crowd_id='.$crowd_id.' and user_id='.$this->uid)->order('id DESC')->getField('add_time');
            if((time()-$add_time)<10){
                ajaxmsg("每次众筹间隔10秒!",3);
            }

            $c_id = intval($this->_post('c_id'));//红包id
            $vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
            $amoney = $vm['account_money']+$vm['back_money'];
            $uname = session('u_user_name');
            $pin_pass = $vm['pin_pass'];//支付密码
            $amoney = floatval($amoney);//用户总资金
            $crowd_info =  M('crowd_info')->where("id = ".$crowd_id)->find();
            if($crowd_info['status'] !=1){
                ajaxmsg("该众筹非众筹中，无法认筹!",3);
            }
            //获取该用户已经投了该标多少钱
            $crowd_all_money = M('crowd_info')->where("id = ".$crowd_id)
                ->sum('crowd_money');//该标总共多少钱
            $has_invest = M('crowd_investor')->where("crowd_id = ".$crowd_id." AND user_id = ".$this->uid)
                ->sum('capital');//该用户已经投资该标多少钱
            $xtee = ($crowd_all_money/2) - $has_invest;//该用户还可以投资多少钱
            $remain_invest_money = $crowd_info['crowd_money']-$crowd_info['has_crowd_money'];//该众筹还剩多少满标
            if($has_invest > ($crowd_all_money/2)){
                ajaxmsg("您已众筹{$has_invest}元,已经达到该众筹单用户最大投资限额",3);
            }
            if($money > $xtee){
                ajaxmsg("单个众筹单个用户最多投资众筹金额的50%,您已投标{$has_invest}元,该众筹你最多只能再投{$xtee}元",3);
            }

            if($money > $remain_invest_money){
                ajaxmsg("该众筹还剩{$remain_invest_money}元可投,小于您要众筹的金额，请重新输入众筹金额！",3);
            }
            if(($crowd_info['min_money']-$money)>0 ){
                $this->error("尊敬的{$uname}，该众筹最低众筹金额为{$crowd_info['min_money']}元，请重新输入众筹金额",3);
            }
            if(($money%100)!=0){
                ajaxmsg("投资金额必须为100的整数倍,请重新输入投资金额!",3);
            }
            if((($crowd_info['crowd_money']-$crowd_info['has_crowd_money']-$money)<$crowd_info['min_money']) && (($crowd_info['crowd_money']-$crowd_info['has_crowd_money']-$money)!=0)){
                ajaxmsg("投资金额不正确，您投资后剩余金额将小于最小投资额，您现在只能一次性投满或者放弃投资!",3);
            }
            if($pin<>$pin_pass) ajaxmsg("支付密码错误，请重试!",3);
            if($money > $amoney){
                $msg = "尊敬的{$uname}，您准备投标{$money}元，但您的账户可用余额为{$amoney}元，请先充值!";
                ajaxmsg($msg,3);
            }
            $done = crowdInvest($this->uid,$crowd_id,$money,0,$c_id);
            if($done){
                $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$this->uid)->find();
                addInnerMsg($this->uid,"恭喜认筹成功","尊敬的".$userinfo['user_name']."，您好，您成功对".$_POST['crowd_id']."号众筹投资".$money."元");//发送站内信
                SMStip("crowdinvest",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$_POST['crowd_id'],$money));//发送短信
               ajaxmsg('恭喜投资成功！',1);
            }else{
                ajaxmsg('投资失败！',3);
            }
        }else{
            $crowd_id = $this->_get('bid');
            $crowd_info = M("crowd_info")
                ->field(true)
                ->where("id='{$crowd_id}'")
                ->find();
            $this->assign('crowd_info', $crowd_info);

            $user_info = M('member_money')
                ->field("account_money+back_money as money ")
                ->where("uid='{$this->uid}'")
                ->find();
            $this->assign('user_info', $user_info);
            $paypass = M("members")->field('pin_pass')->where('id='.$this->uid)->find();
            $this->assign('paypass', $paypass['pin_pass']);
            $this->assign('crowd_id',$crowd_id);
            $this->display();
        }
    }
    public function vote_set()
    {
        $crowd_id = $_POST['crowd_id'];//众筹标ID
        $vote_id = M('crowd_voting')->where('crowd_id = '.$crowd_id)->order('id desc')->limit(1)->find();//查出最新的一次投票，未经测试
        if($vote_id['deadline']<=time()){
            //投票率大于50%
            if($vote_id['failure']<0.5){
                $voting_status['status']=3;
            }else if($vote_id['failure']==0.5){
                $count=M('crowd_investor')->where('crowd_id='.$vote_id['crowd_id'])->count('distinct  user_id');
                if($vote_id['not_agree_people']*2<$count){
                    $voting_status['status']=3;
                }else{
                    $voting_status['status']=2;
                }
            }else{
                $voting_status['status']=2;
            }
            $voting_save=M('crowd_voting')->where('id='.$vote_id['id'])->save($voting_status);
            if(($voting_status['status']==3) && $voting_save ){
                M('crowd_info')->where('id='.$vote_id['crowd_id'])->save(array('status'=>4));
                $vote_id = M('crowd_voting')->where('id='.$vote_id['id'])->find();
                if($voting_status['status']=3){
                    //给每个投资用户发送短信
                    $sql1="SELECT DISTINCT user_id FROM nuomi_crowd_investor WHERE crowd_id =".$val['crowd_id'];
                    $model1=M();
                    $arr1 = $model1->query($sql1);
                    foreach($arr1 as $key=>$v){
                        $user_id = $arr1[$key]['user_id'];
                        $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$user_id)->find();
                        addInnerMsg($user_id,"您投资的众筹投票通过！","尊敬的".$userinfo['user_name']."，您好，您投资的".$val['crowd_id']."号众筹众筹投票成功！投票金额".$vote_id['vote_money'].",该众筹正在回款中！");//发送站内信
                        SMStip("crowdvotesucc",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$val['crowd_id'],$vote_id['vote_money']));//发送短信
                    }
                }elseif($voting_status['status']=2){
                    $sql1="SELECT DISTINCT user_id FROM nuomi_crowd_investor WHERE crowd_id =".$val['crowd_id'];
                    $model1=M();
                    $arr1 = $model1->query($sql1);
                    foreach($arr1 as $key=>$v){
                        $user_id = $arr1[$key]['user_id'];
                        $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$user_id)->find();
                        addInnerMsg($user_id,"您投资的众筹投票未成功通过！","尊敬的".$userinfo['user_name']."，您好，您投资的".$val['crowd_id']."号众筹众筹投票失败！投票金额".$vote_id['vote_money']);//发送站内信
                        SMStip("crowdvotefail",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$val['crowd_id'],$vote_id['vote_money']));//发送短信
                    }
                }
                ajaxmsg("投票结束!",1);
            }
        }
    }
    public function vote()
    {
        $pre = C('DB_PREFIX');
        if(!$this->uid) {
            ajaxmsg('请先登录后再投票!',2);
            exit;
        }
        $need_vote_people = $_POST['need_vote_people'];
        $crowd_vote = D('crowd_voting');

        $is_agree = $_POST['vote'];//1表示赞成  2表示反对
        $crowd_id = $_POST['crowd_id'];//众筹标ID
        $crowd_status = M('crowd_info')->field('status')->where('id = '.$crowd_id)->find();//获取该众筹所处状态
        if($crowd_status['status']!=3){
            //不在投票中状态
            ajaxmsg("该众筹非投票中状态，不能投票！",2);
        }
        //根据众筹ID 查出投票最新的一次投票
        $vote_id = M('crowd_voting')->where('crowd_id = '.$crowd_id)->order('id desc')->limit(1)->find();//查出最新的一次投票，未经测试
        if(!$vote_id){
            ajaxmsg("该众筹还未发起投票，不能投票！",2);
        }
        if($vote_id['status'] != 1){
            ajaxmsg("该众筹投票已经结束！",2);
        }
        //查一下该用户是否投资过该众筹，是否允许可以投票
        $user_id = $this->uid;//当前用户ID
        $is_can_vote = M('crowd_investor')->where('crowd_id = '.$crowd_id." AND user_id = ".$user_id)->find();
        if(!$is_can_vote){
            ajaxmsg("您未参与该众筹，不能投票！",2);
        }
        //算出投资所占比重
        $vote_ratio = M('crowd_investor')->where('crowd_id = '.$crowd_id." AND user_id = ".$user_id)->sum("ratio");
        //判断该用户是否已经投过票
        $is_has_vote = M('crowd_vote_detail')->where('vote_id = '.$vote_id['id']." AND user_id = ".$user_id)->find();
        if($is_has_vote){
            $is_agree_str = $is_has_vote['is_agree']==1?"赞成":"反对";
            ajaxmsg("您已经投过".$is_agree_str."票,不能重复投票！",2);
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
                if($not_agree_people >= $half_people){
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
            ajaxmsg("投票成功！",1);
        }else{
            $crowd_vote->rollback();
            ajaxmsg("投票失败！",3);
        }

    }
}