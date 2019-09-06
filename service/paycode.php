<?php

@session_start();
require 'include.inc.php';
import('libs.*');

class PaycodeController extends Controller {

    function indexAction() {
        $userid = isset($_SESSION['userid']) ? intval($_SESSION['userid']) : 1;
        $p = new Paycode($userid);
        $code = $p->getCode();
        die(json_encode($code));
    }

}

APP::SimpleRun();
