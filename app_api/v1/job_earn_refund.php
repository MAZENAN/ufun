<?php
/**
 * 定时任务：自动过期任务,自动退款
 */
require_once 'base.php';
require_once ROOT_DIR . 'app_api/public/wxpay/lib/WxPay.Config.php';
require_once ROOT_DIR . 'app_api/public/wxpay/wxpay.class.php';
ini_set('max_execution_time', '0');
define('SIZE',10);

$time = time();
$sql = 'SELECT * FROM @pf_earn_order WHERE status=1 AND expire_time<='.$time;
$count = DB::getone("SELECT count(*) mycount FROM ($sql) temp");
$all_page = ceil($count['mycount']/SIZE);
for ($i=0;$i<$all_page;$i++){
    $offset = $i * SIZE;
    $len = SIZE;
    $limit = " limit {$offset},{$len}";
    $earn_rows = DB::getlist($sql.$limit);
    foreach ($earn_rows as $row){
        $order_update = [
            'status' => 5,
            'refund' => 2,
            'refund_fees' => DB::sql('paid'),
            'refund_time' => date('Y-m-d H:i:s'),
            'refund_remarks' => '任务过期，系统自动取消'
        ];
        $push_data = [
            $row['tag'],
            $row['paid'] . '￥',
            date('Y-m-d H:i:s'),
            $order_row['order_id'],
            '任务过期，退款已经原路返回，具体到账时间可能会有1-3天延迟'
        ];

        $wxPay = new Wxpay();
        $result = $wxPay->wxRefund($row);
        if ($result['result_code'] == 'SUCCESS' && $result['return_code'] == 'SUCCESS') {
            $time = date('Y-m-d H:i:s');
            DB::update('@pf_earn_order',$order_update,$row['id']);
            push('earn_refund',$row['user_id'],$push_data);
        }
    }
}

