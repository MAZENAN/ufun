<?php

class ConvertForm extends NumberForm {

    const VAR_TYPE = 'float';

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").convert({rate:' . C('convert.currency_unit') . '});});';
    }

    public static function scriptfiles() {
        return array(__PUBLIC__ . '/js/samao.convert.js');
    }

}
