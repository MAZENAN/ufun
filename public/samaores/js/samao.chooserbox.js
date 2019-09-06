(function ($, undefined) {
    var Chooserbox = function (obj) {
        var that = $(obj);
        var btn = $('<a class="samao-link-btn btndel" style="margin-left:5px;" href="#">选择</a>').insertAfter(that);
        var url = that.attr('data_url');
        var textact = that.attr('textact') || '';
        var dlg_width = that.attr('dlg_width') || 580;
        var dlg_height = that.attr('dlg_height') || 400;
        if (that.attr('btntext')) {
            btn.text(that.attr('btntext'));
        }
        if (that.is(':disabled')) {
            btn.attr('disabled', 'disabled');
        }
        if (textact && that.val() > 0) {
            $.post(url, {action: textact, value: that.val()}, function (rev) {
                if (rev.value) {
                    that.val(rev.value);
                }
                if (rev.text) {
                    that.prev('input').val(rev.text);
                }
            }, 'json');
        }

        var title = that.attr('title') || '选择菜单';
        btn.on('click', function () {
            if (that.is(':disabled')) {
                return;
            }
            window.opDialog(url, 'chooserbox', title, function (rev) {
                console.log(rev);
                if (rev) {
                    if (typeof (rev) == 'string') {
                        that.val(rev);
                    }
                    else {
                        if (rev.value) {
                            that.val(rev.value);
                        }
                        if (rev.text) {
                            that.prev('input').val(rev.text);
                        }
                    }
                }
            }, {width: dlg_width, height: dlg_height});
        });
    };
    $.fn.chooserbox = function () {
        this.each(function (index, element) {
            element.Chooserbox = new Chooserbox(element);
        });
    };
}
)(jQuery);

