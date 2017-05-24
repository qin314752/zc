<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
     <meta name="baidu-site-verification" content="TwScPktjeu">
     <meta name="baidu-site-verification" content="HQEIQCrNfe">
     <meta name="baidu-site-verification" content="ixSKS9YJXI">
     <meta name="baidu-site-verification" content="udP0gwjX5K">
	 <meta name="renderer" content="webkit">
    <link href="favicon.ico" type="image/x-icon"/>
	<title><?php echo ($glo["web_name"]); ?></title>
	<meta http-equiv="keywords" content="<?php echo ($glo["web_keywords"]); ?>"/>
	<meta http-equiv="description" content="<?php echo ($glo["web_descript"]); ?>"/>
	
	<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/config.css" />
    <link type="text/css" rel="stylesheet" href="__ROOT__/Style/JBox/Skins/Currently/jbox.css"/>
    <link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/index.css" />
	
	<link rel="stylesheet" href="__ROOT__/Style/H/che/css/main.css"/>
    <link href="__ROOT__/Style/H/che/css/new_header.css" rel="stylesheet">
    <link href="__ROOT__/Style/H/che/css/reset.css" rel="stylesheet">
    <link href="__ROOT__/Style/H/che/css/loan.css" rel="stylesheet">
    <link href="__ROOT__/Style/H/che/css/member.css" rel="stylesheet">
    <link href="__ROOT__/Style/H/che/css/opera.css" rel="stylesheet">
	
	
	
	<script src="__ROOT__/Style/H/che/js/hm.js"></script>
	<script type="text/javascript" src="__ROOT__/Style/H/che/js/artDialog.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/iframeTools.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/wncore.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/jquery-1.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/layer.js"></script>
	<link style="" id="layui_layer_skinlayercss" href="__ROOT__/Style/H/che/css/layer.css" rel="stylesheet">
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/pager.js"></script>
   <script type="text/javascript" src="__ROOT__/Style/H/che/js/jquery_004.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/jquery.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/jquery_003.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/jquery_002.js"></script>

    <!-- 配置文件 -->
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/ueditor.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/ueditor_002.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/H/che/js/new_index.js"></script>
	
	<!--old header  -->
	<script type="text/javascript" src="__ROOT__/Style/H/js/jquery.min.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/Js/jquery.js"></script>
    <script  src="__ROOT__/Style/JBox/jquery.jBox.min.js" type="text/javascript"></script>
    <script  src="__ROOT__/Style/JBox/jquery.jBoxConfig.js" type="text/javascript"></script>
    <script  type="text/javascript" src="__ROOT__/Style/Js/ui.core.js"></script>
    <script  type="text/javascript" src="__ROOT__/Style/Js/ui.tabs.js"></script>
    <script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
    <script type="text/javascript" src="__ROOT__/Style/Js/utils.js"></script>
    </head>

<body>


<script type="text/javascript">
var basepath = "";
</script>
<link href="__ROOT__/Style/H/head/common.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/H/head/float.css" rel="stylesheet" type="text/css">
<!-- <link href="__ROOT__/Style/H/head/style.css" rel="stylesheet" type="text/css"> -->

<link href="__ROOT__/Style/H/head/jquery.alerts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="__ROOT__/Style/H/head/qly.commons.css">

	
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/config.css" />

<script type="text/javascript">
$(function(){
	$("#menu09 a").addClass("now");
});
</script>
</head>
<body>

<style>.goldtree{width: 131px;height: 76px;position:absolute;top: 0px;left: 330px;}</style>
<!-- Header Start -->
<div class="shi_top">
<div class="bar">
<p class="topl" style="position:relative;">
<span class="tel">全国服务热线：<i><?php echo ($tel["qq_num"]); ?></i></span>

