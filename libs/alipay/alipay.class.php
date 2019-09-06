<?php

Config::setValues(array(
    'alipay_partner' => '2008111122223333',
    'alipay_key' => md5('123456'),
    'alipay_email' => 'test@samaophp.com',
    'alipay_sign_type' => 'MD5',
    'alipay_input_charset' => 'utf-8',
    'alipay_transport' => 'http',
    'alipay_notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/payment/alipay_notify.html',
    'alipay_return_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/payment/alipay_return.html',
    'alipay_show_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/user.html',
));
Config::set('alipay_cacert', dirname(__FILE__) . DS . 'cacert.pem');
Config::set('alipay_log_path', dirname(__FILE__) . DS . 'log.txt');
//网关地址
//Config::set('alipay_gateway_new', 'http://soojcw.duapp.com/alitest/gateway.php?');
Config::load('alipay');

class Alipay {

    static public function send($v_oid, $v_amount, $subject, &$error, $t = 'web',$url=null) {
        if (intval(C('alipay_open')) != 1) {
            $error = '支付宝在线接口尚未开启或配置！';
            return false;
        }
        $alipay_config = array();
        $alipay_config['partner'] = C('alipay_partner');
        $alipay_config['key'] = C('alipay_key');
        $alipay_config['email'] = C('alipay_email');
        $alipay_config['sign_type'] = C('alipay_sign_type');
        $alipay_config['input_charset'] = C('alipay_input_charset');
        $alipay_config['cacert'] = C('alipay_cacert');
        $alipay_config['transport'] = C('alipay_transport');
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = C('alipay_notify_url');
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = C('alipay_return_url');
        
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = $alipay_config['email'];
        //必填
        //商户订单号
        $out_trade_no = $v_oid;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        // $total_fee = 0.01;
        $total_fee = $v_amount;

        //必填
        //订单描述
        $body = "消费描述--{$subject}";
        //商品展示地址
        if (is_null($url)) {
           $show_url = C('alipay_show_url');
        }else{
            $show_url = $url;
        }
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
        //构造要请求的参数数组，无需改动



        if ($t == 'web') {

            $parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => trim($alipay_config['partner']),
                "payment_type" => $payment_type,
                "notify_url" => $notify_url,
                "return_url" => $return_url,
                "seller_email" => $seller_email,
                "out_trade_no" => $out_trade_no,
                "subject" => $subject,
                "total_fee" => $total_fee,
                "body" => $body,
                "show_url" => $show_url,
                "anti_phishing_key" => $anti_phishing_key,
                "exter_invoke_ip" => $exter_invoke_ip,
                "_input_charset" => trim(strtolower($alipay_config['input_charset']))
            );
        } else {

            $parameter = array(
                "service" => "alipay.wap.create.direct.pay.by.user",
                "partner" => trim($alipay_config['partner']),
                "seller_id" => $alipay_config['email'],
                "payment_type" => $payment_type,
                "notify_url" => $notify_url,
                "return_url" => $return_url,
                "out_trade_no" => $out_trade_no,
                "subject" => $subject,
                "total_fee" => $total_fee,
                "show_url" => $show_url,
                "body" => $body,
                //"it_b_pay" => $it_b_pay,
                //"extern_token" => $extern_token,
                "_input_charset" => trim(strtolower($alipay_config['input_charset']))
            );
        }

        //建立请求

        $html_text = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>支付宝即时到账交易接口接口</title></head>';
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text.= $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        $html_text.= '</body></html>';
        return $html_text;
    }

    static public function receive($type = 'notify', &$error) {
        if (intval(C('alipay_open')) != 1) {
            $error = '支付宝在线接口尚未开启或配置！';
            return false;
        }
        $alipay_config = array();
        $alipay_config['partner'] = C('alipay_partner');
        $alipay_config['key'] = C('alipay_key');
        $alipay_config['email'] = C('alipay_email');
        $alipay_config['sign_type'] = C('alipay_sign_type');
        $alipay_config['input_charset'] = C('alipay_input_charset');
        $alipay_config['cacert'] = C('alipay_cacert');
        $alipay_config['transport'] = C('alipay_transport');

        $alipayNotify = new AlipayNotify($alipay_config);

        if ($type == 'notify') {
            $verify_result = $alipayNotify->verifyNotify();
        } else {
            $verify_result = $alipayNotify->verifyReturn();
        }
        if (!$verify_result) {
            $error = '认证失败！';
            return false;
        }
        $out_trade_no = SReq('out_trade_no');
        $trade_status = SReq('trade_status');
        $total_fee = FReq('total_fee');
        $trade_no = SReq('trade_no');
        if ($trade_status == 'TRADE_SUCCESS') {
            $status = 1;
        } elseif ($trade_status == 'TRADE_FINISHED') {
            $status = 2;
        } else {
            $status = -1;
        }
        return array($out_trade_no, $total_fee, $status, $trade_no);
    }

}
