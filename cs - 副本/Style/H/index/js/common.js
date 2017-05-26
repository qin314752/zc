/*
 * Copyright 2010-2015 icl-network.com. All rights reserved.
 * Support: http://www.icl-network.com
 * 
 * JavaScript - Common
 * Version: 3.0
 */

//微信关注
$(document).ready(function(){
	var $weixin = $("#weixin");
	var $weixinQrcode = $("#weixinQrcode");
	$weixin.click(function(){
		$weixinQrcode.show("slow");
	});
	$weixinQrcode.mouseout(function() {
		$weixinQrcode.hide("slow");
	});
	
	var $xlwb = $("#xlwb");
	var $xlwbQrcode = $("#xlwbQrcode");
	$xlwb.click(function(){
		$xlwbQrcode.show("slow");
	});
	$xlwbQrcode.mouseout(function() {
		$xlwbQrcode.hide("slow");
	});
	
	var $txwb = $("#txwb");
	var $txwbQrcode = $("#txwbQrcode");
	$txwb.click(function(){
		$txwbQrcode.show("slow");
	});
	$txwbQrcode.mouseout(function() {
		$txwbQrcode.hide("slow");
	});
});

var setting = {
	base: "",
	locale: "zh_CN",
	currencyScale: "2",
	currencyRoundType: "roundDown",
	currencySign: "￥",
	currencyUnit: "",
	uploadImageExtension: "jpg,jpeg,bmp,gif,png,JPG,JPEG,BMP,GIF,PNG",
	uploadFlashExtension: "swf,flv,SWF,FLV",
	uploadMediaExtension: "swf,flv,mp3,wav,avi,rm,rmvb,SWF,FLV,MP3,WAV,AVI,RM,RMVB,MP4,mp4",
	uploadFileExtension: "zip,rar,7z,doc,docx,xls,xlsx,ppt,pptx,ZIP,RAR,7Z,DOC,DOCX,XLS,XLSX,PPT,PPTX"
};

function currency(value, showSign, showUnit) {
	if (value != null) {
		var currency;
		if (setting.currencyRoundType == "roundHalfUp") {
			currency = (Math.round(value * Math.pow(10, setting.currencyScale)) / Math.pow(10, setting.currencyScale)).toFixed(setting.currencyScale);
		} else if (setting.currencyRoundType == "roundUp") {
			currency = (Math.ceil(value * Math.pow(10, setting.currencyScale)) / Math.pow(10, setting.currencyScale)).toFixed(setting.currencyScale);
		} else {
			currency = (Math.floor(value * Math.pow(10, setting.currencyScale)) / Math.pow(10, setting.currencyScale)).toFixed(setting.currencyScale);
		}
		if (showSign) {
			currency = setting.currencySign + currency;
		}
		if (showUnit) {
			currency += setting.currencyUnit;
		}
		return currency;
	}
}

function addFavorite(url, title) {
	if (document.all) {
		window.external.addFavorite(url, title);
	} else if (window.sidebar) {
		window.sidebar.addPanel(title, url, "");
	}
}

function htmlEscape(htmlString) {
    htmlString = htmlString.replace(/&/g, '&amp;');
    htmlString = htmlString.replace(/'/g, '&acute;');
    htmlString = htmlString.replace(/"/g, '&quot;');
    htmlString = htmlString.replace(/\|/g, '&brvbar;');
    htmlString = htmlString.replace(/</g, '&lt;');
    htmlString = htmlString.replace('script', '&#x73;cript');
    htmlString = htmlString.replace(/>/g, '&gt;');
    return htmlString;
}

function setCookie(name, value) {
	var expires = (arguments.length > 2) ? arguments[2] : null;
	document.cookie = name + "=" + encodeURIComponent(value) + ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) + ";path=" + setting.base;
}

function getCookie(name) {
	var value = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	if (value != null) {
		return decodeURIComponent(value[2]);
 	} else {
		return null;
	}
}

function removeCookie(name) {
	var expires = new Date();
	expires.setTime(expires.getTime() - 1000 * 60);
	setCookie(name, "", expires);
}

function floatAdd(arg1, arg2) {
	var r1, r2, m;
	try{
		r1 = arg1.toString().split(".")[1].length;
	} catch(e) {
		r1 = 0;
	}
	try {
		r2 = arg2.toString().split(".")[1].length;
	} catch(e) {
		r2 = 0;
	}
	m = Math.pow(10, Math.max(r1, r2));
	return (arg1 * m + arg2 * m) / m;
}

function floatSub(arg1, arg2) {
	var r1, r2, m, n;
	try {
		r1 = arg1.toString().split(".")[1].length;
	} catch(e) {
		r1 = 0;
	}
	try {
		r2 = arg2.toString().split(".")[1].length;
	} catch(e) {
		r2 = 0;
	}
	m = Math.pow(10, Math.max(r1, r2));
	n = (r1 >= r2) ? r1 : r2;
	return ((arg1 * m - arg2 * m) / m).toFixed(n);
}

function floatMul(arg1, arg2) {    
	var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
	try {
		m += s1.split(".")[1].length;
	} catch(e) {}
	try {
		m += s2.split(".")[1].length;
	} catch(e) {}
	return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m);
}

