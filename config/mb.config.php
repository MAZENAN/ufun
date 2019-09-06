<?php

return [
    /* 路由规则选项 */
    'ROUTE_DATAS' => [
        'rule' => [
            'single' => '/{ctl:single}-{key:@key}.html',
            'buy' => ['@^/buy-(?P<id>\d+)\.html@i', ['ctl' => 'order', 'act' => 'buy']], //产品显示
            'cfmbuy' => ['@^/cfmbuy-(?P<id>\d+)-(?P<type>[a-z]+)-(?P<depid>\d+)\.html@i', ['ctl' => 'order', 'act' => 'cfmbuy']], //产品显示
            'glcamp_detail' => ['@^/glcamp-(?P<id>\d+)\.html@i', ['ctl' => 'glcamp', 'act' => 'detail']], //产品显示
            'cncamp_detail' => ['@^/cncamp-(?P<id>\d+)\.html@i', ['ctl' => 'cncamp', 'act' => 'detail']], //产品显示
            'campedu_detail' => ['@^/campedu-(?P<id>\d+)\.html@i', ['ctl' => 'campedu', 'act' => 'detail']], //产品显示
            'search' => ['@^/sch-(?P<camp_age>\d+)-(?P<camp_days>\d+)-(?P<starting_city>\d+)-(?P<order>\d+)\.html@i', ['ctl' => 'search', 'act' => 'index']], //大类
            'glcamp' => ['@^/gs-(?P<camp_tag>[\d+\,]*\d+)-(?P<start_date>\d+)-(?P<start_date_to>\d+)-(?P<camp_days>[\d+\,]*\d+)-(?P<camp_type>[\d+\,]*\d+)-(?P<destination>[\d+\,]*\d+)-(?P<camp_age_from>\d+)-(?P<camp_age_to>\d+)-(?P<order_nstart>\d+)-(?P<order_ncost>\d+)\.html@i', ['ctl' => 'glcamp', 'act' => 'index']], //大类
            'cncamp' => ['@^/ns-(?P<camp_tag>[\d+\,]*\d+)-(?P<start_date>\d+)-(?P<start_date_to>\d+)-(?P<camp_days>[\d+\,]*\d+)-(?P<camp_type>[\d+\,]*\d+)-(?P<destination>[\d+\,]*\d+)-(?P<camp_age_from>\d+)-(?P<camp_age_to>\d+)-(?P<order_nstart>\d+)-(?P<order_ncost>\d+)\.html@i', ['ctl' => 'cncamp', 'act' => 'index']], //大类
            'cid' => '/{ctl:@key}/{act:@key}/{id:@num}.html', //可以任意取名
            'act' => '/{ctl:@key}/{act:@key}.html', //控制器路径 一定需要使用 act 的名称 
            'ctl' => '/{ctl:@key}.html', //控制器路径 一定需要使用 ctl 的名称  
        ],
        'default' => ['ctl' => 'index', 'act' => 'index'],
    ],
    'PageBar' => array(
        'info' => '共有信息：#Count#  页次：#Page#/#PageCount# 每页 #PageSize#', //分页信息
        'showinfo' => 0, //1为显示 0 为不显示
        'infoclass' => 'pagebar_info', //控件信息样式
        'size' => 10, //分页控件上 显示多少页
        'showfirst' => 2, //首页按钮显示  可选值 1|2|0 为0时不显示 1 和 2 值为不同显示方式
        'showlast' => 2, //尾页按钮显示   可选值 1|2|0 为0时不显示 1 和 2 值为不同显示方式
        'showprev' => 2, //上页按钮显示 可选值 1|2|0 为0时不显示 1为默认显示 2 为强制显示
        'shownext' => 2, //下页按钮显示 可选值 1|2|0 为0时不显示 1为默认显示 2 为强制显示
        'shownbpage' => 1, //页码按钮显示  可选值 1|0 为0时不显示 1为显示 
        'first' => '首页', //按钮文本
        'prev' => '上页', //按钮文本
        'next' => '下页', //按钮文本
        'last' => '尾页', //按钮文本
        'class' => 'pagebar', //控件样式
    ),
   //'orderIdFirstStr'=>'D',//订单号首字母
    'CONTROLLER_ERROR_TPL' => 'libs/jump.tpl', // 默认错误跳转对应的模板文件
    'CONTROLLER_SUCCESS_TPL' => 'libs/jump.tpl', // 默认成功跳转对应的模板文件
    'CONTROLLER_ERR404_TPL' => 'libs/jump.tpl', // 默认成功跳转对应的模板文件
    'weburl' => 'www.51camp.cn',
    "QiniuRoot" => "https://img.part.cn/"
    
];
