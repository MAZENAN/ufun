<?php

class ModelSkin extends Smarty_Resource_Custom {

    protected function fetch($skin, &$source, &$mtime) {
        $path = SAMAO_DIR . 'tpls' . DS . 'skin' . DS . $skin . DS;
        if (!is_file($path . 'model_skin.tpl')) {
            throw new Exception('皮肤文件夹中不存在model_skin.tpl文件！');
        }
        $html = '';
        $model_skin = file_get_contents($path . 'model_skin.tpl');
        preg_match_all('|\{@function(.+)@\}(.*)\{@\/function@\}|sUi', $model_skin, $items, PREG_PATTERN_ORDER);
        foreach ($items[0] as $value) {
            $html.=trim($value);
        }
        $mydir = dir($path);
        while ($file = $mydir->read()) {
            if (preg_match('|^(model_form_[a-z]+)\.tpl$|', $file, $temp)) {
                $model_form = file_get_contents($path . $file);
                $html.="{@function name='{$temp[1]}' model=NULL box=NULL key=NULL@}";
                $html.=trim($model_form);
                $html.="{@/function@}";
            }
        }
        $source = $html;
        $mtime = time();
    }

    protected function fetchTimestamp($skin) {
        $path = SAMAO_DIR . 'tpls' . DS . 'skin' . DS . $skin . DS;
        $maxtime = 0;
        $mydir = dir($path);
        while ($file = $mydir->read()) {
            if (preg_match('|^model_[a-z_]+\.tpl$|', $file)) {
                $time = @filemtime($path . $file);
                if ($time !== FALSE && $time > $maxtime) {
                    $maxtime = $time;
                }
            }
        }
        return $maxtime;
    }

}
