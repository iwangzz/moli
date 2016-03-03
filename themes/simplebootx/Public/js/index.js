var controllers = {
    investment: function () {
        $("#investment").slideBox({direction: "top"}), $("#notice-list").slideBox({direction: "top"}), $("#dynamic-data").slideBox({
            direction: "top",
            delay: 5
        }), $(".statistics-roll").slideBox({direction: "top", delay: 5})
    }, init: function () {
        controllers.investment(), controllers.events()
    }, events: function () {
        $(".icon-yard").stop().hover(function () {
            $(".integral .background").addClass("icon-integral").removeClass("icon-barcode"), $(".integral-view").hide(), $(".barcode-view").show()
        }), $(".integral").stop().hover(function () {
        }, function () {
            $(".integral .background").addClass("icon-barcode").removeClass("icon-integral"), $(".integral-view").show(), $(".barcode-view").hide()
        }), $(".honour .left .m-tabs a").click(function () {
            var t = $(this).parent().parent().next().find(".on-active");
            return controllers.tabs($(this).index(), t, $(this)), !1
        }), $(".honour .right .m-tabs a").click(function () {
            var t = $(this).parent().parent().next().find(".on-active");
            return controllers.tabs($(this).index(), t, $(this)), !1
        }), $(".cooperate .m-tabs a").click(function () {
            var t = $(this).parent().parent().next().find(".on-active");
            return controllers.tabs($(this).index(), t, $(this)), !1
        }), $("#bbs_href").attr("href", "http://www.yidai.com/api/bbslogin/"), $(".honour .m-tabs a").click(controllers.honour)
    }
};
$(function () {
    controllers.init()
});