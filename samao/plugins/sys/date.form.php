<?php

class DateForm extends TextForm {

    public static function cssfiles() {
        return array(__RES__ . '/css/jqueryui/custom.css');
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery-ui.js', __RES__ . '/js/jquery.ui.datepicker-zh-CN.js');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").datepicker({dateFormat:\'yy-mm-dd\',changeMonth: true,changeYear:true,yearRange:\'1900:2050\'});});';
    }

}
