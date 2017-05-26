// JavaScript Document

//右边浮动层效果
$(document).ready(function(){
	
	$(".rightFloat .div-two").mouseover(function(e) {
		e.preventDefault();
		$(".div-two .qq").show();
	});
	$(".rightFloat .div-two").mouseout(function(e) {
		e.preventDefault();
		$(".div-two .qq").hide();
	});
	
	$(".rightFloat .div-three").mouseover(function(e) {
		e.preventDefault();
		$(".div-three .phone").show();
	});
	$(".rightFloat .div-three").mouseout(function(e) {
		e.preventDefault();
		$(".div-three .phone").hide();
	});
	
	$(".rightFloat .div-four").mouseover(function(e) {
		e.preventDefault();
		$(".div-four .wb-ewm").show();
	});
	$(".rightFloat .div-four").mouseout(function(e) {
		e.preventDefault();
		$(".div-four .wb-ewm").hide();
	});
	
	//浮动层自动隐藏显示
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('.rightFloat .div-five').show();
		} else {
			$('.rightFloat .div-five').hide();
		}
	});
	//返回顶部
	$('.rightFloat .div-five').click(function(e) {
		e.preventDefault();
		$('body,html').animate({scrollTop:0},500);
	});
	
});

// 首页快捷登录页签效果
$(document).ready(function() {
	var $investlist = $(".quick-login .title ul li a.active");
	var $investlisttab = $("#form1");
	$(".quick-login .title ul li a").click(function(e) {
		e.preventDefault();

		var $this = $(this);
		$investlist.toggleClass("active");
		$investlisttab.hide();

		$investlist = $this;
		$investlist.toggleClass("active");
		$investlisttab = $($this.attr("href"));
		$investlisttab.show();
	});
});

// 首页新闻动态
$(document).ready(function() {
	var $newslist = $(".news .title a.active");
	var $newslisttab = $("#notice");
	$(".news .title a").mouseover(function(e) {
		e.preventDefault();

		var $this = $(this);
		$newslist.toggleClass("active");
		$newslisttab.hide();

		$newslist = $this;
		$newslist.toggleClass("active");
		$newslisttab = $($this.attr("href"));
		$newslisttab.show();
	});
});



//帮助中心
$(document).ready(function(){
	
	$("a.navigation").click(function(e){
		e.preventDefault();
	  
		var $this = $(this);
		var href = $this.attr("href");
		$(href).toggle();
		$this.toggleClass("current");
	});
	
});

//留言板块点击回复
$(document).ready(function(){
	
	var $reply = $(".reply-btn");
	var $replyForm = $(".reply-form");
	$reply.click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		$replyForm = $($this.attr("href"));
		$replyForm.toggleClass("hide");
	});	
});

//账户中心导航效果
$(document).ready(function(){
	var $navItems = $(".nav-left div.nav .nav-item");
	var $currentItem = null;
	var $currentItemPanel = null;
	var $item_panel_a_actve = $(".item-panel a.active");
	var $item_panel_a = $(".item-panel a");
	//点击一级栏目效果
	$navItems.click(function(){
		
		if($currentItem != null && $currentItemPanel != null) {
			$navItems.removeClass("active");
			$currentItem.toggleClass("active");
			$currentItemPanel.hide();
			$item_panel_a_actve.removeClass("active");
		}
			$navItems.removeClass("active");
			$currentItem = $(this).toggleClass("active");
			$(".item-panel").css("display","none");
			$currentItemPanel = $(this).find(".item-panel").show();
			$item_panel_a_actve.removeClass("active");
	});
	//点击二级栏目效果
	$item_panel_a.click(function(){
		
		$item_panel_a.removeClass("active");
		$item_panel_a = $(this).toggleClass("active");
	});

});


//文章页面导航效果
$(document).ready(function(){
	var $navItems = $(".left-nav .nav-item");
	var $currentItem = null;
	var $currentItemPanel = null;
	var $item_panel_a_actve = $(".item-panel a.active");
	var $item_panel_a = $(".item-panel a");
	//点击一级栏目效果
	$navItems.click(function(){
		
		if($currentItem != null && $currentItemPanel != null) {
			$navItems.removeClass("active");
			$currentItem.toggleClass("active");
			$currentItemPanel.hide();
			$item_panel_a_actve.removeClass("active");
		}
			$navItems.removeClass("active");
			$currentItem = $(this).toggleClass("active");
			$(".item-panel").css("display","none");
			$currentItemPanel = $(this).find(".item-panel").show();
			$item_panel_a_actve.removeClass("active");
	});
	//点击二级栏目效果
	$item_panel_a.click(function(){
		
		$item_panel_a.removeClass("active");
		$item_panel_a = $(this).toggleClass("active");
	});

});


