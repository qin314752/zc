//正则表达式
var authRegExp = {
    trim: "^\s*|\s*$", //整数
    integer: "^-?[1-9]\\d*$", //整数
    integer1: "^[1-9]\\d*$", //正整数
    integer2: "^-[1-9]\\d*$", //负整数
    number: "^([+-]?)\\d*\\.?\\d+$", //数字
    number1: "^[1-9]\\d*|0$", //正数（正整数 + 0）
    number2: "^-[1-9]\\d*|0$", //负数（负整数 + 0）
    decimal: "^([+-]?)\\d*\\.\\d+$", //浮点数
    decimal1: "^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$", //正浮点数
    decimal2: "^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$", //负浮点数
    decimal3: "^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$", //浮点数
    decimal4: "^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$", //非负浮点数（正浮点数 + 0）
    decimal5: "^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$", //非正浮点数（负浮点数 + 0）
    ascii: "^[\\x00-\\xFF]+$", //仅ACSII字符
    chinese: "^[\\u4e00-\\u9fa5]+$", //仅中文
    color: "^[a-fA-F0-9]{6}$", //颜色
    date: "^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$", //日期
    email: "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$", //邮件
    idcard: "/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/",//身份证


    ip4: "^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$", //ip地址
    letter: "^[A-Za-z]+$", //字母
    letterL: "^[a-z]+$", //小写字母
    letterU: "^[A-Z]+$", //大写字母
    mobile: "^((13[0-9])|(15[^4,\\D])|(17[0-9])|(18[0-9])|(147))\\d{8}$", //手机
    password: "^.*[A-Za-z0-9\\w_-]+.*$", //密码
    fullNumber: "^[0-9]+$", //数字
    picture: "(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$", //图片
    qq: "^[1-9]*[1-9][0-9]*$", //QQ号码
    rar: "(.*)\\.(rar|zip|7zip|tgz)$", //压缩文件
    tel: "^[0-9\-()（）]{7,18}$", //电话号码的函数(包括验证国内区号,国际区号,分机号)
    url: "^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$", //url
    username: "^[A-Za-z0-9_\\-\\u4e00-\\u9fa5]+$", //用户名
    realname: "^[A-Za-z\\u4e00-\\u9fa5]+$", // 真实姓名
    zipcode: "^\\d{6}$", //邮编
    notempty: "^\\S+$", //非空
    removedot: /,/g, //去掉逗号
    letternum: "^[0-9a-zA-Z]",
    money: "^[0-9]+(.[0-9]{1,2})?$"
};


var authRules = {
    isNull: function (str) {
        return (str == "" || typeof str != "string");
    },
    //去掉非数字
    removedot: function (str) {
        var num = str.replace(/[^\d\.]+/g, "");
        if (!authRules.integer1(num))
            return Number(num);
        else
            return num;
    },
    //验证密码
    Password:function (str) {
        return new RegExp(authRegExp.password).test(str);
    },
    //去掉0
    removeZeor: function (number) {
        var reslut = number.toString();
        if ((/\.+/).test(reslut)) {
            reslut = reslut.replace(/0+?$/g, "").replace(/[\.]$/g, "");
        }
        return reslut;
    },

    //去掉非数字 undefined 
    removeUnNum: function (str) {
        var num = str.replace(/[^\d]+/g, "");
        if (!authRules.integer1(num))
            return Number(num);
        else
            return num;
    },
    trim: function (str) {
        return str.replace(/(^\s*)|(\s*$)/g, "");
    },
    integer1: function (str) {
        return new RegExp(authRegExp.integer1).test(str);
    },
    integer2: function (str) {
        return new RegExp(authRegExp.integer2).test(str);
    },
    money: function (str) {
        return new RegExp(authRegExp.money).test(str);
    },
    betweenLength: function (str, _min, _max) {
        return (str.length >= _min && str.length <= _max);
    },
    isUid: function (str) {
        return new RegExp(authRegExp.username).test(str);
    },
    fullNumberName: function (str) {
        return new RegExp(authRegExp.fullNumber).test(str);
    },
    letternum: function (str) {
        return new RegExp(authRegExp.letternum).test(str);
    },
    isPwd: function (str) {
        return /^.*([\W_a-zA-z0-9-])+.*$/i.test(str);
    },
    isPwdRepeat: function (str1, str2) {
        return (str1 == str2);
    },
    isEmail: function (str) {
        return new RegExp(authRegExp.email).test(str);
    },
    isUrl: function (str) {
        return new RegExp(authRegExp.url).test(str);
    },
    isTel: function (str) {
        return new RegExp(authRegExp.tel).test(str);
    },
    isMobile: function (str) {
        return new RegExp(authRegExp.mobile).test(str);
    },
    checkType: function (element) {
        return (element.attr("type") == "checkbox" || element.attr("type") == "radio" || element.attr("rel") == "select");
    },
    isRealName: function (str) {
        return new RegExp(authRegExp.realname).test(str);
    },
    removeQfw: function (str) {
        return str.replace(authRegExp.removedot, "");
    },
    isIdCard: function (str) {
        return new RegExp(authRegExp.idcard).test(str);
    },
    chkNumberTimes: function (str, times) {
        //是否是整数
        var result = false;

        if (Number(str) % times != 0)
            result = false;
        else
            result = true;

        return result;
    }
};

