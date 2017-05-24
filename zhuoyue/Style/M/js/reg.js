var arrBox = new Array();
arrBox["dvPhone"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请填写真实的手机号。";
arrBox["dvUser"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;4-20个字母、数字、汉字、下划线。";
arrBox["dvPwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;6-16个字母、数字、下划线。";
arrBox["dvRepwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请再一次输入您的密码。";
arrBox["dvRec"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;输入推荐人的用户名/手机号(可不填)。";
arrBox["dvCode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请按照图片显示内容输入验证码。";
arrBox["dvPcode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请填入接收到的手机验证码。";
arrBox["dvCard"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请填入真实的公民身份证号码。";
arrBox["dvRealName"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请填入真实姓名。";
arrBox["dvPinPass"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请输入交易密码。";
arrBox["dvRePinPass"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce1.gif'/>&nbsp;请输入交易确认密码。";


var arrWrong = new Array();
arrWrong["dvPhone"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;请输入真实的手机号。";
arrWrong["dvUser"] = "<img style='margin:3px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;4-20个字母、数字、汉字、下划线。";
arrWrong["dvPwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;6-16个字母、数字、下划线。";
arrWrong["dvRepwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;未输入或两次输入密码不同。";
arrWrong["dvRec"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;请输入推荐人的用户名/手机号。";
arrWrong["dvCode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;验证码位数输入不正确。";
arrWrong["dvPcode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;手机验证码不正确。";
arrWrong["dvCard"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;身份证号码格式不正确。";
arrWrong["dvRealName"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;请填入真实姓名。";
arrWrong["dvPinPass"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;交易密码格式不正确。";
arrWrong["dvRePinPass"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;交易确认密码不正确。";


var arrOk = new Array();
arrOk["dvPhone"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;手机号可用。";
arrOk["dvUser"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;用户名可用。";
arrOk["dvPwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;密码格式正确。";
arrOk["dvRepwd"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;密码格式正确。";
arrOk["dvRec"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;推荐人正确。";
arrOk["dvCode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;验证码正确。";
arrOk["dvPcode"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;手机验证码正确。";
arrOk["dvCard"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;身份证号码格式正确。";
arrOk["dvRealName"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;真实姓名已经填写。";
arrOk["dvPinPass"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;交易密码格式正确。";
arrOk["dvRePinPass"] = "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;交易确认密码正确。";

function Init() {
    $('#txtPhone').click(function() { ClickBox("dvPhone"); });
    $('#txtUser').click(function() { ClickBox("dvUser") });
    $('#txtPwd').click(function() { ClickBox("dvPwd") });
    $('#txtRepwd').click(function() { ClickBox("dvRepwd") });
	$('#txtRec').click(function() { ClickBox("dvRec") });
    $('#txtCode').click(function() { ClickBox("dvCode") });
    $('#txtPCode').click(function() { ClickBox("dvPcode") });
    $('#txtIdCard').click(function() { ClickBox("dvCard") });
    $('#txtRealName').click(function() { ClickBox("dvRealName") });
    $('#txtPinPass').click(function() { ClickBox("dvPinPass") });
    $('#txtRePinPass').click(function() { ClickBox("dvRePinPass") });


    $('#txtPhone').blur(function() { BlurEmail(); });
    $('#txtUser').blur(function() { BlurUName(); });
    $('#txtPwd').blur(function() { BlurPwd(); });
    $('#txtRepwd').blur(function() { BlurRepwd(); });
	$('#txtRec').blur(function() { BlurRec(); });
    $('#txtCode').blur(function() { BlurCode(); });
    $('#txtPCode').blur(function() { BlurPCode(); });
    $('#txtIdCard').blur(function() { BlurIdCard(); });
    $('#txtRealName').blur(function() { BlurRealName(); });
    $('#txtPinPass').blur(function() { BlurPinPass(); });
    $('#txtRePinPass').blur(function() { BlurRePinPass(); });

}

$(document).ready(
function() {
	$('#dvRec').html('<font style="color:#777"></font>');
    Init();
    $("#txt_phone").focus();
    //$("#Img1").click(function() { RegSubmit(this); });
    $("#txtCode").keypress(
    function(e) {
        if (e.keyCode == "13")
            $("#Img1").click();
    });
});

function strLength(as_str){
		return as_str.replace(/[^\x00-\xff]/g, 'xx').length;
}
function isLegal(str){
	if(/[!,#,$,%,^,&,*,?,~,\s+]/gi.test(str)) return false;
	return true;
}
function BlurUName() {
    var txt = "#txtUser";
    var td = "#dvUser";
    var pat = new RegExp("^[\\d|\\.a-z_A-Z|\\u4e00-\\u9fa5|\\x00-\\xff]$", "g");
    var str = $(txt).val();
    var strlen = strLength(str);

    if (isLegal(str) && strlen>=4 && strlen<=20&&str.indexOf('@')<0&&str.indexOf('!')<0) {
        $(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce0.gif'/>&nbsp;正在检测用户名……"));
        $.ajax({
            type: "post",
            async: false,
            url: "/member/common/ckuser/",
			dataType: "json",
            data: {"UserName":str},
            timeout: 3000,
            success: AsyncUname
        });
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvUser"]));
    }
}
function BlurRealName() {
    var txt = "#txtRealName";
    var td = "#dvRealName";
    //var pat = new RegExp("^[\\d|\\.a-z_A-Z|\\u4e00-\\u9fa5|\\x00-\\xff]$", "g");
    var str = $(txt).val();
    var strlen = strLength(str);

    if (isLegal(str) && strlen!=0 &&str.indexOf('@')<0&&str.indexOf('!')<0) {
        $(td).html(GetP("reg_info",arrOk["dvRealName"] ));
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvRealName"]));
    }
}
function BlurIdCard(){
    var txt = "#txtIdCard";
    var td = "#dvCard";
    var idcartValidResult = testIdcard($.trim($(txt).val()));
    if (idcartValidResult.indexOf('通过') == -1) {
        $(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;"+idcartValidResult));
    }else{
        $(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;"+idcartValidResult));
    }
}
var testIdcard = function(idcard) {
    var Errors = new Array("验证通过!", "身份证号码位数不对!", "身份证号码出生日期超出范围!", "身份证号码校验错误!", "身份证地区非法!");
    var area = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "xinjiang", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外" }
    var idcard, Y, JYM;
    var S, M;
    var idcard_array = new Array();
    idcard_array = idcard.split("");
    if (area[parseInt(idcard.substr(0, 2))] == null) return Errors[4];
    switch (idcard.length) {
        case 15:
            if ((parseInt(idcard.substr(6, 2)) + 1900) % 4 == 0 || ((parseInt(idcard.substr(6, 2)) + 1900) % 100 == 0 && (parseInt(idcard.substr(6, 2)) + 1900) % 4 == 0)) {
                ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/; //测试出生日期的合法性
            }
            else {
                ereg = /^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/; //测试出生日期的合法性
            }
            if (ereg.test(idcard))
                return Errors[0];
            else
                return Errors[2];
            break;
        case 18:
            if (parseInt(idcard.substr(6, 4)) % 4 == 0 || (parseInt(idcard.substr(6, 4)) % 100 == 0 && parseInt(idcard.substr(6, 4)) % 4 == 0)) {
                ereg = /^[1-9][0-9]{5}[0-9]{4}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/; //闰年出生日期的合法性正则表达式
            }
            else {
                ereg = /^[1-9][0-9]{5}[0-9]{4}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/; //平年出生日期的合法性正则表达式
            }
            if (ereg.test(idcard)) {
                S = (parseInt(idcard_array[0]) + parseInt(idcard_array[10])) * 7 + (parseInt(idcard_array[1]) + parseInt(idcard_array[11])) * 9 + (parseInt(idcard_array[2]) + parseInt(idcard_array[12])) * 10 + (parseInt(idcard_array[3]) + parseInt(idcard_array[13])) * 5 + (parseInt(idcard_array[4]) + parseInt(idcard_array[14])) * 8 + (parseInt(idcard_array[5]) + parseInt(idcard_array[15])) * 4 + (parseInt(idcard_array[6]) + parseInt(idcard_array[16])) * 2 + parseInt(idcard_array[7]) * 1 + parseInt(idcard_array[8]) * 6 + parseInt(idcard_array[9]) * 3;
                Y = S % 11;
                M = "F";
                JYM = "10X98765432";
                M = JYM.substr(Y, 1);
                if (M == idcard_array[17])
                    return Errors[0];
                else
                    return Errors[3];
            }
            else
                return Errors[2];
            break;
        default:
            return Errors[1];
            break;
    }
}
function BlurRec() {
    var txt = "#txtRec";
    var td = "#dvRec";
    var pat = new RegExp("^[a-zA-Z0-9_]*$", "g");
    var str = $(txt).val();
	
    var strlen = strLength(str);
	if (isLegal(str) && strlen>=3 && strlen<=20) {
		$(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce0.gif'/>&nbsp;正在检测推荐人……"));
		$.ajax({
			type: "post",
			async: false,
			url: "/member/common/ckInviteUser/",
			dataType: "json",
			data: {"InviteUserName":str},
			timeout: 3000,
			success: AsyncInviteUname
		}
		);
	}else if(str==''){
		$(td).empty();
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvRec"]));
    }
}
function AsyncUname(data) {
    if (data.status == "1") {
        $("#dvUser").html(GetP("reg_ok", arrOk["dvUser"]));
    }
    else {
        $("#dvUser").html(GetP("reg_wrong", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;此用户名已被注册。"));

    }

}
function AsyncInviteUname(data) {
    if (data.status == "1") {
        $("#dvRec").html(GetP("reg_ok", arrOk["dvRec"]));
    }
    else {
        $("#dvRec").html(GetP("reg_wrong", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;此推荐人不存在。"));

    }

}
function BlurEmail() {
    var txt = "#txtPhone";
    var td = "#dvPhone";
   // var pat = new RegExp("^[\\w-]+(\\.[\\w-]+)*@[\\w-]+(\\.[\\w-]+)+$", "i");
   //(86)*0*13\d{9}
    var pat = new RegExp("^1[3|4|5|8|7][0-9]\\d{8}$", "i");
    var str = $(txt).val();
    var strlen = strLength(str);
    //pat.test(str)
    if (pat.test(str)) {
        $(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce0.gif'/>&nbsp;正在检测手机号……"));
        $.ajax({
            type: "post",
            async: false,
			dataType: "json",
            url: "/member/common/ckphone/",
            data: {"Email":str},
            timeout: 3000,
            success: AsyncEmail
        });
    }
    else { $(td).html(GetP("reg_wrong", arrWrong["dvPhone"])); 
    }
}

function AsyncEmail(data) {
    if (data.status == "1") {
        $("#dvPhone").html(GetP("reg_ok", arrOk["dvPhone"]));
    }
     else {
       // $("#dvEmail").html(GetP("reg_wrong", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;邮箱已经在本站注册<a href='javascript:;' onlick='getPassWord();'>取回密码？</a>"));
		$("#dvPhone").html(GetP("reg_wrong", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;手机号已经在本站注册<a href='/member/common/getpwd/' target='_blank'>取回密码？</a>"));
    }
}

function getPassWord() {
	window.location.href = "/member/common/getpassword/";
	//window.location.href = "/member/common/getpwd/";
}

function BlurPwd() {
    var txt = "#txtPwd";
    var td = "#dvPwd";
    var pat = new RegExp("^.{6,20}$", "i");
    var str = $(txt).val();
    if (pat.test(str)) {
        //格式正确
        $(td).html(GetP("reg_ok", arrOk["dvPwd"]));
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvPwd"]));
    }
}

function BlurRepwd() {
    var txt = "#txtRepwd";
    var td = "#dvRepwd";
    var str = $(txt).val();
    if (str == $("#txtPwd").val() && str.length > 5) {
        //格式正确
        $(td).html(GetP("reg_ok", arrOk["dvRepwd"]));
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvRepwd"]));
    }
}
function BlurPinPass() {
    var txt = "#txtPinPass";
    var td = "#dvPinPass";
    var pat = new RegExp("^.{6,20}$", "i");
    var str = $(txt).val();
    if (pat.test(str)) {
        //格式正确
        $(td).html(GetP("reg_ok", arrOk["dvPinPass"]));
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvPinPass"]));
    }
}
function BlurRePinPass() {
    var txt = "#txtRePinPass";
    var td = "#dvRePinPass";
    var str = $(txt).val();
    if (str == $("#txtPinPass").val() && str.length > 5) {
        //格式正确
        $(td).html(GetP("reg_ok", arrOk["dvRePinPass"]));
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvRePinPass"]));
    }
}
//检验 验证码
function BlurCode() {
    var txt = "#txtCode";
    var td = "#dvCode";
    var pat = new RegExp("^[\\da-z]{4}$", "i");
    var str = $(txt).val();
    if (pat.test(str)) {
        //格式正确
        $.post("/member/common/ckcode/", { Action: "post", Cmd: "CheckVerCode", sVerCode: str }, AsyncVerCode);
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvCode"]));
    }
}
function BlurPCode() {
    var txt = "#txtPCode";
    var td = "#dvPcode";
    var pat = new RegExp("^[\\da-z]{6}$", "i");
    var str = $(txt).val();
    if (pat.test(str)) {
        //格式正确

        $.post("/member/common/ckpcode/", { Action: "post", Cmd: "CheckVerCode", sVerCode: str }, AsyncPVerCode);
    }
    else {
        $(td).html(GetP("reg_wrong", arrWrong["dvPcode"]));
    }
}
function AsyncPVerCode(data) {
    if (data == "1") {
        $("#dvPcode").addClass("reg_ok_");
        $("#dvPcode").html(GetP("reg_ok", arrOk["dvPcode"]));
    }
    else {
        $("#dvPcode").html(GetP("reg_wrong", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;验证码填写错误！"));
        //$("#dvCode").html(GetP("reg_wrong", arrBox["dvCode"]));
    }
}

function AsyncVerCode(data) {
    if (data == "1") {
        $("#dvCode").addClass("reg_ok_");
        $("#dvCode").html(GetP("reg_ok", arrOk["dvCode"]));
    }
    else {
        $("#dvCode").html(GetP("reg_wrong", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;验证码填写错误！"));
		//$("#dvCode").html(GetP("reg_wrong", arrBox["dvCode"]));
    }
}

function ClickBox(id) {
    var ele = '#' + id;
    $(ele).html(GetP("reg_info", arrBox[id]));
}

function GetP(clsName, c) {

    return "<div class='" + clsName + "'>" + c + "</div>";

}

function RegSubmit(ctrl) {
    $(ctrl).unbind("click");
    var arrTds = new Array("#dvPhone", "#dvPwd","#dvRepwd", "#dvPcode","#dvRec");
    BlurEmail();
    BlurRec();
    BlurPwd();
    BlurRepwd();
    BlurPCode();
    for (var i = 0; i < arrTds.length; i++) {
        if ($(arrTds[i]).html().indexOf('reg_wrong') > -1) {
            $(ctrl).click(function() { RegSubmit(this); });
            return false;
        }
    }
	
	var check = $("input[type='checkbox']").attr("checked");
	if(!check){
		$.jBox.tip("请确认服务协议");  
		return false;
  	}

	//$.jBox.tip("提交中......","loading");
	$.ajax({
		url: curpath+"/regaction/",
		data: {"txtPhone": $("#txtPhone").val(),"txtPwd": $("#txtPwd").val(),"txtRec": $("#txtRec").val(),"Pcode":$("#txtPCode").val(),"spread":$("#txtRec").val()},
		//timeout: 8000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==0){
					$.jBox.tip(d.message,"fail");
					//$(ctrl).click(function() { RegSubmit(this); });
				}else{
					//window.location.href="/member/verify/regverifyid";
					window.location.href="/member/index";//临时修改
				}
			}
		}
	});
}
function setIdCard() {
    var td = "#dvRealName";
    var realname = $('#txtRealName').val();
    var idcard = $('#txtIdCard').val();
    var arrTds = new Array("#dvRealName", "#dvCard");
    BlurRealName();
    //BlurUName();
    BlurIdCard();
    for (var i = 0; i < arrTds.length; i++) {
        if ($(arrTds[i]).html().indexOf('reg_wrong') > -1) {
            $(ctrl).click(function() { RegSubmit(this); });
            return false;
        }
    }
    //$.jBox.tip("验证身份信息中...","loading");
    $.ajax({
        url: "saveid/",
        type: "post",
        dataType: "json",
        data: {"realname":realname,"idcard":idcard},
        success: function(result) {
            if (result.status == "0") {
                $(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;"+result.message));
                $.jBox.tip("验证失败","fail");
                return false;
            }else{
                //$.jBox.tip("验证成功");
                window.location.href="/member/verify/setpinpass";
            }
        }
    });
}
function setPinPass() {
    var PinPass = $('#txtPinPass').val();
    var RePinPass = $('#txtRePinPass').val();
    var arrTds = new Array("#dvPinPass", "#dvRePinPass");
    BlurPinPass();
    BlurRePinPass();
    for (var i = 0; i < arrTds.length; i++) {
        if ($(arrTds[i]).html().indexOf('reg_wrong') > -1) {
            $(ctrl).click(function() { RegSubmit(this); });
            return false;
        }
    }
    if(PinPass!=RePinPass){
        return false;
    }
    $.jBox.tip("验证身份信息中...","loading");
    $.ajax({
        url: "savepinpass/",
        type: "post",
        dataType: "json",
        data: {"pinpass":PinPass},
        success: function(result) {
            if (result.status == "0") {
                $.jBox.tip(result.message,"fail");
                return false;
            }
            else {
                $.jBox.tip("交易密码设置成功");
                window.location.href="/member/verify/register3";
            }
        }
    });
}
function myrefresh()
{
	   window.location.href="/member/";
}
function AsyncReg(data) {
    Close_Dialog_AutoClose();
    if (data == "True") {
        suc();
    }
    else { }
}

function AsyncReg_Back() { window.location.href = "/member/"; }