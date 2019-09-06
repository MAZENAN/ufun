<?php

/**
 * Validate 数据验证类
 * (SaMao &gt;= 1.0.0)<br/>
 * @package UxFW 
 * @subpackage framework
 * @author WJ008
 * @version 1.0.0
 */
class Validate {

    /**
     * 默认消息
     * @var array 
     */
    private static $Default_Msgs = array(
        'required' => '必选字段',
        'email' => '请输入正确格式的电子邮件',
        'url' => '请输入正确格式的网址',
        'date' => '请输入正确格式的日期',
        'number' => '仅可输入数字',
        'mobile' => '手机号码格式不正确',
        'idcard' => '身份证号码格式不正确',
        'digits' => '只能输入整数',
        'equalTo' => '请再次输入相同的值',
        'equal' => '请输入{0}字符',
        'notequal' => '数值不能是{0}字符',
        'maxlenght' => '请输入一个 长度最多是 {0} 的字符串',
        'minlength' => '请输入一个 长度最少是 {0} 的字符串',
        'rangelenght' => '请输入 一个长度介于 {0} 和 {1} 之间的字符串',
        'range' => '请输入一个介于 {0} 和 {1} 之间的值',
        'max' => '请输入一个最大为{0} 的值',
        'min' => '请输入一个最小为{0} 的值',
        'remote' => '检测数据不符合要求！',
        'regex' => '请输入正确格式字符',
        'glength' => '请输入正确格式字符',
        'validcode' => '验证码不正确！',
    );

    /**
     * 简称集合
     * @var array 
     */
    private static $Alias = array(
        'r' => 'required',
        'i' => 'digits',
        'num' => 'number',
        'minlen' => 'minlength',
        'maxlen' => 'maxlength',
        'eqto' => 'equalTo',
        'eq' => 'equal',
        'neq' => 'notequal',
    );

    /**
     * 远程函数集合
     * @var array 
     */
    private static $remote_func = array();

    /**
     * 注册远程验证函数
     * @param array $name 注册函数名
     * @param function $func 以数组形式注册user_function
     * call_user_func() 中的函数
     */
    public static function reg_remote($name, $func) {
        self::$remote_func[$name] = $func;
    }

    /**
     * 获取函数名
     * @param string $key
     * @return function
     */
    public static function getfuncname($key) {
        if (!isset(self::$Alias[$key])) {
            return $key;
        }
        $key = self::$Alias[$key];
        return self::getfuncname($key);
    }

    /**
     * 判断是否为空
     * @param string $val
     * @return boolean
     */
    public static function rule_required($val) {
        return $val !== '';
    }

    /**
     * 判断是否Email
     * @param string $val
     * @return boolean
     */
    public static function rule_email($val) {
        return preg_match('/^([a-zA-Z0-9]+[-|_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[-|_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}([\.][a-zA-Z]{2})?$/', $val) != 0;
    }

    /**
     * 判断是否手机号码
     * @param string $val
     * @return boolean
     */
    public static function rule_mobile($val) {
        return preg_match('/^1[34578]\d{9}$/', $val) != 0;
    }

    /**
     * 判断是否手机号码
     * @param string $val
     * @return boolean
     */
    public static function rule_idcard($val) {
        return preg_match('/^[1-9]\d{5}(19|20)\d{2}(((0[13578]|1[02])([0-2]\d|30|31))|((0[469]|11)([0-2]\d|30))|(02[0-2][0-9]))\d{3}(\d|X|x)$/', $val) != 0;
    }

    /**
     * 判断数字
     * @param string $val
     * @return boolean
     */
    public static function rule_number($val) {
        return preg_match('/^[\-\+]?((\d+(\.\d*)?)|(\.\d+))$/', $val) != 0;
    }

    /**
     * 判断证书
     * @param string $val
     * @return boolean
     */
    public static function rule_digits($val) {
        return preg_match('/^[\-\+]?\d+$/', $val) != 0;
    }

    /**
     * 值的最大值不能超过$num
     * @param string $val
     * @param float $num
     * @param boolean $eqmax 是否允许等于最大值
     * @return boolean
     */
    public static function rule_max($val, $num, $eqmax = true) {
        if ($eqmax == true) {
            return floatval($val) <= floatval($num);
        } else {
            return floatval($val) < floatval($num);
        }
    }

