(function($, undefined) {
    var Config = $.SMF.Config;
    function MuLinkage(that) {
        var pl = that.parent();
        var attr = {};
        attr.name = that.attr('name');
        attr.url = that.attr(Config.data_url);
        attr.length = that.attr('length') || 0;
        attr.size = that.attr('size') || 0;
        attr.style = that.attr('style') || '';
        attr.disabled = that.is(':disabled') ? true : false;
        attr[Config.rules] = that.attr(Config.rules) || '';
        attr[Config.val_off] = that.attr(Config.val_off) || '';
        attr[Config.valmsg] = that.attr(Config.valmsg) || '';
        attr[Config.valmsg_default] = that.attr(Config.valmsg_default) || '';
        attr[Config.valmsg_valid] = that.attr(Config.valmsg_valid) || '';
        attr[Config.val_events] = that.attr(Config.val_events) || '';
        attr[Config.val_msgfor] = that.attr(Config.val_msgfor) || '';
        attr['header'] = that.attr('header') || '';
        that.removeAttr('style');
        that.removeAttr('length');
        that.removeAttr(Config.data_url);
        that.removeAttr(Config.rules);
        that.removeAttr(Config.val_off);
        that.removeAttr(Config.valmsg);
        that.removeAttr(Config.valmsg_default);
        that.removeAttr(Config.valmsg_valid);
        that.removeAttr(Config.val_events);
        that.removeAttr(Config.val_msgfor);
        that.removeAttr('header');
        var tempdata = {};
        var ItemIndex = 1;
        function init() {
            var boxval = that.val();
            if (boxval == '') {
                var boxvals = [];
            }
            else {
                var boxvals = $.evalJSON(boxval) || [];
            }
            if (boxvals) {
                for (var i = 0; i < boxvals.length; i++) {
                    addClick(boxvals[i]);
                }
                if (boxvals.length == 0) {
                    addClick();
                }
            }
        }

        function addbox(vals) {
            //先取下拉数据--
            var divitem = $('<div class="mulinkage-item"></div>').appendTo(pl);
            divitem.data('index', ItemIndex);
            ItemIndex++;
            createNextbox(divitem, attr.url, vals, function() {
                var delbtn = $('<a class="samao-link-btn" style="margin-left:5px;" href="#">删除</a>').appendTo(divitem);
                delbtn.click(function() {
                    if (pl.find('div.mulinkage-item').length <= 1) {
                        alert('至少需要一项');
                        return false;
                    }
                    $(this).parent().remove();
                    updateVals();
                    var addbtns = pl.find('.addbtn');
                    addbtns.hide();
                    var btnadd = addbtns.last().show();
                    if (attr.size != 0 && attr.size > pl.find('div.mulinkage-item').length) {
                        btnadd.removeAttr('disabled');
                    }
                    return false;
                });
                var btnadd = $('<a class="samao-link-btn addbtn" style="margin-left:0px" href="#">添加</a>').appendTo(divitem);
                btnadd.click(addClick);
                var addbtns = pl.find('.addbtn');
                addbtns.hide();
                addbtns.last().show();
                if (attr.size != 0 && attr.size <= pl.find('div.mulinkage-item').length) {
                    btnadd.attr('disabled', true);
                }

            });
            return false;
        }

        //远程加载的数据
        var addClick = function(vals) {
            if (attr.size != 0 && attr.size <= pl.find('div.mulinkage-item').length) {
                alert('最大只允许添加' + attr.size + '项！');
                return false;
            }
            if (vals == null) {
                vals = [];
            }
            addbox(vals);
            return false;
        };
        //保存数据
        function updateVals() {
            var arrval = [];
            pl.find('div.mulinkage-item').each(function(index, element) {
                var boxvals = [];
                $(element).find('select').each(function(idx, box) {
                    var val = $(box).val();
                    if (val == null) {
                        val = '';
                    }
                    boxvals.push(val);
                });
                arrval.push(boxvals);
            });
            if (arrval.length == 0) {
                that.val('');
            }
            else {
                that.val($.toJSON(arrval));
            }
        }
        //添加属性==
        function addattr(selector, nlevel) {
            var opts = [
                'name',
                Config.rules,
                Config.valmsg,
                Config.valmsg_default,
                Config.valmsg_valid,
                Config.val_events,
                Config.val_msgfor,
                'header'];
            for (var i in opts) {
                var opt = opts[i];
                var key = opt + nlevel;
                if (opt === 'name') {
                    if (attr[key] === undefined) {
                        attr[key] = that.attr(key) || attr.name + nlevel;
                        that.removeAttr(key);
                    }
                }
                else {
                    if (attr[key] === undefined) {
                        attr[key] = that.attr(key) || attr[opt];
                        that.removeAttr(key);
                    }
                }
                if (attr[key] !== '' && opt === 'name') {
                    selector.attr(opt, attr[key] + '[]');
                }
                else if (attr[key] !== '' && opt === Config.val_msgfor) {
                    var index = selector.parents('div.mulinkage-item:first').data('index');
                    selector.attr(opt, attr[key] + index);
                }
                else if (attr[key] !== '' && opt !== 'header') {
                    selector.attr(opt, attr[key]);
                }
            }
            selector.attr('class', attr['class']);
            if (attr.disabled) {
                selector.attr('disabled', attr.disabled);
            }
        }
        function hideNextBox(box) {
            if (!box || $(box).is(':hidden')) {
                return;
            }
            if (box.nextBox && $(box.nextBox).is(':visible')) {
                hideNextBox(box.nextBox);
            }
            var boxopts = box.options;
            for (var i = box.length - 1; i >= 0; i--) {
                boxopts[i].childsData = null;
            }
            box.length = 0;
            var $box = $(box);
            $box.unbind('change');
            $box.hide();
            if (box.elem_mousedown && typeof (box.elem_mousedown) == 'function') {
                box.elem_mousedown.call(box);
            }
            $box.attr(Config.val_off, 'true');
        }
        var onchange = function(vals) {
            var box = $(this);
            var selected = box.children(':selected');
            var childs = (selected.length > 0 && selected[0].childsData) ? selected[0].childsData : [];
            //创建后面一个数据
            createNextbox(box[0], childs, vals);
            //设置默认值
            if (!box.nextBox || !$(box.nextBox).is(':visible')) {
                updateVals();
            }
        };
        function initbox(box, level, items, vals) {
            vals = vals || [];
            box[0].length = 0;
            var header = attr['header' + level] == '' ? attr['header'] : attr['header' + level];
            if (header !== '') {
                box[0].add(new Option(header, ''));
            }
            box.data('length', items.length);
            if (items !== null) {
                for (var i = 0; i < items.length; i++) {
                    var obj = {value: items[i][0], title: items[i].length >= 2 ? items[i][1] : items[i][0], childs: items[i].length >= 3 ? items[i][2] : []};
                    var optitem = new Option(obj.title, obj.value);
                    box[0].add(optitem);
                    var index = level - 1;
                    if (vals.length > index && vals[index] == obj.value) {
                        optitem.selected = true;
                    }
                    optitem.childsData = obj.childs;
                }
            }
            box.bind('change', function() {
                if (vals.length > 0)
                    vals = [];
                onchange.call(this);
            });
            onchange.call(box[0], vals);
        }
        function createNextbox(emum, items, vals, callback) {
            if (typeof (items) == 'string') {
                if (items == '') {
                    return;
                }
                if (tempdata[items]) {
                    createNextbox(emum, tempdata[items], vals, callback);
                    return;
                }
                $.post(items, null, function(data) {
                    if (data != null) {
                        tempdata[items] = data;
                        createNextbox(emum, data, vals, callback);
                    } else {
                        alert('无法加载远程数据！');
                    }
                }, 'json');
                return;
            }
            var Box = $(emum);
            if (Box.is('select')) {
                if (emum.nextBox && $(emum.nextBox).is(':visible')) {
                    hideNextBox(emum.nextBox);
                }
                var level = Box.data('level') + 1;
                if ((attr.length === 0 && items.length > 0) || level <= attr.length) {
                    if (emum.nextBox) {
                        var nextbox = $(emum.nextBox);
                        nextbox.show();
                        nextbox.removeAttr(Config.val_off);
                        addattr(nextbox, level);
                    }
                    else {
                        var nextbox = $('<select  class="form-control select"></select>').insertAfter(Box);
                        addattr(nextbox, level);
                        nextbox.data('level', level);
                        emum.nextBox = nextbox[0];
                    }
                    initbox(nextbox, level, items, vals);
                }
            }
            else {
                var firstbox = $('<select  class="form-control select"></select>').appendTo(Box);
                addattr(firstbox, 1);
                firstbox[0].nextbox = null;
                firstbox.data('level', 1);
                initbox(firstbox, 1, items, vals);
            }
            if (typeof (callback) == 'function') {
                callback();
            }
        }
        init();
    }

    $.fn.mulinkage = function() {
        this.each(function(index, element) {
            var that = $(element);
            MuLinkage(that);
        });
    };
})(jQuery);