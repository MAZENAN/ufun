<?php
Config::load('upload');
function smarty_modifier_minimg($string, $width, $height, $mode = 3) {
    if ($string==""){
         return C('QiniuRoot')."/upfiles/images/nopic.jpg?imageView2/1/w/".$width."/h/".$height;
    }else{
    	if ($width==0||$height==0) {
    		return C('QiniuRoot').$string;
    	}else{
    		return C('QiniuRoot').$string."?imageView2/1/w/".$width."/h/".$height;
    	}
     	 	
    }
}
