$(function () {
    var boxs = $('.thecon-inlis-select select');
    var depid = $('#depid').val() || 0;
    var setbox = function (box) {
        boxs.removeClass('on');
        box.addClass('on');
        var cost = box.data('cost');
        var deposit = box.data('deposit');
        var html = '';
        if (cost) {
            html += '费　用 : <span>￥' + cost + '</span> 元<br />';
            // if (deposit) {
            //     html += '预定金 : <span>￥' + deposit + '</span> 元';
            // }
        } else {
            html += '<b>&nbsp;&nbsp;暂无报价&nbsp;&nbsp;</b>';
        }
        $('#price').html(html);
    };
    if (depid != 0) {
        boxs.each(function (index, element) {
            var box = $(element);
            if (box.data('id') == depid) {
                setbox(box);
            }
        });
    } else {
        depid = boxs.filter('.on').data('id') || 0;
        $('#depid').val(depid);
    }
    


    boxs.on('change', function () { 
        var box = $(this).children('option:selected');
        boxs.removeClass('on');
        box.addClass('on');
        depid = box.data('id') || 0;
        $('#depid').val(depid);
        setbox(box);
       
        if(box.data('allow')=="0"){
         $(".global_buy").addClass('global_buy2');
         $(".global_buy").html("报名已截止");

        }else if(box.data("allow")=="2"){
         $(".global_buy").removeClass("global_buy2");
         $(".global_buy").addClass("global_buy3");
         $(".global_buy").html("立即预定");
        }
         return false;
    });
   $(".global_buy").click(function(){
    if($(".thecon-inlis-select select").children('option:selected').data('allow')=="2"){
      $("#orderform").submit();
      }
    });

    var fixedtop = $(".fixedtop");

    if (fixedtop.length == 1) {
        var daymenu = $('.day-menu');
        var rcap=$('div.rcap');
        var detailnavs = $('.fixedtop ul>li a').not('.fixedtop ul>li.last a');
        var lays = $('.themai');
        var navH = 0;
        var dayH = 0;
        var dayHeight = 0;
        var headitems = $('.day-menu>li');
        var headitemsbtn = $('.day-menu>li a');
        var listitems = $('li.day-item');
        $(window).scroll(function () {
            navH = navH || fixedtop.offset().top;
            dayH = rcap.offset().top + 60;
            
            dayHeight = dayHeight || daymenu.height();
            var scroH = $(this).scrollTop();
            if (scroH >= navH) {
                fixedtop.css({"position": "fixed", "top": 0, 'z-index': 9999});
            } else if (scroH < navH) {
                fixedtop.css({"position": "static"});
            }
            if (scroH >= dayH) {
                daymenu.css({"position": "fixed", "top": 70, 'z-index': 9998});
            } else if (scroH < dayH) {
                daymenu.css({"position": "static"});
            }
            var hxH = lays.eq(1).offset().top + lays.eq(1).height();
            var mhei = daymenu.offset().top + dayHeight;
            if (mhei > hxH) {
                var xwh = mhei - hxH;
                xwh = -xwh;
                daymenu.css({"position": "fixed", "top": xwh + 40, 'z-index': 9998});
            }
            for (var i = 0; i < lays.length; i++) {
                var lay = lays.eq(i);
                var xtop = lay.offset().top - 40;
                var xfoot = lay.height() + xtop;
                if (scroH >= xtop && scroH < xfoot) {
                    if (!detailnavs.filter('.on').is(detailnavs.eq(i))) {
                        // detailnavs.eq(i).triggerHandler('click');
                        detailnavs.filter('.on').removeClass('on');
                        detailnavs.eq(i).addClass('on');
                    }
                }
            }
            for (var k = 0; k < listitems.length; k++) {
                var item = listitems.eq(k);
                var itop = item.offset().top - 58;
                var ifoot = item.height() + itop;
                if (scroH >= itop && scroH < ifoot) {
                    if (!headitems.filter('.on').is(headitems.eq(k))) {
                        headitems.filter('.on').removeClass('on');
                        headitems.eq(k).addClass('on');
                    }
                }
            }

        });
        detailnavs.on('click', function () {
            detailnavs.removeClass('on');
            var that = $(this).addClass('on');
            var name = that.data('name');
            var lay = lays.filter('.' + name);
            var top = lay.offset().top - 40;
            console.log(top);
            window.scrollTo(0, top);
            return false;
        });
        headitems.each(function (idx, em) {
            var btn = $(em).find('a');
            btn.on('click', idx, function (ev) {
                headitems.removeClass('on');
                $(this).parent().addClass('on');
                var top = listitems.eq(ev.data).offset().top - 58;
                window.scrollTo(0, top);
                return false;
            });
        });

    }

//日程安排高度
 $(".day-menu li").each(function(){
        var this_height=$(this).children(".themai-schedule-day").height();
        $(this).height(this_height);
    });


});