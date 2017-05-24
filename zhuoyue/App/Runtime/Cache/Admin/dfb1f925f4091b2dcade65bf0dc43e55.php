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

<div class="page_tit">登录方式管理</div>
<div class="page_tab"><span data="tab_1" class="active">QQ登录</span><span data="tab_2">新浪微博</span><span data="tab_3">UC同步登录</span><span data="tab_4">COOKIE_KEY</span></div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
	<div id="tab_1">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="login[qq][enable]" value="<?php echo ($k); ?>" id="login[qq][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$qq_config["enable"]==$k)||("key"=="value"&&$qq_config["enable"]==$v)){ ?><input type="radio" name="login[qq][enable]" value="<?php echo ($k); ?>" id="login[qq][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="login[qq][enable]" value="<?php echo ($k); ?>" id="login[qq][enable]_<?php echo ($i); ?>" /><?php } ?><label for="login[qq][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>APP_ID：</dt><dd><input name="login[qq][id]" id="login[qq][id]"  class="input" type="text" value="<?php echo ($qq_config["id"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>APP_KEY：</dt><dd><input name="login[qq][key]" id="login[qq][key]"  class="input" type="text" value="<?php echo ($qq_config["key"]); ?>" ></dd></dl>
	</div>
	<div id="tab_2" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="login[sina][enable]" value="<?php echo ($k); ?>" id="login[sina][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$sina_config["enable"]==$k)||("key"=="value"&&$sina_config["enable"]==$v)){ ?><input type="radio" name="login[sina][enable]" value="<?php echo ($k); ?>" id="login[sina][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="login[sina][enable]" value="<?php echo ($k); ?>" id="login[sina][enable]_<?php echo ($i); ?>" /><?php } ?><label for="login[sina][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>WB_AKEY：</dt><dd><input name="login[sina][akey]" id="login[sina][akey]"  class="input" type="text" value="<?php echo ($sina_config["akey"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>WB_SKEY：</dt><dd><input name="login[sina][skey]" id="login[sina][skey]"  class="input" type="text" value="<?php echo ($sina_config["skey"]); ?>" ></dd></dl>
	</div><!--tab2-->
	
	<div id="tab_3" style="display:none">
		<dl class="lineD"><dt>是否启用：</dt><dd><?php $i=0;$___KEY=array ( 1 => '是', 0 => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="login[uc][enable]" value="<?php echo ($k); ?>" id="login[uc][enable]_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$uc_config["enable"]==$k)||("key"=="value"&&$uc_config["enable"]==$v)){ ?><input type="radio" name="login[uc][enable]" value="<?php echo ($k); ?>" id="login[uc][enable]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="login[uc][enable]" value="<?php echo ($k); ?>" id="login[uc][enable]_<?php echo ($i); ?>" /><?php } ?><label for="login[uc][enable]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
		<dl class="lineD"><dt>UCenter 通信相关</dt><dd>与UC链接验证的相关信息</dd></dl>
		<dl class="lineD"><dt>UC_KEY：</dt><dd><input name="login[uc][UC_KEY]" id="login[uc][UC_KEY]"  class="input" type="text" value="<?php echo ($uc_config["UC_KEY"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>UCenter的 URL 地址：</dt><dd><input name="login[uc][UC_API]" id="login[uc][UC_API]"  class="input" type="text" value="<?php echo ($uc_config["UC_API"]); ?>" ><span id="tip_login[uc][UC_API]" class="tip">带http://</span></dd></dl>
		<dl class="lineD"><dt>UCenter 的字符集：</dt><dd><input name="login[uc][UC_CHARSET]" id="login[uc][UC_CHARSET]"  class="input" type="text" value="<?php echo ($uc_config["UC_CHARSET"]); ?>" ><span id="tip_login[uc][UC_CHARSET]" class="tip">gbk | utf-8</span></dd></dl>
		<dl class="lineD"><dt>UCenter 的 IP：</dt><dd><input name="login[uc][UC_IP]" id="login[uc][UC_IP]"  class="input" type="text" value="<?php echo ($uc_config["UC_IP"]); ?>" ><span id="tip_login[uc][UC_IP]" class="tip">默认留空,当前应用服务器解析域名有问题时, 请设置此值</span></dd></dl>
		<dl class="lineD"><dt>当前应用的 ID：</dt><dd><input name="login[uc][UC_APPID]" id="login[uc][UC_APPID]"  class="input" type="text" value="<?php echo ($uc_config["UC_APPID"]); ?>" ></dd></dl>

		<dl class="lineD"><dt>UCenter 数据库相关</dt><dd>UC所用数据库的相关信息</dd></dl>
		<dl class="lineD"><dt>UCenter 数据库主机：</dt><dd><input name="login[uc][UC_DBHOST]" id="login[uc][UC_DBHOST]"  class="input" type="text" value="<?php echo ($uc_config["UC_DBHOST"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>UCenter 数据库用户名：</dt><dd><input name="login[uc][UC_DBUSER]" id="login[uc][UC_DBUSER]"  class="input" type="text" value="<?php echo ($uc_config["UC_DBUSER"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>UCenter 数据库密码：</dt><dd><input name="login[uc][UC_DBPW]" id="login[uc][UC_DBPW]"  class="input" type="text" value="<?php echo ($uc_config["UC_DBPW"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>UCenter 数据库名称：</dt><dd><input name="login[uc][UC_DBNAME]" id="login[uc][UC_DBNAME]"  class="input" type="text" value="<?php echo ($uc_config["UC_DBNAME"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>UCenter 数据库字符集：</dt><dd><input name="login[uc][UC_DBCHARSET]" id="login[uc][UC_DBCHARSET]"  class="input" type="text" value="<?php echo ($uc_config["UC_DBCHARSET"]); ?>" ></dd></dl>
		<dl class="lineD"><dt>UCenter 数据库表前缀：</dt><dd><input name="login[uc][UC_DBTABLEPRE]" id="login[uc][UC_DBTABLEPRE]"  class="input" type="text" value="<?php echo ($uc_config["UC_DBTABLEPRE"]); ?>" ></dd></dl>

	</div><!--tab3-->
	<div id="tab_4" style="display:none">
		<dl class="lineD"><dt>cookie加密密钥：</dt><dd><input name="login[cookie][key]" id="login[cookie][key]"  class="input" type="text" value="<?php echo ($cookie_config["key"]); ?>" ><span id="tip_login[cookie][key]" class="tip">尽量复杂</span></dd></dl>
	</div><!--tab2-->
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
	</div>
	</form>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>