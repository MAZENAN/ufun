<?php

if ($argc ==2 && $argv[1]=='-h'){
    echo 'mao命令帮助文档:',"\n";
    $helps = <<<EOF
======================后台辅助1.0======================================================================
     info:    必须保证参数为4个或5个；
     命令格式与参数顺序：php mao make:[] -n:[] -a:[]
     make:ctl|model|view|list
     -n:名称，多个单词用_隔开
     -a:目录中存在的app名
     当用创建的为admin的控制器时添加-all参数可以创建所有,控制器或model为表名是可导入表内字段
=============================================================================================
EOF;
    echo $helps;
    exit;
}

if (!in_array($argc, [4,5])){
    exit('error:输入参数个数有误！输入 php mao -h 查看帮助！');
}

$make = $argv[1];
if (!preg_match('#^make:([a-zA-Z]+)$#',$make,$match)){
    exit('error:您的make格式有误!');
}

$what = $match[1];
$can_make = ['ctl','model','list','view'];
if (!in_array($what,$can_make)){
    exit('error:'.$what.'暂时不能制作！');
}

$make_name = $argv[2];
if (!preg_match('#^-n:([\w]+)$#',$make_name,$match)){
    exit('error:请指定创建名称!');
}
$make_name=$match[1];

$app = $argv[3];
if (!preg_match('#^-a:([a-zA-Z]+)$#',$app,$match)){
    exit('error:请指定创建app!');
}
$app = $match[1];
$app_path = 'Apps/'.ucfirst($app);
if (!file_exists($app_path)){
    exit('指定的app不存在');
}
switch ($what){
    case 'ctl':
        if (isset($argv[4]) && $argv[4] == '-all') {
            make_all($make_name,$app_path);
            exit;
        }
        make_controller($make_name,$app_path);
        break;
    case 'model':
        make_model($make_name,$app_path);
        break;
    case 'list':
        if ('admin' !== strtolower($app)){
            exit('只有App:Admin才能创建list！');
        }
        make_list($make_name,$app_path);
        break;
    case 'view':
        if ('admin' !== strtolower($app)){
            exit('暂时只有App:Admin才能创建view_list！');
        }
        make_view($make_name,$app_path);
        break;
}

/**
 * 创建控制器
 * @param $make_name 控制器名
 * @param $app_path 控制器路径：外部传入app自动拼接
 */
function make_controller($make_name,$app_path){
    $make_name = to_camel($make_name);
    $ctl = strtolower($GLOBALS['app'])==='admin' ? 'SmcmsController' :'IndexController';
    $content=<<<EOF
<?php

class {$make_name}Controller extends {$ctl}{

//    public function listData(\$select) {
//        return parent::listData(\$select);
//    }
}
EOF;
    $dir = $app_path .'/controls' ;
    if (!file_exists($dir)){
        exit('app目录结构缺失！');
    }
    $filename = to_under($make_name).'.ctl.php';
    $path = $dir . '/' .$filename;
    if (!file_exists($path)){
        $res =  file_put_contents($path ,$content);
        if ($res===false){
            exit('创建失败');
        }else{
            echo 'app:'.$GLOBALS['app'].'的'.$make_name.'Controller创建成功';
        }
    }else{
        exit('控制器已经存在');
    }
}

/*
 * 读取db中的字段信息
 */
function read_db_field($table){
    $dbconf = require './config/db.config.php';
    $link = mysqli_connect($dbconf['DB_HOST'],$dbconf['DB_USER'],$dbconf['DB_PWD'],$dbconf['DB_NAME'],$dbconf['DB_PORT']);
    if (!$link) {
        return '';
    }
    $table = $dbconf['DB_PREFIX'] .$table;
    $res = mysqli_query($link,"show full fields from $table");
    if(!$res){
        return '';
    }
    $res = mysqli_fetch_all($res,MYSQLI_ASSOC);
    mysqli_close($link);
    return $res;
}

/*
 * 创建model中fields中字段信息
 */
function make_field($table){
    $res = read_db_field($table);
    if (empty($res)){
        return '';
    }
    unset($res[0]);
    $map = array(
        'int' => 'text',
        'smallint' => 'text',
        'varchar' => 'text',
        'text' => 'textarea',
        'char' => 'text',
        'tinyint' => 'bool',
        'datetime' => 'datetime',
        'bigint' => 'text'
    );
    $arr = '';
    foreach ($res as $r){
        preg_match('@^([a-zA-Z]+)(\(([0-9]*)\))?([ A-zA-Z]*)$@', $r['Type'], $matches);
        $type = isset($map[$matches[1]]) ? $map[$matches[1]] :'text';
        $arr .= <<<EOF
            '{$r['Field']}' => array(
                'label' => '{$r['Comment']}',
                'label_width' => 150,
                'type' => '$type',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),\n
EOF;
    }
    return $arr;
}

