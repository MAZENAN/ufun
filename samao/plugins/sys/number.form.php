<?php

class NumberForm extends TextForm {

    const VAR_TYPE = 'float';

    public static function code($field) {
        $data_val = empty($field->data_val) ? array() : $field->data_val;
        $data_val['number'] = true;
        $field->data_val = $data_val;
        return parent::code($field);
    }

}
