<?php

abstract class SmcmsextController extends SmcmsController {

    //列表页面
    public function indexAction() {
        $this->doact('*');
        $model = Model($this->ModelName, 0, false);

        $fields = DB::getFields("@pf_{$model->tbname}");
        $sqlcoms = 'A.*';
        foreach ($fields as $field) {
            if ($field != 'id') {
                $sqlcoms.= ',B.' . $field;
            }
        }

        $tbname = "@pf_{$model->parent_tbname} A,@pf_{$model->tbname} B";
        $select = new Select($tbname);
        $select->find($sqlcoms);
        $select->where('and A.id=B.id');
        $ret = $this->listData($select);

        if (!empty($this->_search_temp)) {
            $searchdata = json_decode($this->_search_temp, TRUE);
            if (gettype($searchdata) == 'array' && count($searchdata) > 0) {
                $schmodel = $this->copyModel($model, $searchdata);
                foreach ($searchdata as $rs) {
                    $name = $rs['name'];
                    $boxname = empty($rs['boxname']) ? $name : $rs['boxname'];
                    if ($rs['type'] != 'linkage') {
                        if (in_array($name, $fields)) {
                            $fname = 'B.' . $name;
                        } else {
                            $fname = 'A.' . $name;
                        }
                        $this->addsearch($select, $rs['schtp'], $fname, $boxname);
                    } else {
                        $field = $schmodel->getfield($name);
                        if ($field !== null) {
                            $names = $field->names;
                            if (gettype($names) == 'array') {
                                foreach ($names as $fid) {
                                    if (in_array($name, $fields)) {
                                        $fname = 'B.' . $fid;
                                    } else {
                                        $fname = 'A.' . $fid;
                                    }
                                    $this->addsearch($select, $rs['schtp'], $fname, $fid);
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($ret['pagelist']) {
            $list = $select->getPagelist($ret['size'], $ret['pagekey'], $ret['count'], $ret['only_count']);
            $rows = $list->getlist();
            $this->assign('bar', $list->getinfo());
        } else {
            $rows = $select->getlist();
        }
        $this->assign('rows', $rows);
        $this->assign('sch', $this->sch);
        $this->displayList();
    }

}
