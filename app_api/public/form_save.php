<?php
require_once('base.php');

$obj = new stdClass;
$obj->status = 500;

$uid         = IPost('uid');
$openid      = isset($_POST['openid']) ? trim($_POST['openid']) : null;
$fid         = isset($_POST['fid']) ? trim($_POST['fid']) : null;

if ($uid<=0 || is_null($openid) || is_null($fid)) {
	$obj->r = "参数错误";
    CommonUtil::return_info($obj);
}

$form_insert = [
    "user_id"=>$uid,
    "openid"=>$openid,
    "form_id"=>$fid,
    "add_time"=>date('Y-m-d H:i:s')
];

$row = DB::getone('SELECT COUNT(*) AS num FROM @pf_wx_form WHERE user_id=? AND DATE(add_time)=CURDATE()',[$uid]);
if ($row['num']<15) {
DB::insert('@pf_wx_form',$form_insert);
}

$obj->status = 200;
CommonUtil::return_info($obj);