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
				<?php echo ($menu); ?>
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
</script> 
<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
	

<div class="menu_dropdown bk_2">
	<dl id="menu-admin">
	<?php
 foreach ($sub_menu as $value) { foreach ($value['low_title'] as $key => $menu) { ?>
			<dl >
				<dt <?php if($value[2]==1){echo "class='$value[1]'";} ?> >
					<?php echo $menu[0] ?>
					<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
				</dt>
				<dd>
					<ul >
					<?php foreach ($value[$key] as $v) {?>
							<li><a href="<?php echo $v[1]?>" ><?php echo $v[0]?></a></li>
					<?php }?>
					</ul>
				</dd>
			</dl>
			<?php
 } } ?>
		<script type="text/javascript">

			window.onload=function(){
				 $('.shouye').parent('dl').addClass('aa');
        		 $('.shouye').parent('dl').siblings().css("display", "none");
        		 $('.aa').siblings('.aa').css("display", "block");
        		 $('.aa').removeClass('aa');
			}

		</script> 
		<script type="text/javascript">
		function clic(id){
				var clas= $('.' + id);
				 clas.parent('dl').addClass('aa');
        		 clas.parent('dl').siblings().css("display", "none");
        		 $('.aa').siblings('.aa').css("display", "block");
        		 $('.aa').removeClass('aa');
		}

		</script>
<!-- 
		 <dl >
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Role/admin_role');?>" title="角色管理">角色管理</a></li>
					<li><a href="<?php echo U('Node/admin_node');?>" title="权限管理">权限管理</a></li>
					<li><a href="<?php echo U('User/admin_user_list');?>" title="管理员列表管理员列表">管理员列表</a></li>

				</ul>
			</dd>
		</dl>
		<dl >
			<dt><i class="Hui-iconfont">&#xe62d;</i> 数据库管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('SysData/index');?>" title="角色管理">数据库信息</a></li>
					

				</ul>
			</dd>
		</dl>
		<dl >
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
		</dl> -->

	</dl>
		 
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->



<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="javascript:;" class="maincolor">首页</a> 
		<span class="c-999 en">&gt;</span>		<div style="margin-left: 10%;">11<?php echo ($a); ?></php></div>
		<span class="c-666">我的桌面</span> 
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
 <div class="Hui-article">
		<article class="cl pd-20">
		
 <form action="<?php echo U('admin/index/add');?>" method="post" enctype="multipart/form-data">
 收件人邮箱：<input type="text" name="mail"/>
 标题：<input type="text" name="title"/>
 内容<input type="text" name="content"/>
 <input class="button" type="submit" value="发送"/>
 </form>

</article>
		<footer class="footer">
			<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br> Copyright &copy;2015 H-ui.admin v3.0 All Rights Reserved.<br> 本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
</footer>-->
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


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">

</script>
<!--/请在上方写此页面业务相关的脚本-->

</body>
</html>