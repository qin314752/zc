<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<link href="__ROOT__/Style/A/css/style.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/A/js/tbox/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
</head>
<body>
<link href="__ROOT__/Style/Swfupload/swfupload.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__ROOT__/Style/Swfupload/handlers.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Swfupload/swfupload.js"></script>
<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>

<script type="text/javascript">

    function changestr(para){

        para = para.replace(/^[^1-9]/g,'');

        para = para.replace(/[^0-9]/g,'');

        return para;
    }

</script>
<style type="text/css">
    .albCt{height:200px}
</style>

<div class="so_main">
    <div class="page_tit">投票</div>
    <div class="page_tab"><span data="tab_1" class="active">基本信息</span></div>
    <div class="form2">
        <form method="post" action="__URL__/settings" onsubmit="return subcheck();" enctype="multipart/form-data">
            <input type="hidden" id="crowd_id" name="crowd_id" value="<?php echo ($list["id"]); ?>"/>
            <div id="tab_1">
                <dl class="lineD">
                    <dt>众筹项目名称：</dt>
                    <dd>
                        <input style="width: 400px;height: 17px;"readonly="readonly" type="text" value="<?php echo ($list["crowd_name"]); ?>" id="crowd_name" name="crowd_name"  /></td><td>*</td>

                    </dd>
                </dl>
                <dl class="lineD">
                    <dt>已筹资金额：</dt>
                    <dd>
                        <input style="width: 196px;height: 17px;"readonly="readonly" type="text" value="<?php echo ($list["has_crowd_money"]); ?>" id="crowd_money" name="crowd_money"  /></td><td>*(元)</td>

                    </dd>
                </dl>
                <dl class="lineD">
                    <dt>众筹人数：</dt>
                    <dd>
                        <input style="width: 196px;height: 17px;"readonly="readonly" type="text" value="<?php echo ($list["count"]); ?>" id="crowd_rs" name="crowd_rs" onkeyup="value=changestr(value)" /></td><td>*(人)</td>
                    </dd>
                </dl>
                <dl class="lineD">
                    <dt>前台售出价格：</dt>
                    <dd>
                        <input style="width: 196px;height: 17px;" type="text"  id="voting_money" name="voting_money" onkeyup="value=changestr(value)" /></td><td>*(元)</td>
                        <!--<input name="has_borrow" id="has_borrow"  class="input" type="text" value="<?php echo ($vo["has_borrow"]); ?>" ><span id="tip_has_borrow" class="tip">*</span>-->
                    </dd>
                </dl>
                <dl class="lineD">
                    <dt>投票期限：</dt>
                    <dd>
                        <select name="deadline" id="deadline"   class="c_select"><option value="">--请选择--</option><?php foreach($deadline as $key=>$v){ if($deadline[""]==$key && $deadline[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_deadline" class="tip">*(小时)</span>
                    </dd>
                </dl>

            </div>
            <!--tab1-->
            <!--tab3-->
            <div class="page_btm">
                <input type="submit" class="btn_b"  value="确定" />
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var status_1=false;
    function subcheck(){
        if(status_1){
            alert("数据正在提交，请勿重复点击！");
            return false;
        }
        var money=$("#voting_money").val();
        var deadline=$("#deadline").val();
        if(money.length == 0){
            alert("出售价格不能为空");
            return false;}
        if(deadline.length == 0) {
            alert("请选择期限");
            return false;}
        status_1=true;
        return true;
    }
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>