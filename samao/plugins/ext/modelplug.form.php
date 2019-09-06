<?php

class ModelplugForm {

    const VAR_TYPE = 'custom';

    private static $modelDatas = array();

    private static function getModelData($field) {
        $name = $field->name . '_ModelData';
        if (isset(self::$modelDatas[$name])) {
            return self::$modelDatas[$name];
        }
        $model = $field->getPlugModel();
        self::$modelDatas[$name] = $modeldata = $model->getModelData();
        return self::$modelDatas[$name];
    }

    public static function script($field) {
        if ($field->plug_type == 3) {
            return '';
        }
        if ($field->plug_type <= 2) {
            $modeldata = self::getModelData($field);
            $addfunc = '';
            $removefunc = '';
            foreach ($modeldata->fields as $box) {
                $id = '"#' . $field->boxname . '_' . $box->boxname . '_"+idx';
                $xid = $field->boxname . '_' . $box->boxname . '_"+idx+"';

//图片上传--
                if ($box->type == 'upimg') {
                    $upurl = $box->upurl;
                    if (empty($upurl)) {
                        $upurl = C('SERVICE_UPFILE_URL');
                    }
                    $extensions = empty($box->extensions) ? 'jpg,jpeg,gif,png' : $box->extensions;
                    $strict_size = empty($box->strict_size) ? '' : 'strict_size:true,';
                    $imgtype = empty($box->img_type) ? 1 : $box->img_type;
                    if ($imgtype == 1) {
                        $addfunc.='$(' . $id . ').initAjaxUpFile({extensions:"' . $extensions . '",upurl:' . json_encode($upurl) . ',type:1,' . $strict_size . 'afterUpfile:function(){upload_showimg(' . $id . ');}});';
                    } else {
                        $addfunc.= '
                                        $("#' . $xid . '_cancel").off("click");
                                        $("#' . $xid . '_cancel").on("click",function(){
                                        $("#' . $xid . '").val("");
                                        $("#' . $xid . '_upimg").attr("src","' . __RES__ . '/images/upimg.png");});
                                        $("#' . $xid . '_upimg,#' . $xid . '_reup").initAjaxUpFile("close");
                                        $("#' . $xid . '_upimg,#' . $xid . '_reup").initAjaxUpFile({
                                            extensions:"' . $extensions . '"
                                            ,upurl:' . json_encode($upurl) . '
                                            ,' . $strict_size . '
                                            type:1
                                            ,bindbox:"#' . $xid . '"
                                            ,bindimg:"#' . $xid . '_upimg"
                                        });
                                 ';
                        $removefunc.='$("#' . $xid . '_upimg,#' . $xid . '_reup").initAjaxUpFile("close");';
                    }
                }
//文件上传--
                if ($box->type == 'upfile') {
                    $upurl = $field->upurl;
                    if (empty($upurl)) {
                        $upurl = C('SERVICE_UPFILE_URL');
                    }
                    $extensions = empty($box->extensions) ? '' : 'extensions:"' . $box->extensions . '",';
                    $addfunc.='$(' . $id . ').initAjaxUpFile({' . $extensions . 'upurl:' . json_encode($upurl) . '});';
                    $removefunc.='$(' . $id . ').initAjaxUpFile("close");';
                }
//日期选择
                if ($box->type == 'date') {
                    $addfunc.='$(' . $id . ').datepicker({dateFormat:\'yy-mm-dd\',changeMonth: true,changeYear:true,yearRange:\'1900:2050\'});';
                }
//时间选择
                if ($box->type == 'date') {
                    $addfunc.='$(' . $id . ').datepicker({dateFormat:\'yy-mm-dd\',changeMonth: true,changeYear:true,yearRange:\'1900:2050\'});';
                }
//时间选择
                if ($box->type == 'datetime') {
                    $addfunc.='$(' . $id . ').datetimepicker({dateFormat:\'yy-mm-dd\',changeMonth: true,changeYear:true});';
                }
//联动下拉
                if ($box->type == 'linkage') {
                    $addfunc.='$(' . $id . ').linkage();';
                }
//数字调整
                if ($box->type == 'amountnumber' || $box->type == 'amountdigits') {
                    $addfunc.='$(' . $id . ').amountbox();';
                }
                if ($box->type == 'colorselecter') {
                    $addfunc.='$(' . $id . ').initColorSelecter();';
                }
            }
            if (!empty($addfunc)) {
                $addfunc = ',addfunc:function(idx){' . $addfunc . '}';
            }
            if (!empty($removefunc)) {
                $removefunc = ',removefunc:function(idx){' . $removefunc . '}';
            }
            if ($field->plug_type == 2) {
                return '$(function() {$("#' . $field->id . '").smtabsTable({souresid:\'#' . $field->id . '_soures\'' . $addfunc . $removefunc . '});});';
            }
            return '$(function() {$("#' . $field->id . '").smtabs({souresid:\'#' . $field->id . '_soures\'' . $addfunc . $removefunc . '});});';
        }
    }

