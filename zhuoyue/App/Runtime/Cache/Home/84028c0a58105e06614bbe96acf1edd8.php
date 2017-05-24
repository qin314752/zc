<?php if (!defined('THINK_PATH')) exit();?>

<?php if($web_close["isopen"] == 2): ?><div class="web_close" style="text-align: center;font-size: 30px;margin-top:200px;">
    <span><?php echo ($web_close["title"]); ?></span>
</div>
<?php else: ?>
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

<title>我要众筹-<?php echo ($glo["web_name"]); ?></title>
<meta http-equiv="keywords" content="<?php echo ($glo["web_keywords"]); ?>"/>
<meta http-equiv="description" content="<?php echo ($glo["web_descript"]); ?>"/>


<head>
<script src="__ROOT__/Style/H/che/css/ta.php" async="" charset="utf-8" type="text/javascript"></script>

<script src="__ROOT__/Style/H/che/js/js/contains.js" async="" charset="utf-8" type="text/javascript"></script>
<script src="__ROOT__/Style/H/che/js/js/taskMgr.js" async="" charset="utf-8" type="text/javascript"></script>
<script src="__ROOT__/Style/H/che/js/js/views.js" async="" charset="utf-8" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="baidu-site-verification" content="N04zA8U7Tp">
<meta property="qc:admins" content="354526626263051176375">
<meta property="wb:webmaster" content="5e8a4649da01fe01">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=8" /> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="baidu-site-verification" content="ufZMqsT36l">
<meta name="renderer" content="ie-stand">

<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/css.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/kefu.css">
<link type="text/css" rel="stylesheet" href="__ROOT__/Style/H/che/css/jbox.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/style.css">
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/style_index.css">
<script type="text/javascript" src="__ROOT__/Style/H/che/js/js/jquery_002.js"></script> 
<script type="text/javascript" src="__ROOT__/Style/H/che/js/js/jquery_004.js"></script>
<script src="__ROOT__/Style/H/che/js/js/jquery_003.js" type="text/javascript"></script>
<script src="__ROOT__/Style/H/che/js/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="__ROOT__/Style/H/che/js/js/utils.js"></script>

<!-- <style>
.shi_bar a{float:none;}
.shi_bar ul{margin-top:-10px;}
</style> -->



<script type="text/javascript">
    var browser=navigator.appName;
    var b_version=navigator.appVersion;
    var version=b_version.split(";"); 
    if(version.length>1) var trim_Version=version[1].replace(/[ ]/g,"");

    if(browser=="Microsoft Internet Explorer" && (trim_Version=="MSIE5.0" || trim_Version=="MSIE6.0")) 
        alert("您正在使用的浏览器版本过低，有些网站效果会显示不出来，建议升级后再使用本网站。"); 

	function makevar(v){
		var d={};
		for(i in v){
			var id = v[i];
			d[id] = $("#"+id).val();
			if(!d[id]) d[id] = $("input[name='"+id+"']:checked").val();
			if(!d[id]) d[id] = $("input[name='"+id+"']").val();
			if(typeof d[id] == "undefined") d[id] = "";
		}
		return d;
	}
    function addBookmark(title, url) {
        if (window.sidebar) {
            window.sidebar.addPanel(title, url, "");
        }
        else if (document.all) {
            window.external.AddFavorite(url, title);
        }
        else if (window.opera && window.print) {
            return true;
        }
    }
    function SetHome(obj, vrl) {
        try {
            obj.style.behavior = 'url(#default#homepage)'; obj.setHomePage(vrl);
            NavClickStat(1);
        }
        catch (e) {
            if (window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                }
                catch (e) {
                    alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");
                }
                var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                prefs.setCharPref('browser.startup.homepage', vrl);
            }
        }
    }
     
// 修复 IE 下 PNG 图片不能透明显示的问题
function fixPNG(myImage) {
var arVersion = navigator.appVersion.split("MSIE");
var version = parseFloat(arVersion[1]);
if ((version >= 5.5) && (version < 7) && (document.body.filters))
{
     var imgID = (myImage.id) ? "id='" + myImage.id + "' " : "";
     var imgClass = (myImage.className) ? "class='" + myImage.className + "' " : "";
     var imgTitle = (myImage.title) ? "title='" + myImage.title   + "' " : "title='" + myImage.alt + "' ";
     var imgStyle = "display:inline-block;" + myImage.style.cssText;
     var strNewHTML = "<span " + imgID + imgClass + imgTitle

   + " style=\"" + "width:" + myImage.width

   + "px; height:" + myImage.height

   + "px;" + imgStyle + ";"

   + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"

   + "(src='" + myImage.src + "', sizingMethod='scale');\"></span>";
     myImage.outerHTML = strNewHTML;
} } 


</script>
<!-- 客服风格 -->

