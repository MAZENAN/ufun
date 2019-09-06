<?php

if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class ReportModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'order';
        $this->type = 1;
        $this->title = '总体销售业绩';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;

        parent::__construct($modeltype);
    }

    public function fields() {
        return array(
            
            'name' => array(
                'label' => '姓名',
                'label_width' => 100,
                'type' => 'text',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '客户姓名不能为空',
                ),
            ),

            'gender'=>array(
                'label' => '性别',
                'label_width' => 100,
                'type' => 'radiogroup',
                'style' => 'width:90px;',
                'options' => array (
                  0 => 
                  array (
                    0 => '1',
                    1 => '男',
                  ),
                  1 => 
                  array (
                    0 => '0',
                    1 => '女',
                  ),
                ),
                'default' => '0',
            ),

            'card' => array(
                'label' => '身份证号码',
                'label_width' => 100,
                'type' => 'text',
                'data_val' => array(
                    'idcard' =>true,
                    'card' => true,
                ),
                'data_val_msg' => array(
                    'idcard'=>'身份证格式不对',
                    'card' => '身份证号码不能为空',
                ),
            ),

            'mobile' => array(
                'label' => '手机号码',
                'label_width' => 100,
                'type' => 'text',
                'data_val' => array(
                    'required' => true,
                    'mobile' => true,
                    'remote' =>
                    array(
                        0 => '__APPROOT__/client/chkmobile.html',
                        1 => 'POST',
                    ),

                
                ),
                'data_val_msg' => array(
                    'required' => '手机号不能为空',
                    'mobile' => '手机号码格式不正确',
                    'remote' => '手机号码已经存在，请更换其他手机号码',
                ),
            ),

            'email' => array(
                'label' => '邮箱',
                'label_width' => 100,
                'type' => 'text',
                'data_val' => array(
                    'email' => true,
                ),
                'data_val_msg' => array(
                    'email' => '邮箱格式不正确',
                ),
            ),

            'webchat' =>array(
                'label' => '微信号',
                'label_width' => 100,
                'type' => 'text',
            ),

            'parent_id' => array(
                'label' => '课程顾问',
                'label_width' => 100,
                'type' => 'select',
                'close' => false,
                'options' => DB::getopts('@pf_manage',null,0,"type in(7,12,13)"),
                'valtype' => 'int',
                'header' => array(
                0 => '',
                1 => '课程顾问',
                ),
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '课程顾问不能为空',
                ),
            ),
            
            'area' => array(
                'label' => '区域',
                'label_width' => 100,
                'type' => 'linkage',
                'style' => 'width:105px;',
                'headers' => array(
                    0 => '选择城市',
                    1 => '选择城市',
                    2 => '选择城市',
                ),
                'data_url' => '/service/area.php',
                'data_val' => array(
                    'required'=>true,
                    'area' => true,
                ),
                'data_val_msg' => array(
                    'required'=>'区域不能为空',
                    'area' => '区域不能为空',
                ),
            ),

            'address' => array(
                'label' => '联系地址',
                'label_width' => 100,
                'type' => 'text',
            ),

            'express_address' => array(
                'label' => '快递地址选项',
                'label_width' => 100,
                'type' => 'bool',
                'close' => true,
            ),

            'express' => array(
                'label' => '快递地址选项',
                'label_width' => 100,
                'type' => 'bool',
                'close' => true,
            ),

            'remark' => array(
                'label' => '备注',
                'close' => false,
                'label_width' => 100,
                'type' => 'textarea',
            ),

            'id'=> array(
                'label' => 'ID',
                'label_width' => 100,
                'row_hide' => true,
            ),
        );
    }

}
