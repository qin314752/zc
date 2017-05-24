<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<link href="__ROOT__/Style/A/css/style.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/A/js/tbox/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
</head>
<body>

<script type="text/javascript">
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
	var isSearchHidden = 1;
	var searchName = "搜索/筛选会员";
    var indexUrl = '__URL__/index';
</script>
<div class="so_main">
  <div class="page_tit">会员帐户详细</div>
    <input type="hidden" value="<?php echo ($flag); ?>" id="flag"/>
<!--搜索/筛选会员-->
    <!-------- 搜索游戏 -------->
  <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__URL__/index">
    <?php if($search["uid"] > 0): ?><input type="hidden" name="uid" value="<?php echo ($search["uid"]); ?>" /><?php endif; ?>
    <dl class="lineD">
      <dt>会员名：</dt>
      <dd>
        <input name="uname" style="width:190px" id="title" type="text" value="<?php echo ($search["uname"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>真实姓名：</dt>
      <dd>
        <input name="realname" style="width:190px" id="title" type="text" value="<?php echo ($search["realname"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>可用余额：</dt>
      <dd>
      <select name="lx" id="lx" style="width:80px"  class="c_select"><option value="">--请选择--</option><?php foreach($lx as $key=>$v){ if($search["lx"]==$key && $search["lx"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
      <select name="bj" id="bj" style="width:80px"  class="c_select"><option value="">--请选择--</option><?php foreach($bj as $key=>$v){ if($search["bj"]==$key && $search["bj"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
      <input name="money" id="money" style="width:100px" class="input" type="text" value="<?php echo ($search["money"]); ?>" >
        <span>不填则不限</span>
      </dd>
    </dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
<!--搜索/筛选会员-->

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选会员</span></a>
    <a class="btn_a" href="__URL__/export?<?php echo ($query); ?>"><span>将当前条件下数据导出为Excel</span></a>
  </div>
  
  <div class="list" style=" overflow:scroll">
  <table id="area_list" width="2000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">用户名</th>
    <th class="line_l">真实姓名</th>
    <th class="line_l"  onclick="OrderBy('total',indexUrl,<?php echo ($flag); ?>+1);" style="cursor: hand;">总资产</th>
    <th class="line_l"  onclick="OrderBy('total_money',indexUrl,<?php echo ($flag); ?>+1);" style="cursor: hand;">可用余额</th>
    <th class="line_l"  onclick="OrderBy('money_freeze',indexUrl,<?php echo ($flag); ?>+1);" style="cursor: hand;">冻结金额</th>

   <!-- <th class="line_l">待收本息金额</th>-->
	<th class="line_l">在投金额</th>
	<!--<th class="line_l">待收利息</th>
    <th class="line_l">待付本息金额</th>
	<th class="line_l">待付本金</th>
	<th class="line_l">待付利息</th>-->


    <th class="line_l">待审核提现+手续费</th>
    <th class="line_l">处理中提现+手续费</th>

	<th class="line_l">累计提现手续费</th>
	<th class="line_l">累计充值手续费</th>
    <th class="line_l">累计提现金额</th>
    <th class="line_l">累计充值金额</th>
    <th class="line_l">累计支付佣金</th>
	<!--<th class="line_l">累计投标奖励</th>-->

	<th class="line_l">累计推广奖励</th>
	<!--<th class="line_l">累计充值奖励</th>
	<th class="line_l">累计续投奖励</th>-->

	<th class="line_1">净赚利息</th>
	<th class="line_l">净付利息</th>
	<th class="line_1">管理员操作资金</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["user_name"]); ?></td>
        <td><?php echo ($vo["real_name"]); ?></td>
        <td><?php echo ($vo['money_freeze'] + $vo['total_money'] + $vo['money_collect']); ?></td>
        <td><?php echo (($vo["total_money"])?($vo["total_money"]):0); ?></td>
        <td><?php echo (($vo["money_freeze"])?($vo["money_freeze"]):0); ?></td>

	    <!--<td><?php echo Fmoney($vo['benefit']['interest_collection']+$vo['benefit']['capital_collection']);?></td>-->
		<td><?php echo (($vo["benefit"]["capital_collection"])?($vo["benefit"]["capital_collection"]):"0.00"); ?></td>
          <!--<td><?php echo (($vo["benefit"]["interest_collection"])?($vo["benefit"]["interest_collection"]):"0.00"); ?></td>

          <td><?php echo Fmoney($vo['out']['interest_pay'] + $vo['out']['capital_pay']);?></td>
          <td><?php echo (($vo["out"]["capital_pay"])?($vo["out"]["capital_pay"]):"0.00"); ?></td>
          <td><?php echo (($vo["out"]["interest_pay"])?($vo["out"]["interest_pay"]):"0.00"); ?></td>
          <td><?php echo (date("Y-m-d H:i",$vo["reg_time"])); ?></td>-->

		<td><?php echo (($vo["dshtx"])?($vo["dshtx"]):"0.00"); ?></td>
		<td><?php echo (($vo["chulizhong"])?($vo["chulizhong"]):"0.00"); ?></td>

		
        <td><?php echo (($vo["out"]["withdraw_fee"])?($vo["out"]["withdraw_fee"]):"0.00"); ?></td>
        <td><?php echo (($vo["out"]["czfee"])?($vo["out"]["czfee"]):"0.00"); ?></td>
		<td><?php echo (($vo["out"]["withdraw_money"])?($vo["out"]["withdraw_money"]):"0.00"); ?></td>
		<td><?php echo (($vo["count"]["payonline"])?($vo["count"]["payonline"]):"0.00"); ?></td>
		<td><?php echo (($vo["count"]["commission"])?($vo["count"]["commission"]):"0.00"); ?></td>
		<!--<td><?php echo (($vo["benefit"]["ireward"])?($vo["benefit"]["ireward"]):"0.00"); ?></td>-->

		<td><?php echo (($vo["benefit"]["spread_reward"])?($vo["benefit"]["spread_reward"]):"0.00"); ?></td>
		<!--<td><?php echo (($vo["benefit"]["re_reward"])?($vo["benefit"]["re_reward"]):"0.00"); ?></td>
		<td><?php echo (($vo["benefit"]["con_reward"])?($vo["benefit"]["con_reward"]):"0.00"); ?></td>-->

		<td><?php echo (($vo["benefit"]["interest"])?($vo["benefit"]["interest"]):"0.00"); ?></td>
		<td><?php echo (($vo["out"]["interest"])?($vo["out"]["interest"]):"0.00"); ?></td>
		<td><?php echo (($vo["glycz"])?($vo["glycz"]):"0.00"); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选会员</span></a>
    <a class="btn_a" href="__URL__/export?<?php echo ($query); ?>"><span>将当前条件下数据导出为Excel</span></a>
  </div>
</div>
<script type="text/javascript">
function showurl(url,Title){
	ui.box.load(url, {title:Title});
}
</script>

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>