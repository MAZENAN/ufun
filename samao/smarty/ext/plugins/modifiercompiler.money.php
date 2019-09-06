<?php

function smarty_modifiercompiler_money($params, $compiler) {
    if (!isset($params[1])) {
        $params[1] = "'￥'";
    }
    return '(' . $params[1] . '.sprintf("%01.2f", floatval(' . $params[0] . ')))';
}

