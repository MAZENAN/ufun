(function($) {
    $.widget("samao.combotree", $.ui.menu, {
        version: "1.11.0",
        defaultElement: "<dl>",
        delay: 300,
        options: {
            icons: {
                submenu: "ui-icon-carat-1-e"
            },
            items: "dd,dt",
            menus: "ul",
            position: {
                my: "left-1 top",
                at: "right top"
            },
            // callbacks
            blur: null,
            focus: null,
            select: null
        }
    });
})(jQuery);