function floatDiv(arg1, arg2) {
	var t1 = 0, t2 = 0, r1, r2;    
	try {
		t1 = arg1.toString().split(".")[1].length;
	} catch(e) {}
	try {
		t2 = arg2.toString().split(".")[1].length;
	} catch(e) {}
	with(Math) {
		r1 = Number(arg1.toString().replace(".", ""));
		r2 = Number(arg2.toString().replace(".", ""));
		return (r1 / r2) * pow(10, t2 - t1);
	}
}

$().ready(function() {

	var $logined = $("#logined");
	var $unlogin = $("#unlogin");
	var $headerUsernameText = $("#headerUsernameText");
	var username = $.cookie("P2PUsername");
	if (username != null) {
		$headerUsernameText.text(username).show();
		$logined.show();
		$unlogin.hide();
	}

	$.checkLogin = function() {
		var result = false;
		$.ajax({
			url: "/login/check",
			type: "get",
			dataType: "json",
			cache: false,
			async: false,
			success: function(data) {
				result = data;
			}
		});
		return result;
	};

	var $document = $(document);
	
	$document.ajaxSend(function(event, request, settings) {
		if (!settings.crossDomain && settings.type != null && settings.type.toLowerCase() != "get") {
			var token = $.cookie("token");
			if (token != null) {
				request.setRequestHeader("token", token);
			}
		}
	});
	
	$document.ajaxComplete(function(event, request, settings) {
		var loginStatus = request.getResponseHeader("loginStatus");
		var tokenStatus = request.getResponseHeader("tokenStatus");
		
		if (loginStatus == "accessDenied") {
			$.redirectLogin(location.href, "登录超时，请重新登录");
		} else if (tokenStatus == "accessDenied") {
			var token = getCookie("token");
			if (token != null) {
				$.extend(settings, {global: false, headers: {token: token}});
				$.ajax(settings);
			}
		}
		
	});
	
	$("form").submit(function() {
		var $this = $(this);
		var method = $this.prop("method");
		if (method != null && method.toLowerCase() != "get" && $this.find("input[name=token]").size() == 0) {
			var token = $.cookie("token");
			if (token != null) {
				$this.append("<input type=\"hidden\" name=\"token\" value=\"" + token + "\" \/>");
			}
		}
	});
	
	$disableButton = function(button, seconds) {
		var previousValue = button.val();
		var className = button.attr("disableClassName");
		var promptValueSuffix = button.attr("disablePromptValueSuffix");
		var promptValue = seconds + "秒" + promptValueSuffix;
		button.prop("disabled", true);
		button.addClass(className);
		button.val(promptValue);
		intervalId = window.setInterval(function() {
			seconds -= 1;
			promptValue = seconds + "秒" + promptValueSuffix;
			button.val(promptValue);
			if(seconds == 0) {
				window.clearInterval(intervalId);
				button.prop("disabled", false);
				button.removeClass(className);
				button.val(previousValue);
			}
		}, 1000);
	};
	
	$("#sign_in").click(function() {
		$.ajax({
			url: "/account/integral/sign_in",
			data: null,
			type: "post",
			dataType: "json",
			cache: false,
			beforeSend: function(request, settings) {
				request.setRequestHeader("token", $.cookie("token"));
			},
			success: function(message) {
				if (message.type == "success") {
					layer.msg('签到成功，积分+1', {icon: 1,time: 2000}, function(){
						$("#sign_in").attr("disabled","disabled").html("已签到");
					});
				} else {
					layer.msg(message.cont, {icon: 1,time: 2000}, function(){
						$("#sign_in").attr("disabled","disabled").html("已签到");
					});
				}
			}
		});
	});
	

});