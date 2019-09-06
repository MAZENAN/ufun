<?php
require_once('base.php');
require_once('wxpayApp/wxpay.class.php');

$xml = file_get_contents('php://input');
logger($xml,"wxpay.log");

$data=simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

if ($data->return_code=='FAIL' ) {
  $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>";
  echo $fail;
  return;
}

$order_id=$data->out_trade_no;
$price=$data->total_fee/100;
$pay_type=5;

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


$row = DB::getone('select * from @pf_study_order where orderid=?', [$order_id]);
if ($row == null) {
    $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[ORDERERROR]]></return_msg>
</xml>";
  echo $fail;
  return;
}elseif ($row['need_topay']!=$price) {
  $fail="<xml>
  <return_code><![CDATA[FAIL]]></return_code>
  <return_msg><![CDATA[PRICEERROR]]></return_msg>
</xml>";
  echo $fail;
  return;
}elseif ($row['status']!=0) {
  $success="<xml>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>";
  echo $success;
  return;
}



if($row['status'] == 0){
    if($row['way'] == 2){
        //判断是否成团
        $order = DB::getone("select count(*) as c , d.group_people from @pf_study_order o join @pf_study_camp_date d on o.date_id = d.id where 
o.way = 2 and o.status = 1 and o.group_id = ?",[$row['group_id']]);
        if(($order['c'] + 1) == $order['group_people']){
            $group = DB::getlist("select id, is_group from @pf_study_order where (status = 1 and  group_id = ?) 
or  id = ?",[$row['group_id'],$row['id']]);
            foreach ($group as $k=>$v){
                DB::update("@pf_study_order",['is_group'=>1],$v['id']);
            }
        }

    }



    if($row['type'] == 1){
        $year = date("Y");
        $date = (date('Y',time())+1).'-12-31 23:59:59';
        $card = DB::getone("select * from @pf_study_member_card where uid = ?",[$row['user_id']]);
        if($card && time() <= strtotime($card['expire'])){
            DB::update("@pf_study_member_card",["year"=> $year,"expire"=>$date,"num"=>DB::sql("ifnull(num,0)+10"),
                "add_time"=>date("Y-m-d H:i:s")],"where uid =". $row['user_id']);
        }elseif($card && time() > strtotime($card['expire'])){
            DB::update("@pf_study_member_card",["year"=> $year,"expire"=>$date,"num"=>10,
                "add_time"=>date("Y-m-d H:i:s")],"where uid =". $row['user_id']);
        }else{
            DB::insert("@pf_study_member_card",["uid"=>$row['user_id'],"year"=> $year,"expire"=>$date,"num"=> 10,"add_time"=>date("Y-m-d H:i:s")]);
        }
    }

    if($row['ref_id'] && $row['commission'] > 0){
        $share = DB::getone("select * from @pf_study_merchant where uid = ?",[$row['ref_id']]);
        if(empty($share)){
            DB::insert("@pf_study_merchant",["uid"=>$row['ref_id'],"account"=>$row['commission'],"add_time"=>date("Y-m-d H:i:s")]);
        }else{
            DB::update("@pf_study_merchant",["account"=>$share['account']+$row['commission']],"where uid =". $row['ref_id']);
        }
        DB::insert("@pf_study_balance_detail",["uid"=>$row['ref_id'],"to_uid"=>$row['user_id'], "camp_id"=>$row['camp_id'],
            "order_id"=>$row['id'],"title"=>'返现',"account"=>'+'.$row['commission'],"status"=>0,"add_time"=>date("Y-m-d H:i:s")]);
    }


}




$vals = array();
if($row['type'] == 1){
    $vals['status'] = 7; //买完年卡 直接改为待评价
}else{
    $vals['status'] = 1; //已支付
}
$vals['pay_time'] = date('Y-m-d H:i:s');
$vals['pay_type'] = $pay_type;
$vals['paid'] = $price;
$vals['source'] = 0;

DB::update('@pf_study_order', $vals, $row['id']);

$success="<xml>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>";
  echo $success;
  return;

?>
