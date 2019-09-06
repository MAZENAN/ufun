<?php

/**
 * 模型数据类 主要返回给Smarty 模板使用
 * @package UxFW 
 * @subpackage framework
 */
class ModelData {

    public $usehtml = false;
    public $name = '';

    /**
     * 模型结构数据数据
     * @var array 
     */
    public $attrs = array();

    /**
     * 模型字段数据
     * @var array 
     */
    public $fields = array();

    /**
     * 标签分栏字段规则数据
     * @var array 
     */
    public $tabs = array();

}

class ModelFieldData {

    function __construct(&$fields) {
        foreach ($fields as $key => $field) {
            $this->$key = &$field->value;
        }
    }

}

/**
 * @property int $modeltype
 * @property string $key
 * @property string $title
 * @property bool $istab
 * @property array $tabs
 * @property string $toptip
 * @property array $incscriptfiles
 * @property string $script
 * @property string $action
 * @property string $acttext
 * @property string $back
 * @property string $backscript
 * @property string $model_tag
 */
class Model {

    const MODEL_ADD = 0;
    const MODEL_EDIT = 1;

    /**
     * 文本框
     */
    const Line_Box = 'line';

    /**
     * 显示标签
     */
    const Label_Box = 'label';

    /**
     * 文本框
     */
    const Text_Box = 'text';

    /**
     * 是否型
     */
    const Bool_Box = 'bool';

    /**
     * 日期型
     */
    const Date_Box = 'date';

    /**
     * 时间型
     */
    const DateTime_Box = 'datetime';

    /**
     * 多选框
     */
    const CheckGroup_Box = 'checkgroup';

    /**
     * 整数型
     */
    const Digits_Box = 'digits';

    /**
     * 隐藏型
     */
    const Hidden_Box = 'hidden';

    /**
     * 联动下拉型
     */
    const Linkage_Box = 'linkage';

    /**
     * 数字型
     */
    const Number_Box = 'number';

    /**
     * 密码型
     */
    const Password_Box = 'password';

    /**
     * 单选框
     */
    const RadioGroup_Box = 'radiogroup';

    /**
     * 下拉菜单
     */
    const Select_Box = 'select';

    /**
     * 文本域
     */
    const TextArea_Box = 'textarea';

    /**
     * 裁剪缩略图
     */
    const Thumbnail_Box = 'thumbnail';

    /**
     * 上传文件
     */
    const UpFile_Box = 'upfile';

    /**
     * 上传多文件
     */
    const UpGroup_Box = 'upgroup';

    /**
     * 上传图片
     */
    const UpImg_Box = 'upimg';

    /**
     * 上传多图片
     */
    const UpImgGroup_Box = 'upimggroup';

    /**
     * 验证码
     */
    const ValidCode_Box = 'validcode';

    /**
     * xh编辑器
     */
    const xhEditor_Box = 'xheditor';

    /**
     * 百度编辑器
     */
    const UEditor_Box = 'ueditor';

    /**
     * 无设置类型
     */
    const None_Box = 'none';

    /**
     * 颜色选择器
     */
    const ColorSelecter_Box = 'colorselecter';

    /**
     *
     * @var ModelField 
     */
    public $Fields = array();
    public $_errors = array();
    private $_attrs = array(
        'modeltype' => self::MODEL_ADD,
        'key' => '',
        'title' => '',
        'istab' => false,
        'tabsplit' => false,
        'tabs' => array(),
        'toptip' => '',
        'incscriptfiles' => array(),
        'script' => '',
        'action' => '',
        'acttext' => '提交',
        'back' => '返回',
        'backscript' => '',
        'model_tag' => 0,
        'btns_left' => 0,
    );
    private $_init = false;
    private static $_res = array();
    private static $reged = false;

    function __construct($modeltype = self::MODEL_ADD, $init = true) {
        $this->modeltype = $modeltype;
        if ($init) {
            $this->init();
        }
    }

