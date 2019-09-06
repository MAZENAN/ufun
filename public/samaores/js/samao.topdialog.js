// JavaScript Document

if (!window.DlgInit) {

    $(function () {
        $(document).delegate('a[dialog=1]', 'click', function (ev) {
            var that = $(this);
            var url = that.attr('href');
            var title = that.attr('title');
            var height = that.attr('dlg_height') || 550;
            var width = that.attr('dlg_width') || 960;
            var func = function (ret) {
                if (ret) {
                    location.reload();
                }
            };
            window.opDialog(url, 'test', title, func, {height: height, width: width});
            ev.preventDefault();
            return false;
        });
        //自动引入JQUI
        if (window.top == window && typeof ($.fn.dialog) !== 'function') {
            var topdialog = $('script[src*="samao.topdialog.js"]');
            var url = topdialog.attr('src');
            var path = url.replace(/js\/samao\.topdialog\.js$/, '');
            $('<link rel="stylesheet" type="text/css" href="' + path + 'css/jqueryui/custom.css">').insertBefore(topdialog);
            $('<script src="' + path + 'js/jquery-ui.js"></script>').insertBefore(topdialog);
        }
        if (window.top != window) {
            var topdialog = $('script[src*="samao.topdialog.js"]');
            var url = topdialog.attr('src');
            var path = url.replace(/js\/samao\.topdialog\.js$/, '');
            if (typeof (window.top.jQuery) != 'function') {
                var oHead = window.top.document.getElementsByTagName('HEAD').item(0);
                var oScript = window.top.document.createElement("script");
                oScript.type = "text/javascript";
                oScript.src = path + "js/jquery.js";
                oHead.appendChild(oScript);
                var nextAdd = function () {
                    if (typeof (window.top.jQuery) == 'function') {
                        window.top.jQuery('<script src="' + path + 'js/jquery-ui.js"></script>').insertBefore(window.top.document.body);
                        window.top.jQuery('<link rel="stylesheet" type="text/css" href="' + path + 'css/jqueryui/custom.css">').insertBefore(window.top.document.body);
                        if (typeof (window.top.DlgInit) != 'function') {
                            window.top.jQuery('<script src="' + url + '"></script>').insertBefore(window.top.document.body);
                        }
                    } else {
                        setTimeout(nextAdd, 1);
                    }
                };
                setTimeout(nextAdd, 1);
            } else if (typeof (window.top.jQuery.fn.dialog) != 'function') {
                window.top.jQuery('<script src="' + path + 'js/jquery-ui.js"></script>').insertBefore(window.top.document.body);
                window.top.jQuery('<link rel="stylesheet" type="text/css" href="' + path + 'css/jqueryui/custom.css">').insertBefore(window.top.document.body);
            }
            if (typeof (window.top.jQuery) == 'function' && typeof (window.top.DlgInit) != 'function') {
                window.top.jQuery('<script src="' + url + '"></script>').insertBefore(window.top.document.body);
            }
        }
    });

    window.DlgInit = function (Dialog) {
        $('.form-submit').hide();
        var buttons = [];
        $('.form-submit').find("input[type='submit'],input[type='button'],input[type='reset']").each(function (index, element) {
            var that = $(element);
            if (that.is("input[type='submit']")) {
                buttons.push({text: that.val(), click: function () {
                        that.click();
                    }, 'class': 'ui-button-submit'});
            } else {
                buttons.push({text: that.val(), click: function () {
                        that.click();
                    }});
            }
        });
        Dialog.dialog({buttons: buttons, dialogClass: 'ui-widget-content-border'});
    };

    window.opDialog = function (url, name, title, func, args, ofunc, callwin) {
        callwin = callwin || window;
        if (window.top != window && typeof (window.top.opDialog) === 'function') {
            window.top.opDialog(url, name, title, func, args, ofunc, callwin);
            return;
        }
        title = title || '网页对话框';
        var Dialog = $('<div style="overflow:hidden;"></div>').attr('title', title).appendTo(window.document.body);
        var iframe = $('<iframe name="' + name + '" src="javascript:false;" frameborder="false" scrolling="auto" style="overflow-x:hidden;border:none;" width="100%" height="100%" id="' + name + '" ></iframe>').appendTo(Dialog);
        var doFix = function (event, ui) {
            $('iframe', this).each(function () {
                $('<div class="ui-draggable-iframeFix" style="background: #FFF;"></div>')
                        .css({
                            width: '100%', height: '100%',
                            position: 'absolute', opacity: '0.5', overflowX: 'hidden'
                        })
                        .css($(this).position())
                        .appendTo($(this).offsetParent());
            });
        };
        var removeFix = function (event, ui) {
            $("div.ui-draggable-iframeFix").each(function () {
                this.parentNode.removeChild(this);
            });
        };
        var options = args || {};
        var maxZ = Math.max.apply(null, $.map($('body > *'), function (e, n) {
            if ($(e).css('position') === 'absolute') {
                return parseInt($(e).css('z-index')) || 1;
            }
        }));

        options.zIndex = maxZ;
        options.width = options.width || 960;
        options.height = options.height || 620;
        options.modal = typeof (options.modal) === 'undefined' ? true : options.modal;
        options.close = function () {
            var dialogWindow = this.window;
            if (typeof (func) === 'function' && dialogWindow && typeof (dialogWindow.returnValue) !== 'undefined' && dialogWindow.returnValue !== null) {
                func(dialogWindow.returnValue);
            }
            iframe.remove();
            Dialog.remove();
            Dialog = null;
        };
        options.dialogClass = 'ui-widget-content-border-nopadding';
        options.autoOpen = true;
        options.dragStart = doFix;
        options.dragStop = removeFix;
        options.resizeStart = doFix;
        options.resizeStop = removeFix;
        Dialog.dialog(options);

        iframe.load(function () {
            var dialogWindow = this.contentWindow;
            try {
                Dialog[0].window = dialogWindow;
                dialogWindow.opDialog = function (url, name, title, func, args, ofunc, callwin) {
                    callwin = callwin || dialogWindow;
                    window.opDialog(url, name, title, func, args, ofunc, callwin);
                };
                dialogWindow.closeDialog = function () {
                    Dialog.dialog('close');
                };
                dialogWindow.callWindow = callwin;
                dialogWindow.closeAndreload = function () {
                    callwin.location.reload();
                    Dialog.dialog('close');
                };

                try {
                    dialogWindow.close = function () {
                        Dialog.dialog('close');
                    };
                } catch (e) {
                }

                if (typeof (options.buttons) === 'undefined') {
                    Dialog.dialog({buttons: null, dialogClass: 'ui-widget-content-border-nobtn'});
                }
                if (typeof (dialogWindow.DlgInit) === 'function') {
                    dialogWindow.DlgInit(Dialog);
                }
                if (!options.modal) {
                    var DialogParent = Dialog.parent();
                    var AllDialog = DialogParent.prevAll('.ui-dialog[role="dialog"]');
                    var Dofs = DialogParent.offset();
                    Dofs.left += 20 * AllDialog.length;
                    Dofs.top += 20 * AllDialog.length;
                    Dialog.dialog({position: [Dofs.left, Dofs.top]});
                }
                if (dialogWindow.document.title === null || dialogWindow.document.title === '') {
                    Dialog.dialog({title: title});
                }
                else {
                    Dialog.dialog({title: dialogWindow.document.title});
                }
                if (typeof (ofunc) === 'function') {
                    ofunc(dialogWindow);
                }

            } catch (e) {

            }

        });
        iframe.attr('src', url);
    };
}