<include file="Common:_meta" />
<include file="Common:_header" />
<include file="Common:_menu" />
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<form action="__URL__/data" method="post" class="form form-horizontal" id="form-article-add">
				<div id="tab-system" class="HuiTab">
					<div class="tabBar cl"><span>短信设置</span><span>邮件设置</span></div>
				<!-- 	<div class="tabCon">
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站名称：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_name"  type="text"  value="{$note['wap_name']}" class="input-text">
							</div>
							<span class="c-orange">出现在每个页面的title后面(web_name)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站标题：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_title"  type="text"  value="{$note['wap_title']}" class="input-text">
							</div>
							<span class="c-orange">首页标题(index_title)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站关键词：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_antistop"  type="text"  value="{$note['wap_antistop']}" class="input-text">
							</div>
							<span class="c-orange">在首页的keywords中显示(web_keywords)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站描述：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_describe"  type="text"   value="{$note['wap_describe']}" class="input-text">
							</div>
							<span class="c-orange">在网站首页的描述中显示(web_descript)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">网站底部：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_bottom"  type="text"  value="{$note['wap_bottom']}" class="input-text">
							</div>
							<span class="c-orange">网站底部的版权和联系信息(bottom)</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">后台入口：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="wap_admin"  type="text"  value="{$note['wap_admin']}" class="input-text">
							</div>
							<span class="c-orange">可修改后台登陆路径,格式为任意字母组合。例如：如填写admin，访问路径即为：【http://www.您的域名.com/shang/admin 】 (admin_url)</span>
						</div>
					</div> -->
					<div class="tabCon">
						<div class="row cl">
							<div style="margin-left: 90px">当前正在使用的短信提供商：<span class="c-orange">&nbsp;{$note['provider'] == 1? 漫道 : 亿美}</span></div>
							
						</div>
						<div class="row cl" >
							<div style="margin-left: 185px">短信提供商：&nbsp;&nbsp;
								<input type="radio" class="sn" name="provider" value="1" {$note['provider']==1? "checked='checked'" : ''}>&nbsp;漫道短信提供商&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" class="cdkey" name="provider" value="2" {$note['provider']==2? "checked='checked'" : ''}>&nbsp;亿美软通短信提供商&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
						</div>
						<div id="sn" {$note['provider']!=1? "style='display:none'" : ''}>
							<div class="row cl">
								<div style="margin-left: 150px">当前剩余短信条数:&nbsp;&nbsp;{$mandao}条</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">sn：</label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="sn"  type="text"  value="{$note['sn']}" class="input-text">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">密码: </label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="pwd"  type="password"  value="{$note['pwd']}" class="input-text">
								</div>
							</div>
						</div>
						<div id="cdkey" {$note['provider']!=2? "style='display:none'" : ''}>
							<div class="row cl">
								<div style="margin-left: 150px">当前剩余短信条数:&nbsp;&nbsp;{$yimei}条</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">cdkey：</label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="cdkey"  type="text"  value="{$note['cdkey']}" class="input-text">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-3 col-sm-2">密码: </label>
								<div class="formControls col-xs-8 col-sm-3">
									<input name="cdkey_pw"  type="password"  value="{$note['cdkey_pw']}" class="input-text">
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
								<input name="smtp_server"  type="text"  value="{$note['smtp_server']}" class="input-text">
							</div>
							<span class="c-orange">如:smtp.163.com</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP服务器端口：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="smtp_port"  type="text"  value="{$note['smtp_port']}" class="input-text">
							</div>
							<span class="c-orange">如:25</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP用户名：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="smtp_user"  type="text"  value="{$note['smtp_user']}" class="input-text">
							</div>
							<span class="c-orange">如:123456@qq.com</span>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-3 col-sm-2">SMTP密码：</label>
							<div class="formControls col-xs-8 col-sm-3">
								<input name="smtp_pw"  type="password"  value="{$note['smtp_pw']}" class="input-text">
							</div>
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