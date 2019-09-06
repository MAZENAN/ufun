<?php

/**
 * @property string $name
 * @property string $boxname
 * @property string $type
 * @property string $class
 * @property string $style
 * @property string $data_val
 * @property string $data_val_msg
 * @property string $data_val_msgs
 * @property string $data_url
 * @property string $error
 * @property string $vartype
 * @property string $tip_front
 * @property string $tip_back
 * @property string $upfile_url
 * @property bool $data_val_off
 * @property int $label_width
 * @property int $box_width
 * @property int $tab
 * @property bool $merge
 * @property bool $display
 * @property bool $close
 * @property bool $close_html
 * @property bool $noscript
 * @property bool $dbfield
 * @property bool $offedit
 * @property bool $names_dbfield
 * @property array $data_vals
 * @property all $value
 * @property all $default
 * @property array $options
 * @property array $names
 * @property bool $row_hide
 * @property array $dynamic
 */
class ModelField {

    private $_model=null;
    //HTML标记--
    private $_html_attrs = array(
        'id' => '',
        'class' => '',
        'style' => '',
        'data_url' => '',
        'error' => '',
        'placeholder' => '',
    );
    //服务器属性--
    private $_server_attrs = array(
        'data_val' => NULL,
        'data_vals' => NULL,
        'data_val_msg' => NULL,
        'data_val_msgs' => NULL,
        'data_val_off' => false,
        'name' => '',
        'boxname' => '',
        'type' => 'text',
        'names' => array(),
        'label' => '',
        'label_width' => 180,
        'box_width' => 0,
        'tab' => 0,
        'options' => NULL,
        'tip_back' => '',
        'names_dbfield' => false,
        'merge' => false,
        'bymerge' => false,
        'nextkey' => NULL,
        'prevkey' => NULL,
        'show' => true,
        'default' => NULL,
        'noscript' => false,
        'dbfield' => true,
        'extensions' => '',
        'data_val_info' => '',
        'display' => true,
        'close' => false,
        'close_html' => false,
        'offedit' => false,
        'data_vals' => NULL,
        'vartype' => '',
        'valtype' => '',
        'row_hide' => false,
        'tip_front' => '',
        'required' => false,
        'merge_type' => false,
        'htmlattr' => '',
        'bymerge_type' => NULL,
        'upfile_url' => '',
        'usehtml' => false,
        'for_bymerge' => NULL,
        'follow_text' => '',
        'tag_shared' => false,
        'bymerge_type' => '',
        'dynamic' => null,
        'strict_size' => false,
        'extend_from' => NULL,
        'model_plug' => NULL,
        'plug_table' => 0,
    );
    public $value = NULL;
    

    public function __get($name) {
        if ($name == 'vartype') {
            $fromclass = to_camel($this->type) . 'Form';
            if (!class_exists($fromclass)) {
                return 'string';
            }
            return constant($fromclass . '::VAR_TYPE');
        }
        if (array_key_exists($name, $this->_html_attrs)) {
            return $this->_html_attrs[$name];
        }
        if (array_key_exists($name, $this->_server_attrs)) {
            return $this->_server_attrs[$name];
        }
        return NULL;
    }

    public function __set($name, $value) {
        if (array_key_exists($name, $this->_server_attrs)) {
            $this->_server_attrs[$name] = $value;
            if ($name == 'name') {
                if ($this->boxname == '') {
                    $this->boxname = $this->name;
                }
                if ($this->id == '') {
                    $this->id = $this->boxname;
                }
            }
        } else {
            $this->_html_attrs[$name] = $value;
            if ($name == 'name') {
                if ($this->boxname == '') {
                    $this->boxname = $this->name;
                }
                if ($this->id == '') {
                    $this->id = $this->boxname;
                }
            }
        }
    }

    public function __isset($name) {
        if (isset($this->_html_attrs[$name]) || isset($this->_server_attrs[$name])) {
            return true;
        }
        return false;
    }

    public function __unset($name) {
        unset($this->_html_attrs[$name]);
        unset($this->_server_attrs[$name]);
    }

    public function merger_attrs($attrs) {
        foreach ($attrs as $key => $value) {
            if ($key == 'value') {
                $this->value = $value;
                continue;
            }
            if ($key[0] == '@') {
                $key = substr($key, 1);
                if (!empty($key)) {
                    $this->_server_attrs[$key] = $value;
                }
            } else {
                if (array_key_exists($key, $this->_server_attrs)) {
                    $this->_server_attrs[$key] = $value;
                } else {
                    $this->_html_attrs[$key] = $value;
                }
            }
        }
    }

    //克隆拷贝
    public function copy($attrs, $model) {
        foreach ($this->_html_attrs as $key => $value) {
            if (!array_key_exists($key, $attrs)) {
                $attrs[$key] = $value;
            }
        }
        foreach ($this->_server_attrs as $key => $value) {
            if (!array_key_exists($key, $attrs)) {
                $attrs[$key] = $value;
            }
        }
        $field = new ModelField($attrs, $model);
        if ($this->value !== NULL && $field->value === NULL) {
            $field->value = $this->value;
        }
        return $field;
    }

