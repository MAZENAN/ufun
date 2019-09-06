<?php

class TextareaForm {

    const VAR_TYPE = 'string';

    /**
     * 
     * @param ModelField $field
     * @return string
     */
    public static function code($field) {
        $args = $field->getHtmlAttrs();
		$val=$args['value'];
        unset($args['value']);
        unset($args['type']);
        $strattr = empty($args['htmlattr']) ? '' : ' ' . trim($args['htmlattr']);
        foreach ($args as $key => $value) {
            if (!($value === '' || gettype($value) == 'array')) {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        return '<textarea' . $strattr . ' >' . htmlspecialchars($val) . '</textarea>';
    }

}
