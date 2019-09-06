// JavaScript Document
(function($, undefined) {
    $.fn.validcode = function(options) {
        var _this = $(this);
        var url = options.url || '/service/code.php';
        _this.one('focus', function() {
            var td = _this.parent('td').next('td');
            var img = $('<img/>');
            img.attr('src', url);
            img.click(function() {
                this.src = url + '?r=' + Math.random();
            });
            td.empty().append(img).css('width', '55px');
            var std = $('<td width="55" style="padding:0"></td>');
            var a = $('<a href="#">看不清?</a>').click(function() {
                img.click();
                return false;
            }).appendTo(std);
            std.insertAfter(td);
        });
    };
})(jQuery);