    /**
     * 初始化模型字段==
     * @param Model $model
     */
    function __construct($attrs = array(), $model = null) {
        if (!empty($model)) {
            $array = $model->fieldDefault($attrs);
            if ($array !== null) {
                $attrs = array_replace($attrs, $array);
            }
        }
        $this->merger_attrs($attrs);
        if ($this->boxname == '') {
            $this->boxname = $this->name;
        }
        if ($this->id == '') {
            $this->id = $this->boxname;
        }

        if ($this->class == '') {
            $FORMBOX_DEFAULT_CSS = C('FORMBOX_DEFAULT_CSS');
            if (empty($FORMBOX_DEFAULT_CSS)) {
                $FORMBOX_DEFAULT_CSS = 'form-control';
            }
            if (empty($this->extend_from)) {
                if ($this->type == 'bool') {
                    $this->class = 'bool';
                } else {
                    $this->class = $FORMBOX_DEFAULT_CSS . ' ' . $this->type;
                }
            } else {
                if ($this->extend_from == 'bool') {
                    $this->class = 'bool';
                } else {
                    $this->class = $FORMBOX_DEFAULT_CSS . ' ' . $this->extend_from;
                }
            }
        }

        if (!empty($model)) {
            $model->fieldRevised($this);
            $this->_model=$model;
        }
    }
    
    public function getModel(){
        return $this->_model;
    }

    //获取HTML属性
    public function getHtmlAttrs() {
        $attrs = array();
        $attrs['name'] = empty($this->boxname) ? $this->name : $this->boxname;
        foreach ($this->_html_attrs as $key => $value) {
            if (!($value === '' || gettype($value) == 'array')) {
                $attrs[$key] = $value;
            }
        }
        $attrs['value'] = $this->value;
        $default = isset($this->default) ? $this->default : '';
        $attrs['value'] = $this->value === NULL ? $default : $this->value;
        if (is_array($attrs['value'])) {
            $attrs['value'] = json_encode($attrs['value']);
        }
        if (!empty($this->data_val)) {

            $attrs['data_val'] = preg_replace_callback('@__(RES|ROOT|PUBLIC|APPROOT|SELF|RUNROOT)__@', create_function('$match', 'return addcslashes(constant($match[0]),\'"/\\\\\');'), json_encode($this->data_val));
            if ($this->data_val_off) {
                $attrs['data_val_off'] = '1';
            }
        }
        if (!empty($this->data_val_msg)) {
            $attrs['data_val_msg'] = json_encode($this->data_val_msg);
        }
        if (!empty($this->data_valmsg_for)) {
            $attrs['data_valmsg_for'] = $this->data_valmsg_for;
        }
        if (!empty($this->data_val_events)) {
            $attrs['data_val_events'] = $this->data_val_events;
        }
        if (!empty($this->data_val_msg_default)) {
            $attrs['data_val_msg_default'] = $this->data_val_msg_default;
        }
        if (!empty($this->data_val_msg_valid)) {
            $attrs['data_val_msg_valid'] = $this->data_val_msg_valid;
        }
        if (!empty($this->data_return)) {
            $attrs['data_return'] = $this->data_return;
        }
        if (!empty($this->data_url)) {
            $attrs['data_url'] = preg_replace_callback('@__(RES|ROOT|PUBLIC|APPROOT|SELF|RUNROOT)__@', create_function('$match', 'return constant($match[0]);'), $this->data_url);
        }
        if (!empty($this->names)) {
            $this->attrsplit($attrs, $this->names, 'name');
        }
        if (!empty($this->headers)) {
            $this->attrsplit($attrs, $this->headers, 'header');
        }
        if (!empty($this->data_vals)) {
            $this->attrsplit($attrs, $this->data_vals, 'data_val');
        }
        if (!empty($this->data_val_msgs)) {
            $this->attrsplit($attrs, $this->data_val_msgs, 'data_val_msg');
        }
        return $attrs;
    }

    public function addHtmlAttr($key, $value) {
        if (isset($this->_server_attrs[$key])) {
            $this->_html_attrs[$key] = $value;
            unset($this->_server_attrs[$key]);
        }
    }

    //获取服务器属性
    public function getServerAttrs() {
        return $this->_server_attrs;
    }

    public function changeToServerAttr($key) {
        if (is_array($key)) {
            foreach ($key as $v) {
                $this->changeToServerAttr($v);
            }
        } else {
            if (isset($this->_html_attrs[$key])) {
                $this->_server_attrs[$key] = $this->_html_attrs[$key];
                unset($this->_html_attrs[$key]);
            }
        }
        return $this;
    }

    public function changeToHtmlAttr($key) {
        if (is_array($key)) {
            foreach ($key as $v) {
                $this->changeToHtmlAttr($v);
            }
        } else {
            if (isset($this->_server_attrs[$key])) {
                $this->_html_attrs[$key] = $this->_server_attrs[$key];
                unset($this->_server_attrs[$key]);
            }
        }
        return $this;
    }

    private function attrsplit(&$attrs, $attr, $key) {
        $vals = gettype($attr) == 'array' ? $attr : array();
        $i = 1;
        foreach ($vals as $val) {
            $value = isset($attrs[$key . $i]) ? $attrs[$key . $i] : $val;
            if (is_array($value)) {
                $value = json_encode($value);
            }
            $attrs[$key . $i] = $value;
            $i++;
        }
    }
	 /**
     * 获取插件的模型
     * @staticvar Model $models
     * @return Model
     */
    public function getPlugModel() {
        static $models = [];
        $name = $this->name . '_Model';
        if (empty($this->model_plug)) {
            return NULL;
        }
        if (isset($models[$name])) {
            return $models[$name];
        }
        if (is_string($this->model_plug)) {
            $models[$name] = Model($this->model_plug);
        } elseif ($this->model_plug instanceof Model) {
            $models[$name] = $this->model_plug;
        }
        return $models[$name];
    }

}
