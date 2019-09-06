<?php

class GroupController extends SmcmsController {

    public function nodeGetAction() {
        $rows = DB::getlist("select * from @pf_node where pid=? order by sort asc", array(0));
        $arr = array();
        $group = DB::getlist('select node from @pf_group_node where `group`=?', array(IGet('group')));
        foreach ($rows as $key => $value) {
            $value['title'] = '<b>' . $value['title'] . '</b>';
            $value['no'] = 1;
            $value['create'] = 1;
            $rowss = DB::getlist("select * from @pf_node where pid=? order by sort asc", array($value['id']));
            foreach ($rowss as $k => $v) {
                $v['checked'] = 0;
                foreach ($group as $ke => $val) {
                    if ($val['node'] === $v['id']) {
                        $v['checked'] = 1;
                    }
                }
                $v['create'] = 0;
                $v['no'] = 0;
                $value['child'][] = $v;
            }
            $arr[] = $value;
        }
        $this->assign("rows", $arr);
        $this->assign("sch", $this->sch);
        $this->display("node.tpl");
    }

    public function nodePostAction() {
        DB::delete('@pf_group_node', '`group`=?', array(IPost("group")));
        if ($_POST['node']) {
            foreach ($_POST['node'] as $value) {
                DB::insert('@pf_group_node', array('group' => IPost("group"), 'node' => intval($value)));
            }
        }
        $this->success("节点修改成功",__SELF__);
    }

}
