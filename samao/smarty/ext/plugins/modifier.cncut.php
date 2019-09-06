<?php

function smarty_modifier_cncut($str, $mlen = 100) {
    $lenth = intval($mlen);
    $str = strip_tags($str);
    $str = preg_replace('/(\s+)/', '', $str);
    $len = strlen($str);
    $r = array();
    $n = 0;
    $m = 0;
    for ($i = 0; $i < $len; $i++) {
        $x = substr($str, $i, 1);
        $a = base_convert(ord($x), 10, 2);
        $a = substr('00000000' . $a, -8);
        if (substr($a, 0, 1) == 0) {
            $r[] = substr($str, $i, 1);
        } elseif (substr($a, 0, 3) == 110) {
            $r[] = substr($str, $i, 2);
            $i += 1;
        } elseif (substr($a, 0, 4) == 1110) {
            $r[] = substr($str, $i, 3);
            $i += 2;
        } else {
            $r[] = '';
        }
        if (++$m >= $lenth) {
            break;
        }
    }
    return join('', $r);
}
