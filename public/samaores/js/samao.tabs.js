(function($, undefined) {
    var Config = $.SMF.Config;
    $.fn.samaotabs = function() {	
		this.each(function(index, element) {
            var that = $(this);
            var form = $(this.form);
            var boxval = that.val();
			var idname=that.attr('name');
			that.removeAttr('name');
			
            var size = that.attr('length') || 0;
            var min_size = that.attr('min-length') || 1;
			var valarr = [];
            if (boxval != '' && boxval!=null) {
                valarr = $.evalJSON(boxval) || [];
            }
            var pl = that.parent();
            pl.delegate('a.btnadd', 'click', function() {
                if (size != 0 && size <= pl.find('div.item').length) {
                    alert('最大只允许添加' + size + '项！');
                    return false;
                }
                addbox();
                if (size != 0 && size <= pl.find('div.item').length) {
                    $(this).attr('disabled', true);
                }
                return false;
            });
			
			pl.delegate('a.btndel', 'click', function() {
                if (min_size != 0 && min_size >= pl.find('div.item').length) {
                        alert('至少需要一项');
                        return false;
                }
				$(this).parent().remove();
                pl.find('a.btnadd:last').show();
				chkinput();
                return false;
            });
			
            var chkinput = function() {
                var inputs = pl.find(":input[name='" + idname + "[]']");
                var oo = inputs.filter(function(index, element) {
                    return $(element).val() == '';
                });
                if (inputs.length == oo.length) {
                    pl.find(":input[name='" + idname + "[]']:first").attr('data_val_off', false);
                } else {
                    pl.find(":input[name='" + idname + "[]']:first").attr('data_val_off', true);
                }
                if (size == 0 || pl.find('div.item').length < size) {
                    pl.find('a.btnadd:last').show();
                }
            };
            pl.delegate(":input[name='" +idname + "[]']", 'blur change keypress', function() {
                chkinput();
            });
			
            var pl = $('<div class="layout-arrtabs"></div>').insertBefore(that);
            if (min_size == 0) {
                var itebtns = $('<div class=".item-btns"></div>').appendTo(pl);
                $('<a class="samao-link-btn btnadd" style="margin-left:0px" href="#">添加</a>').appendTo(itebtns);
            }

            var initfirstbox = function() {
                var opts = [
                    Config.rules,
                    Config.valmsg,
                    Config.valmsg_default,
                    Config.valmsg_valid,
                    Config.val_events,
                    Config.val_msgfor];
                var box = pl.find(":input[name='" + idname+ "[]']:first");
                for (var i in opts) {
                    var opt = opts[i];
                    if (that.attr(opt) !== undefined && that.attr(opt) != '') {
                        box.attr(opt, that.attr(opt));
                        that.removeAttr(opt);
                    }
                }
            };

            var addbox = function(vals) {
                var xitem = $('<div class="item"></div>').appendTo(pl);
                var box= $('<input class="form-control stext" type="text"/>').attr('name',idname+'[]').appendTo(xitem);
                if (vals) {
					box.val(vals);
                }
				$('<a class="samao-link-btn btndel" style="margin-left:10px" href="#">删除</a>').appendTo(xitem);
                $('<a class="samao-link-btn btnadd" href="#">添加</a>').appendTo(xitem);
                pl.find('a.btnadd').hide();
                initfirstbox();
                chkinput();
                if ($.fn.initSMFInputs) {
                    xitem.find(':input[type!=submit][type!=reset][type!=button][disabled!=disabled]').initSMFInputs();
                }
                return false;
            };
            var len = valarr.length;
			for (var n = 0; n < len; n++) {
				addbox(valarr[n]);
            }
            if (len == 0) {
                if (min_size > 0) {
                    addbox();
                }

            }
        });
    };
})(jQuery);
