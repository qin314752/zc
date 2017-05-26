var wido,j=0,numbers
function autoPlayGo()
{j++;if(j>=numbers){j=0;}
$("#scrollArea").stop(true,true).animate({scrollLeft:595*j},300)}
$(function(){var numbers=$("#scrollArea6 img").size();$("#scrollArea ul").css("width",595*numbers);$("#right").click(function(){clearInterval("autoPlayGo6()");j++
if(j>=numbers)j=numbers-1
$("#scrollArea").animate({scrollLeft:595*j},300)})
$("#left").click(function(){clearInterval("autoPlayGo6()")
j--
if(j<0)j=0
$("#scrollArea").animate({scrollLeft:595*j},300)})
wido=window.setInterval("autoPlayGo()",3000)});var wido2,j2=0,numbers2
function autoPlayGo2()
{j2++
if(j2>=numbers2)j2=0
$("#scrollArea2").stop(true,true).animate({scrollLeft:478*j2},300)}
$(function(){numbers2=$("#scrollArea2 img").size()
$("#scrollArea2 ul").css("width",478*numbers2)
$("#right2").click(function(){clearInterval("autoPlayGo6()")
j2++
if(j2>=numbers2)j2=numbers2-1
$("#scrollArea2").animate({scrollLeft:478*j2},300)})
$("#left2").click(function(){clearInterval("autoPlayGo6()")
j2--
if(j2<0)j2=0
$("#scrollArea2").animate({scrollLeft:478*j2},300)})
wido2=window.setInterval("autoPlayGo2()",3000)});var wido6,j6=0,numbers6;function autoPlayGo6()
{j6++
if(j6>=numbers6)j6=0;$("#scrollArea6").stop(true,true).animate({scrollLeft:186*j6},300)}
$(function(){numbers6=$("#scrollArea6 img").size()
$("#scrollArea6 ul").css("width",1220)
$("#right3").click(function(){clearInterval("autoPlayGo6()")
j6++
if(j6>=numbers6)j6=numbers6-1
$("#scrollArea6").animate({scrollLeft:186*j6},300)})
$("#left3").click(function(){clearInterval("autoPlayGo6()")
j6--
if(j6<0)j6=0
$("#scrollArea6").animate({scrollLeft:186*j6},300)})
wido6=window.setInterval("autoPlayGo6()",3000)});$(".top01").click(function(){$(".click01").css("display","block");$(this).addClass("current").siblings().removeClass("current")
$(".click02").css("display","none");$(".click03").css("display","none");})
$(".top02").click(function(){$(".click02").css("display","block");$(this).addClass("current").siblings().removeClass("current")
$(".click01").css("display","none");$(".click03").css("display","none");$(".fade201").fadeTo(0,0);$(".fade203").fadeTo(0,0);$(".fade205").fadeTo(0,0);$(document).scroll(function(){var $scrollTop=$(document).scrollTop();if($scrollTop>539){$(".fade201").fadeTo(1000,1);$(".rightS201").animate({right:0},900);};if($scrollTop>1339){$(".leftPosS201").animate({left:0},900);$(".fade202").animate({right:"-26px"},900);};if($scrollTop>1839){$(".fade203").fadeTo(1000,1);$(".rightS203").animate({right:0},900);};if($scrollTop>2339){$(".leftPosS202").animate({left:0},900);$(".fade204").animate({right:"-26px"},900);};if($scrollTop>2980){$(".fade205").fadeTo(1000,1);$(".rightS205").animate({right:0},900);};if($scrollTop>3439){$(".leftPosS203").animate({left:0},900);$(".fade206").animate({right:"-26px"},900);};});})
$(".top03").click(function(){$(".click03").css("display","block");$(this).addClass("current").siblings().removeClass("current")
$(".click01").css("display","none");$(".click02").css("display","none");$(".fade301").fadeTo(0,0);$(".fade303").fadeTo(0,0);$(".fade305").fadeTo(0,0);$(document).scroll(function(){var $scrollTop=$(document).scrollTop();if($scrollTop>539){$(".fade301").fadeTo(1000,1);$(".rightS301").animate({right:0},900);};if($scrollTop>1339){$(".leftPosS301").animate({left:0},900);$(".fade302").animate({right:"-26px"},900);};if($scrollTop>1839){$(".fade303").fadeTo(1000,1);$(".rightS303").animate({right:0},900);};if($scrollTop>2339){$(".leftPosS302").animate({left:0},900);$(".fade304").animate({right:"-26px"},900);};if($scrollTop>2980){$(".fade305").fadeTo(1000,1);$(".rightS305").animate({right:0},900);};if($scrollTop>3439){$(".leftPosS303").animate({left:0},900);$(".fade306").animate({right:"-26px"},900);};});})
$(function(){$(".fade01").fadeTo(0,0);$(".fade03").fadeTo(0,0);$(".fade05").fadeTo(0,0);$(document).scroll(function(){var $scrollTop=$(document).scrollTop();if($scrollTop>539){$(".fade01").fadeTo(1000,1);$(".rightS01").animate({right:0},900);};if($scrollTop>900){$(".leftPosS01").animate({left:0},900);$(".fade02").animate({right:"-26px"},900);};if($scrollTop>1500){$(".fade03").fadeTo(1000,1);$(".rightS03").animate({right:0},900);};if($scrollTop>1900){$(".leftPosS02").animate({left:0},900);$(".fade04").animate({right:"-26px"},900);};if($scrollTop>2980){$(".fade05").fadeTo(1000,1);$(".rightS05").animate({right:-10},900);};if($scrollTop>3439){$(".leftPosS03").animate({left:0},900);$(".fade06").animate({right:"-26px"},900);};});})