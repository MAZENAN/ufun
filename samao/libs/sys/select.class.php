<?php

/**
 * Description of select
 *
 * @author wj354
 */
//简单的SQL选择器选择器

class Select {

    private $table = '';
    private $where = '';
    private $args = array();
    private $orderby = '';
    private $group = '';
    private $limit = '';
    private $find = '*';
    private $union_sql = array();
    private $union_args = array();
    private $union_limit = '';
    private $union_orderby = '';
    private $brackets = array();
    //直接执行的
    private $stsql = '';
    private $stargs = NULL;
    private $on = '';

    const SEARCH_NOT_EMPTY = 0;
    const SEARCH_NOT_NULL = 1;
    const SEARCH_NOT_ZERO = 2;
    const SEARCH_NOT_EMPTY_STRING = 3;
    const SEARCH_NOT_VALUE = 4;
    const SEARCH_ALL = 5;

    /**
     * 表名 如 @pf_table1
     * @param string $table
     */
    public function __construct($table) {
        $this->table = $table;
    }

    /**
     * 清理 所有查询条件
     * @return \Select
     */
    public function clear() {
        $this->where = '';
        $this->args = array();
        $this->orderby = '';
        $this->group = '';
        $this->limit = '';
        $this->find = '*';
        $this->brackets = array();
        $this->stsql = '';
        $this->stargs = NULL;
        $this->union_sql = array();
        $this->union_args = array();
        $this->union_limit = '';
        $this->union_orderby = '';
        return $this;
    }

    public function clear_order() {
        $this->orderby = '';
        $this->union_orderby = '';
        return $this;
    }

    public function clear_where() {
        $this->where = '';
        return $this;
    }

    public function set_table() {
        $this->table = $table;
        return $this;
    }

    public function get_orderby() {
        return $this->orderby;
    }

    /**
     * where 查询条件
     * @param string $sql 必须以 and 或者 or 等开头
     * @param array $args 查询中的参数集合
     * @return \Select
     */
    public function where($sql, $args = array()) {
        $sql = trim($sql);
        if ($sql == '') {
            return;
        }
        $count = count($this->brackets);
        if ($count == 0) {
            if ($this->where == '') {
                if (stripos($sql, 'and ') === 0) {
                    $this->where = 'where ' . substr($sql, 4);
                } else {
                    $this->where = 'where 1=1 ' . $sql;
                }
            } else {
                $this->where.=' ' . $sql;
            }
            $this->args = array_merge($this->args, $args);
        } else {
            $idx = $count - 1;
            $bsql = $this->brackets[$idx]['sql'];
            $bargs = $this->brackets[$idx]['args'];
            if ($bsql == '') {
                if (stripos($sql, 'and ') === 0) {
                    $bsql = substr($sql, 4);
                } elseif (stripos($sql, 'or ') === 0) {
                    $bsql = substr($sql, 3);
                } else {
                    $bsql = '1=1 ' . $sql;
                }
            } else {
                $bsql.=' ' . $sql;
            }
            $this->brackets[$idx]['sql'] = $bsql;
            $this->brackets[$idx]['args'] = array_merge($bargs, $args);
        }
        return $this;
    }
    public function on($sql) {
        $sql = trim($sql);
        if ($sql == '') {
            return;
        }
          
        $this->on=' ' . $sql;
           
        return $this;
    }

    /**
     * 要查找的字段
     * @param string $find
     * @param 字段中可能的参数 $args
     * @return \Select
     */
    public function find($find = '*', $args = array()) {
        $this->find = $find;
        if (count($args) > 0) {
            $this->args = array_merge($this->args, $args);
        }
        return $this;
    }

    /**
     * 开始括号
     * @param string $type
     * @return \Select
     */
    public function bkStart($type = 'and') {
        $this->brackets[] = array('type' => $type, 'sql' => '', 'args' => array());
        return $this;
    }

    /**
     * 结束括号
     * @return \Select
     */
    public function bkEnd() {
        $count = count($this->brackets);
        if ($count == 0) {
            return;
        }
        $item = $this->brackets[$count - 1];
        array_pop($this->brackets);
        $sql = trim($item['sql']);
        if ($sql != '') {
            $args = $item['args'];
            $sql = ' ' . $item['type'] . ' (' . $sql . ')';
            $this->where($sql, $args);
        }
        return $this;
    }