    /**
     * 值的最小值不能超过$num
     * @param string $val
     * @param float $num
     * @param boolean $eqmax 是否允许等于最小值
     * @return boolean
     */
    public static function rule_min($val, $num, $eqmax = true) {
        if ($eqmax == true) {
            return floatval($val) >= floatval($num);
        } else {
            return floatval($val) > floatval($num);
        }
    }

    /**
     * 区间取值范围
     * @param string $val
     * @param float $num1 最小值
     * @param float $num1 最大值
     * @param boolean $eqmax 是否允许等于最小值与最大值
     * @return boolean
     */
    public static function rule_range($val, $min, $max, $eqmax = true) {
        return self::rule_min($val, $min, $eqmax) && self::rule_max($val, $max, $eqmax);
    }

    /**
     * 长度最小不能低于$len
     * @param string $val
     * @param int $len
     * @return boolean
     */
    public static function rule_minlength($val, $len) {
        return mb_strlen($val, 'UTF-8') >= intval($len);
    }

    /**
     * 长度最大不能超过$len
     * @param string $val
     * @param int $len
     * @return boolean
     */
    public static function rule_maxlength($val, $len) {
        return mb_strlen($val, 'UTF-8') <= intval($len);
    }

    /**
     * 长度在 $minlen 和 $maxlen 之间
     * @param string $val
     * @param int $minlen 最小长度
     * @param int $maxlen 最大长度
     * @return boolean
     */
    public static function rule_rangelength($val, $minlen, $maxlen) {
        return self::rule_minlength($val, $minlen) && self::rule_maxlength($val, $maxlen);
    }

    /**
     * 金额形式，即包含整数与保留2位小数的数字
     * @param string $val
     * @return boolean
     */
    public static function rule_money($val) {
        return preg_match('/^[-]{0,1}\d+[\.]\d{1,2}$/', $val) != 0 || self::rule_digits($val);
    }

    /**
     * 日期格式 Y-M-D格式包括时间格式 Y-M-D H:i:s
     * @param string $val
     * @return boolean
     */
    public static function rule_date($val) {
        return preg_match('/^\d{4}-\d{1,2}-\d{1,2}(\s\d{1,2}(:\d{1,2}(:\d{1,2})?)?)?$/', $val) != 0;
    }

    /**
     * 网站链接格式 完整链接
     * @param string $val
     * @return boolean
     */
    public static function rule_url($val, $jh = false) {
        if ($jh && $val == '#') {
            return true;
        }
        return preg_match('/^(http|https|ftp):\/\/\w+\.\w+/i', $val) != 0;
    }

    /**
     * 值相等于
     * @param string $val
     * @param string $str 被比较值
     * @return boolean
     */
    public static function rule_equal($val, $str) {
        return $val == $str;
    }

    /**
     * 值不相等于
     * @param string $val
     * @param string $str 被比较值
     * @return boolean
     */
    public static function rule_notequal($val, $str) {
        return $val != $str;
    }

    /**
     * 判断值是否与提交值ID一致，需要提交的被比较值的控件ID和name一致，这里取name提交值作为比较
     * @param string $val 
     * @param string $str 被比较的#id 这里用 name 取值比较 如无法取值默认通过
     * @return boolean
     */
    public static function rule_equalTo($val, $str) {
        $fnam = array();
        if ($str != '' && preg_match('/^#(\w+)/i', $str, $fnam) != 0) {
            $name = isset($fnam[1]) ? $fnam[1] : '';
            if ($name != '') {
                $str = isset($_REQUEST[$name]) ? $_REQUEST[$name] : '';
                if ($str != '') {
                    return $val == $str;
                }
            }
        }
        return true;
    }

    /**
     * 判断是否用户名类型 用户名要求 是首字母开头的数字和字母下划线组合
     * @param type $val
     * @return boolean
     */
    public static function rule_user($val) {
        if (preg_match('/^[a-z]\w*$/i', $val) == 0) {
            return false;
        }
        return true;
    }

