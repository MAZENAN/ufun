<?php

class Notify extends WxPayNotify {

    //查询订单
    public function Queryorder($transaction_id) {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        Log::DEBUG("query:" . json_encode($result));
        if (array_key_exists("return_code", $result) && array_key_exists("result_code", $result) && $result["return_code"] == "SUCCESS" && $result["result_code"] == "SUCCESS") {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg,$paytype = '微信') {
        $notfiyOutput = array();
        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            return false;
        }


        $_out_trade_no = explode("L", $data['out_trade_no']);

        $_cash_fee = intval($data['cash_fee'] / 100);

        if (!preg_match('@^([DP])(\d+)$@', $_out_trade_no[0], $arr)) {
            return false;
        }

        $orderid = $arr[2];
        $type = $arr[1];

        $status = $data['return_code'];

        $row = DB::getone('select * from @pf_order where orderid=?', [$orderid]);
        if ($row == null) {
            return false;
        }

        //支付预付款
        if ($type == 'D' && $row['state'] == 0 && $status == 'SUCCESS') {
            $data['type'] = '预付款';
            $vals = array();
            $vals['state'] = 3; //已经支付定金
            $vals['paytime1'] = date('Y-m-d H:i:s');
            $vals['paytype1'] = $paytype;
            $vals['paid'] = $row['paid'] + $_cash_fee;
            DB::update('@pf_order', $vals, $row['id']);
            msg::sendMsg($row['userid'], '支付预付款成功', '您已成功支付订单' . $row['orderid'] . ' 预定金，请及时填写资料，以免影响您的使用。！');

            $_user = DB::getone('select * from @pf_member where id=?', array($row['userid']));
            if ($_user['email'] != "") {
                MsgContent::sendPay($CFG, $_user['email'], $row['deposit'], $row['title']);
            }

            if ($_user['mobile'] != "") {
                $rs = SMS::send($_user['mobile'], '【营天下】您在营天下网站支付的' . $row['deposit'] . '元预定金已经收到，我们会尽快与您联系确认报名相关事项。如有问题请拨打400‐878‐3633。');
            }




            return true;
        }
        if ($type == 'P' && $row['state'] == 2 && $status == 'SUCCESS') {
            $data['type'] = '尾款';
            $vals = array();
            $vals['state'] = 3; //已经支付其余
            $vals['paytime2'] = date('Y-m-d H:i:s');
            $vals['paytype2'] = $paytype;
            $vals['paid'] = $row['paid'] + $_cash_fee;
            DB::update('@pf_order', $vals, $row['id']);
            $fen = intval($vals['paid'] / 10);
            msg::sendMsg($row['userid'], '支付尾款成功', '注意事项：<br/> ------以下为正式内容------<br/><br/>亲爱的家长和小朋友们！祝福你们即将开启一段愉快的夏令营时光。<br/>“营天下”为夏令营招募平台，报名成功后将由活动主办方与您联系，通知您活动的具体细节和提前需要做的准备。如果活动主办方在48小时内没有与您联系，请拨打我们的客服热线400-878-3633。');

            $_user = DB::getone('select * from @pf_member where id=?', array($row['userid']));
            if ($_user['email'] != "") {
                MsgContent::send($CFG, $_user['email'], $row['retainage'], $row['title']);
            }

            if ($_user['mobile'] != "") {
                $rs = SMS::send($_user['mobile'], '【营天下】您在营天下网站支付的' . $row['retainage'] . '元尾款已经收到，我们会尽快与您联系告知出发前的准备事项。如有问题请拨打400‐878‐3633。');
            }


            Comm::addScore($row['userid'], $row['title'], $fen);
            return true;
        }

        return true;
    }

}
