<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class ArticleModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'article';
        $this->type = 1;
        $this->title = '文章';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'title' => array(
                'label' => '标题',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true,
                    'maxlength' => 255
                ),
                'data_val_msg' => array(
                    'maxlength' => '长度不能超过{0}个'
                )
            ),
            'content' => array(
                'label' => '正文',
                'label_width' => 150,
                'type' => 'ueditor',
                'data_val' => array(
                    'required' => true,
                )
            ),
            'add_time' => array(
                'label' => '添加时间',
                'label_width' => 150,
                'type' => 'datetime',
                'default' => date('Y-m-d H:i:s'),
                'row_hide' => true
            ),
            'school_id' => array(
                'label' => '学校id',
                'label_width' => 150,
                'type' => 'digits',
                'data_val' => array(
                    'required' => true,
                ),
                'row_hide' => true
            ),

        );
    }
}