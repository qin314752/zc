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
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js" language="javascript"></script>
<div class="so_main">
<style type="text/css">
.list input[type=text]{
	color: #333333;
    padding-bottom: 2px;
    padding-left: 2px;
    padding-right: 2px;
    padding-top: 2px;
}
li{
	diaplay:block;width:93px;height:27px;background-color:rgb(238,238,238);text-align:center;line-height:25px;
	border:1px solid rgb(189,200,220);
	cursor: pointer;
}
li:hover{
	background-color:rgb(230,230,230);
}
tr:hover{background-color:rgb(238,238,238);}
</style>
<script type="text/javascript">
	$(function(){
			$('li').click(function(){
				$('#search_div').show(300);
				});
			$('a').click(function(){
				$('#search_div').hide(300);
				});
			

	});

</script>
<div class="page_tit">手机信息记录</div>
<!--搜索/筛选会员-->
<div>
	<div id="search_div" style="display:none">
  	<div class="page_tit">搜索/筛选记录 [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__ACTION__">
    <?php if($search["customer_id"] > 0): ?><input type="hidden" name="customer_id" value="<?php echo ($search["customer_id"]); ?>" /><?php endif; ?>
   
   <dl class="lineD">
      <dt>用户名：</dt>
      <dd>
        <input name="uname" style="width:190px" id="title" type="text" value="<?php echo ($search["uname"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>用户手机：</dt>
      <dd>
        <input name="phone" style="width:190px" id="title" type="text" value="<?php echo ($search["phone"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>接口类型：</dt>
      <dd>
        <input name="back_status" style="width:190px" id="title" type="text" value="<?php echo ($search["back_status"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="筛选" />
    </div>
	</form>
  </div>
  </div>

</div>
<!--搜索/筛选会员-->
<div><ul><li>搜索/筛选</li></ul></div>
  
<!-- <div class="page_tab"><span data="tab_1" class="active">通知信息记录</span></div> -->
<div class="form2">
	<!-- <form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data"> -->
	<div id="tab_1">
	  
	  <div class="list">
	  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<!-- <th class="line_l">序号</th> -->
		<th class="line_l">ID</th>
		<th class="line_l">用户名</th>
		<th class="line_l">用户手机</th>
		<th class="line_l" width="50%">内容</th>
		<th class="line_l">添加时间</th>
		<th class="line_l">接口类型</th>
		<!-- <th class="line_l">操作</th> -->
	  </tr>
	  <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
	  		<td><?php echo ($vo["id"]); ?></td>
	  		<td><?php echo ($vo["user_name"]); ?></td>
	  		<td><?php echo ($vo["to_phone"]); ?></td>
	  		<td><?php echo ($vo["content"]); ?></td>
	  		<td><?php echo (date("Y-m-d H:i",$vo["addtime"])); ?></td>
	  		<td><?php echo ($vo["back_status_des"]); ?></td>
	  	</tr><?php endforeach; endif; ?>
		<tr><td colspan="6"><?php echo ($page); ?></td></tr>
	  </table>
		</div>
	</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>