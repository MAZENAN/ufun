<?php
/**
 * 用户相关
 */
require_once 'base.php';

$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '' ;
$uid = IPost('uid');

if ($uid<=0){
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}

$user_row = DB::getone('SELECT nickname,mobile,bind_mobile,status,img_head,balance,earn_money FROM @pf_member WHERE id=?',[$uid]);
if (!$user_row){
    $obj->r = '用户不存在';
    CommonUtil::return_info($obj);
}
$user_row['img_head'] = replace_image(3,$user_row['img_head']);

try{
    switch ($do){
        case 'upload_info':
            upload_info();
            break;
        case 'detail':
            detail();
            break;
        case 'bind_mobile':
            bind_mobile();
            break;
        default:
            break;
    }
}catch (Exception $e){
    $obj->r = '接口错误';
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);


/**
 * 上传认证资料
 */
function upload_info() {
    global $obj,$user_row,$uid;

    if (in_array($user_row['status'],[1,2])){
        $obj->r = '勿重复提交认证';
        CommonUtil::return_info($obj);
    }
    if ($user_row['bind_mobile']==0){
        $obj->r = '请先去绑定手机号';
        CommonUtil::return_info($obj);
    }

    $real_name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $admission_time = isset($_POST['date']) ? trim($_POST['date']) : null;
    $school_id = IPost('sid');
    $stu_card = isset($_POST['stu_card']) ? trim($_POST['stu_card']) : null;
    if (empty($real_name)||empty($admission_time)||$school_id<=0||empty($stu_card)||!preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $admission_time)){
        $obj->r = '上传数据参数错误';
        CommonUtil::return_info($obj);
    }

    $user_update = [
        'real_name' => $real_name,
        'admission_time' => $admission_time,
        'school_id' => $school_id,
        'stu_card' => $stu_card,
        'status' => 1
    ];

    DB::update('@pf_member',$user_update,$uid);
    $obj->r = '提交成功,请耐心等待审核！';
}

/**
 * 用户信息详情
 */
function detail() {
    global $obj,$user_row;
    $obj->data = [
        'detail' =>$user_row
    ];
}

/**
 * 绑定手机号
 */
function bind_mobile() {
    global $obj,$user_row,$uid;

    if ($user_row['bind_mobile']==1){
        $obj->r = '当前用户已绑定手机号！';
        CommonUtil::return_info($obj);
    }

    $by = isset($_POST['by']) ? trim($_POST['by']) : '';

    if (!in_array($by,['x','i'])){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $mobile = '';
    switch ($by){
        case 'x':
            //微信授权手机号绑定
            $code = isset($_POST['code']) ? trim($_POST['code']): null;
            $encryptedData = isset($_POST['encryptedData']) ? urldecode($_POST['encryptedData']): null;
            $iv = isset($_POST['iv']) ? urldecode($_POST['iv']) : null;

            $xappid = APPID;
            $xsecret = SECRET;

            require_once(ROOT_DIR . 'app_api/public/weixin/userinfo/wxBizDataCrypt.php');

            if(is_null($code)||is_null($encryptedData)||is_null($iv))  {
                $obj->r = "客户端参数错误";
                CommonUtil::return_info($obj);
                return;
            }
            $url ='https://api.weixin.qq.com/sns/jscode2session?appid='.$xappid.'&secret='.$xsecret .'&grant_type=authorization_code&js_code='.$code;
            $weixin = getCurl($url);

            $json_obj = json_decode($weixin,true);

            if ($json_obj['errcode']) {
                $obj->r =$json_obj['errmsg'] ;
                CommonUtil::return_info($obj);
                return;
            }
            $session_key  = $json_obj['session_key'];

            $pc = new WXBizDataCrypt($xappid, $session_key);

            $errCode = $pc->decryptData($encryptedData,$iv,$data);

            if ($errCode != 0) {
                $obj->r =$errCode ;
                CommonUtil::return_info($obj);
                return;
            }

            $userinfo=json_decode($data,true);

            if (!isset($userinfo['purePhoneNumber'])){
                $obj->r = '无法获取手机号';
                CommonUtil::return_info($obj);
            }

            $mobile = $userinfo['purePhoneNumber'];

            if (!check_mobile_binded($mobile)){
                $obj->r = '手机号已被绑定';
                CommonUtil::return_info($obj);
            }
            break;
        case 'i':
            //发送验证码绑定
            $mobile = SPost('mobile');
            $code = SPost('code');
            if(!check_mobile($mobile)||!$code){
                $obj->r = '参数错误';
                CommonUtil::return_info($obj);
            }

            //检查手机号是否被绑定
            if (!check_mobile_binded($mobile)){
                $obj->r = '手机号已被绑定';
                CommonUtil::return_info($obj);
            }

            $ip = Funcs::getIP();

            $mocode_log = DB::getone('SELECT * FROM @pf_mbcodelog WHERE uid = ? AND ip = ? ORDER BY id DESC LIMIT 1',[$uid,$ip]);
            if(!$mocode_log){
                $obj->r = "未发送验证码，或者手机号有误";
                CommonUtil::return_info($obj);
            }
            $time = time();
            if($mocode_log['addtime'] + 600 < $time){
                $obj->r = "验证码超时，请重新发送";
                CommonUtil::return_info($obj);
            }
            if($mocode_log['mobile'] != $mobile){
                $obj->r = "手机号码与接收短信的不一致";
                CommonUtil::return_info($obj);
            }
            if($mocode_log['code'] != $code){
                $obj->r = "验证码错误";
                CommonUtil::return_info($obj);
            }
            break;
    }

    DB::update('@pf_member',['mobile'=>$mobile,'bind_mobile'=>1],$uid);

    $obj->r = '绑定成功';
}

/**
 * @param $mobile
 * @return bool
 * @throws Exception
 * 检查手机号是否可以被绑定 true 是 false 否
 */
function check_mobile_binded($mobile) {
    $row = DB::getone('SELECT id FROM @pf_member WHERE mobile=? AND type=1',[$mobile]);
   return empty($row);
}