
(function($, undefined) {
    $.fn.ajaxselect = function() {
        this.each(function(index, element) {
            var that = $(element);
            that.empty();
            var selectedval = that.attr('selectvalue') || that.val() || '';
            var headerstr = that.attr('header') || '';
            var options = [];
            if (headerstr) {
                if (/^".*"$/.test(headerstr) || /^\[.*\]$/.test(headerstr)) {
                    eval('options.push(' + headerstr + ');');
                } else {
                    options.push(headerstr);
                }
            }
            var url = that.attr('data_url');
            $.post(url, function(items) {
                for (var i = 0; i < items.length; i++) {
                    options.push(items[i]);
                }
                var optgroup = null;
                var isopengroup = false;
                for (var i = 0; i < options.length; i++) {
                    var opt = options[i];
                    if ($.type(opt) == 'array') {
                        var selected = selectedval == opt[0];
                        if (opt[0] == '--') {
                            if (opt[2] == 'option') {
                                var optitem = new Option(opt[1] || opt[0], '');

                                $(optitem).css({color: '#999999'}).attr('disabled', 'disabled');
                                if (optgroup && isopengroup) {
                                    optgroup.append(optitem);
                                }
                                else {
                                    that.append(optitem);
                                }

                            } else {
                                if (optgroup && isopengroup) {
                                    that.append(optgroup);
                                }
                                optgroup = $('<optgroup></optgroup>').attr('label', opt[1] || opt[0]);
                                isopengroup = true;
                            }
                        } else {
                            var text = opt[1] || opt[0];
                            if (opt[2]) {
                                text = text + ' | ' + opt[2]
                            }
                            var optitem = new Option(text, opt[0]);
                            optitem.selected = selected;
                            if (optgroup && isopengroup) {
                                optgroup.append(optitem);
                            }
                            else {
                                that.append(optitem);
                            }
                        }
                    }
                    else {
                        var selected = selectedval == opt;
                        var optitem = new Option(opt, opt);
                        optitem.selected = selected;
                        that.append(optitem);
                    }
                }
                if (optgroup && isopengroup) {
                    that.append(optgroup);
                }
            }, 'json');
        });
    };
})(jQuery);

$(function() {
    $('select').each(function(index, element) {
        var that = $(element);
        that.data('selectedIndex', element.selectedIndex);
        that.change(function() {
            if (this[this.selectedIndex].disabled) {
                this.selectedIndex = $(this).data('selectedIndex') || 0;
                alert('该选项已被禁选,请选择其他选项。');
            } else {
                $(this).data('selectedIndex', this.selectedIndex || 0);
            }
        });
    });
});
$(document).ready(function(){
    $("#mobile").on("keyup",function(){
        var mobileval=$(this).val();
        $(this).val(mobileval.replace(/\D|^0/g,''));
    });
});
