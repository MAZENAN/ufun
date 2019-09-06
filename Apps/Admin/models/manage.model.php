<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class ManageModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'manage';
        $this->type = 1;
        $this->title = '管理员';
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
'type' => 'text',
'data_val' => array (
  'required' => true,
),
),
'pwd' => array (
'label' => '用户密码',
'label_width' => 200,
'type' => 'password',
),
'type' => array (
'label' => '管理员类型',
'label_width' => 200,
'type' => 'select',
'options' => DB::getopts('@pf_group'),
'valtype' => 'int',
),
'errtice' => array (
'label' => '错误次数',
'label_width' => 200,
'type' => 'digits',
'close' => true,
),
'errtime' => array (
'label' => '错误时间',
'label_width' => 200,
'type' => 'date',
'close' => true,
),
'thistime' => array (
'label' => '本次登录时间',
'label_width' => 200,
'type' => 'datetime',
'close' => true,
),
'lasttime' => array (
'label' => '最后登录时间',
'label_width' => 200,
'type' => 'datetime',
'close' => true,
),
'thisip' => array (
'label' => '本次登录IP',
'label_width' => 200,
'type' => 'text',
'close' => true,
),
'lastip' => array (
'label' => '最后一次登录IP',
'label_width' => 200,
'type' => 'text',
'close' => true,
),
'islock' => array (
'label' => '是否锁定账号',
'label_width' => 200,
'type' => 'bool',
),
'email' => array (
'label' => '管理员邮箱',
'label_width' => 200,
'type' => 'text',
),

        );
    }
}
