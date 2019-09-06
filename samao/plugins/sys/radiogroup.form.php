<?php

class RadiogroupForm {

    const VAR_TYPE = 'string';

    public static function script($field) {
        return '$(function() {
    var boxclick=function(){var val=$("input[name=' . $field->id . ']:checked").val();$("#data_val_' . $field->id . '").mousedown().val(val);};
    $("input[name=' . $field->id . ']").click(boxclick); 
    boxclick();
});';
    }

    //选项值==
    public static function code($field) {
        $noul = isset($field->noul) ? false : $field->noul;
        $args = $field->getHtmlAttrs();
        $options = gettype($field->options) == 'array' ? $field->options : ($field->options == '' ? array() : json_decode($field->options, TRUE));
        $html = '';
        foreach ($options as $key => $opt) {
            if (gettype($opt) == 'array') {
                $opt[1] = isset($opt[1]) ? $opt[1] : $opt[0];
                $selected = isset($args['value']) && strval($args['value']) === strval($opt[0]) ? ' checked="checked"' : '';
                $disabled = isset($field->disabled) && $field->disabled != '' ? ' disabled="disabled"' : '';
                $id = $field->id . '_' . $key;
                $style = (isset($args['style']) && $args['style'] != '') ? (' style="' . $args['style'] . '"') : '';
                if ($noul) {
                    $html.='<label for="' . $id . '"><input  type="radio" id="' . $id . '" name="' . $args['name'] . '" value="' . htmlspecialchars($opt[0]) . '"' . $selected . $disabled . '/>' . $opt[1] . (isset($opt[2]) ? ' <span> ' . $opt[2] . '</span>' : '') . '</label>' . "\n";
                } else {
                    $html.='<li class="' . $args['class'] . '"' . $style . '><label for="' . $id . '"><input  type="radio" id="' . $id . '" name="' . $args['name'] . '" value="' . htmlspecialchars($opt[0]) . '"' . $selected . $disabled . '/>' . $opt[1] . (isset($opt[2]) ? ' <span> ' . $opt[2] . '</span>' : '') . '</label></li>' . "\n";
                }
            } else {
                $selected = isset($args['value']) && $args['value'] == $opt ? ' checked="checked"' : '';
                $disabled = isset($field->disabled) && $field->disabled != '' ? ' disabled="disabled"' : '';
                $id = $field->id . '_' . $key;
                $style = (isset($args['style']) && $args['style'] != '') ? (' style="' . $args['style'] . '"') : '';
                if ($noul) {
                    $html.='<label for="' . $id . '"><input  type="radio" id="' . $id . '" name="' . $args['name'] . '" value="' . htmlspecialchars($opt) . '"' . $selected . $disabled . '/>' . $opt . '</label>' . "\n";
                } else {
                    $html.='<li class="' . $args['class'] . '"' . $style . '><label for="' . $id . '"><input  type="radio" id="' . $id . '" name="' . $args['name'] . '" value="' . htmlspecialchars($opt) . '"' . $selected . $disabled . '/>' . $opt . '</label></li>' . "\n";
                }
            }
        }
        unset($args['value']);
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
        $hidde = '<input id="data_val_' . $field->id . '" type="hidden"' . $strattr . ' />';
        if ($noul) {
            return $hidde . $html;
        } else {
            return $hidde . '<ul id="' . $field->id . '" class="samao-box" >' . "\n" . $html . "</ul>";
        }
    }

}
