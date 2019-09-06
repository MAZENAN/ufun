<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class EditEmailbModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'member';
        $this->type = 1;
        $this->title = '修改邮箱';
        $this->istab = false;
        $this->tabsplit = false;
        $this->basecontroler = 'SamaoToolController';
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'email' => array (
'label' => '新电子邮箱',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
  'email' => true,
  'remote' => 
  array (
    0 => '/notive/chkemail.html',
    1 => 'POST',
  ),
),
'data_val_msg' => array (
  'required' => '新电子邮箱不能为空',
  'email' => '新电子邮箱格式不正确',
  'remote' => '新电子邮箱已经存在，请更换其他新电子邮箱',
),
),

        );
    }
}
