// JavaScript Document
$.SMF.setCustomFunc('timely_result', function () {
    return true;
});
$.SMF.setCustomFunc('display_default', function (args) {
});
$.SMF.setCustomFunc('display_valid', function (args) {
});
$.SMF.setCustomFunc('display_error', function (args) {
    var msg = args.msg, elem = args.elem, data = args.data, errtype = args.errtype, submit = args.submit;
    if (submit === false) {
        return;
    }
    if (msg) {
        layer.open({
            content: msg,
            btn: ['OK'],
            yes: function (index) {
                layer.close(index)
                elem.focus();
            }
        });
    }
});

if (typeof (layer.alert) !== 'function') {
    layer.alert = function (msg) {
        layer.open({
            content: msg,
            btn: ['OK']
        });
    }
}