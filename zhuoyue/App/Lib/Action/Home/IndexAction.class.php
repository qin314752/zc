<?php
// 金糯米内核类库，2014-06-11_listam
class IndexAction extends HCommonAction {
    public function index(){//exit('index');

        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
        $per = C('DB_PREFIX');
        $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
      //最新
        $parm['type_id'] = 9;
        $parm['limit'] =5;
        $this->assign("noticeList",getArticleList($parm));
	 //工作日志
	    $parm['type_id'] = 58;
		$parm['limit'] =5;
		$this->assign("job",getArticleList($parm));
	 //发标公告
        $parm['type_id'] = 54;
        $parm['limit'] =1;
        $this->assign("fabiaoList",getArticleList($parm));
	//发标公告6个
        $parm['type_id'] = 54;
        $parm['limit'] =6;
        $this->assign("fabiaoList2",getArticleList($parm));
	//项目预告6个
        $parm['type_id'] = 64;
        $parm['limit'] =6;
        $this->assign("yunyinglist",getArticleList($parm));
    //网站公告
    //项目动态
        $parm['type_id'] = 51;
        $parm['limit'] =5;
        $this->assign("productlist",getArticleList($parm));
        //项目动态
        //媒体报道
        $parm['type_id'] = 47;
        $parm['limit'] =5;
        $this->assign("MnoticeList",getArticleList($parm));
        //媒体报道
        //新闻动态
        $parm['type_id'] = 65;
        $parm['limit'] =6;
        //dump(getArticleList($parm));
        $this->assign("NnoticeList",getArticleList($parm));
		//新闻动态
        //投资指南
        $parm['type_id'] = 48;
        $parm['limit'] =6;
        $this->assign("GnoticeList",getArticleList($parm));
        //投资指南
        //平台用户总数
        $members = M('members')->count('id');
        $this->assign('members',$members);
        //平台用户总数
        //投资排行榜
        $bangdan_list = M("member_moneylog s1")->field("sum(s1.affect_money) affect_money,s2.user_phone,s1.uid")->join("{$per}members s2 on s1.uid = s2.id")->where("s1.type in (15,39,171,172,173)")->group("s1.uid")->order("affect_money desc")->limit("5")->select();
        //dump($bangdan_list);
        $this->assign("bangdan_list",$bangdan_list);
	 //投资排行  本月  
		  $sql = "SELECT a.`user_id`,SUM(a.`capital`) AS capitals,a.`add_time`,b.* FROM nuomi_crowd_investor AS a 
			INNER JOIN nuomi_members AS b ON a.`user_id` = b.`id` 
			WHERE FROM_UNIXTIME(a.`add_time`,'%Y-%m') = DATE_FORMAT(NOW(),'%Y-%m')
			GROUP BY a.`user_id` 
			ORDER BY SUM(a.`capital`) DESC LIMIT 0,6";
	       $benyue = M('crowd_investor')->query($sql);
          
		  $this->assign('benyue',$benyue);
		  
		 //投资排行 本周
		   $sql = "SELECT a.`user_id`,SUM(a.`capital`) AS capitals,a.`add_time`,b.* FROM nuomi_crowd_investor AS a 
				INNER JOIN nuomi_members AS b ON a.`user_id` = b.`id` 
				WHERE YEARWEEK(FROM_UNIXTIME(a.`add_time`,'%Y-%m-%d')) = YEARWEEK(NOW())
				GROUP BY a.`user_id` 
				ORDER BY SUM(a.`capital`) DESC LIMIT 0,6";
			
			$benzhou = M('crowd_investor')->query($sql);
			
		    $this->assign('benzhou',$benzhou);
			
		//投资排行 今天
		  $sql = "SELECT a.`user_id`,SUM(a.`capital`) AS capitals,a.`add_time`,b.* FROM nuomi_crowd_investor AS a 
				INNER JOIN nuomi_members AS b ON a.`user_id` = b.`id` 
				WHERE TO_DAYS(FROM_UNIXTIME(a.`add_time`,'%Y-%m-%d %T')) = TO_DAYS(NOW())
				GROUP BY a.`user_id` 
				ORDER BY SUM(a.`capital`) DESC LIMIT 0,6";
			
			$jinri = M('crowd_investor')->query($sql);
			
			$this->assign('jinri',$jinri);
		
		
		
		
		
        //带图片的合作机构
        $link_img = M('friend')->field('link_txt,link_href,link_img,link_type')->where("link_img!='' AND type = 1")->order("link_order DESC")->select();
        // dump($link_img->getLastSql());
        $this->assign('link_img',$link_img);

        $time = strtotime("today");
        $time1 = strtotime("yesterday");
        //今日成交额
        $map_today["second_verify_time"]=array("between",array($time,time()));
        $map_today1["add_time"]=array("between",array($time,time()));
        $b_today_money = M("borrow_info")->where($map_today)->sum("has_borrow");
        $t_today_money = M("transfer_borrow_investor")->where($map_today1)->sum("investor_capital");
        $this->assign("sum_today",$b_today_money+$t_today_money);
        //昨日成交额
        $map_yesterday["second_verify_time"]=array("between",array($time1,$time));
        $map_yesterday1["add_time"]=array("between",array($time1,$time));
        $b_yesday_money = M("borrow_info")->where($map_yesterday)->sum("has_borrow");
        $t_yesday_money = M("transfer_borrow_investor")->where($map_yesterday1)->sum("investor_capital");
        $this->assign("sum_yesterday",$b_yesday_money+$t_yesday_money);

        //正在进行的贷款
        //'1'=>'信用标',
//        '2'=>'担保标',
//			'3'=>'秒还标',
//			'4'=>'净值标',
//			'5'=>'抵押标',
        $searchMap1 = array();
        $searchMap1['b.borrow_status']=array("in",'2,4,6,7');
        $searchMap1['b.borrow_type']=1;
        $parm1=array();
        $parm1['map'] = $searchMap1;
        $parm1['limit'] = 1;
        $parm1['orderby']="b.borrow_status ASC,b.id DESC";
        $listBorrow1 = getBorrowList($parm1);
        $this->assign("listBorrow1",$listBorrow1); 
        $searchMap2 = array();   
        $searchMap2['b.borrow_status']=array("in",'2,4,6,7');
        $searchMap2['b.borrow_type']=2;
        $parm2=array();
        $parm2['map'] = $searchMap2;
        $parm2['limit'] = 1;
        $parm2['orderby']="b.borrow_status ASC,b.id DESC";
        $listBorrow2 = getBorrowList($parm2);
        $this->assign("listBorrow2",$listBorrow2);
        $searchMap3 = array();
        $searchMap3['b.borrow_status']=array("in",'2,4,6,7');
        $searchMap3['b.borrow_type']=3;
        $parm3=array();
        $parm3['map'] = $searchMap3;
        $parm3['limit'] = 1;
        $parm3['orderby']="b.borrow_status ASC,b.id DESC";
        $listBorrow3 = getBorrowList($parm3);
        $this->assign("listBorrow3",$listBorrow3);
        $searchMap4 = array();
        $searchMap4['b.borrow_status']=array("in",'2,4,6,7');
        $searchMap4['b.borrow_type']=4;
        $parm4=array();
        $parm4['map'] = $searchMap4;
        $parm4['limit'] = 1;
        $parm4['orderby']="b.borrow_status ASC,b.id DESC";
        $listBorrow4 = getBorrowList($parm4);
        $this->assign("listBorrow4",$listBorrow4);
        $searchMap5 = array();
        $searchMap5['b.borrow_status']=array("in",'2,4,6,7');
        $searchMap5['b.borrow_type']=5;
        $parm5=array();
        $parm5['map'] = $searchMap5;
        $parm5['limit'] = 1;
        $parm5['orderby']="b.borrow_status ASC,b.id DESC";
        $listBorrow5 = getBorrowList($parm5);
        $this->assign("listBorrow5",$listBorrow5);
        $this->assign( "mborrowOut",M( "borrow_info" )->where( "borrow_status in(6,7,8,9)" )->sum( "has_borrow" ) );//这是散标的累积成交量
        //计算平台总的成交额
        $all_turn_volume = M('crowd_info')->where("status in (2,3,4,5,9)")->sum('crowd_money');
	  //$all_turn_volume = M('crowd_info')->where("status in (5,9)")->sum('crowd_money');
        $this->assign('all_turn_volume',$all_turn_volume);
        //平台总获利
        $crowd_arr = M('crowd_info cf')
            ->field("cf.*,vo.vote_money")
            ->join("{$per}crowd_voting vo ON vo.crowd_id = cf.id")
            ->where('cf.status = 5 AND vo.status = 3')->select();
        $all_interest = 0;
        foreach($crowd_arr as $key=>$v){
            $all_interest+= ($crowd_arr[$key]['vote_money']-$crowd_arr[$key]['crowd_money'])*(1-($crowd_arr[$key]['repayment_ratio']/100));
        }
        //dump(M('crowd_info cf')->getLastSql());
        $this->assign('all_interest',$all_interest);
        //用户总收益
        $user_count_money=0;
        $crow_list=M('crowd_voting')->field('crowd_id,(vote_money - crowd_money) as yl_money')->where('status=3')->select();
        foreach($crow_list as $kay => $val){
            $back_rate=M('crowd_info')->field('status,back_rate')->find($val['crowd_id']);
            if($back_rate['status']!=5) continue;
            //$back_rate=M('crowd_info')->field('back_rate')->find($crow_list['crowd_id']);
            $user_count_money +=$val['yl_money']*$back_rate['back_rate']*0.01;
        }
        //溢价回购
        $yj_crowd=M('crowd_info')->field('id,has_crowd_money,max_duration,withdraw_rate')->where('status=9')->select();
        //$str="";
        foreach($yj_crowd as $kay => $val){
            $user_count_money+=$val['has_crowd_money']*($val['withdraw_rate']*0.01/12)*$val['max_duration'];
//            $yj_crowd[$kay]['user_count_money']=$user_count_money;
//            $str .= $val['id']."=>".$user_count_money."\n";
        }
        $user_count_money=round($user_count_money,2);
        $this->assign('user_count_money',$user_count_money);
		
        //成功放款笔数（散标）
        $this->assign( "borrow_num",M( "borrow_info" )->where( "borrow_status in(6,7,8,9)" )->count( "id" ) );
        
        //新手标
        $searchMapnew = array();
        $searchMapnew['b.money_collect']=0;
        $searchMapnew['b.is_new']=1;
        $searchMapnew['b.borrow_status']=array("in",'2,4,6,7');
        $parmnew=array();
        $parmnew['map'] = $searchMapnew;
        $parmnew['limit'] = 1;
        $parmnew['orderby']="b.borrow_status ASC,b.id DESC";
        $listBorrowNew = getBorrowList($parmnew);
        $this->assign("listBorrowNew",$listBorrowNew);
        //新手标结束
        //排行榜数据
        $allList = M('member_moneylog bi')
            ->field("sum(-bi.affect_money) money_collect,m.user_name")
            ->join("{$this->pre}members m on m.id=bi.uid")
            ->where(array('type'=>array('in',"6,50")))
            ->order("sum(bi.affect_money) asc")
            ->limit(3)
            ->group('bi.uid')
            ->select();
       // dump( M('member_moneylog bi')->getLastSql());
        $this->assign("alllist",$allList);
        $yuepaihangList = M('member_moneylog bi')
            ->field("sum(-bi.affect_money) money_collect,m.user_name")
            ->join("{$this->pre}members m on m.id=bi.uid")
            ->where(array('type'=>array('in',"6,50"),add_time=>array('gt',mktime(0,0,0,date('m'),1,date('Y')))))
            ->order("sum(bi.affect_money) asc")
            ->limit(5)
            ->group('bi.uid')
            ->select();
        $this->assign("yuepaihangList",$yuepaihangList);
        $ripaihangList = M('member_moneylog bi')
            ->field("sum(-bi.affect_money) money_collect,m.user_name")
            ->join("{$this->pre}members m on m.id=bi.uid")
            ->where(array('type'=>array('in',"6,50"),add_time=>array('gt',mktime(0,0,0,date('m'),date('d'),date('Y')))))
            ->order("sum(bi.affect_money) asc")
            ->limit(5)
            ->group('bi.uid')
            ->select();
        $this->assign("ripaihangList",$ripaihangList);
        //end
//        *************************************************************众筹相关函数操作 by lex****************
        //出售中众筹
        $list = M('crowd_info')->where('status <> 3 AND is_use = 1 AND start_time <'.time())->order('id desc')->limit(3)->select();
        $imgarray = array();
        $imgarray[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        foreach($list as $key=>$v){
            $list[$key]['img']=unserialize($list[$key]['crowd_picture'])?unserialize($list[$key]['crowd_picture']):$imgarray;
            $list[$key]['rate'] = round((($list[$key]['has_crowd_money']/ $list[$key]['crowd_money'])*100),2);
            $list[$key]['ky']=$list[$key]['crowd_money']-$list[$key]['has_crowd_money'];
        }
        //dump($list);
        $crowd_count = count($list);
        $all_length = $crowd_count*635;
        $this->assign('crowd_count',$crowd_count);
        $this->assign('all_length',$all_length);
        $this->assign('crowdlist',$list);
        //出售中的众筹end
        //众筹预约中的项目
        $list1 = M('crowd_info')->where('status = 1 AND is_use = 1 AND start_time >'.time())->order('id desc')->limit(3)->select();
        $imgarray1 = array();
        $imgarray1[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
        foreach($list1 as $key=>$v){
            $list1[$key]['img']=unserialize($list1[$key]['crowd_picture'])?unserialize($list1[$key]['crowd_picture']):$imgarray1;
            $list1[$key]['rate'] = round((($list1[$key]['has_crowd_money']/ $list1[$key]['crowd_money'])*100),2);
        }
        //dump(M('crowd_info')->getLastSql());
        $crowd_count1 = count($list1);
        $all_length1 = $crowd_count1*635;
        $this->assign('crowd_count1',$crowd_count1);
        $this->assign('all_length1',$all_length1);
        $this->assign('crowdlist1',$list1);

        //众筹预约的项目  一个
        $list2 = M('crowd_info')->where('status = 1 AND is_use = 1 and start_time>'.time())->order('id desc')->find();
		//var_dump($list2);exit;
        $imgarray2 = array();
        $imgarray2[0]['img']="__ROOT__/Style/H/images/index/index_default.jpg";
			$list2['start_time'] = date('Y-m-d',$list2['start_time']);
            $list2['img']=unserialize($list2['crowd_picture'])?unserialize($list2['crowd_picture']):$imgarray2;
            $list2['rate'] = round((($list2['has_crowd_money']/ $list2['crowd_money'])*100),2);

        if($list2['start_time'] > time()){
            $list2['is_start'] = 0;
            $list2['auto_remain_time'] = $list2['start_time']-time();
        }else{
            $list2['is_start'] = 1;//开始认筹中
            $list2['auto_remain_time']=0;
        }
		//var_dump($list2);exit();
        $crowd_count2 = count($list2);
        $all_length2 = $crowd_count2*635;
        $this->assign('crowd_count2',$crowd_count2);
        $this->assign('all_length2',$all_length2);
        $this->assign('crowd_time',time());
        $this->assign('votelist',$list2);
		
		//众筹预约项目 多个
		$yuyue = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('status = 1 AND is_use = 1 and start_time>'.time())->order('id desc')->select();
		//var_dump(count($yuyue));exit;
		$count_all = count($yuyue);
		$this->assign('count_all',$count_all);
		$yuyue = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('status = 1 AND is_use = 1 and start_time>'.time())->order('id desc')->limit(2)->select();
         foreach($yuyue as $key=>$v){
            $yuyue[$key]['img']=unserialize($yuyue[$key]['crowd_picture'])?unserialize($yuyue[$key]['crowd_picture']):$imgarray2;
            $yuyue[$key]['rate'] = round((($yuyue[$key]['has_crowd_money']/ $yuyue[$key]['crowd_money'])*100),2);
            $yuyue[$key]['is_start'] =($yuyue[$key]['start_time']>time())?0:1;
            $yuyue[$key]['rate'] = round((($list[$key]['has_crowd_money']/ $list[$key]['crowd_money'])*100),2);
			$yuyue[$key]['fenshu'] = round($list[$key]['crowd_money']/ $list[$key]['min_money']);
			$yuyue[$key]['start_time'] = date('Y-m-d',$yuyue[$key]['start_time']);
        }//var_dump($yuyue);exit;
         $this->assign('list',$yuyue);
	    //众筹项目 all
		$list3 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('is_use = 1 and status<>6')->order('id desc')->select();
		//var_dump(count($list3));exit;
		$count_all = count($list3);
		$this->assign('count_all',$count_all);
        $list3 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('is_use = 1 and status<>6')->order('id desc')->limit(9)->select();
        foreach($list3 as $key=>$v){
            $list3[$key]['img']=unserialize($list3[$key]['crowd_picture'])?unserialize($list3[$key]['crowd_picture']):$imgarray2;
            $list3[$key]['rate'] = round((($list3[$key]['has_crowd_money']/ $list3[$key]['crowd_money'])*100),2);
            $list3[$key]['is_start'] =($list3[$key]['start_time']>time())?0:1;
            $list[$key]['rate'] = round((($list[$key]['has_crowd_money']/ $list[$key]['crowd_money'])*100),2);
			$list3[$key]['fenshu'] = round($list[$key]['crowd_money']/ $list[$key]['min_money']);
			$list3[$key]['start_time'] = date('Y-m-d',$list3[$key]['start_time']);
        }//var_dump($list3);exit;
        $this->assign('list3',$list3);
	//众筹项目 zhong 
          $time = time();
	 //$list4 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where($map)->order('id desc')->select();
		$sql = "select id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration from nuomi_crowd_info where is_use = 1 and status = 1 and start_time <= ".$time." order by id DESC limit 0,9";
		$list4 = M('crowd_info')->query($sql);

		
		//var_dump(count($list3));exit;
		$count_zhong = count($list4);
		$this->assign('count_zhong',$count_zhong);
     //   $list4 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where($map)->order('id desc')->limit(4)->select();
        $list4 = M('crowd_info')->query($sql);
		foreach($list4 as $key=>$v){
            $list4[$key]['img']=unserialize($list4[$key]['crowd_picture'])?unserialize($list4[$key]['crowd_picture']):$imgarray2;
            $list4[$key]['rate'] = round((($list4[$key]['has_crowd_money']/ $list4[$key]['crowd_money'])*100),2);
            $list4[$key]['is_start'] =($list4[$key]['start_time']>time())?0:1;
			$list4[$key]['fenshu'] = round($list4[$key]['crowd_money']/ $list4[$key]['min_money']);
			$list4[$key]['start_time'] = date('Y-m-d',$list4[$key]['start_time']);
        }//var_dump($list3);exit;
        $this->assign('list4',$list4);
		
		//众筹项目 shou 
		$list5 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('is_use = 1 and status = 2 or status = 3 ')->order('id desc')->select();
		//var_dump(count($list3));exit;
		$count_shou = count($list5);
		$this->assign('count_shou',$count_shou);
        $list5 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('is_use = 1 and status = 2 or status = 3')->order('id desc')->limit(4)->select();
        foreach($list5 as $key=>$v){
            $list5[$key]['img']=unserialize($list5[$key]['crowd_picture'])?unserialize($list5[$key]['crowd_picture']):$imgarray2;
            $list5[$key]['rate'] = round((($list5[$key]['has_crowd_money']/ $list5[$key]['crowd_money'])*100),2);
            $list5[$key]['is_start'] =($list5[$key]['start_time']>time())?0:1;
			$list5[$key]['fenshu'] = round($list5[$key]['crowd_money']/ $list5[$key]['min_money']);
			$list5[$key]['start_time'] = date('Y-m-d',$list5[$key]['start_time']);
        }//var_dump($list3);exit;
        $this->assign('list5',$list5);
		
		//众筹项目  yishou
		$list6 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('is_use = 1 and status = 5')->order('id desc')->select();
		//var_dump(count($list3));exit;
		$count_yishou = count($list6);
		$this->assign('count_yishou',$count_yishou);
        $list6 = M('crowd_info')->field('id,crowd_name,crowd_money,start_time,crowd_picture,has_crowd_money,status,back_rate,min_money,max_duration,crowd_duration')->where('is_use = 1 and status = 5')->order('id desc')->limit(4)->select();
        foreach($list6 as $key=>$v){
            $list6[$key]['img']=unserialize($list6[$key]['crowd_picture'])?unserialize($list6[$key]['crowd_picture']):$imgarray2;
            $list6[$key]['rate'] = round((($list6[$key]['has_crowd_money']/ $list6[$key]['crowd_money'])*100),2);
            $list6[$key]['is_start'] =($list6[$key]['start_time']>time())?0:1;
			$list6[$key]['fenshu'] = round($list6[$key]['crowd_money']/ $list6[$key]['min_money']);
			$list6[$key]['start_time'] = date('Y-m-d',$list6[$key]['start_time']);
        }//var_dump($list3);exit;
        $this->assign('list6',$list6);
		
        //成功的项目
		
		$success_list = M('crowd_info cf')
            ->field("cf.*,vo.vote_money")
            ->join("{$per}crowd_voting vo ON vo.crowd_id = cf.id")
            ->where('cf.status in (2,3,4,5,9)')->order('cf.id desc')->limit(3)->select();
			
       /* $success_list = M('crowd_info cf')
            ->field("cf.*,vo.vote_money")
            ->join("{$per}crowd_voting vo ON vo.crowd_id = cf.id")
            ->where('cf.status in (5,9) AND vo.status = 3')->order('cf.id desc')->limit(3)->select();*/
			
        $succ_imagearr = array();
        $succ_imagearr[0]['img'] = "__ROOT__/Style/H/images/index/index_default.jpg";
        foreach($success_list as $key=>$v){
            $success_list[$key]['img']=unserialize($success_list[$key]['crowd_picture'])?unserialize($success_list[$key]['crowd_picture']):$succ_imagearr;
            //回款时间减去满标时间
            $difftime = ceil(round((($v['back_time']-$v['full_time'])/86400),4));//间隔多少天
            $success_list[$key]['wan_receive'] = round((($success_list[$key]['vote_money']-$success_list[$key]['crowd_money'])*$success_list[$key]['repayment_ratio']/100)*(10000/$success_list[$key]['crowd_money'])/$difftime,2);

            $interest = round((($success_list[$key]['vote_money']-$success_list[$key]['crowd_money'])*$success_list[$key]['repayment_ratio']/100),4);
            $success_list[$key]['back_rate'] = intval(((($interest/$v['crowd_money'])/$difftime)*360*100));
            $success_list[$key]['diffday'] = $difftime;
        }
        $succ_count = M('crowd_info')->where('status in (2,3,4,5,9)')->count();//count($success_list);
        //dump($success_list);
		foreach($success_list as $k=>$v){
			$all_crowd_money += $v['crowd_money'];
		}
        $succ_all_length = $succ_count*345;
		$this->assign('all_crowd_money',$all_crowd_money);
        $this->assign('succ_count',$succ_count);
        $this->assign('succ_all_length',$succ_all_length);
        $this->assign('success_list',$success_list);
        $glodata = get_global_setting();
        $yuebao_rule = explode("|",$glodata['yuebao_rule']);
        $this->assign('yuebao_rule',$yuebao_rule);
        //        *************************************************************众筹相关函数操作 by lex****************
        //正在进行的贷款
        ///////////////优计划列表开始  fan 2014-06-13//////////////
        $parm = array();
        $searchMap = array();
        $searchMap['borrow_status']=2;
        //$searchMap['is_tuijian']=0;
        $searchMap['on_off']=1;
        $searchMap['is_jijin']=1;
//        $searchMap['b.online_time']=array("lt",time()+300);
        $parm['map'] = $searchMap;
        $parm['limit'] = 3;
        //$parm['orderby'] = "b.is_show desc,b.borrow_status ASC,b.borrow_duration ASC,b.online_time desc";
        $parm['orderby'] = "b.add_time desc";
        $listFBorrow = getTBorrowList($parm);
       // dump($listFBorrow);
        foreach($listFBorrow['list'] as $key=>$v){
            $listFBorrow['list'][$key]['rate'] = (int) $listFBorrow['list'][$key]['borrow_interest_rate'];
        }
       // dump($listFBorrow);
        $this->assign("listFBorrow",$listFBorrow);
        /******************************************/
//            $link_img=M('friend')->where("link_img <> '' AND is_show = 1")->order("link_order desc")->select();
//        $this->assign('link_img',$link_img);
        /******************************************/
        ///////////////优计划列表结束  fan 2014-06-13///////////////

        /*众筹筹资时间已过状态变为溢出 2015-12-31  */
        // crowd_duration  集资期限
        $crowd_duration=M('crowd_info')->field('id,start_time,crowd_duration')->where('status=1')->select();
        if($crowd_duration){
            foreach($crowd_duration as $val){
                $data_time=date('Y-m-d H:i:s',strtotime('+'.$val['crowd_duration'].' day',$val['start_time']));
                if(time()>=strtotime($data_time)){
                    //dump($val);
                    //M('crowd_info')->where('id='.$crowd_duration['id'])->save(array('status'=>6));
                    crowdRefuse($val['id']);//流标函数，返还冻结
                }
            }
        }

        //持有资金最长期限   max_duration 最大持有期限
        $status['status']=array(between,array(2,4));
        $crowd_info_times=M('crowd_info')->field('id,start_time,max_duration')->where($status)->select();
        if($crowd_info_times){
            foreach($crowd_info_times as $val){
                $data_time=date('Y-m-d H:i:s',strtotime('+'.$val['max_duration'].' month',$val['start_time']));
                if(time()>=strtotime($data_time)){
                    M('crowd_info')->where('id='.$val['id'])->save(array('status'=>8));
                }
            }
        }

        //投票期限
        $voting_list=M('crowd_voting')->where('status=1')->select();
        foreach($voting_list as $val){
            if($val['deadline']<=time()){
                //投票率大于50%
                if($val['failure']<0.5){
                    $voting_status['status']=3;
                }else if($val['failure']==0.5){
                    $count=M('crowd_investor')->where('crowd_id='.$val['crowd_id'])->count('distinct  user_id');
                       if($val['not_agree_people']*2<$count){
                        $voting_status['status']=3;
                    }else{
                        $voting_status['status']=2;
                    }
                }else{
                    $voting_status['status']=2;
                }
                $voting_save=M('crowd_voting')->where('id='.$val['id'])->save($voting_status);
                if(($voting_status['status']==3) && $voting_save ){
                    M('crowd_info')->where('id='.$val['crowd_id'])->save(array('status'=>4));
                    $vote_id = M('crowd_voting')->where('id='.$val['id'])->find();
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

                }

                }
            }

        //借款人资金变动
//        $member_money=M('member_money')->find('50');
//        // 充值池可用余额
//        if($member_money){
//            $member_money_jekuan['account_money']=$member_money['account_money']+$crowd_info['crowd_money'];
//            M('member_money')->where('uid=50')->save($member_money_jekuan);
//        }else{
//            $member_money_jekuan['account_money']=123;
//            $member_money_jekuan['uid']=50;
//            M('member_money')->add($member_money_jekuan);
//        }

        $this->display();

        /**更改所有已过筹标时间的标状态为复审中  2015-1-10  刘克涛*/
        $mapT = array();
        $mapT['collect_time']=array("lt",time());
        $mapT['borrow_status'] = 2;
        $tlist = M("borrow_info")->field("id,borrow_uid,borrow_type,borrow_money,first_verify_time,borrow_interest_rate,borrow_duration,repayment_type,collect_day,collect_time")->where($mapT)->select();
        if(empty($tlist)) exit;
        foreach($tlist as $key=>$vbx){
            $borrow_id=$vbx['id'];
            $bstatus = 4;
            M('borrow_info')->where("id={$borrow_id}")->setField("borrow_status",$bstatus);
        }


    }
    public function uk_switch(){
        $UKey_switch = C('UKEY_STATUS');
        ajaxmsg($UKey_switch);
    }
}
