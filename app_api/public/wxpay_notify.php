<?php

require_once('base.php');

require_once('wxpay/wxpay.class.php');

$xml = file_get_contents('php://input');
logger($xml,"wxpay.log");

$data=simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

if (!$data || $data->return_code=='FAIL') {
    $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>";
    echo $fail;
    return;
}

$order_id=$data->out_trade_no;
$price=$data->total_fee/100;
$pay_type=1;

if (is_null($order_id)||is_null($price)||is_null($pay_type)) {
    $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[PARAMETERERROR]]></return_msg>
</xml>";
    echo $fail;
    return;
}

//签名验证
$signData=[];
$signData['appid']=$data->appid;
$signData['bank_type']=$data->bank_type;
$signData['cash_fee']=$data->cash_fee;
$signData['fee_type']=$data->fee_type;
$signData['is_subscribe']=$data->is_subscribe;
$signData['mch_id']=$data->mch_id;
$signData['nonce_str']=$data->nonce_str;
$signData['openid']=$data->openid;
$signData['out_trade_no']=$data->out_trade_no;
$signData['result_code']=$data->result_code;
$signData['return_code']=$data->return_code;
$signData['time_end']=$data->time_end;
$signData['total_fee']=$data->total_fee;
$signData['trade_type']=$data->trade_type;
$signData['transaction_id']=$data->transaction_id;

$wxPay = new Wxpay();
$paySign = $wxPay->sign($signData);
logger($paySign.'-----'.$data->sign,"wxpay.log");

if ($paySign!=$data->sign) {

    $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[SIGNERROR]]></return_msg>
</xml>";
    echo $fail;
    return;
}

$order_row = [];
$str = substr($order_id,0,2);
if ($str == 'SJ'){
    $order_row = DB::getone('SELECT id,status,need_pay,valid_duration FROM @pf_earn_order WHERE order_id=?', [$order_id]);
}else{
    $order_row = DB::getone('SELECT id,status,goods_amount FROM @pf_order WHERE order_id=?', [$order_id]);
}

if (!$order_row) {
    $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[ORDERERROR]]></return_msg>
</xml>";
    echo $fail;
    return;
}

if ($str == 'SJ'){
    $need_pay = $order_row['need_pay'];
}else{
    $need_pay = $order_row['goods_amount'];
}

if ($need_pay!=$price) {

    $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[PRICEERROR]]></return_msg>
</xml>";
    echo $fail;
    return;
}elseif ($order_row['status']!=0) {
    $success="<xml>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>";
    echo $success;
    return;
}

$vals = array();
$vals['status'] = 1; //已支付
$vals['pay_time'] = date('Y-m-d H:i:s');
$vals['pay_type'] = $pay_type;
$vals['paid'] = $price;
$vals['trans_id'] = $data->transaction_id;

if ($str == 'SJ'){
    $vals['expire_time'] = time()+$order_row['valid_duration'];
    DB::update('@pf_earn_order', $vals, $order_row['id']);

}else{
    try{
    DB::update('@pf_order', $vals, $order_row['id']);
   $order_goods_rows = DB::getlist('SELECT goods_id,total FROM @pf_order_goods WHERE order_id=?',[$order_row['id']]);
   foreach ($order_goods_rows as $row){
       $total = $row['total'];
       DB::update('@pf_goods',['sales_real'=> DB::sql("ifnull(sales_real,0)+{$total}")],$row['goods_id']);
   }

   // 打印订单   飞鹅打印机

        printerStr($order_id);
    }catch (\Exception $e){
       logger($e->getMessage(),'printerStr11111.log');
    }

}

$success="<xml>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>";
echo $success;
return;



    //经过各种条件查询数据库得到客户下单的订单信息。。。。。
