/*! xhEditor v1.2.1 | (c) 2009, 2013 xheditor.com.
 Licence: http://xheditor.com/license/lgpl.txt */
(function() {
    var e = {};
    window.XHEDITOR = e
})(), function(e, t) {
    e.mapLang = {}, e.setLang = function(i, s) {
        s === t && (s = i, i = ""), "" !== i && (i += ".");
        var a, n;
        for (var o in s)
            n = s[o], a = i + o, "string" == typeof n || n instanceof Array ? e.mapLang[a] = n : e.setLang(a, n)
    }, e.getLang = function(i) {
        var s = e.mapLang[i];
        if (s === t && (s = i.replace(/{#([^{}]+)}/g, function(t, i) {
            var s = e.mapLang[i];
            return s ? s : i
        })), "string" == typeof s) {
            var a = arguments;
            s = s.replace(/{\$(\d+)}/g, function(e, i) {
                var s = a[parseInt(i, 10) + 1];
                return s !== t ? s : e
            })
        }
        return s
    }
}(XHEDITOR), function(XHEDITOR, $, undefined) {
    var agent = navigator.userAgent.toLowerCase(), bMobile = /mobile/i.test(agent), browser = $.browser, browerVer = parseFloat(browser.version), isIE = browser.msie, isMozilla = browser.mozilla, isWebkit = browser.webkit, isOpera = browser.opera, isChrome = browser.chrome, bAir = agent.indexOf(" adobeair/") > -1, xCount = 0, bShowPanel = !1, bClickCancel = !0, bShowModal = !1, bCheckEscInit = !1, _jPanel, _jShadow, _jCntLine, _jPanelButton, jModal, jModalShadow, layerShadow, jOverlay, jHideSelect, onModalRemove, editorRoot, getLang = XHEDITOR.getLang;
    if ($("script[src*=xheditor]").each(function() {
        var e = this.src;
        return e.match(/xheditor[^\/]*\.js/i) ? (editorRoot = e.replace(/[\?#].*$/, "").replace(/(^|[\/\\])[^\/]*$/, "$1"), !1) : undefined
    }), isIE) {
        try {
            document.execCommand("BackgroundImageCache", !1, !0)
        } catch (e) {
        }
        var jqueryVer = $.fn.jquery;
        jqueryVer && jqueryVer.match(/^1\.[67]/) && ($.attrHooks.width = $.attrHooks.height = null)
    }
    var specialKeys = {27: "esc", 9: "tab", 32: "space", 13: "enter", 8: "backspace", 145: "scroll", 20: "capslock", 144: "numlock", 19: "pause", 45: "insert", 36: "home", 46: "del", 35: "end", 33: "pageup", 34: "pagedown", 37: "left", 38: "up", 39: "right", 40: "down", 112: "f1", 113: "f2", 114: "f3", 115: "f4", 116: "f5", 117: "f6", 118: "f7", 119: "f8", 120: "f9", 121: "f10", 122: "f11", 123: "f12"}, arrAlign = [{v: "justifyleft"}, {v: "justifycenter"}, {v: "justifyright"}, {v: "justifyfull"}], arrList = [{v: "insertOrderedList"}, {v: "insertUnorderedList"}], htmlPastetext = '<div><label for="xhePastetextValue">{#PastetextTip}</label></div><div><textarea id="xhePastetextValue" wrap="soft" spellcheck="false" style="width:300px;height:100px;" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="{#dialogOk}" /></div>', htmlLink = '<div><label for="xheLinkUrl">{#link.url}</label><input type="text" id="xheLinkUrl" value="http://" class="xheText" /></div><div><label for="xheLinkTarget">{#link.target}</label><select id="xheLinkTarget"><option selected="selected" value="">{#default}</option><option value="_blank">{#link.targetBlank}</option><option value="_self">{#link.targetSelf}</option><option value="_parent">{#link.targetParent}</option></select></div><div style="display:none"><label for="xheLinkText">{#link.linkText}</label><input type="text" id="xheLinkText" value="" class="xheText" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="{#dialogOk}" /></div>', htmlAnchor = '<div><label for="xheAnchorName">{#anchor.name}</label><input type="text" id="xheAnchorName" value="" class="xheText" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="{#dialogOk}" /></div>', htmlImg = '<div><label for="xheImgUrl">{#img.url}</label><input type="text" id="xheImgUrl" value="http://" class="xheText" /></div><div><div><label for="xheImgAlt">{#img.alt}</label><input type="text" id="xheImgAlt" /></div><div><label for="xheImgAlign">{#img.align}</label><select id="xheImgAlign"><option selected="selected" value="">{#default}</option><option value="left">{#img.alignLeft}</option><option value="right">{#img.alignRight}</option><option value="top">{#img.alignTop}</option><option value="middle">{#img.alignMiddle}</option><option value="baseline">{#img.alignBaseline}</option><option value="bottom">{#img.alignBottom}</option></select></div><div><label for="xheImgWidth">{#img.width}</label><input type="text" id="xheImgWidth" style="width:40px;" /> <label for="xheImgHeight">{#img.height}</label><input type="text" id="xheImgHeight" style="width:40px;" /></div><div><label for="xheImgBorder">{#img.border}</label><input type="text" id="xheImgBorder" style="width:40px;" /></div><div><label for="xheImgHspace">{#img.hspace}</label><input type="text" id="xheImgHspace" style="width:40px;" /> <label for="xheImgVspace">{#img.vspace}</label><input type="text" id="xheImgVspace" style="width:40px;" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="{#dialogOk}" /></div>', htmlFlash = '<div><label for="xheFlashUrl">{#flash.url}</label><input type="text" id="xheFlashUrl" value="http://" class="xheText" /></div><div><label for="xheFlashWidth">{#flash.width}</label><input type="text" id="xheFlashWidth" style="width:40px;" value="480" /> <label for="xheFlashHeight">{#flash.height}</label><input type="text" id="xheFlashHeight" style="width:40px;" value="400" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="{#dialogOk}" /></div>', htmlMedia = '<div><label for="xheMediaUrl">{#media.url}</label><input type="text" id="xheMediaUrl" value="http://" class="xheText" /></div><div><label for="xheMediaWidth">{#media.width}</label><input type="text" id="xheMediaWidth" style="width:40px;" value="480" /> <label for="xheMediaHeight">{#media.height}</label><input type="text" id="xheMediaHeight" style="width:40px;" value="400" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="{#dialogOk}" /></div>', htmlTable = '<div><label for="xheTableRows">{#table.rows}</label><input type="text" id="xheTableRows" style="width:40px;" value="3" /> <label for="xheTableColumns">{#table.columns}</label><input type="text" id="xheTableColumns" style="width:40px;" value="2" /></div><div><label for="xheTableHeaders">{#table.headers}</label><select id="xheTableHeaders"><option selected="selected" value="">{#none}</option><option value="row">{#table.headersRow}</option><option value="col">{#table.headersCol}</option><option value="both">{#table.headersBoth}</option></select></div><div><label for="xheTableWidth">{#table.width}</label><input type="text" id="xheTableWidth" style="width:40px;" value="200" /> <label for="xheTableHeight">{#table.height}</label><input type="text" id="xheTableHeight" style="width:40px;" value="" /></div><div><label for="xheTableBorder">{#table.border}</label><input type="text" id="xheTableBorder" style="width:40px;" value="1" /></div><div><label for="xheTableCellSpacing">{#table.cellSpacing}</label><input type="text" id="xheTableCellSpacing" style="width:40px;" value="1" /> <label for="xheTableCellPadding">{#table.cellPadding}</label><input type="text" id="xheTableCellPadding" style="width:40px;" value="1" /></div><div><label for="xheTableAlign">{#table.align}</label><select id="xheTableAlign"><option selected="selected" value="">{#default}</option><option value="left">{#table.alignLeft}</option><option value="center">{#table.alignCenter}</option><option value="right">{#table.alignRight}</option></select></div><div><label for="xheTableCaption">{#table.caption}</label><input type="text" id="xheTableCaption" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="{#dialogOk}" /></div>', htmlAbout = '<div style="font:12px Arial;width:245px;word-wrap:break-word;word-break:break-all;outline:none;" role="dialog" tabindex="-1"><p><span style="font-size:20px;color:#1997DF;">xhEditor</span><br />v1.2.1 (build 130225)</p><p>{#aboutXheditor}</p><p>Copyright &copy; <a href="http://xheditor.com/" target="_blank">xhEditor.com</a>. All rights reserved.</p></div>', itemEmots = {"default": {name: "{#default}", width: 24, height: 24, line: 7, list: ["smile", "tongue", "titter", "laugh", "sad", "wronged", "fastcry", "cry", "wail", "mad", "knock", "curse", "crazy", "angry", "ohmy", "awkward", "panic", "shy", "cute", "envy", "proud", "struggle", "quiet", "shutup", "doubt", "despise", "sleep", "bye"]}}, arrTools = {Cut: {t: "Cut"}, Copy: {t: "Copy"}, Paste: {t: "Paste"}, Pastetext: {t: "Pastetext", h: isIE ? 0 : 1}, Blocktag: {t: "Blocktag", h: 1}, Fontface: {t: "Fontface", h: 1}, FontSize: {t: "FontSize", h: 1}, Bold: {t: "Bold", s: "Ctrl+B"}, Italic: {t: "Italic", s: "Ctrl+I"}, Underline: {t: "Underline", s: "Ctrl+U"}, Strikethrough: {t: "Strikethrough"}, FontColor: {t: "FontColor", h: 1}, BackColor: {t: "BackColor", h: 1}, SelectAll: {t: "SelectAll"}, Removeformat: {t: "Removeformat"}, Align: {t: "Align", h: 1}, List: {t: "List", h: 1}, Outdent: {t: "Outdent"}, Indent: {t: "Indent"}, Link: {t: "Link", s: "Ctrl+L", h: 1}, Unlink: {t: "Unlink"}, Anchor: {t: "Anchor", h: 1}, Img: {t: "Img", h: 1}, Flash: {t: "Flash", h: 1}, Media: {t: "Media", h: 1}, Hr: {t: "Hr"}, Emot: {t: "Emot", s: "ctrl+e", h: 1}, Table: {t: "Table", h: 1}, Source: {t: "Source"}, Preview: {t: "Preview"}, Print: {t: "Print", s: "Ctrl+P"}, Fullscreen: {t: "Fullscreen", s: "Esc"}, About: {t: "About"}}, toolsThemes = {mini: "Bold,Italic,Underline,Strikethrough,|,Align,List,|,Link,Img", simple: "Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,|,Align,List,Outdent,Indent,|,Link,Img,Emot", full: "Cut,Copy,Paste,Pastetext,|,Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Media,Hr,Emot,Table,|,Source,Preview,Print,Fullscreen"};
    toolsThemes.mfull = toolsThemes.full.replace(/\|(,Align)/i, "/$1");
    var arrDbClick = {a: "Link", img: "Img", embed: "Embed"}, uploadInputname = "filedata", arrEntities = {"<": "&lt;", ">": "&gt;", '"': "&quot;", "\u00ae": "&reg;", "\u00a9": "&copy;"}, regEntities = /[<>"\u00ae\u00a9]/g, Xheditor = function(textarea, options) {
        function checkDblClick(e) {
            var t = e.target, i = arrDbClick[t.tagName.toLowerCase()];
            if (i) {
                if ("Embed" === i) {
                    var s = {"application/x-shockwave-flash": "Flash", "application/x-mplayer2": "Media"};
                    i = s[t.type.toLowerCase()]
                }
                _this.exec(i)
            }
        }
        function checkEsc(e) {
            return 27 === e.which ? (bShowModal ? _this.removeModal() : bShowPanel && _this.hidePanel(), !1) : undefined
        }
        function loadReset() {
            setTimeout(_this.setSource, 10)
        }
        function saveResult() {
            _this.getSource()
        }
        function cleanPaste(e) {
            var t, i, s;
            if (e && (t = e.originalEvent.clipboardData) && (i = t.items) && (s = i[0]) && "file" == s.kind && s.type.match(/^image\//i)) {
                var a = s.getAsFile(), n = new FileReader;
                return n.onload = function() {
                    var e = '<img src="' + event.target.result + '">';
                    e = replaceRemoteImg(e), _this.pasteHTML(e)
                }, n.readAsDataURL(a), !1
            }
            var o = settings.cleanPaste;
            if (0 === o || bSource || bCleanPaste)
                return!0;
            bCleanPaste = !0, _this.saveBookmark();
            var l = isIE ? "pre" : "div", r = $("<" + l + ' class="xhe-paste">\ufeff\ufeff</' + l + ">", _doc).appendTo(_doc.body), h = r[0], c = _this.getSel(), d = _this.getRng(!0);
            r.css("top", _jWin.scrollTop()), isIE ? (d.moveToElementText(h), d.select()) : (d.selectNodeContents(h), c.removeAllRanges(), c.addRange(d)), setTimeout(function() {
                var e, t = 3 === o;
                if (t)
                    r.html(r.html().replace(/<br(\s+[^<>]*)?>/gi, "\n")), e = r.text();
                else {
                    var i = $(".xhe-paste", _doc.body), s = [];
                    i.each(function(e, t) {
                        0 == $(t).find(".xhe-paste").length && s.push(t.innerHTML)
                    }), e = s.join("<br />")
                }
                r.remove(), _this.loadBookmark(), e = e.replace(/^[\s\uFEFF]+|[\s\uFEFF]+$/g, ""), e && (t ? _this.pasteText(e) : (e = _this.cleanHTML(e), e = _this.cleanWord(e), e = _this.formatXHTML(e), (!settings.onPaste || settings.onPaste && (e = settings.onPaste(e)) !== !1) && (e = replaceRemoteImg(e), _this.pasteHTML(e)))), bCleanPaste = !1
            }, 0)
        }
        function replaceRemoteImg(e) {
            var t = settings.localUrlTest, i = settings.remoteImgSaveUrl;
            if (t && i) {
                var s = [], a = 0;
                e = e.replace(/(<img)((?:\s+[^>]*?)?(?:\s+src="\s*([^"]+)\s*")(?: [^>]*)?)(\/?>)/gi, function(e, i, n, o, l) {
                    return!/^(https?|data:image)/i.test(o) || /_xhe_temp/.test(n) || t.test(o) || (s[a] = o, n = n.replace(/\s+(width|height)="[^"]*"/gi, "").replace(/\s+src="[^"]*"/gi, ' src="' + skinPath + 'img/waiting.gif" remoteimg="' + a++ + '"')), i + n + l
                }), s.length > 0 && $.post(i, {urls: s.join("|")}, function(e) {
                    e = e.split("|"), $("img[remoteimg]", _this.doc).each(function() {
                        var t = $(this);
                        xheAttr(t, "src", e[t.attr("remoteimg")]), t.removeAttr("remoteimg")
                    })
                })
            }
            return e
        }
        function setCSS(e) {
            try {
                _this._exec("styleWithCSS", e, !0)
            } catch (t) {
                try {
                    _this._exec("useCSS", !e, !0)
                } catch (t) {
                }
            }
        }
        function setOpts() {
            if (bInit && !bSource) {
                setCSS(!1);
                try {
                    _this._exec("enableObjectResizing", !0, !0)
                } catch (e) {
                }
                if (isIE)
                    try {
                        _this._exec("BackgroundImageCache", !0, !0)
                    } catch (e) {
                    }
            }
        }
        function forcePtag(e) {
            if (bSource || 13 !== e.which || e.shiftKey || e.ctrlKey || e.altKey)
                return!0;
            var t = _this.getParent("p,h1,h2,h3,h4,h5,h6,pre,address,div,li");
            return t.is("li") ? !0 : settings.forcePtag ? (0 === t.length && _this._exec("formatblock", "<p>"), undefined) : (_this.pasteHTML("<br />"), isIE && t.length > 0 && 2 === _this.getRng().parentElement().childNodes.length && _this.pasteHTML("<br />"), !1)
        }
        function fixFullHeight() {
            isMozilla || isWebkit || (bFullscreen && _jArea.height("100%").css("height", _jArea.outerHeight() - _jTools.outerHeight()), isIE && _jTools.hide().show())
        }
        function fixAppleSel(e) {
            if (e = e.target, e.tagName.match(/(img|embed)/i)) {
                var t = _this.getSel(), i = _this.getRng(!0);
                i.selectNode(e), t.removeAllRanges(), t.addRange(i)
            }
        }
        function xheAttr(e, t, i) {
            if (!t)
                return!1;
            var s = "_xhe_" + t;
            return i && (urlType && (i = getLocalUrl(i, urlType, urlBase)), e.attr(t, urlBase ? getLocalUrl(i, "abs", urlBase) : i).removeAttr(s).attr(s, i)), e.attr(s) || e.attr(t)
        }
        function clickCancelPanel() {
            bClickCancel && _this.hidePanel()
        }
        function checkShortcuts(e) {
            if (bSource)
                return!0;
            var t = e.which, i = specialKeys[t], s = i ? i : String.fromCharCode(t).toLowerCase();
            sKey = "", sKey += e.ctrlKey ? "ctrl+" : "", sKey += e.altKey ? "alt+" : "", sKey += e.shiftKey ? "shift+" : "", sKey += s;
            var a, n = arrShortCuts[sKey];
            for (a in n) {
                if (a = n[a], !$.isFunction(a))
                    return _this.exec(a), !1;
                if (a.call(_this) === !1)
                    return!1
            }
        }
        function is(e, t) {
            var i = typeof e;
            return t ? "array" === t && e.hasOwnProperty && e instanceof Array ? !0 : i === t : "undefined" != i
        }
        function getLocalUrl(e, t, i) {
            if (e.match(/^(\w+):\/\//i) && !e.match(/^https?:/i) || /^#/i.test(e) || /^data:/i.test(e))
                return e;
            var s = i ? $('<a href="' + i + '" />')[0] : location, a = s.protocol, n = s.host, o = s.hostname, l = s.port, r = s.pathname.replace(/\\/g, "/").replace(/[^\/]+$/i, "");
            if ("" === l && (l = "80"), "" === r ? r = "/" : "/" !== r.charAt(0) && (r = "/" + r), e = $.trim(e), "abs" !== t && (e = e.replace(RegExp(a + "\\/\\/" + o.replace(/\./g, "\\.") + "(?::" + l + ")" + ("80" === l ? "?" : "") + "(/|$)", "i"), "/")), "rel" === t && (e = e.replace(RegExp("^" + r.replace(/([\/\.\+\[\]\(\)])/g, "\\$1"), "i"), "")), "rel" !== t && (e.match(/^(https?:\/\/|\/)/i) || (e = r + e), "/" === e.charAt(0))) {
                var h, c, d = [], u = e.split("/"), p = u.length;
                for (c = 0; p > c; c++)
                    h = u[c], ".." === h ? d.pop() : "" !== h && "." !== h && d.push(h);
                "" === u[p - 1] && d.push(""), e = "/" + d.join("/")
            }
            return"abs" !== t || e.match(/^https?:\/\//i) || (e = a + "//" + n + e), e = e.replace(/(https?:\/\/[^:\/?#]+):80(\/|$)/i, "$1$2")
        }
        function checkFileExt(e, t) {
            return"*" === t || e.match(RegExp(".(" + t.replace(/,/g, "|") + ")$", "i")) ? !0 : (alert(getLang("upload.extLimit", t)), !1)
        }
        function formatBytes(e) {
            var t = ["Byte", "KB", "MB", "GB", "TB", "PB"], i = Math.floor(Math.log(e) / Math.log(1024));
            return(e / Math.pow(1024, Math.floor(i))).toFixed(2) + t[i]
        }
        function returnFalse() {
            return!1
        }
        var _this = this, _text = textarea, _jText = $(_text), _jForm = _jText.closest("form"), _jTools, _jArea, _win, _jWin, _doc, _jDoc, bookmark, bInit = !1, bSource = !1, bFullscreen = !1, bCleanPaste = !1, outerScroll, bShowBlocktag = !1, sLayoutStyle = "", ev = null, timer, bDisableHoverExec = !1, bQuickHoverExec = !1, lastPoint = null, lastAngle = null, editorHeight = 0, settings = _this.settings = $.extend({}, XHEDITOR.settings, options), plugins = settings.plugins, strPlugins = [];
        if (plugins && (arrTools = $.extend({}, arrTools, plugins), $.each(plugins, function(e) {
            strPlugins.push(e)
        }), strPlugins = strPlugins.join(",")), settings.tools.match(/^\s*(m?full|simple|mini)\s*$/i)) {
            var toolsTheme = toolsThemes[$.trim(settings.tools)];
            settings.tools = settings.tools.match(/m?full/i) && plugins ? toolsTheme.replace("Table", "Table," + strPlugins) : toolsTheme
        }
        settings.tools.match(/(^|,)\s*About\s*(,|$)/i) || (settings.tools += ",About"), settings.tools = settings.tools.split(","), settings.editorRoot && (editorRoot = settings.editorRoot), bAir === !1 && (editorRoot = getLocalUrl(editorRoot, "abs")), settings.urlBase && (settings.urlBase = getLocalUrl(settings.urlBase, "abs"));
        var idCSS = "xheCSS_" + settings.skin, idContainer = "xhe" + xCount + "_container", idTools = "xhe" + xCount + "_Tool", idIframeArea = "xhe" + xCount + "_iframearea", idIframe = "xhe" + xCount + "_iframe", idFixFFCursor = "xhe" + xCount + "_fixffcursor", headHTML = "", bodyClass = "", skinPath = editorRoot + "xheditor_skin/" + settings.skin + "/", arrEmots = itemEmots, urlType = settings.urlType, urlBase = settings.urlBase, emotPath = settings.emotPath, emotPath = emotPath ? emotPath : editorRoot + "xheditor_emot/", selEmotGroup = "";
        arrEmots = $.extend({}, arrEmots, settings.emots), emotPath = getLocalUrl(emotPath, "rel", urlBase ? urlBase : null), bShowBlocktag = settings.showBlocktag, bShowBlocktag && (bodyClass += " showBlocktag");
        var arrShortCuts = [];
        this.init = function() {
            function e(e) {
                var t, i = $(e.target);
                (t = i.css("width")) && i.css("width", "").attr("width", t.replace(/[^0-9%]+/g, "")), (t = i.css("height")) && i.css("height", "").attr("height", t.replace(/[^0-9%]+/g, ""))
            }
            0 === $("#" + idCSS).length && $("head").append('<link id="' + idCSS + '" rel="stylesheet" type="text/css" href="' + skinPath + 'ui.css" />');
            var t = _jText.outerWidth(), i = _jText.outerHeight(), s = settings.width || _text.style.width || (t > 10 ? t : 0);
            editorHeight = settings.height || _text.style.height || (i > 10 ? i : 150), /^\d+(?:\.\d+)?$/.test(s) && (s += "px"), is(editorHeight, "string") && (editorHeight = editorHeight.replace(/[^\d]+/g, ""));
            var a, n, o = settings.background || _text.style.background, l = ['<span class="xheGStart"/>'], r = /\||\//i;
            $.each(settings.tools, function(e, t) {
                if (t.match(r) && l.push('<span class="xheGEnd"/>'), "|" === t)
                    l.push('<span class="xheSeparator"/>');
                else if ("/" === t)
                    l.push("<br />");
                else {
                    if (a = arrTools[t], !a)
                        return;
                    n = a.c ? a.c : "xheIcon xheBtn" + t, l.push('<span><a href="#" title="{#' + a.t + '}" cmd="' + t + '" class="xheButton xheEnabled" tabindex="-1" role="button"><span class="' + n + '" unselectable="on" style="font-size:0;color:transparent;text-indent:-999px;">' + a.t + "</span></a></span>"), a.s && _this.addShortcuts(a.s, t)
                }
                t.match(r) && l.push('<span class="xheGStart"/>')
            }), l.push('<span class="xheGEnd"/><br />'), _jText.after($('<input type="text" id="' + idFixFFCursor + '" style="position:absolute;display:none;" /><span id="' + idContainer + '" class="xhe_' + settings.skin + '" style="display:none"><table cellspacing="0" cellpadding="0" class="xheLayout" style="' + ("0px" != s ? "width:" + s + ";" : "") + "height:" + editorHeight + 'px;" role="presentation"><tr><td id="' + idTools + '" class="xheTool" unselectable="on" style="height:1px;" role="presentation"></td></tr><tr><td id="' + idIframeArea + '" class="xheIframeArea" role="presentation"><iframe frameborder="0" id="' + idIframe + '" src="javascript:;" style="width:100%;"></iframe></td></tr></table></span>')), _jTools = $("#" + idTools), _jArea = $("#" + idIframeArea), headHTML = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="' + skinPath + 'iframe.css"/>';
            var h = settings.loadCSS;
            if (h)
                if (is(h, "array"))
                    for (var c in h)
                        headHTML += '<link rel="stylesheet" href="' + h[c] + '"/>';
                else
                    headHTML += h.match(/\s*<style(\s+[^>]*?)?>[\s\S]+?<\/style>\s*/i) ? h : '<link rel="stylesheet" href="' + h + '"/>';
            var d = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head>' + headHTML + "<title>{#defaultReadTip} " + (settings.readTip ? settings.readTip : "") + "</title>";
            o && (d += "<style>html{background:" + o + ";}</style>"), d += '</head><body spellcheck="0" class="editMode' + bodyClass + '"></body></html>', _this.win = _win = $("#" + idIframe)[0].contentWindow, _jWin = $(_win);
            try {
                this.doc = _doc = _win.document, _jDoc = $(_doc), _doc.open(), _doc.write(getLang(d)), _doc.close(), isIE ? _doc.body.contentEditable = "true" : _doc.designMode = "On"
            } catch (u) {
            }
            setTimeout(setOpts, 300), _this.setSource(), _win.setInterval = null, _jTools.append(getLang(l.join(""))).bind("mousedown contextmenu", returnFalse).click(function(e) {
                var t = $(e.target).closest("a");
                return t.is(".xheEnabled") && (clearTimeout(timer), _jTools.find("a").attr("tabindex", "-1"), ev = e, _this.exec(t.attr("cmd"))), !1
            }), _jTools.find(".xheButton").hover(function(e) {
                var t = $(this), i = settings.hoverExecDelay, s = lastAngle;
                if (lastAngle = null, -1 === i || bDisableHoverExec || !t.is(".xheEnabled"))
                    return!1;
                if (s && s > 10)
                    return bDisableHoverExec = !0, setTimeout(function() {
                        bDisableHoverExec = !1
                    }, 100), !1;
                var a = t.attr("cmd"), n = 1 === arrTools[a].h;
                return n ? (bQuickHoverExec && (i = 0), i >= 0 && (timer = setTimeout(function() {
                    ev = e, lastPoint = {x: ev.clientX, y: ev.clientY}, _this.exec(a)
                }, i)), undefined) : (_this.hidePanel(), !1)
            }, function() {
                lastPoint = null, timer && clearTimeout(timer)
            }).mousemove(function(e) {
                if (lastPoint) {
                    var t = {x: e.clientX - lastPoint.x, y: e.clientY - lastPoint.y};
                    if (Math.abs(t.x) > 1 || Math.abs(t.y) > 1) {
                        if (t.x > 0 && t.y > 0) {
                            var i = Math.round(Math.atan(t.y / t.x) / .017453293);
                            lastAngle = lastAngle ? (lastAngle + i) / 2 : i
                        } else
                            lastAngle = null;
                        lastPoint = {x: e.clientX, y: e.clientY}
                    }
                }
            }), _jPanel = $("#xhePanel"), _jShadow = $("#xheShadow"), _jCntLine = $("#xheCntLine"), 0 === _jPanel.length && (_jPanel = $('<div id="xhePanel"></div>').mousedown(function(e) {
                e.stopPropagation()
            }), _jShadow = $('<div id="xheShadow"></div>'), _jCntLine = $('<div id="xheCntLine"></div>'), setTimeout(function() {
                $(document.body).append(_jPanel).append(_jShadow).append(_jCntLine)
            }, 10)), $("#" + idContainer).show(), _jText.hide(), _jArea.css("height", editorHeight - _jTools.outerHeight()), isIE & 8 > browerVer && setTimeout(function() {
                _jArea.css("height", editorHeight - _jTools.outerHeight())
            }, 1), _jText.focus(_this.focus), _jForm.submit(saveResult).bind("reset", loadReset), settings.submitID && $("#" + settings.submitID).mousedown(saveResult), $(window).bind("unload beforeunload", saveResult).bind("resize", fixFullHeight), $(document).mousedown(clickCancelPanel), bCheckEscInit || ($(document).keydown(checkEsc), bCheckEscInit = !0), _jWin.focus(function() {
                settings.focus && settings.focus()
            }).blur(function() {
                settings.blur && settings.blur()
            }), isWebkit && _jWin.click(fixAppleSel), _jDoc.mousedown(clickCancelPanel).keydown(checkShortcuts).keypress(forcePtag).dblclick(checkDblClick).bind("mousedown click", function(e) {
                _jText.trigger(e.type)
            }), isIE && (_jDoc.keydown(function(e) {
                var t = _this.getRng();
                return 8 === e.which && t.item ? ($(t.item(0)).remove(), !1) : undefined
            }), _jDoc.bind("controlselect", function(t) {
                t = t.target, $.nodeName(t, "IMG") && $(t).unbind("resizeend", e).bind("resizeend", e)
            })), _jDoc.keydown(function(e) {
                var t = e.which;
                return e.altKey && t >= 49 && 57 >= t ? (_jTools.find("a").attr("tabindex", "0"), _jTools.find(".xheGStart").eq(t - 49).next().find("a").focus(), _doc.title = "\ufeff\ufeff", !1) : undefined
            }).click(function() {
                _jTools.find("a").attr("tabindex", "-1")
            }), _jTools.keydown(function(e) {
                var t = e.which;
                if (27 == t)
                    _jTools.find("a").attr("tabindex", "-1"), _this.focus();
                else if (e.altKey && t >= 49 && 57 >= t)
                    return _jTools.find(".xheGStart").eq(t - 49).next().find("a").focus(), !1
            });
            var p = $(_doc.documentElement);
            isOpera ? p.bind("keydown", function(e) {
                e.ctrlKey && 86 === e.which && cleanPaste()
            }) : p.bind(isIE ? "beforepaste" : "paste", cleanPaste), settings.disableContextmenu && p.bind("contextmenu", returnFalse), settings.html5Upload && p.bind("dragenter dragover", function(e) {
                var t;
                return(t = e.originalEvent.dataTransfer.types) && -1 !== $.inArray("Files", t) ? !1 : undefined
            }).bind("drop", function(e) {
                function t(e) {
                    var t, i, s;
                    for (a = 0; e.length > a; a++) {
                        if (i = e[a].name.replace(/.+\./, ""), !(t = o.match(RegExp("(\\w+):[^:]*," + i + "(?:,|$)", "i"))))
                            return 1;
                        if (s) {
                            if (s !== t[1])
                                return 2
                        } else
                            s = t[1]
                    }
                    return s
                }
                var i, s = e.originalEvent.dataTransfer;
                if (s && (i = s.files) && i.length > 0) {
                    var a, n, o, l = ["Link", "Img", "Flash", "Media"], r = [];
                    for (a in l)
                        n = l[a], settings["up" + n + "Url"] && settings["up" + n + "Url"].match(/^[^!].*/i) && r.push(n + ":," + settings["up" + n + "Ext"]);
                    return 0 === r.length ? !1 : (o = r.join(","), n = t(i), 1 === n ? alert(getLang("upload.extLimit", o.replace(/\w+:,/g, ""))) : 2 === n ? alert(getLang("upload.typeLimit")) : n && _this.startUpload(i, settings["up" + n + "Url"], "*", function(e) {
                        var t, i = [], s = settings.onUpload;
                        s && s(e);
                        for (var a = 0, o = e.length; o > a; a++)
                            t = e[a], url = is(t, "string") ? t : t.url, "!" === url.substr(0, 1) && (url = url.substr(1)), i.push(url);
                        _this.exec(n), $("#xhe" + n + "Url").val(i.join(" ")), $("#xheSave").click()
                    }), !1)
                }
            });
            var g = settings.shortcuts;
            g && $.each(g, function(e, t) {
                _this.addShortcuts(e, t)
            }), xCount++, bInit = !0, settings.fullscreen ? _this.toggleFullscreen() : settings.sourceMode && setTimeout(_this.toggleSource, 20);
            var f = settings.plugins;
            return f && $.each(f, function(e, t) {
                var i = t.i;
                i !== undefined && i(_this)
            }), !0
        }, this.remove = function() {
            _this.hidePanel(), saveResult(), _jText.unbind("focus", _this.focus), _jForm.unbind("submit", saveResult).unbind("reset", loadReset), settings.submitID && $("#" + settings.submitID).unbind("mousedown", saveResult), $(window).unbind("unload beforeunload", saveResult).unbind("resize", fixFullHeight), $(document).unbind("mousedown", clickCancelPanel), $("#" + idContainer).remove(), $("#" + idFixFFCursor).remove(), _jText.show(), bInit = !1
        }, this.saveBookmark = function() {
            if (!bSource) {
                _this.focus();
                var e = _this.getRng();
                e = e.cloneRange ? e.cloneRange() : e, bookmark = {top: _jWin.scrollTop(), rng: e}
            }
        }, this.loadBookmark = function() {
            if (!bSource && bookmark) {
                _this.focus();
                var e = bookmark.rng;
                if (isIE)
                    e.select();
                else {
                    var t = _this.getSel();
                    t.removeAllRanges(), t.addRange(e)
                }
                _jWin.scrollTop(bookmark.top), bookmark = null
            }
        }, this.focus = function() {
            if (bSource ? $("#sourceCode", _doc).focus() : _win.focus(), isIE) {
                var e = _this.getRng();
                e.parentElement && e.parentElement().ownerDocument !== _doc && _this.setTextCursor()
            }
            return!1
        }, this.setTextCursor = function(e) {
            var t = _this.getRng(!0), i = _doc.body;
            if (isIE)
                t.moveToElementText(i);
            else {
                for (var s = e ? "lastChild" : "firstChild"; 3 != i.nodeType && i[s]; )
                    i = i[s];
                t.selectNode(i)
            }
            if (t.collapse(e ? !1 : !0), isIE)
                t.select();
            else {
                var a = _this.getSel();
                a.removeAllRanges(), a.addRange(t)
            }
        }, this.getSel = function() {
            return _doc.selection ? _doc.selection : _win.getSelection()
        }, this.getRng = function(e) {
            var t, i;
            try {
                e || (t = _this.getSel(), i = t.createRange ? t.createRange() : t.rangeCount > 0 ? t.getRangeAt(0) : null), i || (i = _doc.body.createTextRange ? _doc.body.createTextRange() : _doc.createRange())
            } catch (s) {
            }
            return i
        }, this.getParent = function(e) {
            var t, i = _this.getRng();
            return isIE ? t = i.item ? i.item(0) : i.parentElement() : (t = i.commonAncestorContainer, i.collapsed || i.startContainer === i.endContainer && 2 > i.startOffset - i.endOffset && i.startContainer.hasChildNodes() && (t = i.startContainer.childNodes[i.startOffset])), e = e ? e : "*", t = $(t), t.is(e) || (t = $(t).closest(e)), t
        }, this.getSelect = function(e) {
            var t = _this.getSel(), i = _this.getRng(), s = !0;
            if (s = !i || i.item ? !1 : !t || 0 === i.boundingWidth || i.collapsed, "text" === e)
                return s ? "" : i.text || (t.toString ? "" + t : "");
            var a;
            if (i.cloneContents) {
                var n, o = $("<div></div>");
                n = i.cloneContents(), n && o.append(n), a = o.html()
            } else
                a = is(i.item) ? i.item(0).outerHTML : is(i.htmlText) ? i.htmlText : "" + i;
            return s && (a = ""), a = _this.processHTML(a, "read"), a = _this.cleanHTML(a), a = _this.formatXHTML(a)
        }, this.pasteHTML = function(e, t) {
            if (bSource)
                return!1;
            _this.focus(), e = _this.processHTML(e, "write");
            var i = _this.getSel(), s = _this.getRng();
            if (t !== undefined) {
                if (s.item) {
                    var a = s.item(0);
                    s = _this.getRng(!0), s.moveToElementText(a), s.select()
                }
                s.collapse(t)
            }
            if (e += "<" + (isIE ? "img" : "span") + ' id="_xhe_temp" width="0" height="0" />', s.insertNode) {
                if ($(s.startContainer).closest("style,script").length > 0)
                    return!1;
                s.deleteContents(), s.insertNode(s.createContextualFragment(e))
            } else
                "control" === i.type.toLowerCase() && (i.clear(), s = _this.getRng()), s.pasteHTML(e);
            var n = $("#_xhe_temp", _doc), o = n[0];
            isIE ? (s.moveToElementText(o), s.select()) : (s.selectNode(o), i.removeAllRanges(), i.addRange(s)), n.remove()
        }, this.pasteText = function(e, t) {
            e || (e = ""), e = _this.domEncode(e), e = e.replace(/\r?\n/g, "<br />"), _this.pasteHTML(e, t)
        }, this.appendHTML = function(e) {
            return bSource ? !1 : (_this.focus(), e = _this.processHTML(e, "write"), $(_doc.body).append(e), _this.setTextCursor(!0), undefined)
        }, this.domEncode = function(e) {
            return e.replace(regEntities, function(e) {
                return arrEntities[e]
            })
        }, this.setSource = function(e) {
            bookmark = null, "string" != typeof e && "" !== e && (e = _text.value), bSource ? $("#sourceCode", _doc).val(e) : (settings.beforeSetSource && (e = settings.beforeSetSource(e)), e = _this.cleanHTML(e), e = _this.formatXHTML(e), e = _this.processHTML(e, "write"), isIE ? (_doc.body.innerHTML = '<img id="_xhe_temp" width="0" height="0" />' + e, $("#_xhe_temp", _doc).remove()) : _doc.body.innerHTML = e)
        }, this.processHTML = function(e, t) {
            function i(e, t, i, s, a, o) {
                var l, r, h, c, d = "";
                if (l = s.match(/font-family\s*:\s*([^;"]+)/i), l && (d += ' face="' + l[1] + '"'), r = s.match(/font-size\s*:\s*([^;"]+)/i)) {
                    r = r[1].toLowerCase();
                    for (var u = 0; n.length > u; u++)
                        if (r === n[u].n || r === n[u].s) {
                            h = u + 1;
                            break
                        }
                    h && (d += ' size="' + h + '"', s = s.replace(/(^|;)(\s*font-size\s*:\s*[^;"]+;?)+/gi, "$1"))
                }
                if (c = s.match(/(?:^|[\s;])color\s*:\s*([^;"]+)/i)) {
                    var p;
                    if (p = c[1].match(/\s*rgb\s*\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\)/i)) {
                        c[1] = "#";
                        for (var g = 1; 3 >= g; g++)
                            c[1] += ("0" + (p[g] - 0).toString(16)).slice(-2)
                    }
                    c[1] = c[1].replace(/^#([0-9a-f])([0-9a-f])([0-9a-f])$/i, "#$1$1$2$2$3$3"), d += ' color="' + c[1] + '"'
                }
                return s = s.replace(/(^|;)(\s*(font-family|color)\s*:\s*[^;"]+;?)+/gi, "$1"), "" !== d ? (s && (d += ' style="' + s + '"'), "<font" + (i ? i : "") + d + (a ? a : "") + ">" + o + "</font>") : e
            }
            function s(e, t, i, s, a) {
                for (var n, l, r = (i ? i : "") + (s ? s : ""), h = [], c = [], d = 0; o.length > d; d++)
                    n = o[d].r, l = o[d].t, r = r.replace(n, function() {
                        return h.push("<" + l + ">"), c.push("</" + l + ">"), ""
                    });
                return r = r.replace(/\s+style\s*=\s*"\s*"/i, ""), (r ? "<span" + r + ">" : "") + h.join("") + a + c.join("") + (r ? "</span>" : "")
            }
            var a = ' class="Apple-style-span"', n = settings.listFontsize;
            if ("write" === t)
                e = e.replace(/(<(\/?)(\w+))((?:\s+[\w\-:]+\s*=\s*(?:"[^"]*"|'[^']*'|[^>\s]+))*)\s*((\/?)>)/g, function(e, t, i, s, n, o, l) {
                    s = s.toLowerCase(), isMozilla ? "strong" === s ? s = "b" : "em" === s && (s = "i") : isWebkit && ("strong" === s ? (s = "span", i || (n += a + ' style="font-weight: bold;"')) : "em" === s ? (s = "span", i || (n += a + ' style="font-style: italic;"')) : "u" === s ? (s = "span", i || (n += a + ' style="text-decoration: underline;"')) : "strike" === s && (s = "span", i || (n += a + ' style="text-decoration: line-through;"')));
                    var r, h = "";
                    if ("del" === s)
                        s = "strike";
                    else if ("img" === s)
                        n = n.replace(/\s+emot\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/i, function(e, t) {
                            return r = t.match(/^(["']?)(.*)\1/)[2], r = r.split(","), r[1] || (r[1] = r[0], r[0] = ""), "default" === r[0] && (r[0] = ""), settings.emotMark ? e : ""
                        });
                    else if ("a" === s)
                        !n.match(/ href=[^ ]/i) && n.match(/ name=[^ ]/i) && (h += " xhe-anchor"), l && (o = "></a>");
                    else if ("table" === s && !i) {
                        var c = n.match(/\s+border\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/i);
                        (!c || c[1].match(/^(["']?)\s*0\s*\1$/)) && (h += " xhe-border")
                    }
                    var d;
                    if (n = n.replace(/\s+([\w\-:]+)\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/g, function(e, t, i) {
                        return t = t.toLowerCase(), i = i.match(/^(["']?)(.*)\1/)[2], aft = "", isIE && t.match(/^(disabled|checked|readonly|selected)$/) && i.match(/^(false|0)$/i) ? "" : "img" === s && r && "src" === t ? "" : (t.match(/^(src|href)$/) && (aft = " _xhe_" + t + '="' + i + '"', urlBase && (i = getLocalUrl(i, "abs", urlBase))), h && "class" === t && (i += " " + h, h = ""), isWebkit && "style" === t && "span" === s && i.match(/(^|;)\s*(font-family|font-size|color|background-color)\s*:\s*[^;]+\s*(;|$)/i) && (d = !0), " " + t + '="' + i + '"' + aft)
                    }), r) {
                        var u = emotPath + (r[0] ? r[0] : "default") + "/" + r[1] + ".gif";
                        n += ' src="' + u + '" _xhe_src="' + u + '"'
                    }
                    return d && (n += a), h && (n += ' class="' + h + '"'), "<" + i + s + n + o
                }), isIE && (e = e.replace(/&apos;/gi, "&#39;")), isWebkit || (e = e.replace(/<(span)(\s+[^>]*?)?\s+style\s*=\s*"((?:[^"]*?;)?\s*(?:font-family|font-size|color)\s*:[^"]*)"( [^>]*)?>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?<\/\1>)*?)<\/\1>/gi, i), e = e.replace(/<(span)(\s+[^>]*?)?\s+style\s*=\s*"((?:[^"]*?;)?\s*(?:font-family|font-size|color)\s*:[^"]*)"( [^>]*)?>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?)<\/\1>/gi, i), e = e.replace(/<(span)(\s+[^>]*?)?\s+style\s*=\s*"((?:[^"]*?;)?\s*(?:font-family|font-size|color)\s*:[^"]*)"( [^>]*)?>(((?!<\1(\s+[^>]*?)?>)[\s\S])*?)<\/\1>/gi, i)), e = e.replace(/<(td|th)(\s+[^>]*?)?>(\s|&nbsp;)*<\/\1>/gi, "<$1$2>" + (isIE ? "" : "<br />") + "</$1>");
            else {
                if (isWebkit)
                    for (var o = [{r: /font-weight\s*:\s*bold;?/gi, t: "strong"}, {r: /font-style\s*:\s*italic;?/gi, t: "em"}, {r: /text-decoration\s*:\s*underline;?/gi, t: "u"}, {r: /text-decoration\s*:\s*line-through;?/gi, t: "strike"}], l = 0; 2 > l; l++)
                        e = e.replace(/<(span)(\s+[^>]*?)?\s+class\s*=\s*"Apple-style-span"(\s+[^>]*?)?>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?<\/\1>)*?)<\/\1>/gi, s), e = e.replace(/<(span)(\s+[^>]*?)?\s+class\s*=\s*"Apple-style-span"(\s+[^>]*?)?>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?)<\/\1>/gi, s), e = e.replace(/<(span)(\s+[^>]*?)?\s+class\s*=\s*"Apple-style-span"(\s+[^>]*?)?>(((?!<\1(\s+[^>]*?)?>)[\s\S])*?)<\/\1>/gi, s);
                e = e.replace(/(<(\w+))((?:\s+[\w\-:]+\s*=\s*(?:"[^"]*"|'[^']*'|[^>\s]+))*)\s*(\/?>)/g, function(e, t, i, s, a) {
                    i = i.toLowerCase();
                    var o;
                    return s = s.replace(/\s+_xhe_(?:src|href)\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/i, function(e, t) {
                        return o = t.match(/^(["']?)(.*)\1/)[2], ""
                    }), o && urlType && (o = getLocalUrl(o, urlType, urlBase)), s = s.replace(/\s+([\w\-:]+)\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/g, function(e, t, i) {
                        if (t = t.toLowerCase(), i = i.match(/^(["']?)(.*)\1/)[2].replace(/"/g, "'"), "class" === t) {
                            if (i.match(/^["']?(apple|webkit)/i))
                                return"";
                            if (i = i.replace(/\s?xhe-[a-z]+/gi, ""), "" === i)
                                return""
                        } else {
                            if (t.match(/^((_xhe_|_moz_|_webkit_)|jquery\d+)/i))
                                return"";
                            if (o && t.match(/^(src|href)$/i))
                                return" " + t + '="' + o + '"';
                            "style" === t && (i = i.replace(/(^|;)\s*(font-size)\s*:\s*([a-z-]+)\s*(;|$)/i, function(e, t, i, s, a) {
                                for (var o, l, r = 0; n.length > r; r++)
                                    if (o = n[r], s === o.n) {
                                        l = o.s;
                                        break
                                    }
                                return t + i + ":" + l + a
                            }))
                        }
                        return" " + t + '="' + i + '"'
                    }), "img" !== i || s.match(/\s+alt\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/i) || (s += ' alt=""'), t + s + a
                }), e = e.replace(/(<(td|th)(?:\s+[^>]*?)?>)\s*([\s\S]*?)(<br(\s*\/)?>)?\s*<\/\2>/gi, function(e, t, i, s) {
                    return t + (s ? s : "&nbsp;") + "</" + i + ">"
                }), e = e.replace(/^\s*(?:<(p|div)(?:\s+[^>]*?)?>)?\s*(<span(?:\s+[^>]*?)?>\s*<\/span>|<br(?:\s+[^>]*?)?>|&nbsp;)*\s*(?:<\/\1>)?\s*$/i, "")
            }
            return e = e.replace(/(<pre(?:\s+[^>]*?)?>)([\s\S]+?)(<\/pre>)/gi, function(e, t, i, s) {
                return t + i.replace(/<br\s*\/?>/gi, "\r\n") + s
            })
        }, this.getSource = function(e) {
            var t, i = settings.beforeGetSource;
            return bSource ? (t = $("#sourceCode", _doc).val(), i || (t = _this.formatXHTML(t, !1))) : (t = _this.processHTML(_doc.body.innerHTML, "read"), t = _this.cleanHTML(t), t = _this.formatXHTML(t, e), i && (t = i(t))), _text.value = t, t
        }, this.cleanWord = function(e) {
            function t(e, t, i) {
                return i
            }
            var i = settings.cleanPaste;
            if (i > 0 && 3 > i && /mso(-|normal)|WordDocument|<table\s+[^>]*?x:str|\s+class\s*=\s*"?xl[67]\d"/i.test(e)) {
                e = e.replace(/<!--[\s\S]*?-->|<!(--)?\[[\s\S]+?\](--)?>|<style(\s+[^>]*?)?>[\s\S]*?<\/style>/gi, ""), e = e.replace(/\r?\n/gi, ""), isIE ? (e = e.replace(/<v:shapetype(\s+[^>]*)?>[\s\S]*<\/v:shapetype>/gi, ""), e = e.replace(/<v:shape(\s+[^>]+)?>[\s\S]*?<v:imagedata(\s+[^>]+)?>\s*<\/v:imagedata>[\s\S]*?<\/v:shape>/gi, function(e, t, i) {
                    var s;
                    if (s = i.match(/\s+src\s*=\s*("[^"]+"|'[^']+'|[^>\s]+)/i)) {
                        s = s[1].match(/^(["']?)(.*)\1/)[2];
                        var a = '<img src="' + editorRoot + "xheditor_skin/blank.gif" + '" _xhe_temp="true" class="wordImage"';
                        return s = t.match(/\s+style\s*=\s*("[^"]+"|'[^']+'|[^>\s]+)/i), s && (s = s[1].match(/^(["']?)(.*)\1/)[2], a += ' style="' + s + '"'), a += " />"
                    }
                    return""
                })) : e = e.replace(/<img( [^<>]*(v:shapes|msohtmlclip)[^<>]*)\/?>/gi, function(e, t) {
                    var i, s = '<img src="' + editorRoot + "xheditor_skin/blank.gif" + '" _xhe_temp="true" class="wordImage"';
                    return i = t.match(/ width\s*=\s*"([^"]+)"/i), i && (s += ' width="' + i[1] + '"'), i = t.match(/ height\s*=\s*"([^"]+)"/i), i && (s += ' height="' + i[1] + '"'), s + " />"
                }), e = e.replace(/(<(\/?)([\w\-:]+))((?:\s+[\w\-:]+(?:\s*=\s*(?:"[^"]*"|'[^']*'|[^>\s]+))?)*)\s*(\/?>)/g, function(e, t, s, a, n, o) {
                    return a = a.toLowerCase(), a.match(/^(link)$/) && n.match(/file:\/\//i) || a.match(/:/) || "span" === a && 2 === i ? "" : (s || (n = n.replace(/\s([\w\-:]+)(?:\s*=\s*("[^"]*"|'[^']*'|[^>\s]+))?/gi, function(e, t, s) {
                        if (t = t.toLowerCase(), /:/.test(t))
                            return"";
                        if (s = s.match(/^(["']?)(.*)\1/)[2], 1 === i)
                            switch (a) {
                                case"p":
                                    if ("style" === t)
                                        return s = s.replace(/"|&quot;/gi, "'").replace(/\s*([^:]+)\s*:\s*(.*?)(;|$)/gi, function(e, t, i) {
                                            return/^(text-align)$/i.test(t) ? t + ":" + i + ";" : ""
                                        }).replace(/^\s+|\s+$/g, ""), s ? " " + t + '="' + s + '"' : "";
                                    break;
                                case"span":
                                    if ("style" === t)
                                        return s = s.replace(/"|&quot;/gi, "'").replace(/\s*([^:]+)\s*:\s*(.*?)(;|$)/gi, function(e, t, i) {
                                            return/^(color|background|font-size|font-family)$/i.test(t) ? t + ":" + i + ";" : ""
                                        }).replace(/^\s+|\s+$/g, ""), s ? " " + t + '="' + s + '"' : "";
                                    break;
                                case"table":
                                    if (t.match(/^(cellspacing|cellpadding|border|width)$/i))
                                        return e;
                                    break;
                                case"td":
                                    if (t.match(/^(rowspan|colspan)$/i))
                                        return e;
                                    if ("style" === t)
                                        return s = s.replace(/"|&quot;/gi, "'").replace(/\s*([^:]+)\s*:\s*(.*?)(;|$)/gi, function(e, t, i) {
                                            return/^(width|height)$/i.test(t) ? t + ":" + i + ";" : ""
                                        }).replace(/^\s+|\s+$/g, ""), s ? " " + t + '="' + s + '"' : "";
                                    break;
                                case"a":
                                    if (t.match(/^(href)$/i))
                                        return e;
                                    break;
                                case"font":
                                case"img":
                                    return e
                            }
                        else if (2 === i)
                            switch (a) {
                                case"td":
                                    if (t.match(/^(rowspan|colspan)$/i))
                                        return e;
                                    break;
                                case"img":
                                    return e
                            }
                        return""
                    })), t + n + o)
                });
                for (var s = 0; 3 > s; s++)
                    e = e.replace(/<([^\s>]+)(\s+[^>]*)?>\s*<\/\1>/g, "");
                for (var s = 0; 3 > s; s++)
                    e = e.replace(/<(span|a)>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?<\/\1>)*?)<\/\1>/gi, t);
                for (var s = 0; 3 > s; s++)
                    e = e.replace(/<(span|a)>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?)<\/\1>/gi, t);
                for (var s = 0; 3 > s; s++)
                    e = e.replace(/<(span|a)>(((?!<\1(\s+[^>]*?)?>)[\s\S])*?)<\/\1>/gi, t);
                for (var s = 0; 3 > s; s++)
                    e = e.replace(/<font(\s+[^>]+)><font(\s+[^>]+)>/gi, function(e, t, i) {
                        return"<font" + t + i + ">"
                    });
                e = e.replace(/(<(\/?)(tr|td)(?:\s+[^>]+)?>)[^<>]+/gi, function(e, t, i, s) {
                    return!i && /^td$/i.test(s) ? e : t
                })
            }
            return e
        }, this.cleanHTML = function(e) {
            e = e.replace(/<!?\/?(DOCTYPE|html|body|meta)(\s+[^>]*?)?>/gi, "");
            var t;
            return e = e.replace(/<head(?:\s+[^>]*?)?>([\s\S]*?)<\/head>/i, function(e, i) {
                return t = i.match(/<(script|style)(\s+[^>]*?)?>[\s\S]*?<\/\1>/gi), ""
            }), t && (e = t.join("") + e), e = e.replace(/<\??xml(:\w+)?(\s+[^>]*?)?>([\s\S]*?<\/xml>)?/gi, ""), settings.internalScript || (e = e.replace(/<script(\s+[^>]*?)?>[\s\S]*?<\/script>/gi, "")), settings.internalStyle || (e = e.replace(/<style(\s+[^>]*?)?>[\s\S]*?<\/style>/gi, "")), settings.linkTag && settings.inlineScript && settings.inlineStyle || (e = e.replace(/(<(\w+))((?:\s+[\w-]+\s*=\s*(?:"[^"]*"|'[^']*'|[^>\s]+))*)\s*(\/?>)/gi, function(e, t, i, s, a) {
                return settings.linkTag || "link" !== i.toLowerCase() ? (settings.inlineScript || (s = s.replace(/\s+on(?:click|dblclick|mouse(down|up|move|over|out|enter|leave|wheel)|key(down|press|up)|change|select|submit|reset|blur|focus|load|unload)\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/gi, "")), settings.inlineStyle || (s = s.replace(/\s+(style|class)\s*=\s*("[^"]*"|'[^']*'|[^>\s]+)/gi, "")), t + s + a) : ""
            })), e = e.replace(/<\/(strong|b|u|strike|em|i)>((?:\s|<br\/?>|&nbsp;)*?)<\1(\s+[^>]*?)?>/gi, "$2")
        }, this.formatXHTML = function(e, t) {
            function i(e) {
                for (var t = {}, i = e.split(","), s = 0; i.length > s; s++)
                    t[i[s]] = !0;
                return t
            }
            function s(e) {
                e = e.toLowerCase();
                var t = b[e];
                return t ? t : e
            }
            function a(e, t, i) {
                if (p[e])
                    for (; y.last() && g[y.last()]; )
                        n(y.last());
                f[e] && y.last() === e && n(e), i = u[e] || !!i, i || y.push(e);
                var s = [];
                s.push("<" + e), t.replace(_, function(e, t) {
                    t = t.toLowerCase();
                    var i = arguments[2] ? arguments[2] : arguments[3] ? arguments[3] : arguments[4] ? arguments[4] : m[t] ? t : "";
                    s.push(" " + t + '="' + i.replace(/"/g, "'") + '"')
                }), s.push((i ? " /" : "") + ">"), h(s.join(""), e, !0), "pre" === e && (P = !0)
            }
            function n(e) {
                if (e)
                    for (var t = y.length - 1; t >= 0 && y[t] !== e; t--)
                        ;
                else
                    var t = 0;
                if (t >= 0) {
                    for (var i = y.length - 1; i >= t; i--)
                        h("</" + y[i] + ">", y[i]);
                    y.length = t
                }
                "pre" === e && (P = !1, M--)
            }
            function o(e) {
                h(_this.domEncode(e))
            }
            function l(e) {
                w.push(e.replace(/^[\s\r\n]+|[\s\r\n]+$/g, ""))
            }
            function r(e) {
                w.push(e)
            }
            function h(e, i, s) {
                if (P || (e = e.replace(/(\t*\r?\n\t*)+/g, "")), P || t !== !0)
                    w.push(e);
                else {
                    if (e.match(/^\s*$/))
                        return w.push(e), undefined;
                    var a = p[i], n = a ? i : "";
                    a ? (s && M++, "" === E && M--) : E && M++, (n !== E || a) && c(), w.push(e), "br" === i && c(), !a || !u[i] && s || M--, E = a ? i : "", L = s
                }
            }
            function c() {
                if (w.push("\r\n"), M > 0)
                    for (var e = M; e--; )
                        w.push("	")
            }
            function d(e, t, i, s) {
                if (!i)
                    return s;
                var a = "";
                return i = i.replace(/ face\s*=\s*"\s*([^"]*)\s*"/i, function(e, t) {
                    return t && (a += "font-family:" + t + ";"), ""
                }), i = i.replace(/ size\s*=\s*"\s*(\d+)\s*"/i, function(e, t) {
                    return a += "font-size:" + I[(t > 7 ? 7 : 1 > t ? 1 : t) - 1].s + ";", ""
                }), i = i.replace(/ color\s*=\s*"\s*([^"]*)\s*"/i, function(e, t) {
                    return t && (a += "color:" + t + ";"), ""
                }), i = i.replace(/ style\s*=\s*"\s*([^"]*)\s*"/i, function(e, t) {
                    return t && (a += t), ""
                }), i += ' style="' + a + '"', i ? "<span" + i + ">" + s + "</span>" : s
            }
            var u = i("area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed"), p = i("address,applet,blockquote,button,center,dd,dir,div,dl,dt,fieldset,form,frameset,h1,h2,h3,h4,h5,h6,hr,iframe,ins,isindex,li,map,menu,noframes,noscript,object,ol,p,pre,table,tbody,td,tfoot,th,thead,tr,ul,script"), g = i("a,abbr,acronym,applet,b,basefont,bdo,big,br,button,cite,code,del,dfn,em,font,i,iframe,img,input,ins,kbd,label,map,object,q,s,samp,script,select,small,span,strike,strong,sub,sup,textarea,tt,u,var"), f = i("colgroup,dd,dt,li,options,p,td,tfoot,th,thead,tr"), m = i("checked,compact,declare,defer,disabled,ismap,multiple,nohref,noresize,noshade,nowrap,readonly,selected"), v = i("script,style"), b = {b: "strong", i: "em", s: "del", strike: "del"}, x = /<(?:\/([^\s>]+)|!([^>]*?)|([\w\-:]+)((?:"[^"]*"|'[^']*'|[^"'<>])*)\s*(\/?))>/g, _ = /\s*([\w\-:]+)(?:\s*=\s*(?:"([^"]*)"|'([^']*)'|([^\s]+)))?/g, w = [], y = [];
            y.last = function() {
                return this[this.length - 1]
            };
            for (var k, C, T, S, $, F, L, j = 0, M = -1, E = "body", P = !1; k = x.exec(e); )
                C = k.index, C > j && (F = e.substring(j, C), S ? $.push(F) : o(F)), j = x.lastIndex, !(T = k[1]) || (T = s(T), S && T === S && (l($.join("")), S = null, $ = null), S) ? S ? $.push(k[0]) : (T = k[3]) ? (T = s(T), a(T, k[4], k[5]), v[T] && (S = T, $ = [])) : k[2] && r(k[0]) : n(T);
            e.length > j && o(e.substring(j, e.length)), n(), e = w.join(""), w = null;
            var I = settings.listFontsize;
            return e = e.replace(/<(font)(\s+[^>]*?)?>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?<\/\1>)*?)<\/\1>/gi, d), e = e.replace(/<(font)(\s+[^>]*?)?>(((?!<\1(\s+[^>]*?)?>)[\s\S]|<\1(\s+[^>]*?)?>((?!<\1(\s+[^>]*?)?>)[\s\S])*?<\/\1>)*?)<\/\1>/gi, d), e = e.replace(/<(font)(\s+[^>]*?)?>(((?!<\1(\s+[^>]*?)?>)[\s\S])*?)<\/\1>/gi, d), e = e.replace(/^(\s*\r?\n)+|(\s*\r?\n)+$/g, "")
        }, this.toggleShowBlocktag = function(e) {
            if (bShowBlocktag !== e) {
                bShowBlocktag = !bShowBlocktag;
                var t = $(_doc.body);
                bShowBlocktag ? (bodyClass += " showBlocktag", t.addClass("showBlocktag")) : (bodyClass = bodyClass.replace(" showBlocktag", ""), t.removeClass("showBlocktag"))
            }
        }, this.toggleSource = function(e) {
            if (bSource !== e) {
                _jTools.find("[cmd=Source]").toggleClass("xheEnabled").toggleClass("xheActive");
                var t, i, s = _doc.body, a = $(s), n = '<span id="_xhe_cursor"></span>', o = 0, l = "";
                if (bSource ? (t = _this.getSource(), a.html("").removeAttr("scroll").attr("class", "editMode" + bodyClass), isIE ? s.contentEditable = "true" : _doc.designMode = "On", isMozilla && (_this._exec("inserthtml", "-"), $("#" + idFixFFCursor).show().focus().hide()), l = "Source") : (_this.pasteHTML(n, !0), t = _this.getSource(!0), o = t.indexOf(n), isOpera || (o = t.substring(0, o).replace(/\r/g, "").length), t = t.replace(/(\r?\n\s*|)<span id="_xhe_cursor"><\/span>(\s*\r?\n|)/, function(e, t, i) {
                    return t && i ? "\r\n" : t + i
                }), isIE ? s.contentEditable = "false" : _doc.designMode = "Off", a.attr("scroll", "no").attr("class", "sourceMode").html('<textarea id="sourceCode" wrap="soft" spellcheck="false" style="width:100%;height:100%" />'), i = $("#sourceCode", a).blur(_this.getSource)[0], l = "WYSIWYG"), bSource = !bSource, _this.setSource(t), _this.focus(), bSource)
                    if (i.setSelectionRange)
                        i.setSelectionRange(o, o);
                    else {
                        var r = i.createTextRange();
                        r.move("character", o), r.select()
                    }
                else
                    _this.setTextCursor();
                _jTools.find("[cmd=Source]").attr("title", getLang(l)).find("span").text(l), _jTools.find("[cmd=Source],[cmd=Preview]").toggleClass("xheEnabled"), _jTools.find(".xheButton").not("[cmd=Source],[cmd=Fullscreen],[cmd=About]").toggleClass("xheEnabled").attr("aria-disabled", bSource ? !0 : !1), setTimeout(setOpts, 300)
            }
        }, this.showPreview = function() {
            var e = settings.beforeSetSource, t = _this.getSource();
            e && (t = e(t));
            var i = "<html><head>" + headHTML + "<title>{#Preview}</title>" + (urlBase ? '<base href="' + urlBase + '"/>' : "") + "</head><body>" + t + "</body></html>", s = window.screen, a = window.open("", "xhePreview", "toolbar=yes,location=no,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=" + Math.round(.9 * s.width) + ",height=" + Math.round(.8 * s.height) + ",left=" + Math.round(.05 * s.width)), n = a.document;
            n.open(), n.write(getLang(i)), n.close(), a.focus()
        }, this.toggleFullscreen = function(e) {
            if (bFullscreen !== e) {
                var t = $("#" + idContainer).find(".xheLayout"), i = $("#" + idContainer), s = jQuery.browser.version, a = isIE && (6 == s || 7 == s);
                bFullscreen ? (a && _jText.after(i), t.attr("style", sLayoutStyle), _jArea.height(editorHeight - _jTools.outerHeight()), $(window).scrollTop(outerScroll), setTimeout(function() {
                    $(window).scrollTop(outerScroll)
                }, 10)) : (a && $("body").append(i), outerScroll = $(window).scrollTop(), sLayoutStyle = t.attr("style"), t.removeAttr("style"), _jArea.height("100%"), setTimeout(fixFullHeight, 100)), isMozilla ? ($("#" + idFixFFCursor).show().focus().hide(), setTimeout(_this.focus, 1)) : a && _this.setTextCursor(), bFullscreen = !bFullscreen, i.toggleClass("xhe_Fullscreen"), $("html").toggleClass("xhe_Fullfix"), _jTools.find("[cmd=Fullscreen]").toggleClass("xheActive"), setTimeout(setOpts, 300)
            }
        }, this.showMenu = function(e, t) {
            var i = $('<div class="xheMenu"></div>'), s = e.length, a = [];
            $.each(e, function(e, t) {
                "-" === t.s ? a.push('<div class="xheMenuSeparator"></div>') : a.push("<a href=\"javascript:void('" + t.v + '\')" title="' + (t.t ? t.t : t.s) + '" v="' + t.v + '" role="option" aria-setsize="' + s + '" aria-posinset="' + (e + 1) + '" tabindex="0">' + t.s + "</a>")
            }), i.append(getLang(a.join(""))), i.click(function(e) {
                return e = e.target, $.nodeName(e, "DIV") ? undefined : (_this.loadBookmark(), t($(e).closest("a").attr("v")), _this.hidePanel(), !1)
            }).mousedown(returnFalse), _this.saveBookmark(), _this.showPanel(i)
        }, this.showColor = function(e) {
            var t = settings.listColors, i = $('<div class="xheColor"></div>'), s = [], a = t.length, n = 0;
            $.each(t, function(e, t) {
                0 === n % 7 && s.push((n > 0 ? "</div>" : "") + "<div>"), s.push("<a href=\"javascript:void('" + t + '\')" xhev="' + t + '" title="' + t + '" style="background:' + t + '" role="option" aria-setsize="' + a + '" aria-posinset="' + (n + 1) + '"></a>'), n++
            }), s.push("</div>"), i.append(s.join("")), i.click(function(t) {
                return t = t.target, $.nodeName(t, "A") ? (_this.loadBookmark(), e($(t).attr("xhev")), _this.hidePanel(), !1) : undefined
            }).mousedown(returnFalse), _this.saveBookmark(), _this.showPanel(i)
        }, this.showPastetext = function() {
            var e = $(getLang(htmlPastetext)), t = $("#xhePastetextValue", e), i = $("#xheSave", e);
            i.click(function() {
                _this.loadBookmark();
                var e = t.val();
                return e && _this.pasteText(e), _this.hidePanel(), !1
            }), _this.saveBookmark(), _this.showDialog(e)
        }, this.showLink = function() {
            var e = htmlLink, t = _jDoc.find("a[name]").not("[href]"), i = t.length > 0;
            if (i) {
                var s = [];
                t.each(function() {
                    var e = $(this).attr("name");
                    s.push('<option value="#' + e + '">' + e + "</option>")
                }), e = e.replace(/(<div><label for="xheLinkTarget)/, '<div><label for="xheLinkAnchor">{#link.anchor}</label><select id="xheLinkAnchor"><option value="">{#link.anchorNone}</option>' + s.join("") + "</select></div>$1")
            }
            var a = $(getLang(e)), n = _this.getParent("a"), o = $("#xheLinkText", a), l = $("#xheLinkUrl", a), r = $("#xheLinkTarget", a), h = $("#xheSave", a), c = _this.getSelect();
            if (i && a.find("#xheLinkAnchor").change(function() {
                var e = $(this).val();
                "" != e && l.val(e)
            }), 1 === n.length) {
                if (!n.attr("href"))
                    return ev = null, _this.exec("Anchor");
                l.val(xheAttr(n, "href")), r.attr("value", n.attr("target"))
            } else
                "" === c && o.val(getLang(settings.defLinkText)).closest("div").show();
            settings.upLinkUrl && _this.uploadInit(l, settings.upLinkUrl, settings.upLinkExt), h.click(function() {
                _this.loadBookmark();
                var e = l.val();
                if (("" === e || 0 === n.length) && _this._exec("unlink"), "" !== e && "http://" !== e) {
                    var t = e.split(" "), i = r.val(), s = o.val();
                    if (t.length > 1) {
                        _this._exec("unlink"), c = _this.getSelect();
                        var a, h = '<a href="xhe_tmpurl"', d = [];
                        "" !== i && (h += ' target="' + i + '"'), h += ">xhe_tmptext</a>", s = "" !== c ? c : s ? s : e;
                        for (var u = 0, p = t.length; p > u; u++)
                            e = t[u], "" !== e && (e = e.split("||"), a = h, a = a.replace("xhe_tmpurl", e[0]), a = a.replace("xhe_tmptext", e[1] ? e[1] : s), d.push(a));
                        _this.pasteHTML(d.join("&nbsp;"))
                    } else
                        e = t[0].split("||"), s || (s = e[0]), s = e[1] ? e[1] : "" !== c ? "" : s ? s : e[0], 0 === n.length ? (s ? _this.pasteHTML('<a href="#xhe_tmpurl">' + s + "</a>") : _this._exec("createlink", "#xhe_tmpurl"), n = $('a[href$="#xhe_tmpurl"]', _doc)) : s && !isWebkit && n.text(s), xheAttr(n, "href", e[0]), "" !== i ? n.attr("target", i) : n.removeAttr("target")
                }
                return _this.hidePanel(), !1
            }), _this.saveBookmark(), _this.showDialog(a)
        }, this.showAnchor = function() {
            var e = $(getLang(htmlAnchor)), t = _this.getParent("a"), i = $("#xheAnchorName", e), s = $("#xheSave", e);
            if (1 === t.length) {
                if (t.attr("href"))
                    return ev = null, _this.exec("Link");
                i.val(t.attr("name"))
            }
            s.click(function() {
                _this.loadBookmark();
                var e = i.val();
                return e ? 0 === t.length ? _this.pasteHTML('<a name="' + e + '"></a>') : t.attr("name", e) : 1 === t.length && t.remove(), _this.hidePanel(), !1
            }), _this.saveBookmark(), _this.showDialog(e)
        }, this.showImg = function() {
            var e = $(getLang(htmlImg)), t = _this.getParent("img"), i = $("#xheImgUrl", e), s = $("#xheImgAlt", e), a = $("#xheImgAlign", e), n = $("#xheImgWidth", e), o = $("#xheImgHeight", e), l = $("#xheImgBorder", e), r = $("#xheImgVspace", e), h = $("#xheImgHspace", e), c = $("#xheSave", e);
            if (1 === t.length) {
                i.val(xheAttr(t, "src")), s.val(t.attr("alt")), a.val(t.attr("align")), n.val(t.attr("width")), o.val(t.attr("height")), l.val(t.attr("border"));
                var d = t.attr("vspace"), u = t.attr("hspace");
                r.val(0 >= d ? "" : d), h.val(0 >= u ? "" : u)
            }
            settings.upImgUrl && _this.uploadInit(i, settings.upImgUrl, settings.upImgExt), c.click(function() {
                _this.loadBookmark();
                var e = i.val();
                if ("" !== e && "http://" !== e) {
                    var c = e.split(" "), d = s.val(), u = a.val(), p = n.val(), g = o.val(), f = l.val(), m = r.val(), v = h.val();
                    if (c.length > 1) {
                        var b, x = '<img src="xhe_tmpurl"', _ = [];
                        "" !== d && (x += ' alt="' + d + '"'), "" !== u && (x += ' align="' + u + '"'), "" !== p && (x += ' width="' + p + '"'), "" !== g && (x += ' height="' + g + '"'), "" !== f && (x += ' border="' + f + '"'), "" !== m && (x += ' vspace="' + m + '"'), "" !== v && (x += ' hspace="' + v + '"'), x += " />";
                        for (var w in c)
                            e = c[w], "" !== e && (e = e.split("||"), b = x, b = b.replace("xhe_tmpurl", e[0]), e[1] && (b = '<a href="' + e[1] + '" target="_blank">' + b + "</a>"), _.push(b));
                        _this.pasteHTML(_.join("&nbsp;"))
                    } else if (1 === c.length && (e = c[0], "" !== e && (e = e.split("||"), 0 === t.length && (_this.pasteHTML('<img src="' + e[0] + '#xhe_tmpurl" />'), t = $('img[src$="#xhe_tmpurl"]', _doc)), xheAttr(t, "src", e[0]), "" !== d && t.attr("alt", d), "" !== u ? t.attr("align", u) : t.removeAttr("align"), "" !== p ? t.attr("width", p) : t.removeAttr("width"), "" !== g ? t.attr("height", g) : t.removeAttr("height"), "" !== f ? t.attr("border", f) : t.removeAttr("border"), "" !== m ? t.attr("vspace", m) : t.removeAttr("vspace"), "" !== v ? t.attr("hspace", v) : t.removeAttr("hspace"), e[1]))) {
                        var y = t.parent("a");
                        0 === y.length && (t.wrap("<a></a>"), y = t.parent("a")), xheAttr(y, "href", e[1]), y.attr("target", "_blank")
                    }
                } else
                    1 === t.length && t.remove();
                return _this.hidePanel(), !1
            }), _this.saveBookmark(), _this.showDialog(e)
        }, this.showEmbed = function(e, t, i, s, a, n, o) {
            var l = $(getLang(t)), r = _this.getParent('embed[type="' + i + '"],embed[classid="' + s + '"]'), h = $("#xhe" + e + "Url", l), c = $("#xhe" + e + "Width", l), d = $("#xhe" + e + "Height", l), u = $("#xheSave", l);
            n && _this.uploadInit(h, n, o), 1 === r.length && (h.val(xheAttr(r, "src")), c.val(r.attr("width")), d.val(r.attr("height"))), u.click(function() {
                _this.loadBookmark();
                var e = h.val();
                if ("" !== e && "http://" !== e) {
                    var t = c.val(), n = d.val(), o = /^\d+%?$/;
                    o.test(t) || (t = 412), o.test(n) || (n = 300);
                    var l = '<embed type="' + i + '" classid="' + s + '" src="xhe_tmpurl"' + a, u = e.split(" ");
                    if (u.length > 1) {
                        var p, g = l + "", f = [];
                        g += ' width="xhe_width" height="xhe_height" />';
                        for (var m in u)
                            e = u[m].split("||"), p = g, p = p.replace("xhe_tmpurl", e[0]), p = p.replace("xhe_width", e[1] ? e[1] : t), p = p.replace("xhe_height", e[2] ? e[2] : n), "" !== e && f.push(p);
                        _this.pasteHTML(f.join("&nbsp;"))
                    } else
                        1 === u.length && (e = u[0].split("||"), 0 === r.length && (_this.pasteHTML(l.replace("xhe_tmpurl", e[0] + "#xhe_tmpurl") + " />"), r = $('embed[src$="#xhe_tmpurl"]', _doc)), xheAttr(r, "src", e[0]), r.attr("width", e[1] ? e[1] : t), r.attr("height", e[2] ? e[2] : n))
                } else
                    1 === r.length && r.remove();
                return _this.hidePanel(), !1
            }), _this.saveBookmark(), _this.showDialog(l)
        }, this.showEmot = function(e) {
            var t = $('<div class="xheEmot"></div>');
            e = e ? e : selEmotGroup ? selEmotGroup : "default";
            var i = arrEmots[e], s = emotPath + e + "/", a = 0, n = [], o = "", l = i.width, r = i.height, h = i.line, c = i.count, d = i.list;
            if (c)
                for (var u = 1; c >= u; u++)
                    a++, n.push("<a href=\"javascript:void('" + u + '\')" style="background-image:url(' + s + u + '.gif);" emot="' + e + "," + u + '" xhev="" title="' + u + '" role="option">&nbsp;</a>'), 0 === a % h && n.push("<br />");
            else {
                var p = is(d, "array");
                $.each(d, function(t, i) {
                    p && (t = i, i = "{#emot." + e + "." + t + "}"), a++, n.push("<a href=\"javascript:void('" + i + '\')" style="background-image:url(' + s + t + '.gif);" emot="' + e + "," + t + '" title="' + i + '" xhev="' + i + '" role="option">&nbsp;</a>'), 0 === a % h && n.push("<br />")
                })
            }
            var g = h * (l + 12), f = Math.ceil(a / h) * (r + 12), m = .75 * g;
            m >= f && (m = ""), o = $(getLang("<style>" + (m ? ".xheEmot div{width:" + (g + 20) + "px;height:" + m + "px;}" : "") + ".xheEmot div a{width:" + l + "px;height:" + r + "px;}</style><div>" + n.join("") + "</div>")).click(function(e) {
                e = e.target;
                var t = $(e);
                if ($.nodeName(e, "A"))
                    return _this.loadBookmark(), _this.pasteHTML('<img emot="' + t.attr("emot") + '" alt="' + t.attr("xhev") + '">'), _this.hidePanel(), !1
            }).mousedown(returnFalse), t.append(o);
            var v, b = 0, x = ['<ul role="tablist">'];
            $.each(arrEmots, function(t, i) {
                b++, x.push("<li" + (e === t ? ' class="cur"' : "") + ' role="presentation"><a href="javascript:void(\'' + i.name + '\')" group="' + t + '" role="tab" tabindex="0">' + i.name + "</a></li>")
            }), b > 1 && (x.push('</ul><br style="clear:both;" />'), v = $(getLang(x.join(""))).click(function(e) {
                return selEmotGroup = $(e.target).attr("group"), _this.exec("Emot"), !1
            }).mousedown(returnFalse), t.append(v)), _this.saveBookmark(), _this.showPanel(t)
        }, this.showTable = function() {
            var e = $(getLang(htmlTable)), t = $("#xheTableRows", e), i = $("#xheTableColumns", e), s = $("#xheTableHeaders", e), a = $("#xheTableWidth", e), n = $("#xheTableHeight", e), o = $("#xheTableBorder", e), l = $("#xheTableCellSpacing", e), r = $("#xheTableCellPadding", e), h = $("#xheTableAlign", e), c = $("#xheTableCaption", e), d = $("#xheSave", e);
            d.click(function() {
                _this.loadBookmark();
                var e, d, u = c.val(), p = o.val(), g = t.val(), f = i.val(), m = s.val(), v = a.val(), b = n.val(), x = l.val(), _ = r.val(), w = h.val(), y = "<table" + ("" !== p ? ' border="' + p + '"' : "") + ("" !== v ? ' width="' + v + '"' : "") + ("" !== b ? ' height="' + b + '"' : "") + ("" !== x ? ' cellspacing="' + x + '"' : "") + ("" !== _ ? ' cellpadding="' + _ + '"' : "") + ("" !== w ? ' align="' + w + '"' : "") + ">";
                if ("" !== u && (y += "<caption>" + u + "</caption>"), "row" === m || "both" === m) {
                    for (y += "<tr>", e = 0; f > e; e++)
                        y += '<th scope="col"></th>';
                    y += "</tr>", g--
                }
                for (y += "<tbody>", e = 0; g > e; e++) {
                    for (y += "<tr>", d = 0; f > d; d++)
                        y += 0 !== d || "col" !== m && "both" !== m ? "<td></td>" : '<th scope="row"></th>';
                    y += "</tr>"
                }
                return y += "</tbody></table>", _this.pasteHTML(y), _this.hidePanel(), !1
            }), _this.saveBookmark(), _this.showDialog(e)
        }, this.showAbout = function() {
            var e = $(getLang(htmlAbout));
            e.find("p").attr("role", "presentation"), _this.showDialog(e, !0), setTimeout(function() {
                e.focus()
            }, 100)
        }, this.addShortcuts = function(e, t) {
            e = e.toLowerCase(), arrShortCuts[e] === undefined && (arrShortCuts[e] = []), arrShortCuts[e].push(t)
        }, this.delShortcuts = function(e) {
            delete arrShortCuts[e]
        }, this.uploadInit = function(e, t, i) {
            function s(t) {
                is(t, "string") && (t = [t]);
                var i, s, a, n = !1, o = t.length, l = [], r = settings.onUpload;
                for (r && r(t), i = 0; o > i; i++)
                    s = t[i], a = is(s, "string") ? s : s.url, "!" === a.substr(0, 1) && (n = !0, a = a.substr(1)), l.push(a);
                e.val(l.join(" ")), n && e.closest(".xheDialog").find("#xheSave").click()
            }
            var a = $(getLang('<span class="xheUpload"><input type="text" style="visibility:hidden;" tabindex="-1" /><input type="button" value="' + settings.upBtnText + '" class="xheBtn" tabindex="-1" /></span>')), n = $(".xheBtn", a), o = settings.html5Upload, l = o ? settings.upMultiple : 1;
            if (e.after(a), n.before(e), t = t.replace(/{editorRoot}/gi, editorRoot), "!" === t.substr(0, 1))
                n.click(function() {
                    _this.showIframeModal("{#upload.browserTitle}", t.substr(1), s, null, null)
                });
            else {
                a.append('<input type="file"' + (l > 1 ? ' multiple=""' : "") + ' class="xheFile" size="13" name="' + uploadInputname + '" tabindex="-1" />');
                var r, h = $(".xheFile", a);
                h.change(function() {
                    r = [], _this.startUpload(h[0], t, i, s)
                }), setTimeout(function() {
                    e.closest(".xheDialog").bind("dragenter dragover", returnFalse).bind("drop", function(e) {
                        var a, n = e.originalEvent.dataTransfer;
                        return o && n && (a = n.files) && a.length > 0 && _this.startUpload(a, t, i, s), !1
                    })
                }, 10)
            }
        }, this.startUpload = function(fromFiles, toUrl, limitExt, onUploadComplete) {
            function onUploadCallback(sText, bFinish) {
                var data = Object, bOK = !1;
                try {
                    data = eval("(" + sText + ")")
                } catch (ex) {
                }
                return data.err === undefined || data.msg === undefined ? alert(getLang("upload.apiError", toUrl, sText)) : data.err ? alert(data.err) : (arrMsg.push(data.msg), bOK = !0), (!bOK || bFinish) && _this.removeModal(), bFinish && bOK && onUploadComplete(arrMsg), bOK
            }
            var arrMsg = [], bHtml5Upload = settings.html5Upload, upMultiple = bHtml5Upload ? settings.upMultiple : 1, upload, fileList, filename, jUploadTip = $(getLang('<div style="padding:22px 0;text-align:center;line-height:30px;">{#upload.progressTip}<br /></div>')), sLoading = '<img src="' + skinPath + 'img/loading.gif">';
            if (!isOpera && bHtml5Upload && (!fromFiles.nodeType || (fileList = fromFiles.files) && fileList[0].name)) {
                fileList || (fileList = fromFiles);
                var i, len = fileList.length;
                if (len > upMultiple)
                    return alert(getLang("upload.countLimit", upMultiple)), undefined;
                for (i = 0; len > i; i++)
                    if (!checkFileExt(fileList[i].name, limitExt))
                        return;
                var jProgress = $('<div class="xheProgress"><div><span>0%</span></div></div>');
                jUploadTip.append(jProgress), upload = new _this.html5Upload(uploadInputname, fileList, toUrl, onUploadCallback, function(e) {
                    if (e.loaded >= 0) {
                        var t = Math.round(100 * e.loaded / e.total) + "%";
                        $("div", jProgress).css("width", t), $("span", jProgress).text(t + " ( " + formatBytes(e.loaded) + " / " + formatBytes(e.total) + " )")
                    } else
                        jProgress.replaceWith(sLoading)
                })
            } else {
                if (!checkFileExt(fromFiles.value, limitExt))
                    return;
                jUploadTip.append(sLoading), upload = new _this.html4Upload(fromFiles, toUrl, onUploadCallback)
            }
            _this.showModal("{#upload.progressTitle}", jUploadTip, 320, 150), upload.start()
        }, this.html4Upload = function(e, t, i) {
            var s = (new Date).getTime(), a = "jUploadFrame" + s, n = this, o = $('<iframe name="' + a + '" class="xheHideArea" />').appendTo("body"), l = $('<form action="' + t + '" target="' + a + '" method="post" enctype="multipart/form-data" class="xheHideArea"></form>').appendTo("body"), r = $(e), h = r.clone().attr("disabled", "true");
            return r.before(h).appendTo(l), this.remove = function() {
                null !== n && (h.before(r).remove(), o.remove(), l.remove(), n = null)
            }, this.onLoad = function() {
                var e = o[0].contentWindow.document, t = $(e.body).text();
                e.write(""), n.remove(), i(t, !0)
            }, this.start = function() {
                l.submit(), o.load(n.onLoad)
            }, this
        }, this.html5Upload = function(e, t, i, s, a) {
            function n(t, i, s, a) {
                l = new XMLHttpRequest, upload = l.upload, l.onreadystatechange = function() {
                    4 === l.readyState && s(l.responseText)
                }, upload ? upload.onprogress = function(e) {
                    a(e.loaded)
                } : a(-1), l.open("POST", i), l.setRequestHeader("Content-Type", "application/octet-stream"), l.setRequestHeader("Content-Disposition", 'attachment; name="' + encodeURIComponent(e) + '"; filename="' + encodeURIComponent(t.name) + '"'), l.sendAsBinary && t.getAsBinary ? l.sendAsBinary(t.getAsBinary()) : l.send(t)
            }
            function o(e) {
                a && a({loaded: c + e, total: d})
            }
            for (var l, r = 0, h = t.length, c = 0, d = 0, u = this, p = 0; h > p; p++)
                d += t[p].size;
            this.remove = function() {
                l && (l.abort(), l = null)
            }, this.uploadNext = function(e) {
                e && (c += t[r - 1].size, o(0)), (!e || e && s(e, r === h) === !0) && h > r && n(t[r++], i, u.uploadNext, function(e) {
                    o(e)
                })
            }, this.start = function() {
                u.uploadNext()
            }
        }, this.showIframeModal = function(title, url, callback, w, h, onRemove) {
            window.opDialog(url, 'upfile', '网页对话框', function(data) {
                if (data && data.err === '') {
                    callback(data.msg.url);
                }
            }, {width: 730, height: 540, resizable: false});
        }, this.showModal = function(e, t, i, s, a) {
            return bShowModal ? !1 : (_this.panelState = bShowPanel, bShowPanel = !1, layerShadow = settings.layerShadow, i = i ? i : settings.modalWidth, s = s ? s : settings.modalHeight, jModal = $(getLang('<div class="xheModal" style="width:' + (i - 1) + "px;height:" + s + "px;margin-left:-" + Math.ceil(i / 2) + "px;" + (isIE && 7 > browerVer ? "" : "margin-top:-" + Math.ceil(s / 2) + "px") + '">' + (settings.modalTitle ? '<div class="xheModalTitle"><span class="xheModalClose" title="{#close} (Esc)" tabindex="0" role="button"></span>' + e + "</div>" : "") + '<div class="xheModalContent"></div></div>')).appendTo("body"), jOverlay = $('<div class="xheModalOverlay"></div>').appendTo("body"), layerShadow > 0 && (jModalShadow = $('<div class="xheModalShadow" style="width:' + jModal.outerWidth() + "px;height:" + jModal.outerHeight() + "px;margin-left:-" + (Math.ceil(i / 2) - layerShadow - 2) + "px;" + (isIE && 7 > browerVer ? "" : "margin-top:-" + (Math.ceil(s / 2) - layerShadow - 2) + "px") + '"></div>').appendTo("body")), $(".xheModalContent", jModal).css("height", s - (settings.modalTitle ? $(".xheModalTitle").outerHeight() : 0)).html(t), isIE && 6 === browerVer && (jHideSelect = $("select:visible").css("visibility", "hidden")), $(".xheModalClose", jModal).click(_this.removeModal), jOverlay.show(), layerShadow > 0 && jModalShadow.show(), jModal.show(), setTimeout(function() {
                jModal.find("a,input[type=text],textarea").filter(":visible").filter(function() {
                    return"hidden" !== $(this).css("visibility")
                }).eq(0).focus()
            }, 10), bShowModal = !0, onModalRemove = a, undefined)
        }, this.removeModal = function() {
            jHideSelect && jHideSelect.css("visibility", "visible"), jModal.html("").remove(), layerShadow > 0 && jModalShadow.remove(), jOverlay.remove(), onModalRemove && onModalRemove(), bShowModal = !1, bShowPanel = _this.panelState
        }, this.showDialog = function(e, t) {
            var i = $('<div class="xheDialog"></div>'), s = $(e), a = $("#xheSave", s);
            if (1 === a.length) {
                if (s.find("input[type=text],select").keypress(function(e) {
                    return 13 === e.which ? (a.click(), !1) : undefined
                }), s.find("textarea").keydown(function(e) {
                    return e.ctrlKey && 13 === e.which ? (a.click(), !1) : undefined
                }), a.after(getLang(' <input type="button" id="xheCancel" value="{#dialogCancel}" />')), $("#xheCancel", s).click(_this.hidePanel), !settings.clickCancelDialog) {
                    bClickCancel = !1;
                    var n = $('<div class="xheFixCancel"></div>').appendTo("body").mousedown(returnFalse), o = _jArea.offset();
                    n.css({left: o.left, top: o.top, width: _jArea.outerWidth(), height: _jArea.outerHeight()})
                }
                i.mousedown(function() {
                    bDisableHoverExec = !0
                })
            }
            i.append(s), _this.showPanel(i, t)
        }, this.showPanel = function(e, t) {
            if (!ev.target)
                return!1;
            _jPanel.html("").append(e).css("left", -999).css("top", -999), _jPanelButton = $(ev.target).closest("a").addClass("xheActive");
            var i = _jPanelButton.offset(), s = i.left, a = i.top;
            a += _jPanelButton.outerHeight() - 1, _jCntLine.css({left: s + 1, top: a, width: _jPanelButton.width()}).show();
            var n = document.documentElement, o = document.body;
            s + _jPanel.outerWidth() > (window.pageXOffset || n.scrollLeft || o.scrollLeft) + (n.clientWidth || o.clientWidth) && (s -= _jPanel.outerWidth() - _jPanelButton.outerWidth());
            var l = settings.layerShadow;
            l > 0 && _jShadow.css({left: s + l, top: a + l, width: _jPanel.outerWidth(), height: _jPanel.outerHeight()}).show();
            var r = $("#" + idContainer).offsetParent().css("zIndex");
            r && !isNaN(r) && (_jShadow.css("zIndex", parseInt(r, 10) + 1), _jPanel.css("zIndex", parseInt(r, 10) + 2), _jCntLine.css("zIndex", parseInt(r, 10) + 3)), _jPanel.css({left: s, top: a}).show(), t || setTimeout(function() {
                _jPanel.find("a,input[type=text],textarea").filter(":visible").filter(function() {
                    return"hidden" !== $(this).css("visibility")
                }).eq(0).focus()
            }, 10), bQuickHoverExec = bShowPanel = !0
        }, this.hidePanel = function() {
            bShowPanel && (_jPanelButton.removeClass("xheActive"), _jShadow.hide(), _jCntLine.hide(), _jPanel.hide(), bShowPanel = !1, bClickCancel || ($(".xheFixCancel").remove(), bClickCancel = !0), bQuickHoverExec = bDisableHoverExec = !1, lastAngle = null, _this.focus(), _this.loadBookmark())
        }, this.exec = function(e) {
            _this.hidePanel();
            var t = arrTools[e];
            if (!t)
                return!1;
            if (null === ev) {
                ev = {};
                var i = _jTools.find(".xheButton[cmd=" + e + "]");
                1 === i.length && (ev.target = i)
            }
            if (t.e)
                t.e.call(_this);
            else
                switch (e = e.toLowerCase()) {
                    case"cut":
                        try {
                            if (_doc.execCommand(e), !_doc.queryCommandSupported(e))
                                throw"Error"
                        } catch (s) {
                            alert(getLang("cutDisabledTip"))
                        }
                        break;
                    case"copy":
                        try {
                            if (_doc.execCommand(e), !_doc.queryCommandSupported(e))
                                throw"Error"
                        } catch (s) {
                            alert(getLang("copyDisabledTip"))
                        }
                        break;
                    case"paste":
                        try {
                            if (_doc.execCommand(e), !_doc.queryCommandSupported(e))
                                throw"Error"
                        } catch (s) {
                            alert(getLang("pasteDisabledTip"))
                        }
                        break;
                    case"pastetext":
                        window.clipboardData ? _this.pasteText(window.clipboardData.getData("Text", !0)) : _this.showPastetext();
                        break;
                    case"blocktag":
                        var a = [];
                        $.each(settings.listBlocktag, function(e, t) {
                            a.push({s: "<" + t.n + ">{#listBlocktag." + t.n + "}</" + t.n + ">", v: "<" + t.n + ">", t: "{#listBlocktag." + t.n + "}"})
                        }), _this.showMenu(a, function(e) {
                            _this._exec("formatblock", e)
                        });
                        break;
                    case"fontface":
                        var n = [];
                        $.each(getLang("listFontname"), function(e, t) {
                            t.c = t.c ? t.c : t.n, n.push({s: '<span style="font-family:' + t.c + '">' + t.n + "</span>", v: t.c, t: t.n})
                        }), _this.showMenu(n, function(e) {
                            _this._exec("fontname", e)
                        });
                        break;
                    case"fontsize":
                        var o = [];
                        $.each(settings.listFontsize, function(e, t) {
                            o.push({s: '<span style="font-size:' + t.s + ';">{#fontsize.' + t.n + "}(" + t.s + ")</span>", v: e + 1, t: "{#fontsize." + t.n + "}"})
                        }), _this.showMenu(o, function(e) {
                            _this._exec("fontsize", e)
                        });
                        break;
                    case"fontcolor":
                        _this.showColor(function(e) {
                            _this._exec("forecolor", e)
                        });
                        break;
                    case"backcolor":
                        _this.showColor(function(e) {
                            isIE ? _this._exec("backcolor", e) : (setCSS(!0), _this._exec("hilitecolor", e), setCSS(!1))
                        });
                        break;
                    case"align":
                        var l = [];
                        $.each(arrAlign, function(e, t) {
                            l.push({s: "{#align." + t.v + "}", v: t.v})
                        }), _this.showMenu(l, function(e) {
                            _this._exec(e)
                        });
                        break;
                    case"list":
                        var r = [];
                        $.each(arrList, function(e, t) {
                            r.push({s: "{#list." + t.v + "}", v: t.v})
                        }), _this.showMenu(r, function(e) {
                            _this._exec(e)
                        });
                        break;
                    case"link":
                        _this.showLink();
                        break;
                    case"anchor":
                        _this.showAnchor();
                        break;
                    case"img":
                        _this.showImg();
                        break;
                    case"flash":
                        _this.showEmbed("Flash", htmlFlash, "application/x-shockwave-flash", "clsid:d27cdb6e-ae6d-11cf-96b8-4445535400000", ' wmode="opaque" quality="high" menu="false" play="true" loop="true" allowfullscreen="true"', settings.upFlashUrl, settings.upFlashExt);
                        break;
                    case"media":
                        _this.showEmbed("Media", htmlMedia, "application/x-mplayer2", "clsid:6bf52a52-394a-11d3-b153-00c04f79faa6", ' enablecontextmenu="false" autostart="false"', settings.upMediaUrl, settings.upMediaExt);
                        break;
                    case"hr":
                        _this.pasteHTML("<hr />");
                        break;
                    case"emot":
                        _this.showEmot();
                        break;
                    case"table":
                        _this.showTable();
                        break;
                    case"source":
                        _this.toggleSource();
                        break;
                    case"preview":
                        _this.showPreview();
                        break;
                    case"print":
                        _win.print();
                        break;
                    case"fullscreen":
                        _this.toggleFullscreen();
                        break;
                    case"about":
                        _this.showAbout();
                        break;
                    default:
                        _this._exec(e)
                }
            ev = null
        }, this._exec = function(e, t, i) {
            i || _this.focus();
            var s;
            return s = t !== undefined ? _doc.execCommand(e, !1, t) : _doc.execCommand(e, !1, null)
        }
    };
    XHEDITOR.settings = {skin: "default", tools: "full", clickCancelDialog: !0, linkTag: !1, internalScript: !1, inlineScript: !1, internalStyle: !0, inlineStyle: !0, showBlocktag: !1, forcePtag: !0, upLinkExt: "zip,rar,txt", upImgExt: "jpg,jpeg,gif,png", upFlashExt: "swf", upMediaExt: "wmv,avi,wma,mp3,mid", modalWidth: 350, modalHeight: 220, modalTitle: !0, defLinkText: "{#link.defText}", layerShadow: 3, emotMark: !1, upBtnText: "{#upload.btnText}", cleanPaste: 1, hoverExecDelay: 100, html5Upload: !0, upMultiple: 99, listBlocktag: [{n: "p"}, {n: "h1"}, {n: "h2"}, {n: "h3"}, {n: "h4"}, {n: "h5"}, {n: "h6"}, {n: "pre"}, {n: "address"}], listColors: ["#FFFFFF", "#CCCCCC", "#C0C0C0", "#999999", "#666666", "#333333", "#000000", "#FFCCCC", "#FF6666", "#FF0000", "#CC0000", "#990000", "#660000", "#330000", "#FFCC99", "#FF9966", "#FF9900", "#FF6600", "#CC6600", "#993300", "#663300", "#FFFF99", "#FFFF66", "#FFCC66", "#FFCC33", "#CC9933", "#996633", "#663333", "#FFFFCC", "#FFFF33", "#FFFF00", "#FFCC00", "#999900", "#666600", "#333300", "#99FF99", "#66FF99", "#33FF33", "#33CC00", "#009900", "#006600", "#003300", "#99FFFF", "#33FFFF", "#66CCCC", "#00CCCC", "#339999", "#336666", "#003333", "#CCFFFF", "#66FFFF", "#33CCFF", "#3366FF", "#3333FF", "#000099", "#000066", "#CCCCFF", "#9999FF", "#6666CC", "#6633FF", "#6600CC", "#333399", "#330099", "#FFCCFF", "#FF99FF", "#CC66CC", "#CC33CC", "#993399", "#663366", "#330033"], listFontsize: [{n: "x-small", s: "10px"}, {n: "small", s: "12px"}, {n: "medium", s: "16px"}, {n: "large", s: "18px"}, {n: "x-large", s: "24px"}, {n: "xx-large", s: "32px"}, {n: "-webkit-xxx-large", s: "48px"}]}, $.fn.xheditor = function(options) {
        var editTest = document.body.contentEditable ? document.body.contentEditable : document.designMode;
        if (!editTest)
            return!1;
        var arrSuccess = [];
        return this.each(function() {
            if ($.nodeName(this, "TEXTAREA"))
                if (options === !1)
                    this.xheditor && (this.xheditor.remove(), this.xheditor = null);
                else if (this.xheditor)
                    arrSuccess.push(this.xheditor);
                else {
                    var tOptions = /({.*})/.exec($(this).attr("class"));
                    if (tOptions) {
                        try {
                            tOptions = eval("(" + tOptions[1] + ")")
                        } catch (ex) {
                        }
                        options = $.extend({}, tOptions, options)
                    }
                    var editor = new Xheditor(this, options);
                    editor.init() ? (this.xheditor = editor, arrSuccess.push(editor)) : editor = null
                }
        }), 0 === arrSuccess.length && (arrSuccess = !1), 1 === arrSuccess.length && (arrSuccess = arrSuccess[0]), arrSuccess
    }, $.fn.oldVal = $.fn.val, $.fn.val = function(e) {
        var t, i = this;
        return e === undefined ? i[0] && (t = i[0].xheditor) ? t.getSource() : i.oldVal() : i.each(function() {
            (t = this.xheditor) ? t.setSource(e) : i.oldVal(e)
        })
    }, $(function() {
        $("textarea").each(function() {
            var e = $(this), t = e.attr("class");
            t && (t = t.match(/(?:^|\s)xheditor(?:\-(m?full|simple|mini))?(?:\s|$)/i)) && e.xheditor(t[1] ? {tools: t[1]} : null)
        })
    })
}(XHEDITOR, jQuery);