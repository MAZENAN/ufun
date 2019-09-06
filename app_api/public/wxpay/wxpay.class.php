<?php
require_once dirname(__FILE__)."/lib/WxPay.Data.php";
require_once dirname(__FILE__)."/lib/WxPay.Api.php";

class Wxpay {
    public function send($openId,$v_oid, $v_amount, $subject, &$error) {

        if ($openId) {
            //print_r($openId);die();

            $input = new WxPayUnifiedOrder();
            $input->SetBody($subject);
            $input->SetOut_trade_no($v_oid);
//            $input->SetTotal_fee(intval($v_amount*100));
            $input->SetTotal_fee(($v_amount*100));
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetNotify_url("http://" . $_SERVER['HTTP_HOST'] . "/app_api/public/wxpay_notify.php");
            $input->SetTrade_type("JSAPI");
            $input->SetSign_type("MD5");
            $input->SetOpenid($openId);
            $order = WxPayApi::unifiedOrder($input);
//var_dump($order);die;
            return $order;
        } else {
            return false;
        }
    }

    public function  sign($array){
        
        if (is_array($array)) {
            $inputObj = new WxPayUnifiedOrder();

            foreach ($array as $key => $value) {
                $inputObj->SetData($key,$value);
            }
            //签名
            return $inputObj->SetSign();
        }else{
            return false;
        }
        
    }

    /**
     * 微信退款
     * @param  string   $order_id 	订单ID
     * @return 成功时返回(array类型)，其他抛异常
     */
    function wxRefund($order) {
        $merchid = WxPayConfig::MCHID;

        if (!$order) {
            throw new Exception('发起退款失败!');
        }

        $str = substr($order['order_id'],0,2);

        if ($str=='SJ'){
            if ($order['pid']==0){
                $trade_no = $order['order_id'];
                $trans_id = $order['trans_id'];
                $refund_no = $order['id'];
                $total_fee = $order['need_pay'] * 100;
                $refund_fee = $order['paid'] * 100;
            }else{
                $parent_order_row = DB::getone('SELECT id,order_id,trans_id,goods_amount FROM @pf_order WHERE id=?',[$order['pid']]);
                if (!$parent_order_row){
                    throw new Exception('发起退款失败!');
                }
                $trade_no = $parent_order_row['order_id'];
                $trans_id = $parent_order_row['trans_id'];
                $refund_no = $parent_order_row['id'];
                $total_fee = $parent_order_row['goods_amount'] * 100;
                $refund_fee = $order['paid'] * 100;
            }
        }else{
            $trade_no = $order['order_id'];
            $trans_id = $order['trans_id'];
            $refund_no = $order['id'];
            $total_fee = $order['goods_amount'] * 100;
            $refund_fee = $order['paid'] * 100;
        }

        $input = new WxPayRefund();
        $input->SetOut_trade_no($trade_no);            //自己的订单号
        $input->SetTransaction_id($trans_id);    //微信官方生成的订单流水号，在支付成功中有返回
        $input->SetOut_refund_no($refund_no);            //订单编号
        $input->SetTotal_fee($total_fee);            //订单标价金额，单位为分
        $input->SetRefund_fee($refund_fee);            //退款总金额，订单总金额，单位为分，只能为整数
        $input->SetOp_user_id($merchid);
        $input->GetNonce_str();
        $input->SetSign();
        $result = WxPayApi::refund($input);    //退款操作

        // 这句file_put_contents是用来查看服务器返回的退款结果 测试完可以删除了
        //file_put_contents(APP_ROOT.'/Api/wxpay/logs/log3.txt',arrayToXml($result),FILE_APPEND);
        return $result;
    }
        /**
	 * 
	 * 企业付款到零钱，openId、amount、desc必填
	 * @param String $openId 用户openId
	 * @param int $amount    企业付款金额，单位为元
	 * @param String $desc   企业付款操作说明信息。必填
	 * @param String $desc   收款用户真实姓名。选填
	 * @throws WxPayException
	 * @return 成功时返回，其他抛异常
	 */
    public static function sendWXpayEnterprisePayment($openId, $amount, $desc, $re_user_name = "",$timeOut = 30)
    {
        if ($openId && $amount && $desc) {
            //print_r($openId);die();
            $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";

            $input = new WxPayEnterprisePayment();
            $input->SetMch_appid(WxPayConfig::APPID);
            $input->SetMchid(WxPayConfig::MCHID);
            $input->SetNonce_str(WxPayApi::getNonceStr());
            $input->SetPartner_trade_no(WxPayConfig::MCHID.date("YmdHis"));
            $input->SetOpenid($openId);
            $input->SetCheck_name('NO_CHECK');
            $input->SetAmount($amount*100);
            $input->SetDesc($desc);
            $input->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']);
//            $input->SetSign_type("MD5");
//            $input->SetDevice_info();
            if (!is_null(re_user_name)) {
            	$input->SetRe_user_name($re_user_name);
            }
           
            //签名
            $input->SetSign();
            $xml = $input->ToXml();

            $response = WxPayApi::postXmlCurl($xml, $url, true, $timeOut);

            $result = WxPayResults::Init($response);
//            var_dump($result);

            return $result;

        } else {
            return false;
        }
    }
    public static function sendWxPayCashBonus($re_openid, $send_name, $total_amount, $total_num, $wishing, $act_name, $remark, $timeOut = 30)
    {
        if ($re_openid) {
            //print_r($openId);die();
            $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";

            $input = new WxPayCashBonus();
            $input->SetNonce_str(WxPayApi::getNonceStr());
            $input->SetMch_billno(WxPayConfig::MCHID.date("YmdHis"));
            $input->SetMch_id(WxPayConfig::MCHID);
            $input->SetWxappid(WxPayConfig::APPID);
            $input->SetSend_name($send_name);
            $input->SetRe_openid($re_openid);
            $input->SetTotal_amount($total_amount);
            $input->SetTotal_num($total_num);
            $input->SetWishing($wishing);
            $input->Setclient_ip($_SERVER['REMOTE_ADDR']);
            $input->SetAct_name($act_name);
            $input->SetRemark($remark);
//            $input->SetScene_id($scene_id);
//            $input->SetRisk_info();
//            $input->SetConsume_mch_id();

            //签名
            $input->SetSign();
            $xml = $input->ToXml();

            $response = WxPayApi::postXmlCurl($xml, $url, true, $timeOut);

            echo $response;
            $result = WxPayResults::Init($response);
            var_dump($response);die;
            return $response;

        } else {
            return false;
        }
    }

}

