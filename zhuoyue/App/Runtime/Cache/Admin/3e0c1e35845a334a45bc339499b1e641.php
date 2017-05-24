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
    $(document).ready(function() {
        //swf上传图片
        swfu = new SWFUpload(
                {
                    // Backend Settings
                    upload_url: "swfupload",
                    post_params: {"PHPSESSID": "<?php echo session_id(); ?>", "dopost" : ""},

                    // File Upload Settings
                    file_size_limit : "4 MB",	// 2MB
                    file_types : "*.jpg; *.gif; *.png",
                    file_types_description : "选择 JPEG/GIF/PNG 格式图片",
                    file_upload_limit : "0",

                    file_queue_error_handler : fileQueueError,
                    file_dialog_complete_handler : fileDialogComplete,
                    upload_progress_handler : uploadProgress,
                    upload_error_handler : uploadError,
                    upload_success_handler : uploadSuccess,
                    upload_complete_handler : uploadComplete,

                    button_image_url : "../images/SmallSpyGlassWithTransperancy_17x18.png",
                    button_placeholder_id : "spanButtonPlaceholder",
                    button_width: 250,
                    button_height: 18,
                    button_text : '<span class="button">选择本地图片 <span class="buttonSmall">(单图最大为 2 MB，支持多选)</span></span>',
                    button_text_style : '.button { font-family: "微软雅黑", sans-serif; font-size: 12px; } .buttonSmall { font-size: 10pt; }',
                    button_text_top_padding: 0,
                    button_text_left_padding: 18,
                    button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
                    button_cursor: SWFUpload.CURSOR.HAND,

                    // Flash Settings
                    flash_url : "__ROOT__/Style/Swfupload/swfupload.swf",

                    custom_settings : {
                        upload_target : "divFileProgressContainer"
                    },

                    // Debug Settings
                    debug: false
                });
        //swf上传图片
    });

