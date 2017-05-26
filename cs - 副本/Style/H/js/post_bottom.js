/**
 * Created by Administrator on 2015/10/26.
 */
<!--中部结束-->


<if condition="$miao eq 'yes'">
    var miao = 'yes';
</if>
$("#is_pass").click(function (e) {
    if ($(this).attr('checked')) {
        $("#password").show();
    } else {
        $("#password").hide();
    }
});
function setError(tip) {
    $.jBox.tip(tip);
    return false;
}
function cksubmit() {
    var p = makevar(['borrow_name', 'borrow_money', 'borrow_interest_rate', 'borrow_use', 'borrow_duration', 'borrow_min', 'borrow_max', 'borrow_time', 'repayment_type', 'reward_type_1', 'reward_type_1_value', 'borrow_name', 'borrow_info', 'moneycollect']);
    if (!$("input[name='xieyi']").attr("checked")) {
        return setError("阅读并同意《{$glo.web_name}借款协议》后才能发布借款！");
    }

    if ($.trim(p.borrow_name) == "")         return setError("借款标题不能为空！");
    if (p.borrow_money == "")        return setError("借款金额不能为空！");
    if (p.borrow_money < 50)            return setError("借款金额不能小于50元！");
    if ((p.borrow_min * 2 > p.borrow_max) && (p.borrow_max > 0))            return setError("最大投资金额不能小于最小投资金额的2倍！");
    if (p.borrow_money % p.borrow_min != 0)    return setError("借款金额必须是最小投资金额的整数倍！");
    if (p.borrow_money > 99999999)        return setError("借款金额不能大于99999999元！");
    if (p.borrow_interest_rate == "")    return setError("借款利率不能为空！");
    if (p.borrow_use == "")            return setError("借款用途不能为空！");
    if (p.borrow_duration == "" && typeof miao == "undefined")        return setError("借款期限不能为空！");
    if (p.borrow_min == "")            return setError("最小投资金额不能为空！");
    if (p.borrow_time == "")        return setError("借款有效时间不能为空！");
    if (p.repayment_type == "" && typeof miao == "undefined")            return setError("还款方式不能为空！");
    if (p.borrow_name == "")        return setError("借款标题不能为空！");
    if (p.borrow_info == "")        return setError("借款内容不能为空！");

    return true;
}
