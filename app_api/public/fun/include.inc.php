<?php

define('DEV_REPORT_CLOSE', true);
date_default_timezone_set('Asia/Shanghai');
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'update/');
define('APP_NAME', 'update');
define('APP_URL', '/update');
define('DEV_DEBUG', false);
define('URL_REWRITE', FALSE);
define('CONF_DIR', ROOT_DIR . 'config/');

require ROOT_DIR . 'samao/samaophp.php';
require ROOT_DIR . 'libs/comm.class.php';
require ROOT_DIR . 'libs/msg.class.php';
Config::load('push');
