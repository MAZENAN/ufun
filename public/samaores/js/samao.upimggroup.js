// JavaScript Document
(function($, undefined) {
    var getImgObj = function(url, width, height) {
        var img = $('<img/>');
        img.height(height);
        img.width(width);
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
            img.height(mheight);
            img.width(mwidth);
        };
        imgtemp.src = url;
        img.attr('src', url);
        return img;
    };
    var initUpimgGroup = function(box, options) {
        var valbox = $(box);//要填充的输入框
        var size = valbox.attr('length') || 0;//数量
        var datatype = valbox.attr('data_type') || 0;//0为普通形式 1 为全部值 2带标题模式 3带标题带说明模式
        var id = valbox.attr('id');
        if (id === null || id === '') {
            id = 'upimgs_' + new Date().getTime();
            valbox.attr('id', id);
        }
        var dlg_type = valbox.attr('dlg_type') || 0;
        var shower = valbox.attr('shower') || '';
        datatype = Number(datatype);
        size = Number(size);
        var button = $('<button type="button" class="smbox-upfile-btn smbox-upimggroup" >选择图片</button>').insertBefore(valbox);
        button.mouseenter(function() {
            valbox.mousedown();
        });
        var $shower;
        if (shower === '' || shower === null) {
            if (datatype === 3 || datatype === 2) {
                var classname = datatype == 2 ? 'smbox-imggroup-showbox' : 'smbox-imggroup-showinfo';
                $shower = $('<div><div class="smbox-splito"></div></div>').addClass(classname).insertAfter(valbox.parent());
                var $shower_parent = $shower.parent();

                var showerresize = function() {
                    var bwidth = datatype == 2 ? 160 : 510;
                    $shower.css('width', '100%');
                    var pwidth = $shower_parent.innerWidth();
                    var pwidthpx = parseInt(pwidth / bwidth);
                    pwidthpx = pwidthpx * bwidth;
                    $shower.width(pwidthpx);
                };
                $('#smbox-tabs b').click(function() {
                    window.setTimeout(showerresize, 100);
                });
                $(window).resize(showerresize);
                showerresize();
            }
            else {
                $shower = $('<div class="smbox-imggroup-show"><div class="smbox-splito"></div></div>').insertAfter(valbox.parent());
            }
            if (size > 0) {
                $shower.addClass('c' + size);
            }
        }
        else {
            $shower = $(shower);
        }
        $shower.sortable({revert: true, containment: "parent", update: function(event, ui) {
                updatevals();
            }});
        $shower.find('div.smbox-picitem').disableSelection();
        if ($shower.length > 0) {
            //计算数量
            var countpic = function() {
                return $shower.find('div.smbox-picitem').length;
            };
            //跟新值
            var updatevals = function() {
                var imgs = [];
                $shower.find('div.smbox-picitem').each(function(index, element) {
                    var _this = $(element);
                    var dat = _this.data('dat');
                    if (datatype === 2 || datatype === 3) {
                        dat.title = _this.find('.smbox-picitem-title').val();
                    }
                    if (datatype === 3) {
                        dat.content = _this.find('.smbox-picitem-content').val();
                    }
                    imgs.push(_this.data('dat'));
                });
                console.log(imgs);
                if (imgs.length === 0) {
                    valbox.val('');
                }
                else {
                    var valstr = $.toJSON(imgs);
                    valbox.val(valstr);
                }
                valbox.change();
            };
            var addimg = function(dat) {
                var xlen = countpic();
                if (size !== 0 && xlen >= size) {
                    return;
                }
                var img;
                if (datatype === 0)
                {
                    img = getImgObj(dat, 64, 64);
                }
                else if (datatype === 2)
                {
                    img = getImgObj(dat.url, 150, 150);
                }
                else if (datatype === 3)
                {
                    img = getImgObj(dat.url, 120, 120);
                }
                else {
                    img = getImgObj(dat.url, 64, 64);
                }

                var oitem = $('<div class="smbox-picitem">\n\
<table  border="0" cellspacing="0" cellpadding="0">\n\
<tr>\n\
<td style="padding:0px; vertical-align:middle; text-align:center; line-height:0px;"></td>\n\
</tr>\n\
</table></div>').data('dat', dat);
                if (datatype === 2 || datatype === 3) {
                    var classname = datatype == 2 ? 'smbox-picitem-box' : 'smbox-picitem-info';
                    var infoarea = $('<div></div>').addClass(classname).appendTo(oitem);
                    var titlewidth = datatype == 2 ? '135' : '340';
                    var placeholder = datatype == 2 ? '请输入图片标题' : '请输入标题，如不填则使用默认标题';
                    var title = $('<input type="text" placeholder="' + placeholder + '" class="samao-box model-upimg smbox-picitem-title" style="width:' + titlewidth + 'px"/>').appendTo(infoarea);
                    title.on('blur', function() {
                        updatevals();
                    });
                    if (dat.title) {
                        title.val(dat.title);
                    }

                    if (datatype === 3) {
                        var content = $('<textarea placeholder="请输入图片简要描述信息"  class="samao-box model-textarea smbox-picitem-content" style="width:340px;height:75px"></textarea>').appendTo(infoarea);
                        content.on('blur', function() {
                            updatevals();
                        });
                        if (dat.content) {
                            content.val(dat.content);
                        }
                    }
                }
                var td = oitem.find('td');
                oitem.mouseenter(function() {
                    $(this).addClass('smbox-pic-index');
                });
                oitem.mouseleave(function() {
                    $(this).removeClass('smbox-pic-index');
                });
                td.append(img);
                var abtn = $('<a href="javascript:void(0);"></a>').addClass('smbox-delpic').appendTo(oitem);
                abtn.click(function() {
                    $(this).parent('.smbox-picitem').remove();
                    if (size !== 0) {
                        var len = countpic();
                        if (len < size) {
                            button[0].disabled = false;
                        }
                        updatevals();
                    }
                });
                $shower.append(oitem);
                if (size !== 0) {
                    var len = countpic();
                    if (len >= size) {
                        button[0].disabled = true;
                    }
                }
            };

            var imgurl_str = valbox.val();
            var vals = [];
            if (imgurl_str !== '' && imgurl_str !== 'null') {
                try {
                    vals = $.parseJSON(imgurl_str);
                } catch (e) {
                }
            }
            if ($.isArray(vals)) {
                for (var i = 0; i < vals.length; i++)
                    addimg(vals[i]);
            }
            if (size !== 0) {
                options.beginUpfile = function() {
                    var len = countpic();
                    if (len >= size) {
                        alert('最大上传图片数量为 ' + size + ' !');
                        return false;
                    }
                    return true;
                };
            }
            options.afterUpfile = function(data) {
                if (dlg_type != 1) {
                    if (data && data.err === '') {
                        var dat = data.msg;
                        if (datatype === 0) {
                            addimg(dat.url);
                        }
                        else {
                            addimg(dat);
                        }
                        updatevals();
                    }
                }
                else {
                    for (var i in data) {
                        var idata = data[i];
                        var dat = idata.msg;
                        if (datatype === 0) {
                            addimg(dat.url);
                        }
                        else {
                            addimg(dat);
                        }
                    }
                    updatevals();
                }
            };
            options.button = button[0];
        }
        options.noSetVal = true;
        options.upGroup = true;
        $(box).initAjaxUpFile(options);
        this.BoxClose = function() {
            $(box).initAjaxUpFile('close');
        };
    };
    $.fn.initUpimgGroup = function(options) {
        this.each(function() {
            if (!this.UpimgGroup) {
                var Box = new initUpimgGroup(this, options);
                this.UpimgGroup = Box;
            }
            else {
                if (typeof (options) === 'string') {
                    if (options === 'close') {
                        this.UpimgGroup.BoxClose();
                        this.UpimgGroup = null;
                    }
                }
            }
        });
    };

})(jQuery);