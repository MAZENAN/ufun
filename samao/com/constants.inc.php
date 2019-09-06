<?php

defined('SAMAO_VERSION') or exit;
/**
 * 系统常量
 * 下面这些系统常量会随着开发环境的改变或者设置的改变而产生变化
 */
/**
 * 应用名称
 * 默认为 Home 应用
 */
defined('APP_NAME') or define('APP_NAME', 'Home');

defined('SAMAO_DIR') or define('SAMAO_DIR', './samao/');
/**
 * 是否属于 CGI模式
 */
define('IS_CGI', substr(PHP_SAPI, 0, 3) == 'cgi' ? TRUE : FALSE );
/**
 * 是否属于Windows 环境
 */
define('IS_WIN', strstr(PHP_OS, 'WIN') ? TRUE : FALSE);

/**
 * 是否属于命令行模式
 */
define('IS_CLI', PHP_SAPI == 'cli' ? TRUE : FALSE);

/**
 * 当前是否GET请求
 */
define('IS_GET', strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' ? TRUE : FALSE);
/**
 * 当前是否POST请求
 */
define('IS_POST', strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ? TRUE : FALSE);

//是否开启快速路由模式
defined('ROUTE_FAST') or define('ROUTE_FAST', FALSE);
/**
 * 相对站点跟目录
 */
defined('ROOT_DIR') or define('ROOT_DIR', realpath(dirname(SAMAO_DIR)) . DS);
/**
 * 应用URL路径
 */
defined('APP_URL') or define('APP_URL', '');

defined('SAMAO_APP_ROOT') or define('SAMAO_APP_ROOT', '');
/**
 * 当前应用路径
 */
defined('APP_DIR') or define('APP_DIR', './Home/');

defined('SAMAO_SESSION') or define('SAMAO_SESSION', FALSE);
if (!IS_CLI) {

    // 当前文件名
    if (!defined('_PHP_FILE_')) {
        if (IS_CGI) {
            //CGI/FASTCGI模式下
            $_temp = explode('.php', $_SERVER['PHP_SELF']);
            define('_PHP_FILE_', rtrim(str_replace($_SERVER['HTTP_HOST'], '', $_temp[0] . '.php'), '/'));
        } else {
            define('_PHP_FILE_', rtrim($_SERVER['SCRIPT_NAME'], '/'));
        }
    }

    if (!defined('__ROOT__')) {
        // 网站URL根目录===
        if (!isset($_SERVER['DOCUMENT_ROOT'])) {
            if (isset($_SERVER['SCRIPT_FILENAME'])) {
                $temp1 = str_replace(array('/', '\\'), DS, $_SERVER['SCRIPT_FILENAME']);
                $temp2 = str_replace(array('/', '\\'), DS, _PHP_FILE_);
                list($path) = explode($temp2, $temp1);
                $_SERVER['DOCUMENT_ROOT'] = rtrim($path, DS);
            }
        }
        //根据DOCUMENT_ROOT获取跟目录
        if (isset($_SERVER['DOCUMENT_ROOT'])) {
            $temp1 = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
            $temp2 = rtrim(str_replace('\\', '/', ROOT_DIR), '/');
            if ($temp1 == $temp2) {
                define('__ROOT__', '');
            } else {
                $temps = explode($temp1, $temp2);
                if (count($temps) == 2) {
                    $_root = rtrim($temps[1], '/');
                    define('__ROOT__', $_root);
                }
            }
        }
    }
}

/**
 * 网站根目录地址
 */
defined('__ROOT__') or define('__ROOT__', '');

/**
 * 网站公共资源目录
 */
defined('__PUBLIC__') or define('__PUBLIC__', __ROOT__ . '/public');
/**
 * 网站内置资源目录
 */
defined('__RES__') or define('__RES__', __PUBLIC__ . '/samaores');
/**
 * 配置文件路径
 */
defined('CONF_DIR') or define('CONF_DIR', ROOT_DIR . 'config' . DS);

/**
 * 运行时目录
 */
defined('RUNTIME_DIR') or define('RUNTIME_DIR', ROOT_DIR . 'runtime' . DS);

/**
 * 是否开启重写路径
 */
defined('URL_REWRITE') or define('URL_REWRITE', FALSE);

/**
 * 是否使用PATH_INFO目录
 */
defined('URL_PATH_INFO') or define('URL_PATH_INFO', TRUE);

/**
 * 是否开发模式
 */
defined('DEV_DEBUG') or define('DEV_DEBUG', TRUE);

/**
 * 移除所有POST XSS脚本
 */
defined('REMOVE_XSS') or define('REMOVE_XSS', FALSE);
/**
 * 开启脚手架工具扩展
 */
defined('SAMAO_BYTOOL') or define('SAMAO_BYTOOL', FALSE);