/**
 *
 * 企业付款下单接口
 * @author widyhu
 *
 */
class WxPayEnterprisePayment extends WxPayDataBase
{
    /**
     *
     * 设置参数
     * @param string $key
     * @param string $value
     */
    public function SetData($key, $value)
    {
        $this->values[$key] = $value;
    }
    /**
     * 设置微信分配的公众账号ID
     * @param string $value
     **/
    public function SetMch_appid($value)
    {
        $this->values['mch_appid'] = $value;
    }
    /**
     * 获取微信分配的公众账号ID的值
     * @return 值
     **/
    public function GetMch_appid()
    {
        return $this->values['mch_appidd'];
    }
    /**
     * 判断微信分配的公众账号ID是否存在
     * @return true 或 false
     **/
    public function IsMch_appidSet()
    {
        return array_key_exists('mch_appid', $this->values);
    }


    /**
     * 设置微信支付分配的商户号
     * @param string $value
     **/
    public function SetMchid($value)
    {
        $this->values['mchid'] = $value;
    }
    /**
     * 获取微信支付分配的商户号的值
     * @return 值
     **/
    public function GetMchid()
    {
        return $this->values['mchid'];
    }
    /**
     * 判断微信支付分配的商户号是否存在
     * @return true 或 false
     **/
    public function IsMchidSet()
    {
        return array_key_exists('mchid', $this->values);
    }


    /**
     * 设置微信支付分配的终端设备号，商户自定义
     * @param string $value
     **/
    public function SetDevice_info($value)
    {
        $this->values['device_info'] = $value;
    }
    /**
     * 获取微信支付分配的终端设备号，商户自定义的值
     * @return 值
     **/
    public function GetDevice_info()
    {
        return $this->values['device_info'];
    }
    /**
     * 判断微信支付分配的终端设备号，商户自定义是否存在
     * @return true 或 false
     **/
    public function IsDevice_infoSet()
    {
        return array_key_exists('device_info', $this->values);
    }


    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetNonce_str($value)
    {
        $this->values['nonce_str'] = $value;
    }
    /**
     * 获取随机字符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetNonce_str()
    {
        return $this->values['nonce_str'];
    }
    /**
     * 判断随机字符串，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsNonce_strSet()
    {
        return array_key_exists('nonce_str', $this->values);
    }

    /**
     * 设置企业付款描述信息
     * @param string $value
     **/
    public function SetDesc($value)
    {
        $this->values['desc'] = $value;
    }
    /**
     * 获取企业付款描述信息的值
     * @return 值
     **/
    public function GetDesc()
    {
        return $this->values['desc'];
    }
    /**
     * 判断企业付款描述信息是否存在
     * @return true 或 false
     **/
    public function IsDescSet()
    {
        return array_key_exists('desc', $this->values);
    }


