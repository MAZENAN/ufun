<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class MerchantModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'merchant';
        $this->type = 1;
        $this->title = '商户';
        $this->istab = true;
        $this->tabsplit = false;
        $this->tabs = [
            'base'=>'基本信息',
            'status'=>'状态',
            'open'=> '营业资质信息',
            'address'=>'地址信息',
            'delivery'=>'配送设置',
            'disscount'=>'参与优惠',
            'account'=>'账号信息',
        ];
        $this->btns_left = 1;
       /** $this->script = '
        $(function() {$("#sale_from_time").timepicker({timeFormat: \'HH:mm\'});});
        $(function() {$("#sale_to_time").timepicker({timeFormat: \'HH:mm\'});});
        $(function() {$("#delivery_time1").timepicker({timeFormat: \'HH:mm\'});});
        $(function() {$("#delivery_time2").timepicker({timeFormat: \'HH:mm\'});});
        $(function() {$("#delivery_time3").timepicker({timeFormat: \'HH:mm\'});});
        $(function() {$("#sale_from_time").prop(\'readonly\',true);});
        $(function() {$("#sale_to_time").prop(\'readonly\',true);});
        ';*/

        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'user_id' => array(
                'label' => '用户ID',
                'label_width' => 150,
                'type' => 'text',
                'close' => true
            ),
            'name' => array(
                'label' => '商家名称',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'base',
                'data_val' => array(
                    'required' => true
                ),
                'tip_back' => '<span class="red">*</span>必填项'
            ),
            'logo' => array(
                'label' => 'logo',
                'label_width' => 150,
                'type' => 'upimg',
                'tab'=>'base',
//                'img_width' => 640,
//                'img_height' => 640,
                'extensions' => 'jpg,jpeg,gif,png',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '必须上传图片'
                ),
                'tip_back' => '<span class="red">*</span>必须上传'
            ),
            'type' => array(
                'label' => '类型',
                'label_width' => 150,
                'type' => 'select',
                'tab'=>'base',
                'data_val' => array(
                    'required' => true
                ),
                'options' => array(
                    0 =>
                        array (
                            0 => '0',
                            1 => '普通类型',
                        ),
                    1 =>
                        array (
                            0 => '1',
                            1 => '平台类型',
                        ),
                ),
                'data_val_msg' => array(
                    'required' => '请选择商家类型'
                ),
                'header' => array(
                    '',
                    '请选择'
                )
            ),
            'license_img' => array(
                'label' => '营业执照',
                'label_width' => 150,
                'type' => 'upimg',
                'tab'=>'open',
//                'img_width' => 640,
//                'img_height' => 640,
                'extensions' => 'jpg,jpeg,gif,png',
//                'data_val' => array(
//                    'required' => true
//                ),
//                'data_val_msg' => array(
//                    'required' => '必须上传图片'
//                ),
            ),
            'food_img' => array(
                'label' => '食品经营许可证',
                'label_width' => 150,
                'type' => 'upimg',
                'tab'=>'open',
//                'img_width' => 640,
//                'img_height' => 640,
                'extensions' => 'jpg,jpeg,gif,png',
//                'data_val' => array(
//                    'required' => true
//                ),
//                'data_val_msg' => array(
//                    'required' => '必须上传图片'
//                ),
            ),

            'door_img' => array(
                'label' => '门脸照',
                'label_width' => 150,
                'type' => 'upimggroup',
                'length' => 3,
                'tab'=>'open',
//                'img_width' => 640,
//                'img_height' => 640,
                'extensions' => 'jpg,jpeg,gif,png',
//                'data_val' => array(
//                    'required' => true,
//                    'max' => 5
//                ),
//                'data_val_msg' => array(
//                    'required' => '必须上传图片'
//                ),
            ),
            'inside_img' => array(
                'label' => '店内照',
                'label_width' => 150,
                'type' => 'upimggroup',
                'length' => 3,
                'tab'=>'open',
//                'img_width' => 640,
//                'img_height' => 640,
                'extensions' => 'jpg,jpeg,gif,png',
//                'data_val' => array(
//                    'required' => true
//                ),
//                'data_val_msg' => array(
//                    'required' => '必须上传图片'
//                ),
            ),

//            'sign_protocol' => array(
//                'label' => '是否签署协议，1是，0否',
//                'label_width' => 150,
//                'type' => 'bool',
//            ),
//            'sign_time' => array(
//                'label' => '协议签署日期',
//                'label_width' => 150,
//                'type' => 'datetime',
//            ),
//            'proto_id' => array(
//                'label' => '协议版本',
//                'label_width' => 150,
//                'type' => 'text',
//            ),
            'status' => array(
                'label' => '入驻状态',
                'label_width' => 150,
                'tab' => 'status',
                'type' => 'select',
                'options' => array(
                    array(
                        0 => '0',
                        1 =>'未入驻'
                    ),
                    array(
                        0 => '1',
                        1 =>'已入驻'
                    ),
                    array(
                        0 => '2',
                        1 =>'认证失败'
                    ),
                    array(
                        0 => '3',
                        1 =>'暂停'
                    )
                ),
                'header' => array(
                    0 => '',
                    1 => '请选择',
                ),
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '请选择入驻状态',
                ),
                'dynamic' => array(
                    array(
                        'val' => 2,
                        'show' => 'ref_mark'
                    ),
                    array(
                        'val' => 0,
                        'hide' => 'ref_mark'
                    ),
                    array(
                        'val' => 1,
                        'hide' => 'ref_mark'
                    ),
                    array(
                        'val' => 3,
                        'hide' => 'ref_mark'
                    )
                )
            ),
            'ref_mark' => array(
                'label' => '认证失败原因',
                'label_width' => 150,
                'type' => 'textarea',
                'tab' => 'status',
                'hide' => true
            ),
