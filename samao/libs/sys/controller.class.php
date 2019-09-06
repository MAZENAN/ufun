<?php

/**
 * @ignore
 */
class Controller {

    /**
     * @var Smarty 
     */
    protected $_smarty = null;
    private $_smarty_view_dir = '';
    private $_books = array();
    

    public function setTemplateDir($dir) {
        $this->_smarty_view_dir = $dir;
    }

    public function addbook($key, $value) {
        $this->_books[$key] = $value;
    }

    protected function initSmarty() {
        $this->_smarty = new SamaoTpl();
        if ($this->_smarty_view_dir == '') {
            $this->_smarty_view_dir = correct_dir(APP_DIR) . 'views';
        }
        $smartyPlugins = array();
        $smartyPlugins[] = SMARTY_PLUGINS_DIR;
        $smartyPlugins[] = SAMAO_SMARTY_DIR . 'ext' . DS . 'plugins';
        $CustomsmartyPlugins = C('CUSTOM_SMARTY_PLUG_DIR');
        if (!empty($CustomsmartyPlugins)) {
            $smartyPlugins[] = substr(ROOT_DIR, 0, -1) . $CustomsmartyPlugins;
        }
        $this->_smarty->setTemplateDir($this->_smarty_view_dir)
                ->setCompileDir(RUNTIME_DIR)
                ->setCacheDir(RUNTIME_DIR . 'cache')
                ->setPluginsDir($smartyPlugins);
        $this->_smarty->left_delimiter = "{@";
        $this->_smarty->right_delimiter = "@}";
        $this->_smarty->registerFilter('pre', 'smarty_rewrite_extension');
        $this->_smarty->compile_check = DEV_DEBUG;
        $this->_smarty->force_compile = DEV_DEBUG;
        $this->_smarty->config_vars = Config::getValues();
    }

    public function __get($name) {
        if ($this->_smarty == NULL) {
            $this->initSmarty();
        }
        if (isset($this->_smarty->$name) && property_exists($this->_smarty, $name)) {
            return $this->_smarty->$name;
        }
    }

    public function __set($name, $value) {
        if ($this->_smarty == NULL) {
            $this->initSmarty();
        }
        if (isset($this->_smarty->$name) && property_exists($this->_smarty, $name)) {
            return $this->_smarty->$name = $value;
        }
    }

    public function __isset($name) {
        if ($this->_smarty == NULL) {
            $this->initSmarty();
        }
        if (isset($this->_smarty->$name) && property_exists($this->_smarty, $name)) {
            return true;
        }
        return false;
    }

    public function __unset($name) {
        if ($this->_smarty == NULL) {
            $this->initSmarty();
        }
        unset($this->_smarty->$name);
    }

    public function __call($name, $arguments) {
        if ($this->_smarty == NULL) {
            $this->initSmarty();
        }
        if (!method_exists($this->_smarty, $name)) {
            return;
        }

        if ($name == 'display' && count($this->_books) > 0) {
            foreach ($this->_books as $key => $value) {
                $this->_smarty->assign($key, $value);
            }
        }
        try {
            return call_user_func_array(array($this->_smarty, $name), $arguments);
        } catch (Exception $exc) {
            throw new Exception('调用Smarty方法错误: ' . $name . '()' . html_entity_decode(html_entity_decode($exc->getMessage())));
        }
    }

