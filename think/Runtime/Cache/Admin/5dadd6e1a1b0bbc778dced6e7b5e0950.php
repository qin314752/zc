<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/Public/Admin/favicon.ico" >
<link rel="Shortcut Icon" href="/Public/Admin/favicon.ico" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/style.css" />
<title>H-ui.admin v3.0</title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
<!-- 图片上传 -->
		<script type="text/javascript" src="/Public/upload/js/jquery.js"></script>
        <script type="text/javascript" src="/Public/upload/js/swfupload.js"></script>
        <script type="text/javascript" src="/Public/upload/js/handlers.js"></script>
        <link href="/Public/upload/css/default.css" rel="stylesheet" type="text/css" />
<!-- 图片上传 end-->
</head>
<body>

<!--_header 作为公共模版分离出去-->
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">H-ui.admin</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> 
			<span class="logo navbar-slogan f-l mr-10 hidden-xs">v3.0</span> 
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"> 新增 </a>
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"> 新增 </a>
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"> 新增 </a>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li> <a href="javascript:;" onclick="del()" >清除缓存</a></li>
					<li class="dropDown dropDown_hover">&nbsp; &nbsp;&nbsp;&nbsp;admin &nbsp;
						
			</li>
					<li id="Hui-msg"> <a href="#" >首页</a> </li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" >退出</a>
						
			</li>
		</ul>
	</nav>
</div>
</div>
</header>
<!--/_header 作为公共模版分离出去-->
<!-- <script type="text/javascript">
	function del(){
		$.get('/Admin/Index/del',function(data){
			if(data){
				layer.msg('已清除缓存',{icon: 1,time:3000});
			}else{
				layer.Hui-msg('清除缓存失败',{icon: 2,time:3000});
			}
		} );
	}
</script> -->
<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
	

	<div class="menu_dropdown bk_2">
		<dl id="menu-admin">
<div style="margin-left: 10%;"><?php echo ($a); ?></php></div>
		<dl id="menu-admin">
			
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Role/admin_role');?>" title="角色管理">角色管理</a></li>
					<li><a href="<?php echo U('Node/admin_node');?>" title="权限管理">权限管理</a></li>
					<li><a href="<?php echo U('User/admin_user_list');?>" title="管理员列表">管理员列表</a></li>

				</ul>
			</dd>
		</dl>
		<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 数据库管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('SysData/index');?>" title="角色管理">数据库信息</a></li>
					<li><a href="<?php echo U('Node/admin_node');?>" title="权限管理">备份数据库</a></li>
					<li><a href="<?php echo U('User/admin_user_list');?>" title="管理员列表">清空数据</a></li>

				</ul>
			</dd>
		</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="" data-title="" href="<?php echo U('Notice/index');?>">通知信息接口</a></li>
					<li><a data-href="" data-title="" href="<?php echo U('Notice/template');?>">通知信息模板</a></li>
					
				</ul>
			</dd>
		</dl>
<dl >
			<dt><i class="Hui-iconfont">&#xe62e;</i> 众筹<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="" data-title="" href="<?php echo U('Crowd/index');?>">发起项目</a></li>
					
				</ul>
			</dd>
		</dl>

