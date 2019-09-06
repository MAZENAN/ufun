<?php

class HiddenForm {

    const VAR_TYPE = 'string';

    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $args['type'] = 'hidden';
        $strattr = empty($field->htmlattr) ? '' : ' ' . trim($field->htmlattr);
        foreach ($args as $key => $value) {
            if ($value !== '') {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        return '<input' . $strattr . ' />';
    }

}
