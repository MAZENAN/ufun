$(function () {
    var checkall = $('#checkall');
    if (checkall.length > 0) {

        checkall.click(function () {
            $('.checkitem').attr('checked', this.checked);
        });

        function getIds() {
            var ids = [];
            $('.checkitem').each(function (index, element) {
                var $element = $(element);
                if ($element.is(':checked')) {
                    ids.push($element.val());
                }
            });
            return ids.join(',');
        }

        function getname(name, sids) {
            var vals = [];
            var ids = sids.split(',');
            for (var i in ids) {
                var val = $('#' + name + ids[i]).val();
                vals.push(val);
            }
            return vals.join(',');
        }

        $("#allopts a.optbtn").click(function () {
            var ids = getIds();
            if (ids == '') {
                alert('未选中任何信息!');
                return false;
            }
            var _this = $(this);
            var tip = _this.attr('tip');
            if (tip) {
                if (!confirm(tip)) {
                    return false;
                }
            }
            var url = _this.attr('href').replace('[ids]', ids);
            url = url.replace(/\[([a-z]+)\]/g, function ($0, name) {
                return getname(name, ids);
            });
            _this.attr('href', url);
            return true;
        });
    }
    $('.samao-minimenu').hover(function () {
        var menu = $(this).addClass('hover');
        var menubody = menu.find('.samao-menu-body');
        var left = menu.outerWidth(true) - menubody.outerWidth(true);
        menubody.css('left', left + 'px');
    }, function () {
        $(this).removeClass('hover');
    });

    $('.samao-menu').mouseenter(function () {
        var menu = $(this);
        menu.addClass('hover');
        var menubody = menu.find('.samao-menu-body');
        var mr = menu.offset().left + menubody.outerWidth();
        var wr = $(document.body).width() - 10;
        if (mr > wr) {
            menubody.css('left', (wr - mr) + 'px');
        } else {
            menubody.css('left', 0);
        }

    }).mousedown(function (event) {
        event.stopPropagation();
    });
    $(document).mousedown(function () {
        $('.samao-menu').removeClass('hover');
    });

});
