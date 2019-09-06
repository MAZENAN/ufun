<?php

require 'include.inc.php';
Config::load('upload');

class UeUpfileController extends Controller {

    //通用上传 兼容xheditor
    function indexAction() {
        $this->doact('*', true);
    }

    //百度编辑器获取配置文件
    function configAction() {
        /* 上传图片配置项 */
        $config = array(
            "imageActionName" => "upfile", /* 执行上传图片的action名称 */
            "imageFieldName" => "upfile", /* 提交的图片表单名称 */
            "imageMaxSize" => C('uploadMaxSize'), /* 上传大小限制，单位B */
            "imageAllowFiles" => array(".png", ".jpg", ".jpeg", ".gif", ".bmp"), /* 上传图片格式显示 */
            "imageCompressEnable" => true, /* 是否压缩图片,默认是true */
            "imageCompressBorder" => 1600, /* 图片压缩最长边限制 */
            "imageInsertAlign" => "none", /* 插入的图片浮动方式 */
            "imageUrlPrefix" => C('QiniuRoot'), /* 图片访问路径前缀 */
            /* 涂鸦图片上传配置项 */
            "scrawlActionName" => "scrawl", /* 执行上传涂鸦的action名称 */
            "scrawlFieldName" => "upfile", /* 提交的图片表单名称 */
            "scrawlMaxSize" => C('uploadMaxSize'), /* 上传大小限制，单位B */
            "scrawlUrlPrefix" => "", /* 图片访问路径前缀 */
            "scrawlInsertAlign" => "none",
            /* 截图工具上传 */
            "snapscreenActionName" => "upfile", /* 执行上传截图的action名称 */
            "snapscreenUrlPrefix" => "", /* 图片访问路径前缀 */
            "snapscreenInsertAlign" => "none", /* 插入的图片浮动方式 */

            /* 抓取远程图片配置 */
            "catcherLocalDomain" => array("127.0.0.1", "localhost", "img.baidu.com"),
            "catcherActionName" => "upfile", /* 执行抓取远程图片的action名称 */
            "catcherFieldName" => "source", /* 提交的图片列表表单名称 */
            "catcherUrlPrefix" => "", /* 图片访问路径前缀 */
            "catcherMaxSize" => C('uploadMaxSize'), /* 上传大小限制，单位B */
            "catcherAllowFiles" => array(".png", ".jpg", ".jpeg", ".gif", ".bmp"), /* 抓取图片格式显示 */

            /* 上传视频配置 */
            "videoActionName" => "upfile", /* 执行上传视频的action名称 */
            "videoFieldName" => "upfile", /* 提交的视频表单名称 */
            "videoUrlPrefix" => "", /* 视频访问路径前缀 */
            "videoMaxSize" => C('uploadMaxSize'), /* 上传大小限制，单位B，默认100MB */
            "videoAllowFiles" => array(
                ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
                ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"), /* 上传视频格式显示 */

            /* 上传文件配置 */
            "fileActionName" => "upfile", /* controller里,执行上传视频的action名称 */
            "fileFieldName" => "upfile", /* 提交的文件表单名称 */
            "fileUrlPrefix" => "", /* 文件访问路径前缀 */
            "fileMaxSize" => C('uploadMaxSize'), /* 上传大小限制，单位B，默认50MB */
            "fileAllowFiles" => C('uploadAllowFiles'), /* 上传文件格式显示 */
            /* 列出指定目录下的图片 */
            "imageManagerActionName" => "listimage", /* 执行图片管理的action名称 */
            "imageManagerListPath" => C('imageManagerListPath'), /* 指定要列出图片的目录 */
            "imageManagerListSize" => C('imageManagerListSize'), /* 每次列出文件数量 */
            "imageManagerUrlPrefix" => "", /* 图片访问路径前缀 */
            "imageManagerInsertAlign" => "none", /* 插入的图片浮动方式 */
            "imageManagerAllowFiles" => C('uploadAllowFiles'), /* 列出的文件类型 */

            /* 列出指定目录下的文件 */
            "fileManagerActionName" => "listfile", /* 执行文件管理的action名称 */
            "fileManagerListPath" => C('fileManagerListPath'), /* 指定要列出文件的目录 */
            "fileManagerUrlPrefix" => "", /* 文件访问路径前缀 */
            "fileManagerListSize" => C('fileManagerListSize'), /* 每次列出文件数量 */
            "fileManagerAllowFiles" => C('uploadAllowFiles')
                /* 列出的文件类型 */
        );
        die(json_encode($config));
    }

    //百度编辑器上传图片
    function upfileAction() {
        $upload = new Uploader('upfile', Config::getValues());
        if ($upload->upFile()) {
            $upload->saveFile();
        }
        $info = $upload->getFileInfo();
        echo '';
        die(json_encode($info));
    }

    function upfileAjaxAction() {
        $this->upfileAction();
    }

    function scrawlAction() {
        Config::set('oriName', 'scrawl.png');
        $upload = new Uploader('upfile', Config::getValues());
        if ($upload->upBase64()) {
            $upload->saveFile();
        }
        $info = $upload->getFileInfo();
        die(json_encode($info));
    }

    function scrawlAjaxAction() {
        $this->scrawlAction();
    }

    //列出文件--------
    function listfileAction() {
        $allowFiles = C('uploadAllowFiles');
        $listSize = C('fileManagerListSize');
        $path = C('fileManagerListPath');
        $data = $this->getfilelist($allowFiles, $listSize, $path);
        die(json_encode($data));
    }

    function listfileAjaxAction() {
        $this->listfileAction();
    }

    //列出图片--------
    function listimageAction() {
        $allowFiles = C('uploadAllowFiles');
        $listSize = C('imageManagerListSize');
        $path = C('imageManagerListPath');
        $data = $this->getfilelist($allowFiles, $listSize, $path);
        die(json_encode($data));
    }

    function listimageAjaxAction() {
        $this->listimageAction();
    }

    function catchimageAction() {
        $this->listimageAction();
    }

    private function getfilelist($allowFiles, $listSize, $path) {
        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);
        $size = IGet('size', $listSize);
        $start = IGet('start');
        $end = $start + $size;
        /* 获取文件列表 */
        $path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "" : "/") . $path;
        $files = $this->getfiles($path, $allowFiles);
        if (!count($files)) {
            return array(
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files)
            );
        }

        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }

        $result = array(
            "state" => "SUCCESS",
            "list" => $list,
            "start" => $start,
            "total" => count($files)
        );

        return $result;
    }

    private function getfiles($path, $allowFiles, &$files = array()) {
        if (!is_dir($path)) {
            return null;
        }
        if (substr($path, strlen($path) - 1) != '/') {
            $path .= '/';
        }
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getfiles($path2, $allowFiles, $files);
                } else {
                    if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
                        $files[] = array(
                            'url' => substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                            'mtime' => filemtime($path2)
                        );
                    }
                }
            }
        }
        return $files;
    }

}

APP::SimpleRun();
