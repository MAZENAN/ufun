<?php

require_once('base.php');echo "1";return;
require_once('/fun/session.php');

$obj = new stdClass;
$obj->status = 500;

$mobile		    = isset($_POST['mobile'])? trim($_POST['mobile']):NULL;
$pass           = isset($_POST['pass'])? trim($_POST['pass']):NULL;
$sign_sn           = isset($_POST['sign_sn'])? trim($_POST['sign_sn']):NULL;
$uid		    = isset($_POST['uid'])? trim($_POST['uid']):NULL;
if (!is_null($sign_sn)&&!is_null($uid)) {
   $user_status = CommonUtil::verify_user();
   CommonUtil::check_status($user_status);
   $row = DB::getone('select * from @pf_member where id=?', array($uid));
}else{
    if(is_null($mobile)||is_null($pass))
    {
        $obj->r = "normal参数错误";
        CommonUtil::return_info($obj);
        return;
    }

    if (check_mobile($mobile)==false)
    {
        $obj->r = "手机号格式不正确";
        CommonUtil::return_info($obj);
        return;
    }
    $row = DB::getone('select * from @pf_member where mobile=?', array($mobile));
    if ($row == null) {
        $obj->r = "账号不存在";
        CommonUtil::return_info($obj);
        return;
    }
    if (check_pwd($pass)==false)
    {
        $obj->r = "密码格式不正确";
        CommonUtil::return_info($obj);
        return;
    }
    if ($row['lock'] == 1) {
        $obj->r = "对不起，您的账号已被管理员锁定，请联系客服解锁";
        CommonUtil::return_info($obj);
        return;
    }
    if ($row['errtime'] == date('Y-m-d') && $row['errtice'] > 5) {
        $obj->r = "对不起，错误次数过多请隔天在试";
        CommonUtil::return_info($obj);
        return;
    }
    if ($row['pass'] != md5($pass)) {
        DB::update('@pf_member', array('errtime' => date('Y-m-d'), 'errtice' => $row['errtice'] + 1), $row['id']);
        $m = (5 - $row['errtice']);
        if ($m == 0) {
            $obj->r = "用户密码错误,请隔天在试";
            CommonUtil::return_info($obj);
            return;
        } else {
            $obj->r = '用户密码错误,还可以尝试' . $m . '次';
            CommonUtil::return_info($obj);
            return;
        }
    }

    //登陆成功
    $arr = array('last_login_time' => DB::sql('this_login_time'), 'this_login_time' => DB::sql('now()'), 'errtice' => 0);      
    DB::update('@pf_member', $arr, $row['id']);
}



	
$obj_user = new stdClass;
$obj_user->uid=$row['id'];
$obj_user->sign_sn=$sign_sn?$sign_sn:Session::set_token($obj_user->uid);
$obj_user->name=is_null($row['name'])?"":$row['name'];
$obj_user->nickname=is_null($row['nickname']) ?$row['mobile'] : trim($row['nickname']);
$obj_user->telephone=is_null($row['telephone']) ? "" : trim($row['telephone']);
$obj_user->mobile=$row['mobile'];
$obj_user->email=is_null($row['email']) ? "" : trim($row['email']);
$obj_user->remark=is_null($row['remark']) ? "" : trim($row['remark']);
$obj_user->msg_unread_num=msg_unread_num($obj_user->uid);

$obj->status = 200;
$obj->data = $obj_user;
CommonUtil::return_info($obj);
?>