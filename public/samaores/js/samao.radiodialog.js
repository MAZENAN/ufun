// JavaScript Document
(function($, undefined) {

    $.fn.radiodialog = function() {
        this.each(function(index, element) {
            var that = $(this);
            var pl = that.parent();
            var sendval = that.val();
            var sendvText = '';
            var idname = that.attr('id') || that.attr('name');

            var btntext = that.attr('btntext') || '请选择';
            var dltitle = that.attr('dltitle') || '请选择下面选项';
            var dlwidth = that.attr('dlwidth') || 760;
            var dlheight = that.attr('dlheight') || 550;
            var url = that.attr('data_url') || '';
            if (url == '') {
                alert('没有设置data_url连接');
            }
            var btnadd = $('<a class="samao-link-btn" style="margin-left:0px" href="#"></a>').text(btntext).insertAfter(that);
            var input = $('<span style="margin-left:10px; border:1px solid #CCC;padding:4px 10px; background:#F7F7F7" class=blu></span>').insertAfter(btnadd);

            if (sendval != '') {
                $.get(url, {id: sendval}, function(msg) {
                    sendvText = msg;
                    input.text(sendvText);
                }, 'json');
            }

            var dialog = $('<div id="radiodialog_' + idname + '" class="radiodialog"></div>').attr('title', dltitle).hide().appendTo(document.body);
            var loadurl = function(url) {
                $.get(url, function(msg) {
                    dialog.html(msg);
                    dialog.find('.optitem').each(function(index, element) {
                        var elem = $(element);
                        var elemval = elem.val();
                        if (sendval == elemval) {
                            elem.attr('checked', 'checked');
                        }
                    });
                });
            };
            $('#radiodialog_' + idname + ' .optitem').live('click', function() {
                var xitem = $(this);
                if (xitem.is(':checked')) {
                    sendval = xitem.val();
                    sendvText = xitem.attr('title');
                }
                else {
                    sendval = '';
                    sendvText = '';
                }
            });


            $('#radiodialog_' + idname + ' .samao-pagebar a').live('click', function() {
                var that = $(this);
                var xurl = that.attr('href').split('?')[1];
                loadurl(url + '?' + xurl);
                return false;
            });

            $('#radiodialog_' + idname + ' form').live('submit', function() {
                var that = $(this);
                var data = that.serialize();
                var method = that.attr('method');
                method = method.toLowerCase();
                if (method == 'get') {
                    $.get(url, data, function(msg) {
                        dialog.html(msg);
                        dialog.find('.optitem').each(function(index, element) {
                            var elem = $(element);
                            var elemval = elem.val();
                            if (sendval == elemval) {
                                elem.attr('checked', 'checked');
                            }
                        });
                    });
                }
                else {
                    $.post(url, data, function(msg) {
                    });
                }
                return false;
            });

            var iopen = function() {
                that.mousedown();
                loadurl(url);
                dialog.dialog({dialogClass: 'ui-widget-content-border', autoOpen: true, width: dlwidth, height: dlheight, modal: true, resizable: false, buttons: {
                        '确认选择': function() {
                            that.val(sendval);
                            input.text(sendvText);
                            dialog.dialog('close');
                            that.change();
                        }
                    }});
                return false;
            };

            btnadd.click(iopen);
            input.click(iopen);
        });
    };

})(jQuery);