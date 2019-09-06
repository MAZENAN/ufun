<?php
require_once('base.php');

$obj = new stdClass;
$obj->status = 500;

require_once ROOT_DIR."libs/qiniu/vendor/autoload.php";
include  ROOT_DIR."libs/qiniu/vendor/qiniu/php-sdk/src/Qiniu/Auth.php";

$auth = new Auth(C('accessKey'), C('secretKey'));
$bucket = C('Bucket');
$token = $auth->uploadToken($bucket);

if ($token) {
    $obj->status = 200;
    $obj->data = array('token'=>$token);
    CommonUtil::return_info($obj);
}else {
    $obj->r = "获取token失败";
    CommonUtil::return_info($obj);
}
