<?php

class FastRoute {

    private static $Data;
    public static $isInit = false;
    public static $route = null;
    public static $urls = null;

    public static function init(&$route = null) {
        if (self::$isInit) {
            return;
        }
        //动作
        if (!empty($_REQUEST['action'])) {
            $data['act'] = trim($_REQUEST['action']);
        } elseif (!empty($_GET['Act'])) {
            $data['act'] = trim($_GET['Act']);
        } else {
            $data['act'] = 'index';
        }
        //控制器
        if (!empty($_GET['Ctl'])) {
            $data['ctl'] = trim($_GET['Ctl']);
        } else {
            $data['ctl'] = 'index';
        }
        //应用
        if (!empty($_GET['App'])) {
            $data['app'] = trim($_GET['App']);
        } else {
            $data['app'] = trim(APP_URL, '/');
            if (empty($data['app'])) {
                $data['app'] = 'home';
            }
        }
        $tempAJAX = false;
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $tempAJAX = 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
        }
        //判断是否AJAX
        $action = $data['act'];
        if (strlen($action) > 5 && (strtoupper(substr($action, -5)) == '_AJAX')) {
            $tempAJAX = TRUE;
            $data['act'] = substr($action, 0, strlen($action) - 5);
        }
        define('IS_AJAX', $tempAJAX);
        self::$Data = $data;
        $_GET['_URL_'] = $data;
        self::$isInit = true;
    }

    //设置运行路径
    public static function getRunRoot($path = '') {
        return SAMAO_APP_ROOT . $path;
    }

    public static function get($key = '') {
        if (empty($key)) {
            return self::$Data;
        } else {
            return isset(self::$Data[$key]) ? self::$Data[$key] : '';
        }
    }

    //默认的TP模式
    public static function getUrl($name, $args = array()) {
        if (!self::$isInit) {
            return '';
        }
        if (!isset($args['app'])) {
            $args['app'] = Route::get('app');
        }
        if (!isset($args['ctl'])) {
            $args['ctl'] = Route::get('ctl');
        }
        $url = '';
        if ($args['app'] == 'home') {
            $url = '/';
        } else {
            $url = '/' . $args['app'] . '/';
        }
        $url.='?Ctl=' . $args['ctl'];
        if (isset($args['act'])) {
            $url.='&Act=' . $args['act'];
        }
        return SAMAO_APP_ROOT . $url;
    }

}
