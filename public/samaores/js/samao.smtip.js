// JavaScript Document
(function($,undefined){

var smTiper=function(elem,options){
	var that=$(elem);
	var tip=$('<div class="smtip smtip-'+options.css+'"></div>');
	$('<div class="smtip-arrow"></div>').appendTo(tip);
	$('<div class="smtip-wrapper"></div>').html(options.content).appendTo(tip);
	
	$(document.body).append(tip);
	var width=tip.width();
	if(tip.width()>250){
		tip.css({'width':'250px'});
	}
	tip.css({'position':'absolute'});
	var resite=function(){
		var ofs=that.offset();
		tip.css({'left':ofs.left, 'top':ofs.top+that.outerHeight()});
	};
	resite();
	$(window).bind('resize',resite);
	this.destroy=function(){
		$(window).unbind('resize',resite);
		tip.remove();
	};
};

$.fn.smtip=function(options){
	this.each(function(index,elem){
		if(options==='destroy'&&elem.smTiper){
			elem.smTiper.destroy();
			return;
		}
		elem.smTiper=new  smTiper(elem,options);
	});};

})(jQuery);