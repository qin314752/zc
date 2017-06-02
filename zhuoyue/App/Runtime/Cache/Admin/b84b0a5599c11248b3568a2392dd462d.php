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

<div class="so_main">

<div class="page_tit">Wap支付方式管理</div>
<div class="page_tab">
    <span data="tab_1"  class="active">宝付Wap认证支付</span>
    <span data="tab_2">快钱Wap认证支付</span>
    <span data="tab_3">通联Wap认证支付</span>
</div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
        <!--tab1-->
        <div id="tab_1">
            <dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="wappay[baofuwap][enable]" value="<?php echo ($k); ?>" id="wappay[baofuwap][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$baofuwap_config["enable"]==$k)||("key"=="value"&&$baofuwap_config["enable"]==$v)){ ?><input type="radio" name="wappay[baofuwap][enable]" value="<?php echo ($k); ?>" id="wappay[baofuwap][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="wappay[baofuwap][enable]" value="<?php echo ($k); ?>" id="wappay[baofuwap][enable]_<?php echo ($i); ?>" /><?php } ?><label for="wappay[baofuwap][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
            <dl class="lineD"><dt>商户号：</dt><dd><input name="wappay[baofuwap][MemberID]" id="wappay[baofuwap][MemberID]"  class="input" type="text" value="<?php echo ($baofuwap_config["MemberID"]); ?>" ><span id="tip_wappay[baofuwap][MemberID]" class="tip">*</span></dd></dl>
            <dl class="lineD"><dt>终端号：</dt><dd><input name="wappay[baofuwap][TerminalID]" id="wappay[baofuwap][TerminalID]"  class="input" type="text" value="<?php echo ($baofuwap_config["TerminalID"]); ?>" ><span id="tip_wappay[baofuwap][TerminalID]" class="tip">*</span></dd></dl>
            <dl class="lineD"><dt>私钥密码：</dt><dd><input name="wappay[baofuwap][pkey]" id="wappay[baofuwap][pkey]"  class="input" type="text" value="<?php echo ($baofuwap_config["pkey"]); ?>" ><span id="tip_wappay[baofuwap][pkey]" class="tip">*</span></dd></dl>
        </div>
        <!--tab2-->
        <div id="tab_2" style="display: none;">
            <dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="wappay[kuaiqian][enable]" value="<?php echo ($k); ?>" id="wappay[kuaiqian][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$kuaiqian_config["enable"]==$k)||("key"=="value"&&$kuaiqian_config["enable"]==$v)){ ?><input type="radio" name="wappay[kuaiqian][enable]" value="<?php echo ($k); ?>" id="wappay[kuaiqian][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="wappay[kuaiqian][enable]" value="<?php echo ($k); ?>" id="wappay[kuaiqian][enable]_<?php echo ($i); ?>" /><?php } ?><label for="wappay[kuaiqian][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
            <dl class="lineD"><dt>商户号：</dt><dd><input name="wappay[kuaiqian][merchantId]" id="wappay[kuaiqian][merchantId]"  class="input" type="text" value="<?php echo ($kuaiqian_config["merchantId"]); ?>" ><span id="tip_wappay[kuaiqian][merchantId]" class="tip">*</span></dd></dl>
            <!--<dl class="lineD"><dt>终端号：</dt><dd><input name="wappay[kuaiqian][TerminalID]" id="wappay[kuaiqian][TerminalID]"  class="input" type="text" value="<?php echo ($kuaiqian_config["TerminalID"]); ?>" ><span id="tip_wappay[kuaiqian][TerminalID]" class="tip">*</span></dd></dl>-->
            <dl class="lineD"><dt>私钥密码：</dt><dd><input name="wappay[kuaiqian][pkey]" id="wappay[kuaiqian][pkey]"  class="input" type="text" value="<?php echo ($kuaiqian_config["pkey"]); ?>" ><span id="tip_wappay[kuaiqian][pkey]" class="tip">*</span></dd></dl>
        </div>
        <!--tab3-->
        <div id="tab_3" style="display: none;">
            <dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="wappay[allinpaywap][enable]" value="<?php echo ($k); ?>" id="wappay[allinpaywap][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$allinpaywap_config["enable"]==$k)||("key"=="value"&&$allinpaywap_config["enable"]==$v)){ ?><input type="radio" name="wappay[allinpaywap][enable]" value="<?php echo ($k); ?>" id="wappay[allinpaywap][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="wappay[allinpaywap][enable]" value="<?php echo ($k); ?>" id="wappay[allinpaywap][enable]_<?php echo ($i); ?>" /><?php } ?><label for="wappay[allinpaywap][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
            <dl class="lineD"><dt>充值手续费：</dt><dd><input name="wappay[allinpaywap][feerate]" id="wappay[allinpaywap][feerate]"  class="input" type="text" value="<?php echo ($allinpaywap_config["feerate"]); ?>" ><span id="tip_wappay[allinpaywap][feerate]" class="tip">% *</span></dd></dl>
            <dl class="lineD"><dt>商户号：</dt><dd><input name="wappay[allinpaywap][merchantId]" id="wappay[allinpaywap][merchantId]"  class="input" type="text" value="<?php echo ($allinpaywap_config["merchantId"]); ?>" ><span id="tip_wappay[allinpaywap][merchantId]" class="tip">*</span></dd></dl>
            <dl class="lineD"><dt>私钥密码：</dt><dd><input name="wappay[allinpaywap][pkey]" id="wappay[allinpaywap][pkey]"  class="input" type="text" value="<?php echo ($allinpaywap_config["pkey"]); ?>" ><span id="tip_wappay[allinpaywap][pkey]" class="tip">*</span></dd></dl>
        </div>
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
	</div>
	</form>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>