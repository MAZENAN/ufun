<?php
//$deleted = SGet('deleted');
//$this->assign(compact('deleted'));

return array(
    'model' => 'Goods',
    'search' => array(
        1 => array(
            'name' => 'deleted',
            'label' => '软删除',
            'boxname' => 'deleted',
            'type' => 'text',
            'schtp' => '1',
            'style' => '',
            'css' => '',
        ),
        2 => array(
            'name' => 'title',
            'label' => '商品名',
            'boxname' => 'title',
            'type' => 'text',
            'schtp' => '0',
            'style' => '',
            'css' => '',
        ),
        3 => array(
            'name' => 'allow',
            'label' => '上下架',
            'boxname' => 'allow',
            'type' => 'text',
            'schtp' => '1',
            'style' => 'width:100;',
            'css' => '',
        ),
        4 => array(
            'name' => 'merchant_id',
            'label' => '所属商家',
            'boxname' => 'merchant_id',
            'type' => 'select',
            'schtp' => '1',
            'style' => '',
            'css' => '',
        ),
        5 => array(
            'name' => 'deleted',
            'label' => '上下架',
            'boxname' => 'deleted',
            'type' => 'text',
            'schtp' => '1',
            'style' => 'width:100;',
            'css' => '',
        ),
        6 => array(
            'name' => 'sale_nums',
            'label' => '上下架',
            'boxname' => 'sale_nums',
            'type' => 'text',
            'schtp' => '9',
            'style' => 'width:100;',
            'css' => '',
        ),
        7 => array(
            'name' => 'is_option',
            'label' => '商品类型',
            'boxname' => 'is_option',
            'type' => 'select',
            'schtp' => '1',
            'style' => 'width:100;',
            'css' => '',
        ),
    ),
    'usesql' => '0',
    'sql' => '',
    'sqlargs' => NULL,
    'usingfy' => '1',
    'orderby' => 'sort asc',
);