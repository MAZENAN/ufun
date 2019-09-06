<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class NoticeModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'notice';
        $this->type = 1;
        $this->title = '公告';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'title' => array(
                'label' => '公告名',
                'label_width' => 200,
                'type' => 'text',
                'data_val' => array(
                    'required' => true,
                    'maxlength' => 255
                ),
            ),
            'content' => array(
                'label' => '公告内容',
                'label_width' => 150,
                'type' => 'xheditor',
                'data_val' => array(
                    'required' => true,
                ),
            ),
            'notice_date' => array(
                'label' => '通知时间',
                'label_width' => 150,
                'type' => 'date',
                'data_val' => array(
                    'required' => true,
                ),
                'close' => true
            ),
            'allow' => array(
                'label' => '是否显示',
                'label_width' => 150,
                'type' => 'bool',
                'default' => '0'
            ),
            'type' => array(
                'label' => '类型',
                'label_width' => 150,
                'type' => 'select',
                'options' => array(
                    array(
                        '0',
                        '学校'
                    ),
                    array(
                        '1',
                        '店铺'
                    )
                ),
                'default' => '0',
                'row_hide' => true,
                'dynamic' => array(
                    0 =>
                        array(
                            'val' => '0',
                            'show' => 'title',
                        ),
                    1 =>
                        array(
                            'val' => '1',
                            'hide' => 'title',
                        ),
                )
            ),
            'merchant_id' => array(
                'label' => '店铺',
                'label_width' => 150,
                'type' => 'digits',
                'row_hide' => true
            ),
            'school_id' => array(
                'label' => '学校',
                'label_width' => 150,
                'type' => 'digits',
                'row_hide' => true
            ),
            'sort' => array(
                'label' => '排序值',
                'label_width' => 150,
                'type' => 'digits',
                'default' => $this->getNextSort(),
                'data_val' => array(
                    'required' => true
                ),
            ),
            'add_time' => array(
                'label' => '创建时间',
                'label_width' => 150,
                'type' => 'datetime',
                'default' => date('Y-m-d H:i:s'),
                'row_hide' => true
            ),
        );
    }
}