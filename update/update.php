<?php
/*
 * 用于程序升级的代码
 */
require 'include.inc.php';
#检查数据库是否有版本控制
if (!DbSet::chkField('config', 'version')) {
    DbSet::addField('config', 'version', 'int', 11, 'NULL', '网站版本控制');
    DB::update('@pf_config', ['version' => 0], 1);
}
$version = DB::getval('@pf_config', 'version', 1);
$lastver=$version;
while(0<=$version=$lastver++){
    $filename=  correct_file(APP_DIR.'update.'.$lastver.'.php') ;
    if(!file_exists($filename)){
        break;
    }
    require $filename;
    echo "\n".$filename."补丁更新完成!";
}
DB::update('@pf_config', ['version' => $version], 1);