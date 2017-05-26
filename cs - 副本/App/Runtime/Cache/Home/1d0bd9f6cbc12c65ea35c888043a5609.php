<?php if (!defined('THINK_PATH')) exit();?>﻿<?php if($web_close["isopen"] == 2): ?><div class="web_close" style="text-align: center;font-size: 30px;margin-top:200px;">
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

<link href="__ROOT__/style/H/lanren/css/lanrenzhijia.css" type="text/css" rel="stylesheet" />
	
	<div class="flexslider">
	<ul class="slides">
	
		<?php $_result=get_ad(4);if(is_array($_result)): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($k % 2 );++$k;?><li ><a href="<?php echo ($va["url"]); ?>"><img src="<?php echo ($va["img"]); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
   </div>

	
<!-- js调用部分begin -->
<script src="http://www.lanrenzhijia.com/ajaxjs/jquery.min.js"></script>
<script src="__ROOT__/style/H/lanren/js/jquery.flexslider-min.js"></script>
<script>
$(function(){
	$('.flexslider').flexslider({
		directionNav: true,
		pauseOnAction: false
	});
});
</script>
<!-- js调用部分end -->

	<div class="projectTrailer-box">
		<span class="projectMore"><a href="/fgonggao/index.html">更多&gt;&gt;</a></span>
		<span class="projectTrailer">项目预告</span>
		<span class="projectTrailer-title">
			<?php if(is_array($fabiaoList["list"])): $i = 0; $__LIST__ = $fabiaoList["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gg): $mod = ($i % 2 );++$i;?><a href="<?php echo ($gg["arturl"]); ?>"><?php echo (cnsubstr($gg["title"],16)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</span></div>
	 <div class="ptsj">
    	<div class="ptsj-box1"><span>累计成交金额（￥）</span><br>
    	<strong><?php echo Fmoney($all_turn_volume);?></strong></div>
		<div class="ptsj-box2"><span>累计分红金额（￥）</span><br>
		<strong><?php echo Fmoney($user_count_money);?></strong></div>
		<div class="ptsj-box3"><span>已回款金额（￥）</span><br>
		<strong><?php echo Fmoney($all_crowd_money);?></strong></div>
		<div class="ptsj-box4"><span>已处置项目（个数） </span><br>
		<strong><?php echo ($succ_count); ?></strong></div>
		<div class="ptsj-box5"><span>注册用户（人数）</span><br>
		<strong><?php echo ($members); ?></strong></div>
    </div>
	
	
	<div class="guide">
			<div class="guide-box">
				<div class="guide-box-1">
					<a href="">
					<div class="guide-box-1-left">
						
					</div>
					</a>
					<div class="guide-box-1-right">
						<h1><a href="">门槛低，收益高</a>	</h1>
						<p>起投100元</p>
						
					</div>
					
				</div>
				<div class="guide-box-2">
					<a href="">
					<div class="guide-box-2-left">
						
					</div>
					</a>
					<div class="guide-box-2-right">
						<h1><a href="">多重安全保障</a></h1>
						
						<p>优质实物资产保障</p>
					</div>
					
				</div>
				<div class="guide-box-3">
					<a href="">
					<div class="guide-box-3-left">
						
					</div>
					</a>
					<div class="guide-box-3-right">
						<h1><a href="">律师事务所</a></h1>
						<p>法律尽调</p>
						<p>项目监督</p>
					</div>
					
				</div>
			</div>

			
		</div>
	<div class="contain">
		<div class="contain-box">
			<div class="contain-box-left">
			<div class="tyb">
							<div class="tyb-img">
								<h1 class="tyb-leftbox-title">众筹预告&gt;</h1>
								<p class="tyb-leftbox-p">财富增值，智慧之选！<br>
								</p>
							</div>
							<div class=" tyb-right">
								<h1 class="tyb-rightbox-title"><a href="<?php echo (getcrowdinvesturl($votelist["id"])); ?>"><?php echo (cnsubstr($votelist["crowd_name"],20)); ?></a><!-- <div class="tyb-xiantou">限投1万元</div> --></h1>
							<table class=" tyb-table">
												<tbody><tr>
													<td class="tyb-td2"><?php echo ($votelist["max_duration"]); ?>月</td>
													<td class="tyb-td3"><?php echo ($votelist["crowd_money"]); ?>元</td>
												</tr>
													<tr style="height: 35px;">
													
													<td>预计周期</td>
													<td class="tyb-td4">投资金额</td>
												</tr>
												
												
	
												 <tr style="height: 65px;">
													<td colspan="3" class="progress-tyb">
														<div class="progress-box tyb-progress-box">
															<span class="progress-text">项目投资进度:</span>
															<div class="progress progress-tyb-span">
																<span style="width: <?php echo ($votelist["rate"]); ?>%;"></span>
															</div>
															<span class="progress-text"><?php echo ($votelist["rate"]); ?>%</span>
														</div>
														<div class="wyzq-btn tyb-wyzq-btn"><a href="<?php echo (getcrowdinvesturl($votelist["id"])); ?>">我要赚钱</a></div>
													</td>
									
												</tr>
												<tr>
													<td colspan="3">开始时间 <?php if($votelist['start_time']=="1970-01-01"){ }else{ echo $votelist['start_time']; }?>
													
													</td>									  
												</tr>
					
											</tbody></table>
								
							</div>
				</div>
				<div class="hot-porject-title-box">
					<span class="hot-porject-title">热门项目</span>
					<ul class="hot-porject-menu">
						<li data-id="porject-box-all" class="porject-active"><a>全部项目<span><?php echo ($count_all); ?></span></a></li>
						<li data-id="porject-box-tzz"><a>众筹中<span><?php echo ($count_zhong); ?></span></a></li>
						<li data-id="porject-box-czz"><a>出售中<span><?php echo ($count_shou); ?></span></a></li>
						<li data-id="porject-box-yfh"><a>己出售<span><?php echo ($count_yishou); ?></span></a></li>
					</ul>
				</div>
				<div class="porject porject-box-all">
				<!-- 全部 -->
				<?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ls): $mod = ($i % 2 );++$i;?><div class="porject-box">
								<div class="porject-box-left">
									<a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">
									<img src="<?php echo ($ls['img'][0]['img']); ?>" alt="<?php echo (cnsubstr($ls["crowd_name"],15)); ?>" height="251" width="381">
									
									</a>
									<!-- <span class="handle">汽车处置</span> -->
								</div>
								<div class="porject-box-right">
									<h1><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>"><?php echo (cnsubstr($ls["crowd_name"],15)); ?></a></h1>
									<table class="porject-table">
										<tbody><tr>
											<!--<td class="porject-table-td1"><?php echo ($ls["back_rate"]); ?>%</td>-->
											<td class="porject-table-td2"><?php echo ($ls["max_duration"]); ?>月</td>
											<td class="porject-table-td3"><?php echo ($ls["crowd_money"]); ?>元</td>
										</tr>
											<tr style="height: 35px;">
											<!--<td>预计年化收益率<a class="porject-icon" title="实际收益以最终获得的收益为准。"></a></td>-->
											<td>预计周期<a class="porject-icon" title="可提前回款"></a></td>
											<td class="porject-table-td4">投资金额</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td5" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td>目标份额：<?php echo ($ls["fenshu"]); ?>份</td>
											<td></td>
											<td class="porject-table-td6">起投金额：<?php echo ($ls["min_money"]); ?>元</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td7" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td class="countdown-td" colspan="3">
											   <div class="djs">项目众筹时间：</div>
												<div id="">
													<span><?php echo ($ls["crowd_duration"]); ?>天</span>
											   </td>
											   <!--<div class="djs">距投资时间结束还有：</div>
												<div id="code_160812094416664097"><span>0</span> 天 <span>22</span> 时 <span>23</span> 分  <span>3</span> 秒</div>
												   <input id="time_160812094416664097" value="80583" type="hidden">
											   </td>-->
											
										</tr>
										 <tr style="height: 35px;">
											<td colspan="3">
												<div class="progress-box">
													<span class="progress-text">项目投资进度:</span>
													<div class="progress">
														<span style="width: <?php echo ($ls["rate"]); ?>%;"></span>
													</div>
													<span class="progress-text"><?php echo ($ls["rate"]); ?>%</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>招标时间:<?php echo ($ls["start_time"]); ?></td>
											<td></td>
										  <td> <span class="wyzq-btn"><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">我要赚钱</a></span></td>
										  </tr>
			
									</tbody></table>
									
							
									
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>	
					 </div>     
                <div class="porject porject-box-tzz">
                    <!-- 投资中 -->
				<?php if(is_array($list4)): $i = 0; $__LIST__ = $list4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ls): $mod = ($i % 2 );++$i;?><div class="porject-box">
								<div class="porject-box-left">
									<a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">
									<img src="<?php echo ($ls['img'][0]['img']); ?>" alt="<?php echo (cnsubstr($ls["crowd_name"],15)); ?>" height="251" width="381">
									
									</a>
									<!-- <span class="handle">汽车处置</span> -->
								</div>
								<div class="porject-box-right">
									<h1><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>"><?php echo (cnsubstr($ls["crowd_name"],15)); ?></a></h1>
									<table class="porject-table">
										<tbody><tr>
											<!--<td class="porject-table-td1"><?php echo ($ls["back_rate"]); ?>%</td>-->
											<td class="porject-table-td2"><?php echo ($ls["max_duration"]); ?>月</td>
											<td class="porject-table-td3"><?php echo ($ls["crowd_money"]); ?>元</td>
										</tr>
											<tr style="height: 35px;">
											<!--<td>预计年化收益率<a class="porject-icon" title="实际收益以最终获得的收益为准。"></a></td>-->
											<td>预计周期<a class="porject-icon" title="可提前回款"></a></td>
											<td class="porject-table-td4">投资金额</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td5" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td>目标份额：<?php echo ($ls["fenshu"]); ?>份</td>
											<td></td>
											<td class="porject-table-td6">起投金额：<?php echo ($ls["min_money"]); ?>元</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td7" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td class="countdown-td" colspan="3">
											   <div class="djs">项目众筹时间：</div>
												<div id="">
													<span><?php echo ($ls["crowd_duration"]); ?>天</span>
											   </td>
											   <!--<div class="djs">距投资时间结束还有：</div>
												<div id="code_160812094416664097"><span>0</span> 天 <span>22</span> 时 <span>23</span> 分  <span>3</span> 秒</div>
												   <input id="time_160812094416664097" value="80583" type="hidden">
											   </td>-->
											
										</tr>
										 <tr style="height: 35px;">
											<td colspan="3">
												<div class="progress-box">
													<span class="progress-text">项目投资进度:</span>
													<div class="progress">
														<span style="width: <?php echo ($ls["rate"]); ?>%;"></span>
													</div>
													<span class="progress-text"><?php echo ($ls["rate"]); ?>%</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>招标时间:<?php echo ($ls["start_time"]); ?></td>
											<td></td>
										  <td> <span class="wyzq-btn"><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">我要赚钱</a></span></td>
										  </tr>
			
									</tbody></table>
									
							
									
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
							
					   </div>  
				<div class="porject porject-box-czz">
                      <!-- 处置中 -->
					<?php if(is_array($list5)): $i = 0; $__LIST__ = $list5;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ls): $mod = ($i % 2 );++$i;?><div class="porject-box">
								<div class="porject-box-left">
									<a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">
									<img src="<?php echo ($ls['img'][0]['img']); ?>" alt="<?php echo (cnsubstr($ls["crowd_name"],15)); ?>" height="251" width="381">
									
									</a>
									<!-- <span class="handle">汽车处置</span> -->
								</div>
								<div class="porject-box-right">
									<h1><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>"><?php echo (cnsubstr($ls["crowd_name"],15)); ?></a></h1>
									<table class="porject-table">
										<tbody><tr>
											<!--<td class="porject-table-td1"><?php echo ($ls["back_rate"]); ?>%</td>-->
											<td class="porject-table-td2"><?php echo ($ls["max_duration"]); ?>月</td>
											<td class="porject-table-td3"><?php echo ($ls["crowd_money"]); ?>元</td>
										</tr>
											<tr style="height: 35px;">
											<!--<td>预计年化收益率<a class="porject-icon" title="实际收益以最终获得的收益为准。"></a></td>-->
											<td>预计周期<a class="porject-icon" title="可提前回款"></a></td>
											<td class="porject-table-td4">投资金额</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td5" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td>目标份额：<?php echo ($ls["fenshu"]); ?>份</td>
											<td></td>
											<td class="porject-table-td6">起投金额：<?php echo ($ls["min_money"]); ?>元</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td7" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td class="countdown-td" colspan="3">
											   <div class="djs">项目众筹时间：</div>
												<div id="">
													<span><?php echo ($ls["crowd_duration"]); ?>天</span>
											   </td>
											   <!--<div class="djs">距投资时间结束还有：</div>
												<div id="code_160812094416664097"><span>0</span> 天 <span>22</span> 时 <span>23</span> 分  <span>3</span> 秒</div>
												   <input id="time_160812094416664097" value="80583" type="hidden">
											   </td>-->
											
										</tr>
										 <tr style="height: 35px;">
											<td colspan="3">
												<div class="progress-box">
													<span class="progress-text">项目投资进度:</span>
													<div class="progress">
														<span style="width: <?php echo ($ls["rate"]); ?>%;"></span>
													</div>
													<span class="progress-text"><?php echo ($ls["rate"]); ?>%</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>招标时间:<?php echo ($ls["start_time"]); ?></td>
											<td></td>
										  <td> <span class="wyzq-btn"><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">我要赚钱</a></span></td>
										  </tr>
			
									</tbody></table>
									
							
									
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
							
					   </div>
                    <div class="porject porject-box-yfh">
                    <!-- 已处置 -->
						<?php if(is_array($list6)): $i = 0; $__LIST__ = $list6;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ls): $mod = ($i % 2 );++$i;?><div class="porject-box">
								<div class="porject-box-left">
									<a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">
									<img src="<?php echo ($ls['img'][0]['img']); ?>" alt="<?php echo (cnsubstr($ls["crowd_name"],15)); ?>" height="251" width="381">
									
									</a>
									<!-- <span class="handle">汽车处置</span> -->
								</div>
								<div class="porject-box-right">
									<h1><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>"><?php echo (cnsubstr($ls["crowd_name"],15)); ?></a></h1>
									<table class="porject-table">
										<tbody><tr>
											<!--<td class="porject-table-td1"><?php echo ($ls["back_rate"]); ?>%</td>-->
											<td class="porject-table-td2"><?php echo ($ls["max_duration"]); ?>月</td>
											<td class="porject-table-td3"><?php echo ($ls["crowd_money"]); ?>元</td>
										</tr>
											<tr style="height: 35px;">
											<!--<td>预计年化收益率<a class="porject-icon" title="实际收益以最终获得的收益为准。"></a></td>-->
											<td>预计周期<a class="porject-icon" title="可提前回款"></a></td>
											<td class="porject-table-td4">投资金额</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td5" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td>目标份额：<?php echo ($ls["fenshu"]); ?>份</td>
											<td></td>
											<td class="porject-table-td6">起投金额：<?php echo ($ls["min_money"]); ?>元</td>
										</tr>
										<tr style="height: 1px;">
			
											<td class="porject-table-td7" colspan="3"></td>
										</tr>
										<tr style="height: 35px;">
											<td class="countdown-td" colspan="3">
											   <div class="djs">项目众筹时间：</div>
												<div id="">
													<span><?php echo ($ls["crowd_duration"]); ?>天</span>
											   </td>
											   <!--<div class="djs">距投资时间结束还有：</div>
												<div id="code_160812094416664097"><span>0</span> 天 <span>22</span> 时 <span>23</span> 分  <span>3</span> 秒</div>
												   <input id="time_160812094416664097" value="80583" type="hidden">
											   </td>-->
											
										</tr>
										 <tr style="height: 35px;">
											<td colspan="3">
												<div class="progress-box">
													<span class="progress-text">项目投资进度:</span>
													<div class="progress">
														<span style="width: <?php echo ($ls["rate"]); ?>%;"></span>
													</div>
													<span class="progress-text"><?php echo ($ls["rate"]); ?>%</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>招标时间:<?php echo ($ls["start_time"]); ?></td>
											<td></td>
										  <td> <span class="wyzq-btn"><a href="<?php echo (getcrowdinvesturl($ls["id"])); ?>">我要赚钱</a></span></td>
										  </tr>
			
									</tbody></table>
									
							
									
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
			<a href="/crowdinvest/index"> <div class="hot-porject-more">查看更多项目</div></a>
			</div>
			
			<div class="contain-box-right">
				<div class="notice">
				 
					<h1>
						<span data-id="0" class="notice-title contain-right-toggle">
							<a href="/gonggao/index.html">最新公告</a>
						</span>
						<span data-id="1" class="bbs-title contain-right-toggle"><a href="/product_news/index.html">发标公告</a></span>
					</h1>
					<div class="contain-right-toggle-text">
					<?php if(is_array($noticeList["list"])): $i = 0; $__LIST__ = $noticeList["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gg): $mod = ($i % 2 );++$i;?><p><a href="<?php echo ($gg["arturl"]); ?>"><?php echo (cnsubstr($gg["title"],16)); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div style="display: none;" class="contain-right-toggle-text">
					<?php if(is_array($fabiaoList2["list"])): $i = 0; $__LIST__ = $fabiaoList2["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gg): $mod = ($i % 2 );++$i;?><p><a href="<?php echo ($gg["arturl"]); ?>"><?php echo (cnsubstr($gg["title"],16)); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				

				<div class="revenue">
					<div class="revenue-title">
						<div style="height: 16px;"></div>
						<h1>年化收益对比</h1>
					</div>
					<img src="__ROOT__/Style/H/che/images/revenue.jpg" alt="">
				</div>


				<div class="consultation">
					<h1>
						<span data-id="0" class="consultation-title contain-right-toggle2"><a href="/news/index.html">新闻动态</a></span>
						<span data-id="1" class="school-title contain-right-toggle2"><a href="/crowdinvest/index">项目动态</a></span>
					</h1>
					<div class="contain-right-toggle2-text">
					<?php if(is_array($NnoticeList["list"])): $i = 0; $__LIST__ = $NnoticeList["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gg): $mod = ($i % 2 );++$i;?><p><a href="<?php echo ($gg["arturl"]); ?>"><?php echo (cnsubstr($gg["title"],16)); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div style="display: none;" class="contain-right-toggle2-text">
					<?php if(is_array($productlist["list"])): $i = 0; $__LIST__ = $productlist["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gg): $mod = ($i % 2 );++$i;?><p><a href="<?php echo ($gg["arturl"]); ?>"><?php echo (cnsubstr($gg["title"],16)); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				
				<div class="company-news">
					<div>
						<div style="height: 15px;"></div>
						<div class="company-news-h1-div"><h1><a href="fgonggao/index.html"><span class="company-news-more">更多&gt;&gt;</span></a>运营报告</h1></div>
					</div>
					<div class="company-news-box">
						<?php if(is_array($yunyinglist["list"])): $i = 0; $__LIST__ = $yunyinglist["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gg): $mod = ($i % 2 );++$i;?><a href="<?php echo ($gg["arturl"]); ?>"><img src="<?php echo ($gg["art_img"]); ?>" alt="<?php echo (cnsubstr($gg["title"],16)); ?>"></a>
							<p><a href="<?php echo ($gg["arturl"]); ?>"><?php echo (cnsubstr($gg["title"],16)); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
				   </div>
				</div>

			</div>
		</div>

<div class="partner">
			<h1>友情链接</h1>
			<div class="partner-box">
				<div class="partner-box-left"><a class="arrow-left"></a></div>
				<div class="partner-box-center">
					<ul style="left: -163px;">
						<?php if(is_array($link_img)): $i = 0; $__LIST__ = $link_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["link_href"]); ?>"><img src="<?php echo ($vo["link_img"]); ?>" alt=""></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="partner-box-right"><a class="arrow-right"></a></div>
				
			</div>
</div>

	</div>
   <!-- qq客服开始 --> 
    <link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/new/css/kefu.css">
    <script type="text/javascript" src="__ROOT__/Style/H/new/js/kefu.js"></script>
    <div id="floatTools" class="float0831">
      <div class="floatL">
        <a style="display:block" id="aFloatTools_Show" class="btnOpen" title="查看在线客服" onclick="javascript:$('#divFloatToolsView').animate({width: 'show', opacity: 'show'}, 'normal',function(){ $('#divFloatToolsView').show();kf_setCookie('RightFloatShown', 0, '', '/', 'www.16sucai.com'); });$('#aFloatTools_Show').attr('style','display:none');$('#aFloatTools_Hide').attr('style','display:block');" href="javascript:void(0);">展开</a>

        <a id="aFloatTools_Hide" class="btnCtn" title="关闭在线客服" onclick="javascript:$('#divFloatToolsView').animate({width: 'hide', opacity: 'hide'}, 'normal',function(){ $('#divFloatToolsView').hide();kf_setCookie('RightFloatShown', 1, '', '/', 'www.16sucai.com'); });$('#aFloatTools_Show').attr('style','display:block');$('#aFloatTools_Hide').attr('style','display:none');" href="javascript:void(0);" style="display:none">收缩</a>
      </div>
      <div id="divFloatToolsView" class="floatR" style="display: none;">
        <div class="tp"></div>
        <div class="cn">
          <ul style="list-style:none;">
            <li class="top1">
              <h3 class="titZx">QQ咨询</h3>
            </li>
            <li><span class="icoZx">在线咨询</span> </li>

        <?php if(is_array($qq1)): $i = 0; $__LIST__ = $qq1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
               <a class="icoTc" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($vo["qq_num"]); ?>&site=qq&menu=yes"><?php echo ($vo["qq_title"]); ?></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>



          </ul>
          <ul>
            <li>
              <span class="icoZx">官方交流群</span>
            </li>
           
            <li>
              <p><span style="color:rgb(102, 102, 102);font-family:微软雅黑, 宋体;font-size:14px;"><?php echo ($qun['qq_num']); ?></span></p>
            </li>

          </ul>
          <ul>
            <li>
              <h3 class="titDh">电话咨询</h3>
            </li>
            <li style="width:105px;"><?php echo ($tel["qq_num"]); ?> </li>
          </ul>
        </div>
      </div>
      <script type="text/javascript" src="__ROOT__/Style/H/new/js/siteHome.js"></script>
    </div>
<!-- qq客服结束-->







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