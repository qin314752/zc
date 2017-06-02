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

<div class="page_tit">支付方式管理</div>
<div class="page_tab">
	<span data="tab_3"  class="active">双乾网络支付</span>
    <span data="tab_1"  >汇潮支付</span>
    <span data="tab_2">环迅支付</span>
    <span data="tab_4">宝付</span>
<!--    <span data="tab_6">财付通</span>
    <span data="tab_7">国付宝</span>
    <span data="tab_8">易生支付</span>
    <span data="tab_9">中国移动支付</span> -->
    <span data="tab_10">通联支付</span>
</div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
	<!--tab1-->
	<div id="tab_1" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[ecpss][enable]" value="<?php echo ($k); ?>" id="pay[ecpss][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$ecpss_config["enable"]==$k)||("key"=="value"&&$ecpss_config["enable"]==$v)){ ?><input type="radio" name="pay[ecpss][enable]" value="<?php echo ($k); ?>" id="pay[ecpss][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[ecpss][enable]" value="<?php echo ($k); ?>" id="pay[ecpss][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[ecpss][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[ecpss][feerate]" id="pay[ecpss][feerate]"  class="input" type="text" value="<?php echo ($ecpss_config["feerate"]); ?>" ><span id="tip_pay[ecpss][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[ecpss][MerNo]" id="pay[ecpss][MerNo]"  class="input" type="text" value="<?php echo ($ecpss_config["MerNo"]); ?>" ><span id="tip_pay[ecpss][MerNo]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[ecpss][MD5key]" id="pay[ecpss][MD5key]"  class="input" type="text" value="<?php echo ($ecpss_config["MD5key"]); ?>" ><span id="tip_pay[ecpss][MD5key]" class="tip">*</span></dd></dl>
	</div>
	<!--tab2-->
	
	<div id="tab_2" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[ips][enable]" value="<?php echo ($k); ?>" id="pay[ips][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$ips_config["enable"]==$k)||("key"=="value"&&$ips_config["enable"]==$v)){ ?><input type="radio" name="pay[ips][enable]" value="<?php echo ($k); ?>" id="pay[ips][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[ips][enable]" value="<?php echo ($k); ?>" id="pay[ips][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[ips][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[ips][feerate]" id="pay[ips][feerate]"  class="input" type="text" value="<?php echo ($ips_config["feerate"]); ?>" ><span id="tip_pay[ips][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[ips][MerCode]" id="pay[ips][MerCode]"  class="input" type="text" value="<?php echo ($ips_config["MerCode"]); ?>" ><span id="tip_pay[ips][MerCode]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>商户证书：</dt><dd><input name="pay[ips][MerKey]" id="pay[ips][MerKey]"  class="input" type="text" value="<?php echo ($ips_config["MerKey"]); ?>" ><span id="tip_pay[ips][MerKey]" class="tip">*</span></dd></dl>
	</div>
		<!--tab3-->
	<div id="tab_3" >
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[epay95][enable]" value="<?php echo ($k); ?>" id="pay[epay95][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$epay95_config["enable"]==$k)||("key"=="value"&&$epay95_config["enable"]==$v)){ ?><input type="radio" name="pay[epay95][enable]" value="<?php echo ($k); ?>" id="pay[epay95][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[epay95][enable]" value="<?php echo ($k); ?>" id="pay[epay95][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[epay95][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[epay95][feerate]" id="pay[epay95][feerate]"  class="input" type="text" value="<?php echo ($epay95_config["feerate"]); ?>" ><span id="tip_pay[epay95][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[epay95][MerNo]" id="pay[epay95][MerNo]"  class="input" type="text" value="<?php echo ($epay95_config["MerNo"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>MD5密钥：</dt><dd><input name="pay[epay95][MD5key]" id="pay[epay95][MD5key]"  class="input" type="text" value="<?php echo ($epay95_config["MD5key"]); ?>" ></dd></dl>
	</div>
	<!--tab4-->
	<div id="tab_4" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[baofoo][enable]" value="<?php echo ($k); ?>" id="pay[baofoo][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$baofoo_config["enable"]==$k)||("key"=="value"&&$baofoo_config["enable"]==$v)){ ?><input type="radio" name="pay[baofoo][enable]" value="<?php echo ($k); ?>" id="pay[baofoo][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[baofoo][enable]" value="<?php echo ($k); ?>" id="pay[baofoo][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[baofoo][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[baofoo][feerate]" id="pay[baofoo][feerate]"  class="input" type="text" value="<?php echo ($baofoo_config["feerate"]); ?>" ><span id="tip_pay[baofoo][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[baofoo][MemberID]" id="pay[baofoo][MemberID]"  class="input" type="text" value="<?php echo ($baofoo_config["MemberID"]); ?>" ><span id="tip_pay[baofoo][MemberID]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>终端号：</dt><dd><input name="pay[baofoo][TerminalID]" id="pay[baofoo][TerminalID]"  class="input" type="text" value="<?php echo ($baofoo_config["TerminalID"]); ?>" ><span id="tip_pay[baofoo][TerminalID]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>商户证书：</dt><dd><input name="pay[baofoo][pkey]" id="pay[baofoo][pkey]"  class="input" type="text" value="<?php echo ($baofoo_config["pkey"]); ?>" ><span id="tip_pay[baofoo][pkey]" class="tip">*</span></dd></dl>
	</div>
	<!--tab6
	<div id="tab_6" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[tenpay][enable]" value="<?php echo ($k); ?>" id="pay[tenpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$tenpay_config["enable"]==$k)||("key"=="value"&&$tenpay_config["enable"]==$v)){ ?><input type="radio" name="pay[tenpay][enable]" value="<?php echo ($k); ?>" id="pay[tenpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[tenpay][enable]" value="<?php echo ($k); ?>" id="pay[tenpay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[tenpay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[tenpay][feerate]" id="pay[tenpay][feerate]"  class="input" type="text" value="<?php echo ($tenpay_config["feerate"]); ?>" ><span id="tip_pay[tenpay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[tenpay][partner]" id="pay[tenpay][partner]"  class="input" type="text" value="<?php echo ($tenpay_config["partner"]); ?>" ><span id="tip_pay[tenpay][partner]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[tenpay][key]" id="pay[tenpay][key]"  class="input" type="text" value="<?php echo ($tenpay_config["key"]); ?>" ><span id="tip_pay[tenpay][key]" class="tip">*</span></dd></dl>
	</div>
	-->
	<!--tab7
	<div id="tab_7"  style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[guofubao][enable]" value="<?php echo ($k); ?>" id="pay[guofubao][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$guofubao_config["enable"]==$k)||("key"=="value"&&$guofubao_config["enable"]==$v)){ ?><input type="radio" name="pay[guofubao][enable]" value="<?php echo ($k); ?>" id="pay[guofubao][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[guofubao][enable]" value="<?php echo ($k); ?>" id="pay[guofubao][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[guofubao][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[guofubao][feerate]" id="pay[guofubao][feerate]"  class="input" type="text" value="<?php echo ($guofubao_config["feerate"]); ?>" ><span id="tip_pay[guofubao][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户代码：</dt><dd><input name="pay[guofubao][merchantID]" id="pay[guofubao][merchantID]"  class="input" type="text" value="<?php echo ($guofubao_config["merchantID"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>商户识别码：</dt><dd><input name="pay[guofubao][VerficationCode]" id="pay[guofubao][VerficationCode]"  class="input" type="text" value="<?php echo ($guofubao_config["VerficationCode"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>国付宝帐号：</dt><dd><input name="pay[guofubao][virCardNoIn]" id="pay[guofubao][virCardNoIn]"  class="input" type="text" value="<?php echo ($guofubao_config["virCardNoIn"]); ?>" ></dd></dl>
	</div>-->
        <!--tab8
	<div id="tab_8" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[easypay][enable]" value="<?php echo ($k); ?>" id="pay[easypay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$easypay_config["enable"]==$k)||("key"=="value"&&$easypay_config["enable"]==$v)){ ?><input type="radio" name="pay[easypay][enable]" value="<?php echo ($k); ?>" id="pay[easypay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[easypay][enable]" value="<?php echo ($k); ?>" id="pay[easypay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[easypay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[easypay][feerate]" id="pay[easypay][feerate]"  class="input" type="text" value="<?php echo ($easypay_config["feerate"]); ?>" ><span id="tip_pay[easypay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户开户邮箱：</dt><dd><input name="pay[easypay][seller_email]" id="pay[easypay][seller_email]"  class="input" type="text" value="<?php echo ($easypay_config["seller_email"]); ?>" ><span id="tip_pay[easypay][seller_email]" class="tip">商户开户时注册用的Email邮箱</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[easypay][partner]" id="pay[easypay][partner]"  class="input" type="text" value="<?php echo ($easypay_config["partner"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[easypay][key]" id="pay[easypay][key]"  class="input" type="text" value="<?php echo ($easypay_config["key"]); ?>" ></dd></dl>
		</div>-->
	<!--tab9
	<div id="tab_9" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[cmpay][enable]" value="<?php echo ($k); ?>" id="pay[cmpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$cmpay_config["enable"]==$k)||("key"=="value"&&$cmpay_config["enable"]==$v)){ ?><input type="radio" name="pay[cmpay][enable]" value="<?php echo ($k); ?>" id="pay[cmpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[cmpay][enable]" value="<?php echo ($k); ?>" id="pay[cmpay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[cmpay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[cmpay][feerate]" id="pay[cmpay][feerate]"  class="input" type="text" value="<?php echo ($cmpay_config["feerate"]); ?>" ><span id="tip_pay[cmpay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[cmpay][merchantId]" id="pay[cmpay][merchantId]"  class="input" type="text" value="<?php echo ($cmpay_config["merchantId"]); ?>" ><span id="tip_pay[cmpay][merchantId]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>支付密钥：</dt><dd><input name="pay[cmpay][serverCert]" id="pay[cmpay][serverCert]"  class="input" type="text" value="<?php echo ($cmpay_config["serverCert"]); ?>" ><span id="tip_pay[cmpay][serverCert]" class="tip">*</span></dd></dl>
	</div>
	-->
	<!--tab10-->
	<div id="tab_10" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="pay[allinpay][enable]" value="<?php echo ($k); ?>" id="pay[allinpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$allinpay_config["enable"]==$k)||("key"=="value"&&$allinpay_config["enable"]==$v)){ ?><input type="radio" name="pay[allinpay][enable]" value="<?php echo ($k); ?>" id="pay[allinpay][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="pay[allinpay][enable]" value="<?php echo ($k); ?>" id="pay[allinpay][enable]_<?php echo ($i); ?>" /><?php } ?><label for="pay[allinpay][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>充值手续费：</dt><dd><input name="pay[allinpay][feerate]" id="pay[allinpay][feerate]"  class="input" type="text" value="<?php echo ($allinpay_config["feerate"]); ?>" ><span id="tip_pay[allinpay][feerate]" class="tip">%</span></dd></dl>
		<dl class="lineD"><dt>商户号：</dt><dd><input name="pay[allinpay][MerCode]" id="pay[allinpay][MerCode]"  class="input" type="text" value="<?php echo ($allinpay_config["MerCode"]); ?>" ><span id="tip_pay[allinpay][MerCode]" class="tip">*</span></dd></dl>
		<dl class="lineD"><dt>商户key：</dt><dd><input name="pay[allinpay][key]" id="pay[allinpay][key]"  class="input" type="text" value="<?php echo ($allinpay_config["key"]); ?>" ><span id="tip_pay[allinpay][key]" class="tip">*</span></dd></dl>
	</div>
	<!--tab10-->
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
	</div>
	</form>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>