<!-- 客服代码begin -->
<style type="text/css">
/**{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
body{font:12px/180% Arial, Helvetica, sans-serif, "新宋体";background:#ddd;}
*/
#leftsead{width:131px;height:143px;position:fixed;top:450px;right:0px;z-index:100;}
*html #leftsead{margin-top:450px;position:absolute;top:expression(eval(document.documentElement.scrollTop));z-index:100;}
#leftsead li{width:131px;height:60px;}
#leftsead li img{float:right;}
#leftsead li a{height:49px;float:right;display:block;min-width:47px;max-width:131px;}
#leftsead li a .shows{display:block;}
#leftsead li a .hides{margin-right:-143px;cursor:pointer;cursor:hand;}
#leftsead li a.youhui .hides{display:none;position:absolute;right:190px;top:54px;}
.Nav_nav .navigation-list .navigation-item {margin-left: 50px; }
</style>
<script charset="utf-8" src="__ROOT__/Style/H/che/css/wpa.php"></script>
<script id="_da" src="__ROOT__/Style/H/che/js/js/i.js" async="" charset="utf-8"></script>
</head>
<body>
<iframe style="position: absolute; width: 0px; height: 0px; border: 0px none;" tabindex="-1" title="" src="__ROOT__/Style/H/che/css/id.htm" frameborder="0"></iframe>
<iframe style="display: none;"></iframe>
<style type="text/css">.WPA3-SELECT-PANEL { z-index:2147483647; width:463px; height:292px; margin:0; padding:0; border:1px solid #d4d4d4; background-color:#fff; border-radius:5px; box-shadow:0 0 15px #d4d4d4;}.WPA3-SELECT-PANEL * { position:static; z-index:auto; top:auto; left:auto; right:auto; bottom:auto; width:auto; height:auto; max-height:auto; max-width:auto; min-height:0; min-width:0; margin:0; padding:0; border:0; clear:none; clip:auto; background:transparent; color:#333; cursor:auto; direction:ltr; filter:; float:none; font:normal normal normal 12px "Helvetica Neue", Arial, sans-serif; line-height:16px; letter-spacing:normal; list-style:none; marks:none; overflow:visible; page:auto; quotes:none; -o-set-link-source:none; size:auto; text-align:left; text-decoration:none; text-indent:0; text-overflow:clip; text-shadow:none; text-transform:none; vertical-align:baseline; visibility:visible; white-space:normal; word-spacing:normal; word-wrap:normal; -webkit-box-shadow:none; -moz-box-shadow:none; -ms-box-shadow:none; -o-box-shadow:none; box-shadow:none; -webkit-border-radius:0; -moz-border-radius:0; -ms-border-radius:0; -o-border-radius:0; border-radius:0; -webkit-opacity:1; -moz-opacity:1; -ms-opacity:1; -o-opacity:1; opacity:1; -webkit-outline:0; -moz-outline:0; -ms-outline:0; -o-outline:0; outline:0; -webkit-text-size-adjust:none; font-family:Microsoft YaHei,Simsun;}.WPA3-SELECT-PANEL a { cursor:auto;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-TOP { height:25px;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-CLOSE { float:right; display:block; width:47px; height:25px; background:url(http://combo.b.qq.com/crm/wpa/release/3.3/wpa/views/SelectPanel-sprites.png) no-repeat;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-CLOSE:hover { background-position:0 -25px;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-MAIN { padding:23px 20px 45px;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-GUIDE { margin-bottom:42px; font-family:"Microsoft Yahei"; font-size:16px;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-SELECTS { width:246px; height:111px; margin:0 auto;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-CHAT { float:right; display:block; width:88px; height:111px; background:url(http://combo.b.qq.com/crm/wpa/release/3.3/wpa/views/SelectPanel-sprites.png) no-repeat 0 -80px;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-CHAT:hover { background-position:-88px -80px;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-AIO-CHAT { float:left;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-QQ { display:block; width:76px; height:76px; margin:6px; background:url(http://combo.b.qq.com/crm/wpa/release/3.3/wpa/views/SelectPanel-sprites.png) no-repeat -50px 0;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-QQ-ANONY { background-position:-130px 0;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-LABEL { display:block; padding-top:10px; color:#00a2e6; text-align:center;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-BOTTOM { padding:0 20px; text-align:right;}.WPA3-SELECT-PANEL .WPA3-SELECT-PANEL-INSTALL { color:#8e8e8e;}</style><style type="text/css">.WPA3-CONFIRM { z-index:2147483647; width:285px; height:141px; margin:0; background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAR0AAACNCAMAAAC9pV6+AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjU5QUIyQzVCNUIwQTExRTJCM0FFRDNCMTc1RTI3Nzg4IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjU5QUIyQzVDNUIwQTExRTJCM0FFRDNCMTc1RTI3Nzg4Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NTlBQjJDNTk1QjBBMTFFMkIzQUVEM0IxNzVFMjc3ODgiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NTlBQjJDNUE1QjBBMTFFMkIzQUVEM0IxNzVFMjc3ODgiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6QoyAtAAADAFBMVEW5xdCkvtNjJhzf6Ozo7/LuEQEhHifZ1tbv8vaibw7/9VRVXGrR3en4+vuveXwZGCT///82N0prTRrgU0MkISxuEg2uTUqvEwO2tbb2mwLn0dHOiQnExMacpKwoJzT29/n+qAF0mbf9xRaTm6abm5vTNBXJ0tvFFgH/KgD+ugqtra2yJRSkq7YPDxvZGwDk7O//2zfoIgH7/f1GSV6PEAhERUtWWF2EiZHHNix1dXWLk53/ySLppQt/gID9IAH7Mgj0JQCJNTTj4+QaIi0zNDr/0Cvq9f/s+/5eYGrn9fZ0eYXZ5O3/tBD8/f5udHy6naTV2t9obHl8gY9ubW/19fXq8fXN2uT/5z/h7PC2oaVmZWoqJR6mMCL3+f33KQM1Fhr6NRT9///w/v/ftrjJDQby9vpKkcWHc3vh7vvZ5uvpPycrMEHu7/De7fne5+709voyKSTi7PVbjrcuLTnnNAzHFhD7/P3aDwDfNxTj6vHz9fj09vj3///19/ny9PevuMI9PEPw8/bw8vbx9PdhYWHx8/fy9ff19vj19vny9fjw8/fc6fOosbza5/LX5fDV4+/U4u7S4e3R4O3O3uvd6vTe6vTd6fPb6PPb6PLW5PDZ5/HW5O/Z5vHV5O/T4e7T4u7Y5vHY5fHO3evR4OzP3+vP3uvQ3+xGt/9Lg7Dz9vjv8/X7+/3d5+vi6+7g6ezh6u3w9Pbc5+rt8vTl7fDn7vHr8fP2+Pr3+fv6+/zq8PPc5urb5en4+/7Y5epGsvjN3erW4OXf6+/s8/bn8PPk7vLv9fiAyfdHrO6Aorz09vnx9fnz9Pb09/vv8fVHsfd+zP/jwyLdExFekLipYWLN3OjR3Oa0k5n/9fXX6PDh7vDU4ey6fAzV4+5HOSHIoBP+/v3b6OppaGrT4Ovk6/Lw8PE8P1Pz+v/w8/nZ5vDW4erOztL/LgT3+Pn2+PvY5/Ta5/HvuxfZ5Ojm8f6lrrrI1uPw0iZPT1Sps7r19/iqtLzxKgjZ3N9RVFtQSkbL2ujM2+ku4f1qAAAIDklEQVR42uzcC3ATdR7A8S3QhZajm+RSEmxZEhIT2vKvjU1aWqAPWr1IsRTkoRZb4Qoi6XmFYHued5coQe8wFLSoFOXV0oeIShG13ANURBmoeme9Z6dXnbP34OF517MOUo/7JykNySXZjPP/rzPb37d0y7Yz/5n9zP43u9tNmUnqHBcUqpzUakatf2QaFKqz+lQm5931T0KhWv9uDuNavwMK3XoX43oq+koYXemQxem0WLMv/fYp6Yd1Hou2v39RarHzvBLHsnyWbtmOxyRe9Do7DaWWfjmPYVjWu2CzLo0CnaejyzGUmSm3Yx0fjafi3B1PSzqsszOqHJkYx2bz6iiv7j189j93SqnTzZ5l8+mr61hnazQxg5mZ/XhisRw+6CiVHOK8POW5u7ZKqFZt8/DCV5Q6zdZ+Lw7vVCKMg8oH7cjLY78kJZ2tzdpW/G/rNTq7oihX3i+Xy21yxzy1HSmRXV17zom8s2to2S4pdUCrbfCvYZ1nBdtnGLTZMI4yVSbrU+NZpcdfkznf5Mp9Vkp9qNW2+Newzj7hdLzdZrNx/Z/Ikj9OHkLF86bqO5dYULlHx2L4wz7J1KBtOKFtGFnFOvsF+5ZVqeR5O7J2Lsmy6F3IlfqVRd3p8h55lPzU/ZKpSdu0f/8Jz8IX1qkXjHF6zo95ZL2wZLB87sdoSK/WZ1+403dcrindXS+VTl/xLE+cbhxej0Zn34D36kGJnNWyVGfqnaj4XOe8eZ84fTOLz1pWL9WwTqNgOtZ3Dsip+1b2jecR0nuPzsOnPBamvlGiYZ1nBGrcne3DwTtP8o2XMxGHlDOPJg/vOixvYZ6Ralhnt1B/uqfIe4LMsogfcpb3evpKOXy2zNqL79i7W6JhnW0CNS5M9F4+4JnUq4j7868//3z6Z3OSehS9rHdu2SoLDdskWhQ627pVlZiH43p75sxevjw+Pn55xvQFGo2mR8Fx5UVFiebflUhXZ3vk9pwrNKoQp+TjNJqUjPh4r87sBVOmaDRTemqKUKLK2L1dognrbF9oVpnSEKpJSkmaM/2mjIzlGTfNXqCZgm00SeUo0agyTm6Qrs5egRaqVMYv01hUE9ejSEqZjkvxzau4uCLObDIajd17JRrW2SOQI81oTP/y+jEIKTlWkfRZSkqKZk6PAq+gyrQK/DPVPdv3SDOs83jkmuYnpmMC092zxrAcQlyNQqHorUH4f2PSzs9IN6Ybzbapj0szYZ1cnjWn40wVd69bUdhbiV/HucrKyjErrs+vqMDfNpkriyzMHqnqPBGp1gG5HR9dqtJN2KEiPz9/48Yf4Dbm558/P6PAZDLVmdki3r7ov09IMSEdw0Q5PtUpKlRhHJOpoGDGtVUUmKoKeY7l7M4Bqeo0R+iArt+Or6/kzMIVRg9ORcVVmfP4s6BOlWCYiFhOKS/9sFmCYZ3WCP3HKvdcXk08u6rbbMb7T0HeVZ28vNi6tG71pzcvRizeeQaZllbpFVmnxeHZdVg0f+XvZ1UZsY+qqq4uFldXd3/a5ITkW/567GYdvtrilHZdqzR1DkQo13Pfi0XZfdfNqsvDZ8UrEhIme+pOuCO5Y5VM9v0H/j2TxVOL5ecfkGCRdVpLec+NCw7r3B+bZ0rPW1f2nT9+1PHRyVtW/UiGqz1439qZnkt1jrVKVKclQlbvAxdoft93q2JnFOTlrbtOdk19XeNK1uKZ5eHJapFgWKchfE0TfTeUrauwTh7mCdSp/dtfSr6XjWrs2MfaIMEi6zQswjaLM5GzxDOz8AvVuvHX4KzsOnZf/adWtCgX65S2SFOnKUI6JV96ZTHLDtyY8JtY/CL+7aN9/i4ufeAfa5libuoVF8vqmiQY1nFH1SX8EaEv3FIM60R8KvXiRc9i2rQLOLwcZc/kCumM7kAHdEAHdL4BnR9D4QId0AEd0AEd0AEd0BkFOj+FwgU6AjqPQuECHQGdB6FwgQ7ogA7ogA7ogA7ogA7oQKDztXR+CIULdEAHdEAHdEAHdEAHdEAHAp2vpfMzKFygI6DzCBQu0BHQ+QkULtABHdABHdABHdABnTAx2nZCaZnVm/zjljEDNN99zpSF0NlEuFMxa95pI9Q7a2JGxj1rYKplFOurZgxBm0JBZ9OG4+//klDvH99weGRcxwXZrVR71HGWvk572121hLqrrd0/rltWSzn3JlF0nidUkM7zlBNJp5NQQTqdlBNHp2sSoboCdSZRTiSd1wgVpPMa5cTRWf0qoVYH6rxKuRA6m0nX3naG1JvrzrS1+8d1y2i/l88dtCV0dE49R6hTgTrPUU4kHVI3doN0aN9HFkfnzcOEejNQ5zDlxNFZepBQSwN1DlJOJJ0jhArSOUI5cXROvkKok4E6r1AuhM4W0mGdY4TCOv5x3bJjlHMHbQkdnbfGEeqtQJ1xlBNJ5yihgnSOUk4cndtfJtTtgTovU04cnTduINQbgTo3UC6EzkOkwzovEArr+Md1y16gnDtoS+jojH2JUGMDdV6inDg6h14k1KFAnRcpJ45Ox1hCdQTqjKWcODr3HiLUvYE6hygnkk4HoYJ0Oignhs6G997+FaHefu8D/7iOaT+n2+sOEXRi1hwn9Zvi42tizoyMa0j+1y9o9jpTNoG6zpYjMRtIPWXwQUzXyLibNxscVP/GvaPswf/fdx4m3oQJxIbasuXhbzAqOpIJdAR0JkDhAh3QAR3QAR3QAR3QAZ3RrZNzGRTCdPk2JnUu8ITBmatnqlNzXFCobtOP/58AAwA/1aMkKhXCbQAAAABJRU5ErkJggg==) no-repeat;}.WPA3-CONFIRM { *background-image:url(http://combo.b.qq.com/crm/wpa/release/3.3/wpa/views/panel.png);}.WPA3-CONFIRM * { position:static; z-index:auto; top:auto; left:auto; right:auto; bottom:auto; width:auto; height:auto; max-height:auto; max-width:auto; min-height:0; min-width:0; margin:0; padding:0; border:0; clear:none; clip:auto; background:transparent; color:#333; cursor:auto; direction:ltr; filter:; float:none; font:normal normal normal 12px "Helvetica Neue", Arial, sans-serif; line-height:16px; letter-spacing:normal; list-style:none; marks:none; overflow:visible; page:auto; quotes:none; -o-set-link-source:none; size:auto; text-align:left; text-decoration:none; text-indent:0; text-overflow:clip; text-shadow:none; text-transform:none; vertical-align:baseline; visibility:visible; white-space:normal; word-spacing:normal; word-wrap:normal; -webkit-box-shadow:none; -moz-box-shadow:none; -ms-box-shadow:none; -o-box-shadow:none; box-shadow:none; -webkit-border-radius:0; -moz-border-radius:0; -ms-border-radius:0; -o-border-radius:0; border-radius:0; -webkit-opacity:1; -moz-opacity:1; -ms-opacity:1; -o-opacity:1; opacity:1; -webkit-outline:0; -moz-outline:0; -ms-outline:0; -o-outline:0; outline:0; -webkit-text-size-adjust:none;}.WPA3-CONFIRM * { font-family:Microsoft YaHei,Simsun;}.WPA3-CONFIRM .WPA3-CONFIRM-TITLE { height:40px; margin:0; padding:0; line-height:40px; color:#2b6089; font-weight:normal; font-size:14px; text-indent:80px;}.WPA3-CONFIRM .WPA3-CONFIRM-CONTENT { height:55px; margin:0; line-height:55px; color:#353535; font-size:14px; text-indent:29px;}.WPA3-CONFIRM .WPA3-CONFIRM-PANEL { height:30px; margin:0; padding-right:16px; text-align:right;}.WPA3-CONFIRM .WPA3-CONFIRM-BUTTON { position:relative; display:inline-block!important; display:inline; zoom:1; width:99px; height:30px; margin-left:10px; line-height:30px; color:#000; text-decoration:none; font-size:12px; text-align:center;}.WPA3-CONFIRM .WPA3-CONFIRM-BUTTON-FOCUS { width:78px;}.WPA3-CONFIRM .WPA3-CONFIRM-BUTTON .WPA3-CONFIRM-BUTTON-TEXT { line-height:30px; text-align:center; cursor:pointer;}.WPA3-CONFIRM-CLOSE { position:absolute; top:7px; right:7px; width:10px; height:10px; cursor:pointer;}</style>


<!-- 客服代码end -->

<!-- 结束客服风格 -->
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/com.css">

<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/zhongchou.css">
<script type="text/javascript" src="__ROOT__/Style/H/che/js/js/zhongchou.js" language="javascript"></script>

<script type="text/javascript">
function videoverify(){
  $.jBox.confirm("申请视频认证后会直接从帐户扣除认证费用0元，然后客服会联系您进行认证。<br/><font style='color:red'>确定要申请认证吗?</font>", "视频认证", dovideo, { buttons: { '确认申请': true, '暂不申请': false} });
}
function dovideo(v, h, f) {
  if (v == true){
        $.ajax({
            url: "/common/video",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
                if(d){
          if(d.status==1) $.jBox.tip(d.message, 'success');
          else $.jBox.tip(d.message, 'fail');
        }
            }
        });
  }
  return true;
};
// 自定义按钮
function faceverify(){
  $.jBox.confirm("<font style='color:red'>确定要申请现场认证吗?</font>", "现场认证", doface, { buttons: { '确认申请': true, '暂不申请': false} });
}
function doface(v, h, f) {
  if (v == true){
        $.ajax({
            url: "/common/face",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
                if(d){
          if(d.status==1) $.jBox.tip(d.message, 'success');
          else $.jBox.tip(d.message, 'fail');
        }
            }
        });
  }
  return true;
};
  $(function  () {
     var xiaowei_p= $("#xiaowei li");
     if(true)
     {
       xiaowei_p.parent().parent().css('background','url(/Style/H/images/hover_bg.gif) no-repeat center right');


     }
   })

  
