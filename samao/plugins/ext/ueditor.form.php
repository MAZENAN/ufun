<?php

class UeditorForm extends TextareaForm {

    public static function scriptfiles() {
        return array(__RES__ . '/ueditor/ueditor.config.js', __RES__ . '/ueditor/ueditor.all.min.js', __RES__ . '/js/samao.forueditor.js');
    }

    public static function script($field) {
        return "$(function(){ $('#{$field->id}').initUeditor();});";
    }

    public static function code($field) {
        if (empty($field->style)) {
            $field->style = 'width:100%;height:300px;';
        }
        $field->class = 'form-control ueditor';
        return parent::code($field);
    }

}
