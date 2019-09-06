<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class TagModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'tag';
        $this->type = 1;
        $this->title = '课程体系标签';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'title' => array (
        'label' => '标签名称',
        'label_width' => 200,
        'type' => 'text',
        'data_val' => array (
        'required' => true,
        ),
        'data_val_msg' => array (
          'required' => '标签名称不能为空',
        ),
        ),
        'en_title' => array (
        'label' => '英文标签名称',
        'label_width' => 200,
        'type' => 'text',        
        ),
         'img' => array (
        'label' => '标签图片',
        'label_width' => 200,
        'type' => 'upimg',
        'img_width' => 220,
        'img_height' => 140,
         'tip_back' => '图片尺寸 220*140',
        'extensions' => 'jpg,jpeg,gif,png',
        
        ),
        'pid' => array (
        'label' => '所属节点',
        'label_width' => 200,
        'type' => 'digits',
        'default' => IGet("pid"),
        'row_hide' => true,
        ),
        'type' => array (
        'type' => 'text',
         'default' => IGet("type"),
        'row_hide' => true,
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
