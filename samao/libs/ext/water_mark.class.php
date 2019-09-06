<?php

class WaterMark {

    private $pos = 0;  //水印位置
    private $transparent = 45; //水印透明度
    private $waterStr = 'test';  //水印文字
    private $fontSize = 16; //文字字体大小
    private $fontColor = array(255, 0, 255); //水印文字颜色（RGB）
    private $fontFile = 'arial.ttf'; //字体文件
    private $waterImg = 'logo.png'; //水印图片
    private $forcePng = false;
    private $srcImg = ''; //需要添加水印的图片
    private $img = ''; //图片句柄
    private $water_img = ''; //水印图片句柄
    private $srcImg_info = ''; //图片信息
    private $waterImg_info = ''; //水印图片信息
    private $str_w = ''; //水印文字宽度
    private $str_h = ''; //水印文字高度
    private $x = ''; //水印X坐标
    private $y = ''; //水印y坐标
    private $autoSize = 1; //如果图片过小 自动调整水印大小 0图片过小 放弃添加水印  1超出限制后调整 2为所有图片调整
    private $waterSizeLevel = 1; //自动调整水印比例大小等级
    private $waterTextMargin = 1; //字体边距

    function __construct($img) {
        if (!file_exists($img)) {
            throw new Exception($img . '对不起，水印文件不存在！');
        }
        $this->srcImg = $img;
        $this->imginfo();
    }

    /**
     * 设置水印类型 0图片过小 放弃添加水印  1超出限制后调整 2为所有图片调整
     * @param int $type
     */
    public function setAutoSize($type) {
        $this->autoSize = $type;
    }

    /**
     * 字体边距
     * @param int $margin
     */
    public function setTextMargin($margin) {
        $this->waterTextMargin = $margin;
    }

    /**
     * 设置水印大小限制，背景图的高宽几分之一
     * @param int $type
     */
    public function setWaterSizeLevel($type) {
        if ($type < 1) {
            $type = 1;
        }
        $this->waterSizeLevel = $type;
    }

    /**
     * 设置水印文本
     * @param string $text
     */
    public function setText($text) {
        $this->waterStr = $text;
    }

    /**
     * 设置字体
     * @param int $fontsize
     */
    public function setFontSize($fontsize) {
        $this->fontSize = $fontsize;
    }

    /**
     * 设置字体大小
     * @param string $font
     */
    public function setFont($font) {
        $this->fontFile = $font;
    }

    /**
     * 设置字体颜色
     * @param string|array $color
     */
    public function setfontColor($color) {
        if (empty($color)) {
            $this->fontColor = $this->Color2RGB('#000');
        }
        if (gettype($color) == 'string') {
            $this->fontColor = $this->Color2RGB($color);
        } else {
            $this->fontColor = $color;
        }
    }

    /**
     * 设置水印图片
     * @param string $src
     */
    public function setImgWater($src) {
        $this->waterImg = $src;
        $this->waterimginfo();
    }

    /**
     * 设置位置
     * @param type $pos
     */
    public function setImgPos($pos) {
        $this->pos = $pos;
    }

    /**
     * 强制保存为PNG格式
     * @param type $forcePng
     */
    public function setForcePng($forcePng) {
        $this->forcePng = $forcePng;
    }

    public function setTransparent($trans) {
        $this->transparent = $trans;
    }

    //是否超出范围==
    private function isOutRange() {
        if ($this->srcImg_info[0] <= $this->waterImg_info[0] * $this->waterSizeLevel || $this->srcImg_info[1] <= $this->waterImg_info[1] * $this->waterSizeLevel) {
            return true;
        }
        return false;
    }

    /**
     * 重新计算水印图范围
     */
    private function reSize() {
        $temp = array();
        $temp[0] = $this->srcImg_info[0] / $this->waterSizeLevel;
        $temp[1] = $this->srcImg_info[1] / $this->waterSizeLevel;
        $size = array();
        $size[0] = round($temp[0]);
        $ps = $temp[0] / $this->waterImg_info[0];
        $size[1] = round($this->waterImg_info[1] * $ps);
        if ($size[1] > round($temp[1])) {
            $size[1] = round($temp[1]);
            $ps = $temp[1] / $this->waterImg_info[1];
            $size[0] = round($this->waterImg_info[0] * $ps);
        }
        return $size;
    }