    public function init() {
        if ($this->_init) {
            return;
        }
        $this->_init = true;
        if ($this->_attrs['action'] == '') {
            $this->_attrs['action'] = ( Route::get('act') == '' || Route::get('act') == 'index' ? 'add' : Route::get('act') );
        }
        $_fields = $this->fields();
        foreach ($_fields as $key => $field) {
            if (gettype($field) == 'array') {
                $field['name'] = $key;
                $this->Fields[$key] = new ModelField($field, $this);
            } else {
                $field->name = $key;
                $this->Fields[$key] = $field;
            }
        }
    }

    public function addscriptfiles($file) {
        $this->_attrs['incscriptfiles'][] = $file;
    }

    public function appendscript($code) {
        $this->_attrs['script'].= $code;
    }

    public function __get($name) {
        if (isset($this->_attrs[$name])) {
            return $this->_attrs[$name];
        }
    }

    public function __set($name, $value) {
        $this->_attrs[$name] = $value;
    }

    public function __isset($name) {
        if (isset($this->_attrs[$name])) {
            return true;
        }
        return false;
    }

    public function __unset($name) {
        unset($this->_attrs[$name]);
    }

    public static function addModelScriptfile($file) {
        if (!isset(self::$_res['scriptfiles'])) {
            self::$_res['scriptfiles'] = array();
        }
        if (!in_array($file, self::$_res['scriptfiles'])) {
            self::$_res['scriptfiles'][] = $file;
        }
    }

    public static function addModelScript($script) {
        if (!isset(self::$_res['scripts'])) {
            self::$_res['scripts'] = array();
        }
        if (trim($script) != '') {
            self::$_res['scripts'][] = $script;
        }
    }

    public static function addModelCssfile($file) {
        if (!isset(self::$_res['cssfiles'])) {
            self::$_res['cssfiles'] = array();
        }
        if (!in_array($file, self::$_res['cssfiles'])) {
            self::$_res['cssfiles'][] = $file;
        }
    }

    private static function getModelCss() {
        $html = '';
        if (isset(self::$_res['cssfiles'])) {
            foreach (self::$_res['cssfiles'] as $value) {
                $value = preg_replace_callback('@__(RES|ROOT|PUBLIC|APPROOT|SELF)__@', create_function('$match', 'return constant($match[0]);'), $value);
                $html.='<link href="' . $value . '" rel="stylesheet" type="text/css" />' . "\n";
            }
        }
        return $html;
    }

    private static function getModelScript() {
        $html = '';
        if (isset(self::$_res['scriptfiles'])) {
            foreach (self::$_res['scriptfiles'] as $value) {
                $value = preg_replace_callback('@__(RES|ROOT|PUBLIC|APPROOT|SELF)__@', create_function('$match', 'return constant($match[0]);'), $value);
                $html.='<script type="text/javascript" charset="utf-8" src="' . $value . '"></script>' . "\n";
            }
        }
        if (isset(self::$_res['scripts'])) {
            $script = '';
            foreach (self::$_res['scripts'] as $value) {
                $value = preg_replace_callback('@__(RES|ROOT|PUBLIC|APPROOT|SELF)__@', create_function('$match', 'return constant($match[0]);'), $value);
                $script.=$value . "\n";
            }
            $script = trim($script);
            if (!empty($script)) {
                $html.='<script type="text/javascript">' . "\n" . $script . '</script>' . "\n";
            }
        }
        return $html;
    }

