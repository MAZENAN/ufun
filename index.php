<?php

date_default_timezone_set('PRC');
error_reporting(7);
define('DEV_DEBUG', true);
define('DEV_REPORT', false);
//如果不支持URL重写 设置该项为FALSE 采访路径如 /index.php/admin
define('URL_REWRITE', TRUE);
//如果不支持 PATH_INFO 格式 设置该项为 FALSE 采访路径为 /index.php?/admin
define('URL_PATH_INFO', TRUE);
//不使用工具数据库
define('USE_TOOL', true);


$url = preg_replace('@^/index\.php@', '', $_SERVER['REQUEST_URI']);

define('SAMAO_BYTOOL', true);
if (preg_match('@^/admin(/.*)?$@', $url)) {
    define('APP_DIR', './Apps/Admin/');
    define('APP_NAME', 'Admin');
    define('APP_URL', '/admin');
    require './samao/samaophp.php';
    Config::load('admin');
}else {

    header("HTTP/1.0 404 Not Found");die();
    define('APP_DIR', './Apps/Home/');
    define('APP_NAME', 'Home');
    define('APP_URL', '');
    require './samao/samaophp.php';
    Config::load('home');
}
import('libs.*');
Config::load('base');
Config::load('webchat');
//print_r(c("TOKEN"));
//print_r($unionId);

App::Run();




