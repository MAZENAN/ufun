<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class WithdrawsLogModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'withdraws_log';
        $this->type = 1;
        $this->title = '';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
                    'case_id' => array(
                'label' => '提现id',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'type' => array(
                'label' => '日志类型:0赏金提现',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'manage_id' => array(
                'label' => '管理员id',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'user_id' => array(
                'label' => '用户id',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'ret' => array(
                'label' => '提现结果0失败1成功',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'log' => array(
                'label' => '错误记录',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'add_time' => array(
                'label' => '日志添加时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),

        );
    }
}