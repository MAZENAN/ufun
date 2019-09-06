$(function(){if($.trim($('#allopts').text())==''){$('#allopts_trs').hide();$('.smbox-list-table th[opt=allopt]').hide();$('.smbox-list-table td[opt=allopt]').hide();}
var ishide=true;var opttr=$('.smbox-list-table th').last();var str=opttr.attr('opt')||'';if(str!='opt'){return;}
var trs=$('.smbox-list-table tr');trs.each(function(index,element){if(index==0){return;}
var td=$(element).find('td:last[opt=opt]');var std=$.trim(td.text());if(std!=''){if(ishide){ishide=false;}}else{td.text('-----');}});if(ishide&&trs.length>1){opttr.hide();$('.smbox-list-table td[opt=opt]').hide();}});