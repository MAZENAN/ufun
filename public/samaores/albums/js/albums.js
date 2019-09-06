// JavaScript Document
var LastUrl = '';
var loadurl = function(url) {
    if (url == '') {
        return;
    }
    LastUrl = url;
    $.get(url, function(html) {
        $('#pagebar').html(html);
    });
};
function getImgObj(url, width, height, title) {
    var img = $('<img/>');
    img.css('height', height + 'px');
    img.css('width', width + 'px');
    var imgtemp = new Image();
    imgtemp.onload = function() {
        var imgwidth = imgtemp.width;
        var imgheight = imgtemp.height;
        var mwidth = width, mheight = height;
        if (imgwidth > imgheight && imgwidth > width) {
            mwidth = width;
            mheight = parseInt((width / imgwidth) * imgheight);
        }
        else if (imgheight > imgwidth && imgheight > height) {
            mheight = height;
            mwidth = parseInt((height / imgheight) * imgwidth);
        }
        else {
            if (imgwidth > width) {
                mwidth = width;
                mheight = height;
            }
            else {
                mwidth = imgwidth;
                mheight = imgheight;
            }
        }
        img.css('height', mheight + 'px');
        img.css('width', mwidth + 'px');
        img.attr('xheight', mheight + 'px');
        img.attr('xwidth', mwidth + 'px');
    };
    imgtemp.src = url;
    img.attr('src', url);
    var table = $('<table border="0" cellspacing="0" cellpadding="0"><tr><td style="padding:0px; width:' + width + 'px; height:' + height + 'px; vertical-align:middle; text-align:center; line-height:0px;"></td></tr></table>');
    if (title) {
        table.attr('title', title);
    }
    table.find('td').append(img);
    return table;
}
//替换为缩略图路径

function getTImgObj(url, width, height, title) {
    var img = $('<img/>');
    img.css('height', height + 'px');
    img.css('width', width + 'px');
    if (title) {
        img.attr('title', title);
    }
    url = url.replace(/\/upfiles\/images\/([0-9]+)\/([0-9]+)\.(jpg|jpeg|png|gif)/, "/upfiles/mini_images/$1/$2_" + width + "x" + height + "_3.$3");
    img.attr('src', url);
    return img;
}





