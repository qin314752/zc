// JavaScript Document
$(function() {
	   
	/*站内信
	$('.msg_read').click(function(e) {
	   if($(this).parent().siblings('.msg_cont').css('display') == 'none'){
			   $(this).parent().siblings('.msg_cont').css({'display':'block'});
			   var status=$(this).attr('data-status');
			   if(status==0){
				   $(this).removeClass('f_bold');
				   $(this).addClass('f_normal');
				   var id=$(this).attr('data-id');
				   var user_id=$(this).attr('user-id');
				   $.ajax({
					   type: 'get',
					   url: '/?user&m=message/viewed&action=viewed&id='+id+'&user_id='+user_id
					});
				}
			}
			else{
			   $(this).parent().siblings('.msg_cont').css({'display':'none'})
			}
   	 });*/
	 
	  $('#allcheck').click(function(e) {
              if(document.getElementById("allcheck").checked){
                 $('input[data-type="aid"]').attr("checked",true);
              }else{
                 $('input[data-type="aid"]').attr("checked",false);
              }             
      });



	   
	   //筛选
	   $(".ui_filter_tag").click(function(){
		   $(this).parent().find('li').removeClass("active");
		   $(this).parent().find('input').removeAttr("checked");
		   $(this).addClass('active');
		   $(this).find('input').attr("checked",'checked');
	   });
	   
	   //轮播图片居中
       var slid_w = $(".flexslider").width();
	   	   marg_l= 1920-slid_w;
	   $(".flexslider .slides img").css({"margin-left":-marg_l/2})
	   
	   //众筹列表第三个
		$("#zc_list .zc-list-item:eq(2),#zc_list .zc-list-item:eq(5),#zc_list .zc-list-item:eq(8),#zc_list .zc-list-item:eq(11),#zc_list .zc-list-item:eq(14)").css({"margin-right":"0"});
    });
	
	//在线客服
	 $("#leftsead a").hover(function(){
        if($(this).prop("className")=="youhui"){
            $(this).children("img.hides").show();
        }else{
            $(this).children("div.hides").show();
            $(this).children("img.shows").hide();
            $(this).children("div.hides").animate({marginRight:'0px'},'0'); 
        }
    },function(){ 
        if($(this).prop("className")=="youhui"){
            $(this).children("img.hides").hide();
        }else{
            $(this).children("div.hides").animate({marginRight:'-163px'},0,function(){$(this).hide();$(this).next("img.shows").show();});
        }
    });

    $("#top_btn").click(function(){if(scroll=="off") return;$("html,body").animate({scrollTop: 0}, 600);});

	//右侧导航 - 二维码
	$(".youhui").mouseover(function(){
		$(this).children(".2wm").show();
	})
	$(".youhui").mouseout(function(){
		$(this).children(".2wm").hide();
	});
	
	$(window).load(function(){
      $('.flexslider').flexslider({
        animation: "fade",
		slideshowSpeed: 6000,
		pauseOnAction: false, 
		directionNav: false, 
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
	  
	  $('.flexslider2').flexslider({
        animation: "slide",
		slideshowSpeed: 6000,
		pauseOnAction: false, 
		controlNav: false, 
		directionNav: true, 
		prevText: "",
 		nextText: "",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
	  
	  	//确认弹窗
	   $("#btn-confirm").click(function(e) {
			layer.open({
				  title:'确认弹窗',
				  content:'确定要执行此操作吗？',
				  icon:3,
				  btn: ['确定','取消'],
				  yes: function(index, layero){ 
						alert("确定回调");
				  },
				  cancel: function(index){
					
				  }
			});
		}); 
		
	 //登录弹窗 
	$("#login-btn").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['登录', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#login-window') 
		});
    }); 
	
	//头像上传 
	$("#user_head_img").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['头像上传', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#head_upload') 
		});
    }); 
	
	
	//实名认证 
	$("#edit_realname").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['实名认证', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#edit_realname_window') 
		});
    }); 
	
	//邮箱认证 
	$("#add_mail").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['邮箱认证', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#add_mail_window') 
		});
    }); 
	
	//邮箱修改
	$("#edit_mail").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['邮箱认证', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#edit_mail_window') 
		});
    }); 
	
	//手机认证 
	$("#add_phone").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['手机认证', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#add_phone_window') 
		});
    }); 
	
	//修改手机 
	$("#edit_phone").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['修改手机号码', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#edit_phone_window') 
		});
    }); 
	
	//设置支付密码 
	$("#set_paypwd").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['设置支付密码', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#set_paypwd_window') 
		});
    }); 
	
	//修改支付密码 
	$("#edit_paypwd").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['修改支付密码', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#edit_paypwd_window') 
		});
    }); 
	
	//找回支付密码 
	$("#find_paypwd").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['找回支付密码', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#find_paypwd_window') 
		});
    }); 	
	
	//修改支付密码 
	$("#edit_loginpwd").click(function(e) {
        layer.open({
			type: 1,
			skin: 'layui-layer-rim', //加上边框
			title: ['修改登录密码', 'font-size:18px; height:55px; padding-top:5px'],
			area: ['550px'], //宽高
			shift:0,  //动画0-6
			move: false,
			content: $('#edit_loginpwd_window') 
		});
    }); 
		
	//反对按钮
	$("#vote-against").click(function() {
		layer.msg('反对票投票成功！', {
		//icon: 1,
		time: 2000
			}, function(){
				window.location.reload();
			});  
	}); 
	
	//赞成按钮
	$("#vote-agree").click(function() {
		layer.msg('赞成票投票成功！', {
		//icon: 1,
		time: 2000
			}, function(){
				window.location.reload();
			});  
	});
	
	/*签到
	$("#sign_in").click(function() {
		$.ajax({
			url: "xxxx/account/integral/sign_in",
			data: null,
			type: "post",
			dataType: "json",
			cache: false,
			beforeSend: function(request, settings) {
				request.setRequestHeader("token", $.cookie("token"));
			},
			success: function(message) {
				if (message.type == "success") {
					layer.msg('签到成功，积分+1', {icon: 1,time: 2000}, function(){
						$("#sign_in").attr("disabled","disabled").html("已签到");
					});
				} else {
					layer.msg(message.cont, {icon: 1,time: 2000}, function(){
						$("#sign_in").attr("disabled","disabled").html("已签到");
					});
				}
			}
		});
	});*/
	
	//用户中心左右等高
	var user_h = $("#user_left_nav").parent(".wrap-1200-mid").height();
	$("#user_right_main,#user_left_nav").css({"min-height":user_h});
	
	//用户中心左边导航
	$(".usernav li.hassub").click(function() {
		$(this).toggleClass("subopen").next(".subnav").slideToggle();
        $(this).siblings(".subnav").not($(this).next()).slideUp();
		$(this).siblings(".hassub").not($(this)).removeClass("subopen");		
    });
	$(".subopen").next(".subnav").show();
	
	$(".close-parent").bind("click",function(){
		$(this).parent().slideUp();
	});
	
	
	//关于我们leftnav
	$(".aboutnav").hover(function() {
        $(this).find("b").animate({top:"0"},300);
    },function() {
        $(this).find("b").animate({top:"75px"},300);
    }
	
	);
	
		
});//$(function()

