// JavaScript Document
var Timer = null;

var tempOnePage = OnePage || '';
var tOnePage = false;
tempOnePage = tempOnePage.toLowerCase();
if (tempOnePage.toLowerCase() == 'on' || tempOnePage.toLowerCase() == 'yes' || tempOnePage.toLowerCase() == '1' || tempOnePage.toLowerCase() == 'true') {
    tOnePage = true;
}

var PageObject = function(url, title) {
    var that = this, tag, frame, lable;
    //更新宽度==
    var update = function() {
        var items = $('#movebar a');
        var barwidth = 0;
        items.each(function(index, element) {
            barwidth += $(element).outerWidth(true);
        });
        //预留300
        barwidth += 500;
        $('#movebar').width(barwidth);
    };
    var setLast = function() {
        var scrollLeft = $('#movebar').width() - $('#pbar').width() - 490;
        if (scrollLeft > 0) {
            $('#pbar').scrollLeft(scrollLeft);
        }
    };
    //创建==
    var create = (function() {
        
         var items = $('#movebar a');
         items.removeClass();
         
        //不新打开存在的窗口
        
        var len=$('#rcontent').find("iframe[src='"+url+"']").length;//$('#movebar').find("a[data='"+url+"']").length;//是否存在窗口
        //alert( $('#rcontent iframe').contentWindow.document.location.href);
        //var index=0;
         //$('#rcontent iframe').each(function(){
                 //alert($('#rcontent iframe')[index++].contentWindow.document.location.href);
         //    });
       // alert( $('#rcontent').find("iframe[src='"+url+"']").contentWindow.document.location.href);
        if(len>=1){
           tag=$('#movebar').find("a[data='"+url+"']");
           tag.addClass('idx');
           
           $('#rcontent iframe').hide();
           frame=$('#rcontent').find("iframe[src='"+url+"']");
           frame.show();
           return;
        }
  
         tag = $('<a href="#" class="idx"><span class="text">正在打开...</span><b></b></a>').appendTo('#movebar');
         tag.attr("data",url);
         update();
         setLast();
        
        lable = tag.find('.text');
        tag[0].mypage = that;
        tag.click(function() {
            that.show();
            return false;
        });
        tag.find('b').click(function() {
            that.remove();
            return false;
        });
        
        $('#rcontent iframe').hide();
        frame = $('<iframe scrolling="auto" frameborder="0" width="100%" height="100%"></iframe>').appendTo('#rcontent');
        frame.load(function() {
            try {
                lable.text(this.contentWindow.document.title);
            }
            catch (e) {
                lable.text(title);
            }
            update();
        });
        frame.attr('src', url);
    })();

    this.show = function() {
        $('#movebar a').removeClass();
        $('#rcontent iframe').hide();
        tag.addClass('idx');
        frame.show();
    };

    this.remove = function() {
        frame.remove();
        if (tag.mypage != null) {
            delete(tag.mypage);
            tag.mypage = null;
        }
        if (tag.is('.idx')) {
            var ptag = tag.prev('a');
            if (ptag.length > 0 && typeof (ptag[0].mypage) != 'undefined') {
                ptag[0].mypage.show();
            }
            else {
                ptag = tag.next('a');
                if (ptag.length > 0 && typeof (ptag[0].mypage) != 'undefined') {
                    ptag[0].mypage.show();
                }
            }
        }
        tag.remove();
        var iframes = $('#rcontent iframe');
        if (iframes.length == 1) {
            iframes.show();
        }
        update();
    };
};

var newpage = function(url, title) {

    new PageObject(url, title);
};


