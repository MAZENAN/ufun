<?php

define('DEV_REPORT_CLOSE', TRUE);

class IndexController extends AdmController {

    function indexAction() {
        $this->isLogin();
        Config::load('base');
        $this->doact('left', 'welcome', 'logout');
        $rows = DB::getlist('select * from @pf_sysmenu where pid=0 and allow=1 order by sort asc');
        $this->assign('rows', $rows);
        $adm = DB::getone('select * from @pf_manage where id=?', array($this->AdmID));
        $this->assign('adm', $adm);
        $this->display('index.tpl');
    }

    function leftAjaxAction() {
        $mid = IGet('mid');
        if ($mid == 0) {
            $rows = DB::getlist('select id,title,`show` from @pf_sysmenu where pid=0 and allow=1 order by sort asc');
            foreach ($rows as $key => $row) {
                $rows[$key]['item'] = DB::getlist('select title,url from @pf_sysmenu where pid=? and allow=1 order by sort asc', array($row['id']));
            }
        } else if ($mid == 38) {
            $rows = [];
            $item = DB::getlist('select id, name as title from @pf_singlepage_group order by sort asc');
            foreach ($item as $it) {
                $it['show'] = 1;
                $it['item'] = DB::getlist('select id,title,`key` from @pf_singlepage where `group`=? order by sort asc', array($it['id']));
                foreach ($it['item'] as &$xrs) {
                    $xrs['url'] = 'single_page/edit?key=' . $xrs['key'];
                }
                $rows[] = $it;
            }
        } else {
            $rows = DB::getlist('select id,title,`show` from @pf_sysmenu where pid=? and allow=1 order by sort asc', array($mid));
            foreach ($rows as $key => $row) {
                $rows[$key]['item'] = DB::getlist('select title,url from @pf_sysmenu where pid=? and allow=1 order by sort asc', array($row['id']));
            }
        }


        $this->assign('items', $rows);
        $this->display('left.tpl');
    }

    function welcomeAction() {
        $row = DB::getone('select * from @pf_manage where id=?', array($this->AdmID));
        $row['time'] = date('Y-m-d H:i:s');
        //弹出系统提示,by: lsy,2016-12-28
        $is_settle=0;
        if($row['type']==6){//财务
           $count_row = DB::getone('select count(*) as b from @pf_order where settle_state in (2,6)');
              if ($count_row['b']>=1){
                $is_settle=1;
            }
        }
        elseif($row['type']==13){//高级销售
           $count_row = DB::getone('select count(*) as b from @pf_order where settle_state=1'); 
              if ($count_row['b']>=1){
                $is_settle=1;
            }
        }
        $this->assign('is_settle', $is_settle);
        $this->assign('row', $row);
        $this->display('welcome.tpl');
    }

    function logoutAction() {
        $this->setLogout();
    }

}
