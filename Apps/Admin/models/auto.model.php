<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class AutoModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'auto';
        $this->type = 1;
        $this->title = '自动回复';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'keyword' => array (
'label' => '关键词',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '关键词不能为空',
),
),
'reply' => array (
'label' => '回复类型',
'label_width' => 200,
'type' => 'radiogroup',
'options' => array (
  0 => 
  array (
    0 => '1',
    1 => '文本回复',
  ),
  1 => 
  array (
    0 => '2',
    1 => '图文回复',
  ),
  2 => 
  array (
    0 => '3',
    1 => '图片回复',
  ),
),
'default' => '1',
'dynamic' => array (
  0 => 
  array (
    'val' => '1',
    'hide' => 'title|thumb|links',
    'show' => 'content',
  ),
  1 => 
  array (
    'val' => '2',
    'show' => 'title|thumb|links|content',
  ),
  2 => 
  array (
    'val' => '3',
    'hide' => 'title|content|links',
    'show' => 'thumb',
  ),
),
),
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
'content' => array (
'label' => '回复内容',
'label_width' => 200,
'type' => 'textarea',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '回复内容不能为空',
),
),
'thumb' => array (
'label' => '缩略图',
'label_width' => 200,
'type' => 'upimg',
'img_width' => 300,
'img_height' => 200,
'extensions' => 'jpg,jpeg,gif,png',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '缩略图不能为空',
),
),
'links' => array (
'label' => '连接地址',
'label_width' => 200,
'type' => 'textarea',
'data_val' => array (
  'url' => true,
),
'data_val_msg' => array (
  'url' => '连接地址格式不正确',
),
),
        );
    }
}
