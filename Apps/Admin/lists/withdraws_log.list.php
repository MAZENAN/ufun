<?php

return array(
    'model' => 'WithdrawsLog',
    'search' => array(
        array(
            'name' => 'type',
            'label' => '提现类型',
            'boxname' => 'type',
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