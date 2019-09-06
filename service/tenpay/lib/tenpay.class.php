<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tenpay
 *
 * @author WJ008
 */
class Tenpay {

    private $partner, $key, $return_url, $notify_url;

    function __construct($partner, $key, $return_url, $notify_url) {
        $this->partner = $partner;
        $this->key = $key;
        $this->return_url = $return_url;
        $this->notify_url = $notify_url;
    }

    function send($oid, $subject, $body, $total = 0.01, $attach = '') {
        if ('1900000113' == $this->partner) {
            $total = 0.01;
        }
        $vals = array();
        $vals['sign_type'] = 'MD5';
        $vals['input_charset'] = 'UTF-8';
        $vals['return_url'] = $this->return_url;
        $vals['notify_url'] = $this->notify_url;
        $vals['partner'] = $this->partner;
        $vals['fee_type'] = '1';
        $vals['spbill_create_ip'] = $this->getip();
        if (!empty($attach)) {
            $vals['attach'] = $attach;
        }
        $vals['subject'] = $subject;
        $vals['body'] = $body;
        $vals['out_trade_no'] = $oid;
        $vals['total_fee'] = intval($total * 100);
        ksort($vals);
        $linkarr = array();
        $linkmd5s = array();
        foreach ($vals as $k => $value) {
            $linkarr[] = $k . '=' . urlencode($value);
            $linkmd5s[] = $k . '=' . $value;
        }
        $link = join('&', $linkmd5s);
        $link_md5 = strtoupper(md5($link . '&key=' . $this->key));
        $link = join('&', $linkarr) . '&sign=' . $link_md5;
        header("Content-type:text/html;charset=utf-8");
        header('Location: https://gw.tenpay.com/gateway/pay.htm?' . $link);
    }

    function verify() {
        $sign = $_GET['sign'];
        unset($_GET['sign']);
        unset($_GET['_Area']);
        unset($_GET['controller']);
        unset($_GET['action']);
        ksort($_GET);
        $linkarr = array();
        foreach ($_GET as $k => $value) {
            $linkarr[] = $k . '=' . $value;
        }
        $link = join('&', $linkarr);
        $md5 = strtoupper(md5($link . '&key=' . $this->key));
        if (intval($_GET['trade_state']) != 0)
            return false;
        return $md5 == $sign;
    }

    function report($success = FALSE) {
        if ($success) {
            die('success');
        }
        die('fail');
    }

    function get_result() {
        $vals = array();
        $vals['attach'] = isset($_GET['attach']) ? $_GET['attach'] : '';
        $vals['bank_billno'] = isset($_GET['bank_billno']) ? $_GET['bank_billno'] : '';
        $vals['oid'] = isset($_GET['out_trade_no']) ? $_GET['out_trade_no'] : '';
        $vals['total'] = isset($_GET['total_fee']) ? (intval($_GET['total_fee']) / 100) : 0;
        return $vals;
    }

    private function getip() {
        if (isset($HTTP_SERVER_VARS ["HTTP_X_FORWARDED_FOR"]) && $HTTP_SERVER_VARS ["HTTP_X_FORWARDED_FOR"]) {
            $ip = $HTTP_SERVER_VARS ["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($HTTP_SERVER_VARS ["HTTP_CLIENT_IP"]) && $HTTP_SERVER_VARS ["HTTP_CLIENT_IP"]) {
            $ip = $HTTP_SERVER_VARS ["HTTP_CLIENT_IP"];
        } elseif (isset($HTTP_SERVER_VARS ["REMOTE_ADDR"]) && $HTTP_SERVER_VARS ["REMOTE_ADDR"]) {
            $ip = $HTTP_SERVER_VARS ["REMOTE_ADDR"];
        } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = "0.0.0.0";
        }
        return trim($ip);
    }

}