    /**
     * 设置商户订单号
     * @param string $value
     **/
    public function SetPartner_trade_no($value)
    {
        $this->values['partner_trade_no'] = $value;
    }
    /**
     * 获取商户订单号的值
     * @return 值
     **/
    public function GetPartner_trade_no()
    {
        return $this->values['partner_trade_no'];
    }
    /**
     * 判断商户订单号是否存在
     * @return true 或 false
     **/
    public function IsPartner_trade_noSet()
    {
        return array_key_exists('partner_trade_no', $this->values);
    }


    /**
     * 设置用户openid
     * @param string $value
     **/
    public function SetOpenid($value)
    {
        $this->values['openid'] = $value;
    }
    /**
     * 获取用户openid的值
     * @return 值
     **/
    public function GetOpenid()
    {
        return $this->values['openid'];
    }
    /**
     * 判断用户openid是否存在
     * @return true 或 false
     **/
    public function IsOpenidSet()
    {
        return array_key_exists('openid', $this->values);
    }


    /**
     * 设置校验用户姓名选项
     * @param string $value
     **/
    public function SetCheck_name($value)
    {
        $this->values['check_name'] = $value;
    }
    /**
     * 获取校验用户姓名选项的值
     * @return 值
     **/
    public function GetCheck_name()
    {
        return $this->values['check_name'];
    }
    /**
     * 判断校验用户姓名选项
     * @return true 或 false
     **/
    public function IsCheck_nameSet()
    {
        return array_key_exists('check_name', $this->values);
    }


    /**
     * 设置收款用户姓名
     * @param string $value
     **/
    public function SetRe_user_name($value)
    {
        $this->values['re_user_name'] = $value;
    }
    /**
     * 获取收款用户姓名的值
     * @return 值
     **/
    public function GetRe_user_name()
    {
        return $this->values['re_user_name'];
    }
    /**
     * 判断收款用户姓名是否存在
     * @return true 或 false
     **/
    public function IsRe_user_nameSet()
    {
        return array_key_exists('re_user_name', $this->values);
    }


    /**
     * 设置订单总金额，只能为整数，详见支付金额
     * @param string $value
     **/
    public function SetAmount($value)
    {
        $this->values['amount'] = $value;
    }
    /**
     * 获取订单总金额，只能为整数，详见支付金额的值
     * @return 值
     **/
    public function GetAmount()
    {
        return $this->values['amount'];
    }
    /**
     * 判断订单总金额，只能为整数，详见支付金额是否存在
     * @return true 或 false
     **/
    public function IsAmountSet()
    {
        return array_key_exists('amount', $this->values);
    }

    /**
     * 设置调用接口的机器Ip地址。
     * @param string $value
     **/
    public function SetSpbill_create_ip($value)
    {
        $this->values['spbill_create_ip'] = $value;
    }
    /**
     * 获取调用接口的机器Ip地址的值
     * @return 值
     **/
    public function GetSpbill_create_ip()
    {
        return $this->values['spbill_create_ip'];
    }
    /**
     * 判断调用接口的机器Ip地址是否存在
     * @return true 或 false
     **/
    public function IsSpbill_create_ipSet()
    {
        return array_key_exists('spbill_create_ip', $this->values);
    }

}


/**
 *
 * 现金红包下单接口
 * @author widyhu
 *
 */
class WxPayCashBonus extends WxPayDataBase
{
    /**
     *
     * 设置参数
     * @param string $key
     * @param string $value
     */
    public function SetData($key, $value)
    {
        $this->values[$key] = $value;
    }
    /**
     * 设置微信分配的公众账号ID
     * @param string $value
     **/
    public function SetWxappid($value)
    {
        $this->values['wxappid'] = $value;
    }
    /**
     * 获取微信分配的公众账号ID的值
     * @return 值
     **/
    public function GetWxappid()
    {
        return $this->values['wxappid'];
    }
    /**
     * 判断微信分配的公众账号ID是否存在
     * @return true 或 false
     **/
    public function IsWxappidSet()
    {
        return array_key_exists('wxappid', $this->values);
    }


