<?php

require 'include.inc.php';
import('service.tenpay.lib.Tenpay');
Config::load('pay');

class SendController extends WebController {

    function indexAction() {
        $this->islogin();
        if (intval(C('tenpay_open')) != 1) {
            $this->error("财付通在线接口尚未开启或配置！");
        }
        //登记订单=====================
        $v_amount = isset($_POST['amount']) ? floatval(trim($_POST['amount'])) : 0;
        if ($v_amount <= 0) {
            $this->error("充值金额过小，不能进行充值！");
        }
        $v_rcvname = isset($_POST['rcvname']) ? trim($_POST['rcvname']) : '';
        $v_rcvemail = isset($_POST['email']) ? trim($_POST['email']) : '';
        $v_rcvmobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
        if (!preg_match('/^([a-zA-Z0-9]+[-_.])*[a-zA-Z0-9]+@([a-zA-Z0-9]+-)*[a-zA-Z0-9]+(\.[a-zA-Z]{2,4})+$/', $v_rcvemail)) {
            $this->error('邮箱格式不正确！');
        }
        $vals = array();
        $vals['title'] = '在线充值';
        $vals['type'] = 1;
        $vals['ispay'] = 0;
        $vals['money'] = $v_amount;
        $vals['owner'] = $this->userid;
        $vals['paytime'] = DB::sql('now()');
        $vals['rcvname'] = $v_rcvname;
        $vals['mobile'] = $v_rcvmobile;
        $vals['email'] = $v_rcvemail;
        $vals['paybank'] = '财付通支付';
        DB::insert('@pf_recharge', $vals);
        $id = DB::lastId();
        $row = DB::getone('select owner from @pf_recharge where id=?', array($id));
        if ($row == NULL || intval($row['owner']) != $this->userid) {
            $this->error('支付订单生成错误，请重试！');
        }
        $v_oid = str_pad($id, 8, '0', STR_PAD_LEFT);
        DB::update('@pf_recharge', array('oid' => $v_oid), $id);
        //=======================
        $tenpay = new Tenpay(C('tenpay_partner'), C('tenpay_key'), C('pay_host') . '/service/tenpay/return.php', C('pay_host') . '/service/tenpay/notify.php');
        $tenpay->send($v_oid, '在线充值', '会员在线充值', $v_amount);
    }

}
APP::SimpleRun();