// JavaScript Document
$.SMF.setCustomFunc('display_error',function(msg, elem, data){
	    elem.removeClass($.SMF.Config.input_valid).removeClass($.SMF.Config.input_default).addClass($.SMF.Config.input_error);
        if (msg) {
			layer.tips(msg, elem[0], {
				//guide: 1,
				//time: 1,
				style: ['background-color:#F26C4F; color:#fff', '#F26C4F'],
				maxWidth:240
			});
	
            //var msglabel = getMsgLabel(elem);
           // msglabel.removeClass(Config.field_valid).removeClass(Config.field_default).addClass(Config.field_error);
           // msglabel.html(msg);
        }
});