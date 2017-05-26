<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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

<title>新用户注册-- <?php echo ($glo["web_name"]); ?></title>
<script type="text/javascript">
    var JPlaceHolder = {
        //检测
        _check : function(){
            return 'placeholder' in document.createElement('input');
        },
        //初始化
        init : function(){
            if(!this._check()){
                this.fix();
            }
        },
        //修复
        fix : function(){
            jQuery(':input[placeholder]').each(function(index, element) {
                var self = $(this), txt = self.attr('placeholder');
                self.wrap($('<div></div>').css({position:'relative', zoom:'1', border:'none', background:'none', padding:'none', margin:'none'}));
                var pos = self.position(), h = self.outerHeight(true), paddingleft = self.css('padding-left');
                var holder = $('<span></span>').text(txt).css({position:'absolute', left:pos.left+57, top:pos.top, height:h, lienHeight:h, paddingLeft:paddingleft, color:'#aaa'}).appendTo(self.parent());
                self.focusin(function(e) {
                    holder.hide();
                }).focusout(function(e) {
                    if(!self.val()){
                        holder.show();
                    }
                });
                holder.click(function(e) {
                    holder.hide();
                    self.focus();
                });
            });
        }
    };
    //执行
    jQuery(function(){
        JPlaceHolder.init();
    });
var imgpath="__ROOT__/Style/M/";
var curpath="__URL__";
</script>