    /**
     * 内部使用 无需关注=====
     * @param type $tpl_source
     * @return type
     */
    public static function getSmartyResource($tpl_source) {
        if (!(isset(self::$_res['cssfiles']) || isset(self::$_res['scriptfiles']) || isset(self::$_res['scripts']))) {
            $tpl_source = str_ireplace('<!--samao model css-->', '', $tpl_source);
            $tpl_source = str_ireplace('<!--samao model script-->', '', $tpl_source);
            return $tpl_source;
        }
        $csshtml = self::getModelCss();
        $scripthtml = self::getModelScript();
        if (trim($csshtml) != '') {
            if (preg_match('@<!--samao model css-->@i', $tpl_source)) {
                $tpl_source = str_ireplace('<!--samao model css-->', $csshtml, $tpl_source);
            } elseif (preg_match('@</head>@i', $tpl_source)) {
                $tpl_source = str_ireplace('</head>', $csshtml . "\n</head>", $tpl_source);
            } else {
                $tpl_source = $csshtml . "\n" . $tpl_source;
            }
        }
        if (trim($scripthtml) != '') {
            if (preg_match('@<!--samao model script-->@i', $tpl_source)) {
                $tpl_source = str_ireplace('<!--samao model script-->', $scripthtml, $tpl_source);
            } elseif (preg_match('@</head>@i', $tpl_source)) {
                $tpl_source = str_ireplace('</head>', $scripthtml . "\n</head>", $tpl_source);
            } else {
                $tpl_source = $scripthtml . "\n" . $tpl_source;
            }
        }
        return $tpl_source;
    }

    /**
     * 自动加入模型脚本到模板页面中。
     * 在使用 Controller->displayModel();时将会调用本函数 无需自行再次调用。
     * @param Controller $control
     */
    public static function regSmartyOutputHead($control) {
        if (self::$reged)
            return;
        self::$reged = true;
        $control->registerFilter('output', array('Model', 'getSmartyResource'));
    }

    /**
     * 前置默认项
     */
    public function fieldDefault($attr) {
        return null;
    }

    /**
     * 修正字段
     */
    public function fieldRevised($field) {
        
    }

    /**
     * 设置字段值 这个函数将被后期重载实现
     * 依据返回值创建 ModelField 数据集合
     * @return array 返回默认选项
     * 如返回
     * <code>
     * array('class'=>'boxinput','width'=>'100',...);
     * </code>
     * 
     */
    public function fields() {
        return array();
    }

    public function addfield($key, $field) {
        if (gettype($field) == 'array') {
            $field = new ModelField($field);
        }
        if ($field->name == '') {
            $field->name = $key;
        }
        $this->Fields[$key] = $field;
    }

    public function getfield($key) {
        return isset($this->Fields[$key]) ? $this->Fields[$key] : null;
    }

    /**
     * 清除所有错误信息===
     * @return \Model
     */
    public function cleanAllError() {
        foreach ($this->Fields as $field) {
            $field->error = '';
        }
        $this->_errors = array();
        return $this;
    }

    /**
     * 添加字段错误信息
     * @param string $key
     * @param array $errmsg
     * @return \Model
     */
    public function addError($key, $errmsg) {
        $this->Fields[$key]->error = $errmsg;
        if (!empty($errmsg)) {
            $this->_errors[$key] = $errmsg;
        }
        return $this;
    }

    /**
     * 移除字段错误信息
     * @param string $key
     * @return \Model
     */
    public function removeError($key) {
        $this->_errors = array();
        $this->Fields[$key]->error = '';
        return $this;
    }

    /**
     * 移除字段错误信息
     * @param string $key
     * @return \Model
     */
    public function getError($key) {
        return isset($this->Fields[$key]) ? $this->Fields[$key]->error : '';
    }

    public function getAllError() {
        return $this->_errors;
    }

    public function getFirstError() {
        return reset($this->_errors);
    }

    //创建字段相关脚本
    /**
     * 
     * @param ModelField $field
     */
    private function validDynamic($field, $fields) {
        if ($field->dynamic === NULL || gettype($field->dynamic) != 'array') {
            return;
        }
        if (!($field->type == 'bool' || $field->type == 'select' || $field->type == 'radiogroup')) {
            return;
        }
        try {
            if ($field->type == 'bool') {
                $val = $field->value ? 1 : 0;
            } else {
                $val = $field->value;
            }
            foreach ($field->dynamic as $item) {
                if ((empty($item['hide']) && empty($item['off'])) || (array_key_exists('val', $item) && $val != $item['val']) || (array_key_exists('nval', $item) && $val == $item['nval'])) {
                    continue;
                }
                $offstr = '';
                if (!empty($item['hide'])) {
                    $offstr.='|' . trim($item['hide']);
                }
                if (!empty($item['off'])) {
                    $offstr.='|' . trim($item['off']);
                }
                $hides = explode('|', trim($offstr, '|'));
                foreach ($hides as $hideid) {
                    $hideid = trim($hideid);
                    $box = (empty($hideid) || !isset($fields[$hideid])) ? null : $fields[$hideid];
                    if (!empty($box)) {
                        $box->data_val_off = true;
                    }
                }
            }
        } catch (Exception $e) {
            
        }
    }

