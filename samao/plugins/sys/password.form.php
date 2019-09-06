<?php

class PasswordForm {

    const VAR_TYPE = 'string';

    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $args['type'] = 'password';
        $strattr = empty($field->htmlattr) ? '' : ' ' . trim($field->htmlattr);
        foreach ($args as $key => $value) {
            if ($value !== '' && $key != 'value') {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        return '<input' . $strattr . ' />';
    }

}