// 安全中心内容效果
$(document).ready(function() {
	
	var $settings = $("a.setting");
	// 显示触发器
	$settings.bind("settingShow", function() {
		var $this = $(this);
		$this.addClass("setting-ing");
		// 设置/修改时
		$this.text($this.hasClass("setting-no") ? $this.data("setting-no-cancel") : ($this.hasClass("setting-yes") ? $this.data("setting-yes-cancel") : ""));
		// 出现
		$($this.attr("href")).slideDown();
	});
	// 隐藏触发器
	$settings.bind("settingHide", function() {
		var $this = $(this);
		$this.removeClass("setting-ing");
		// 设置时
		if ($this.hasClass("setting-no")) {
			$this.text($this.data("setting-no"));
		}
		// 修改时
		else if ($this.hasClass("setting-yes")) {
			$this.text($this.data("setting-yes"));
		}
		// 隐藏
		$($this.attr("href")).slideUp();
	});
	// 点击事件
	$settings.bind("click", function(e) {
		e.preventDefault();
		var $this = $(this);
		// 隐藏触发器（隐藏非当前所有）
		$settings.not($this).trigger("settingHide");
		// 显示/隐藏触发器
		$this.trigger(!$this.hasClass("setting-ing") ? "settingShow" : $this.trigger("settingHide"));
	});
	
    //实名认证
	$(".cancel-one").click(function(e) {
		e.preventDefault();
		
		var $this = $("#identity_a");
		var href = $this.attr("href");
		
		$this.removeClass("setting-ing");
			// 设置时
			if ($this.hasClass("setting-no")) {
				$this.text($this.data("setting-no"));
			}
			// 修改时
			else if ($this.hasClass("setting-yes")) {
				$this.text($this.data("setting-yes"));
			}
			
		$("#identity").slideUp("fast");
	});
	
	//邮箱认证
	$(".cancel-two").click(function(e) {
		e.preventDefault();
		
		var $this = $("#email_a");
		var href = $this.attr("href");
		
		$this.removeClass("setting-ing");
			// 设置时
			if ($this.hasClass("setting-no")) {
				$this.text($this.data("setting-no"));
			}
			// 修改时
			else if ($this.hasClass("setting-yes")) {
				$this.text($this.data("setting-yes"));
			}
			
		$("#email").slideUp("fast");
	});
	
    //手机认证
	$(".cancel-three").click(function(e) {
		e.preventDefault();
		
		var $this = $("#phone_a");
		var href = $this.attr("href");
		
		$this.removeClass("setting-ing");
			// 设置时
			if ($this.hasClass("setting-no")) {
				$this.text($this.data("setting-no"));
			}
			// 修改时
			else if ($this.hasClass("setting-yes")) {
				$this.text($this.data("setting-yes"));
			}
			
		$("#phone").slideUp("fast");
	});
	
    //设置提现密码
	$(".cancel-four").click(function(e) {
		e.preventDefault();
		
		var $this = $("#withdraw_password_a");
		var href = $this.attr("href");
		
		$this.removeClass("setting-ing");
			// 设置时
			if ($this.hasClass("setting-no")) {
				$this.text($this.data("setting-no"));
			}
			// 修改时
			else if ($this.hasClass("setting-yes")) {
				$this.text($this.data("setting-yes"));
			}
			
		$("#withdraw_password").slideUp("fast");
	});
	
	//修改提现密码
	$(".cancel-five").click(function(e) {
		e.preventDefault();
		
		var $this = $("#withdraw_modify_a");
		var href = $this.attr("href");
		
		$this.removeClass("setting-ing");
			// 设置时
			if ($this.hasClass("setting-no")) {
				$this.text($this.data("setting-no"));
			}
			// 修改时
			else if ($this.hasClass("setting-yes")) {
				$this.text($this.data("setting-yes"));
			}
			
		$("#withdraw_modify").slideUp("fast");
	});
	
	//找回提现密码
	$(".cancel-six").click(function(e) {
		e.preventDefault();
		
		var $this = $("#withdraw_find_a");
		var href = $this.attr("href");
		
		$this.removeClass("setting-ing");
			// 设置时
			if ($this.hasClass("setting-no")) {
				$this.text($this.data("setting-no"));
			}
			// 修改时
			else if ($this.hasClass("setting-yes")) {
				$this.text($this.data("setting-yes"));
			}
			
		$("#withdraw_find").slideUp("fast");
	});
	
	//修改登录密码
	$(".cancel-seven").click(function(e) {
		e.preventDefault();
		
		var $this = $("#login_password_a");
		var href = $this.attr("href");
		
		$this.removeClass("setting-ing");
			// 设置时
			if ($this.hasClass("setting-no")) {
				$this.text($this.data("setting-no"));
			}
			// 修改时
			else if ($this.hasClass("setting-yes")) {
				$this.text($this.data("setting-yes"));
			}
			
		$("#login_password").slideUp("fast");
	});

});