    /**
     * 执行字段数据验证控件
     * @return boolean
     */
    public function validation() {
        $fields = $this->getFields();
        $result = true;
        foreach ($fields as $key => $field) {
            $this->validDynamic($field, $fields);
        }
        foreach ($fields as $key => $field) {
            if ($field->close) {
                continue;
            }
            $errmsg = $this->getError($key);
            if ($field->type == 'validcode') {
                $vals = $field->data_val;
                $vals['validcode'] = true;
                $field->data_val = $vals;
            }
            $re = Validate::checkItem($key, $field, $errmsg);//var_dump($key,$errmsg)
            if (!$re) {
                $this->addError($key, $errmsg);
            }
            $result = $re && $result;
        }
        return $result;
    }

    /**
     * 获取所有字段属性数组
     * @return ModelField
     */
    private function getFields() {
        $this->initModelTag();
        if ($this->tabsplit && $this->istab) {
            $temp = array();
            foreach ($this->Fields as $key => $field) {
                if ($field->tag_shared == true || ($field->tab === $this->model_tag && isset($this->tabs[$field->tab]) && $this->tabs[$field->tab] !== NULL)) {
                    $temp[$key] = $field;
                }
            }
            return $temp;
        } elseif ($this->istab) {
            $temp = array();
            foreach ($this->Fields as $key => $field) {
                if (isset($this->tabs[$field->tab]) && $this->tabs[$field->tab] != NULL) {
                    $temp[$key] = $field;
                }
            }
            return $temp;
        }
        return $this->Fields;
    }

    /**
     * 获取所有要被编辑的数据库字段
     */
    public function getDBFields() {
        $fields = $this->getFields();
        $dbfields = array();
        foreach ($fields as $key => $field) {
            if ($this->modeltype == self::MODEL_EDIT && $field->offedit == true) {
                continue;
            }
            if ($field->close == true) {
                continue;
            }
            if ($field->dbfield == FALSE) {
                continue;
            }
            if ($field->type == self::Label_Box) {
                continue;
            }
            if ($field->type == self::Line_Box) {
                continue;
            }
            if ($field->type == self::ValidCode_Box) {
                continue;
            }
            if (($field->vartype == 'array' || $field->vartype == 'custom') && $field->names_dbfield) {
                foreach ($field->names as $idx => $kname) {
                    $dbfields[] = $kname;
                }
            } else {
                $dbfields[] = $key;
            }
        }
        return $dbfields;
    }

