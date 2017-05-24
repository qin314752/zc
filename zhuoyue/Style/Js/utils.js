$(function() {

    (function() {
        var time = 0;
        $(".navigation-item").mouseenter(function() {
            var that = $(this);
            clearTimeout(time);
            time = setTimeout(function() {
                var next = that.find(".navigation-list-two-con"),
                width = that.width(),
                eleWidth = next.width(),
                cha = (eleWidth - width) / 2;
                that.addClass("select");
                next.css("left", -cha);
                next.find(".nav-sanjiao").css("left", eleWidth / 2 - 6);
                next.stop().fadeIn(0);
            },
            0);
        }).mouseleave(function() {
            var that = $(this),
            listTwo = that.find(".navigation-list-two-con");
            clearTimeout(time);
            setTimeout(function() {
                if (that.hasClass("select")) {
                    that.removeClass("select");
                    that.find(".navigation-list-two-con").stop().fadeOut(0);
                }
            },
            0);
        });
    })();
});