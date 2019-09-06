<?php

class PDOStatement {

    var $sql;
    var $conn;
    var $result = NULL;

    function __construct($sql, &$conn) {
        $this->sql = $sql;
        $this->conn = $conn;
    }

    function execute($vals = array()) {
        $this->changsql($vals);
        $this->result = mysql_query($this->sql, $this->conn);
        if ($this->result == null)
            throw new Exception('错误信息SQL:' . $this->sql);
        return true;
    }

    private function changsql($vals = array()) {
        if (count($vals) == 0)
            return;
        $idx = 0;
        for ($i = 0, $len = count($vals); $i < $len; $i++) {
            $pos = strpos($this->sql, '?', $idx);
            if ($pos === false)
                throw new SamaoException('执行语句错误', '错误信息：' . $this->sql);
            if (gettype($vals[$i]) == 'string')
                $temp = '\'' . addcslashes($vals[$i], '\'\\') . '\'';
            else if (gettype($vals[$i]) == 'object' && get_class($vals[$i]) == 'stdClass')
                $temp = $vals[$i]->text;
            else
                $temp = $vals[$i];
            $this->sql = substr_replace($this->sql, $temp, $pos, 1);
            $idx = $pos + strlen($temp);
        }
    }

    function fetchAll($type = MYSQL_BOTH) {
        $rows = array();
        if ($type == PDO::FETCH_CLASS) {
            while ($row = mysql_fetch_object($this->result)) {
                $rows[] = $row;
            }
        } elseif ($type == PDO::FETCH_COLUMN) {
            while ($row = mysql_fetch_array($this->result)) {
                $rows[] = $row[0];
            }
        } else {
            while ($row = mysql_fetch_array($this->result, $type)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    function closeCursor() {
        if ($this->result != NULL) {
            $this->result = NULL;
        }
    }

}

class PDO {

    var $conn;

    const FETCH_BOTH = MYSQL_BOTH;
    const FETCH_ASSOC = MYSQL_ASSOC;
    const FETCH_CLASS = 8;
    const FETCH_COLUMN = 7;
    const FETCH_NUM = MYSQL_NUM;
    const MYSQL_ATTR_INIT_COMMAND = 1002;

    function __construct($dsn, $username = '', $password = '', $driver_options = array()) {
        preg_match("/host=(.*?)($| |;)/i", $dsn, $d);
        $host = isset($d[1]) ? $d[1] : '';
        preg_match("/port=(.*?)($| |;)/i", $dsn, $d);
        $port = isset($d[1]) ? $d[1] : '';
        preg_match("/dbname=(.*?)($| |;)/i", $dsn, $d);
        $dbname = isset($d[1]) ? $d[1] : '';
        $host = $port == '' ? $host : ($host . ':' . $port);
        $this->conn = mysql_connect($host, $username, $password);
        if (isset($driver_options[self::MYSQL_ATTR_INIT_COMMAND])) {
            mysql_query($driver_options[self::MYSQL_ATTR_INIT_COMMAND], $this->conn);
        }
        mysql_select_db($dbname, $this->conn);
    }

    function prepare($sql, $arr = array()) {
        return new PDOStatement($sql, $this->conn);
    }

    function exec($sql) {
        return mysql_query($sql, $this->conn);
    }

    function query($sql) {
        $result = mysql_query($sql, $this->conn);
        $rows = array();
        while ($row = mysql_fetch_array($this->result)) {
            $rows[] = $row[0];
        }
        return $rows;
    }

    function lastInsertId($field = '') {
        return mysql_insert_id();
    }

    function beginTransaction() {
        mysql_query("set autocommit=0");
        mysql_query("start transaction");
    }

    function commit() {
        mysql_query("commit");
        mysql_query("set autocommit=1");
    }

    function rollBack() {
        mysql_query("roolback");
        mysql_query("set autocommit=1");
    }

    function __destruct() {
        mysql_close($this->conn);
    }

}
