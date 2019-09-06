<?php
require_once 'base.php';

$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';
$uid = IPost('uid');

if ($uid<=0){
    $obj->r = '参数错误';

}

try{
    switch ($do){
        case 'list':
            address_list();
            break;
        case 'add':
            address_add();
            break;
        case 'detail':
            address_detail();
            break;
        case 'modify':
            address_modify();
            break;
        case 'default';
            set_default();
            break;
        case 'delete':
            address_delete();
            break;
        default :
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    $obj->r = '接口错误请重试' . $e->getMessage();
    CommonUtil::return_info($obj);
}


$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 删除用户地址
 * @throws Exception
 */
function address_delete() {
    global $obj,$uid;

    $addr_id = IPost('id');
    if ($addr_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $addr_row = DB::getone('SELECT user_id FROM @pf_user_address WHERE id=?',[$addr_id]);
    if (!$addr_row || $addr_row['user_id']!=$uid){
        $obj->r = '地址不存在';
        CommonUtil::return_info($obj);
    }
    DB::delete('@pf_user_address',$addr_id);
}

/**
 * 修改地址
 */
function address_modify() {
    global $obj,$uid;

    $gender = IPost('gender');
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : null;
    $school_id = IPost('sid');
    $address = isset($_POST['address']) ? trim($_POST['address']) : null;
    $addr_id = IPost('id');

    if ($gender<0 || is_null($username) || is_null($mobile) || !check_mobile($mobile) || $school_id<=0 || is_null($address) || $addr_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

   $address_row =  DB::getone('SELECT user_id FROM @pf_user_address WHERE id=?',[$addr_id]);
    if (!$address_row || $address_row['user_id']!=$uid){
        $obj->r = '地址不存在';
        CommonUtil::return_info($obj);
    }
    $address_update = [
        'user_id' => $uid,
        'gender' => $gender,
        'username' => $username,
        'mobile' => $mobile,
        'school_id' => $school_id,
        'address' => $address
    ];

    DB::update('@pf_user_address',$address_update,$addr_id);
}

/**
 * 添加地址
 */
function address_add() {
    global $obj,$uid;

    $gender = IPost('gender');
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : null;
    $school_id = IPost('sid');
    $address = isset($_POST['address']) ? trim($_POST['address']) : null;

    if ($gender<0 || is_null($username) || is_null($mobile) || !check_mobile($mobile) || $school_id<=0 || is_null($address)){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $address_insert = [
        'user_id' => $uid,
        'gender' => $gender,
        'username' => $username,
        'mobile' => $mobile,
        'school_id' => $school_id,
        'address' => $address
    ];

    DB::insert('@pf_user_address',$address_insert);
}

/**
 * 地址列表
 */
function address_list() {
    global $obj,$uid;

    $from = isset($_POST['from']) ? trim($_POST['from']) : '';
    $mid = IPost('mid');

    if (!in_array($from,['order','all'])){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    if ($from=='order'){
        if ($mid<=0){
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
        }
       $merchant_row = DB::getone('SELECT supp_schools FROM @pf_merchant WHERE id=?',[$mid]);
        if (!$merchant_row){
            $obj->r = '店铺不存在';
            CommonUtil::return_info($obj);
        }
        $supp_schools = json_decode($merchant_row['supp_schools']);
        if (!$supp_schools){
            throw new Exception();
        }
        //$school_ids = implode(',',$supp_schools);
//        $school_rows = DB::getlist("SELECT m.id,m.gender,m.username,m.mobile,m.address,CONCAT(s.title,s.campaus) as school,m.school_id FROM @pf_user_address AS m INNER JOIN @pf_school AS s ON m.school_id= s.id WHERE s.allow=1 AND m.user_id=? AND m.school_id in($school_ids)",[$uid]);
        $school_rows = DB::getlist("SELECT m.id,m.gender,m.username,m.mobile,m.address,s.title as school,m.school_id FROM @pf_user_address AS m INNER JOIN @pf_school AS s ON m.school_id= s.id WHERE s.allow=1 AND m.user_id=?",[$uid]);

        foreach ($school_rows as $k=>$row){
            if (in_array($row['school_id'],$supp_schools)){
                $school_rows[$k]['alow']=1;
            }else{
                $school_rows[$k]['alow']=0;
            }
        }


    }elseif($from=='all'){
        $school_rows = DB::getlist("SELECT m.id,m.gender,m.username,m.mobile,m.address,s.title as school FROM @pf_user_address AS m INNER JOIN @pf_school AS s ON m.school_id= s.id WHERE s.allow=1 AND m.user_id=?",[$uid]);
    }



    $obj->data = ['list'=>$school_rows];
}

/**
 * 地址详情
 */
function address_detail() {
    global $obj,$uid;

    $addr_id = IPost('id');

    if ($addr_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $address_row = DB::getone('SELECT user_id,gender,username,mobile,school_id,address FROM @pf_user_address WHERE id=?',[$addr_id]);
    if (!$address_row || $address_row['user_id']!=$uid){
        $obj->r = '地址不存在';
        CommonUtil::return_info($obj);
    }
    $school_row = DB::getone("SELECT title as school FROM @pf_school WHERE id=?",[$address_row['school_id']]);
    unset($address_row['user_id']);
    $school = $school_row ? $school_row['school'] : '';
    $address_row['school'] = $school;
    $obj->data = $address_row;
}

/**
 * 设为默认地址
 */
function set_default() {
    global $uid,$obj;
    $addr_id = IPost('id');

   $addr_row =  DB::getone('SELECT user_id,address,username,mobile,gender,school_id FROM @pf_user_address WHERE id=?',[$addr_id]);
   if (!$addr_row || $addr_row['user_id']!=$uid) {
       $obj->r = '地址不存在';
       CommonUtil::return_info($obj);
   }

   DB::update('@pf_user_address',['is_default'=>0],'user_id=? AND is_default=1',[$uid]);
   DB::update('@pf_user_address',['is_default'=>1],$addr_id);

   $username = $addr_row['username'];
   if ($addr_row['gender']==0){
       $username .= '(先生)';
   }elseif ($addr_row['gender']==1){
       $username .= '(女士)';
   }
   $obj->data = [
       'id' => $addr_id,
       'username'=>$username,
       'address' => $addr_row['address'],
       'mobile' => $addr_row['mobile'],
       'sid' =>$addr_row['school_id']
   ];
}