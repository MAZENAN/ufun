// JavaScript Document

(function($, undefined) {

    $.fn.initTinyMCE = function(options) {
        var that = $(this);
        var id = that.attr('id');
        if (!id) {
            id = 'tinymce_' + new Date().getTime();
            that.attr('id', id);
        }
        options = options || {};
        options.language = 'zh_CN';

        options.plugins = options.plugins || [
            "advlist autolink lists link samaoimage charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ];

        var editor = that.tinymce(options);
        return editor;
    };
})(jQuery);

