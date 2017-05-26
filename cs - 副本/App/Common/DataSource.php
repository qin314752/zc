<?php

//获取特定栏目下文章列表
function getAreaArticleList($parm){
	if(empty($parm['type_id'])) return;
	$map['type_id'] = $parm['type_id'];
	$Osql="id DESC";
	$field="id,title,art_set,art_time,art_url,area_id";
	//查询条件 
	if($parm['pagesize']){
		//分页处理
		import("ORG.Util.Page");
		$count = M('article_area')->

where($map)->count('id');
      $p = new Page($count, $parm['pagesize']);
      $page = $p->show();
      $Lsql = "{$p->firstRow},{$p->listRows}";
      //分页处理
      }else{
      $page="";
      $Lsql="LIMIT {$parm['limit']}";
      }
      
      $data = M('article_area')->field($field)->where($map)->order($Osql)->limit($Lsql)->select();
      
      $suffix=C("URL_HTML_SUFFIX");
      $typefix = get_type_leve_area_nid($map['type_id'],$parm['area_id']);
      
      $typeu = implode("/",$typefix);
      foreach($data as $key=>$v){
      if($v['art_set']==1) $data[$key]['arturl'] = (stripos($v['art_url'],"http://")===false)?"http://".$v['art_url']:$v['art_url'];
      //elseif(count($typefix)==1) $data[$key]['arturl'] = 
      else $data[$key]['arturl'] = MU("Home/{$typeu}","article",array("id"=>"id-".$v['id'],"suffix"=>$suffix));
      }
      $row=array();
      $row['list'] = $data;
      $row['page'] = $page;
      
      return $row;
      }
      
      //获取下级或者同级栏目列表
      function getAreaTypeList($parm){
      //if(empty($parm['type_id'])) return;
      $Osql="sort_order DESC";
      $field="id,type_name,type_set,add_time,type_url,type_nid,parent_id,area_id";
      //查询条件 
      $Lsql="{$parm['limit']}";
      $pc = D('Aacategory')->where("parent_id={$parm['type_id']} AND area_id={$parm['area_id']}")->count('id');
      if($pc>0){
      $map['is_hiden'] = 0;
      $map['parent_id'] = $parm['type_id'];
      $map['area_id'] = $parm['area_id'];
      $data = D('Aacategory')->field($field)->where($map)->order($Osql)->limit($Lsql)->select();
      }elseif(!isset($parm['notself'])){
      $map['is_hiden'] = 0;
      $map['parent_id'] = D('Aacategory')->getFieldById($parm['type_id'],'parent_id');
      $map['area_id'] = $parm['area_id'];
      $data = D('Aacategory')->field($field)->where($map)->order($Osql)->limit($Lsql)->select();
      }
      
      //链接处理
      $typefix = get_type_leve_area_nid($parm['type_id'],$parm['area_id']);
      $typeu = $typefix[0];
      $suffix=C("URL_HTML_SUFFIX");
      foreach($data as $key=>$v){
      if($v['type_set']==2){
      if(empty($v['type_url'])) $data[$key]['turl']="javascript:alert('请在后台添加此栏目链接');";
      else $data[$key]['turl'] = $v['type_url'];
      }
      elseif($v['parent_id']==0&&count($typefix)==1) $data[$key]['turl'] = MU("Home/{$v['type_nid']}/index","typelist",array("id"=>$v['id'],"suffix"=>$suffix));
      else $data[$key]['turl'] = MU("Home/{$typeu}/{$v['type_nid']}","typelist",array("id"=>$v['id'],"suffix"=>$suffix));
      }
      $row=array();
      $row = $data;
      
      return $row;
      }
      
      
      
      /**
      * 统计借款信息（借款总额、放款笔数、已还总额、待还总额）
      *     
      */
      function loan_total_info()
      {
      $info = array();
      $info['ordinary_total'] = M( "borrow_info" )->where( "borrow_status in(6,7,8,9)" )->sum( "has_borrow" ); //普通标借款总额
      $info['num_total'] = M( "borrow_info" )->where( "borrow_status in(6,7,8,9)" )->count( "id" ); // 普通标总笔数
      $info['has_also'] = M("borrow_info")->where("borrow_status in (7,8,9)")->count("borrow_money");    //已还款总额
      $info['arrears'] = M("borrow_info")->where("borrow_status = 6")->count("borrow_money");   //未还款总额
      
      //企业直投汇总信息
      $transfer_total_money = M('transfer_borrow_investor')->count('investor_capital');  //总借出
      $transfer_also_money = M('transfer_borrow_investor')->where('status=2')->count('investor_capital'); //已还款
      $transfer_arrears_money = M('transfer_borrow_investor')->where('status=1')->count('investor_capital'); //未还款
      $transfer_num_total  =   M('transfer_borrow_info')->count('id'); //总数
      
      $info['ordinary_total'] += $transfer_total_money;  //借款总额
      $info['has_also'] += $transfer_also_money; //已还款总额
      $info['arrears'] += $transfer_arrears_money;  //未还款总额
      $info['num_total'] += $transfer_num_total;  //借款笔数
      return $info;     
      }  
      function crowd_invest_benefit($uid){
          //计算出该用于投资众筹所获得的总利息
          $pre = C("DB_PREFIX");
          $uid = intval($uid);
          $crowd_investor = M('crowd_investor cv')
              ->field("cv.capital,cv.ratio,ci.repayment_ratio,ci.has_crowd_money,vo.vote_money")
              ->join("{$pre}crowd_info ci ON ci.id = cv.crowd_id")
              ->join("{$pre}crowd_voting vo ON vo.crowd_id= ci.id")
              ->where('cv.user_id = '.$uid." AND ci.status = 5 AND vo.status = 3")->select();
          $benefit = 0;
          foreach ($crowd_investor as $key=>$v) {
              $crowd_investor[$key]['receive'] = round(($crowd_investor[$key]['ratio']*round(($crowd_investor[$key]['repayment_ratio']/100),4)*round(($crowd_investor[$key]['vote_money']-$crowd_investor[$key]['has_crowd_money']),4)),4);//预期收益
              $benefit+= $crowd_investor[$key]['receive'];
          }
          $crowd_investor = M('crowd_investor cv')
              ->field("cv.capital,cv.ratio,ci.repayment_ratio,ci.has_crowd_money")
              ->join("{$pre}crowd_info ci ON ci.id = cv.crowd_id")
              ->where('cv.user_id = '.$uid." AND ci.status = 9")->select();
          $benefit1 = 0;
          foreach ($crowd_investor as $key=>$v) {
              $crowd_investor[$key]['receive'] =  round(($crowd_investor[$key]['capital']*round(($crowd_investor[$key]['repayment_ratio']/100),4)),4);//逾期收益//预期收益
              $benefit1+= $crowd_investor[$key]['receive'];
          }
          $all_benefit = $benefit+$benefit1;
          return $all_benefit;

      }
      /**
      * 获取用户投资收益汇总
      * （净赚利息、投标奖励、推广奖励、续投奖励、线下充值奖励、收入总和、代收利息）
      * 
      * @param int $uid  //用户ID
      */
      function get_personal_benefit($uid)
      {
      $uid = intval($uid);   
      $total = array();
      //统计回款利息interest、回款总额capital、利息手续费fee
      $investor =  M("investor_detail")
      ->field("sum(receive_capital) as capital, sum(receive_interest) as interest, sum('interest_fee') as fee")
      ->where('investor_uid='.$uid)->find(); 
      $investor['interest'] -= $investor['fee'];
      
      // 统计企业直投回款利息interest、回款总额capital、利息手续费fee
      $transfer_investor =  M("transfer_investor_detail")
      ->field("sum(receive_capital) as capital, sum(receive_interest) as interest, sum('interest_fee') as fee")
      ->where('investor_uid='.$uid)->find();
      $transfer_investor['interest'] -= $transfer_investor['fee'];   //减去管理费
      
      //投资奖励 推广奖励  续投奖励 线下充值奖励
      $log = get_money_log($uid);
      
      $benefit['ireward'] = $log['20']['money'] +  $log['41']['money'];     // 投标奖励
      $benefit['spread_reward'] = $log['13']['money'];  //推广奖励
      $benefit['con_reward'] = $log['34']['money'] +  $log['40']['money'];  //续投奖励
      $benefit['re_reward'] = $log['32']['money'];  // 线下充值
      $benefit['interest']  = $investor['interest'] + $transfer_investor['interest']; //净赚利息
      $benefit['capital'] =  $investor['capital'] + $transfer_investor['capital']; // 回款总额
      //$benefit['fee'] =  $investor['fee'] + $transfer_investor['fee'];
      $benefit['total'] = $benefit['ireward']+$benefit['spread_reward']+$benefit['con_reward']+$benefit['re_reward']+$benefit['interest']; 
      
      //待收利息
      $interest_collection = M('investor_detail')
      ->field('sum(interest) as interest, sum(capital) as capital,sum(interest_fee) as fee')
      ->where("investor_uid={$uid} and status in (6,7)")
      ->find();
      $transfer_interest_collection = M('transfer_investor_detail')
      ->field('sum(interest) as interest, sum(capital) as capital,sum(interest_fee) as fee')
      ->where("investor_uid={$uid} and status = 7")
      ->find();  
      $benefit['interest_collection'] =  $interest_collection['interest']-$interest_collection['fee']+ $transfer_interest_collection['interest']-$transfer_interest_collection['fee'];//dai shou ben xi 
      $benefit['capital_collection'] =  $interest_collection['capital'] + $transfer_interest_collection['capital']; // dai shou ben jin
      return $benefit; 
      }
      
      function get_money_log($uid)
      {
      $uid = intval($uid); 
      $log = array();
      if($uid){
      $list = M("member_moneylog")->field('type,sum(affect_money) as money')->where("uid={$uid}")->group('type')->select();
      }else{
      $list = M("member_moneylog")->field('type,sum(affect_money) as money')->group('type')->select();
      }
      
      foreach($list as $v){
      $log[$v['type']]['money']= ($v['money']>0)?$v['money']:$v['money']*(-1);
      $log[$v['type']]['name']= $name[$v['type']];
      }
      return $log;
      }
      /**
      *   用户借款支出汇总
      * 、支付投标奖励、支付利息、提现手续费、借款管理费、会员及认证费用、逾期及催收费用 、 支出总和、待付利息总额
      * 
      * @param mixed $uid   //用户id
      */
      function get_personal_out($uid)
      {
      $log = get_money_log($uid);
      $out['borrow_manage'] = $log['18']['money']; //借款管理费
      $out['pay_tender'] = $log['21']['money']+$log['42']['money'];                   //支付投标奖励
      $out['overdue'] = $log['30']['money']+ $log['31']['money'];//逾期催收
      $out['authenticate'] = $log['14']['money']+$log['22']['money']+$log['25']['money']+$log['26']['money'] ;// 认证费用
      
      $interest =  M("investor_detail")
      ->field('sum(receive_capital) as capital, sum(receive_interest) as interest')
      ->where("borrow_uid={$uid} and status in (1,2,3,4,5)")
      ->find();                     
      
      $out['interest'] = $interest['interest'] ;   //支付利息 
      $out['capital'] = $interest['capital']; // 已还本金
      
      //待付利息\本金
      $interest_pay = M('investor_detail')
      ->field('sum(interest) as interest, sum(capital) as capital')
      ->where("borrow_uid={$uid} and status in (6,7)")
      ->find();
      $out['interest_pay'] =  $interest_pay['interest']; //待还利息
      $out['capital_pay'] = $interest_pay['capital']; //待还金额
      
      $czfee = M('member_payonline')->where("uid={$uid} AND status=1")->sum('fee');//在线充值手续费 
      $out['czfee'] = $czfee;
      //print_r($out);                    
      $withdraw = M('member_withdraw')->field('sum(second_fee) as fee, sum(withdraw_money) as withdraw_money')->where("uid={$uid} and withdraw_status=2")->find();
      $out['withdraw_fee'] = $withdraw['fee']; //提现手续费
      $out['withdraw_money'] = $withdraw['withdraw_money'];//提现金额
      
      $out['total'] = $out['borrow_manage'] + $out['pay_tender']+$out['overdue']+ $out['authenticate']+$out['interest']+$out['withdraw_fee'];
      return $out;
      
      }
      
      /**
      * 累计投资金额 \累计款金额\累计充值金额\累计提现金额\累计支付佣金
      * 
      * @param mixed $uid
      */
      function get_personal_count($uid)
      {
      $uid = intval($uid);
      $count = array();
      //*********累计投资金额************
      $p_ljtz = M('borrow_investor')->where("investor_uid={$uid} and status in (4,5,6,7)")->sum('investor_capital');
      $t_ljtz = M('transfer_borrow_investor')->where("investor_uid={$uid}")->sum('investor_capital');
      $count['ljtz'] = $p_ljtz + $t_ljtz;
      //**************
      //累计借入金额
      $p_jrje = M('borrow_info')->where("borrow_uid={$uid} and borrow_status in (6,7,8,9,10)")->sum('has_borrow');
      $count['jrje'] = $p_jrje;
      //****************
      //*****累计充值金额***
      $payonline = M('member_payonline')->where("uid={$uid} AND status=1")->sum('money');//累计充值金额 
      $count['payonline'] = $payonline;
      //*****************
      //累计提现金额
      $withdraw = M('member_withdraw')
      ->where("uid={$uid} and withdraw_status=2")
      ->sum('withdraw_money');
      $count['withdraw'] = $withdraw;
      //***************
      //  累计支付佣金  包括借款管理费、投资手续费
      $interest_fee = M('investor_detail')->where('investor_uid='.$uid.' and status in (1,2,3,4,5)' )->sum('interest_fee'); // 普通标投资管理费（统计还款后的管理费）
      $transfer_interest_fee = M('transfer_investor_detail')->where('investor_uid='.$uid.' and status =1 ' )->sum('interest_fee');  //企业直投投资管理费（统计还款后的管理费）
      $borrow_fee = M('borrow_info')->where("borrow_uid={$uid} AND borrow_status in(6,7,8,9,10)")->sum('borrow_fee');  // 借款管理费 （统计复审通过后的管理费）
      $count['commission'] = $interest_fee + $transfer_interest_fee + $borrow_fee ; //累积支付佣金
      
      //*********************************
      return $count;
      
      }
      
      /**
      * 借款参数\累计款金额\累计充值金额\累计提现金额\累计支付佣金
      * 
      * @param mixed $uid
      */
      
      function get_bconf_setting($type){
      $bconf=array();
      if(!S('bconf_setting')){
      $borrowconfig=  require C("ROOT_URL")."Dynamic/borrowconfig.php";
      $bconf=$borrowconfig;
      
      S('bconf_setting',$bconf);
      S('bconf_setting',$bconf,3600*C('TTXF_TMP_HOUR')); 
      }else{
      $bconf = S('bconf_setting');
      }
      
      return $bconf;
      }
      
      /**
      * 标种小图标展示
      * 
      * @param mixed 
      */
      function getIco($map){
      $str="";
      if($map['borrow_type']==2) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/d.gif" align="absmiddle">';
      elseif($map['borrow_type']==3) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/m.gif" align="absmiddle">';
      elseif($map['borrow_type']==4) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/jing.gif" align="absmiddle">';
      elseif($map['borrow_type']==1) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/xin.gif" align="absmiddle">';
      elseif($map['borrow_type']==5) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/ya.gif" align="absmiddle">';
      elseif($map['borrow_type']==6) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/lbt.gif" align="absmiddle">';
      if($map['repayment_type']==1) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/t.gif" align="absmiddle">';
      if(!empty($map['password'])) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/passw.gif" align="absmiddle">';
      if($map['is_tuijian']==1) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/tuijian.gif" align="absmiddle">';
          if($map["is_new"]) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/isnew.gif" align="absmiddle">';
      return $str.'&nbsp;&nbsp;';
      }
