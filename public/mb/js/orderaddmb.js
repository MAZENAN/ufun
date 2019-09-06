
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
            <td width="40" align="center" valign="middle" style="padding-left:15px;">';
            if (tourists >= 2) {
                htmltr += '<input id="boxstu' + rs.id + '" class="stus" name="stus[]" type="checkbox" value="' + rs.id + '" />';
            } else {
                htmltr += '<input id="boxstu' + rs.id + '" class="stus" name="stus[]" type="radio" value="' + rs.id + '" />';
            }
            htmltr += '</td>\
            <td align="left" valign="middle"><label for="boxstu' + rs.id + '">' + rs.name + '</label></td>\
            <td align="center" valign="middle">' + rs.gender + '</td>\
            <td align="center" valign="middle">' + rs.birthday + '</td>\
            <td align="left" valign="middle">' + rs.telephone + '</td>\
            <td align="center" valign="middle"><a href="#" data-value="' + rs.id + '" class="opteditstu">修改</a></td>\
            </tr>';
            var newtr = $(htmltr).appendTo('#stulist');
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
            var parents = $('#parent').val();
            var htmltr = '<tr class="fmyitem" id="fmy' + rs.id + '">\
            <td width="40" align="center" valign="middle" style="padding-left:15px;">';
            if (parents >= 2) {
                htmltr += '<input id="boxfmy' + rs.id + '" class="fmys" name="fmys[]" type="checkbox" value="' + rs.id + '" />';
            } else {
                htmltr += '<input id="boxfmy' + rs.id + '" class="fmys" name="fmys[]" type="radio" value="' + rs.id + '" />';
            }
            htmltr += '</td>\
            <td align="left" valign="middle"><label for="boxfmy' + rs.id + '">' + rs.name + '</label></td>\
            <td align="center" valign="middle">' + rs.gender + '</td>\
            <td align="center" valign="middle">' + rs.birthday + '</td>\
            <td align="left" valign="middle">' + rs.telephone + '</td>\
            <td align="center" valign="middle"><a href="#" data-value="' + rs.id + '" class="opteditfmy">修改</a></td>\
            </tr>';
            var newtr = $(htmltr).appendTo('#fmylist');
            if (inIds(rs.id)) {
                newtr.find('input').attr('checked', 'checked');
            }
        }
    }
    $('#fmylist .delitem').remove();
};


var initStuForm = function () {
    var tourists = $('#tourists').val();
    var Stulist = $('#stulist');
    var stu_btn1 = $('#stu_btn1');
    var stu_btn2 = $('#stu_btn2');
    var url = "/account/stuadd.html";
    $("#add_person").click(function () {
        $('#stu_name,#stu_birthday,#stu_school,#stu_grade,#stu_telephone,#stu_email,#stu_area,#stu_address,#stu_area').val('');
        $('#stu_area').linkage();
        $('#stu_gender_1').removeAttr('checked');
        $('#stu_gender_0').attr('checked', 'checked');
        stu_btn1.text('确定添加');
        stu_btn2.text('取消添加');
        url = "/account/stuadd.html";
        $("#person_form").slideDown(200);
    });

    $.get('/account/getstulist.html', function (rows) {
        initStuList(rows);
    }, 'json');
    //编辑学生
    Stulist.delegate('a.opteditstu', 'click', function () {
        var that = $(this);
        var id = that.data('value');
        $.get('/account/stuget.html', {id: id}, function (row) {
            url = '/account/stuedit/' + id + '.html';
            $('#stu_name,#stu_birthday,#stu_school,#stu_grade,#stu_telephone,#stu_email,#stu_area,#stu_address,#stu_area').val('');
            $('#stu_name').val(row.name || '');
            if (row.gender == '男') {
                $('#stu_gender_1').removeAttr('checked');
                $('#stu_gender_0').attr('checked', 'checked');
            } else {
                $('#stu_gender_0').removeAttr('checked');
                $('#stu_gender_1').attr('checked', 'checked');
            }
            $('#stu_birthday').val(row.birthday || '');
            $('#stu_school').val(row.school || '');
            $('#stu_grade').val(row.grade || '');
            $('#stu_telephone').val(row.telephone || '');
            $('#stu_email').val(row.email || '');
            $('#stu_area').val(row.area || '');
            $('#stu_address').val(row.address || '');
            $('#stu_area').linkage();
            stu_btn1.text('确定编辑');
            stu_btn2.text('取消编辑');
            $("#person_form").slideDown(200);
        }, 'json');
        return false;
    });
    Stulist.delegate('input.stus', 'click', function (ev) {
        var boxs = Stulist.find('input.stus').filter(':checked');
        if (boxs.length > tourists) {
            layer.open({
                content: '学生人数超出 ' + tourists + '人！',
                btn: ['OK']
            });
            return false;
        }
        return true;
    });
    stu_btn1.on('click', function () {
        var data = {};
        data.name = $('#stu_name').val();
        if (data.name == '') {
            layer.alert('请填写姓名！');
            return false;
        }
        data.gender = $('#stu_gender_0,#stu_gender_1').filter(':checked').val();
        if (data.gender == '') {
            layer.alert('请选择性别！');
            return false;
        }
        data.birthday = $('#stu_birthday').val();
        if (data.birthday == '') {
            layer.alert('请填写生日！');
            return false;
        }
        data.school = $('#stu_school').val();
        if (data.school == '') {
            layer.alert('请填写所在学校！');
            return false;
        }
        data.grade = $('#stu_grade').val();
        if (data.grade == '') {
            layer.alert('请填写年级信息！');
            return false;
        }
        data.telephone = $('#stu_telephone').val();
        if (data.telephone == '') {
            layer.alert('请填写电话号码！');
            return false;
        }
        data.email = $('#stu_email').val();
        if (data.email == '') {
            layer.alert('请填写邮箱地址！');
            return false;
        }
        data.area = $('#stu_area').val();
        if (data.area == '') {
            layer.alert('请选择所在区域！');
            return false;
        }
        data.address = $('#stu_address').val();
        $.post(url, data, function (rdata) {
            if (rdata.success) {
                initStuList(rdata.data);
                layer.open({
                    content: rdata.success,
                    time: 2
                });
                $("#person_form").slideUp(200);
            } else {
                layer.alert(rdata.error);
            }
        }, 'json');
        return false;
    });
    stu_btn2.on('click', function () {
        $("#person_form").slideUp(200);
    });
};

