<?php

function smarty_modifiercompiler_case($params, $compiler) {
    if (!isset($params[1])) {
        $params[1] = "''";
    }
    if (!isset($params[2])) {
        $params[2] = "''";
    }
    if (!isset($params[3])) {
        $params[3] = "''";
    }
    $arrtype1 = substr($params[1], 0, 5) == 'array';
    $arrtype2 = substr($params[2], 0, 5) == 'array';
    if ($arrtype1 && $arrtype2) {
        return '((FALSE!==$_tempkey=array_search(' . $params[0] . ',' . $params[1] . ')) && array_key_exists($_tempkey,$_temparr=' . $params[2] . ')?$_temparr[$_tempkey]:' . $params[3] . ')';
    } else {
        return '(is_array(' . $params[1] . ')&&is_array(' . $params[2] . ') ? ((FALSE!==$_tempkey=array_search(' . $params[0] . ',' . $params[1] . ')) && array_key_exists($_tempkey,$_temparr=' . $params[2] . ')?$_temparr[$_tempkey]:' . $params[3] . ') : (' . $params[0] . '==' . $params[1] . '?' . $params[2] . ':' . $params[3] . '))';
    }
}
