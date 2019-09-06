<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class ConfigModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'config';
        $this->type = 1;
        $this->title = '系统设置';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'website_name' => array (
'label' => '网站名称',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '网站名称不能为空',
),
),
'description' => array (
'label' => '网站描述',
'label_width' => 200,
'type' => 'textarea',
),
'keywords' => array (
'label' => '关键词',
'label_width' => 200,
'type' => 'textarea',
),
'copyright' => array (
'label' => '版权信息',
'label_width' => 200,
'type' => 'textarea',
),
'keep' => array (
'label' => '备案号',
'label_width' => 200,
'type' => 'text',
),

        );
    }
}
