// layer.config({
//     skin: 'layer-ext-seaning',
//     extend: 'skin/seaning/style.css'
// });

$(document).ready(function(){
    $("#comment").bind("focus",function(event) {
    $("#err_info").empty();
    });  

      $(".global_three").eq(0).show();
      $(".tit_three h2").click(function(){
      $(".tit_three h2").eq($(this).index()).addClass("on").siblings().removeClass("on");
      $(".global_three").hide().eq($(this).index()).show();
    });
     $(".global_con-answer form #comment").bind("focus",function(){
        // document.querySelector(".wrap").addEventListener("touchmove",function(e){
        //   e.preventDefault();
        // },false);
     });
     $(".global_evaluate").on("click",function(){
      $(".comment_con").css("left","0");    
      $(".tit_three h2").eq(2).addClass("on").siblings().removeClass("on");
      $(".global_three").hide().eq(2).show();
      //$("body,html").animate({scrollTop:$(".tit_three").offset().top - 100},1000);   
      $("#comment").focus(); 
     });
     $(".global_con-answer h2 span").click(function(){
      $(".comment_con").css("left","0");
     });
     $(".comment_con dd a").bind("click",function(){     
      $(".comment_con").css("left","100%");
     });
     $(".laymshade").on("click",function(e){
        $(this).parent().hide();
     });
});
var M=1;
function get_commentmark(camp_id){
    
    $.post("/commentmark/index.html?page="+M,{campid:camp_id},function(data){
      if(data){
          M++;
          var rows=eval(data);
          if(rows.length==0){
                $(".btn_load_pj").html("没有更多了~");
                $(".btn_load_pj").attr("disabled","disabled");
                $(".btn_load_pj").css({"color":"#999","cursor":"default"});
                return;
               }
          for(var i in rows){
              var rs=rows[i];
              var img_head='';
              if (rs.img_head==''||rs.img_head==null) {
                  img_head='public/mb/images/comment_head.png';
              }else{
                img_head=rs.img_head;
              }
              htmltr="<li><div class='comment_head'><img src='"+img_head+"'/></div><h4><span>"+rs.add_time+"</span>"+rs.nickname+"</h4><dl><ul class=star"+rs.point+"></ul></dd></dl> <p>"+rs.info+"</p><dt><div class='thumbs'>";
              if(rs.images!==''){
                for(var im in rs.images){
                  im_rs=rs.images[im];
                  htmltr+="<a href='https://img.part.cn/"+im_rs+"?imageView2/1/w/500/h/500/' ><img src='https://img.part.cn/"+im_rs+"?imageView2/1/w/92/h/92/'/></a>";
                }              
              }
              htmltr+="</div></dt>";
              if(rs.c_comments_mark!=""){
              for(var j in rs.c_comments_mark){
                c_rs=rs.c_comments_mark[j];
                htmltr += "<dd><h5>"+c_rs.nickname+"回复：</h5><span>"+c_rs.info+"</span></dd></li>";
               }
              }
              var newtr=$(htmltr).appendTo(".global_con-evaluate ol");   
          }
          if ($.isFunction($.our_fun)){
                 $.our_fun();
             }
      }else{
       $(".global_con-evaluate ol").html("暂无评价");
      }
      over=true;
    });
}

  

