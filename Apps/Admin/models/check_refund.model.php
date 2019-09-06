<?php
if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class Check_refundModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'order';
        $this->type = 1;
        $this->title = '退款审核';
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
            'refund_fees' => array (
                'label' => '退款金额',
                'label_width' => 200,
                'type' => 'number',
                'data_val' => array (
                  'required' => true,
                  'money' => true,
                ),
                'data_val_msg' => array (
                  'required' => '退款金额不能为空',
                  'money' => '退款金额格式错误',
                ),
                'follow_text' => '元',

            ),
            'refund_reasons' => array (
                'label' => '退款理由',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
            ),
            
                'refund_remarks' => array (
                'label' => '核实退款备注',
                'label_width' => 200,
                'type' => 'textarea',
                'tip_front' => '备注如 付款人姓名，付款账号，付款流水号 等信息。 ',
                'data_val' => array (
                  'required' => true,
                ),
                'data_val_msg' => array (
                  'required' => '核实备注不能为空',
                ),
                ),
            'check_status' => array (
                  'label' => '退款审核',
                  'label_width' => 200,
                  'type' => 'radiogroup',
                  'options' => array (
                          0 => 
                          array (
                            0 => '1',
                            1 => '通过',
                          ),
                          1 => 
                          array (
                            0 => '0',
                            1 => '未通过',
                          ),
                  ),
                  'default'=>'1',
                  'dynamic' => array (
                      0 => 
                      array (
                        'val' => '0',
                        'show' => 'log',
                        
                      ),
                       1 => 
                      array (
                        'val' => '1',
                        'hide' => 'log',
                        
                      ),
                      2 => 
                      array (
                        'val' => '3',
                        'hide' => 'log',
                        
                      ),
                      3 => 
                      array (
                        'val' => '4',
                        'hide' => 'log',
                        
                      ),
                      4 => 
                      array (
                        'val' => '2',
                        'hide' => 'log',
                        
                      ),
                    ),
            ),
            'log' => array(
                'label' => '审核未通过原因',
                'label_width' => 200,
                'type' => 'textarea',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '审核未通过原因不能为空',
                ),
            ),
            'corr_fees_type' => array (
                'label' => '财务修正值类型',
                'label_width' => 200,
                'type' => 'select',
                'close'=>true,
                'options' => array(
                    0 =>
                    array(
                        0 => '1',
                        1 => '增加',
                    ),
                    1 =>
                    array(
                        0 => '0',
                        1 => '减少',
                    ),
                ),

            //ysq
            'default' => '0',
            ),
            'corr_fees' => array (
                'label' => '财务修正值',
                'label_width' => 200,
                'type' => 'number',
                'close'=>true,
                'data_val' => array (
                  'money' => true,
                ),
                'data_val_msg' => array (
                  'money' => '财务修正值格式错误',
                ),
                'follow_text' => '元',

            ),
        );
    }

}
