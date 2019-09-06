<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class LemonModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'goods_spec';
        $this->type = 1;
        $this->title = '快乐柠檬模板';
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

            'material' => array(
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
                        0 => 'Q果',
                        1 => 'Q果'
                    ),
                    2 => array(
                        0 => '红豆',
                        1 => '红豆'
                    ),
                    3 => array(
                        0 => 'OREO',
                        1 => 'OREO'
                    ),

                    4 => array(
                        0 => '珍珠',
                        1 => '珍珠'
                    ),

                    5 => array(
                        0 => '布丁',
                        1 => '布丁'
                    ),
                    6 => array(
                        0 => '芋圆',
                        1 => '芋圆'
                    ),
                    7 => array(
                        0 => '芝士',
                        1 => '芝士'
                    ),
                    8 => array(
                        0 => '轻奶霜',
                        1 => '轻奶霜'
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
                        0 => '多冰',
                        1 => '多冰'
                    ),
                    1 => array(
                        0 => '全冰',
                        1 => '全冰'
                    ),
                    3 => array(
                        0 => '少冰',
                        1 => '少冰'
                    ),
                    4 => array(
                        0 => '去冰',
                        1 => '去冰'
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