</script>
<script type="text/javascript">
    //swf上传后排序
    function rightPic(o){
        var o = $("#albCtok"+o);
        if( o.next().length > 0) {
            var tmp = o.clone();
            var oo = o.next();
            o.remove();
            oo.after(tmp);
        }else{
            alert("已经是最后一个了");
        }
    }
    //swf上传后排序
    function leftPic(o){
        var o = $("#albCtok"+o);
        if( o.prev().length > 0) {
            var tmp = o.clone();
            var oo = o.prev();
            o.remove();
            oo.before(tmp);
        }else{
            alert("已经是第一个了");
        }
    }
    //swf上传后删除图片start
    function delPic(id){
        var imgpath = $("#albCtok"+id).find("input[type='hidden']").eq(0).val();
        var datas = {'picpath':imgpath,'oid':id};
        $.post("__URL__/swfupload?delpic", datas, picdelResponse,'json');
    }

    function picdelResponse(res){
        var imgdiv = $("#albCtok"+res.data);
        imgdiv.remove();
        ui.success(res.info);
        ui.box.close();
    }
    //swf上传后删除图片end
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
<div class="page_tit">添加众筹</div>
<div class="page_tab"><span data="tab_1" class="active">基本信息</span><!--<span data="tab_3">车辆图片资料</span>--></div>
<div class="form2">
<form method="post" action="__URL__/add" onsubmit="return subcheck();" enctype="multipart/form-data">
<div id="tab_1">
    <dl class="lineD">
        <dt>众筹项目名称：</dt>
        <dd>
            <input name="crowd_name" id="crowd_name"  class="input" type="text" value="第<?php echo ($crowd_count); ?>期项目-<?php echo ($crowd_info["crowd_name"]); ?>" ><span id="tip_crowd_name" class="tip">*</span>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>发起人：</dt>
        <dd>
            <select name="user_name" id="user_name"   class="c_select"><option value="">--请选择--</option><?php foreach($user_name as $key=>$v){ if($crowd_info[""]==$key && $crowd_info[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_user_name" class="tip">*</span>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>发布车商：</dt>
        <dd>
            <select name="che_article" id="che_article"   class="c_select"><option value="">--请选择--</option><?php foreach($che_article as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_che_article" class="tip">*</span>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>项目金额：</dt>
        <dd>
            <input style="width: 353px;height: 17px;" type="text" value="<?php echo ($crowd_info["crowd_money"]); ?>" id="crowd_money" name="crowd_money" onkeyup="value=changestr(value)" /></td><td><span style="color: #FC8936">*</span></td>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>上线：</dt>
        <dd>
            <input name="is_use" value="1" id="is_use_0" checked="checked" type="radio"><label for="is_use_0">有效</label>&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_use" value="0" id="is_use_1"  type="radio"><label for="is_use_1">无效</label>
        </dd>
    </dl>
        <dl class="lineD">
        <dt>开始时间：</dt>
        <dd>
            <input onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="begin" id="begin"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d ',$crowd_info["start_time"])); ?>"><span id="tip_begin" class="tip">*</span>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>集资期限：</dt>
        <dd>
            <select name="zc_collect" id="zc_collect"   class="c_select"><option value="">--请选择--</option><?php foreach($zc_collect as $key=>$v){ if($zc_collect[""]==$key && $zc_collect[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_zc_collect" class="tip">*(天)</span>
            <!--<input name="has_borrow" id="has_borrow"  class="input" type="text" value="<?php echo ($vo["has_borrow"]); ?>" ><span id="tip_has_borrow" class="tip">*</span>-->
        </dd>
    </dl>
    <dl class="lineD">
        <dt>众筹最小金额：</dt>
        <dd>
            <select name="zc_min" id="zc_min"   class="c_select"><option value="">--请选择--</option><?php foreach($zc_min as $key=>$v){ if($zc_min[""]==$key && $zc_min[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_zc_min" class="tip">*(元)</span>
        </dd>
    </dl>
    <dl class="lineD">
    <dt>最长持有期限：</dt>
    <dd>
        <select name="zc_deadline" id="zc_deadline"   class="c_select"><option value="">--请选择--</option><?php foreach($zc_deadline as $key=>$v){ if($zc_deadline[""]==$key && $zc_deadline[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_zc_deadline" class="tip">*(月)</span>
    </dd>
    </dl>
    <dl class="lineD">
        <dt>分红比例：</dt>
        <dd>
            <input name="back_rate" id="back_rate"  class="input" type="text" value="<?php echo ($crowd_info["back_rate"]); ?>" ><span id="tip_back_rate" class="tip">*(该比例为投资人所分红比例,若填写10表示，该次众筹总收益的10%由投资人所分配，90%归平台所有)</span>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>溢价回购利率：</dt>
        <dd>
            <input name="withdraw_rate" id="withdraw_rate"  class="input" type="text" value="<?php echo ($crowd_info["withdraw_rate"]); ?>" ><span id="tip_withdraw_rate" class="tip">*(溢价回购比率溢价回购投资人所得收益为：投资本金*(溢价率/12)*该众筹最长持有期限)，溢价率即为年化收益率)</span>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>车型：</dt>
        <dd>
            <select name="car_type" id="car_type" class="c_select">
                <option value="">--请选择--</option>
                <option value="1" <?php if($crowd_info['car_type'] == 1): ?>selected<?php endif; ?>>轿车</option>
                <option value="2" <?php if($crowd_info['car_type'] == 2): ?>selected<?php endif; ?>>SUV/越野车</option>
                <option value="3" <?php if($crowd_info['car_type'] == 3): ?>selected<?php endif; ?>>MPV</option>
                <option value="4" <?php if($crowd_info['car_type'] == 4): ?>selected<?php endif; ?>>跑车</option>
                <option value="5" <?php if($crowd_info['car_type'] == 5): ?>selected<?php endif; ?>>皮卡</option>
                <option value="6" <?php if($crowd_info['car_type'] == 6): ?>selected<?php endif; ?>>其他</option>
            </select>
            <span id="tip_zc_deadline" class="tip">*</span>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>车辆参数：</dt>
        <dd>
            <link href="__ROOT__/Style/Editor/editor/theme/base-min.css" rel="stylesheet"/>
<!--[if lt IE 8]>
<link href="__ROOT__/Style/Editor/editor/theme/cool/editor-pkg-sprite-min.css" rel="stylesheet"/>
<![endif]-->
<!--[if gte IE 8]><!-->
<link href="__ROOT__/Style/Editor/editor/theme/cool/editor-pkg-min-datauri.css" rel="stylesheet"/>
<!--<![endif]-->
<script src="__ROOT__/Style/Editor/kissy-min.js"></script>
<script src="__ROOT__/Style/Editor/uibase-min.js"></script>
<script src="__ROOT__/Style/Editor/dd-min.js"></script>
<script src="__ROOT__/Style/Editor/component-min.js"></script>
<script src="__ROOT__/Style/Editor/overlay-min.js"></script>

<script src="__ROOT__/Style/Editor/editor/editor-all-pkg-min.js?t=20101223a"></script>
<script src="__ROOT__/Style/Editor/editor/biz/ext/editor-plugin-pkg-min.js?t=20101223a"></script>
<script>
function loadEditor(textareaId) {
    KISSY.use('editor', function() {
        var KE = KISSY.Editor;
        var EDITER_UPLOAD = "<?php echo U('/admin/kissy/index/');?>";
       
        //编辑器内弹窗 z-index 底限，防止互相覆盖
        KE.Config.baseZIndex = 10000;

        var cfg = {
            attachForm:true,
            baseZIndex:10000,
            focus:false,
            pluginConfig: {
                "image":{
                    upload:{
                        serverUrl:EDITER_UPLOAD,
                        surfix:"png,jpg,jpeg,gif,bmp",
                        sizeLimit:"2000" // K
                    }
                },
                "flash":{
                    defaultWidth:"300",
                    defaultHeight:"300"
                },
				
                "draft":{
                    interval:5,
                    limit:10,
                    helpHtml:  "<div " +
                            "style='width:200px;'>" +
                            "<div style='padding:5px;'>草稿箱能够自动保存您最新编辑的内容，" +
                            "如果发现内容丢失，" +
                            "请选择恢复编辑历史</div></div>"
                },
				
                "resize":{
                    direction:["y"]
                }
            }
        };

        KE("#"+textareaId, cfg).use(
			"sourcearea," +
            "preview,separator," +
            "undo,separator," +
            "removeformat,font,format,color,table,separator," +
            "list,indent,justify,separator," +
            "link,image,flash,xiami-music,smiley,separator," +
            "video," +
            "draft," +
            "maximize");
    });
}

function getEditorWordCount() {
	var count = 0;
	
	return count;
}
</script>
            <!-- 编辑器调用开始 -->
				<textarea name="crowd_info" id="crowd_info" style="width:980px;height:320px;"><?php echo ($table); ?></textarea>
				<script>
				
					loadEditor("crowd_info");
				
				</script>
				<!-- 编辑器调用结束 -->
        </dd>
    </dl>
    <dl class="lineD">
        <dt>项目简介：</dt>
        <dd>
            <!-- 编辑器调用开始 -->
				<textarea name="crowd_car_zk" id="crowd_car_zk" style="width:980px;height:320px;"><?php echo ($crowd_info["car_info"]); ?></textarea>
				<script>
				
					loadEditor("crowd_car_zk");
				
				</script>
				<!-- 编辑器调用结束 -->
        </dd>
    </dl>
    <dl class="lineD">
        <dt>车辆图片：</dt>
        <dd>
            <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;"><span id="spanButtonPlaceholder"></span></div>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>图片预览：</dt>
        <dd>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr id="handfield">
                    <td colspan="4" class="bline" style="background:url(images/albviewbg.gif) #fff 0 20px no-repeat;"><table width='100%' height='160' style="margin:0 0 20px 0">
                        <tr>
                            <td>

                                <div id="divFileProgressContainer" style="height:75px;"></div>
                                <div id="thumbnails">
                                    <?php $x=1000;foreach(unserialize($crowd_info['updata']) as $v){ $x--; ?>
                                    <div class="albCt" id="albCtok<?php echo $x; ?>">
                                        <img width="120" height="120" src="__ROOT__/<?php echo get_thumb_pic($v['img']); ?>"><a onclick="javascript:delPic(<?php echo $x; ?>)" href="javascript:;">[删除]</a><a onclick="javascript:leftPic(<?php echo $x; ?>)" href="javascript:;">[前移]</a><a onclick="javascript:rightPic(<?php echo $x; ?>)" href="javascript:;">[后移]</a>
                                        <div style="margin-top:10px">
                                            水印文字：<input type="text" style="width:190px;" value="<?php echo $v['info']; ?>" name="swfimglist[]">
                                            <input type="hidden" value="__ROOT__/<?php echo $v['img']; ?>" name="swfimglist[]">
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>


                            </td>
                        </tr>
                    </table></td>
                </tr>
            </table>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>合同：</dt>
        <dd>
            <!-- 编辑器调用开始 -->
				<textarea name="crowd_agreement" id="crowd_agreement" style="width:980px;height:320px;"><?php echo ($hetong); ?></textarea>
				<script>
				
					loadEditor("crowd_agreement");
				
				</script>
				<!-- 编辑器调用结束 -->
        </dd>
    </dl>
</div>
<!--tab1-->
<!--tab3-->
<!--<div id="tab_3" style="display:none">
    <dl class="lineD">
        <dt>车辆图片：</dt>
        <dd>
            <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;"><span id="spanButtonPlaceholder"></span></div>
        </dd>
    </dl>
    <dl class="lineD">
        <dt>图片预览0：</dt>
        <dd>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr id="handfield">
                    <td colspan="4" class="bline" style="background:url(images/albviewbg.gif) #fff 0 20px no-repeat;"><table width='100%' height='160' style="margin:0 0 20px 0">
                        <tr>
                            <td>

                                <div id="divFileProgressContainer" style="height:75px;"></div>
                                <div id="thumbnails">
                                    <?php $x=1000;foreach(unserialize($crowd_info['updata']) as $v){ $x--; ?>
                                    <div class="albCt" id="albCtok<?php echo $x; ?>">
                                        <img width="120" height="120" src="__ROOT__/<?php echo get_thumb_pic($v['img']); ?>"><a onclick="javascript:delPic(<?php echo $x; ?>)" href="javascript:;">[删除]</a><a onclick="javascript:leftPic(<?php echo $x; ?>)" href="javascript:;">[前移]</a><a onclick="javascript:rightPic(<?php echo $x; ?>)" href="javascript:;">[后移]</a>
                                        <div style="margin-top:10px">
                                            水印文字：<input type="text" style="width:190px;" value="<?php echo $v['info']; ?>" name="swfimglist[]">
                                            <input type="hidden" value="__ROOT__/<?php echo $v['img']; ?>" name="swfimglist[]">
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>


                            </td>
                        </tr>
                    </table></td>
                </tr>
            </table>
        </dd>
    </dl>

</div>-->
<div class="page_btm">
    <input type="submit" class="btn_b" value="确定" />
</div>
</form>
</div>
</div>
<script type="text/javascript">

    var status_1 = false;
    $('.btn_b').click(function(){
        if(status_1){
            alert("请不要重复提交，如网速慢，请等待！");
            return false;
        }
        if($('#crowd_name').val()==""){ui.error("项目名称不能为空！"); return false;}
        else if($('#user_name').val()==""){ui.error("发起人不能为空！");return false;}
        else if($('#crowd_money').val()==""){ui.error("项目金额不能为空！");return false;}
        else if($('#zc_collect').val()==""){ui.error("集资期限不能为空！");return false;}
        else if($('#zc_min').val()==""){ui.error("最小投资额度不能为空！");return false;}
        else if($('#zc_max').val()==""){ui.error("最大投资额度不能为空！");return false;}
        else if($('#zc_deadline').val()==""){ui.error("最长持有期限不能为空！");return false;}
        //else if($('#che_article').val()==""){ui.error("发起车商不能为空！");return false;}
        else {
            status_1 = true;
            return true;
        }
    });

</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>