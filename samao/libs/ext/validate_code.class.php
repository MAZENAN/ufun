<?php

class ValidateCode {

    private $charset = '01234567892345678923456789'; //随机因子abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ
    public $checkcode = '';       //验证码
    private $codelen = 4;     //验证码长度
    private $width = 130;     //宽度
    private $height = 50;     //高度
    private $img;        //图形资源句柄
    private $font;        //指定的字体
    private $fontsize = 20;    //指定字体大小
    private $fontcolor;      //指定字体颜色  

    //构造方法初始化

    public function __construct($width, $height, $codelen, $fontsize = 20) {
        $this->width = $width;
        $this->height = $height;
        $this->codelen = $codelen;
        $this->fontsize = $fontsize;
        $this->font = ROOT_DIR . 'public/font/segoeuiz.ttf';
    }

    //生成随机码
    private function createCode() {
        $_len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->checkcode .= $this->charset[mt_rand(0, $_len)];
        }
    }

    //生成背景
    private function createBg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(210, 255), mt_rand(210, 255), mt_rand(210, 255));
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }

    //生成文字
    private function createFont() {
        $_x = ($this->width-10) / $this->codelen;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 136), mt_rand(0, 136), mt_rand(0, 136));
            imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $_x * $i + mt_rand(1, 5)+5, $this->height / 1.4, $this->fontcolor, $this->font, $this->checkcode[$i]);
        }
    }

    //生成线条、雪花
    private function createLine() {
        for ($i = 0; $i < 4; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
        }
        for ($i = 0; $i < 80; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
        }
    }

    //输出
    private function outPut() {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    //对外生成
    public function outImg() {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }

    //获取验证码
    public function getCode() {
        return strtolower($this->checkcode);
    }

}
