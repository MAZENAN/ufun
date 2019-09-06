<?php

define('DEV_REPORT_CLOSE', true);
date_default_timezone_set('Asia/Shanghai');
define('ROOT_DIR', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'service/');
define('APP_NAME', 'service');
define('APP_URL', '/service');
define('DEV_DEBUG', TRUE);
define('URL_REWRITE', FALSE);
define('CONF_DIR', ROOT_DIR . 'config/');
require ROOT_DIR . 'samao/samaophp.php';

