<?php
$qiniu_root = 'https://img.part.cn/';
return array(
    'imageCompressEnable' => true, /* 是否压缩图片,默认是true */
    'imageCompressBorder' => 1600, /* 图片压缩最长边限制 */
    /* 上传保存路径,可以自定义保存路径和文件名格式 */
    'imagePathFormat' => '/ufun/upfiles/images/{yyyy}{mm}/{dd}{time}{rand:4}',
    /* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
    /* {rand:6} 会替换成随机数,后面的数字是随机数的位数 */
    /* {time} 会替换成时间戳 */
    /* {yyyy} 会替换成四位年份 */
    /* {yy} 会替换成两位年份 */
    /* {mm} 会替换成两位月份 */
    /* {dd} 会替换成两位日期 */
    /* {hh} 会替换成两位小时 */
    /* {ii} 会替换成两位分钟 */
    /* {ss} 会替换成两位秒 */
    'filePathFormat' => "/ufun/upfiles/files/{yyyy}{mm}/{dd}{time}{rand:4}",
//    'uploadMaxSize' => 2097152,
    'uploadMaxSize' => 2097152000000,
    'uploadAllowFiles' => array(".png", ".jpg", ".jpeg", ".gif",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"),
    //列出文件配置
    /* 列出指定目录下的图片 */
    "imageManagerListPath" => $qiniu_root, /* 指定要列出图片的目录 */
    "imageManagerListSize" => 20, /* 每次列出文件数量 */

    /* 列出指定目录下的文件 */
    "fileManagerListPath" => $qiniu_root, /* 指定要列出文件的目录 */
    "fileManagerListSize" => 20, /* 每次列出文件数量 */
	
	'ImgThumb'=>array(
		'160x160'=>true,
	),

    /* 七牛存储 */
    // "accessKey" => "cZLI7FrxaaeN9RoyALIGd9GdXoc9EQToI_5774ue", 
    // "secretKey" => "8-RvY35u42vvrsuRuckOwykVimOoifjkE1IO1JfP", 
    // "QiniuRoot" => "http://7xu0h9.com1.z0.glb.clouddn.com/", 
    // "Bucket"=>"ytx-51camp",

//    "accessKey" => "oqbU6MX3pzUzFmCw2yJXsOXOsvvEJ_4JmgSSxmBy",
//    "secretKey" => "IfSSeQA2KHDwd2x1ma-lSXb-ICur97xPvt18ptNh",
//    "QiniuRoot" => "https://img.part.cn/",
//    "Bucket"=>"ytx-51camp",

    "accessKey" => "cZLI7FrxaaeN9RoyALIGd9GdXoc9EQToI_5774ue",
    "secretKey" => "8-RvY35u42vvrsuRuckOwykVimOoifjkE1IO1JfP",
    "QiniuRoot" => $qiniu_root,
    "Bucket"=>"part",
);
