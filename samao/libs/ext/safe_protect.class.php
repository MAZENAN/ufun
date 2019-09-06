<?php

//防止CC攻击 使用内存表记录
class SafeProtect {

    private static function replacepreg($ignoredip) {
        $ignoredip = addcslashes($ignoredip, '@[]{}()+\\^$.?/');
        $ignoredip = str_replace(array("\n", "\r", "\t", "\s"), '', $ignoredip);
        $ignoredip = str_replace('*', '\d+', $ignoredip);
        $ignoredip = trim($ignoredip, '|');
        return '@^' . $ignoredip . '$@';
    }

    //获得链接IP地址
    public static function getIP() {
        static $realip;
        if (!empty($realip)) {
            return $realip;
        }
        //如果IP是代理IP
        $ip = '';
        $ignoredip = trim(C('ignoredip'));
        if (!empty($ignoredip)) {
            if (isset($_SERVER ["REMOTE_ADDR"]) && $_SERVER ["REMOTE_ADDR"]) {
                $ip = $_SERVER ["REMOTE_ADDR"];
            }
            //判断是否等于
            if ($ignoredip == $ip) {
                $ip = '';
            } else {
                if (preg_match(self::replacepreg($ignoredip), $ip)) {
                    $ip = '';
                }
            }
            if (empty($ip) && isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && $_SERVER ["HTTP_X_FORWARDED_FOR"]) {
                $ips = explode(',', $_SERVER ["HTTP_X_FORWARDED_FOR"]);
                $ip = trim($ips[0]);
            }
            if (empty($ip) && isset($_SERVER["HTTP_CLIENTIP"]) && $_SERVER ["HTTP_CLIENTIP"]) {
                $ips = explode(',', $_SERVER ["HTTP_CLIENTIP"]);
                $ip = trim($ips[0]);
            }
        } else {
            if (isset($_SERVER ["REMOTE_ADDR"]) && $_SERVER ["REMOTE_ADDR"]) {
                $ip = $_SERVER ["REMOTE_ADDR"];
            }
        }
        if (empty($ip)) {
            $ip = "0.0.0.0";
        }
        $realip = trim($ip);
        return $realip;
    }

    //判断是否代理
    public static function isProxy() {
        if (isset($_SERVER['HTTP_VIA']) && !empty($_SERVER['HTTP_VIA'])) {
            return true;
        }
        if (getenv("HTTP_VIA")) {
            return true;
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $_SERVER ["HTTP_X_FORWARDED_FOR"]);
            foreach ($ips as $key => $value) {
                $ips[$key] = trim($value);
            }
            $ip = isset($_SERVER ["REMOTE_ADDR"]) ? trim($_SERVER ["REMOTE_ADDR"]) : '0.0.0.0';
            if (!in_array($ip, $ips)) {
                return true;
            }
        }
        return false;
    }

    //创建采访日志表
    private static function create_table() {
        $row = DB::getone("show tables like '@pf_safe_protect'");
        if ($row == null) {
            DB::exec("CREATE TABLE `@pf_safe_protect` ( 
  `name` varchar(40) NOT NULL default '', 
  `time` int(10) unsigned NOT NULL default '0', 
  `method` int(1) unsigned NOT NULL default '0',
  `type` int(1) unsigned NOT NULL default '0'
            )ENGINE=MEMORY DEFAULT CHARSET=utf8 COMMENT='安全防护日志表'");
        }
    }

    //添加IP日志===
    private static function addLog($name, $type = 0, $time = 0) {
        $method = IS_POST ? 1 : 0;
        $time = $time == 0 ? time() : $time;
        DB::insert('@pf_safe_protect', array('name' => $name, 'time' => $time, 'type' => $type, 'method' => $method));
    }

    //清理日志
    private static function delLog($timeout) {
        $time = time() - $timeout;
        DB::delete('@pf_safe_protect', '`time`<?', array($time));
    }

    //验证==
    public static function chick() {
        $dis_proxy = C('dis_proxy') == 1 ? true : false;
        if ($dis_proxy && self::isProxy()) {
            return -1;
        }
        $name = self::getIP();
        $ignoredip = trim(C('ignoredwip'));
        if (!empty($ignoredip)) {
            if (preg_match(self::replacepreg($ignoredip), $name)) {
                return 1;
            }
        }
        try {
            $dis_time = C('dis_time');
            //禁止访问列表
            if (!empty($dis_time)) {
                $count = DB::getval('select count(1) from @pf_safe_protect where `name`=? and method=0 and `type`=3 and `time`>?', array($name, time()));
                if ($count > 0) {
                    return -5;
                }
            }
            $ipgettice = C('ipgettice');
            $ipgettime = C('ipgettime');
            if (!empty($ipgettice) && !empty($ipgettime)) {
                $time = time() - $ipgettime;
                $count = DB::getval('select count(1) from @pf_safe_protect where `name`=? and method=0 and `type`=0 and `time`>?', array($name, $time));
                if ($count > $ipgettice) {
                    if (!empty($dis_time)) {
                        self::addLog($name, 3, time() + $dis_time);
                    }
                    return -2;
                }
            }
            $ipposttice = C('ipposttice');
            $ipposttime = C('ipposttime');
            if (!empty($ipposttice) && !empty($ipposttime)) {
                $time = time() - $ipposttime;
                $count = DB::getval('select count(1) from @pf_safe_protect where `name`=? and method=1 and `type`=0 and `time`>?', array($name, $time));
                if ($count > $ipposttice) {
                    if (!empty($dis_time)) {
                        self::addLog($name, 3, time() + $dis_time);
                    }
                    return -3;
                }
            }
            self::addLog($name, 0);
            $noref = C('noref') == 1 ? true : false;
            if ($noref) {
                @session_start();
                $name = session_id();
                $noreftice = C('noreftice');
                $noreftime = C('noreftime');
                if (!empty($noreftice) && !empty($noreftime)) {
                    $time = time() - $noreftime;
                    $count = DB::getval('select count(1) from @pf_safe_protect where `name`=? and `type`=1 and `time`>?', array($name, $time));
                    if ($count > $noreftice) {
                        return -4;
                    }
                }
                self::addLog($name, 1);
            }
            self::delLog(300);
        } catch (Exception $e) {
            self::create_table();
        }
        return 1;
    }

    //验证直接输出==
    public static function chickmsg() {
        $rt = self::chick();
        if ($rt < 0) {
            switch ($rt) {
                case -1:
                    die('错误，网站拒绝代理IP采访！');
                case -2:
                case -4:
                    die('采访速度太快，请稍后再采访！');
                case -3:
                    die('提交速度太快，请稍后再采访！');
                case -5:
                    die('采访过快，IP暂时被拒绝采访！');
                default :
                    die('错误，禁止采访！');
            }
        }
    }

}
