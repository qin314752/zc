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


<div class="so_main">
    <div class="page_tit"><?php echo (L("lan_glo_21")); ?></div>

    <div class="page_tab">
        <span data="tab_1">费用规则</span>
        <!--<span data="tab_2">借款/投标规则</span>
        <span data="tab_3">积分规则</span>
        <span data="tab_4">其他规则</span>-->
    </div>

    <!-------- 搜索用户 -------->
    <div id="searchUser_div" style="display:none;">
        <div class="page_tit"><?php echo (L("lan_glo_19")); ?> [ <a href="javascript:void(0);" onclick="addWebSetting();"><?php echo (L("lan_glo_20")); ?></a> ]</div>

        <div class="form2">
            <form method="post" action="__URL__/add" onsubmit="return false;">
                <dl class="lineD">
                    <dt><?php echo (L("lan_glo_7")); ?>：</dt>
                    <dd>
                        <input name="name" class="input" id="name" type="text" value="">
                        <span><?php echo (L("lan_glo_18")); ?></span>
                    </dd>
                </dl>

                <dl class="lineD">
                    <dt><?php echo (L("lan_glo_8")); ?>：</dt>
                    <dd>
                        <input name="code" class="input" id="code" type="text" value="">
                        <span><?php echo (L("lan_glo_17")); ?></span>
                    </dd>
                </dl>

                <dl class="lineD">
                    <dt><?php echo (L("lan_glo_9")); ?>：</dt>
                    <dd>
                        <select name="type" class="input" id="type"><option value="input"><?php echo (L("lan_glo_15")); ?></option><option value="textarea"><?php echo (L("lan_glo_16")); ?></option></select>
                        <span><?php echo (L("lan_glo_14")); ?></span>
                    </dd>
                </dl>

                <dl class="lineD">
                    <dt><?php echo (L("lan_glo_10")); ?>：</dt>
                    <dd>
                        <input name="tip" class="input" id="tip" type="text" value="">
                        <span><?php echo (L("lan_glo_13")); ?></span>
                    </dd>
                </dl>

                <dl class="lineD">
                    <dt><?php echo (L("lan_glo_11")); ?>：</dt>
                    <dd>
                        <input name="order_sn" class="input" id="order_sn" type="text" value="0">
                        <span><?php echo (L("lan_glo_12")); ?></span>
                    </dd>
                </dl>

                <div class="page_btm">
                    <input type="submit" class="btn_b" id="showwait" onclick="addNewSetting();" value="<?php echo (L("lan_add_do")); ?>" />
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function addNewSetting(){
            var name=$("#name").val();
            var code=$("#code").val();
            var type=$("#type").val();
            var tip=$("#tip").val();
            var order_sn=$("#order_sn").val();

            if(name==""){
                ui.error('<?php echo (L("lan_glo_3")); ?>');
                $("#name").focus();
                return false;
            }else if(code==""){
                ui.error('<?php echo (L("lan_glo_4")); ?>');
                $("#code").focus();
                return false;
            }else if(!order_sn.match(/^[\d]+$/)){
                ui.error('<?php echo (L("lan_glo_5")); ?>');
                $("#order_sn").focus();
                return false;
            }

            var datas = {'name':name,'code':code,'type':type,'order_sn':order_sn,'tip':tip};
            $.post('__URL__/doAdd', datas,addSettingResponse,'json');
        }
        function addSettingResponse(res){
            if(!res.status){
                ui.error(res.info);
            }else{
                var name=$("#name").val('');
                var code=$("#code").val('');
                var type=$("#type").val('');
                var tip=$("#tip").val('');
                var order_sn=$("#order_sn").val('');
                ui.success('<?php echo (L("lan_add_success")); ?>');
            }
        }
    </script>

    <div class="Toolbar_inbox">
        <div class="page right"></div>
        <a onclick="addWebSetting();" class="btn_a" href="javascript:void(0);">
            <!--<span class="searchUser_action"><?php echo (L("lan_glo_6")); ?></span>-->
        </a>
    </div>

    <div class="form2">
        <form method="post" action="__URL__/doEdit">
            <div id="tab_1">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['isyc'] == 1 ): ?><dl class="lineD" id="line_<?php echo ($vo['id']); ?>">

                    <a href="javascript:void(0);" onclick="if(confirm('<?php echo (L("lan_del_confirm")); ?>')) delx('<?php echo ($vo['id']); ?>');" class="a_del" title="<?php echo (L("lan_del_do")); ?>"></a>
                    <dt><?php echo ($vo['name']); ?>：</dt>
                    <dd>
                        <?php if($vo['type'] == 'textarea' ): ?><textarea name="<?php echo ($vo['id']); ?>" class="areabox"><?php echo ($vo['text']); ?></textarea>
                            <?php else: ?>
                            <input name="<?php echo ($vo['id']); ?>" class="input" type="text" value="<?php echo ($vo['text']); ?>"><?php endif; ?>
                        <?php if($vo['tip'] != ' ' ): ?><span><?php echo ($vo['tip']); ?>(<?php echo ($vo['code']); ?>)</span><?php else: ?>(<?php echo ($vo['code']); ?>)<?php endif; ?>
                    </dd>
                </dl>
                    <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
            <div id="tab_2">
                <?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,16,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['isyc'] == 1 ): ?><dl class="lineD" id="line_<?php echo ($vo['id']); ?>">

                        <a href="javascript:void(0);" onclick="if(confirm('<?php echo (L("lan_del_confirm")); ?>')) delx('<?php echo ($vo['id']); ?>');" class="a_del" title="<?php echo (L("lan_del_do")); ?>"></a>
                        <dt><?php echo ($vo['name']); ?>：</dt>
                        <dd>
                            <?php if($vo['type'] == 'textarea' ): ?><textarea name="<?php echo ($vo['id']); ?>" class="areabox"><?php echo ($vo['text']); ?></textarea>
                                <?php else: ?>
                                <input name="<?php echo ($vo['id']); ?>" class="input" type="text" value="<?php echo ($vo['text']); ?>"><?php endif; ?>
                            <?php if($vo['tip'] != ' ' ): ?><span><?php echo ($vo['tip']); ?>(<?php echo ($vo['code']); ?>)</span><?php else: ?>(<?php echo ($vo['code']); ?>)<?php endif; ?>
                        </dd>
                    </dl>
                          <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div id="tab_3">
                <?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,22,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['isyc'] == 1 ): ?><dl class="lineD" id="line_<?php echo ($vo['id']); ?>">

                        <a href="javascript:void(0);" onclick="if(confirm('<?php echo (L("lan_del_confirm")); ?>')) delx('<?php echo ($vo['id']); ?>');" class="a_del" title="<?php echo (L("lan_del_do")); ?>"></a>
                        <dt><?php echo ($vo['name']); ?>：</dt>
                        <dd>
                            <?php if($vo['type'] == 'textarea' ): ?><textarea name="<?php echo ($vo['id']); ?>" class="areabox"><?php echo ($vo['text']); ?></textarea>
                                <?php else: ?>
                                <input name="<?php echo ($vo['id']); ?>" class="input" type="text" value="<?php echo ($vo['text']); ?>"><?php endif; ?>
                            <?php if($vo['tip'] != ' ' ): ?><span><?php echo ($vo['tip']); ?>(<?php echo ($vo['code']); ?>)</span><?php else: ?>(<?php echo ($vo['code']); ?>)<?php endif; ?>
                        </dd>
                    </dl>
                         <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <div id="tab_4">
                <?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,25,15,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['isyc'] == 1 ): ?><dl class="lineD" id="line_<?php echo ($vo['id']); ?>">

                        <a href="javascript:void(0);"
                           onclick="if(confirm('<?php echo (L("lan_del_confirm")); ?>')) delx('<?php echo ($vo['id']); ?>');" class="a_del"
                           title="<?php echo (L("lan_del_do")); ?>"></a>
                        <dt><?php echo ($vo['name']); ?>：</dt>
                        <dd>
                            <?php if($vo['type'] == 'textarea' ): ?><textarea name="<?php echo ($vo['id']); ?>" class="areabox"><?php echo ($vo['text']); ?></textarea>
                                <?php else: ?>
                                <input name="<?php echo ($vo['id']); ?>" class="input" type="text" value="<?php echo ($vo['text']); ?>"><?php endif; ?>
                            <?php if($vo['tip'] != ' ' ): ?><span><?php echo ($vo['tip']); ?>(<?php echo ($vo['code']); ?>)</span>
                                <?php else: ?>
                                (<?php echo ($vo['code']); ?>)<?php endif; ?>
                        </dd>
                    </dl>
                        <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="page_btm">
                <input type="submit" class="btn_b" value="<?php echo (L("lan_edit_do")); ?>" />
            </div>
        </form>

    </div>

</div>

<script>
    $(document).ready(function(){
        $(".lineD").mouseover(function(){
                    $(this).find(".a_del").css("display","block")
                }
        )
        $(".lineD").mouseleave(function(){
                    $(this).find(".a_del").css("display","none")
                }
        )
    });

    function delx(id){
        var datas = {'id':id};
        $.post('<?php echo U("global/doDelweb");?>', datas,delSettingResponse,'json');
    }

    function delSettingResponse(res){
        if(res.status){
            $("#line_"+res.id).css("display","none");
            ui.success('<?php echo (L("lan_del_success")); ?>');
        }else{
            ui.error(res.message);
        }
    }

    var isSearchHidden = 1;
    function addWebSetting() {
        if(isSearchHidden == 1) {
            $("#searchUser_div").slideDown("fast");
            $(".searchUser_action").html("<?php echo (L("lan_glo_22")); ?>");
            isSearchHidden = 0;
        }else {
            $("#searchUser_div").slideUp("fast");
            $(".searchUser_action").html("<?php echo (L("lan_glo_23")); ?>");
            isSearchHidden = 1;
        }
    }

</script>

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>