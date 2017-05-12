<extend name='./App/View/Admin/head.php' />

<block name="centent">
<form class="form-inline definewidth m20" action="index.html" method="get">  
    
    <button type="button" class="btn btn-success" id="addnew">新增角色</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>用户组名称</th>
        <th>操作</th>
    </tr>
    </thead>
         <foreach name="data" item="vo" > 
         <tr>
            <td class="id">{$vo.id}</td>
            <td class = 'authority_name'>{$vo.authority_name}</td>
            <td><a href="">编辑</a>&nbsp;|&nbsp;<a class='del' href="">删除</a></td>
        </tr>
         </foreach>
    </table>
    <div class="inline pull-right page">
                {$count} 条记录 1/{$pages} 页 
                {$show} 
</div>
   

<script>
    $(function () {
        
        $('#addnew').click(function(){

                window.location.href="{:U('Admin/System/add_admin?$id=3')}";
         });


    });

    
    $('.del').click(function(){
        if(confirm("确定要删除吗？")){
            var id = $(this).parent('td').siblings('.id').html();
            var username = $(this).parent('td').siblings('.authority_name').html();
            $.get("{:U('Admin/System/del_authority')}",{id:id,username:username},function(data){
                
            });
        }
    });
</script>
</block>