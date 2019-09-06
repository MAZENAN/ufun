/*SMF表单验证器 验证器 2.0版本 
 网站 www.samaophp.com 
 使用例子 需要 jQuery 支持环境
 
 */
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
    //默认提示消息
    var DefMsgs = {
        required: '必选字段'
        , email: '请输入正确格式的电子邮件'
        , url: '请输入正确格式的网址'
        , date: '请输入正确格式的日期'
        , number: '仅可输入数字'
        , digits: '只能输入整数'
        , equalTo: '请再次输入相同的值'
        , maxlenght: '请输入一个 长度最多是 {0} 的字符串'
        , minlength: '请输入一个 长度最少是 {0} 的字符串'
        , rangelenght: '请输入 一个长度介于 {0} 和 {1} 之间的字符串'
        , range: '请输入一个介于 {0} 和 {1} 之间的值'
        , max: '请输入一个小于 {0} 的值'
        , min: '请输入一个大于 {0} 的值'
        , remote: '检测数据不符合要求'
        , regex: '请输入正确格式字符'
        , mobile: '手机号码格式不正确'
        , idcard: '身份证号码格式不正确'
    };

    //字符串格式输出==
    String.prototype.formatString = function (args) {
        if (!this || !args) {
            return this;
        }
        if (!$.isArray(args)) {
            args = [args];
        }
        return this.replace(/{(\d+)}/ig, function ($0, $1) {
            return args.length > $1 ? args[parseInt($1)] : '';
        });
    };

    var isPlaceholderSupport = (function () {
        return 'placeholder' in document.createElement('input');
    })();
    //如果不支持placeholder 重写val函数
    if (!isPlaceholderSupport) {
        $.fn.oldPlaceholderSupportVal = $.fn.val;
        $.fn.val = function (value) {
            var that = this;
            if (value === undefined) {
                if (that[0] && (that.is(':text[placeholder],textarea[placeholder]'))) {
                    var holder = that.attr('placeholder');
                    if (holder != '' && that.oldPlaceholderSupportVal() == holder) {
                        return '';
                    }
                }
                return that.oldPlaceholderSupportVal();
            }//读
            return that.oldPlaceholderSupportVal(value);
        };
    }

    var Funcs = {};
    var ShotName = {};
    var FormSubmitState = false;//表单提交状态
    var remoteElems = [];
    //注册函数

    var regfunc = function (key, fn, defmsg) {
        if (typeof (fn) === 'function') {
            Funcs[key] = fn;
            if (defmsg) {
                DefMsgs[key] = defmsg;
            }
        }
        //添加别名
        if (typeof (fn) === 'string') {
            ShotName[key] = fn;
        }
    };
    var getshotmap = function (key) {
        if (ShotName[key])
            return ShotName[key];
        return key;
    };

    //获取函数
    var getfunc = function (key) {
        return Funcs[key];
    };

    var getmsg = function (key) {
        return DefMsgs[key];
    };

    function randomString(len) {
        len = len || 32;
        var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
        var maxPos = $chars.length;
        var run = '';
        for (i = 0; i < len; i++) {
            run += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return run;
    }

    var getMsgLabel = function (elem) {
        var forid = elem.attr(Config.val_msgfor) || '';
        var msglabel = null;
        if (forid !== '') {
            msglabel = $(forid);
            if (msglabel.length == 0) {
                var id = forid.substr(1);
                msglabel = $('<span id="' + id + '"></span>').appendTo(elem.parent());
            }
        }
        else {
            var id = elem.attr('id') || randomString(20);
            msglabel = $('<span id="temp_info_' + id + '"></span>').appendTo(elem.parent());
            elem.attr(Config.val_msgfor, '#temp_info_' + id);
        }
        return msglabel;
    };

    //呈现形式=====================================
    var displayDefault = function (args) {
		var msg=args.msg,elem=args.elem;
        elem.removeClass(Config.input_error).removeClass(Config.input_valid).addClass(Config.input_default);
        if ($.fn.smtip && elem.attr('data_val_smtip') == 1) {
            if (elem.data('cache-smtip')) {
                elem.smtip("destroy");
            }
        } else {
            var msglabel = getMsgLabel(elem);
            msglabel.removeClass(Config.field_error).removeClass(Config.field_valid).addClass(Config.field_default);
            msglabel.html(msg);
            if (!msg) {
                msglabel.hide();
            }
        }
    };

    //正确形式=====================================
    var displayValid = function (args) {
		var msg=args.msg,elem=args.elem;
        elem.removeClass(Config.input_error).removeClass(Config.input_default).addClass(Config.input_valid);
        if ($.fn.smtip && elem.attr('data_val_smtip') == 1) {
            if (msg) {
                if (elem.data('cache-smtip')) {
                    elem.smtip("destroy");
                }
                elem.data('cache-smtip', true);
                elem.smtip({content: msg, css: 'valid'});
            }
        }
        else {
            if (msg) {
                var msglabel = getMsgLabel(elem);
                msglabel.show();
                msglabel.removeClass(Config.field_error).removeClass(Config.field_default).addClass(Config.field_valid);
                msglabel.html(msg);
            }
        }
    };

    var displayError = function (args) {
		var msg=args.msg,elem=args.elem,data=args.data,errtype=args.errtype,submit=args.submit;
        if (submit === false && data && data.erropt !== 'remote') {
            return;
        }
        if (!errtype) {
            elem.removeClass(Config.input_valid).removeClass(Config.input_default).addClass(Config.input_error);
        }
        if ($.fn.smtip && elem.attr('data_val_smtip') == 1) {
            if (msg) {
                if (elem.data('cache-smtip')) {
                    elem.smtip("destroy");
                }
                elem.data('cache-smtip', true);
                elem.smtip({content: msg, css: 'error'});
            }
        }
        else {
            if (msg) {
                var msglabel = getMsgLabel(elem);
                msglabel.removeClass(Config.field_valid).removeClass(Config.field_default).addClass(Config.field_error);
                var offtemp = elem.data('cache-temp-off') || '';
                if (!offtemp) {
                    msglabel.show();
                    msglabel.html(msg);
                }
            }
        }
    };

    var timelyResult = function (elem, data) {
        if (elem[0].result !== undefined && typeof (elem[0].result) === 'function') {
            elem[0].result(data.pass);
        }
    };

    var displayAllError = function (items) {

    };

    var cleanAllError = function () {
    };

    var setCustomFunc = function (funname, fn) {
        if (funname === 'display_default' || funname === 'displayDefault') {
            displayDefault = fn;
        }
        if (funname === 'display_valid' || funname === 'displayValid') {
            displayValid = fn;
        }
        if (funname === 'display_error' || funname === 'displayError') {
            displayError = fn;
        }
        if (funname === 'display_allerror' || funname === 'displayAllError') {
            displayAllError = fn;
        }
        if (funname === 'clean_allerror' || funname === 'cleanAllError') {
            cleanAllError = fn;
        }
        if (funname === 'timely_result' || funname === 'timelyResult') {
            timelyResult = fn;
        }
    };

    var getCustomFunc = function (funname) {
        if (funname === 'display_default' || funname === 'displayDefault') {
            return displayDefault;
        }
        if (funname === 'display_valid' || funname === 'displayValid') {
            return displayValid;
        }
        if (funname === 'display_error' || funname === 'displayError') {
            return displayError;
        }
        if (funname === 'display_allerror' || funname === 'displayAllError') {
            return displayAllError;
        }
        if (funname === 'clean_allerror' || funname === 'cleanAllError') {
            return cleanAllError;
        }
        if (funname === 'timely_result' || funname === 'timelyResult') {
            return timelyResult;
        }
    };

    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return unescape(r[2]);
        }
        return '';
    }

    var ajaxRemote = function (elem, data, fn) {
        var elemcache = elem.data('sm-cache');
        if (typeof (elemcache) === 'object') {
            if (elem.val() === elemcache.val) {
                data.pass = elemcache.pass;
                data.erropt = 'remote';
                data.remote_msg = elemcache.remote_msg;
                fn(data);
                return;
            }
        }
        var val = data.rules.remote;
        var name = elem.attr('name');
        if (name === undefined || name === '')
            return;
        var url = '';
        var type = 'post';
        var otvals = '';//而外要附加的字段ID
        if ($.isArray(val)) {
            if (val.length >= 1)
                url = val[0];
            if (val.length >= 2)
                type = val[1];
            if (val.length >= 3)
                otvals = val[2];
        }
        else {
            url = val;
        }
        var opt = {};
        var value = elem.val();
        opt[name] = value;
        if (otvals !== '') {
            var arrtemp = otvals.split(',');
            for (i in arrtemp) {
                var xname = arrtemp[i];
                var sle = ':input[name=' + xname + ']';
                var _elem = $(sle);
                if (_elem.length > 0) {
                    var _name = _elem.attr('name');
                    if (_name && _name !== '') {
                        opt[_name] = _elem.val();
                    }
                } else {
                    var val = getQueryString(xname);
                    if (val !== '') {
                        opt[xname] = val;
                    }
                }
            }
        }
        $.ajax({url: url, data: opt, type: type.toUpperCase(), dataType: 'json', success: function (ret) {
                if (typeof (ret) == 'boolean') {
                    if (ret === true) {
                        data.pass = true;
                    }
                    else {
                        data.pass = false;
                        data.erropt = 'remote';
                    }
                    elem.data('sm-cache', {val: value, pass: data.pass});
                    fn(data);
                } else {
                    if (ret.status === true) {
                        data.pass = true;
                    }
                    else {
                        data.remote_msg = ret.msg;
                        data.pass = false;
                        data.erropt = 'remote';
                    }
                    elem.data('sm-cache', {val: value, pass: data.pass, remote_msg: ret.msg});
                    fn(data);
                }
            }});
    };

    var getItem = function (elem) {
        var rules_attr = elem.attr(Config.rules) || '';
        var valmsg_attr = elem.attr(Config.valmsg) || '';
        var msg_default = elem.attr(Config.valmsg_default) || '';
        var msg_valid = elem.attr(Config.valmsg_valid) || '';
        var events_attr = elem.attr(Config.val_events) || '';
        var offerr = elem.attr(Config.val_off) || '';
        var rules_off = (offerr === 'true' || offerr === 1 || offerr === '1' || offerr === 'on');
        var returnattr = elem.attr(Config.val_return) || '';
        var val_return = (returnattr === 'true' || returnattr === 1 || returnattr === '1' || returnattr === 'on');
        var temp_rules = {};
        var temp_msgs = {};
        var rules = {};
        var msgs = {};
        if (rules_attr == '') {
            return null;
        }
        //解析消息
        if (valmsg_attr) {
            try {
                temp_msgs = eval('(' + valmsg_attr + ')');
            } catch (e) {
                alert('解析字段属性数据 ' + Config.valmsg + ' 出现问题:\n\n' + valmsg_attr);
                return null;
            }
        }
        //解析验证
        if (rules_attr) {
            try {
                temp_rules = eval('(' + rules_attr + ')');
            } catch (e) {
                alert('解析字段属性数据 ' + Config.rules + ' 出现问题:\n\n' + rules_attr);
                return null;
            }
        }
        else {
            for (var key in msgs) {
                temp_rules[key] = true;
            }
        }
        //先加入判断空
        for (var key in temp_rules) {
            var bkey = getshotmap(key);
            if (bkey == 'required') {
                rules[bkey] = temp_rules[key];
                break;
            }
        }
        for (var key in temp_rules) {
            var bkey = getshotmap(key);
            if (bkey != 'remote' && bkey != 'required') {
                rules[bkey] = temp_rules[key];
            }
        }
        for (var key in temp_rules) {
            var bkey = getshotmap(key);
            if (bkey == 'remote') {
                rules[bkey] = temp_rules[key];
                break;
            }
        }
        for (var key in temp_msgs) {
            var bkey = getshotmap(key);
            msgs[bkey] = temp_msgs[key];
        }
        for (var key in rules) {
            if (!msgs[key] && DefMsgs[key]) {
                msgs[key] = DefMsgs[key];
            }
        }
        return {
            rules: rules,
            msgs: msgs,
            msg_default: msg_default || '',
            msg_valid: msg_valid || '',
            erropt: null,
            pass: true,
            remote: !!rules.remote,
            off: rules_off,
            vreturn: val_return,
            events: events_attr
        };
    };

    var checkBox = function (elem, data) {
        elem.unbind('mousedown', elem_mousedown);
        elem.bind('mousedown', elem_mousedown);
        elem[0].elem_mousedown = elem_mousedown;
        var val = elem.val();
        var rules = data.rules;
        var type = elem.attr('type') || elem[0].type || 'text';
        if (type.toLowerCase() === 'checkbox' || 'radio' === type.toLowerCase()) {
            val = elem.is(':checked') ? val : '';
        }
        for (var key in rules) {
            if (key === 'remote') {
                if (FormSubmitState) {
                    remoteElems.push(elem);
                    var rmdata = elem.data('sm-cache');
                    if (rmdata && !rmdata.pass) {
                        data.erropt = key;
                        data.pass = false;
                        if (rmdata.remote_msg) {
                            data.msgs.remote = rmdata.remote_msg;
                        }
                    }
                }
                continue;
            }
            if (!Funcs[key] || typeof (Funcs[key]) != 'function') {
                continue;
            }
            //验证非空====
            if ((key === 'required') && rules[key] === true) {
                if (val === '') {
                    data.erropt = key;
                    data.pass = false;
                }
            }
            if (val === '') {
                return data;
            }
            var args = rules[key];
            if (!$.isArray(args)) {
                args = [args];
            }
            args = args.slice(0);
            args.unshift({val: val, elem: elem});
            if (!Funcs[key].apply(elem, args)) {
                data.erropt = key;
                data.pass = false;
                return data;
            }
        }
        return data;
    };

    var getAllInputs = function (form) {
        var inputs = [];
        for (var i = 0; i < form.elements.length; i++)
        {
            inputs.push(form.elements.item(i));
        }
        inputs = $(inputs).filter(':input[type!=submit][type!=reset][type!=button][disabled!=disabled]');
        return inputs;
    };

    var elem_mousedown = function () {
        var elem = $(this);
        var forid = elem.attr(Config.val_msgfor);
        if (forid) {
            var Pindex = -1;
            $(':input[' + Config.val_msgfor + '="' + forid + '"]').each(function (index, element) {
                if (element === elem[0]) {
                    Pindex = index;
                }
                if (index > Pindex && Pindex != -1) {
                    $(element).removeData('cache-temp-off');
                }
            });
        }
        var data = getItem(elem);
        if (!data) {
            return;
        }
        try {
            displayDefault({msg:data.msg_default,elem:elem,data:data});
        } catch (ex) {

        }
    };
    //清理临时关闭后面与之相同的验证
    var cleanTempOff = function (elem) {
        var forid = elem.attr(Config.val_msgfor) || '';
        if (forid !== '') {
            elem.nextAll(':input[' + Config.val_msgfor + '="' + forid + '"]').removeData('cache-temp-off');
        }
    };
    //临时关闭后面与之相同的验证
    var addTempOff = function (elem) {
        var forid = elem.attr(Config.val_msgfor) || '';
        if (forid !== '') {
            elem.nextAll(':input[' + Config.val_msgfor + '="' + forid + '"]').data('cache-temp-off', '1');
        }
    };

    //检查非远程相关的
    var checkFormNoRemote = function (form) {
        FormSubmitState = true;//表单检查为真
        remoteElems.length = 0;
        var allpass = true;
        var errItems = [];
        var inputs = getAllInputs(form);
        cleanAllError();
        inputs.each(function (index, element) {
            var elem = $(element);
            var data = getItem(elem);
            if (!data || data.off) {
                return;
            }
            data = checkBox(elem, data);
            //接管处理请求
            var Result = timelyResult(elem, data);
            if (!data.pass) {
                var msg = data.msgs[data.erropt] || '';
                msg = msg.formatString(data.rules[data.erropt]);
                try {
                    addTempOff(elem);
                    displayError({msg:msg, elem:elem, data:data,submit:FormSubmitState,errtype:0});
                } catch (ex) {
                }
                errItems.push({data: data, elem: elem, msg: msg});
            }
            else {
                try {
                    cleanTempOff(elem);
                    displayValid({msg:data.msg_valid, elem:elem, data:data});
                } catch (ex) {
                }
            }
            allpass = allpass && data.pass;
            if (Result === true || data.vreturn) {
                if (!allpass) {
                    return false;
                }
            }
        });
        if (allpass === false) {
            try {
                displayAllError(errItems);
            } catch (ex) {
            }
            setTimeout(function () {
                try {
                    errItems[0].elem.focus();                   
                    $(document).scrollTop(errItems[0].elem.offset().top - 100);
                } catch (e) {
                }
            }, 100);
        }
        //如果全部通过
        if (allpass && !isPlaceholderSupport) {
            var holderinputs = inputs.filter(':text[placeholder],textarea[placeholder]');
            holderinputs.each(function (index, element) {
                var that = $(element);
                if (that.val() == '') {
                    that.val('');
                }
            });
        }
        return allpass;
    };

    //检查表单数据==
    var checkForm = function (form) {
        if (form.SMF_options && typeof (form.SMF_options.beforefn) == 'function') {
            form.SMF_options.beforefn();
        }
        var allpass = checkFormNoRemote(form);
        var i = 0;
        var nextajax = function () {
            if (i >= remoteElems.length) {
                return;
            }
            var xcelem = remoteElems[i];
            var xcdata = getItem(xcelem);
            i++;
            ajaxRemote(xcelem, xcdata, function (tdata) {
                if (!tdata.pass) {
                    var msg = tdata.msgs[tdata.erropt] || '';
                    if (tdata.remote_msg) {
                        msg = tdata.remote_msg;
                    }
                    msg = msg.formatString(tdata.rules[tdata.erropt]);
                    try {
                        displayError({msg:msg, elem:xcelem, data:tdata,submit:FormSubmitState,errtype:0});
                    } catch (ex) {
                    }
                }
                nextajax();
            });
        };
        //验证远程端===
        if (!allpass) {
            nextajax();
        }
        FormSubmitState = false;
        return allpass;
    };

    var dataValGroup = function (elem) {
        if (elem.data('cache-temp-off') == 'true') {
            return;
        }
        var forid = elem.attr(Config.val_msgfor) || '';
        var form = elem.parents('form:first');
        if (forid != '') {
            var forboxs = form.find(':input[' + Config.val_msgfor + '="' + forid + '"]');
            if (forboxs.length > 1) {
                elem[0].result = function (verify) {
                    var nextVal = false;
                    var nextboxs = forboxs.filter(function (index) {
                        if (nextVal == true) {
                            return true;
                        }
                        if (this == elem[0]) {
                            nextVal = true;
                        }
                    });
                    if (verify) {
                        nextboxs.removeData('cache-temp-off');
                    }
                    else
                    {
                        nextboxs.data('cache-temp-off', 'true');
                    }
                };
            }
        }
    };
    var initInputs = function (inputs) {
        /*修正placeholder*/
        if (!isPlaceholderSupport) {
            var holderinputs = inputs.filter(':text[placeholder],textarea[placeholder]');
            holderinputs.each(function (index, element) {
                var that = $(element);
                var holder = that.attr('placeholder');
                if (that.val() == '') {
                    var holder = that.attr('placeholder');
                    if (holder != '') {
                        that.addClass('placeholder');
                        that.val(holder);
                    }
                }
                if (holder != '') {
                    that.bind('focus', function () {
                        var that = $(this);
                        var holder = that.attr('placeholder');
                        that.removeClass('placeholder');
                        if (that.val() == '' && holder != '') {
                            that.val('');
                        }
                    });
                    that.bind('blur', function () {
                        var that = $(this);
                        var holder = that.attr('placeholder');
                        if (that.val() == '' && holder != '') {
                            that.addClass('placeholder');
                            that.val(holder);
                        }
                    });
                }
            });

        }
        //绑定它们的验证事件==
        var chcekError = function () {
            var elem = $(this);
            var data = getItem(elem);
            if (!data || data.off) {
                return;
            }
            data = checkBox(elem, data);
            if (!data.pass) {
                var msg = data.msgs[data.erropt] || '';
                msg.formatString(data.rules[data.erropt]);
                try {
                    if (elem.data('sm-display') === 'remote' && !FormSubmitState) {
                        displayError({msg:msg, elem:elem, data:data,submit:FormSubmitState,errtype:1});
                    }
                    else {
                        displayError({msg:msg, elem:elem, data:data,submit:FormSubmitState,errtype:0});
                    }
                } catch (ex) {
                }
                return;
            }
            if (data.remote) {
                ajaxRemote(elem, data, function (tdata) {
                    if (!tdata.pass) {
                        var msg = tdata.msgs[tdata.erropt] || '';
                        if (tdata.remote_msg) {
                            msg = tdata.remote_msg;
                        }
                        msg.formatString(tdata.rules[tdata.erropt]);
                        try {
                            displayError({msg:msg, elem:elem, data:tdata,submit:FormSubmitState,errtype:0});
                        } catch (ex) {
                        }
                    }
                    else {
                        try {
							
                            displayValid({msg:tdata.msg_valid, elem:elem, data:tdata});
                        } catch (ex) {
                        }
                    }
                });
                return;
            }
            try {
                displayValid({msg:data.msg_valid, elem:elem, data:data});
            } catch (ex) {
            }
        };
        inputs.each(function (index, element) {
            var elem = $(element);
            if (elem.attr('data_val_msg_default_tip') == '1') {
                var lable = getMsgLabel(elem);
                var helplable = $(lable).prev('.smbox-help').hide();
                elem.attr('data_val_msg_default', helplable.text());
            }
            //同组依次验证
            dataValGroup(elem);
            var data = getItem(elem);
            if (data && data.msg_default) {
                displayDefault({msg:data.msg_default,elem:elem,data:data});
            }
            //显示来自服务器的错误数据
            if (elem.attr(Config.val_error)) {
                var msg = elem.attr(Config.val_error);
                elem.removeAttr(Config.val_error);
                data.erropt = 'error';
                displayError({msg:msg, elem:elem, data:data,submit:true,errtype:0});
            }

            if (!data || data.off) {
                return;
            }
            if (data.events) {
                elem.bind(data.events, chcekError);
            }
            if (data.remote && !/blur/.test(data.events)) {
                elem.data('sm-display', 'remote');
                elem.bind('blur', chcekError);
            }
        });
    };
    var initForm = function (form, options) {
        var inputs = getAllInputs(form);
        initInputs(inputs);
        //===================
        regfunc('required', function (mt) {
            return !(mt.val === null || mt.val === '' || mt.val.length === 0);
        });
        regfunc('email', function (mt) {
            return /^([a-zA-Z0-9]+[-|_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[-|_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}([\.][a-zA-Z]{2})?$/.test(mt.val);
        });
        regfunc('number', function (mt) {
            return  /^[\-\+]?((\d+(\.\d*)?)|(\.\d+))$/.test(mt.val);
        });
        regfunc('digits', function (mt) {
            return  /^[\-\+]?\d+$/.test(mt.val);
        });
        regfunc('max', function (mt, num, noeq) {
            if (noeq === true)
                return mt.val < Number(num);
            else
                return mt.val <= Number(num);
        });
        regfunc('min', function (mt, num, noeq) {
            if (noeq === true)
                return mt.val > Number(num);
            else
                return mt.val >= Number(num);
        });
        regfunc('range', function (mt, num1, num2, nomax) {
            var r = true;
            if (undefined === nomax || nomax === false)
            {
                if (!(undefined === num1 || num1 === null || isNaN(num1))) {
                    r = r && mt.val > Number(num1);
                }
                if (!(undefined === num2 || num2 === null || isNaN(num2))) {
                    r = r && mt.val < Number(num2);
                }
            }
            else {
                if (!(undefined === num1 || num1 === false || isNaN(num1))) {
                    r = r && mt.val >= Number(num1);
                }
                if (!(undefined === num2 || num2 === false || isNaN(num2))) {
                    r = r && mt.val <= Number(num2);
                }
            }
            return r;
        });
        regfunc("minlength", function (mt, len) {
            return mt.val.length >= len;
        });
        regfunc("maxlength", function (mt, len) {
            return mt.val.length <= len;
        });
        regfunc("rangelength", function (mt, len1, len2) {
            return mt.val.length >= len1 && mt.val.length <= len2;
        });
        regfunc('money', function (mt) {
            return /^[-]{0,1}\d+[\.]\d{1,2}$/.test(mt.val) || /^[-]{0,1}\d+$/.test(mt.val);
        }, '仅可输入带有2位小数以内的数字及整数');
        regfunc("date", function (mt) {
            return /^\d{4}-\d{1,2}-\d{1,2}(\s\d{1,2}(:\d{1,2}(:\d{1,2})?)?)?$/.test(mt.val);
        });
        regfunc("url", function (mt, jh) {
            if (jh && mt.val == '#') {
                return true;
            }
            return /^(http|https|ftp):\/\/\w+\.\w+/i.test(mt.val);
        });
        regfunc("equal", function (mt, str) {
            return mt.val === str;
        });
        regfunc("notequal", function (mt, str) {
            return mt.val !== str;
        });
        regfunc("equalTo", function (mt, str) {
            return mt.val === $(str).val();
        });
        regfunc("mobile", function (mt) {
            return /^1[34578]\d{9}$/.test(mt.val);
        });
        regfunc("idcard", function (mt) {
            return /^[1-9]\d{5}(19|20)\d{2}(((0[13578]|1[02])([0-2]\d|30|31))|((0[469]|11)([0-2]\d|30))|(02[0-2][0-9]))\d{3}(\d|X|x)$/.test(mt.val);
        });
        regfunc("user", function (mt, num1, num2) {
            var r = /^[a-zA-Z]\w+$/.test(mt.val);
            if (num1 !== undefined && isNaN(parseInt(num1)))
                r = r && mt.val.length >= parseInt(num1);
            if (num2 !== undefined && isNaN(parseInt(num2)))
                r = r && mt.val.length <= parseInt(num2);
            return r;
        }, '请使用英文之母开头的字母下划线数字组合');
        regfunc("regex", function (mt, str) {
            var re = new RegExp(str).exec(mt.val);
            return (re && (re.index === 0) && (re[0].length === mt.val.length));
        });
        regfunc('num', 'number');
        regfunc('r', 'required');
        regfunc('i', 'digits');
        regfunc('minlen', 'minlength');
        regfunc('maxlen', 'maxlength');
        regfunc('eqto', 'equalTo');
        regfunc('eq', 'equal');
        regfunc('neq', 'notequal');

    };
    $.extend({SMF: {chkform: checkForm, regfunc: regfunc, getfunc: getfunc, getmsg: getmsg, setCustomFunc: setCustomFunc, getCustomFunc: getCustomFunc, Config: Config, DefMsgs: DefMsgs}});
    $.fn.extend({
        chkform: function () {
            return checkForm(this[0]);
        },
        initSMF: function (options) {
            this.each(function (index, element) {
                if (element.nodeName.toLowerCase() !== 'form') {
                    return;
                }
                if (options) {
                    element.SMF_options = options;
                }
                if (!element.SMF) {
                    initForm(element);
                    var Jform = $(element);
                    Jform.submit(function (ev) {
                        var formajax = Jform.attr('ajax');
                        if (formajax && (formajax.toLowerCase() == 'true' || formajax == '1')) {
                            Jform.ajaxSend();
                            return false;
                        }
                        try {
                            return checkForm(this);
                        } catch (e) {
                            console.log(e);
                            return false;
                        }
                    });
                    element.SMF = true;
                }
            });
        },
        initSMFInputs: function () {
            initInputs(this);
        },
        ajaxSend: function () {
            var that = $(this[0]);
            var url = that.attr('action') || window.location.href;
            var type = (that.attr('method') || 'POST').toUpperCase();
            var isok = that.chkform();
            if (isok) {
                $.ajax({
                    type: type,
                    url: url,
                    data: that.serialize(),
                    dataType: 'json',
                    success: function (data) {
                        var rt = that.triggerHandler('success', [data]);
                        if (rt !== false && data) {
                            if (data.formError) {
                                for (var name in data.formError) {
                                    var elem = that.find(":input[name='" + name + "']");
                                    if (elem.length) {
                                        var msg = data.formError[name];
                                        displayError({msg:msg, elem:elem, data:null,submit:true,errtype:0});
                                    }
                                }
                            }
                            if (data.call) {
                                var rtx = that.triggerHandler(data.call.event, data.call.args);
                                if (rtx === false) {
                                    return false;
                                }
                            }
                            if (data.returnValue) {
                                window.returnValue = data.returnValue;
                            }
                            if (data.closeDialog && typeof (window.closeDialog) == 'function') {
                                var callWindow = window.callWindow || window.parent;
                                if (data.success) {
                                    if (layer&&layer.alert) {
                                        layer.alert(data.success, function () {
                                            if (data.jumpurl) {
                                                callWindow.location.href = data.jumpurl;
                                            }
                                            if (data.reload) {
                                                callWindow.location.reload();
                                            }
                                            window.closeDialog();
                                        });
                                        return;
                                    }
                                    alert(data.success);
                                    if ((typeof (data.jumpurl) == 'undefined' || data.jumpurl === null) && !data.dofunc) {
                                        callWindow.location.reload();
                                    }
                                }
                                if (data.jumpurl) {
                                    callWindow.location.href = data.jumpurl;
                                }
                                if (data.reload) {
                                    callWindow.location.reload();
                                }
                                window.closeDialog();
                                return;
                            }
                            if (data.success) {
                                if (layer&&layer.alert) {
                                    layer.open({
                                        content: data.success,
                                        btn: ['OK'],
                                        yes: function (index) {
                                            layer.close(index)
                                            if (data.jumpurl) {
                                                window.location.href = data.jumpurl;
                                            }
                                            if (data.reload) {
                                                window.location.reload();
                                            }
                                            if (data.dofunc) {
                                                eval(data.dofunc);
                                            }
                                        }
                                        
                                    });
                                    return;
                                }
                                alert(data.success);
                                if ((typeof (data.jumpurl) == 'undefined' || data.jumpurl === null) && !data.dofunc) {
                                    window.location.reload();
                                }
                            }
                            if (data.dofunc) {
                                eval(data.dofunc);
                            }
                            if (data.jumpurl) {
                                window.location.href = data.jumpurl;
                            }
                            if (data.reload) {
                                window.location.reload();
                            }
                        }
                    }
                });
            }

        }
    });

})(jQuery);

$(function () {
    $('form').initSMF();
});
