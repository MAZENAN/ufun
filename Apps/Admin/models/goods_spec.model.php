<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class GoodsSpecModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'goods_spec';
        $this->type = 1;
        $this->title = '规格';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        $this->script = '$(function(){
        var fun = function(){
                    var pid = $("#pid").val()
                    if(pid==0){
                        $("#row_price").hide()
                        $("#row_stock").hide()
                    }else{
                        $("#row_price").show()
                        $("#row_stock").show()
                    }
                };
            $("#pid").change(
                fun
            )
        })';
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'goods_id' => array(
                'label' => '商品id',
                'label_width' => 150,
                'type' => 'text',
                'row_hide' => true,
                'data_val' => array(
                    'required' => true
                )
            ),
            'title' => array(
                'label' => '名称',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '请填写规格名'
                ),
            ),
            'pid' => array(
                'label' => '所属规格',
                'label_width' => 150,
                'type' => 'select',
                'data_val' => array(
                    'required' => true
                ),
                'header' => array(
                    0 => '0',
                    1 => '规格名称',
                ),
                'dynamic' => array(
                    array (
                        'val' => '0',
                        'hide' => 'price|stock',
                        'show' => 'required'
                    )
                )
            ),
            'price' => array(
                'label' => '商品价格',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'info',
                'follow_text' => '元',
                'data_val' => array(
                    'number' => true,
                    'min' => '0.00',
                    'required' => true
                ),
                'data_val_msg' => array(
                ),
                'default' => '0.00'
            ),
            'stock' => array(
                'label' => '库存',
                'label_width' => 150,
                'type' => 'digits',
                'tab' => 'info',
                'data_val' => array(
                    'digits' => true,
                    'min' => '0',
                    'required' => true
                ),
                'default' => '0'
            ),
            'sort' => array(
                'label' => '排序',
                'label_width' => 150,
                'type' => 'digits',
                'default' => $this->getNextSort(),
                'data_val' => array (
                    'required' => true,
                    'digits' => true,
                 )
            ),
            'allow' => array(
                'label' => '是否启用',
                'label_width' => 150,
                'type' => 'bool',
                'default' => 1
            ),
//            'required' => array(
//                'label' => '是否必选',
//                'label_width' => 150,
//                'type' => 'bool',
//                'default' => 1,
//                'row_hide' => true
//            ),


        );
    }
}