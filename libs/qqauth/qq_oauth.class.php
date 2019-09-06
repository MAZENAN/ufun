<?php

class QauthRecorder {

    private static $data;

    public function __construct() {
        if (empty($_SESSION['QC_userData'])) {
            self::$data = array();
        } else {
            self::$data = $_SESSION['QC_userData'];
        }
    }

    public function write($name, $value) {
        self::$data[$name] = $value;
    }

    public function read($name) {
        if (empty(self::$data[$name])) {
            return null;
        } else {
            return self::$data[$name];
        }
    }

    public function delete($name) {
        unset(self::$data[$name]);
    }

    function __destruct() {
        $_SESSION['QC_userData'] = self::$data;
    }

}

class QqOauth {

    const VERSION = "2.0";
    const GET_AUTH_CODE_URL = "https://graph.qq.com/oauth2.0/authorize";
    const GET_ACCESS_TOKEN_URL = "https://graph.qq.com/oauth2.0/token";
    const GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";
    const GET_INFO = 'https://graph.qq.com/user/get_user_info';

    protected $recorder;

    function __construct() {
        $this->recorder = new QauthRecorder();
    }

    public function qq_login($appid, $callback, $scope) {
        $state = md5(uniqid(rand(), TRUE));
        $this->recorder->write('state', $state);
        $keysArr = array(
            "response_type" => "code",
            "client_id" => $appid,
            "redirect_uri" => $callback,
            "state" => $state,
            "scope" => $scope
        );
        $login_url = HttpRequest::combineURL(self::GET_AUTH_CODE_URL, $keysArr);
        header("Location:$login_url");
    }

    public function qq_callback($appid, $callback, $appkey) {
        $state = $this->recorder->read("state");
        //--------验证state防止CSRF攻击
        if (SGet('state') != $state) {
            return false;
        }
        //-------请求参数列表
        $keysArr = array(
            "grant_type" => "authorization_code",
            "client_id" => $appid,
            "redirect_uri" => urlencode($callback),
            "client_secret" => $appkey,
            "code" => SGet('code')
        );
        //------构造请求access_token的url
        $token_url = HttpRequest::combineURL(self::GET_ACCESS_TOKEN_URL, $keysArr);
        $response = HttpRequest::get_contents($token_url);
        if (strpos($response, "callback") !== false) {
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
            $msg = json_decode($response);
            if (isset($msg->error)) {

                return($msg->error_description);
            }
        }
        $params = array();
        parse_str($response, $params);
        $this->recorder->write("access_token", $params["access_token"]);
        return $params["access_token"];
    }

    public function get_openid() {
        //-------请求参数列表
        $keysArr = array(
            "access_token" => $this->recorder->read("access_token")
        );
        $graph_url = HttpRequest::combineURL(self::GET_OPENID_URL, $keysArr);
        $response = HttpRequest::get_contents($graph_url);
        //--------检测错误是否发生
        if (strpos($response, "callback") !== false) {
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
        }
        $user = json_decode($response);
        if (isset($user->error)) {
            // echo "ssssss";
            die($msg->error_description);
        }
        //------记录openid
        $this->recorder->write("openid", $user->openid);
        $this->recorder->write("client_id", $user->client_id);
        return $user->openid;
    }

    public function get_info() {



        $keysArr = array(
            "access_token" => $this->recorder->read("access_token"),
            "oauth_consumer_key" => $this->recorder->read("client_id"),
            "openid" => $this->recorder->read("openid")
        );

        $graph_url = HttpRequest::combineURL(self::GET_INFO, $keysArr);
        $response = HttpRequest::get_contents($graph_url);
        return($response);
    }

}
