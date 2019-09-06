<?php

class WithdrawsLogController extends SmcmsController{

    public function detailAction(){
        $log = DB::getrow('@pf_withdraws_log', $this->id);
        $user = DB::getrow('@pf_member',$log['user_id']);
        $this->assign(compact('log','user'));
        $this->display('withdraws_log_show.tpl');
    }
}