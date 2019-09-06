<?php
/**
 * @api 赏金任务首页
 * @author wangyufan
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';

try{
    switch ($do){
        case 'index':
            index();
            break;
        case 'detail':
            detail();
            break;
        case 'show':
            earn_show();
            break;
        case 'earn_user_list':
            get_earn_users();
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    $obj->r = '服务器错误请重试' .$e->getMessage();
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);


/**
 * @throws Exception
 * 赏金任务首页数据
 */
function index() {
    global $obj;

    $page = IPost('page',1);
    $cate_rows = [];
    $user_rows = [];
    $img_rows = [];

    if ($page==1){
        $cate_rows = DB::getlist('SELECT id,title,type,img FROM @pf_earn_cate WHERE allow=1 ORDER BY sort ASC');
        $user_rows = DB::getlist('SELECT nickname AS name,img_head AS img,earn_total AS money FROM @pf_member WHERE type=1 ORDER BY earn_total AND earn_total>0 DESC LIMIT 0,3');
        foreach ($cate_rows as $k=>$row) {
            $cate_rows[$k]['img'] = replace_image(1,$row['img']);
        }
        foreach ($user_rows as $k=>$row){
            $user_rows[$k]['img'] = replace_image(1,$row['img']);
            $user_rows[$k]['money'] = $row['money'] . '￥';
        }
        $img_path = C('QiniuRoot');
        $img_rows = DB::getlist("SELECT CONCAT('{$img_path}',src) AS img FROM @pf_earn_movepics WHERE allow=1 ORDER BY sort ASC");
    }


    //待领取任务列表
    $select = new Select('@pf_earn_order');
    $select->find('id,status,content AS title,tag,earn_money AS money,start_address AS addr,pay_time AS time,status,order_type');
//    $select->where('AND status =1');
    $select->where('AND status in(1,2,3,6,7)');
    $select->orderby('status ASC,pay_time DESC');
    $list = $select->getPagelist();
    $task_rows = $list->getlist();
    foreach ($task_rows as $k=>$row){
        $task_rows[$k]['title'] = preg_replace('#\d#','*',$row['title']);
        $task_rows[$k]['time'] = CommonUtil::get_last_time(strtotime($task_rows[$k]['time']));
        $task_rows[$k]['money'] .=  '￥';
        if ($row['status']==1){
            $task_rows[$k]['status_desc'] = '待接单';
        }elseif ($row['status']==2){
            $task_rows[$k]['status_desc'] = '配送中';
        }else{
            $task_rows[$k]['status_desc'] = '已完成';
        }
    }

    $obj->data = [
        'imgs' => $img_rows,
        'rank_user' =>$user_rows,
        'cates' => $cate_rows,
        'list' => $task_rows,

    ];
}

function detail() {
    global $obj;

    $cate_id = IPost('cid');
    if ($cate_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    $cate_row = DB::getone('SELECT type,title,allow,label,tip_min,tip_max,rule FROM @pf_earn_cate WHERE id=?',[$cate_id]);


    if ($cate_row['allow']!=1){
        $obj->r = '当前任务已关闭';
        CommonUtil::return_info($obj);
    }

    $tags = explode('|',$cate_row['label']);
    $tip_fee = [
        'min' => $cate_row['tip_min'],
        'max' => $cate_row['tip_max'],
    ];

    $obj->data = [
        'title' => $cate_row['title'],
        'type' => $cate_row['type'],
        'tags' => $tags,
        'fee' => $tip_fee,
        'rule' => $cate_row['rule']
    ];
}

/**
 * 赏金任务详情,从大厅卡片进来的
 */
function earn_show() {
    global $obj;

    $id = IPost('id');
    $user_id = IPost('uid');

    if ($id<=0 || $user_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $earn_order_row = DB::getone('SELECT o.user_id,o.order_type,m.nickname,m.img_head,o.pay_time AS publish_time,o.earn_money as money,o.arrive_time,o.content,m.mobile,m.real_name,o.start_address,o.end_address,o.attachment AS attach,o.status FROM @pf_earn_order AS o LEFT JOIN @pf_member AS m ON o.user_id=m.id WHERE o.id=?',[$id]);
    if (!$earn_order_row || !in_array($earn_order_row['status'],[1,2,3,6,7])){
        $obj->r = '任务不存在';
        CommonUtil::return_info($obj);
    }
    $earn_order_row['content'] = preg_replace('#\d#','*',$earn_order_row['content']);
    $earn_order_row['mobile'] = substr($earn_order_row['mobile'],0,2) . '*******' . substr($earn_order_row['mobile'],-2);


    if (in_array($earn_order_row['order_type'],[1,2])){
        unset($earn_order_row['attach']);
    }
    if ($earn_order_row['order_type']==3){
        unset($earn_order_row['end_address']);
        $earn_order_row['attach'] =  replace_image(0,$earn_order_row['attach']);
    }
//    unset($earn_order_row['status']);

    $earn_order_row['real_name'] = empty($earn_order_row['real_name']) ? $earn_order_row['nickname'] : $earn_order_row['real_name'];
    $earn_order_row['img_head'] = replace_image(1,$earn_order_row['img_head']);

    $user_row = DB::getone('SELECT type,status,bind_mobile FROM @pf_member WHERE id=?',[$user_id]);

    if (!$user_row || $user_row['type']!=1){
        $obj->r = '当前用户不存在';
    }

    $ret = $earn_order_row;
    $ret['user_status'] = $user_row['status'];
    $ret['bind_mobile'] = $user_row['bind_mobile'];
    $obj->data = $ret;
}

/**
 * 赏金用户排行
 */
function get_earn_users() {
    global $obj;
    $select = new Select('@pf_member');
    $select->find('nickname AS name,img_head AS img,earn_total AS money');
    $select->where("and type=1 AND earn_total>0");
    $select->orderby('earn_total','desc');
    $list =  $select->getPagelist(10);
    $rows = $list->getlist();
    foreach ($rows as $k=>$row) {
        $rows[$k]['img'] = replace_image(1,$row['img']);
    }
    $obj->data = [
        'user_list' => $rows
    ];
}


