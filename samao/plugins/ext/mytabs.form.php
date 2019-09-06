<?php

class MytabsForm {

    const VAR_TYPE = 'custom';

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").mytabs({scriptid:\'#' . $field->id . '_soures\'});});';
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery.json.js', __PUBLIC__ . '/js/admin/mytabs.js');
    }

    public static function code($field) {
        $field->data_val_off = 'true';
        $field->value = json_encode($field->value);
        $args = $field->getHtmlAttrs();
        $args['type'] = 'hidden';
        $strattr = empty($field->htmlattr) ? '' : ' ' . trim($field->htmlattr);
        foreach ($args as $key => $value) {
            if ($value !== '' && $key !== 'name') {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        return '<input' . $strattr . ' /><span id="' . $field->id . '_info"></span>';
    }

    public static function fill(&$Data, $field) {
        $temps = isset($Data[$field->boxname]) && is_array($Data[$field->boxname]) ? $Data[$field->boxname] : array();
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
        return json_decode($val, true);
    }

    public static function setvals(&$vals, $field) {
        $vals[$field->name] = json_encode($field->value);
    }

}
