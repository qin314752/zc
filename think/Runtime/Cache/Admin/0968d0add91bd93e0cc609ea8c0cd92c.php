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
		<?php if(is_array($sub_menu)): foreach($sub_menu as $key=>$menu): ?><dl id="menu-picture">
			<dt ><?php echo ($key); ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd >
				<ul >
					<?php if(is_array($menu)): foreach($menu as $key1=>$admin_menu): ?><li><a href="<?php echo ($admin_menu['url']); ?>" title="图片管理"><?php echo ($key1); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</dd>
		</dl><?php endforeach; endif; ?>
		<!-- <dl >
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="<?php echo U('Role/admin_role');?>" title="角色管理">角色管理</a></li>
					<li><a href="<?php echo U('Node/admin_node');?>" title="权限管理">权限管理</a></li>
					<li><a href="<?php echo U('User/admin_user_list');?>" title="管理员列表">管理员列表</a></li>

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
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		数据库管理
		<span class="c-gray en">&gt;</span>
		数据库信息 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>	
	<div class="Hui-article">
		<div class="page-container">
		<a href="java	script:;" style="color: #3B5999">数据备份</a>
		<p style="float:right;">数据库中共有<?php echo ($tables); ?>张表，共计<?php echo ($total); ?></p>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th colspan="9" scope="col">信息统计</th>
					</tr>
					<tr class="text-c">
						<th>序号</th>
						<th>表名</th>
						<th>引擎</th>
						<th>编码</th>
						<th>记录数</th>
						<th>大小</th>
						<th>最后更新时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($k % 2 );++$k;?><tr class="text-c">
						<td><?php echo ($k); ?></td>
						<td><?php echo ($tab["name"]); ?></td>
						<td><?php echo ($tab["engine"]); ?></td>
						<td><?php echo ($tab["collation"]); ?></td>
						<td><?php echo ($tab["rows"]); ?></td>
						<td><?php echo ($tab["size"]); ?></td>
						<td><?php echo ($tab["update_time"]); ?></td>
						<td><a href="javascript:;" onclick="admin_role_edit('查看表结构','SysData_list?name=<?php echo ($tab["name"]); ?>','1','800','300')"  style="color: #3B5999">查询表结构</a></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			
				</tbody>
			</table>
			
		</div>
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
	function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

</script>
</body>
</html>