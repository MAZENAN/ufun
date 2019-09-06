<?php

class ColorselecterForm extends HiddenForm {

    public static function scriptfiles() {
        return array(__RES__ . '/js/samao.color_selecter.js');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").initColorSelecter();});';
    }

}