</script>
<script type="text/javascript"><!--//--><![CDATA[//><!--
function menuFix() {
var ele_ = document.getElementById("nav");
  if(!ele_) return;
var sfEls = ele_.getElementsByTagName("li");
for (var i=0; i<sfEls.length; i++) {
sfEls[i].onmouseover=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onMouseDown=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onMouseUp=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onmouseout=function() {
this.className=this.className.replace(new RegExp("( ?|^)sfhover\b"),
"");
}
}
}
window.onload=menuFix;
//--><!]]></script>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/home.css">





<style>
 .Nav_nav .navigation-list .navigation-item { margin-left: 50px;} 
</style><script type="text/javascript">
  function  erji(a, b, c, d) {
        $(a).children(b).each(function() {
            var a1 = $(this).children(c),
             b2 = $(this).children(d),
             index=$(this).index();
            if (a1.html()) $(this).hover(function() {
                a1.show();
                
            index==0 && $(this).css({'background-position':'0px -62px'});
            index==1 && $(this).css({'background-position':'0px -124px'});
                b2.css({

                    'color':'#cfcfcf'
                });
            }, function() {
                a1.hide();
                 index==0 && $(this).css({'background-position':'0px -31px'});
            index==1 && $(this).css({'background-position':'0px -93px'});
                b2.css({

                    'color':'#b1b1b1'
                });
            });
        });
    }



erji('#erji','li','div','h1');
</script>

  <!--快捷通道-->
   <!-- -->
  <!--快捷通道end-->
    <script language="javascript">
                   $(document).ready(function(){
      
            
          $("#ui-nav-item-link").mouseover(function(){
            $("#ui-nav-dropdown").show()
            }).mouseout(function(){
              $("#ui-nav-dropdown").hide()
              });
            $(".ui-nav-dropdown-item").mouseover(function(){
              $(this).css({"background":"#027BC0"}).mouseout(function(){
                $(this).css({"background":"#fff"})
                              });

              })
            
            })
//      var str=$("#jieduan").html();
//                  if(len(str)>6){
//                    str=
//                    }
                     </script>
  </div>
</div>

<!--<div class="wrap">
	<div id="all-sort">
		<a href="javascript:void(0)">全部分类</a> <i></i>
		<div style="display: none;" id="wrap1">
			<ul id="dir">
				<div class="fengge"></div>
				<li class="item">
					<a href="http://www.zecaifu.com/crowdfunding?sort=400">易车惠</a>
					<span style="background: transparent url(&quot;/Style/H/pic/sj.png&quot;) repeat scroll 0% 0%;"></span>
					<ul class="sub_dir" style="display: none;">
						<li style="border-left: medium none white;">
							<a href="http://www.zecaifu.com/crowdfunding?sort=10">捷和-二手车</a>
						</li>
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=11">捷豪-二手车</a>
						</li>
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=12">捷捷-租车惠</a>
						</li>
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=13">一手车</a>
						</li>
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=15">天津宇轩-进口车</a>
						</li>
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=16">万国-二手车</a>
						</li>
					</ul>
				</li>
				<div class="fengge"></div>
				<li class="item">
					<a href="http://www.zecaifu.com/crowdfunding?sort=100">抢赚惠</a>
					<span style="background: transparent url(&quot;/Style/H/pic/sj.png&quot;) repeat scroll 0% 0%;"></span>
					<ul style="display: none;" class="sub_dir">
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=7">紫正园-停车位</a>
						</li>
						<li style="border-left: medium none white;">
							<a href="http://www.zecaifu.com/crowdfunding?sort=1&amp;time=22">百桐园二期-停车位</a>
						</li>
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=1&amp;time=11">百桐园一期-停车位</a>
						</li>
					</ul>
				</li>
				<div class="fengge"></div>
				<li class="item">
					<a href="http://www.zecaifu.com/crowdfunding?sort=300">升值惠</a>
					<span></span>
					<ul class="sub_dir" style="display:none;">
						<li>
							<a href="http://www.zecaifu.com/crowdfunding?sort=6">中e宝-房产</a>
						</li>
					</ul>
				</li>
				<div class="fengge"></div>
				<li>
					<a href="http://www.zecaifu.com/crowdfunding?status=1">众筹中</a>
					<span></span>
				</li>
				<div class="fengge"></div>
				<li>
					<a href="http://www.zecaifu.com/crowdfunding?status=3">出售中</a>
					<span></span>
				</li>
				<div class="fengge"></div>
				<li>
					<a href="http://www.zecaifu.com/crowdfunding?status=2">投票中</a>
					<span></span>
				</li>
				
				<div class="fengge"></div>
				<li id="ywc">
					<a href="http://www.zecaifu.com/crowdfunding?status=5">已完成</a>
					<span></span>
				</li>
				<div class="fengge"></div>
				<li>
				
				</li>
			</ul>
		</div>
	</div>
	<div id="vote">
		<span>今日投票</span>
		<label>标号：</label>
		<a href="http://www.zecaifu.com/crowdfunding/tdetail/id/2519">2519</a><a href="http://www.zecaifu.com/crowdfunding/tdetail/id/2553">2553</a><a href="http://www.zecaifu.com/crowdfunding/tdetail/id/2574">2574</a><a href="http://www.zecaifu.com/crowdfunding/tdetail/id/2610">2610</a><a href="http://www.zecaifu.com/crowdfunding/tdetail/id/2637">2637</a><a href="http://www.zecaifu.com/crowdfunding/tdetail/id/2653">2653</a><a href="http://www.zecaifu.com/crowdfunding/tdetail/id/2692">2692</a><a href="http://www.zecaifu.com/crowdfunding/tdetail/id/1965">1965</a>				</div>
</div>-->
<!-- 投票结束 -->
<div class="clear"></div>
<!-- 分割线 -->
<div id="line"></div>
<!-- 顶部 -->
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/jquery.css" media="screen">
<link type="text/css" rel="stylesheet" href="__ROOT__/Style/H/che/css/jbox.css">
 <link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/che/css/detail.css">
