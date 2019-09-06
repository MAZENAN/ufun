<?php

require 'include.inc.php';
import('libs.*');

class ApiController extends Controller {

    public function indexAction() {
        $wechatObj = new Wechat();
        if (!isset($_GET['echostr'])) {
            $wechatObj->responseMsg();
        } else {
            $wechatObj->valid();
        }
    }

}

Config::load('webchat');
APP::SimpleRun();
