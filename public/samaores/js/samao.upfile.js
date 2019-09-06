// JavaScript Document
(function ($, undefined) {
    jQuery.event.props.push("dataTransfer");
    var Index = 0;
    function getExt(path) {
        return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
    }
    var initAjaxUpFile = function (box, options) {

        options = options || {};
        var extensions = 'txt,rar,zip,jpg,jpeg,gif,png,psd,doc,ppt,xls,bmp';
        var beginUpfile = options.beginUpfile || null;
        var afterUpfile = options.afterUpfile || null;
        var initUpfile = options.initUpfile || null;
        var Type = 0;
        var noSetVal = false;
        var $button = null;
        var returnbox = $(box);
        var bindbox = options.bindbox == null ? null : $(options.bindbox);
        var bindimg = options.bindimg == null ? null : $(options.bindimg);
        var qiniuRoot ="https://img.part.cn/";

        var isinput = returnbox.is('input');
        if (isinput) {
            var reval = qiniuRoot+returnbox.val();
            returnbox.attr('ref', qiniuRoot+returnbox.val());
            if (bindimg) {
                bindimg.attr('src', reval);
            }
            if (returnbox.attr('show_type') == 1 && reval.length > 10) {
                upload_showimg(box);
            }
            if (typeof (initUpfile) === 'function' && reval.length > 10) {
                initUpfile(reval);
            }

        }
        else {
            var reval = bindbox === null ? '' : bindbox.val();
            if (bindimg) {
                bindimg.attr('src', reval);
            }
            if (typeof (initUpfile) === 'function' && reval.length > 10) {
                initUpfile(reval);
            }
        }

        var binddata = options.binddata || {};//绑定提交的数据
        if (options.strict_size) {
            var pic_width = returnbox.attr('img_width') || 0;
            var pic_height = returnbox.attr('img_height') || 0;
            if (pic_width && pic_height) {
                binddata.pic_width = pic_width;
                binddata.pic_height = pic_height;
                binddata.strict_size = 1;
            }
        }

        if (options.noSetVal !== undefined)
        {
            noSetVal = options.noSetVal;
        }
        if (options.type !== undefined)
        {
            Type = options.type;
        }
        var dlg_type = returnbox.attr('dlg_type') || 0;
        var upGroup = options.upGroup || false;//是否多图上传
        if (options.button !== undefined) {
            $button = $(options.button);
        }
        else if (isinput) {
            returnbox.addClass('not-radius-left');
            $button = $('<button type="button" class="smbox-upfile-btn not-radius-right">' + (Type >= 1 ? '选择图片' : '选择文件') + '</button>').insertBefore(returnbox);
        } else {
            $button = returnbox;
        }
        if (isinput) {
            if (Type == 2) {
                var cater = $('<a class="samao-link-btn" href="#" style="margin-left:5px;">裁剪</a>').insertAfter(returnbox);
                var __RES__ = options.res || '/';
                cater.click(function () {
                    openthumbnail(returnbox, upurl, __RES__);
                    return false;
                });
            }
            if (Type >= 1) {
                var shower = $('<a class="samao-link-btn" href="#" style="margin-left:5px;">查看</a>').insertAfter(returnbox);
                shower.click(function () {
                    upload_showimg(returnbox);
                    return false;
                });
            }
        }
        var uploadCompleteData = function (data) {
            if (data && data.err != '') {
                alert(data.err);
                return;
            }
            if (data && data.err === '' && !noSetVal) {
                if (bindimg) {
                    bindimg.attr('src', data.msg.url);
                }
                if (isinput) {
                    returnbox.val(data.msg.url);
                    returnbox.attr('ref',data.msg.ref);
                }
                if (bindbox) {
                    bindbox.val(data.msg.url);
                }
            }
            if (data != null && typeof (afterUpfile) == 'function') {
                afterUpfile(data);
            }
        };
        //处理对话框数据===
        if (dlg_type == 1) {
            $button.click(function (ev) {
                ev.preventDefault();
                var dlgurl = options.upurl || '/service/upload_albums.php';
                if (upGroup) {
                    dlgurl += '?multiple=1';
                }
                window.opDialog(dlgurl, 'albums', '', function (data) {
                    uploadCompleteData(data);
                }, {width: 730, height: 600, resizable: false});
                ev.preventDefault();
                return false;
            });
            return;
        }
        Index++;
        function rnd_str(len) {
            var Seed_array = ['A', 'B', 'C', 'D', 'E', 'F', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            var seedary = '';
            for (var i = 0; i < len; i++) {
                seedary += Seed_array[Math.round(Math.random() * (Seed_array.length - 1))];
            }
            return seedary;
        }
        var dropupfile = function (e) {
            e.preventDefault();
            if (!e.dataTransfer)
                return;
            files = e.dataTransfer.files;
            upload(files[0]);
        };

        if (options.drop) {
            var bymodel = $(options.drop);
            if (bymodel.length == 1) {
                bymodel.on('drop', dropupfile);
            }
            else {
                returnbox.parent().on('drop', dropupfile);
            }
        }

        $(document).on('drop', function (e) {
            e.preventDefault();
        }).on('dragenter', function (e) {
            e.preventDefault();
        }).on('dragover', function (e) {
            e.preventDefault();
        }).on('dragleave', function (e) {
            e.preventDefault();
        });
        var Ajax_upload_frame = 'Ajax_upload_frame_' + Index;
        var extensions = options.extensions == null || options.extensions == '' ? 'txt,rar,zip,jpg,jpeg,gif,png,psd,doc,ppt,xls,bmp' : options.extensions;
        var upurl = options.upurl || '/service/upfile.php';

        var Mform = $('<form action="' + upurl + '" target="' + Ajax_upload_frame + '" method="post" enctype="multipart/form-data"></form>').appendTo(document.body)
        var FileDiv = $('<div class="Ajax_upfile_Box" style="overflow:hidden;position:absolute;"></div>').hide()
                .css({'opacity': 0, 'background-color': '#06F', 'zIndex': 1000000, 'cursor': 'pointer'})
                .appendTo(Mform);
        FileDiv.mouseleave(function () {
            $(this).hide();
        });
        var indiv = $('<div></div>').css({'float': 'left', 'margin-left': '-2px', 'margin-top': '-2px'}).appendTo(FileDiv);
        $('<input class="inentfier" type="hidden" name="UPLOAD_IDENTIFIER"/>').appendTo(indiv);

        for (var key in binddata) {
            $('<input type="hidden" name="' + key + '"/>').val(binddata[key]).appendTo(indiv);
        }
        var FileObj = $('<input type="file" name="filedata" style="cursor:pointer"/>').appendTo(indiv);

        //没有支持HTML5上传的
        if (typeof (FormData) === 'undefined') {
            $button.mouseenter(function () {
                if (returnbox.is(':disabled')) {
                    return;
                }
                var _this = $(this);
                var left = _this.offset().left;
                var top = _this.offset().top;
                var width = _this.outerWidth();
                var height = _this.outerHeight();
                FileDiv.css({left: left + 'px', top: top + 'px', width: width + 'px', height: height + 'px'}).show();
            });
            var b = navigator.userAgent.toLowerCase();
            if (/msie/.test(b)) {
                indiv.css({'direction': 'rtl', 'float': 'left'});
            }
            if (/opera/.test(b)) {
                indiv.css({'float': 'right'});
            }
        } else {
            $button.bind('click', function (ev) {
                FileObj.click();
                return false;
            });
        }
        var iframe = null;
        var uploadComplete = function (str) {
            if (str != '') {
                try {
                    eval('var data=(' + str + ')');
                    uploadCompleteData(data);
                } catch (ex) {
                    alert(ex.toString());
                }
            }
        };
        if (typeof (FormData) === 'undefined') {
            iframe = $('<iframe name="' + Ajax_upload_frame + '" src="javascript:false;"  width="500" style="position:absolute; top:-550px; left:-80px" height="200" id="Ajax_upload_frame" ></iframe>').appendTo(document.body);
            iframe.load(function () {
                Mform[0].reset();
                var str = this.contentWindow.document.body.innerHTML;
                if (str === 'false')
                    return;
                uploadComplete(str);
            });
        }
        var upload = function (tempfile) {
            var upfile = typeof (tempfile) == 'undefined' ? null : tempfile;
            if (typeof (beginUpfile) === 'function') {
                var updo = beginUpfile(Mform);
                if (updo === false) {
                    return;
                }
            }
            var path = upfile == null ? FileObj.val() : upfile.name;
            var ext = getExt(path);
            var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
            if (extensions !== '' && (re.exec(extensions) === null || ext === '')) {
                alert('对不起，只能上传 ' + extensions + ' 类型的文件。');
                Mform[0].reset();
                return false;
            }
            //可以上传数据==

            if (typeof (FormData) !== 'undefined') {
                var fd = new FormData();
                var file = upfile == null ? FileObj[0].files[0] : upfile;
                FileObj.val('');
                var fileSize = 0;
                if (file.size > 1024 * 1024)
                {
                    fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                }
                else
                {
                    fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                }
                for (var key in binddata) {
                    fd.append(key, binddata[key]);
                }
                fd.append("filedata", file);
                var xhr = new XMLHttpRequest();
                var landingDialog = null;
                //加载条
                if (typeof ($.fn.progressbar) !== 'undefined') {
                    landingDialog = $('<div title="上传进度"><div style="margin-left:10px;line-height:25px;">文件大小：' + fileSize + '</div></div>');
                    var progressbar = $('<div style="position: relative;width:230px;margin-left:10px"></div>').appendTo(landingDialog);
                    var progressLabel = $('<div style="text-align:center;position:absolute;text-shadow: 1px 1px 0 #fff;left:0;width:230px;top: 4px;">Loading...</div>').appendTo(progressbar);
                    progressbar.progressbar({
                        value: false,
                        change: function () {
                            progressLabel.text(progressbar.progressbar("value") + "%");
                        },
                        complete: function () {
                            progressLabel.text("100%");
                        }
                    });
                    landingDialog.appendTo(document.body);
                    landingDialog.dialog({autoOpen: true,
                        draggable: false, resizable: false, dialogClass: 'ui-widget-content-border-nobtn',
                        width: 250,
                        height: 140,
                        modal: true,
                        close: function () {
                            landingDialog.remove();
                        }
                    });
                    xhr.upload.addEventListener("progress", function (evt) {
                        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                        progressbar.progressbar("value", percentComplete);
                    }, false);
                }
                xhr.addEventListener("load", function (evt) {
                    var str = evt.target.responseText;
                    if (landingDialog != null) {
                        landingDialog.dialog('close');
                    }
                    uploadComplete(str);
                }, false);
                xhr.open("POST", upurl);
                xhr.send(fd);
                return;
            }
            Mform[0].submit();
        };
        FileObj.css('font-size', '460px');
        FileObj.css('margin', '0px');
        FileObj.css('padding', '0px');
        FileObj.css('border', '0px');
        FileObj.change(function () {
            upload();
        });
        this.BoxClose = function () {
            $button.unbind('click');
            if (FileObj != null) {
                FileObj.remove();
                FileObj = null;
            }
            if (Mform != null) {
                Mform.remove();
                Mform = null;
            }
            if (FileDiv != null) {
                FileDiv.remove();
                FileObj = null;
            }
            if (iframe != null) {
                iframe.remove();
                iframe = null;
            }
        };
    };

    $.fn.initAjaxUpFile = function (options) {
        this.each(function () {
            if (!this.initAjaxUpFile) {
                if (typeof (options) != 'string') {
                    this.initAjaxUpFile = new initAjaxUpFile(this, options);
                }
            }
            else {
                if (typeof (options) == 'string') {
                    if (options == 'close') {
                        this.initAjaxUpFile.BoxClose();
                        this.initAjaxUpFile = null;
                    }
                }
            }
        });
    };

})(jQuery);

function upload_showimg(selector) {
    var box = $(selector);
    var pic_width = box.attr('img_width') || 240;
    var pic_height = box.attr('img_height') || 180;
    var show_type = box.attr('show_type') || 0;
    var idname = box.attr('id') || box.attr('name');
    var width = /^\d+$/.test(pic_width) ? parseInt(pic_width) : 240;
    var height = /^\d+$/.test(pic_height) ? parseInt(pic_height) : 180;

    if (width > 500) {
        var pt = width / 500;
        width = parseInt(width / pt);
        height = parseInt(height / pt);
    }
    if (height > 400) {
        var pt = height / 400;
        width = parseInt(width / pt);
        height = parseInt(height / pt);
    }

    if (box.length <= 0)
        return;
    var imgurl = box.attr('ref');
    if (imgurl.length < 10) {
        alert('没有可查阅的图片资源！');
        return;
    }
    if (show_type == 1) {
        var showimg = $('#upshow_' + idname);
        if (showimg.length <= 0) {
            showimg = $('<div id="upshow_' + idname + '" title="查看图片" style="text-align:center"></div>');
            showimg.appendTo(box.parent());
            showimg.css({width: width + 'px', height: height + 'px', 'background-color': '#F7F7F7', 'border': 'solid 1px #DDD', 'padding': '10px'});
        }
        showimg.html('<img src="' + imgurl + '" width="' + width + '" height="' + height + '"/>');
    }
    else {
        var showimg = $('<div id="upshow_' + idname + '" title="查看图片" style="text-align:center"><img src="' + imgurl + '" width="' + width + '" height="' + height + '"/></div>');
        showimg.css({'padding': '2px', 'margin': '0px'});
        width += 30;
        height += 60;
        showimg.appendTo(document.body);
        showimg.dialog({autoOpen: true,
            position: {
                my: "left top",
                at: "left bottom+1",
                of: box
            },
            //   position: [offset.left, offset.top],
            draggable: false, resizable: false,
            width: width,
            height: height,
            modal: false,
            close: function () {
                showimg.remove();
            }
        });
    }

    if (typeof ($.fn.uiframe) === 'function') {
        showimg.uiframe();
    }
}

//截图部分===

var thum_flash_dialog = null;
function openthumbnail(selector, upurl, __RES__) {
    var box = $(selector);
    var id = box.attr('id');
    if (id == null || id == '')
    {
        id = 'cut_' + new Date().getTime();
        $(selector).attr('id', id);
    }
    var pic_width = box.attr('img_width') || 240;
    var pic_height = box.attr('img_height') || 180;
    var imgwidth = /^\d+$/.test(pic_width) ? parseInt(pic_width) : 240;
    var imgheight = /^\d+$/.test(pic_height) ? parseInt(pic_height) : 180;
    var imgurl = box.val();
    if (imgurl.length < 10) {
        alert('没有可用的图片资源！');
        return;
    }
    thum_flash_dialog = $('<div title="裁剪缩略图"><div id="flash_' + id + '"></div></div>');
    thum_flash_dialog.css('padding', '0 5px');
    $(document.body).append(thum_flash_dialog);
    thum_flash_dialog.dialog({autoOpen: false,
        height: 660,
        width: 810,
        modal: true,
        zIndex: 1000000,
        resizable: false,
        open: function () {
            var flashvars = {'imgurl': imgurl, 'upurl': upurl, 'imgwidth': imgwidth, 'imgheight': imgheight, 'editid': id, 'fieldname': 'filedata'};
            var params = {'allowscriptaccess': 'always', "quality": "high"};
            var attributes = {};
            swfobject.embedSWF(__RES__ + '/images/cutor.swf', 'flash_' + id, '800', '600', '10', false, flashvars, params, attributes);
        },
        close: function () {
            thum_flash_dialog.remove();
        }
    });
    if (typeof ($.fn.uiframe) === 'function') {
        thum_flash_dialog.uiframe();
    }
    setTimeout(function () {
        thum_flash_dialog.dialog('open');
    }, 0);
}

function FlashCompleteCall(str, id) {
    try {
        obj = eval('(' + str + ')');
    } catch (ex) {
    }
    if (obj.err != '') {
        alert(obj.err);
    }
    var box = $('#' + id);
    box.val(obj.msg.url);
    var show_type = box.attr('show_type') || 0;
    if (show_type == 1) {
        upload_showimg('#' + id);
    }
    FlashGoBack();
}
function FlashGoBack()
{
    if (thum_flash_dialog != null) {
        thum_flash_dialog.dialog('close');
        thum_flash_dialog = null;
    }
}