<script type="text/javascript" src="__ROOT__/Style/M/js/reg.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/strength.js"></script> 
<script type="text/javascript" src="__ROOT__/Style/Js/autoMail.js"></script>

	<link href="__ROOT__/Style/H/che/css/person.css" type="text/css" rel="stylesheet">
    <style type="text/css">
        body{background: #f0f0f0;}
    </style>
    
    <link style="" id="layui_layer_skinlayercss" href="__ROOT__/Style/H/che/css/layer.css" rel="stylesheet">
	<style class="firebugResetStyles" type="text/css" charset="utf-8">
	/* See license.txt for terms of usage */

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

    background: url("data:image/png,%89PNG%0D%0A%1A%0A%00%00%00%0DIHDR%00%00%13%88%00%00%00%0E%08%02%00%00%00L%25a%0A%00%00%00%04gAMA%00%00%D6%D8%D4OX2%00%00%00%19tEXtSoftware%00Adobe%20ImageReadyq%C9e%3C%00%00%04%F8IDATx%DA%EC%DD%D1n%E2%3A%00E%D1%80%F8%FF%EF%E2%AF2%95%D0D4%0E%C1%14%B0%8Fa-%E9%3E%CC%9C%87n%B9%81%A6W0%1C%A6i%9A%E7y%0As8%1CT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AATE9%FE%FCw%3E%9F%AF%2B%2F%BA%97%FDT%1D~K(%5C%9D%D5%EA%1B%5C%86%B5%A9%BDU%B5y%80%ED%AB*%03%FAV9%AB%E1%CEj%E7%82%EF%FB%18%BC%AEJ8%AB%FA'%D2%BEU9%D7U%ECc0%E1%A2r%5DynwVi%CFW%7F%BB%17%7Dy%EACU%CD%0E%F0%FA%3BX%FEbV%FEM%9B%2B%AD%BE%AA%E5%95v%AB%AA%E3E5%DCu%15rV9%07%B5%7F%B5w%FCm%BA%BE%AA%FBY%3D%14%F0%EE%C7%60%0EU%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5JU%88%D3%F5%1F%AE%DF%3B%1B%F2%3E%DAUCNa%F92%D02%AC%7Dm%F9%3A%D4%F2%8B6%AE*%BF%5C%C2Ym~9g5%D0Y%95%17%7C%C8c%B0%7C%18%26%9CU%CD%13i%F7%AA%90%B3Z%7D%95%B4%C7%60%E6E%B5%BC%05%B4%FBY%95U%9E%DB%FD%1C%FC%E0%9F%83%7F%BE%17%7DkjMU%E3%03%AC%7CWj%DF%83%9An%BCG%AE%F1%95%96yQ%0Dq%5Dy%00%3Et%B5'%FC6%5DS%95pV%95%01%81%FF'%07%00%00%00%00%00%00%00%00%00%F8x%C7%F0%BE%9COp%5D%C9%7C%AD%E7%E6%EBV%FB%1E%E0(%07%E5%AC%C6%3A%ABi%9C%8F%C6%0E9%AB%C0'%D2%8E%9F%F99%D0E%B5%99%14%F5%0D%CD%7F%24%C6%DEH%B8%E9rV%DFs%DB%D0%F7%00k%FE%1D%84%84%83J%B8%E3%BA%FB%EF%20%84%1C%D7%AD%B0%8E%D7U%C8Y%05%1E%D4t%EF%AD%95Q%BF8w%BF%E9%0A%BF%EB%03%00%00%00%00%00%00%00%00%00%B8vJ%8E%BB%F5%B1u%8Cx%80%E1o%5E%CA9%AB%CB%CB%8E%03%DF%1D%B7T%25%9C%D5(%EFJM8%AB%CC'%D2%B2*%A4s%E7c6%FB%3E%FA%A2%1E%80~%0E%3E%DA%10x%5D%95Uig%15u%15%ED%7C%14%B6%87%A1%3B%FCo8%A8%D8o%D3%ADO%01%EDx%83%1A~%1B%9FpP%A3%DC%C6'%9C%95gK%00%00%00%00%00%00%00%00%00%20%D9%C9%11%D0%C0%40%AF%3F%EE%EE%92%94%D6%16X%B5%BCMH%15%2F%BF%D4%A7%C87%F1%8E%F2%81%AE%AAvzr%DA2%ABV%17%7C%E63%83%E7I%DC%C6%0Bs%1B%EF6%1E%00%00%00%00%00%00%00%00%00%80cr%9CW%FF%7F%C6%01%0E%F1%CE%A5%84%B3%CA%BC%E0%CB%AA%84%CE%F9%BF)%EC%13%08WU%AE%AB%B1%AE%2BO%EC%8E%CBYe%FE%8CN%ABr%5Dy%60~%CFA%0D%F4%AE%D4%BE%C75%CA%EDVB%EA(%B7%F1%09g%E5%D9%12%00%00%00%00%00%00%00%00%00H%F6%EB%13S%E7y%5E%5E%FB%98%F0%22%D1%B2'%A7%F0%92%B1%BC%24z3%AC%7Dm%60%D5%92%B4%7CEUO%5E%F0%AA*%3BU%B9%AE%3E%A0j%94%07%A0%C7%A0%AB%FD%B5%3F%A0%F7%03T%3Dy%D7%F7%D6%D4%C0%AAU%D2%E6%DFt%3F%A8%CC%AA%F2%86%B9%D7%F5%1F%18%E6%01%F8%CC%D5%9E%F0%F3z%88%AA%90%EF%20%00%00%00%00%00%00%00%00%00%C0%A6%D3%EA%CFi%AFb%2C%7BB%0A%2B%C3%1A%D7%06V%D5%07%A8r%5D%3D%D9%A6%CAu%F5%25%CF%A2%99%97zNX%60%95%AB%5DUZ%D5%FBR%03%AB%1C%D4k%9F%3F%BB%5C%FF%81a%AE%AB'%7F%F3%EA%FE%F3z%94%AA%D8%DF%5B%01%00%00%00%00%00%00%00%00%00%8E%FB%F3%F2%B1%1B%8DWU%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*UiU%C7%BBe%E7%F3%B9%CB%AAJ%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5*%AAj%FD%C6%D4%5Eo%90%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5%86%AF%1B%9F%98%DA%EBm%BBV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%AD%D6%E4%F58%01%00%00%00%00%00%00%00%00%00%00%00%00%00%40%85%7F%02%0C%008%C2%D0H%16j%8FX%00%00%00%00IEND%AEB%60%82") repeat-x !important;

    border-top: 1px solid #BBBBBB !important;

    border-right: 1px dashed #BBBBBB !important;

    border-bottom: 1px solid #000000 !important;

}



