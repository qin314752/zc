<include file="Common:_meta" />
<include file="Common:_header" />
<include file="Common:_menu" />
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		数据库管理
		<span class="c-gray en">&gt;</span>
		数据库信息 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>	
	<div class="Hui-article">
		<div class="page-container">
		<a href="java	script:;" style="color: #3B5999">数据备份</a>
		<p style="float:right;">数据库中共有{$tables}张表，共计{$total}</p>
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
				<volist name="data" id="tab" key="k"> 
					<tr class="text-c">
						<td>{$k}</td>
						<td>{$tab.name}</td>
						<td>{$tab.engine}</td>
						<td>{$tab.collation}</td>
						<td>{$tab.rows}</td>
						<td>{$tab.size}</td>
						<td>{$tab.update_time}</td>
						<td><a href="javascript:;" onclick="admin_role_edit('查看表结构','SysData_list?name={$tab.name}','1','800','300')"  style="color: #3B5999">查询表结构</a></td>
					</tr>
				</volist>
			
				</tbody>
			</table>
			
		</div>
	</div>
</section>


<include file="Common:_footer" />

<script type="text/javascript">
	function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

</script>
</body>
</html>