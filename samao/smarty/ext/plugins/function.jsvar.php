<?php

function smarty_function_jsvar($params, $template) {
    echo 'var __SELF__=\'' . __SELF__ . '\'';
    echo ',__ROOT__=\'' . __ROOT__ . '\'';
    echo ',__PUBLIC__=\'' . __PUBLIC__ . '\'';
    echo ',__APPROOT__=\'' . __APPROOT__ . '\'';
    echo ',__RUNROOT__=\'' . __RUNROOT__ . '\'';
    echo ',__CTL__=\'' . Route::get('ctl') . '\'';
    echo ',__ACT__=\'' . Route::get('act') . '\'';
    echo ',__APP__=\'' . Route::get('app') . '\';';
}
