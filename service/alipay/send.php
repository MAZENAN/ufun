<?php

require 'include.inc.php';
require_once("alipay.config.php");
import('service.alipay.lib.AlipaySubmit');
Config::load('pay');

class SendController extends WebController {

    function indexAction() {
        $this->islogin();
        if (intval(C('alipay_open')) != 1) {
            $this->error("支付宝在线接口尚未开启或配置！");
        }
        global $alipay_config;
        $alipay_config['partner'] = C('alipay_partner');
        $alipay_config['key'] = C('alipay_key');
        $alipay_config['email'] = C('alipay_email');
        echo '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>支付宝即时到账交易接口接口</title></head>';
        /*         *
         * 功能：即时到账交易接口接入页
         * 版本：3.3
         * 修改日期：2012-07-23
         * 说明：
         * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
         * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

         * ************************注意*************************
         * 如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
         * 1、商户服务中心（https://b.alipay.com/support/helperApply.htm?action=consultationApply），提交申请集成协助，我们会有专业的技术工程师主动联系您协助解决
         * 2、商户帮助中心（http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9）
         * 3、支付宝论坛（http://club.alipay.com/read-htm-tid-8681712.html）
         * 如果不想使用扩展功能请把扩展功能参数赋空值。
         */


        /*         * ************************请求参数************************* */
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
        $vals['paybank'] = '支付宝支付';
        DB::insert('@pf_recharge', $vals);
        $id = DB::lastId();
        $row = DB::getone('select owner from @pf_recharge where id=?', array($id));
        if ($row == NULL || intval($row['owner']) != $this->userid) {
            $this->error('支付订单生成错误，请重试！');
        }
        $v_oid = str_pad($id, 8, '0', STR_PAD_LEFT);
        DB::update('@pf_recharge', array('oid' => $v_oid), $id);
        //=======================
        //==========================================================
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = C('pay_host') . '/service/alipay/return.php'; #"http://www.ehisp.com/extends/alipay/notify.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = C('pay_host') . '/service/alipay/return.php'; #"http://www.ehisp.com/extends/alipay/return.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = $alipay_config['email'];
        //必填
        //商户订单号
        $out_trade_no = $v_oid;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        // $total_fee = 0.01;
        $total_fee = $v_amount;

        $subject = '账户充值';
        //必填
        //订单描述


        $body = "账户充值--用户名：{$v_rcvname}，用户邮箱：{$v_rcvemail}，用户手机：{$v_rcvmobile}";
        //商品展示地址
        $show_url = C('pay_host');
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /*         * ********************************************************* */

//构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type" => $payment_type,
            "notify_url" => $notify_url,
            "return_url" => $return_url,
            "seller_email" => $seller_email,
            "out_trade_no" => $out_trade_no,
            "subject" => $subject,
            "total_fee" => $total_fee,
            "body" => $body,
            "show_url" => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip" => $exter_invoke_ip,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );

//建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        echo $html_text;

        echo '</body></html>';
    }

}

APP::SimpleRun();
