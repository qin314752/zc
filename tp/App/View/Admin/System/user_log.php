<extend name='./App/View/Admin/head.php' />

<block name="centent">
<br>
<!-- 日志显示 -->
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>操作者</th>
        <th>备注信息</th>
        <th>操作时间</th>
        <th>操作者IP</th>
        <th>操作</th>
    </tr>
    </thead>
        <volist name="data" id="vo">  
         <tr>
            <td>{$vo.id}</td>
            <td>{$vo.admin_user_name}</td>
            <td>{$vo.last_log}</td>
            <td>{$vo.last_log_time|date="Y-m-d H:i:s",###}</td>
            <td>{$vo.last_log_ip}</td>
            <td><a href="">操作</a></td>
            
            
        </tr>
</volist>
    </table>
<div class="inline pull-right page">
                {$count} 条记录 1/{$pages} 页 
                {$show} 
</div>

</block>
