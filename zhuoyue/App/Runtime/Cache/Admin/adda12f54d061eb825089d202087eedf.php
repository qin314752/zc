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
.alertDiv { margin: 0px auto; background-color: #f1f1f1; border: 1px solid #1f76df; line-height: 25px; background-image: url(__ROOT__/Style/M/images/info/001_30.png); background-position: 20px 4px; background-repeat: no-repeat; }
.alertDiv li { margin: 5px 0; list-style-type: decimal; color: #005B9F; padding: 0px; line-height: 20px; }
.alertDiv ul { text-align: left; list-style-type: decimal; display: block; padding: 0px; margin: 0px 0px 0px 75px; }
</style>

<div class="so_main">
  <div class="page_tit">通知信息接口管理</div>
  <div class="page_tab"><span data="tab_1" class="active">邮箱信息</span>
      <span data="tab_2">手机参数</span>
      <span data="tab_3" style="display:none">百度云推送参数</span>
  </div>
  <div class="form2">
    <form method="post" action="__URL__/save" >
      <div id="tab_1">
        <dl class="lineD">
          <dt>SMTP服务器：</dt>
          <dd>
            <input name="msg[stmp][server]" id="msg[stmp][server]"  class="input" type="text" value="<?php echo ($stmp_config["server"]); ?>" ><span id="tip_msg[stmp][server]" class="tip">如:smtp.qq.com</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>SMTP服务器端口：</dt>
          <dd>
            <input name="msg[stmp][port]" id="msg[stmp][port]"  class="input" type="text" value="<?php echo ($stmp_config["port"]); ?>" ><span id="tip_msg[stmp][port]" class="tip">如:25</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>SMTP用户名：</dt>
          <dd>
            <input name="msg[stmp][user]" id="msg[stmp][user]"  class="input" type="text" value="<?php echo ($stmp_config["user"]); ?>" ><span id="tip_msg[stmp][user]" class="tip">如:123456@qq.com</span>
          </dd>
        </dl>
        <dl class="lineD">
          <dt>SMTP密码：</dt>
          <dd>
            <input type="password" name="msg[stmp][pass]" id="stmpPass" value="<?php echo ($stmp_config["pass"]); ?>" class="input" />
          </dd>
        </dl>
        <dl class="lineD">
          <dt>发件人昵称或姓名：</dt>
          <dd>
            <input type="name" name="msg[stmp][name]" id="stmpPass" value="<?php echo ($stmp_config["name"]); ?>" class="input" />
          </dd>
        </dl>
      </div>
      <!--tab1-->
      <div id="tab_2" style="display:none">
      
        <dl class="lineD">
          <dt>当前正在使用的短信提供商：</dt>
          <dd> <span style="color:#fc8936;"><b>
            <?php if($sms_config_type == 0): ?>吉信通
              <?php elseif($sms_config_type == 1): ?>
              漫道
              <?php elseif($sms_config_type == 2): ?>
              亿美软通
                <?php elseif($sms_config_type == 4): ?>
                漫道二次
              <?php else: ?>
              短信服务已关闭<?php endif; ?>
            </b></span> </dd>
        </dl>
        <dl class="lineD">
          <dt>请选择短信提供商：</dt>
          <dd>
            <?php $i=0;foreach($type_list as $k=>$v){ if(strlen("key1")==1&&$i==0){ ?><input type="radio" name="msg[sms][type]" value="<?php echo ($k); ?>" id="msg[sms][type]_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="key1"&&$k==$sms_config["type"]){ ?><input type="radio" name="msg[sms][type]" value="<?php echo ($k); ?>" id="msg[sms][type]_<?php echo ($i); ?>" checked="checked" /><?php }elseif("key1"=="value1"&&$v==$sms_config["type"]){ ?><input type="radio" name="msg[sms][type]" value="<?php echo ($k); ?>" id="msg[sms][type]_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="msg[sms][type]" value="<?php echo ($k); ?>" id="msg[sms][type]_<?php echo ($i); ?>" /><?php } ?><label for="msg[sms][type]_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++;} ?>
          </dd>
        </dl>
        <div id="close">
          <dl class="lineD">
            <dt>当前短信服务状态:</dt>
            <dd>关闭</dd>
          </dl>
          <dl class="lineD">
            <dt>友情提示:</dt>
            <dd>当您停止短信服务时，系统中所有的操作都将不再向会员发送短信通知！</dd>
          </dl>
        </div>
        <div id="winic">
       <!--   <dl class="lineD">
            <dt>短信请到</dt>
            <dd> <a href="http://www.winic.org/" target="_blank">http://www.winic.org/</a>购买</dd>
          </dl> -->
          <dl class="lineD">
            <dt>当前短信帐户余额:</dt>
            <dd><?php echo (($winic)?($winic):"0"); ?></dd>
          </dl>
          <dl class="lineD">
            <dt>用户名：</dt>
            <dd>
              <input name="msg[sms][user1]" id="msg[sms][user1]"  class="input" type="text" value="<?php echo ($sms_config["user1"]); ?>" >
            </dd>
          </dl>
          <dl class="lineD">
            <dt>密　码：</dt>
            <dd>
              <input type="password" name="msg[sms][pass1]" id="pass1" value="<?php echo ($sms_config["pass1"]); ?>" class="input" />
            </dd>
          </dl>
        </div>
        <div id="zucp" style="display:none;">
        <!--  <dl class="lineD">
            <dt>短信请到</dt>
            <dd> <a href="http://www.zucp.net/" target="_blank">http://www.zucp.net/</a>购买</dd>
          </dl> -->
          <dl class="lineD">
            <dt>当前剩余短信条数:</dt>
            <dd> <?php echo (($zucp)?($zucp):"0"); ?></dd>
          </dl>
          <dl class="lineD">
            <dt>sn：</dt>
            <dd>
              <input name="msg[sms][user2]" id="msg[sms][user2]"  class="input" type="text" value="<?php echo ($sms_config["user2"]); ?>" >
            </dd>
          </dl>
          <dl class="lineD">
            <dt>密码：</dt>
            <dd>
              <input type="password" name="msg[sms][pass2]" id="pass2" value="<?php echo ($sms_config["pwd"]); ?>" class="input" />
            </dd>
          </dl>
        </div>
        <div id="emay" style="display:none;">
          <dl class="lineD">
        <!--    <dt>短信请到</dt>
            <dd> <a href="http://www.emay.cn/" target="_blank">http://www.emay.cn/</a>购买</dd>
          </dl>  -->
          <dl class="lineD">
            <dt>当前剩余短信条数:</dt>
            <dd><?php echo (($emay)?($emay):"0"); ?></dd>
          </dl>
          <dl class="lineD">
            <dt>cdkey：</dt>
            <dd>
              <input name="msg[sms][user3]" id="msg[sms][user3]"  class="input" type="text" value="<?php echo ($sms_config["user3"]); ?>" >
            </dd>
          </dl>
          <dl class="lineD">
            <dt>密　码：</dt>
            <dd>
              <input type="password" name="msg[sms][pass3]" id="pass3" value="<?php echo ($sms_config["pass3"]); ?>" class="input" />
            </dd>
          </dl>
        </div>
          <div id="mdec" style="display:none;">
              <!--  <dl class="lineD">
                  <dt>短信请到</dt>
                  <dd> <a href="http://www.zucp.net/" target="_blank">http://www.zucp.net/</a>购买</dd>
                </dl> -->
              <dl class="lineD">
                  <dt>当前剩余短信条数:</dt>
                  <dd><?php echo (($mdec)?($mdec):'0'); ?> </dd>
              </dl>
              <dl class="lineD">
                  <dt>userid：</dt>
                  <dd>
                      <input name="msg[sms][userid4]" id="msg[sms][userid4]"  class="input" type="text" value="<?php echo ($sms_config["userid4"]); ?>" >
                  </dd>
              </dl>
              <dl class="lineD">
                  <dt>账户：</dt>
                  <dd>
                      <input name="msg[sms][user4]" id="msg[sms][user4]"  class="input" type="text" value="<?php echo ($sms_config["user4"]); ?>" >
                  </dd>
              </dl>
              <dl class="lineD">
                  <dt>密码：</dt>
                  <dd>
                      <input type="password" name="msg[sms][pass4]" id="pass4" value="<?php echo ($sms_config["pass4"]); ?>" class="input" />
                  </dd>
              </dl>
          </div>
      </div>
      <!--tab2-->
      <div id="tab_3"  style="display:none;">
        <dl class="lineD">
          <dt>百度云消息推送API_KEY：</dt>
          <dd>
            <input name="msg[baidu][apiKey]" id="msg[baidu][apiKey]"  class="input" type="text" value="<?php echo ($baidu_config["apiKey"]); ?>" >
          </dd>
        </dl>
        <dl class="lineD">
          <dt>百度云消息推送secretKey：</dt>
          <dd>
            <input name="msg[baidu][secretKey]" id="msg[baidu][secretKey]"  class="input" type="text" value="<?php echo ($baidu_config["secretKey"]); ?>" >
          </dd>
        </dl>
        <dl class="lineD">
          <dt>手机客户端最新版本：</dt>
          <dd>
            <input name="msg[baidu][apkVersion]" id="msg[baidu][apkVersion]"  class="input" type="text" value="<?php echo ($baidu_config["apkVersion"]); ?>" >
          </dd>
        </dl>
        <dl class="lineD">
          <dt>手机客户端最新版本下载路径：</dt>
          <dd>
            <input name="msg[baidu][apkPath]" id="msg[baidu][apkPath]"  class="input" type="text" value="<?php echo ($baidu_config["apkPath"]); ?>" >
          </dd>
        </dl>
      </div>

      <!--tab1-->
      <div class="page_btm">
        <input type="submit" class="btn_b" value="确定" />
        <span style="color:#CCCCCC">(所有方式修改提交一次即可)</span> </div>
    </form>
  </div>
  <script language=javascript type="text/javascript" src="__ROOT__/Style/Js/jquery.js"></script>
  <script language=javascript type="text/javascript" >
$(document).ready(function() {
	var b_type = $(":input[name='msg[sms][type]']:checked").val();
	if(b_type==0){
		$("#winic").show();
		$("#zucp").hide(); 
		$("#emay").hide();
		$("#close").hide();
		$("#mdec").hide();
	}else if(b_type==1){
		$("#winic").hide();
		$("#zucp").show(); 
		$("#emay").hide();
		$("#close").hide();
        $("#mdec").hide();
	}else if(b_type==2){
		$("#winic").hide(); 
		$("#zucp").hide();
		$("#emay").show();
		$("#close").hide();
        $("#mdec").hide();
	}else if(b_type==4){
        $("#winic").hide();
        $("#zucp").hide();
        $("#emay").hide();
        $("#close").hide();
        $("#mdec").show();
    }else{
		$("#winic").hide(); 
		$("#zucp").hide();
		$("#emay").hide();
		$("#close").show();
        $("#mdec").hide();
	}
});
$(function(){
   $(":input[name='msg[sms][type]']").click(function(){
  if($(this).attr("value")=="0"){
   		$("#winic").show();
		$("#zucp").hide(); 
		$("#emay").hide();
		$("#close").hide();
      $("#mdec").hide();
  }else if($(this).attr("value")=="1"){
		$("#winic").hide();
		$("#zucp").show(); 
		$("#emay").hide();
		$("#close").hide();
      $("#mdec").hide();
  }else if($(this).attr("value")=="2"){
		$("#winic").hide();
		$("#zucp").hide(); 
		$("#emay").show();
		$("#close").hide();
      $("#mdec").hide();
  }else if($(this).attr("value")=="4"){
      $("#winic").hide();
      $("#zucp").hide();
      $("#emay").hide();
      $("#close").hide();
      $("#mdec").show();
  }else{
		$("#winic").hide(); 
		$("#zucp").hide();
		$("#emay").hide();
		$("#close").show();
      $("#mdec").hide();
  }
 });
});

</script>
</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>