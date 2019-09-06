<?php

class TextForm {

    const VAR_TYPE = 'string';

    /**
     * 
     * @param ModelField $field
     * @return string
     */
    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $args['type'] = 'text';
        $strattr = empty($field->htmlattr) ? '' : ' ' . trim($field->htmlattr);
        foreach ($args as $key => $value) {
            if ($value !== '') {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        return '<input' . $strattr . ' />';
    }

}
