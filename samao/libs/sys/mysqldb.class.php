<?php

/**
 * (MysqlDB &gt;= 1.0.0, SaMao &gt;= 1.0.0)<br/>
 * Mysql数据库操作简单封装 
 */

/**
 * Description of MysqlDB<br/>
 * Mysql数据库操作简单封装 
 * @author WJ008
 */
class MysqlDb {

    public $PDO;
    public $queryStrings = array();

    function __construct($host, $dbname, $user, $pass = '', $port = 3306) {
        if ($dbname != '') {
            $link = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname;
        } else {
            $link = 'mysql:host=' . $host . ';port=' . $port . ';';
        }
        try {
            if (DEV_REPORT) {
                $starttime = SamaoReport::getMicrotime();
            }
            $this->PDO = new PDO($link, $user, $pass);
            $this->PDO->exec('SET NAMES \'UTF8\'');
            if (DEV_REPORT) {
                $endtime = SamaoReport::getMicrotime();
                SamaoReport::setDBConnectionTime(round($endtime - $starttime, 6));
            }
        } catch (PDOException $e) {
            throw new Exception("数据库连接不成功{$e->getMessage()} \n");
        }
    }

    public function getqueryStrings() {
        return $this->queryStrings;
    }

    /**
     * 将参数格式化到SLQ语句之中 仅对?参数有效
     * @param string $sql
     * @param array $args
     */
    private function format_sql($sql, $args) {
        $idx = 0;
        $osql = $sql;
        for ($i = 0, $len = count($args); $i < $len; $i++) {
            $pos = strpos($sql, '?', $idx);
            if ($pos === false) {
                throw new Exception("执行语句错误\n参数数量与sql语句不一致。\nSQL: {$sql}\nOLDSQL: {$osql}\n参数:" . print_r($args, TRUE));
            }
            if (gettype($args[$i]) == 'string') {
                $temp = '\'' . addcslashes($args[$i], '\'\\') . '\'';
            } else {
                $temp = $args[$i];
            }
            $sql = substr_replace($sql, $temp, $pos, 1);
            $idx = $pos + strlen($temp);
        }

        return ($sql);
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
    public function exec($sql) {
        $rt = $this->PDO->exec($sql);
        if ($rt === FALSE) {
            throw new Exception("执行语句错误\nSQL: \n{$sql}");
        }
        return $rt;
    }

    /**
     * 获取最后插入的ID
     * @param string $name 获取字段名称
     * @return mixed an SQLSTATE
     */
    public function lastId($name = NULL) {
        if ($name == NULL) {
            $this->PDO->lastInsertId();
        }
        return $this->PDO->lastInsertId($name);
    }

    /**
     * 执行SQL语句 
     * @param string $sql
     * @param array $args
     * @return mixed The return value
     */
    public function execute($sql, $args = array()) {
        if (!is_array($args)) {
            throw new Exception("查询参数错误\nSQL: \n{$sql}\n参数必须是数组形式：\n" . print_r($args, TRUE));
        }
        if (substr_count($sql, '?') != count($args)) {
            throw new Exception("查询参数错误\nSQL: \n{$sql}\n参数传递数量不一致：\n" . print_r($args, TRUE));
        }
        if (DEV_REPORT) {
            $starttime = SamaoReport::getMicrotime();
        }
        $Stm = $this->PDO->prepare($sql);
        if ($Stm->execute($args) === FALSE) {
            //切换为不带参数形式
            $Stm->closeCursor();
            $sql = $this->format_sql($sql, $args);
            $args = array();
            $Stm = $this->PDO->prepare($sql);
            if ($Stm->execute() === FALSE) {
                $str = print_r($Stm->errorInfo(), true);
                throw new Exception("执行语句错误\n{$str}\n最终执行的SQL: \n{$sql}");
            }
        }
        if (DEV_REPORT || DEV_DEBUG) {
            $queryString = $this->format_sql($Stm->queryString, $args);
            if (DEV_REPORT) {
                $endtime = SamaoReport::getMicrotime();
                $timeset = round($endtime - $starttime, 6);
                SamaoReport::addQueryTime($timeset);
                $queryString.='      ---- [ReturnTime:' . sprintf('%f', $timeset) . ']';
            }
            $this->queryStrings[] = $queryString;
        }
        return $Stm;
    }

    /**
     * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
     * Initiates a transaction
     * @link http://php.net/manual/en/pdo.begintransaction.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function beginTransaction() {
        $rt = $this->PDO->beginTransaction();
        if ($rt === FALSE) {
            throw new Exception("无法开启事务\n请查看您的数据表类型是否支持事务!");
        }
        return $rt;
    }

    /**
     * 执行事务
     * @link http://php.net/manual/en/pdo.commit.php
     * @return bool true on success or false on failure.
     */
    public function commit() {
        $rt = $this->PDO->commit();
        if ($rt === FALSE) {
            throw new Exception("无法提交事务\n请查看您的数据表类型是否支持事务!");
        }
        return $rt;
    }

    /**
     * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
     * 回滚事务
     * @link http://php.net/manual/en/pdo.rollback.php
     * @return bool true on success or false on failure.
     */
    public function rollBack() {
        $rt = $this->PDO->rollBack();
        if ($rt === FALSE) {
            throw new Exception("无法回滚事务\n请查看您的数据表类型是否支持事务!");
        }
        return $rt;
    }

    /**
     * (PHP 5 &gt;= 5.3.3, Bundled pdo_pgsql)<br/>
     * Checks if inside a transaction
     * @link http://php.net/manual/en/pdo.intransaction.php
     * @return bool true if a transaction is currently active, and false if not.
     */
    public function inTransaction() {
        $rt = $this->PDO->inTransaction();
        if ($rt === FALSE) {
            throw new Exception("无法执行事务inTransaction\n请查看您的数据表类型是否支持事务!");
        }
        return $rt;
    }

    /**
     * 获取查询的所有结果
     * @param string $sql 查询语句
     * @param array $args 查询参数集
     * @link http://php.net/manual/en/pdostatement.fetch.php
     * @param int $type [optional] <p> 查询参数集
     * @return array The return value
     */
    public function getlist($sql, $args = array(), $type = PDO::FETCH_ASSOC) {
        try {
            $Stm = $this->execute($sql, $args);
            $rows = $Stm->fetchAll($type);
            $Stm->closeCursor();
            return $rows;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
        return array();
    }

    /**
     * 获取查询的首条数据结果
     * @param string $sql 查询语句
     * @param array $args 查询参数集
     * @link http://php.net/manual/en/pdostatement.fetch.php
     * @param int $type [optional] <p> 查询参数集
     * @return array The return value
     */
    public function getone($sql, $args = array(), $type = PDO::FETCH_ASSOC) {
        try {
            $rows = $this->getlist($sql, $args, $type);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
        if (count($rows) > 0) {
            return $rows [0];
        } else {
            return NULL;
        }
    }

    /**
     * 获取表字段
     * @param string $tb 表名
     * @return mixed The return value
     */
    public function getfields($tb) {
        try {
            return $this->getlist('desc `' . $tb . '`', array(), PDO::FETCH_COLUMN);
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
    public function replace($tb, $vals) {
        if (count($vals) == 0) {
            return;
        }
        $SqlKey = array();
        $SqlPam = array();
        $SqlVal = array();
        foreach ($vals as $key => $value) {
            $SqlKey [] = '`' . $key . '`';
            if ($value === NULL) {
                $SqlPam [] = 'NULL';
            } else if (gettype($value) == 'object' && get_class($value) == 'stdClass') {
                $SqlPam [] = $value->text;
            } else {
                $SqlPam [] = '?';
                $SqlVal [] = $value;
            }
        }
        $sql = 'replace into ' . $tb . '(' . join(',', $SqlKey) . ') values (' . join(',', $SqlPam) . ')';
        try {
            $Stm = $this->execute($sql, $SqlVal);
            $Stm->closeCursor();
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
    public function insert($tb, $vals) {
        if (count($vals) == 0) {
            return;
        }
        $SqlKey = array();
        $SqlPam = array();
        $SqlVal = array();
        foreach ($vals as $key => $value) {
            $SqlKey [] = '`' . $key . '`';
            if ($value === NULL) {
                $SqlPam [] = 'NULL';
            } else if (gettype($value) == 'object' && get_class($value) == 'stdClass') {
                $SqlPam [] = $value->text;
            } else {
                $SqlPam [] = '?';
                $SqlVal [] = $value;
            }
        }
        $sql = 'insert into ' . $tb . '(' . join(',', $SqlKey) . ') values (' . join(',', $SqlPam) . ')';

        try {
            $Stm = $this->execute($sql, $SqlVal);
            $Stm->closeCursor();
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
    public function update($tb, $vals, $where = '', $args = array()) {
        if (count($vals) == 0) {
            return;
        }
        if (gettype($where) == 'integer' || (gettype($where) == 'string' && is_numeric(trim($where)))) {
            $args = array(intval(trim($where)));
            $where = 'id=?';
        }
        $SqlPam = array();
        $SqlVal = array();
        foreach ($vals as $key => $value) {
            if ($value === NULL) {
                $SqlPam [] = '`' . $key . '`=NULL';
            } else if (gettype($value) == 'object' && get_class($value) == 'stdClass') {
                $SqlPam [] = '`' . $key . '`=' . $value->text;
            } else {
                $SqlPam [] = '`' . $key . '`=?';
                $SqlVal [] = $value;
            }
        }
        $where = trim($where);
        if (strrpos($where, 'where') !== false && strrpos($where, 'where') == 0) {
            $where = trim(substr($where, 5));
        }
        $sql = 'update ' . $tb . ' set ' . join(',', $SqlPam) . ' where ' . $where;
        if (count($args) > 0) {
            for ($i = 0; $i < count($args); $i++) {
                $SqlVal [] = $args [$i];
            }
        }

        try {
            $Stm = $this->execute($sql, $SqlVal);
            $Stm->closeCursor();
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
    public function delete($tb, $where, $args = array()) {
        if (gettype($where) == 'integer' || (gettype($where) == 'string' && is_numeric(trim($where)))) {
            $args = array(intval(trim($where)));
            $where = 'id=?';
        }
        $where = trim($where);
        if (strrpos($where, 'where') !== false && strrpos($where, 'where') == 0) {
            $where = trim(substr($where, 5));
        }
        $sql = 'delete from ' . $tb . ' where ' . $where;
        try {
            $Stm = $this->execute($sql, $args);
            $Stm->closeCursor();
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage(), $exc->getInfo());
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
        $sql = new stdClass();
        $sql->text = $str;
        return $sql;
    }

}
