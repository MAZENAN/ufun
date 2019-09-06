(function ($, undefined) {
    var Config = $.SMF.Config;

    $.fn.smtabs = function (options) {
        this.each(function (index, element) {
            var that = $(this);
            var form = $(this.form);
            var boxval = that.val();
            var size = that.attr('length') || 0;
            var min_size = that.attr('min-length') || 0;
            var souresid = options.souresid || '';
            var htmlcode = options.code || $(souresid).html();
            var addfunc = options.addfunc || null;
            var removefunc = options.removefunc || null;
            if (boxval == '') {
                var arr = [];
            }
            else {
                var arr = $.evalJSON(boxval) || [];
            }
            var pl = that.parent();
            pl.delegate('a.btnadd', 'click', function () {
                if (size != 0 && size <= pl.find('div.item').length) {
                    alert('最大只允许添加' + size + '项！');
                    return false;
                }
                addbox();
                if (size != 0 && size <= pl.find('div.item').length) {
                    $(this).attr('disabled', true);
                }
                return false;
            });

            var pl = $('<div></div>').insertBefore(that);
            if (min_size == 0) {
                var itebtns = $('<div class=".item-btns"></div>').appendTo(pl);
                $('<a class="samao-link-btn btnadd" style="margin-left:0px" href="#">添加</a>').appendTo(itebtns);
            }
            pl.delegate('a.btndel', 'click', function () {
                if (pl.find('div.item').length == min_size) {
                    alert('至少需要一项！');
                    return false;
                }
                var xitem = $(this).parents('div.item:first');
                var Idx = xitem.data('idx');
                if (typeof (removefunc) == 'function') {
                    removefunc(Idx);
                }
                xitem.remove();
                pl.find('a.btnadd').hide();
                pl.find('a.btnadd:last').show().removeAttr('disabled');
                return false;
            });

            var index = 0;
            var addbox = function (val) {
                var Idx = index;
                var xitem = $('<div class="item"></div>').data('idx', Idx).appendTo(pl);
                var mcode = htmlcode.replace(/@\index/g, Idx);
                index++;
                $(mcode).appendTo(xitem);
                if (val) {
                    for (var key in val) {
                        var box = xitem.find(":input[name='" + that.attr('id') + '[' + Idx + '][' + key + "]']");
                        if (box.length > 0) {
                            console.log(val[key], box.attr('id'));
                            if (typeof (val[key]) == 'string' || typeof (val[key]) == 'number') {
                                if (box.is(':input[type=checkbox]')) {
                                    if (val[key] == 1) {
                                        box.attr('checked', 'checked');
                                    }
                                } else {
                                    box.val(val[key]);
                                }
                            } else {
                                box.val($.toJSON(val[key]));
                            }

                        }
                    }
                }
                var itembtns = xitem.find('.item-btns');
                if (itembtns.length) {
                    $('<a class="samao-link-btn btndel" style="margin-left:5px;" href="#">删除</a>').appendTo(itembtns);
                    $('<a class="samao-link-btn btnadd" style="margin-left:0px" href="#">添加</a>').appendTo(itembtns);
                } else {
                    $('<a class="samao-link-btn btndel" style="margin-left:5px;" href="#">删除</a>').appendTo(xitem);
                    $('<a class="samao-link-btn btnadd" style="margin-left:0px" href="#">添加</a>').appendTo(xitem);
                }
                pl.find('a.btnadd').hide();
                pl.find('a.btnadd:last').show();
                if (typeof (addfunc) == 'function') {
                    addfunc(Idx);
                }
                if ($.fn.initSMFInputs) {
                    xitem.find(':input[type!=submit][type!=reset][type!=button][disabled!=disabled]').initSMFInputs();
                }
                return false;
            };
            var len = arr.length;
            for (var k = 0; k < len; k++) {
                addbox(arr[k]);
            }
            if (len == 0) {
                if (min_size > 0) {
                    addbox();
                }

            }
        });
    };

    $.fn.smtabsTable = function (options) {
        this.each(function (index, element) {
            var that = $(this);
            var form = $(this.form);
            var boxval = that.val();
            var size = that.attr('length') || 0;
            var souresid = options.souresid || '';
            var table = options.table || that.attr('id') + '_table';
            var htmlcode = options.code || $(souresid).html();
            var addfunc = options.addfunc || null;
            var removefunc = options.removefunc || null;
            if (boxval == '') {
                var arr = [];
            }
            else {
                var arr = $.evalJSON(boxval) || [];
            }

            var pl = $('#' + table).find('tbody');
            var addbtn = $('<a class="samao-link-btn btnadd" style="margin-left:0px" href="#"> + 添加一行</a>').insertBefore(that);

            addbtn.on('click', function () {
                if (size != 0 && size <= pl.find('tr.item').length) {
                    alert('最大只允许添加' + size + '项！');
                    return false;
                }
                addbox();
                if (size != 0 && size <= pl.find('tr.item').length) {
                    $(this).attr('disabled', true);
                } else {
                    $(this).removeAttr('disabled');
                }
                return false;
            });

            pl.delegate('a.btndel', 'click', function () {
                if (pl.find('tr.item').length == 1) {
                    alert('至少需要一项！');
                    return false;
                }
                var xitem = $(this).parents('tr.item:first');
                var Idx = xitem.data('idx');
                if (typeof (removefunc) == 'function') {
                    removefunc(Idx);
                }
                xitem.remove();
                if (pl.find('tr.item').length == 1) {
                    pl.find('a.btndel').hide();
                } else {
                    pl.find('a.btndel').show();
                }
                return false;
            });
            var index = 0;
            var addbox = function (val) {
                var Idx = index;
                var mcode = htmlcode.replace(/@\index/g, Idx);
                var xitem = $(mcode).data('idx', Idx).appendTo(pl);
                if (pl.find('div.item').length == 1) {
                    pl.find('a.btndel').hide();
                } else {
                    pl.find('a.btndel').show();
                }
                index++;
                if (val) {
                    for (var key in val) {
                        var box = xitem.find(":input[name='" + that.attr('id') + '[' + Idx + '][' + key + "]']");
                        if (box.length > 0) {
                            if (box.is(':input[type=checkbox]')) {
                                if (val[key] == 1) {
                                    box.attr('checked', 'checked');
                                }
                            } else {
                                box.val(val[key]);
                            }
                        }
                    }
                }
                if (typeof (addfunc) == 'function') {
                    addfunc(Idx);
                }
                if ($.fn.initSMFInputs) {
                    xitem.find(':input[type!=submit][type!=reset][type!=button][disabled!=disabled]').initSMFInputs();
                }
                return false;
            };
            var len = arr.length;
            for (var k = 0; k < len; k++) {
                addbox(arr[k]);
            }
            if (len == 0) {
                addbox();
            }



        });
    };

})(jQuery);
