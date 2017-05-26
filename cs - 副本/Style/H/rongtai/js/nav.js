jQuery(function() {
	jQuery(".navbar li.ui_nav_item").hover(function () {
		jQuery(this).addClass("show");
    }, function () {
    	jQuery(this).removeClass("show");
   });
});
