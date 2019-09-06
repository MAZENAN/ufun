<?php

class OrderController extends SmcmsController{

    public function detailAction(){
        $order = DB::getrow('@pf_order', $this->id);
        $goods = DB::getlist('SELECT * FROM @pf_order_goods WHERE order_id=?',[$this->id]);

        $this->assign(compact('order','goods'));
        $this->display('order_show.tpl');
    }
}