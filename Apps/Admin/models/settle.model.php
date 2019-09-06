<?php

if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class SettleModel extends SmcmsModel{
	 public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'order';
        $this->type = 1;
        $this->title = '';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        $this->incscriptfiles = ['/public/js/admin/radio_check.js'];

        parent::__construct($modeltype);
    }

    public function fields() {
        return array(

	        'seller_id' => array(
	            'label' => '所属供应商',
	            'label_width' => 150,
	            'type' => 'select',
	            'options' => DB::getopts('@pf_member','id,nickname',0,"type in(3,4) and status=2 order by nickname asc"),
	            'valtype' => 'int',
	            'tab' => 'base',
	            'header' => array(
	                0 => '',
	                1 => '选择供应商',
	            ),
	        ),
	        'nickname'=>array(
	        	'label'=>'供应商名称',
	       	 	'label_width' => 150,
	       		'type' => 'label',
	        ),
	       'title'=>array(
		       	'label'=>'产品名称',
		       	 'label_width' => 150,
		       	'type' => 'label',
	       	),
	       'paid'=>array(
	       		'label'=>'已付费用',
	       		'label_width' => 150,
	       		'type' => 'label',
            'follow_text' => '元',
	       	),
	       	'scommision'=>array(
	       		'label'=>'结算费用',
	       		'label_width' => 150,
	       		'style'=>'width:100px',
	       		'type' => 'text',
            'follow_text' => '元',
            'data_val' => array(
                'required' => true,
            ),
            'data_val_msg' => array(
                'required' => '请填写结算费用',
            ),

	       	),

	       	'key'=>array(
	       		'label'=>'url参数',
	       		'row_hide'=>true,
	       	),

	       	'check_status'=>array(
                'label' => '审核状态',
                'label_width' => 150,
                'type' => 'radiogroup',
                //'style' => 'width:90px;',
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
                'default' => '1',
            'dynamic' => array (
              0 => 
              array (
                'val' => '1',
                'hide' => 'error_log',
                
              ),
              1 => 
              array (
                'val' => '0',
                'show' => 'error_log',
              ),
              
            ),
            ),

         'error_log' => array(
                'label' => '审核未通过原因',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                    'required' => true,
                ),
                 'data_val_msg' => array(
                  'required' => '请填写未通过原因',
              ),
            ),
         'settle_remark' => array(
                'label' => '结算备注',
                'label_width' => 150,
                'type' => 'textarea',
            ),
        );
    }

}