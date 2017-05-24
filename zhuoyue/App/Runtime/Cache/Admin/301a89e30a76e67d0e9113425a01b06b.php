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
</script>

<div class="so_main">
  <div class="page_tit">手机认证会员</div>
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
      <dt>认证手机号：</dt>
      <dd>
        <input name="user_phone" style="width:190px" id="title" type="text" value="<?php echo ($search["user_phone"]); ?>">
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
    <a class="btn_a" href="__URL__/index?status=3"><span>待审核</span></a>
    <a class="btn_a" href="__URL__/index?status=1"><span>已通过审核</span></a>
    <a class="btn_a" href="__URL__/index?status=2"><span>未通过审核</span></a>
    <a class="btn_a" href="__URL__/export?<?php echo ($query); ?>"><span>将当前条件下数据导出为Excel</span></a>
  </div>
  <div class="list">
    <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th style="width:30px;"> <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
          <label for="checkbox"></label>
        </th>
        <th class="line_l">ID</th>
        <th class="line_l">用户名</th>
        <th class="line_l">真实姓名</th>
        <th class="line_l">认证手机号</th>
        <th class="line_l">总余额</th>
        <th class="line_l">可用余额</th>
        <th class="line_l">冻结金额</th>
        <!--<th class="line_l">待收金额</th>-->
        <th class="line_l">注册时间</th>
        <th class="line_l">状态</th>
        <th class="line_l">操作</th>
      </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
          <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
          <td><?php echo ($vo["id"]); ?></td>
          <td><a onclick="loadUser(<?php echo ($vo["id"]); ?>,'<?php echo ($vo["user_name"]); ?>')" href="javascript:void(0);"><?php echo ($vo["user_name"]); ?></a></td>
          <td><?php echo (($vo["real_name"])?($vo["real_name"]):"&nbsp;"); ?></td>
          <td><?php echo ($vo["user_phone"]); ?></td>
          <td>¥<?php echo ($vo['money_freeze'] + $vo['account_money'] + $vo['money_collect']); ?></td>
          <td>¥<?php echo (($vo["account_money"])?($vo["account_money"]):0); ?></td>
          <td>¥<?php echo (($vo["money_freeze"])?($vo["money_freeze"]):0); ?></td>
          <!--<td><?php echo (($vo["money_collect"])?($vo["money_collect"]):0); ?>元</td>-->
          <td><?php echo (date("Y-m-d H:i",$vo["reg_time"])); ?></td>
          <td><?php if($vo['phone_status'] == 3): ?><span style="color:#F00">待审核</span>
              <?php elseif($vo['phone_status'] == 1): ?>
              <span style="color:#090">审核通过</span>
              <?php else: ?>
              审核未通过<?php endif; ?></td>
          <td><?php if($vo['phone_status'] != 1): ?><a href="__URL__/edit?id=<?php echo ($vo['uid']); ?>">审核</a>
              <?php else: ?>
              ----<?php endif; ?>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </div>
  <div class="Toolbar_inbox">
    <div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选会员</span></a>
    <a class="btn_a" href="__URL__/index?status=3"><span>待审核</span></a>
    <a class="btn_a" href="__URL__/index?status=1"><span>已通过审核</span></a>
    <a class="btn_a" href="__URL__/index?status=2"><span>未通过审核</span></a>
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