    /**
     * 设置微信支付分配的商户号
     * @param string $value
     **/
    public function SetMch_id($value)
    {
        $this->values['mch_id'] = $value;
    }
    /**
     * 获取微信支付分配的商户号的值
     * @return 值
     **/
    public function GetMch_id()
    {
        return $this->values['mch_id'];
    }
    /**
     * 判断微信支付分配的商户号是否存在
     * @return true 或 false
     **/
    public function IsMch_idSet()
    {
        return array_key_exists('mch_id', $this->values);
    }


    /**
     * 设置微信支付分配的终端设备号，商户自定义
     * @param string $value
     **/
    public function SetDevice_info($value)
    {
        $this->values['device_info'] = $value;
    }
    /**
     * 获取微信支付分配的终端设备号，商户自定义的值
     * @return 值
     **/
    public function GetDevice_info()
    {
        return $this->values['device_info'];
    }
    /**
     * 判断微信支付分配的终端设备号，商户自定义是否存在
     * @return true 或 false
     **/
    public function IsDevice_infoSet()
    {
        return array_key_exists('device_info', $this->values);
    }


    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     **/
    public function SetNonce_str($value)
    {
        $this->values['nonce_str'] = $value;
    }
    /**
     * 获取随机字符串，不长于32位。推荐随机数生成算法的值
     * @return 值
     **/
    public function GetNonce_str()
    {
        return $this->values['nonce_str'];
    }
    /**
     * 判断随机字符串，不长于32位。推荐随机数生成算法是否存在
     * @return true 或 false
     **/
    public function IsNonce_strSet()
    {
        return array_key_exists('nonce_str', $this->values);
    }

    /**
     * 设置企业付款描述信息
     * @param string $value
     **/
    public function SetDesc($value)
    {
        $this->values['desc'] = $value;
    }
    /**
     * 获取企业付款描述信息的值
     * @return 值
     **/
    public function GetDesc()
    {
        return $this->values['desc'];
    }
    /**
     * 判断企业付款描述信息是否存在
     * @return true 或 false
     **/
    public function IsDescSet()
    {
        return array_key_exists('desc', $this->values);
    }


    /**
     * 设置商户订单号
     * @param string $value
     **/
    public function SetMch_billno($value)
    {
        $this->values['mch_billno'] = $value;
    }
    /**
     * 获取商户订单号的值
     * @return 值
     **/
    public function GetMch_billno()
    {
        return $this->values['mch_billno'];
    }
    /**
     * 判断商户订单号是否存在
     * @return true 或 false
     **/
    public function IsMch_billnov()
    {
        return array_key_exists('mch_billno', $this->values);
    }


    /**
     * 设置用户openid
     * @param string $value
     **/
    public function SetRe_openid($value)
    {
        $this->values['re_openid'] = $value;
    }
    /**
     * 获取用户openid的值
     * @return 值
     **/
    public function GetRe_openid()
    {
        return $this->values['re_openid'];
    }
    /**
     * 判断用户openid是否存在
     * @return true 或 false
     **/
    public function IsRe_openid()
    {
        return array_key_exists('re_openid', $this->values);
    }


    /**
     * 设置红包发送者名称
     * @param string $value
     **/
    public function SetSend_name($value)
    {
        $this->values['send_name'] = $value;
    }
    /**
     * 获取红包发送者名称的值
     * @return 值
     **/
    public function GetSetSend_namee()
    {
        return $this->values['send_name'];
    }
    /**
     * 判断红包发送者名称是否存在
     * @return true 或 false
     **/
    public function IsSetSend_nameSet()
    {
        return array_key_exists('send_name', $this->values);
    }


    /**
     * 设置收款用户姓名
     * @param string $value
     **/
    public function SetRe_user_name($value)
    {
        $this->values['re_user_name'] = $value;
    }
    /**
     * 获取收款用户姓名的值
     * @return 值
     **/
    public function GetRe_user_name()
    {
        return $this->values['re_user_name'];
    }
    /**
     * 判断收款用户姓名是否存在
     * @return true 或 false
     **/
    public function IsRe_user_nameSet()
    {
        return array_key_exists('re_user_name', $this->values);
    }


