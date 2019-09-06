<?php

class DigitsForm extends TextForm {

    const VAR_TYPE = 'int';

    public static function code($field) {
        $data_val = empty($field->data_val) ? array() : $field->data_val;
        $data_val['digits'] = true;
        $field->data_val = $data_val;
        return parent::code($field);
    }

}
