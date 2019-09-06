<?php

require 'include.inc.php';
import('service.tenpay.lib.Tenpay');
Config::load('pay');

class ReturnController extends WebController {

    function indexAction() {
        if (intval(C('tenpay_open')) != 1) {
             $this->error("财付通在线接口尚未开启或配置！");
        }
        $tenpay = new Tenpay(C('tenpay_partner'), C('tenpay_key'), C('pay_host') . '/service/tenpay/return.php', C('pay_host') . '/service/tenpay/notify.php');
        $isok = $tenpay->verify();
        $vals = $tenpay->get_result();
        if (!$isok) {
            $this->display('receive_err.tpl');
            exit;
        }
        $row = DB::getone('select * from @pf_recharge where oid=?', array($vals['oid']));
        $m_money = $vals['total'];
        $m_ispay = intval($row['ispay']);
        $m_uid = $row['owner'];
        $m_id = $row['id'];
        $user = DB::getone('select money,username from @pf_member where id=?', array($m_uid));
        $dat = array();
        $dat['oid'] = $vals['oid'];
        $dat['paybank'] = '财付通支付';
        $dat['money'] = $m_money;
        $dat['user'] = $user['username'];
        $dat['payerr'] = 0;
        $dat['usmoney'] = $user['money'];
        if ($m_ispay == 0) {
            $vals = array();
            $vals['ispay'] = 1;
            $vals['money'] = $m_money;
            $vals['paytime'] = DB::sql('now()');
            $uvals = array('money' => floatval($user['money']) + $m_money);
            DB::update('@pf_recharge', $vals, $m_id);
            DB::update('@pf_member', $uvals, $m_uid);
            Record::addorder($m_uid, $m_id, '用户在线充值', $m_money, 'recharge', 10);
            $dat['usmoney'] = $uvals['money'];
        }
        $this->assign('dat', $dat);
        $this->display('receive_ok.tpl');
    }

}
APP::SimpleRun();
