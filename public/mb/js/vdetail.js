$(function () {
    var setbox = function () {
        var opt = $('#depid').children('option:selected');
        var depid = opt.val() || 0;
        var cost = opt.data('cost');
        var deposit = opt.data('deposit');
        var html = '';
        if (cost) {
            if (deposit) {
               // html += '预定金 : <i>￥' + deposit + '</i> 元';
               html += '费用共计: <i>￥' + cost + '</i> 元<br />';
            }
        } else {
            html += '<b>&nbsp;&nbsp;暂无报价&nbsp;<br/>&nbsp;&nbsp;</b>';
        }
        $('.price').html(html);
    };
    setbox();
    $('#depid').on('change', setbox);
});