<!-- <link rel="stylesheet" type="text/css" href="/Style/H/css/common2.css" /> -->
<script type="text/javascript" src="__ROOT__/Style/H/che/js/js/jquery_005.js"></script>
<script type="text/javascript" src="__ROOT__/Style/H/che/js/js/common.js" language="javascript"></script>
<style type="text/css">
	body{background:#fff;color:#021524;}
	.wrap{width:1210px;}
	.tnum{border:none;padding:0;}
	a:hover{color:black;}
	.zc_com a:hover{color: black;}
	.zc_ztl:hover{background: #7c7475;}
	.xq_jj a:hover{color:#0099ff;text-decoration: underline;}
	.prevnext:hover{color:black;}
	.middle .zcht_tpl {padding-top: 0}
	/*.xq_qiehuan p{padding:0 10px;}*/
	.xq_qiehuan>*>img{width:793px;padding-top: 20px;}
	.xq_qiehuan>*>*>img{width:793px;padding-top: 20px;}
	.xq_qiehuan>*>*>*>img{width:793px;padding-top: 20px;}
	#zc-tetail-con{background:white;width: 100%;}
	.bid{width:793px;}
	.bid tr{width: 793px;}
	.pr30{padding:0 0px;}
	#bot16{margin-top: 27px;}
	.xq_qiehuan{overflow: auto;margin-bottom:20px;}
</style>
<script type="text/javascript">
   
</script>
<script type="text/javascript">
	$(function(){
		$('.minus').mousedown(function(event) {
			$(this).css('background',"url('images/minus1.png')");
		}	
		);
		$('.minus').mouseup(function(event) {
			$(this).css('background',"url('images/minus.png')");
		}	
		);
		$('.plus').mousedown(function(event) {
			$(this).css('background',"url('images/plus1.png')");
		}
		);
		$('.plus').mouseup(function(event) {
			$(this).css('background',"url('images/plus.png')");
		}
		);
	})
</script>
<script type="text/javascript">var Transfer_invest_url = "/crowdfunding";</script>
<script>
<!--
/*第一种形式 第二种形式 更换显示样式*/
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"hover":"";
con.style.display=i==cursel?"block":"none";
}
}

//function invest(id){
//	$.jBox("get:/crowdfunding/ajax_invest?id="+id, {title: "立即投标--{$glo.web_name}"});
//}

function vouch(id){
	$.jBox("get:/crowdfunding/ajax_vouch?id="+id, {
		title: "立即担保--中e财富"
	});
}
function addFriend(type){
	var uid = 2999;
	$.ajax({
		url: "/crowdfunding/addfriend",
		data: {"fuid":uid,"type":type},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1)	 $.jBox.tip(d.message,'success');
				else $.jBox.tip(d.message,'error');
			}
		}
	});
}
function InnerMsg(){
	var uid = 2999;
	$.jBox("get:/crowdfunding/innermsg?uid="+uid, {
		title: "发送站内信"
	});
}

function changeDIV(num){
	for(var id = 1;id<=8;id++)
		{
			if(id==num)
			{
				$("#detail_menu_"+id).attr('style','display: block');
				$("#li_menu_"+id).addClass('now');
			}
			else
			{
				$("#detail_menu_"+id).attr('style','display: none');
				$("#li_menu_"+id).removeClass();
			}
		}
}
//--></script>
<script type="text/javascript">
	function showht(){
		var status = 'login';
		if(status=="no"){
			jBox.tip("您未投此标");
		}else if(status=="login"){
			jBox.tip("请先登陆");
		}else{
			window.location.href="/member/agreement/downfile?id="+status;
		}
	}
</script>

<script>
	$(function(){
		window.onload = (function(){	
			// alert(2832);
			
			 $.get("/crowdfunding/Huikuanjihua?id=2832", function(data){ //
			 
			 if(data == ''){
			
				$("#huikuan").html('您未投过此标！');
			 }else{
	
				$("#huikuan").html(data);
			 }
		  
	   });
		});
	
	});
</script>

<script type="text/javascript">
//智能浮动层函数
$.fn.smartFloat = function() {
	var position = function(element) {
		var top = element.position().top, pos = element.css("position");
		var w = element.innerWidth();
		$(window).scroll(function() {
			var scrolls = $(this).scrollTop();
			if (scrolls > top) {
				if (window.XMLHttpRequest) {
					element.css({
						width: w,
						position: "fixed",
						top: 0
					});	
				} else {
					element.css({
						top: scrolls
					});	
				}
			}else {
				element.css({
					position: pos,
					top: top
				});	
			}
		});
	};
	return $(this).each(function() {
		position($(this));						 
	}); 
};

//Tab控制选项卡
function tabs(tabId, event) {
    //绑定事件
	var tabItem = $("#zhongc_tabList ul li");
	tabItem.bind(event,function(){
		//设置点击后的切换样式
		tabItem.removeClass("cur");
		$(this).addClass("cur");
		//设置点击后的切换内容
		var tabNum = tabItem.index($(this));
		$(tabId + " .tab_inner").hide();
        $(tabId + " .tab_inner").eq(tabNum).show();
	});
}


//Tab代码
$(function(){
	//智能浮动层
	$("#tabHead").smartFloat();
	tabs('#zhongc_tabCon','mousedown');
});
</script>

<script type="text/javascript">
$(function(){
updateEndTime();
});
//倒计时函数
function updateEndTime()
{
 var date = new Date();
 var time = date.getTime();  //当前时间距1970年1月1日之间的毫秒数
 
 $(".settime").each(function(i){
 
 var endDate =this.getAttribute("endTime"); //结束时间字符串
 //转换为时间日期类型
 var endDate1 = eval('new Date(' + endDate.replace(/d+(?=-[^-]+$)/, function (a) { return parseInt(a, 10) - 1; }).match(/d+/g) + ')');

 var endTime = endDate1.getTime(); //结束时间毫秒数
 
 var lag = (endTime - time) / 1000; //当前时间和结束时间之间的秒数
  if(lag > 0)
  {
   var second = Math.floor(lag % 60);     
   var minite = Math.floor((lag / 60) % 60);
   var hour = Math.floor((lag / 3600) % 24);
   var day = Math.floor((lag / 3600) / 24);
   $(this).html(day+"天"+hour+"小时"+minite+"分"+second+"秒");
  }
  else
   $(this).html("认购结束啦！");
 });
 setTimeout("updateEndTime()",1000);
}
</script>
<script type="text/javascript">
$(document).ready(function() {
		$("a[rel=img_group]").fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
			}
		});
		ajax_show(1);

	});
function ajax_show(p)
	{
	   $.get("/crowdfunding/investRecord?borrow_id=2832&p="+p, function(data){
		  $("#investrecord").html(data);
	   });

	   $(".pages a").removeClass('current');
	   $(".pages a").eq(p).addClass("current");
	}
</script>
<div id="sort-dh">
	&gt;项目详情
	<div id="djs" style="display: none;">

		<p> <em>倒计时：</em>
			<span class="mini" id="mins">00</span>
			<span class="sec" id="secs">00</span>
			<span class="hm" id="micros">00</span>
		</p>

	</div>
