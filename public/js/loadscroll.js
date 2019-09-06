     //list_page_url=""; //默认为普通分页, union为分销商分页, ad为精选项目分页
     $('#container').infinitescroll({
         loading: {
                    msgText: "",
                    img: scroll_img_path,
                    finishedMsg: '已经到底啦！',
                    selector: '.loading' //loading选择器
                },
                navSelector: "#pages", //导航的选择器，会被隐藏
                nextSelector: "#next", //包含下一页链接的选择器
                itemSelector: "#container li", //你将要取回的选项(内容块)
                debug: false, //启用调试信息，若启用必须引入debug.js
                dataType: 'html', //格式要和itemSelector保持一致
                maxPage:  page_count, //最大加载的页数
                animate: false, //当有新数据加载进来的时候，页面是否有动画效果，默认没有
                extraScrollPx: 150, //滚动条距离底部多少像素的时候开始加载，默认150
 //               bufferPx: 40, //载入信息的显示时间，时间越大，载入信息显示时间越短
                errorCallback: function() { //加载完数据后的回调函数

                },
                path: function(index) { //获取下一页方法
                    if(typeof(list_page_url)=="undefined"){
                         return "?page=" + index;
                    }
                    return "?page=" + index+list_page_url;
                },
            }, function(newElements, data, url) { //回调函数
                if (/iP(hone|od|ad)/.test(navigator.userAgent)) {
                  var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/),
                    version = parseInt(v[1], 10);
                  if(version >= 8){   
                    $(".global_year,.global_double").addClass("borderhalf");
                  }
                } 
                 listTag();
                 if ($.isFunction($.our_fun)){
                      $.our_fun();
                    }
                
                //console.log(data);
                //alert(url);
            });

    