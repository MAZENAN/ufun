<?php

class LabelForm {

    const VAR_TYPE = 'string';

    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $strattr = empty($args['htmlattr']) ? '' : ' ' . trim($args['htmlattr']);
        unset($args['data_val']);
        unset($args['data_valmsg_for']);
        unset($args['data_val_msg']);
        unset($args['error']);
        unset($args['data_val_msgs']);
        unset($args['data_vals']);
        unset($args['data_val_off']);
        foreach ($args as $key => $value) {
            if ($key == 'value' || $key == 'type' || gettype($value) == 'array') {
                continue;
            }
            $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
        }

        return '<span' . $strattr . ' />' . $args['value'] . '</span>';
    }

}
