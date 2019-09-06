<?php

require 'include.inc.php';
require_once("alipay.config.php");
import('service.alipay.lib.AlipayNotify');
Config::load('pay');
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 * ************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

class ReturnController extends WebController {

    function indexAction() {
        if (intval(C('alipay_open')) != 1) {
            $this->error("支付宝在线接口尚未开启或配置！");
        }
        global $alipay_config;
        $alipay_config['partner'] = C('alipay_partner');
        $alipay_config['key'] = C('alipay_key');
        $alipay_config['email'] = C('alipay_email');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if (!$verify_result) {
            $this->display('receive_err.tpl');
            exit;
        }
        //验证成功
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //请在这里加上商户的业务逻辑程序代码
        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
        //商户订单号
        $out_trade_no = $_GET['out_trade_no'];
        //支付宝交易号
        $trade_status = $_GET['trade_status'];
        $total_fee = isset($_GET['total_fee']) ? floatval($_GET['total_fee']) : 0;
        $row = DB::getone('select * from @pf_recharge where oid=?', array($out_trade_no));
        $m_money = $total_fee;
        $m_ispay = intval($row['ispay']);
        $m_uid = $row['owner'];
        $m_id = $row['id'];
        $user = DB::getone('select money,username from @pf_member where id=?', array($m_uid));
        $dat = array();
        $dat['oid'] = $out_trade_no;
        $dat['paybank'] = '支付宝支付';
        $dat['money'] = $m_money;
        $dat['user'] = $user['username'];
        $dat['payerr'] = 0;
        $dat['usmoney'] = $user['money'];
        if ($m_ispay == 0 && ( $trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS')) {
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

        //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }

}

APP::SimpleRun();
