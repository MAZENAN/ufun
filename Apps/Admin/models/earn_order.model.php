<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class EarnOrderModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'earn_order';
        $this->type = 1;
        $this->title = '';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
                    'uid' => array(
                'label' => '用户id',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'order_id' => array(
                'label' => '订单编号',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'order_type' => array(
                'label' => '赏金订单类型',
                'label_width' => 150,
                'type' => 'select',
                'options' => array(
                    0 => array(
                        0=> '1',
                        1=> '跑腿类'
                    ),
                    1 => array(
                        0=>'2',
                        1=> '代购类'
                    ),
                    2 => array(
                        0=>'3',
                        1=> '技能求助类'
                    )
                ),
                'header' => array(
                    '',
                    '请选择'
                )
            ),
            'cate_id' => array(
                'label' => '跑腿订单关联分类id',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'tag' => array(
                'label' => '任务标签',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'content' => array(
                'label' => '任务描述',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'attachment' => array(
                'label' => '任务附件',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'start_address' => array(
                'label' => '开始地址',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'end_address' => array(
                'label' => '送达地址',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'arrive_time' => array(
                'label' => '配送送达时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'goods_weight' => array(
                'label' => '商品重量',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'distance' => array(
                'label' => '配送距离',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'tip_fee' => array(
                'label' => '佣金费用',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'base_fee' => array(
                'label' => '基础费用',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'earn_money' => array(
                'label' => '配送员可挣钱数',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'need_pay' => array(
                'label' => '需支付',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'paid' => array(
                'label' => '已支付金额',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'pay_type' => array(
                'label' => '支付方式1微信支付',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'is_pay' => array(
                'label' => '是否支付0否1是',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'trans_id' => array(
                'label' => '微信支付单号',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'add_time' => array(
                'label' => '创建时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'pay_time' => array(
                'label' => '支付时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'status' => array(
                'label' => '订单状态',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'delivery_status' => array(
                'label' => '订单配送状态',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'deliveryer_id' => array(
                'label' => '配送员id',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'deliveryer_get_time' => array(
                'label' => '抢单成功时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'refund_reasons' => array(
                'label' => '退款理由',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'refund_time' => array(
                'label' => '退款时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'refund_fees' => array(
                'label' => '退款金额',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'refund' => array(
                'label' => '退款状态1退款申请中2退款成功3退款失败',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'refund_remarks' => array(
                'label' => '退款备注',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),

        );
    }
}