/**
 * Created by lll on 2016/7/26.
 */
var remain_amount = parseInt($("#my_param").attr('data-remain_amount'));
var beforehand = (parseInt($("#my_param").attr('data-beforehand')) == 0) ? 1 : parseInt($("#my_param").attr('data-beforehand'));
var user_id = (parseInt($("#my_param").attr('data-user_id')) == 0) ? 0 : parseInt($("#my_param").attr('data-user_id'));
var price = parseInt($('#price').text());
var part_price = parseInt($("#my_param").attr('data-price'));
var balance = parseInt($("#my_param").attr('data-balance')); 
//投资导航选中
function Investnav() {
    var list = new Array("car", "second-hands", "float-income", "fixed-income", "parallel-imports");
    var path = GetQueryString("category");

    for (var i = 0; i < list.length; i++) {
        if (list[i] == path) {
            $(".plan").find("a").eq(i).addClass("focus").siblings().removeClass("focus");
        }
    }
}
//初始化输入框数量值
function getSkuNum() {
    var partCount = parseInt($("#my_param").attr('data-remain'));//剩余份数  
    var num = (parseInt($("#skuNum").val()) != 0) ? parseInt($("#skuNum").val()) : 1;//输入框数量
    var maximum = parseInt($("#my_param").attr('data-maximum') / part_price);//最大限额可购买数量
    var balanceCount = (parseInt(balance / part_price) != 0) ? parseInt(balance / part_price) : 1;//余额可购买数量
    var result = (maximum == 0) ? Math.min(partCount,parseInt(beforehand / part_price), balanceCount) : Math.min(partCount,parseInt(beforehand / part_price), maximum, balanceCount);//得出最小值
    result = (result == 0) ? 1 : result;
    $("#skuNum").val(result);
    $("#investamount").text((result * $("#subtotal").text().split("元")[0]) + "元");
}


function bar(_obj, wid) {
    var w = _obj.text().replace("%", "") * wid * 0.01;
    _obj.parent().find(".barcurrent").animate({width: w + "px"});
}
//增加按钮
function addSkuNum(obj) {
    var partCount = parseInt($("#my_param").attr('data-remain'));
    var skuNum = parseInt($("#skuNum").val()) + 1;
    var balanceNum = parseInt(balance / part_price);
    if (user_id == 0) {
        $("#skuNum").val(skuNum);
        $("#investamount").text((skuNum * $("#subtotal").text().split("元")[0]) + "元");
        return false;
    } else {
        if (parseInt($("#my_param").attr('data-maximum')) != 0) {
            if ((skuNum * part_price) > parseInt($("#my_param").attr('data-maximum'))) {
                $(".tips-info").text('投资金额超过最大限额');
                funtips();
                return false;
            }
        }
        if (skuNum > partCount) {
            $(".tips-info").text('投资份数超过最大值');
            funtips();
            return false;
        }
        if (skuNum > balanceNum) {
            if (obj == 'newbie') {
                $(".tips-info").text('体验金余额不足');
            } else {
                $(".tips-info").html('投资金额大于账户余额' + "<a  href=\"/account?type=management&style=deposit\">去充值</a>");
            }
            funtips();
            return false;
        } else {
            $("#skuNum").val(skuNum);
            $("#investamount").text((skuNum * $("#subtotal").text().split("元")[0]) + "元");
        }
    }
}

