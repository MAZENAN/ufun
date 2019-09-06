<?php

class EarnOrderController extends SmcmsController{

    public function detailAction(){
        $order = DB::getrow('@pf_earn_order', $this->id);
        $this->assign('order',$order);
        $this->display('earn_order_show.tpl');
    }
}