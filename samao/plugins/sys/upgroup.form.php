<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upgroup
 *
 * @author wj354
 */
class UpgroupForm extends HiddenForm {

    const VAR_TYPE = 'array';

    public static function cssfiles() {
        return array(__RES__ . '/css/jqueryui/custom.css');
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery-ui.js', __RES__ . '/js/jquery.json.js', __RES__ . '/js/samao.upfile.js', __RES__ . '/js/samao.upgroup.js');
    }

    public static function script($field) {
        $upurl = $field->upurl;
        if (empty($upurl)) {
            $upurl = C('SERVICE_UPFILE_URL');
        }
        if (empty($field->extensions)) {
            return '$(function() {$("#' . $field->id . '").initUpGroup({upurl:' . json_encode($upurl) . '});});';
        } else {
            return '$(function() {$("#' . $field->id . '").initUpGroup({extensions:"' . $field->extensions . '",upurl:' . json_encode($upurl) . '});});';
        }
    }

}
