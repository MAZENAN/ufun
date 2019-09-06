/*左右滚动*/
var myScroll;
var myScroll2;
function loaded () {
  myScroll = new IScroll('#wrapper', { scrollX: true, freeScroll: true, scrollbars: false });
  myScroll2 = new IScroll('#wrapper2', { scrollX: true, freeScroll: true, scrollbars: false });
}
window.onload=function(){
   document.querySelector("#wrapper,#wrapper2").style.width=screen.width;
}
$(document).ready(function(){
    function listTag(){
      $(".exten").parents(".div").css("paddingTop","9px");
      if($(".indexf ul li img").height()!=$(".indexf ul li img").width()){
      //$(".indexf ul li img").height($(".indexf ul li img").width());
      }
      $(".exten").each(function(){
      	console.log($(this).text());
      	if($(this).text().length==3){	
      	$(this).css({"padding":"0px","letterSpacing":"0"});
        }
      });     
      
    }	 
    listTag();  
      /*首页成长快报滚动*/     
      // $(".new_one ul li").eq(0).css({"top":"0"});
      // var indexOld=0;
      // setInterval(function(){  
      // indexOld++;    

	     //    if(indexOld==$(".new_one ul li").index()+1){                      
	     //      indexOld=0;
	     //    }
      //        $(".new_one ul li").eq(indexOld).css({"top":"0","transition":".5s all ease"}).siblings().css({"top":"46px","transition":"none"});
      //        //$(".new_one ul li").eq(indexNew).animate({top:0});
                                   
      //  },1500); 

       /*判断ios设备*/
		if (/iP(hone|od|ad)/.test(navigator.userAgent)) {
		  var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/),
		    version = parseInt(v[1], 10);
		  if(version >= 8){
		  	$(".appdownload").show();		  	
		  	$(".vdescription .logo,.loreg-form ul li input.inp1,.layer_index h1,.tab_three ul li span,.tab_three,.tab span,.camp_lx2 ul li.on,.camp_lx2,.filter,.forum_list .label,.forum_list ul li,.forum_list,.tips,.article_first dd dl,.new_one ul a span,.grow_list ul li h3,.grow_boot,.user-boot,.extension ul li,.global_new .global_icon span,.global_con-select h2,.global_con-select #orderform ul.detail li,.global_con-total,.comment_grow h3,.grow_dlist_about .global-box,.comment_head img,#updown,.confirmorder_list2 ul li,.user-list ul li,.number_select ul li div.txt .inp,.new_one,.comment_grow h3,.date_select_par #wrapper").addClass("borderhalf");
		  }
		} 
		/*引流链接*/
		 $(".drainage_link").on("click",function(){
	      window.location.href="https://itunes.apple.com/us/app/ying-tian-xia-quan-guo-shou/id1151004913?mt=8";
	     });
	     $(".close").on("click",function(){
            $(this).parents(".layer_star").hide();
            $(".evaluate_layer_mask").hide();
            $(".layer_bg").hide();
	     });
      function prevent(e){
        e.preventDefault();
      }
      //列表页
      $(function(){
        var onLeft=$(".camp_lx ul li.on").offset().left;
        var liWidth=$(".camp_lx ul li").width();
        if(onLeft+liWidth>$(document).width()){
          $(".camp_lx ul").scrollLeft(onLeft-$(document).width()+liWidth);
        }   
      });
      //点击底部兰营地判断是国际还是国内    
      $(".boot_cn").on("click",function(){
          if(sessionStorage.ls=="gs"){
              window.location.href="/glcamp.html";
          }else{
              window.location.href="/cncamp.html";
          }
      });
    
     //首页、列表页弹层
     $(".chengnuo img,.tab_camp").on("click",function(e){
      if(this==e.target){
        $(".layer_index").css("opacity","1");
        $(".layer_index .laymshade").show();
        $(".layer_index .evaluate_layer").css("top","50%");
        document.body.addEventListener("touchmove",prevent);
      }   
     });
     $(".layer_index .close").on("click",function(){
       $(".layer_index").css("opacity","0");
       $(".layer_index").show();
       $(".layer_index .laymshade").hide();
       $(".layer_index .evaluate_layer").css("top","-50%");
       document.body.removeEventListener("touchmove",prevent);
     });
     //index.tpl
       if($(".index_forum ul li").length==0){
          $(".index_forum").hide();
       }
      //search.tpl
      $(".icon-search").on("click",function(){
        $(".search_camp_focus").show();         
        $(".search_camp_focus form .inp")[0].focus();       
      });
      $(".search_camp .inp").on("focus",function(){
        $(".search_camp_focus").show();
        $(".search_camp > .inp").blur();  
        $(".search_camp_focus form .inp")[0].focus();
       
      });
      $(".search_camp_focus .close").on("click",function(){
        $(".search_camp_focus").hide();
      });
  });



