<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class SellerModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'seller';
        $this->type = 1;
        $this->title = '';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
                    'user_id' => array(
                'label' => '会员ID',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'level_id' => array(
                'label' => '等级',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'business_license' => array(
                'label' => '营业执照',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'sign_protocol' => array(
                'label' => '是否签署协议，1是，0否',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'sign_time' => array(
                'label' => '协议签署日期',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'proto_id' => array(
                'label' => '协议版本',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'company_info' => array(
                'label' => '公司简介',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'logo' => array(
                'label' => 'logo',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'notice' => array(
                'label' => '公告',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'allow' => array(
                'label' => '状态',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'isselftake' => array(
                'label' => '是否支持自取0否1是',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'tel' => array(
                'label' => '联系电话',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'mobile' => array(
                'label' => '联系手机',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'lat' => array(
                'label' => '经度',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'lng' => array(
                'label' => '纬度',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'address' => array(
                'label' => '地址',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),

        );
    }
}