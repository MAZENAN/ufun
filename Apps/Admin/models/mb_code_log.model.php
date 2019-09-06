<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class MbCodeLogModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'mbcodelog';
        $this->type = 1;
        $this->title = '短信日志';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'mobile' => array (
'label' => '手机号码',
'label_width' => 200,
'type' => 'text',
),
'mbcode' => array (
'label' => '验证码',
'label_width' => 200,
'type' => 'text',
),
'ip' => array (
'label' => 'ip',
'label_width' => 200,
'type' => 'text',
),
'addtime' => array (
'label' => '添加时间',
'label_width' => 200,
'type' => 'digits',
),

        );
    }
}
