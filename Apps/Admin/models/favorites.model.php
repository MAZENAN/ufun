<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class FavoritesModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'favorites';
        $this->type = 1;
        $this->title = '收藏夹';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'userid' => array (
'label' => '用户id',
'label_width' => 200,
'type' => 'digits',
),
'type' => array (
'label' => '类型',
'label_width' => 200,
'type' => 'text',
),
'campid' => array (
'label' => '产品id',
'label_width' => 200,
'type' => 'digits',
),
'addtime' => array (
'label' => '添加时间',
'label_width' => 200,
'type' => 'datetime',
),

        );
    }
}
