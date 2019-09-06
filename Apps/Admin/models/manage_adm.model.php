<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class ManageAdmModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'manage';
        $this->type = 1;
        $this->title = '管理资料修改';
        $this->toptip = '修改账号密码信息。';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'name' => array (
'label' => '用户名',
'label_width' => 200,
'type' => 'label',
'dbfield' => false,
'offedit' => true,
'data_val' => array (
  'required' => true,
),
),
'oldpass' => array (
'label' => '输入旧密码',
'label_width' => 200,
'type' => 'password',
'dbfield' => false,
'tip_back' => '请输入旧密码',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '旧密码不能为空',
),
),
'pwd' => array (
'label' => '用户密码',
'label_width' => 200,
'type' => 'password',
'tip_back' => '请输入新密码，并牢记您的密码！',
'data_val' => array (
  'required' => true,
),
),
'cfmpass' => array (
'label' => '再次输入密码',
'label_width' => 200,
'type' => 'password',
'dbfield' => false,
'tip_back' => '再一次输入新密码！',
'data_val' => array (
  'required' => true,
  'equalTo' => '#pwd',
),
'data_val_msg' => array (
  'required' => '确认密码不能为空',
  'equalTo' => '两次输入密码不一致',
),
),

        );
    }
}
