$(document).ready(function(){
  $("#depid_val").val("");
  if($("#depid li.sel-item").index()==0 && $("#depid li.sel-item").data("allow")=="2"){
      $("#depid li.sel-item").addClass('on');
      $(".buy_list").css({"top":"0px","height":"50px","zIndex":"1"});
      $("#depid_val").val($("#depid li.sel-item").val());
      var myDate=new Date();
      var years=myDate.getFullYear();
      var month=myDate.getMonth()+1;
      var date=myDate.getDate();
      var localTime=Date.parse(years+"/"+month+"/"+date);
      var deadTime=Date.parse($("#depid li.sel-item").data('deadline'));
      var days=Math.ceil((deadTime-localTime)/86400000);
      if(days<=10){
        $(".number_select ul li span.tit2").html("还有"+days+"天截止报名");
      }else{
        $(".number_select ul li span.tit2").html("");
      }   
   }
  var o_price=$(".price > i span").html();
  var p_price=$(".price dt i span").html();
  var union_price=$(".price_union span i").html();
        $("#depid li").each(function(){
           if($(this).data("allow")=="0"){
            $(this).css("background","#fafafa");
            $(this).removeClass("sel-item");
            $(this).click(function(){
              layer.open({content:"这一期已经截止报名",time:1});
            });
            }else if($(this).data("allow")=="1"){
             $(this).css("background","#fafafa");
             $(this).removeClass("sel-item");
             $(this).click(function(){
               layer.open({content:"这一期报名未开始",time:1});
             });
            }
        });
       $("#depid li.sel-item").click(function(){
        var myDate=new Date();
        var years=myDate.getFullYear();
        var month=myDate.getMonth()+1;
        var date=myDate.getDate();
        var localTime=Date.parse(years+"/"+month+"/"+date);
        var deadTime=Date.parse($(this).data('deadline'));
        var days=Math.ceil((deadTime-localTime)/86400000);
        if(days<=10){
          $(".number_select ul li span.tit2").html("还有"+days+"天截止报名");
        }else{
          $(".number_select ul li span.tit2").html("");
        }   
        $("#depid li").eq($(this).index()).toggleClass("on").siblings().removeClass("on");
        if($(this).data('cost')==$(this).data('deposit')){
          $(".price dt").hide();
        }else{
          $(".price dt").show();
        }
        if($("#depid li").eq($(this).index()).hasClass("on")){
          //$(".buy_list").show();
           $(".buy_list").css({"top":"0px","height":"50px","zIndex":"1"});
          $("#depid_val").val($(this).val());
          $(".price > i span").html($(this).data('cost'));
          $(".price dt i span").html($(this).data('deposit'));
          $(".price_union span i").html($(this).data('cost') * parseInt($("#shuliang").val()));
        }else{
          $(".price dt").show();
          //$(".buy_list").hide();
          $(".buy_list").css({"top":"-60px","height":"0","marginBottom":"0","zIndex":"-1"});
          $(".buy_list input#shuliang").val("1");
          $("#depid_val").val("");
          $(".price > i span").html(o_price);
          $(".price dt i span").html(p_price);
          $(".price_union span i").html(union_price);
        }

        //$(".commodity_show .global_con-total-union .action").hide();
        //$(".commodity_show .title").html($(this).html());        
       });
       function prevent1(ev) {
           ev.preventDefault();
       }
       $('.detail_login input').on("focus",function(){
           document.body.addEventListener("touchmove",prevent1,false);
       });
       $('.detail_login input').on("blur",function(){
           document.body.removeEventListener("touchmove",prevent1,false);
       });
       var open_mask=function(){
          $(".commodity_show").css({"transform":"translate(0,0)","-webkit-transform":"translate(0,0)"});    
       }
       var close_mask=function(){
          $(".commodity_show").css({"transform":"translate(-100%,0)","-webkit-transform":"translate(-100%,0)"});         
       }

        $(".global_buy").click(function(){
            if($("#depid_val").val() == ""){
               layer.open({ content: "请选择出发日期", time: 1,yes: function(){
               
               }});               
              $('html, body').animate({scrollTop:$(".date_select").offset().top-100}, 'slow');   
            }else{
                if($(this).attr("id")=="reserve"){
                    var href = $(this).attr("data-href");
                    $.get(href,function (data) {
                        if (data.error) { 
                            $('.detail_login').show();
                            $("#mobile").focus();
                            return false;
                        }else {
                            $("#orderform").submit();
                            return false;
                        }
                    }, 'json');         
                }else{
                     $("#orderform").submit();
                            return false;
                }
              
            }
        });
        //  $(".global_buy2").click(function(){
        //     if($("#depid_val").val() == ""){
        //         $(".commodity_show .global_con-total-union .action").show().delay(3000).hide(0);
        //     }else{
        //         $("#orderform").submit();
        //         return false;
        //     }
        // });
          
     $(".date_select").click(open_mask);
     $(".commodity_show .close").click(close_mask);
     $(".commodity_show .mask").click(close_mask);
     $(".camp_xu dd img").prev().css("width","calc(100% - 110px)");
     /*日期选择*/
     $(".date_select_par #wrapper").height($(".date_select_par #wrapper ul").height()+ 15);
     $(".btn").on("click", function () {
            var _that = $(this);
            if (_that.attr("value") == '-') {
              if ((parseInt($("#shuliang").val()) - 1) > 0) {
                  $("#shuliang").val(parseInt($("#shuliang").val()) - 1);
                   if($("#depid li.on").length>0){
                  $("#need_topay i").html($("#depid li.on").data('cost') * parseInt($("#shuliang").val()));
                  //$(".price dt i span").html($("#depid li.on").data('deposit') * parseInt($("#shuliang").val()));
                  }
              }
            }
            if (_that.attr("value") == '+') {
              //alert(parseInt($("#shuliang").val())+1);
              if ((parseInt($("#shuliang").val()) + 1) <= 99) {
                  $("#shuliang").val(parseInt($("#shuliang").val()) + 1);
                  if($("#depid li.on").length>0){
                  $("#need_topay i").html($("#depid li.on").data('cost') * parseInt($("#shuliang").val()));
                  //$(".price dt i span").html($("#depid li.on").data('deposit') * parseInt($("#shuliang").val()));
                  }
              }
            }
     });
     

  });

// $(function () {
//     var setbox = function () {
//         var opt = $('#depid').children('option:selected');
//         var depid = opt.val() || 0;
//         var cost = opt.data('cost');
//         var deposit = opt.data('deposit');
//         var html = '';
//         if (cost) {
//             if (deposit) {
//                // html += '预定金 : <i>￥' + deposit + '</i> 元';
//                html += '<img src="public/mb/images/icon-detail4.png" width="12">费用共计: <i>￥' + cost + '</i> 元<br />';
//             }
//         } else {
//             html += '<b>&nbsp;&nbsp;暂无报价&nbsp;<br/>&nbsp;&nbsp;</b>';
//         }
//         $('.price').html(html);
//     };
//     setbox();
//     $('#depid').on('change', setbox);
// });