$(function() {

    var a = $('.smbox-tabs b').each(function(e, t) {
        $(t).data("d", e).click(function() {
            var e = $(this), t = e.data("d");
            a.removeClass("active"), e.addClass("active");
            $("div[id^=smbox_tabs_]").hide();
            $("#smbox_tabs_" + t).show();
            return false;
        });
    });

    $('.smbox-imgitem').live('click', function() {
        if (isDuoxun) {
            if ($(this).is('.idx')) {
                $(this).removeClass('idx');
            }
            else {
                $(this).addClass('idx');
            }
        }
        else {
            $('.smbox-imgitem.idx').removeClass('idx');
            $(this).addClass('idx');
        }
    });

    if (!isDuoxun) {
        $('.smbox-imgitem').live('dblclick', function() {
            var data = $(this).data('data');
            window.returnValue = data;
            window.closeDialog();
        });
    }

    $('#addfile').click(function() {
        //本地上传的
        if ($('#local').is('.active')) {
            if (isDuoxun) {
                var items = [];
                $('#shower_local .smbox-imgitem.idx').each(function(index, element) {
                    items.push($(element).data('data'));
                });
                if (items.length === 0) {
                    alert('没有选择任何图片信息！');
                    return;
                }
                window.returnValue = items;
            }
            else {
                var selitem = $('#shower_local .smbox-imgitem.idx');
                if (selitem.length === 1) {
                    var data = selitem.data('data');
                    window.returnValue = data;
                }
                else {
                    alert('没有选择任何图片信息！');
                    return;
                }
            }
            window.closeDialog();
        }
        //图库的
        if ($('#galleries').is('.active')) {
            if (isDuoxun) {
                var items = [];
                $('#shower .smbox-imgitem.idx').each(function(index, element) {
                    items.push($(element).data('data'));
                });
                if (items.length === 0) {
                    alert('没有选择任何图片信息！');
                    return;
                }
                window.returnValue = items;
            }
            else {
                var selitem = $('#shower .smbox-imgitem.idx');
                if (selitem.length === 1) {
                    var data = selitem.data('data');
                    window.returnValue = data;
                }
                else {
                    alert('没有选择任何图片信息！');
                    return;
                }
            }
            window.closeDialog();
        }
    });


    $('#closewin').click(function() {
        window.closeDialog();
    });

    $('#pagebar a').live('click', function() {
        var href = $(this).attr('href');
        loadurl(href);
        return false;
    });

    $('#albums').on('change', function() {
        var id = $(this).val();
        loadurl(__SELF__ +'?action=getlist&albumsid=' + id);
        return false;
    });

    loadurl(__SELF__ +'?action=getlist');

    $('#file_upload').uploadify({
        'auto': true,
        'swf': __RES__ + '/albums/images/uploadify.swf',
        'uploader': __SELF__,
        'fileSizeLimit': '2MB',
        'fileTypeDesc': '图片文件',
        'checkExisting': false,
        'buttonClass': 'addnew',
        'buttonText': '',
        'height': '28',
        'width': '75',
        'fileTypeExts': '*.gif; *.jpeg; *.jpg; *.png',
        'removeTimeout': 0,
        'queueSizeLimit': 100,
        'uploadLimit': 100,
        'queueID': 'null',
        'fileObjName': 'filedata',
        'onUploadError': function(file, errorCode, errorMsg, errorString) {
            alert(file.name + ' 上传失败，错误原因: ' + errorString);
            var Id = '#item_' + file.index;
            $(Id).remove();
        },
        'onUploadStart': function(file) {
            var water = $('#water').is(':checked') == true ? 1 : 0;
            var albumsid = $('#albumsid').val();
            $("#file_upload").uploadify("settings", "formData", {'action': 'upload', 'water': water, 'albumsid': albumsid});
        },
        //完成的时候
        'onUploadSuccess': function(file, dat, response) {
            var data = $.parseJSON(dat);
            if (data.err != '') {
                alert(data.err);
                var Id = '#item_' + file.index;
                $(Id).remove();
                return;
            }
            var Id = '#item_' + file.index;
            var ite = $(Id);
            ite.removeClass('smbox-imgitemx').addClass('smbox-imgitem');
            ite.data('data', data);
            var img = new getTImgObj(data.msg.url, 100, 100, data.msg.localname);
            ite.append('<b></b>');
            ite.empty().append(img);
            var span = $('<span class="text"></span>').text(data.msg.localname);
            ite.append(span);
            if (!isDuoxun) {
                $('.smbox-imgitem').removeClass('idx');
                ite.addClass('idx');
            }
            ite.contextPopup(MumeData);
        },
        //选择文件的时候
        'onSelect': function(file, dat, response) {
            var data = $.parseJSON(dat);
            var ite = $('<div class="smbox-imgitemx"><div class="text"></div><div class="progress"><div class="progress-bar"></div></div></div>').prependTo('#shower_local');
            ite.attr('id', 'item_' + file.index);
            ite.find('.text').html(file.name);
        }
        ,
        'onUploadProgress': function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
            var Id = '#item_' + file.index;
            var ite = $(Id);
            var bar = ite.find('.progress-bar');
            var bli = parseInt((bytesUploaded / bytesTotal) * 100);
            bar.css('width', bli + '%');
            ite.find('.text').html(file.name + '<br>' + bli + '%');
        }
    });

});

var MumeData = {
    title: '文件管理',
    items: [
        {label: '查看', icon: __RES__ + '/albums/images/openl.png', action: function(e, node) {
                var url = $(node).data('data').msg.url;
                window.open(url);
                return false;
            }},
        {label: '删除', icon: __RES__ + '/albums/images/del.png', action: function(e, node) {

                var box = $('<div title="确定删除图片？" style="line-height:20px; font-size:14px; padding:20px;">删除图片可能会造成其他使用该图片的地方无法加载图片<br>确定删除该图片吗？</div>').appendTo(document.body);
                var func = function() {
                    var id = $(node).data('data').msg.id;
                    $.get(__SELF__ +'?action=delete&id=' + id, function(html) {
                        if (html == true) {
                            loadurl(LastUrl);
                        }
                        else {
                            alert('删除图片失败！');
                        }
                    }, 'json');
                };
                box.dialog({
                    resizable: false,
                    height: 180,
                    modal: true,
                    buttons: {
                        "确定删除": function() {
                            func();
                            $(this).dialog("close");
                        },
                        '取消': function() {
                            $(this).dialog("close");
                        }
                    },
                    close: function() {
                        $(this).remove();
                    }
                });
                return false;
            }}
    ]
};

var InitData = function(datas) {
    $('#shower').empty();
    for (var i in datas) {
        var data = {};
        data.err = '';
        data.msg = datas[i];
        var ite = $('<div class="smbox-imgitem"></div>').appendTo('#shower');
        var img = new getTImgObj(data.msg.url, 100, 100, data.msg.localname);
        ite.append('<b></b>');
        ite.append(img);
        var span = $('<span class="text"></span>').text(data.msg.localname);
        ite.append(span);
        ite.data('data', data);
        ite.contextPopup(MumeData);
    }
};