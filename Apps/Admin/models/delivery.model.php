<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class DeliveryModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'delivery';
        $this->type = 1;
        $this->title = '配送时间';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        $this->script = '
         $(function() {$("#noon_stop_time").timepicker({timeFormat: \'HH:mm\'});});
         $(function() {$("#pm_stop_time").timepicker({timeFormat: \'HH:mm\'});});
        ';
        parent::__construct($modeltype);
    }
    public function fields() {
        $merchant_id = IGet('merchant_id');
        
        return array(
            'merchant_id' => array(
                'label' => '商户id',
                'label_width' => 150,
                'type' => 'digits',
                'row_hide' => true
            ),
            'week' => array(
                'label' => '星期',
                'label_width' => 150,
                'type' => 'select',
                'data_val' => array(
                    'required' => true,
                    'remote' => array(
                        array(
                            0 => '/admin/delivery/check?merchant_id=' . $merchant_id,
                        )
                    ),
                ),
                'data_val_msg' => array(
                    'remote' => '已存在当天配送信息'
                ),
                'options' => array(
                    array(
                        1,
                        '星期一'
                    ),
                    array(
                        2,
                        '星期二'
                    ),
                    array(
                        3,
                        '星期三'
                    ),
                    array(
                        4,
                        '星期四'
                    ),
                    array(
                        5,
                        '星期五'
                    ),
                    array(
                        6,
                        '星期六'
                    ),
                    array(
                        7,
                        '星期日'
                    ),
                ),
                'header' => array(
                    '',
                    '请选择'
                ),
                'offedit' => true
            ),
            'is_noon' => array(
                'label' => '是否支持中午配送',
                'label_width' => 150,
                'type' => 'radiogroup',
                'options' => array(
                    array(
                        1,
                        '支持'
                    ),
                    array(
                        0,
                        '不支持'
                    )
                ),
                'default' => 1,
                'dynamic' => array(
                    array(
                        'val' => '0',
                        'hide' => 'noon_stop_time|noon_order_nums',
                    ),
                    array(
                        'val' => '1',
                        'show' => 'noon_stop_time|noon_order_nums',
                    )
                )
            ),
            'noon_stop_time' => array(
                'label' => '中午截单时间',
                'label_width' => 150,
                'type' => 'datetime',
                'default' => '11:00',
                'data_val' =>array(
                    'required' => true
                )
            ),
            'noon_order_nums' => array(
                'label' => '中午截单量',
                'label_width' => 150,
                'type' => 'digits',
                'default' => '30',
                'data_val' =>array(
                    'digits' => true,
                    'min' => 0,
                )
            ),
            'is_pm' => array(
                'label' => '是否支持下午配送',
                'label_width' => 150,
                'type' => 'radiogroup',
                'options' => array(
                    array(
                        1,
                        '支持'
                    ),
                    array(
                        0,
                        '不支持'
                    )
                ),
                'default' => 1,
                'dynamic' => array(
                    array(
                        'val' => '0',
                        'hide' => 'pm_stop_time|pm_order_nums',
                    ),
                    array(
                        'val' => '1',
                        'show' => 'pm_stop_time|pm_order_nums',
                    )
                )
            ),
            'pm_stop_time' => array(
                'label' => '下午截单时间',
                'label_width' => 150,
                'type' => 'datetime',
                'default' => '17:00',
                'data_val' =>array(
                    'required' => true
                )
            ),
            'pm_order_nums' => array(
            'label' => '下午截单量',
            'label_width' => 150,
            'type' => 'digits',
            'default' => '60',
            'data_val' =>array(
                'digits' => true,
                'min' => 0,
                'default' => '60'
            )
        ),

        );
    }
}