/**
 * 创建模型
 * @param $make_name
 * @param $app_path
 */
function make_model($make_name,$app_path){
    $make_name = to_camel($make_name);
    $tb_name = to_under($make_name);
    $pmodel = 'SmcmsModel';
    $field = make_field($tb_name);
    $content=<<<EOF
<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class {$make_name}Model extends {$pmodel} {
    public function __construct(\$modeltype = self::MODEL_ADD) {

        \$this->tbname = '$tb_name';
        \$this->type = 1;
        \$this->title = '';
        \$this->istab = false;
        \$this->tabsplit = false;
        \$this->btns_left = 0;
        parent::__construct(\$modeltype);
    }
    public function fields() {
        return array(
        $field
        );
    }
}
EOF;
    $dir = $app_path .'/models' ;
    if (!file_exists($dir)){
        exit('app目录结构缺失！');
    }
    $filename = to_under($make_name).'.model.php';
    $path = $dir . '/' .$filename;
    if (!file_exists($path)){
        $res =  file_put_contents($path ,$content);
        if ($res===false){
            exit('创建失败');
        }else{
            echo 'app:'.$GLOBALS['app'].'的'.$make_name.'Model创建成功';
        }
    }else{
        exit('模型已经存在');
    }
}

/**
 * 创建list
 * @param $make_name
 * @param $app_path
 */
function make_list($make_name,$app_path){
    $make_name = to_camel($make_name);
    $content=<<<EOF
<?php

return array(
    'model' => '$make_name',
    'search' => NULL,
    'usesql' => '0',
    'sql' => '',
    'sqlargs' => NULL,
    'usingfy' => '1',
    'orderby' => 'id desc',
);
EOF;
    $dir = $app_path .'/lists' ;
    if (!file_exists($dir)){
        exit('app目录结构缺失！');
    }
    $filename = to_under($make_name).'.list.php';
    $path = $dir . '/' .$filename;
    if (!file_exists($path)){
        $res =  file_put_contents($path ,$content);
        if ($res===false){
            exit('创建失败');
        }else{
            echo $make_name.'的list创建成功';
        }
    }else{
        exit('list已经存在');
    }
}

/**
 * 创建view
 */
function make_view($make_name,$app_path){
    $make_name = to_camel($make_name);
    $res = read_db_field(to_under($make_name));
    $table_head = '';
    $table_tds = '';
    if (!empty($res )){
        $arr = array_column($res,'Comment');
        foreach ($arr as $v){
            $table_head .= "<th width=\"10%\">{$v}</th>\n";
        }
    }
    if (!empty($res )){
        $arr = array_column($res,'Field');
        foreach ($arr as $v){
            $table_tds .= "<td align=\"center\">{@\$rs.{$v}@}</td>\n";
        }
    }
    $content=<<<EOF
{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
$table_head
<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
$table_tds
<td align="center">
    <a dialog="1" class="samao-link-minibtn" href="__SELF__/show?id={@\$rs.id@}">详情</a>
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@\$rs.id@}">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@\$rs.id@}">删除</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=\$bar@}</div>
{@/block@}

EOF;
    $dir = $app_path .'/views/layout' ;
    if (!file_exists($dir)){
        exit('app目录结构缺失！');
    }
    $filename = to_under($make_name).'_list.tpl';
    $path = $dir . '/' .$filename;
    if (!file_exists($path)){
        $res =  file_put_contents($path ,$content);
        if ($res===false){
            exit('创建失败');
        }else{
            echo 'app:'.$GLOBALS['app'].'的'.$make_name.'list_view创建成功';
        }
    }else{
        exit('list_view已经存在');
    }
}

function make_all($make_name,$app_path){
    make_controller($make_name,$app_path);
    make_view($make_name,$app_path);
    make_list($make_name,$app_path);
    make_model($make_name,$app_path);
}

/**
 * 蛇形命名
 * @param $name
 * @return string|string[]|null
 */
function to_under($name) {
    if (empty($name)) {
        return $name;
    }
    return preg_replace('@^_@', '', preg_replace_callback('@[A-Z]@', function($val) {
        return '_' . strtolower($val[0]);
    }, $name));
}

/**
 * 驼峰命名
 * @param $name
 * @return string
 */
function to_camel($name) {
    if (empty($name)) {
        return $name;
    }
    return ucfirst(preg_replace_callback('@_[A-Za-z]@', function($val) {
        return strtoupper(substr($val[0], 1, 1));
    }, $name));
}