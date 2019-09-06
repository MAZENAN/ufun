<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class TagIndexModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'tag_index';
        $this->type = 1;
        $this->title = '小程序首页标签';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'title' => array(
                'label' => '名称',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true
                )
            ),
            'img' => array(
                'label' => '图片',
                'label_width' => 150,
                'type' => 'upimg',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '请上传图片'
                ),
            ),
//            'type' => array(
//                'label' => '类型',
//                'label_width' => 150,
//                'type' => 'select',
//                'options' => array(
//                    array(
//                        '0',
//                        '商品'
//                    ),
//                    array(
//                        '1',
//                        '商铺'
//                    )
//                ),
//                'header' => array(
//                    '',
//                    '请选择'
//                ),
//                'data_val' => array(
//                    'required' => true
//                ),
//                'data_val_msg' => array(
//                ),
//                'dynamic' => array(
//                    array(
//                        'val' => 0,
//                        'hide' => 'merchant_id'
//                    ),
//                    array(
//                        'val' => 1,
//                        'show' => 'merchant_id'
//                    )
//                ),
//                'default' => 0
//            ),
//            'merchant_id' => array(
//                'label' => '商家',
//                'label_width' => 150,
//                'type' => 'select',
//                'tip_back' => '只能关联一个自营类型店铺，没有请去添加！',
//                'options' => DB::getopts('@pf_merchant','id,name',0,'status=1 AND type=1'),
//                'header' => array(
//                    0 => '',
//                    1 => '请选择',
//                ),
//                'data_val' => array(
//                    'required' => true
//                ),
//                'data_val_msg' => array(
//                    'required' => '请选择店铺'
//                ),
//            ),
            'sort' => array(
                'label' => '排序',
                'label_width' => 150,
                'type' => 'digits',
                'default' => $this->getNextSort(),
                'data_val' => array (
                    'required' => true,
                    'digits' => true,
                ),
                'data_val_msg' => array (
                    'required' => '排序不能为空',
                    'digits' => '排序必须是整数形式',
                ),
            ),
            'allow' => array(
                'label' => '是否启用',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
                'default' => 1
            ),

        );
    }
}