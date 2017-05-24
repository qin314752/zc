<?php
/**
 * User: Administrator
 */
class CrowdInvestAction extends HCommonAction{
    public function index(){
        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
        else{
        static $newpars;
        $curl = $_SERVER['REQUEST_URI'];
        $urlarr = parse_url($curl);
        parse_str($urlarr['query'],$surl);//array获取当前链接参数，2.
        $urlArr = array('crowd_money','car_type','crowd_status');
        foreach($urlArr as $v){
            $newpars = $surl;//用新变量避免后面的连接受影响
            unset($newpars[$v],$newpars['type'],$newpars['order_sort'],$newpars['orderby']);//去掉公共参数，对掉当前参数
            foreach($newpars as $skey=>$sv){
                if($sv=="all") unset($newpars[$skey]);//去掉"全部"状态的参数,避免地址栏全满
            }

            $newurl = http_build_query($newpars);//生成此值的链接,生成必须是即时生成
            $searchUrl[$v]['url'] = $newurl;
            $searchUrl[$v]['cur'] = empty($_GET[$v])?"all":text($_GET[$v]);
        }

        $searchMap['crowd_money'] = array("all"=>"不限","0-15"=>"15万以下","15-30"=>"15万-30万","30-50"=>"30万-50万","50-100"=>"50万-100万","100-9999999999999999"=>"100万以上");
        $searchMap['car_type'] = array("all"=>"不限","1"=>"轿车","2"=>"SUV/越野车","3"=>"MPV","4"=>"跑车","5"=>"皮卡","6"=>"其他");
        $searchMap['crowd_status'] = array("all"=>"不限","7"=>"即将上线","1"=>"众筹中","2"=>"出售中","3"=>"投票中","4"=>"待回款","5"=>"已售出" ,"8"=>"溢价回购");

        $search = array();
        //搜索条件
        foreach($urlArr as $v){
            if($_GET[$v] && $_GET[$v]<>'all'){
                switch($v){
                    case 'crowd_money':
                        $barr = explode("-",text($_GET[$v]));
                        foreach($barr as $key=>$v){
                            $barr[$key] = $v*10000;
                        }
                        $search["ci.crowd_money"] = array("between",$barr);
                        break;
                    case 'car_type':
                        $search["ci.".$v] = intval($_GET[$v]);
                        break;
                    case 'crowd_status':
                        if(intval($_GET[$v])==7){
                            $search['ci.start_time'] = array('gt',time());
                        }elseif(intval($_GET[$v])==5){
                            $search["ci.status"] = array('in','5');
                            $search['ci.start_time'] = array('lt',time());
                        }elseif(intval($_GET[$v])==8){
                            $search["ci.status"] = array('in','8,9');
                            $search['ci.start_time'] = array('lt',time());
                        }
                        else{
                            $search["ci.status"] = intval($_GET[$v]);
                            $search['ci.start_time'] = array('lt',time());
                        }
                        break;
                }
            }
        }
        if($search['ci.status'] == ''){
            $search['ci.status'] = array('neq',6);
        }
        import("ORG.Util.Page");

        //分页
        $size=8;
        $count = M('crowd_info ci')->where($search)->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $list = M('crowd_info ci')->order('id DESC')->where($search)->limit($Lsql)->select();
        //dump(M('crowd_info ci')->getLastSql());
		//var_dump($list);exit;
        $imgarray = array();
        $imgarray[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        foreach($list as $key=>$v){
            //查询每个众筹的投票金额
             $list_vote= M('crowd_voting')->where('crowd_id = '.$list[$key]['id'].' AND status = 3')->find();
            $list[$key]['vote_money'] = $list_vote['vote_money'];
            $list[$key]['img']=unserialize($list[$key]['crowd_picture'])?unserialize($list[$key]['crowd_picture']):$imgarray;
            $list[$key]['rate'] = round((($list[$key]['has_crowd_money']/ $list[$key]['crowd_money'])*100),2);
            if($list[$key]['start_time'] > time()){
                $list[$key]['is_start'] = 0;
                $list[$key]['auto_remain_time'] = $list[$key]['start_time']-time();
            }else{
                $list[$key]['is_start'] = 1;//开始认筹中
                $list[$key]['auto_remain_time']=0;
            }
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
			if($list[$key]['status'] == 1){
				$list[$key]['status_name'] = '众筹中';
			}elseif($list[$key]['status'] == 2){
				$list[$key]['status_name'] = '出售中';
			}elseif($list[$key]['status'] == 3){
				$list[$key]['status_name'] = '投票';
			}elseif($list[$key]['status'] == 4){
				$list[$key]['status_name'] = '待回款';
			}elseif($list[$key]['status'] == 5){
				$list[$key]['status_name'] = '已完成';
			}elseif($list[$key]['status'] == 6){
				$list[$key]['status_name'] = '筹标未满';
			}elseif($list[$key]['status'] == 7){
				$list[$key]['status_name'] = '预告';
			}elseif($list[$key]['status'] == 8){
				$list[$key]['status_name'] = '溢价回购';
			}elseif($list[$key]['status'] == 9){
				$list[$key]['status_name'] = '溢价回购完成';
			}
			
			
			
            $list[$key]['remain_time'] = $remain_time;//剩余时间
			//max_duration *30
			$list[$key]['max_duration'] = $list[$key]['max_duration']*30;
            //众筹记录以及众筹人次
            $crowd_record = M('crowd_investor')->where('crowd_id = '. $list[$key]['id']." AND status = 1")->select();
            $record_count = count($crowd_record);//众筹人次
            $list[$key]['record_count'] = $record_count;
            $difftime = ceil(round((($v['back_time']-$v['full_time'])/86400),4));//间隔多少天
            $list[$key]['wan_receive'] = round((($list[$key]['vote_money']-$list[$key]['crowd_money'])*$list[$key]['repayment_ratio']/100)*(10000/$list[$key]['crowd_money'])/$difftime,2);
			
			$list[$key]['back_rate1'] = $list[$key]['back_rate'];
            $interest = round((($list[$key]['vote_money']-$list[$key]['crowd_money'])*$list[$key]['repayment_ratio']/100),4);
            $list[$key]['back_rate'] = intval(((($interest/$v['crowd_money'])/$difftime)*360*100));
            $list[$key]['diffday'] = $difftime;
            if($list[$key]['status']==5){
                $list_voting= M('crowd_voting')->where('crowd_id = '.$list[$key]['id'].' AND status = 3')->find();
                $back_rate=M('crowd_info')->field('back_rate')->find($list[$key]['id']);
                $sy_time=ceil(($list[$key]['back_time']-$list[$key]['full_time'])/(3600*24));
                $sy=$list_voting['vote_money']-$list_voting['crowd_money'];

                //众筹收益X分配比例X360
                //众筹金额X（回款时间-满标时间）
                $list[$key]['voting']=round(($sy*$back_rate['back_rate']/100*360)/($list_voting['crowd_money']*$sy_time)*100,2);
                //$list[$key]['voting']=round(($list_voting['vote_money']-$list_voting['crowd_money'])/$list_voting['crowd_money']/$sy_time*360,2);
            }
			
        }
        $this->assign("searchMap",$searchMap);
        $this->assign("searchUrl",$searchUrl);
        $this->assign("list",$list);
        //dump($list);exit;
        $this->assign("page",$page);
       // dump($searchUrl);
	   
	   
        }
		 //带图片的合作机构
        $link_img = M('friend')->field('link_txt,link_href,link_img,link_type')->where("link_img!='' AND type = 1")->order("link_order DESC")->select();
        // dump($link_img->getLastSql());
        $this->assign('link_img',$link_img);
        $this->display();
    }

    public function ajax_remain(){
        $crowd_id = $_POST['crowd_id'];
        $crowd_info = M('crowd_info')->where('id = '.$crowd_id)->find();
        if($crowd_info['start_time'] > time()){
            $crowd_remain_time = $crowd_info['start_time']-time();
        }else{
            $crowd_remain_time = 0;
        }
        $data['seconds'] = $crowd_remain_time;
        ajaxmsg($data);
    }
    public function detail()
    {
        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
        else{
        $pre = C('DB_PREFIX');
        $id = intval($_GET['id']);
        $list = M('crowd_info')->where('id = '.$id)->select();
        $imgarray = array();
        $imgarray[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        foreach($list as $key=>$v){
            $list[$key]['img']=unserialize($list[$key]['crowd_picture'])?unserialize($list[$key]['crowd_picture']):$imgarray;
            $list[$key]['rate'] = round((($list[$key]['has_crowd_money']/ $list[$key]['crowd_money'])*100),2);
            $list[$key]['remain_crowd_money'] = round((($list[$key]['crowd_money']- $list[$key]['has_crowd_money'])),2);
            $list[$key]['count_img'] = count($list[$key]['img']);
            if($list[$key]['car_dealer']){
                //$car_dealer=M('article')->field('title')->find($list[$key]['car_dealer']);
                $car_dealer=M('article')->field('title')->find($list[$key]['car_dealer']);
                $list[$key]['car_dealer']=$car_dealer['title'];
            }

            if($list[$key]['status']==5){
//                $list_voting= M('crowd_voting')->where('crowd_id = '.$list[$key]['id'].' AND status = 3')->find();
//                $list[$key]['voting']=round(($list_voting['vote_money']/$list_voting['crowd_money'])*100,2);

                $list_voting= M('crowd_voting')->where('crowd_id = '.$list[$key]['id'].' AND status = 3')->find();
                $back_rate=M('crowd_info')->field('back_rate')->find($list[$key]['id']);
                $sy_time=ceil(($list[$key]['back_time']-$list[$key]['full_time'])/(3600*24));
                $sy=$list_voting['vote_money']-$list_voting['crowd_money'];

                //众筹收益X分配比例X360
                //众筹金额X（回款时间-满标时间）
                $list[$key]['voting']=round(($sy*$back_rate['back_rate']/100*360)/($list_voting['crowd_money']*$sy_time)*100,2);



            }
        }
        //判断是否登录，以及是否是自己的标
        if($this->uid){
            $invsx='yes';
            $this->assign('user_id',$this->uid);
            $user_capital=M('crowd_investor')->where('crowd_id='.$id.' and user_id='.$this->uid)->sum('capital');
            $this->assign('user_capital',$user_capital);

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
        //是否开始认筹中
        if($list[0]['start_time'] > time()){
            $is_start = 0;
        }else{
            $is_start = 1;//开始认筹
        }
        $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
        $crowd_status =$Bconfig['CROWD_STATUS'];
        $list[0]["status_info"] = $crowd_status[$list[0]['status']];//该众筹的状态

        //众筹记录
        // 投资记录
        $this->investRecord($id);
        $this->assign('crowd_id', $id);
        //计算出总共需要几个人投票，单人多次投资，算一个人
        $sql = "SELECT COUNT(DISTINCT user_id) as count FROM nuomi_crowd_investor WHERE crowd_id =".$id;
        $model = M();
        $arr =$model->query($sql);               //需要几个人投票
        $need_vote_people = $arr[0]['count'];//总共需要投票的人数
        $this->assign("need_vote_people",$need_vote_people);
        //查出该众筹的投票记录以及投票百分比
        $vote_list = M('crowd_voting vo')
            ->join("{$pre}crowd_vote_detail vt ON vt.vote_id = vo.id")
            ->where('vo.crowd_id = '.$id." AND vo.status in (1,3)")
            ->select();//投票列表
        $agree_people_arr = M('crowd_voting vo')
            ->join("{$pre}crowd_vote_detail vt ON vt.vote_id = vo.id")
            ->where('vo.crowd_id = '.$id." AND vo.status in (1,3) AND vt.is_agree = 1")
            ->select();//投赞成票的人数
        $agree_arte = 0;
        foreach($agree_people_arr as $key=>$v){
            $agree_arte+=$v['ratio'];
        }
        $agree_people = count($agree_people_arr);
        $not_agree_people_arr = M('crowd_voting vo')
            ->join("{$pre}crowd_vote_detail vt ON vt.vote_id = vo.id")
            ->where('vo.crowd_id = '.$id." AND vo.status in (1,3) AND vt.is_agree = 0")
            ->select();;//投不赞成票的人数
        $not_agree_people = count($not_agree_people_arr);
        //dump($not_agree_people_arr);
        $not_agree_rate = 0;
        foreach($not_agree_people_arr as $key=>$v){
            $not_agree_rate+=$v['ratio'];
        }
        //$agree_vote_rate = intval(($agree_people/$need_vote_people)*100);
       // $not_agree_vote_rate = intval(($not_agree_people/$need_vote_people)*100);
        $agree_vote_rate = round(($agree_arte*100),2);
        $not_agree_vote_rate = round(($not_agree_rate*100),2);
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
        //dump($list);
        $this->assign('crowd_info',$list);
        
		//红包
		$hongbao = M(pay_bid_userlog)->where(array('uid'=>$this->uid))->select();
		$this->assign('hongbao',$hongbao);
		
        }
        if($this->uid){

            $cou=M('pay_bid_userlog')->where('uid='.$this->uid.' and crowd_id='.$id)->count();
            //每个用户对应每个众筹只可以用一个红包
            if($cou==0){
                $bid_list=M('pay_bid_userlog')->field('id,pay_money,bid_money')->where('uid='.$this->uid.' and status=1')->select();
                $this->assign("bid",$bid_list);
            }
            $p_list=M('pay_bid_userlog')->where('uid='.$this->uid.' and status=1')->select();
            foreach($p_list as $p){
                if(time()>$p['end_time'])
                    $userlog= M('pay_bid_userlog')->where('id='.$p['id'])->save(array('status'=>3));
                if($userlog) {
                    $c_data['pid'] = $p['id'];
                    $c_data['uid'] = $p['uid'];
                    $c_data['add_time'] = time();
                    $c_data['info'] = "红包" . $p['bid_money'] . "元有效期已过";
                    $c_data['money'] = $p['bid_money'];
                    $c_data['status'] = 3;
                    M('crowd_user_log')->add($c_data);
                }
            }
        }
        $this->display();
    }
    public function investRecord($crowd_id=0)
    {
        isset($_GET['crowd_id']) && $crowd_id = intval($_GET['crowd_id']);
        $Page = D('Page');
        $pre = C('DB_PREFIX');
        import("ORG.Util.Page");
        $size=10;
        $count = M('crowd_investor')
            ->where('crowd_id = '.$crowd_id)->count('id');

        $Page = new Page($count,$size);
        $show = $Page->ajax_show();

        $repayment_ratio=M('crowd_info')->field('repayment_ratio,max_duration')->find($crowd_id);

        $this->assign('ajaxpage',$show);
        $statearr = array("1"=>"众筹中","2"=>"出售中","3"=>"投票中","4"=>"待回款","5"=>"已出售" ,"6"=>"溢价回购");
        $crowd_type = array('0'=>'手动','1'=>'自动');
        if($_GET['crowd_id']){
            $Lsql = "{$Page->firstRow},{$Page->listRows}";
            $record_list = M('crowd_investor ci')
                ->field("ci.*,m.user_name,cf.status as cfstatus,cf.start_time,cf.has_crowd_money,cf.repayment_ratio,cf.max_duration")
                ->join("{$pre}members m ON m.id = ci.user_id")
                ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
                //->join("{$pre}crowd_voting vo ON vo.crowd_id= cf.id")
                ->order('id DESC')
                ->where('ci.crowd_id = '.$crowd_id)
                ->limit($Lsql)
                ->select();

            foreach($record_list as $key=>$v){
                $voting=M('crowd_voting')->field('vote_money')->where('crowd_id='.$v['crowd_id'])->order('id DESC')->limit(1) ->find();
                $record_list[$key]['vote_money']=$voting['vote_money'];
                if($v['cfstatus']==5){
                    $record_list[$key]['receive'] = round(($record_list[$key]['ratio']*round(($record_list[$key]['repayment_ratio']/100),4)*round(($record_list[$key]['vote_money']-$record_list[$key]['has_crowd_money']),4)),4);//预期收益

                }else{
                    //投资本金*(溢价率/12)*该众筹最长持有期限)
                    $record_list[$key]['receive'] = round($record_list[$key]['capital']*($record_list[$key]['repayment_ratio']*0.01/12)*$record_list[$key]['max_duration'],2);//预期收益

                }

            };

            $string = '';
            if($record_list[0]['start_time'] > time()){
                $string = "暂时没有投资记录";
                echo $string;
            }else{
                foreach($record_list as $k=>$v){
                    //添加收益金额
                   // $v['receive'] = round(($v['ratio']*round(($v['repayment_ratio']/100),4)*round(($v['vote_money']-$v['has_crowd_money']),4)),4);//预期收益

                    $string .="<tr>";
                    $string .="<td class='td2'>".($k+1)."</td>";
                    $string .="<td class='td2'>".hidecard($v['user_name'],5)."</td>";
                    $string .="<td class='td2'>".$v['capital']."</td>";
                    $string .="<td class='td2'>".date("Y-m-d H:i",$v['add_time'])."</td>";
                    if($v['receive']>0){
                        $string .="<td class='td2'>". $statearr[$v['cfstatus']]."收益金额".$v['receive']."元</td>";
                    }else{
                        $string .="<td class='td2'>". $statearr[$v['cfstatus']]."</td>";
                    }
                    $string .="<td class='td2'>".$crowd_type[$v['type']]."</td>";
                    $string .="</tr>";
                }
                echo empty($string)?'暂时没有投资记录':$string;
            }
        }
    }
    public function ajax_invest(){
        $crowd_id = $_GET['id'];
        $money = $_GET['money'];
        $vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');//用户信息
		$crowd_info =  M('crowd_info')->where("id = ".$crowd_id)->find();// 众筹密码
        $this->assign("mima",(empty($crowd_info['mima']))?'no':'yess');// 众筹密码
        $this->assign("has_pin", (empty($vm['pin_pass']))?'no':'yes');
        $this->assign("investMoney", intval($money));
        $this->assign("id", intval($crowd_id));
        $this->assign("crowd_id",intval($_GET['crowd_id']));
        $data['content'] = $this->fetch();
        ajaxmsg($data);
    }
    public function investcheck(){
        $pre = C('DB_PREFIX');
        if(!$this->uid) {
            ajaxmsg('请先登录',3);
            exit;
        }
		
        $pin = md5($_POST['pin']);//获取过来的支付密码
        $crowd_id = intval($_POST['crowd_id']);//标id
        $money = intval($_POST['money']);//获取过来的投资金额
        $vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
        $amoney = $vm['account_money']+$vm['back_money'];
        $uname = session('u_user_name');
        $pin_pass = $vm['pin_pass'];//支付密码
        $amoney = floatval($amoney);//用户总资金
        $crowd_info =  M('crowd_info')->where("id = ".$crowd_id)->find();
        if($crowd_info['status'] !=1){
            ajaxmsg("该众筹非众筹中，无法认筹!",3);
        }
        if($crowd_info['user_id'] == $this->uid){
            ajaxmsg("不能投自己发起的众筹!",3);
        }
		if($crowd_info['mima'] != ""){
			if($crowd_info['mima'] != MD5($_POST['mima'])){
				ajaxmsg("众筹密码错误!",3);
			}
		}
        //获取该用户已经投了该标多少钱
        $crowd_all_money = M('crowd_info')->where("id = ".$crowd_id)
            ->sum('crowd_money');//该标总共多少钱
        $has_invest = M('crowd_investor')->where("crowd_id = ".$crowd_id." AND user_id = ".$this->uid)
            ->sum('capital');//该用户已经投资该标多少钱
        $xtee = ($crowd_all_money/2) - $has_invest;//该用户还可以投资多少钱
        $remain_invest_money = $crowd_info['crowd_money']-$crowd_info['has_crowd_money'];//该众筹还剩多少满标
        if($has_invest <= 0){
            $has_invest=0;
        }
        //if($has_invest > ($crowd_all_money/2)){
         //   ajaxmsg("您已投标{$has_invest}元,已经达到该众筹单用户最大投资限额",3);
        //}
		
       // if($money > $xtee){
        //    ajaxmsg("单个众筹单个用户最多投资众筹金额的50%,您已投标{$has_invest}元,该众筹你最多只能再投{$xtee}元",3);
        //}
		
        //if(($money%100)!=0){
          //  ajaxmsg("投资金额必须为起投金额的整数倍,请重新输入投资金额!",3);
       // }
        if($money > $remain_invest_money){
            ajaxmsg("该众筹还剩{$remain_invest_money}元可投,小于您要投资的金额，请重新输入投资金额！",3);
        }
        if($money <= 0){
            ajaxmsg("众筹金额异常，请重新输入投资金额！",3);
        }
        // if(($crowd_info['min_money']-$money)>0 ){
        //     $this->error("尊敬的{$uname}，本标最低投标金额为{$crowd_info['min_money']}元，请重新输入投标金额");
        // }
        if($pin<>$pin_pass) ajaxmsg("支付密码错误，请重试!",0);
        if($money > $amoney){
            $msg = "尊敬的{$uname}，您准备投标{$money}元，但您的账户可用余额为{$amoney}元，您要先去充值吗？";
            ajaxmsg($msg,2);
        }else{
			        $msg = "尊敬的{$uname}，您的账户可用余额为{$amoney}元，您确认投标{$money}元吗？";
                    ajaxmsg($msg,1);	
        }
        ajaxmsg($msg,1);
    }
    //众筹投资
    public function investmoney(){

        $data['crowd_id']=$_POST['crowd_id'];
        if(!empty($_POST['c_id'])) $c_id=$_POST['c_id'];
		
		$data['user_id']=$this->uid;
        $data['status']=1;
        $money=$_POST['money'];
        $info=M('crowd_info')->find($_POST['crowd_id']);
        //用户投资总金额
        $user_invest=M('crowd_investor')->field('sum(capital) as money')->where($data)->select();
        if($info['user_id'] == $this->uid) $this->error("不能投自己发起的众筹！");
        //if($money<100) $this->error("投资金额最低为100元");
        //if(($money%100)!=0) $this->error("投资金额必须为最小投资金额的倍数");
        if($info['start_time']>time()) $this->error("众筹还未开始");
        if($info['status']<>1) $this->error("众筹还未开始或已经结束");
//        if(($user_invest[0]['money']+$money)>($info['crowd_money']*0.5)) $this->error("个人最多投资额度为总金额的50%");
        if(($info['crowd_money']-$info['has_crowd_money'])<$money) $this->error("投资金额大于众筹剩余金额");

	  
         $done = crowdInvest($this->uid,$_POST['crowd_id'],$money,0,$c_id);
         if($done){
			//邀请奖励
			if($userinfo['recommend_id'] != '') {

                $bili = M('global')->field('text')->where(array('id'=>93))->find();    
                $ticheng = $bili['text']/1000*$money;               //千分之
                $ticheng = round($ticheng,2);
                
               $tuijianmoney = M('member_money')->where(array('uid'=>$userinfo['recommend_id']))->setInc('account_money',$ticheng);
               $member_money = M('member_money')->field('account_money')->where(array('uid'=>$userinfo['recommend_id']))->find();
               $where['uid']  = $userinfo['recommend_id'];   //用户id
               $where['type'] = 13;               //类型
               $where['affect_money'] = $ticheng;      //影响金额
               $where['account_money'] = $member_money['account_money'];//可用余额 
               $where['back_money'] = 0.00;//回款资金存放池_可用余额
               $where['collect_money'] = 0.00;//代收金额
               $where['freeze_money'] = 0.00;  //冻结金额
               $where['info']    = '推荐好友成功奖励'.$ticheng.'元';//描述
               $where['add_time'] =  time();//添加时间
               $where['add_ip'] = $_SERVER["REMOTE_ADDR"];//添加ip
               $where['target_uid'] = 0;//管理员操作
               $where['target_uname'] = $userinfo['user_name'];  //交易对方
               $where['tag'] = 0;
               M('member_moneylog')->add($where);
            } 
			 
            $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$this->uid)->find();
            addInnerMsg($this->uid,"恭喜认筹成功","尊敬的".$userinfo['user_name']."，您好，您成功对".$_POST['crowd_id']."号众筹投资".$money."元");//发送站内信
            SMStip("crowdinvest",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($userinfo['user_name'],$_POST['crowd_id'],$money));//发送短信
            $this->success("恭喜成功投资{$money}元");
        }else{
            $this->success("投资失败");
        }

    }
    public function vote_set()
    {
        $crowd_id = $_POST['crowd_id'];//众筹标ID
        $vote_id = M('crowd_voting')->where('crowd_id = '.$crowd_id)->order('id desc')->limit(1)->find();//查出最新的一次投票，未经测试
        if($vote_id['deadline']<=time()){
            //投票率大于50%
         if(($vote_id['failure']<0.5 && $vote_id['failure']>0) || ($vote_id['ratio']>0.5 || $vote_id['ratio']>0)){
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
            ajaxmsg("投票成功！",3);
        }else{
            $crowd_vote->rollback();
            ajaxmsg("投票失败！",3);
        }

    }
}