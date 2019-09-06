<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class CocoModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'goods_spec';
        $this->type = 1;
        $this->title = 'COCO规格';
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
                'value'=>IGet('gid'),
                'row_hide' => true,
                'data_val' => array(
                    'required' => true
                )
            ),
//            '规格' => array(
//                'label' => '规格',
//                'label_width' => 200,
//                'type' => 'checkgroup',
//                'tab' => 'delivery',
//                'options' => array(
//
////                    0 => array(
////                        0 => '中杯',
////                        1 => '中杯'
////                    ),
////                    1 => array(
////                        0 => '大杯',
////                        1 => '大杯'
////                    ),
//                ),
//
//            ),
            'mid_price' => array(
                'label' => '规格',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'base',
                'follow_text' => '元',
                'data_val' => array(
                    'number' => true,
                    'min' => '0.00'
                ),
                'data_val_msg' => array(
                ),
                'default' => '0.00',
                '@minititle' => '中杯价格：'
            ),
            'big_price' => array(
                'label' => '大杯价格',
                'label_width' => 300,
                'type' => 'number',
                'tab' => 'base',
                'follow_text' => '元',
                'data_val' => array(
                    'number' => true,
                    'min' => '0.00'
                ),
                'data_val_msg' => array(
                ),
                'default' => '0.00',
                'merge' => true,
                'merge_type' => '1',
            ),

            'jia_liao' => array(
                'label' => '加料',
                'label_width' => 200,
                'type' => 'checkgroup',
                'tab' => 'delivery',
                'options' => array(
                    0 => array(
                        0 => 'X',
                        1 => 'X'
                    ),
                    1 => array(
                        0 => '珍珠',
                        1 => '珍珠'
                    ),
                    3 => array(
                        0 => '椰果',
                        1 => '椰果'
                    ),
                    4 => array(
                        0 => '红豆',
                        1 => '红豆'
                    ),
                    5 => array(
                        0 => '布丁',
                        1 => '布丁'
                    ),
                    6 => array(
                        0 => '西米',
                        1 => '西米'
                    ),
                    7 => array(
                        0 => '仙草',
                        1 => '仙草'
                    ),
                ),

            ),
            'wen_du' => array(
                'label' => '温度',
                'label_width' => 200,
                'type' => 'checkgroup',
                'tab' => 'delivery',
                'options' => array(
                    0 => array(
                        0 => '全冰',
                        1 => '全冰'
                    ),
                    1 => array(
                        0 => '多冰',
                        1 => '多冰'
                    ),
                    3 => array(
                        0 => '去冰',
                        1 => '去冰'
                    ),
                    4 => array(
                        0 => '热',
                        1 => '热'
                    ),

                ),

            ),
            'tang_du' => array(
                'label' => '糖度',
                'label_width' => 200,
                'type' => 'checkgroup',
                'tab' => 'delivery',
                'options' => array(
                    0 => array(
                        0 => '全糖',
                        1 => '全糖'
                    ),
                    1 => array(
                        0 => '半糖',
                        1 => '半糖'
                    ),
                    3 => array(
                        0 => '微糖',
                        1 => '微糖'
                    ),
                    4 => array(
                        0 => '无糖',
                        1 => '无糖'
                    ),

                ),

            ),
        );


    }
}