    public static function scriptfiles() {
        return array(__RES__ . '/js/jquery.json.js', __RES__ . '/js/samao.smtabs.js');
    }

    public static function code($field) {
        $field->data_val_off = 'true';
        $field->value = json_encode($field->value);
        $args = $field->getHtmlAttrs();
        $args['type'] = 'hidden';
        $strattr = empty($field->htmlattr) ? '' : ' ' . trim($field->htmlattr);
        foreach ($args as $key => $value) {
            if ($value !== '' && $key !== 'name') {
                $strattr.=' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        $code = '<script type="text/code" id="' . $field->id . '_soures">';
        if ($field->plug_type == 0) {
            $code.='<div class="form-modelplug-item">' . "\n";
        } elseif ($field->plug_type == 1) {
            $code.='<div class="form-modelplug-item"><div class="form-group-modelplug">' . "\n";
        }
        $modeldata = self::getModelData($field);
        $ths = array('<th class="removeth"></th>');
        $tds = array('<td class="removeth"><a class="btndel samao-link-btn" href="javascript:;">-</a></td>');
        $bymerge = false;
        foreach ($modeldata->fields as $box) {
            $box->noscript = true;
            $box->id = $field->boxname . '_' . $box->boxname . '_@index';
            $box->boxname = empty($box->boxname) ? $box->name : $box->boxname;


            //默认模式
            if ($field->plug_type == 0) {
                $box->data_valmsg_for = '#' . $field->boxname . '_@index_info';
                $box->for_bymerge = isset($box->bymerge) && $box->bymerge && !empty($box->nextkey);
                $box->tip_back = !empty($box->tip_back) ? $box->follow_text . '<span class="smbox-help">' . $box->tip_back . '</span>' : $box->follow_text;
                $box->tip_front = !empty($box->tip_front) ? '<p>' . $box->tip_front . '</p>' : '';
                $item = FormBox::Fdefault(array('name' => $box->name, 'type' => $box->type, 'boxname' => $field->boxname . '[@index][' . $box->boxname . ']'), $modeldata) . ' ' . $box->tip_back;
                if (!$box->merge && !$bymerge) {
                    $box->label_width = empty($box->label_width) ? '' : ' style="width:' . $box->label_width . 'px"';
                    $code.='<div class="form-group-modelplug"><label class="form-label modelplug" ' . $box->label_width . '>' . $box->label . ':' . $box->tip_front . '</label>' . ' <div class="form-box modelplug">' . $item;
                    if ($box->for_bymerge) {
                        $bymerge = true;
                        continue;
                    }
                    $code.='</div></div>' . "\n";
                } else {
                    if (isset($box->label[0]) && $box->label[0] != '#') {
                        $code.='<label class="form-label-inner modelplug" >' . $box->label . '：' . $box->tip_front . '</label>';
                    }
                    $code.= $item;
                    $code.='&nbsp;&nbsp;&nbsp;';
                    if ($bymerge && !$box->for_bymerge) {
                        $code.='</div></div>' . "\n";
                        $bymerge = false;
                    }
                }
            } elseif ($field->plug_type == 1) {
                $box->data_valmsg_for = '#' . $field->boxname . '_@index_info';
                $box->for_bymerge = isset($box->bymerge) && $box->bymerge && !empty($box->nextkey);
                $box->tip_back = !empty($box->tip_back) ? $box->follow_text . '<span class="smbox-help">' . $box->tip_back . '</span>' : $box->follow_text;
                $box->tip_front = !empty($box->tip_front) ? '<p>' . $box->tip_front . '</p>' : '';
                $item = FormBox::Fdefault(array('name' => $box->name, 'boxname' => $field->boxname . '[@index][' . $box->boxname . ']'), $modeldata) . ' ' . $box->tip_back;
                if (isset($box->label[0]) && $box->label[0] != '#') {
                    $code.='<label class="form-label-inner modelplug" >' . $box->label . '：' . $box->tip_front . '</label>';
                }
                $code.= $item;
                $code.='&nbsp;&nbsp;&nbsp;';
            } else {
                if (!preg_match('/@/', $box->data_valmsg_for)) {
                    $box->data_valmsg_for = '#' . $box->id . '_info';
                }
                $item = FormBox::Fdefault(array('name' => $box->name, 'boxname' => $field->boxname . '[@index][' . $box->boxname . ']'), $modeldata) . ' ' . $box->tip_back;
                $ths[] = '<th ' . ( empty($box->label_width) ? '' : ' style="width:' . $box->label_width . 'px"') . '>' . $box->label . (!empty($box->required) ? '<em>*</em>' : '') . '</th>';
                $tds[] = '<td>' . $item . '</td>';
            }
        }

        $table = '';
        if ($field->plug_type == 2) {
            $table = '<table id="' . $field->id . '_table" class="form-modelplug-table"><tbody><tr>' . join('', $ths) . '</tr></tbody></table>';
            $code.='<tr class="item">' . join('', $tds) . '</tr>';
            $code.='</script>';
            return $table . $code . '<input' . $strattr . ' /><span id="' . $field->id . '_info"></span>';
        } else {
            if ($field->plug_type == 1) {
                $code.='<span class="item-btns"></span>&nbsp;&nbsp;&nbsp;<span id="' . $field->boxname . '_@index_info"></span></div></div>';
            } else {
                $code.='<div class="item-btns-area"><span class="item-btns"></span>&nbsp;&nbsp;&nbsp;<span id="' . $field->boxname . '_@index_info"></span></div></div>';
            }
            $code.='</script>';
            return $table . $code . '<input' . $strattr . ' />';
        }
    }

    public static function fill(&$Data, $field) {
        $model = $field->getPlugModel();
        $temps = isset($Data[$field->boxname]) && is_array($Data[$field->boxname]) ? $Data[$field->boxname] : array();
        $values = array();
        foreach ($temps as $value) {
            if (!empty($value)) {
                $model->initVals();
                $model->autoComplete($vals, $value);
                if ($model->validation()) {
                    $values[] = $vals;
                } else {
                    $field->error = $model->getFirstError();
                    $values[] = $value;
                }
            }
        }
        return $values;
    }

    public static function setfield(&$vals, $field) {
        //取该字段值==
        $val = empty($vals[$field->name]) ? '' : $vals[$field->name];
        if (is_string($val)) {
            if (!preg_match('@^\[@', $val)) {
                return array();
            }
            return json_decode($val, true);
        }
        return $val;
    }

    public static function setvals(&$vals, $field) {
        $vals[$field->name] = json_encode($field->value);
    }

}
