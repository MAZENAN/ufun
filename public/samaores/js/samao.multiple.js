// JavaScript Document
(function($, undefined) {
    $.fn.multiple = function() {
        var Data = [];
        var valbox = $(this);//要填充的输入框
        var title = valbox.attr('dltitle') || '选择内容';
        var btntext = valbox.attr('btntext') || '点击选择';
        var size = valbox.attr('length') || 3;//数量
        var id = valbox.attr('id') || 'mc_' + new Date().getTime();
        var data_url = valbox.attr($.SMF.Config.data_url) || '';//路径
        if (data_url === '') {
            alert('没有数据地址');
            return;
        }
        size = Number(size);
        var button = $('<input class="samao-mini-btn smbox-multiple" value="' + btntext + '" type="button" />').insertBefore(valbox);
        var showerid = valbox.attr('shower') || 'mc_shower_' + id;
        var shower = $('#'.showerid);
        if (shower.length <= 0) {
            shower = $('<div class="samao-multiple-shower"></div>').attr('id', showerid).appendTo(valbox.parent());
        }
        shower.hide();
        var Dialog = $('<div></div>').hide().appendTo($(document.body)).dialog({
            autoOpen: false,
            dialogClass: 'ui-widget-content-border',
            height: 500, width: 600,
            modal: true,
            title: title,
            resizable: false,
            buttons: {
                '确定': function() {
                    var puts = Dialog.find('input.valbox:checked');
                    var length = puts.length;
                    if (length > size) {
                        alert('最多只能选择' + size + '个选项！');
                        return false;
                    }
                    var ids = [];
                    for (var i = 0; i < puts.length; i++) {
                        var pval = $(puts[i]).parents('ul:first').data('val');
                        var mval = $(puts[i]).val();
                        ids.push([pval, mval]);
                    }
                    if (ids.length <= 0) {
                        valbox.val('');
                    }
                    else {
                        valbox.val($.toJSON(ids));
                    }
                    SetText(ids);
                    valbox.change();
                    Dialog.dialog('close');
                },
                '取消': function() {
                    Dialog.dialog('close');
                }
            }
            , open: function() {
                InitVal();
            }
        });
        if (typeof ($.fn.uiframe) === 'function') {
            Dialog.uiframe();
        }
        button.click(function() {
            valbox.mousedown();
            Dialog.dialog('open');
        });

        var SetText = function(ids) {
            if (ids == null) {
                var str = valbox.val();
                if (str != '') {
                    ids = $.parseJSON(str);
                }
                else {
                    ids = [];
                }
            }
            var Text = [];
            for (var i = 0; i < Data.length; i++) {
                var T = Data[i][2];
                var M = [];
                for (var j = 0; j < T.length; j++) {
                    for (var k = 0; k < ids.length; k++) {
                        if (T[j][0] == ids[k][1]) {
                            M.push(T[j][1]);
                            break;
                        }
                    }
                }
                if (M.length > 0) {
                    Text.push('<b>' + Data[i][1] + '</b> > <span>' + M.join('</span> , <span>') + '</span>');
                }
            }
            if (Text.length > 0) {
                shower.show().html(Text.join('<br>'));
            }
            else
            {
                shower.hide().html('');
            }
        };

        var Init = function(Dat) {
            Data = Dat;
            for (var i = 0; i < Dat.length; i++) {
                var items = $('<div class="samao-multiple-items-title"><b class="open"></b></div>').appendTo(Dialog);
                var label = $('<span></span>').html(Dat[i][1]).appendTo(items);
                if (Dat[i][2].length != 0) {
                    var itemsul = $('<ul class="samao-multiple-items"></ul>').data('val', Dat[i][0]).appendTo(Dialog);
                    items.click(function() {
                        var $this = $(this).find('b');
                        if (!$this.hasClass('open')) {
                            $this.parent().next('ul').show();
                            $this.addClass('open');
                        }
                        else {
                            $this.removeClass('open');
                            $this.parent().next('ul').hide();
                        }
                    });

                    for (var j = 0; j < Dat[i][2].length; j++) {
                        var itemli = $('<li></li>');
                        var boxid = 'samao_temp_' + id + '_' + i + '_' + j;
                        var put = $('<input id="' + boxid + '" class="valbox" type="checkbox"/>').val(Dat[i][2][j][0]).appendTo(itemli);
                        put.click(function() {
                            var puts = Dialog.find('input.valbox:checked');
                            var length = puts.length;
                            if (length > size) {
                                alert('最多只能选择' + size + '个选项！');
                                return false;
                            }
                            if (this.checked) {
                                $(this).parent('li').addClass('checked');
                            } else {
                                $(this).parent('li').removeClass('checked');
                            }
                            return true;
                        });
                        $('<label for="' + boxid + '"></label>').html(Dat[i][2][j][1]).appendTo(itemli);
                        itemli.appendTo(itemsul);
                    }
                }
            }
            SetText();
        };
        var InitVal = function() {
            var boxs = Dialog.find('input.valbox:checked');
            $(boxs).each(function(index, element) {
                var $element = $(element).removeAttr('checked')
                $element.parent('li').removeClass('checked');
            });
            var str = valbox.val();
            if (str != '') {
                var ids = $.parseJSON(str);
                for (var i = 0; i < ids.length; i++) {
                    var tval = ids[i][1];
                    var box = Dialog.find('input.valbox[value=' + tval + ']');
                    box.attr('checked', 'checked');
                    box.parent('li').addClass('checked');
                }
            }
        };

        $.get(data_url, {}, function(dat) {
            Init(dat);
        }, 'json');
    };
})(jQuery);