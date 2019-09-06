<?php

Config::load('db');
/**
 * 数据库连接地址
 */
defined('DB_DRIVER') or define('DB_DRIVER', 'mysql');
/**
 * 数据库连接地址
 */
defined('DB_HOST') or define('DB_HOST', C('DB_HOST'));
/**
 * 数据库连接端口
 */
defined('DB_PORT') or define('DB_PORT', C('DB_PORT'));
/**
 * 数据库名称
 */
defined('DB_NAME') or define('DB_NAME', C('DB_NAME'));
/**
 * 数据库用户名
 */
defined('DB_USER') or define('DB_USER', C('DB_USER'));
/**
 * 数据库连接密码
 */
defined('DB_PWD') or define('DB_PWD', C('DB_PWD'));
/**
 * 数据表前缀 
 */
defined('DB_PREFIX') or define('DB_PREFIX', C('DB_PREFIX'));

/**
 * MysqlDB 数据库静态类封装
 * 目前仅让其静态类支持Mysql 
 * (SaMao &gt;= 1.0.0)<br/>
 * @package UxFW 
 * @subpackage framework
 * @author WJ008
 * @version 1.0.0
 */
class DB {

    /**
     * MysqlDB 连接实例
     * @var MysqlDB 
     */
    public static $Conn;
    private static $prefix = DB_PREFIX;
    public static $isOpen = FALSE;
    private static $cache = FALSE;
    private static $cache_time = 3600;
    private static $TransTice = 0; //事务次数==

    /**
     * 打开数据库 调用时自动打开
     */

