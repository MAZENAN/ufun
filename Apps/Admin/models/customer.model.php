<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class CustomerModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'customer';
        $this->type = 1;
        $this->title = '客服中心';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'sina_weibo' => array (
'label' => '新浪微博',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '新浪微博不能为空',
),
),
'tencent_weibo' => array (
'label' => '腾讯微博',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '腾讯微博不能为空',
),
),
'weixin' => array (
'label' => '官方微信',
'label_width' => 200,
'type' => 'upimg',
'img_width' => 300,
'img_height' => 200,
'extensions' => 'jpg,jpeg,gif,png',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '官方微信不能为空',
),
),
'tel' => array (
'label' => '联系电话',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '联系电话不能为空',
),
),
'work' => array (
'label' => '工作时间',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '工作时间不能为空',
),
),

        );
    }
}