.firebugRulerV {

    top: 0 !important;

    left: -15px !important;

    width: 14px !important;

    height: 100% !important;

    background: url("data:image/png,%89PNG%0D%0A%1A%0A%00%00%00%0DIHDR%00%00%00%0E%00%00%13%88%08%02%00%00%00%0E%F5%CB%10%00%00%00%04gAMA%00%00%D6%D8%D4OX2%00%00%00%19tEXtSoftware%00Adobe%20ImageReadyq%C9e%3C%00%00%06~IDATx%DA%EC%DD%D1v%A20%14%40Qt%F1%FF%FF%E4%97%D9%07%3BT%19%92%DC%40(%90%EEy%9A5%CB%B6%E8%F6%9Ac%A4%CC0%84%FF%DC%9E%CF%E7%E3%F1%88%DE4%F8%5D%C7%9F%2F%BA%DD%5E%7FI%7D%F18%DDn%BA%C5%FB%DF%97%BFk%F2%10%FF%FD%B4%F2M%A7%FB%FD%FD%B3%22%07p%8F%3F%AE%E3%F4S%8A%8F%40%EEq%9D%BE8D%F0%0EY%A1Uq%B7%EA%1F%81%88V%E8X%3F%B4%CEy%B7h%D1%A2E%EBohU%FC%D9%AF2fO%8BBeD%BE%F7X%0C%97%A4%D6b7%2Ck%A5%12%E3%9B%60v%B7r%C7%1AI%8C%BD%2B%23r%00c0%B2v%9B%AD%CA%26%0C%1Ek%05A%FD%93%D0%2B%A1u%8B%16-%95q%5Ce%DCSO%8E%E4M%23%8B%F7%C2%FE%40%BB%BD%8C%FC%8A%B5V%EBu%40%F9%3B%A72%FA%AE%8C%D4%01%CC%B5%DA%13%9CB%AB%E2I%18%24%B0n%A9%0CZ*Ce%9C%A22%8E%D8NJ%1E%EB%FF%8F%AE%CAP%19*%C3%BAEKe%AC%D1%AAX%8C*%DEH%8F%C5W%A1e%AD%D4%B7%5C%5B%19%C5%DB%0D%EF%9F%19%1D%7B%5E%86%BD%0C%95%A12%AC%5B*%83%96%CAP%19%F62T%86%CAP%19*%83%96%CA%B8Xe%BC%FE)T%19%A1%17xg%7F%DA%CBP%19*%C3%BA%A52T%86%CAP%19%F62T%86%CA%B0n%A9%0CZ%1DV%C6%3D%F3%FCH%DE%B4%B8~%7F%5CZc%F1%D6%1F%AF%84%F9%0F6%E6%EBVt9%0E~%BEr%AF%23%B0%97%A12T%86%CAP%19%B4T%86%CA%B8Re%D8%CBP%19*%C3%BA%A52huX%19%AE%CA%E5%BC%0C%7B%19*CeX%B7h%A9%0C%95%E1%BC%0C%7B%19*CeX%B7T%06%AD%CB%5E%95%2B%BF.%8F%C5%97%D5%E4%7B%EE%82%D6%FB%CF-%9C%FD%B9%CF%3By%7B%19%F62T%86%CA%B0n%D1R%19*%A3%D3%CA%B0%97%A12T%86uKe%D0%EA%B02*%3F1%99%5DB%2B%A4%B5%F8%3A%7C%BA%2B%8Co%7D%5C%EDe%A8%0C%95a%DDR%19%B4T%C66%82fA%B2%ED%DA%9FC%FC%17GZ%06%C9%E1%B3%E5%2C%1A%9FoiB%EB%96%CA%A0%D5qe4%7B%7D%FD%85%F7%5B%ED_%E0s%07%F0k%951%ECr%0D%B5C%D7-g%D1%A8%0C%EB%96%CA%A0%A52T%C6)*%C3%5E%86%CAP%19%D6-%95A%EB*%95q%F8%BB%E3%F9%AB%F6%E21%ACZ%B7%22%B7%9B%3F%02%85%CB%A2%5B%B7%BA%5E%B7%9C%97%E1%BC%0C%EB%16-%95%A12z%AC%0C%BFc%A22T%86uKe%D0%EA%B02V%DD%AD%8A%2B%8CWhe%5E%AF%CF%F5%3B%26%CE%CBh%5C%19%CE%CB%B0%F3%A4%095%A1%CAP%19*Ce%A8%0C%3BO*Ce%A8%0C%95%A12%3A%AD%8C%0A%82%7B%F0v%1F%2FD%A9%5B%9F%EE%EA%26%AF%03%CA%DF9%7B%19*Ce%A8%0C%95%A12T%86%CA%B8Ze%D8%CBP%19*Ce%A8%0C%95%D1ae%EC%F7%89I%E1%B4%D7M%D7P%8BjU%5C%BB%3E%F2%20%D8%CBP%19*Ce%A8%0C%95%A12T%C6%D5*%C3%5E%86%CAP%19*Ce%B4O%07%7B%F0W%7Bw%1C%7C%1A%8C%B3%3B%D1%EE%AA%5C%D6-%EBV%83%80%5E%D0%CA%10%5CU%2BD%E07YU%86%CAP%19*%E3%9A%95%91%D9%A0%C8%AD%5B%EDv%9E%82%FFKOee%E4%8FUe%A8%0C%95%A12T%C6%1F%A9%8C%C8%3D%5B%A5%15%FD%14%22r%E7B%9F%17l%F8%BF%ED%EAf%2B%7F%CF%ECe%D8%CBP%19*Ce%A8%0C%95%E1%93~%7B%19%F62T%86%CAP%19*Ce%A8%0C%E7%13%DA%CBP%19*Ce%A8%0CZf%8B%16-Z%B4h%D1R%19f%8B%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1%A2%A52%CC%16-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2EKe%98-Z%B4h%D1%A2EKe%D02%5B%B4h%D1%A2EKe%D02%5B%B4h%D1%A2E%8B%96%CA0%5B%B4h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%16-%95a%B6h%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-Z*%C3l%D1%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z%B4T%86%D9%A2E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4h%A9%0C%B3E%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%D1R%19f%8B%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1%A2%A52%CC%16-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2EKe%98-Z%B4h%D1%A2EKe%D02%5B%B4h%D1%A2EKe%D02%5B%B4h%D1%A2E%8B%96%CA0%5B%B4h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%16-%95a%B6h%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-Z*%C3l%D1%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z%B4T%86%D9%A2E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4h%A9%0C%B3E%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%D1R%19f%8B%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1%A2%A52%CC%16-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2EKe%98-Z%B4h%D1%A2EKe%D02%5B%B4h%D1%A2EKe%D02%5B%B4h%D1%A2E%8B%96%CA0%5B%B4h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%16-%95a%B6h%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-Z*%C3l%D1%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z%B4T%86%D9%A2E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4%AE%A4%F5%25%C0%00%DE%BF%5C'%0F%DA%B8q%00%00%00%00IEND%AEB%60%82") repeat-y !important;

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
<body style="">
<div class="browsertip" id="browsertip" style="display: none;">
    <i class="ico-warn"></i> 您系统上的IE版本过低，可能会导致某些功能无法正常使用，<a href="http://rj.baidu.com/soft/detail/23356.html?ald" target="_blank" title="去升级">去升级IE</a>
</div>


    <div class="register-box">
        <div class="wrapper rel">
            <div class="rigister-form">
                <p class="title clearfix">
                    <span class="fl">注册</span>
                    <span class="fr">已有账号，快速 <a href="__APP__/member/common/login/" title="去登录">&nbsp;登录</a></span>
                </p>
                <!--<input name="_token" value="moyjFUMWO9nCygP2bCeONbgkwVg5kvkGIyG1ZG83" type="hidden">-->

                <div class="list" style="margin-top:8px;">
                    <!--<input class="input" id="txtuname" placeholder="注册手机号" onkeyup="javascript:RepNumber(this)" autocomplete="off" maxlength="11" type="text">-->
					<input id="txtPhone" type="text" class="border-none boxinput input" value="" placeholder="请输入手机号"/>

                    <!--<div class="err_tip" id="uname_tip" style="display: none;"></div>-->
                </div>
				<div id="dvPhone" class="boxnew_title2"></div>
                
                <div class="list rel">
                    <i class="ico-showpwd"></i>
                    <!--<input class="input" id="txtpwd" placeholder="输入6-18位密码" maxlength="18" type="password">-->
					<input id="txtPwd" type="password" class="border-none boxinput input" value="" placeholder="请输入密码"/>

                    <!--<div class="err_tip" id="txtpwd_tip" style="display: none;"></div>-->
                </div>
				<div id="dvPwd" class="boxnew_title2"></div>
				<div class="list rel">
                    <i class="ico-showpwd"></i>
                    <!--<input class="input" id="txtpwd" placeholder="输入6-18位密码" maxlength="18" type="password">-->
					<input id="txtRepwd" type="password" class="border-none boxinput input" value="" placeholder="请再次输入密码"/>

                    <!--<div class="err_tip" id="txtpwd_tip" style="display: none;"></div>-->
                </div>
				<div id="dvRepwd" class="boxnew_title2"></div>
                <div class="list">
					<input id="txtRec" type="text" class="border-none boxinput input" value="<?php echo ($in); ?>" <?php if($invite != ''): ?>readonly=readonly<?php endif; ?>  placeholder="请输入推广人用户名/手机号"/>
                    <!--<input class="input" id="txttjcode" placeholder="推荐码人ID非必填项" onkeyup="javascript:RepNumber(this)" autocomplete="off" type="text">-->

                    <!--<div class="err_tip" id="txttjcode_tips" style="display: none;"></div>-->
                </div>
				 <div id="dvRec" class="boxnew_title2"></div>
				<div class="list rel">
                    <input type="text" placeholder="请输入验证码" class="border-none boxinput_ input w-sms" id="txtCode"/>
					<img class="btnsms" onclick="this.src=this.src+'?t='+Math.random()" id="imVcode" alt="点击换一个校验码" style=" float: right; margin-left: 12px; height:40px;border: 1px solid #dcdcdc;" src="__URL__/verify">
                </div>
				<div id="dvCode" class="boxnew_title2"></div>
				<div class="list clearfix">
					<input type="text" placeholder="请输入手机验证码" class="border-none boxinput_ input w-sms" id="txtPCode"/>
                    <!--<input class="input w-sms" id="txtsms" maxlength="6" placeholder="短信验证码" onkeyup="javascript:RepNumber(this)" autocomplete="off" type="text">
                    <button class="btnsms" id="btnsms" onclick="funsmscode('register')">获取验证码</button>-->
					 <input type="button" value="获取短信验证码" class="binput_ border-none btnsms" id="pcodebtn" onclick="sendMobileValidSMSCode()" style="cursor: pointer"/>
                    <!--<input id="code_id" value="" type="hidden">
                    <div class="err_tip" id="txtsms_tips" style="display: none;"></div>-->
                </div>
				<div id="dvPcode" class="boxnew_title2"></div>
                <div class="contract">
					<input class="ckcontract" type="checkbox" checked="checked"/><a target="_blank" href="http://www.baishengzc.com/profile/index?zhuce=2" class="color-red">同意《注册服务协议》 </a>
                </div>
                <div>
                    <button class="btnregister login_btn border-none text-center font18" onclick="RegSubmit(this);" id="btnReg">注册</button>
					
                </div>
            </div>
        </div>
    </div>
    
   

<script type="text/javascript">
    function closeAction(){
        window.location.href="__APP__/member/";
    }

    function getPassWord() {
        $.jBox("get:__APP__/member/common/getpassword/", {
            title: "找回密码",
            width: "auto",
            buttons: {'发送邮件':'jfun_dogetpass()','关闭': true }
        });
    }
    //$(document).ready(function(){
    //    $('#txtEmail').autoMail({
    //        emails:['qq.com','163.com','126.com','sina.com','sohu.com','yahoo.cn','gmail.com','hotmail.com','live.cn']
    //    });
    //});
    var mbTest = /^(13|14|15|17|18)[0-9]{9}$/;
    var timer = null;
    var leftsecond = 60; //倒计时
    var msg = "";
    function sendMobileValidSMSCode() {
        if("获取短信验证码" !=$("#pcodebtn").val())
        {
            return;
        }
		


        var mobile = $("#txtPhone").val();
        if (mobile == "") {
            return;
        }
        if (mbTest.test(mobile)) {
            //$.jBox.tip("验证码发送中......","loading");
            $.ajax({
                url: "__URL__/sendphone/",
                type: "post",
                dataType: "json",
                data: {"cellphone":mobile,"code":$("#txtCode").val()},
                success: function(d) {
                    leftsecond = 60;
                    if (d.status == 1) {
                        $.jBox.tip("发送成功","success");
                        clearInterval(timer);
                        timer = setInterval(setLeftTime, 1000, "1");
                    }
                    else if (d.status == 2) {
                        $.jBox.tip("号码已被使用","error");
                    }
                    else if (d.status == 3) {
                        $.jBox.tip("图像验证码不正确！","error");
                    }
                    else if (d.status == 4) {
                        $.jBox.tip("请先填写图形验证码！","error");
                    }
                    else {
                        $.jBox.tip("校验码发送失败,请重试","fail");
                    }
                }
            });
        }
        else {

            return;
        }
    }
    function setLeftTime() {
        var second = Math.floor(leftsecond);
        $("#pcodebtn").val(msg + second + "秒后可重发");
        leftsecond--;
        if (leftsecond < 1) {
            $("#pcodebtn").val("现在可重新发送！");
            clearInterval(timer);
            try {
                $("#pcodebtn").val("获取短信验证码");
            } catch (E) { }
            return;
        }
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