<extend name='./App/View/Admin/head.php' />

<block name="centent">
<form  action="{:U('/admin/System/authority')}" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">名称</td>
            <td><input type="text" name="authority_name"/></td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <!-- <input type="radio" name="status" value="1" checked/>   <input type="radio" name="status" value="0"/>  -->
            </td>
        </tr>
        <tr>
            <td class="tableleft">权限</td>
            <td>
                <ul>
  <li>
    <label class='checkbox inline'>
      <input type='checkbox' name='group[]' value='' />公用节点</label>
    <ul>
      <li>
        <label class='checkbox inline'>
          <input type='checkbox' name='node[]' value='1' />省市区级联数据</label>
        <li>
          <label class='checkbox inline'>
            <input type='checkbox' name='node[]' value='2' />省市区数据获取</label></ul>
    </li>
    <li>
      <label class='checkbox inline'>
        <input type='checkbox' name='group[]' value='' />明信片批次管理</label>
      <ul>
        <li>
          <label class='checkbox inline'>
            <input type='checkbox' name='node[]' value='3' />明信片批次管理</label>
          <li>
            <label class='checkbox inline'>
              <input type='checkbox' name='node[]' value='4' />明信片批次添加</label>
            <li>
              <label class='checkbox inline'>
                <input type='checkbox' name='node[]' value='5' />明信片批次编辑</label></ul>
      </li>
      <li>
        <label class='checkbox inline'>
          <input type='checkbox' name='group[]' value='' />标签管理</label>
        <ul>
          <li>
            <label class='checkbox inline'>
              <input type='checkbox' name='node[]' value='6' />标签查询</label>
            <li>
              <label class='checkbox inline'>
                <input type='checkbox' name='node[]' value='7' />标签生成</label>
              <li>
                <label class='checkbox inline'>
                  <input type='checkbox' name='node[]' value='8' />批量贴标签</label>
                <li>
                  <label class='checkbox inline'>
                    <input type='checkbox' name='node[]' value='9' />标签编辑</label>
                  <li>
                    <label class='checkbox inline'>
                      <input type='checkbox' name='node[]' value='10' />标签生成下载（请和标签生成同时选中）</label>
                    <li>
                      <label class='checkbox inline'>
                        <input type='checkbox' name='node[]' value='11' />文件下载（请和标签生成、查询同时选中）</label></ul>
        </li>
        <li>
          <label class='checkbox inline'>
            <input type='checkbox' name='group[]' value='' />权限</label>
          <ul>
            <li>
              <label class='checkbox inline'>
                <input type='checkbox' name='node[]' value='12' />权限列表</label>
              <li>
                <label class='checkbox inline'>
                  <input type='checkbox' name='node[]' value='13' />权限添加</label>
                <li>
                  <label class='checkbox inline'>
                    <input type='checkbox' name='node[]' value='14' />权限编辑</label>
                  <li>
                    <label class='checkbox inline'>
                      <input type='checkbox' name='node[]' value='15' />权限删除</label></ul>
          </li>
          <li>
            <label class='checkbox inline'>
              <input type='checkbox' name='group[]' value='' />用户</label>
            <ul>
              <li>
                <label class='checkbox inline'>
                  <input type='checkbox' name='node[]' value='16' />用户列表</label>
                <li>
                  <label class='checkbox inline'>
                    <input type='checkbox' name='node[]' value='17' />用户添加</label>
                  <li>
                    <label class='checkbox inline'>
                      <input type='checkbox' name='node[]' value='18' />用户编辑</label>
                    <li>
                      <label class='checkbox inline'>
                        <input type='checkbox' name='node[]' value='19' />用户删除</label></ul>
            </li>
            <li>
              <label class='checkbox inline'>
                <input type='checkbox' name='group[]' value='' />菜单管理</label>
              <ul>
                <li>
                  <label class='checkbox inline'>
                    <input type='checkbox' name='node[]' value='20' />菜单列表</label>
                  <li>
                    <label class='checkbox inline'>
                      <input type='checkbox' name='node[]' value='21' />菜单新增</label>
                    <li>
                      <label class='checkbox inline'>
                        <input type='checkbox' name='node[]' value='22' />菜单编辑</label>
                      <li>
                        <label class='checkbox inline'>
                          <input type='checkbox' name='node[]' value='23' />菜单删除</label></ul>
              </li>
              <li>
                <label class='checkbox inline'>
                  <input type='checkbox' name='group[]' value='' />角色</label>
                <ul>
                  <li>
                    <label class='checkbox inline'>
                      <input type='checkbox' name='node[]' value='24' />角色列表</label>
                    <li>
                      <label class='checkbox inline'>
                        <input type='checkbox' name='node[]' value='25' />角色添加</label>
                      <li>
                        <label class='checkbox inline'>
                          <input type='checkbox' name='node[]' value='26' />角色编辑</label>
                        <li>
                          <label class='checkbox inline'>
                            <input type='checkbox' name='node[]' value='27' />角色删除</label></ul>
                </li>
</ul>
            </td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button> 
            </td>
        </tr>
    </table>
</form>

<script>
    $(function () {
        $(':checkbox[name="group[]"]').click(function () {
            $(':checkbox', $(this).closest('li')).prop('checked', this.checked);
        });

		$('#backid').click(function(){
				window.location.href="index.html";
		 });
    });
</script>
</block>

