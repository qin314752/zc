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

<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script type="text/javascript">
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
	var editUrl = '__URL__/edit';
	var editTitle = '处理充值';
	var isSearchHidden = 1;
	var searchName = "搜索充值";
</script>
<div class="so_main">
  <div class="page_tit">线上充值列表</div>
<!--搜索-->
    <!-------- 搜索游戏 -------->
  <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__URL__/index">
    <dl class="lineD">
      <dt>会员名：</dt>
      <dd>
        <input name="uname" style="width:190px" id="title" type="text" value="<?php echo ($search["uname"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>

    <dl class="lineD">
      <dt>处理人：</dt>
      <dd>
        <input name="dealuser" style="width:190px" id="title" type="text" value="<?php echo ($search["dealuser"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>充值状态：</dt>
      <dd>
		<?php $i=0;foreach($type_list as $k=>$v){ if(strlen("key1")==1&&$i==0){ ?><input type="radio" name="status" value="<?php echo ($k); ?>" id="status_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="key1"&&$k==$search["status"]){ ?><input type="radio" name="status" value="<?php echo ($k); ?>" id="status_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="value1"&&$v==$search["status"]){ ?><input type="radio" name="status" value="<?php echo ($k); ?>" id="status_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="status" value="<?php echo ($k); ?>" id="status_<?php echo ($i); ?>" /><?php } ?><label for="status_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++;} ?>
        <span>不选择则不限</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>充值方式：</dt>
      <dd>
		<select name="way" id="way"   class="c_select"><option value="">--请选择--</option><?php foreach($payType as $key=>$v){ if($search["way"]==$key && $search["way"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
        <span>不选择则不限</span>
      </dd>
    </dl>
	
	<dl class="lineD"><dt>时间从：</dt><dd><input onclick="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}',dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true});" name="start_time" id="start_time"  class="input" type="text" value="<?php echo ($search["start_time"]); ?>"><span id="tip_start_time" class="tip">时间段</span></dd></dl>
	<dl class="lineD"><dt>到：</dt><dd><input onclick="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2020-10-01',dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true});" name="end_time" id="end_time"  class="input" type="text" value="<?php echo ($search["end_time"]); ?>"><span id="tip_end_time" class="tip">时间段</span></dd></dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
<!--搜索-->

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索充值</span></a>
	
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">会员名</th>
    <th class="line_l">充值方式</th>
    <th class="line_l">充值金额</th>
    <th class="line_l">充值时间</th>
    <th class="line_l">充值状态</th>
    <th class="line_l">对帐订单号</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><a onclick="loadUser(<?php echo ($vo["uid"]); ?>,'<?php echo ($vo["uname"]); ?>')" href="javascript:void(0);"><?php echo ($vo["uname"]); ?></a></td>
		
        <!-- <td><?php if($vo["way"] != '线下充值'): echo ($vo["way"]); else: ?>线下充值<?php endif; ?></td> -->
		<td><?php echo ($vo["way"]); ?></td>
        <td><?php echo ($vo["money"]); ?></td>
        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
        <td><?php echo ($vo["status"]); ?></td>
        <td><?php echo (($vo["tran_id"])?($vo["tran_id"]):"无"); if($vo["way"] == '线下充值'): ?>入帐银行：<?php echo ($vo["off_bank"]); ?>##充值方式：<?php echo ($vo["off_way"]); endif; ?></td>
        <td><?php if($vo["status_num"] == 0): ?><a href="javascript:;" onclick="edit('?id=<?php echo ($vo["id"]); ?>')">操作</a><?php else: ?>----<?php endif; ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索充值</span></a>
  </div>
</div>


<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>