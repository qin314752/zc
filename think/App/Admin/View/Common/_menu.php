<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
	

<div class="menu_dropdown bk_2">
	<dl id="menu-admin">
	<?php
		foreach ($sub_menu as $value) {
			foreach ($value['low_title'] as $key => $menu) {
			?>
			<dl >
				<dt <?php if($value[2]==1){echo "class='$value[1]'";}  ?> >
					<?php echo $menu[0] ?>
					<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
				</dt>
				<dd>
					<ul >
					<?php foreach ($value[$key] as  $v) {?>
							<li><a href="<?php echo $v[1]?>" ><?php echo $v[0]?></a></li>
					<?php }?>
					</ul>
				</dd>
			</dl>
			<?php
			}
		}
	?>
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
					<li><a href="{:U('Role/admin_role')}" title="角色管理">角色管理</a></li>
					<li><a href="{:U('Node/admin_node')}" title="权限管理">权限管理</a></li>
					<li><a href="{:U('User/admin_user_list')}" title="管理员列表管理员列表">管理员列表</a></li>

				</ul>
			</dd>
		</dl>
		<dl >
			<dt><i class="Hui-iconfont">&#xe62d;</i> 数据库管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="{:U('SysData/index')}" title="角色管理">数据库信息</a></li>
					

				</ul>
			</dd>
		</dl>
		<dl >
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="" data-title="" href="{:U('Notice/index')}">通知信息接口</a></li>
					<li><a data-href="" data-title="" href="{:U('Notice/template')}">通知信息模板</a></li>
					
				</ul>
			</dd>
		</dl>
		<dl >
			<dt><i class="Hui-iconfont">&#xe62e;</i> 众筹<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="" data-title="" href="{:U('Crowd/index')}">发起项目</a></li>
					
				</ul>
			</dd>
		</dl> -->

	</dl>
		 
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->
