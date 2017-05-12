<extend name='./App/View/Admin/head.php' />

<block name="centent">
<form action="{:U('Admin/System/admin_user_add')}" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">登录名</td>
        <td><input type="text" name="username"/></td>
    </tr>
    <tr>
        <td class="tableleft">密码</td>
        <td><input type="password" name="password"/></td>
    </tr>
    
    <tr>
        <td class="tableleft">真实姓名</td>
        <td><input type="text" name="adminname"/></td>
    </tr>
    <tr>
        <td class="tableleft">电话</td>
        <td><input type="text" name="phone"/></td>
    </tr>
    <tr>
        <td class="tableleft">状态</td>
        <td>
            <input type="radio" name="status" value="1" checked/> 启用
           <input type="radio" name="status" value="0"/> 禁用
        </td>
    </tr>
    <tr>
        <td class="tableleft">角色</td>
        <td> <select name="pid" > 
              <foreach name="authority" item="vo" >
                <option value="{$vo.id}">{$vo.authority_name}</option>   
               </foreach>
            </select>   
      </td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>

<script>
    $(function () {       
        $('#backid').click(function(){
                window.location.href="index.html";
         });

    });
</script>
</block>