<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class SellCategoryModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'sell_category';
        $this->type = 1;
        $this->title = '经营分类';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
                    'title' => array(
                'label' => '分类名',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '名称必须填写'
                ),
            ),
            'pid' => array(
                'label' => '父分类',
                'label_width' => 150,
                'type' => 'hidden',
                'default' => IGet('pid'),
                'row_hide' => true,
                'valtype' => 'int',
            ),
            'allow' => array(
                'label' => '是否启用',
                'label_width' => 150,
                'type' => 'bool',
                'default' => 1
            ),

        );
    }
}