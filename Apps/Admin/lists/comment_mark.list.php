<?php
$content = SGet('content');
$this->assign("content",$content);
return array(
   

    'model' => 'CommentMark',
    'search' =>
        array(
            0 => array(
                'name' => 'screen',
                'label' => '客户筛选',
                'boxname' => 'screen',
                'type' => 'select',
                'schtp' => '9',
                'style' => '',
                'css' => '',
            ),
            1 => array(
                'name' => 'content',
                'label' => '客户筛选',
                'boxname' => 'content',
                'type' => 'text',
                'schtp' => '9',
                'style' => '',
                'css' => '',
            ),
        ),
    'usesql' => '0',
    'sql' => '',
    'sqlargs' => NULL,
    'usingfy' => '1',
    'orderby' => 'add_time desc',
);
