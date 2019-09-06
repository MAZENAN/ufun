<?php

define('DEV_REPORT_CLOSE', true);
date_default_timezone_set('Asia/Shanghai');
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'app_api/');
define('APP_NAME', 'app_api');
define('APP_URL', '/app_api');
define('DEV_DEBUG', false);
define('URL_REWRITE', FALSE);
define('CONF_DIR', ROOT_DIR . 'config/');
require ROOT_DIR . 'samao/samaophp.php';
require ROOT_DIR . 'libs/comm.class.php';
require ROOT_DIR . 'libs/msg.class.php';

Config::load('x');
$webchat=C('v1');
define('APPID', $webchat['appid']);
define('SECRET', $webchat['secret']);