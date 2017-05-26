<include file="Common:_meta" />
<include file="Common:_header" />
<include file="Common:_menu" />
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<form action="__URL__/data" method="post" class="form form-horizontal" id="form-article-add">
				<div id="tab-system" class="HuiTab">
					<div class="tabBar cl"><span>基本设置</span><span>短信设置</span><span>邮件设置</span></div>
					<div class="tabCon">
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站名称：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
							<span class="c-orange">出现在每个页面的title后面(web_name)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站标题：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
							<span class="c-orange">首页标题(index_title)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站关键词：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
							<span class="c-orange">在首页的keywords中显示(web_keywords)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站描述：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"   value="" class="input-text">
							</div>
							<span class="c-orange">在网站首页的描述中显示(web_descript)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站底部：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
							<span class="c-orange">网站底部的版权和联系信息(bottom)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">后台入口：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
							<span class="c-orange">可修改后台登陆路径,格式为任意字母组合。例如：如填写admin，访问路径即为：【http://www.您的域名.com/shang/admin 】 (admin_url)</span>
						</div>
					</div>
					<div class="tabCon">
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-3">当前正在使用的短信提供商：&nbsp;漫道
							</label>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">sn：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">pw: </label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
						</div>
					</div>
					<div class="tabCon">
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP服务器：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP服务器端口：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="25" class="input-text">
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP用户名：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="25" class="input-text">
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP密码：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="text"  value="" class="input-text">
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">发件人昵称或姓名：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name=""  type="password"  value="" class="input-text">
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
<include file="Common:_footer" />
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