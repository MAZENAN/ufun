<?php

class SamaoSession {

    public static $lifeTime;
    public static $havcache = NULL;

    private static function create() {
        $row = DB::getone("show tables like '@pf_sessions'");
        if ($row == null) {
            DB::exec("CREATE TABLE `@pf_sessions` ( 
  `session_id` varchar(40) NOT NULL default '', 
  `session_expires` int(10) unsigned NOT NULL default '0', 
  `session_data` varchar(500),
  PRIMARY KEY (`session_id`)
            )ENGINE=MEMORY DEFAULT CHARSET=utf8 COMMENT='SAMAO_SESSION内存表'");
        }
    }

    private static function chkcache() {
        if (self::$havcache === NULL) {
            $engine = DataCache::get_engine();
            if ($engine == 'wincache' || $engine == 'redis' || $engine == 'memcache') {
                self::$havcache = true;
            } else {
                self::$havcache = false;
            }
        }
    }

    public static function open($savePath, $sessName) {
        self::$lifeTime = get_cfg_var("session.gc_maxlifetime");
        self::chkcache();
        if (self::$havcache) {
            return true;
        }
        if (DEV_DEBUG) {
            self::create();
        }
        return true;
    }

    public static function close() {
        self::gc(ini_get('session.gc_maxlifetime'));
        return true;
    }

    public static function read($sessID) {
        self::chkcache();
        if (self::$havcache) {
            $rt = DataCache::get($sessID, $res);
            if (!$rt) {
                return '';
            }
        } else {
            try {
                $res = DB::getval("select session_data from @pf_sessions where session_id = ? and session_expires > ?", array($sessID, time()));
            } catch (Exception $e) {
                self::create();
                return '';
            }
        }
        return $res;
    }

    public static function write($sessID, $sessData) {
        self::chkcache();
        if (self::$havcache) {
            DataCache::save($sessID, $sessData, self::$lifeTime);
        } else {
            $newExp = time() + self::$lifeTime;
            try {
                $res = DB::getone("select * from @pf_sessions where session_id = ?", array($sessID));
            } catch (Exception $e) {
                self::create();
                $res = null;
            }
            if ($res != null) {
                DB::update('@pf_sessions', array('session_expires' => $newExp, 'session_data' => $sessData), 'session_id=?', array($sessID));
                return true;
            } else {
                DB::insert('@pf_sessions', array('session_expires' => $newExp, 'session_data' => $sessData, 'session_id' => $sessID));
                return true;
            }
        }
    }

    public static function destroy($sessID) {
        self::chkcache();
        if (self::$havcache) {
            DataCache::delete($sessID);
        } else {
            try {
                DB::delete('@pf_sessions', 'session_id=?', array($sessID));
            } catch (Exception $e) {
                self::create();
                return true;
            }
        }
        return true;
    }

    public static function gc($sessMaxLifeTime) {
        self::chkcache();
        if (self::$havcache) {
            return true;
        }
        try {
            DB::delete('@pf_sessions', 'session_expires<?', array(time()));
        } catch (Exception $e) {
            self::create();
            return true;
        }
        return true;
    }

}
