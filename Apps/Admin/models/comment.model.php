<?php

if (!defined('SAMAO_VERSION')){
    exit('no direct access allowed');
}
    

class CommentModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'comment';
        $this->type = 1;
        $this->title = '问答';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;

        parent::__construct($modeltype);
    }

    public function fields() {
        return array(
//            'user_info'=>array(
//                'label'=>'提问人',
//                'label_width'=>120,
//                'type' => 'label',
//                'dbfield' => false,
//                
//            ),
//            'comment_info'=>array(
//                'label'=>'问题',
//                'label_width'=>120,
//                'type' => 'label',
//                'dbfield' => false,
//                
//            ),
            'comment'=>array(
                'label'=>'内容',
                'label_width'=>120,
                'type'=>'textarea',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '内容不能为空',
                ),
            ),
//            'camp_id'=>array(
//                'label'=>'产品id',
//                'label_width'=>120,
//                'type'=>'text',
//                'row_hide'=>'true',
//            ),
//            'pid'=>array(
//                'label'=>'父id',
//                'label_width'=>120,
//                'type'=>'text',
//                'row_hide'=>'true',
//            ),
//            'p_userid'=>array(
//                'label'=>'父userid',
//                'label_width'=>120,
//                'type'=>'text',
//                'row_hide'=>'true',
//            ),
//            'user_id'=>array(
//                'label'=>'发布人',
//                'label_width'=>120,
//                'type'=>'text',
//                'default'=>'-1',
//                'row_hide'=>'true',
//            ),
//            'add_time'=>array(
//                'label'=>'添加时间',
//                'label_width'=>120,
//                'type'=>'text',
//                'default'=>date('Y-m-d H:i:s'),
//                'row_hide'=>'true',
//            ),
            
        );
    }
}
