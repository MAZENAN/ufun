<?php

/**
 * SamaoPHP惯例配置文件
 * 该文件请不要修改，如果要覆盖惯例配置的值，可在项目配置文件中设定和惯例不符的配置项
 */
return array(
    /* 路由规则选项 */

    'ROUTE_DATAS' => array(
        'rule' => array(
            'id' => '/{ctl:@key}/{act:@key}/{id:@num}.html', //可以任意取名
            'param' => '/{ctl:@key}/{act:@key}/{param:@any}.html', //可以任意取名
            'act' => '/{ctl:@key}/{act:@key}.html', //控制器路径 一定需要使用 act 的名称 
            'ctl' => '/{ctl:@key}.html', //控制器路径 一定需要使用 ctl 的名称 
        ),
        'default' => array('ctl' => 'index', 'act' => 'index'),
    ),
    'ROUTE_BASE_FILLTYPE' => '', //默认为空，如 GET|REQUEST， GET 和 REQUEST中 仅包含 controller 和 action
    'ROUTE_PARAM_FILLTYPE' => 'GET|REQUEST', //默认将地址参数写入 GET 和 REQUEST中
    'ROUTE_PARAM_OVERLAY' => FALSE, //填充的参数是否覆盖原$_GET或者 $_REQUEST 中的参数

    /* 模板引擎设置 */
    'CONTROLLER_ERROR_TPL' => SAMAO_DIR . 'tpls/status_jump.tpl', // 默认错误跳转对应的模板文件
    'CONTROLLER_SUCCESS_TPL' => SAMAO_DIR . 'tpls/status_jump.tpl', // 默认成功跳转对应的模板文件
    'CONTROLLER_ERR404_TPL' => SAMAO_DIR . 'tpls/status_notfound.tpl', // 默认成功跳转对应的模板文件

    /* 服务路径配置 */
    'SERVICE_UPFILE_URL' => __ROOT__ . '/service/upfile.php', // 默认上传路径
    'SERVICE_VALIDCODE_URL' => __ROOT__ . '/service/code.php', // 默认验证码路径

    /* RBAC配置项 */
    'RBAC_CACHE_TYPE' => 'SESSION', // 权限节点缓存方式 选项 为 DB|SESSION 如果为空 默认为SESSION
    'RBAC_SESSION_NAME' => 'ADM', //选用 SESSION 名称 
    'Smarty_TPL_EXT' => 'tpl',
    'CUSTOM_SMARTY_PLUG_DIR' => '/libs/smarty_plugs',
);