    /**
     * 设置付款金额
     * @param string $value
     **/
    public function SetTotal_amount($value)
    {
        $this->values['total_amount'] = $value;
    }
    /**
     * 获取付款金额的值
     * @return 值
     **/
    public function GetTotal_amount()
    {
        return $this->values['total_amount'];
    }
    /**
     * 判断付款金额是否存在
     * @return true 或 false
     **/
    public function IsTotal_amountSet()
    {
        return array_key_exists('total_amount', $this->values);
    }

    /**
     * 设置红包发放总人数
     * @param string $value
     **/
    public function SetTotal_num($value)
    {
        $this->values['total_num'] = $value;
    }
    /**
     * 获取红包发放总人数的值
     * @return 值
     **/
    public function GetTotal_num()
    {
        return $this->values['total_num'];
    }
    /**
     * 判断红包发放总人数是否存在
     * @return true 或 false
     **/
    public function IsTotal_numSet()
    {
        return array_key_exists('total_num', $this->values);
    }

    /**
     * 设置红包祝福语
     * @param string $value
     **/
    public function SetWishing($value)
    {
        $this->values['wishing'] = $value;
    }
    /**
     * 获取红包祝福语的值
     * @return 值
     **/
    public function GetWishing()
    {
        return $this->values['wishing'];
    }
    /**
     * 判断红包祝福语是否存在
     * @return true 或 false
     **/
    public function IsWishingSet()
    {
        return array_key_exists('wishing', $this->values);
    }

    /**
     * 设置活动名称
     * @param string $value
     **/
    public function SetAct_name($value)
    {
        $this->values['act_name'] = $value;
    }
    /**
     * 获取活动名称的值
     * @return 值
     **/
    public function GetAct_namem()
    {
        return $this->values['act_name'];
    }
    /**
     * 判断活动名称是否存在
     * @return true 或 false
     **/
    public function IsAct_nameSet()
    {
        return array_key_exists('act_name', $this->values);
    }

    /**
     * 设置备注
     * @param string $value
     **/
    public function SetRemark($value)
    {
        $this->values['remark'] = $value;
    }
    /**
     * 获取备注的值
     * @return 值
     **/
    public function GetRemark()
    {
        return $this->values['remark'];
    }
    /**
     * 判断备注是否存在
     * @return true 或 false
     **/
    public function IsRemarkSet()
    {
        return array_key_exists('remark', $this->values);
    }

    /**
     * 设置调用接口的机器Ip地址。
     * @param string $value
     **/
    public function Setclient_ip($value)
    {
        $this->values['client_ip'] = $value;
    }
    /**
     * 获取调用接口的机器Ip地址的值
     * @return 值
     **/
    public function Getclient_ip()
    {
        return $this->values['client_ip'];
    }
    /**
     * 判断调用接口的机器Ip地址是否存在
     * @return true 或 false
     **/
    public function Isclient_ipSet()
    {
        return array_key_exists('client_ip', $this->values);
    }

    /**
     * 设置场景id
     * @param string $value
     **/
    public function SetScene_id($value)
    {
        $this->values['scene_id'] = $value;
    }
    /**
     * 获取场景id的值
     * @return 值
     **/
    public function GetScene_id()
    {
        return $this->values['scene_id'];
    }
    /**
     * 判断场景id是否存在
     * @return true 或 false
     **/
    public function IsScene_idSet()
    {
        return array_key_exists('scene_id', $this->values);
    }

    /**
     * 设置活动信息
     * @param string $value
     **/
    public function SetRisk_info($value)
    {
        $this->values['risk_info'] = $value;
    }
    /**
     * 获取活动信息的值
     * @return 值
     **/
    public function GetRisk_info()
    {
        return $this->values['risk_info'];
    }
    /**
     * 判断活动信息是否存在
     * @return true 或 false
     **/
    public function IsRisk_infoSet()
    {
        return array_key_exists('risk_info', $this->values);
    }

    /**
     * 设置资金授权商户号
     * @param string $value
     **/
    public function SetConsume_mch_id($value)
    {
        $this->values['consume_mch_id'] = $value;
    }
    /**
     * 获取资金授权商户号的值
     * @return 值
     **/
    public function GetConsume_mch_id()
    {
        return $this->values['consume_mch_id'];
    }
    /**
     * 判断资金授权商户号是否存在
     * @return true 或 false
     **/
    public function IsConsume_mch_id()
    {
        return array_key_exists('consume_mch_id', $this->values);
    }

}