//    static $orderInfo;
//    $orderInfo = '<CB>UFUN校园</CB><BR>';
//    $orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
//    $orderInfo .= '--------------------------------<BR>';
//    $orderInfo .= '饭　　　　　 　10.0   10  10.0<BR>';
//    $orderInfo .= '炒饭　　　　　 10.0   10  10.0<BR>';
//    $orderInfo .= '蛋炒饭　　　　 10.0   100 100.0<BR>';
//    $orderInfo .= '鸡蛋炒饭　　　 100.0  100 100.0<BR>';
//    $orderInfo .= '西红柿炒饭　　 1000.0 1   100.0<BR>';
//    $orderInfo .= '西红柿鸡蛋炒饭 15.0   1   15.0<BR>';
//    $orderInfo .= '西红柿鸡蛋炒饭 15.0   10   150.0<BR>';
//    $orderInfo .= '备注：加辣<BR>';
//    $orderInfo .= '--------------------------------<BR>';
//    $orderInfo .= '合计：xx.0元<BR>';
//    $orderInfo .= '送货地点：广州市南沙区xx路xx号<BR>';
//    $orderInfo .= '联系电话：13888888888888<BR>';
//    $orderInfo .= '订餐时间：2014-08-08 08:08:08<BR>';
//    $orderInfo .= '<QR>http://www.feieyun.com</QR>';//把二维码字符串用标签套上即可自动生成二维码


    function printerStr($orderId)
    {
        require_once ROOT_DIR.'/app_api/public/feiEAPI/site.php';
        $order = DB::getone('select * from sl_order where order_id = ? ',[$orderId]);
        $goodsList = DB::getlist('select * from sl_order_goods WHERE order_id = ? ',[$order['id']]);
        $schoolShortName = DB::getval('sl_school','short_title',$order['school_id']);

        file_put_contents('goods_list.log',json_encode($goodsList));
        if(empty($goodsList))
            return false;
        $printInfo  = '';
        $printInfo  .= '<CB>有FUN校园</CB><BR>';
        $printInfo  .= '<CB>（'.$schoolShortName.$order['code'].'）</CB><BR>';
        $printInfo .= '--------------------------------<BR>';
        $printInfo .= '<BOLD>备注：'.$order['remark'].'</BOLD><BR>';
        $printInfo .= '--------------------------------<BR>';
        $printInfo .= '<B>'.$order['arrive_desc'].'</B><BR>';
        $printInfo .= '支付时间：'.$order['pay_time'].'<BR>';
        $printInfo .= '--------------------------------<BR>';
        $printInfo .= '名称              数量    金额  <BR>';  // 名称:18  数量:7   金额:7   （名称 单行最多9个汉字  数量最多 999份  ×999两倍字体占8位宽 小计最大9999.9)
        $printInfo .= '--------------------------------<BR>';



        foreach ($goodsList as $value){

            $shortName = trim($value['short_title']);
            make_goods_short_name($shortName,$printInfo);

            // 如果 有 规格名  spec_name  如：大份 小份等 换行 打印 规格名
            $spec_name = trim($value['spec_name'],'/ ');
            if($spec_name){
                $printInfo .='<BR>';
                make_goods_short_name($spec_name,$printInfo);
            }



//            $printInfo .= '×<CB>'.my_str_pad($value['total'],8-2,2).'</CB>';
            $printInfo .= my_str_pad('×'.$value['total'],7,2);

            $subPrice = number_format($value['total']*$value['market_price'],2);

            $printInfo .= my_str_pad($subPrice,7);

            $printInfo .='<BR>';
        }

        $printInfo .= '--------------------------------<BR>';
        $printInfo .= '<RIGHT>配送费：'.number_format($order['delivery_price'],2).'元</RIGHT>';
        $printInfo .= '--------------------------------<BR>';
        $printInfo .= '<RIGHT>合计：<B>'.number_format($order['paid'],2).'</B>元</RIGHT>';
        $printInfo .= '--------------------------------<BR>';
        $printInfo .= '收货人：'.$order['buyer_info'].'<BR>';
        $printInfo .= '联系电话：'.$order['buyer_phone'].'<BR>';
        $printInfo .= '地址：'.$order['address'].'<BR>';

        $feiEYun = new feiEYun();
        $feiEYun ->feieyunPrint($printInfo);
}

/** 飞鹅 商品清单打印处理
 * @param $input
 * @param $pad_length
 * @param int $times
 * @param string $pad_string
 * @return string
 */
function my_str_pad($input,$pad_length,$times=1,$pad_string=' ')
{
    $len = mb_strwidth($input);
    $difference = $pad_length - $len;
    if($times == 2)
    {
        $input = '<BOLD>'.$input.'</BOLD>';
    }
    if($difference>0){
        return $input.str_repeat($pad_string,$difference);
    }else{
        return $input;
    }
}
function make_goods_short_name($short_name,&$printInfo)
{


    $width = mb_strwidth($short_name);
    if($width>18)
    {
        $title = mb_substr($short_name,0,9); //假如全中文 即使全英文或数字也这样处理
        $printInfo .= my_str_pad($title,18).'<BR>';
        $short_name =  mb_substr($short_name,9);
        make_goods_short_name($short_name,$printInfo);
    }else{
        $printInfo .= my_str_pad($short_name,18);
    }


}

?>