//监听输入框数量
function inputSkuNum(obj) {
    var partCount = parseInt($("#my_param").attr('data-remain'));//剩余份数
    var num = (parseInt($("#skuNum").val()) != 0 && $("#skuNum").val().trim()!="") ? parseInt($("#skuNum").val()) : 1;//输入框数量
    var maximum = parseInt($("#my_param").attr('data-maximum') / part_price);//最大限额可购买数量
    var balanceCount = (parseInt(balance / part_price) != 0) ? parseInt(balance / part_price) : 1;//余额可购买数量
    var result = (maximum == 0) ? Math.min(partCount, balanceCount) : Math.min(partCount, maximum, balanceCount);//得出最小值
    result = (result == 0) ? 1 : result;
    if (user_id == 0) {
        $("#skuNum").val(num);
        $("#investamount").text((num * $("#subtotal").text().split("元")[0]) + "元");
        return false;
    } else {
        if (num > result) {
            $("#skuNum").val(result);
            $("#investamount").text((result * $("#subtotal").text().split("元")[0]) + "元");
            if (maximum == 0) {
                if (result == partCount) {
                    $(".tips-info").text('投资份数超过最大值');
                    funtips();
                    return false;
                } else if (result == balanceCount) {
                    if (obj == 'newbie') {
                        $(".tips-info").text('体验金余额不足');
                    } else {
                        $(".tips-info").html('投资金额大于账户余额' + "<a  href=\"/account?type=management&style=deposit\">去充值</a>");
                    }
                    funtips();
                    return false;
                }
            } else {
                $(".tips-info").text('投资金额超过最大限额');
                funtips();
                return false;
            }
        } else {
            $("#skuNum").val(num);
            $("#investamount").text((num * $("#subtotal").text().split("元")[0]) + "元");
            return false;
        }
    }

}
//弹幕
function funtips() {
    $(".tips-info").fadeIn();
    var f = setTimeout(function () {
        $(".tips-info").fadeOut()
    }, 3000);
    $(".tips-info").hover(function () {
        clearTimeout(f);
    }, function () {
        $(".tips-info").fadeOut();
    })
}
$(document).ready(function () {
    Investnav();
    updateEndTime();
    getSkuNum();
    //减少按钮
    $("#reduceSkuNum").click(function () {
        var reduceNum = $("#skuNum").val();
        if (reduceNum > 1) {
            $("#skuNum").val(reduceNum - 1);
            $("#investamount").text(($("#skuNum").val() * $("#subtotal").text().split("元")[0]) + "元");
        } else {
            $("#skuNum").val(1);
        }
    })

})
//投标详情页js  ----2016-07-21---------
window.onscroll = function () { 
    var t = document.documentElement.scrollTop || document.body.scrollTop;
    var w = 0; 
    if (($(window).width() - 1108) > 0)
        w = ($(window).width() - 1108) / 2;

    if (t >= 500 ) {
    	$(".hd-bg").fadeIn();
        $(".hd-bg").css({"height": "60px", "box-shadow": "0 0 6px rgba(0,0,0,0.2)"});
        $(".ul-nav").css({"position": "absolute", "z-index": "2"});
        $(".nav").addClass("am-sticky").css("left", w + "px");
        $(".nav .am-btn").css("display", "block");
        $(".tabs-1,.tabs-2").css("margin-top", "80px");

    } else { 
    	$(".hd-bg").fadeOut();
        $(".hd-bg").css({"height": "0px", "box-shadow": "0 0 0 rgba(0,0,0,0)"});
        $(".ul-nav,.nav").removeClass("am-sticky");
        $(".ul-nav").css("position", "relative");
        $(".nav .am-btn").css("display", "none");
        $(".tabs-1,.tabs-2").css("margin-top", "0");

    }
}
$('.ul-nav li').click(function () {
   $('html, body').animate({scrollTop: 500}, '250');
    $(this).siblings().removeClass("focus");
    $(this).addClass("focus");
    for (var i = 1; i < $('.ul-nav li').length + 1; i++) {
        if (i == $(this).index() + 1)
            $(".tabs-" + i).fadeIn();
        else
            $(".tabs-" + i).fadeOut();
    }
})

