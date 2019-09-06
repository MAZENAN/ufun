<?php
function smarty_modifiercompiler_way($params, $compiler) {
    if (!isset($params[1])) {
        $params[1] = "0";
    }
   return "({$params[0]}==1?'<img src=\"".__RES__."/images/yes.gif\" />':'<img src=\"".__RES__."/images/no.gif\" />')";
}
