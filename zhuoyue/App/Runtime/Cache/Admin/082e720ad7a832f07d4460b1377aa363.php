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

<div class="page_tit">通知信息模板管理---(#UserName#表示接受信息用户的用户名，是一个动态参数，包含#号整体,表示用户名)</div>
<div class="page_tab"><span data="tab_1" class="active">邮件模板</span><span data="tab_2">短信模板</span><span data="tab_3">站内信模板</span></div>
<div class="form2">
	<form method="post" action="__URL__/templetsave" onsubmit="return subcheck();" enctype="multipart/form-data">
	<div id="tab_1">
		<dl class="lineD"><dt>用户注册成功：</dt><dd><textarea name="email[regsuccess]|de_xie=###" id="email[regsuccess]|de_xie=###"  class="areabox" ><?php echo ($emailTxt["regsuccess"]); ?></textarea><span id="tip_email[regsuccess]|de_xie=###" class="tip">#LINK#表示激活链接，只在此邮件下有用</span></dd></dl>
		<dl class="lineD"><dt>安全中心更改安全问题：</dt><dd><textarea name="email[safecode]|de_xie=###" id="email[safecode]|de_xie=###"  class="areabox" ><?php echo ($emailTxt["safecode"]); ?></textarea><span id="tip_email[safecode]|de_xie=###" class="tip">#CODE#表示验证码</span></dd></dl>
		<dl class="lineD"><dt>安全中心新手机安全码：</dt><dd><textarea name="email[changephone]|de_xie=###" id="email[changephone]|de_xie=###"  class="areabox" ><?php echo ($emailTxt["changephone"]); ?></textarea><span id="tip_email[changephone]|de_xie=###" class="tip">#CODE#表示验证码</span></dd></dl>
		<!--<dl class="lineD"><dt>借款申请审核通过：</dt><dd><textarea name="email[verifysuccess]|de_xie=###" id="email[verifysuccess]|de_xie=###"  class="areabox" ><?php echo ($emailTxt["verifysuccess"]); ?></textarea></dd></dl>-->
		<dl class="lineD"><dt>密码找回提示：</dt><dd><textarea name="email[getpass]|de_xie=###" id="email[getpass]|de_xie=###"  class="areabox" ><?php echo ($emailTxt["getpass"]); ?></textarea><span id="tip_email[getpass]|de_xie=###" class="tip">#LINK#表示密码找回链接，只在此邮件下有用</span></dd></dl>
		<!--<dl class="lineD"><dt>到期还款提醒：</dt><dd><textarea name="email[repaymentTip]|de_xie=###" id="email[repaymentTip]|de_xie=###"  class="areabox" ><?php echo ($emailTxt["repaymentTip"]); ?></textarea><span id="tip_email[repaymentTip]|de_xie=###" class="tip">管理员可在还款中的借款查询即将到期的会员信息，并给会员以邮件提醒</span></dd></dl>-->
		<dl class="lineD"><dt>支付密码找回提示：</dt><dd><textarea name="email[getpaypass]|de_xie=###" id="email[getpaypass]|de_xie=###"  class="areabox" ><?php echo ($emailTxt["getpaypass"]); ?></textarea><span id="tip_email[getpaypass]|de_xie=###" class="tip">#LINK#表示支付密码找回链接，只在此邮件下有用</span></dd></dl>
	</div><!--tab1-->
	
	<div id="tab_2" style="display:none">
	<dl class="lineD"><span style="color:#fc8936; padding-left:100px;">【注】：模板内容不要太长，不要包含违法关键字，内容结尾请加网站签名，网站签名格式为：【网站名称】，这样可加快邮件接收速度！</span></dl>
		<dl class="lineD"><dt>线上充值成功：</dt><dd><textarea name="sms[payonline][content]|de_xie=###" id="sms[payonline][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["payonline"]["content"]); ?></textarea><span id="tip_sms[payonline][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#DATE#表示充值日期,#MONEY#表示充值金额</span><input type="checkbox" name="sms[payonline][enable]" value="1" <?php if($smsTxt['payonline']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
		<dl class="lineD"><dt>线下充值成功：</dt><dd><textarea name="sms[payoffline][content]|de_xie=###" id="sms[payoffline][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["payoffline"]["content"]); ?></textarea><span id="tip_sms[payoffline][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#DATE#表示充值日期,#MONEY#表示充值金额</span><input type="checkbox" name="sms[payoffline][enable]" value="1" <?php if($smsTxt['payoffline']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
		<dl class="lineD"><dt>还款到帐：</dt><dd><textarea name="sms[payback][content]|de_xie=###" id="sms[payback][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["payback"]["content"]); ?></textarea><span id="tip_sms[payback][content]|de_xie=###" class="tip">#ID#表示标号,#ORDER#表示期数</span><input type="checkbox" name="sms[payback][enable]" value="1" <?php if($smsTxt['payback']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
		<dl class="lineD"><dt>提现成功：</dt><dd><textarea name="sms[withdraw][content]|de_xie=###" id="sms[withdraw][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["withdraw"]["content"]); ?></textarea><span id="tip_sms[withdraw][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#DATE#表示提现日期，#MONEY#表示提现金额</span><input type="checkbox" name="sms[withdraw][enable]" value="1" <?php if($smsTxt['withdraw']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
		<!--<dl class="lineD"><dt>Vip认证通过：</dt><dd><textarea name="sms[vip][content]|de_xie=###" id="sms[vip][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["vip"]["content"]); ?></textarea><span id="tip_sms[vip][content]|de_xie=###" class="tip">#USERANEM#表示用户名</span><input type="checkbox" name="sms[vip][enable]" value="1" <?php if($smsTxt['vip']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
		<dl class="lineD"><dt>发标初审通过：</dt><dd><textarea name="sms[firstV][content]|de_xie=###" id="sms[firstV][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["firstV"]["content"]); ?></textarea><span id="tip_sms[firstV][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号</span><input type="checkbox" name="sms[firstV][enable]" value="1" <?php if($smsTxt['firstV']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
		<dl class="lineD"><dt>发标流标：</dt><dd><textarea name="sms[refuse][content]|de_xie=###" id="sms[refuse][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["refuse"]["content"]); ?></textarea><span id="tip_sms[refuse][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号</span><input type="checkbox" name="sms[refuse][enable]" value="1" <?php if($smsTxt['refuse']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
		<dl class="lineD"><dt>发标复审通过(对借款人)：</dt><dd><textarea name="sms[approve][content]|de_xie=###" id="sms[approve][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["approve"]["content"]); ?></textarea><span id="tip_sms[approve][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号</span><input type="checkbox" name="sms[approve][enable]" value="1" <?php if($smsTxt['approve']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>发标复审通过(对投资人)：</dt><dd><textarea name="sms[approve_invest][content]|de_xie=###" id="sms[approve_invest][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["approve_invest"]["content"]); ?></textarea><span id="tip_sms[approve_invest][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号</span><input type="checkbox" name="sms[approve_invest][enable]" value="1" <?php if($smsTxt['approve_invest']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        -->
        <dl class="lineD"><dt>手机验时发送验证码：</dt><dd><textarea name="sms[verify_phone]|de_xie=###" id="sms[verify_phone]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["verify_phone"]); ?></textarea><span id="tip_sms[verify_phone]|de_xie=###" class="tip">#CODE#表示验证码</span></dd></dl>
		<dl class="lineD"><dt>安全中心更改安全问题：</dt><dd><textarea name="sms[safecode]|de_xie=###" id="sms[safecode]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["safecode"]); ?></textarea><span id="tip_sms[safecode]|de_xie=###" class="tip">#CODE#表示验证码</span></dd></dl>
		<dl class="lineD"><dt>安全中心更改手机号码：</dt><dd><textarea name="sms[changephone]|de_xie=###" id="sms[changephone]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["changephone"]); ?></textarea><span id="tip_sms[changephone]|de_xie=###" class="tip">#CODE#表示验证码</span></dd></dl>
		<dl class="lineD"><dt>安全中心新手机验证码：</dt><dd><textarea name="sms[newphone]|de_xie=###" id="sms[newphone]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["newphone"]); ?></textarea><span id="tip_sms[newphone]|de_xie=###" class="tip">#CODE#表示验证码</span></dd></dl>
		<!--<dl class="lineD"><dt>会员设置的新标提醒：</dt><dd><textarea name="sms[newtip]|de_xie=###" id="sms[newtip]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["newtip"]); ?></textarea><span id="tip_sms[newtip]|de_xie=###" class="tip">这种群发式短信中不能使用##这种的动态变量</span></dd></dl>-->
        <dl class="lineD"><dt>众筹投资成功：</dt><dd><textarea name="sms[crowdinvest][content]|de_xie=###" id="sms[crowdinvest][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdinvest"]["content"]); ?></textarea><span id="tip_sms[crowdinvest][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投资金额</span><input type="checkbox" name="sms[crowdinvest][enable]" value="1" <?php if($smsTxt['crowdinvest']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>众筹筹资成功，出售中：</dt><dd><textarea name="sms[crowdsell][content]|de_xie=###" id="sms[crowdsell][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdsell"]["content"]); ?></textarea><span id="tip_sms[crowdsell][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号</span><input type="checkbox" name="sms[crowdsell][enable]" value="1" <?php if($smsTxt['crowdsell']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>众筹发起投票：</dt><dd><textarea name="sms[crowdvote][content]|de_xie=###" id="sms[crowdvote][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdvote"]["content"]); ?></textarea><span id="tip_sms[crowdvote][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号</span><input type="checkbox" name="sms[crowdvote][enable]" value="1" <?php if($smsTxt['crowdvote']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>众筹投票成功：</dt><dd><textarea name="sms[crowdvotesucc][content]|de_xie=###" id="sms[crowdvotesucc][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdvotesucc"]["content"]); ?></textarea><span id="tip_sms[crowdvotesucc][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投票金额</span><input type="checkbox" name="sms[crowdvotesucc][enable]" value="1" <?php if($smsTxt['crowdvotesucc']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>众筹投票失败：</dt><dd><textarea name="sms[crowdvotefail][content]|de_xie=###" id="sms[crowdvotefail][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdvotefail"]["content"]); ?></textarea><span id="tip_sms[crowdvotefail][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投票金额</span><input type="checkbox" name="sms[crowdvotefail][enable]" value="1" <?php if($smsTxt['crowdvotefail']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>众筹回款到账：</dt><dd><textarea name="sms[crowdvotedone][content]|de_xie=###" id="sms[crowdvotedone][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdvotedone"]["content"]); ?></textarea><span id="tip_sms[crowdvotedone][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示到账金额</span><input type="checkbox" name="sms[crowdvotedone][enable]" value="1" <?php if($smsTxt['crowdvotedone']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>众筹预约：</dt><dd><textarea name="sms[crowdauto][content]|de_xie=###" id="sms[crowdauto][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdauto"]["content"]); ?></textarea><span id="tip_sms[crowdauto][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#MONEY#表示预约金额</span><input type="checkbox" name="sms[crowdvotedone][enable]" value="1" <?php if($smsTxt['crowdvotedone']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
        <dl class="lineD"><dt>众筹预约投资：</dt><dd><textarea name="sms[crowdautoinvest][content]|de_xie=###" id="sms[crowdautoinvest][content]|de_xie=###"  class="areabox" ><?php echo ($smsTxt["crowdautoinvest"]["content"]); ?></textarea><span id="tip_sms[crowdautoinvest][content]|de_xie=###" class="tip">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投资金额</span><input type="checkbox" name="sms[crowdvotedone][enable]" value="1" <?php if($smsTxt['crowdvotedone']['enable'] == 1): ?>checked="checked"<?php endif; ?> />开启</dd></dl>
    </div><!--tab2-->
	
	<div id="tab_3" style="display:none">
		<dl class="lineD"><dt>用户注册成功：</dt><dd><textarea name="msg[regsuccess]|de_xie=###" id="msg[regsuccess]|de_xie=###"  class="areabox" ><?php echo ($msgTxt["regsuccess"]); ?></textarea></dd></dl>
		<!--<dl class="lineD"><dt>借款申请审核通过：</dt><dd><textarea name="msg[verifysuccess]|de_xie=###" id="msg[verifysuccess]|de_xie=###"  class="areabox" ><?php echo ($msgTxt["verifysuccess"]); ?></textarea></dd></dl>-->
	</div><!--tab3-->
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
	  <div>#UserName#表示接受信息用户的用户名，是一个动态参数,如" #UserName#你好，恭喜您注册成功",那么用户'test'收到的信息就是 "test你好，恭喜您注册成功"</div>
	</div>
	</form>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>