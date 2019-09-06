<?php

define('DEV_REPORT_CLOSE', true);
date_default_timezone_set('Asia/Shanghai');
define('ROOT_DIR', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'update/');
define('APP_NAME', 'update');
define('APP_URL', '/update');
define('DEV_DEBUG', TRUE);
define('URL_REWRITE', FALSE);
define('CONF_DIR', ROOT_DIR . 'config/');
require ROOT_DIR . 'samao/samaophp.php';