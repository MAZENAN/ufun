<?php

class NodeController extends SmcmsController {
    /**
     * 2016-8-17 ysq修改 $getid,$id
     */
    public function indexAction() {
        $this->doact("*");
        $getid = SGet('id');
        if($getid > 0){
            $id = $getid;
            $rows = DB::getlist("select * from @pf_node where pid=? and id = ? order by sort asc",array(0,$id));
        }else{
            $rows = DB::getlist("select * from @pf_node where pid=? order by sort asc",array(0));
        }//ysq
        
        $arr = array();
        foreach ($rows as $key => $value) {
            $value['title'] = '<b>' . $value['title'] . '</b>';
            $value['no'] = 1;
            $value['create'] = 1;
            $arr[] = $value;
            $rowss = DB::getlist("select * from @pf_node where pid=? order by sort asc", array($value['id']));
            foreach ($rowss as $k => $v) {
                $v['title'] = '+--- <span class="blu">' . $v['title'] . '</span>';
                $v['create'] = 0;
                $v['no'] = 0;
                $arr[] = $v;
            }
        }
        $this->assign('id',$id);
        $this->assign("rows", $arr);
        $this->assign("sch", $this->sch);
        $this->displayList();
    }

}
