<?php
/**
 * 店铺相关
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;
$do = isset($_POST['do']) ? trim($_POST['do']) : '';
$uid = IPost('uid');
$mid = IPost('mid');

if ($mid<=0 || $uid<=0){
    $obj->r='参数错误';
    CommonUtil::return_info($obj);
}
$all_row = check_and_get_merch($uid,$mid);
if (empty($all_row)){
    $obj->r = '商户不存在';
    CommonUtil::return_info($obj);
}

try{
    switch ($do){
        case 'detail':
            store_detail();
            break;
        case 'allow':
            store_info_modify('allow');
            break;
        default :
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
 * 店铺详情
 */
function store_detail() {
    global $obj,$all_row;

    $ret = [];
    $ret['name'] = $all_row['merch']['name'];
    $ret['logo'] = replace_image(0,$all_row['merch']['logo']);
    $ret['status'] = $all_row['merch']['status'];
    $ret['status_desc'] = CommonUtil::status_desc($ret['status']);
    $ret['allow'] = $all_row['merch']['allow'];
    $ret['allow_desc'] = CommonUtil::allow_desc($ret['allow']);

    $obj->data = $ret;
}

/**
 * 店铺信息修改
 */
function store_info_modify($op) {
    global $obj,$mid;

    $merch_update = [];
    $r = '操作成功';
    switch ($op){
        case 'allow':
            $status = isset($_POST['status']) ? trim($_POST['status']) : '';
            if (!in_array($status,['off','on'])){
                $obj->r = '参数错误';
                CommonUtil::return_info($obj);
            }
            $allow = ['off'=>0,'on'=>1][$status];
            $merch_update = compact('allow');
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }

    DB::update('@pf_merchant',$merch_update,$mid);
    $obj->r = $r;
}