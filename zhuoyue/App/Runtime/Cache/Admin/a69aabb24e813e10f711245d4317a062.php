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
<!-- <script  src="__ROOT__/Style/A/js/layer/jquery-1.9.1.min.js"></script>
<script  src="__ROOT__/Style/A/js/layer/layer.js"></script> -->
<script type="text/javascript">
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
	var editUrl = '__URL__/edit';
	var editTitle = '修改会员类型';
	var isSearchHidden = 1;
	var searchName = "搜索/筛选会员";
</script>
<div class="so_main">
<style type="text/css">
.list input[type=text]{
	color: #333333;
    padding-bottom: 2px;
    padding-left: 2px;
    padding-right: 2px;
    padding-top: 2px;
}
li{diaplay:block;width:93px;height:27px;background-color:rgb(238,238,238);text-align:center;line-height:25px;
	border:1px solid rgb(189,200,220);cursor: pointer;}
li:hover{background-color:rgb(230,230,230);}
tr:hover{background-color:rgb(238,238,238);}
</style>
<script type="text/javascript">
$(document).ready(function(){ }); 
function changeDisplay(){  

                var helloDivObj = $("#addF");  
                var buttonObj = $("#addB");  
                var val = buttonObj.attr("value");  
              
                if(val=="Add Filter"){  
                    helloDivObj.show();  
                    buttonObj.attr("value","--");  
                }else{  
                    helloDivObj.hide();  
                    buttonObj.attr("value","Add Filter");  
                }  
                                     
    }  
	$(function(){
			$('li').click(function(){
				$('#search_div').show(300);
				});
			$('a').click(function(){
				$('#search_div').hide(300);
				});			
	});
</script>
<div class="page_tit">邮箱信息记录</div>
<!--搜索/筛选会员-->
<div>
<div id="search_div" style="display:none">
  	<div class="page_tit">搜索/筛选记录 [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="GET" action="__ACTION__">
   <dl class="lineD">
      <dt>用户名：</dt>
      <dd>
        <input name="username" style="width:190px" id="title" type="text" value="<?php echo ($search["username"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>接收邮箱：</dt>
      <dd>
        <input name="email" style="width:190px" id="title" type="text" value="<?php echo ($search["email"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="筛选" />
    </div>
	</form>
  </div>
  </div>

</div>
<!--搜索/筛选会员结束-->
<div><ul><li>搜索/筛选</li></ul></div>


<div class="form2">
	<div id="tab_1">
	  <div class="list">
	  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<!-- <th class="line_l">序号</th> -->
		<th class="line_l">ID</th>
		<th class="line_l">用户名</th>
		<th class="line_l">发送邮箱</th>
		<th class="line_l">接收邮箱</th>
		<th class="line_l">标题</th>
		<th class="line_l">信息</th>
		<th class="line_l">添加时间</th>
		<th class="line_l">添加IP</th>
		<!-- <th class="line_l">操作</th> -->
	  </tr>
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	  		<td><?php echo ($vo["id"]); ?></td>
	  		<td><?php echo ($vo["user_name"]); ?></td>
	  		<td><?php echo ($vo["send_email"]); ?></td>
	  		<td><?php echo ($vo["email"]); ?></td>
	  		<td><?php echo ($vo["email_title"]); ?></td>
	  		
	  		<td>
					 <a href="javascript:;" onclick="showurl('__URL__/showdetail?id=<?php echo ($vo['id']); ?>','查看信件');">查看</a>
	  		</td>
	  		 <!--浮层框架开始-->
	  		<td><?php echo (date("Y-m-d H:i",$vo["addtime"])); ?></td>
	  		<td><?php echo ($vo["addip"]); ?></td>
	  	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr><td colspan="8"><?php echo ($page); ?></td></tr>
	  </table>
		</div>
	</div>

</div>
<script type="text/javascript">
function showurl(url,Title){
	ui.box.load(url, {title:Title});
}
    
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>