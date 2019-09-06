<?php

class DbSet {

    //存在返回真，不存在返回假
    public static function chkField($table, $name) {
        $row = DB::getlist('describe @pf_' . $table . ' `' . $name . '`', array(), PDO::FETCH_COLUMN);
        return $row != null;
    }

    //添加字段信息
    public static function addField($table, $name, $type = 'longtext', $len = 0, $def = 'NULL', $comment = '') {
        $scomment = $comment == '' ? '' : ' COMMENT \'' . str_replace("'", '', $comment) . '\'';
        if ($type == 'varchar' || $type == 'int') {
            $sql = 'alter table @pf_' . $table . ' add `' . $name . '` ' . $type . '(' . $len . ') DEFAULT ' . $def . $scomment . ';';
        } elseif ($type == 'decimal') {
            $sql = 'alter table @pf_' . $table . ' add `' . $name . '` ' . $type . '(' . $len . ',2) DEFAULT ' . $def . $scomment . ';';
        } else {
            $sql = 'alter table @pf_' . $table . ' add `' . $name . '` ' . $type . ' DEFAULT ' . $def . $scomment . ';';
        }
        DB::exec($sql);
    }

    //更新字段信息
    public static function changeField($table, $oldname, $newname, $type = 'longtext', $len = 0, $def = 'NULL', $comment = '') {
        $scomment = $comment == '' ? '' : ' COMMENT \'' . str_replace("'", '', $comment) . '\'';
        if ($type == 'varchar' || $type == 'int') {
            $sql = 'alter table @pf_' . $table . ' change `' . $oldname . '` `' . $newname . '` ' . $type . '(' . $len . ') DEFAULT ' . $def . $scomment . ';';
        } elseif ($type == 'decimal') {
            $sql = 'alter table @pf_' . $table . ' change `' . $oldname . '` `' . $newname . '` ' . $type . '(' . $len . ',2) DEFAULT ' . $def . $scomment . ';';
        } else {
            $sql = 'alter table @pf_' . $table . ' change `' . $oldname . '` `' . $newname . '` ' . $type . ' DEFAULT ' . $def . $scomment . ';';
        }
        DB::exec($sql);
    }

    //修改字段信息
    public static function modifyField($table, $name, $type = 'longtext', $len = 0, $def = 'NULL', $comment = '') {
        $scomment = $comment == '' ? '' : ' COMMENT \'' . str_replace("'", '', $comment) . '\'';
        if ($type == 'varchar' || $type == 'int') {
            $sql = 'alter table @pf_' . $table . ' modify `' . $name . '` ' . $type . '(' . $len . ') DEFAULT ' . $def . $scomment . ';';
        } elseif ($type == 'decimal') {
            $sql = 'alter table @pf_' . $table . ' modify `' . $name . '` ' . $type . '(' . $len . ',2) DEFAULT ' . $def . $scomment . ';';
        } else {
            $sql = 'alter table @pf_' . $table . ' modify `' . $name . '` ' . $type . ' DEFAULT ' . $def . $scomment . ';';
        }
        DB::exec($sql);
    }

    //检查表是否存在
    public static function existsTable($table) {
        return DB::getone('show tables like \'@pf_' . $table . '\';', array(), PDO::FETCH_COLUMN) != NULL;
    }

    //删除字段
    public static function dropField($table, $name) {
        if (self::chkField($table, $name)) {
            $sql = 'alter table @pf_' . $table . ' drop `' . $name . '`;';
            DB::exec($sql);
        }
    }

    private static function getDefault(&$field) {
        $def = 'NULL';
        if ($field['fieldtype'] == 'int' || $field['fieldtype'] == 'float' || $field['fieldtype'] == 'decimal' || $field['fieldtype'] == 'double') {
            $def = '0';
        }
        return $def;
    }

    //添加分字段保存--
    private static function addSplitField($table, &$field, &$error = '') {
        $names = empty($field['names']) ? array() : json_decode($field['names'], TRUE);
        if ($field['type'] == 'checkgroup') {
            $options = empty($field['options']) ? array() : json_decode($field['options'], TRUE);
            if (count($names) != count($options)) {
                $error = '分配名称数量与选项值不一致！';
                return FALSE;
            }
        }
        foreach ($names as $vname) {
            if (self::chkField($table, $vname)) {
                $error = "{$vname}字段名称已经在表中存在，请使用其他名称！";
                return FALSE;
            }
        }
        foreach ($names as $vname) {
            if ($field['names_fieldtype'] == 'int') {
                self::addField($table, $vname, 'int', 11, 0);
            } else {
                self::addField($table, $vname, 'varchar', 255, 'NULL');
            }
        }
        return TRUE;
    }

    //删除分字段保存--
    private static function delSplitField($table, &$field) {
        $names = empty($field['names']) ? array() : json_decode($field['names'], TRUE);
        foreach ($names as $vname) {
            self::dropField($table, $vname);
        }
    }

