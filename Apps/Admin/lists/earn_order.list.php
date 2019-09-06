<?php

return array(
    'model' => 'EarnOrder',
    'search' => array(
        array(
            'name' => 'order_id',
            'label' => '订单号',
            'boxname' => 'order_id',
            'type' => 'text',
            'schtp' => '1',
            'style' => 'width:120px',
            'css' => '',
        ),
        array(
            'name' => 'status',
            'label' => '状态',
            'boxname' => 'status',
            'type' => 'text',
            'schtp' => '1',
            'style' => 'width:120px',
            'css' => '',
        ),
        array(
            'name' => 'order_type',
            'label' => '状态',
            'boxname' => 'order_type',
            'type' => 'select',
            'schtp' => '1',
            'style' => 'width:120px',
            'css' => '',
        )
    ),
    'usesql' => '0',
    'sql' => '',
    'sqlargs' => NULL,
    'usingfy' => '1',
    'orderby' => 'id desc',
);