    /**
     * 搜索字符串
     * @param type $sch
     * @param type $val
     * @param type $searchtype
     * @param type $notval
     * @return \Select
     */
    public function search($sch, $val = '', $searchtype = self::SEARCH_NOT_EMPTY, $notval = null) {
        $sql = '';
        $args = array();
        if ($searchtype == self::SEARCH_NOT_EMPTY) {
            if (!empty($sch) && !empty($val)) {
                $sql.=' ' . trim($sch);
                $args[] = $val;
            }
        } elseif ($searchtype == self::SEARCH_NOT_NULL) {
            if (!empty($sch) && $val !== NULL) {
                $sql.=' ' . trim($sch);
                $args[] = $val;
            }
        } elseif ($searchtype == self::SEARCH_NOT_ZERO) {
            if (!empty($sch) && $val !== 0) {
                $sql.=' ' . trim($sch);
                $args[] = $val;
            }
        } elseif ($searchtype == self::SEARCH_NOT_EMPTY_STRING) {
            if (!empty($sch) && $val !== '') {
                $sql.=' ' . trim($sch);
                $args[] = $val;
            }
        } elseif ($searchtype == self::SEARCH_NOT_VALUE) {
            if (!empty($sch) && $val !== $notval) {
                $sql.=' ' . trim($sch);
                $args[] = $val;
            }
        } else {
            if (!empty($sch)) {
                $sql.=' ' . trim($sch);
                $args[] = $val;
            }
        }
        $this->where($sql, $args);
        return $this;
    }

    public function like_search($sch, $val = '', $searchtype = self::SEARCH_NOT_EMPTY, $notval = null) {
        $sql = '';
        $args = array();
        if ($searchtype == self::SEARCH_NOT_EMPTY) {
            if (!empty($sch) && !empty($val)) {
                $sql.=' ' . trim($sch);
                $args[] = '%' . $val . '%';
            }
        } elseif ($searchtype == self::SEARCH_NOT_NULL) {
            if (!empty($sch) && $val !== NULL) {
                $sql.=' ' . trim($sch);
                $args[] = '%' . $val . '%';
            }
        } elseif ($searchtype == self::SEARCH_NOT_ZERO) {
            if (!empty($sch) && $val !== 0) {
                $sql.=' ' . trim($sch);
                $args[] = '%' . $val . '%';
            }
        } elseif ($searchtype == self::SEARCH_NOT_EMPTY_STRING) {
            if (!empty($sch) && $val !== '') {
                $sql.=' ' . trim($sch);
                $args[] = '%' . $val . '%';
            }
        } elseif ($searchtype == self::SEARCH_NOT_VALUE) {
            if (!empty($sch) && $val !== $notval) {
                $sql.=' ' . trim($sch);
                $args[] = '%' . $val . '%';
            }
        } else {
            if (!empty($sch)) {
                $sql.=' ' . trim($sch);
                $args[] = '%' . $val . '%';
            }
        }
        $this->where($sql, $args);
        return $this;
    }

    /**
     * 排序
     * @param string $field
     * @param string $sort 
     * @return \Select
     */
    public function orderby($field, $sort = NULL) {
        if (is_array($field)) {
            foreach ($field as $vals) {
                $this->orderby($vals, $sort);
            }
        } else {
            if (count($this->union_sql) == 0) {
                if ($this->orderby == '') {
                    if ($sort === NULL) {
                        $this->orderby = 'order by ' . $field;
                    } else {
                        $this->orderby = 'order by ' . $field . ' ' . $sort;
                    }
                } else {
                    if ($sort === NULL) {
                        $this->orderby.=',' . $field;
                    } else {
                        $this->orderby.=',' . $field . ' ' . $sort;
                    }
                }
            } else {
                if ($this->union_orderby == '') {
                    if ($sort === NULL) {
                        $this->union_orderby = 'order by ' . $field;
                    } else {
                        $this->union_orderby = 'order by ' . $field . ' ' . $sort;
                    }
                } else {
                    if ($sort === NULL) {
                        $this->union_orderby.=',' . $field;
                    } else {
                        $this->union_orderby.=',' . $field . ' ' . $sort;
                    }
                }
            }
        }
        return $this;
    }

    /**
     * 归组
     * @param string $field
     * @return \Select
     */
    public function group($field) {
        if (is_array($field)) {
            foreach ($field as $vals) {
                $this->group($vals);
            }
        } else {
            if ($this->group == '') {
                $this->group = 'group by ' . $field;
            } else {
                $this->group.=',' . $field;
            }
        }
        return $this;
    }

