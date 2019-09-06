<?php

class BoolForm {

    const VAR_TYPE = 'bool';

    public static function code($field) {
        $args = $field->getHtmlAttrs();
        if (isset($args['value']) && intval($args['value']) == 1) {
            $args['checked'] = 'checked';
        }
        $args['value'] = 1;
        $args['type'] = 'checkbox';
        $strattr = empty($field->htmlattr) ? '' : ' ' . trim($field->htmlattr);
        foreach ($args as $key => $value) {
            $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
        }
        return '<input' . $strattr . ' />';
    }

}
