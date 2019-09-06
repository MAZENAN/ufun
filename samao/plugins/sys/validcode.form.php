<?php

@session_start();

class ValidcodeForm {

    const VAR_TYPE = 'string';

    public static function script($field) {
        if (!(isset($field->notimg) && $field->notimg == true)) {
            $url = C('SERVICE_VALIDCODE_URL');
            return '$(function() {$("#' . $field->id . '").validcode({url:' . json_encode($url) . '});});';
        }
        return '';
    }

    public static function scriptfiles() {
        if (!(isset($field->notimg) && $field->notimg == true)) {
            return array(__RES__ . '/js/samao.validcode.js');
        }
        return '';
    }

    public static function code($field) {
        $args = $field->getHtmlAttrs();
        $args['type'] = 'text';
        $strattr = empty($args['htmlattr']) ? '' : ' ' . trim($args['htmlattr']);
        foreach ($args as $key => $value) {
            if (!($value === '' || gettype($value) == 'array')) {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        if (isset($field->notimg) && $field->notimg == true) {
            return '<input' . $strattr . ' />';
        } else {
            return '<table style="display:inline;float:left;" border="0" cellspacing="0" cellpadding="0">
<tr><td width="70" style="padding:0"><input' . $strattr . ' /></td>
<td style="padding:0 5px;"><nobr class=red>点击左框获取验证码</nobr></td>
</tr></table>';
        }
    }



}
