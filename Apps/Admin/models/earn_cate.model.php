<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class EarnCateModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'earn_cate';
        $this->type = 1;
        $this->title = '赏金分类';
        $this->istab = true;
        $this->tabs = [
            'base' => '基本信息',
            'fee'=>'费用设置'
        ];
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'title' => array(
                'label' => '标题',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '分类名不能为空'
                ),
                'tab' => 'base'
            ),
            'type' => array(
                'label' => '赏金类型',
                'label_width' => 150,
                'type' => 'radiogroup',
                'options' => array(
                    array(
                        1,
                        '跑腿类'
                    ),
                    array(
                        2,
                        '代购类'
                    ),
                    array(
                        3,
                        '技能求助类'
                    )
                ),
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '请选择分类'
                ),
                'default' => 1,
                'tab' => 'base',
                'dynamic' => array(
                    array(
                        'val' => '1',
                        'show' => 'is_weight|start_distance'
                    ),
                    array(
                        'val' => '2',
                        'show' => 'is_weight|start_distance'
                    ),
                    array(
                        'val' => '3',
                        'hide' => 'is_weight|start_distance'
                    )
                )
            ),
            'img' => array(
                'label' => '图片icon',
                'label_width' => 150,
                'type' => 'upimg',
                'tab' => 'base',
                'extensions' => 'jpg,jpeg,gif,png',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '必须上传图片'
                ),
            ),
//            'label' => array(
//                'label' => '可选标签',
//                'label_width' => 150,
//                'type' => 'textarea',
//                'tip_back' => '多个标签用|分割。帮助接单人快速识别',
//                'data_val' => array(
//                    'required' => true
//                ),
//                'data_val_msg' => array(
//                    'required' => '标签不能为空'
//                ),
//                'tab' => 'base'
//            ),
            'start_fee' => array(
                'label' => '基础费用(未启用)',
                'label_width' => 150,
                'type' => 'number',
                'default' => '0',
                'tab' => 'fee',
                'follow_text' => '元',
            ),
            'tip_min' => array(
                'label' => '佣金设置',
                'label_width' => 150,
                'type' => 'number',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '最低佣金不能为空'
                ),
                'default' => '0.00',
                'follow_text' => '元',
                '@minititle' => '最低佣金：',
                'tab' => 'fee'
            ),
            'tip_max' => array(
                'label' => '最高佣金',
                'label_width' => 150,
                'type' => 'number',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '最低佣金不能为空'
                ),
                'default' => '0.00',
                'merge' => true,
                'merge_type' => '1',
                'follow_text' => '元',
                'tab' => 'fee'
            ),
            'is_weight' => array(
                'label' => '是否开启重量计费(未启用)',
                'label_width' => 150,
                'type' => 'radiogroup',
                'default' => '0',
                'options' => array(
                    array(
                        0,
                        '不启用'
                    ),
                    array(
                        1,
                        '启用'
                    )
                ),
                'tab' => 'fee',
                'row_hide' => 'true'
            ),
            'is_distance' => array(
                'label' => '是否开启距离计费(未启用)',
                'label_width' => 150,
                'type' => 'radiogroup',
                'default' => '0',
                'options' => array(
                    array(
                        0,
                        '不启用'
                    ),
                    array(
                        1,
                        '启用'
                    )
                ),
                'tab' => 'fee',
                'dynamic' => array(
                    array(
                        'val' => '0',
                        'hide' => 'start_distance'
                    ),
                    array(
                        'val' => '1',
                        'show' => 'start_distance'
                    )
                )
            ),
            'start_distance' => array(
                'label' => '距离加收费用(未启用)',
                'label_width' => 150,
                'type' => 'amountdigits',
                'default' => '0',
                'tab' => 'fee',
                'follow_text' => 'km',
                '@minititle' => '起步距离：',
            ),
            'pre_km' => array(
                'label' => '每增',
                'label_width' => 150,
                'type' => 'amountdigits',
                'default' => '0',
                'tab' => 'fee',
                'follow_text' => 'km',
                'merge' => true,
                'merge_type' => 1,
            ),
            'pre_km_fee' => array(
                'label' => '加收',
                'label_width' => 150,
                'type' => 'number',
                'default' => '0',
                'tab' => 'fee',
                'follow_text' => '元',
                'merge' => true,
                'merge_type' => 1,
            ),
            'add_time' => array(
                'label' => '添加时间',
                'label_width' => 150,
                'type' => 'datetime',
                'default' => date('Y-m-d H:i:s'),
                'row_hide' => true,
                'tab' => 'base'
            ),
            'rule' => array(
                'label' => '任务发布提示',
                'label_width' => 150,
                'type' => 'textarea',
                'tab' => 'base'
            ),
            'allow' => array(
                'label' => '是否启用',
                'label_width' => 150,
                'type' => 'radiogroup',
                'tip_back' => '<span class="red">*</span>请确认信息无误后再开启',
                'options' => array(
                    array(
                        0,
                        '关闭'
                    ),
                    array(
                        1,
                        '开启'
                    )
                ),
                'default' => 0,
                'tab' => 'base'
            )
        );
    }
}