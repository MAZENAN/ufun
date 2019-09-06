<?php

// 默认配置
Config::setValues(array(
    'weibo_authorize_url' => 'https://api.weibo.com/oauth2/authorize',
    'weibo_access_token_url' => 'https://api.weibo.com/oauth2/access_token',
    'weibo_redirect_uri' => 'http://' . $_SERVER['SERVER_NAME'] . '/login/weibo.html',
));
Config::load('weibo','auth');

class WeiboAuth {

    static public function auth() {
        $weibo_akey = C('weibo_akey');
        $weibo_skey = C('weibo_skey');
        $callback = C('weibo_redirect_uri');
        if (SGet('auth') == 'send') {
            $params = array();
            $params['client_id'] = $weibo_akey;
            $params['redirect_uri'] = $callback;
            $params['response_type'] = 'code';
            $params['state'] = NULL;
            $params['display'] = NULL;
            $login_url = C('weibo_authorize_url') . "?" . http_build_query($params);
            header("Location:$login_url");
            exit;
        }
        $keys = array();
        $keys['code'] = isset($keys['code']) ? $keys['code'] : SReq('code');
        $keys['redirect_uri'] = $callback;
        $auth = new SaeAuth($weibo_akey, $weibo_skey);
		try{
			$token = $auth->getAccessToken('code', $keys);
		}catch(Exception $e){
			 return false;
		}
        if (gettype($token) == 'array' && isset($token['uid'])) {
            return $token['uid'];
        }
        return false;
    }

}
