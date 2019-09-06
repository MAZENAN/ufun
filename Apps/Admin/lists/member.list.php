<?php

$arr = array(
    'model' => 'Member',
    'search' => array(
        1 => array(
            'name' => 'type',
            'label' => '会员类型',
            'boxname' => 'type',
            'type' => 'select',
            'schtp' => '1',
            'style' => '',
            'css' => '',
        ),
        2 => array(
            'name' => 'mobile',
            'label' => '手机号',
            'boxname' => 'mobile',
            'type' => 'text',
            'schtp' => '1',
            'style' => '',
            'css' => '',
        ),
    ),
    'usesql' => '0',
    'sql' => '',
    'sqlargs' => NULL,
    'usingfy' => '1',
    'orderby' => 'id desc',
);

$from = SGet('from');
if ($from!='all'){
    $arr['search'][] = array(
        'name' => 'status',
        'label' => '用户状态',
        'boxname' => 'status',
        'type' => 'text',
        'schtp' => '1',
        'style' => '',
        'css' => '',
    );
}
return $arr;