//            'sale_from_time' => array(
//                'label' => '营业时间',
//                'label_width' => 150,
//                'type' => 'datetime',
//                'tab' => 'base',
//                '@minititle' => '从：',
//                'data_val' => array(
//                    'required' => true,
//                ),
//                'data_val_msg' => array(
//                    'required' => '起始时间不能为空',
//                ),
//            ),
//            'sale_to_time' => array(
//                'label' => '到',
//                'label_width' => 150,
//                'type' => 'datetime',
//                'tab' => 'base',
//                'merge' => true,
//                'merge_type' => '1',
//                'data_val' => array(
//                    'required' => true,
//                ),
//                'data_val_msg' => array(
//                    'required' => '结束时间不能为空',
//                ),
//                'tip_back' => '<span class="red">*</span>必须选择'
//            ),
//            'istostore' => array(
//                'label' => '是否支持店内自取',
//                'label_width' => 150,
//                'type' => 'radiogroup',
//                'tab' => 'delivery',
//                'tip_back' => '暂时无效',
//                'options' => array(
//                    array(
//                        '0',
//                        '不支持'
//                    ),
//                    array(
//                        '1',
//                        '支持'
//                    )
//                ),
//                'default' => '0'
//            ),
//            'istoroom' => array(
//                'label' => '是否支持配送到寝室',
//                'label_width' => 150,
//                'type' => 'radiogroup',
//                'tab' => 'delivery',
//                'tip_back' => '暂时无效',
//                'options' => array(
//                    array(
//                        '0',
//                        '不支持'
//                    ),
//                    array(
//                        '1',
//                        '支持'
//                    )
//                ),
//                'default' => '1',
//            ),
//            'istoschool' => array(
//                'label' => '是否支持校内自取',
//                'label_width' => 150,
//                'type' => 'radiogroup',
//                'tip_back' => '暂时无效',
//                'tab' => 'delivery',
//                'options' => array(
//                    array(
//                        '0',
//                        '不支持'
//                    ),
//                    array(
//                        '1',
//                        '支持'
//                    )
//                ),
//                'default' => '1'
//            ),
//            'delivery_week' => array(
//                'label' => '配送星期',
//                'label_width' => 150,
//                'type' => 'checkgroup',
//                'tab' => 'delivery',
//                'options' => array(
//                    0 => array(
//                        0 => '1',
//                        1 => '星期一'
//                    ),
//                    1 => array(
//                        0 => '2',
//                        1 => '星期二'
//                    ),
//                    2 => array(
//                        0 => '3',
//                        1 => '星期三'
//                    ),
//                    3 => array(
//                        0 => '4',
//                        1 => '星期四'
//                    ),
//                    4 => array(
//                        0 => '5',
//                        1 => '星期五'
//                    ),
//                    5 => array(
//                        0 => '6',
//                        1 => '星期六'
//                    ),
//                    6 => array(
//                        0 => '7',
//                        1 => '星期日'
//                    )
//                ),
//                'default' => 1,
//                'data_val' => array(
//                    'required' => true,
//                )
//            ),
//            'delivery_time' => array(
//                'label' => '配送时间',
//                'label_width' => 150,
//                'type' => 'text',
//                'tab' => 'delivery' ,
//                'default' => '[]',
//                'row_hide' => true
//            ),
//            'delivery_time1' => array(
//                'label' => '配送时间',
//                'label_width' => 150,
//                'type' => 'datetime',
//                'tab' => 'delivery',
//                'tip_back' => '上午暂时无效',
//                'default' => '09:00',
//                '@minititle' => '上午',
//                'data_val' => array(
//                    'required' => true,
//                ),
//            ),
//            'delivery_time2' => array(
//                'label' => '中午',
//                'label_width' => 150,
//                'type' => 'datetime',
//                'tab' => 'delivery',
//                'default' => '12:00',
//                'merge' => true,
//                'merge_type' => '1',
//                'data_val' => array(
//                    'required' => true,
//                ),
//            ),
//            'delivery_time3' => array(
//                'label' => '下午',
//                'label_width' => 150,
//                'type' => 'datetime',
//                'tab' => 'delivery',
//                'default' => '18:00',
//                'merge' => true,
//                'merge_type' => '1',
//                'data_val' => array(
//                    'required' => true,
//                ),
//            ),
            'deliver_price' => array(
                'label' => '配送费',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'delivery',
                'data_val' => array(
                    'required' => true,
                ),
                'default' => '0.00',
                'follow_text' => '元'
            ),
            'deliver_from_price' => array(
                'label' => '起送价',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'delivery',
                'data_val' => array(
                    'required' => true,
                ),
                'default' => '0.00',
                'follow_text' => '元'
            ),
            'contact_name' => array(
                'label' => '联系人',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'base',
                'data_val' => array(
                    'required' => true,
                    'maxlength' => 10
                ),
                'data_val_msg' => array(
                    'maxlength' => '长度不能超过{0}个'
                )
            ),
            'phone' => array(
                'label' => '联系手机',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'base',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '联系手机不能为空',
                ),
            ),
            'star' => array(
                'label' => '评分',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'base',
                'tip_back' => '请输入一个0.0-5.0的值',
                'data_val' => array(
                    'required' => true,
                    'max' => '5.0',
                    'min' => '0.0'
                ),
                'default' => '0.0',
            ),
            'lat' => array(
                'label' => '经度',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'address'
            ),
            'lng' => array(
                'label' => '纬度',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'address'
            ),
            'area' => array(
                'label' => '区域',
                'label_width' => 150,
                'type' => 'linkage',
                'headers' => array(
                    0 => '选择城市',
                    1 => '选择城市',
                    // 2 => '选择城市',
                ),
                'data_url' => '/service/all_area.php',
                'tab'=>'address',
            ),
            'street' => array(
                'label' => '街道',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'address'
            ),
            'address' => array(
                'label' => '详细地址',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'address'
            ),
