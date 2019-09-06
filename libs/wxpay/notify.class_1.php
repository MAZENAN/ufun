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
        Log::DEBUG("call back:" . json_encode($data));
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

        $_data = $data;


        $_out_trade_no = explode("L", $_data['out_trade_no']);

        Log::DEBUG("_out_trade_no".  json_encode($_out_trade_no));
        

        $row = DB::getone('select * from @pf_order where orderid=?', [$_out_trade_no[0]]);
        if ($row == null) {
            return false;
        }
        
        Log::DEBUG("@pf_order".  json_encode($row));
        


        $data['orderid'] = $_out_trade_no[0];
        $data['id'] = $row['id'];
        $data['title'] = $row['title'];


        if (!preg_match('@^([DP])(\d+)$@', $_out_trade_no[0], $arr)) {
            return false;
        }

        $orderid = $arr[2];
        $type = $arr[1];
        
        
        

        //支付预付款
        if ($type == 'D' && $row['state'] == 0 && $status > 0) {
            $data['type'] = '预付款';
            $vals = array();
            $vals['state'] = 3; //已经支付定金
            $vals['paytime1'] = date('Y-m-d H:i:s');
            $vals['paytype1'] = $paytype;
            $vals['paid'] = $row['paid'] + $money;
            DB::update('@pf_order', $vals, $row['id']);
            msg::sendMsg($row['userid'], '支付成功', '您已成功支付订单' . $row['orderid'] . '，请及时填写资料，以免影响您的使用。');

            return true;
        }
        if ($type == 'P' && $row['state'] == 2 && $status > 0) {
            $data['type'] = '尾款';
            $vals = array();
            $vals['state'] = 3; //已经支付其余
            $vals['paytime2'] = date('Y-m-d H:i:s');
            $vals['paytype2'] = $paytype;
            $vals['paid'] = $row['paid'] + $money;
            DB::update('@pf_order', $vals, $row['id']);
            $fen = intval($vals['paid'] / 10);


            msg::sendMsg($row['userid'], '支付尾款成功', '准备出发！您的订单<a href="/order/addmb/' . $row['id'] . '.html">' . $row['orderid'] . '</a> 订单已经生效，祝您愉快！！');

            Comm::addScore($row['userid'], $row['title'], $fen);
            return true;
        }
        //显示重复支付
        if ($type == 'D' && $row['state'] == 3 && $status > 0) {
            $data['type'] = '预付款';
            return true;
        }
        //显示重复支付
        if ($type == 'P' && $row['state'] == 3 && $status > 0) {
            $data['type'] = '尾款';
            return true;
        }
        return true;
    }

}
