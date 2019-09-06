
jQuery.fn.contextPopup = function(menuData) {
    var settings = {
        contextMenuClass: 'contextMenuPlugin',
        gutterLineClass: 'gutterLine',
        headerClass: 'header',
        seperatorClass: 'divider',
        title: '',
        items: []
    };

    $.extend(settings, menuData);
    function createMenu(e, node) {
        var menu = $('<ul class="' + settings.contextMenuClass + '"><div class="' + settings.gutterLineClass + '"></div></ul>')
                .appendTo(document.body);
        if (settings.title) {
            $('<li class="' + settings.headerClass + '"></li>').text(settings.title).appendTo(menu);
        }
        settings.items.forEach(function(item) {
            if (item) {
                var rowCode = '<li><a href="javascript:;"><span></span></a></li>';
                var row = $(rowCode).appendTo(menu);
                if (item.icon) {
                    var icon = $('<img>');
                    icon.attr('src', item.icon);
                    icon.insertBefore(row.find('span'));
                }
                row.find('span').text(item.label);

                if (item.isEnabled != undefined && !item.isEnabled()) {
                    row.addClass('disabled');
                } else if (item.action) {
                    row.find('a').click(function() {
                        menu.remove();
                        item.action(e, node);
                    });
                }

            } else {
                $('<li class="' + settings.seperatorClass + '"></li>').appendTo(menu);
            }
        });
        menu.find('.' + settings.headerClass).text(settings.title);
        return menu;
    }

    this.bind('contextmenu', function(e) {
        var menu = createMenu(e, this).show();
        var left = e.pageX + 5, /* nudge to the right, so the pointer is covering the title */
                top = e.pageY;
        if (top + menu.height() >= $(window).height()) {
            top -= menu.height();
        }
        if (left + menu.width() >= $(window).width()) {
            left -= menu.width();
        }
        menu.css({zIndex: 1000001, left: left, top: top}).bind('contextmenu', function() {
            return false;
        });
        menu.mousedown(function(ev) {
            ev.preventDefault();
            return false;
        });
        $(document).one('mousedown', function() {
            menu.remove();
            return false;
        });
        menu.find('a').click(function() {
            menu.remove();
        });
        return false;
    });

    return this;
};

