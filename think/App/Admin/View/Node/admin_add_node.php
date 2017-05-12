<include file="Common:_meta" />
<article class="cl pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-admin-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>{$type}名称： </label>
			<div class="formControls col-xs-8 col-sm-6">
				<input type="text" class="input-text" value="" placeholder="{$type}名称" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>{$type}描述： </label>
			<div class="formControls col-xs-8 col-sm-6">
				<input type="text" class="input-text" autocomplete="off" value="" placeholder="{$type}描述" id="title" name="title">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否启用：</label>
			<div class="formControls col-xs-8 col-sm-6 skin-minimal">
				<div class="radio-box">
					<input name="status" type="radio" id="sex-1" value="1"  checked>
					<label for="sex-1">启用</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2"  value="0" name="status">
					<label for="sex-2">禁用</label>
				</div>
			</div>
		</div>
		<input type="hidden" name="pid" value="{$pid}">
		<input type="hidden" name="level" value="{$level}">
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-6 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>
<include file="Common:_footer" />
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			name:{
				required:true,
				
			},
			title:{
				required:true,
			},
			
			status:{
				required:true,
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
			type: "post",
			url: "{:U('Node/add_node')}",
			success: function (data) {
				if(data ==1){
					window.parent.location.reload();
					var index = parent.layer.getFrameIndex(window.name);
					parent.$('.btn-refresh').click();
					parent.layer.close(index);
				} else {
					alert('添加失败，请求联系管理员');
				}
			}
			});
			}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>