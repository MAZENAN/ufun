(function ($, undefined) {

    function TimeBtn(em, options) {
        var btn = $(em);
        var timeout = options.timeout || 60;
        var intext = options.intext || '';
        var isbtn = btn.is('input');
        var outtext = options.outtext || (isbtn ? btn.val() : btn.text());
        var onfun = options.click || function () {
        };
        var ontimeout = options.ontimeout || function () {
        };
        var time = 0;
        var timer = null;
        var state = 0;
        var cleantimer = function () {
            if (timer != null) {
                window.clearInterval(timer);
                timer = null;
            }
        };
        var start = this.start = function () {
            time = timeout;
            cleantimer();
            btn.attr('disabled', 'disabled');
            btn.addClass('disabled');
            timer = window.setInterval(function () {
                time--;
                if (time <= 0) {
                    ontimeout();
                    if (isbtn) {
                        btn.val(outtext);
                    }
                    else {
                        btn.text(outtext);
                    }
                    stop();
                }
                else {
                    var str = intext.replace(/{time}/ig, time);
                    if (isbtn) {
                        btn.val(str);
                    }
                    else {
                        btn.text(str);
                    }
                }
            }, 1000);
        };
        var stop = this.stop = function () {
            time = 0;
            btn.removeAttr('disabled');
            btn.removeClass('disabled');
            cleantimer();
        };
        var disabled = this.disabled = function () {
            stop();
            btn.attr('disabled', 'disabled');
            btn.addClass('disabled');
            state = 0;
        };
        var ready = this.ready = function () {
            btn.removeAttr('disabled');
            btn.removeClass('disabled');
            state = 1;
        };
        btn.click(function (ev) {
            if (time != 0 || state === 0) {
                return;
            }
            if($(this).data('state')=='redo'){return false;}
            var ret = onfun.call(this, ev);
            if (!ret) {
                return false;
            }
            start();
            return true;
        });
        ready();
    }

    $.fn.timebtn = function (options) {
        this.each(function () {
            if (!this.TimeBtn) {
                if (typeof (options) !== 'string') {
                    this.TimeBtn = new TimeBtn(this, options);
                }
            }
            else {
                if (typeof (options) === 'string') {
                    if (options === 'start') {
                        this.TimeBtn.start();
                    }
                    if (options === 'stop') {
                        this.TimeBtn.stop();
                    }
                    if (options === 'disabled') {
                        this.TimeBtn.disabled();
                    }
                    if (options === 'ready') {
                        this.TimeBtn.ready();
                    }
                }
            }
        });
    };

})(jQuery);