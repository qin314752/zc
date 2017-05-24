 var count = '${sliderList}';
 count = count.length;
	
$(function(){
	
	//top
	var id=0;
	$('.header-nav-ul li').hover(function(){
		$('.header-nav-ul li').each(function(){
			if($(this).attr('class')=='header-nav-active')
			{
				id=$(this).data('id');
			}
			
		})

			$(this).addClass('header-nav-active');
			$('.header-nav-ul li').eq(id).addClass('header-nav-active');

	},function(){
		
		$(this).removeClass('header-nav-active');
		$('.header-nav-ul li').eq(id).addClass('header-nav-active');
	})
	
	
	$('.banner ul li').eq(0).show();
	//banner
	$('.opacity').css('opacity','0.5');

	$('.user-gain-first').animate({top:'54px'},'slow',function(){

		$(this).animate({top:'30px'},1000);
	});

	$('.enter-login').click(function(){
		$('.user-gain-first').stop();
		$('.user-gain-first').css('top','350px');
		$('.user-gain-second').animate({top:'54px'},'slow',function(){

		$(this).animate({top:'30px'},1000);

	});
	})

	$('.enter-regist').click(function(){
		$('.user-gain-second').stop();
		$('.user-gain-second').css('top','350px');
		$('.user-gain-first').animate({top:'54px'},'slow',function(){

		$(this).animate({top:'30px'},1000);

	});
	})

		$('.user-gain-three').animate({top:'120px'},'slow',function(){
			$(this).animate({top:'60px'},1000);
		});


	//contain-right
	$('.contain-right-toggle').hover(function(){
		$(this).children('a').css('color','#14a9ff');
		$(this).css('border-bottom','1px solid #14a9ff');
		$(this).siblings().children('a').css('color','#666');
		$(this).siblings().css('border-bottom','none');
		var id=$(this).data('id');
		$('.contain-right-toggle-text').eq(id).show();
		$('.contain-right-toggle-text').eq(id).siblings('div').hide();

	})
	$('.contain-right-toggle2').hover(function(){
		$(this).children('a').css('color','#14a9ff');
		$(this).css('border-bottom','1px solid #14a9ff');
		$(this).siblings().children('a').css('color','#666');
		$(this).siblings().css('border-bottom','none');
		var id=$(this).data('id');
		$('.contain-right-toggle2-text').eq(id).show();
		$('.contain-right-toggle2-text').eq(id).siblings('div').hide();
		
	})
	
	
	function run()
	{
		if($('.banner ul li:visible').data('id')==5)
		{
			$('.banner ol li').eq(0).addClass('active');
	 		$('.banner ol li').eq(0).siblings().removeClass('active');
			$('.banner ul li:visible').fadeToggle('normal');
			$('.banner ul li').first().fadeToggle('normal');

		}
		else
		{
			var id = $('.banner ul li:visible').data('id');
			$('.banner ol li').eq(id+1).addClass('active');
	 		$('.banner ol li').eq(id+1).siblings().removeClass('active');
			$('.banner ul li:visible').fadeToggle('normal');
			$('.banner ul li:visible').next().fadeToggle('normal');

		}
	}
	   setInterval(run, 8000); 

	 $('.banner ol li').click(function(){
	 	var id=$(this).data('id');
	 	$('.banner ul li').eq(id).siblings().fadeOut('normal');
	 	$('.banner ul li').eq(id).fadeIn('normal');
	 	$(this).addClass('active');
	 	$(this).siblings().removeClass('active');
	 	
	 });


	 //partner
	 $('.arrow-right').click(function(){
		if($('.partner ul').is(":animated")){
		
		
		}
		else
		{
			$('.partner ul').stop();
			$('.partner ul li').last().after($('.partner ul li').first());	
			$('.partner ul').css('left','0px');
			$('.partner ul').animate({left:'-=163px'},'slow','swing');
		}
		
	 });
	 $('.arrow-left').click(function(){
		 if($('.partner ul').is(":animated")){
			 
			 
		 }
		 else
			 {
			 	$('.partner ul').stop();
				$('.partner ul li').first().before($('.partner ul li').last());
				$('.partner ul').css('left','-326px');
				$('.partner ul').animate({left:'+=163px'},'slow','swing');
			 
			 
			 }
		
	 });
	 autoclick();
	 function autoclick(){
			$(".partner-box-right .arrow-right").trigger("click");  //让系统自动执行单击事件
			$autoFun = setTimeout( autoclick, 3000 ); //设置3秒钟之后再次执行函数

			}

	
	 $('.hot-porject-menu li').click(function(){
		$(this).addClass('porject-active');
		$(this).siblings('li').removeClass('porject-active');
		var id ="."+ $(this).data("id");
		$(id).css('display',"block");
		$(id).siblings('.porject').css('display','none');
	 });
	 
}) 