<?php

@session_start();
date_default_timezone_set('Asia/Shanghai');
define('ROOT_DIR', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'service/alipay');
define('APP_NAME', 'alipay');
define('APP_URL', '/service/alipay');
define('DEV_DEBUG', TRUE);
define('URL_REWRITE', FALSE);
define('CONF_DIR', ROOT_DIR . 'config/');
require ROOT_DIR . 'samao/samaophp.php';
import('libs.*');

class WebController extends Controller {

    public $userid = 0;

    public function __construct() {
        $this->userid = isset($_SESSION['userid']) ? intval($_SESSION['userid']) : 0;
    }

    public function islogin() {
        if ($this->userid == 0) {
            $this->error(NULL, '/user/login.html?url=' . urlencode($_SERVER['REQUEST_URI']), 0);
        }
    }

}
