<?php

class FadcheckgroupForm {

    const VAR_TYPE = 'custom';

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery.json.js', __RES__ . '/js/samao.fadbox.js');
    }

    public static function script($field) {
        return '$(function() {$("#' . $field->id . '").fadbox("checkgroup");});';
    }

    //选项值==
    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $values = gettype($field->value) == 'array' ? $field->value : ($field->value == '' ? array() : json_decode($field->value, TRUE));
        $options = gettype($field->options) == 'array' ? $field->options : ($field->options == '' ? array() : json_decode($field->options, TRUE));
        $html = '';
        foreach ($options as $key => $opt) {
            if (gettype($opt) == 'array') {
                $opt[1] = isset($opt[1]) ? $opt[1] : $opt[0];
                $selected = in_array($opt[0], $values) ? ' selected' : '';
                $style = (isset($args['style']) && $args['style'] != '') ? (' style="' . $args['style'] . '"') : '';
                $class = trim($args['class'] . $selected);
                $html.='<a class="' . $class . '"' . $style . ' data_name="' . $args['name'] . '" data_value="' . htmlspecialchars($opt[0]) . '" href="javascript:;">' . $opt[1] . (isset($opt[2]) ? ' <span> ' . $opt[2] . '</span>' : '') . '</a>' . "\n";
            } else {
                $selected = in_array($opt, $values) ? ' selected' : '';
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
        return '<div fadbox="true" id="' . $field->id . '" class="form-fadbox" >' . $hidde . "\n" . $html . "</div>";
    }

    public static function fill(&$Data, $field) {
        $val = isset($Data[$field->boxname]) ? $Data[$field->boxname] : '';
        if (gettype($val) != 'string' || $val == '' || $val == '[]') {
            return array();
        }
        if (!preg_match('@^\[@', $val)) {
            return array();
        }
        $temps = json_decode($val, true);
        if (!is_array($temps)) {
            return array();
        }
        return $temps;
    }

    public static function setfield(&$vals, $field) {
        //这个是拆分字段名的
        if ($field->names_dbfield) {
            $tvals = array();
            foreach ($field->names as $idx => $kname) {
                if ($vals[$kname] == 1) {
                    $optval = (gettype($field->options[$idx]) == 'array') ? (isset($field->options[$idx][0]) ? $field->options[$idx][0] : $kname) : $field->options[$idx];
                    $tvals[] = $optval;
                }
            }
            return $tvals;
        }
        //不拆分的
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
        if ($field->names_dbfield) {
            foreach ($field->names as $idx => $kname) {
                $optval = $kname;
                if (isset($field->options[$idx])) {
                    $optval = (gettype($field->options[$idx]) == 'array') ? (isset($field->options[$idx][0]) ? $field->options[$idx][0] : $kname) : $field->options[$idx];
                }
                $vals[$kname] = in_array($optval, $field->value) ? 1 : 0;
            }
        } else {
            $vals[$field->name] = json_encode($field->value);
        }
    }

}
