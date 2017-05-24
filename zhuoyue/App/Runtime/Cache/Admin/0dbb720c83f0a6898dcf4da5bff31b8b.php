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
	var editTitle = '审核资料';
	var isSearchHidden = 1;
	var searchName = "搜索会员身份证";
</script>
<div class="so_main">
  <div class="page_tit">会员实名认证管理</div>
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
      <dt>真实姓名：</dt>
      <dd>
        <input name="realname" style="width:190px" id="title" type="text" value="<?php echo ($search["realname"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>身份证号：</dt>
      <dd>
        <input name="idcard" style="width:190px" id="title" type="text" value="<?php echo ($search["idcard"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
	<dl class="lineD"><dt>申请时间(开始)：</dt><dd><input onclick="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="start_time" id="start_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["start_time"])); ?>"><span id="tip_start_time" class="tip">只选开始时间则查询从开始时间往后所有</span></dd></dl>
	<dl class="lineD"><dt>申请时间(结束)：</dt><dd><input onclick="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2020-10-01',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="end_time" id="end_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["end_time"])); ?>"><span id="tip_end_time" class="tip">只选结束时间则查询从结束时间往前所有</span></dd></dl>
    <dl class="lineD">
      <dt>申请状态：</dt>
      <dd>
      <select name="status" id="status" style="width:150px"  class="c_select"><option value="">--请选择--</option><?php foreach($status as $key=>$v){ if($search["status"]==$key && $search["status"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
        <span>不填则不限</span>
      </dd>
    </dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
<!--搜索-->

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索会员身份证</span></a>
    <a class="btn_a" href="__URL__/index?status=1"><span>已认证</span></a>
    <a class="btn_a" href="__URL__/index?status=3"><span>待认证</span></a>
	<a class="btn_a" href="__URL__/export?<?php echo ($query); ?>"><span>将当前条件下数据导出为Excel</span></a>
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
    <th class="line_l">真实姓名</th>
    <th class="line_l">身份证号</th>
    <th class="line_l">身份证图片</th>
    <th class="line_l">上传时间</th>
    <th class="line_l">审核状态</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["uid"]); ?></td>
        <td><a onclick="loadUser(<?php echo ($vo["uid"]); ?>,'<?php echo ($vo["user_name"]); ?>')" href="javascript:void(0);"><?php echo ($vo["user_name"]); ?></a></td>
        <td><?php echo ($vo["real_name"]); ?></td>
        <td><?php echo ($vo["idcard"]); ?></td>
        <td>[<a href="__ROOT__/<?php echo ($vo["card_img"]); ?>" target="_blank">正面查看</a>] [<a href="__ROOT__/<?php echo ($vo["card_back_img"]); ?>" target="_blank">反面查看</a>]</td>
        <td><?php echo (date("Y-m-d H:i",$vo["up_time"])); ?></td>
        <td>
        	<?php if($vo["id_status"] == 3): ?><font color="red">待审核</font>
            <?php elseif($vo["id_status"] == 1): ?>
            	<font color="#00CC00">已认证</font><?php endif; ?>
         </td>
        <td>
        	<?php if($vo["id_status"] == 3): ?><a href="javascript:void(0);" onclick="edit('?id=<?php echo ($vo['uid']); ?>');">审核</a>
            <?php elseif($vo["id_status"] == 1): ?>
            	---<?php endif; ?>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索会员身份证</span></a>
    <a class="btn_a" href="__URL__/index?status=1"><span>已认证</span></a>
    <a class="btn_a" href="__URL__/index?status=3"><span>待认证</span></a>
	<a class="btn_a" href="__URL__/export?<?php echo ($query); ?>"><span>将当前条件下数据导出为Excel</span></a>
  </div>
</div>


<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>