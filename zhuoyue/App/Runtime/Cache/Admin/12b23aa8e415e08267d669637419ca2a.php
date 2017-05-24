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
    <div class="page_tit">已经完成项目列表</div>
    <!--搜索/筛选会员-->
    <!---->
    <!--搜索/筛选会员-->

    <div class="Toolbar_inbox">
        <div class="page right"><?php echo ($pagebar); ?></div>
        <!--<a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选众筹</span></a>-->
    </div>

    <div class="list">
        <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th style="width:30px;">
                    <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
                    <label for="checkbox"></label>
                </th>
                <th class="line_l">ID</th>
                <th class="line_l">众筹项目名称</th>
                <th class="line_l">发起人</th>
                <th class="line_l">项目金额</th>
                <th class="line_l">筹标金额</th>
                <th class="line_l">投票金额</th>
                <th class="line_l">发布时间</th>
                <th class="line_l">最长持有期限</th>
                <th class="line_l">完成状态</th>
                <th class="line_l">查看</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
                    <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo (cnsubstr($vo["crowd_name"],12)); ?></td>
                    <td><?php echo ($vo["user_name"]); ?></td>
                    <td><?php echo (fmoney($vo["crowd_money"])); ?></td>
                    <td><?php echo (fmoney($vo["has_crowd_money"])); ?></td>
                    <td><?php echo (fmoney($vo["vote_money"])); ?></td>
                    <td><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>
                    <td><?php echo ($vo["max_duration"]); ?>个月</td>
                    <td><?php if($vo["status"] == 5): ?><span style="color: #008000">正常完成</span><?php else: ?><span style="color: red">溢价回购完成</span><?php endif; ?></td>
                    <td><a href="__URL__/complete_detail?crowd_id=<?php echo ($vo["id"]); ?>">投资详情</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>

    </div>

    <div class="Toolbar_inbox">
        <div class="page right"><?php echo ($page); ?></div>
        <!--<a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选众筹</span></a>-->
    </div>
</div>
</body>
</html>