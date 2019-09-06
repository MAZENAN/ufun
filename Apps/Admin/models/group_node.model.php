<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class GroupNodeModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'group_node';
        $this->type = 1;
        $this->title = '管理组节点';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'group' => array (
'label' => '管理组',
'label_width' => 200,
'type' => 'digits',
),
'node' => array (
'label' => '节点',
'label_width' => 200,
'type' => 'digits',
),

        );
    }
}
