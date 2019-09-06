<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of date
 *
 * @author wj354
 */
class DatetimeForm extends TextForm {

    const VAR_TYPE = 'string';

    public static function cssfiles() {
        return array(__RES__ . '/css/jqueryui/custom.css');
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery-ui.js', __RES__ . '/js/jquery.ui.datepicker-zh-CN.js', __RES__ . '/js/jquery-ui-timepicker-addon.js');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").datetimepicker({dateFormat:\'yy-mm-dd\',changeMonth: true,changeYear:true});});';
    }

}
