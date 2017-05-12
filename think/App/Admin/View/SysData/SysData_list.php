<include file="Common:_meta" />
 
<div class=""  style="margin: 20px;">
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr><th colspan="6" scope="col">{$data_name}&nbsp;表结构</th></tr>
		</thead>
		<tbody>
			<volist name="data_list" id="list1"> 
			<tr>
				<td>{$list1.field}</td>
				<td>类型={$list1.type}</td>
				<td>是否为空={$list1.null}</td>
				<td>索引={$list1.key}</td>
				<td>默认值={$list1.default}</td>
				<td>其他={$list1.extra}</td>
			</tr>
			</volist>
		</tbody>
	</table>
</div>

<include file="Common:_footer" />
</script>
</body>
</html>