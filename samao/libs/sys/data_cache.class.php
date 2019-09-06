<?php

class DataCache {

    private static $redis = null;
    private static $memcache = null;
    private static $engine = '';
    private static $temp_engine = '';
    private static $isloadcgf = false;

    //获取缓存引擎
    public static function get_engine() {
        if (self::$temp_engine != '') {
            return self::$temp_engine;
        }
        if (!self::$isloadcgf) {
            Config::load('cache');
            self::$engine = C('ENGINE');
            self::$isloadcgf = true;
        }
        if (self::$engine === 'wincache' && extension_loaded('wincache')) {
            self::$temp_engine = 'wincache';
            return 'wincache';
        }
        if (self::$engine === 'redis' && extension_loaded('redis')) {
            self::$temp_engine = 'redis';
            return 'redis';
        }
        if (self::$engine === 'memcache' && extension_loaded('memcache')) {
            self::$temp_engine = 'memcache';
            return 'memcache';
        }
        //百度BAE缓存
        if (self::$engine === 'bae_memcache') {
            self::$temp_engine = 'bae_memcache';
            return 'bae_memcache';
        }
        self::$temp_engine = 'file';
        return 'file';
    }

    private static function connect_redis() {
        if (self::$redis === null) {
            self::$redis = new Redis();
            $host = C('REDIS_HOST');
            $port = C('REDIS_PORT');
            $host = empty($host) ? '127.0.0.1' : $host;
            $port = empty($port) ? 6379 : $port;
            $user = C('REDIS_USER');
            $pwd = C('REDIS_PWD');
            $dbname = C('REDIS_DBNAME');
            $isconnect = self::$redis->connect($host, $port);
            if (!$isconnect) {
                throw new Exception('Redis未连接成功！');
            }
            if (!empty($user) && !empty($pwd) && !empty($dbname)) {
                $ret = self::$redis->auth($user . "-" . $pwd . "-" . $dbname);
                if (!$ret) {
                    throw new Exception('Redis用户密码错误！');
                }
            }
        }
    }

    private static function connect_memcache() {
        if (self::$memcache === null) {
            $host = C('MEMCACHE_HOST');
            $port = C('MEMCACHE_PORT');
            $host = empty($host) ? '127.0.0.1' : $host;
            $port = empty($port) ? 11211 : $port;
            self::$memcache = memcache_connect($host, $port);
            if (!self::$memcache) {
                throw new Exception('Memcache未连接成功！');
            }
        }
    }

    private static function connect_bae_memcache() {
        if (self::$memcache === null) {
            $host = C('BAE_MEMCACHE_HOST');
            $port = C('BAE_MEMCACHE_PORT');
            $host = empty($host) ? 'cache.duapp.com' : $host;
            $port = empty($port) ? 20243 : $port;
            $user = C('BAE_MEMCACHE_USER');
            $pwd = C('BAE_MEMCACHE_PWD');
            $cacheid = C('BAE_MEMCACHE_CACHEID');
            self::$memcache = new BaeMemcache($cacheid, $host . ':' . $port, $user, $pwd);
            if (!self::$memcache) {
                throw new Exception('Memcache未连接成功！');
            }
        }
    }

    public static function get($key, &$data) {
        $engine = self::get_engine();
        $mkey = md5($key);
        switch ($engine) {
            case 'wincache':
                $result = wincache_ucache_exists($mkey);
                if ($result === false) {
                    return false;
                } else {
                    $datestr = wincache_ucache_get($mkey);
                    $data = unserialize($datestr);
                    return true;
                }
            case 'redis':
                self::connect_redis();
                $result = self::$redis->exists($mkey);
                if ($result === false) {
                    return false;
                } else {
                    $datestr = self::$redis->get($mkey);
                    if (extension_loaded('igbinary')) {
                        $data = igbinary_unserialize($datestr);
                    } else {
                        $data = unserialize($datestr);
                    }
                    return true;
                }
            case 'memcache':
                self::connect_memcache();
                $datestr = self::$memcache->get($mkey);
                if ($datestr === FALSE) {
                    return false;
                }
                $data = unserialize($datestr);
                return true;
            case 'bae_memcache':
                self::connect_bae_memcache();
                $datestr = self::$memcache->get($mkey);
                if ($datestr === FALSE) {
                    return false;
                }
                $data = unserialize($datestr);
                return true;
            default:
                $path = RUNTIME_DIR . 'datacache' . DIRECTORY_SEPARATOR . $mkey . '.php';
                if (is_file($path)) {
                    $sdata = require $path;
                    if ($sdata['lasttime'] < time()) {
                        return false;
                    }
                    $data = $sdata['data'];
                    return true;
                }
                return false;
        }
    }

    public static function save($key, $data, $time = 3600) {
        $engine = self::get_engine();
        $mkey = md5($key);
        switch ($engine) {
            case 'wincache':
                $datestr = serialize($data);
                wincache_ucache_set($mkey, $datestr, $time);
                break;
            case 'redis':
                self::connect_redis();
                if (extension_loaded('igbinary')) {
                    $datestr = igbinary_serialize($data);
                } else {
                    $datestr = serialize($data);
                }
                self::$redis->setex($mkey, $time, $datestr);
                break;
            case 'memcache':
                self::connect_memcache();
                $datestr = serialize($data);
                self::$memcache->set($mkey, $datestr, 0, $time);
                break;
            case 'bae_memcache':
                self::connect_bae_memcache();
                $datestr = serialize($data);
                self::$memcache->set($mkey, $datestr, 0, $time);
                break;
            default:
                $ftime = time() + $time;
                $sdata = array('lasttime' => $ftime, 'data' => $data);
                $str = '<?php if(!defined(\'SAMAO_VERSION\')) exit(\'no direct access allowed\'); 
return ' . var_export($sdata, TRUE) . ';';
                $path = RUNTIME_DIR . 'datacache' . DIRECTORY_SEPARATOR . $mkey . '.php';
                Funcs::createdir(dirname($path));
                file_put_contents($path, $str);
                break;
        }
    }

    //删除
    public static function delete($key) {
        $engine = self::get_engine();
        $mkey = md5($key);
        switch ($engine) {
            case 'wincache':
                wincache_ucache_delete($mkey);
                break;
            case 'redis':
                self::connect_redis();
                self::$redis->del($mkey);
                break;
            case 'memcache':
                self::connect_memcache();
                self::$memcache->delete($mkey);
                break;
            case 'bae_memcache':
                self::connect_bae_memcache();
                self::$memcache->delete($mkey);
                break;
            default:
                $path = RUNTIME_DIR . 'datacache' . DIRECTORY_SEPARATOR . $mkey . '.php';
                unlink($path);
                break;
        }
    }

}
