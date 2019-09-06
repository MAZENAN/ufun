<?php

class Wxpay {

    static public function send($v_oid, $v_amount, $subject, &$error) {

        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        if ($openId) {
            //print_r($openId);

            $input = new WxPayUnifiedOrder();
            $input->SetBody($subject);
            $input->SetOut_trade_no($v_oid);
            $input->SetTotal_fee($v_amount*100);
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetNotify_url("http://" . $_SERVER['HTTP_HOST'] . "/payment/wxpay_notify.html");
            $input->SetTrade_type("JSAPI");


            $input->SetOpenid($openId);
            $order = WxPayApi::unifiedOrder($input);
            $jsApiParameters = $tools->GetJsApiParameters($order);
            
            $jsApiParameters = json_decode($jsApiParameters,true);
            $jsApiParameters['timeStamp']  = "".time()."";
            
            
            return(json_encode($jsApiParameters));
        } else {
            return false;
        }
    }

}
