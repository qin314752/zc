


$(document).ready(function(){						   
	//表格颜色
	$(".tableOdd").each(function(){
		$(this).find("tr:odd").addClass("tdColor");
	});
	$(".tableEven").each(function(){
		$(this).find("tr:even").addClass("tdColor");
	});
	
	//项目介绍左侧线条高度
	$("#details .item").each(function(){
		var detailsItem = $(this).height();
		$(this).find(".detailsLbor1").height(detailsItem);
	});	
	//单选
	$("#payment .label").each(function(){
		$(this).find("span").click(function(){
			$(this).siblings().removeClass("checked");
			$(this).addClass("checked");
		});
	});
});

//选项卡

function setTab(m,n){
var menu=document.getElementById("tabT"+m).getElementsByTagName("li");
var div=document.getElementById("tabB"+m).getElementsByTagName("div");
var showdiv=[];
for (i=0; j=div[i]; i++){
if ((" "+div[i].className+" ").indexOf(" tabBlock ")!=-1){	
	showdiv.push(div[i]);
}
}
for(i=0;i<menu.length;i++)
{
menu[i].className=i==n?"now":"";
showdiv[i].style.display=i==n?"Block":"none";
}
}
/*
$(function(){
	$("#kinMaxShow").kinMaxShow({
		height:356,
		button:{
			  normal:{
				  width:'10px',
				  height:'10px',
				  lineHeight:'10px',
				  left:'50%',
				  bottom:'10px',
				  fontSize:'10px',
				  background:"#fff",
				  border:"none",
				  borderRadius:"100px",
				  color:"#666666",
				  textAlign:'center',
				  fontFamily:"Verdana",
				  float:'left'},
			 focus:{background:"#0071df",border:"none",color:"#000000"}
		}
	});
	
});
*/
//幻灯
$(document).ready(function(){

	var on=$(".point li");
	var img=$(".img li");
	//自动播放
    var i=0;	
	var len=img.length;	
	var timer=setInterval(autoPlay,5000);		
	function autoPlay(){			
	if (i==len-1){
       i=0;
	   }
    else{
    i++;
	}
	play(i);
	}		
	function play(i){	    
			on.removeClass("current");			
			img.fadeOut(1000);     
			on.eq(i).addClass("current");		
			img.eq(i).fadeIn(3000);		
		}
		
    //清除自动播放
	$(".slide").mouseover(function(){
		clearInterval(timer);
		});
	$(".slide").mouseout(function(){
		timer=setInterval(autoPlay,5000);	
		});		
		
	//点击变化
	on.each(function(index){
		$(this).click(function(){
			on.removeClass("current");			
			img.fadeOut(1000);     
			on.eq(index).addClass("current");		
			img.eq(index).fadeIn(3000);
			});
		});
});


