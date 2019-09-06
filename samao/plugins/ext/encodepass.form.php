<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of radiodialog
 *
 * @author wj354
 */
class EncodepassForm extends PasswordForm {

    const VAR_TYPE = 'custom';

    //数据POST过来填入的，post -> obj
    public static function fill(&$Data, $field) {
        return isset($Data[$field->boxname]) ? md5($Data[$field->boxname]) : '';
    }

    //数据库转对象； dbvals -> obj
    public static function setfield(&$vals, $field) {
        return '';
    }

    //对象写数据库； obj -> dbvals
    public static function setvals(&$vals, $field) {
        $vals[$field->name] = $field->value;
    }

}