//投标
function goBid(obj) {
    //数量为0变为1
    if (parseInt($("#skuNum").val()) == '0') {
        $("#skuNum").val(1);
        $("#investamount").text((1 * $("#subtotal").text().split("元")[0]) + "元");
        $(".tips-info").text('最小份额为1份');
        funtips();
        return false;
    }
    var endTime = $(".settime").text(); //结束时间字符串
    if (endTime.trim() != '' ) {
        if (endTime.split("天")[0] != 0 || endTime.split("天")[1].split("小时")[0] != 0 || endTime.split("天")[1].split("小时")[1].split("分")[0] != 0 || endTime.split("天")[1].split("小时")[1].split("分")[1].split("秒")[0] != 0) {
            layer.msg('众筹尚未开始', {
                time: 2000,
                icon: 2
            });
            return false;
        }
    }
    $("#goBid").html('处理中<span class=\"dotting\"></span>');
    $("#goBid").attr('disabled', true).addClass("unabled");
    var url = '';
    if (obj == 'cf') {
        //正式标
        url = $("#my_param").attr("data-url");
    } else {
        //体验标
        url = "/newbie/crowdfunding/" + $("#my_param").attr('data-id') + "/pay";
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {
            part_count: parseInt($("#skuNum").val()),
            _token: $("#my_param").attr('data-token')
        },
        success: function (data) {
            $("#goBid").text('立即投资');
            $("#goBid").attr('disabled', false).removeClass("unabled");
            if (obj == 'cf') {
                layer.confirm('<i class="layui-layer-ico layui-layer-ico1"></i><span style=\"padding-left:33px\">支付成功</span>', {
                    skin: 'layer-ext-moon',
                    closeBtn: 0,
                    btn: ['确认', '前往我的理财'], //按钮
                    title: '消息'
                }, function () {
                    //window.location.href = location.href;
                    location.reload();
                }, function () {
                    window.location.href = "/account?type=assets";
                });
            } else {
                layer.confirm('<i class="layui-layer-ico layui-layer-ico1"></i><span style=\"padding-left:33px\">支付成功</span>', {
                    skin: 'layer-ext-moon',
                    closeBtn: 0,
                    btn: ['确认', '前往我的体验金'], //按钮
                    title: '消息'
                }, function () {
                    //window.location.href = location.href;
                    location.reload();
                }, function () {
                    window.location.href = "/newbie/profile?type=balance";
                });
            }

        },
        error: function (data) {
            $("#goBid").text('立即投资');
            $("#goBid").attr('disabled', false).removeClass("unabled");
            var err = eval("(" + data.responseText + ")");
            layer.msg(err.msg, {
                time: 2000,
                icon: 2
            });
        },
        dataType: 'json'
    });
}
//正式标投标
//$("#goPay").bind("click", function () {
//    //数量为0变为1
//    if (parseInt($("#skuNum").val()) == '0') {
//        $("#skuNum").val(1);
//    }
//    //var partCount = parseInt($("#my_param").attr('data-remain'));
//    //if (parseInt($("#skuNum").val()) > parseInt(balance / part_price)) {
//    //    $("#skuNum").val(parseInt(balance / part_price));
//    //}
//    //if (parseInt($("#skuNum").val()) > partCount) {
//    //    $("#skuNum").val(partCount);
//    //}
//    $("#goPay").html('处理中<span class=\"dotting\"></span>');
//    $("#goPay").attr('disabled', true).addClass("unabled");
//    $.ajax({
//        type: "POST",
//        url: $("#my_param").attr("data-url"),
//        data: {
//            part_count: parseInt($("#skuNum").val()),
//            _token: $("#my_param").attr('data-token')
//        },
//        success: function (data) {
//            $("#goPay").text('立即投资');
//            $("#goPay").attr('disabled', false).removeClass("unabled");
//            layer.confirm('<i class="layui-layer-ico layui-layer-ico1"></i><span style=\"padding-left:33px\">支付成功</span>', {
//                skin: 'layer-ext-moon',
//                closeBtn: 0,
//                btn: ['确认', '前往我的理财'], //按钮
//                title: '消息'
//            }, function () {
//                //window.location.href = location.href;
//                location.reload();
//            }, function () {
//                window.location.href = "/account?type=assets";
//            });
//        },
//        error: function (data) {
//            $("#goPay").text('立即投资');
//            $("#goPay").attr('disabled', false).removeClass("unabled");
//            var err = eval("(" + data.responseText + ")");
//            layer.msg(err.msg, {
//                time: 2000,
//                icon: 2
//            });
//        },
//        dataType: 'json'
//    });
//})
//充值
$("#goDeposit").bind("click", function () {
    var amount = $("#skuNum").val() * $("#subtotal").text().split("元")[0];
    var balance = $("#my_param").attr('data-balance');
    window.location.href = "/account?type=management&style=deposit" + "&amount=" + amount + "&balance=" + balance;
});
//开通委托扣款
$("#goWithhold").bind("click", function () {
    $.ajax({
        type: "GET",
        url: "/payment/guide?type=handle_withhold_authority",
        data: {
            url: $("#my_param").attr("data-url") + '?'
        },
        success: function (data) {
            layer.msg('即将跳转到新浪', {
                time: 2000, //2s后自动关闭
                icon: 6
            }, function () {
                window.location.href = data.url;
            });
        },
        error: function (data) {
            var err = eval("(" + data.responseText + ")");
            layer.msg(err.msg, {
                time: 2000,
                icon: 2
            });
        },
        dataType: 'json'
    });
});