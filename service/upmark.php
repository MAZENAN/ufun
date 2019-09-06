<?php

require 'include.inc.php';
Config::load('upload');
import('libs.*');

class UpmarkController {

    //通用上传 兼容xheditor
    function indexAction() {
        $immediate = IGet('immediate');
        $strict_size = IPost('strict_size', 0);
        $upload = new Uploader('filedata', Config::getValues());
        if ($upload->upFile()) {
            $upload->saveFile();
        }
        $info = $upload->getFileInfo();
        //要求严格控制图片大小
        $vals = array();
        if ($strict_size && $info['isimg']) {
            $pic_width = IPost('pic_width', 0);
            $pic_height = IPost('pic_height', 0);
            $path = realpath(ROOT_DIR . ltrim($info['url'], '/'));
            $img = getimagesize($path);
            if (!(empty($img[0]) || empty($img[1]))) {
                if ($pic_width != $img[0] || $pic_height != $img[1]) {
                    unlink($path);
                    $vals['err'] = "请上传 宽为 $pic_width px,高为 $pic_height px 的图片,您目前的尺寸({$img[0]}x{$img[1]})不符合要求。";
                    $vals['msg'] = null;
                    die(json_encode($vals));
                }
            }
        }
        if ($info['isimg'] == 1) {
            $path = realpath(ROOT_DIR . ltrim($info['url'], '/'));
            Wmark::create($path);
        }
        if ($info['state'] != 'SUCCESS') {
            $vals['err'] = $info['state'];
            $vals['msg'] = null;
        } else {
            $msg = array();
            $msg['url'] = $immediate == 1 ? '!' . $info['url'] : $info['url'];
            $msg['localname'] = $info['title'];
            $vals['err'] = '';
            $vals['msg'] = $msg;
        }
        die(json_encode($vals));
    }

}

APP::SimpleRun();
