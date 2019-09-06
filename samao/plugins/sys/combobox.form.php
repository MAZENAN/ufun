<?php

class ComboboxForm extends SelectForm {

    public static function cssfiles() {
        return array(__RES__ . '/css/jqueryui/custom.css');
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery-ui.js', __RES__ . '/js/samao.select.js', __RES__ . '/js/samao.combobox.js');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").combobox();});';
    }

}
