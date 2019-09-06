// JavaScript Document
$(function() {
    $('a.load').each(function(index, element) {
        $(element).click(function() {
            var that = $(this);
            var url = that.attr('href');
            var bg = $('<div></div>').css({'width': '100%', 'height': '100%', 'position': 'absolute', 'background-color': '#000', 'opacity': '0.1', 'top': '0px'}).appendTo(document.body);
            var top = ($(document).height() - 100) / 2;
            var left = ($(document).width() - 260) / 2;
            var msg = $('<div class="smloadingbox">处理进行中,请稍后...</div>').css({'top': top + 'px', 'left': left + 'px'}).appendTo(document.body);
            $.get(url, function(dat) {
                if (dat.status) {
                    msg.removeClass().addClass('smloadingbox-yes').text(dat.msg);
                }
                else {
                    msg.removeClass().addClass('smloadingbox-no').text(dat.msg);
                }
                setTimeout(function() {
                    location.reload();
                }, 500);

            }, 'json');
            return false;
        });
    });
});