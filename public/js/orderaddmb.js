layer.config({
    skin: 'layer-ext-seaning',
    extend: 'skin/seaning/style.css'
});

var inIds = function (id) {
    for (var i in Chids) {
        if (id == Chids[i]) {
            return true;
        }
    }
    return false;
};

var initStuList = function (rows) {
    $('#stulist .stuitem').addClass('delitem');
    for (var i in rows) {
        var rs = rows[i];
        var tr = $('#stu' + rs.id);
        if (tr.length > 0) {
            tr.removeClass('delitem');
            var tds = tr.find('td');
            tds.eq(1).text(rs.name);
            tds.eq(2).text(rs.gender);
            tds.eq(3).text(rs.birthday);
            tds.eq(4).text(rs.telephone);
        } else {
            var tourists = $('#tourists').val();
            var htmltr = '<tr class="stuitem" id="stu' + rs.id + '">\
            <td width="32" align="center" valign="middle">';
            if (tourists >= 2) {
                htmltr += '<input id="boxstu' + rs.id + '" class="stus" name="stus[]" type="checkbox" value="' + rs.id + '" />';
            } else {
                htmltr += '<input id="boxstu' + rs.id + '" class="stus" name="stus[]" type="radio" value="' + rs.id + '" />';
            }
            htmltr += '</td>\
            <td width="180" align="left" valign="middle"><label for="boxstu' + rs.id + '">' + rs.name + '</label></td>\
            <td width="90" align="center" valign="middle">' + rs.gender + '</td>\
            <td align="center" valign="middle">' + rs.birthday + '</td>\
            <td width="240" align="left" valign="middle">' + rs.telephone + '</td>\
            <td width="60" align="center" valign="middle"><a href="#" data-value="' + rs.id + '" class="opteditstu">修改</a></td>\
            </tr>';
            var newtr = $(htmltr).insertBefore('#stuhead');
            if (inIds(rs.id)) {
                newtr.find('input').attr('checked', 'checked');
            }
        }
    }
    $('#stulist .delitem').remove();
};

var initFmyList = function (rows) {
    $('#fmylist .fmyitem').addClass('delitem');
    for (var i in rows) {
        var rs = rows[i];
        var tr = $('#fmy' + rs.id);
        if (tr.length > 0) {
            tr.removeClass('delitem');
            var tds = tr.find('td');
            tds.eq(1).text(rs.name);
            tds.eq(2).text(rs.gender);
            tds.eq(3).text(rs.birthday);
            tds.eq(4).text(rs.telephone);
        } else {
            var parent = $('#parent').val();
            var htmltr = '<tr class="fmyitem" id="fmy' + rs.id + '">\
            <td width="32" align="center" valign="middle">';
            if (parent >= 2) {
                htmltr += '<input id="boxstu' + rs.id + '" class="fmys" name="fmys[]" type="checkbox" value="' + rs.id + '" />';
            } else {
                htmltr += '<input id="boxstu' + rs.id + '" class="fmys" name="fmys[]" type="radio" value="' + rs.id + '" />';
            }
            htmltr += '</td>\
            <td width="180" align="left" valign="middle"><label for="boxfmy' + rs.id + '">' + rs.name + '</label></td>\
            <td width="90" align="center" valign="middle">' + rs.gender + '</td>\
            <td align="center" valign="middle">' + rs.birthday + '</td>\
            <td width="240" align="left" valign="middle">' + rs.telephone + '</td>\
            <td width="60" align="center" valign="middle"><a href="#" data-value="' + rs.id + '" class="opteditfmy">修改</a> | <a href="#" data-value="' + rs.id + '" class="optdelfmy">删除</a></td>\
            </tr>';
            var newtr = $(htmltr).insertBefore('#fmyhead');
            if (inIds(rs.id)) {
                newtr.find('input').attr('checked', 'checked');
            }
        }
    }
    $('#fmylist .delitem').remove();
};

function showct2() {
    $('.ct2').show();
    $('#ctladdtr').hide();
}