</div>
<!-- 中间部分 -->
<div class="middle" >
	<!--<div class="xq_img">
			
			<?php if(is_array($crowd_info["0"]["img"])): $i = 0; $__LIST__ = $crowd_info["0"]["img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$im): $mod = ($i % 2 );++$i;?><img src="<?php echo ($im["img"]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>		
    </div>-->


    <div class="float_left marright_20 box-shadow-2" style="width: 620px;height: 510px">
        <!--图片轮播-->
        <div id="slider1_container" style="position: relative; margin:0 auto; width: 620px;
		        height: 510px; background: #191919; overflow: hidden;">
            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
		                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
		                top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
            </div>
            <div u="slides" style="cursor: move; position: absolute; left:0px; top: 0px; width: 620px; height: 410px; overflow: hidden;">
                <?php if(is_array($crowd_info["0"]["img"])): $i = 0; $__LIST__ = $crowd_info["0"]["img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$im): $mod = ($i % 2 );++$i;?><div>
                        <a href="<?php echo ($im["img"]); ?>" rel="img_group"><img u="image" src="<?php echo ($im["img"]); ?>" /></a>
                        <img u="thumb" src="<?php echo ($im["img"]); ?>" />
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <style>
                .jssora05l, .jssora05r {
                    display: block;
                    position: absolute;
                    /* size of arrow element */
                    width: 40px;
                    height: 40px;
                    cursor: pointer;
                    background: url(__ROOT__/Style/CrowdSlide/img/a17.png) no-repeat;
                    overflow: hidden;
                }
                .jssora05l { background-position: -10px -40px; }
                .jssora05r { background-position: -70px -40px; }
                .jssora05l:hover { background-position: -130px -40px; }
                .jssora05r:hover { background-position: -190px -40px; }
                .jssora05l.jssora05ldn { background-position: -250px -40px; }
                .jssora05r.jssora05rdn { background-position: -310px -40px; }
            </style>
            <!-- Arrow Left -->
		        <span u="arrowleft" class="jssora05l" style="top: 158px; left: 8px;">
		        </span>
            <!-- Arrow Right -->
		        <span u="arrowright" class="jssora05r" style="top: 158px; right: 8px">
		        </span>
            <style>
                .jssort01 {
                    position: absolute;
                    /* size of thumbnail navigator container */
                    width: 800px;
                    height: 100px;
                    background: #fff;
                }
                .jssort01 .p {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 110px;
                    height: 74px;
                }

                .jssort01 .t {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border: none;
                }

                .jssort01 .w {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                    cursor: pointer;
                }
                .jssort01 .c {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 110px;
                    height: 74px;
                    border: #000 2px solid;
                    box-sizing: content-box;
                    background: url(__ROOT__/Style/CrowdSlide/img/t01.png) -800px -800px no-repeat;
                    _background: none;
                }

                .jssort01 .pav .c {
                    top: 2px;
                    _top: 0px;
                    left: 2px;
                    _left: 0px;
                    width: 110px;
                    height: 74px;
                    border: #000 0px solid;
                    _border: #fff 2px solid;
                    background-position: 50% 50%;
                }

                .jssort01 .p:hover .c {
                    top: 0px;
                    left: 0px;
                    width: 110px;
                    height: 74px;
                    border: #fff 1px solid;
                    background-position: 50% 50%;
                }

                .jssort01 .p.pdn .c {
                    background-position: 50% 50%;
                    width: 110px;
                    height: 74px;
                    border: #000 2px solid;
                }

                * html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {
                    /* ie quirks mode adjust */
                    width /**/: 110px;
                    height /**/: 74px;
                }
            </style>

            <!-- thumbnail navigator container -->
            <div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">
                <!-- Thumbnail Item Skin Begin -->
                <div u="slides" id="thumbslide" style="cursor: default;left:0px !important;">
                    <div u="prototype" class="p">
                        <div class=w><div u="thumbnailtemplate" class="t"></div></div>
                    </div>
                </div>
                <!-- Thumbnail Item Skin End -->
            </div>
        </div>
        <!-- Jssor Slider End -->
        <script type="text/javascript" src="__ROOT__/Style/CrowdSlide/js/jssor.slider.mini.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("a[rel=img_group]").fancybox({
                    'transitionIn'		: 'none',
                    'margin' : '150',
                    'transitionOut'		: 'none',
                    'titlePosition' 	: 'over',
                    'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                        return '<span id="fancybox-title-over" style="display: none;">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                    }
                });
            });
            jQuery(document).ready(function ($) {
                var _SlideshowTransitions = [
                    //Fade in L
                    { $Duration : 1200, x : 0.3, $During : { $Left: [0.3, 0.7] }, $Easing : { $Left: $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade out R
                    , { $Duration : 1200, x : -0.3, $SlideOut : true, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade in R
                    , { $Duration : 1200, x : -0.3, $During : { $Left : [0.3, 0.7] }, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade out L
                    , { $Duration : 1200, x : 0.3, $SlideOut : true, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }

                    //Fade in T
                    , { $Duration : 1200, y : 0.3, $During : { $Top : [0.3, 0.7] }, $Easing : { $Top: $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }
                    //Fade out B
                    , { $Duration : 1200, y : -0.3, $SlideOut : true, $Easing : { $Top: $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }
                    //Fade in B
                    , { $Duration : 1200, y : -0.3, $During : { $Top : [0.3, 0.7] }, $Easing : { $Top: $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade out T
                    , { $Duration : 1200, y : 0.3, $SlideOut : true, $Easing : { $Top : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }

                    //Fade in LR
                    , { $Duration : 1200, x : 0.3, $Cols : 2, $During : { $Left : [0.3, 0.7] }, $ChessMode : { $Column : 3 }, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }
                    //Fade out LR
                    , { $Duration : 1200, x : 0.3, $Cols : 2, $SlideOut : true, $ChessMode : { $Column : 3 }, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }
                    //Fade in TB
                    , { $Duration : 1200, y : 0.3, $Rows : 2, $During : { $Top : [0.3, 0.7] }, $ChessMode : { $Row : 12 }, $Easing : { $Top : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade out TB
                    , { $Duration : 1200, y : 0.3, $Rows : 2, $SlideOut : true, $ChessMode : { $Row : 12 }, $Easing : { $Top : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }

                    //Fade in LR Chess
                    , { $Duration : 1200, y : 0.3, $Cols : 2, $During : { $Top : [0.3, 0.7] }, $ChessMode : { $Column : 12 }, $Easing : { $Top : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }
                    //Fade out LR Chess
                    , { $Duration : 1200, y : -0.3, $Cols : 2, $SlideOut : true, $ChessMode : { $Column : 12 }, $Easing : { $Top : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade in TB Chess
                    , { $Duration : 1200, x : 0.3, $Rows : 2, $During : { $Left : [0.3, 0.7] }, $ChessMode : { $Row : 3 }, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }
                    //Fade out TB Chess
                    , { $Duration : 1200, x : -0.3, $Rows : 2, $SlideOut : true, $ChessMode : { $Row : 3 }, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }

                    //Fade in Corners
                    , { $Duration : 1200, x : 0.3, y : 0.3, $Cols : 2, $Rows : 2, $During : { $Left : [0.3, 0.7], $Top : [0.3, 0.7] }, $ChessMode : { $Column : 3, $Row : 12 }, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Top : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }
                    //Fade out Corners
                    , { $Duration : 1200, x : 0.3, y : 0.3, $Cols : 2, $Rows : 2, $During : { $Left : [0.3, 0.7], $Top : [0.3, 0.7] }, $SlideOut : true, $ChessMode : { $Column : 3, $Row : 12 }, $Easing : { $Left : $JssorEasing$.$EaseInCubic, $Top : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2, $Outside : true }

                    //Fade Clip in H
                    , { $Duration : 1200, $Delay : 20, $Clip : 3, $Assembly : 260, $Easing : { $Clip : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade Clip out H
                    , { $Duration : 1200, $Delay : 20, $Clip : 3, $SlideOut : true, $Assembly : 260, $Easing : { $Clip : $JssorEasing$.$EaseOutCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade Clip in V
                    , { $Duration : 1200, $Delay : 20, $Clip : 12, $Assembly : 260, $Easing : { $Clip : $JssorEasing$.$EaseInCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                    //Fade Clip out V
                    , { $Duration : 1200, $Delay : 20, $Clip : 12, $SlideOut : true, $Assembly : 260, $Easing : { $Clip : $JssorEasing$.$EaseOutCubic, $Opacity : $JssorEasing$.$EaseLinear }, $Opacity : 2 }
                ];

                var options = {
                    $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                    $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                    $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                    $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                    $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                    $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds
                    $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                        $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                        $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                        $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                        $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                    },

                    $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                        $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    },

                    $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                        $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                        $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                        $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                        $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                        $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
                    }
                };
                var jssor_slider1 = new $JssorSlider$("slider1_container", options);
                function ScaleSlider() {
                    var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                    if (parentWidth)
                        jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 620), 500));
                    else
                        window.setTimeout(ScaleSlider, 30);
                }
                ScaleSlider();

                $(window).bind("load", ScaleSlider);
                $(window).bind("resize", ScaleSlider);
                $(window).bind("orientationchange", ScaleSlider);
                //responsive code end
//                var img_count = "<?php echo ($crowd_info[0]['count_img']); ?>";
//                if(img_count <= 5){
                    $('#thumbslide').css('left',5);
//                }
            });

        </script>
        <!--图片轮播end-->
    </div>
	
	
	
	
	<div class="xq_jianjie">
		<img src="__ROOT__/Style/H/che/images/heng.png" id="heng">
		<img src="__ROOT__/Style/H/che/images/shu.png" id="shu">
		<ul>
			<li class="li1">
				<div id="detail-tu">
			<!--<img src="__ROOT__/Style/H/che/images/csz.png">	-->		
			</div>
				<p class="xq_p1"><?php echo ($crowd_info[0][crowd_name]); ?></p>
				<p class="xq_p2"> 发布日期：<?php echo date('Y-m-d H:i',$crowd_info[0]['add_time']); ?></p>
			</li>
			<li class="li2">
				<p class="xq_p3">
					众筹目标：
					<span class="span"><?php echo ($crowd_info[0]['crowd_money']); ?> 元</span>
				</p>
				<p class="xq_p3 xq_p4">
					已筹金额：
					<span class="span"><?php if($is_start == 0): ?>0
                            <?php else: ?>
                            <?php echo (($crowd_info[0]['has_crowd_money'])?($crowd_info[0]['has_crowd_money']):0); endif; ?> 元</span> <em>众筹次数：
						<span class="span"><?php if($is_start == 0): ?>0
                                <?php else: ?>
                                <?php echo (($record_count)?($record_count):0); endif; ?>笔</span></em> 
				</p>
			</li>
			<li class="xq_p5">
				<span class="span1">预计期限：<?php echo ($crowd_info[0]['max_duration']); ?> 月</span>
				<span class="span2">起投金额：<?php echo ($crowd_info[0]['min_money']); ?> 元</span>
				<!--<span class="span3">可投金额：<?php echo $crowd_info[0]['crowd_money']/$crowd_info[0]['min_money']; ?> 份</span>-->
				<span class="span3">可投金额：<?php echo $crowd_info[0]['crowd_money'] - $crowd_info[0]['has_crowd_money']; ?> 元</span>
				<span id="daojishi" style="display:none;"><?php echo ($crowd_info[0]['start_time']); ?></span>
				
				<span class="span4">项目正式发布倒计时:	
	                <span id="day_show">0天</span>
					<strong id="hour_show">0时</strong>
					<strong id="minute_show">0分</strong>
					<strong id="second_show">0秒</strong></span>
					<strong id="sj" style="display:none"><?php echo time()?></strong>
			</li>
						<li class="li1 li3">
				<p>
					剩余时间：
								<span><?php if($remain_time['day'] != '0'): echo ($remain_time['day']); ?>天
                                <?php elseif($remain_time['day']==0 && $remain_time['hour']!=0 ): ?>
                                <?php echo ($remain_time['hour']); ?>小时
                                <?php else: ?>
                                <?php echo ($remain_time['min']); ?>分钟<?php endif; ?></span>
										</p>
				<div class="zc_jdt">
					<span class="zc_precent" style="width:<?php if($is_start == 0): ?>0<?php else: ?>
                <?php echo ($crowd_info[0]['rate']); endif; ?>%;"></span>
				</div>
				<span><?php if($is_start == 0): ?>0<?php else: ?>
                <?php echo ($crowd_info[0]['rate']); endif; ?>%</span>
			</li>
			<li id="xq_shuru">
				<!--<input class="plus xq_num" onmousedown="minus(2832)" value="" type="button">
				<input class="tnum xq_fen" id="tnum_2832" value="1份" type="text">
				<input class="minus xq_num" onmousedown="plus(2832)" value="" type="button">
				<input id="token" value="" type="hidden">-->
				<input type="text" id="enter_value" <?php if($is_start == 0 || $crowd_info[0]['status'] != 1): ?>disabled<?php endif; ?> name="money" placeholder="请输入最小金额的的整数倍" style="width: 204px !important;text-align: left;height: 40px;border-radius: 4px;box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;color: #555;vertical-align: middle;background-color: #FFF;border: 1px solid #06a9e7;padding-left: 6px;"/>
				
				
           
                <?php if($bid != null): ?><select id="bid" name="bid" style="width:212px; height:40px; margin-top: 10px;margin-left: 48px;line-height:40px;border-radius: 4px; border: 1px solid rgb(6, 169, 231); padding:0 3px;text-align: left;">
                        <option value="0" selected="selected">众筹红包</option>
                        <?php if(is_array($bid)): $i = 0; $__LIST__ = $bid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><option id="<?php echo ($vb["id"]); ?>" value="<?php echo ($vb["bid_money"]); ?>" t_money="<?php echo ($vb["pay_money"]); ?>" title="投资金额大于等于<?php echo ($vb["pay_money"]); ?>元时可用"><?php echo ($vb["bid_money"]); ?>(投资<?php echo ($vb["pay_money"]); ?>元可用)</option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select><?php endif; ?>
        
				
				<p>
				<?php if($UID == ''): ?>可用余额：
						<span class="span">
							0.00 <i style="color:#021524">&nbsp;元</i>
						</span>
											[
					<a href="/member/common/login/" target="_blank">登录</a>
					]
                <?php else: ?>
				可用余额：
						<span class="span">
							<?php echo ($investInfo['account_money']+$investInfo['back_money']); ?> <i style="color:#021524">&nbsp;元</i>
						</span>
											[
					<a href="__APP__/member/charge#fragment-1" target="_blank">我要充值</a>
					]<?php endif; ?>
					
				</p>
			</li>
			<li id="xq_lj">
									<div style="background:#b9d11b;border-radius: 5px;">
									<?php if($is_start == 0): ?><span onclick="crowdauto()" class=" a-small-button invest_orange color-white text-center font16 invest-a   font18" style="line-height: 35px;border-radius:3px;cursor: pointer height:35px;">我要预约</span>
                    <?php elseif($crowd_info[0]['status'] == 1): ?>
                    <span  id="jx_payment" onclick="invest(<?php echo ($crowd_info[0]['id']); ?>)" class=" a-small-button main-bg-color color-white text-center font16 invest-a   font18" style="line-height: 35px;border-radius:3px;cursor: pointer;height:35px;">立即认筹</span>
                    <?php elseif($crowd_info[0]['status'] == 2): ?>
                    <span class=" a-small-button invest_grey_bg color-white text-center font16 invest-a   font18" style="line-height: 35px;border-radius:3px;cursor: pointer;height:35px;">出售中</span>
                    <?php elseif($crowd_info[0]['status'] == 3): ?>
                    <span class=" a-small-button invest_grey_bg color-white text-center font16 invest-a   font18" style="line-height: 35px;border-radius:3px;cursor: pointer;height:35px;">投票中</span>
                    <?php elseif($crowd_info[0]['status'] == 4): ?>
                    <span class=" a-small-button invest_grey_bg color-white text-center font16 invest-a  font18" style="line-height: 35px;border-radius:3px;cursor: pointer;height:35px;">待回款</span>
                    <?php elseif($crowd_info[0]['status'] == 5 ): ?>
                    <span class=" a-small-button invest_grey_bg color-white text-center font16 invest-a   font18" style="line-height: 35px;border-radius:3px;cursor: pointer;height:35px;">已售出</span>
                    <?php elseif($crowd_info[0]['status'] == 8 || $crowd_info[0]['status'] == 9): ?>
                    <span class=" a-small-button invest_grey_bg color-white text-center font16 invest-a   font18" style="line-height: 35px;border-radius:3px;cursor: pointer;height:35px;">溢价回购</span><?php endif; ?>
									</div>
							</li>
							<li id="xq_yy"><div style="background:#e50312;border-radius: 5px;"><a onclick="crowdauto()">我要预约<a></div></li>
	</ul>
</div>
</div>
<!-- 中间部分结束 -->
<div class="clear"></div>
<div class="middle" style="height: 100%; overflow: hidden;">
<div id="xq_nav">
<ul>
	<li class="xq_nav">项目参数</li>
	<li >众筹介绍</li>
	
	<li>合同服务</li>
	<li>众筹记录</li>
	<li>众筹投票</li>
	<!--<li>我有话说</li>-->
</ul>
</div>

<div style="height: 990px;" id="zc-tetail-con">
	<!-- 切换内容 -->
	<div>
		<div style="display: none;" class="xq_qiehuan">
			<div class="width-90 crowd_detail" style="line-height: 30px;">
                <?php if($user_id == null): ?><span class="font16">项目参数<a href="/Member/Common/login" style="color: #06a9e7;">登录</a>后方可查看</span>
                    <?php else: ?>
                    <?php echo ($crowd_info[0]['car_parameter']); endif; ?>
            </div>	
						<div class="clear"></div>
		</div>
		<div class="xq_qiehuan">
			<div class="width-90 crowd_detail" style="margin: 20px auto;line-height: 30px;">
                <?php if($user_id == null): ?><p style="font-size:18px; text-align:center;line-height:3em;padding:0 20px">
					项目信息
					<a href="/Member/Common/login" style="color:#fc554c">登录</a>
					后才可以查看
				</p>
                    <?php else: ?>
                    <?php echo ($crowd_info[0]['car_info']); endif; ?>
            </div>
										<div class="clear"></div>
		</div>
		
		<div style="display: none;" class="xq_qiehuan">
			<div class="width-90 margin-auto crowd_detail lineheight30"  style="margin: 20px auto;">
                <?php if($user_id == null): ?><p style="font-size:18px; text-align:center;line-height:3em;padding:0 20px">
					合同服务
					<a href="/Member/Common/login" style="color:#fc554c">登录</a>
					后才可以查看
				</p>
                    <?php else: ?>
                    <?php echo ($crowd_info[0]['crowd_agreement']); endif; ?>
            </div>
		  			<div class="clear"></div>
		</div>
		<div style="display: none;" class="xq_qiehuan">
			<?php if($user_id == null): ?><div class="width-90 margin-auto crowd_detail lineheight30"  style="margin: 20px auto;">
                <p style="font-size:18px; text-align:center;line-height:3em;padding:0 20px">
					众筹记录
					<a href="/Member/Common/login" style="color:#fc554c">登录</a>
					后才可以查看
				</p>
				</div>
                <?php else: ?>
            <table class="table invest_detail_color lineheight30 text-center invest_table" width="95%"  cellspacing="1" cellpadding="1" style="margin: 10px auto;background: rgb(224,224,224)">
                <tr class="td1">
                    <td>序号</td>
                    <td>投资人</td>
                    <td>众筹金额</td>
                    <td>众筹时间</td>
                    <td>众筹状态</td>
                    <td>投资类型</td>
                </tr>
                <tbody id="investrecord" class="tender-list">
                </tbody>
                <tr>
                    <td colspan="6">
                        <div class="width-100 text-center invest_page" style="height: 30px !important;">
                            <div style="margin:0 auto">
                                <?php echo ($ajaxpage); ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table><?php endif; ?>
			
			
		</div>
		<!--众筹投票-->
		

		<div style="display: none;" class="xq_qiehuan">
				<input type="hidden" id="vote_remain_time" value="<?php echo ($vote_list[0]['vote_remain_time']); ?>"/>
            <div class="" style="_height:300px;height: auto;margin:20px auto;">
                <div class="width-100" style="height: 40px;">
                    <div class="box-shadow-2" style="float: left;height: 40px;background: #0697da;width: 480px;font-size: 18px;color: #fff;line-height: 39px;padding-left: 20px"> <?php echo ($crowd_info[0]['crowd_name']); ?>(<?php echo ($crowd_info[0]['status_info']); ?>)</div>
                </div>
                <div class="width-100" style="margin: 30px 70px;">
                    <div style="font-size: 16px;color: #535353;">
                        投票金额:&nbsp;&nbsp;&nbsp;<span style="font-size: 26px;color: #ff6600;"><?php if($vote_list[0]['vote_money'] == ''): ?>投票未开始！<?php else: ?>￥<?php echo ($vote_list[0]['vote_money']); endif; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                        投票人数:&nbsp;&nbsp;&nbsp;<span style="font-size: 26px;color: #ff6600;"><?php if($crowd_info[0]['status'] == 2 || $crowd_info[0]['status'] == 3 || $crowd_info[0]['status'] == 4 || $crowd_info[0]['status'] == 5): echo ($need_vote_people); ?>人<?php else: ?>投票未开始！<?php endif; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                        已投人数:&nbsp;&nbsp;&nbsp;<span style="font-size: 26px;color: #ff6600;"><?php if($crowd_info[0]['status'] == 2 || $crowd_info[0]['status'] == 3 || $crowd_info[0]['status'] == 4 || $crowd_info[0]['status'] == 5): echo ($has_vote_people); ?>人<?php else: ?>投票未开始！<?php endif; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                        投票剩余时间:&nbsp;&nbsp;&nbsp;<?php if($crowd_info[0]['status'] == 3): ?><span id="vote_remain" style="color: #ff6600;font-size: 22px;"></span><?php else: ?><span style="color: #ff6600;font-size: 26px;">0秒</span><?php endif; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <script>
                        var seconds;
                        var timer=null;
                        function setLeftTime() {
                            seconds = parseInt($("#vote_remain_time").val(), 10);
                            timer = setInterval(showSeconds,1000);
                        }
                        function showSeconds() {
                            var day1 = Math.floor(seconds / (60 * 60 * 24));
                            var hour = Math.floor((seconds - day1 * 24 * 60 * 60) / 3600);
                            var minute = Math.floor((seconds - day1 * 24 * 60 * 60 - hour * 3600) / 60);
                            var second = Math.floor(seconds - day1 * 24 * 60 * 60 - hour * 3600 - minute * 60);
                            $("#vote_remain").html(day1 + " 天 " + hour + " 小时 " + minute + " 分 " + second + " 秒");
                            if(seconds <= 0){
                                clearInterval(timer);
                                $("#vote_remain").html("投票已结束");
                                var crowd_id = "<?php echo ($crowd_info[0]['id']); ?>";
                                $.ajax({
                                    url: "__URL__/vote_set",
                                    type: "post",
                                    dataType: "json",
                                    data: {"crowd_id":crowd_id},
                                    success: function(d) {
                                        if(d.status == 1){
                                            setTimeout("location.reload()",1000);
                                        }
                                    }
                                });
                            }
                            seconds--;
                        }
                        $(document).ready(function(){
                            setLeftTime();
                        });
                    </script>
                </div>
                <div class="width-80" style="height: 260px;margin: 50px auto 20px;">
                    <div class="width-100" style="height: 130px;">
                        <div class="float_left" style="height: 130px">
                            <img src="__ROOT__/Style/H/images/crowdinvest/vote_succ_car.png" alt=""/>
                        </div>
                        <div class="float_left" style="height: 130px; margin-left: 20px;line-height: 32px;">
                            <div style="color: #ff6600;text-align: center;font-size: 20px;">赞成(<?php echo (($agree_people)?($agree_people):0); ?>票)</div>
                            <div><span class="progress color-bg-grey2" style="width: 460px;height: 12px;float: left">
                    <span class="precent pbprecent" style="width:<?php echo ($agree_vote_rate); ?>%;height: 12px;background: #ff6600">
                    </span>
                </span><span style="float: right;display: block;height: 30px;line-height: 10px;width: 40px;
"><?php if($agree_vote_rate > 100): ?>100<?php else: echo ($agree_vote_rate); endif; ?>%</span></div>
                        </div>
                        <div class="float_left" style="height: 130px;margin-left: 30px;">
                            <div style="width: 64px;height: 67px;background: url('/Style/H/images/crowdinvest/vote_succ.png') no-repeat scroll center center;cursor: pointer" onclick="vote(1)"></div>
                        </div>
                    </div>
                    <div class="width-100" style="height: 130px;">
                        <div class="float_left" style="height: 130px">
                            <img src="__ROOT__/Style/H/images/crowdinvest/vote_fail_car.png" alt=""/>
                        </div>
                        <div class="float_left" style="height: 130px; margin-left: 20px;line-height: 32px;">
                            <div style="color: #0697da;text-align: center;font-size: 20px;">反对(<?php echo (($not_agree_people)?($not_agree_people):0); ?>票)</div>
                            <div><span class="progress color-bg-grey2" style="width: 460px;height: 12px;float: left">
                    <span class="precent pbprecent" style="width:<?php echo ($not_agree_vote_rate); ?>%;height: 12px;background: #0697da">
                    </span>
                </span><span style="float: right;display: block;height: 30px;line-height: 10px;width: 40px;
"><?php echo ($not_agree_vote_rate); ?>%</span></div>
                        </div>
                        <div class="float_left" style="height: 130px;margin-left: 30px;">
                            <div style="width: 64px;height: 67px;background: url('/Style/H/images/crowdinvest/vote_fail.png') no-repeat scroll center center;cursor: pointer" onclick="vote(0)"></div>
                        </div>
                    </div>
                </div>
            </div>
						<div class="clear"></div>
		</div>
		<!--众筹投票结束-->
		<!--<div class="xq_qiehuan" style="border: medium none; display: none;">
			<table style="width:793px;">
				<tbody><tr>
					<td style="background:white;border: 1px solid #D1D1D1;" height="60">
						<p class="table_title">&nbsp;&nbsp;&nbsp;&nbsp;本项目用户讨论</p>
					</td>
				</tr>
				<tr>
					<td style="border:1px solid #CCC; border-top:0;background:white">
						<table border="0" cellpadding="0" cellspacing="0" width="">
							<tbody><tr>
								<td style=" padding-bottom:5px;" id="scomment" align="center" valign="top">
																		<div class="page ajaxpagebar" data="scomment" style="margin-left:10px;margin-top:10px;"></div>
								</td>
							</tr>
						</tbody></table>
						<div style="padding:10px">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody><tr>
									<td colspan="2" align="left" height="40" valign="middle"> <strong>发表评论</strong>
									</td>
								</tr>
								<tr>
									<td>
										<textarea name="comments" id="comments" cols="30" rows="4" style="width:580px; height:110px;background:#ccc;text-indent:20px;padding-top:20px;line-height:150%;"></textarea>
									</td>
									<td>
										<a href="javascript:;" onmousedown="addComment();">
											<img src="__ROOT__/Style/H/che/images/comment.gif">
										</a>
									</td>
								</tr>
							</tbody></table>
						</div>

					</td>
				</tr>
			</tbody></table>
			<div class="clear"></div>
		</div>-->
	</div>
	<!-- 切换内容结束 -->
	
</div>
</div>
<script type="text/javascript">
        function crowdauto(){
            window.location.href="/member/crowd_auto#fragment-1";
        }
        function vote(id){
            var crowd_id = "<?php echo ($crowd_info[0]['id']); ?>";
            var need_vote_people = "<?php echo ($need_vote_people); ?>";
            $.ajax({
                url: "__URL__/vote",
                type: "post",
                dataType: "json",
                data: {"vote":id,"crowd_id":crowd_id,"need_vote_people":need_vote_people},
                success: function(d) {
                    if(d.status == 3)//
                    {
                        $.jBox.tip(d.message,"success");
                        setTimeout("location.reload()",3000);
                    }
                    else if(d.status == 2){
                        $.jBox.alert(d.message,"提示");
                    }
                }

            });
        }
        $(document).ready(function() {
            ajax_show(1);
        });
        function ajax_show(p)
        {
            $.get("__URL__/investRecord?crowd_id=<?php echo ($crowd_info[0]['id']); ?>&p="+p, function(data){
                $("#investrecord").html(data);
            });
            $(".invest_page a").removeClass('current');
            $(".invest_page a").eq(p).addClass("current");
        }
</script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("a[rel=img_group]").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});
});

bindpage();
function refreshComment(){
	var geturl = "/crowdfunding/tdetail/id/2832?type=commentlist&id=2832&p=1";
	
	var id = "scomment";
	var x={};
	
	$.ajax({
		url: geturl,
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d){ 
				$("#"+id).html(d.html);
			}
		}
	});
}
function bindpage(){
	$('.ajaxpagebar a').mousedown(function(){
		try{	
			var geturl = $(this).attr('href');
			var id = $(this).parent().attr('data');
			var x={};
			$.ajax({
				url: geturl,
				data: x,
				timeout: 5000,
				cache: false,
				type: "get",
				dataType: "json",
				success: function (d, s, r) {
					if(d) $("#"+id).html(d.html);//更新客户端竞拍信息 作个判断，避免报错
				}
			});
		}catch(e){};
		return false;
	})
}
function addComment(){
	var tid = 2832;
	var cm = $("#comments").val();
	if(cm=="") {
		$.jBox.tip("留言内容不能为空",'tip');
		return;
	}
	$.jBox.tip("提交中......","loading");
	$.ajax({
		url: "/crowdfunding/addcomment",
		data: {"comment":cm,"tid":tid},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					refreshComment();
					$.jBox.tip('留言成功');
					$("#comments").val('');
				}else{
					$.jBox.tip(d.message,'fail');
				}
			}
		}
	});
}
//ajax投票
function ajax_vote(vid,act){
	var bid = 2832;
	$.ajax({
		url: "/crowdfunding/ajaxVote",
		data: {"vid":vid,"act":act},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					//刷新页面
					$("#agreeprogress").css("width",d.agreeprogress+"%");
					$("#agreenum").html(d.agreenum+"票");
					$("#disagreeprogress").css("width",d.disagreeprogress+"%");
					$("#disagreenum").html(d.disagreenum+"票");
					$.jBox.tip('投票成功');
					
				}else{
					$.jBox.tip(d.message,'fail');
				}
			}
		}
	});
}

</script>
<script type="text/javascript">
function jubao(id){
	var uxid = ""||0;
	if(!(parseInt(uxid)>0)){
		$.jBox.tip("请先登陆");
		return;
	}
	$.jBox("get:/crowdfunding/jubao/?id="+id, {title: "举报会员"});
}
</script>

<script>
   var aq=document.getElementById('aq');
   var host=window.location.host;
   aq.href="http://www.anquan.org/authenticate/cert/?site="+host+"&at=business";
</script>
<script type="text/javascript">
  if(200!=0){
	var time;
	var t, m, s, ss, fre;
	var fen, miao, hao;
	$(function(){
		var start = new Date().getTime();
		var end = (1471509020 + 120) * 1000;
		time = end - start;
		/*alert(start + ' ' + end);*/
		if(time > 0) {
			fen = document.getElementById('mins');
			miao = document.getElementById('secs');
			hao = document.getElementById('micros');
			fre = window.setInterval('countdown()', 10);
		} else $('#djs').hide();
	});
	function countdown() {
			time -= 10;
			/*console.log(time);*/
			if(time < 10) {
				window.clearInterval(fre);
				$('#djs').slideUp('slow');
			}
			t = time;
			m = Math.floor(t / 60000);
			t -= m * 60000;
			s = Math.floor(t / 1000);
			t -= s * 1000;
			ss = t / 10;
			if(m < 10) m = '0' + m;
			if(s < 10) s = '0' + s;
			if(ss < 10) ss = '0' + ss;
			fen.firstChild.data = m;
			miao.firstChild.data = s;
			hao.firstChild.data = ss;
		}
	}else {
		$('#djs').hide();
	}
</script>
<div id="fancybox-tmp"></div><div id="fancybox-loading"><div></div></div><div id="fancybox-overlay"></div><div id="fancybox-wrap"><div id="fancybox-outer"><div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div><div id="fancybox-content"></div><a id="fancybox-close"></a><div id="fancybox-title"></div><a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a><a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a></div></div>
<script type="text/javascript">
        $(function(){
            $('#crowd_parameter').click(function(){
                $('#pro_info').removeClass('king_title2');
                $('#crowd_info').removeClass('king_title2');
                $('#crowd_agreement').removeClass('king_title2');
                $('#crowd_full').removeClass('king_title2');
                $('#crowd_parameter').addClass('king_title2');
                $('#crowd_parameter_detail').css('display','block');
                $('#pro_info_detail').css('display','none');
                $('#crowd_info_detail').css('display','none');
                $('#crowd_agreement_detail').css('display','none');
                $('#crowd_full_detail').css('display','none');
            });
            $('#pro_info').click(function(){
                $('#pro_info').addClass('king_title2');
                $('#crowd_info').removeClass('king_title2');
                $('#crowd_agreement').removeClass('king_title2');
                $('#crowd_full').removeClass('king_title2');
                $('#crowd_parameter').removeClass('king_title2');
                $('#crowd_parameter_detail').css('display','none');
                $('#pro_info_detail').css('display','block');
                $('#crowd_info_detail').css('display','none');
                $('#crowd_agreement_detail').css('display','none');
                $('#crowd_full_detail').css('display','none');
            });
            $('#crowd_info').click(function(){
                $('#pro_info').removeClass('king_title2');
                $('#crowd_info').addClass('king_title2');
                $('#crowd_agreement').removeClass('king_title2');
                $('#crowd_full').removeClass('king_title2');
                $('#crowd_parameter').removeClass('king_title2');
                $('#crowd_parameter_detail').css('display','none');
                $('#pro_info_detail').css('display','none');
                $('#crowd_info_detail').css('display','block');
                $('#crowd_agreement_detail').css('display','none');
                $('#crowd_full_detail').css('display','none');
            });
            $('#crowd_agreement').click(function(){
                $('#pro_info').removeClass('king_title2');
                $('#crowd_info').removeClass('king_title2');
                $('#crowd_agreement').addClass('king_title2');
                $('#crowd_full').removeClass('king_title2');
                $('#crowd_parameter').removeClass('king_title2');
                $('#crowd_parameter_detail').css('display','none');
                $('#pro_info_detail').css('display','none');
                $('#crowd_info_detail').css('display','none');
                $('#crowd_agreement_detail').css('display','block');
                $('#crowd_full_detail').css('display','none');
            });
            $('#crowd_full').click(function(){
                $('#pro_info').removeClass('king_title2');
                $('#crowd_info').removeClass('king_title2');
                $('#crowd_agreement').removeClass('king_title2');
                $('#crowd_full').addClass('king_title2');
                $('#crowd_parameter').removeClass('king_title2');
                $('#crowd_parameter_detail').css('display','none');
                $('#pro_info_detail').css('display','none');
                $('#crowd_info_detail').css('display','none');
                $('#crowd_agreement_detail').css('display','none');
                $('#crowd_full_detail').css('display','block');
                <?php if(($user_id == '') AND ($crowd_info[0]['status'] >= 3)): ?>$('#crowd_full_detail').html("<span class='font16' style='line-height:60px;padding-left:40px;'><a href='/Member/Common/login' style='color:#06a9e7;'>登录</a>后方可投票</span>");
                <?php elseif($crowd_info[0]['status'] < 3): ?>
//                    $('#crowd_full_detail').html("<span class='font16' style='line-height:60px;padding-left:40px;'>投票尚未开始</span>");
                    $('#crowd_full_detail').html("<img style='height:300px;margin-left: 280px;'src='/Style/H/crowd/images/shangweitoupiao.jpg'>");<?php endif; ?>
            });
        });
        //投资
        function invest(id){

            var is_login = '<?php echo ($invid); ?>';
            var num = parseFloat($('#enter_value').val());
            var user_money = parseFloat($('#user_money').text());
            var crowd= $("select option:selected");
            var crowd_id= parseFloat(crowd.attr('id'));

            if(crowd.val()>0){

               if(num<parseFloat(crowd.attr('t_money'))){
                   $.jBox.alert('投资金额小于使用红包的可用金额！','提示');
                return;
               }
            }
            if(num>user_money){
                $.jBox.alert('可用余额不足！','提示');
                return;
            }
            if(is_login == 'login'){
                $.jBox.alert('请先登录！','提示');
                setTimeout("go_login()",2000);
            }else{
                var flag = validate_enter();
                if(!flag){
                    return;
                }
				$.jBox("get:__URL__/ajax_invest?id="+id+'&money='+num+'&crowd_id='+crowd_id, {title: "立即认筹",buttons:{}});
            }
        }
        function validate_enter(){
            var flag =true;
            var input_enter = $('#enter_value').val();//用户输入的金额
            //用户输入的金额必须满足一下条件，必须大于最小金额，小于最大金额，必须是10的倍数，而且必须是数字
            var min_money = <?php echo ($crowd_info[0]['min_money']); ?>;//最小金额
            var max_money = <?php echo ($crowd_info[0]['max_money']); ?>;//最大金额
            var remain_money = <?php echo ($crowd_info[0]['remain_crowd_money']); ?>;//可投金额
            var crowd_money = <?php echo ($crowd_info[0]['crowd_money']); ?>;
            var user_capital = $('#user_capital').val();//已投金额
            var crowd_user_id= <?php echo ($crowd_info[0]['user_id']); ?>;
            var user_id = $('#user_crowd_id').val() ;
           if(crowd_user_id==user_id){
               flag = false;
               $.jBox.alert('不可以投资自己发起的众筹!','提示');
               return;
           }
            if(input_enter > remain_money){
                $('#enter_value').val(min_money);
                flag = false;
                $.jBox.alert('投资金额不正确，不能大于可投金额!','提示');
                return;
            }
            if(input_enter < min_money){
                $('#enter_value').val(min_money);
                flag = false;
                $.jBox.alert('投资金额不正确，默认最小投资金额!','提示');
                return;
            }
            if(input_enter > max_money){
                $('#enter_value').val(max_money);
                flag = false;
                $.jBox.alert('投资金额不正确，不能大于最大投资金额!','提示');
                return;
            }
            if((crowd_money/2-user_capital)<input_enter){
                flag = false;
                $.jBox.alert('投资金额不正确，不能大于单一用户最大可投金额!','提示');
                return;
            }
            if((input_enter%100) !=0){
                $('#enter_value').val(min_money);
                flag = false;
                $.jBox.alert('投资金额必须为100的整数倍!','提示');
                return;
            }
           // alert(remain_money+'===='+input_enter);
            if(((remain_money-input_enter)<min_money) && ((remain_money-input_enter)!=0)){
                $('#enter_value').val(remain_money);
                flag = false;
                $.jBox.alert('投资金额不正确，您投资后剩余金额将小于最小投资额，您现在只能一次性投满或者放弃投资!','提示');
                return;
            }
            return flag;
        }
        function go_login(){
            window.location.href="/member/common/login/";
        }
        function PostData() {
            var pin = $("#pin").val(),					// 支付密码
                    money = $("#enter_value").val(),		// 输入投资金额
                    crowd_id = $('#crowd_id').val()		// 投标编号
            if(!pin){
                $.jBox.alert("请输入支付密码",'提示');
                return false;
            }
            var flag = validate_enter();
            if(!flag){
                return;
            }
            $.ajax({
                url: "__URL__/investcheck",
                type: "post",
                dataType: "json",
                data: {"money":money,'pin':pin,'crowd_id':crowd_id},
                success: function(d) {
                    if (d.status == 1) {
                        investmoney = money;
                        var content = '<div class="jbox-custom"><p>'+ d.message +'</p><div class="jbox-custom-button"><span onclick="$.jBox.close()">取消</span><span onclick="isinvest(true)" id="iscancel">确定投标</span></div></div>';
                        $.jBox(content, {title:'会员投标提示',buttons:{}});
                    }
                    else if(d.status == 2)//
                    {
                        var content = '<div class="jbox-custom"><p>'+ d.message +'</p><div class="jbox-custom-button"><span onclick="$.jBox.close()">取消</span><span onclick="ischarge(true)">去充值</span></div></div>';
                        $.jBox(content, {title:'会员投标提示',buttons:{}});
                    }
                    else if(d.status == 3)//
                    {
                        $.jBox.tip(d.message);
                    }else{
                        $.jBox.tip(d.message);
                    }
                }
            });
        }
        // 提交支付当前要投标表单
        function isinvest(d){
            if(d===true) $('#iscancel').removeAttr('onclick');document.forms.investForm.submit();
        }
        // 充值
        function ischarge(d){
            if(d===true) location.href='/member/charge#fragment-1';
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
</html><?php endif; ?>

<script type="text/javascript">
$(function(){
var daojishi = $("#daojishi").html();
var date = $("#sj").html();
var time = daojishi - date;
var intDiff = parseInt(time);//倒计时总秒数量

function timer(intDiff){
	window.setInterval(function(){
	var day=0,
		hour=0,
		minute=0,
		second=0;//时间默认值		
	if(intDiff > 0){
		day = Math.floor(intDiff / (60 * 60 * 24));
		hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
		minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
		second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
	}
	if (minute <= 9) minute = '0' + minute;
	if (second <= 9) second = '0' + second;
	$('#day_show').html(day+"天");
	$('#hour_show').html('<s id="h"></s>'+hour+'时');
	$('#minute_show').html('<s></s>'+minute+'分');
	$('#second_show').html('<s></s>'+second+'秒');
	intDiff--;
	}, 1000);
} 

$(function(){
	timer(intDiff);
});	
})
</script>