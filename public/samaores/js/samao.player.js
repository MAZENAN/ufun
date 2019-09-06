
(function($, undefined) {

    var smMover = function(elem, options) {
        var self = this;
        var that = $(elem);
        var getPageIndex = null;
        var InitPlay = false;
        var MyMar = null;
        var lbtn, rbtn, mover, uldata, newlis, Index = 0, len = 0;
        var sleep = options.sleep || 500;
        var timeout = options.timeout || 4000;
        var autoplay = options.autoplay || true;
        var fn = options.fn || null;
        var hide = !!options.hide;
        var size = options.minsize || 0;
        var direction = options.direction || 0;

        var init = this.init = function() {

            lbtn = that.find('.leftbar');
            rbtn = that.find('.rightbar');
            mover = that.find('.mover');
            if (direction == 0) {
                mover.css({'margin-left': '0px'});
            } else {
                mover.css({'margin-top': '0px'});
            }
            if (hide) {
                uldata = that.find('ul.data');
            } else {
                uldata = that.find('ul.data:visible');
            }

            Index = 0;
            if (!uldata.data('init')) {
                var lis = uldata.children('li');
                len = lis.length;
                if (size) {
                    if (size > len) {
                        return;
                    }
                }
                uldata.data('initlen', len);
                uldata.data('init', true);
                lis.each(function(lidx, lielem) {
                    $(lielem).clone().appendTo(uldata);
                });
            } else {
                len = uldata.data('initlen');
            }
            newlis = uldata.children('li');
            rbtn.off('click').on('click', next);
            lbtn.off('click').on('click', prev);
        };

        var getLeft = function(Index) {
            var left = 0;
            if (Index == 0) {
                return 0;
            }
            newlis.each(function(lidx, lielem) {
                if (lidx >= Index) {
                    return false;
                }
                left += $(lielem).outerWidth(true);
            });
            return -left;
        };

        var getTop = function(Index) {
            var top = 0;
            if (Index == 0) {
                return 0;
            }
            newlis.each(function(lidx, lielem) {
                if (lidx >= Index) {
                    return false;
                }
                top += $(lielem).outerHeight(true);
            });
            return -top;
        };

        var goTo = this.goto = function(Index) {
            if (typeof (fn) == 'function') {
                if (Index >= len) {
                    fn(0);
                } else {
                    fn(Index);
                }
            }
            if (direction == 0) {
                mover.animate({'margin-left': getLeft(Index) + 'px'}, sleep);
            } else {
                mover.animate({'margin-top': getTop(Index) + 'px'}, sleep);
            }
        };

        this.resize = function() {
            if (direction == 0) {
                mover.css({'margin-left': getLeft(Index) + 'px'});
            } else {
                mover.css({'margin-top': getTop(Index) + 'px'});
            }
        };
        var next = function() {
            if (Index >= len) {
                Index = 0;
                if (direction == 0) {
                    mover.css({'margin-left': '0px'});
                } else {
                    mover.css({'margin-top': '0px'});
                }
            }
            Index++;
            goTo(Index);
        };

        var prev = function() {
            if (Index <= 0) {
                Index = len;
                if (direction == 0) {
                    mover.css({'margin-left': getLeft(Index) + 'px'});
                } else {
                    mover.css({'margin-top': getTop(Index) + 'px'});
                }
            }
            Index--;
            goTo(Index);
        };

        that.on('mouseenter', function() {
            if (MyMar) {
                window.clearInterval(MyMar);
                MyMar = null;
            }
        }).on('mouseleave', function() {
            if (InitPlay) {
                if (MyMar) {
                    window.clearInterval(MyMar);
                    MyMar = null;
                }
                MyMar = setInterval(next, timeout);
            }
        });

        this.getPageIndex = function() {
            if (getPageIndex === null) {
                getPageIndex = that.parents('.page:first').data('Index');
            }
            return parseInt(getPageIndex);
        };

        var stop = this.stop = function() {
            InitPlay = false;
            if (MyMar) {
                window.clearInterval(MyMar);
                MyMar = null;
            }
        };
        this.isplay = function() {
            return MyMar != null;
        };

        var play = this.play = function() {
            InitPlay = true;
            if (MyMar) {
                window.clearInterval(MyMar);
                MyMar = null;
            }
            MyMar = setInterval(next, timeout);
        };
        init();
        if (autoplay) {
            play();
        }

    };

    var smPlayer = function(elem, options) {

        var w = options.width || 980;
        var h = options.height || 350;
        var pics = options.pics == null ? [
            {src: '/styles/images/index_img1.jpg'},
            {src: '/styles/images/index_img2.jpg'},
            {src: '/styles/images/index_img3.jpg'},
            {src: '/styles/images/index_img4.jpg'},
            {src: '/styles/images/index_img5.jpg'}
        ] : options.pics;
        var timeout = options.timeout || 4500;
        var sleep = options.sleep || 500;
        var nobar = !!options.nobar;
        var nbbar = !!options.nbbar;
        var btnbar = options.btnbar || null;
        var createbar = false;
        var that = $(elem);

        var dplay = $('<div></div>').css({
            width: w + 'px',
            height: h + 'px'
        }).appendTo(that);

        var mplay = $('<div></div>').css({
            width: w + 'px',
            height: h + 'px',
            position: 'relative',
            marginTop: '-' + h + 'px'
        }).appendTo(that);

        if (btnbar == null && !nobar) {
            createbar = true;
            btnbar = $('<div></div>').css({
                width: w + 'px',
                height: 22 + 'px',
                position: 'relative',
                marginTop: '-22px'
            }).appendTo(that);
        }
        if (!nobar) {
            var mare = $('<div></div>').css({
                height: 22 + 'px',
                float: 'right',
                marginRight: '5px'
            }).appendTo(btnbar);
        }
        var index = 0, length = pics.length;
        var css = {
            height: '15px',
            lineHeight: '14px',
            float: 'left',
            marginLeft: '5px',
            border: '1px solid #FFF',
            padding: '0 7px',
            color: '#FFF',
            backgroundColor: '#FFF',
            fontSize: '12px',
            cursor: 'pointer',
            fontFamily: 'Verdana, Geneva, sans-serif'
        };
        var css1 = {color: '#FFF', backgroundColor: '#A44', border: '1px solid #A44', opacity: 1};
        var css2 = {color: '#A44', backgroundColor: '#FFF', border: '1px solid #FFF', opacity: 1};

        var paly = function(num) {
            var src = pics[num].src;
            var link = pics[num].link || '';
            var str = '<a href="' + link + '" target="_blank"></a>';
            if (link === '') {
                link = 'javascript:void(0);';
                str = '<a href="' + link + '"></a>';
            }
            dplay.empty();
            var alink = $(str).appendTo(dplay);

            $('<img/>').attr('src', src).css({width: w + 'px', height: h + 'px'}).appendTo(alink);
            mplay.fadeOut(sleep, function() {
                mplay.html(dplay.html()).show();
            });
            if (!nobar) {
                if (createbar) {
                    mare.find('b').css(css1);
                    mare.find('b[xid=' + num + ']').css(css2);
                } else {
                    mare.find('b').removeClass('active');
                    mare.find('b[xid=' + num + ']').addClass('active');
                }
            }
            index = num;
        };

        var next = function() {
            index++;
            if (index >= length)
                index = 0;
            paly(index);
        };
        if (!nobar) {
            for (var i = 0; i < length; i++) {
                var btn = $('<b></b>').attr('xid', i).click(function(event) {
                    var idx = $(this).attr('xid');
                    if (timer != null) {
                        window.clearInterval(timer);
                        timer = window.setInterval(function() {
                            next();
                        }, timeout);
                    }
                    paly(idx);
                    return false;
                }).appendTo(mare);
                if (nbbar) {
                    btn.text(i + 1);
                }
                if (createbar) {
                    btn.css(css);
                }
            }
        }
        timer = window.setInterval(function() {
            next();
        }, timeout);
        paly(index);

    };

    $.fn.smMover = function(options, args) {
        $(this).each(function(idx, elem) {
            if (elem.smMover == null && typeof (options) != 'string') {
                elem.smMover = new smMover(elem, options);
            } else if (elem.smMover != null && typeof (options) != 'string') {
                switch (options) {
                    case 'stop':
                        elem.smMover.stop();
                        break;
                    case 'play':
                        elem.smMover.play();
                        break;
                    case 'goto':
                        elem.smMover.goto(args);
                        break;
                    default:
                        break;
                }

            }
        });
    };
    $.fn.smPlayer = function(options) {
        $(this).each(function(idx, elem) {
            if (elem.smPlayer == null) {
                elem.smPlayer = new smPlayer(elem, options);
            }
        });
    };

})(jQuery);