    private function imginfo() {//获取水印图片信息，并加载。
        $this->srcImg_info = getimagesize($this->srcImg);
        switch ($this->srcImg_info[2]) {
            case 3:
                $this->img = imagecreatefrompng($this->srcImg);
                break 1;
            case 2:
                $this->img = imagecreatefromjpeg($this->srcImg);
                break 1;
            case 1:
                $this->img = imagecreatefromgif($this->srcImg);
                break 1;
            default:
                throw new Exception('水印图片（' . $this->srcImg . '）水印图片格式不对，请选择PNG、JPEG、GIF格式的图片。');
        }
    }

    private function waterimginfo() {//获取水印图片并载入。
        $this->waterImg_info = getimagesize($this->waterImg);
        switch ($this->waterImg_info[2]) {
            case 3:
                $this->water_img = imagecreatefrompng($this->waterImg);
                break 1;
            case 2:
                $this->water_img = imagecreatefromjpeg($this->waterImg);
                break 1;
            case 1:
                $this->water_img = imagecreatefromgif($this->waterImg);
                break 1;
            default:
                throw new Exception('水印图片（' . $this->srcImg . '）格式不对，只支持PNG、JPEG、GIF。');
        }
    }

    private function waterpos() {//水印位置算法
        switch ($this->pos) {
            case 0:     //随机位置
                $this->x = rand(0, $this->srcImg_info[0] - $this->waterImg_info[0]);
                $this->y = rand(0, $this->srcImg_info[1] - $this->waterImg_info[1]);
                break 1;
            case 1:     //上左
                $this->x = 0;
                $this->y = 0;
                break 1;
            case 2:     //上中
                $this->x = ($this->srcImg_info[0] - $this->waterImg_info[0]) / 2;
                $this->y = 0;
                break 1;
            case 3:     //上右
                $this->x = $this->srcImg_info[0] - $this->waterImg_info[0];
                $this->y = 0;
                break 1;
            case 4:     //中左
                $this->x = 0;
                $this->y = ($this->srcImg_info[1] - $this->waterImg_info[1]) / 2;
                break 1;
            case 5:     //中中
                $this->x = ($this->srcImg_info[0] - $this->waterImg_info[0]) / 2;
                $this->y = ($this->srcImg_info[1] - $this->waterImg_info[1]) / 2;
                break 1;
            case 6:     //中右
                $this->x = $this->srcImg_info[0] - $this->waterImg_info[0];
                $this->y = ($this->srcImg_info[1] - $this->waterImg_info[1]) / 2;
                break 1;
            case 7:     //下左
                $this->x = 0;
                $this->y = $this->srcImg_info[1] - $this->waterImg_info[1];
                break 1;
            case 8:     //下中
                $this->x = ($this->srcImg_info[0] - $this->waterImg_info[0]) / 2;
                $this->y = $this->srcImg_info[1] - $this->waterImg_info[1];
                break 1;
            default:    //下右
                $this->x = $this->srcImg_info[0] - $this->waterImg_info[0];
                $this->y = $this->srcImg_info[1] - $this->waterImg_info[1];
                break 1;
        }
    }

    public function waterimg() {
        $oldinfo = $this->waterImg_info;
        $resize = null;
        if ($this->autoSize == 2) {
            $resize = $this->reSize();
            $this->waterImg_info[0] = $resize[0];
            $this->waterImg_info[1] = $resize[1];
        } elseif ($this->autoSize == 1) {
            if ($this->isOutRange()) {
                $resize = $this->reSize();
                $this->waterImg_info[0] = $resize[0];
                $this->waterImg_info[1] = $resize[1];
            }
        } else {
            if ($this->isOutRange()) {
                return;
            }
        }
        $this->waterpos();
        $cut = imagecreatetruecolor($this->waterImg_info[0], $this->waterImg_info[1]);
        imagecopy($cut, $this->img, 0, 0, $this->x, $this->y, $this->waterImg_info[0], $this->waterImg_info[1]);
        $pct = $this->transparent;
        if ($resize === null) {
            imagecopy($cut, $this->water_img, 0, 0, 0, 0, $this->waterImg_info[0], $this->waterImg_info[1]);
        } else {
            imagecopyresampled($cut, $this->water_img, 0, 0, 0, 0, $this->waterImg_info[0], $this->waterImg_info[1], $oldinfo[0], $oldinfo[1]);
        }
        imagecopymerge($this->img, $cut, $this->x, $this->y, 0, 0, $this->waterImg_info[0], $this->waterImg_info[1], $pct);
    }

