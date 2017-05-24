﻿var arrBox = new Array();
//arrBox["dvUser"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请填写用户名或者邮件";
arrBox["dvUser"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请填写用户名或者手机号";
arrBox["dvCode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请按照图片显示内容输入验证码。";
arrBox["dvPwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请填写您的密码";

var arrWrong = new Array();
arrWrong["dvUser"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;用户名填写错误。";
arrWrong["dvCode"] = "<img style='margin:3px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;验证码填写错误！";
arrWrong["dvPwd"] = "<img style='margin:3px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;密码填写错误！";

arrWrong["login"] = "<img style='margin:3px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;用户名或密码填写错误！";

arrWrong["code"] = "<img style='margin:3px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;用户名或密码填写错误！";
var arrOk = new Array();

arrOk["dvUser"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;用户名填写格式正确。";
arrOk["dvPwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;密码填写格式正确。";
arrOk["dvCode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;验证码填写格式正确。";



function Init() {

    $('#txtUser').click(function() { ClickBox("dvUser"); });
    $('#txtPwd').click(function() { ClickBox("dvPwd"); });

    $('#txtCode').click(function() { ClickBox("dvCode"); });
    $('#txtCode').blur(function() { BlurCode(); });

    $('#txtUser').blur(function() { BlurEmail(); });
    $('#txtPwd').blur(function() { BlurPwd(); });

    var title = $('#txtUser').attr("title");
    $('#txtUser').val(title).css("color", "#8D8C8C").click(function() {
        if ($(this).val() == title)
        { $(this).val("").css("color", "#000"); }
    }).blur(function() {
        if ($(this).val().length < 1)
        { $(this).val(title).css("color", "#8D8C8C"); }
    });
}

function BlurCode() {

    var txt = "#txtCode";
    var td = "#dvUser";
    var pat = new RegExp("^[\\da-z]{4}$", "i");
    var str = $(txt).val();
    if (pat.test(str)) {
        $("#dvCode").addClass("reg_ok_");
        $("#dvCode").html(GetP("reg_ok", arrOk["dvCode"]));
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvCode"]));
		return "1";
    }
}

function strLength(as_str){
		return as_str.replace(/[^\x00-\xff]/g, 'xx').length;
}
function isLegal(str){
	if(/[!,#,$,%,^,&,*,?,~,\s+]/gi.test(str)) return false;
	return true;
}

function BlurEmail() {
    var txt = "#txtUser";
    var td = "#dvUser";
    //var pat1 = new RegExp("^[\\d\\.a-z_A-Z]{4,20}$", "i");
	var pat1 = new RegExp("^[\\d\\.a-z_A-Z]{4,20}|[\u4e00-\u9fa5]$", "i");
    var str = $(txt).val();
    var pat2 = new RegExp("^[\\w-]+(\\.[\\w-]+)*@[\\w-]+(\\.[\\w-]+)+$", "i");
	strlen = strLength(str);
	
    if (!isLegal(str) || strlen<4 || strlen>20) {
        $(td).html(GetP("reg_wrong", arrWrong["dvUser"]));
        return "1";
    }
    $("#dvUser").html(GetP("reg_ok", arrOk["dvUser"]));
}

function BlurPwd() {
    var txt = "#txtPwd";
    var td = "#dvUser";
    var pat = new RegExp("^.{6,}$", "i");
    var str = $(txt).val();
    if (pat.test(str)) {
        //格式正确
        $(td).html(GetP("reg_ok", arrOk["dvPwd"]));
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvPwd"]));
		return "1";
    }
}

(function($) {
    $(function() {
        Init();
        //$("#txtUser").focus();
        $("#form1").keypress(
        function(e) {
            if (e.keyCode == "13")
                $("#btnReg").click();
        });
    });
})(jQuery);

function ClickBox(id) {
    var ele = '#' + id;
    $(ele).html(GetP("reg_info", arrBox[id]));
}

function GetP(clsName, c) { return "<div class='" + clsName + "'>" + c + "</div>"; }

function LoginSubmit(ctrl) {
	//alert(ctrl);
    $(ctrl).unbind("click");
    var arrTds = new Array("#dvUser", "#dvPwd", "#dvCode");
    var bemail = BlurEmail();
    var bpwd = BlurPwd();
    var bcode = BlurCode();
    if(bemail == '1' || bpwd == '1' || bcode == '1'){
	    //$(ctrl).click(function() { LoginSubmit(this); });
        return false;
	}
    var keep = 0;
    if ($("#states").attr("checked") == true) {
        keep = 1;
    }
	
	$.jBox.tip("登录中......",'loading');
    //alert(curpath);
	$.ajax({
		url: curpath+"/actlogin/",
		data: {"sUserName": $("#txtUser").val(),"sPassword": $("#txtPwd").val(),"sVerCode": $("#txtCode").val()},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==0){
					$.jBox.tip(d.message,"tip");	
				}else{
					window.location.href="/member/";
				}
			}
		}
	});
}
