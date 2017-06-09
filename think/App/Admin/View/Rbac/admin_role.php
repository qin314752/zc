<include file="Common:_meta" />
<include file="Common:_header" />
<include file="Common:_menu" />
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		角色管理
		<span class="c-gray en">&gt;</span>
		角色列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>	
	<div class="Hui-article">
		<article class="cl pd-20">
			
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_role_add('添加角色','admin_role_add','800')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> </span>
				<span class="r">共有数据：<strong>54</strong> 条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value=""></th>
						<th width="40">ID</th>
						<th width="40">角色名</th>
						<th width="40">启用/停用</th>
						<th width="40">操作</th>
					</tr>
				</thead>
				<tbody>
					
				 <foreach name="data" item="role_data" >
					<tr class="text-c">
						<td><input type="checkbox" value="" name=""></td>
						<td>{$role_data.id}</td>
						<td>{$role_data.name}</td>
						<td class="td-status">
							<if condition="$role_data['status'] eq 1">
							<span class="label label-success radius">已启用</span>
							<else />
							<span class="label radius">已停用</span>
							</if>
						</td>
						<td class="td-manage">
						
						<if condition="$role_data['status'] eq 1">
						<a style="text-decoration:none" onClick="admin_stop(this,'{$role_data.id}','{$role_data.status}')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
						<else />
						<a style="text-decoration:none" onClick="admin_stop(this,'{$role_data.id}','{$role_data.status}')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
						</if>
						<a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin_role_edit?id={$role_data.id}&name={$role_data.name}&status={$role_data.status}','1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
						<a title="删除" href="javascript:;" onclick="admin_role_del(this,'{$role_data.id}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
						</td>
					</tr>
					</foreach>


					
				</tbody>
			</table>
		</article>
	</div>
</section>


<include file="Common:_footer" />

<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

/*管理员-*/
function admin_stop(obj,id,status){
	
	layer.confirm('确认要修改吗？',function(index)
	{
		//此处请求后台程序，下方是成功后的前台处理……
		var id1 = id;
		var status1 = status;
		$.get("{:U('Role/suop')}",{id:id1,status:status1},function(data){
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
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		var role_id = id;
		$.get("{:U('Role/del')}",{id:role_id},function(data){
			if(data == 1){
				window.location.reload()
				layer.msg('已删除!',{icon:1,time:1000});

			}else{
				alert('删除不全，请联系管理员');
			}
		}); 
		
		
	});
}
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>