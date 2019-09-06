// JavaScript Document

if (window.console) {
    window.console.log("技术支持：北京银彩互通科技有限公司(zcsing.com)\n 下属公司：海口尚来网络科技有限公司(web0898.com)\n 联系电话：18611287980(郭先生)\n 电子邮件：guoshaoyi@qq.com");
}

$(document).ready(function () {
    $(".head-customer").hover(function () {
        $(this).find("h1").addClass("on");
        $(this).find("ul").show();
        $(".head-tel").css({borderColor: "#f3f3f3"});
    }, function () {
        $(this).find("h1").removeClass("on");
        $(this).find("ul").hide();
        $(".head-tel").css({borderColor: "#dddddd"});
    });

    $(".floor-list ul li").hover(function () {
        $(this).addClass("on");
    }, function () {
        $(this).removeClass("on");
    });

    $(".theme ul li").hover(function () {
        $(this).addClass("on");
    }, function () {
        $(this).removeClass("on");
    });

    $(".camp ul li").hover(function () {
        $(this).addClass("on");
    }, function () {
        $(this).removeClass("on");
    });

    $(".user-menu-list ul li:last-child h1").css("border", "none");
    $(".user-menu-three a:last-child").css("border", "none");

    $(document).ready(function () {
        $(".user-prompt-box").click(function () {
            $(this).find("div").slideToggle();
            $(this).parent().parent().toggleClass("on");
        });
    });

    $(".head-customer-t").hover(function () {
        $(this).find("h1").addClass("on");
        $(this).find(".subnav-flow").show();
        $(".head-tel").css({borderColor: "#f3f3f3"});
    }, function () {
        $(this).find("h1").removeClass("on");
        $(this).find(".subnav-flow").hide();
        $(".head-tel").css({borderColor: "#dddddd"});
    });

});

//div 水平垂直居中


$(document).ready(function () {
    var hei = $(window).height();
    var mah = $(".marauto").height();
    $(".marauto").css({
        "padding-top": (hei - mah) / 2 + "px"
    });
});

$(window).resize(function () {
    var hei = $(window).height();
    var mah = $(".marauto").height();
    $(".marauto").css({
        "padding-top": (hei - mah) / 2 + "px"
    });
});