//标题页签效果
$(document).ready(function(){

	var $lastinvest = $(".details .tab a.active");
	var $lastinvesttab = $("#tab-one");
	$(".details .tab a").click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		$lastinvest.toggleClass("active");
		$lastinvesttab.hide();
		
		$lastinvest = $this;
		$lastinvest.toggleClass("active");
		$lastinvesttab = $($this.attr("href"));
		$lastinvesttab.show();
	});
	
});


//提现银行卡选中效果
$(document).ready(function(){
	
	var $navItem1 = $(".bankCards_list_li");
	var $navItem2 = $(".card a");
	var $currentItem = null;
	$navItem1.click(function() {
		if($currentItem != null) {
			$navItem1.removeClass("active");
			$navItem2.removeClass("active");
			$currentItem.toggleClass("active");
		}
		$navItem1.removeClass("active");
		$navItem2.addClass("active");
		$currentItem = $(this).toggleClass("active");
	});
	
});

// 标列表页搜索效果
$(document).ready(function() {

	$(document).ready(function() {
		$type = $(".search .type.active")
		$credit = $(".search .credit.active")
		$term= $(".search .term.active")
		$mendian= $(".search .mendian.active")
		
		$(".search .type").click(function(e) {
			e.preventDefault();

			var $this = $(this);
			$type.toggleClass("active");

			$type = $this;
			$type.toggleClass("active");

		});
		
		$(".search .credit").click(function(e) {
			e.preventDefault();

			var $this = $(this);
			$credit.toggleClass("active");

			$credit = $this;
			$credit.toggleClass("active");

		});
		
		$(".search .term").click(function(e) {
			e.preventDefault();

			var $this = $(this);
			$term.toggleClass("active");

			$term = $this;
			$term.toggleClass("active");

		});
		
		$(".search .mendian").click(function(e) {
			e.preventDefault();

			var $this = $(this);
			$mendian.toggleClass("active");

			$mendian = $this;
			$mendian.toggleClass("active");

		});
		
	});

});

//标的详情页页签效果
$(document).ready(function(){

	var $lastinvest = $(".Details .title a.active");
	var $lastinvesttab = $("#Details-content-one");
	$(".Details .title a").click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		$lastinvest.toggleClass("active");
		$lastinvesttab.hide();
		
		$lastinvest = $this;
		$lastinvest.toggleClass("active");
		$lastinvesttab = $($this.attr("href"));
		$lastinvesttab.show();
	});
	
});

/*//账户中心页签效果1
$(document).ready(function(){
	var $lastprocess = $(".invest .invest-title a.active");
	var $lastprocessUl = $("#table-one");
	$(".invest .invest-title a").click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		$lastprocess.toggleClass("active");
		$lastprocessUl.hide();
		
		$lastprocess = $this;
		$lastprocess.toggleClass("active");
		$lastprocessUl = $($this.attr("href"));
		$lastprocessUl.show();
	});
});

//账户中心页签效果2
$(document).ready(function(){
	var $lastprocess = $(".invest .invest-title-one a.active");
	var $lastprocessUl = $("#table-one");
	$(".invest .invest-title-one a").click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		$lastprocess.toggleClass("active");
		$lastprocessUl.hide();
		
		$lastprocess = $this;
		$lastprocess.toggleClass("active");
		$lastprocessUl = $($this.attr("href"));
		$lastprocessUl.show();
	});
	
});
*/

// 注册方式切换
$(document).ready(function() {
	$("#email-icon").click(function(){
		$(".email-ul").removeClass("hide");
		$(".phone-ul").addClass("hide");
	})
	$("#phone-icon").click(function(){
		$(".phone-ul").removeClass("hide");
		$(".email-ul").addClass("hide");
	})
});


//信用贷申请流程页签效果
/*$(document).ready(function(){
	var $lastprocess = $(".process .title-info a.active");
	var $lastprocessUl = $("#form-one");
	$(".process .title-info a").click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		$lastprocess.toggleClass("active");
		$lastprocessUl.hide();
		
		$lastprocess = $this;
		$lastprocess.toggleClass("active");
		$lastprocessUl = $($this.attr("href"));
		$lastprocessUl.show();
	});
	
});
*/