<?php

class UpimggroupForm extends HiddenForm {

    const VAR_TYPE = 'array';

    public static function cssfiles() {
        return array(__RES__ . '/css/jqueryui/custom.css');
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery-ui.js', __RES__ . '/js/samao.topdialog.js', __RES__ . '/js/jquery.json.js', __RES__ . '/js/samao.upfile.js', __RES__ . '/js/samao.upimggroup.js');
    }

    public static function script($field) {
        $upurl = $field->upurl;
        if (empty($upurl)) {
            $upurl = C('SERVICE_UPFILE_URL');
        }
        $extensions = empty($field->extensions) ? 'jpg,jpeg,gif,png' : $field->extensions;
		 $strict_size = empty($field->strict_size) ? '' : ',strict_size:true';
        return '$(function() {$("#' . $field->id . '").initUpimgGroup({extensions:"' . $extensions . '",upurl:' . json_encode($upurl)  . $strict_size . '});});';
    }

}
