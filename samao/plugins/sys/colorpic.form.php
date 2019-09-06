<?php

class ColorpicForm extends HiddenForm {

    public static function scriptfiles() {
        return array(__RES__ . '/js/samao.upfile.js', __RES__ . '/js/samao.colorpic.js');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").initColorPic();});';
    }

}
