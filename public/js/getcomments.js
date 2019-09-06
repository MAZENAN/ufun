$(document).ready(function(){
  $("#comment").bind("focus",function(event) {
  $("#err_info").empty();
  $(this).val("");
});  
});
var M=1;
function get_commentmark(camp_id,comment_mark_count){
  
   $.post('/commentmark/index.html?page='+M,{campid:camp_id},function(data){
      
       if(data){  
       M++;    
          var rows=eval(data);
          var page=parseInt(comment_mark_count/10);

          if(page==(M-2)){
                $(".btn_load_pj").html("没有更多了~");
                $(".btn_load_pj").attr("disabled","disabled");
                $(".btn_load_pj").css({"color":"#999","cursor":"default"});
                //return;
               }
           for(var i in rows){
            var rs=rows[i];
            var c_rs=rs.c_comments_mark[j];
            var img_head='';
            if (rs.img_head==''||rs.img_head==null) {
                img_head='public/mb/images/comment_head.png';
            }else{
              img_head=rs.img_head;
            }
            htmltr="<li><dt><div class='comment_head'><img src='"+img_head+"'/></div></dt><dd><h2>"+rs.nickname+"</h2><div class='star'><span class='starall star"+rs.point+"'></span><i><span>有收获：</span><span>"+rs.p1+"</span></i><i><span>安全性：</span><span>"+rs.p2+"</span></i><i><span>趣味性：</span><span>"+rs.p3+"</span></i></div><div class='info'>"+rs.info+"</div><time>"+rs.add_time+"</time>";
            if(rs.c_comments_mark!=""){
              for(var j in rs.c_comments_mark){
                c_rs=rs.c_comments_mark[j];
                htmltr += "<div class='reply'><h4>"+c_rs.nickname+"回复：</h4><span>"+c_rs.info+"</span></div>";
              }
            }
            htmltr +="</dd></li>"
           var newtr=$(htmltr).appendTo(".pj ol");
          }       
       }else{
        $(".btn_load_pj").html("还没有评价！");
       }
     
   },"json");
  }

var N=1;
function get_comment(camp_id,comment_count){
   
   
    $.post('/comment/index.html?page='+N,{campid:camp_id},function(data){

          if(data){
            N++;
            var rows = eval(data);
            var page = parseInt(comment_count/10); 
               if(page==(N-2)){
                $(".btn_load").html("没有更多了~");
                $(".btn_load").attr("disabled","disabled");
                $(".btn_load").css({"color":"#999","cursor":"default"});
               // return;
               }

            for (var i in rows) {
                var rs=rows[i];
                var n=++i;
                var img_head='';
                if (rs.img_head==''||rs.img_head==null) {
                    img_head='public/mb/images/comment_head.png';
                }else{
                  img_head=rs.img_head;
                }
                if (rs.nickname==null || rs.nickname=="") {
                  var htmltr = '<div class="pcomment_name" id="pcomment_'+rs.id+'"><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><h2>游客</h2>';
                }else if(rs.user_id==-1){
                  var htmltr = '<div class="pcomment_name" id="pcomment_'+rs.id+'"><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><h2 style="color:#83c640;">'+rs.nickname+'</h2>';
                }else{                 
                  var htmltr = '<div class="pcomment_name" id="pcomment_'+rs.id+'"><div class="comment_head"><img src="'+img_head+'"/></div><h2>'+rs.nickname+'</h2>';
                }
                htmltr +='<div class="reply_time">'+rs.add_time+'<a href="javascript:comment_reply('+camp_id+','+rs.id+','+rs.user_id+');">回复</a></div><p>'+rs.comment+'&nbsp;&nbsp;'+'</p><ul>';
                if (rs.c_comments!=null) {
                  for (var j in rs.c_comments) {
                    var c_rs=rs.c_comments[j];
                   
                    if (c_rs.nickname==null || c_rs.nickname=="") {
                      htmltr += '<li ><h2>游客</h2>@';
                     // var name='匿名';
                    }else if(c_rs.user_id==-1){
                      htmltr += '<li ><h2 style="color:#83c640;">'+c_rs.nickname+'</h2>@';
                    }else{
                       htmltr += '<li ><h2>'+c_rs.nickname+'</h2>@';
                      // var name=c_rs.nickname;
                    }
                     if(c_rs.p_nickname==null || c_rs.p_nickname==""){
                       var name2='<span>游客</span>：';
                      }else if(c_rs.p_userid==-1){
                        var name2='<span style="color:#83c640;">'+c_rs.p_nickname+'</span>：';
                      }else{
                        var name2='<span>'+c_rs.p_nickname+'</span>：';
                      }
                    htmltr +=name2+c_rs.comment+'<div class="reply_time">'+c_rs.add_time+'<a href="javascript:comment_reply('+camp_id+','+rs.id+','+c_rs.user_id+');">回复</a></div></li>';
                  }
                };
                 
                htmltr +='</ul></div>';
                var newtr = $(htmltr).appendTo('.insert');
               //alert("pcomment_"+rs.id);
            }
             $(".insert .pcomment_name").each(function(){
               var  oneid=$(this).attr("id");

              $(".comment_li2 .pcomment_name").each(function(){
                if(oneid==$(this).attr("id")){
                  $("#"+$(this).attr("id")).remove();
                  //alert($(this).attr("id"));
                }
                
              });
             });

          }else {
            alert("加载失败");
          }

     },'json');
}
function comment_reply(campid,pid,p_userid){
  var form_exist=$("#form_reply").length;
  if (form_exist>0) {
    $("#form_reply").remove();
    
  }else{
    var htmltr='<form id="form_reply" method="post" ajax="true"><div><textarea placeholder="写下您的评论......" class="comment"></textarea><span id="err_info2"></span><input type="hidden" id="campid" value="'+campid+'"><input type="hidden" id="pid" value="'+pid+'"><input type="hidden" id="p_userid" value="'+p_userid+'"></div><div><button type="button" class="btn" onclick="publish2();">发表</button></div></form>';
    var newtr =$(htmltr).appendTo('#pcomment_'+pid);
  }
}

