<?php

class TabsForm extends HiddenForm {

    const VAR_TYPE = 'custom';

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").samaotabs();});';
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery.json.js', __RES__ . '/js/samao.tabs.js');
    }

    public static function code($field) {
        $field->data_val_off = 'true';
        $field->value = json_encode($field->value);
        return parent::code($field);
    }

    public static function fill(&$Data, $field) {
        $val = isset($Data[$field->boxname]) ? $Data[$field->boxname] : '';
        if ($val == '' || $val == '[]') {
            return array();
        }
        if (!preg_match('@^\[@', $val)) {
            return array();
        }
        $temps = json_decode($val, true);
        $values = array();
        foreach ($temps as $value) {
            if (!empty($value)) {
                $values[] = $value;
            }
        }
        return $values;
    }

    public static function setfield(&$vals, $field) {
        //取该字段值==
        $val = empty($vals[$field->name]) ? '[]' : $vals[$field->name];
        if (!preg_match('@^\[@', $val)) {
            return array();
        }
        $temps = json_decode($val, true);
        $values = array();
        foreach ($temps as $value) {
            if (!empty($value)) {
                $values[] = $value;
            }
        }
        return $values;
    }

    public static function setvals(&$vals, $field) {
        $vals[$field->name] = json_encode($field->value);
    }

}
