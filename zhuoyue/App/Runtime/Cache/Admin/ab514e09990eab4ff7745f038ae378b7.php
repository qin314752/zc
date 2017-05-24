<?php if (!defined('THINK_PATH')) exit();?>
<div class="so_main">

<div class="page_tit">调整余额</div>
<div class="form2">
	<form method="post" action="__URL__/doMoneyEdit" onsubmit="return subcheck();">
	<input type="hidden" name="id" value="<?php echo ($id); ?>" />
	<div id="tab_1">
	
	<dl class="lineD"><dt>可用余额：</dt><dd><input name="account_money" id="account_money"  class="input" type="text" value="" ><span id="tip_account_money" class="tip">如果是减少余额，请填负数，如'-1000'</span></dd></dl>
	<dl class="lineD"><dt>冻结金额：</dt><dd><input name="money_freeze" id="money_freeze"  class="input" type="text" value="" ><span id="tip_money_freeze" class="tip">如果是减少余额，请填负数，如'-1000'</span></dd></dl>
	<!--<dl class="lineD"><dt>待收金额：</dt><dd><input name="money_collect" id="money_collect"  class="input" type="text" value="" ><span id="tip_money_collect" class="tip">如果是减少余额，请填负数，如'-1000'</span></dd></dl>-->
    <!--<dl class="lineD"><dt>投资积分：</dt><dd><input name="integral" id="integral"  class="input" type="text" value="" ><span id="tip_integral" class="tip">如果是减少余额，请填负数，如'-1000'</span></dd></dl>-->
    <!--<dl class="lineD"><dt>信用积分：</dt><dd><input name="credits" id="credits"  class="input" type="text" value="" ><span id="tip_credits" class="tip">如果是减少余额，请填负数，如'-1000'</span></dd></dl>-->
	<dl class="lineD"><dt>变动原因：</dt><dd><input name="info" id="info"  class="input" type="text" value="" ><span id="tip_info" class="tip">*</span></dd></dl>
	
	</div><!--tab1-->
	
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" />
	</div>
	</form>
</div>

</div>
<script type="text/javascript">
var cansub = true;
function subcheck(){
	if(!cansub){
		alert("请不要重复提交，如网速慢，请等待！");
		return false;	
	}
	
	if($("#account_money").val()=="" && $("#money_freeze").val()=="" && $("#money_collect").val()=="" && $("#integral").val()=="" && $("#credits").val()==""){
		ui.error("如果不做任何修改，请点关闭按钮退出！");
		return false;
	}else if($("#info").val()==""){
		ui.error("变动原因不允许为空！");
		return false;
	}else{
		cansub = false;
		return true;
	}
}
</script>