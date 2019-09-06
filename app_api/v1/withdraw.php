<?php
/**
 * 赏金任务提现
 */
require_once 'base.php';

$obj = new stdClass();
$obj->status = 500;
$uid = IPost('uid');
$do = isset($_POST['do']) ? trim($_POST['do']) : '';

if ($uid<=0) {
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}
$user_row = CommonUtil::get_user($uid,1);
if (!$user_row){
    $obj->r = '用户不存在';
    CommonUtil::return_info($obj);
}

try{
    switch ($do){
        case 'sj_withdraw':
            withdraw('sj');
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    $obj->r = '服务器错误请重试';
    CommonUtil::return_info($obj);
}


$obj->status = 200;
CommonUtil::return_info($obj);


/**
 * 提现sj提现到个人钱包
 * @throws WxPayException
 */
function withdraw($type) {
    global $obj,$user_row,$uid;

    $money = isset($_POST['money']) ? trim($_POST['money']) : null;
    if (is_null($money)||!preg_match('#^[\d]+(\.[\d]{0,2})$#',$money)){
        $obj->r = '输入金额错误';
        CommonUtil::return_info($obj);
    }
    $money = sprintf('%.2f',$money);
    if ($money==0){
        $obj->r = '请输入大于0元的金额';
        CommonUtil::return_info($obj);
    }
    $earn_money = $user_row['earn_money'];
    if (bccomp($earn_money,$money,2)==-1){
        $obj->r = '账户余额不足';
        CommonUtil::return_info($obj);
    }
    require_once ROOT_DIR . 'app_api/public/wxpay/lib/WxPay.Config.php';
    require_once ROOT_DIR . 'app_api/public/wxpay/wxpay.class.php';
    $result =  Wxpay::sendWXpayEnterprisePayment($user_row['openid'],$money,'赏金提现',$user_row['real_name']);
    $withdraw_log = [
        'user_id' => $uid,
        'add_time' => date('Y-m-d H:i:s'),
        'type' => 0
    ];
    if ($result && $result['result_code'] == 'SUCCESS' && $result['return_code'] == 'SUCCESS') {
        $user_update = [
            'earn_money' => DB::sql('ifnull(earn_money,0)-'.$money)
        ];
        DB::update('@pf_member',$user_update,$uid);
        $obj->r = '提现成功,1-3日内会到账您的微信内钱包';
    }else{
        $withdraw_log['ret'] = 0;
        $withdraw_log['log'] = '赏金提现失败';
        if (is_array($result)){
            $withdraw_log['log'] .= json_encode($result);
        }
        DB::insert('@pf_withdraws_log',$withdraw_log);
        $obj->r = '提现失败';
        CommonUtil::return_info($obj);
    }
}
