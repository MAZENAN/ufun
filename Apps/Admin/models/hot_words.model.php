<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class HotWordsModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'hot_words';
        $this->type = 1;
        $this->title = '热搜词';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
                'word' => array(
                'label' => '热搜词',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true,
                    'maxlength' => 20
                ),
                'data_val_msg' => array(
                        'maxlength' => '热搜词长度不能超过{0}位'
                    ),
            ),
            'sort' => array (
                'label' => '排序',
                'label_width' => 150,
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
            'allow' => array(
                'label' => '是否启用',
                'label_width' => 130,
                'defalut' => '0',
                'type' => 'bool'
            ),
        );
    }
}