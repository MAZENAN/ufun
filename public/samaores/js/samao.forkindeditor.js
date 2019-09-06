// JavaScript Document

(function($, undefined) {
	
    $.fn.oldVal = $.fn.val;
    $.fn.val = function(value) {
        var _this = this;
        var editor = null;
        if (value === undefined) {
            if (_this[0] && (_this[0].kindeditor)) {
                editor = _this[0].kindeditor;
                return editor.html();
            }
            return _this.oldVal();
        }//读
        return _this.each(function() {
            if (this.kindeditor) {
                editor = this.kindeditor;
                editor.html(value);
            }
            else{
                _this.oldVal(value);
            }
        });
    };
	$.fn.initKindEditor=function(options){
		 var that = $(this);
		 var editor=KindEditor.create(this,options);
		 that[0].kindeditor=editor;
		 that.focus(function(){ editor.focus();});
		 return editor;
	};
})(jQuery);
