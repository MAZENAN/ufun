<?php

require 'include.inc.php';
@session_start();

class CodeController {

    function indexAction() {
        setcookie("WEB", 'www.web0898.com', time() + 60 * 60 * 24 * 30);
        $image = new ValidateCode(100, 40, 4);    //图片长度、宽度、字符个数
        $image->outImg();
        $_SESSION['validationcode'] = $image->checkcode; //存贮验证码到 $_SESSION 中
    }

}

APP::SimpleRun();