    /**
     * 自动完成表单
     * @param string $method GET|POST 提交类型。
     * @return ModelFieldData 迭代器
     */
    public function autoComplete(&$vals = array(), $Data = null) {
        $fields = $this->getFields();
        $D = array();
        if ($Data == null) {
            if (IS_POST) {
                $D = $_POST;
            } else {
                $D = $_GET;
            }
        } else {
            $D = $Data;
        }
        foreach ($fields as $field) {
            if ($this->modeltype == self::MODEL_EDIT && $field->offedit == true) {
                continue;
            }
            if ($field->close == true) {
                continue;
            }
            if ($field->type == self::Label_Box) {
                continue;
            }
            if ($field->type == self::Line_Box) {
                continue;
            }
            if ($field->close_html == true) {
                $field->value = $field->default;
                continue;
            }
            $field->boxname = empty($field->boxname) ? $field->name : $field->boxname;
            if ('float' == $field->vartype) {
                $field->value = isset($D[$field->boxname]) ? floatval($D[$field->boxname]) : 0;
            } elseif ('int' == $field->vartype) {
                $field->value = isset($D[$field->boxname]) ? intval($D[$field->boxname]) : 0;
            } elseif ('bool' == $field->vartype) {
                $field->value = isset($D[$field->boxname]) && intval($D[$field->boxname]) == 1 ? true : false;
            } elseif ('array' == $field->vartype) {
                $value = isset($D[$field->boxname]) ? $D[$field->boxname] : array();
                if (gettype($value) != 'array') {
                    $value = json_decode(empty($D[$field->boxname]) ? '[]' : $D[$field->boxname], true);
                }
                $field->value = $value;
            } elseif ('custom' == $field->vartype) {
                $fromclass = to_camel($field->type) . 'Form';
                if (method_exists($fromclass, 'fill')) {
                    $callback = $fromclass . '::fill';
                    $value = call_user_func_array($callback, array(&$D, $field));
                    $field->value = $value;
                } else {
                    throw new Exception('自定义 ' . $fromclass . '插件中，不存在静态函数' . $fromclass . '::fill');
                }
            } else {
                $field->value = isset($D[$field->boxname]) ? $D[$field->boxname] : NULL;
            }
            //默认值==
            if ($field->value === NULL) {
                if ($field->default !== NULL) {
                    $field->value = $field->default;
                } else {
                    if ($field->vartype == 'string') {
                        $field->value = '';
                    }
                }
            }
        }
        $this->formatVals($vals);
        return new ModelFieldData($this->Fields);
    }

    /**
     * 将数据库数组格式化为字段数值==
     * 已数组形式的数值，一般是数据库提取出来的值 来更新字段值
     * @param array $vals
     * @return \Model
     */
    public function setFieldVals($vals) {
        if (gettype($vals) != 'array') {
            return $this;
        }
        $fields = $this->getFields();
        foreach ($fields as $key => $field) {
            if (!isset($vals[$key]) && !($field->vartype == 'array' || $field->vartype == 'custom')) {
                continue;
            }
            $value = isset($vals[$key]) ? $vals[$key] : NULL;
            if ($field->vartype == 'array') {
                $field->value = json_decode($value, TRUE);
            } elseif ($field->vartype == 'bool') {
                $field->value = $value == 1 ? true : false;
            } elseif ('custom' == $field->vartype) {
                $fromclass = to_camel($field->type) . 'Form';
                if (method_exists($fromclass, 'setfield')) {
                    $callback = $fromclass . '::setfield';
                    $value = call_user_func_array($callback, array(&$vals, $field));
                    $field->value = $value;
                } else {
                    throw new Exception('自定义 ' . $fromclass . '插件中，不存在静态函数' . $fromclass . '::setfield');
                }
            } else {
                $field->value = $value;
            }
        }
        return $this;
    }

    /**
     * 格式化数据为可保存入库的值==
     * 格式化为可以存入数据库的数组值。
     * @return array
     */
    public function formatVals(&$vals = array()) {
        $fields = $this->getFields();
        foreach ($fields as $key => $field) {
            if ($this->modeltype == self::MODEL_EDIT && $field->offedit == true) {
                continue;
            }
            if ($field->close == true) {
                continue;
            }

            if ($field->dbfield == FALSE) {
                continue;
            }

            if ($field->type == self::Label_Box) {
                continue;
            }
            if ($field->type == self::Line_Box) {
                continue;
            }
            if ($field->type == self::ValidCode_Box) {
                continue;
            }
            if ($field->vartype == 'array') {
                $vals[$key] = json_encode($field->value);
            } elseif ($field->vartype == 'bool') {
                $vals[$key] = $field->value ? 1 : 0;
            } elseif ($field->vartype == 'int') {
                $vals[$key] = intval($field->value);
            } elseif ($field->vartype == 'float') {
                $vals[$key] = floatval($field->value);
            } elseif ('custom' == $field->vartype) {
                $fromclass = to_camel($field->type) . 'Form';
                if (method_exists($fromclass, 'setvals')) {
                    $callback = $fromclass . '::setvals';
                    call_user_func_array($callback, array(&$vals, $field));
                } else {
                    throw new Exception('自定义 ' . $fromclass . '插件中，不存在静态函数' . $fromclass . '::setvals');
                }
            } else {
                if ($field->value === '' && ($field->type == self::Date_Box || $field->type == self::DateTime_Box)) {
                    $vals[$key] = NULL;
                } else {
                    $vals[$key] = $field->value;
                }
            }
        }
        return $vals;
    }

