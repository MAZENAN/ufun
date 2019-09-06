<?php

class SelectForm {

    const VAR_TYPE = 'string';

    public static function scriptfiles() {
        return array(__RES__ . '/js/samao.select.js');
    }

    public static function script($field) {
        if (!empty($field->data_url)) {
            return '$(function() {$("#' . $field->id . '").ajaxselect();});';
        }
    }

    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $options = gettype($field->options) == 'array' ? $field->options : ($field->options == '' ? array() : json_decode($field->options, TRUE));
        $html = '';
        $isopengroup = false;
        //加入表头
        $headopt = array();
        if (!empty($field->header)) {
            if (gettype($field->header) == 'array') {
                $headopt = $field->header;
            } else {
                $headopt = array('', $field->header);
            }
            array_unshift($options, $headopt);
        }
        if (empty($field->data_url)) {
            foreach ($options as $opt) {
                if (gettype($opt) == 'array') {
                    $selected = isset($args['value']) && strval($args['value']) === strval($opt[0]) ? ' selected="selected"' : '';
                    if ($opt[0] === '--') {
                        if (isset($opt[2]) && $opt[2] == 'option') {
                            $html.='<option style="color:#999999;" value="" disabled="disabled">' . (isset($opt[1]) ? htmlspecialchars($opt[1]) : htmlspecialchars($opt[0])) . '</option>' . "\n";
                        } else {
                            if ($isopengroup) {
                                $html.='</optgroup>' . "\n";
                                $isopengroup = false;
                            }
                            $html.='<optgroup label="' . (isset($opt[1]) ? htmlspecialchars($opt[1]) : htmlspecialchars($opt[0])) . '">' . "\n";
                            $isopengroup = true;
                        }
                    } else {
                        $html.='<option value="' . htmlspecialchars($opt[0]) . '"' . $selected . '>' . (isset($opt[1]) ? htmlspecialchars($opt[1]) : htmlspecialchars($opt[0])) . (isset($opt[2]) ? ' | ' . $opt[2] : '') . '</option>' . "\n";
                    }
                } else {
                    $selected = isset($args['value']) && $args['value'] == $opt ? ' selected="selected"' : '';
                    $html.='<option' . $selected . '>' . htmlspecialchars($opt) . '</option>' . "\n";
                }
            }
            if ($isopengroup) {
                $html.='</optgroup>' . "\n";
            }
        }
        $valueattr = (isset($args['value']) && $args['value'] !== '') ? ' selectvalue="' . $args['value'] . '"' : '';
        unset($args['value']);
        unset($args['type']);
        $strattr = empty($args['htmlattr']) ? '' : ' ' . trim($args['htmlattr']);
        foreach ($args as $key => $value) {
            if (!($value === '' || gettype($value) == 'array')) {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        if (!empty($field->data_url)) {
            if (!empty($field->header)) {
                $heads = json_encode($headopt);
                $strattr.=' header="' . htmlspecialchars($heads) . '"';
                $strattr.= $valueattr;
            }
            $strattr.=' ajaxselect="true"';
        }
        return '<select' . $strattr . '>' . "\n" . $html . "</select>";
    }

}
