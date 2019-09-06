// JavaScript Document
(function($,undefined){
$.fn.initColorSelecter=function(){
	var valbox=$(this);//要填充的输入框
	var button=$('<a class="smbox-color-selecter" href="#"></a>').insertBefore(valbox);
	var val=valbox.val();
	var colors=[
	'#FFF','#CCC','#999','#666','#333','#000',
	'#CC0033','#C76','#C43','#C12','#912','#612',
	'#FF9900','#FF6600','#CC6600','#CC6633','#FF9966','#663300',
	'#FFCC33','#FFFF99','#FFCC99','#FFCC00','#CCCC33','#CC9900',
	'#99CC00','#339933','#009933','#99CC66','#99CC33','#003300',
	'#0099CC','#CCFFFF','#66CCCC','#66CCFF','#66CCCC','#339999',
	'#0066CC','#6666FF','#0000FF','#99CCFF','#6666FF','#003399',
	'#990066','#FF33CC','#FF3399','#993399','#CC6699','#993366'
	];
	if(val!==''){
		button.css('background-color',val);
		}
	var ColorMeun=$('<div></div>').css({'width':'1px','height':'1px','position':'absolute'}).appendTo(button).hide();
	var ColorkMeun=$('<div></div>').css({'width':'115px','position':'absolute','background-color':'#FFF','top':'23px','border':'#CCC 4px solid'}).appendTo(ColorMeun);
	
	for(var i=0;i<colors.length;i++){
		$('<b></b>').css('background-color',colors[i]).click(function(){
			var cl=$(this).css('background-color');
			button.css('background-color',cl);
			valbox.val(cl);
			ColorMeun.hide();
			return false;
			}).appendTo(ColorkMeun);
		}
	$('<b></b>').css({'width':'115','text-align':'center','height':'20px','line-height':'18px','clear':'both'}).click(function(){
			button.css('background-color','');
			valbox.val('');
			ColorMeun.hide();
			return false;
			}).text('无样式').appendTo(ColorkMeun);
			
	button.click(function(){
		ColorMeun.show();
		return false;
		});
	ColorMeun.mousedown(function(ev){
		 ev.preventDefault();
		return false;
		});
	$(document).bind('mousedown',function(){ColorMeun.hide();});
	
};
})(jQuery);