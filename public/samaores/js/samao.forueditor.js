// JavaScript Document

(function($, undefined) {

    $.fn.oldVal = $.fn.val;
    $.fn.val = function(value) {
        var _this = this;
        var editor = null;
        if (value === undefined) {
            if (_this[0] && (_this[0].ueditor)) {
                editor = _this[0].ueditor;
                editor.sync();
            }
            return _this.oldVal();
        }//读
        return _this.each(function() {
            if (this.ueditor) {
                editor = this.ueditor;
                editor.setContent(value);
            }
            else {
                _this.oldVal(value);
            }
        });
    };
    $.fn.initUeditor = function() {
        var that = $(this);
        var id = that.attr('id');
        if (!id) {
            id = 'ueditor_' + new Date().getTime();
            that.attr('id', id);
        }
     
        var editor = UE.getEditor(id);
        that[0].ueditor = editor;
        that.focus(function() {
            editor.focus();
        });
        return editor;
    };
})(jQuery);
