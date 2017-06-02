<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<link href="__ROOT__/Style/A/css/style.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/A/js/tbox/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
</head>
<body>

<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>


<div class="so_main">
  <div class="page_tit">线下充值银行设置</div>

  <div class="Toolbar_inbox">

      <a onclick="addBank();" class="btn_a" href="javascript:void(0);"><span class="search_action">添加银行</span></a>          
    
  </div>
  
  <div class="list">
  <form action="__URL__/index" name="bankForm" id="bankForm" method="post" >   
  <table id="bank_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th class="line_l">序号</th>
    <th class="line_l">银行名称</th>
    <th class="line_l">收款人</th>
    <th class="line_l">收款账号</th>
    <th class="line_l">开户地址</th>
    <th class="line_l" width="80">操作</th>
  </tr>
   <?php if(is_array($bank)): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="bank_<?php echo ($i); ?>">
        <td><?php echo ($i); ?></td>
        <td><input type="text" name="bank[]"  value="<?php echo ($vo["bank"]); ?>"></td>
        <td><input type="text" name="payee[]"  value="<?php echo ($vo["payee"]); ?>"></td>
        <td><input type="text" name="account[]"  value="<?php echo ($vo["account"]); ?>" size="30"></td>
        <td><input type="text" name="address[]"  value="<?php echo ($vo["address"]); ?>" size="40"></td>  
        <td><a href="javascript:void(0);" onclick="delBank(<?php echo ($i); ?>)">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  <table>
    <tr>
        <td>
            说明：
        </td>
        <td>                                          
            <textarea id="info" name="info" ><?php echo ($info); ?></textarea>    
        </td>
  </tr>
  </table>
  </form>
  </div>
  
  <div class="Toolbar_inbox">
     <a onclick="dosubmit();" class="btn_a" href="javascript:void(0);"><span class="search_action">保存设置</span></a>          
  </div>
</div>
<script type="text/javascript">
function addBank()
{
    id = parseInt($("#bank_list tr").last().find("td").eq(0).html())+1; 

    var html = '<tr overstyle="on" id="bank_'+id+'"><td>'+id+'</td><td><input type="text" name="bank[]" value=""></td> <td><input type="text" name="payee[]" value=""></td><td><input type="text" name="account[]"  value="" size="30"></td>  <td><input type="text" name="address[]" value="" size="40"></td><td><a href="javascript:void(0);" onclick="delBank('+id+')">删除</a></td></tr>';
    
    $("#bank_list").append(html); 
}
function delBank(id)
{
    $("#bank_"+id).remove();
}
function dosubmit()
{
   $("#bankForm").submit(); 
}
</script>
<?php echo ($keshow); ?>
<style type="text/css">
body .ke-container td{
    padding:0;
}
</style>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>