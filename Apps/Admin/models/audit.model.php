<?php
if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class AuditModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'withdraws_cash';
        $this->type = 1;
        $this->title = '分销商提现审核';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;

           

        parent::__construct($modeltype);
    }

    public function fields() {
        return array(
            'mobile' => array(
                'label' => '用户名',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'style' => 'font-size:14px; color:#9B410E;',
            ),
            'money' => array(
                'label' => '申请金额',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
            ),
            'applytime' => array(
                'label' => '申请时间',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'style' => 'font-size:14px;',
            ),
            'realname' => array(
                'label' => '真实姓名',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'style' => 'font-size:14px;',
            ),
            'state' => array(
                'label' => '审核状态',
                'label_width' => 200,
                'type' => 'select',
                'options' => array(
                    0 =>
                    array(
                        0 => '1',
                        1 => '申请通过',
                    ),
                    1 =>
                    array(
                        0 => '2',
                        1 => '申请失败',
                    ),
               
                ),
              
            
            'default' => '1',
            'dynamic' => array (
              0 => 
              array (
                'val' => '1',
                'hide' => 'failmark',
                
              ),
              1 => 
              array (
                'val' => '2',
                'show' => 'failmark',
              ),
              
            ),
         ),
            'failmark' => array(
                'label' => '失败理由',
                'label_width' => 200,
                'type' => 'textarea',
                'style' => 'width:300px; height:30px;',
                'close' => false,
               /* 'data_val' => array(
                    'required' => true,
                ),*/
            ),
        );
    }

}