window.closeDlg = function (rows) {
    initStuList(rows);
    layer.closeAll();
};
window.closeFamily = function (rows) {
    initFmyList(rows);
    layer.closeAll();
};

$(function () {
    //更新学生信息
    $.get('/account/getstulist.html', function (rows) {
        initStuList(rows);
    }, 'json');
    //添加学生
    $('#optaddstu').on('click', function () {
        layer.open({
            type: 2,
            title: '添加学生信息',
            skin: 'layer-ext-seaning', //加上边框
            area: ['700px', '500px'], //宽高
            content: '/account/stuadd.html' //iframe的url
        });
        return false;
    });
    //编辑学生
    $('#stulist').delegate('a.opteditstu', 'click', function (ev) {
        var that = $(this);
        var id = that.data('value');
        layer.open({
            type: 2,
            title: '编辑学生信息',
            skin: 'layer-ext-seaning', //加上边框
            area: ['700px', '500px'], //宽高
            content: '/account/stuedit/' + id + '.html' //iframe的url
        });
        return false;
    });

    //点击学生数量
    $('#stulist').delegate('input.stus', 'click', function (ev) {
        var boxs = $('#stulist input.stus').filter(':checked');
        var tourists = $('#tourists').val();
        if (boxs.length > tourists) {
            layer.alert('学生人数超出 ' + tourists + '人！');
            return false;
        }
        return true;
    });

    //更新家长信息
    if ($('#fmylist').length > 0) {

        $.get('/account/getfmylist.html', function (rows) {
            initFmyList(rows);
        }, 'json');

        //添加家长
        $('#optaddfmy').on('click', function () {
            layer.open({
                type: 2,
                title: '添加家长信息',
                skin: 'layer-ext-seaning', //加上边框
                area: ['700px', '440px'], //宽高
                content: '/account/fmyadd.html' //iframe的url
            });
            return false;
        });

        //编辑家长
        $('#fmylist').delegate('a.opteditfmy', 'click', function (ev) {
            var that = $(this);
            var id = that.data('value');
            layer.open({
                type: 2,
                title: '编辑家长信息',
                skin: 'layer-ext-seaning', //加上边框
                area: ['700px', '440px'], //宽高
                content: '/account/fmyedit/' + id + '.html' //iframe的url
            });
            return false;
        });

        //编辑家长
        $('#fmylist').delegate('a.optdelfmy', 'click', function (ev) {
            var that = $(this);
            var id = that.data('value');
            layer.confirm('确定要删除该家长信息吗？', {
                btn: ['确定', '取消'], //按钮
                shade: false //不显示遮罩
            }, function () {
                layer.closeAll();
                $.get('/account/fmydel/' + id + '.html', function (dat) {
                    if (dat.success) {
                        initFmyList(dat.data);
                    } else {
                        layer.msg(dat.error, {icon: 1});
                    }
                }, 'json');

            });
            return false;
        });



        $('#fmylist').delegate('input.fmys', 'click', function (ev) {
            var boxs = $('#fmylist input.fmys').filter(':checked');
            var parent = $('#parent').val();
            if (boxs.length > parent) {
                layer.alert('家长人数超出 ' + parent + '人！');
                return false;
            }
            return true;
        });

    }

    $('#addmb').on('submit', function () {
        var boxs = $('#stulist input.stus').filter(':checked');
        var tourists = $('#tourists').val();

        if (boxs.length < tourists) {
            layer.alert('学生人数不足 ' + tourists + ' 人！');
            return false;
        }
        if (boxs.length > tourists) {
            layer.alert('学生人数超出 ' + tourists + ' 人！');
            return false;
        }
        if ($('#fmylist').length > 0) {
            var boxs2 = $('#fmylist input.fmys').filter(':checked');
            var parents = $('#parent').val();
            if (boxs2.length < parents) {
                layer.alert('家长人数不足 ' + parents + ' 人！');
                return false;
            }
            if (boxs2.length > parents) {
                layer.alert('家长人数超出 ' + parents + ' 人！');
                return false;
            }
        }
    });

    $('#optaddctl2').on('click', function () {
        showct2();
    });

});