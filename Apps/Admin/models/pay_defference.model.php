<?php
if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class Pay_defferenceModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'order';
        $this->type = 1;
        $this->title = '退补差价审核';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        $this->incscriptfiles = ['/public/js/admin/radio_check.js'];
        parent::__construct($modeltype);
    }

    public function fields() {
        return array(
            'orderid' => array(
                'label' => '订单编号',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'style' => 'font-size:14px; color:#9B410E;',
            ),
            'title' => array(
                'label' => '产品名称',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
            ),
            'departure_option' => array(
                'label' => '出发日期',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
            ),
            'need_topay' => array(
                'label' => '费用',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'follow_text' => '元',

            ),
            'paid' => array(
                'label' => '已付金额',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'follow_text' => '元',

            ),
            'corr_fees_type' => array (
                'label' => '退补差价类型',
                'label_width' => 200,
                'type' => 'select',
                'options' => array(
                    0 =>
                    array(
                        0 => '1',
                        1 => '补差价  ',
                    ),
                    1 =>
                    array(
                        0 => '0',
                        1 => '退差价  ',
                    ),
                ),
            //ysq
            'default' => '0',
            ),
            'corr_fees' => array (
                'label' => '退补金额',
                'label_width' => 200,
                'type' => 'number',
                'data_val' => array (
                  'money' => true,
                  'required' => true,
                ),
                'data_val_msg' => array (
                  'money' => '退补金额格式错误',
                  'required' => '退补金额不能为空',
                ),
                'follow_text' => '元',

            ),

            'check_status' => array (
                  'label' => '退补差价审核',
                  'label_width' => 200,
                  'type' => 'radiogroup',
                  'options' => array (
                          0 => 
                          array (
                            0 => '9',
                            1 => '通过',
                          ),
                          1 => 
                          array (
                            0 => '0',
                            1 => '未通过',
                          ),
                  ),
                  'default'=>'9',
                  'dynamic' => array (
                      0 => 
                      array (
                        'val' => '0',
                        'show' => 'log',
                        
                      ),
                       1 => 
                      array (
                        'val' => '9',
                        'hide' => 'log',
                        
                      ),
                      2 => 
                      array (
                        'val' => '10',
                        'hide' => 'log',
                        
                      ),
                    ),
            ),
            'log' => array(
                'label' => '审核未通过原因',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '审核未通过原因不能为空',
                ),
            ),
            
        );
    }

}
