<?php


if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');


 class CouponsModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'coupons';
        $this->type = 1;
        $this->title = '优惠券';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;

        parent::__construct($modeltype);
    }


     public function fields() {
        return array(
                    
//            'title' => array(
//                 'label' => '标题',
//                'label_width' => 130,
//                'type' => 'text',
//                'type' => 'text',
//                 'data_val' => array(
//                    'required' => true,
//                ),
//                'data_val_msg' => array(
//                    'required' => '标题不能为空',
//                ),
//            
//            ),
            'coupon' => array(
                 'label' => '优惠券金额',
                'label_width' => 130,
                'type' => 'text',
//                 'data_val' => array(
//                  	'required' => true,
//                        'min'=>1,
//                ),
//                'data_val_msg' => array(
//                    'required' => '优惠券金额不能为空',
//                    'min'=>'优惠券金额不能为0',
//                ),
            ),
//            'type' => array(
//                 'label' => '优惠券类型',
//                'label_width' => 130,
//                'default'=>'1',
//                'type' => 'select',
//                'options' => array(
//                    0 =>
//                    array(
//                        0 => '0',
//                        1 => '不可分享  ',
//                    ),
//                    1 =>
//                    array(
//                        0 => '1',
//                        1 => '可分享  ',
//                    ),
//                ),
//            ),
//            'addtime' => array(
//                 'label' => '添加日期',
//                'label_width' => 130,
//                'type' => 'label',
//                'dbfield' => false,
//            ),
             'scope' => array(
                 'label' => '最低订单金额',
                'label_width' => 130,
                'type' => 'text',
//                'data_val' => array(
//                  	'required' => true,
//                ),
//                'data_val_msg' => array(
//                    'required' => '最低订单金额不能为空',
//                ),
            ),
             'starttime' => array(
                 'label' => '开始时间',
                'label_width' => 130,
                'type' => 'datetime',

            ),
            'deadline' => array(
                 'label' => '到期时间',
                'label_width' => 130,
                'type' => 'datetime',

            ),
            
             'camp_id' => array(
                 'label' => '可用活动',
                'label_width' => 130,
                'type' => 'text',
            ),
             'pack_id' => array(
                 'label' => '所属礼包id',
                'label_width' => 130,
                'type' => 'text',
                'row_hide'=>'ture',
            ),
            'allow' => array(
                'label' => '上下架',
                'label_width' => 130,
                'defalut' => '0',
                'row_hide'=>'ture',
            ),
    	);
  	}
 }