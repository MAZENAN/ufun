<?php

defined('ROUTE_STRICT') or define('ROUTE_STRICT', false);

class Route {

    private static $Data;
    public static $isInit = false;
    public static $route = null;
    public static $urls = null;
    public static $pregkeys = array(
        '@key' => '\w*',
        '@num' => '\d+',
        '@any' => '.+',
        '@_num' => '\d*',
        '@_any' => '.*',
    );

    public static function init(&$route = null) {
        if (self::$isInit) {
            return;
        }
        self::setPathinfo();
        if ($route == null) {
            $route = C('ROUTE_DATAS');
        }
        if (empty($route['rule'])) {
            throw new Exception("缺少路由规则项！\$route['rule'] 路由规则缺少，\n如果您需要使用默认规则 请在执行 SamaoPHP::Run 中不需要带入任何参数。
                                系统会自动选择默认的路由规则,如果您希望自定义规则请参考路由规则帮助。");
        }
        if (!isset($route['default'])) {
            $route['default'] = array('ctl' => 'index', 'act' => 'index');
        }
        if (gettype($route['default']) != 'array') {
            throw new Exception("定义规则 default 必须是数组形式！\$route['default']", "默认路由必须是以一个一唯的键值数组，格式如 \n
            array(\'ctl\' => \'index\', \'act\' => \'index\');
            一般至少需要包含 controller 和 action 两项,
            也可以包含其他键值作为\$_GET 的默认值");
        }
        self::$route = $route;
        if (!isset($_SERVER['SAMAO_REQUEST_URI'])) {
            if (URL_REWRITE == FALSE) {
                if (URL_PATH_INFO) {
                    throw new Exception('系统重写已经关闭，URL_PATH_INFO被开启，应使用 /index.php/ 形式采访，如果环境不支持支持 PATH_INFO 请定义 URL_PATH_INFO 常量为 false！');
                } else {
                    throw new Exception('系统重写已经关闭，URL_PATH_INFO被已关闭,应使用 /index.php?/ 形式采访！');
                }
            } else {
                throw new Exception('重写开启，未检测到合适的系统变量，系统环境无法满足本框架运行。您可以尝试 关闭或开启 URL_PATH_INFO。');
            }
        }
        $url = $_SERVER['SAMAO_REQUEST_URI'];
        if (!empty($_SERVER['QUERY_STRING']) && !preg_match('@^[^=&?]+\?@', $url) && !preg_match('@^\/@', $_SERVER['QUERY_STRING'])) {
            $url = $url . '?' . $_SERVER['QUERY_STRING'];
        }
        if (gettype($route['rule']) != 'array') {
            $route['rule'] = array($route['rule']);
        }
        $nroute = array();
        foreach ($route['rule'] as $key => $rule) {
            if (is_array($rule) && count($rule) == 2) {
                $nroute[$key] = $rule[0];
            } else {
                $nroute[$key] = _simple_preg($rule);
            }
        }
        self::$urls = $route['rule'];
        $data = $route['default'];
        $allerr = 0;
        foreach ($nroute as $rkey => $rule) {
            $args = array();
            $rt = preg_match($rule, $url, $args);
            if ($rt === FALSE) {
                throw new Exception("执行路由的正则表达式配置不正确，请查证修改\n错误表达式：{$route['rule'][$rkey]} 最终执行的错误正则表达式 {$rule}");
            }
            //找到了
            if ($rt != 0) {
                $allerr++;
                $temp = array();
                foreach ($args as $key => $val) {
                    if (!is_numeric($key)) {
                        if ($key == 'param') {
                            if (!empty($val)) {
                                $vals = explode('/', $val);
                                for ($len = count($vals), $i = 0; $i < $len; $i+=2) {
                                    $mkey = isset($vals[$i]) ? $vals[$i] : '';
                                    $mval = isset($vals[$i + 1]) ? $vals[$i + 1] : '';
                                    $temp[$mkey] = $mval;
                                }
                            }
                        } else {
                            $temp[$key] = $val;
                        }
                    }
                }
                $face = (isset($route['rule'][$rkey]) && is_array($route['rule'][$rkey]) && count($route['rule'][$rkey] == 2)) ? $route['rule'][$rkey][1] : [];
                $data = array_merge($data, $temp, $face);
                break;
            }
        }

        $tempAJAX = false;
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            $tempAJAX = 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
        }
        if (ROUTE_STRICT) {
            if ($allerr == 0 && !($url == '' || $url == '/')) {
                try {
                    define('IS_AJAX', $tempAJAX);
                    $errc = new Controller();
                    $errc->error('404错误 您访问的页面不存在，5秒后跳至首页', '/', 5, 404);
                } catch (Exception $exc) {
                    throw new Exception('模板信息有误' . $exc->getMessage());
                }
            }
        }

        $data['app'] = strtolower(APP_NAME);
        if (!empty($_GET['_app'])) {
            $data['app'] = trim($_GET['_app']);
        }
        if (!empty($_REQUEST['action'])) {
            $data['act'] = trim($_REQUEST['action']);
        } elseif (!empty($_GET['_act'])) {
            $data['act'] = trim($_GET['_act']);
        }
        if (empty($data['act'])) {
            $data['act'] = 'index';
        }
        if (!empty($_GET['_ctl'])) {
            $data['ctl'] = trim($_GET['_ctl']);
        }
        if (empty($data['ctl'])) {
            $data['ctl'] = 'index';
        }

        $ctemp = strtoupper(C('ROUTE_PARAM_FILLTYPE'));
        $ctemps = explode('|', $ctemp);
        $isget = in_array('GET', $ctemps);
        $isrequest = in_array('REQUEST', $ctemps);
        $overlay = C('ROUTE_PARAM_OVERLAY');
        //判断是否AJAX
        $action = $data['act'];
        if (strlen($action) > 5 && (strtoupper(substr($action, -5)) == '_AJAX')) {
            $tempAJAX = TRUE;
            $data['act'] = substr($action, 0, strlen($action) - 5);
        }
        define('IS_AJAX', $tempAJAX);
        foreach ($data as $key => $val) {
            if ($key == 'ctl' || $key == 'act' || $key == 'app' || $key == 'param') {
                continue;
            }
            if ($isget) {
                if (!isset($_GET[$key]) || $overlay) {
                    $_GET[$key] = $val;
                }
            }
            if ($isrequest) {
                if (!isset($_REQUEST[$key]) || $overlay) {
                    $_REQUEST[$key] = $val;
                }
            }
        }
        self::$Data = $data;
        self::$isInit = true;
    }

    public static function addpregkey($key, $val) {
        self::$pregkeys[$key] = $val;
    }

    public static function getRunRoot($path = '') {
        return $_SERVER['SAMAO_APP_ROOT'] . $path;
    }

    public static function get($key = '') {
        if (empty($key)) {
            return self::$Data;
        } else {
            return isset(self::$Data[$key]) ? self::$Data[$key] : '';
        }
    }

    public static function getUrl($name, $args = array(), $path = NULL) {
        if (!self::$isInit) {
            return '';
        }
        if (!isset(self::$urls[$name])) {
            throw new Exception("不存在的URLS规则\n不存在指定的规则 {$name} ,请配置 \$route['urls']['{$name}']");
        }
        if (!isset($args['ctl'])) {
            $args['ctl'] = Route::get('ctl');
        }
        if (!isset($args['act'])) {
            $args['act'] = Route::get('act');
        }
        $url = self::$urls[$name];
        //使用兼容方案函数
        $ret = _route_url_replace($url, $args);
        if ($path === NULL) {
            $path = self::getRunRoot(APP_URL);
        }
        return $path . $ret;
    }

    public static function getUrlRule($name) {
        if (!isset(self::$urls[$name])) {
            throw new Exception("不存在的URLS规则\n不存在指定的规则 {$name} ,请配置 \$route['urls']['{$name}']");
        }
        return self::$urls[$name];
    }

    public static function getRule() {
        
    }

    private static function is_utf8($string) {
        return preg_match('%^(?:
          [\x09\x0A\x0D\x20-\x7E]            # ASCII
        | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
        |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
        | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
        |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
        |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
        | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
        |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
    )*$%xs', $string);
    }

    //处理路径===
    private static function setPathinfo() {
        if (isset($_SERVER['PATH_INFO'])) {
            $_SERVER['SAMAO_OLD_PATH_INFO'] = $_SERVER['PATH_INFO'];
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            $_SERVER['SAMAO_OLD_REQUEST_URI'] = $_SERVER['REQUEST_URI'];
        }
        if (isset($_SERVER['QUERY_STRING'])) {
            $_SERVER['SAMAO_OLD_QUERY_STRING'] = $_SERVER['QUERY_STRING'];
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            //兼容某些古老设备 PATH_INFO 不是 UTF-8
            if (!self::is_utf8($_SERVER['REQUEST_URI'])) {
                $_SERVER['REQUEST_URI'] = mb_convert_encoding($_SERVER['REQUEST_URI'], 'UTF-8');
            }
            //处理不支持URL重写情况
            $_SERVER['REQUEST_URI'] = urldecode($_SERVER['REQUEST_URI']);
        } else {
            if (IS_CLI) {
                if (stripos($_SERVER['SCRIPT_NAME'], ROOT_DIR) === 0) {
                    $_SERVER['REQUEST_URI'] = '/' . str_replace('\\', '/', substr($_SERVER['SCRIPT_NAME'], strlen(ROOT_DIR)));
                }
                if (isset($_SERVER['argv']) && isset($_SERVER['argv'][1])) {
                    $_SERVER['REQUEST_URI'].='?' . $_SERVER['argv'][1];
                }
            }
        }
        if (URL_REWRITE == FALSE) {
            self::setPathA();
            return;
        }
        self::setPathB();
        return;
    }

    private static function lefttrim($str, $ext) {
        if ($ext == '') {
            return $str;
        }
        if (strpos($str, $ext) == 0) {
            $str = substr($str, strlen($ext));
        }
        return $str;
    }

    //处理根目录下 没有开启重写  IIS==
    private static function setPathA() {
        if (URL_PATH_INFO == FALSE) {
            $ridx = strpos($_SERVER['REQUEST_URI'], '?/');
            if ($ridx !== FALSE) {
                $samao_root = substr($_SERVER['REQUEST_URI'], 0, $ridx + 1);
                $_SERVER['SAMAO_REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], $ridx + 1);
                $qidx = strpos($_SERVER['SAMAO_REQUEST_URI'], '?');
                if ($qidx === FALSE) {
                    $_SERVER['PATH_INFO'] = $_SERVER['SAMAO_REQUEST_URI'];
                    $_SERVER['QUERY_STRING'] = '';
                    $_GET = array();
                } else {
                    $_SERVER['QUERY_STRING'] = substr($_SERVER['SAMAO_REQUEST_URI'], $qidx + 1);
                    $_GET = array();
                    parse_str($_SERVER['QUERY_STRING'], $_GET);
                    $_SERVER['PATH_INFO'] = substr($_SERVER['SAMAO_REQUEST_URI'], 0, $qidx);
                }
                $_SERVER['SAMAO_APP_ROOT'] = $samao_root;
                $_SERVER['SAMAO_REQUEST_URI'] = self::lefttrim($_SERVER['SAMAO_REQUEST_URI'], APP_URL);
                return;
            }
        }
        //处理带有.php的目录结构==
        $ridx2 = strpos($_SERVER['REQUEST_URI'], '.php/');
        if ($ridx2 !== FALSE) {
            $samao_root = substr($_SERVER['REQUEST_URI'], 0, $ridx2 + 4);
            $_SERVER['SAMAO_REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], $ridx2 + 4);
            $_SERVER['SAMAO_APP_ROOT'] = rtrim($samao_root, '/');
            $_SERVER['SAMAO_REQUEST_URI'] = self::lefttrim($_SERVER['SAMAO_REQUEST_URI'], APP_URL);
            return;
        }
        //处理带有根目录结构==
        $root = rtrim(__ROOT__, '/');
        if ($_SERVER['REQUEST_URI'] == $root . '/') {
            if (URL_PATH_INFO == FALSE) {
                $samao_root = $root . '/?';
                $_SERVER['SAMAO_REQUEST_URI'] = '/';
                $_SERVER['SAMAO_APP_ROOT'] = rtrim($samao_root, '/');
            } else {
                $samao_root = $root . '/index.php/';
                $_SERVER['SAMAO_REQUEST_URI'] = '/';
                $_SERVER['SAMAO_APP_ROOT'] = rtrim($samao_root, '/');
            }
            $_SERVER['SAMAO_REQUEST_URI'] = self::lefttrim($_SERVER['SAMAO_REQUEST_URI'], APP_URL);
            return;
        }
        //处理 带有入口页面的
        $root = rtrim(__ROOT__, '/') . '/' . basename($_SERVER['SCRIPT_NAME']);
        if ($_SERVER['REQUEST_URI'] == $root . '/' || $_SERVER['REQUEST_URI'] == $root) {
            if (URL_PATH_INFO == FALSE) {
                $samao_root = $root . '?';
                $_SERVER['SAMAO_REQUEST_URI'] = '/';
                $_SERVER['SAMAO_APP_ROOT'] = rtrim($samao_root, '/');
            } else {
                $samao_root = $root . '/';
                $_SERVER['SAMAO_REQUEST_URI'] = '/';
                $_SERVER['SAMAO_APP_ROOT'] = rtrim($samao_root, '/');
            }
            $_SERVER['SAMAO_REQUEST_URI'] = self::lefttrim($_SERVER['SAMAO_REQUEST_URI'], APP_URL);
            return;
        }
    }

    //处理根目录下 开启重写  IIS==
    private static function setPathB() {
        //处理ISAPI_REWRITE3下的重写问题==
        if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
            $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
        } else {
            if (stripos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) === 0) {
                $_SERVER['REQUEST_URI'] = APP_URL . substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME']));
            }
        }
        //如果存在PATH_INFO目录==
        $root = rtrim(__ROOT__, '/');
        if (URL_PATH_INFO == FALSE) {
            if (preg_match('@^((?:/[^/=&]+)+)&?(.*)$@', $_SERVER['QUERY_STRING'], $matches)) {
                $_SERVER['SAMAO_REQUEST_URI'] = $matches[1];
                $_SERVER['QUERY_STRING'] = isset($matches[2]) ? $matches[2] : '';
            } else {
                $_SERVER['SAMAO_REQUEST_URI'] = $_SERVER['REQUEST_URI'];
            }
        } else {
            if (isset($_SERVER['PATH_INFO'])) {
                $_SERVER['SAMAO_REQUEST_URI'] = $_SERVER['PATH_INFO'];
            } else {
                $_SERVER['SAMAO_REQUEST_URI'] = $_SERVER['REQUEST_URI'];
            }
        }
        $samao_root = rtrim($root, '/');
        if ($samao_root != '') {
            $ridx = stripos($_SERVER['REQUEST_URI'], $samao_root);
            if ($ridx !== FALSE) {
                $_SERVER['SAMAO_REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], $ridx + strlen($samao_root));
            }
        }
        $_SERVER['SAMAO_APP_ROOT'] = $samao_root;
        $_SERVER['SAMAO_REQUEST_URI'] = self::lefttrim($_SERVER['SAMAO_REQUEST_URI'], APP_URL);
        return;
    }

}