</dl>
		
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<form action="/index.php/Admin/Notice/template_data" method="post" class="form form-horizontal" id="form-article-add">
				<div id="tab-system" class="HuiTab">
				<div style="color:#1E325C;font-size: 16px">通知信息模板管理---(#UserName#表示接受信息用户的用户名，是一个动态参数，包含#号整体,表示用户名)</div>
					<div class="tabBar cl">
					<span>邮件设置</span>
					<span>短信设置</span>
					</div>
					<div class="tabCon">
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">用户注册成功:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="email_regsuccess" class="textarea_color" ><?php echo ($emailtxt['email_regsuccess']); ?></textarea> 
							</div>
							<span class="c-orange">#LINK#表示激活链接，只在此邮件下有用</span>
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">安全中心更改安全问题:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="email_safecode"  class="textarea_color" ><?php echo ($emailtxt['email_safecode']); ?></textarea> 
							</div>
							<span class="c-orange">#CODE#表示验证码</span>
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">安全中心新手机安全码:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="email_changephone"  class="textarea_color" ><?php echo ($emailtxt['email_changephone']); ?></textarea> 
							</div>
							<span class="c-orange">#CODE#表示验证码</span>
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">密码找回提示:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="email_getpass"  class="textarea_color" ><?php echo ($emailtxt['email_getpass']); ?></textarea> 
							</div>
							<span class="c-orange">#LINK#表示密码找回链接，只在此邮件下有用</span>
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">支付密码找回提示:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="email_getpaypass"  class="textarea_color" ><?php echo ($emailtxt['email_getpaypass']); ?></textarea> 
							</div>
							<span class="c-orange">#LINK#表示支付密码找回链接，只在此邮件下有用</span>
						</div>
					</div>

					<div class="tabCon">
					<span class="c-orange" style="margin-left: 170px;">【注】：模板内容不要太长，不要包含违法关键字，内容结尾请加网站签名，网站签名格式为：【网站名称】，这样可加快邮件接收速度！</span>
						<div class="row cl dashed">
							<label class="form-label col-xs-3 col-sm-2">用户注册成功:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="regsuccess"  class="textarea_color" ><?php echo ($smstxt['regsuccess']); ?></textarea> 
							</div>
						</div>
						<div class="row cl dashed" name="payonline">
							<label class="form-label col-xs-3 col-sm-2">线上充值成功:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="payonline[content]"  class="textarea_color" ><?php echo ($smstxt['payonline']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#DATE#表示充值日期,#MONEY#表示充值金额</span>
							<input type="checkbox" <?php echo ($smstxt['payonline']['enable'] == 1? "checked='checked'" : ''); ?> name="payonline[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="payoffline">
							<label class="form-label col-xs-3 col-sm-2">线下充值成功:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="payoffline[content]"  class="textarea_color" ><?php echo ($smstxt['payoffline']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#DATE#表示充值日期,#MONEY#表示充值金额</span>
							<input type="checkbox" <?php echo ($smstxt['payoffline']['enable'] == 1? "checked='checked'" : ''); ?> name="payoffline[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="payback">
							<label class="form-label col-xs-3 col-sm-2">还款到帐:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="payback[content]"  class="textarea_color" ><?php echo ($smstxt['payback']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#ID#表示标号,#ORDER#表示期数</span>
							<input type="checkbox" <?php echo ($smstxt['payback']['enable'] == 1? "checked='checked'" : ''); ?> name="payback[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="withdraw">
							<label class="form-label col-xs-3 col-sm-2">提现成功:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="withdraw[content]"  class="textarea_color" ><?php echo ($smstxt['withdraw']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#DATE#表示提现日期，#MONEY#表示提现金额</span>
							<input type="checkbox" <?php echo ($smstxt['withdraw']['enable'] == 1? "checked='checked'" : ''); ?> name="withdraw[enable]" value="1">开启
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">手机验时发送验证码:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="verify_phone"  class="textarea_color" ><?php echo ($smstxt['verify_phone']); ?></textarea> 
							</div>
							<span class="c-orange">#CODE#表示验证码</span>
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">安全中心更改安全问题:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="safecode"  class="textarea_color" ><?php echo ($smstxt['safecode']); ?></textarea> 
							</div>
							<span class="c-orange">#CODE#表示验证码</span>
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">安全中心更改手机号码:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="changephone"  class="textarea_color" ><?php echo ($smstxt['changephone']); ?></textarea> 
							</div>
							<span class="c-orange">#CODE#表示验证码</span>
						</div>
						<div class="row cl dashed" >
							<label class="form-label col-xs-3 col-sm-2">安全中心新手机验证码:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="newphone"  class="textarea_color" ><?php echo ($smstxt['newphone']); ?></textarea> 
							</div>
							<span class="c-orange">#CODE#表示验证码</span>
						</div>
						<div class="row cl dashed" name="crowdinvest">
							<label class="form-label col-xs-3 col-sm-2">众筹投资成功:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdinvest[content]"  class="textarea_color" ><?php echo ($smstxt['crowdinvest']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投资金额</span>
							<input type="checkbox" <?php echo ($smstxt['crowdinvest']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdinvest[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="crowdsell">
							<label class="form-label col-xs-3 col-sm-2">众筹筹资成功，出售中:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdsell[content]"  class="textarea_color" ><?php echo ($smstxt['crowdsell']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#ID#表示标号</span>
							<input type="checkbox" <?php echo ($smstxt['crowdsell']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdsell[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="crowdvote">
							<label class="form-label col-xs-3 col-sm-2">众筹发起投票:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdvote[content]"  class="textarea_color" ><?php echo ($smstxt['crowdvote']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#ID#表示标号</span>
							<input type="checkbox" <?php echo ($smstxt['crowdvote']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdvote[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="crowdvotesucc">
							<label class="form-label col-xs-3 col-sm-2">众筹投票成功:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdvotesucc[content]"  class="textarea_color" ><?php echo ($smstxt['crowdvotesucc']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投票金额</span>
							<input type="checkbox" <?php echo ($smstxt['crowdvotesucc']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdvotesucc[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="crowdvotefail">
							<label class="form-label col-xs-3 col-sm-2">众筹投票失败:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdvotefail[content]"  class="textarea_color" ><?php echo ($smstxt['crowdvotefail']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投票金额</span>
							<input type="checkbox" <?php echo ($smstxt['crowdvotefail']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdvotefail[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="crowdvotedone">
							<label class="form-label col-xs-3 col-sm-2">众筹回款到账:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdvotedone[content]"  class="textarea_color" ><?php echo ($smstxt['crowdvotedone']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示到账金额</span>
							<input type="checkbox" <?php echo ($smstxt['crowdvotedone']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdvotedone[enable]" value="1">开启
						</div>
						<div class="row cl dashed" name="crowdauto">
							<label class="form-label col-xs-3 col-sm-2">众筹预约:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdauto[content]"  class="textarea_color" ><?php echo ($smstxt['crowdauto']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#MONEY#表示预约金额</span>
							<input type="checkbox" <?php echo ($smstxt['crowdauto']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdauto[enable]" value="1">开启
						</div>
						<div  class="row cl dashed" name="crowdautoinvest">
							<label class="form-label col-xs-3 col-sm-2">众筹预约投资:</label>
							<div class="formControls col-xs-8 col-sm-3">
								<textarea name="crowdautoinvest[content]"  class="textarea_color" ><?php echo ($smstxt['crowdautoinvest']['content']); ?></textarea> 
							</div>
							<span class="c-orange">#USERANEM#表示用户名,#ID#表示标号,#MONEY#表示投资金额</span>
							<input type="checkbox" <?php echo ($smstxt['crowdautoinvest']['enable'] == 1? "checked='checked'" : ''); ?> name="crowdautoinvest[enable]" value="1" >开启
						</div>
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-3 col-xs-offset-3 col-sm-offset-2">
						<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
						<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
						<span>(所有方式修改提交一次即可)</span>
					</div>
				</div>
				<div style="color:#1E325C;font-size: 16px">#UserName#表示接受信息用户的用户名，是一个动态参数,如" #UserName#你好，恭喜您注册成功",那么用户'test'收到的信息就是 "test你好，恭喜您注册成功"</div>
			</form>
		</article>
	</div>
</section>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/Admin/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本 -->
<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 

<!--请在下方写此页面业务相关的脚本 -->
<script type="text/javascript" src="/Public/Admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/laypage/1.2/laypage.js"></script>

<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.min.js"></script> 
<!-- 时间 插件-->
<script src="/Public/time/laydate/laydate.js"></script>

<!-- 编辑器 插件 -->
 <script type="text/javascript" charset="utf-8" src="/Public/editor/ueditor.config.js"></script>
 <script type="text/javascript" charset="utf-8" src="/Public/editor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
 <script type="text/javascript" charset="utf-8" src="/Public/editor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});
</script>