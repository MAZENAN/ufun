<?php

require 'include.inc.php';
import('service.tenpay.lib.Tenpay');
Config::load('pay');

class NotifyController extends WebController {

    function indexAction() {
        if (C('tenpay_open') != 1) {
            die('fail');
        }
        $tenpay = new Tenpay(C('tenpay_partner'), C('tenpay_key'), C('pay_host') . '/extends/tenpay/return.php', C('pay_host') . '/extends/tenpay/notify.php');
        $isok = $tenpay->verify();
        if (!$isok) {
            die('fail');
            exit;
        }
        $vals = $tenpay->get_result();
        $row = DB::getone('select * from @pf_recharge where oid=?', array($vals['oid']));
        $m_money = $vals['total'];
        $m_ispay = intval($row['ispay']);
        $m_uid = $row['owner'];
        $m_id = $row['id'];
        $user = DB::getone('select money,username from @pf_member where id=?', array($m_uid));
        if ($m_ispay == 0) {
            $vals = array();
            $vals['ispay'] = 1;
            $vals['money'] = $m_money;
            $vals['paytime'] = DB::sql('now()');
            $uvals = array('money' => floatval($user['money']) + $m_money);
            DB::update('@pf_recharge', $vals, $m_id);
            DB::update('@pf_member', $uvals, $m_uid);
            Record::addorder($m_uid, $m_id, '用户在线充值', $m_money, 'recharge', 10);
        }
        die('success');
    }

}

APP::SimpleRun();
