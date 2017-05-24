<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
	

	<div class="menu_dropdown bk_2">
		<dl id="menu-admin">
<div style="margin-left: 10%;">{$a}</php></div>
		<dl id="menu-admin">
			
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="{:U('Role/admin_role')}" title="角色管理">角色管理</a></li>
					<li><a href="{:U('Node/admin_node')}" title="权限管理">权限管理</a></li>
					<li><a href="{:U('User/admin_user_list')}" title="管理员列表">管理员列表</a></li>

				</ul>
			</dd>
		</dl>
		<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 数据库管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="{:U('SysData/index')}" title="角色管理">数据库信息</a></li>
					<li><a href="{:U('Node/admin_node')}" title="权限管理">备份数据库</a></li>
					<li><a href="{:U('User/admin_user_list')}" title="管理员列表">清空数据</a></li>

				</ul>
			</dd>
		</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="" data-title="系统设置" href="{:U('System/index')}">系统设置</a></li>
					
				</ul>
			</dd>
		</dl>
<dl >
			<dt><i class="Hui-iconfont">&#xe62e;</i> 众筹<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="" data-title="系统设置" href="{:U('Crowd/index')}">发起项目</a></li>
					
				</ul>
			</dd>
		</dl>

</dl>
		
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->