<span class="" style="margin-left:30px;">官方QQ群：<i><?php echo ($qun["qq_num"]); ?></i></span>

        <!--<span class="weixincode">
		  <i class="wxcode">
			 <?php if(is_array($qq)): $i = 0; $__LIST__ = $qq;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qq): $mod = ($i % 2 );++$i;?><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($qq["qq_num"]); ?>&site=qq&menu=yes"><?php echo ($qq["qq_title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	      </i>
		</span>-->
		<div class="kefus" style="display:none;position:absolute;top:23px;left:590px;border:0px solid red;z-index:99999;background:#d53740;">
		
		<?php if(is_array($qqs)): $i = 0; $__LIST__ = $qqs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$iqq): $mod = ($i % 2 );++$i;?><span class="kefucode" style="display:block;width:99%;">
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($iqq["qq_num"]); ?>&site=qq&menu=yes" style="display:block;width:99%;color:white;font-size:14px;text-align:left;padding:0 10px 0 10px;"><?php echo ($iqq["qq_title"]); ?></a>
		</span><?php endforeach; endif; else: echo "" ;endif; ?>
		
		</div>
        <!--<span><a class="mobileapp" href="" title="手机客户端下载">&nbsp;</a></span>-->

		</p>
<style>
.wxcode a{color:black;width:100px; text-align:center; height:28px; margin-left:30px;margin-top:5px;}
</style>
<p class="wel">        

					<?php if($UID == ''): ?><a  href="/member/index/">您好,<?php echo cnsubstr(get_username($UID),11);?></a> 
						<a href="/member/common/register/" rel="nofollow" title="免费注册">[免费注册]</a> | 
						<a href="/member/common/login/" rel="nofollow" title="登录">[登录]</a> 
						<?php else: ?>
						<a style="" href="/member/index/">您好：<?php echo cnsubstr(get_username($UID),11);?></a> |
						<a style="" href="/member/common/actlogout">退出</a><?php endif; ?>

 <!--| <a href="/newguide/register" title="众筹指引">[众筹指引]</a> | <a href="/newguide/register" title="注册指引">[注册指引]</a>-->
</p>
</div>
</div>
<div class="header">
<div class="shi_bar" style="position:relative">
	<a href="/"><?php echo get_ad(1);?></a>
	
	<ul class="shi_menu">

		<!-- <li id="menu07"><a href="https://www.sh.com/" title="首页">首页</a></li> -->
                            <?php $typelist = getTypeList(array('type_id'=>0,'limit'=>6)); foreach($typelist as $vtype=> $va){ ?>
                            <?php $urlarr = explode("/",$va['type_url']); ?>
                            <?php if($url==$urlarr[1]){ ?>
                            <li><a href="<?php echo ($va["turl"]); ?>" class="float_left menu-a-current font16"><?php echo ($va["type_name"]); ?></a>
                                
                            </li>
                            <?php }else{ ?>
                            <li><a href="<?php echo ($va["turl"]); ?>" class="float_left menu-a font16"><?php echo ($va["type_name"]); ?></a>
                                
                            </li>
                            <?php } ?>
                            <?php } ?>

	</ul>
</div>
</div>
<script type="text/javascript">
$(".kefu,.kefus").hover(function(){
	$(".kefus").css('display','block');
},function(){
	$(".kefus").css('display','none');
});
$(".weixincode,.mobileapp").hover(function(){
	$(this).find(".wxcode").stop().fadeToggle(300);
});
</script>
<!-- Header End -->



