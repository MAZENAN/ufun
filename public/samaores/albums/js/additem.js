(function($, undefined) {
    $.fn.additembox = function(options) {
        this.each(function(index, element) {
            var that = $(element);
            var url = options.url;
            var css = options.css || 'form-control fadbox';
            var lable = $('<span class="dtadd-btns"></span>').insertAfter(that);
            var addbtn = $('<a class="samao-link-btn" href="javascript:;">新建相册</a>').appendTo(lable);
			var layout=$('<span></span>').hide().appendTo(lable);
            var addbox = $('<input class="form-control stext" placeholder="相册名称" type="text" />').appendTo(layout);
			var openbox = $('<input name="open" type="checkbox" value="1" checked="checked" />').css('margin-left','10px').appendTo(layout);
			var span = $('<span>是否公开</span>').appendTo(layout);
			var btns=$('<span></span>').hide().css('margin-left','10px').appendTo(lable);
			
            var okbtn = $('<a class="samao-link-btn" style="margin-left:3px" href="javascript:;">保存</a>').appendTo(btns);
			var csbtn = $('<a class="samao-link-btn" style="margin-left:3px" href="javascript:;">取消</a>').appendTo(btns);
			
            addbtn.click(function() {
                layout.show();
                btns.show();
				addbtn.hide();
                return false;
            });
			
			csbtn.click(function() {
                layout.hide();
                btns.hide();
				addbtn.show();
                return false;
            });
			
            okbtn.click(function() {
                var val = addbox.val();
                var boxval = that.val();
                if (val == '') {
                    alert('相册名称不能为空！');
                    addbox.focus();
                    return false;
                }
                $.post(url, {pid: boxval, name: addbox.val(),open:openbox.is(':checked')?1:0}, function(dat) {
                    if (dat.error) {
                        alert(dat.error);
                        return false;
                    }
                    layout.hide();
                    btns.hide();
					addbtn.show();
					
                    addbox.val('');
                    addbtn.text('添加');
                    if (that.attr('ajaxselect')) {
                        if (dat.id) {
                            that.attr('selectvalue', dat.id);
                        } else {
                            that.attr('selectvalue', boxval);
                        }
                        that.ajaxselect();
                    }
                    if (that.attr('fadbox')) {
                        var nitem = $('<a href="javascript:;"></a>').attr({'data_name': dat.name, 'data_value': dat.id}).text(dat.name);
                        nitem.appendTo(that);
                        nitem.click();
                    }
                }, 'json');
                return false;
            });

        });
    };
})(jQuery);