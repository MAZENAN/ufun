<?php

class AmountdigitsForm extends DigitsForm {

    const VAR_TYPE = 'int';

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").amountbox();});';
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/samao.amountbox.js');
    }

}