var initFmyForm = function () {
    var parents = $('#parent').val();
    var Fmylist = $('#fmylist');
    var fmy_btn1 = $('#fmy_btn1');
    var fmy_btn2 = $('#fmy_btn2');
    var url = "/account/fmyadd.html";
    $("#add_parent").click(function () {
        $('#fmy_name,#fmy_birthday,#fmy_idcard,#fmy_telephone,#fmy_email,#fmy_area,#fmy_address,#fmy_area').val('');
        $('#fmy_area').linkage();
        $('#fmy_gender_1').removeAttr('checked');
        $('#fmy_gender_0').attr('checked', 'checked');
        fmy_btn1.text('确定添加');
        fmy_btn2.text('取消添加');
        url = "/account/fmyadd.html";
        $("#parent_form").slideDown(200);
    });

    $.get('/account/getfmylist.html', function (rows) {
        initFmyList(rows);
    }, 'json');
    //编辑学生
    Fmylist.delegate('a.opteditfmy', 'click', function () {
        var that = $(this);
        var id = that.data('value');
        $.get('/account/stuget.html', {id: id}, function (row) {
            url = '/account/fmyedit/' + id + '.html';
            $('#fmy_name,#fmy_birthday,#fmy_idcard,#fmy_telephone,#fmy_email,#fmy_area,#fmy_address,#fmy_area').val('');
            $('#fmy_name').val(row.name || '');
            if (row.gender == '男') {
                $('#fmy_gender_1').removeAttr('checked');
                $('#fmy_gender_0').attr('checked', 'checked');
            } else {
                $('#fmy_gender_0').removeAttr('checked');
                $('#fmy_gender_1').attr('checked', 'checked');
            }
            $('#fmy_birthday').val(row.birthday || '');
            $('#fmy_idcard').val(row.school || '');
            $('#fmy_telephone').val(row.telephone || '');
            $('#fmy_email').val(row.email || '');
            $('#fmy_area').val(row.area || '');
            $('#fmy_address').val(row.address || '');
            $('#fmy_area').linkage();
            fmy_btn1.text('确定编辑');
            fmy_btn2.text('取消编辑');
            $("#parent_form").slideDown(200);
        }, 'json');
        return false;
    });
    Fmylist.delegate('input.fmys', 'click', function (ev) {
        var boxs = Fmylist.find('input.fmys').filter(':checked');
        if (boxs.length > parents) {
            layer.open({
                content: '家长人数超出 ' + parents + '人！',
                btn: ['OK']
            });
            return false;
        }
        return true;
    });
    fmy_btn1.on('click', function () {
        var data = {};
        data.name = $('#fmy_name').val();
        if (data.name == '') {
            layer.alert('请填写姓名！');
            return false;
        }
        data.gender = $('#fmy_gender_0,#fmy_gender_1').filter(':checked').val();
        if (data.gender == '') {
            layer.alert('请选择性别！');
            return false;
        }
        data.birthday = $('#fmy_birthday').val();
        if (data.birthday == '') {
            layer.alert('请填写生日！');
            return false;
        }
        data.idcard = $('#fmy_idcard').val();
        if (data.idcard == '') {
            layer.alert('请填写身份证号码！');
            return false;
        }
        data.telephone = $('#fmy_telephone').val();
        if (data.telephone == '') {
            layer.alert('请填写电话号码！');
            return false;
        }
        data.email = $('#fmy_email').val();
        if (data.email == '') {
            layer.alert('请填写邮箱地址！');
            return false;
        }
        data.area = $('#fmy_area').val();
        if (data.area == '') {
            layer.alert('请选择所在区域！');
            return false;
        }
        data.address = $('#fmy_address').val();
        $.post(url, data, function (rdata) {
            if (rdata.success) {
                initFmyList(rdata.data);
                layer.open({
                    content: rdata.success,
                    time: 2
                });
                $("#parent_form").slideUp(200);
            } else {
                layer.alert(rdata.error);
            }
        }, 'json');
        return false;
    });
    fmy_btn2.on('click', function () {
        $("#parent_form").slideUp(200);
    });
};


$(function () {

    initStuForm();
    initFmyForm();

    $('#addmb').on('submit', function () {
        var boxs = $('#stulist input.stus').filter(':checked');
        var tourists = $('#tourists').val();
        if (boxs.length < tourists) {
            layer.alert('学生人数不足 ' + tourists + ' 人,请在 学生基本信息 栏中勾选 ' + tourists + ' 人');
            return false;
        }
        if (boxs.length > tourists) {
            layer.alert('学生人数超出 ' + tourists + ' 人,只能框勾选' + tourists + ' 人');
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

});