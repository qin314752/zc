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
<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>


<script type="text/javascript">
    var isSearchHidden = 1;
    var searchName = "添加众筹红包";

    function dosearchadd() {
        if(isSearchHidden == 1) {
            $("#search_div").slideDown();
            $(".search_action").html("添加完毕");
            isSearchHidden = 0;
        }else {
            $("#search_div").slideUp();
            $(".search_action").html(searchName);
            isSearchHidden = 1;
        }
    }
    var isSearchtime = 1;

</script>
<div class="so_main">
    <div class="page_tit">众筹红包设置</div>
    <div class="Toolbar_inbox">
        <a onclick="dosearchadd();" class="btn_a" href="javascript:void(0);"><span class="search_action">添加众筹红包</span></a>
    </div>

    <div id="search_div" style="display:none">
        <div class="form2">
            <form method="post" action="__URL__/doadd" onsubmit="return subcheck();" enctype="multipart/form-data">
                <dl class="lineD">
                    <dt>使用条件：</dt>
                    <dd>
                        <input name="crowd_money" style="width:190px" id="crowd_money" type="text" onkeyup="value=changestr(value)" >
                        <span>（元）*再投金额满足这个条件即可使用赠送金额</span>
                    </dd>
                </dl>

                <dl class="lineD"><dt>开始时间(开始)：</dt><dd><input onclick="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="start_time" id="start_time"  class="input Wdate" type="text" value="<?php echo ($bidtime["start_time"]); ?>"><span id="tip_start_time" class="tip">*</span></dd></dl>
                <dl class="lineD"><dt>结束时间(结束)：</dt><dd><input onclick="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2020-10-01',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="end_time" id="end_time"  class="input Wdate" type="text" value="<?php echo ($bidtime["end_time"]); ?>"><span id="tip_end_time" class="tip">*</span></dd></dl>


                <dl class="lineD">
                    <dt>赠送金额：</dt>
                    <dd>
                        <input name="donate_money" style="width:190px" id="donate_money" type="text" onkeyup="value=changestr(value)" value="<?php echo ($search["realname"]); ?>">
                        <span>*（只可众筹，不可提现）</span>
                    </dd>
                </dl>
                <dl class="lineD">
                    <dt>使用期限：</dt>
                    <dd>
                        <input name="deadline" style="width:190px" id="deadline" type="text" onkeyup="value=changestr(value)" value="<?php echo ($search["customer_name"]); ?>">
                        <span>（天）*从领取之日往后推迟指定的天数</span>
                    </dd>
                </dl>

                <div class="page_btm">
                    <input type="submit" class="btn_b" value="确定" />
                </div>

            </form>
        </div>
    </div>


    <div class="list" >
        <table style="width: 100%">
            <tr class="Toolbar_inbox" >
                <td width="200px">ID</td>
                <td  width="300px">使用条件(在投金额)</td>
                <td  width="200px">赠送金额</td>
                <td  width="200px">活动领取开始时间</td>
                <td  width="200px">活动领取结束时间</td>
                <td  width="200px">使用期限</td>
                <td width="200px">状态</td>
            </tr>
            <?php if(is_array($count)): $i = 0; $__LIST__ = $count;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["pay_money"]); ?></td>
                    <td><?php echo ($vo["donate_money"]); ?></td>

                    <td><?php echo ($vo["begin_time"]); ?></td>
                    <td><?php echo ($vo["over_time"]); ?></td>

                    <td><?php echo ($vo["count"]); ?>天</td>

                    <td class="dd"><?php echo ($vo["status"]); ?></td>

                    <!--<td><a href="__URL__/amend?id=<?php echo ($tqj["id"]); ?>">修改</a>/<a href="#"  class="del" id="<?php echo ($tqj["id"]); ?>" >删除</a></td>-->
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="page right"><?php echo ($pagebar); ?></div>
    </div>

</div>


<script type="text/javascript">

    function changestr(para){

        para = para.replace(/^[^1-9]/g,'');

        para = para.replace(/[^0-9]/g,'');

        return para;
    }


    $(".btn_t").click(function(){
        var start_time=$('#start_time').val();
        var end_time=$('#end_time').val();
        if(start_time.length==0){
            alert("开始时间不能为空");
            return false;
        }
        if(end_time.length==0){
            alert("结束时间不能为空");
            return false;
        }
    });
    var status_btn_b = false;
    $(".btn_b").click(function(){
        if(status_btn_b){
            alert("请不要重复提交，如网速慢，请等待！");
            return false;
        }
        var crowd_money=$('#crowd_money').val();
        var donate_money=$('#donate_money').val();
        var deadline=$('#deadline').val();
        var start_time=$('#start_time').val();
        var end_time=$('#end_time').val();



        if(crowd_money.length==0){
            alert("在投金额不能为空");
            return false;
        }
        if(donate_money.length==0){
            alert("赠送金额不能为空");
            return false;
        }
        if(deadline.length==0){
            alert("使用期限不能为空");
            return false;
        }
        if(start_time.length==0){
            alert("开始时间不能为空");
            return false;
        }
        if(end_time.length==0){
            alert("结束时间不能为空");
            return false;
        }
        status_btn_b=true;

    });

</script>