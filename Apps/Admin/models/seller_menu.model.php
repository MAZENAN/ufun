<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class SellerMenuModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'seller_menu';
        $this->type = 1;
        $this->title = '商品分类';
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
                'tip_back' => '<span class="red">*</span>必填',
                'data_val' => array(
                    'required' => true,
                    'maxlength' => '20'
                ),
                'data_val_msg' => array(
                    'required' => '分类名必填',
                    'maxlength' => '不能超过{0}个字符'
                ),
            ),
//            'description' => array(
//                'label' => '描述',
//                'label_width' => 150,
//                'type' => 'textarea',
//                'data_val' => array(
//                    'maxlength' => '255'
//                ),
//                'data_val_msg' => array(
//                    'maxlength' => '不能超过{0}个字符'
//                ),
//            ),
//            'icon' => array( //TODO 尺寸
//                'label' => 'icon',
//                'label_width' => 150,
//                'type' => 'upimg',
//                'tab'=>'base',
//                'img_width' => 100,
//                'img_height' => 100,
//                'extensions' => 'jpg,jpeg,gif,png',
//            ),
            'add_time' => array(
                'label' => '创建时间',
                'label_width' => 150,
                'type' => 'datetime',
                'default' => date('Y-m-d H:i:s'),
                'row_hide' => true
            ),
            'sort' => array(
                'label' => '排序',
                'label_width' => 150,
                'type' => 'digits',
                'default' => $this->getNextSort(),
            ),
            'allow' => array (
                'label' => '是否启用',
                'label_width' => 150,
                'type' => 'bool',
                'default' => '1',
            ),
            'merchant_id' => array(
                'label' => '商户id',
                'label_width' => 150,
                'type' => 'text',
                'row_hide' => true,
                'data_val' => array(
                    'required' => true
                )
            ),
        );
    }
}