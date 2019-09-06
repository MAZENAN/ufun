<?php

return array(
    'model' => 'SellCategory',
    'search' =>
        array (
            0 =>
                array (
                    'name' => 'pid',
                    'label' => '所属上级分类',
                    'boxname' => 'pid',
                    'type' => 'hidden',
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