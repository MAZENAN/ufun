<?php

header("Content-type:text/html;charset=utf-8");
/**
 * 框架版本信息
 */
define('SAMAO_VERSION', '6.0.0');

#判断PHP版本信息
if (version_compare(PHP_VERSION, '5.2.0', '<')) {
    die('PHP版本要求  > 5.2.0 !');
}

/**
 * 系统默认物理路径斜线
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * SAMAO框架路径
 */
defined('SAMAO_DIR') or define('SAMAO_DIR', dirname(__FILE__) . DS);
/**
 * 是否开启调试报告
 */
defined('DEV_REPORT') or define('DEV_REPORT', FALSE);

if (DEV_REPORT) {
    require SAMAO_DIR . 'libs' . DS . 'sys' . DS . 'samao_report.class.php';
    SamaoReport::StartTime();
}

#载入环境变量信息
require SAMAO_DIR . 'com' . DS . 'constants.inc.php';

#依据PHP版本载入对应函数信息
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    require SAMAO_DIR . 'com' . DS . 'php52.inc.php';
} else {
    require SAMAO_DIR . 'com' . DS . 'php53.inc.php';
}

#加入基本库
import('samao.libs.sys.*');
#加入扩展库
import('samao.libs.ext.*');

if (REMOVE_XSS && IS_POST) {
    Xss::RemoveAllPost();
}
#开启快速路由
if (ROUTE_FAST) {
    eval('class Route extends FastRoute{}');
}
#载入基本配置类
Config::load('samaophp');

//应用类==
class App {

    /**
     *  MVC模式运行
     * @param array $route
     * @throws Exception
     */
    public static function Run(&$route = null) {
        if (!Route::$isInit) {
            Route::init($route);
        }
        if (SAMAO_BYTOOL || C('SAMAO_BYTOOL') === TRUE) {
            import('samao.toollibs.*');
            require SAMAO_DIR . 'toollibs' . DS . 'bytool.inc.php';
        }
        //使用Samao缓存保存Session
        if (SAMAO_SESSION || C('SAMAO_SESSION') === TRUE) {
            ini_set('session.save_handler', 'user');
            session_set_save_handler('SamaoSession::open', 'SamaoSession::close', 'SamaoSession::read', 'SamaoSession::write', 'SamaoSession::destroy', 'SamaoSession::gc');
        }
        //配置运行时常量
        define('__SELF__', Route::getUrl('ctl'));
        defined('__APPROOT__') or define('__APPROOT__', Route::getRunRoot(APP_URL));
        defined('__RUNROOT__') or define('__RUNROOT__', Route::getRunRoot());

        $name = Route::get('ctl');
        $class = to_camel($name) . 'Controller';
        if (!class_exists($class)) {
            throw new Exception("您访问的控制器页面不存在[{$class}]");
        }
        $slcms = new $class();
        if (!method_exists($slcms, 'indexAction')) {
            throw new Exception("您访问的控制器页面[{$class}]不存在 indexAction() 方法");
        }
        $slcms->indexAction();
    }

    /**
     *  简单模式模式运行
     * @param array $route
     * @throws Exception
     */
    public static function SimpleRun(&$route = null) {
        $pathinfo = pathinfo($_SERVER['SCRIPT_NAME']);
        if (!ROUTE_FAST) {
            $pathinfo = pathinfo($_SERVER['SCRIPT_NAME']);
            $_SERVER['SAMAO_REQUEST_URI'] = '/' . $pathinfo['basename'];
            $_SERVER['SAMAO_APP_ROOT'] = rtrim(__ROOT__, '/');
            if ($route == null) {
                $route = array(
                    'rule' => array(
                        'useparam' => '/{ctl:@key}.php?{act:@key}&{get:@_any}', //可以任意取名
                        'act' => '/{ctl:@key}.php?{act:@key}{:@end}',
                        'ctl' => '/{ctl:@key}.php', //控制器路径 一定需要使用 ctl 的名称 
                    ),
                    'default' => array('ctl' => 'index', 'act' => 'index'),
                );
            }
            Route::init($route);
        }
        self::Run();
    }

}
