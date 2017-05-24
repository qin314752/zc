jQuery(function() {

    // 返回顶部按钮自动隐藏
    jQuery(window).scroll(function(){
        if (jQuery(window).scrollTop()>200){
            jQuery('#goTop').fadeIn();
        }else if(jQuery(window).scrollTop()<200){
            jQuery('#goTop').fadeOut();
        }
    });

    // 返回顶部按钮
    jQuery('#goTop').click(function() {
        jQuery("html, body").animate({scrollTop:0}, 200);
    });



    // 语音开关
    var music = document.getElementById("bgMusic");

    jQuery("#audioBtn").click(function(){

        if(music.paused){
            music.play();
            jQuery("#audioBtn").removeClass("pause").addClass("play");
        }else{
            music.pause();
            jQuery("#audioBtn").removeClass("play").addClass("pause");
        }
    });
    
    jQuery(".float-rig li").hover(function () {
    	jQuery(this).addClass("h");
    }, function () {
    	jQuery(this).removeClass("h");
   });
});
