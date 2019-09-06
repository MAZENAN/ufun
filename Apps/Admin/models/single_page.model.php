<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class SinglePageModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'singlepage';
        $this->type = 1;
        $this->title = '单页文档';
        $this->istab = false;
        $this->tabsplit = false;
        $this->basecontroler = 'SmcmsController';
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'title' => array (
'label' => '标题',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '标题不能为空',
),
),
'key' => array (
'label' => '标识符',
'label_width' => 200,
'type' => 'text',
'style' => 'width:120px',
'data_val' => array (
  'required' => true,
  'regex' => '^[a-z_]+$',
),
'data_val_msg' => array (
  'required' => '标识符不能为空',
  'regex' => '标识符格式不正确',
),
),
'group' => array (
'label' => '分组名称',
'label_width' => 200,
'type' => 'select',
'options' => DB::getopts('@pf_singlepage_group',null,1),
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '请选择分组名称',
),
'header' => array (
  0 => '',
  1 => '请选择分组',
),
'valtype' => 'int',
),
'sort' => array (
'label' => '排序',
'label_width' => 200,
'type' => 'digits',
'default' => $this->getNextSort(),
'data_val' => array (
  'required' => true,
  'digits' => true,
),
'data_val_msg' => array (
  'required' => '排序不能为空',
  'digits' => '排序必须是整数形式',
),
),
'allow' => array (
'label' => '是否允许',
'label_width' => 200,
'type' => 'bool',
'default' => '1',
),
'islink' => array (
'label' => '是否连接',
'label_width' => 200,
'type' => 'bool',
'dynamic' => array (
  0 => 
  array (
    'val' => 1,
    'show' => 'link',
    'hide' => 'content',
  ),
  1 => 
  array (
    'val' => 0,
    'show' => 'content',
    'hide' => 'link',
  ),
),
),
'link' => array (
'label' => '连接地址',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '连接地址不能为空',
),
),
'content' => array (
'label' => '内容',
'label_width' => 200,
'type' => 'xheditor',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '内容不能为空',
),
),

        );
    }
}
