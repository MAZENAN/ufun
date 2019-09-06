<?php

class ThumbnailForm extends TextForm {

    const VAR_TYPE = 'string';

    public static function cssfiles() {
        return array(__RES__ . '/css/jqueryui/custom.css');
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery-ui.js', __RES__ . '/js/swfobject.js', __RES__ . '/js/samao.upfile.js');
    }

    public static function script($field) {
        $upurl = $field->upurl;
        if (empty($upurl)) {
            $upurl = C('SERVICE_UPFILE_URL');
        }
        if (empty($field->extensions)) {
            $field->extensions = 'jpg,jpeg,gif,png';
        }
        return '$(function() {$("#' . $field->id . '").initAjaxUpFile({extensions:"' . $field->extensions . '",upurl:' . json_encode($upurl) . ',res:' . json_encode(__RES__) . ',type:2,afterUpfile:function(){openthumbnail(\'#' . $field->id . '\',' . json_encode($upurl) . ',' . json_encode(__RES__) . ');}});});';
    }

}
