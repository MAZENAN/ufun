<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class MsgListModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'msg';
        $this->type = 1;
        $this->title = '发送短消息';
        $this->istab = false;
        $this->tabsplit = false;
        $this->basecontroler = 'SamaoToolController';
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'title' => array (
'label' => '标题',
'label_width' => 200,
'type' => 'text',
'style' => 'width:380px;',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '标题不能为空',
),
),
'accept' => array (
'label' => '接受对象',
'label_width' => 200,
'type' => 'radiogroup',
'options' => array (
  0 => 
  array (
    0 => '1',
    1 => '所有用户',
  ),
  1 => 
  array (
    0 => '2',
    1 => '指定用户',
  ),
),
'default' => '1',
'style' => 'width:100px',
'dynamic' => array (
  0 => 
  array (
    'val' => '1',
    'hide' => 'users',
  ),
  1 => 
  array (
    'val' => '2',
    'show' => 'users',
  ),
),
),
'users' => array (
'label' => '接受者账号',
'label_width' => 200,
'type' => 'textarea',
'style' => 'width:300px;',
'tip_front' => '请输入会员账号<br>
如果有多个接受者请换行',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '接受者不能为空',
),
),
'type' => array (
'label' => '消息类型',
'label_width' => 200,
'type' => 'select',
'options' => array (
  0 => 
  array (
    0 => '系统消息',
    1 => '系统消息',
  ),
  1 => 
  array (
    0 => '通知',
    1 => '通知',
  ),
),
),
'content' => array (
'label' => '消息内容',
'label_width' => 200,
'type' => 'textarea',
'style' => 'width:500px; height:120px;',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '消息内容不能为空',
),
),
'addtime' => array (
'label' => '添加时间',
'label_width' => 200,
'type' => 'datetime',
'default' => date('Y-m-d H:i:s'),
'close_html' => true,
),

        );
    }
}
