<?php

/**
 * 控制器类 基类
 * 伪继承于Smarty 如果控制器中没有用到Smarty函数时 不开启及不引用Smarty类
 * 拥有 所有Smarty 属性 及方法 魔法继承
 * @package UxFW 
 * @subpackage framework
 * @author wj354
 */
class Controller extends Smarty {

    /**
     * 设置模板路径
     * @param string $dir
     */
    public function setTemplateDir($dir) {
        
    }

    /**
     * 预加入字段
     * 在模板调display用时 自动 assign 的数据 
     * 如果没有启用模板不加入
     * 主要解决 因为调用 assign 而产生自动开启模板功能
     * @param string $key
     * @param object $value
     */
    public function addbook($key, $value) {

    }

    /**
     * action 执行 
     * 如果 acttion 存在 则执行 所注册的动作 
     * 如果 无函数可执行 则继续执行 doact 后面的代码！<br/>
     * 可在index函数体内注册
     * @param mixed $_ [optional] 注册格式 如： $this->doact('add','edit'....);
     */
    public function doact() {
        
    }

    /**
     * 模型呈现==
     * @param Model $model 模型结构
     * @param string $tpl  呈现模板 默认是系统模板
     */
    public function displayModel($model, $tpl = '@model_act.tpl') {
        
    }

}

