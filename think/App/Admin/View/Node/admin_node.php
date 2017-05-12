<include file="Common:_meta" />
<include file="Common:_header" />
<include file="Common:_menu" />
<article class="cl pd-20">

	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3" style="margin-left: 1%">
			<a href="javascript:;" onclick="admin_add('添加节点','admin_add_node','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加节点	</a> 
		</label>		
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站角色：</label>
			
			<div class="formControls col-xs-8 col-sm-6">
				<!-- 第一层 -->
				<foreach name="node" item="node_list">
					<dl class="permission-list">
						<dt>
							<label>
								<input type="checkbox" value="" name="user-Character-0" id="user-Character-1">{$node_list.title} </label>
								<span ><a href="javascript:;" style="float:right;margin-right: 3%;color:#00CC00;" onclick="admin_add('添加控制器','admin_add_node?pid={$node_list.id}&level=2','800','500')">添加控制器</a></span>
						</dt>
					<!-- 第二层 -->
					<foreach name="node_list['child']" item="controller">
						<dd>
							<dl class="cl permission-list2">
								<dt>
									<label class="">
										<input type="checkbox" value="" name="user-Character-1-0" id="user-Character-1-0">{$controller.title}
									</label>
										
								</dt>
								<dt style="float:right;">
									<label class="">
										<span  ><a href="javascript:;" style="color:#00CC00;" onclick="admin_add('添加方法','admin_add_node?pid={$controller.id}&level=3','800','500')">添加方法</a></span>
									</label>
										
								</dt>
								<dd>
							<!-- 第三层 -->
							<foreach name="controller['child']" item="method">
									
									<label class=""><input type="checkbox" value="" name="user-Character-1-0-0" id="user-Character-1-0-0">{$method.title}</label>
							</foreach>
								</dd>
							</dl>
						</dd>
					</foreach>
					</dl>
				</foreach>
			</div>

		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-6 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
<include file="Common:_footer" />

<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});

	$("#form-admin-role-add").validate({
		rules:{
			roleName:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
		}
	});
});
/*节点-增加*/
	/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>