    //创建字段相关脚本
    /**
     * 
     * @param ModelField $field
     */
    private function createFieldScript($field, $fields) {
        if ($field->dynamic === NULL || gettype($field->dynamic) != 'array') {
            return;
        }
        if ($field->type == 'bool' || $field->type == 'select' || $field->type == 'radiogroup') {
            $script = '$(function(){ var fun=function(){';
            if ($field->type == 'bool') {
                $script.= 'var val=$("#' . $field->boxname . '").is(":checked")?1:0;';
            }
            if ($field->type == 'select') {
                $script.= 'var val=$("#' . $field->boxname . '").val();';
            }
            if ($field->type == 'radiogroup') {
                $script.= 'var val=$("input[name=' . $field->boxname . ']:checked").val();';
            }
            foreach ($field->dynamic as $item) {
                if (array_key_exists('val', $item)) {
                    $script.='if(val=="' . $item['val'] . '"){';
                } elseif (array_key_exists('nval', $item)) {
                    $script.='if(val!="' . $item['nval'] . '"){';
                } else {
                    return;
                }
                //显示
                if (isset($item['show'])) {
                    $shows = explode('|', $item['show']);
                    $showrows = array();
                    $showids = array();
                    foreach ($shows as $showid) {
                        $showid = trim($showid);
                        $box = (empty($showid) || !isset($fields[$showid])) ? null : $fields[$showid];
                        $showid = $box == null ? '' : $box->boxname;
                        if (!empty($showid)) {
                            $showrows[] = '#row_' . $showid;
                            $showids[] = ($box != null && $box->type == 'linkage') ? '#linkage_' . $showid . ' select' : '#' . $showid;
                        }
                    }
                    if (count($showids) > 0) {
                        $script.='$("' . join(',', $showrows) . '").show();';
                        $script.='$("' . join(',', $showids) . '").removeAttr("data_val_off");';
                    }
                }
                //验证
                if (isset($item['on'])) {
                    $shows = explode('|', $item['on']);
                    $showids = array();
                    foreach ($shows as $showid) {
                        $showid = trim($showid);
                        $box = (empty($showid) || !isset($fields[$showid])) ? null : $fields[$showid];
                        $showid = $box == null ? '' : $box->boxname;
                        if (!empty($showid)) {
                            $showids[] = ($box != null && $box->type == 'linkage') ? '#linkage_' . $showid . ' select' : '#' . $showid;
                        }
                    }
                    if (count($showids) > 0) {
                        $script.='$("' . join(',', $showids) . '").removeAttr("data_val_off");';
                    }
                }
                //隐藏
                if (isset($item['hide'])) {
                    $hides = explode('|', $item['hide']);
                    $hiderows = array();
                    $hideids = array();
                    foreach ($hides as $hideid) {
                        $hideid = trim($hideid);
                        $box = (empty($hideid) || !isset($fields[$hideid])) ? null : $fields[$hideid];
                        $hideid = $box == null ? '' : $box->boxname;
                        if (!empty($hideid)) {
                            $hiderows[] = '#row_' . $hideid;
                            $hideids[] = ($box != null && $box->type == 'linkage') ? '#linkage_' . $hideid . ' select' : '#' . $hideid;
                        }
                    }
                    if (count($hideids) > 0) {
                        $script.='$("' . join(',', $hiderows) . '").hide();';
                        $script.='$("' . join(',', $hideids) . '").attr("data_val_off","1");';
                    }
                }
                //关闭验证
                if (isset($item['off'])) {
                    $hides = explode('|', $item['off']);
                    $hideids = array();
                    foreach ($hides as $hideid) {
                        $hideid = trim($hideid);
                        $box = (empty($hideid) || !isset($fields[$hideid])) ? null : $fields[$hideid];
                        $hideid = $box == null ? '' : $box->boxname;
                        if (!empty($hideid)) {
                            $hideids[] = ($box != null && $box->type == 'linkage') ? '#linkage_' . $hideid . ' select' : '#' . $hideid;
                        }
                    }
                    if (count($hideids) > 0) {
                        $script.='$("' . join(',', $hideids) . '").attr("data_val_off","1");';
                    }
                }
                $script.='}';
            }
            $script.='};';
            $script.='fun();$(\'form\').initSMF({beforefn:fun});';
            if ($field->type == 'bool') {
                $script.= '$("#' . $field->boxname . '").click(fun);';
            }
            if ($field->type == 'select') {
                $script.= '$("#' . $field->boxname . '").change(fun);';
            }
            if ($field->type == 'radiogroup') {
                $script.= '$("input[name=' . $field->boxname . ']").click(fun);';
            }
            $script.='});';
            self::addModelScript($script);
        }
    }