//            'sell_cates' => array(
//                'label' => '主要经营种类',
//                'label_width' => 150,
//                'type' => 'linkage',
//                'tab' => 'base',
//                'headers' => array(
//                    0 => '选择分类',
//                    1 => '选择分类',
//                ),
//                'data_url' => '/service/sell_type.php',
//                'data_val' => array(
//                    'required' => true,
//                ),
//                'data_val_msg' => array(
//                    'required' => '主要经营类别不能为空',
//                ),
//                'tip_back' => '<span class="red">*</span>必选项'
//            ),
//            'sell_cates_sec' => array(
//                'label' => '次要经营种类',
//                'label_width' => 150,
//                'type' => 'linkage',
//                'tab' => 'base',
//                'headers' => array(
//                    0 => '选择分类',
//                    1 => '选择分类',
//                ),
//                'data_url' => '/service/sell_type.php',
//            ),
            'tag_index_ids' => array(
                'label' => '分类',
                'label_width' => 150,
                'type' => 'checkgroup',
                'tab' => 'base',
                'options' => DB::getopts('@pf_tag_index','id,title',0,'allow=1'),
                'css' => 'color=#f00'
            ),
            'is_recommend' => array(
                'label' => '是否推荐到首页分类',
                'label_width' => 150,
                'type' => 'radiogroup',
                'tab' => 'base',
                'options' => array(
                    array(
                        '0',
                        '不推荐',
                    ),
                    array(
                        '1',
                        '推荐'
                    )
                ),
                'default' => 0
            ),
            'info' => array(
                'label' => '商户简介',
                'label_width' => 150,
                'type' => 'textarea',
                'tab'=>'base',
            ),
            'supp_schools' => array(
                'label' => '支持配送学校',
                'label_width' => 200,
                'type' => 'checkgroup',
                'tab' => 'delivery',
                'options' => DB::getopts('@pf_school','id,title',0,'allow=1'),
                'data_val'=> array(
                    'required' => true
                )
            ),
            'allow' => array(
                'label' => '营业状态',
                'label_width' => 150,
                'type' => 'radiogroup',
                'tab' => 'status',
                'options' => array(
                    array(
                        '0',
                        '不营业'
                    ),
                    array(
                        '1',
                        '营业'
                    )
                ),
                'default' => 1
            ),
            'mobile' => array(
                'label' => '手机号码',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'account',
                'tip_back' => '<span class="red">*</span>必填项，一个手机号只能绑定一个商户',
                'data_val' => array(
                    'required' => true,
                    'mobile' => true,
                    'remote' => array(
                        array(
                            0 => '/admin/merchant/check_account',
                            1 => 'POST'
                        )
                    ),
                ),
                'data_val_msg' => array(
                    'required' => '手机号码不能为空',
                    'mobile' => '手机号码格式不正确',
                    'remote' => '该手机号已绑定商户'
                ),

            ),
            'pass' => array(
                'label' => '密码',
                'label_width' => 150,
                'type' => 'password',
                'tab' => 'account',
                'data_val' => array(
                    'required' => true,
                    'minlength' => 6,
                ),
                'tip_back' =>'<span class="red">*</span>必填项，密码最小长度不能低于6位' ,
                'data_val_msg' => array(
                    'required' => '密码不能为空',
                    'minlength' => '密码最小长度不能低于{0}位',
                ),
            )
        );
    }
}