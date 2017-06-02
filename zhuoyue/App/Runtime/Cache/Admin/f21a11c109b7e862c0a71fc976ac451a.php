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
<script type="text/javascript" src="__ROOT__/Style/A/js/uploadPreview.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#imgfile").uploadPreview({width:100,height:100,imgDiv:"#imgDiv",imgType:["bmp","gif","png","jpg"],maxwidth:2300,maxheight:2300});
	});
</script>
<style type="text/css">
.alertDiv { margin: 0px auto; background-color: #f1f1f1; border: 1px solid #1f76df; line-height: 25px; background-image: url(__ROOT__/Style/M/images/info/001_30.png); background-position: 20px 4px; background-repeat: no-repeat; }
.alertDiv li { margin: 5px 0; list-style-type: decimal; color: #005B9F; padding: 0px; line-height: 20px; }
.alertDiv ul { text-align: left; list-style-type: decimal; display: block; padding: 0px; margin: 0px 0px 0px 75px; }
</style>

<div class="page_tit">合同居间方资料上传</div>
<div class="page_tab"><span data="tab_1" class="active">合同居间方资料上传</span></div>
<div class="form2">
  <div class="alertDiv">
    <ul>
      <li>允许上传格式：bmp,gif,png,jpg，建议尺寸：100px*100px </li>
      <li>该功能用于在借款合同内容中显示平台居间方的相关必要资料</li>
    </ul>
  </div>
  <form action="__URL__/upload" method="post" enctype="multipart/form-data">
    <div id="tab_1">
      <dl class="lineD"  style="overflow:hidden">
        <dt>居间方合同章上传：</dt>
        <dd>
          <input type="file" id="imgfile" name="picpath" class="input"/>
        </dd>
      </dl>
      <dl class="lineD" style="height:110px;overflow:hidden">
        <dt>居间方合同章缩略图：</dt>
        <dd><span style="float:left">
          <div style="text-align:left; clear:both; overflow:hidden; width:120px; height:100px">
            <div id="imgDiv">
              <?php if($vo["hetong_img"] == ''): ?>无缩略图
                <?php else: ?>
                <img src="/<?php echo ($vo["hetong_img"]); ?>"  width="100px" height="100px"/><?php endif; ?>
            </div>
          </div>
          </span></dd>
      </dl>
      <dl class="lineD">
        <dt>居间方公司名称：</dt>
        <dd>
          <input name="name" id="name"  class="input" type="text" value="<?php echo ($vo["name"]); ?>" >
        </dd>
      </dl>
      <dl class="lineD">
        <dt>居间方公司地址：</dt>
        <dd>
          <input name="dizhi" id="dizhi"  class="input" type="text" value="<?php echo ($vo["dizhi"]); ?>" >
        </dd>
      </dl>
      <dl class="lineD">
        <dt>居间方联系电话：</dt>
        <dd>
          <input name="tel" id="tel"  class="input" type="text" value="<?php echo ($vo["tel"]); ?>" >
        </dd>
      </dl>
    </div>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
      <input type="button" class="btn_b" value="返回"  onclick="javascript:history.back();"/>
    </div>
  </form>
</div>