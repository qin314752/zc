function plus(id){
	var cnum = parseInt($("#tnum_"+id).val());
	cnum++;
	$("#tnum_"+id).val(cnum+'份');
}
function minus(id){
	var cnum = parseInt($("#tnum_"+id).val());
	cnum=(cnum-1)>0?(cnum-1):1;
	$("#tnum_"+id).val(cnum+'份');
}

function round2(floatData,i){
	var i=i+1;
	var floatStr = (floatData)+"";
	var index = floatStr.indexOf(".");
	if(index!=-1){
			return floatStr.substring(0,(index+i));	
	}
	else
		return floatStr;
}


/*企业直投流程*/

var T_transfer_num = 0;
var T_month_min = 0;
var T_month_max = 0;
function Transfer(id){
	var num = $("#tnum_"+id).val();
	
	$.jBox("get:"+Transfer_invest_url+"/ajax_invest?id="+id+"&num="+num, {title: "立即投标",buttons: {}});
}
function FTransfer(id){
	var chooseWay = $("input[name='radios']:checked").val();
	if(chooseWay==null){
		alert("请选择利息使用方式！");
    	return;
	}
	var num = $("#tnum_"+id).val();
	$.jBox("get:"+Transfer_invest_url+"/ajax_invest?id="+id+"&num="+num+"&chooseWay="+chooseWay, {
		title: "立即投标",
		width: "auto",
		buttons: {}
	});
}
function tanchu(id,ziduan){
	
	$.jBox("get:"+Transfer_invest_url+"/ajax_tanchu?id="+id+"&ziduan="+ziduan, {title: "详情",buttons: {}});
}
function sumTMoney(obj){
	obj.value=obj.value.replace(/[^0-9]/g,'');
	var tnum = parseInt($("#transfer_invest_num").val());
	var per = parseInt($("#per_transfer").val());
	var total = tnum*per;
		total = isNaN(total)?0:total;
	$("#total_transfer_money").html(total);
}

function showTMoney(rate,reward_rate,increase_rate,month1){
	var tnum = parseInt($("#transfer_invest_num").val());
	var per = parseInt($("#per_transfer").val());
	var month = parseInt($("#transfer_invest_month").val());
		month = isNaN(month)?0:month;
	var total = tnum*per;
		total = isNaN(total)?0:total;
	
	var interest_rate = parseFloat(rate)+month*parseFloat(increase_rate);
	var interest = parseFloat(interest_rate)*total*month/(12*100);
	var reward = parseFloat(reward_rate)*total/100;
	$("#year_interest").html(interest_rate);
	$("#except_income").html("￥"+round2((interest+reward),2));
	$("#interest_income").html("￥"+round2(interest,2));
	$("#reward_income").html("￥"+round2(reward,2));
}
function showFMoney(rate,reward_rate,increase_rate,chooseway,shouyi4,shouyi6){
	var tnum = parseInt($("#transfer_invest_num").val());
	var per = parseInt($("#per_transfer").val());
	var month = parseInt($("#transfer_invest_month").val());
		month = isNaN(month)?0:month;
	var total = tnum*per;
		total = isNaN(total)?0:total;
	var chooseway = parseInt(chooseway)
	//var mujiqi = parseFloat(total*leftday*(rate/365)/100);
	
	var interest_rate = parseFloat(rate);
	//var interest = parseFloat(interest_rate)*total*month/(12*100);
	var interest;
	if(chooseway == 4){
	    interest = parseFloat(tnum*shouyi4);
	}else if(chooseway == 6){
	    interest = parseFloat(tnum*shouyi6);
	}
	var reward = parseFloat(reward_rate)*total/100;
	$("#year_interest").html(interest_rate);
	//$("#except_income").html("￥"+round2((interest+mujiqi+reward),2));
	$("#except_income").html("￥"+round2((interest+reward),2));
	$("#interest_income").html("￥"+round2(interest,2));
	$("#reward_income").html("￥"+round2(reward,2));
}
function T_PostData(tnum,month,per) {
	var tnum = parseInt($("#transfer_invest_num").val());
	var per = parseInt($("#per_transfer").val());
	var month = parseInt($("#transfer_invest_month").val());
	if(tnum<1){
		$.jBox.tip("购买份数必须大于等于1份！");  
		return false;
	}
	var total = tnum*per;
		tendValue = isNaN(total)?0:total;
  var pin = $("#T_pin").val();
  var borrow_id = $("#T_borrow_id").val();
  if(pin==""){
	$.jBox.tip("请输入支付密码");  
	return false;
  }
  if(tnum>T_transfer_num){
	$.jBox.tip("本标还能认购最大份数为"+T_transfer_num+"份，请重新输入认购份数");  
	return false;
  }else if(T_month_max<month){
	$.jBox.tip("本标最多只能认购"+T_month_max+"个月");  
	return false;
  }
  $.ajax({
	  url: Transfer_invest_url+"/investcheck",
	  type: "post",
	  dataType: "json",
	  data: {"tnum":tnum,"month":month,'pin':pin,'borrow_id':borrow_id},
	  success: function(d) {
			  if (d.status == 1) {
				  investmoney = tendValue;
				  $.jBox.confirm(d.message, "会员投标提示", isinvest, { buttons: { '确认投标': true, '暂不投标': false},top:'40%' });
			  }
			  else if(d.status == 2)// 无担保贷款多次提醒
			  {
				  $.jBox.confirm(d.message, "会员投标提示", ischarge, { buttons: { '去充值': true, '暂不充值': false},top:'40%' });
			  }
			  else if(d.status == 3)// 无担保贷款多次提醒
			  {
				  $.jBox.alert(d.message, '会员投标提示',{top:'40%'});
			  }else{
				  $.jBox.tip(d.message);  
			  }
	  }
  });
}

function ischarge(d){
	if(d===true) window.location.href="/member/charge#fragment-1";
}
function isinvest(d){
	if(d===true) document.forms.investForm.submit();
}
/*企业直投流程*/
function bindpagebar(){
	$('.ajaxpagebar a').unbind().click(function(){
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
