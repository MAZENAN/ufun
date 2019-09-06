<?php
if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class TopayModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'order';
        $this->type = 1;
        $this->title = '修改订单金额';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
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
                'label' => '项目名称',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
            ),
            'money' => array(
                'label' => '应付金额',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'style' => 'font-size:14px; color:  #F80;',
            ),
            'topay' => array(
                'label' => '费用',
                'label_width' => 200,
                'type' => 'number',
                'data_val' => array(
                    'required' => true,
                    'number' => true,
                    'min' => '0.01'
                ),
                'data_val_msg' => array(
                    'required' => '费用不能为空',
                ),
                'follow_text' => '元',
                'data_valmsg_for' => '#cost_info',
            ),
        );
    }

}
