<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class MsgRecordModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'msg_record';
        $this->type = 1;
        $this->title = '消息记录';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'msgid' => array (
'label' => '消息ID',
'label_width' => 200,
'type' => 'digits',
),
'userid' => array (
'label' => '用户ID',
'label_width' => 200,
'type' => 'digits',
),
'del' => array (
'label' => '是否删除',
'label_width' => 200,
'type' => 'bool',
),

        );
    }
}
