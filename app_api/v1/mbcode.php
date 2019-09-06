<?php
/**
 * 发送短信验证码
 * TODO 后续调整
 */
require_once('base.php');
require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'sms.class.php');
$obj = new stdClass;
$obj->status = 500;

$uid = IPost('uid');
$mobile = SPost('mobile');
$do = isset($_POST['do']) ? trim($_POST['do']) : '';

if($uid<=0 || !check_mobile($mobile) || !in_array($do,['bind','login','reg'])){
	$obj->r = '参数错误';
	CommonUtil::return_info($obj);
}

switch ($do){
    case 'bind':
        $user_row = DB::getone('SELECT id,bind_mobile FROM @pf_member WHERE type=1 AND mobile=?',[$mobile]);
        if ($user_row){
            $obj->r = '该手机号已被绑定';
            CommonUtil::return_info($obj);
        }
        break;
    case 'login':
        break;
    case 'reg':
        break;
    default:
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
        break;
}

$mbcode = Funcs::randNum(4);
$ip = Funcs::getIP();
$time = time();

$row = DB::getone('SELECT * FROM @pf_mbcodelog WHERE uid=? AND ip=? ORDER BY id DESC LIMIT 1',[$uid,$ip]);
if ($row) {
	if ($row['addtime'] + 60 > $time) {
		$obj->r = "发送太快，请稍后再试！";
		CommonUtil::return_info($obj);
	}
}

//TODO 短信接入
$rs = SMS::sendMbCode($mobile,$mbcode);
$msg = $rs->Message;
DB::insert('@pf_mbcodelog', ['uid' => $uid, 'mobile' => $mobile, 'code' => $mbcode, 'mbcode' => '    验证码：' . $mbcode . ' 结果:' . $msg, 'ip' => $ip, 'addtime' => $time]);
if($msg != 'OK'){
	$obj->r = "发送失败，请稍后重试！";
	CommonUtil::return_info($obj);
}

$obj->r = "发送成功！";
$obj->status = 200;
CommonUtil::return_info($obj);

