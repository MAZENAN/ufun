// JavaScript Document
(function($, undefined) {
    $.fn.fadbox = function(type) {
        this.each(function(index, element) {
            var fadrdg = $(element);
            //单选
            if (type == 'radiogroup') {
                fadrdg.delegate("a", "click", function() {
                    var that = $(this);
                    if (that.is('.disabled')) {
                        return;
                    }
                    fadrdg.find("a").removeClass("selected");
                    that.addClass("selected");
                    var val = that.attr("data_value");
                    fadrdg.prev('input').mousedown().val(val);
                    return false;
                });
            }
            //多选
            if (type == 'checkgroup') {
                fadrdg.delegate("a", "click", function() {
                    var that = $(this);
                    if (that.is('.disabled')) {
                        return;
                    }
                    if (that.is('.selected')) {
                        that.removeClass("selected");
                    }
                    else {
                        that.addClass("selected");
                    }
                    var vals = [];
                    fadrdg.find("a.selected").each(function(idx, elem) {
                        var val = $(elem).attr("data_value");
                        vals.push(val);
                    });
                    var valstr = $.toJSON(vals);
                    fadrdg.prev('input').mousedown().val(valstr);
                    return false;
                });
            }
        });

    };
})(jQuery);