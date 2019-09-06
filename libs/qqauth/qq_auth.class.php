<?php

Config::setValues(array(
    'qqauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . '/login/qqauth.html',
    'qqauth_scope' => 'get_user_info',
));
Config::load('qqauth', 'auth');

class QqAuth {

    
    static public function info() {
        $auth = new QqOauth();
        $_info = $auth->get_info();
        return ($_info);
        
    }
    
    static public function auth() {
        $appid = C('qqauth_appid');
        $callback = C('qqauth_callback');
        $appkey = C('qqauth_appkey');
        $scope = C('qqauth_scope');
        $auth = new QqOauth();


        if (SGet('auth') == 'send') {
            $auth->qq_login($appid, $callback, $scope);
            exit;
        }
        $token = $auth->qq_callback($appid, $callback, $appkey);
        
       
        //  die($token);
        if (!$token) {
            return false;
        }
        if (strstr("error", $token)) {
            return false;
        }        //  code is reused error
        $openid = $auth->get_openid();

        if (empty($openid)) {
            return false;
        }
        
        
        return $openid;
    }
    
    

}
