<?php

# 辅助编译模型表单无需了解

function smarty_template_function_model_form_base($_smarty_tpl, $params) {
    $model = $params['model'];
    $key = $params['key'];
    if (!empty($key) && isset($model->fields[$key])) {
        /**
         * @var ModelField Description
         */
        $box = $model->fields[$key];
        $type = $box->type;
        if (!isset($box->_ischange) || $box->_ischange === false) {
            //数据替换部分==
            $box->label_width = empty($box->label_width) ? '' : ' style="width:' . $box->label_width . 'px"';
            $box->box_width = empty($box->box_width) ? '' : ' style="width:' . $box->box_width . 'px"';
            $box->row_hide = $box->row_hide == true ? ' style="display:none"' : '';
            $box->required = !empty($box->required) ? '<em>*</em>' : '';
            $box->bymerge_type = empty($box->bymerge_type) ? false : true;
            $box->for_bymerge = isset($box->bymerge) && $box->bymerge && !empty($box->nextkey);
            $box->follow_text = empty($box->follow_text) ? '' : ' ' . $box->follow_text . ' ';
            $box->tip_back = !empty($box->tip_back) ? $box->follow_text . '<span class="smbox-help">' . $box->tip_back . '</span>' : $box->follow_text;
            $box->data_val_info = !empty($box->data_val_info) ? $box->data_val_info : '';
            $box->_ischange = true;
            $box->changeToServerAttr('_ischange');
        }
        $params['box'] = $box;
        if ($box->usehtml) {
            $callback = 'smarty_template_function_model_usehtml_' . $key;
            call_user_func($callback, $_smarty_tpl, $params);
        } else {
            $callback = 'smarty_template_function_model_form_' . $type;
            if (function_exists($callback)) {
                call_user_func($callback, $_smarty_tpl, $params);
            } else {
                smarty_template_function_model_form_default($_smarty_tpl, $params);
            }
        }
    }
}

function forsmarty_template_addtabs(&$fields, $_smarty_tpl, $model, $idx) {
    smarty_template_function_model_header($_smarty_tpl, array('model' => $model, 'tab' => $idx));
    foreach ($fields as $key => $temp_box) {
        if ($temp_box->merge == false) {
            smarty_template_function_model_form_base($_smarty_tpl, array('model' => $model, 'key' => $key));
        }
    }
    smarty_template_function_model_footer($_smarty_tpl, array());
}

function smarty_template_function_model_form($_smarty_tpl, $params) {
    $model = $params['model'];
    if ($model->attrs['istab']) {
        foreach ($model->tabs as $idx => $tab) {
            forsmarty_template_addtabs($tab, $_smarty_tpl, $model, $idx);
        }
        return;
    }
    forsmarty_template_addtabs($model->fields, $_smarty_tpl, $model, 0);
}

function smarty_rewrite_extension($tpl_source, $obj) {
    $left = addcslashes($obj->left_delimiter, $obj->left_delimiter);
    $right = addcslashes($obj->right_delimiter, $obj->right_delimiter);
    $ostr = preg_replace("/{$left}(include|extends) file=['|\"]\@(.+)['|\"]{$right}/", $obj->left_delimiter . '$1 file="' . str_replace('\\', '/', SAMAO_DIR . 'tpls' . DS) . '$2"' . $obj->right_delimiter, $tpl_source);
    $ostr = preg_replace("/{$left}#([a-z0-9_]+)\.([a-z0-9_]+)#{$right}/i", $obj->left_delimiter . 'C(\'$1.$2\')' . $obj->right_delimiter, $ostr);
    return preg_replace_callback('@__(RES|ROOT|PUBLIC|APPROOT|SELF|RUNROOT)__@', create_function('$match', 'return constant($match[0]);'), $ostr);
}
