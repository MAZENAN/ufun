<?php

function smarty_modifiercompiler_smval($params, $compiler) {
    if (!isset($params[1])) {
        $compiler->trigger_template_error("该控件必须存在1个参数", $compiler->lex->taglineno);
    }
    if (!isset($params[2])) {
        $params[2] = '\'name\'';
    }
    return "DB::getval({$params[1]},{$params[2]},{$params[0]})";
}
