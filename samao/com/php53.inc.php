<?php

defined('SAMAO_VERSION') or exit;

/**
 * 驼峰转为路径寻找
 * @param string $name
 * @return string
 */
function to_under($name) {
    if (empty($name)) {
        return $name;
    }
    return preg_replace('@^_@', '', preg_replace_callback('@[A-Z]@', function($val) {
                return '_' . strtolower($val[0]);
            }, $name));
}

/**
 * 路径转为驼峰命名
 * @param string $name
 * @return string
 */
function to_camel($name) {
    if (empty($name)) {
        return $name;
    }
    return ucfirst(preg_replace_callback('@_[A-Za-z]@', function($val) {
                return strtoupper(substr($val[0], 1, 1));
            }, $name));
}

/**
 * 纠正目录 
 * @param string $path
 * @return string
 */
function correct_dir($path) {
    $path = str_replace(array('/', '\\'), DS, $path);
    if (substr($path, -1) != DS) {
        $path = $path . DS;
    }
    return $path;
}

/**
 * 纠正文件路径
 * @param string $path
 * @return string
 */
function correct_file($file) {
    $file = str_replace(array('/', '\\'), DS, $file);
    return str_replace(DS . DS, DS, $file);
}

/**
 * 包含目录
 * @staticvar array $_INCLIBS
 * @param string $dir 需要包含的目录或者文件
 * @return array 返回所有目录
 */
function lib($path = '') {
    static $_INCLIBS = array('DIRS' => array(), 'FILES' => array());
    if (empty($path)) {
        return $_INCLIBS;
    }
    //如果目录不为空
    $path = str_replace(array('/', '\\'), DS, $path);
    if (substr($path, -1) == DS) {
        $path = substr($path, 0, -1);
    }
    //如果是文件夹 加入查找队列中
    if (is_dir($path)) {
        $dir = $path . DS;
        $key = md5(strtolower($dir));
        $_INCLIBS['DIRS'][$key] = $dir;
        return;
    }
    //如果是文件直接包含
    if (preg_match('@^(.*\\' . DS . ')([^.\\' . DS . ']+)(\.class\.php)$@', $path, $temp)) {
        $class = to_under($temp[2]);
        if (!isset($_INCLIBS['FILES'][$class])) {
            //如果不行 转为小写
            $path = $temp[1] . strtolower($temp[2]) . $temp[3];
            if (is_file($path)) {
                $_INCLIBS['FILES'][$class] = $path;
                return;
            }
            //还不行 转为下划线格式
            $path = $temp[1] . $class . $temp[3];
            if (is_file($path)) {
                $_INCLIBS['FILES'][$class] = $path;
                return;
            }

            $path = $temp[1] . $temp[2] . $temp[3];
            if (is_file($path)) {
                $_INCLIBS['FILES'][$class] = $path;
                return;
            }
        }
    }
}

//加载类库
function import($path) {
    if (empty($path)) {
        return;
    }
    $paths = explode('.', $path);
    $last = count($paths) - 1;
    if ($paths[0] == '@') {
        $paths[0] = APP_NAME;
    }
    if ($paths[$last] == '*') {
        $paths[$last] = '';
    } else {
        $paths[$last] = $paths[$last] . '.class.php';
    }
    $path = ROOT_DIR . join(DS, $paths);
    lib($path);
}

/**
 * 创建模型
 * @param string $key
 * @param int $type
 * @return Model
 */
function Model($key, $type = 0, $init = true) {
    $class = $key . 'Model';
    return new $class($type, $init);
}

//Route辅助函数========================
function _simple_preg($rule) {
    $rule = addcslashes($rule, '@[]{}()+\\^$.?*|/');
    $ret = preg_replace_callback('@\\\{([a-zA-Z0-9_-]*):([^}]+)\\\}@', function ($match) {
        $keys = array();
        foreach (Route::$pregkeys as $key => $value) {
            $keys['\\' . $key] = $value;
        }
        if (empty($match[1])) {
            if ($match[2] == '\\@end') {
                return '$';
            }
            return '(' . $keys[$match[2]] . ')';
        }
        if (isset($keys[$match[2]])) {
            return '(?P<' . $match[1] . '>' . $keys[$match[2]] . ')';
        } else {
            return '(?P<' . $match[1] . '>' . $match[2] . ')';
        }
    }, $rule);
    return '@^' . $ret . '@';
}

function _route_url_replace($url, &$args) {
    return preg_replace_callback('@\{([a-zA-Z0-9_-]*):([^}]+)\}@', function($match) use (&$args) {
        if (empty($match[1]) || !isset($args[$match[1]])) {
            return $match[1];
        }
        return $args[$match[1]];
    }, $url);
}

//=====================================

/**
 * 获取配置项的值
 * @param string $key
 * @return string|array
 */
function C($key = '') {
    if ($key == '') {
        return Config::getValues();
    }
    if (preg_match('@^([a-z0-9_]+)\.(\*|[a-z0-9_]+)$@i', $key, $keys)) {
        $name = $keys[1];
        Config::load($name);
        $key = $keys[2];
        if ($key == '*') {
            return Config::getValues($name);
        }
    }
    return Config::get($key);
}

function IGet($name, $def = 0) {
    return isset($_GET[$name]) ? intval($_GET[$name]) : $def;
}

