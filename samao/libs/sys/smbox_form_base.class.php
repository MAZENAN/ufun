<?php

abstract class SmboxFormBase extends Smarty_Internal_CompileBase {

    public $required_attributes = array('name');
    public $shorttag_order = array('name');
    public $optional_attributes = array('_any');
    public $fromtype = 'default';

    public function __construct() {
        $classname = get_class($this);
        $arrs = explode('_', $classname);
        $this->fromtype = isset($arrs[4]) ? $arrs[4] : 'default';
    }

    public function compile($args, $compiler) {
        $_attr = $this->getAttributes($compiler, $args);
        $model = '';
        $html = 'array(';
        foreach ($_attr as $key => $value) {
            if (!empty($value)) {
                if ($key === 'model') {
                    $model = ',' . $value;
                } else {
                    $html.="'$key'=>$value,";
                }
            }
        }
        $html.=')';
        $func = $this->fromtype;
        if ($func == 'default') {
            $func = 'Fdefault';
        }
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            if (!method_exists('FormBox', $func)) {
                return '<?php echo FormBox::__callStatic(' . var_export($func, TRUE) . ',array(' . $html . $model . '));?>';
            } else {
                return '<?php echo FormBox::' . $func . '(' . $html . $model . ');?>';
            }
        }
        return '<?php echo FormBox::' . $func . '(' . $html . $model . ');?>';
    }

}