var N=1;
function get_comment(camp_id){
     
    $.post('/comment/index.html?page='+N,{campid:camp_id},function(data){

          if(data){
             N++;
            var rows = eval(data); 

               if(rows.length==0){
                $(".btn_load").html("没有更多了~");
                $(".btn_load").attr("disabled","disabled");
                $(".btn_load").css({"color":"#999","cursor":"default"});
                return;
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
                  var htmltr = '<li class="pcomment_name" id="pcomment_'+rs.id+'"><h4><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><span>游客</span>';
                }else if(rs.user_id==-1){
                  var htmltr = '<li class="pcomment_name" id="pcomment_'+rs.id+'"><h4><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><span style="color:#83c640;">'+rs.nickname+'</span>';
                }else{
                  var htmltr = '<li class="pcomment_name" id="pcomment_'+rs.id+'"><h4><div class="comment_head"><img src="'+img_head+'"/></div><span>'+rs.nickname+'</span>';
                }
                htmltr +='<div class="reply_time">'+rs.add_time+'</div></h4><p onclick="comment_reply('+camp_id+','+rs.id+','+rs.user_id+')">'+rs.comment+'&nbsp;&nbsp;'+'</p><ol>';
                if (rs.c_comments!=null) {
                  for (var j in rs.c_comments) {
                    var c_rs=rs.c_comments[j];
                    if (c_rs.nickname==null || c_rs.nickname=="") {
                      htmltr += '<li ><h4><span>游客</span><i>@</i>';
                      //var name='匿名';
                    }else if(c_rs.user_id==-1){
                       htmltr += '<li ><h4><span style="color:#83c640;">'+c_rs.nickname+'</span><i>@</i>';
                    }else{
                       htmltr += '<li ><h4><span>'+c_rs.nickname+'</span><i>@</i>';
                       //var name=c_rs.p_nickname;
                    }
                     if(c_rs.p_nickname==null || c_rs.p_nickname==""){
                       var name2='<span>游客</span>';
                      }else if(c_rs.p_userid==-1){
                        var name2='<span style="color:#83c640;">'+c_rs.p_nickname+'</span>';
                      }else{
                        var name2='<span>'+c_rs.p_nickname+'</span>';
                      }
                    htmltr +=name2+'<div class="reply_time">'+c_rs.add_time+'</div></h4><p onclick="comment_reply('+camp_id+','+rs.id+','+c_rs.user_id+')">'+c_rs.comment+'</p></li>';
                  }
                };
                 
                htmltr +='</ol></li>';
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
          over=true;
     },'json');
}
function comment_reply(campid,pid,p_userid){
  var form_exist=$("#form_reply").length;

  if (form_exist>0) {
    $("#form_reply").parents(".comment_con").remove();
   
  }else{
    var htmltr='<div class="comment_con"><div id="comment_list2"><dd><a onclick="comment_hide()">取消</a><h1 class="title">我要咨询</h1></dd><form id="form_reply" method="post" ajax="true"><div><textarea placeholder="写下您的评论......" class="comment"></textarea><span id="err_info2"></span><input type="hidden" id="campid" value="'+campid+'"><input type="hidden" id="pid" value="'+pid+'"><input type="hidden" id="p_userid" value="'+p_userid+'"></div><div><button type="button" class="btn" onclick="publish2();">发表</button></div></form></div></div>';
    var newtr =$(htmltr).appendTo('#pcomment_'+pid);
    $("#form_reply").parents(".comment_con").css({"left":"0"});
    $("#comment_list2").css({"top":$(window).height()+"px"});
    $("#comment_list2 textarea").focus();
  }
}
function comment_hide(){
       $("#form_reply").parents(".comment_con").remove();
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
                  var htmltr = '<li class="pcomment_name" id="pcomment_'+rs.id+'"><h4><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><span>游客</span>';
                }else if(rs.user_id==-1){
                  var htmltr = '<li class="pcomment_name" id="pcomment_'+rs.id+'"><h4><div class="comment_head"><img src="public/mb/images/comment_head.png"/></div><span style="color:#83c640;">'+rs.nickname+'</span>';
                }else{
                  var htmltr = '<li class="pcomment_name" id="pcomment_'+rs.id+'"><h4><div class="comment_head"><img src="'+img_head+'"/></div><span>'+rs.nickname+'</span>';
                }
                htmltr +='<div class="reply_time">'+rs.add_time+'</div></h4><p onclick="comment_reply('+camp_id+','+rs.id+','+rs.user_id+')">'+rs.comment+'&nbsp;&nbsp;'+'</p><ol>';
                if (rs.c_comments!=null) {
                  for (var j in rs.c_comments) {
                    var c_rs=rs.c_comments[j];
                    if (c_rs.nickname==null || c_rs.nickname=="") {
                      htmltr += '<li ><h4>游客<i>@</i>';
                      //var name='匿名';
                    }else if(c_rs.user_id==-1){
                      htmltr += '<li ><h4 style="color:#83c640;">'+c_rs.nickname+'<i>@</i>';
                    }else{
                       htmltr += '<li ><h4>'+c_rs.nickname+'<i>@</i>';
                       //var name=c_rs.p_nickname;
                    }
                     if(c_rs.p_nickname==null || c_rs.p_nickname==""){
                       var name2='<span>游客</span>';
                      }else if(c_rs.p_user_id==-1){
                         var name2='<span>'+c_rs.p_nickname+'</span>';
                      }else{
                        var name2='<span style="color:#83c640;">'+c_rs.p_nickname+'</span>';
                      }
                    htmltr +=name2+'<div class="reply_time">'+c_rs.add_time+'</div></h4><p onclick="comment_reply('+camp_id+','+rs.id+','+c_rs.user_id+')">'+c_rs.comment+'</p></li>';
                  }
                };
                htmltr +='</ol></li>';
                var newtr = $(htmltr).prependTo('.comment_li2');
                $(".global_con-answer button.btn_load").removeClass("btn_load_wu");           
            }
                  // $("#err_info").html("发布成功");               
               $("#comment").val("");
               $(".comment_con").css("left","100%");
               $("body").animate({scrollTop:$(".tit_three").offset().top - 100},1000);
               $(".evaluate_layer_ok,.layer_star").show();
               $(".evaluate_layer_ok h3").html("<a>咨询成功</a>");
               $(".evaluate_layer_ok p").html("您的留言被回复后，可在营天下APP中我的消息查看");
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
                   $(".comment").val(" ");           
                   $("#form_reply").remove();
                var row = eval(data);
                   for (var i in row) {
                var rs=row[i];
               
                if (rs.nickname==null || rs.nickname=="") {
                  var htmltr = '<li><h4><span>游客</span><i>@</i>';
                  //var name='匿名';
                }else if(rs.user_id==-1){
                   var htmltr = '<li><h4><span style="color:#83c640;">'+rs.nickname+'</span><i>@</i>';
                }else{
                  var htmltr = '<li><h4><span>'+rs.nickname+'</span><i>@</i>';
                 // var name=c_rs.p_nickname;
                }
                 if(rs.p_nickname==null || rs.p_nickname==""){
                       var name2='<span>游客</span>';
                      }else if(rs.p_userid==-1){
                        var name2='<span style="color:#83c640;">'+rs.p_nickname+'</span>';
                      }else{
                        var name2='<span>'+rs.p_nickname+'</span>';
                      }
                htmltr +=name2+'<div class="reply_time">'+rs.add_time+'</div></h4><p onclick="comment_reply('+camp_id+','+p_id+','+rs.user_id+')">'+rs.comment+'</p></li>';
      
                var newtr = $(htmltr).prependTo('#pcomment_'+p_id+" ol");
            
                }
                $("#comment").val("");
               $(".comment_con").css("left","100%");
               $("body").animate({scrollTop:$(".tit_three").offset().top - 100},1000);
               $(".evaluate_layer_ok,.layer_star").show();
               $(".evaluate_layer_ok h3").html("<a>咨询成功</a>");
               $(".evaluate_layer_ok p").html("您的留言被回复后，可在营天下APP中我的消息查看");
                     //get_comment(camp_id);
                }
            },'json');
}