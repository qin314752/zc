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
					<li><a data-href="" data-title="" href="<?php echo U('System/index');?>">系统设置</a></li>
					
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
			<form action="/index.php/Admin/Crowd/data" method="post" class="form form-horizontal" id="form-article-add">
				<div id="tab-system" class="HuiTab">
					<div class="tabBar cl"><span>添加众筹</span></div>
			 <div class="tabCon" >
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">众筹项目名称:</label>
					<span class="formControls col-xs-3 col-sm-3" >
						<input style="height: 25px" type="text" name="new_project_name" value="第1期项目-" class="input-text">
					</span>
					<span class="c-orange">*</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">发起人:</label>
					<span class="formControls col-xs-3 col-sm-2" >
						<select class="select" name="new_initiator" >
		 					<option value="">---请选择---</option>
		 					<option value="发起人1">发起人1</option>
		 					<option value="发起人2">发起人2</option>
		 					<option value="发起人3">发起人3</option>
						</select>
					</span>
					<span class="c-orange">*</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">发布车商:</label>
					<span class="formControls col-xs-3 col-sm-2" >
						<select class="select" name="crowd_dealer" >
		 					<option value="">---请选择---</option>
		 					<option value="发布车商1">***发布车商1</option>
		 					<option value="发布车商2">***发布车商2</option>
		 					<option value="发布车商3">***发布车商3</option>
						</select>
					</span>
					<span class="c-orange">*</span>
				</div>

				
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">项目金额:</label>
					<span class="formControls col-xs-3 col-sm-3" >
						<input style="height: 25px" name="project_money" type="text" value="" class="input-text"></span>
					<span class="c-orange">*元</span>
				</div>

				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">上线:</label>
					<span class="formControls col-xs-3 col-sm-3" >
						<div class="formControls skin-minimal">
						<div class="radio-box">
							<input name="status" type="radio"  value="1"  checked>
							<label for="sex-1">有效</label>
						</div>
						<div class="radio-box">
							<input type="radio" value="0" name="status">
							<label for="sex-2">无效</label>
						</div>
						</div>
					</span>
				</div>


				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">开始时间:</label>
					<span class="formControls col-xs-3 col-sm-2" >
						
						<input placeholder="请输入日期" name="new_project_time" class="laydate-icon" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
						<script>
						!function(){
						laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
						laydate({elem: '#demo'});//绑定元素
						}();
						</script>
					</span>
					<span class="c-orange">*月</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">集资期限:</label>
					<span class="formControls col-xs-3 col-sm-2" >
					<select class="select" name="new_money_time" >
		 					<option value="">---请选择---</option>
		 					<option value="1">1天</option>
		 					<option value="2">2天</option>
		 					<option value="3">3天</option>
		 					<option value="4">4天</option>
		 					<option value="5">5天</option>
		 					<option value="6">6天</option>
		 					<option value="7">7天</option>
		 					<option value="8">8天</option>
		 					<option value="9">9天</option>
		 					<option value="10">10天</option>
						</select>
					</span>
					<span class="c-orange">*天</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">众筹最小金额:</label>
					<span class="formControls col-xs-3 col-sm-2" >
					<select class="select" name="money_size" >
		 					<option value="">---请选择---</option>
		 					<option value="100">100</option>
		 					<option value="1000">1000</option>
						</select>
					</span>
					<span class="c-orange">*元</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">最长持有期限:</label>
					<span class="formControls col-xs-3 col-sm-2" >
					<select class="select" name="time_longest" >
		 					<option value="">---请选择---</option>
		 					<option value="0.5">0.5个月</option>
		 					<option value="1">1个月</option>
		 					<option value="2">2个月</option>
		 					<option value="3">3个月</option>
		 					<option value="4">4个月</option>
		 					<option value="5">5个月</option>
		 					<option value="6">6个月</option>
		 					<option value="7">7个月</option>
		 					<option value="8">8个月</option>
		 					<option value="9">9个月</option>
		 					<option value="10">10个月</option>
		 					<option value="11">11个月</option>
		 					<option value="12">12个月</option>
						</select>
					</span>
					<span class="c-orange">*月</span>
				</div>

				
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">分红比例:</label>
					<span class="formControls col-xs-3 col-sm-3" >
						<input style="height: 25px" name="profit_ratio" type="text" value="" class="input-text">
					</span>
					<span class="c-orange">*(该比例为投资人所分红比例,若填写10表示，该次众筹总收益的10%由投资人所分配，90%归平台所有)</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">溢价回购利率:</label>
					<span class="formControls col-xs-3 col-sm-3" >
						<input style="height: 25px" type="text" name="premium_ratio" value="" class="input-text">
					</span>
					<span class="c-orange">*(溢价回购比率溢价回购投资人所得收益为：投资本金*(溢价率/12)*该众筹最长持有期限)，溢价率即为年化收益率)</span>
				</div>
				
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">车型:</label>
					<span class="formControls col-xs-3 col-sm-2" >
					<select class="select" name="vehicle_model" >
		 					<option value="">---请选择---</option>
		 					<option value="轿车">轿车</option>
		 					<option value="SUV/越野车">SUV/越野车</option>
		 					<option value="MPV">MPV</option>
		 					<option value="跑车">跑车</option>
		 					<option value="皮卡">皮卡</option>
		 					<option value="其他">其他</option>
						</select>
					</span>
					<span class="c-orange">*</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">车辆参数:</label>
					<span class="formControls col-xs-3 col-sm-5" >
					<script id="editor" type="text/plain" name="car_parameters" style="width:100%;height:250px;"></script></span>
					<span class="c-orange">*</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">项目简介:</label>
					<span class="formControls col-xs-3 col-sm-5" >
						<script id="editor1" type="text/plain" name="project_brief" style="width:100%;height:250px;"></script></span>
					</span>
				</div>
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">车辆图片:</label>
					<span class="formControls col-xs-3 col-sm-4" >

						<!-- <input style="height: 25px" type="text" value="" class="input-text"> -->
						   <div class="demo">
				                <div style="width: 95%; height: auto; border: 1px solid #e1e1e1; font-size: 12px; padding: 10px;">
				                    <span id="spanButtonPlaceholder"></span>
				                    <div id="divFileProgressContainer"></div>
				                    <div id="thumbnails">
				                        <ul id="pic_list" style="margin: 5px;"></ul>
				                        <div style="clear: both;"></div>
				                    </div>
				                </div>
				            </div>
				             <script type="text/javascript">
					            var swfu;
					            var file_queue_limit = 100;//队列1，每次只能上传1个,若是1个以上，上传后的样式是叠加图片
					            window.onload = function() {
					                swfu = new SWFUpload({
					                    upload_url: "<?php echo U('Admin/Crowd/upload');?>",
					                    post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
					                    file_size_limit: "2 MB", //最大2M
					                    file_types: "*.jpg;*.png;*.gif;*.bmp", //设置选择文件的类型
					                    file_types_description: "JPG Images", //描述文件类型
					                    file_upload_limit: "0", //0代表不受上传个数的限制
					                    file_queue_limit:file_queue_limit,
					                    file_queue_error_handler: fileQueueError,
					                    file_dialog_complete_handler: fileDialogComplete, //当关闭选择框后,做触发的事件
					                    upload_progress_handler: uploadProgress, //处理上传进度
					                    upload_error_handler: uploadError, //错误处理事件
					                    upload_success_handler: uploadSuccess, //上传成功够,所处理的时间
					                    upload_complete_handler: uploadComplete, //上传结束后,处理的事件
					                    button_image_url: "/Public/upload/images/upload.png",
					                    button_placeholder_id: "spanButtonPlaceholder",
					                    button_width: 113,
					                    button_height: 33,
					                    button_text: '',
					                    button_text_style: '.spanButtonPlaceholder { font-family: Helvetica, Arial, sans-serif; font-size: 14pt;} ',
					                    button_text_top_padding: 0,
					                    button_text_left_padding: 0,
					                    button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
					                    button_cursor: SWFUpload.CURSOR.HAND,
					                    flash_url: "/Public/upload/js/swfupload.swf",
					                    custom_settings: {
					                        upload_target: "divFileProgressContainer"
					                    },
					                    debug: 1 //是否开启日志
					                });
					            };
					        </script>
					</span>
					<span class="c-orange">*文件的类型(小于2M) .jpg .png .gif .bmp </span>
				</div>
				
				<div class="row cl" style="border-bottom: 1px dashed #E2E2E2;margin-top:-1px;padding-top:2px;padding-bottom:5px;">
					<label class="form-label col-xs-3 col-sm-2">合同:</label>
					<span class="formControls col-xs-3 col-sm-5" >
						<script id="editor2" name="project_pact" type="text/plain" style="width:100%;height:250px;"></script></span>
					</span>
					<span class="c-orange">*</span>
				</div>
				
				
			</div>

		</div>
		<div class="row cl">
			<div class="col-xs-3 col-sm-3 col-xs-offset-3 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
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

