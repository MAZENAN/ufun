<?php

class Smarty_Internal_Compile_Rbac extends Smarty_Internal_CompileBase {

    public $required_attributes = array('c');
    public $optional_attributes = array('type');
    public $shorttag_order = array('c', 'type');

    public function compile($args, $compiler, $parameter) {
        $_attr = $this->getAttributes($compiler, $args);
        $check = $_attr['c'];
        $type = empty($_attr['type']) ? '' : $_attr['type'];
        $this->openTag($compiler, 'rbac', array('rbac', $compiler->nocache, $check, $type));
        $compiler->nocache = $compiler->nocache | $compiler->tag_nocache;
        if (empty($type)) {
            return "<?php if (RBAC::check({$check})) {?>";
        }
        return "<?php if (RBAC::check({$check},$type)) {?>";
    }

}

class Smarty_Internal_Compile_Rbacelse extends Smarty_Internal_CompileBase {

    public function compile($args, $compiler, $parameter) {
        list($openTag, $nocache, $check, $type) = $this->closeTag($compiler, array('rbac'));
        $this->openTag($compiler, 'rbacelse', array('rbacelse', $nocache, $check, $type));
        return "<?php } else { ?>";
    }

}

class Smarty_Internal_Compile_Rbacclose extends Smarty_Internal_CompileBase {

    public function compile($args, $compiler, $parameter) {
        $_attr = $this->getAttributes($compiler, $args);
        if ($compiler->nocache) {
            $compiler->tag_nocache = true;
        }
        list($openTag, $compiler->nocache, $check, $type) = $this->closeTag($compiler, array('rbac', 'rbacelse'));
        return "<?php } ?>";
    }

}
