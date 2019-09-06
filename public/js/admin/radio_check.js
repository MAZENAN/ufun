// JavaScript Document
$(document).ready(function(e) {
	$("#check_status li:eq(0)").addClass("audit-cur");
	$("#check_status label:eq(0)").css({"borderRight":"none","borderRadius":"5px 0 0 5px"});
	$("#check_status label:eq(1)").css({"borderLeft":"none","borderRadius":"0px 5px 5px 0px"});	
		$("#check_status li").on("click",function(){
		$("#check_status li").eq($(this).index()).addClass("audit-cur").siblings().removeClass('audit-cur');
		$(".samao-box").addClass("samao-box-show");
		});
	   $("#check_status li:eq(0)").click(function(){
		   $("#check_status_1").parent().css({"background":"#fff"});
		   });
	   $("#check_status li:eq(1)").click(function(){
		   $("#check_status_1").parent().css({"background":"rgb(128,128,128)"});
		   });
});