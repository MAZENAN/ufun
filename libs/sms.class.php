<?php

set_time_limit(0);
define('SCRIPT_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'sms' . DIRECTORY_SEPARATOR);
require_once SCRIPT_ROOT . 'include' . DIRECTORY_SEPARATOR . 'Client.php';
Config::load('sms');

class SMS {

    static $client = null;

    static public function send($mobile, $content) {
        # file_put_contents('sms.log', "准备发送：$content \n", FILE_APPEND);
        if (self::$client == null) {
            $gwUrl = C('sms_gwurl');
            $serialNumber = C('sms_user');
            $password = C('sms_pwd');
            $sessionKey = C('sms_key');
           // $sessionKey = DB::getval('select ssid from @pf_smsssid where id=1');
            #file_put_contents('sms.log', "SSID：$sessionKey 链接： $gwUrl 用户： $serialNumber 密码：$password \n", FILE_APPEND);
            $connectTimeOut = 2;
            $readTimeOut = 10;
            $proxyhost = false;
            $proxyport = false;
            $proxyusername = false;
            $proxypassword = false;
            self::$client = new Client($gwUrl, $serialNumber, $password, $sessionKey, $proxyhost, $proxyport, $proxyusername, $proxypassword, $connectTimeOut, $readTimeOut);
            self::$client->setOutgoingEncoding("utf-8");
            //$statusCode = self::$client->logout();
            $statusCode = self::$client->login($sessionKey);
            if (!($statusCode != null && $statusCode == "0")) {
                file_put_contents('sms.log', "登录状态：$statusCode \n", FILE_APPEND);
                return false;
            }else{
                file_put_contents('sms.log', "登录状态：$statusCode \n", FILE_APPEND);
            }
          //  DB::update('@pf_smsssid', ['ssid' => $sessionKey],["id"=>1]);
        }
        $state = self::$client->sendSMS(array($mobile), $content);
        
        file_put_contents('sms.log', "发送状态：$state \n", FILE_APPEND);
        
        $err = self::$client->getError();
        if ($err) {
            /**
             * 调用出错，可能是网络原因，接口版本原因 等非业务上错误的问题导致的错误
             * 可在每个方法调用后查看，用于开发人员调试
             */
            file_put_contents('sms.log', "发送错误：$err \n", FILE_APPEND);
        }
        return true;
    }

    
     static public function getSmsMoney() {
        # file_put_contents('sms.log', "准备发送：$content \n", FILE_APPEND);
        if (self::$client == null) {
            $gwUrl = C('sms_gwurl');
            $serialNumber = C('sms_user');
            $password = C('sms_pwd');
            $sessionKey = C('sms_key');
           // $sessionKey = DB::getval('select ssid from @pf_smsssid where id=1');
            #file_put_contents('sms.log', "SSID：$sessionKey 链接： $gwUrl 用户： $serialNumber 密码：$password \n", FILE_APPEND);
            $connectTimeOut = 2;
            $readTimeOut = 10;
            $proxyhost = false;
            $proxyport = false;
            $proxyusername = false;
            $proxypassword = false;
            self::$client = new Client($gwUrl, $serialNumber, $password, $sessionKey, $proxyhost, $proxyport, $proxyusername, $proxypassword, $connectTimeOut, $readTimeOut);
            self::$client->setOutgoingEncoding("utf-8");
            //$statusCode = self::$client->logout();
            $statusCode = self::$client->login($sessionKey);
            if (!($statusCode != null && $statusCode == "0")) {
                file_put_contents('sms.log', "登录状态：$statusCode \n", FILE_APPEND);
                return false;
            }else{
                file_put_contents('sms.log', "登录状态：$statusCode \n", FILE_APPEND);
            }
          //  DB::update('@pf_smsssid', ['ssid' => $sessionKey],["id"=>1]);
        }
        $state = "剩余金额：".self::$client->getBalance()." 元 单条价格：".self::$client->getEachFee()." 元";
        return $state;
    }
}
