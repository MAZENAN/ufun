<?php
/**
 * 搜索相关
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : null;

try{
    switch ($do){
        case 'all_goods':
            goods_list();
            break;
        case 'hot_words':
            get_hot_words();
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
//    var_dump($e->getMessage());
    $obj->r = '接口错误';
    CommonUtil::return_info($obj);
}


$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 商品列表
 */
function goods_list() {
    global $obj;

    $keywords = isset($_POST['wd']) ? trim($_POST['wd']) : null;
    $sid = IPost('sid');
    if (is_null($keywords)){
        $obj->r = '关键词不能为空';
        CommonUtil::return_info($obj);
    }
    if ($sid<=0){//TODO 检查学校状态
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $select = new Select('@pf_goods AS g');
    $select->join('@pf_merchant AS m');
    $select->find('g.id AS gid,g.title,g.img,g.market_price AS price,m.id AS mid');
    $select->like_search('AND g.title LIKE ?',$keywords);
    $select->where('AND g.merchant_id=m.id AND g.allow=1 AND g.deleted=0');
    $select->where('AND m.status=1 AND m.allow=1 AND m.supp_schools REGEXP ?',['"' . $sid . '"']);//TODO 店铺状态
    $list = $select->getPagelist(10);
    $rows = $list->getlist();
    foreach ($rows as $k=>$v){
        $rows[$k]['img'] = replace_image(1,$v['img']);
    }

    $obj->data = ['list'=>$rows];
}

function get_hot_words() {
    global $obj;

   $words_rows = DB::getlist('SELECT word FROM @pf_hot_words WHERE allow=1 ORDER BY sort ASC');
    $obj->data = [
        'list' => $words_rows
    ];
}

