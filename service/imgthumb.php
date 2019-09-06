<?php

include 'include.inc.php';

/**
 * 自动处理缩略图==
 */
class ImgThumbController {

    var $SizeConfig = array(
        '70x40' => true,
        '80x60' => true,
        '40x55' => true,
		'200x200' => true,
        '310x230' => true,
		'360x270' => true,
		'350x234' => true,
		 '240x150' => true,
		 '274x158' => true,
		  '120x80' => true,
		    '720x540' => true,
    );

    function indexAction() {
        $filename = isset($_GET['filename']) ? $_GET['filename'] : '';
        $size = isset($_GET['size']) ? $_GET['size'] : '';
        $ext = isset($_GET['ext']) ? $_GET['ext'] : '';
        $mode = isset($_GET['mode']) ? intval($_GET['mode']) : 3;
        if (empty($filename) || empty($size) || empty($ext)) {
            return;
        }
        if ($mode < 1 || $mode > 5) {
            return;
        }
        if (!in_array(strtolower($ext), array('jpg', 'gif', 'png', 'jpeg'))) {
            return;
        }
        $argc = array();
        if (!(isset($this->SizeConfig[$size]) && preg_match('@^([0-9]+)x([0-9]+)$@', $size, $argc))) {
            return;
        }
        $width = intval($argc[1]);
        $height = intval($argc[2]);
        $file = ROOT_DIR . 'upfiles' . DS . 'images' . DS . $filename . '.' . $ext;
        if (!file_exists($file)) {
            return;
        }
        $tofile = ROOT_DIR . 'upfiles' . DS . 'mini_images' . DS . $filename . '_' . $size . '_' . $mode . '.' . $ext;
        $dirname = dirname($tofile);
        Funcs::createdir($dirname);
        $ic = new ImageCrop($file, $tofile);
        $ic->Crop($width, $height, $mode);
        $ic->SaveImage();
        $ic->destory();
        header('Content-type: image/' . strtolower($ext));
        readfile($tofile);
    }

}

APP::SimpleRun();