    /**
     * 分段取数据
     * @param int $start
     * @param int $lenght
     * @return \Select
     */
    public function limit($start, $lenght = 0) {
        if ($lenght == 0) {
            $lenght = $start;
            $start = 0;
        }
        if (count($this->union_sql) == 0) {
            $this->limit = 'limit ' . $start . ',' . $lenght;
        } else {
            $this->union_limit = 'limit ' . $start . ',' . $lenght;
        }
        return $this;
    }

    public function setSql($sql) {
        $this->stsql = $sql;
        return $this;
    }

    /**
     * 获取SQL
     * @return string
     */
    public function getSql() {
        if (!empty($this->stsql)) {
            return $this->stsql;
        }
        $sql = 'select ' . $this->find . ' from ' . $this->table;
        if (!empty($this->on)) {
            $sql.=' on ' . $this->on;
        }
        if (!empty($this->where)) {
            $sql.=' ' . $this->where;
        }
        if (!empty($this->group)) {
            $sql.=' ' . $this->group;
        }
        if (!empty($this->orderby)) {
            $sql.=' ' . $this->orderby;
        }
        if (!empty($this->limit)) {
            $sql.=' ' . $this->limit;
        }
        if (count($this->union_sql) > 0) {
            $sql = '(' . $sql . ')';
            foreach ($this->union_sql as $union_sql) {
                $sql.= ' union (' . $union_sql . ')';
            }
            if (!empty($this->union_orderby)) {
                $sql.=' ' . $this->union_orderby;
            }
            if (!empty($this->union_limit)) {
                $sql.=' ' . $this->union_limit;
            }
        }
        return $sql;
    }

    public function setArgs($args) {
        $this->stargs = $args;
        return $this;
    }

    public function getArgs() {
        if ($this->stargs != NULL) {
            return $this->stargs;
        }
        if (count($this->union_sql) > 0) {
            $temp = $this->args;
            foreach ($this->union_args as $args) {
                $temp = array_merge($temp, $args);
            }
            return $temp;
        }
        return $this->args;
    }

    public function getlist($fetch_style = PDO::FETCH_ASSOC) {
        $sql = $this->getSql();
        $args = $this->getArgs();
        return DB::getlist($sql, $args, $fetch_style);
    }

    public function lastSql() {
        return DB::getLastSql();
    }

    public function insert($vals) {
        DB::insert($this->table, $vals);
        return $this;
    }

    public function replace($vals) {
        DB::replace($this->table, $vals);
        return $this;
    }

    public function lastid() {
        return DB::lastId();
    }

    public function update($vals, $id = NULL) {
        if (!empty($id)) {
            DB::update($this->table, $vals, $id);
        }
        if (!empty($this->where)) {
            DB::update($this->table, $vals, $this->where, $this->args);
        }
        return $this;
    }

    public function delete($id = NULL) {
        if (!empty($id)) {
            DB::delete($this->table, $id);
        }
        if (!empty($this->where)) {
            DB::delete($this->table, $this->where, $this->args);
        }
        return $this;
    }

    public function getone($fetch_style = PDO::FETCH_ASSOC) {
        $sql = $this->getSql();
        $args = $this->getArgs();
        return DB::getone($sql, $args, $fetch_style);
    }

    public function getCount() {
        $sql = $this->getSql();
        $args = $this->getArgs();
        if (strripos($sql, ' from ') === stripos($sql, ' from ')) {
            $sql = preg_replace('@^select\s+(distinct\s+[a-z][a-z0-9]+\s*,)?(.*)\s+from\s+@', 'select $1count(1) as MyCount from ', $sql);
            $row = DB::getone($sql, $args);
        } else {
            $row = DB::getone('select count(1) as MyCount from (' . $sql . ') MyTempTable', $args);
        }
        return $row['MyCount'];
    }

    public function getPagelist($size = 20, $pagekey = 'page', $count = -1, $only_count = -1) {
        $sql = $this->getSql();
        $args = $this->getArgs();
        return new Pagelist($sql, $args, $size, $pagekey, $count, $only_count);
    }

    public function union($select) {
        $this->union_sql[] = $select->getSql();
        $this->union_args[] = $select->getArgs();
        return $this;
    }

    public function join($table) {
        $this->table = $this->table . ',' . $table;
        return $this;
    }
    public function leftJoin($table) {
        $this->table = $this->table . ' left join ' . $table;
        return $this;
    }
    public function leftJoinMore($table,$on) {
        $this->table = $this->table . ' left join ' . $table ." on " .$on;
        return $this;
    }

}
