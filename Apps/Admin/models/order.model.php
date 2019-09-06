<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class OrderModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'order';
        $this->type = 1;
        $this->title = '';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'order_id' => array(
                'label' => '订单号',
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
            'merchant_id' => array(
                'label' => '商户id',
                'label_width' => 150,
                'type' => 'select',
                'options' => DB::getopts('@pf_merchant','id,name',0),
                'offedit' => true
            ),
            'title' => array(
                'label' => '订单标题',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'goods_amount' => array(
                'label' => '实付总金额',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'delivery_price' => array(
                'label' => '配送费',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'status' => array(
                'label' => '订单状态:-1取消0待付款1已付款(待发货)2卖家已接单(制作中)3卖家已发货(配送中)4退款中5已退款6待评价7已完成',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'pay_type' => array(
                'label' => '支付类型0余额支付1微信支付',
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
            'remark' => array(
                'label' => '买家备注',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'address' => array(
                'label' => '配送具体地址描述',
                'label_width' => 150,
                'type' => 'textarea',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'buyer_info' => array(
                'label' => '买家信息姓名性别',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'buyer_phone' => array(
                'label' => '买家联系电话',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'arrive_date' => array(
                'label' => '送达日期年月日',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'arrive_time' => array(
                'label' => '送达时间1中午2下午0备用上午',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'arrive_desc' => array(
                'label' => '送达时间描述',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'take_meal_addr' => array(
                'label' => '自提地址',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'delivery_type' => array(
                'label' => '配送方式0配送到寝1校内自提',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'school_id' => array(
                'label' => '配送学校id',
                'label_width' => 150,
                'type' => 'select',
                'options' => DB::getopts('@pf_school','id,title')
            ),
            'finish_time' => array(
                'label' => '完成时间',
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
            'user_deleted' => array(
                'label' => '用户删除',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'cancel_time' => array(
                'label' => '取消订单时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'cancel_pay_time' => array(
                'label' => '取消支付时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'sys_deleted' => array(
                'label' => '系统删除',
                'label_width' => 150,
                'type' => 'bool',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'add_time' => array(
                'label' => '订单生成时间',
                'label_width' => 150,
                'type' => 'datetime',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'total' => array(
                'label' => '买下商品总数',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'add_date' => array(
                'label' => '订单生成日期',
                'label_width' => 150,
                'type' => 'text',
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
            'paid' => array(
                'label' => '已支付金额',
                'label_width' => 150,
                'type' => 'text',
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