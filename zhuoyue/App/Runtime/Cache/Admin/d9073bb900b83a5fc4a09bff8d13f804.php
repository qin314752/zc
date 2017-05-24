<?php if (!defined('THINK_PATH')) exit();?><!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
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
<body>-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
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

<script type="text/javascript">
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
    var isSearchHidden = 1;
	var addTitle = '添加分类';
</script>
<div class="so_main">
    <div class="page_tit">建立关联</div>
    <!--搜索/筛选会员-->
      <!-------- 搜索游戏 -------->
  <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__URL__/ulist">
        <!--<?php if($search["rid"] > 0): ?><input type="hidden" name="uid" value="<?php echo ($search["rid"]); ?>" /><?php endif; ?>-->
        <!--<?php if($search["uid"] > 0): ?><input type="hidden" name="uid" value="<?php echo ($search["uid"]); ?>" /><?php endif; ?>-->
    <dl class="lineD">
      <dt>会员名：</dt>
      <dd>
        <input name="uname" style="width:190px" id="title" type="text" value="<?php echo ($search["uname"]); ?>">
        <span>不填则不限</span>
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
    <!--搜索/筛选会员-->

    <div class="Toolbar_inbox">
        <div class="page right"><?php echo ($pagebar); ?></div>
        <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选</span></a>
        <!--
        <a class="btn_a" href="__URL__/export?<?php echo ($query); ?>"><span>将当前条件下数据导出为Excel</span></a>
        -->
        <a class="btn_a" href="__URL__/ulist"><span>建立关联</span></a>
        <a class="btn_a" href="__URL__/slist"><span>推广人列表</span></a>
        <a class="btn_a" href="__URL__/log"><span>推广记录</span></a>
        <!--
        <a class="btn_a" href="__URL__/set"><span>推广设置</span></a>
        -->
    </div>

    <div class="list">
        <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr><!--
                <th style="width:30px;">
                    <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
                    <label for="checkbox"></label>
                </th>-->
                <th class="line_l">用户ID</th>
                <th class="line_l">用户名</th>
                <th class="line_l">邮箱</th>
                <!--
                <th class="line_l">类型</th>
                -->
                <th class="line_l">状态</th>
                <th class="line_l">推广人</th>
                <th class="line_l">关联时间</th>
                <th class="line_l">操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
                    <!--
                    <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
                    -->
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["user_name"]); ?></td>
                    <td><?php echo (($vo["user_email"])?($vo["user_email"]):"未邮箱验证"); ?></td>
                    <!--
                    <td></td>
                    -->
                    <td><?php echo $vo["recommend_id"]?"关联":"未关联"; ?></td>
                    <td><?php echo (($vo["recommend_name"])?($vo["recommend_name"]):"未关联"); ?></td>
                    <td>

                    <?php if($vo['recommend_id'] > 0): echo (date('Y-m-d',$vo["recommend_time"])); else: ?>未关联<?php endif; ?>

                        <!--<?php echo $vo["recommend_id"]?date("Y-m-d",$vo["recommend_time"]):""; ?></td>-->
                    <td>
                        <?php if($vo['recommend_id'] > 0): ?><a onclick="unlink(<?php echo ($vo["id"]); ?>);" href="javascript:void(0);">取消关联</a>
                        <?php else: ?>
                            <a onclick="dolink(<?php echo ($vo["id"]); ?>);" href="javascript:void(0);">关联用户</a><?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>

    </div>

    <div class="Toolbar_inbox">
        <div class="page right"><?php echo ($pagebar); ?></div>
        <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选</span></a>
        <!--
        <a class="btn_a" href="__URL__/export?<?php echo ($query); ?>"><span>将当前条件下数据导出为Excel</span></a>
        -->
    </div>
</div>
<script type="text/javascript">
    function dolink(n){
        ui.box.load("/admin/spread/add?uid="+n, {title:"关联用户"});
    }
    function unlink(n){
        if(!confirm("确定要取消关联吗?")) return;
        $.post('/admin/spread/unlink',
                {uid:n,ra:Math.random()},
                function(d,s){
                    if(d==0)ui.error('参数有错误！');
                    if(d==1)ui.error('参数有错误！');
                    if(d==2){ui.success('取消关联成功！');window.location.reload();}
                    if(d==3)ui.error('取消关联失败！');
                }
        );
    }

</script>

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>