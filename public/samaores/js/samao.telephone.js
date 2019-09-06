(function($, undefined) {
    var Config = $.SMF.Config;
    $.fn.telephone = function() {
        this.each(function(index, element) {
            var that = $(this);
            var form = $(this.form);
            var boxval = that.val();
            var arr = boxval.split(' ');
            var gqbox_val = '';
            var sqbox_val = '';
            var telbox_val = '';
            var fjbox_val = '';
            if (arr[0] !== undefined) {
                gqbox_val = arr[0];
            }
            if (arr[1] !== undefined) {
                var arr2 = arr[1].split('-');
                if (arr2[0] !== undefined) {
                    sqbox_val = arr2[0];
                }
                if (arr2[1] !== undefined) {
                    telbox_val = arr2[1];
                }
                if (arr2[2] !== undefined) {
                    fjbox_val = arr2[2];
                }
            }
            var css = that.attr('class');
            var attr = {};
            attr.disabled = that.is(':disabled') ? true : false;
            attr[Config.rules] = that.attr(Config.rules) || '';
            attr[Config.val_off] = that.attr(Config.val_off) || '';
            attr[Config.valmsg] = that.attr(Config.valmsg) || '';
            attr[Config.valmsg_default] = that.attr(Config.valmsg_default) || '';
            attr[Config.valmsg_valid] = that.attr(Config.valmsg_valid) || '';
            attr[Config.val_events] = that.attr(Config.val_events) || '';
            attr[Config.val_msgfor] = that.attr(Config.val_msgfor) || '';

            var placeholder = that.attr('placeholder') || '';
            var placeholders = null;
            if (placeholder != '') {
                placeholders = placeholder.split('|');
            }

            that.removeAttr('style');
            that.removeAttr('remote');
            that.removeAttr('class');
            that.removeAttr('length');
            that.removeAttr(Config.data_url);
            that.removeAttr(Config.rules);
            that.removeAttr(Config.val_off);
            that.removeAttr(Config.valmsg);
            that.removeAttr(Config.valmsg_default);
            that.removeAttr(Config.valmsg_valid);
            that.removeAttr(Config.val_events);
            that.removeAttr(Config.val_msgfor);

            function addattr(selector, nlevel) {
                var opts = [
                    Config.rules,
                    Config.valmsg,
                    Config.valmsg_default,
                    Config.valmsg_valid,
                    Config.val_events,
                    Config.val_msgfor];
                for (i in opts) {
                    var opt = opts[i];
                    var key = opt + nlevel;
                    if (attr[key] === undefined) {
                        attr[key] = that.attr(key) || attr[opt];
                        that.removeAttr(key);
                    }
                    if (attr[key] !== '') {
                        selector.attr(opt, attr[key]);
                    }
                }
                if (attr.disabled) {
                    selector.attr('disabled', attr.disabled);
                }
            }

            var updateValue = function() {
                if (gqbox.val() == '' || sqbox.val() == '' || telbox.val() == '') {
                    return;
                }
                if (fjbox.val() != '') {
                    boxval = gqbox.val() + ' ' + sqbox.val() + '-' + telbox.val() + '-' + fjbox.val();
                }
                else {
                    boxval = gqbox.val() + ' ' + sqbox.val() + '-' + telbox.val();
                }
                that.val(boxval);
            };

            var gqbox = $('<input type="text"/>').val(gqbox_val).attr('class', css).css({
                'width': '40px',
                'margin-right': '3px'

            }).on('blur keyup change', updateValue).insertAfter(that);
            var sqbox = $('<input type="text"/>').val(sqbox_val).attr('class', css).css({
                'width': '50px',
                'margin-right': '3px'

            }).on('blur keyup change', updateValue).insertAfter(gqbox);
            var telbox = $('<input type="text"/>').val(telbox_val).attr('class', css).css({
                'width': '90px',
                'margin-right': '3px'

            }).on('blur keyup change', updateValue).insertAfter(sqbox);
            var fjbox = $('<input type="text"/>').val(fjbox_val).attr('class', css).css({
                'width': '50px'

            }).on('blur keyup change', updateValue).insertAfter(telbox);
            if (placeholders[0] != undefined) {
                gqbox.attr('placeholder', placeholders[0]);
            }
            if (placeholders[1] != undefined) {
                sqbox.attr('placeholder', placeholders[1]);
            }
            if (placeholders[2] != undefined) {
                telbox.attr('placeholder', placeholders[2]);
            }
            if (placeholders[3] != undefined) {
                fjbox.attr('placeholder', placeholders[3]);
            }


            form.bind('submit', function() {
                if (gqbox.val() == '' || sqbox.val() == '' || telbox.val() == '') {
                    return;
                }
                if (fjbox.val() != '') {
                    boxval = gqbox.val() + ' ' + sqbox.val() + '-' + telbox.val() + '-' + fjbox.val();
                }
                else {
                    boxval = gqbox.val() + ' ' + sqbox.val() + '-' + telbox.val();
                }
                that.val(boxval);
            });


            addattr(gqbox, 1);
            addattr(sqbox, 2);
            addattr(telbox, 3);
            addattr(fjbox, 4);
        });
    };
})(jQuery);