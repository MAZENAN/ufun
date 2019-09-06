<?php
Config::load('upload');
function smarty_modifier_img_add_host($string, $mode = 1) {
  return preg_replace('/(<img.*?src=")(.*?\/upfiles\/)(.*?(?:[.gif|.jpg|.png]))(".*?>)/i',"\${1}".C('QiniuRoot')."/upfiles/\${3}\${4}",$string);
}
