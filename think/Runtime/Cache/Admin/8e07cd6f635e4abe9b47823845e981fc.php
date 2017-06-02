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
					<li><a data-href="" data-title="" href="<?php echo U('NoticeTemplate/index');?>">通知信息模板</a></li>
					
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
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		管理员管理
		<span class="c-gray en">&gt;</span>
		管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加管理员','admin_add','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> </span>
				<span class="r">共有数据：<strong>54</strong> 条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value=""></th>
						<th width="40">ID</th>
						<th width="90">登录名</th>
						<th width="90">真实名称</th>
						<th width="90">手机</th>
						<th width="90">所属用户组</th>
						<th width="100">登录IP地址</th>
						<th width="130">加入时间</th>
						<th width="90">是否已启用</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
				 
					<?php if(is_array($data)): foreach($data as $key=>$user_data): ?><tr class="text-c">
						<td><input type="checkbox" value="" name=""></td>
						<td><?php echo ($user_data["id"]); ?></td>
						<td><?php echo ($user_data["username"]); ?></td>
						<td><?php echo ($user_data["adminname"]); ?></td>
						<td><?php echo ($user_data["phone"]); ?></td>
						<td><?php echo ($user_data["user_role"]); ?></td>
						<td><?php echo ($user_data["last_add_ip"]); ?></td>
						<td><?php echo (date('Y-m-d H:i:s',$user_data["last_add_time"])); ?></td>
						<td class="td-status">
						<?php if($user_data['status'] == 1): ?><span class="label label-success radius">已启用</span>
						<?php else: ?>
						<span class="label radius">已停用</span><?php endif; ?>
						</td>
						<td class="td-manage">
						
						<?php if($user_data['status'] == 1): ?><a style="text-decoration:none" onClick="admin_stop(this,'<?php echo ($user_data["id"]); ?>','<?php echo ($user_data["status"]); ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
						<?php else: ?>
						<a style="text-decoration:none" onClick="admin_stop(this,'<?php echo ($user_data["id"]); ?>','<?php echo ($user_data["status"]); ?>')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a><?php endif; ?>
						<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','admin_edit?id=<?php echo ($user_data["id"]); ?>','<?php echo ($user_data["id"]); ?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
						<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($user_data["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
						</td>
					</tr><?php endforeach; endif; ?>


					
				</tbody>
			</table>
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
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		var id1 = id;
		$.get("<?php echo U('User/del');?>",{id:id1,data:'del'},function(data){
			if(data==0){
				window.location.reload();
				layer.msg('已删除!',{icon:1,time:2000});
			}else{
				layer.msg('删除失败请联系管理员!',{icon:1,time:3000});
			}
		});
		
	});
}
/*管理员-编辑*/
function admin_edit(title,url,id,w,h){

	layer_show(title,url,w,h);
}
/*管理员-*/
function admin_stop(obj,id,status){
	
	layer.confirm('确认要修改吗？',function(index)
	{
		//此处请求后台程序，下方是成功后的前台处理……
		var id1 = id;
		var status1 = status;
		$.get("<?php echo U('User/suop');?>",{id:id1,status:status1},function(data){
		if(data==1){
				window.location.reload();
				layer.msg('已启用!', {icon: 6,time:2000});
			}else if(data==0){
				window.location.reload();
				layer.msg('已停用!',{icon: 5,time:2000});
				
			}

		});

		
	});
}

</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>