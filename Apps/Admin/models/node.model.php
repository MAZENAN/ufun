<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class NodeModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'node';
        $this->type = 1;
        $this->title = '权限节点';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'title' => array (
'label' => '节点名称',
'label_width' => 200,
'type' => 'text',
),
'controller' => array (
'label' => '控制器',
'label_width' => 200,
'type' => 'text',
),
'model' => array (
'label' => '操作方法',
'label_width' => 200,
'type' => 'text',
),
'pid' => array (
'label' => '所属节点',
'label_width' => 200,
'type' => 'digits',
'default' => IGet("pid"),
'row_hide' => true,
),
'parameter' => array (
'label' => '参数',
'label_width' => 200,
'type' => 'text',
),
'value' => array (
'label' => '值',
'label_width' => 200,
'type' => 'text',
),
'sort' => array (
'label' => '排序',
'label_width' => 200,
'type' => 'digits',
'default' => $this->getNextSort(),
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '排序不能为空',
),
),

        );
    }
}