    public function waterstr() {
        $str = mb_convert_encoding($this->waterStr, "html-entities", "utf-8");
        $rect = @imagettfbbox($this->fontSize, 0, $this->fontFile, $str);
        if ($rect == null) {
            throw new Exception('无法成功加载您上传的字体！');
        }
        $w = abs($rect[2] - $rect[6]) + $this->waterTextMargin * 2;
        $h = abs($rect[3] - $rect[7]) + $this->waterTextMargin * 2;
        $this->water_img = imagecreatetruecolor($w, $h);
        imagealphablending($this->water_img, false);
        imagesavealpha($this->water_img, true);
        $white_alpha = imagecolorallocatealpha($this->water_img, 255, 255, 255, 127);
        imagefill($this->water_img, 0, 0, $white_alpha);
        $color1 = imagecolorallocate($this->water_img, 80, 80, 80);
        $color2 = imagecolorallocate($this->water_img, $this->fontColor[0], $this->fontColor[1], $this->fontColor[2]);
        imagettftext($this->water_img, $this->fontSize, 0, $this->waterTextMargin + 1, $this->fontSize + $this->waterTextMargin + 1, $color1, $this->fontFile, $str);
        imagettftext($this->water_img, $this->fontSize, 0, $this->waterTextMargin, $this->fontSize + $this->waterTextMargin, $color2, $this->fontFile, $str);
        $this->waterImg_info = array(0 => $w, 1 => $h);
        $this->waterimg();
    }

    private function Color2RGB($hexColor) {
        if (preg_match('@^rgb\((\d+),\s?(\d+),\s?(\d+)\)$@i', $hexColor, $data)) {
            return array($data[1], $data[2], $data[3]);
        }
        $color = str_replace('#', '', $hexColor);
        if (strlen($color) > 3) {
            $rgb = array(
                hexdec(substr($color, 0, 2)),
                hexdec(substr($color, 2, 2)),
                hexdec(substr($color, 4, 2))
            );
        } else {
            $color = str_replace('#', '', $hexColor);
            $r = substr($color, 0, 1) . substr($color, 0, 1);
            $g = substr($color, 1, 1) . substr($color, 1, 1);
            $b = substr($color, 2, 1) . substr($color, 2, 1);
            $rgb = array(
                hexdec($r),
                hexdec($g),
                hexdec($b)
            );
        }
        return $rgb;
    }

    function getnewpath() {
        $newfileurl = $this->srcImg;
        if ($this->forcePng) {
            $newfileurl = preg_replace('@.([^.]+)$@', '.png', $this->srcImg);
        }
        return $newfileurl;
    }

    function output($path = null) {
        //强制转换为PNG 确保清晰
        if ($this->forcePng) {
            if ($path == null) {
                header('Content-type: image/png');
            }
            imagepng($this->img, $path);
        } else {
            switch ($this->srcImg_info[2]) {
                case 3:
                    if ($path == null) {
                        header('Content-type: image/png');
                    }
                    imagepng($this->img, $path);
                    break 1;
                case 2:
                    if ($path == null) {
                        header('Content-type: image/jpeg');
                    }
                    imagejpeg($this->img, $path, 100);
                    break 1;
                case 1:
                    if ($path == null) {
                        header('Content-type: image/gif');
                    }
                    imagegif($this->img, $path);
                    break 1;
                default:
                    throw new Exception('原因未知：水印添加失败！');
            }
        }
        imagedestroy($this->img);
        imagedestroy($this->water_img);
    }

}
