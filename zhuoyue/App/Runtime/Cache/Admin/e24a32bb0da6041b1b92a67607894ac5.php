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

<div class="so_main">
    <div class="page_tit">投票列表</div>
    <!--搜索/筛选会员-->
    <!---->
    <!--搜索/筛选会员-->

    <div class="Toolbar_inbox">
        <div class="page right"><?php echo ($pagebar); ?></div>
    </div>

    <div class="list">
        <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th style="width:30px;">
                    <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
                    <label for="checkbox"></label>
                </th>
                <th class="line_l">ID</th>
                <th class="line_l">投票用户</th>
                <th class="line_l">资金比例</th>
                <th class="line_l">是否赞成</th>
                <th class="line_l">投票时间</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
                    <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["user_name"]); ?></td>
                    <td><?php echo ($vo['ratio'])*100 ?>%</td>
                    <td>
                        <?php if($vo["is_agree"] == 1): ?><span style="color: #008000">赞成</span>
                            <?php else: ?>
                            <span style="color: red">不赞成</span><?php endif; ?>
                    </td>
                    <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>

    </div>

</div>
</body>
</html>