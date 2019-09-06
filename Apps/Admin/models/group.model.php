<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class GroupModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'group';
        $this->type = 1;
        $this->title = '管理组';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'name' => array (
'label' => '管理组',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '管理组不能为空',
),
),

        );
    }
}
