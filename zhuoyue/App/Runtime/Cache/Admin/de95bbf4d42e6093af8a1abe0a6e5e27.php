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
<style type="text/css">
.quxiantu{ margin-top:30px;}
.qleft{ float:left; width:50%; text-align:left;}
.qright{ float:right; width:50%; text-align:right;}

.ssx a{height:30px; line-height:30px}
.lf{
    float:left;
    width:48%; border:1px solid #c7d8ea; margin: 10px;
}
.lf h6{
    border-bottom: 1px solid #c7d8ea;
    color: #3a6ea5;
    height: 26px;
    line-height: 28px;
    padding: 0 10px;
    font-size: 13px;
}
.lf .content{
    padding: 9px 10px;
    line-height: 22px;
}
.lf .content a{
    color:#fc8936;
    font-weight:bold;
}
</style>
<script type="text/javascript" src="__ROOT__/Style/Js/highcharts.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/exporting.js"></script>
<script language="javascript" type="text/javascript"> 
function txxt(){
	ui.box.load("/admin/common/sms", {title:"下发消息",buttons:{}});
}
</script>
<div class="so_main">
  <div class="page_tit">首页</div>
  <!--列表模块-->
  <div class="Toolbar_inbox">
    <div class="page right">
    
    </div>
      <a href="javascript:;" class="btn_a"> 当前时间<span id="clock"></span></a></div>
<script>
function changeClock()
{
	var d = new Date();
	document.getElementById("clock").innerHTML = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
}
window.setInterval(changeClock, 1000);
</script> 
<div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb"> <a href="__APP__/admin/crowdfunding/index.html">  发起众筹 </a> </li>
            <li class="bg_lg span3"> <a href="__APP__/admin/crowdfunding/fully.html"> <span class="label label-important"><?php if($row["crowd_status"] > 0): echo ($row["crowd_status"]); else: ?> 0<?php endif; ?> </span>众筹投票</a> </li>
            
            <!--<li class="bg_ls"><a href="__APP__/admin/members/infowait.html"> <span class="label label-important"><?php if($row["limit_a"] > 0): echo ($row["limit_a"]); else: ?> 0<?php endif; ?></span> 额度待审</a> </li>
            <li class="bg_lo"> <a href="__APP__/admin/vipapply/index?status=0"><span class="label label-success"><?php if($row["vip_a"] > 0): echo ($row["vip_a"]); else: ?> 0<?php endif; ?></span> VIP认证</a> </li>
            <li class="bg_lo span3"> <a href="__APP__/admin/memberdata/index.html"> <i class="icon-th-list"></i> <span class="label label-important"><?php if($row["data_up"] > 0): echo ($row["data_up"]); else: ?> 0<?php endif; ?></span> 上传资料审核</a> </li>
             <li class="bg_lb"> <a href="__APP__/admin/debt/index.html"> <i class="icon-pencil"></i><span class="label label-success"><?php if($row["debt_a"] > 0): echo ($row["debt_a"]); else: ?> 0<?php endif; ?></span> 债权转让审核</a> </li>
            <li class="bg_lg"> <a href="__APP__/admin/expired/index.html"> <i class="icon-calendar"></i> <span class="label label-important"><?php if($row["borrow_8"] > 0): echo ($row["borrow_8"]); else: ?> 0<?php endif; ?></span> 逾期借款</a> </li>
            -->
            <li class="bg_ls"> <a href="__APP__/admin/memberid/index?status=3"> <span class="label label-success"><?php if($row["real_a"] > 0): echo ($row["real_a"]); else: ?> 0<?php endif; ?></span> 实名认证</a> </li>

            <li class="bg_ls"> <a href="__APP__/admin/Withdrawlogwait/index.html"> <i class="icon-tint"></i> <span class="label label-important"><?php if($row["withdraw"] > 0): echo ($row["withdraw"]); else: ?> 0<?php endif; ?></span> 提现审核</a> </li>

          <!--  <li class="bg_lr"> <a href="__APP__/admin/feedback/index.html"> <i class="icon-info-sign"></i> <span class="label label-success"><?php if($row["kuaisujiekuan"] > 0): echo ($row["kuaisujiekuan"]); else: ?> 0<?php endif; ?></span> 快捷借款</a> </li>  -->
            <li class="bg_lr"> <a href="javascript:void(0);" onClick="txxt();"> <i class="icon-info-sign"></i>下发通知</a> </li>
            <div style="clear:both"></div>
        </ul>
    </div>
<br/>
<div class="lf">
    <h6>个人信息</h6>
    <div class="content">
        您好，<?php echo ($user["user_name"]); ?>
        <br />
        所属角色：<?php echo ($user["groupname"]); ?> 
        <br />
        上次登录时间：<?php echo (date('Y-m-d H:i:s',$user["last_log_time"])); ?>
        <br />
        上次登录IP：<?php echo ($user["last_log_ip"]); ?>   
    </div>
</div>
<div class="lf">
    <h6>系统信息</h6>
	 <div class="content">
     <div style="float: left; width:300px;">
       操作系统：<?php echo ($service["service_name"]); ?> 
     </div>
    <div style="float: left;">
      PHP版本：<?php echo PHP_VERSION?>
     </div>
     <br />
	<div style="float: left; width:300px;">
        服务器协议：<?php echo ($_SERVER['SERVER_PROTOCOL']); ?>
         </div>
    <div style="float: left;">
        MySQL 版本：<?php echo ($service["mysql"]); ?>
     </div>
     <br />
    <div style="float: left; width:300px;">
       运行环境：<?php echo ($service["service"]); ?>
     </div>
    <div style="float: left;">
      Sapi：<?php echo strtoupper(php_sapi_name())?>
     </div>
     <br />
	
	 </div>
</div>


</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>