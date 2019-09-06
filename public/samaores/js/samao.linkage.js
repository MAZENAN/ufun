// JavaScript Document

(function ($, undefined) {

    var Config = {
        rules: 'data_val'					//验证器规则
        , valmsg: 'data_val_msg'		 		//验证消息
        , valmsg_default: 'data_val_msg_default'		//默认描述
        , valmsg_valid: 'data_val_msg_valid'		//正确描述
        , val_events: 'data_val_events'			//触发事件进行验证
        , val_msgfor: 'data_valmsg_for'			//显示消息控件属性值 = id
        , val_off: 'data_val_off'				//关闭验证
        , val_error: 'error'                                //默认错误信息
        , val_return: 'data_return'                         //出错以后立即返回
        , field_error: 'field-val-error'
        , field_valid: 'field-val-valid'
        , field_default: 'field-val-default'
        , input_error: 'input-val-error'
        , input_valid: 'input-val-valid'
        , input_default: 'input-val-default'
        , tip_back: 'smbox-help'
        , data_url: 'data_url'
    };

    function Linkage(element) {
        var that = $(element);
        var valstr = that.val();
        //  console.log(valstr);
        var boxvals = [];
        if (valstr !== '') {
            try {
                boxvals = $.parseJSON(valstr);
            }
            catch (e) {
            }
        }
        var attr = {};
        attr.id = that.attr('id');
        if (attr.id === null || attr.id === '') {
            attr.id = 'linkage_' + new Date().getTime();
            that.attr('id', attr.id);
        }
        attr.name = that.attr('name');
        attr.url = that.attr(Config.data_url);
        attr.length = that.attr('length') || 0;
        attr.size = that.attr('size') || '';
        attr.style = that.attr('style') || '';
        attr.disabled = that.is(':disabled') ? true : false;
        attr['class'] = that.attr('class') || 'form-control select';
        attr[Config.rules] = that.attr(Config.rules) || '';
        attr[Config.val_off] = that.attr(Config.val_off) || '';
        attr[Config.valmsg] = that.attr(Config.valmsg) || '';
        attr[Config.valmsg_default] = that.attr(Config.valmsg_default) || '';
        attr[Config.valmsg_valid] = that.attr(Config.valmsg_valid) || '';
        attr[Config.val_events] = that.attr(Config.val_events) || '';
        attr[Config.val_msgfor] = that.attr(Config.val_msgfor) || '';
        attr['header'] = that.attr('header') || '';
        that.removeAttr('style');
        that.removeAttr('remote');
        that.removeAttr('class');
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
        var shower = $('<span id="linkage_' + attr.id + '"></span>').insertAfter(that);
        var tempdata = {};
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
            for (i in opts) {
                var opt = opts[i];
                var key = opt + nlevel;
                if (opt === 'name') {
                    if (attr[key] === undefined) {
                        var kname = attr.name + nlevel;
                        if (/\]$/.test(attr.name)) {
                            kname = attr.name.substr(0, attr.name.length - 1) + nlevel + ']';
                        }
                        attr[key] = that.attr(key) || kname;
                        that.removeAttr(key);
                    }
                }
                else {
                    if (attr[key] === undefined) {
                        attr[key] = that.attr(key) || attr[opt];
                        that.removeAttr(key);
                    }
                }
                if (attr[key] !== '' && opt !== 'header') {
                    selector.attr(opt, attr[key]);
                }
            }
            selector.attr('class', attr['class']);
            if (attr.size != '') {
                selector.attr('size', attr['size']);
            }
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
        function updateVals() {
            var vlasarr = [];
            var selects = shower.find('select');
            for (var i = 0; i < selects.length; i++) {
                vlasarr.push($(selects[i]).val());
            }
            that.val($.toJSON(vlasarr));
        }
        var onchange = function (vals) {
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
            if (attr.length != 0) {
                if (level > attr.length) {
                    return;
                }
            }
            vals = vals || [];
            box[0].length = 0;
            var header = attr['header' + level] == '' ? attr['header'] : attr['header' + level];
            if (header !== '') {
                box[0].add(new Option(header, ''));
            }
            box.data('length', items.length);
            var index = level - 1;
            var defval = vals[index] || '';
            if (items !== null) {
                for (var i = 0; i < items.length; i++) {
                    var obj = {value: items[i][0], title: items[i].length >= 2 ? items[i][1] : items[i][0], childs: items[i].length >= 3 ? items[i][2] : []};
                    var optitem = new Option(obj.title, obj.value);
                    box[0].add(optitem);
                    if (defval == obj.value) {
                        optitem.selected = true;
                    }
                    optitem.childsData = obj.childs;
                }
            }
            box.bind('change', function () {
                onchange.call(this);
            });
            onchange.call(box[0], vals);
        }
        var FirstBox = null;
        function createNextbox(emum, items, vals) {
            //如果是路径==
            if (typeof (items) === 'string') {
                if (items == '') {
                    return;
                }
                if (tempdata[items]) {
                    createNextbox(emum, tempdata[items], vals);
                    return;
                }
                $.post(items, null, function (data) {
                    if (data != null) {
                        tempdata[items] = data;
                        createNextbox(emum, data, vals);
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
                FirstBox = $('<select class="form-control select"></select>').appendTo(Box);
                addattr(FirstBox, 1);
                FirstBox[0].nextbox = null;
                FirstBox.data('level', 1);
                initbox(FirstBox, 1, items, vals);
            }
        }
        createNextbox(shower, attr.url, boxvals);
        this.update = function () {
            valstr = that.val();
            boxvals = [];
            if (valstr !== '') {
                try {
                    boxvals = $.parseJSON(valstr);
                }
                catch (e) {
                }
            }
            if (FirstBox) {
                var defval = boxvals[0] || '';
                FirstBox.val(defval);
                onchange.call(FirstBox[0], boxvals);
            }
        };
    }

    $.fn.linkage = function () {
        this.each(function (index, element) {
            if (typeof (element.Linkage) === 'undefined') {
                element.Linkage = new Linkage(element);
            } else {
                element.Linkage.update();
            }
        });
    };
})(jQuery);
