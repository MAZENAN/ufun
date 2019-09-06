<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of radiodialog
 *
 * @author wj354
 */
class MultipleForm extends HiddenForm {

    const VAR_TYPE = 'string';

    public static function cssfiles() {
        return array(__RES__ . '/css/jqueryui/custom.css');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").multiple();});';
    }

    public static function scriptfiles() {
        return array(
            __RES__ . '/js/jquery-ui.js',
            __RES__ . '/js/jquery.json.js',
            __PUBLIC__ . '/js/samao.multiple.js'
        );
    }

}
