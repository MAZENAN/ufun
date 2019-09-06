<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class MemberModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'member';
        $this->type = 1;
        $this->title = '账号管理';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'username' => array(
                'label' => '用户名',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'pass' => array(
                'label' => '用户密码',
                'label_width' => 150,
                'type' => 'password',
                'data_val' => array(
                    'required' => true,
                    'minlength' => 6,
                ),
                'data_val_msg' => array(
                    'required' => '密码不能为空',
                    'minlength' => '密码最小长度不能低于{0}位',
                ),
            ),
            'email' => array(
                'label' => '邮箱',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'email' => true
                ),
                'data_val_msg' => array(
                ),
            ),
            'mobile' => array(
                'label' => '手机号码',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'mobile' => true
                ),
                'offedit' => true
            ),
            'errtice' => array(
                'label' => '错误次数',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'errtime' => array(
                'label' => '错误日期',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'lock' => array(
                'label' => '锁定',
                'label_width' => 150,
                'type' => 'bool',
            ),
            'last_login_time' => array(
                'label' => '上次登陆',
                'label_width' => 150,
                'type' => 'datetime',
                'offedit' => true
            ),
            'this_login_time' => array(
                'label' => '本次登录',
                'label_width' => 150,
                'type' => 'datetime',
                'offedit' => true
            ),
            'name' => array(
                'label' => '姓名',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'telephone' => array(
                'label' => '联系电话',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'remark' => array(
                'label' => '备注',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'area' => array(
                'label' => '区域',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'address' => array(
                'label' => '地址信息',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'nickname' => array(
                'label' => '昵称',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'score' => array(
                'label' => '积分',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'auth_mobile' => array(
                'label' => '手机认证',
                'label_width' => 150,
                'type' => 'bool',
            ),
            'bind_mobile' => array(
                'label' => '绑定手机',
                'label_width' => 150,
                'type' => 'bool',
            ),
            'unionid' => array(
                'label' => '微信ID',
                'label_width' => 150,
                'type' => 'text',
                'offedit' => true
            ),
            'type' => array(
                'label' => '会员类型',
                'label_width' => 150,
                'type' => 'select',
                'options' => array(
                    array(
                        1,
                        '普通会员'
                    ),
                    array(
                        2,
                        '商户账号'
                    )
                ),
                'offedit' => true
            ),
            'gender' => array(
                'label' => '性别',
                'label_width' => 150,
                'type' => 'radiogroup',
                'options' => array(
                    array(
                        0,
                        '女'
                    ),
                    array(
                        1,
                        '男'
                    )
                )
            ),

            'card' => array(
                'label' => '身份证号',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'real_name' => array(
                'label' => '真实姓名',
                'label_width' => 150,
                'type' => 'text',
                'offedit' => true
            ),
            'school_id' => array(
                'label' => '学校',
                'label_width' => 150,
                'type' => 'select',
                'options' => DB::getopts('@pf_school','id,title',0,'allow=1'),
                'header' => array(
                    '',
                    '未选择'
                ),
                'offedit' => true
            ),
            'admission_time' => array(
                'label' => '入学时间',
                'label_width' => 150,
                'type' => 'date',
                'offedit' => true
            ),
            'stu_card' => array(
                'label' => '学生证件',
                'label_width' => 150,
                'type' => 'upimg',
            ),

            'status' => array(
                'label' => '认证状态',
                'label_width' => 150,
                'type' => 'select',
                'header' => array(
                    '',
                    '请选择'
                ),
                'options' => array(
                    array(
                        '0' ,
                        '未认证'
                    ),
                    array(
                        '1' ,
                        '待审核'
                    ),
                    array(
                        '2' ,
                        '认证成功'
                    )  ,
                    array(
                        '3' ,
                        '认证失败'
                    )
                ),
                'dynamic' => array(
                    array(
                        'val' => 0,
                        'hide' => 'ref_mark'
                    ),
                    array(
                        'val' => 1,
                        'hide' => 'ref_mark'
                    ),
                    array(
                        'val' => 2,
                        'hide' => 'ref_mark'
                    ),
                    array(
                        'val' => 3,
                        'show' => 'ref_mark'
                    ),
                )
            ),
            'ref_mark' => array(
                'label' => '认证失败原因',
                'label_width' => 150,
                'type' => 'textarea',
                'row_hide' => true
            ),
            'webchat' => array(
                'label' => '微信号(联系方式)',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'addtime' => array(
                'label' => '添加时间',
                'label_width' => 150,
                'type' => 'datetime',
            ),
            'img_head' => array(
                'label' => '用户头像',
                'label_width' => 150,
                'type' => 'upimg',
            ),
            'openid' => array(
                'label' => 'openid',
                'label_width' => 150,
                'type' => 'text',
                'offedit' => true
            )
        );
    }
}