<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fcf72ab416193c91b64d55a57b4eef13e' type='text/javascript'%3E%3C/script%3E"));
var nowdate = new Date();
var startdate =  new Date("2015/1/1 00:00:00");
var enddate =  new Date("2015/1/5 23:59:59");
if(startdate.getTime()<nowdate.getTime()&nowdate.getTime()<=enddate.getTime()){
	$("#changeaward").attr("href",basepath+"/awardmanage/toeggPage");
}else{
	$("#changeaward").attr("href",basepath+"/awardmanage/tottcjpage");
}
$(function(){	
	//右侧浮窗
	$("#weixinIcon").live("hover",function(){
	$("#weixinBox").stop(true,false).toggle();
	  });
	$("#qqIcon").live("hover",function(){
	$("#qqBox").stop(true,false).toggle();
	  });
	$(".closeIcon").live("click", function(){
	$(".rightIcon").animate({right:'-73px'},500);
	  });
	$("#yyIcon").hover(function(){
		$("#yyBox").stop(true,false).animate({left:"-238px"},500);
	},function(){
			 $("#yyBox").stop(true,false).animate({left:"68px"},500);  
	});
	
});
</script><script src="__ROOT__/Style/H/head/h.js" type="text/javascript"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?cf72ab416193c91b64d55a57b4eef13e";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<!-- script language="javascript" src="http://count18.51yes.com/click.aspx?id=181140733&logo=1" charset="gb2312"></script -->
<script type="text/javascript" src="__ROOT__/Style/H/che/js/respond.js"></script>
<link href="__ROOT__/Style/H/che/css/new_index.css" rel="stylesheet">
<link href="__ROOT__/Style/H/che/css/base.css" rel="stylesheet">
<script type="text/javascript" src="__ROOT__/Style/H/che/js/jquery_005.js"></script>
<script type="text/javascript">
        //全部
         setInterval("time_left()",1000);
         function time_left(){
        	 var data = '{160812094416664097=80669494}'.substring(1,'{160812094416664097=80669494}'.length-1);
        	 data = data.split(",");
        	 //data =eval("("+data+")");
        	$(data).each(function(i,n){
        		  var index = n.indexOf("=");
           		  var key = n.substring(0,index);
           		  var value = n.substring(index+1,n.length-1);
           		  key =  $.trim(key);
           		  var time_code = $("#time_"+key).val();
           		  var leftsecond = "";
           		  if(time_code == "" || time_code == undefined){
           			  leftsecond = parseInt(value/100);
           		  }else{
           			  leftsecond = time_code;
           			  leftsecond--;
           		  } 
           		  
           		  $("#time_"+key).val(leftsecond);
           		  var day = Math.floor(leftsecond/(60*60*24)); 
           		  var hour=Math.floor((leftsecond-day*24*60*60)/3600); 
           		  var minute=Math.floor((leftsecond-day*24*60*60-hour*3600)/60); 
           		  var second=Math.floor(leftsecond-day*24*60*60-hour*3600-minute*60); 
           		  if(leftsecond <= 0){
           			 $("#code_"+key).html("<span>该项目投标已经截止</span>");
           		  }else{
           			 
           			 $("#code_"+key).html("<span>"+day+"</span> 天 <span>"+hour+"</span> 时 <span>"+minute+"</span> 分  <span>"+second+"</span> 秒");
           		  }
           		 
           		  
        		 }); 
         }
         //投标中
          setInterval("time_leftA()",1000);
         function time_leftA(){
        	 var data = '{160812094416664097=80669395}'.substring(1,'{160812094416664097=80669395}'.length-1);
        	 data = data.split(",");
        	 //data =eval("("+data+")");
        	$(data).each(function(i,n){
        		  var index = n.indexOf("=");
           		  var key = n.substring(0,index);
           		  var value = n.substring(index+1,n.length-1);
           		  key =  $.trim(key);
           		  var time_code = $("#time_"+key).val();
           		  var leftsecond = "";
           		  if(time_code == "" || time_code == undefined){
           			  leftsecond = parseInt(value/100);
           		  }else{
           			  leftsecond = time_code;
           			  leftsecond--;
           		  } 
           		  
           		  $("#timeA_"+key).val(leftsecond);
           		  var day = Math.floor(leftsecond/(60*60*24)); 
           		  var hour=Math.floor((leftsecond-day*24*60*60)/3600); 
           		  var minute=Math.floor((leftsecond-day*24*60*60-hour*3600)/60); 
           		  var second=Math.floor(leftsecond-day*24*60*60-hour*3600-minute*60); 
           		  if(leftsecond <= 0){
           			 $("#codeA_"+key).html("<span>该项目投标已经截止</span>");
           		  }else{
           			 $("#codeA_"+key).html("<span >"+day+"</span> 天 <span>"+hour+"</span>时 <span>"+minute+"</span> 分 <span>"+second+"</span> 秒");
           		  }
           		 
           		  
        		 }); 
         }
