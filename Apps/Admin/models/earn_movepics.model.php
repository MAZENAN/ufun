<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class EarnMovepicsModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'earn_movepics';
        $this->type = 1;
        $this->title = '首页滚动图片';
        $this->toptip = '设置首页滚动图片,修改此处信息将会更改首页滚动播放的大图。';
        $this->istab = false;
        $this->tabsplit = false;
        $this->basecontroler = 'SmcmsController';
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'name' => array (
            'label' => '图片名称',
            'label_width' => 200,
            'type' => 'text',
        ),
        'src' => array (
            'label' => '图片',
            'label_width' => 200,
            'type' => 'upimg',
            'img_width' => 355,
            'img_height' => 125,
            'extensions' => 'jpg,jpeg,gif,png',
            'tip_back' => '要求图片 宽为：355px 高为 125px',
            'data_val' => array (
              'required' => true,
            ),
        ),
        'allow' => array (
            'label' => '是否启用',
            'label_width' => 200,
            'type' => 'bool',
            'default' => '1',
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
        );
    }
}
