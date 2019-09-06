<?php


if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');


 class CouponPacksModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'coupon_packs';
        $this->type = 1;
        $this->title = '优惠券大礼包';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;

        parent::__construct($modeltype);
    }


     public function fields() {
        return array(
                    
            'title' => array(
                 'label' => '标题',
                'label_width' => 130,
                'type' => 'text',
                 'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '标题不能为空',
                ),
            
            ),
                    
            'img' => array(
                 'label' => '推荐图',
                'label_width' => 130,
                'type' => 'upimg',
                'img_width' => 300,
                'img_height' => 200,
                'extensions' => 'jpg,jpeg,gif,png',
                 'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '推荐图不能为空',
                ),
            
            ),
                    
            'pack_explain' => array(
                 'label' => '礼包说明',
                'label_width' => 130,
                'type' => 'textarea',
                
            ),
                    
            'use_explain' => array(
                 'label' => '使用说明',
                'label_width' => 130,
                'type' => 'textarea',

            ),
             'button_text' => array(
                 'label' => '立即使用按钮文字',
                'label_width' => 130,
                'type' => 'text',
                 'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '立即使用按钮文字不能为空',
                ),

            ),
            'url' => array(
                'label' => '立即使用url',
                'label_width' => 130,
                'type' => 'text',
                'tip_back' => "已有前缀: m.51camp.cn/",
            
            ),
                    
            'total_amount' => array(
                 'label' => '优惠总金额',
                'label_width' => 130,
                'type' => 'text',
                 'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '总金额不能为空',
                ),
            
            ),
        'is_top' => array(
                'label' => '是否推荐',
                'label_width' => 130,
                'type' => 'bool',
                'follow_text' => '推荐至官网首页',
            ),
            
            //优惠券
               'coupon' => array(
                 'label' => '优惠券金额',
                'label_width' => 130,
                'type' => 'text',
                'close'=>true,
                  
            ),

             'scope' => array(
                 'label' => '最低订单金额',
                'label_width' => 130,
                'type' => 'text',
                 'close'=>true,

            ),
             'starttime' => array(
                 'label' => '开始时间',
                'label_width' => 130,
                'type' => 'datetime',
                'close'=>true,

            ),
            'deadline' => array(
                 'label' => '到期时间',
                'label_width' => 130,
                'type' => 'datetime',
                'close'=>true,

            ),
            
             'camp_id' => array(
                 'label' => '可用活动',
                'label_width' => 130,
                'type' => 'text',
                 'close'=>true,
            ),
             'pack_id' => array(
                 'label' => '所属礼包id',
                'label_width' => 130,
                'type' => 'text',
                'row_hide'=>'ture',
                 'close'=>true,
            ),
            'allow' => array(
                'label' => '上下架',
                'label_width' => 130,
                'defalut' => '0',
                'row_hide'=>'ture',
                'close'=>true,
            ),
    	);
  	}
 }