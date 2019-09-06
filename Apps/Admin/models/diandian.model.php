<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class DiandianModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'goods_spec';
        $this->type = 1;
        $this->title = '一点点模板';
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

            'material_free' => array(
                'label' => '免费配料',
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
                    2 => array(
                        0 => '波霸',
                        1 => '波霸'
                    ),
                    3 => array(
                        0 => '仙草',
                        1 => '仙草'
                    ),

                    4 => array(
                        0 => '椰果',
                        1 => '椰果'
                    ),

                    5 => array(
                        0 => '红豆',
                        1 => '红豆'
                    ),
                    6 => array(
                        0 => '珍波椰',
                        1 => '珍波椰'
                    ),
                    7 => array(
                        0 => '混珠×',
                        1 => '混珠×'
                    ),

                ),

            ),
            'material_charge' => array(
                'label' => '加价配料',
                'label_width' => 200,
                'type' => 'checkgroup',
                'tab' => 'delivery',
                'options' => array(
                    0 => array(
                        0 => 'X',
                        1 => 'X'
                    ),
                    1 => array(
                        0 => '布丁',
                        1 => '布丁'
                    ),
                    2 => array(
                        0 => '奶霜',
                        1 => '奶霜'
                    ),
                    3 => array(
                        0 => '燕麦',
                        1 => '燕麦'
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
                        0 => '少冰',
                        1 => '少冰'
                    ),
                    3 => array(
                        0 => '去冰',
                        1 => '去冰'
                    ),
                    4 => array(
                        0 => '常温',
                        1 => '常温'
                    ),
                    5 => array(
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
                        0 => '7分',
                        1 => '7分'
                    ),
                    3 => array(
                        0 => '5分',
                        1 => '5分'
                    ),
                    4 => array(
                        0 => '3分',
                        1 => '3分'
                    ),
                    5 => array(
                        0 => '无糖',
                        1 => '无糖'
                    ),

                ),

            ),
        );


    }
}