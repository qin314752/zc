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

    <div class="page_tit">网站关站设置</div>
    <div class="page_tab"><span data="tab_1" class="active">网站关站设置</span>
        <span data="tab_2" style="display:none">程序运行状态</span></div>
    <div class="form2">
        <form method="post" action="__URL__/index" onsubmit="return subcheck();" enctype="multipart/form-data">
            <div id="tab_1">
                <br>
                <br>
                <dl class="lineD">
                    <dt>关站提示语：</dt>
                    <dd>
                        <input style="width: 300px;height: 20px;" type="text"  id="title" name="title"  value="<?php echo ($web_close["title"]); ?>" />
                    </dd>
                </dl>
                <dt>是否启用：</dt>
                <dd>
                    <?php if($web_close["isopen"] == 2): ?><input type="radio" id="close_1" name="isopen" value="1"  />开启
                        <input type="radio" id="close_2" name="isopen" value="2"  checked="checked"/>关闭
                     <?php else: ?>
                        <input type="radio" id="close_1" name="isopen" value="1" checked="checked" />开启
                        <input type="radio" id="close_2" name="isopen" value="2" />关闭<?php endif; ?>

                </dd>
                <div class="page_btm">
                    <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC">(所有方式修改提交一次即可)</span>
                </div>
            </div>
        </form>
    </div>

</div>
<script type="text/javascript">
    function doaction(action){

    }
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>