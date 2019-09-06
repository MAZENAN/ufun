function allow_on(id){
	if ($("#check_status_0_"+id).prop("checked")){return}

	$.ajax({
		type: "GET",
		url: "/admin/goods/seton",
		data: "id="+id,
		success: function(msg){
			if (msg=="true") {
				$("#check_status_0_"+id).attr("checked","checked")
				$("#li_0_"+id).addClass("audit-cur")
				$("#check_status_1_"+id).removeAttr("checked")
				$("#li_1_"+id).removeClass("audit-cur")

				$("#lab_l_"+id).css("background","rgb(255,255,255)")
			}

		}
	});


}
function allow_off(id){
	if ($("#check_status_1_"+id).prop("checked")){return}
	$.ajax({
		type: "GET",
		url: "/admin/goods/setoff",
		data: "id="+id,
		success: function(msg){
			if (msg=="true"){
				$("#check_status_1_"+id).attr("checked","checked")
				$("#li_1_"+id).addClass("audit-cur")
				$("#check_status_0_"+id).removeAttr("checked")
				$("#li_0_"+id).removeClass("audit-cur")

				$("#lab_l_"+id).css("background","rgb(128,128,128)")
			}

		}
	});


}