    private static function open() {
        try {
            if (self::$Conn == NULL) {
                switch (strtolower(DB_DRIVER)) {
                    case 'mysql':
                        self::$Conn = new MysqlDb(DB_HOST, DB_NAME, DB_USER, DB_PWD, DB_PORT);
                        break;
                    default :
                        self::$Conn = new MysqlDb(DB_HOST, DB_NAME, DB_USER, DB_PWD, DB_PORT);
                        break;
                }
                self::$isOpen = TRUE;
            }
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public static function cache_open($time = 3600) {
        self::$cache = TRUE;
        self::$cache_time = $time;
    }

    public static function cache_close() {
        self::$cache = FALSE;
    }

    public static function getqueryStrings() {
        if (!self::$isOpen) {
            return array();
        }
        return self::$Conn->getqueryStrings();
    }

    //获得最后一条执行语句==
    public static function getLastSql() {
        $len = count(self::$Conn->queryStrings);
        return $len > 0 ? self::$Conn->queryStrings[$len - 1] : '';
    }

    /**
     * 开启事务
     * @return bool true on success or false on failure.
     */
    public static function beginTransaction() {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            //只有事务次数是0才开启=
            if (self::$TransTice == 0) {
                self::$TransTice++;
                return self::$Conn->beginTransaction();
            }
            self::$TransTice++;
            return true;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 执行事务
     * @link http://php.net/manual/en/pdo.commit.php
     * @return bool true on success or false on failure.
     */
    public static function commit() {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            self::$TransTice--;
            if (self::$TransTice == 0) {
                return self::$Conn->commit();
            }
            return true;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
     * 回滚事务
     * @link http://php.net/manual/en/pdo.rollback.php
     * @return bool true on success or false on failure.
     */
    public static function rollBack() {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            self::$TransTice--;
            if (self::$TransTice == 0) {
                return self::$Conn->rollBack();
            }
            return true;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * (PHP 5 &gt;= 5.3.3, Bundled pdo_pgsql)<br/>
     * Checks if inside a transaction
     * @link http://php.net/manual/en/pdo.intransaction.php
     * @return bool true if a transaction is currently active, and false if not.
     */
    public static function inTransaction() {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            return self::$Conn->inTransaction();
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 快速执行SQL语句 无返回值
     * @link http://php.net/manual/en/pdo.exec.php
     * @param string $statement <p>
     * The SQL statement to prepare and execute.
     * </p>
     * <p>
     * Data inside the query should be properly escaped.
     * </p>
     * @return int <b>PDO::exec</b> returns the number of rows that were modified
     */
    public static function exec($sql) {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $sql = str_replace('@pf_', self::$prefix, $sql);
            }
            self::$Conn->exec($sql);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 获取最后插入的ID
     * @param string $name 获取字段名称
     * @return mixed an SQLSTATE
     */
    public static function lastId($name = NULL) {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            return self::$Conn->lastId($name);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 执行SQL语句 
     * @param string $sql
     * @param array $args
     * @return mixed The return value
     */
    public static function execute($sql, $args = array()) {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $sql = str_replace('@pf_', self::$prefix, $sql);
            }
            return self::$Conn->execute($sql, $args);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 获取表字段
     * @param string $tb 表名
     * @return mixed The return value
     */
    public static function getFields($tb) {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $tb = str_replace('@pf_', self::$prefix, $tb);
            }
            return self::$Conn->getFields($tb);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 获取查询的所有结果
     * @param string $sql 查询语句
     * @param array $args 查询参数集
     * @param int $fetch_style [optional] <p> 查询参数集
     * @return array The return value
     */
    public static function getlist($sql, $args = array(), $fetch_style = PDO::FETCH_ASSOC) {
        try {
            $savecache = false;
            if (self::$cache) {
                $key = 'getlist' . $sql . serialize($args) . 'fetch_type' . $fetch_style;
                if (DataCache::get($key, $data)) {
                    return $data;
                }
                $savecache = true;
            }
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $sql = str_replace('@pf_', self::$prefix, $sql);
            }
            $data = self::$Conn->getlist($sql, $args, $fetch_style);
            if ($savecache) {
                DataCache::save($key, $data, self::$cache_time);
            }
            return $data;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public static function getopts($tb, $field = null, $order = 0, $where = null, $args = array()) {
        $field = $field == null ? 'id,name' : $field;
        $sql = 'select ' . $field . ' from ' . $tb;
        if ($where) {
            $sql.=' where ' . $where;
        }
        if ($order == 1) {
            $sql.=' order by sort asc';
        }
        if ($order == 2) {
            $sql.=' order by sort desc';
        }
        if ($order == 3) {
            $sql.=' order by id desc';
        }
        return self::getdata($sql, $args);
    }

    /**
     * 返回数组字段
     * @param string $sql 查询语句
     * @param array $args 查询参数集
     * @return array The return value
     */
    public static function getdata($sql, $args = array()) {
        try {
            return self::getlist($sql, $args, PDO::FETCH_NUM);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 获取查询的首条数据结果
     * @param string $sql 查询语句
     * @param array $args 查询参数集
     * @param int $fetch_style [optional] <p> 查询参数集
     * @return array The return value
     */
    public static function getone($sql, $args = array(), $fetch_style = PDO::FETCH_ASSOC) {
        try {
            $savecache = false;
            if (self::$cache) {
                $key = 'getone' . $sql . serialize($args) . 'fetch_type' . $fetch_style;
                if (DataCache::get($key, $data)) {
                    return $data;
                }
                $savecache = true;
            }
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $sql = str_replace('@pf_', self::$prefix, $sql);
            }
            $data = self::$Conn->getone($sql, $args, $fetch_style);
            if ($savecache) {
                DataCache::save($key, $data, self::$cache_time);
            }
            return $data;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public static function getval($tb, $field = null, $id = 0) {
        try {
            if (gettype($field) == 'string') {
                static $vals = array();
                $key = "{$tb}|{$field}|{$id}";
                if (isset($vals[$key])) {
                    return $vals[$key];
                }
                $tb = "select `{$field}` from {$tb} where id=?";
                $row = self::getone($tb, array($id), PDO::FETCH_NUM);
                if ($row == NULL) {
                    $vals[$key] = '';
                    return '';
                }
                $vals[$key] = $row[0];
                return $row[0];
            }
            if ($field === null) {
                $field = [];
            }
            $row = self::getone($tb, $field, PDO::FETCH_NUM);
            if ($row == NULL) {
                return '';
            }
            return $row[0];
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 获取查询的首条数据结果
     * @param string $sql 查询语句
     * @param array $args 查询参数集
     * @param int $fetch_style [optional] <p> 查询参数集
     * @return array The return value
     */
    public static function getrow($tb, $id = '', $fetch_style = PDO::FETCH_ASSOC) {
        if (gettype($tb) == 'array') {
            return self::Agetrow($tb, $id, $fetch_style);
        }
        try {
            $savecache = false;
            if (self::$cache) {
                $key = 'getrow' . $tb . '@id_' . $id . 'fetch_type' . $fetch_style;
                if (DataCache::get($key, $data)) {
                    return $data;
                }
                $savecache = true;
            }
            if (!self::$isOpen) {
                self::open();
            }
            $sql = 'select * from ' . $tb;
            $args = array();
            if ($id !== '') {
                $sql.=' where id=?';
                $args[0] = $id;
            }
            if (self::$prefix != '') {
                $sql = str_replace('@pf_', self::$prefix, $sql);
            }
            $data = self::$Conn->getone($sql, $args, $fetch_style);
            if ($savecache) {
                DataCache::save($key, $data, self::$cache_time);
            }
            return $data;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 指定数据表插入数据 使用 键=>值 形式 <p>
     * @param string $tb 数据表
     * @param array $vals 键=>值
     * * 如 <code> array('name'=>'wj008','sex'=>'男') </code><p>
     * 即表示 向数据表的 name,sex 插入相应值
     */
    public static function insert($tb, $vals) {
        if (gettype($tb) == 'array') {
            return self::Ainsert($tb, $vals);
        }
        try {
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $tb = str_replace('@pf_', self::$prefix, $tb);
            }
            self::$Conn->insert($tb, $vals);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 指定数据表插入数据 使用 键=>值 形式 <p>
     * @param string $tb 数据表
     * @param array $vals 键=>值
     * * 如 <code> array('name'=>'wj008','sex'=>'男') </code><p>
     * 即表示 向数据表的 name,sex 插入相应值
     */
    public static function replace($tb, $vals) {
        try {
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $tb = str_replace('@pf_', self::$prefix, $tb);
            }
            self::$Conn->replace($tb, $vals);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 指定数据表跟新数据 使用 键=>值 形式 <p>
     * @param string $tb 数据表
     * @param array $vals 键=>值
     * * 如 <code> array('name'=>'wj008','sex'=>'男') </code><p>
     * 即表示 向数据表的 name,sex 跟新相应值
     * @param integer|string $where [optional] <p>如果为integer时 即查找id字段为该值的记录<p>如果为string时 可以书写查询sql语句 <br>如 where name=? 或者 name=? and sex=?<br>可不带where
     * @param array $args [optional] <p>即如果 $where 为sql 语句时存在?号的参数 
     */
    public static function update($tb, $vals, $where = NULL, $args = array()) {
        if (gettype($tb) == 'array') {
            return self::Aupdate($tb, $vals, $where, $args);
        }
        try {
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $tb = str_replace('@pf_', self::$prefix, $tb);
            }
            self::$Conn->update($tb, $vals, $where, $args);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 指定数据表删除数据 <p>
     * @param string $tb 数据表
     * @param integer|string $where [optional] <p>如果为integer时 即查找id字段为该值的记录<p>如果为string时 可以书写查询sql语句 <br>如 where name=? 或者 name=? and sex=?<br>可不带where
     * @param array $args [optional] <p>即如果 $where 为sql 语句时存在?号的参数 
     */
    public static function delete($tb, $where = NULL, $args = array()) {
        if (gettype($tb) == 'array') {
            return self::Adelete($tb, $where, $args);
        }
        try {
            if (!self::$isOpen) {
                self::open();
            }
            if (self::$prefix != '') {
                $tb = str_replace('@pf_', self::$prefix, $tb);
            }
            self::$Conn->delete($tb, $where, $args);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 在MysqlDB 插入insert和跟新update中使用键值配对时 <br>
     * 提供一种数据类型可以直接插入 sql语句的数据类型 <p>
     * 如 $vals['time']=MysqlDB::sql('now()');<br> 即 ·time·=now() 而非 ·time·='now()'
     * @param string $str
     * @return stdClass 
     */
    public static function sql($str) {
        try {
            $sql = new stdClass();
            $sql->text = $str;
            return $sql;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    /**
     * 连表添加方法=== 要求ID或者主表ID一致 主表需要在前面
     * @param array $tbs
     * @param array $vals
     */
    private static function Ainsert($tbs, $vals) {
        $mainid = 0;
        $mtb = 'id';
        foreach ($tbs as $idx => $tb) {
            $fileds = self::getFields($tb);
            $tempvals = array();
            foreach ($fileds as $filed) {
                if (isset($vals[$filed])) {
                    $tempvals[$filed] = $vals[$filed];
                }
            }
            if ($idx == 0) {
                self::insert($tb, $tempvals);
                $mainid = self::lastId();
                $mtb = str_replace('@pf_', '', $tb) . '_id';
            } else {
                if (in_array($mtb, $fileds)) {
                    $tempvals[$mtb] = $mainid;
                    self::insert($tb, $tempvals);
                } else {
                    $tempvals['id'] = $mainid;
                    self::replace($tb, $tempvals);
                }
            }
        }
    }

    private static function Aupdate($tbs, $vals, $where = NULL, $args = array()) {
        $rows = array();
        $mtb = 'id';
        foreach ($tbs as $idx => $tb) {
            $fileds = self::getFields($tb);
            $tempvals = array();
            foreach ($fileds as $filed) {
                if (isset($vals[$filed])) {
                    $tempvals[$filed] = $vals[$filed];
                }
            }
            if ($idx == 0) {
                self::update($tb, $tempvals, $where, $args);
                $twhere = $where;
                $targs = $args;
                if (gettype($twhere) == 'integer' || (gettype($twhere) == 'string' && is_numeric(trim($twhere)))) {
                    $targs = array(intval(trim($twhere)));
                    $twhere = 'id=?';
                }
                $twhere = trim($twhere);
                if (strrpos($twhere, 'where') !== false && strrpos($twhere, 'where') == 0) {
                    $twhere = trim(substr($twhere, 5));
                }
                $sql = 'select id from ' . $tb . ' where ' . $twhere;
                $rows = self::getlist($sql, $targs);
                $mtb = str_replace('@pf_', '', $tb) . '_id';
            } else {
                foreach ($rows as $rs) {
                    if (in_array($mtb, $fileds)) {
                        self::update($tb, $tempvals, $mtb . '=?', array($rs['id']));
                    } else {
                        $temp = self::getone('select * from ' . $tb . ' where id=?', array($rs['id']));
                        if ($temp == null) {
                            $tempvals['id'] = $rs['id'];
                            self::replace($tb, $tempvals);
                        } else {
                            self::update($tb, $tempvals, $rs['id']);
                        }
                    }
                }
            }
        }
    }

    private static function Adelete($tbs, $where = NULL, $args = array()) {
        $rows = array();
        $mtb = 'id';
        foreach ($tbs as $idx => $tb) {
            if ($idx == 0) {
                $twhere = $where;
                $targs = $args;
                if (gettype($twhere) == 'integer' || (gettype($twhere) == 'string' && is_numeric(trim($twhere)))) {
                    $targs = array(intval(trim($twhere)));
                    $twhere = 'id=?';
                }
                $twhere = trim($twhere);
                if (strrpos($twhere, 'where') !== false && strrpos($twhere, 'where') == 0) {
                    $twhere = trim(substr($twhere, 5));
                }
                $sql = 'select id from ' . $tb . ' where ' . $twhere;
                $rows = self::getlist($sql, $targs);
                self::delete($tb, $where, $args);
                $mtb = str_replace('@pf_', '', $tb) . '_id';
            } else {
                $fileds = self::getFields($tb);
                foreach ($rows as $rs) {
                    if (in_array($mtb, $fileds)) {
                        self::delete($tb, $mtb . '=?', array($rs['id']));
                    } else {
                        self::delete($tb, $rs['id']);
                    }
                }
            }
        }
    }

    private static function Agetrow($tbs, $id, $fetch_style = PDO::FETCH_ASSOC) {
        try {
            $mainid = 0;
            $row = null;
            $mtb = 'id';
            foreach ($tbs as $idx => $tb) {
                if ($idx == 0) {
                    $row = self::getrow($tb, $id, $fetch_style);
                    if ($row == null) {
                        return null;
                    }
                    $mainid = $row['id'];
                    $mtb = str_replace('@pf_', '', $tb) . '_id';
                } else {
                    $fileds = self::getFields($tb);
                    if (in_array($mtb, $fileds)) {
                        $temp = self::getone('select * from ' . $tb . ' where ' . $mtb . '=?', array($mainid), $fetch_style);
                    } else {
                        $temp = self::getrow($tb, $mainid, $fetch_style);
                    }
                    if (gettype($temp) == 'array') {
                        $row = array_merge($temp, $row);
                    }
                }
            }
            return $row;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

}
