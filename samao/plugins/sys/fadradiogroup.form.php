<?php

class FadradiogroupForm {

    const VAR_TYPE = 'string';

    public static function scriptfiles() {
        return array(__RES__ . '/js/samao.fadbox.js');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").fadbox("radiogroup");});';
    }

    //选项值==
    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $options = gettype($field->options) == 'array' ? $field->options : ($field->options == '' ? array() : json_decode($field->options, TRUE));
        $html = '';
        foreach ($options as $key => $opt) {
            if (gettype($opt) == 'array') {
                $opt[1] = isset($opt[1]) ? $opt[1] : $opt[0];
                $selected = isset($args['value']) && strval($args['value']) === strval($opt[0]) ? ' selected' : '';
                $style = (isset($args['style']) && $args['style'] != '') ? (' style="' . $args['style'] . '"') : '';
                $class = trim($args['class'] . $selected);
                $html.='<a class="' . $class . '"' . $style . ' data_name="' . $args['name'] . '" data_value="' . htmlspecialchars($opt[0]) . '" href="javascript:;">' . $opt[1] . (isset($opt[2]) ? ' <span> ' . $opt[2] . '</span>' : '') . '</a>' . "\n";
            } else {
                $selected = isset($args['value']) && $args['value'] == $opt ? ' selected' : '';
                $style = (isset($args['style']) && $args['style'] != '') ? (' style="' . $args['style'] . '"') : '';
                $class = trim($args['class'] . $selected);
                $html.='<a class="' . $class . '"' . $style . ' data_name="' . $args['name'] . '" data_value="' . htmlspecialchars($opt) . '" href="javascript:;">' . $opt . '</a>' . "\n";
            }
        }
        $name = $args['name'];
        unset($args['type']);
        unset($args['id']);
        unset($args['name']);
        unset($args['class']);
        $strattr = empty($args['htmlattr']) ? '' : ' ' . trim($args['htmlattr']);
        foreach ($args as $key => $value) {
            if (!($value === '' || gettype($value) == 'array')) {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        $hidde = '<input id="data_val_' . $field->id . '" name="' . $name . '" type="hidden"' . $strattr . ' />';
        return $hidde . '<div fadbox="true" id="' . $field->id . '" class="form-fadbox" >' . "\n" . $html . "</div>";
    }

}
