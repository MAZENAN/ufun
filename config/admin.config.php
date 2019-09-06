<?php

return array(
    /* 路由规则选项 */

    'ROUTE_DATAS' => array(
        'rule' => array(
            'id' => '/{ctl:@key}/{act:@key}/{id:@num}', //可以任意取名
            'param' => '/{ctl:@key}/{act:@key}/{param:@any}', //可以任意取名
            'act' => '/{ctl:@key}/{act:@key}', //控制器路径 一定需要使用 act 的名称 
            'ctl' => '/{ctl:@key}', //控制器路径 一定需要使用 ctl 的名称 
        ),
        'default' => array('ctl' => 'index', 'act' => 'index'),
    ),
    //TOOOL接管设置，允许所有不存在的模型由工具托管
    'SAMAO_BYTOOL' => TRUE,
    'TOOL_ALLOW_CONTROLLERS' => '*', //允许接管所有控制器
);

