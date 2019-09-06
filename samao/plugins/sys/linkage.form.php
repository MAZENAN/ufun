<?php

class LinkageForm extends HiddenForm {

    const VAR_TYPE = 'custom';

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").linkage();});';
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery.json.js', __RES__ . '/js/samao.linkage.js');
    }

    public static function code($field) {
        $field->data_val_off = true;
        if ($field->value == null) {
            $field->value = '';
        } else {
            $field->value = json_encode($field->value);
        }
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
        if (!is_array($temps)) {
            return array();
        }
        if (!empty($field->default)) {
            $defval = $field->default;
            foreach ($defval as $key => $value) {
                if (!isset($temps[$key]) || (gettype($temps[$key]) != gettype($value) && empty($temps[$key]))) {
                    $temps[$key] = $value;
                }
            }
        }
        return $temps;
    }

    public static function setfield(&$vals, $field) {
        if ($field->names_dbfield) {
            $tvals = array();
            foreach ($field->names as $idx => $name) {
                $tvals[$idx] = isset($vals[$name]) ? $vals[$name] : '';
            }
            return $tvals;
        }
        $val = empty($vals[$field->name]) ? '[]' : $vals[$field->name];
        if (!preg_match('@^\[@', $val)) {
            return array();
        }
        $temps = json_decode($val, true);
        if (!is_array($temps)) {
            return array();
        }
        return $temps;
    }

    public static function setvals(&$vals, $field) {
        if (empty($field->value)) {
            return;
        }
        if ($field->names_dbfield) {
            foreach ($field->names as $idx => $name) {
                $vals[$name] = empty($field->value[$idx]) ? 0 : $field->value[$idx];
            }
        } else {
            $vals[$field->name] = json_encode($field->value);
        }
    }

}