$(function() {
    window.onresize = function() {
        var h = document.body.clientHeight - document.getElementById("header").offsetHeight;
        document.getElementById("content").style.height = (h < 100 ? 100 : h) + 'px';
        h = h - document.getElementById("pagebar").offsetHeight;
        document.getElementById("rcontent").style.height = (h < 100 ? 100 : h) + 'px';
        if (!tOnePage) {
            document.getElementById("pbar").style.width = (document.getElementById("pagebar").offsetWidth - document.getElementById("pbtns").offsetWidth - 10) + 'px';
        }
    };
    window.onresize();
    var show_btn = $('#bardiv').click(function() {
        if ($(this).is('.hide')) {
            $(this).removeClass('hide');
            $('#left').show();
            $('#right').removeClass('big');
        }
        else {
            $(this).addClass('hide');
            $('#left').hide();
            $('#right').addClass('big');
        }
        var tempOnePage = OnePage || '';
        tempOnePage = tempOnePage.toLowerCase();
        if (!tOnePage) {
            document.getElementById("pbar").style.width = (document.getElementById("pagebar").offsetWidth - document.getElementById("pbtns").offsetWidth - 10) + 'px';
        }

    });
    show_btn.css('opacity', 0.5);
    show_btn.mouseenter(function(e) {
        $(this).css('opacity', 1);
    });
    show_btn.mouseleave(function(e) {
        $(this).css('opacity', 0.5);
    });

    var atops = $('#mainmune li');
    atops.click(function() {
        atops.removeClass('idx').removeClass('lidx');
        var that = $(this);
        that.addClass('idx');
        that.prev('li').addClass('lidx');
        var url = that.find('a').attr('href');
        if (url.length > 0 && url !== '#') {
            $.get(url, null, function(html) {
                $('#left').html(html);
            });
        }
        return false;
    });
    $('#mainmune li.idx').click();

    $('#left a[target="Main"]').live('click', function() {
        $('#left a[target="Main"]').removeClass('active');
        var that = $(this).addClass('active');
        var url = that.attr('href');
        var text = that.text();
        if (tOnePage) {
            $('#Main').attr('src', url);
        } else {
            newpage(url, text);
        }
        return false;
    });

    $('.quick-menu-list a[target="Main"]').live('click', function() {
        $('.quick-menu-list a[target="Main"]').removeClass('active');
        var that = $(this).addClass('active');
        var url = that.attr('href');
        var text = that.text();
        if (tOnePage) {
            $('#Main').attr('src', url);
        } else {
            newpage(url, text);
        }
        return false;
    });
    //在#main里打开新窗口
    $('a[target="Main"].pagebar').live('click', function() {
        $('a[target="Main"].pagebar').removeClass('active');
        var that = $(this).addClass('active');
        var url = that.attr('href');
        var text = that.text();
        if (tOnePage) {
            $('#Main').attr('src', url);
        } else {
            newpage(url, text);
        }
        return false;
    });


    $('#moveleft').mousedown(function() {
        if (Timer != null) {
            window.clearInterval(Timer);
            Timer = null;
        }
        var bar_area = $('#pbar');
        Timer = window.setInterval(function() {
            var L = bar_area.scrollLeft();
            if (L <= 0)
                return;
            L -= 15;
            L = L < 0 ? 0 : L;
            bar_area.scrollLeft(L);
        }, 20);
        $(document).one('mouseup', function() {
            if (Timer != null) {
                window.clearInterval(Timer);
                Timer = null;
            }
        });
    });

    $('#moveright').mousedown(function() {
        if (Timer != null) {
            window.clearInterval(Timer);
            Timer = null;
        }
        var bar_area = $('#pbar');
        var mL = $('#movebar').width() - bar_area.width() - 490;
        if (mL <= 0)
            return;
        Timer = window.setInterval(function() {
            var L = bar_area.scrollLeft();
            if (L >= mL)
                return;
            L += 15;
            L = L > mL ? mL : L;
            bar_area.scrollLeft(L);
        }, 20);
        $(document).one('mouseup', function() {
            if (Timer != null) {
                window.clearInterval(Timer);
                Timer = null;
            }
        });
    });

    $('#closeall').click(function() {
        if (!confirm("确定要关闭所有标签页面吗？"))
            return;
        $('#movebar a').each(function(index, element) {
            if (typeof (element.mypage) != 'undefined') {
                element.mypage.remove();
            }
        });
    });


    $('#left dt').live('click', function() {
        var icon = $(this).find('i');
        if (icon.is('.folder-open')) {
            icon.removeClass('folder-open').addClass('folder-close');
            $(this).siblings('dd').hide();
            $(this).parent('dl').css('padding-bottom', '0px');
            $(this).removeClass('item_open').addClass('item_close');
			$(this).children("i").css("transform","rotate(90deg)");
        }
        else {
            icon.removeClass('folder-close').addClass('folder-open');
            $(this).siblings('dd').show();
            $(this).parent('dl').css('padding-bottom', '5px');
            $(this).removeClass('item_close').addClass('item_open');
			$(this).children("i").css("transform","rotate(0deg)");
        }
    });
});