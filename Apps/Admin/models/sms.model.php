<?php

if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

//发送短信 刘斯玉 9月7
class SmsModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_EDIT) {

        $this->tbname = 'sms';
        $this->type = 1;
        $this->title = '群发短信';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }

    public function fields() {
        return array(
            'money' => array(
                'label' => '短信余额',
                'label_width' => 200,
                'type' => 'label',
            ),
            'reply' => array(
                'label' => '回复类型',
                'label_width' => 200,
                'type' => 'radiogroup',
                'options' => array(
                    0 =>
                    array(
                        0 => '1',
                        1 => '给会员群发',
                    ),
                    1 =>
                    array(
                        0 => '2',
                        1 => '自定义群发',
                    ),
                ),
                'default' => '1',
                'dynamic' => array(
                    0 =>
                    array(
                        'val' => '1',
                        'hide' => 'mobile',
                        'show' => '',
                    ),
                    1 =>
                    array(
                        'val' => '2',
                        'show' => 'mobile',
                    ),
                ),
            ),
            'mobile' => array(
                'label' => '手机号码（以英文逗号分隔）',
                'label_width' => 200,
                'type' => 'textarea',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '手机号码不能为空',
                ),
            ),
            'content' => array(
                'label' => '短信内容',
                'label_width' => 200,
                'type' => 'textarea',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '关键词不能为空',
                ),
            ),
        );
    }

}
