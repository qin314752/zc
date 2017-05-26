/**
 * @wiki-net.com
 *
 */

var WN = {
    //全局索引参数
    globalIndex: 0,

    util: {
        isJson: function (obj) {
            var isjson = typeof(obj) == "object" && Object.prototype.toString.call(obj).toLowerCase() == "[object object]" && !obj.length;
            return isjson;
        },
        isMobile: function (mobile) {
            var partten = /^1[3,5,8,4,9,6,7]\d{9}$/;
            if (partten.test(mobile)) {
                return true;
            } else {
                return false;
            }
        },
        isEmail: function (email) {
            if (/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(email)) {
                return true;
            }
            return false;
        },
        isUsername: function (username) {
            if (WN.util.isEmpty(username)) {
                return false;
            }
            if (username.length < 4 || username.length > 16) {
                return false;
            }
            return true;
        },
        isIDCard: function (idcode) {
            var Wi = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1];// 加权因子;
            var ValideCode = [1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2];// 身份证验证位值，10代表X;
            if (idcode.length == 15) {
                return isValidityBrithBy15IdCard(idcode);
            } else if (idcode.length == 18) {
                var a_idCard = idcode.split("");// 得到身份证数组
                if (isValidityBrithBy18IdCard(idcode) && isTrueValidateCodeBy18IdCard(a_idCard)) {
                    return true;
                }
                return false;
            }
            return false;

            function isTrueValidateCodeBy18IdCard(a_idCard) {
                var sum = 0; // 声明加权求和变量
                if (a_idCard[17].toLowerCase() == 'x') {
                    a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
                }
                for (var i = 0; i < 17; i++) {
                    sum += Wi[i] * a_idCard[i];// 加权求和
                }
                valCodePosition = sum % 11;// 得到验证码所位置
                if (a_idCard[17] == ValideCode[valCodePosition]) {
                    return true;
                }
                return false;
            }

            function isValidityBrithBy18IdCard(idCard18) {
                var year = idCard18.substring(6, 10);
                var month = idCard18.substring(10, 12);
                var day = idCard18.substring(12, 14);
                var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
                // 这里用getFullYear()获取年份，避免千年虫问题
                if (temp_date.getFullYear() != parseFloat(year) || temp_date.getMonth() != parseFloat(month) - 1 || temp_date.getDate() != parseFloat(day)) {
                    return false;
                }
                return true;
            }

            function isValidityBrithBy15IdCard(idCard15) {
                var year = idCard15.substring(6, 8);
                var month = idCard15.substring(8, 10);
                var day = idCard15.substring(10, 12);
                var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
                // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
                if (temp_date.getYear() != parseFloat(year) || temp_date.getMonth() != parseFloat(month) - 1 || temp_date.getDate() != parseFloat(day)) {
                    return false;
                }
                return true;
            }
        },
        isBankCard: function () {

        },
        isTruename: function (truename) {
            if (truename.match(/^[\u4e00-\u9fa5]{2,4}$/i)) {
                return true;
            }
            return false;
        },
        isUrl: function () {

        },
        isFunc: function (testFunc) {

            return typeof(eval(testFunc)) == 'function';
        },
        jsonEval: function (data) {
            try {
                if ($.type(data) == 'string')
                    return eval('(' + data + ')');
                else return data;
            } catch (e) {
                return {};
            }
        },
        isPassword: function (pwd) {
            if (WN.util.isEmpty(pwd)) {
                return false;
            }
            if (pwd.length >= 6 && pwd.length <= 16) {
                return true;
            }
            return false;
        },
        //判断字符串是否为空
        isEmpty: function (str) {
            if (str == undefined || str == '')
                return true;
            return false;
        },
        isDigits: function (s) {
            if (s != null && s != "") {
                return !isNaN(s);
            }
            return false;
        },
        fromMobile: function () {
            var userAgent = navigator.userAgent;
            if (userAgent != null && userAgent != "") {
                userAgent = userAgent.toLowerCase();
            }
            //手机处理
            if (userAgent.indexOf("android") >= 0
                || userAgent.indexOf("iphone") >= 0
                || userAgent.indexOf("ipod") >= 0
                || userAgent.indexOf("ipad") >= 0
                || userAgent.indexOf("windows phone") >= 0
                || userAgent.indexOf("blackberry") >= 0) {
                return true;
            }
            return false;
        },

        addFavorite: function () {
            var url = window.location;
            var title = document.title;
            var ua = navigator.userAgent.toLowerCase();
            if (ua.indexOf("360se") > -1) {
                alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
            }
            else if (ua.indexOf("msie 8") > -1) {
                window.external.AddToFavoritesBar(url, title); //IE8
            }
            else if (document.all) {
                try {
                    window.external.addFavorite(url, title);
                } catch (e) {
                    alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
                }
            }
            else if (window.sidebar) {
                window.sidebar.addPanel(title, url, "");
            }
            else {
                alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
            }
        },
        goUrl: function (url) {
            setTimeout(function () {
                location.href = url;
            }, 500);

        },
        //格式化金额格式
        formatAmount: function (num) {
            num = num.toString().replace(/\$|\,/g, '');
            if (isNaN(num))
                num = "0";
            sign = (num == (num = Math.abs(num)));
            num = Math.floor(num * 100 + 0.50000000001);
            cents = num % 100;
            num = Math.floor(num / 100).toString();
            if (cents < 10)
                cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                num = num.substring(0, num.length - (4 * i + 3)) + ',' +
                    num.substring(num.length - (4 * i + 3));
            return (((sign) ? '' : '-') + num + '.' + cents);
        },
        //////////////////////////////////////////////////////////////////////
        //BLL.JS 中数字字符转换成大写人民币通用方法封装
        //////////////////////////////////////////////////////////////////////
        covertAmountToDX: function (currencyDigits) {
            var MAXIMUM_NUMBER = 99999999999.99;  //最大值
            // 定义转移字符
            var CN_ZERO = "零";
            var CN_ONE = "壹";
            var CN_TWO = "贰";
            var CN_THREE = "叁";
            var CN_FOUR = "肆";
            var CN_FIVE = "伍";
            var CN_SIX = "陆";
            var CN_SEVEN = "柒";
            var CN_EIGHT = "捌";
            var CN_NINE = "玖";
            var CN_TEN = "拾";
            var CN_HUNDRED = "佰";
            var CN_THOUSAND = "仟";
            var CN_TEN_THOUSAND = "万";
            var CN_HUNDRED_MILLION = "亿";
            var CN_DOLLAR = "元";
            var CN_TEN_CENT = "角";
            var CN_CENT = "分";
            var CN_INTEGER = "整";
            // 初始化验证:
            var integral, decimal, outputCharacters, parts;
            var digits, radices, bigRadices, decimals;
            var zeroCount;
            var i, p, d;
            var quotient, modulus;
            // 验证输入字符串是否合法
            if (currencyDigits.toString() == "") {
                alert("还没有输入数字");
                $("#Digits").focus();
                return;
            }
            //判断是否输入有效的数字格式
            var reg = /^((\d{1,3}(,\d{3})*(.((\d{3},)*\d{1,3}))?)|(\d+(.\d+)?))$/;
            if (!reg.test(currencyDigits)) {
                alert("请输入有效格式数字");
                $("#Digits").focus();
                return;

            }
            currencyDigits = currencyDigits.replace(/,/g, "");
            currencyDigits = currencyDigits.replace(/^0+/, "");
            //判断输入的数字是否大于定义的数值
            if (Number(currencyDigits) > MAXIMUM_NUMBER) {
                alert("您输入的数字太大了");
                $("#Digits").focus();
                return;
            }
            parts = currencyDigits.split(".");
            if (parts.length > 1) {
                integral = parts[0];
                decimal = parts[1];
                decimal = decimal.substr(0, 2);
            }
            else {
                integral = parts[0];
                decimal = "";
            }
            // 实例化字符大写人民币汉字对应的数字
            digits = new Array(CN_ZERO, CN_ONE, CN_TWO, CN_THREE, CN_FOUR, CN_FIVE, CN_SIX, CN_SEVEN, CN_EIGHT, CN_NINE);
            radices = new Array("", CN_TEN, CN_HUNDRED, CN_THOUSAND);
            bigRadices = new Array("", CN_TEN_THOUSAND, CN_HUNDRED_MILLION);
            decimals = new Array(CN_TEN_CENT, CN_CENT);

            outputCharacters = "";
            //大于零处理逻辑
            if (Number(integral) > 0) {
                zeroCount = 0;
                for (i = 0; i < integral.length; i++) {
                    p = integral.length - i - 1;
                    d = integral.substr(i, 1);
                    quotient = p / 4;
                    modulus = p % 4;
                    if (d == "0") {
                        zeroCount++;
                    }
                    else {
                        if (zeroCount > 0) {
                            outputCharacters += digits[0];
                        }
                        zeroCount = 0;
                        outputCharacters += digits[Number(d)] + radices[modulus];
                    }
                    if (modulus == 0 && zeroCount < 4) {
                        outputCharacters += bigRadices[quotient];
                    }
                }
                outputCharacters += CN_DOLLAR;
            }
            // 包含小数部分处理逻辑
            if (decimal != "") {
                for (i = 0; i < decimal.length; i++) {
                    d = decimal.substr(i, 1);
                    if (d != "0") {
                        outputCharacters += digits[Number(d)] + decimals[i];
                    }
                }
            }
            //确认并返回最终的输出字符串
            if (outputCharacters == "") {
                outputCharacters = CN_ZERO + CN_DOLLAR;
            }
            if (decimal == "") {
                outputCharacters += CN_INTEGER;
            }
            //获取人民币大写
            return outputCharacters;
        },

        /**
         * 上传图片
         */
        uploadImg: function (A, value, img) {
            var a = $(A);
            var url = a.attr("uploadUrl");
            if (url == '' || url === undefined) {
                alert("请配置uploadUrl属性");
            }
            var data = new FormData();
            $.each(a[0].files, function (i, file) {
                data.append('Filedata', file);
            });
            $.ajax({
                url: url, type: 'POST', data: data, cache: false,
                dataType: "json", contentType: false, //不可缺
                processData: false, //不可缺
                success: function (data) {
                    var imgurl = data.ext.url;
                    $("#" + img).fadeIn().attr("src", imgurl);
                    $("#" + value).attr("value", imgurl);
                }, error: function (date) {
                    alert(date);
                }
            });
        }

    },
    /**
     * 兼容性相关处理代码
     */
    fixed: {
        placeholder: function () {

            var doPlaceholder = function (input) {

                var type = input.attr('type');
                if (type == 'text') {
                    var text = input.attr('placeholder'), defaultValue = input.defaultValue;
                    if (!defaultValue) {
                        input.val(text).addClass("WNPlaceHolder");
                    }
                    input.focus(function () {
                        if (input.val() == text) {
                            $(this).val("");
                        }
                    });
                    input.blur(function () {
                        if (input.val() == "") {
                            $(this).val(text).addClass("WNPlaceHolder");
                        }
                    });
                    //输入的字符不为灰色
                    input.keydown(function () {
                        $(this).removeClass("WNPlaceHolder");
                    });
                }
                else if (type == 'password') {
                    //对password框的特殊处理1.创建一个text框 2获取焦点和失去焦点的时候切换
                    var pwdVal = input.attr('placeholder');
                    var pwdPlaceholder = input.clone();
                    pwdPlaceholder.attr('type', 'text');
                    pwdPlaceholder.addClass('WNPlaceHolder');
                    pwdPlaceholder.removeAttr('wn-check');
                    pwdPlaceholder.removeAttr('name');
                    pwdPlaceholder.val(pwdVal);
                    //var pwdPlaceholder = $('<input class="text password phcolor" type="text" value='+pwdVal+' autocomplete="off" />');
                    input.after(pwdPlaceholder);
                    pwdPlaceholder.show();
                    input.hide();

                    pwdPlaceholder.focus(function () {
                        pwdPlaceholder.hide();
                        input.show();
                        input.focus();
                    });
                    input.blur(function () {
                        if (input.val() == '') {
                            pwdPlaceholder.show();
                            input.hide();
                        }
                    });
                }

            }
            isSupport = 'placeholder' in document.createElement('input');
            if (!isSupport) {
                $('input').each(function () {
                    var text = $(this).attr("placeholder");
                    if ($(this).attr("type") == "text" || $(this).attr("type") == "password") {
                        doPlaceholder($(this));
                    }
                });
            }
        }
    },

    ui: {
        showLoading: function () {
            $('.wn-mask').show();
        },
        hideLoading: function () {
            $('.wn-mask').hide();
        },
        showMsg: function (msg, type) {
            //art.dialog.tips(msg, 1.5);
            layer.msg(msg);
        },
        showOk: function () {

        },
        showError: function (msg) {
            WN.ui.showMsg(msg, 'error');
        },
        showInfo: function () {

        },
        showConfirm: function (message, okText, okCall) {

            layer.confirm(message, {
                btn: [okText || '确认', '取消'] //按钮
            }, function (e) {
                return okCall.call(this, e);
            }, function () {
            });
            /*art.dialog(
             {
             id: 'WN-Confirm',
             zIndex: 1000,
             icon: 'question',
             fixed: true,
             lock: true,
             opacity: .1,
             content: message,
             okVal : okText || '确定',
             ok: function (here) {
             return okCall.call(this, here);
             }
             }
             )*/

        }
    },

    widget: {
        onlineService: function () {

        },
        gotoTop: function () {
            //$('body').append('<div class="wn-gotoTop"></div>');
            var scrollUP = function () {
                var st = $(document).scrollTop(), winh = $(window).height(), winw = $(window).width();
                (st > 0) ? $(".wn-gotoTop").parent().show("normal", function () {
                }) : $(".gotop").parent().hide("normal", function () {
                });
                status = st;
                //IE6下的定位
                if (!window.XMLHttpRequest) {
                    $(".wn-gotoTop").css("top", st + winh - 166);
                }
            }
            scrollUP();
            $(window).bind("scroll", scrollUP);

            // backToTop
            $(".wn-gotoTop").click(function () {
                //alert('fdsfdsf');
                if (scroll == "off") return;
                $("html,body").animate({scrollTop: 0}, 600);
            });
            // backToTop end
        }
    },

    plugin: {

        viewport: {}

    },

    /**
     *
     */
    form: {
        isAjax: true,
        /**
         * 提交表单后默认等待方式
         */
        loadingType: 1,
        /**
         * 错误消息提示方式，
         * 目前支持3种方式
         * 1.直接在input元素后面加入<span class="msgtip"></span>提示
         * 2.直接弹出对话框提示alert()
         * 3.在指定的位置上显示提示消息，这个需要传入wn-tip-target="id"，来指明是在那个标签上显示信息
         * 4.直接将input元素加入class="error"样式
         */
        tipType: 1,

        register: function (form) {
            //获取表单配置
            WN.form.isAjax = form.attr('wn-ajax') == 'false' ? false : true;
            WN.form.tipType = WN.util.isEmpty(form.attr('wn-tip')) ? 1 : form.attr('wn-tip');
            WN.form.loadingType = WN.util.isEmpty(form.attr('wn-loading')) ? 1 : form.attr('wn-loading');

            //alert($(form).find('*[wn-check]').size());
            form.find('*[wn-check]').each(function () {
                var obj = $(this);
                $(this).blur(function () {
                    WN.form.docheck(obj);
                    if ($(this).attr('wn-result') == 'true') {
                        //是否需要远程验证
                        var remoteUrl = $(this).attr('wn-remote-url');
                        //alert(remoteUrl);
                        var value = $(this).val();
                        if (!WN.util.isEmpty(remoteUrl)) {
                            WN.form.dotip(false, obj, '正在验证中');
                            WN.ajax.post(remoteUrl, {value: value}, function (json) {
                                if (json.status == 1) {
                                    WN.form.dotip(true, obj, json.message);
                                } else {
                                    //alert(json.message);
                                    WN.form.dotip(false, obj, json.message);
                                }
                            });
                        }
                    }
                });
            });

            form.find('*[wn-type="submit"]').click(function () {
                if (!form.find('*[wn-type="submit"]').hasClass('WNBtnDisable')) {
                    form.submit();
                }
            });

            form.submit(function () {
                //alert('submit:' + WN.form.valid(form));
                if (WN.form.valid(form)) {

                    var beforeCall = form.attr('wn-call-before');
                    if (!WN.util.isEmpty(beforeCall)) {
                        if (WN.util.isFunc(beforeCall)) {
                            var func = eval(beforeCall);
                            if (func(form) != true) {
                                return false;
                            }
                        }
                    }
                    WN.form.loadingOpen(form);
                    if (WN.form.isAjax == true) {
                        //alert(form.serialize());
                        WN.ajax.post(form.attr('action'), form.serialize(), function (json) {

                            var afterCall = form.attr('wn-call-after');
                            if (!WN.util.isEmpty(afterCall)) {
                                if (WN.util.isFunc(afterCall)) {
                                    var func = eval(afterCall);
                                    func(json);
                                    WN.form.loadingClose(form);
                                    return;
                                }
                            }

                            if (json.status == 1) {
                                //if(!WN.util.isEmpty(json.ext) && !WN.util.isEmpty(json.ext.gourl))
                                if (!WN.util.isEmpty(json.message)) {
                                    WN.ui.showMsg(json.message, false);
                                }
                                //alert(json.ext.gourl);
                                if (json.ext != undefined && !WN.util.isEmpty(json.ext.gourl)) {
                                    setTimeout(function () {
                                        location.href = json.ext.gourl;
                                    }, 1500);
                                    return;
                                }
                                var isReload = form.attr('wn-reload');
                                if (isReload == 'true') {
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1500);
                                    return;
                                }
                                var goUrl = form.attr('wn-succurl');
                                if (!WN.util.isEmpty(goUrl)) {
                                    setTimeout(function () {
                                        location.href = goUrl;
                                    }, 1500);
                                    return;
                                }
                                WN.form.loadingClose(form);
                            } else {
                                WN.form.loadingClose(form);
                                WN.ui.showMsg(json.message);
                                var vcode = form.find('*[wn-type="vcode"]');
                                vcode.show();
                                vcode.click();
                            }
                        });
                        return false;
                    } else {
                        return true;
                    }
                }
                return false;
            });
        },
        valid: function (form) {
            var result = true;
            form.find('*[wn-check]').each(function () {
                WN.form.docheck($(this));
                if ($(this).attr('wn-result') == 'false') {
                    result = false;
                    if (WN.form.tipType != '1') {
                        $(this).focus();
                        return false;
                    }
                }
            });
            return result;
        },
        docheck: function (obj) {


            var myrule = obj.attr('wn-check');
            if (myrule == '') {
                WN.form.rules.noempty(obj);
            } else {
                var func = eval('WN.form.rules.' + myrule);
                func(obj);
            }
        },
        dotip: function (result, obj, msg) {
            //alert(msg);
            obj.attr('wn-result', result);
            //1.直接在input元素后面加入<span class="msgtip"></span>提示
            //alert(WN.form.tipType);
            if (WN.form.tipType == '1') {
                var tip = $(obj).parent().find('.msgtip');
                //alert(tip);
                if (tip.size() == 0) {
                    tip = $('<span class="msgtip"></span>');
                    $(obj).parent().append(tip);
                    //$(obj).after(tip);
                }
                tip.html(msg);
            }
            //2.直接弹出对话框提示alert()
            else if (WN.form.tipType == '2') {
                if (msg != '') {
                    WN.ui.showMsg(msg);
                }
            }
            //3.在指定的位置上显示提示消息，这个需要传入wn-tip-target="id"，来指明是在那个标签上显示信息
            else if (WN.form.tipType == '3') {
                var target = $(obj).closest('form').attr('wn-tip-target');
                if (target == undefined || target == '') {
                    alert('当wn-tip为3时，请配置wn-tip-target属性');
                    return;
                }
                $('#' + target).html(msg);
            }
            //4.直接将input元素加入class="error"样式
            else if (WN.form.tipType == '4') {
                if (!result) {
                    $(obj).addClass('wn-error');
                } else {
                    $(obj).removeClass('wn-error');
                }
            }
            //5.上面滑下来
            else if (WN.form.tipType == '5') {
            	 var tip = $(obj).parent().find('.ts-li');
            	 var timg =  $(obj).parent().find('.ts-img');
                 if (tip.size() == 0) {
                     tip = $('<li class="ts-li"></li>');
                     $(timg).hide();
                     $(obj).parent().append(tip);
                     //$(obj).after(tip);
                 }
                 if(msg != ""){
                	 tip.html(msg);
                 }else{
                	 if(tip.size()!=0){
                		 $(tip).remove();
                		 $(timg).show();
                	 }
                 }
                 
            }


        },
        /**
         * 提交表单的时候，loadding 等待效果
         */
        loadingOpen: function (form) {
            form.find('*[wn-type="submit"]').addClass('WNBtnDisable');
            if (WN.form.loadingType == 1) {
                layer.load(1, {shade: ['0.5', '#666']});
            }
        },
        /**
         * 关闭提交表单的时候的loadding效果
         */
        loadingClose: function (form) {
            form.find('*[wn-type="submit"]').removeClass('WNBtnDisable');
            layer.closeAll("loading");
        },
        /**
         * 统一获取提示语言对象
         * @param obj
         * @param nulmsg
         * @param errmsg
         * @param sucmsg
         */
        getTipMsg: function (obj, nulmsg, errmsg, sucmsg) {
            var msg = {};
            msg.errmsg = obj.attr('wn-errmsg') || errmsg;
            msg.nulmsg = obj.attr('wn-nulmsg') || nulmsg;
            msg.sucmsg = obj.attr('wn-sucmsg') || sucmsg;
            return msg;
        },
        //
        rules: {
            noempty: function (obj) {
                var value = obj.val();
                var msg = WN.form.getTipMsg(obj, '该项不能为空', '该项输入有误', '');
                var inputType = obj.attr('type');
                if (inputType == 'checkbox') {
                    if (obj.attr('checked') != 'checked') {
                        WN.form.dotip(false, obj, msg.nulmsg);
                        return;
                    }
                } else {
                    if (value == '') {
                        WN.form.dotip(false, obj, msg.nulmsg);
                        return;
                    }
                }
                WN.form.dotip(true, obj, msg.sucmsg);
            },
            username: function (obj) {
                var value = obj.val();
                var okMsg = obj.attr('wn-ok-msg') || '';
                var errorMsg = obj.attr('wn-error-msg') || '请输入正确的用户名';
                var nullMsg = obj.attr('wn-null-msg') || '用户名不能为空';
                if (value == '') {
                    WN.form.dotip(false, obj, nullMsg);
                    return;
                }
                if (!WN.util.isUsername(value)) {
                    WN.form.dotip(false, obj, errorMsg);
                    return;
                }
                WN.form.dotip(true, obj, okMsg);
            },
            truename: function (obj) {
                var value = obj.val();
                var okMsg = obj.attr('wn-ok-msg') || '';
                var errorMsg = obj.attr('wn-error-msg') || '请输入正确的真实姓名';
                var nullMsg = obj.attr('wn-null-msg') || '真实姓名不能为空';
                if (value == '') {
                    WN.form.dotip(false, obj, nullMsg);
                    return;
                }
                if (!WN.util.isTruename(value)) {
                    WN.form.dotip(false, obj, errorMsg);
                    return;
                }
                WN.form.dotip(true, obj, okMsg);
            },
            email: function (obj) {
                var value = obj.val();
                var okMsg = obj.attr('wn-ok-msg') || '';
                var errorMsg = obj.attr('wn-error-msg') || '请输入正确的邮箱账号';
                var nullMsg = obj.attr('wn-null-msg') || '邮箱账号不能为空';
                if (value == '') {
                    WN.form.dotip(false, obj, nullMsg);
                    return;
                }
                if (!WN.util.isEmail(value)) {
                    WN.form.dotip(false, obj, errorMsg);
                    return;
                }
                WN.form.dotip(true, obj, okMsg);
            },
            idcard: function (obj) {
                var value = obj.val();
                var okMsg = obj.attr('wn-ok-msg') || '';
                var errorMsg = obj.attr('wn-error-msg') || '请输入正确的身份证号码';
                var nullMsg = obj.attr('wn-null-msg') || '身份证号码不能为空';
                if (value == '') {
                    WN.form.dotip(false, obj, nullMsg);
                    return;
                }
                if (!WN.util.isIDCard(value)) {
                    WN.form.dotip(false, obj, errorMsg);
                    return;
                }
                WN.form.dotip(true, obj, okMsg);
            },
            password: function (obj) {
                var value = obj.val();
                var msg = WN.form.getTipMsg(obj, '密码不能为空', '请输入正确的密码，长度为6-16位', '');
                //alert("password:" + value);
                if (value == '') {
                    WN.form.dotip(false, obj, msg.nulmsg);
                    return;
                }
                if (!WN.util.isPassword(value)) {
                    WN.form.dotip(false, obj, msg.errmsg);
                    return;
                }
                WN.form.dotip(true, obj, msg.sucmsg);
            },
            number: function (obj) {
                var value = obj.val();
                var msg = WN.form.getTipMsg(obj, '不能为空', '只能输入整数', '');
                if (value == '') {
                    WN.form.dotip(false, obj, msg.nulmsg);
                    return;
                }
                if (parseInt(value) != value) {
                    WN.form.dotip(false, obj, msg.errmsg);
                    return;
                }
                WN.form.dotip(true, obj, msg.sucmsg);
            },
            digits: function (obj) {
                var value = obj.val();
                var msg = WN.form.getTipMsg(obj, '不能为空', '只能输入数字', '');
                if (value == '') {
                    WN.form.dotip(false, obj, msg.nulmsg);
                    return;
                }
                if (!WN.util.isDigits(value)) {
                    WN.form.dotip(false, obj, msg.errmsg);
                    return;
                }
                WN.form.dotip(true, obj, msg.sucmsg);
            },
            mobile: function (obj) {
                var value = $(obj).val();
                if (!WN.util.isMobile(value)) {
                    return WN.form.dotip(false, obj, '请输入正确的手机号码');
                }
                return WN.form.dotip(true, obj, '');
            },
            vcode: function (obj) {
                var value = $(obj).val();
                var msg = WN.form.getTipMsg(obj, '请输入图片验证码', '请输入正确的图片验证码', '');
                if (WN.util.isEmpty(value)) {
                    return WN.form.dotip(false, obj, msg.nulmsg);
                }
                if (value.length != 4) {
                    return WN.form.dotip(false, obj, msg.errmsg);
                }
                return WN.form.dotip(true, obj, '');
            },
            equal: function (obj) {
                var target = obj.attr('wn-target');
                var okMsg = obj.attr('wn-ok-msg') || '';
                var errorMsg = obj.attr('wn-error-msg') || '确认密码不相等';
                var nullMsg = obj.attr('wn-null-msg');
                var obj2 = $('#' + target);
                //alert(obj.val() + "-" + obj2.val());
                if (obj.val() != obj2.val()) {
                    return WN.form.dotip(false, obj, errorMsg);
                }
                return WN.form.dotip(true, obj, okMsg);
            },
            /**
             * 金额验证
             */
            amount: function (obj) {
                var value = obj.val();
                var msg = WN.form.getTipMsg(obj, '请输入金额', '金额格式有误，请输入正确的金额，2位小数', '');
                //alert(isNaN(value) + ' ' + value);
                if (WN.util.isEmpty(value)) {
                    return WN.form.dotip(false, obj, msg.nulmsg);
                }
                if (isNaN(value)) {
                    return WN.form.dotip(false, obj, msg.errmsg);
                }
                value = parseFloat(value);
                var min = obj.attr('wn-min') || 0;
                var max = obj.attr('wn-max') || 10000000;
                if (value < min || value > max) {
                    return WN.form.dotip(false, obj, '金额范围有误，最小:' + min + '，最大:' + max);
                }
                return WN.form.dotip(true, obj, msg.sucmsg);
            },
            /**
             * QQ号码验证
             */
            qq: function (obj) {
                var value = obj.val();
                var msg = WN.form.getTipMsg(obj, 'QQ号码不能为空', 'QQ号码格式错误', '');
                if (WN.util.isEmpty(value)) {
                    return WN.form.dotip(false, obj, msg.nulmsg);
                }
                if (!WN.util.isQQ(value)) {
                    return WN.form.dotip(false, obj, msg.errmsg);
                }
                return WN.form.dotip(true, obj, msg.sucmsg);
            },
            //远程验证
            remote: function () {

            }

        }
    },

    ajax: {

        request: function (url, type, data, func) {
            $.ajax({
                type: type,
                url: url,
                data: data,
                timeout: 120000,
                dataType: 'json',
                cache: false,
                success: function (resData) {
                    func(resData);
                },
                error: function (xhr, status, error) {
                    //for(var i in xhr)
                    //{
                    //	alert(xhr[i]);
                    //}
                    //alert(xhr + "ffffffffffffff" + status + "  ddd   " + error);
                    //showDialog('������æ', error);
                    //WN.ui.showMsg('');sh
                    WN.ui.showError(error);
                }
            });
        },

        post: function (url, data, func) {
            WN.ajax.request(url, 'POST', data, func);
        },

        get: function (url, func) {
            WN.ajax.request(url, 'GET', null, func);
        }

    },

    init: function () {

        //倒计时
        $('[wn-type="countdown"]').each(function () {

            function showTime(objId, time_distance) {
                //alert(objId + ' ' + time_distance);
                this.id = objId;
                this.distance = time_distance * 1000;
            }

            showTime.prototype.setTimeShow = function () {
                //alert('ffff');
                var timer = $('#' + this.id);
                var str_time;
                var int_day, int_hour, int_minute, int_second;
                distance = this.distance;
                this.distance = this.distance - 1000;
                if (distance > 0) {
                    int_day = Math.floor(distance / 86400000);
                    distance -= int_day * 86400000;
                    int_hour = Math.floor(distance / 3600000);
                    distance -= int_hour * 3600000;
                    int_minute = Math.floor(distance / 60000);
                    distance -= int_minute * 60000;
                    int_second = Math.floor(distance / 1000);
                    if (int_hour < 10)
                        int_hour = "0" + int_hour;
                    if (int_minute < 10)
                        int_minute = "0" + int_minute;
                    if (int_second < 10)
                        int_second = "0" + int_second;
                    str_time = int_day + "天" + int_hour + "小时" + int_minute + "分钟" + int_second + "秒";
                    //alert(str_time);
                    timer.text(str_time);
                    var self = this;
                    setTimeout(function () {
                        self.setTimeShow();
                    }, 1000);
                } else {
                    timer.text("项目已结束");
                    return;
                }
            };

            var objId = $(this).attr('id');
            var distance = $(this).attr('wn-distance') || 0;
            var st = new showTime(objId, distance);
            st.setTimeShow();
        });


        //发送短信验证码
        $('[wn-type="sendsms"]').click(function () {

            var obj = $(this);

            //判断是否正在倒计时
            var status = obj.attr('wn-status');
            if (status == 'going') {
                return;
            }

            //是否需要依赖于检验验证码后才能发送
            var depeVcode = $(this).attr('wn-depe-vcode');
            if (depeVcode == 'true') {
                var result = $('#vcode').attr('wn-result');
                if (result != 'true') {
                    WN.ui.showError('请先输入正确的图片验证码，在进行发送');
                    $('#vcode').focus();
                    return;
                }
            }

            var postData = {};

            //需要发送的手机号标签，如果是#开头，表明是id元素，需要查找属性的val()，否则就是手机号码
            var mobileTag = $(this).attr('wn-mobile');
            var emailTag = $(this).attr('wn-email');
            if (!WN.util.isEmpty(mobileTag)) {
                //需要发送的手机号
                var mobile = '';
                if (mobileTag.startWith('#')) {
                    mobile = $(mobileTag).val();
                } else {
                    mobile = mobileTag;
                }
                //alert(mobile);
                if (!WN.util.isMobile(mobile)) {
                    WN.ui.showError('请输入正确的手机号');
                    $(mobileTag).focus();
                    return;
                }
                postData.mobile = mobile;
            }
            else if (!WN.util.isEmpty(emailTag)) {
                var email = '';
                if (emailTag.startWith('#')) {
                    email = $(emailTag).val();
                } else {
                    email = emailTag;
                }

                if (!WN.util.isEmail(email)) {
                    WN.ui.showError('请输入正确的邮箱');
                    $(emailTag).focus();
                    return;
                }
                postData.email = email;
            }

            var sendUrl = $(this).attr('wn-sendurl');
            if (WN.util.isEmpty(sendUrl)) {
                WN.ui.showError('请配置验证码发送URL');
                return;
            }
            postData.vcode = $('#vcode').val() || '';
            var oldText = obj.html();
            WN.ajax.post(sendUrl, postData, function (json) {
                if (json.status != 1) {
                    obj.attr('wn-status', 'no');
                    WN.ui.showError(json.message);
                    return;
                }
                timerSMSCount(true, 60);
                obj.attr('wn-status', 'going');
            });

            /**
             * 发送短信验证码倒计时
             * @param step
             */
            window.timerSMSCount = function (isfirst, step) {
                if (isfirst) {
                    obj.attr("disabled", "true");
                    obj.addClass('btnDisble');
                }
                step = step <= 120 && step >= 0 ? step : 120;
                step = step - 1;
                obj.html(step + "秒后可重新发送");
                if (step <= 0) {
                    obj.html(oldText).removeAttr("disabled");
                    obj.removeClass('btnDisble');
                    obj.attr('wn-status', 'no');
                } else {
                    window.setTimeout("timerSMSCount(false," + step + ")", 1000);
                }
            }

        });
        $('[wn-type="delete"]').click(function () {
            var title = $(this).attr('wn-title');
            title = title || '您确认要执行该操作吗？';
            if (confirm(title)) {
                location.href = $(this).attr('href');
            }
        });
        $('[wn-type="view"]').click(function () {

            var url = $(this).attr('href');
            console.log(url);
            if (WN.util.isEmpty(url)) {
                WN.ui.showMsg('请配置href参数', false);
                return false;
            }

            var title = $(this).attr('title') || '标题';
            var iframe = $(this).attr('wn-iframe') || false;

            var p = {};
            p.id = 'IFRAME_VIEW';
            p.title = title;
            p.lock = 'true';
            p.window = 'top';

            var wH = document.body.clientHeight;
            var dH = document.documentElement.clientHeight;
            var sH = window.screen.height;
            //alert("wH " + wH);
            //alert("sH " + sH);
            //alert("dH " + dH);
            p.height = Math.min(wH, sH, dH) + 'px';

            if ($(this).attr('wn-width')) {
                p.width = $(this).attr('wn-width') + 'px';
            }
            if ($(this).attr('wn-height')) {
                p.height = $(this).attr('wn-height') + 'px';
            }

            //alert(p.width + ' ' + p.height);
            layer.open({
                type: 2,
                title: title,
                shade: 0.3,
                shadeClose: true,
                area: [p.width, p.height],
                content: url
            })
            //artDialog.open(url, p);

            return false;
        });
        //��֤��
        $('[wn-type="vcode"]').click(function () {
            $(this).attr('src', $(this).attr('wn-url') + '?' + Math.random());
        });
        //
        $('[wn-type="form"]').each(function () {
            WN.form.register($(this));
        });
        //返回上一页
        $('[wn-type="back"]').click(function () {
            history.go(-1);
        });

        //新闻等滚动效果
        $('[wn-type="scroll"]').each(function () {
            var contId = $(this).attr('id');
            var interval = $(this).attr('wn-interval') || 3000;
            window.wnScrollFun = function (uniq) {
                var obj = $('#' + uniq);
                var scrollTop = obj.attr('wn-scrolltop') || '-40px';
                obj.find("ul:first").animate({
                    marginTop: scrollTop
                }, 750, function () {
                    $(this).css({marginTop: "0px"}).find("li:first").appendTo(this);
                });
            }
            setInterval('wnScrollFun("' + contId + '")', interval);
        });

        //a链接ajax操作
        $('[wn-type="ajax"]').click(function () {
            var url = $(this).attr('href');
            if (WN.util.isEmpty(url)) {
                WN.ui.showError('提交地址错误');
                return;
            }
            var msg = $(this).attr('wn-confirm') || '您确认要提交吗？';
            var $this = $(this);
            WN.ui.showConfirm(msg, '确定', function () {
                WN.ajax.get(url, function (json) {
                    if (json.message) {
                        WN.ui.showMsg(json.message);
                    }
                    if (json.status == 1) {
                        var reload = $this.attr('wn-reload');
                        if (reload == 'true') {
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                            return;
                        }
                    }
                })
            });
            return false;
        });


        //当前页面在iframe中打开
        if (window.location.href != top.location.href) {
            $('[wn-type="page-status"]').each(function () {
                var status = $(this).attr('wn-status') || 'yes';
                var message = $(this).attr('wn-message') || '';
                if (status == 'no') {
                    art.dialog.close();
                    art.dialog.tips(message, 1.5);
                }
            });
        }

        //�б�Ч��
        $('[wn-type="wn-datalist"] tr:nth-child(odd)').addClass('space');
        $('[wn-type="wn-datalist"] tr').hover(function () {
            $(this).addClass('hover')
        }, function () {
            $(this).removeClass('hover')
        });

        $('body').append('<div class="wn-mask"></div>');
        $('body').append('<div class="wn-loading"></div>');


        if ($.fn.uploadify) {
            $(":file[uploaderOption]").each(function () {
                var $this = $(this);
                var options = {
                    fileObjName: $this.attr("name") || "Filedata",
                    auto: true,
                    multi: true,
                    onUploadError: wnOnUploadError
                };
                var uploaderOption = WN.util.jsonEval($this.attr("uploaderOption"));
                $.extend(options, uploaderOption);
                $this.uploadify(options);
            });
        }

        if ($.fn.uploadifive) {
            $(":file[uploaderOption]").each(function () {
                var $this = $(this);
                var options = {
                    fileObjName: $this.attr("name") || "Filedata",
                    auto: true,
                    multi: true,
                    onUploadError: wnOnUploadError
                };
                var uploaderOption = WN.util.jsonEval($this.attr("uploaderOption"));
                $.extend(options, uploaderOption);
                $this.uploadifive(options);
            });
        }


        $(document).keyup(function (event) {
            if (event.keyCode == 13) {
                $('[wn-type="form"]').trigger("submit");
            }
        });

        WN.fixed.placeholder();
        WN.widget.gotoTop();
    },

    config: {
        debug: true
    }
}


String.prototype.endWith = function (str) {
    if (str == null || str == "" || this.length == 0
        || str.length > this.length)
        return false;
    if (this.substring(this.length - str.length) == str)
        return true;
    else
        return false;
    return true;
}
String.prototype.startWith = function (str) {
    if (str == null || str == "" || this.length == 0
        || str.length > this.length)
        return false;
    if (this.substr(0, str.length) == str)
        return true;
    else
        return false;
    return true;
}

String.prototype.trim = function () {
    return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}

$(function () {
    WN.init();
    //WN.ui.showLoading();
});