<?php
/**
 * 文章相关
 */
require_once ('base.php');
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';

switch ($do){
    case 'detail':
        detail();
        break;
    default:
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
        break;
}

$obj->status = 200;
CommonUtil::return_info($obj);

function detail() {
    global $obj;
    $id = IPost('id');
    if ($id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    $article_row = DB::getone('SELECT title,content,allow FROM @pf_article WHERE id=?',[$id]);

    $article = [];
    if ($article_row && $article_row['allow']==1){
        $article = $article_row;
        unset($article['allow']);
    }
    $obj->data = [
        'article' =>$article
    ];
}