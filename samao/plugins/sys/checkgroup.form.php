<?php

class CheckgroupForm {

    const VAR_TYPE = 'custom';

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery.json.js');
    }

    public static function script($field) {
        return '$(function() {
    var boxclick=function(){
        $("#data_val_' . $field->id . '").mousedown();
        var vals=[];
        $("input[name=\'' . $field->id . '[]\']:checked").each(function(idx,em){var val=$(em).val();vals.push(val);});
        if(vals.length==0){$("#data_val_' . $field->id . '").mousedown().val("");}
        else{var json=$.toJSON(vals);$("#data_val_' . $field->id . '").mousedown().val(json);}
     }; 
    $("input[name=\'' . $field->id . '[]\']").click(boxclick); boxclick();
});';
    }

    /**
     * 
     * @param ModelField $field
     * @return string
     */
    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $values = gettype($field->value) == 'array' ? $field->value : ($field->value == '' ? array() : json_decode($field->value, TRUE));
        //选项值==
        $options = gettype($field->options) == 'array' ? $field->options : ($field->options == '' ? array() : json_decode($field->options, TRUE));
        $html = '';
        foreach ($options as $key => $opt) {
            if (gettype($opt) == 'array') {
                $selected = in_array($opt[0], $values) ? ' checked="checked"' : '';
                $opt[1] = isset($opt[1]) ? $opt[1] : $opt[0];
                $id = $field->id . '_' . $key;
                $style = (isset($args['style']) && $args['style'] != '') ? (' style="' . $args['style'] . '"') : '';
                $html.='<li class="' . $args['class'] . '"' . $style . '><input  type="checkbox" id="' . $id . '" name="' . $args['name'] . '[]" value="' . htmlspecialchars($opt[0]) . '"' . $selected . '/><label for="' . $id . '">' . $opt[1] . (isset($opt[2]) ? ' <span> ' . $opt[2] . '</span>' : '') . '</label></li>' . "\n";
            } else {
                $selected = in_array($opt, $values) ? ' checked="checked"' : '';
                $id = $field->id . '_' . $key;
                $style = (isset($args['style']) && $args['style'] != '') ? (' style="' . $args['style'] . '"') : '';
                $html.='<li class="' . $args['class'] . '"' . $style . '><input  type="checkbox" id="' . $id . '" name="' . $args['name'] . '[]" value="' . htmlspecialchars($opt) . '"' . $selected . '/><label for="' . $id . '">' . $opt . '</label></li>' . "\n";
            }
        }

        unset($args['value']);
        unset($args['type']);
        unset($args['id']);
        unset($args['name']);
        unset($args['class']);
        $strattr = empty($field->htmlattr) ? '' : ' ' . trim($field->htmlattr);
        foreach ($args as $key => $value) {
            $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
        }
        $hidde = '<input id="data_val_' . $field->id . '" type="hidden"' . $strattr . ' />';
        return $hidde . '<ul id="' . $field->id . '" class="samao-box">' . "\n" . $html . "</ul>";
    }

    public static function fill(&$Data, $field) {
        $val = isset($Data[$field->boxname])?$Data[$field->boxname]:array();
        if (gettype($val) == 'array') {
            return $val;
        }
        return array();
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