<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
    var ue = UE.getEditor('editor1');
    var ue = UE.getEditor('editor2');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    // function insertHtml() {
    //     var value = prompt('插入html代码', '');
    //     UE.getEditor('editor').execCommand('insertHtml', value)
    // }
    // function createEditor() {
    //     enableBtn();
    //     UE.getEditor('editor');
    // }
    // function getAllHtml() {
    //     alert(UE.getEditor('editor').getAllHtml())
    // }
    // function getContent() {
    //     var arr = [];
    //     arr.push("使用editor.getContent()方法可以获得编辑器的内容");
    //     arr.push("内容为：");
    //     arr.push(UE.getEditor('editor').getContent());
    //     alert(arr.join("\n"));
    // }
    // function getPlainTxt() {
    //     var arr = [];
    //     arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
    //     arr.push("内容为：");
    //     arr.push(UE.getEditor('editor').getPlainTxt());
    //     alert(arr.join('\n'))
    // }
    // function setContent(isAppendTo) {
    //     var arr = [];
    //     arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
    //     UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
    //     alert(arr.join("\n"));
    // }
    // function setDisabled() {
    //     UE.getEditor('editor').setDisabled('fullscreen');
    //     disableBtn("enable");
    // }

    // function setEnabled() {
    //     UE.getEditor('editor').setEnabled();
    //     enableBtn();
    // }

    // function getText() {
    //     //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
    //     var range = UE.getEditor('editor').selection.getRange();
    //     range.select();
    //     var txt = UE.getEditor('editor').selection.getText();
    //     alert(txt)
    // }

    // function getContentTxt() {
    //     var arr = [];
    //     arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
    //     arr.push("编辑器的纯文本内容为：");
    //     arr.push(UE.getEditor('editor').getContentTxt());
    //     alert(arr.join("\n"));
    // }
    // function hasContent() {
    //     var arr = [];
    //     arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
    //     arr.push("判断结果为：");
    //     arr.push(UE.getEditor('editor').hasContents());
    //     alert(arr.join("\n"));
    // }
    // function setFocus() {
    //     UE.getEditor('editor').focus();
    // }
    // function deleteEditor() {
    //     disableBtn();
    //     UE.getEditor('editor').destroy();
    // }
    // function disableBtn(str) {
    //     var div = document.getElementById('btns');
    //     var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
    //     for (var i = 0, btn; btn = btns[i++];) {
    //         if (btn.id == str) {
    //             UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
    //         } else {
    //             btn.setAttribute("disabled", "true");
    //         }
    //     }
    // }
    // function enableBtn() {
    //     var div = document.getElementById('btns');
    //     var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
    //     for (var i = 0, btn; btn = btns[i++];) {
    //         UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
    //     }
    // }

    // function getLocalData () {
    //     alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    // }

    // function clearLocalData () {
    //     UE.getEditor('editor').execCommand( "clearlocaldata" );
    //     alert("已清空草稿箱")
    // }
</script>