    public function initVals() {
        foreach ($this->Fields as $field) {
            $field->value = NULL;
        }
    }

    private function initModelTag() {
        //处理拆分保存
        foreach ($this->_attrs['tabs'] as $key => $value) {
            if (!is_array($value)) {
                $value = array('name' => $value);
            }
            $value['tips'] = isset($value['tips']) ? $value['tips'] : '';
            $this->_attrs['tabs'][$key] = $value;
        }
        $this->_attrs['tab_keys'] = array_keys($this->_attrs['tabs']);
        if (count($this->_attrs['tab_keys']) == 0) {
            $this->_attrs['tab_keys'][] = 0;
        }
        //拆分情况下
        if ($this->_attrs['tabsplit'] == true) {
            $this->_attrs['model_tag'] = SGet('model_tag');
            if (empty($this->_attrs['model_tag'])) {
                $this->_attrs['model_tag'] = $this->_attrs['tab_keys'][0];
            }
        }
    }

    /**
     * 获取模型数据 为模板引擎整理一份数据供模板调用。
     * @return \ModelData
     */
    public function getModelData() {
        try {
            $modeldata = new ModelData();
            $modeldata->name = substr(get_class($this), 0, -5);
            //获取呈现
            $modeldata->fields = $this->getFields();
            $data_val_smtip = false;
            //处理拆分情况
            if ($this->_attrs['tabsplit'] == true) {
                $url = preg_replace('@[?&]?model_tag=[^&=]*@', '', $_SERVER['QUERY_STRING']);
                if (is_array($this->_attrs['tabs'])) {
                    foreach ($this->_attrs['tabs'] as $key => $value) {
                        if ($url == '') {
                            $value['url'] = '?model_tag=' . $key;
                        } else {
                            $value['url'] = '?' . $url . '&model_tag=' . $key;
                        }
                        $this->_attrs['tabs'][$key] = $value;
                    }
                }
            }
            $modeldata->attrs = $this->_attrs;
            //添加脚本
            if (gettype($this->incscriptfiles) == 'array') {
                foreach ($this->incscriptfiles as $file) {
                    $exts = explode('.', $file);
                    $ext = strtolower($exts[count($exts) - 1]);
                    if ($ext == 'css') {
                        self::addModelCssfile($file);
                    } else {
                        self::addModelScriptfile($file);
                    }
                }
            }
            if (!empty($this->script)) {
                self::addModelScript($this->script);
            }
            //过滤==
            foreach ($modeldata->fields as $key => $field) {
                if ($field->type == self::None_Box || $field->close == true || $field->close_html == true) {
                    unset($modeldata->fields[$key]);
                }
            }
            //标签==
            if ($this->istab) {
                //分离栏目---
                $tabfields = array();
                foreach ($modeldata->fields as $key => $field) {
                    $tabfields[$field->tab][$key] = $field;
                }
                $prevkey = FALSE;
                foreach ($tabfields as $idx => $tab) {
                    $keys = array_keys($tab); //获取键名数组
                    foreach ($keys as $t => $key) {
                        $nkey = isset($keys[$t + 1]) ? $keys[$t + 1] : FALSE; //是否存在下一个键名
                        $field = $tab[$key];
                        $next = $nkey !== FALSE ? $tab[$nkey] : FALSE;
                        $tab[$key] = new stdClass();
                        $tab[$key]->merge = $field->merge;
                        $modeldata->fields[$key]->bymerge = $next === FALSE ? false : $next->merge;
                        $modeldata->fields[$key]->bymerge_type = $next === FALSE ? false : $next->merge_type;
                        $modeldata->fields[$key]->nextkey = $nkey == FALSE ? '' : $nkey;
                        $modeldata->fields[$key]->prevkey = $prevkey == FALSE ? '' : $prevkey;
                        $prevkey = $key;
                    }
                    $tabfields[$idx] = $tab;
                }
                $modeldata->tabs = $tabfields;
            } else {
                $keys = array_keys($modeldata->fields);
                $prevkey = FALSE;
                foreach ($keys as $idx => $key) {
                    $nkey = isset($keys[$idx + 1]) ? $keys[$idx + 1] : FALSE;
                    $field = $modeldata->fields[$key];
                    $next = $nkey !== FALSE ? $modeldata->fields[$nkey] : FALSE;
                    $modeldata->fields[$key]->bymerge = $next === FALSE ? false : $next->merge;
                    $modeldata->fields[$key]->bymerge_type = $next === FALSE ? false : $next->merge_type;
                    $modeldata->fields[$key]->nextkey = $nkey == FALSE ? '' : $nkey;
                    $modeldata->fields[$key]->prevkey = $prevkey == FALSE ? '' : $prevkey;
                    $prevkey = $key;
                }
            }
            //修正验证部分===
            foreach ($modeldata->fields as $key => $field) {
                if (!empty($field->usehtml)) {
                    //使用自定义内容只有使用数据形式才能支持==
                    $modeldata->usehtml = true;
                }
                if ($field->type == self::Line_Box) {
                    $field->merge = false;
                }
                if ($field->offedit == true && $this->modeltype == self::MODEL_EDIT) {
                    $field->disabled = 'disabled';
                    $field->data_val_off = true;
                    $field->data_val = '';
                    $field->data_val_msg = '';
                    $field->data_valmsg_for = '';
                } else {
                    if (!empty($field->data_val) || !empty($field->data_vals)) {
                        if (empty($field->data_valmsg_for)) {
                            $field->data_val_info = '<span id="' . $field->boxname . '_info" class="field-info"></span>';
                            if (!empty($field->bymerge_type) && $field->merge && !empty($field->prevkey)) {
                                $pfield = isset($modeldata->fields[$field->prevkey]) ? $modeldata->fields[$field->prevkey] : null;
                                if ($pfield != null) {
                                    $field->data_valmsg_for = $pfield->data_valmsg_for;
                                }
                            } else {
                                $field->data_valmsg_for = '#' . $field->boxname . '_info';
                            }
                        }
                    }
                }
                if ($field->data_val_smtip) {
                    $data_val_smtip = 1;
                }
                $this->createFieldScript($field, $modeldata->fields);
            }
            if ($data_val_smtip) {
                Model::addModelScriptfile('__RES__/js/samao.smtip.js');
            }
            return $modeldata;
        } catch (Exception $exc) {
            throw new Exception('模型解析数据有误，请检查您的模型操作是否正常。');
        }
    }

    /**
     * 将ModelData注册表单值 并同时开启自动加入脚本
     * @param Smarty $smarty
     * @param string $name 注册到Smarty模板中的变量名称，默认为 model
     */
    public function assignTo(&$smarty, $name = 'model') {
        try {
            self::regSmartyOutputHead($smarty);
            $modeldata = $this->getModelData();
            $smarty->assign($name, $modeldata);
            $smarty->registerResource('modelskin', new ModelSkin());
            if ($modeldata->usehtml) {
                $smarty->registerResource('modeltpl', new ModelTpl());
            }
            return $this;
        } catch (Exception $exc) {
            throw new Exception('模型解析数据有误，请检查您的模型操作是否正常。');
        }
    }

}
