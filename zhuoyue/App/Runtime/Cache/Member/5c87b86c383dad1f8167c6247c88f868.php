<?php if (!defined('THINK_PATH')) exit(); if($web_close["isopen"] == 2): ?><div class="web_close" style="text-align: center;font-size: 30px;margin-top:200px;">
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

<title>用户登录-- <?php echo ($glo["web_name"]); ?></title>
	
	<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/Mbmber.css" />
	<link rel="stylesheet" href="__ROOT__/Style/H/css/registerreset.css" />
	<link rel="stylesheet" href="__ROOT__/Style/H/css/registerstyle.css" />

	<link href="__ROOT__/Style/H/che/css/person.css" type="text/css" rel="stylesheet">
    <style type="text/css">
        body{background: #f0f0f0;}
    </style>
    <link style="" id="layui_layer_skinlayercss" href="__ROOT__/Style/H/che/css/layer.css" rel="stylesheet"></head>

	<script type="text/javascript">
var imgpath="__ROOT__/Style/M/";
var curpath="__URL__";
</script>
<script language="JavaScript">
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
function keyLogin(){
  if (event.keyCode==13)   //回车键的键值为13
     document.getElementById("btnReg").click();  //调用登录按钮的登录事件
}
</script>
<script type="text/javascript" src="__ROOT__/Style/M/js/login.js"></script>
<div class="browsertip" id="browsertip" style="display: none;">
    <i class="ico-warn"></i> 您系统上的IE版本过低，可能会导致某些功能无法正常使用，<a href="http://rj.baidu.com/soft/detail/23356.html?ald" target="_blank" title="去升级">去升级IE</a>
</div>

    <div class="login-box " >
        <div class="wrapper rel member_login" onkeydown="keyLogin();">
            <div class="login-form login_boxnew color-bg-white"  >
                <p class="title clearfix">
                    <span class="fl">登录</span>
                    <span class="fr">
                                            </span><span class="fr">新朋友，请<a href="__APP__/member/common/register/" title="去注册">&nbsp;注册</a></span>
                </p>
                <!--<input name="_token" value="moyjFUMWO9nCygP2bCeONbgkwVg5kvkGIyG1ZG83" type="hidden">-->
				<div id="dvUser" class="boxnew_title"></div>
                <div class="list">
                    <!--<input class="input" maxlength="11" placeholder="输入手机号" id="txtuname" onkeyup="javascript:RepNumber(this)" autocomplete="off" type="text">-->
					<input id="txtUser" type="text" class="border-none boxinput input" value="" placeholder="请输入用户名/手机号"/>

                    <!--<div class="err_tip" id="uname_tip" style="display: none;"></div>-->
                </div>
                <div class="list ">
                    <!--<input class="input" placeholder="输入6-18位密码" maxlength="18" id="txtpwd" type="password">-->
					<input id="txtPwd" type="password" class="border-none boxinput input" value="" placeholder="请输入登录密码"/>

                    <!--<div class="err_tip" id="txtpwd_tip" style="display: none;"></div>-->
                </div>

                <div class="list listauthcode " id="authcode" style="">
                    <!--<input id="time" value="0" type="hidden">-->
					<input type="text" placeholder="请输入验证码" class="border-none boxinput_ input w-sms " id="txtCode" maxlength="6"/>
                    <!--<input class="input w-sms" id="txtsms" maxlength="6" onkeyup="javascript:RepNumber(this)" autocomplete="off" placeholder="短信验证码" type="text">-->
                    <!--<button class="btnsms" id="btnsms">获取验证码</button>
                    <div class="err_tip" id="txtauthcode_tip" style="display: none"></div>-->
					<img class="btnsms" onclick="this.src=this.src+'?t='+Math.random()" id="imVcode" alt="点击换一个校验码" style=" float: right; margin-left: 12px; width: 119px; height:40px;border: 1px solid #dcdcdc;" src="__URL__/verify">
                </div>
                <div class="forget">
                    <!--<label class="fl"><input class="ckpwd" id="remAccount" type="checkbox">&nbsp;自动登录</label>--><a href="__APP__/member/common/getpwd/" class="fr">忘记密码？</a>
                </div>
                
				<div class="login_btn border-none text-center font18 btnlogin" onclick="LoginSubmit(this);"  id="btnReg">登录</div>
                
            </div>
        </div>
    </div>
<script type="text/javascript">
function jfun_dogetpass(){
	var ux = $("#emailname").val();
	if(ux==""){
		$.jBox.tip('请输入用户名或者手机号','tip');
		return;
	}
	$.jBox.tip("邮件发送中......","loading");
	$.ajax({
		url: "__APP__/member/common/dogetpass/",
		data: {"u":ux},
		//timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip("发送成功，请去邮箱查收",'success');
					$.jBox.close(true);
				}else{
					$.jBox.tip("发送失败，请重试",'fail');
				}
			}
		}
	});

}

function getPassWord() {
	$.jBox("get:__APP__/member/common/getpassword/", {
		title: "找回密码",
		width: "auto",
		buttons: {'发送邮件':'jfun_dogetpass()','关闭': true }
	});   
}


$(".login_btn").click(function(){
  //  alert('13');
});
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
</body></html><?php endif; ?>