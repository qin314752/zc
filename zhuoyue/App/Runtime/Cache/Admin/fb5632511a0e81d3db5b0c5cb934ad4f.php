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
<script type="text/javascript" src="__ROOT__/Style/A/js/uploadPreview.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#imgfile").uploadPreview({width:100,height:50,imgDiv:"#imgDiv",imgType:["bmp","gif","png","jpg"],maxwidth:3169,maxheight:4759});
	});
</script>
<div class="so_main">
  <div class="page_tit"><?php echo ($position); ?>管理</div>


  <!-------- 添加编辑友情链接 -------->
  <div id="addAttr_div" style="display:none;">
  	<div class="page_tit">添加友情链接 [ <a href="javascript:void(0);" onclick="addWebSetting();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="post" action="<?php echo U('global/addFriend');?>" onsubmit="return addNewFriend();" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>友情链接名称：</dt>
      <dd>
        <input name="link_txt" class="input" id="link_txt" type="text" value="">
        <span>前台显示的链接文字</span>
      </dd>
    </dl>
        <dl class="lineD">
            <dt>链接类型：</dt>
            <dd style="overflow:hidden;">
                <input type="radio" name="type" id="type" value="1" checked="checked" /><label for="yes">合作机构</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="type" id="type" value="0" /><label for="no">保障机构</label>
                <span></span>
            </dd>
        </dl>
    <dl class="lineD">
      <dt>链接地址：</dt>
      <dd>
        <input name="link_href" class="input" id="link_href" type="text" value="http://">
        <span>文字的网址</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>显示位置：</dt>
      <dd>
	  	<select name="link_type" class="input" id="link_type" onchange="showgame();">
	  	<?php if(is_array($friend_position)): $k = 0; $__LIST__ = $friend_position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
        <span>友情链接在前台的哪个页面显示</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>显示顺序：</dt>
      <dd>
        <input name="link_order" class="input" id="link_order" type="text" value="0">
        <span>数字越大顺序越靠前</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>友情链接图片：</dt>
      <dd style="overflow:hidden; margin-left:5px">
	  	<input type="file" id="imgfile" name="imgfile" style="float:left"/>
        <span style="float:left"><div style="text-align:left; clear:both; overflow:hidden; width:290px; height:50px"><div id="imgDiv"></div></div></span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>是否显示：</dt>
      <dd style="overflow:hidden;">
	  	<input type="radio" name="is_show" id="yes" value="1" checked="checked" /><label for="yes">是</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="is_show" id="no" value="0" /><label for="no">否</label>
        <span></span>
      </dd>
    </dl>
		 
    <div class="page_btm">
	  <input type="hidden" name="fid" id="fid" value="" disabled="disabled" />
      <input type="submit" class="btn_b" id="showwait" onclick="addNewSetting();" value="添加" />
    </div>
	</form>
  </div>
  </div>
  
<div class="suggestion_wrap" id="suggestion_wrap" style="display:none">
	<div class="suggestion_box">
		<ul id="suggestion_con">
		</ul>
	</div>
</div>
<script type="text/javascript">
var show_sn;
 function addNewFriend(){
 	var name=$("#link_txt").val();
 	var lhref=$("#link_href").val();
	
	if(name==""){
		ui.error('友情链接名不能为空');
		$("#link_txt").focus();
		return false;
	}else if(lhref.length < 8){
		ui.error('友情链接地址不能不填');
		$("#link_href").focus();
		return false;
	}else{
		return true;
	}
}

var isSearchHidden = 1;
function addWebSetting(s) {

	if(!arguments[0]){
		F_isSearchHidden = 0;
		searchFriend(4);
	}

	if(isSearchHidden == 1) {
		$("#addAttr_div").slideDown("fast");
		$(".addAttr_action").html("添加完毕");
		isSearchHidden = 0;
	}else {
		$("#addAttr_div").slideUp("fast");
		$(".addAttr_action").html("添加友情链接");
		isSearchHidden = 1;
	}
}
</script> 
  
<!--添加友情链接-->

  <!-------- 搜索友情链接 -------->
  <div id="searchFriend_div" style="display:none;">
  	<div class="page_tit">搜索友情链接 [ <a href="javascript:void(0);" onclick="searchFriend();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="post" action="<?php echo U('global/searchFriend');?>">
    <dl class="lineD">
      <dt>友情链接名称：</dt>
      <dd>
        <input name="link_txt" class="input" id="link_txt" type="text" value="">
        <span>不填则不限</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>友链接地址：</dt>
      <dd>
        <input name="link_href" class="input" id="link_href" type="text" value="">
        <span>支持模糊查询</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>显示位置：</dt>
      <dd>
	  	<select name="link_type" class="input" id="link_type">
		<option value="0">请选择</option>
	  	<?php if(is_array($friend_position)): $k = 0; $__LIST__ = $friend_position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
        <span>不选择则不限</span>
      </dd>
    </dl>

    <dl class="lineD">
      <dt>是否显示：</dt>
      <dd style="overflow:hidden;">
	  	<input type="radio" name="is_show" id="yes" value="1" /><label for="yes">是</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="is_show" id="no" value="0" /><label for="no">否</label>
        <span>不选择则不限</span>
      </dd>
    </dl>
		 
    <div class="page_btm">
      <input type="submit" class="btn_b" id="showwait" onclick="searchFriend();" value="搜索" />
    </div>
	</form>
  </div>
  </div>
<script type="text/javascript">
var F_isSearchHidden = 1;
function searchFriend(s) {
	
	if(!arguments[0]){
		isSearchHidden = 0;
		addWebSetting(4);
	}
	
	if(F_isSearchHidden == 1) {
		$("#searchFriend_div").slideDown("fast");
		$(".searchFriend_action").html("搜索完毕");
		F_isSearchHidden = 0;
	}else {
		$("#searchFriend_div").slideUp("fast");
		$(".searchFriend_action").html("搜索友情链接");
		F_isSearchHidden = 1;
	}
}
</script>

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
	<a onclick="addWebSetting();" class="btn_a" href="javascript:void(0);">
		<span class="addAttr_action">添加友情链接</span>
	</a>
	<a onclick="searchFriend();" class="btn_a" href="javascript:void(0);">
		<span class="searchFriend_action">搜索友情链接</span>
	</a>
    <a href="javascript:void(0);" class="btn_a" onclick="del_f();"><span>删除<?php echo ($position); ?></span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">链接文字</th>
      <th class="line_l">链接类型</th>
    <th class="line_l">链接地址</th>
    <th class="line_l">链接图片</th>
    <th class="line_l">显示位置</th>
    <th class="line_l">是否显示</th>
    <th class="line_l">排序</th>
    <th class="line_l">操作</th>
  </tr>
  	<?php $_REQUEST['p'] = isset($_REQUEST['p'])?$_REQUEST['p']:0; $cpage = (intval($_REQUEST['p'])<=1)?0:intval($_REQUEST['p']); $j=($cpage*C('ADMIN_PAGE_SIZE') + 1); ?>
  <?php if(is_array($friend_list)): $i = 0; $__LIST__ = $friend_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="area_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo $j; ?></td>
          <td><span id="name_<?php echo ($vo['id']); ?>"><?php echo ($vo["link_txt"]); ?></span></td>
          <td><span id="name_<?php echo ($vo['id']); ?>"><?php if($vo["type"] == 1): ?>合作机构<?php else: ?>保障机构<?php endif; ?></span></td>

        <td><span id="lhref_<?php echo ($vo['id']); ?>"><a href="<?php echo ($vo["link_href"]); ?>" target="_blank"><?php echo ($vo["link_href"]); ?></a></span></td>
        <td><div style="float:left;" id="img_<?php echo ($vo['id']); ?>"><?php if(strlen($vo['link_img']) > 3) echo '<img src="__ROOT__/'.$vo['link_img'].'" width="50" height="50" alt="'.$vo['attr_title'].'" />';else echo '无图'; ?></div></td>
		<td><span id="link_type_<?php echo ($vo['id']); ?>"><?php echo ($vo["link_type"]); ?></span></td>
		<td><span id="is_show_<?php echo ($vo['id']); ?>"><?php echo ($vo["is_show"]); ?></span></td>
		<td><span id="link_order_<?php echo ($vo['id']); ?>"><?php echo ($vo["link_order"]); ?></span></td>
        <td>
            <a href="javascript:void(0);" onclick="edit_f(<?php echo ($vo['id']); ?>);">编辑</a> 
            <a href="javascript:void(0);" onclick="del_f(<?php echo ($vo['id']); ?>);">删除</a>  
        </td>
      </tr>
	<?php $j++; endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
	<a onclick="addWebSetting();" class="btn_a" href="javascript:void(0);">
		<span class="addAttr_action">添加友情链接</span>
	</a>
	<a onclick="searchFriend();" class="btn_a" href="javascript:void(0);">
		<span class="searchFriend_action">搜索友情链接</span>
	</a>
    <a href="javascript:void(0);" class="btn_a" onclick="del();"><span>删除<?php echo ($position); ?></span></a>
  </div>
</div>

<script type="text/javascript">

	var ps = '<?php echo ($position); ?>';
	var type = '<?php echo ($type); ?>';
    //编辑地区
    function edit_f(par_id) {
		$("#fid").attr("disabled","");
		var name = $("#name_"+par_id).html();
		var lhref = $("#lhref_"+par_id).find("a").attr("href");
		var imgd = $("#img_"+par_id).html();
		var link_type = $("#link_type_"+par_id).html();
		var is_show = $("#is_show_"+par_id).html();
		var link_order = $("#link_order_"+par_id).html();
		var link_game = $("#link_game_"+par_id).html();
		
		if(link_type=="首页") s_v = 1;
		else s_v = 2;
		
		if(is_show=="是") s_r = 1;
		else s_r = 0;
		
		$("#fid").val(par_id);
		$("#link_txt").val(name);
		$("#link_href").val(lhref);
		$("#link_type option[value='"+s_v+"']").attr("selected","selected");
		$("#link_order").val(link_order);
		$("#imgDiv").html(imgd);
		$("input:[type=radio]:[value='"+s_r+"']").attr("checked",true);//
		
		if(link_game != "无"){
			$("#game_name").val(link_game);
			$("#game_friend").show();
			$("#game_name").attr("disabled","");
		}else{
			$("#game_friend").val('');
			$("#game_friend").hide();
			$("#game_name").attr("disabled","disabled");
		}
		
		
		$("#area_"+par_id).remove();
		isSearchHidden = 1;
		addWebSetting();
    }
    
    //删除
    function del_f(aid) {
        aid = aid ? aid : getChecked();
        aid = aid.toString();
        if(aid == '') return false;

		//提交修改
		var datas = {'idarr':aid,'type':type};
		$.post('__URL__/doDeleteFriend', datas,delResponseF,'json');
    }
	
	function delResponseF(res){
				if(res.success == '0') {
					ui.error('删除失败');
				}else {
					aid = res.aid.split(',');
					$.each(aid, function(i,n){
						$('#area_'+n).remove();
					});
					ui.success('删除成功');
				}
	}	
    //鼠标移动表格效果
    $(document).ready(function(){
        $("tr[overstyle='on']").hover(
          function () {
            $(this).addClass("bg_hover");
          },
          function () {
            $(this).removeClass("bg_hover");
          }
        );
    });
    
    function checkon(o){
        if( o.checked == true ){
            $(o).parents('tr').addClass('bg_on') ;
        }else{
            $(o).parents('tr').removeClass('bg_on') ;
        }
    }
    
    function checkAll(o){
        if( o.checked == true ){
            $('input[name="checkbox"]').attr('checked','true');
            $('tr[overstyle="on"]').addClass("bg_on");
        }else{
            $('input[name="checkbox"]').removeAttr('checked');
            $('tr[overstyle="on"]').removeClass("bg_on");
        }
    }

    //获取已选择用户的ID数组
    function getChecked() {
        var gids = new Array();
        $.each($('input:checked'), function(i, n){
            gids.push( $(n).val() );
        });
        return gids;
    }
</script>

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>