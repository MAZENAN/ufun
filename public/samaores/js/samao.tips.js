var getMsgLabel=function(a){var b=a.attr($.SMF.Config.val_msgfor)||"",c=null;if(""!=b)c=$(b);else{var d=a.attr("id")||a.attr("name");c=$('<span id="temp_info_'+d+'"></span>').appendTo(a.parent()),a.attr($.SMF.Config.val_msgfor,"temp_info_"+d)}return c};!function(a){a.fn.smtip=function(b){b=b||{};var c=b.content||"";this.each(function(d,e){var f=a(e);if(e.smtip&&(e.smtip.empty(),e.smtip.hide()),"close"!==b){var g=getMsgLabel(f);g.css({position:"relative"}),g.show();var h=a('<div class="smtip-content"></div>').appendTo(g);h.css({position:"absolute","background-color":"rgb(255, 153, 0)","border-radius":"3px",padding:"3px 10px",color:"#FFF","line-height":"20px","box-shadow":"1px 1px 3px rgba(0,0,0,.3)"});var i=a('<i style="position:absolute;  width:0; height:0; border-width:8px; border-color:transparent; border-style:dashed; *overflow:hidden;border-bottom-color: rgb(255, 153, 0);"></i>').appendTo(g);h.css({"white-space":"nowrap"}),b.width&&(h.css({width:b.width+"px","word-break":"break-all","word-wrap":"break-word",display:"inline-block"}),h.css({"white-space":""})),b.maxWidth&&h.css({"max-width":b.maxWidth+"px","word-break":"break-all","word-wrap":"break-word",display:"inline-block"}),b.color&&h.css({color:b.color}),b.borderColor&&(h.css({"background-color":b.borderColor}),i.css({"border-bottom-color":b.borderColor})),g.css("opacity",0),setTimeout(function(){var a=10,c=-4,d=/msie 6/i.test(navigator.userAgent);if(d&&(c=-22),!b.width&&b.maxWidth){var e=h.outerWidth();e>b.maxWidth&&(h.css({width:b.maxWidth+"px"}),h.css({"white-space":""}))}h.css({left:a+"px",top:c+"px"}),i.css({left:a-8+"px",top:c+"px"}),g.css("opacity",1)},10),e.smtip=g,h.html(c)}})}}(jQuery),$.SMF.setCustomFunc("display_error",function(a,b){if(b.removeClass($.SMF.Config.input_valid).removeClass($.SMF.Config.input_default).addClass($.SMF.Config.input_error),a){var d=getMsgLabel(b),e=d.prev("span."+$.SMF.Config.tip_back);e.hide(),b.smtip({content:a,borderColor:"#a94442",maxWidth:250})}}),$.SMF.setCustomFunc("displayDefault",function(a,b){var d=getMsgLabel(b);d.prev("span."+$.SMF.Config.tip_back).show(),b.removeClass($.SMF.Config.input_error).removeClass($.SMF.Config.input_default).addClass($.SMF.Config.field_default),b.smtip("close")});