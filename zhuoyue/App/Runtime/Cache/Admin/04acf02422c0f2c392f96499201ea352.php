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

<style type="text/css">
.sel_fs{width:110px}
</style>
<!--调试内容开始-->
<!--<pre><?php var_dump($_SERVER); ?></pre>-->
<!--调试内容结束-->
<div class="so_main">

<div class="page_tit">修改会员</div>
<div class="page_tab"><span data="tab_1" class="active">基本信息</span><span data="tab_2">基本资料</span><span data="tab_3">银行卡信息</span></div>
<div class="form2">
	<form method="post" action="__URL__/doEdit" onsubmit="return subcheck();">
	<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
	<input type="hidden" name="uid" value="<?php echo ($vo["id"]); ?>" />
	
	<div id="tab_1">
	<!--<dl class="lineD"><dt>是否内部发标人员：</dt><dd><?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_vip" value="<?php echo ($k); ?>" id="is_vip_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_vip"]==$k)||("key"=="value"&&$vo["is_vip"]==$v)){ ?><input type="radio" name="is_vip" value="<?php echo ($k); ?>" id="is_vip_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_vip" value="<?php echo ($k); ?>" id="is_vip_<?php echo ($i); ?>" /><?php } ?><label for="is_vip_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_is_vip" class="tip">内部发标人员可以拥有直接发布借款标的特权，无需等待各项认证通过才能发标，仅用于平台内部人员</span></dd></dl>
	<dl class="lineD"><dt>是否优计划发标人员：</dt><dd><?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_transfer" value="<?php echo ($k); ?>" id="is_transfer_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_transfer"]==$k)||("key"=="value"&&$vo["is_transfer"]==$v)){ ?><input type="radio" name="is_transfer" value="<?php echo ($k); ?>" id="is_transfer_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_transfer" value="<?php echo ($k); ?>" id="is_transfer_<?php echo ($i); ?>" /><?php } ?><label for="is_transfer_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_is_transfer" class="tip">选择是才可以以此会员身份在后台发布优计划</span></dd></dl>-->
        <dl class="lineD"><dt>是否众筹发标人员：</dt><dd><?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_crowd_users" value="<?php echo ($k); ?>" id="is_crowd_users_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_crowd_users"]==$k)||("key"=="value"&&$vo["is_crowd_users"]==$v)){ ?><input type="radio" name="is_crowd_users" value="<?php echo ($k); ?>" id="is_crowd_users_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_crowd_users" value="<?php echo ($k); ?>" id="is_crowd_users_<?php echo ($i); ?>" /><?php } ?><label for="is_crowd_users_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_is_crowd_users" class="tip">选择是才可以以此会员身份在后台发布众筹</span></dd></dl>
	<dl class="lineD"><dt>是否冻结：</dt><dd><?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_ban" value="<?php echo ($k); ?>" id="is_ban_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_ban"]==$k)||("key"=="value"&&$vo["is_ban"]==$v)){ ?><input type="radio" name="is_ban" value="<?php echo ($k); ?>" id="is_ban_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_ban" value="<?php echo ($k); ?>" id="is_ban_<?php echo ($i); ?>" /><?php } ?><label for="is_ban_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_is_ban" class="tip">冻结后会员不能登录，须联系客服处理</span></dd></dl>
	<!--<dl class="lineD"><dt>是否允许发布借款：</dt><dd><?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="is_borrow" value="<?php echo ($k); ?>" id="is_borrow_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["is_borrow"]==$k)||("key"=="value"&&$vo["is_borrow"]==$v)){ ?><input type="radio" name="is_borrow" value="<?php echo ($k); ?>" id="is_borrow_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_borrow" value="<?php echo ($k); ?>" id="is_borrow_<?php echo ($i); ?>" /><?php } ?><label for="is_borrow_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_is_borrow" class="tip">会员只有被允许发布借款时，才可以发标</span></dd></dl>-->
	<dl class="lineD"><dt>客户类型：</dt><dd><?php $i=0;foreach($utype as $k=>$v){ if(strlen("key1")==1&&$i==0){ ?><input type="radio" name="user_type" value="<?php echo ($k); ?>" id="user_type_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="key1"&&$k==$vo["user_type"]){ ?><input type="radio" name="user_type" value="<?php echo ($k); ?>" id="user_type_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="value1"&&$v==$vo["user_type"]){ ?><input type="radio" name="user_type" value="<?php echo ($k); ?>" id="user_type_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="user_type" value="<?php echo ($k); ?>" id="user_type_<?php echo ($i); ?>" /><?php } ?><label for="user_type_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++;} ?></dd></dl>
	<dl class="lineD"><dt>客服ID：</dt><dd><input name="customer_id" id="customer_id"  class="input" type="text" value="<?php echo ($vo["customer_id"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>新密码：</dt><dd><input name="user_pass" id="user_pass"  class="input" type="text" value="" ><span id="tip_user_pass" class="tip">如不修改则留空</span></dd></dl>
	<dl class="lineD"><dt>确认新密码：</dt><dd><input name="re_user_pass" id="re_user_pass"  class="input" type="text" value="" ><span id="tip_re_user_pass" class="tip">如不修改则留空</span></dd></dl>
	<dl class="lineD"><dt>新支付密码：</dt><dd><input name="pin_pass" id="pin_pass"  class="input" type="text" value="" ><span id="tip_pin_pass" class="tip">如不修改则留空</span></dd></dl>
	<dl class="lineD"><dt>确认支付密码：</dt><dd><input name="re_pin_pass" id="re_pin_pass"  class="input" type="text" value="" ><span id="tip_re_pin_pass" class="tip">如不修改则留空</span></dd></dl>
	</div><!--tab1-->

	<div id="tab_2" style="display:none">
	<dl class="lineD"><dt>会员名：</dt><dd><input name="user_name" id="user_name"  class="input" type="text" value="<?php echo ($vo["user_name"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>真实姓名：</dt><dd><input name="real_name" id="real_name"  class="input" type="text" value="<?php echo ($vo["real_name"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>身份证号：</dt><dd><input name="idcard" id="idcard"  class="input" type="text" value="<?php echo ($vo["idcard"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>手机号码：</dt><dd><input name="cell_phone" id="cell_phone"  class="input" type="text" value="<?php echo ($vo["cell_phone"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>会员邮箱：</dt><dd><input name="user_email" id="user_email"  class="input" type="text" value="<?php echo ($vo["user_email"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>地址：</dt><dd><input name="address" id="address"  class="input" type="text" value="<?php echo ($vo["address"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>年龄：</dt><dd><input name="age" id="age"  class="input" type="text" value="<?php echo ($vo["age"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>职业：</dt><dd><input name="zy" id="zy"  class="input" type="text" value="<?php echo ($vo["zy"]); ?>" ></dd></dl>
	<!--//////////////////////////////////////////////-->
	<dl class="lineD"><dt>身份证正面图片：</dt><dd><div style="text-align:left; clear:both; overflow:hidden; width:290px; height:100px"><div id="imgDiv"></div><?php if($vo["card_img"] == ''): ?>无缩略图<?php else: ?><img src="__ROOT__/<?php echo ($vo["card_img"]); ?>" width="100" height="100" /><?php endif; ?></div>
	</dd></dl>
	<dl class="lineD"><dt>身份证反面图片：</dt><dd><div style="text-align:left; clear:both; overflow:hidden; width:290px; height:100px"><div id="imgDiv"></div><?php if($vo["card_back_img"] == ''): ?>无缩略图<?php else: ?><img src="__ROOT__/<?php echo ($vo["card_back_img"]); ?>" width="100" height="100" /><?php endif; ?></div>
	</dd></dl>
<!--//////////////////////////////////////////////-->
	</div><!--tab1-->
	
	<!--银行卡信息-->
	<div id="tab_3"  style="display:none">
	<dl class="lineD"><dt>银行账号：</dt><dd><input name="bank_num" id="bank_num"  class="input" type="text" value="<?php echo ($vo["bank_num"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>银行名称：</dt><dd><select name="bank_name" id="bank_name"  style="width: 110px;" class="c_select selectStyle"><option value="">--请选择--</option><?php foreach($bank_list as $key=>$v){ if($vo["bank_name"]==$key && $vo["bank_name"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_bank_name" class="tip">*</span></dd></dl>
	<dl class="lineD"><dt>开户银行所在省份：</dt><dd>
	<input name="bank_province" id="bank_province"  class="input" type="text" value="<?php echo ($vo["bank_province"]); ?>" ><span id="tip_bank_province" class="tip">如:山东省</span>		
	</dd></dl>
	<dl class="lineD"><dt>开户银行所在市：</dt><dd>
	<input name="bank_city" id="bank_city"  class="input" type="text" value="<?php echo ($vo["bank_city"]); ?>" ><span id="tip_bank_city" class="tip">如:济南市</span>
	</dd></dl>
	<dl class="lineD"><dt>开户行支行名称：</dt><dd><input name="bank_address" id="bank_address"  class="input" type="text" value="<?php echo ($vo["bank_address"]); ?>" ><span id="tip_bank_address" class="tip">如:高新区支行</span></dd></dl>
	
	</div>
	<!--银行卡信息-->
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" />
	</div>
	</form>
</div>
<script type="text/javascript">

function subcheck(){
	var pass = $("#user_pass").val();
	var re_pass = $("#re_user_pass").val();
	if( (pass!=""||re_pass!="") && re_pass!=pass){
		ui.error("新密码和确认密码不能相同，如不修改则都留空");
		return false;
	}
	var pin = $("#pin_pass").val();
	var re_pin = $("#re_pin_pass").val();
	if( (pin!=""||re_pin!="") && re_pin!=pin){
		ui.error("新支付密码和确认支付密码不相同，如不修改则都留空");
		return false;
	}
	return true;
}

</script>
</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>