function getRewardIco($map){
    $str='';
    if($map['reward_type']>0 &&($map['reward_num']>0 || $map['reward_money']>0)) {
        $str.='<a href="javascript:;" style="cursor: default;" class="font14 color-white text-center color-bg-red marleft_10 border-radius padleft_5 padright_5">奖励+'.$map["reward_num"].'%</a>';
    }
    return $str.'&nbsp;&nbsp;';
}


      function ajaxmsg($msg="",$type=1,$is_end=true){
      $json['status'] = $type;
      if(is_array($msg)){
      foreach($msg as $key=>$v){
      $json[$key] = $v;
      }
      }elseif(!empty($msg)){
      $json['message'] = $msg;
      }
      if($is_end){
      echo json_encode($json);
      exit;
      }else{
      echo json_encode($json);
      exit;
      }
      }
      
      //字段文字内容隐藏处理方法
      function hidecard($cardnum,$type=1,$default=""){
      if(empty($cardnum)) return $default;
      if($type==1) $cardnum = substr($cardnum,0,3).str_repeat("*",3).substr($cardnum,strlen($cardnum)-4);//身份证
      elseif($type==2) $cardnum = substr($cardnum,0,3).str_repeat("*",3).substr($cardnum,strlen($cardnum)-4);//手机号
      elseif($type==3) $cardnum = str_repeat("*",strlen($cardnum)-4).substr($cardnum,strlen($cardnum)-4);//银行卡
      elseif($type==4)
      {

          if(preg_match("/[\x7f-\xff]/", substr($cardnum,0,2))&& !preg_match("/[\x7f-\xff]/", substr($cardnum,0,1)))
          {
              $str = substr($cardnum,0,4);
          }
          elseif(!preg_match("/[\x7f-\xff]/", substr($cardnum,0,2)) && preg_match("/[\x7f-\xff]/", substr($cardnum,0,3)))
          {
              $str = substr($cardnum,0,2);
          }
          else{
              $str = substr($cardnum,0,3);
          }
          $cardnum = $str.str_repeat("*",strlen($cardnum)-3);//用户名

      }elseif($type==5)
      {


          if(preg_match("/[\x7f-\xff]/", substr($cardnum,0,2))&& !preg_match("/[\x7f-\xff]/", substr($cardnum,0,1))){
              $str1 = substr($cardnum,0,4);
          }
          elseif(!preg_match("/[\x7f-\xff]/", substr($cardnum,0,2)) && preg_match("/[\x7f-\xff]/", substr($cardnum,0,3))){
              $str1 = substr($cardnum,0,2);
          }else{
              $str1 = substr($cardnum,0,3);
          }
          if(preg_match("/[\x7f-\xff]/", substr($cardnum,strlen($cardnum)-2))&& !preg_match("/[\x7f-\xff]/", substr($cardnum,strlen($cardnum)-1))){
              $str2 = substr($cardnum,strlen($cardnum)-4);
          }
          elseif(!preg_match("/[\x7f-\xff]/", substr($cardnum,strlen($cardnum)-2)) && preg_match("/[\x7f-\xff]/", substr($cardnum,strlen($cardnum)-3))){
              $str2 = substr($cardnum,strlen($cardnum)-2);
          }
          else{
              $str2 = substr($cardnum,strlen($cardnum)-3);
          }

          $cardnum = $str1.str_repeat("*",3).$str2;//新用户名

      }
          return $cardnum;
      }
      
      function setmb($size)
      {
      $mbsize=$size/1024/1024;
      if($mbsize>0)
      {
      list($t1,$t2)=explode(".",$mbsize);
      $mbsize=$t1.".".substr($t2,0,2);
      }
      
      if($mbsize<1){
      $kbsize=$size/1024;
      list($t1,$t2)=explode(".",$kbsize);
      $kbsize=$t1.".".substr($t2,0,2);
      return $kbsize."KB";
      }else{
      return $mbsize."MB";
      }
      
      }
      
      function getMoneyFormt($money){
      if($money>=100000 && $money<=100000000){
      $res = getFloatValue(($money/10000),2)."万";
      }else if($money>=100000000){
      $res = getFloatValue(($money/100000000),2)."亿";
      }else{
      $res = getFloatValue($money,2);
      }
      return $res;
      }
      function getArea(){
      $area = FS("Dynamic/area");
      if(!is_array($area)){
      $list = M("area")->getField("id,name");
      FS("area",$list,"Dynamic/");
      }else{
      return $area;	
      }
      }
      
      //信用等级图标显示
      function getLeveIco($num,$type=1){
      $leveconfig = FS("Dynamic/leveconfig");
      foreach($leveconfig as $key=>$v){
      if($num>=$v['start'] && $num<=$v['end']){
      if($type==1) return "/Static/leveico/".$v['icoName'];
      elseif($type==2)  return '<a  target="_blank" href="'.__APP__.'/member/credit#fragment-1"><img src="'.__ROOT__.'/Static/leveico/'.$v['icoName'].'" style="width:20px;height:20px;" /></a>';
      elseif($type==3)  return '<a href="'.__APP__.'/member/credit#fragment-1">'.$v['name'].'</a>' ;//手机版使用
      else   return '<a href="'.__APP__.'/member/credit#fragment-1"><img src="'.__ROOT__.'/Static/leveico/'.$v['icoName'].'" title="'.$v['name'].'"/></a>';
      }
      }
      }
      
      //投资等级图标显示
      function getInvestLeveIco($num,$type=1){
      $leveconfig = FS("Dynamic/leveinvestconfig");
      foreach($leveconfig as $key=>$v){
      if($num>=$v['start'] && $num<=$v['end']){
      if($type==1){ 
      return "/Static/leveico/".$v['icoName'];
      }elseif($type==2){  
      return '<a target="_blabk" href="'.__APP__.'/member/credit#fragment-2"><img src="'.__ROOT__.'/Static/leveico/'.$v['icoName'].'" title="'.$v['name'].'"/></a>';
      }elseif($type==3){  
      return $v['name'] ;//手机版使用
      }else{   
      return '<a href="'.__APP__.'/member/credit#fragment-2"><img src="'.__ROOT__.'/Static/leveico/'.$v['icoName'].'" title="'.$v['name'].'"/></a>';										}
      }
      }
      }
      
      function getAgeName($num){
      $ageconfig = FS("Dynamic/ageconfig");
      foreach($ageconfig as $key=>$v){
      if($num>=$v['start'] && $num<=$v['end']){
      return $v['name'];
      }
      }
      }
      
      function getLocalhost(){
      $vo['id'] = 1;
      $vo['name'] = "主站";
      $vo['domain'] = "www";
      return $vo;
      }
      
      function Fmoney($money){
          if(!is_numeric($money) || $money == 0) return "￥0.00";
          $sb = "";
          if($money<0){
              $sb="-";
              $money = $money*(-1);
          }

          $dot = explode(".",$money);
          $tmp_money = strrev_utf8($dot[0]);
          $format_money = "";
          for($i = 3;$i<strlen($dot[0]);$i+=3){
              $format_money .= substr($tmp_money,0,3).",";
              $tmp_money = substr($tmp_money,3);
          }
          $format_money .=$tmp_money;
          if(empty($sb)) $format_money = "￥".strrev_utf8($format_money);
          else $format_money = "￥-".strrev_utf8($format_money);
          if($dot[1]){
              return $format_money.".".$dot[1];
          }else{
              return $format_money.".00";
          }
}

