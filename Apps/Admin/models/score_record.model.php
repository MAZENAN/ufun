<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class ScoreRecordModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'score_record';
        $this->type = 1;
        $this->title = '计分记录';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'userid' => array (
'label' => '用户ID',
'label_width' => 200,
'type' => 'digits',
),
'title' => array (
'label' => '标题',
'label_width' => 200,
'type' => 'text',
),
'score' => array (
'label' => '积分',
'label_width' => 200,
'type' => 'digits',
),
'addtime' => array (
'label' => '时间',
'label_width' => 200,
'type' => 'datetime',
),

        );
    }
}
