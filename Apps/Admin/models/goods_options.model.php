<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class GoodsOptionsModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'goods_options';
        $this->type = 1;
        $this->title = '商品规格';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'merchant_id' => array(
                'label' => '商户id',
                'label_width' => 150,
                'type' => 'digits',
                'value' => IGet('mid'),
                'row_hide' => true
            ),
            'goods_id' => array(
                'label' => '商品id',
                'label_width' => 150,
                'type' => 'digits',
                'value'=>IGet('gid'),
                'row_hide' => true
            ),
            'name' => array(
                'label' => '规格名',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true
                )
            ),
            'price' => array(
                'label' => '规格价格',
                'label_width' => 150,
                'type' => 'number',
                'default' => '0',
                'data_val' => array(
                    'required' => true
                )
            ),
            'stock' => array(
                'label' => '库存',
                'label_width' => 150,
                'type' => 'digits',
                'data_val' => array(
                    'required' => true
                ),
                'default' => -1
            ),
            'sort' => array(
                'label' => '排序',
                'label_width' => 150,
                'type' => 'digits',
                'data_val' => array(
                    'required' => true
                ),
                'default' => $this->getNextSort(),
            ),

        );
    }
}