<?php
if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class UserAuthReviewModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'member';
        $this->type = 1;
        $this->title = '实名认证审核';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        $this->incscriptfiles = ['/public/js/admin/radio_check.js'];
        parent::__construct($modeltype);
    }

    public function fields() {
        return array(
            'real_name' => array(
                'label' => '用户名',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
                'style' => 'font-size:14px; color:#9B410E;',
            ),
            'mobile' => array(
                'label' => '联系电话',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,
            ),
            'admission_time' => array(
                'label' => '入学时间',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,

            ),
            'school_name' => array(
                'label' => '所在学校',
                'label_width' => 200,
                'type' => 'label',
                'dbfield' => false,

            ),
            'stu_card' => array(
                'label' => '学生证',
                'label_width' => 200,
                'type' => 'upimg',
                'dbfield' => false,
            ),
            'remark' => array (
            'label' => '审核备注',
            'label_width' => 200,
            'type' => 'textarea',
            'data_val' => array (
              'required' => true,
            ),
            'data_val_msg' => array (
              'required' => '核实备注不能为空',
            ),
            ),
            'check_status' => array (
                  'label' => '实名审核',
                  'label_width' => 200,
                  'type' => 'radiogroup',
                  'options' => array (
                          0 => 
                          array (
                            0 => '1',
                            1 => '通过',
                          ),
                          1 => 
                          array (
                            0 => '0',
                            1 => '未通过',
                          ),
                  ),
                  'default'=>'1',
                  'dynamic' => array (
                      0 => 
                      array (
                        'val' => '0',
                        'show' => 'ref_mark',
                        
                      ),
                       1 => 
                      array (
                        'val' => '1',
                        'hide' => 'ref_mark',
                        
                      )
                    ),
            ),
            'ref_mark' => array(
                'label' => '审核未通过原因',
                'label_width' => 200,
                'type' => 'textarea',
                'tip_back' => '失败原因将推送给用户',
                'data_val' => array(
                    'required' => true,
                ),
                'data_val_msg' => array(
                    'required' => '审核未通过原因不能为空',
                ),
            )
        );
    }

}