    /**
     * 正则形式验证，碰到 # 请转义 \#
     * @param string $val 验证值
     * @param string $re 正则表达式
     * @return boolean
     */
    public static function rule_regex($val, $re) {
        $str = '#' . str_replace('#', '\#', $re) . '#';
        $rt = preg_match($str, $val);
        if ($rt === FALSE) {
            throw new Exception('验证器正则表达式错误!' . '最终执行的正则表达式：' . $str . '
请查看您的模型配置是否正确，请使用兼容PHP于JS 的正则表达式。
');
        }
        return $rt != 0;
    }

    /**
     * 远程形式验证 默认通过验证
     * @param string $val 值
     * @param string $name 
     * @param string $url
     * @param string $type
     * @return boolean
     */
    public static function rule_remote($name, $val, $url = '', $type = 'GET', $names = '') {
        if (isset(self::$remote_func[$name])) {
            return call_user_func(self::$remote_func[$name], $val, $type, $names);
        }
        return true;
    }

    /**
     * 验证验证码信息 默认通过验证
     * @param string $val 值
     * @return boolean
     */
    public static function rule_validcode($val) {
        @session_start();
        $code = isset($_SESSION['validationcode']) ? $_SESSION['validationcode'] : '';
        $_SESSION['validationcode'] = '';
        return $val != '' && strtolower($val) == strtolower($code);
    }

    /**
     * 格式化文本，按参数格式
     * @param type $format
     * @param type $args
     * @return string
     */
    private static function formatString($format, $args) {
        if ($format == '') {
            return '';
        }
        if ($args == NULL) {
            return $format;
        }
        if (gettype($args) != 'array') {
            return self::formatString($format, array($args));
        }
        $format = preg_replace_callback('@{(\d+)}@', function($mt) use($args) {
            return count($args) > intval($mt[1]) ? $args[intval($mt[1])] : '';
        }, $format);
        return $format;
    }

    /**
     * 检查字段
     * @param string $fkey
     * @param ModelField $field
     * @param string $errmsg
     * @return boolean
     */
    public static function checkItem($fkey, $field, &$errmsg) {
        //处理不是数组的数据========
        if (!empty($errmsg)) {
            return false;
        }
        if (isset($field->value) && gettype($field->value) != 'array') {
            $rules = empty($field->data_val) ? NULL : $field->data_val;
            if ($rules == NULL) {
                return true;
            }
            if (isset($field->data_val_off) && $field->data_val_off == true) {
                return true;
            }
            //替换别名为主名称====
            $temprules = array();
            foreach ($rules as $key => $val) {
                $mkey = self::getfuncname($key);
                $temprules[$mkey] = $val;
            }

            $msgs = empty($field->data_val_msg) ? array() : $field->data_val_msg;
            //替换消息别名=======
            $tempmsgs = array();
            foreach ($msgs as $key => $val) {
                $mkey = self::getfuncname($key);
                $tempmsgs[$mkey] = $val;
            }

            $rules = $temprules;
            $msgs = $tempmsgs;
            $val = $field->value;


            //如果存在验证为空的情况===
            if (isset($rules['required']) && $rules['required']) {
                if (!self::rule_required($val)) {
                    $errmsg = empty($msgs['required']) ? self::$Default_Msgs['required'] : $msgs['required'];
                    return false;
                }
                unset($rules['required']);
            }
            //强制验证或者值不为空验证
            if ($val !== '' || (isset($rules['force']) && $rules['force'])) {
                unset($rules['force']);
                foreach ($rules as $key => $arg) {
                    $args = array();
                    if (gettype($arg) == 'array') {
                        $args = $arg;
                    } else {
                        $args = array($arg);
                    }
                    array_unshift($args, $val);
                    if ($key == 'remote') {
                        array_unshift($args, $fkey);
                    }
                    $funcname = 'Validate::rule_' . $key;
                    if (is_callable($funcname)) {
                        if (!call_user_func_array($funcname, $args)) {
                            array_shift($args);
                            $errmsg = empty($msgs[$key]) ? self::formatString(self::$Default_Msgs[$key], $args) : self::formatString($msgs[$key], $args);
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }

}
