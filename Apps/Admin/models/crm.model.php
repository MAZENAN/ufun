<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class CrmModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'order';
        $this->type = 1;
        $this->title = '销售审核';
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
            'need_topay' => array(
                'label' => '费用',
                'label_width' => 200,
                'type' => 'label',
                'follow_text' => '元',
                'dbfield' => false,
            ),
            'yifu' => array(
                'label' => '已付金额',
                'label_width' => 200,
                'type' => 'text',
                'style'=>'width:102px;',
                'follow_text' => '元',
                'data_val' => array(
                    'required' => true,
                    'min'=>1,
                    'number' => true,
                ),
                'data_val_msg' => array(
                    'required' => '已付金额不能为空',
                ),
            ),
            

        'paytype1' => array (
          'label' => '付款方式',
          'label_width' => 200,
          'type' => 'select',
          'options' => array (
                  0 => 
                  array (
                    0 => '微店',
                    1 => '微店',
                  ),
                  1 => 
                  array (
                    0 => '微信',
                    1 => '微信',
                  ),
                  2 => 
                  array (
                    0 => '支付宝',
                    1 => '支付宝',
                  ),
                  3 => 
                  array (
                    0 => '银行转账',
                    1 => '银行转账',
                  ),
                  4 => 
                  array (
                    0 => '其它',
                    1 => '其它',
                  ),
          ),
          'data_val' => array(
              'required' => true,
          ),
          'data_val_msg' => array(
              'required' => '请选择付款方式',
          ),
          'header' => array(
              0 => '',
              1 => '选择付款方式',
          ),
        ),

         'manage_id' => array(
                'label' => '课程顾问',
                'label_width' => 200,
                'type' => 'select',
                'options' => DB::getOpts('@pf_manage','id,name',0,"type in(7,12,13) and islock = 0"),
                'style'=>"width:108px;",
                'header' => array(
                    0 => '',
                    1 => '选择课程顾问',
                ),
                'data_val' => array(
                    'required' => true,
                ),
                 'data_val_msg' => array(
                  'required' => '请选择课程顾问',
                ),
            ),
            'ct2_name' => array(
                'label' => '付款人',
                'label_width' => 200,
                'type' => 'text',
                'style'=>"width:108px;",
                'data_val' => array(
                    'required' => true,
                ),
                 'data_val_msg' => array(
                  'required' => '付款人不能为空',
                ),
            ),
          'adddate' => array(
                'label' => '审核时间',
                'label_width' => 200,
                'type' => 'datetime',
                'close' => true,
                'data_val' => array(
                    'required' => true,
                ),

                 'data_val_msg' => array(
                  'required' => '审核时间不能为空',
                ),
                'default' =>date('Y-m-d H:i:s'),
            ),
          'adddate1' => array(               
                'row_hide' => true,
            ),
            'payremark1' => array (
                'label' => '核实付款备注',
                'label_width' => 200,
                'type' => 'textarea',
                'tip_front' => '备注如 付款人姓名，付款账号，付款流水号 等信息。 ',
               
                ),


          'check_status'=>array(
                'label' => '审核状态',
                'label_width' => 200,
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
                'label_width' => 200,
                'type' => 'textarea',
                'data_val' => array(
                    'required' => true,
                ),
                 'data_val_msg' => array(
                  'required' => '请填写未通过原因',
              ),
            ),


         
        );
    }
}
