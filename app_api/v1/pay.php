<?php
//TODO 更新售出数



require_once ("base.php");
$obj = new stdClass();
$obj->status = 500;

$uid = IPost('uid');
$order_id = IPost('id');
$pay_type = IPost('paytype');//支付方式1微信支付0余额支付
$to = isset($_POST['to']) ? trim($_POST['to']) : 'waimai';

if ($uid<=0 || $order_id<=0 || !in_array($to,['waimai','sj'])){
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}

//TODO
//if (check_user_exist($uid)){
//    $obj->r = '当前用户不存在';
//    CommonUtil::return_info($obj);
//}

try{
    switch ($pay_type){
        case '0':
            balance_pay();
            break;
        case '1':
            weixin_pay();
            break;
        default:
            $obj->r = '支付方式错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    $obj->r = '接口错误请重试';
    CommonUtil::return_info($obj);
}
$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 余额支付
 */
function balance_pay() {

}

/**
 * 微信支付
 */
function weixin_pay() {
    require_once ("../public/wxpay/lib/WxPay.Config.php");
    require_once ("../public/wxpay/wxpay.class.php");

    global $obj,$uid,$order_id,$to;

    $openid = isset($_POST['openid']) ? trim($_POST['openid']) : NULL;

    if(is_null($openid )|| $order_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $order_row = [];
    $need_pay = 0.00;
    $title = '';

    if ($to=='waimai'){
        $order_row = DB::getone('SELECT user_id,status,order_id,title,goods_amount FROM @pf_order WHERE id = ?',[$order_id]);
    }elseif ($to=='sj'){
        $order_row = DB::getone('SELECT user_id,status,order_id,need_pay FROM @pf_earn_order WHERE id = ?',[$order_id]);
    }

    if (!$order_row || $order_row['user_id']!=$uid || $order_row['status']!=0){
        $obj->r = '订单参数错误';
        CommonUtil::return_info($obj);
    }

    switch ($to){
        case 'waimai':
            $need_pay = $order_row['goods_amount'];
            $title = $order_row['title'];
            break;
        case 'sj':
            $need_pay = $order_row['need_pay'];
            $title = '赏金任务';
            break;
    }

    if ($need_pay<=0){
        $obj->r = '支付金额错误';
        CommonUtil::return_info($obj);
    }

    $wxPay = new Wxpay();
    $result = $wxPay->send($openid,$order_row['order_id'], $need_pay, $title);
    if ($result['result_code']!='SUCCESS'){
        file_put_contents('pay2.log',json_encode($result));
        $obj->r = '支付失败' . $result['return_msg'];
        CommonUtil::return_info($obj);
    }

    $now=time();
    $result['timeStamp'] = $now;
    $result['package'] = 'prepay_id='.$result['prepay_id'];
    $result['paySign'] = $wxPay->sign(array('appId'=>WxPayConfig::APPID,
        'nonceStr'=>$result['nonce_str'],'package'=>$result['package'],'signType'=>'MD5','timeStamp'=>$now));
    $obj->data = $result;
}

