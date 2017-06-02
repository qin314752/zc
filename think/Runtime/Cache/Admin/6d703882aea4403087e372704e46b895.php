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
					<li><a data-href="" data-title="" href="<?php echo U('Port/index');?>">通知信息接口</a></li>
					
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
			<form action="/index.php/Admin/Port/data" method="post" class="form form-horizontal" id="form-article-add">
				<div id="tab-system" class="HuiTab">
					<div class="tabBar cl"><span>短信设置</span><span>邮件设置</span></div>
				<!-- 	<div class="tabCon">
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站名称：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_name"  type="text"  value="<?php echo ($note['wap_name']); ?>" class="input-text">
							</div>
							<span class="c-orange">出现在每个页面的title后面(web_name)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站标题：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_title"  type="text"  value="<?php echo ($note['wap_title']); ?>" class="input-text">
							</div>
							<span class="c-orange">首页标题(index_title)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站关键词：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_antistop"  type="text"  value="<?php echo ($note['wap_antistop']); ?>" class="input-text">
							</div>
							<span class="c-orange">在首页的keywords中显示(web_keywords)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站描述：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_describe"  type="text"   value="<?php echo ($note['wap_describe']); ?>" class="input-text">
							</div>
							<span class="c-orange">在网站首页的描述中显示(web_descript)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站底部：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_bottom"  type="text"  value="<?php echo ($note['wap_bottom']); ?>" class="input-text">
							</div>
							<span class="c-orange">网站底部的版权和联系信息(bottom)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">后台入口：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_admin"  type="text"  value="<?php echo ($note['wap_admin']); ?>" class="input-text">
							</div>
							<span class="c-orange">可修改后台登陆路径,格式为任意字母组合。例如：如填写admin，访问路径即为：【http://www.您的域名.com/shang/admin 】 (admin_url)</span>
						</div>
					</div> -->
					<div class="tabCon">
						<div class="row cl">
							<div style="margin-left: 90px">当前正在使用的短信提供商：<span class="c-orange">&nbsp;<?php echo ($note['provider'] == 1? 漫道 : 亿美); ?></span></div>
							
						</div>
						<div class="row cl" >
							<div style="margin-left: 185px">短信提供商：&nbsp;&nbsp;
								<input type="radio" class="sn" name="provider" value="1" <?php echo ($note['provider']==1? "checked='checked'" : ''); ?>>&nbsp;漫道短信提供商&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" class="cdkey" name="provider" value="2" <?php echo ($note['provider']==2? "checked='checked'" : ''); ?>>&nbsp;亿美软通短信提供商&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
						</div>
						<div id="sn" <?php echo ($note['provider']!=1? "style='display:none'" : ''); ?>>
							<div class="row cl">
								<div style="margin-left: 150px">当前剩余短信条数:&nbsp;&nbsp;<?php echo ($mandao); ?>条</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">sn：</label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="sn"  type="text"  value="<?php echo ($note['sn']); ?>" class="input-text">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">密码: </label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="pwd"  type="password"  value="<?php echo ($note['pwd']); ?>" class="input-text">
								</div>
							</div>
						</div>
						<div id="cdkey" <?php echo ($note['provider']!=2? "style='display:none'" : ''); ?>>
							<div class="row cl">
								<div style="margin-left: 150px">当前剩余短信条数:&nbsp;&nbsp;<?php echo ($yimei); ?>条</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">cdkey：</label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="cdkey"  type="text"  value="<?php echo ($note['cdkey']); ?>" class="input-text">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">密码: </label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="cdkey_pw"  type="password"  value="<?php echo ($note['cdkey_pw']); ?>" class="input-text">
								</div>
							</div>
						</div>
					</div>
					<script type="text/javascript">
							$('.sn').click(function(){
								$('#sn').css('display','');
								$('#cdkey').css('display','none');
							});
							$('.cdkey').click(function(){
								$('#cdkey').css('display','');
								$('#sn').css('display','none');
							});
					</script>
					<div class="tabCon">
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP服务器：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="smtp_server"  type="text"  value="<?php echo ($note['smtp_server']); ?>" class="input-text">
							</div>
							<span class="c-orange">如:smtp.163.com</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP服务器端口：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="smtp_port"  type="text"  value="<?php echo ($note['smtp_port']); ?>" class="input-text">
							</div>
							<span class="c-orange">如:25</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP用户名：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="smtp_user"  type="text"  value="<?php echo ($note['smtp_user']); ?>" class="input-text">
							</div>
							<span class="c-orange">如:123456@qq.com</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP密码：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="smtp_pw"  type="password"  value="<?php echo ($note['smtp_pw']); ?>" class="input-text">
							</div>
						</div>
						
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-3 col-xs-offset-3 col-sm-offset-2">
						<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
						<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
					</div>
				</div>
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