<extend name='./App/View/Admin/head.php' />

<block name="centent">
<form class="form-inline definewidth m20" action="" method="get">    
    <button type="button" class="btn btn-success" id="addnew">新增用户</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>id</th>
        <th>pid</th>
        <th>用户名</th>
        <th>真实姓名</th>
        <th>手机号</th>
        <th>是否禁用</th>
        <th>最后登录时间</th>
        <th>最后IP地址</th>
        <th>操作</th>
    </tr>
    </thead>
       <foreach name="data" item="vo" >
         <tr>
            <td class = 'id'>{$vo.id}</td>
            <td>{$vo.pid}</td>
            <td class = 'username'>{$vo.username}</td>
            <td>{$vo.adminname}</td>
            <td>{$vo.phone}</td>
            <td>{$vo.status}</td>
            <td>{$vo.last_add_time|date='Y-m-d H:i:s',###}</td>
            <td>{$vo.last_add_ip}</td>
            <td><a href="">编辑</a> | <a class='del' href="">删除</a></td>
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

                window.location.href="{:U('Admin/System/add_admin?$id=2')}";
         });
 

    });


    $('.del').click(function(){
        if(confirm("确定要删除吗？")){
            var id = $(this).parent('td').siblings('.id').html();
            var username = $(this).parent('td').siblings('.username').html();
          
            $.get("{:U('Admin/System/del')}",{id:id,username:username},function(data){
                
            });
        }
    });
    
    
</script>
</block>