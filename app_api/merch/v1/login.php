<?php
/**
 * 商户登录
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';

try{
    switch ($do){
        case 'ByPwd':
            login_by_pwd();
            break;
        default :
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch(Exception $e){
    $obj->r= '服务器错误请重试';
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 账号密码登录
 */
function login_by_pwd() {
    global $obj;

    $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
    $pwd = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';

    if (!$mobile || !$pwd){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $user_row = DB::getone('SELECT id,pass FROM @pf_member WHERE mobile=? AND type=2',[$mobile]);
    if (!$user_row || md5($pwd)!=$user_row['pass']){
        $obj->r = '用户名或密码错误，请重试';
        CommonUtil::return_info($obj);
    }
   $merch_row =  DB::getone('SELECT id FROM @pf_merchant WHERE user_id =?',[$user_row['id']]);
    if (!$merch_row){
        $obj->r='商家不存在';
        CommonUtil::return_info($obj);
    }

    $obj->r = '登陆成功';
    $obj->data = [
        'mid' => $merch_row['id'],
        'uid' => $user_row['id'],
    ];
}