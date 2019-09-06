function upd_file(obj,file_id){	
	$("input[name='"+file_id+"[]']").bind("change",function(){       
		 $.ajaxFileUpload({
				    url:"/service/upimg.php",  
				    secureuri:false,
				    fileElementId:file_id,
				    dataType: 'json',
				    success: function (data, status){
			    		if(data.status==1){                            
	                       //$("#imgarray").val(data.key);                    
	                       for(var i=0;i<data.key.length;i++){	                        
	                       	$("#imgboxid").append("<dl><img src='https://img.part.cn/"+data.key[i]+"?imageView2/1/w/100/h/100/'><div class='close'>X</div><input type=hidden value="+data.key[i]+" name='img[]' /></dl>");
	                       }	                       
	                       var arr_filter=[];
	                       arr_filter.push(data.key);
	                       console.log(arr_filter);
                        }
                        if(data.status!=1){
                        	if(data.status==3){
				  				alert(data.error);
				  			}
				  			console.log(data.error);
                        }
                        
                        				   	
				    },
				    error: function (data, status, e)
				    {
						//alert('error');
				    	 
						// $('#'+error_msg).html('上传失败');
						// $('#'+img_src).addClass("warnning");
						// $(obj).show();
				    }
			   }
		   );
		  //$("input[name='"+file_id+"']").unbind("change");
	});	
}
