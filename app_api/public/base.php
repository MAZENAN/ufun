<?php

define('API_DIR', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);

require_once("fun/CommonUtil.php");
require_once("fun/include.inc.php");
Config::load('upload');

function replace_image($type,$img){
  if ($type==0) {
    return C('QiniuRoot').$img."?imageView2/1/format/jpg/q/40";
  }elseif ($type==1) {
    return C('QiniuRoot').$img."?imageView2/1/w/100/h/100";
  }elseif($type==2){
    return C('QiniuRoot').$img."?imageView2/1/w/720/h/540";
  }
  elseif($type==3){
    return C('QiniuRoot').$img."?imageView2/1/w/240/h/240";
  }
}

function string_truncate_cn($string, $length = 60, $etc = '...', $code = 'UTF-8') {
    $string = trim($string);
        if ($length == 0) {
            return $string;
        }
        if ($code == 'UTF-8') {
            $pax = "/[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        } else {
            $pax = "/[\xa1-\xff][\xa1-\xff]/";
        }
        $str = preg_replace($pax, '**', $string);
        if (strlen($str) <= $length) {
            return $string;
        }
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        } else {
            $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";
        }
        preg_match_all($pa, $string, $t_string);
        $curentLength = 0;                //用于计算真正的字符长度
        $arrayPoint = 0;                  //如过长时，以该坐标为截取长度
        $arrayLength = count($t_string[0]); //所有文本长度
        for ($arrayPoint = 0; ($arrayPoint < $arrayLength) && ($curentLength < $length); $arrayPoint++) {
            if (strlen($t_string[0][$arrayPoint]) > 1) {
                $curentLength+=2;
            } else {
                $curentLength++;
            }
        }
        if ($arrayLength > $arrayPoint) {
            if ($etc != '') {
                return join('', array_slice($t_string[0], 0, ($arrayPoint - 1))) . $etc;
            } else {
                return join('', array_slice($t_string[0], 0, ($arrayPoint)));
            }
        }
        return join('', array_slice($t_string[0], 0, $arrayLength));
}

/**查询用户是否存在
 * @param $user_id 用户ID
 * @return bool
 */
function check_user_exist($user_id)
{
    $sql  = "SELECT id FROM @pf_member WHERE id='$user_id' limit 1";
    $user = DB::getlist($sql);
    if(empty($user))
    {
        return false;
    }
    return true;
}

function postCurl($postData, $url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_exec($ch);

    curl_close($ch);
}

function logger($log_content,$log_filename) {

    $max_size = 1000000;
    if (file_exists($log_filename) and ( abs(filesize($log_filename)) > $max_size)) {
        unlink($log_filename);
    }
    file_put_contents($log_filename, date('Y-m-d H:i:s') . " " . $log_content . "\r\n", FILE_APPEND);
}

?>
