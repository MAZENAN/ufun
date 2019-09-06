<?php

$name = to_camel(strtolower(Route::get('ctl')));
$class = $name . 'Controller';
if (!class_exists($class)) {
    $ALLOW_CONTROLLERS = C('TOOL_ALLOW_CONTROLLERS');
    if (gettype($ALLOW_CONTROLLERS) == 'array') {
        if (!in_array($name, $ALLOW_CONTROLLERS)) {
            return;
        }
    } else if ($ALLOW_CONTROLLERS != '*') {
        return;
    }
    Config::load('base_controlers');
    $rows = C('BASE_CONTROLERS');
    if (!empty($rows)) {
        $control = !isset($rows[$name]) ? 'SmcmsController' : $rows[$name];
        $phpstr = 'class ' . $class . ' extends ' . $control . '{}';
        try {
            eval($phpstr);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
        return;
    }
}
