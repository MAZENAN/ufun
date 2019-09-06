<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class SchoolModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'school';
        $this->type = 1;
        $this->title = '学校信息表';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'title' => array(
                'label' => '学校名',
                'label_width' => 150,
                'type' => 'text',
                'tip_back' => '<span class="red">*</span>学校名必填,校区用()标注',
                'data_val' => array(
                    'required' => true,
                    'maxlength' => 60
                ),
                'data_val_msg' => array(
                    'required' => '学校名必填'
                ),
            ),
            'short_title' => array(
                'label' => '学校名简称',
                'label_width' => 150,
                'type' => 'text',
                'tip_back' => '<span class="red">*</span>学校名简称必填',
                'data_val' => array(
                    'required' => true,
                    'maxlength' => 20
                ),
                'data_val_msg' => array(
                    'required' => '学校名简称必填'
                ),
            ),
            'code' => array(
                'label' => '院校代码',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'maxlength' => 255,
                    'digits' => true
                ),
                'data_val_msg' => array(
                    'maxlength' => '最长{0}个字符'
                ),
                'close' => true
            ),
            'type' => array(
                'label' => '学校类型',
                'label_width' => 150,
                'type' => 'select',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '学校类型必选'
                ),
                'tip_back' => '暂时无用',
                'options' => array(
                    0 => array(
                        0 => '1',
                        1 => '大学'
                    )
                ),
                'header' => array(
                    0 => '',
                    1 => '学校类型'
                ),
                'default' => 1,
                'close' => true
            ),
//            'campaus' => array(
//                'label' => '校区',
//                'label_width' => 150,
//                'type' => 'text',
//                'data_val' => array(
//                    'maxlength' => 255
//                ),
//                'data_val_msg' => array(
//                    'maxlength' => '最长{0}个字符'
//                ),
//            ),
            'area' => array(
                'label' => '区域',
                'label_width' => 150,
                'type' => 'linkage',
                'headers' => array(
                    0 => '选择城市',
                    1 => '选择城市',
                    // 2 => '选择城市',
                ),
                'data_url' => '/service/area.php',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '请选择区域'
                )
            ),
            'street' => array(
                'label' => '街道',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                    'maxlength' => 255,
                ),
                'data_val_msg' => array(
                    'maxlength' => '最长{0}个字符'
                ),
            ),
            'take_meal_addr' => array(
                'label' => '取餐地址',
                'label_width' => 150,
                'type' => 'textarea',
                'tip_back' => '<span class="red">*</span>取餐地址必填',
                'data_val' => array(
                    'maxlength' => 255,
                    'required' => true
                ),
                'data_val_msg' => array(
                    'maxlength' => '最长{0}个字符',
                    'required' => '请填写取餐地址'
                ),
            ),
            'name' => array(
                'label' => '联系人姓名',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'maxlength' => 255
                ),
                'data_val_msg' => array(
                    'maxlength' => '最长{0}个字符'
                ),
            ),
            'phone' => array(
                'label' => '联系人电话',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'mobile' => true
                ),
            ),
            'lng' => array(
                'label' => '位置坐标拾取',
                '@minititle' => '经度:',
                'label_width' => 150,
                'type' => 'number',
                'tip_back' => '-180~180',
                'data_val' => array(
                    'number' => true,
                    'min' => -180,
                    'max' => 180,
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '请填写经度'
                )
            ),
            'lat' => array(
                'label' => '纬度',
                'label_width' => 150,
                'type' => 'number',
                'tip_back' => '-90~90',
                'data_val' => array(
                    'number' => true,
                    'min' => -90,
                    'max' => 90,
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '请填写纬度'
                ),
                'merge' => true,
                'merge_type' => '1',
            ),
            'geohash' => array(
                'label' => 'geohash',
                'label_width' => 150,
                'type' => 'text',
                'row_hide' => true
            ),
            'allow' => array(
                'label' => '是否启用',
                'label_width' => 150,
                'type' => 'bool',
                'default' => 1
            ),

        );
    }
}