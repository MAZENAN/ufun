<?php

/**
 *  HTML表单插件管理类
 * Time   : 2013年4月17日16:46:05
 * 该类配合 Smarty 实现创建表单控件 
 * 也可以用 PHP代码创建表单控件
 * 调用方法：
 * 是否控件
 * <code>
 * CForm::bool(
 *      array(
 *      'name'=>'test',
 *      'value'=>1,
 *      )
 * );
 * 文本控件
 * CForm::text(
 *      array(
 *      'name'=>'test',
 *      'value'=>1,
 *      'width'=>300,
 *      'class'=>'boxcss'
 *      )
 * )
 * </code>
 * @package UxFW 
 * @subpackage framework
 * @author wj354
 */
class FormBox {

    /**
     * 内部函数 用来从模型数据中提取属性值
     * @param ModelData $model
     * 模型数据
     * @param string $name
     * 控件名称
     * @return array 
     * 返回模型数据控件设置的属性
     */
    public static function __callStatic($type, $arguments) {
        $fromclass = ucfirst($type) . 'Form';
        $args = $arguments[0];
        $args['type'] = $type;
        $name = isset($args['name']) ? $args['name'] : '';
        if ($name == '') {
            throw new Exception("模型中不存在 [{$name}] 字段！");
        }
        $field = null;
        if (!empty($arguments[1])) {
            $model = $arguments[1];
            $field = isset($model->fields[$name]) ? $model->fields[$name] : null;
            if ($field === null) {
                throw new Exception("模型中不存在 [{$name}] 字段！");
            }
            $field->merger_attrs($args);
        } else {
            $field = new ModelField($args);
        }
        if (class_exists($fromclass)) {
            if (method_exists($fromclass, 'filter')) {
                call_user_func(array($fromclass, 'filter'), $field);
            }
            if (method_exists($fromclass, 'cssfiles')) {
                $cssfile = call_user_func(array($fromclass, 'cssfiles'), $field);
                foreach ($cssfile as $file) {
                    Model::addModelCssfile($file);
                }
            }
            if (method_exists($fromclass, 'scriptfiles')) {
                $scriptfiles = call_user_func(array($fromclass, 'scriptfiles'), $field);
                foreach ($scriptfiles as $file) {
                    Model::addModelScriptfile($file);
                }
            }
            if ((!isset($field->noscript) || !$field->noscript) && method_exists($fromclass, 'script')) {
                $scripts = call_user_func(array($fromclass, 'script'), $field);
                Model::addModelScript($scripts);
            }
            if (method_exists($fromclass, 'code')) {
                $code = call_user_func(array($fromclass, 'code'), $field);
                return $code;
            }
        }
        return '';
    }

    /**
     * 这个是一个默认插件，可以根据 $args['type'] 类型处理自动调用其他控件。
     * 一般使用这个控件的时候 是在未知控件类型或者后期动态修改
     * 至少需要有  $args['type'] 和  $args['name'] 2个属性
     * @param array $args 属性参数，一般是 boxname name 等参数 至少包含 
     * @param ModelData $model 模型数据 如果有控件数据时可以附加上本控件数据属性
     * @return string 返回控件代码
     */
    public static function Fdefault($args, &$model = NULL) {
        $type = isset($args['type']) ? $args['type'] : '';
        if (empty($type)) {
            if ($model == null) {
                throw new Exception("字段属性 type 是必选项！");
            }
            $key = $args['name'];
            $field = isset($model->fields[$key]) ? $model->fields[$key] : null;
            if ($field == null) {
                throw new Exception("模型中不存在 [{$key}] 字段，需要指定字段属性 type");
            }
            $type = $field->type;
        }
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $arguments = func_get_args();
            return self::__callStatic($type, $arguments);
        }
        return call_user_func('self::' . $type, $args, $model);
    }

    public static function labelex($args, &$model = NULL) {
        $key = $args['name'];
        if (!empty($model)) {
            $field = isset($model->fields[$key]) ? $model->fields[$key] : null;
            if ($field === null) {
                throw new Exception("模型中不存在 [{$key}] 字段！");
            }
            $field->merger_attrs($args);
        } else {
            $field = new ModelField($args);
        }
        $name = empty($field->boxname) ? $field->name : $field->boxname;
        return '<label class="form-label" id="' . $name . '_label">' . $field->label . '</label>';
    }

    public static function error($args, &$model = NULL) {
        $key = $args['name'];
        if (!empty($model)) {
            $field = isset($model->fields[$key]) ? $model->fields[$key] : null;
            if ($field === null) {
                throw new Exception("模型中不存在 [{$key}] 字段！");
            }
            $field->merger_attrs($args);
        } else {
            $field = new ModelField($args);
        }
        $name = empty($field->boxname) ? $field->name : $field->boxname;
        return '<span id="' . $name . '_info" class="field-info"></span>';
    }

}
