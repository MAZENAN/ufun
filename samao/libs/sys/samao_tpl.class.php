<?php

define('SAMAO_SMARTY_DIR', SAMAO_DIR . 'smarty' . DS);
require SAMAO_SMARTY_DIR . 'libs' . DS . 'Smarty.class.php';
require SAMAO_DIR . 'com' . DS . 'forsmarty.inc.php';

class SamaoTpl extends Smarty {

    public function loadPlugin($plugin_name, $check = true) {
        if ($check && (is_callable($plugin_name) || class_exists($plugin_name, false))) {
            return true;
        }
        $_name_parts = explode('_', $plugin_name, 5);
        if (!isset($_name_parts[2]) || strtolower($_name_parts[0]) !== 'smarty') {
            throw new SmartyException("plugin {$plugin_name} is not a valid name format");
        }
        if (strtolower($_name_parts[1]) == 'internal') {
            if (isset($_name_parts[2]) && isset($_name_parts[3]) && isset($_name_parts[4]) && strtolower($_name_parts[2]) == 'compile' && strtolower($_name_parts[3]) == 'form') {
                $type = $_name_parts[4];
                if (preg_match('@^[a-z][a-z0-9]*$@i', $type)) {
                    eval('class Smarty_Internal_Compile_Form_' . $type . ' extends SmboxFormBase{}');
                    return true;
                }
            } else {
                $file = SAMAO_SMARTY_DIR . 'ext' . DS . 'sysplugins' . DS . strtolower($plugin_name) . '.php';
                if (file_exists($file)) {
                    require_once($file);
                    return $file;
                }
            }
        }
        return parent::loadPlugin($plugin_name, $check);
    }

    public function display($template = null, $cache_id = null, $compile_id = null, $parent = null) {
        if ($template == null) {
            if (Route::get('act') == 'index') {
                $template = Route::get('ctl') . '.' . C('Smarty_TPL_EXT');
            } else {
                $template = Route::get('ctl') . '_' . Route::get('act') . '.' . C('Smarty_TPL_EXT');
            }
        }
        if ($template != '' && $template[0] == '@') {
            $template = SAMAO_DIR . 'tpls' . DS . substr($template, 1);
        }
        parent::display($template, $cache_id, $compile_id, $parent);
    }

}
