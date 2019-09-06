<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Func
 *
 * @author wj354
 */
class Funcs {

    public static function getIP() {
        if (isset($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]) && $HTTP_SERVER_VARS ["HTTP_X_FORWARDED_FOR"]) {
            $ips = explode(',', $HTTP_SERVER_VARS ["HTTP_X_FORWARDED_FOR"]);
            $ip = trim($ips[0]);
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

    public static function createdir($filedir) {
        if (!is_dir($filedir)) {
            $pfiledir = dirname($filedir);
            self::createdir($pfiledir);
            @mkdir($filedir, 0777);
            @fclose(fopen($filedir . DS . 'index.htm', 'w'));
            @unlink($filedir . DS . 'index.htm');
        }
    }

    public static function randString($len = 4) {
        return substr(str_shuffle('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, $len);
    }

    public static function randNum($len = 4) {
        $chars = "1234567890";
        $string = "";
        for ($i = 0; $i < $len; $i++) {
            $rand = rand(0, strlen($chars) - 1);
            $string .= substr($chars, $rand, 1);
        }
        return $string;
    }

}