    public static function __callStatic($name, $arguments) {
        require_once(SAMAO_DIR . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php');
        if (method_exists('Smarty', $name)) {
            return call_user_func_array('Smarty::' . $name, $arguments);
        }
    }

    public function doact() {
        $action = Route::get('act');
        if ($action == 'index') {
            return;
        }
        $exit = false;
        $_acts = func_get_args();
        $len = count($_acts);
        if ($len >= 2 && end($_acts) === true) {
            $exit = true;
            array_pop($_acts);
        }

        if (count($_acts) == 1 && is_array($_acts[0])) {
            $_acts = $_acts[0];
        }

        if ($_acts[0] == '*') {
            if ($action == '' || $action == 'index') {
                if ($exit) {
                    exit();
                }
                return;
            }
        } else {
            if ($action == '' || !in_array($action, $_acts)) {
                if ($exit) {
                    exit();
                }
                return;
            }
        }
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        if (IS_AJAX) {
            $action.='Ajax';
        }
        if ($method == 'GET' && method_exists($this, $action . 'GetAction')) {
            $out = call_user_func(array($this, $action . 'GetAction'));
            if (IS_AJAX && isset($out)) {
                die(json_encode($out));
            }
            exit;
        }
        if ($method == 'POST' && method_exists($this, $action . 'PostAction')) {
            $out = call_user_func(array($this, $action . 'PostAction'));
            if (IS_AJAX && isset($out)) {
                die(json_encode($out));
            }
            exit;
        }
        if (method_exists($this, $action . 'Action')) {
            $out = call_user_func(array($this, $action . 'Action'), $method);
            if (IS_AJAX && isset($out)) {
                die(json_encode($out));
            }
            exit;
        }
    }

    public function displayModel($model, $tpl = '@model_act.tpl') {
        try {
            $model->assignTo($this);
            $this->display($tpl);
        } catch (SmartyException $exc) {
            throw new Exception('调用Smarty方法错误: display()' . html_entity_decode(html_entity_decode($exc->getMessage())));
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function success($msg = NULL, $url = NULL, $waitSecond = 1, $type = 0, $script = '') {
        if (IS_AJAX) {
            if ($msg === NULL && $url === NULL) {
                die(json_encode(true));
            } else {
                if ($url === NULL) {
                    die(json_encode(array('status' => true, 'msg' => $msg)));
                } else {
                    die(json_encode(array('status' => true, 'msg' => $msg, 'url' => __APPROOT__ . $url)));
                }
            }
        } else {
            if (empty($url)) {
                $url = SPost('_BACKURL_');
            }
            if (empty($url)) {
                $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : -1;
            }
            if (is_numeric($url)) {
                $url = 'javascript:history.go(' . $url . ');';
            } else {
                if (empty($msg) || $waitSecond == 0) {
                    header("location:" . $url);
                    exit('<script type="text/javascript">location.href ="' . $url . '";</script>');
                }
            }
            $arr = array(
                'msgTitle' => '操作成功！',
                'message' => $msg,
                'status' => true,
                'waitSecond' => $waitSecond,
                'jumpUrl' => $url,
                'script' => $script,
            );
            $this->assign($arr);
            try {
                $this->display(C('CONTROLLER_SUCCESS_TPL'));
            } catch (Exception $exc) {
                throw new Exception('模板信息有误' . $exc->getMessage());
            }
            exit();
        }
    }

    public function error($msg = NULL, $url = NULL, $waitSecond = 3, $type = 0, $script = '') {
        if (IS_AJAX) {
            if ($msg === NULL && $url === NULL) {
                die(json_encode(false));
            } else {
                if ($url === NULL) {
                    die(json_encode(array('status' => false, 'msg' => $msg)));
                } else {
                    die(json_encode(array('status' => false, 'msg' => $msg, 'jumpurl' => __APPROOT__ . $url)));
                }
            }
        } else {
            if (empty($url)) {
                $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : -1;
            }
            if (is_numeric($url)) {
                $url = 'javascript:history.go(' . $url . ');';
            } else {
                if (empty($msg) || $waitSecond == 0) {
                    header("location:" . $url);
                    exit('<script type="text/javascript">location.href ="' . $url . '";</script>');
                }
            }
            $arr = array(
                'msgTitle' => '操作失败！',
                'error' => $msg,
                'status' => false,
                'waitSecond' => $waitSecond,
                'jumpUrl' => $url,
                'script' => $script,
            );
            $this->assign($arr);
            if ($type == 404) {
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
                $temp = C('CONTROLLER_ERR404_TPL') == '' ? C('CONTROLLER_ERROR_TPL') : C('CONTROLLER_ERR404_TPL');
                try {
                    $this->display($temp);
                } catch (Exception $exc) {
                    throw new Exception('模板信息有误' . $exc->getMessage());
                }
            } else {
                try {
                    $this->display(C('CONTROLLER_ERROR_TPL'));
                } catch (Exception $exc) {
                    throw new Exception('模板信息有误' . $exc->getMessage());
                }
            }
            exit();
        }
    }

    public function alert($msg, $url = '', $top = false) {
        if (empty($url)) {
            $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : -1;
        }
        if (is_numeric($url)) {
            $url = 'javascript:history.go(' . $url . ');';
        }
        $alert = 'alert("' . $msg . '");';
        $goto = 'location="' . $url . '";';
        if ($top) {
            $goto = 'top.' . $goto;
        }
        die('<html><head><script type="text/javascript">' . $alert . $goto . '</script></head><body></body></html>');
    }

}