    //修改分字段保存--
    private static function editSplitField($table, &$field, &$oldfd, &$error = '') {
        $newnames = empty($field['names']) ? array() : json_decode($field['names'], TRUE);
        $oldnames = empty($oldfd['names']) ? array() : json_decode($oldfd['names'], TRUE);
        if ($field['type'] == 'checkgroup') {
            $options = empty($field['options']) ? array() : json_decode($field['options'], TRUE);
            if (count($newnames) != count($options)) {
                $error = '分配名称数量与选项值不一致！';
                return FALSE;
            }
        }
        $delnames = array_diff($oldnames, $newnames);
        $addnames = array_diff($newnames, $oldnames);
        $editnames = array_intersect($newnames, $oldnames);
        foreach ($delnames as $vname) {
            self::dropField($table, $vname);
        }
        foreach ($addnames as $vname) {
            if (self::chkField($table, $vname)) {
                $error = "{$vname}字段名称已经在表中存在，请使用其他名称！";
                return FALSE;
            }
        }
        foreach ($addnames as $vname) {
            if ($field['names_fieldtype'] == 'int') {
                self::addField($table, $vname, 'int', 11, 0);
            } else {
                self::addField($table, $vname, 'varchar', 255, 'NULL');
            }
        }
        foreach ($editnames as $vname) {
            if ($field['names_fieldtype'] == 'int') {
                self::modifyField($table, $vname, 'int', 11, 0);
            } else {
                self::modifyField($table, $vname, 'varchar', 255, 'NULL');
            }
        }
        return true;
    }

    //根据数据值添加一个字段
    public static function addFieldByVals($table, &$field, &$error = '') {

        $name = $field['name'];
        //修正数据值==
        if ($field['type'] == 'line' || $field['type'] == 'none' || $field['type'] == 'label' || $field['type'] == 'validcode') {
            $field['dbfield'] = 0;
        }
        if ($field['dbfield'] == 0) {
            return TRUE;
        }
        if ($field['type'] != 'linkage' && $field['type'] != 'checkgroup') {
            $field['names_dbfield'] = 0;
        }

        if (self::chkField($table, $name)) {
            $error = "{$name}字段名称已经在表中存在，请使用其他名称！";
            return FALSE;
        }

        try {
            $def = self::getDefault($field);
            self::addField($table, $name, $field['fieldtype'], $field['fieldlen'], $def, $field['label']);
        } catch (Exception $exc) {
            $error = "{$name}插入字段错误！";
            return FALSE;
        }

        //拆分保存===
        if ($field['names_dbfield'] == 0) {
            return TRUE;
        }

        try {
            $rt = self::addSplitField($table, $field, $error);
            if ($rt) {
                self::dropField($table, $field['name']);
            }
            return $rt;
        } catch (Exception $exc) {
            $error = "{$name}字段拆分插入错误！";
            return false;
        }
        return false;
    }

    public static function editFieldNomol($table, &$field, &$oldfd, $def, &$error = '') {
        //全部一致不需要修改
        if ($field['fieldtype'] == $oldfd['fieldtype'] && $field['name'] == $oldfd['name'] && $field['fieldlen'] == $oldfd['fieldlen']) {
            return TRUE;
        }
        //名称一致 只修改其他属性
        if ($field['name'] == $oldfd['name']) {
            self::modifyField($table, $field['name'], $field['fieldtype'], $field['fieldlen'], $def, $field['label']);
            return TRUE;
        }
        //检查要修改的名称是否存在
        if (self::chkField($table, $field['name'])) {
            $error = "{$field['name']}字段名称已经在表中存在，请使用其他名称！";
            return FALSE;
        }
        self::changeField($table, $oldfd['name'], $field['name'], $field['fieldtype'], $field['fieldlen'], $def, $field['label']);
        return TRUE;
    }

    public static function editFieldByVals($table, &$field, &$oldfd, &$error = '') {

        //修正数据值==
        if ($field['type'] == 'line' || $field['type'] == 'none' || $field['type'] == 'validcode') {
            $field['dbfield'] = 0;
            $oldfd['dbfield'] = 0;
            if (self::chkField($table, $oldfd['name'])) {
                self::dropField($table, $oldfd['name']);
            }
        }
        if ($field['dbfield'] == 0) {
            return TRUE;
        }
        if ($field['type'] != 'linkage' && $field['type'] != 'checkgroup') {
            $field['names_dbfield'] = 0;
        }
        $def = self::getDefault($field);
        //如果字段相同类型相同长度相同---
        if ($field['fieldtype'] == $oldfd['fieldtype'] && $field['name'] == $oldfd['name'] && $field['fieldlen'] == $oldfd['fieldlen'] && $field['type'] == $oldfd['type'] && $field['names'] == $oldfd['names'] && $field['names_dbfield'] == $oldfd['names_dbfield'] && $field['names_fieldtype'] == $oldfd['names_fieldtype']) {
            return TRUE;
        }
        //如果旧字段不存在
        if ($oldfd['type'] == 'line' || $oldfd['type'] == 'none' || $oldfd['type'] == 'label' || $oldfd['type'] == 'validcode') {
            if (!self::chkField($table, $field['name'])) {
                self::addFieldByVals($table, $field, $error);
                return TRUE;
            }
        }
        //处理新数据和旧数据都不分字段保存--
        $return = self::editFieldNomol($table, $field, $oldfd, $def, $error);
        if (!$return) {
            return false;
        }
        //旧数据不分字段新数据分字段--
        if ($oldfd['names_dbfield'] == 0 && $field['names_dbfield'] == 1) {
            return self::addSplitField($table, $field, $error);
        }
        //旧数据分字段新数据不分字段--
        if ($oldfd['names_dbfield'] == 1 && $field['names_dbfield'] == 0) {
            self::delSplitField($table, $oldfd);
            return true;
        }
        if ($oldfd['names_dbfield'] == 1 && $field['names_dbfield'] == 1) {
            return self::editSplitField($table, $field, $oldfd, $def, $error);
        }
        return TRUE;
    }

}
