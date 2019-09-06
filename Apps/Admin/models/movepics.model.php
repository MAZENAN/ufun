<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class MovepicsModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'movepics';
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
'type' => array(
    'label' => '类型',
    'label_width' => 200,
    'type' => 'select',
    'options' => array(
        array(
            0,
            '店铺'
        ),
        array(
            1,
            '商品'
        ),
        array(
            2,
            '文章'
        ),
    ),

    'header'  => array(
        '',
        '请选择'
    ),
    'dynamic' => array(
        array(
            'val' => 0,
            'show' => 'merchant_id',
            'hide' => 'goods_id|article_id'
        ),
        array(
            'val' => 1,
            'show' => 'goods_id',
            'hide' => 'merchant_id|article_id'
        ),
        array(
            'val' => 2,
            'show' => 'article_id',
            'hide' => 'merchant_id|goods_id'
        )
    )
),
'merchant_id' => array(
    'label' => '店铺',
    'label_width' => 200,
    'type' => 'select',
    'header' => array(
        '',
        '请选择'
    ),
    'data_val' => array(
        'required' => true
    ),
    'row_hide' => true
),
            'school_id' => array(
                'label' => '学校id',
                'label_width' => 200,
                'type' => 'digits',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '学校id不能为空',
                ),
                'row_hide'=> true
            ),
            'goods_id' => array(
                'label' => '商品id',
                'label_width' => 200,
                'type' => 'digits',
//                'data_val' => array(
//                    'required' => true,
//                    'digits' => true,
//                    'remote' => array(
//                        array(
//                            0 => '/admin/goods/check_goods',
//                            1 => 'POST'
//                        )
//                    ),
//                ),
                'data_val_msg' => array(
                    'required' => '商品id不能为空',
                    'digits' => '商品id必须是整数形式',
                    'remote' => '商品不存在或已下架或不支持配送该学校'
                ),
                'row_hide' => true

            ),
            'article_id' => array(
                'label' => '文章id',
                'label_width' => 200,
                'type' => 'digits',
                'data_val_msg' => array(
                    'required' => '文章id不能为空',
                    'digits' => '文章id必须是整数形式',
                    'remote' => '文章不存在或未启用'
                ),
                'row_hide' => true
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
