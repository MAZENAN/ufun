<?php
/**
 * 订单退款,微信支付渠道
 */
require_once 'base.php';
require_once '../public/wxpay/lib/WxPay.Config.php';
require_once '../public/wxpay/wxpay.class.php';

$obj = new stdClass();
$obj->status = 500;

$uid = IPost('uid');
$order_id = IPost('id');
$type = isset($_POST['type']) ? trim($_POST['type']) : '';
$reasons = SPost('reasons');


if ($uid<=0 || $order_id<=0 || !in_array($type,['sj','waimai'])){
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}

try {
    $order_row = [];
    $table = '';
    switch ($type){
        case 'sj':
            $table = '@pf_earn_order';
            break;
        case 'waimai':
            $table = '@pf_order';
            break;
    }

    $order_row = DB::getone('SELECT * FROM '. $table . ' WHERE id=?',[$order_id]);

    if (!$order_row || $order_row['user_id']!=$uid || $order_row['status']!=1) {
        $obj->r = '退款订单不存在';
        CommonUtil::return_info($obj);
    }

    $wxPay = new Wxpay();
    $result = $wxPay->wxRefund($order_row);
    if ($result['result_code'] == 'SUCCESS' && $result['return_code'] == 'SUCCESS') {
        $time = date('Y-m-d H:i:s');
        DB::update($table,['status'=>5, 'refund'=>2,'refund_fees'=>$order_row['paid'],'refund_remarks'=>$reasons, 'refund_time'=>$time],$order_id);
        $obj->r = '退款申请成功,请等待到账！';
        $obj->status = 200;
        CommonUtil::return_info($obj);
    } else {
        $obj->r = '退款失败';
        CommonUtil::return_info($obj);
    }

} catch (Exception $e) {
    $obj->r = '服务器错误请重试';
    CommonUtil::return_info($obj);
}