function publish(){
    var camp_id=$("#campid").val();
    var p_id=$("#pid").val();
    var p_user_id=$("#p_userid").val();
    var desc=$("#comment_list #comment").val();
    
    if (desc=='') {
      $("#err_info").html("发布内容不能为空");  
      return;
    }
  
    $.post('/comment/base.html',{campid:camp_id,comment:desc,pid:p_id,p_userid:p_user_id},function(data){
                if(data===false){
                   alert("发布失败");                    
                }else {
                   var row = eval(data);
                  
                   for (var i in row) {
                var rs=row[i];
                var n=++i;
                var img_head='';
                if (rs.img_head==''||rs.img_head==null) {
                    img_head='public/mb/images/comment_head.png';
                }else{
                  img_head=rs.img_head;
                }
                if (rs.nickname==null || rs.nickname=="") {
                  var htmltr = '<div class="pcomment_name" id="pcomment_'+rs.id+'"><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><h2>游客</h2>';
                }else if(rs.user_id==-1){
                  var htmltr = '<div class="pcomment_name" id="pcomment_'+rs.id+'"><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><h2 style="color:#83c640">'+rs.nickname+'</h2>';
                }else{
                  var htmltr = '<div class="pcomment_name" id="pcomment_'+rs.id+'"><div class="comment_head"><img src="'+img_head+'"/></div><h2>'+rs.nickname+'</h2>';
                }
                htmltr +='<div class="reply_time">'+rs.add_time+'<a href="javascript:comment_reply('+camp_id+','+rs.id+','+rs.user_id+');">回复</a></div><p>'+rs.comment+'&nbsp;&nbsp;'+'</p><ul>';
                if (rs.c_comments!=null) {
                  for (var j in rs.c_comments) {
                    var c_rs=rs.c_comments[j];
                    if (c_rs.nickname==null || c_rs.nickname=="") {
                      htmltr += '<li ><h2>游客</h2>@';
                      //var name='匿名';
                    }else if(c_rs.user_id==-1){
                      htmltr += '<li ><h2 style="color:#83c640">'+c_rs.nickname+'</h2>@';
                    }else{
                       htmltr += '<li ><h2>'+c_rs.nickname+'</h2>@';
                       //var name=c_rs.nickname;
                    }
                     if(c_rs.p_nickname==null || c_rs.p_nickname==""){
                       var name2='<span>游客</span>：';
                      }else if(c_rs.p_userid==-1){
                         var name2='<span style="color:#83c640">'+c_rs.p_nickname+'</span>：';
                      }else{
                        var name2='<span>'+c_rs.p_nickname+'</span>：';
                      }
                    htmltr +=name2+c_rs.comment+'<div class="reply_time">'+c_rs.add_time+'<a href="javascript:comment_reply('+camp_id+','+rs.id+','+c_rs.user_id+');">回复</a></div></li>';
                  }
                };
                htmltr +='</ul></div>';
                var newtr = $(htmltr).appendTo('.comment_li2');
            
            }
                   //$("#err_info").html("发布成功");
                   $("#comment_list #comment").val("");
                     //get_comment(camp_id);
                }
            },'json');
}

function publish2(){
    var camp_id=$("#campid").val();
    var p_id=$("#pid").val();
    var p_user_id=$("#p_userid").val();
    var desc=$(".comment").val();
     if($(".comment").val()==""){
       $("#err_info2").html("回复内容不能为空");  
      return;
     }
   
  
    $.post('/comment/base.html',{campid:camp_id,comment:desc,pid:p_id,p_userid:p_user_id},function(data){                 
                if(data===false){
                   alert("发布失败");
                     
                }else {                  
                   $("#err_info2").html("发布成功");
                   $(".comment").val("");
                   $("#form_reply").remove();
                var row = eval(data);
                   for (var i in row) {
                var rs=row[i];
               
                if (rs.nickname==null || rs.nickname=="") {
                  var htmltr = '<li><h2>游客</h2> @';
                  //var name='匿名';
                }else if(rs.user_id==-1){
                  var htmltr = '<li><h2 style="color:#83c640">'+rs.nickname+'</h2> @';
                }else{
                  var htmltr = '<li><h2>'+rs.nickname+'</h2> @';
                  //var name=c_rs.nickname;
                }
                if(rs.p_nickname==null || rs.p_nickname==""){
                 var name2='<span>游客</span>：';
                }else if(rs.p_userid==-1){
                  var name2='<span style="color:#83c640">'+rs.p_nickname+'</span>：';
                }else{
                  var name2='<span>'+rs.p_nickname+'</span>：';
                }
                htmltr +=name2+rs.comment+'&nbsp;&nbsp;'+'<div class="reply_time">'+rs.add_time+'<a href="javascript:comment_reply('+camp_id+','+p_id+','+rs.user_id+');">回复</a></div></li>';
      
                var newtr = $(htmltr).appendTo('#pcomment_'+p_id+" ul");
            
                }
                
                }
            },'json');
}