function FGet($name, $def = 0) {
    return isset($_GET[$name]) ? floatval($_GET[$name]) : $def;
}

function BGet($name, $def = false) {
    return isset($_GET[$name]) ? (true == !!$_GET[$name] ? true : false) : $def;
}

function SGet($name, $def = '') {
    return isset($_GET[$name]) ? $_GET[$name] : $def;
}

function IPost($name, $def = 0) {
    return isset($_POST[$name]) ? intval($_POST[$name]) : $def;
}

function FPost($name, $def = 0) {
    return isset($_POST[$name]) ? floatval($_POST[$name]) : $def;
}

function BPost($name, $def = false) {
    return isset($_POST[$name]) ? (true == !!$_POST[$name] ? true : false) : $def;
}

function SPost($name, $def = '') {
    return isset($_POST[$name]) ? $_POST[$name] : $def;
}

function IReq($name, $def = 0) {
    return isset($_REQUEST[$name]) ? intval($_REQUEST[$name]) : $def;
}

function FReq($name, $def = 0) {
    return isset($_REQUEST[$name]) ? floatval($_REQUEST[$name]) : $def;
}

function BReq($name, $def = false) {
    return isset($_REQUEST[$name]) ? (true == !!$_REQUEST[$name] ? true : false) : $def;
}

function SReq($name, $def = '') {
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
}



/**
 * 自动加载类
 * @param string $class
 * @return type
 */
function __autoloader($class) {
    //对use 的支持
    $paths = explode('\\', $class);
    if (isset($paths[1])) {
        $_paths = array();
        for ($i = 0, $len = count($paths) - 1; $i < $len; $i++) {
            $_paths[] = strtolower($paths[$i]);
        }
        $_paths[] = to_under(end($paths)) . '.class.php';
        require (correct_dir(ROOT_DIR) . join(DS, $_paths));
        return;
    }
    $_class = to_under($class);
    //加载其他控件
    $_INCLIBS = lib();
    //单个
    if (isset($_INCLIBS['FILES'][$_class])) {
        require ($_INCLIBS['FILES'][$_class]);
        return;
    }
    //识别控制器路径
    if (substr($_class, -11) == '_controller') {
        $path = correct_dir(APP_DIR) . 'controls' . DS . substr($_class, 0, -11) . '.ctl.php';
        if (is_file($path)) {
            require($path);
            return;
        }
    }
    //识别模型路径
    if (substr($_class, -6) == '_model') {
        $path = correct_dir(APP_DIR) . 'models' . DS . substr($_class, 0, -6) . '.model.php';
        if (is_file($path)) {
            require($path);
            return;
        }
    }
    //识别表单控件路径
    if (substr($_class, -5) == '_form') {
        $path = correct_dir(SAMAO_DIR) . 'plugins' . DS . 'ext' . DS . substr($_class, 0, -5) . '.form.php';
        if (is_file($path)) {
            require($path);
            return;
        }
        $path = correct_dir(SAMAO_DIR) . 'plugins' . DS . 'sys' . DS . substr($_class, 0, -5) . '.form.php';
        if (is_file($path)) {
            require($path);
            return;
        }
    }
    //文件夹
    foreach ($_INCLIBS['DIRS'] as $_DIR) {
        $path = $_DIR . strtolower($class) . '.class.php';
        if (is_file($path)) {
            require($path);
            return;
        }
        $path = $_DIR . $_class . '.class.php';
        if (is_file($path)) {
            require($path);
            return;
        }
    }
}

#为了兼容某些PHP环境过滤了POST 和 GET
if (ini_get('magic_quotes_gpc')) {

    function stripslashesRecursive(array $array) {
        foreach ($array as $k => $v) {
            if (is_string($v)) {
                $array[$k] = stripslashes($v);
            } else if (is_array($v)) {
                $array[$k] = stripslashesRecursive($v);
            }
        }
        return $array;
    }

    $_GET = stripslashesRecursive($_GET);
    $_POST = stripslashesRecursive($_POST);
}

spl_autoload_register('__autoloader');

if (DEV_DEBUG) {

//处理异常情况===========
    function __samao_exception_handler(Exception $exc) {
        new SamaoError($exc->getMessage(), $exc->getCode(), $exc->getFile(), $exc->getLine(), $exc->getTrace());
    }

//处理错误信息===========
    function __samao_error_handler($errorCode, $errorMessage, $errorFile, $errorLine) {
        if (!(error_reporting() & $errorCode)) {
            return;
        }
        new SamaoError($errorMessage, $errorCode, $errorFile, $errorLine);
    }

//处理PHP程序错误函数
    function __check_for_fatal() {
        $error = error_get_last();
        if ($error["type"] == E_ERROR) {
            __samao_error_handler($error["type"], $error["message"], $error["file"], $error["line"]);
        }
    }

//注册默认异常处理函数
    set_exception_handler('__samao_exception_handler');
//注册默认错误处理函数
    set_error_handler('__samao_error_handler', E_ALL | E_STRICT);
//处理PHP程序错误函数
    register_shutdown_function("__check_for_fatal");
}

ini_set("display_errors", "off");

if (DEV_REPORT) {

    function __samao_report() {
        SamaoReport::EndReport();
    }

    register_shutdown_function("__samao_report");
}

function trace($msg) {
    if (DEV_REPORT) {
        SamaoReport::Log($msg);
    }
}