function strrev_utf8($str) {
    return join("", array_reverse(
        preg_split("//u", $str)
    ));
}

function getInvestUrl($id){
	return __APP__."/invest/{$id}".C('URL_HTML_SUFFIX');
}
function getCrowdInvestUrl($id){
    return __APP__."/crowdinvest/{$id}".C('URL_HTML_SUFFIX');
}
//获取管理员ID对应的名称,以id为键
function get_admin_name($id=false){
	$stype = "adminlist";
	$list = array();
	if(!S($stype)){
		$rule = M('ausers')->field('id,user_name')->select();
      foreach($rule as $v){
      $list[$v['id']]=$v['user_name'];
      }
      
      S($stype,$list,3600*C('HOME_CACHE_TIME')); 
      if(!$id) $row = $list;
      else $row = $list[$id];
      }else{
      $list = S($stype); 
      if($id===false) $row = $list;
      else $row = $list[$id];
      }
      return $row;
      }
      
      
      //添加会员操作记录
      function addMsg($from,$to,$title,$msg,$type=1){
      if(empty($from) || empty($to)) return;
      $data['from_uid'] = $from;
      $data['from_uname'] = M('members')->getFieldById($from,"user_name");
      $data['to_uid'] = $to;
      $data['to_uname'] = M('members')->getFieldById($to,"user_name");
      $data['title'] = $title;
      $data['msg'] = $msg;
      $data['add_time'] = time();
      $data['is_read'] = 0;
      $data['type'] = $type;
      $newid = M('member_msg')->add($data);
      return $newid;
      }
      
      //注册专用
      function rand_string_reg($len=6,$type='1',$utype='1',$addChars='') {
      $str ='';
      switch($type) {
      case 0:
      $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
      break;
      case 1:
      $chars= str_repeat('0123456789',3);
      break;
      case 2:
      $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
      break;
      case 3:
      $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
      break;
      default :
      // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
      $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
      break;
      }
      if($len>10 ) {//位数过长重复字符串一定次数
      $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
      }
      $chars   =   str_shuffle($chars);
      $str     =   substr($chars,0,$len);
      session("code_temp",$str);
      session("send_time",time());
      
      return $str;
      }
      /**
      * 设置用户认证状态 处理表为members_status
      * 
      * @param int $uid  // 用户id
      * @param string $type  // 类型的名字 结合数据库字段
      * @param int  $status // 状态0 or 1
      * @param string $info //类别说明，用户保存增加积分说明
      */
      function setMemberStatus($uid, $type, $status, $log_type, $log_info)
      {
      $uid = intval($uid);
      $status = intval($status);
      
      $type_status = $type.'_status';
      $type_credits = $type.'_credits';
      $integration = FS('Dynamic/integration');
      $credits = $integration[$type]['fraction'];
      $nid = 0;
      $insert_info = M('members_status')->field('uid,'.$type_status.', '.$type_credits)->where("uid='".$uid."'")->find();
      if(!$insert_info['uid']){  //如果记录不存在
      if($status===1){
      $nid = M('members_status')->data(array('uid' => $uid, $type_status => $status, $type_credits => $credits))->add();  
      }else{
      $nid = M('members_status')->data(array('uid' => $uid, $type_status => $status))->add();
      } 
      }else{ //如果记录存在切积分不存在  判断状态是否为1（不给积分） 为0 （认为是第一次审核给积分）
      if($insert_info[$type_credits] or $insert_info[$type_status]===1 or $status===2){ //状态为 1 or 积分已存在 or 修改状态为2
      $nid = M('members_status')->data(array($type_status => $status))->where('uid='.$uid)->save(); 
      }else{ //状态为 1 （通过送积分）
      $nid = M('members_status')->data(array($type_status => $status, $type_credits => $credits))->where('uid='.$uid)->save();  
      }
      }
      
      if($status === 1 && $nid){
      memberCreditsLog($uid, $log_type, $credits, $log_info."认证通过,奖励积分{$credits}");
      }
      return $nid;
      }
      
      /**
      * 过滤上传资料类型
      * 
      * @param array $arr  // Dynamic/integration 文件
      */
      function FilterUploadType($arr)
      {
      $uploadType = array();
      if(is_array($arr)){
      foreach($arr as $key=>$val){
      if(is_numeric($key)){
      $uploadType[$key] = $val;
      }
      }
      }
      return $uploadType; 
      }
      
      /**
      * 获取当前用户没有上传过的上传资料类型
      * 
      * @param int $uid   // 用户id
      */
      function get_upload_type($uid)
      {
      $integration = FilterUploadType(FS("Dynamic/integration"));
      $uploadType = M('member_data_info')->field('type')->where("uid='{$uid}' and status in (0,1)")->select();
      foreach($uploadType as $row){
      unset($integration[$row['type']]);
      }
      foreach($integration as $key=>$val){
      $integration[$key] = $val['description'];
      }
      return $integration;
      }


      
      /****************************
      /*  手机短信接口（整合吉信通www.winic.org、漫道短信www.zucp.net和亿美短信www.zucp.net）
      /* 参数：$mob  		手机号码
      /*		$content   	短信内容 
      *****************************/
      function sendsms($mob,$content){

      //填入日志
         // $smslog['']
          //找到被发送人的id 和 姓名

      $map['user_phone'] = $mob;
      $res = M('members')->field("id,user_name")->where($map)->find();




      $msgconfig = FS("Dynamic/msgconfig");
      $type = $msgconfig['sms']['type'];// type=0 吉信通短信接口   type=1    type=2 亿美短信接口
      if($type==0){	
      $uid=$msgconfig['sms']['user1']; //分配给你的账号
      $pwd=$msgconfig['sms']['pass1']; //密码
      $mob=$mob; //发送号码用逗号分隔
      if(PATH_SEPARATOR==':'){//如果是Linux系统，则执行linux短息接口
      $url="http://service.winic.org:8009/sys_port/gateway/?id=%s&pwd=%s&to=%s&content=%s&time=";
      $id = urlencode($uid);
      $pwd = urlencode($pwd);
      $to = urlencode($mob);    
      $content = iconv("UTF-8","GB2312",$content); 
      $rurl = sprintf($url, $id, $pwd, $to, $content);
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_URL,$rurl);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
      $result = curl_exec($ch);
      curl_close($ch);
      $status = substr($result, 0,3);


          $shuju = array();
          $shuju['to_user_id'] = $res['id'];
          $shuju['to_user_name'] = $res['user_name'];
          $shuju['content'] = $content;
          $shuju['to_phone'] = $mob;
          $shuju['addtime'] = time();
          $shuju['addtime_des'] = date('Y-m-d=H-i-s');
          $shuju['back_status'] = $status;
          $shuju['add_ip']=get_client_ip();
          $cid = M('xbo_smslog')->add($shuju);

      if($status==="000"){
      return true;
      }else{
      return false;
      }
      
      }else{
      $content=urlencode(auto_charset($content,"utf-8",'gbk'));  //短信内容
      $sendurl="http://service.winic.org:8009/sys_port/gateway/?";
      $sdata="id=".$uid."&pwd=".$pwd."&to=".$mob."&content=".$content."&time=";
      
      $xhr=new COM("MSXML2.XMLHTTP");   
      $xhr->open("POST",$sendurl,false);
      $xhr->setRequestHeader ("Content-type:","text/xml;charset=GB2312");
      $xhr->setRequestHeader ("Content-Type","application/x-www-form-urlencoded");
      $xhr->send($sdata);   
      $data = explode("/",$xhr->responseText);
          $shuju = array();
          $shuju['to_user_id'] = $res['id'];
          $shuju['to_user_name'] = $res['user_name'];
          $shuju['content'] = $content;
          $shuju['to_phone'] = $mob;
          $shuju['addtime'] = time();
          $shuju['addtime_des'] = date('Y-m-d=H-i-s');
          $shuju['back_status'] = $data[0];
          $shuju['add_ip']=get_client_ip();
          $shuju['back_status_des'] = '吉信通短信接口';
          $cid = M('xbo_smslog')->add($shuju);
      if($data[0]=="000") return true;
      else return false;
      }
      }elseif($type==1){
      /////////////////////////////////////////漫道短信接口 开始///////////////////////////////////////////////////////////// 
      //如果您的系统是utf-8,请转成GB2312 后，再提交、
      $flag = 0; 
      //要post的数据 
      $argv = array( 
      'sn'=>$msgconfig['sms']['user2'], ////替换成您自己的序列号
      'pwd'=>$msgconfig['sms']['pass2'], //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
      
      'mobile'=>$mob,//手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
      'content'=>iconv( "UTF-8", "gb2312//IGNORE" ,$content),//短信内容
      'ext'=>'',		
      'stime'=>'',//定时时间 格式为2011-6-29 11:09:21
      'rrid'=>''
      ); 
      //构造要post的字符串 
      foreach ($argv as $key=>$value) { 
      if ($flag!=0) { 
      $params .= "&"; 
      $flag = 1; 
      } 
      $params.= $key."="; $params.= urlencode($value); 
      $flag = 1; 
      } 
      $length = strlen($params); 
      //创建socket连接 
      $fp = fsockopen("sdk2.zucp.net",8060,$errno,$errstr,10) or exit($errstr."--->".$errno); 
      //构造post请求的头 
      $header = "POST /webservice.asmx/mt HTTP/1.1\r\n"; 
      $header .= "Host:sdk2.zucp.net\r\n"; 
      $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
      $header .= "Content-Length: ".$length."\r\n"; 
      $header .= "Connection: Close\r\n\r\n"; 
      //添加post的字符串 
      $header .= $params."\r\n"; 
      //发送post的数据 
      fputs($fp,$header); 
      $inheader = 1; 
      while (!feof($fp)) { 
      $line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据 
      if ($inheader && ($line == "\n" || $line == "\r\n")) { 
      $inheader = 0; 
      } 
      if ($inheader == 0) { 
      // echo $line; 
      } 
      }
      $rescode = $inheader;
      $line=str_replace("
<string xmlns=\"http://tempuri.org/\">","",$line);
  $line=str_replace("</string>
","",$line);
      $result=explode("-",$line);

          $shuju = array();
          $shuju['to_user_id'] = $res['id'];
          $shuju['to_user_name'] = $res['user_name'];
          $shuju['content'] = $content;
          $shuju['to_phone'] = $mob;
          $shuju['addtime'] = time();
          $shuju['addtime_des'] = date('Y-m-d=H-i-s');
          $shuju['back_status'] = $rescode;
          $shuju['add_ip']=get_client_ip();
          $shuju['back_status_des'] = '漫道短信接口';
          $cid = M('xbo_smslog')->add($shuju);
      if(count($result)>1){
      return false;
      }else{
      return true;
      }
      /////////////////////////////////////////漫道短信接口 结束///////////////////////////////////////////////////////////// 
      }elseif($type==2){
      ////////////////////////////////////////////////////////亿美短信接口 开始/////////////////////////////////////////////
      $uid=$msgconfig['sms']['user3']; //分配给你的账号
      $pwd=$msgconfig['sms']['pass3']; //密码
      $mob=$mob; //发送号码用逗号分隔
       #短信内容
      $content2=$content;
        $content=urlencode(auto_charset($content,"utf-8",'utf-8'));

        $sendurl="http://sdk4report.eucp.b2m.cn:8080/sdkproxy/sendsms.action?";
        $sendurl.='cdkey='.$uid.'&password='.$pwd.'&phone='.$mob.'&message='.$content;#.'&addserial=';

        $d = file_get_contents($sendurl);

        preg_match_all('/<response>(.*)<\/response>/isU',$d,$arr);

        foreach($arr[1] as $k=>$v){
            preg_match_all('#<error>(.*)</error>#isU',$v,$ar[$k]);
            $data[]=$ar[$k][1];
        }
        
        $shuju = array();
        $shuju['to_user_id'] = $res['id'];
        $shuju['to_user_name'] = $res['id'];
        $shuju['content'] = $content2;
        $shuju['to_phone'] = $mob;
        $shuju['addtime'] = time();
        $shuju['addtime_des'] = date('Y-m-d=H-i-s');
        $shuju['back_status'] = $data[0][0];
          $shuju['add_ip']=get_client_ip();
        $shuju['back_status_des'] = '亿美短信接口';
        $cid = M('xbo_smslog')->add($shuju);
        if($data[0][0]=="0"){
            return true;
        }else{
            return false;
        }
      ////////////////////////////////////////////////////////亿美短信接口 结束/////////////////////////////////////////////
      }elseif($type==4){
          ////////////////////////////////////////////////////////漫道二次短信接口 开始/////////////////////////////////////////////
          $uid4=$msgconfig['sms']['userid4']; //分配给你的账号
          $account4=$msgconfig['sms']['user4']; //分配给你的账号
          $pwd4=$msgconfig['sms']['pass4']; //密码
          $mob=$mob; //发送号码用逗号分隔
          #短信内容
          $content2=$content;
          //$content=urlencode(auto_charset($content,"utf-8",'utf-8'));
          $post_data = array();
          $post_data['userid'] =$uid4; //改为自己的id
          $post_data['account'] = $account4;
          $post_data['password'] = $pwd4;
          $post_data['content'] = $content2;
          $post_data['mobile'] = $mob;
          $post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
          $url = 'http://115.29.242.32:8888/sms.aspx?action=send&';
          $url.='userid='.$uid4.'&account='.$account4.'&password='.$pwd4.'&content='.$content2.'&mobile='.$mob.'&sendtime=';
          $d = @file_get_contents($url,false);
//          $o='';
//          foreach ($post_data as $k=>$v)
//          {
//              $o.="$k=".urlencode($v).'&';
//          }
//          $post_data=substr($o,0,-1);
//          $ch = curl_init();
//          curl_setopt($ch, CURLOPT_POST, 1);
//          curl_setopt($ch, CURLOPT_HEADER, 0);
//          curl_setopt($ch, CURLOPT_URL,$url);
//          curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
//          $result = curl_exec($ch);
          preg_match_all('/<successCounts>(.*)<\/successCounts>/isU', $d, $data);
          $arr=array();

          $shuju = array();
          $shuju['to_user_id'] = $res['id'];
          $shuju['to_user_name'] = $res['id'];
          $shuju['content'] = $content2;
          $shuju['to_phone'] = $mob;
          $shuju['addtime'] = time();
          $shuju['addtime_des'] = date('Y-m-d=H-i-s');
          $shuju['back_status'] = $data[1][0];
          $shuju['add_ip']=get_client_ip();
          $shuju['back_status_des'] = '漫道二次短信接口';
          $cid = M('xbo_smslog')->add($shuju);
          if($data[1][0] > 0){
              return true;
          }else{
              return false;
          }
          ////////////////////////////////////////////////////////漫道二次短信接口 结束/////////////////////////////////////////////
      }else{
      return false;
      }
      }
      
      //手机日志
      function alogsm($type,$tid,$tstatus,$deal_info='',$deal_user='' ){
      $arr = array();
      $arr['type'] = $type;
      $arr['tid'] = $tid;
      $arr['tstatus'] = $tstatus;
      $arr['deal_info'] = $deal_info;
      
      $arr['deal_user'] = session("u_id");
      $arr['deal_ip'] = get_client_ip();
      $arr['deal_time'] = time();
      //dump($arr);exit;
      $newid = M("auser_dologs")->add($arr);
      return $newid;
      }
      
      function cancelDebt($borrow_id)
      {
      $borrow_id = intval($borrow_id);
      $borrow_info = M("borrow_info")->field("total, has_pay")->where("id={$borrow_id}")->find();
      $result = M("borrow_investor")->field("id")->where(" borrow_id={$borrow_id}")->select();
      D("DebtBehavior");
      $Debt = new DebtBehavior(); 
      foreach($result as $k=>$v){
      $debt_info = M('invest_detb')->field('status')->where("invest_id={$v['id']}")->find();
      if($borrow_info['total'] == $borrow_info['has_pay'] && $debt_info['status'] == 1){ //已经还完更改状态
      M('invest_detb')->where("invest_id={$v['id']}")->save(array('status'=>4));
      }elseif($debt_info['status'] == 2){
      $Debt->cancelDebt($v['id'], 2);
      }              
      }
      }
      
      //提取广告
      function get_ad($id){
      $stype = "home_ad".$id;
      if(!S($stype)){
      $list=array();
      /*$condition['start_time']=array("lt",time());
      $condition['end_time']=array("gt",time());*/
      $condition['id']=array('eq',$id);
      $_list = M('ad')->field('ad_type,content')->where($condition)->find();


      if($_list['ad_type']==1) $_list['content']=unserialize($_list['content']);
      $list = $_list;
      S($stype,$list,3600*C('HOME_CACHE_TIME')); 
      }else{
      $list = S($stype);
      }
      
      if($list['ad_type']==0 || !$list['content']){
      if(!$list['content']) $list['content'] = "广告未上传或已过期";
      echo $list['content'];
      }
      else{
          return $list['content'];
      }

      }
      
      
      function getVerify($uid){
      $pre = C('DB_PREFIX');
      $vo = M("members m")->field("m.id,m.user_leve,m.time_limit,m.pin_pass,s.id_status,s.phone_status,s.email_status,s.video_status,s.face_status")->join("{$pre}members_status s ON s.uid=m.id")->where("m.id={$uid}")->find();
      $str = "";
      if($vo['id_status']==1) $str.='&nbsp;<img alt="实名认证通过" src="'.__ROOT__.'/Style/H/images/icon/id.gif"/>';
      else  $str.='&nbsp;<img alt="实名认证未通过" src="'.__ROOT__.'/Style/H/images/icon/id_0.gif"/>';
      if($vo['phone_status']==1) $str.='&nbsp;<img alt="手机认证通过" src="'.__ROOT__.'/Style/H/images/icon/phone.gif"/>';
      else  $str.='&nbsp;<img alt="手机认证未通过" src="'.__ROOT__.'/Style/H/images/icon/phone_0.gif"/>';
      if($vo['email_status']==1) $str.='&nbsp;<img alt="邮件认证通过" src="'.__ROOT__.'/Style/H/images/icon/email.gif"/></br>
';
      else  $str.='&nbsp;<img alt="邮件认证未通过" src="'.__ROOT__.'/Style/H/images/icon/email_0.gif"/></br>
';
      if($vo['user_leve']!=0 && $vo['time_limit']>time()) $str.='&nbsp;<img alt="VIP会员" src="'.__ROOT__.'/Style/H/images/icon/vip.gif"/></a>&nbsp;';
      else  $str.='&nbsp;<img alt="不是VIP会员" src="'.__ROOT__.'/Style/H/images/icon/vip_0.gif"/>';
      if(!empty($vo['pin_pass'])) {
      $str.='<img alt="支付密码已设置" src="'.__ROOT__.'/Style/H/images/icon/mima.gif"/>&nbsp;';
      }else{  
      $str.='<img alt="支付密码未设置" src="'.__ROOT__.'/Style/H/images/icon/mima_0.gif"/>';
      }
      return $str;
      } 
    function getVerify_ucenter($uid){
        $pre = C('DB_PREFIX');
        $vo = M("members m")->field("m.id,m.user_leve,m.time_limit,m.pin_pass,s.id_status,s.phone_status,s.email_status,s.video_status,s.face_status")->join("{$pre}members_status s ON s.uid=m.id")->where("m.id={$uid}")->find();
        $str = "";
        if ($vo['id_status'] == 1)
            $str.='<a href="' . __APP__ . '/member/verify#fragment-4"><img alt="实名认证通过"   title="实名认证通过" src="' . __ROOT__ . '/Style/H/images/icon/id.png"/></a>&nbsp;';
        else
            $str.='<a href="' . __APP__ . '/member/verify#fragment-4"><img alt="实名认证未通过"  title="实名认证未通过" src="' . __ROOT__ . '/Style/H/images/icon/id_0.png"/></a>&nbsp;';
        if ($vo['phone_status'] == 1)
            $str.='<a href="' . __APP__ . '/member/verify#fragment-3"><img alt="手机认证通过"   title="手机认证通过" src="' . __ROOT__ . '/Style/H/images/icon/phone.png"/>&nbsp;';
        else
            $str.='<a href="' . __APP__ . '/member/verify#fragment-3"><img alt="手机认证未通过"   title="手机认证未通过" src="' . __ROOT__ . '/Style/H/images/icon/phone_0.png"/></a>&nbsp;';
        if ($vo['email_status'] == 1)
            $str.='<a href="' . __APP__ . '/member/verify?id=1#fragment-2"><img alt="邮件认证通过"   title="邮件认证通过" src="' . __ROOT__ . '/Style/H/images/icon/email.png"/></a>&nbsp;';
        else
            $str.='<a href="' . __APP__ . '/member/verify?id=1#fragment-2"><img alt="邮件认证未通过"   title="邮件认证未通过" src="' . __ROOT__ . '/Style/H/images/icon/email_0.png"/></a>&nbsp;';
        /*if ($vo['user_leve'] != 0 && $vo['time_limit'] > time())
            $str.='<img alt="VIP会员"   title="VIP会员" src="' . __ROOT__ . '/Style/H/images/icon/vip.png"/></a>&nbsp;';
        else
            $str.='<a href="javascript:;" onclick="window.location.href=\'/member/verify#fragment-5\';"><img alt="不是VIP会员"   title="不是VIP会员" src="' . __ROOT__ . '/Style/H/images/icon/vip_0.png"/></a>&nbsp;';
*/
        if (!empty($vo['pin_pass'])) {
            $str.='<a  href="' . __APP__ . '/member/user#fragment-3"><img alt="支付密码已设置"   title="支付密码已设置" src="' . __ROOT__ . '/Style/H/images/icon/mima.png"/></a>&nbsp;';
        } else {
            $str.='<a  href="' . __APP__ . '/member/user#fragment-3"><img alt="支付密码未设置"   title="支付密码未设置" src="' . __ROOT__ . '/Style/H/images/icon/mima_0.png"/></a>&nbsp;';
        }

        return $str;
    } 
      
      
      //获得时间天数
      function get_times($data=array()){
      if (isset($data['time']) && $data['time']!=""){
      $time = $data['time'];//时间
      }elseif (isset($data['date']) && $data['date']!=""){
      $time = strtotime($data['date']);//日期
      }else{
      $time = time();//现在时间
      }
      if (isset($data['type']) && $data['type']!=""){ 
      $type = $data['type'];//时间转换类型，有day week month year
      }else{
      $type = "month";
      }
      if (isset($data['num']) && $data['num']!=""){ 
      $num = $data['num'];
      }else{
      $num = 1;
      }
      
      if ($type=="month"){
      $month = date("m",$time);
      $year = date("Y",$time);
      $_result = strtotime("$num month",$time);
      $_month = (int)date("m",$_result);
      if ($month+$num>12){
      $_num = $month+$num-12;
      $year = $year+1;
      }else{
      $_num = $month+$num;
      }
      
      if ($_num!=$_month){
      
      $_result = strtotime("-1 day",strtotime("{$year}-{$_month}-01"));
      }
      }else{
      $_result = strtotime("$num $type",$time);
      }
      if (isset($data['format']) && $data['format']!=""){ 
      return date($data['format'],$_result);
      }else{
      return $_result;
      }
      
      }
      
      
      //企业直投自动投标设置
      function autotInvest($borrow_id){
	  $datag = get_global_setting();
      $binfo = M("transfer_borrow_info")->field('borrow_money,borrow_uid,per_transfer,borrow_type,borrow_interest_rate,borrow_duration,progress,transfer_total,transfer_out')->find($borrow_id);
      
      $map['a.is_use'] = 1;
      $map['a.borrow_type'] = 3;
      $map['a.end_time'] = array("gt",time());
      $autolist = M("auto_borrow a")
      ->join(C('DB_PREFIX')."member_money m ON a.uid=m.uid")
      ->field("a.*, m.account_money+m.back_money as money")
      ->where($map)
      ->order("a.invest_time asc")
      ->select();		
      $needMoney=$binfo['borrow_money'] - ($binfo['borrow_money']*$binfo['progress']/100);
      foreach($autolist as $key=>$v){
      if(!$needMoney) break;
      if( $v['uid']==$binfo['borrow_uid']) continue;
      if($v['money']<=0||$v['money']==NULL){
      continue;
      }
      $num_max1 = floor(($v['money']-$v['account_money'])/$binfo['per_transfer']);//余额最多可购买份数
      $num_max2 = floor($v['invest_money']/$binfo['per_transfer']);//最大投资总额可购买份数
      $num_max3 = $needMoney/$binfo['per_transfer'];//$binfo['transfer_total'] - $binfo['transfer_out'];//剩余多少份
      $num_max4 = $binfo['transfer_total']*$datag['auto_rate']/100;//不能超过10%
      $num_min = ceil($v['min_invest']/$binfo['per_transfer']);//最少要买多少份
      if($num_max1 > $num_max2){
      $num = $num_max2;
      }else{
      $num = $num_max1;
      }
      if($num > $num_max3){
      $num = $num_max3;
      }
      if($num > $num_max4){
      $num = $num_max4;
      }
      if($v['interest_rate'] > 0){
      if(!($binfo['borrow_interest_rate']>=$v['interest_rate'])){//利率范围
      continue;	
      }
      }
      if($v['duration_from'] > 0 && $v['duration_to'] > 0 && $v['duration_from'] <= $v['duration_to']){//借款期限范围
      if(!(($binfo['borrow_duration']>=$v['duration_from'])&&($binfo['borrow_duration']<=$v['duration_to']))){
      continue;
      }
      }
      if(!($num>=$num_min)){//
      continue;
      }
      if(!(($v['money']-$v['account_money'])>=($num*$binfo['per_transfer']))){//余额限制
      continue;
      }
      if($needMoney <= 0){//可投金额必须大于0
      continue;
      }
      
      TinvestMoney($v['uid'],$borrow_id,$num,$binfo['borrow_duration'],1);//
      $needMoney = $needMoney - $num*$binfo['per_transfer'];   // 减去剩余已投金额
      MTip('chk27',$v['uid'],$borrow_id,$v['id']);//sss
      M('auto_borrow')->where('id = '.$v['id'])->save(array("invest_time"=>time()));
      
      }
      return true;
      }
      
      //普通标自动投标设置
      function autoInvest($borrow_id){
	  $datag = get_global_setting();
      $binfo = M("borrow_info")->field('borrow_uid,is_new,borrow_money,borrow_type,repayment_type,borrow_interest_rate,borrow_duration,has_vouch,has_borrow,borrow_max,borrow_min,can_auto')->find($borrow_id);
      if($binfo['can_auto']=='0'){
      return;
      }
      $map['a.is_use'] = 1;
      $map['a.borrow_type'] = 1;
      $map['a.end_time'] = array("gt",time());
      
      $autolist = M("auto_borrow a")
      ->join(C('DB_PREFIX')."member_money m ON a.uid=m.uid")
      ->field("a.*, m.account_money+m.back_money as money")
      ->where($map)
      ->order("a.invest_time asc")
      ->select();
      $needMoney=$binfo['borrow_money'] - $binfo['has_borrow'];
      foreach($autolist as $key=>$v){
          #####################################################
          $benefit = get_personal_benefit($v["uid"]);
          if($binfo['is_new']==1&&$benefit["capital_collection"]>0){
//              ajaxmsg("对不起，此标为新手标，只有新用户才能投此标！",0);
              continue;
          }



          #####################################################
      if(!$needMoney) break;
      if( $v['uid']==$binfo['borrow_uid']) continue;
      $num_max1 = intval($v['money']-$v['account_money']);//账户余额-设置的最少剩余金额，即可用的投资金额数
      $num_max4 = $binfo['borrow_money']*$datag['auto_rate']/100;//不能超过10%
      
      if($v['invest_money'] > $binfo['borrow_max'] && $binfo['borrow_max']>0){ // 大于最大投标 且设置最大投标
      $investMoney = $binfo['borrow_max'];
      }
      if($num_max1 > $v['invest_money']){//如果可用的投资金额大于最大投资金额，则投资金额等于最大投资金额
      $investMoney = $v['invest_money'];
      }else{
      $investMoney = $num_max1;//如果未设置投标后账户余额，则会投出全部余额
      }
      if($investMoney > $needMoney){
      		$investMoney = $needMoney;
      }else if($binfo['borrow_min']){ //设置了最小投标    如果直接满标则不考虑最小投标
		  if($investMoney < $binfo['borrow_min']){ // 小于最低投标
				continue;//不符合最低投资金额
		  }elseif(($needMoney-$investMoney)>0 && ($needMoney-$investMoney) < $binfo['borrow_min']){ // 剩余金额小于最小投标金额 
			  if(($investMoney-$binfo['borrow_min']) >= $binfo['borrow_min']){  // 投资金额- 最小投资金额 大于最小投资金额
					$investMoney = $investMoney-$binfo['borrow_min'];  // 投资 = 投资-最小投资（保证下次投资金额大于最小投资金额）
			  }else{
					continue;
			  }
		  }
      }
      
      if($investMoney > $num_max4){//投资金额不能大于借款金额的10%
      $investMoney = $num_max4;
      }
      if($investMoney%$binfo['borrow_min']!=0 && $investMoney%$binfo['borrow_min']>0){//如果当前可投金额不是最小投资金额的整数倍
		  $investMoney = $binfo['borrow_min']*floor($investMoney%$binfo['borrow_min']);
      }
      if($v['interest_rate'] > 0){
		  if(!($binfo['borrow_interest_rate']>=$v['interest_rate'])){//利率范围
		  continue;	
		  }
      }
      if($v['duration_from'] > 0 && $v['duration_to'] > 0 && $v['duration_from'] <= $v['duration_to']){//借款期限范围
		  if(!(($binfo['borrow_duration']>=$v['duration_from'])&&($binfo['borrow_duration']<=$v['duration_to']))){
		  continue;
		  }
      }
      if(!($investMoney>=$v['min_invest'])){//
      continue;
      }
      if(!($v['money']-$v['account_money']>=$investMoney)){//余额限制
      continue;
      }
      if($needMoney <= 0){//可投金额必须大于0
      continue;
      }
      
      $x = investMoney($v['uid'],$borrow_id,$investMoney,1);
      if($x===true){
      $needMoney = $needMoney - $investMoney;   // 减去剩余已投金额
      MTip('chk27',$v['uid'],$borrow_id,$v['id']);//sss
      M('auto_borrow')->where('id = '.$v['id'])->save(array("invest_time"=>time()));
      }
      }
      return true;
      }
      
      
      //获取当前星期的日期范围，也就是从星期一到星期日的日期范围
      function getWeekRange($date){
      $ret=array();
      $timestamp=strtotime($date);
      $w=strftime('%u',$timestamp);
      $ret['sdate']=date('Y-m-d 00:00:00',$timestamp-($w-1)*86400);
      $ret['edate']=date('Y-m-d 23:59:59',$timestamp+(7-$w)*86400);
      return $ret;
      }
      
      //获取指定日期所在月的开始日期与结束日期
      function getMonthRange($date){
      $ret=array();
      $timestamp=strtotime($date);
      $mdays=date('t',$timestamp);
      $ret['sdate']=date('Y-m-1 00:00:00',$timestamp);
      $ret['edate']=date('Y-m-'.$mdays.' 23:59:59',$timestamp);
      return $ret;
      }
      
  // 以上两个函数的时间段获取应用
  function getFilter($n){
	  $ret=array();
	  switch($n){
		  case 1:// 昨天
		  $ret['sdate']=date('Y-m-d 00:00:00',strtotime('-1 day'));
		  $ret['edate']=date('Y-m-d 23:59:59',strtotime('-1 day'));
		  break;
		  case 2://本星期
		  $ret=getWeekRange(date('Y-m-d'));
		  break;
		  case 3://上一个星期
		  $strDate=date('Y-m-d',strtotime('-1 week'));
		  $ret=getWeekRange($strDate);
		  break;
		  case 4: //上上星期
		  $strDate=date('Y-m-d',strtotime('-2 week'));
		  $ret=getWeekRange($strDate);
		  break;
		  case 5: //本月
		  $ret=getMonthRange(date('Y-m-d'));
		  break;
		  case 6://上月
		  $strDate=date('Y-m-d',strtotime('-1 month'));
		  $ret=getMonthRange($strDate);
		  break;
	  }
	  return $ret;
  } 
      

