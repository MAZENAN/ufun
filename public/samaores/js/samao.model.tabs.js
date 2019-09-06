
$(function() {

    var trim = function() {
        return this.replace(/(^\s*)|(\s*$)/g, "");
    };

    var a = $('#form-tabs b').each(function(e, t) {
        $(t).data("d", $(t).attr('idx')).click(function() {
            var e = $(this), t = e.data("d");
            a.removeClass("active"), e.addClass("active");
            $("div[id^=form_tabs_],div.form-tips").hide();
            $("#form_tabs_" + t).show();
            $("#form_tips_tabs_" + t).show();
            return false;
        });
    });
});

var old_display_allerror = $.SMF.getCustomFunc('display_allerror');
$.SMF.setCustomFunc('display_allerror',
        function(items) {
            var tabls = $(items[0].elem).parents('div[id^=form_tabs_]:first');
            if (tabls.length > 0 && tabls.attr('id') !== '') {
                var idx = tabls.attr('id').replace('form_tabs_', '');
                $($('#form-tabs b[idx=' + idx + ']')).click();
            }
            old_display_allerror(items);
        });