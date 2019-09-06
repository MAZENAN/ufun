<?php

class XheditorForm extends TextareaForm {

    const VAR_TYPE = 'string';

    public static function scriptfiles() {
        return array(__RES__ . '/xheditor/xheditor.js', __RES__ . '/xheditor/xheditor_lang/zh-cn.js', __RES__ . '/js/samao.topdialog.js');
    }

    public static function script($field) {
        if (empty($field->upfile_url)) {
            $upurl = C('SERVICE_UPFILE_URL');
            $field->upfile_url = $upurl;
        }
        //图片上传路径
        if (empty($field->upimg_url)) {
            $field->upimg_url = $field->upfile_url;
        }
        if (isset($field->xheditor_up) && $field->xheditor_up) {
            return '$(function() {$("#' . $field->id . '").xheditor({modalWidth:730,modalHeight:540,upLinkUrl:"' . $field->upfile_url . '?immediate=1",upLinkExt:"zip,rar,txt",upImgUrl:"' . $field->upimg_url . '?immediate=1",upImgExt:"jpg,jpeg,gif,png",upFlashUrl:"' . $field->upfile_url . '?immediate=1",upFlashExt:"swf",upMediaUrl:"' . $field->upfile_url . '?immediate=1",upMediaExt:"avi"});});';
        } else {
            return '$(function() {$("#' . $field->id . '").xheditor();});';
        }
    }

    public static function code($field) {
        if (empty($field->style)) {
            $field->style = 'width:100%;';
        }
        $field->class='form-control defxheditor';
        return parent::code($field);
    }

}
