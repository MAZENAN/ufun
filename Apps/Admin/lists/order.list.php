<?php

return array(
    'model' => 'Order',
    'search' => array(
        array(
            'name' => 'order_id',
            'label' => '订单号',
            'boxname' => 'order_id',
            'type' => 'text',
            'schtp' => '0',
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
            'name' => 'merchant_id',
            'label' => '所属商家',
            'boxname' => 'merchant_id',
            'type' => 'select',
            'schtp' => '1',
            'style' => 'width:120px',
            'css' => '',
        ),
        array(
            'name' => 'school_id',
            'label' => '配送学校',
            'boxname' => 'school_id',
            'type' => 'select',
            'schtp' => '1',
            'style' => 'width:120px',
            'css' => '',
        ),
        array(
            'name' => 'code',
            'label' => '取餐码',
            'boxname' => 'code',
            'type' => 'text',
            'schtp' => '1',
            'style' => 'width:120px',
            'css' => '',
        ),
        array(
            'name' => 'buyer_phone',
            'label' => '手机号',
            'boxname' => 'buyer_phone',
            'type' => 'text',
            'schtp' => '1',
            'style' => 'width:120px',
            'css' => '',
        ),
    ),
    'usesql' => '0',
    'sql' => '',
    'sqlargs' => NULL,
    'usingfy' => '1',
    'orderby' => 'id desc',
);