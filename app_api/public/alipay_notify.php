<?php
require_once('base.php');
require_once('alipay/AopSdk.php');

//验证签名
$aop = new \AopClient();
$aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsmG7diU7fn8fETyoeXBV7sVUEwGwBV95IMJfMdugrZ9phxkPdlyXiFTdb6KKbO/MJBx85jbGZjeEmNtikfQGXgM9OoyLyU3oNmXc8bgko0UXopJEUzCEzyV4iiGP71zHJAON626O1O0p6D0mpRL9nhRIcZnjX2VMJlsqq3Pj3XgsRcuAYmcmnyc7qzzfYfX4HUOgl9t9J55N3iODJMfeqcDGzANT0JPwn2nFoAzw2S3SnGOwm85B+GApXbxPHHwcH9ln+a+iff/9L+mwhcqW2ch5xrBqDSzM7pK2D6ZV+6fJr/neQYhRnnACjwnoF7qKCoMMwQ5iKys/tXwVxiteNwIDAQAB';
$flag = $aop->rsaCheckV1($_POST, NULL, "RSA2");

//验签
if($flag){
    //处理业务，并从$_POST中提取需要的参数内容
    if($_POST['trade_status'] == 'TRADE_SUCCESS'
        || $_POST['trade_status'] == 'TRADE_FINISHED'){//处理交易完成或者支付成功的通知
        //获取订单号
        $orderId = $_POST['out_trade_no'];
        //交易号
        $trade_no = $_POST['trade_no'];
        //订单支付时间
        $gmt_payment = $_POST['gmt_payment'];
        //转换为时间戳
        $gtime = strtotime($gmt_payment);

        //此处编写回调处理逻辑
        $row = DB::getone('select * from @pf_study_order where orderid=?', [$orderId]);

        $vals = array();
        $vals['status'] = 1; //已支付
        $vals['pay_time'] = $gmt_payment;
        $vals['pay_type'] = 1;
        $vals['paid'] = $_POST['total_amount'];
        $vals['source'] = 0;

        DB::update('@pf_study_order', $vals, $row['id']);
        //处理成功一定要返回 success 这7个字符组成的字符串，
        //die('success');//响应success表示业务处理成功，告知支付宝无需在异步通知

    }
}

  echo 'success';
  return;

?>
