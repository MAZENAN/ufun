<?php
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';

try {
	switch ($do) {
	case 'loginByX':
		weixinXlogin();
		break;
	default:
		$obj->r = '参数错误';
		CommonUtil::return_info($obj);
		break;
	}
} catch (Exception $e) {
	$obj->r = '接口错误，请重试';
	CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 微信小程序授权登录
 */
function weixinXlogin() {
	global $obj;

	$code = isset($_POST['code']) ? trim($_POST['code']) : null;
	$encryptedData = isset($_POST['encryptedData']) ? urldecode($_POST['encryptedData']) : null;
	$iv = isset($_POST['iv']) ? urldecode($_POST['iv']) : null;
	$nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : null;
	$img_head = isset($_POST['img_head']) ? trim($_POST['img_head']) : null;

	if (is_null($code) || is_null($encryptedData) || is_null($iv) || is_null($nickname) || is_null($img_head)) {
		$obj->r = "客户端参数错误";
		CommonUtil::return_info($obj);
		return;
	}

    $xappid = APPID;
    $xsecret = SECRET;
    require_once ROOT_DIR . 'app_api/public/weixin/userinfo/wxBizDataCrypt.php';

    $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $xappid . '&secret=' . $xsecret . '&grant_type=authorization_code&js_code=' . $code;
	$weixin = getCurl($url);

	$json_obj = json_decode($weixin, true);

	if ($json_obj['errcode']) {
		$obj->r = $json_obj['errmsg'];
		CommonUtil::return_info($obj);
		return;
	}
	$openid = $json_obj['openid'];
	$session_key = $json_obj['session_key'];

	$pc = new WXBizDataCrypt($xappid, $session_key);

	$errCode = $pc->decryptData($encryptedData, $iv, $data);

	if ($errCode != 0) {
		$obj->r = $errCode;
		CommonUtil::return_info($obj);
		return;
	}

	$userinfo = json_decode($data, true);
	$unionid = $userinfo['unionId'];

	if (is_null($openid) || is_null($unionid)) {
		$obj->r = "参数错误ee";
		$obj->data = ['openid' => $openid, 'unionid' => $unionid];
		CommonUtil::return_info($obj);
		return;
	}

	$member_row = DB::getone('SELECT id FROM @pf_member where unionid=?', [$unionid]);

	if (!$member_row) {
		//开始注册member表
		$user_insert = [];
		$user_insert['openid'] = $openid;
		$user_insert['unionid'] = $unionid;
		$user_insert['nickname'] = $nickname;
		$user_insert['img_head'] = $img_head;
		$user_insert['addtime'] = date('Y-m-d H:i:s');
		$user_insert['this_login_time'] = date('Y-m-d H:i:s');
		DB::insert('@pf_member', $user_insert);
		$uid = DB::lastId();
	} else {
		$uid = $member_row['id'];
		$user_update['img_head'] = $img_head;
		$user_update['nickname'] = $nickname;
		$user_update['this_login_time'] = date('Y-m-d H:i:s');
		DB::update('@pf_member', $user_update, $uid);
	}

	$obj->data = [
		'uid' => $uid,
		'avator' => replace_image(0, $img_head),
		'openid' => $openid,
	];
}
