<?php

class SysmenuController extends SmcmsController {

    public function indexAction() {
        $this->doact('add', 'edit', 'delete', 'upsortbypid', 'dnsortbypid', 'editsort', 'selected_delete', 'seton_allow', 'setoff_allow', 'selectedon_allow', 'selectedoff_allow');
        $brows = array();
        $getid = SGet('id');
        if($getid > 0){
            $id = $getid;
            $rows = DB::getlist('select * from @pf_sysmenu A where pid=? and id = ? order by sort asc',[0,$id]);
        }else{
            $rows = DB::getlist('select * from @pf_sysmenu A where pid=0 order by sort asc');
        }
        foreach ($rows as $row) {
            $title = $row['title'];
            $row['title'] = '<b>' . $row['title'] . '</b>';
            $row['create'] = 1;
            $brows[] = $row;
            $temp = DB::getlist('select * from @pf_sysmenu where pid=? order by sort asc', array($row['id']));
            foreach ($temp as $rs) {
                $rs['title'] = '+--- <span class="blu">' . $rs['title'] . '</span>';
                $rs['create'] = 1;
                $brows[] = $rs;
                $tempx = DB::getlist('select * from @pf_sysmenu where pid=? order by sort asc', array($rs['id']));
                foreach ($tempx as $rsx) {
                    $rsx['title'] = '+---+--- ' . $rsx['title'];
                    $rsx['create'] = 0;
                    $brows[] = $rsx;
                }
            }
        }
        $this->assign('id',$id);
        $this->assign('rows', $brows);
        $this->displayList();
    }

    /**
     * @param Model $model
     */
    public function setModel($model) {
        if (IS_GET) {
            $pobts = array();
            $opts2 = DB::getlist('select `id`,title from @pf_sysmenu where id<>? and pid=0 order by sort asc', array($this->id), PDO::FETCH_NUM);
            foreach ($opts2 as $opt) {
                $pobts[] = $opt;
                $temp = DB::getlist('select `id`,title from @pf_sysmenu where id<>? and pid=? order by sort asc', array($this->id, $opt[0]), PDO::FETCH_NUM);
                foreach ($temp as $mopt) {
                    $pobts[] = array($mopt[0], '+--- ' . $mopt[1]);
                }
            }

            $model->Fields['pid']->options = array_merge($model->Fields['pid']->options, $pobts);
            $pid = empty($_GET['pid']) ? 0 : intval($_GET['pid']);
            $model->Fields['pid']->value = $pid;
            if (Route::get('act') == 'add') {
                list($model->Fields['sort']->default) = DB::getone('select (ifnull(max(sort),0)+10) as mysort from @pf_sysmenu where pid=?', array($pid), PDO::FETCH_NUM);
            }
        }
    }

}