</script>
<script type="text/javascript">
	 $(function(){
			 
			 if($.cookie('first-login')!='yes')
			 {
				    $('#divbox').fadeIn(function(){
				 		$('.position-wrap').delay(10000).fadeOut(1000);
				 	}) ;
			 }
			 $.cookie('first-login', 'yes'); 
			 
		})
		
</script>

<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/member/css/blue_dream_zhongchou.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/member/css/my_account.css">
<script type="text/javascript" src="__ROOT__/Style/H/member/js/jquery-1.js"></script>
<script type="text/javascript" src="__ROOT__/Style/H/member/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/member/css/blue_dream_zhongchou.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/member/css/my_account.css">
<script type="text/javascript" src="__ROOT__/Style/H/member/js/ajaxfileupload.js"></script>
<script src="__ROOT__/Style/H/member/js/m.js"></script>
<script type="text/javascript" src="__ROOT__/Style/H/member/js/gs_image_100-50_en.js" defer="defer"></script>


<script type="text/javascript">
$(function () {
    var Accordion = function (el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;
        var links = this.el.find('.link');
        links.on('click', {
            el: this.el,
            multiple: this.multiple
        }, this.dropdown);
    };
    Accordion.prototype.dropdown = function (e) {
        var $el = e.data.el;
        $this = $(this), $next = $this.next();
        $next.slideToggle();
        $this.parent().toggleClass('open');
        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        }
        ;
    };
    var accordion = new Accordion($('#accordion'), false);
});
//@ sourceURL=pen.js
</script>
<style class="firebugResetStyles" type="text/css" charset="utf-8">/* See license.txt for terms of usage */

/** reset styling **/

.firebugResetStyles {

    z-index: 2147483646 !important;

    top: 0 !important;

    left: 0 !important;

    display: block !important;

    border: 0 none !important;

    margin: 0 !important;

    padding: 0 !important;

    outline: 0 !important;

    min-width: 0 !important;

    max-width: none !important;

    min-height: 0 !important;

    max-height: none !important;

    position: fixed !important;

    transform: rotate(0deg) !important;

    transform-origin: 50% 50% !important;

    border-radius: 0 !important;

    box-shadow: none !important;

    background: transparent none !important;

    pointer-events: none !important;

    white-space: normal !important;

}

style.firebugResetStyles {

    display: none !important;

}



.firebugBlockBackgroundColor {

    background-color: transparent !important;

}



.firebugResetStyles:before, .firebugResetStyles:after {

    content: "" !important;

}

/**actual styling to be modified by firebug theme**/

