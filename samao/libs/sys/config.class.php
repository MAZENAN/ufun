<?php

class Config {

    private static $config = array();
    private static $allconfig = array();
    private static $loads = array();

    public static function load() {
        $names = func_get_args();
        foreach ($names as $name) {
            if (self::isload($name)) {
                continue;
            }
            $path = CONF_DIR . $name . '.config.php';
            if (is_file($path)) {
                if (DEV_REPORT) {
                    SamaoReport::addConfigName($name);
                }
                self::$loads[$name] = true;
                $temp = require($path);
                if (isset(self::$config[$name]) && gettype(self::$config[$name]) == 'array') {
                    self::$config[$name] = array_merge(self::$config, $temp);
                } else {
                    self::$config[$name] = $temp;
                }
                self::$allconfig = array_merge(self::$allconfig, $temp);
            } else {
                if (DEV_REPORT) {
                    trace("找不到加载的配置文件 [{$name}].\n{$path}目录中不存在这个配置文件，请检查并加入这个配置文件信息！");
                }
            }
        }
    }

    //是否加载
    private static function isload($name) {
        if (isset(self::$loads[$name])) {
            return true;
        }
        return false;
    }

    //设置键值
    public static function set($key, $value) {
        $keys = array();
        if (preg_match('@^([a-z0-9_]+)\.([a-z0-9_]+)$@i', $key, $keys)) {
            $name = $keys[1];
            $key = $keys[2];
            if (isset(self::$config[$name]) && gettype(self::$config[$name]) == 'array') {
                self::$config[$name][$key] = $value;
            } else {
                self::$config[$name] = array($key => $value);
            }
            self::$allconfig[$key] = $value;
        } else {
            self::$allconfig[$key] = $value;
        }
    }

    //设置配置值
    public static function setValues($values) {
        foreach ($values as $key => $value) {
            self::set($key, $value);
        }
    }

    //获取所有配置值
    public static function getValues($name = '') {
        if (empty($name)) {
            return self::$allconfig;
        } else {
            return isset(self::$config[$name]) ? self::$config[$name] : array();
        }
    }

    //获得单个配置
    public static function get($key) {
        if (preg_match('@^([a-z0-9_]+)\.([a-z0-9_]+)$@i', $key, $keys)) {
            $name = $keys[1];
            $key = $keys[2];
            if (isset(self::$config[$name]) && isset(self::$config[$name][$key])) {
                return self::$config[$name][$key];
            }
        }
        return isset(self::$allconfig[$key]) ? self::$allconfig[$key] : '';
    }

    //保存配置值
    public static function save($name, $data) {
        $path = CONF_DIR . $name . '.config.php';
        $code = var_export($data, true);
        $code = '<?php return ' . $code . ';';
        file_put_contents($path, $code);
    }

}
