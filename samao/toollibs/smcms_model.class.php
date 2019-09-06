<?php

abstract class SmcmsModel extends Model {

    var $tbname = '';
    var $list_tpl = 'smcms';

    public function __construct($modeltype = self::MODEL_ADD) {
        parent::__construct($modeltype);
        $this->action = Route::get('act');
    }

    public function add(&$id = FALSE) {
        $args = func_get_args();
        $vals = $this->formatVals();
        if ($this->type == 2) {
            $ret = DB::insert(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), $vals);
        } else {
            $ret = DB::insert("@pf_{$this->tbname}", $vals);
        }
        if (count($args) > 0) {
            $id = DB::lastId();
        }
        return $ret;
    }

    public function update($id) {
        $vals = $this->formatVals();
        if ($this->type == 2) {
            DB::update(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), $vals, $id);
        } else {
            DB::update("@pf_{$this->tbname}", $vals, $id);
        }
    }

    public function delete($id) {
        if ($this->type == 2) {
            DB::delete(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), $id);
        } else {
            DB::delete("@pf_{$this->tbname}", $id);
        }
    }

    public function deleteArr($ids) {
        if (count($ids) == 0) {
            return;
        }
        if ($this->type == 2) {
            DB::delete(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), 'id in (' . join(',', $ids) . ')');
        } else {
            DB::delete('@pf_' . $this->tbname, 'id in (' . join(',', $ids) . ')');
        }
    }

    public function getone($id, $field = '*') {
        if ($this->type != 2) {
            return DB::getone("select {$field} from @pf_{$this->tbname} where id=?", array($id));
        } else {
            $row1 = DB::getone("select * from @pf_{$this->tbname} where id=?", array($id));
            $row2 = DB::getone("select {$field} from @pf_{$this->parent_tbname} where id=?", array($id));
            if ($row2 == null) {
                return $row1;
            }
            if ($row1 == null) {
                return $row2;
            }
            return array_merge($row1, $row2);
        }
    }

    public function upsort($id) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, 'sort')) {
                return;
            }
            $row1 = DB::getone("select id,sort from @pf_{$this->tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->tbname} where sort<? order by sort desc limit 0,1", array($row1['sort']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        } else {
            if (!DbSet::chkField($this->parent_tbname, 'sort')) {
                return;
            }
            $row1 = DB::getone("select id,sort from @pf_{$this->parent_tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->parent_tbname} where sort<? order by sort desc limit 0,1", array($row1['sort']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        }
    }

    public function dnsort($id) {
        //检查是否存在 sort 字段
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, 'sort')) {
                return;
            }
            $row1 = DB::getone("select id,sort from @pf_{$this->tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->tbname} where sort>? order by sort asc limit 0,1", array($row1['sort']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        } else {
            if (!DbSet::chkField($this->parent_tbname, 'sort')) {
                return;
            }
            $row1 = DB::getone("select id,sort from @pf_{$this->parent_tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->parent_tbname} where sort>? order by sort asc limit 0,1", array($row1['sort']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        }
    }

    public function upsortByPid($id) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, 'sort')) {
                return;
            }
            if (!DbSet::chkField($this->tbname, 'pid')) {
                return;
            }
            $row1 = DB::getone("select id,sort,pid from @pf_{$this->tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->tbname} where sort<? and pid=? order by sort desc limit 0,1", array($row1['sort'], $row1['pid']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        } else {
            if (!DbSet::chkField($this->parent_tbname, 'sort')) {
                return;
            }
            if (!DbSet::chkField($this->parent_tbname, 'pid')) {
                return;
            }
            $row1 = DB::getone("select id,sort,pid from @pf_{$this->parent_tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->parent_tbname} where sort<? and pid=? order by sort desc limit 0,1", array($row1['sort'], $row1['pid']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        }
    }

    public function dnsortByPid($id) {
        //检查是否存在 sort 字段
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, 'sort')) {
                return;
            }
            if (!DbSet::chkField($this->tbname, 'pid')) {
                return;
            }
            $row1 = DB::getone("select id,sort,pid from @pf_{$this->tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->tbname} where sort>? and pid=? order by sort asc limit 0,1", array($row1['sort'], $row1['pid']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        } else {
            if (!DbSet::chkField($this->parent_tbname, 'sort')) {
                return;
            }
            if (!DbSet::chkField($this->parent_tbname, 'pid')) {
                return;
            }
            $row1 = DB::getone("select id,sort,pid from @pf_{$this->parent_tbname} where id=?", array($id));
            if ($row1 != NULL) {
                $row2 = DB::getone("select id,sort from @pf_{$this->parent_tbname} where sort>? and pid=? order by sort asc limit 0,1", array($row1['sort'], $row1['pid']));
                if ($row2 != NULL) {
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row2['sort']), $row1['id']);
                    DB::update('@pf_' . $this->parent_tbname, array('sort' => $row1['sort']), $row2['id']);
                }
            }
        }
    }

    public function editsort($id, $sort) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, 'sort')) {
                return;
            }
            DB::update('@pf_' . $this->tbname, array('sort' => $sort), $id);
        } else {
            if (!DbSet::chkField($this->parent_tbname, 'sort')) {
                return;
            }
            DB::update('@pf_' . $this->parent_tbname, array('sort' => $sort), $id);
        }
    }

    public function setON($id, $filed) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, $filed)) {
                return;
            }
            DB::update('@pf_' . $this->tbname, array($filed => 1), $id);
        } else {
            DB::update(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), array($filed => 1), $id);
        }
    }

    public function updateFiled($id, $filed, $val) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, $filed)) {
                return;
            }
            DB::update('@pf_' . $this->tbname, array($filed => $val), $id);
        } else {
            DB::update(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), array($filed => $val), $id);
        }
    }

    public function setOFF($id, $filed) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, $filed)) {
                return;
            }
            DB::update('@pf_' . $this->tbname, array($filed => 0), $id);
        } else {
            DB::update(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), array($filed => 0), $id);
        }
    }

    public function setArrON($ids, $filed) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, $filed)) {
                return;
            }
            if (count($ids) == 0) {
                return;
            }
            DB::update('@pf_' . $this->tbname, array($filed => 1), 'id in (' . join(',', $ids) . ')');
        } else {
            DB::update(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), array($filed => 1), 'id in (' . join(',', $ids) . ')');
        }
    }

    public function setArrOFF($ids, $filed) {
        if ($this->type != 2) {
            if (!DbSet::chkField($this->tbname, $filed)) {
                return;
            }
            if (count($ids) == 0) {
                return;
            }
            DB::update('@pf_' . $this->tbname, array($filed => 0), 'id in (' . join(',', $ids) . ')');
        } else {
            DB::update(array("@pf_{$this->parent_tbname}", "@pf_{$this->tbname}"), array($filed => 0), 'id in (' . join(',', $ids) . ')');
        }
    }

    public function getNextSort($field = 'pid', $type = 'int') {
        if ($this->type == 2) {
            if (!DbSet::chkField($this->parent_tbname, 'sort')) {
                return NULL;
            }
            if (DbSet::chkField($this->parent_tbname, $field)) {
                if ($type == 'int') {
                    $pid = empty($_REQUEST[$field]) ? 0 : intval($_REQUEST[$field]);
                } else {
                    $pid = empty($_REQUEST[$field]) ? '' : $_REQUEST[$field];
                }
                list($sort) = DB::getone('select (ifnull(max(sort),0)+10) as mysort from @pf_' . $this->parent_tbname . ' where `' . $field . '`=?', array($pid), PDO::FETCH_NUM);
                return $sort;
            } else {
                list($sort) = DB::getone('select (ifnull(max(sort),0)+10) as mysort from @pf_' . $this->parent_tbname, array(), PDO::FETCH_NUM);
                return $sort;
            }
        }

        if (!DbSet::chkField($this->tbname, 'sort')) {
            return NULL;
        }

        if (DbSet::chkField($this->tbname, $field)) {
            if ($type == 'int') {
                $pid = empty($_REQUEST[$field]) ? 0 : intval($_REQUEST[$field]);
            } else {
                $pid = empty($_REQUEST[$field]) ? '' : $_REQUEST[$field];
            }
            list($sort) = DB::getone('select (ifnull(max(sort),0)+10) as mysort from @pf_' . $this->tbname . ' where `' . $field . '`=?', array($pid), PDO::FETCH_NUM);
            return $sort;
        } else {
            list($sort) = DB::getone('select (ifnull(max(sort),0)+10) as mysort from @pf_' . $this->tbname, array(), PDO::FETCH_NUM);
            return $sort;
        }
    }

}