.firebugCanvas {

    display: none !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.firebugLayoutBox {

    width: auto !important;

    position: static !important;

}



.firebugLayoutBoxOffset {

    opacity: 0.8 !important;

    position: fixed !important;

}



.firebugLayoutLine {

    opacity: 0.4 !important;

    background-color: #000000 !important;

}



.firebugLayoutLineLeft, .firebugLayoutLineRight {

    width: 1px !important;

    height: 100% !important;

}



.firebugLayoutLineTop, .firebugLayoutLineBottom {

    width: 100% !important;

    height: 1px !important;

}



.firebugLayoutLineTop {

    margin-top: -1px !important;

    border-top: 1px solid #999999 !important;

}



.firebugLayoutLineRight {

    border-right: 1px solid #999999 !important;

}



.firebugLayoutLineBottom {

    border-bottom: 1px solid #999999 !important;

}



.firebugLayoutLineLeft {

    margin-left: -1px !important;

    border-left: 1px solid #999999 !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.firebugLayoutBoxParent {

    border-top: 0 none !important;

    border-right: 1px dashed #E00 !important;

    border-bottom: 1px dashed #E00 !important;

    border-left: 0 none !important;

    position: fixed !important;

    width: auto !important;

}



.firebugRuler{

    position: absolute !important;

}



.firebugRulerH {

    top: -15px !important;

    left: 0 !important;

    width: 100% !important;

    height: 14px !important;

    background: url("") repeat-x !important;

    border-top: 1px solid #BBBBBB !important;

    border-right: 1px dashed #BBBBBB !important;

    border-bottom: 1px solid #000000 !important;

}



.firebugRulerV {

    top: 0 !important;

    left: -15px !important;

    width: 14px !important;

    height: 100% !important;

    background: url("") repeat-y !important;

    border-left: 1px solid #BBBBBB !important;

    border-right: 1px solid #000000 !important;

    border-bottom: 1px dashed #BBBBBB !important;

}



.overflowRulerX > .firebugRulerV {

    left: 0 !important;

}



.overflowRulerY > .firebugRulerH {

    top: 0 !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.fbProxyElement {

    position: fixed !important;

    pointer-events: auto !important;

}

</style></head>
<body>﻿


    <meta charset="utf-8">
    <title></title>
      
    <link rel="shortcut icon" href="https://www.xiaokazx.com/favicon.ico">
    <link rel="bookmark" href="https://www.xiaokazx.com/favicon.ico"> 
    <script>
_pro_track_id='bd2f59e19156692947cd';
</script>


<script>

$(document).ready(function(){
    $('.zc_nav li').each(function(){
        if($($(this))[0].href==String(window.location))
            $(this).parent().addClass('nav_active');
    });
})
</script>


<div class="zc_main" style="height:900px;">
  <div class="zc_content bgfff">
    <ul class="breadcrumb">
      <li><a href="/">首页</a> </li>
      <li class="active">账户中心</li>
      <div class="clear"></div>
    </ul>
  </div>
  <div class="zc_content  zc_hot_content">




<script language="javascript">

function shangchuan(){
    $("#image_file").click();
}
function ajaxFileUpload() {
            $.ajaxFileUpload
            (
                {
                    url: 'storesimg', //用于文件上传的服务器端请求地址
                    secureuri: false, //一般设置为false
                    fileElementId: 'image_file', //文件上传空间的id属性  <input type="file" id="file" name="file" />
                    dataType: 'text', //返回值类型 一般设置为json
                  
                    success: function (data)  //服务器成功响应处理函数
                    {
                       
                        var repObj = $.parseJSON(data);
        
                       $("#img").attr("src", repObj.img_url);
                        $("#img1").attr("src", repObj.img_url);
                        if (typeof (repObj.error) != 'undefined') {
                            if (repObj.error != '') {
                                alert(repObj.error);
                            } else {
                                alert(repObj.msg);
                            }
                        }
                    },
                    error: function (data, status, e)//服务器响应失败处理函数
                    {
                        alert(e);
                    }
                }
            )
            return false;
        } 


</script>
  

<div class=" myaccount_left">


<div class=" myaccount_left_part">

 <input style="display:none;" id="image_file" accept="image/*" name="image_file" onchange="ajaxFileUpload();" type="file"> 
 
 
<div class="my_pic"><a href="__APP__/member/user#fragment-1"><img id="img" name="img" src="<?php echo (get_avatar($UID)); ?>" height="115" width="115"></a></div> 
                 
<ul class="my_rz " style="text-align:center">
    <?php echo (getverify_ucenter($minfo["id"])); ?>
<div class="clear"></div>
</ul>
</div>
<div class=" myaccount_left_part">

  <ul class="about_us accordion" id="accordion">
    <li class="">
     <div class="link moneygl_ico">基本设置</div>
            <ul style="display: none;" class="submenu">
        <li><a href="__APP__/member/user#fragment-1">头像与密码</a></li>
        <li><a href="__APP__/member/verify?id=1#fragment-1">认证中心</a></li>
        <?php if($loginconfig['qq']['enable'] == '0' and $loginconfig['sina']['enable'] == '0'): ?><li class="last"><a href="__APP__/member/msg#fragment-1">系统消息</a></li>
          <?php else: ?>
          <li><a href="__APP__/member/msg#fragment-1">系统消息</a></li>
          <li class="last"><a  href="__APP__/member/oauthlogin">快捷登录</a></li><?php endif; ?>
            </ul>
    </li>
    
    <li class="">
        <div class="link accountgl_ico">众筹管理</div>
         <ul style="display: none;" class="submenu">
              <li><a href="__APP__/member/infocrowd#fragment-1">众筹投资</a></li>
              <li class="last"><a href="__APP__/member/crowdauto#fragment-1">众筹预约</a></li>
        </ul>
    </li>

    <li class="">
     <div class="link huodonggl_ico">众筹红包</div>
    <ul style="display: none;" class="submenu">
              <li><a href="__APP__/member/crowddonate#fragment-1">众筹红包</a></li>
              <li class="last"><a href="__APP__/member/crowddonate#fragment-2">使用记录</a></li>
    </ul>
    </li>
     
    <li class="">
      <div class="link eachgl_ico">资金管理</div>
         <ul style="display: none;" class="submenu">
        <li><a href="__APP__/member/capital#fragment-1">资金统计</a></li>
        <li><a href="__APP__/member/charge#fragment-1">我要充值</a></li>
        <li><a href="__APP__/member/withdraw#fragment-1">我要提现</a></li>
        <li><a href="__APP__/member/bank#fragment-1">银行帐户</a></li>
                
        </ul>
    </li>
    
    <li class="">
      <div class="link eachgl_ico">邀请有奖</div>
         <ul style="display: none;" class="submenu">
        <li><a href="/member/promotion#fragment-1">邀请好友</a></li>
                
        </ul>
    </li>
  </ul>
  
</div>
<div class=" myaccount_left_part">
<div class="myaccount_left_service">
    <p>客服热线</p>
    <!--<div class="mylft_img"><div class="mylft_nr"><p><a class="icoTc" title="点击开始QQ交谈/留言" href="http://wpa.qq.com/msgrd?v=3&uin=1828529320&site=qq&menu=yes" target="_blank">QQ客服</a></p><p>0532-68992383</p></div></div>-->
    <dl class="service">
    <dt><img src="__ROOT__/Style/H/member/images/service.png"></dt>
    
    <dd><?php echo ($tel["qq_num"]); ?></dd>
    <div class="clear"></div>
    </dl>
  </div>
</div>

</div>
<script type="text/javascript">
function xuanzhong(lei){
    window.location.href="my_account?lei="+lei; 
    
}
</script>


<div class="myaccount_right">
  
     
       <div class="myaccount_right_part height152">
  <dl class="myaccount_money">
  <dt>账户余额：<span class="fb4140"> <?php echo Fmoney($minfo['account_money']+$minfo['back_money']);?> </span>元</dt>
  <dd>帐户总额： <?php echo Fmoney($minfo['account_money']+$minfo['back_money']+$minfo['money_freeze']+$bj_crowds['capital']);?>  元</dd>
  <dd>预约金额： <?php echo Fmoney($surplus_money['surplus_money']);?>  元</dd>
  <dd>众筹金额：<?php echo (fmoney($bj_crowds["capital"])); ?> 元</dd>
  <dd>冻结金额： <?php echo Fmoney($minfo['money_freeze']);?>  元</dd>
  </dl>
  <div class="myaccount_btn">
  <a href="__APP__/member/charge#fragment-1"><p class="myaccount_btn_cz">充值</p></a>
  <a href="__APP__/member/withdraw#fragment-1"><p class="myaccount_btn_tx">提现</p></a>
  </div>
  
 


  </div>
  <div class="myaccount_right_part">
  <script>
$(function(){
    $(".myaccount_mine_select_no").each(function(index) {
        $(".myaccount_mine_select_no").eq(index).click(function(){
            $(".myaccount_mine_select_no").removeClass("myaccount_mine_select").eq(index).addClass("myaccount_mine_select")
            $(".myaccount_content").css("display", "none").eq(index).css("display","block")
        })
    });
})



//.css({"color":"#666","border":"1px solid #e4e4e4","padding":"15px 25px"}).css({"color":"#fff"})


</script>
  <ul class="myaccount_mine">
  <li class="myaccount_mine_select myaccount_mine_select_no">我支持的</li>
 <!-- <li class="myaccount_mine_select_no">我关注的</li>
  <li class="myaccount_mine_select_no">我发起的</li>
  <li class="myaccount_mine_select_no"><span class="delete"></span>回收站</li>-->
    <li style="float:right"><a href="http://59.110.137.120/crowdinvest/index"><span class="myaccount_more"></span>更多支持项目</a></li>
<!--
  <li class="myaccount_mine_select_no colorfb4140" style="float:right"><span class="minecm"></span>我的筹码</li>
  -->
  <div class="clear"></div>
  </ul>
  <ul class="myaccount_chose margintop15">
  
 <!-- 
  <li  onclick="xuanzhong(2)">已支付</li>
  <li  onclick="xuanzhong(3)">未支付</li>
-->  
  <div class="clear"></div>
  </ul>
  <div class="myaccount_content margintop15">
  <table class="table table-striped min_width">
                    <thead>
                    
                
                        <tr>
                            <th class="color_fff color0099cb_b"> 编号 </th>
                            <th class="color_fff color0099cb_b"> 项目金额 </th>
                            <th class="color_fff color0099cb_b"> 众筹时间</th>
                            <th class="color_fff color0099cb_b"> 状态  </th>
                        </tr>
                  
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td class="tdContent"><a href="<?php echo (getcrowdinvesturl($vo["id"])); ?>"><?php echo ($vo["id"]); ?></a></td>
                                <td class="tdContent"><?php echo (($vo["crowd_money"])?($vo["crowd_money"]):"0.00"); ?>元</td>
                                <td class="tdContent"><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>
                                <td class="tdContent"><?php if($vo["status"] == 5): ?>已完成<?php else: ?>溢价回购完成<?php endif; ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </thead>

                     
                </table>
                <?php  if($list ==''){?>
                    <p style=" text-align:center;">您目前没有支持的项目，<a style="color:#E42607;" href="http://59.110.137.120/crowdinvest/index">请前往众筹</a></p>
                    <?php }?> 
                      </div>
  <div class="myaccount_content margintop15 none">1222</div>
  <div class="myaccount_content margintop15 none">333</div>
  <div class="myaccount_content margintop15 none">444</div>
  
  
  </div>
</div>
</div>
<!--hot end-->
<div class="clear"></div>
</div>
<div class="clear" style="margin-bottom:3px;clear:both;"></div>

<script type="text/javascript">
function xuanzhong(lei){
    window.location.href="my_account?lei="+lei; 
    
}
</script>
<div class="bottom-css font14 color-bg-black color-white text-center width-100 minwidth1200 ">
    <?php echo ($glo["bottom"]); ?>
   <!--  <div class="width1200 margin-auto" style="height: 50px;text-align: center">
       <div style="width: auto;margin: 0 auto;">
            <script src="http://kxlogo.knet.cn/seallogo.dll?sn=e160129370100623529bdw000000&size=0"></script>
            <a  key ="56986072efbfb00c17b63356"  logo_size="124x47"  logo_type="business"  href="http://www.anquan.org" ><script src="http://static.anquan.org/static/outer/js/aq_auth.js"></script></a>
            <a id='___szfw_logo___' href='https://credit.szfw.org/CX20160116013333290199.html' target='_blank'><img src='http://icon.szfw.org/cert.png' border='0' /></a>
            <script type='text/javascript'>(function(){document.getElementById('___szfw_logo___').oncontextmenu = function(){return false;}})();</script>
                <!--<img src="__ROOT__/Style/H/images/index/cfca.jpg" style="cursor: pointer;margin-right: 35px;" alt=""/>-->
                <!--<img src="__ROOT__/Style/H/images/index/360safe.jpg" style="cursor: pointer;margin-right: 35px;" alt=""/>-->
                <!--<img src="__ROOT__/Style/H/images/index/safe2.jpg" style="cursor: pointer;margin-right: 35px;" alt=""/>-->
            <!--<img src="__ROOT__/Style/H/images/index/safe3.jpg" style="cursor: pointer;margin-right: 35px;" alt=""/>
        </div>
    </div>-->
</div>
</body>
</html>
</body>
</html>

<!--结束-->