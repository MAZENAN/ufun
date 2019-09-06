$(document).ready(function () {
    // $(".filter ul li a.list").click(function(){
    //   $(".filter-open").slideToggle(200);
    // });

    //$(".filter ul li a.list-sort").click(function(){
    // $(".filter-sort").slideToggle(200);
    //});
    //列表页国际、国内tab效果
    $(".camp_list .tab_camp > div.on a").css({"fontSize":"30px"});
    $(".camp_list .tab_camp > div.on i").css("bottom","-10px");
    $(".camp_list .tab_camp > div.tab_cn.on").css("backgroundSize","33px");
    $(".camp_list .tab_camp > div.tab_gl.on").css("backgroundSize","83px");
    <!---->
    sessionStorage.setItem("ls",list_type);
     function prevent(e){
        e.preventDefault();
      }
    $(".filter_time input").on("click",function(){
        $(".wrap").css({"height":$(window).height(),"overflow":"hidden"});//
        $(this).addClass("on");
        $(".filter_time input").blur();
    });
        
    if($(".camp_lx ul li").eq(0).siblings().hasClass("on")){
        $(".camp_lx ul li").eq(0).removeClass("on");
    }
    if($(".camp_lx2 ul").html().replace(/(^\s*)|(\s*$)/g, "")==""){
        $(".camp_lx2").css({"height":"1px","borderTop":"0"});
    }
    //点击显示
    $(".filter2 .screen").on("click",function(){      
      $(".filter-open .blank").show();
      $(".filter-open .pop_main").css({"transform":"translate(0,0)","WebkitTransform":"translate(0,0)"}); 
       $(".wrap").css({"height":$(window).height(),"overflow":"hidden"});//
    });
   
    $(".filter-open .blank").on("click",function(){
      $(".filter-open .blank").hide();
      $(".filter-open .pop_main").css({"transform":"translate(0,120%)","WebkitTransform":"translate(0,120%)"}); 
      $(".wrap").css({"height":"auto","overflow":"visible"});//
    });


    // });
   //点击筛选
    $(".list").click(function () {
        var btn_top = $('.btn1').offset().top;//
        var scroll_top = $(document).scrollTop() + 200;
        $('html,body').animate({scrollTop: '0px'}, 500);
        if (scroll_top > btn_top && btn_top != 0 && !$(".btn1").is(":hidden")) {
            return;
        }
        $(".filter-sort").hide();
        $(".filter-open").slideToggle(200); 
    });    
    //点击排序
      $(".list-sort").click(function () {
        var btn_top = $('.btn1').offset().top;//
        var scroll_top = $(document).scrollTop() + 200;//;//;
        // alert(btn_top);
        // alert(scroll_top);//
        // alert($(this).attr("data"));
        $('html,body').animate({scrollTop: '0px'}, 500);
        if (scroll_top > btn_top && btn_top != 0 && !$(".btn1").is(":hidden")) {
            //alert(scroll_top);
            return;
        }
        $(".filter-open").hide();
        $(".filter-sort").slideToggle(200);           
    });
    //选项选中事件
    $(".filter-open ul li.camp_days a,.filter-open ul li.camp_type a").on("click",function () {          
            $(this).toggleClass("on");
    });
    $(".filter-open ul li.destination a").on("click",function () {    
        if($(".filter-open ul li.destination a.on").length<5){
            $(this).toggleClass("on");
        }else{
            if($(this).hasClass('on')){
                $(this).removeClass("on");
            }else{
                layer.open({ content:"最多选择5个目的地", time: 1});
            }
            
        }
    });

    $(".filter_time input").each(function(){
       if($(this).val()!=""){
         $(this).addClass("on");
       }
    });
    
    //取消
    $(".btn2").click(function () {
        $(".filter-open ul li a").removeClass("on");
        $(".filter_time input").removeClass("on").val("");
         
        // if (list_type == "gs") {
        //     location.href = "/glcamp.html";
        // } else {
        //     location.href = "/cncamp.html";
        // }
        //取消筛选选中
        /*$(".filter-a a").each(function () {
         if($(this).attr("selectdata")=="0"){
         $(this).addClass("on"); 
         } 
         else{
         $(this).removeClass("on");
         }
         });
         
         //取消年龄滑杆
         $("#range_1").attr("value","4,18");*/
         var slider = $("#range_1").data("ionRangeSlider");      
         // slider.reset();
         slider.update({
            from: 0,
            to: 0
        });
    });


   function get_select_url(c_name){
        var   tmp='';
        $("."+c_name+" .on").each(function () {
            tmp += $(this).attr("selectdata") + ",";
        });
          if (tmp==''){
            return '0';
          }
          else{
           tmp=tmp.substring(0,tmp.length-1);
          }
            return tmp;
   }

    //确定
    $(".btn1").click(function () {
        $(".filter-open").slideToggle(200);
        var url = "";
        var parameter=$(".camp_lx ul li.on a").attr("href");
        var start=$("#start").val().replace(/-/g,"");
        var start_to=$("#start_to").val().replace(/-/g,"");
        var camp_lx2=0;
        if($(".camp_lx2 ul li").hasClass('on')){
            camp_lx2=$(".camp_lx2 ul li.on a").attr("selectdata");
        }
        if(start==""){
            start=0;
        }
        if(start_to==""){
            start_to=0;
        }
        url+= camp_lx2+'-';//公用产品
        url+= start+'-'+ start_to+'-';//公用产品
        url+= get_select_url("camp_days")+'-';//公用产品
        url+= get_select_url("camp_type")+'-';//公用产品
        url+= get_select_url("destination")+'-';//公用产品
      
        range = $("#range_1").val();

        arr = range.split(';');//注split可以用字符或字符串分割
         console.log(range);
        if (arr.length != 2) {
            alert("程序异常,请联系官网客服!");
            return;
        }
        if (arr[0] == "4") {
            arr[0] = "0";
        }
        if (arr[1] == "18") {
            arr[1] = "0";
        }
        url += arr[0] + "-" + arr[1]+'-0-0';
        url = "/" + list_type + "-" + url;    
        /*$(".filter-sort ul li a").each(function () {
            $(this).attr("selectdata");
            url += "-" + $(this).attr("selectdata");
        });*/
        if(parameter.indexOf("?")>0){
            url += ".html"+parameter.substring(parameter.indexOf("?"),parameter.length);
        }else{
            url += ".html";
        }
        
        // alert(url);return;
        window.location.href = url;
    });
});

$(document).ready(function () {
    $(".filter-open ul li").siblings().children(".filter-a").show();
    $(".filter-open ul li").click(function () {
        //alert($(this).children("dt").hasClass("filter-a"));
        //var ishasclass=$(this).children("dt").is(":hidden") ;

        // $(this).siblings().children(".filter-a").hide();//alert(ishasclass);
        // if(ishasclass){
        //  $(this).children(".filter-a").toggle();
        //  }
        // else{
        //  $(this).children(".filter-a").hide();
        //  }
        //  
        $(this).children(".filter-a").toggle();
        //  $(this).children("h2").children("i").toggleClass("rotate180");

    });

    $(".filter-open ul li dt").click(function (e) {
        e.stopPropagation();
    });

});

