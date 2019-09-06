<?php
class CommonUtil{
	public static function verify_user($param = null) {
		require_once('session.php');
		$obj_r = new stdClass;
		$obj_r->status = 500 ;
		$uid		 = isset($_POST["uid"])?trim($_POST["uid"]):NULL ;
		$sign_sn   = isset($_POST["sign_sn"])?trim($_POST["sign_sn"]):NULL ;

		if (!is_null($param)) {
			$param->mobile 	= $p_mobile ;
			$param->uid			= $p_uid ;
			$param->sign_sn 	= $p_sign_sn ;
			$param->role_code 	= $p_role_code ;	
		}
		if (empty($uid)) {
				$obj_r->r = "用户ID为空" ;
				return $obj_r ;
	    }
		if (empty($sign_sn)) {
				$obj_r->r = "sign_sn为空" ;
				return $obj_r ;
		}
		$token_status=Session::valid_token($uid,$sign_sn);
		if($token_status==TOKEN_505)//UID 不存在
		{
			//登录过期
			$obj_r->status = 505;
			$obj_r->r = "登录过期";
			return $obj_r ;
		}
	
		if($token_status==TOKEN_508)//UID 存在， 但是SESSION 不同
		{
			//踢下线
			$obj_r->status = 508;
			$obj_r->r = "请重新登录";
			return $obj_r ;
		}

		$obj_r->status = 200 ;
		return $obj_r;
	}
	
	public static function check_status($user_status)
	{
		$obj_r = new stdClass;
		$obj_r->status = 500 ;
		if(500 == $user_status->status || 505 ==$user_status->status || 508 ==$user_status->status)
		{
			CommonUtil::return_info($user_status);
			exit(-1) ;
		}
		if(200 ==$user_status->status)
		{
			$mobile 	= isset($_POST['mobile'])? trim($_POST['mobile']):NULL;
			if(!is_null($mobile))
			{
				if(preg_match("/^1[34578]\d{9}$/", $mobile))
				{
					//手机号验证通过
					$obj_r->status = 200 ;
					return $obj_r;
				}else{
					//未通过
					$obj_r->status = 500 ;
					return $obj_r;
				}
			}
			$password 	= isset($_POST['password'])? trim($_POST['password']):NULL;
			if(!is_null($password))
			{
				if(preg_match("/^[A-Za-z0-9]{6,12}$/", $password))
				{
					$obj_r->status = 200 ;
					return $obj_r;
				}else{
					$obj_r->status = 500 ;
					return $obj_r;
				}
			}

		}
		/*{
			//verify email
			$email 		= isset($_POST['email'])? trim($_POST['email']):NULL;
			if(!is_null($email))
			{
				if(preg_match("/[a-zA-Z0-9_-.+]+@[a-zA-Z]+/",$email)=0)
				{
						//邮箱验证通过
				}
				else
				{
						//验证不通过： 状态码返回数字几？ 需要规定
				}
			}
			$mobile 		= isset($_POST['mobile'])? trim($_POST['mobile']):NULL;
			if(!is_null($mobile))
			{
				if(preg_match("[0-9]", subject))
				{
						//手机号验证通过
				}
			}

		}*/
	}
	
	public static function return_info($obj)
	{
		echo json_encode($obj,JSON_UNESCAPED_UNICODE);die();
	}

	public static function Qiniu_Encode($str) // URLSafeBase64Encode
	 {
	    $find = array('+', '/');
	    $replace = array('-', '_');
	    return str_replace($find, $replace, base64_encode($str));
	 }

	public static function getQiniuPath($key) {//$info里面的url
    	$url=BP_DOMAIN.$key;
    	$accessKey = '5CQmagmT27DNXYhsmVewntOpd9VLGD8sC5c02ptg';
		$secretKey = 'lQm-akaIb3JOS-WAlBycTXF_95hx7JEd9s88ARk5';
	    $duetime = time() + 36000;//下载凭证有效时间
	    $DownloadUrl = $url . '?e=' . $duetime;
	    $Sign = hash_hmac ( 'sha1', $DownloadUrl, $secretKey, true );
	    $EncodedSign = CommonUtil::Qiniu_Encode ( $Sign );
	    $Token = $accessKey. ':' . $EncodedSign;
	    $url = $DownloadUrl . '&token=' . $Token;
	
    return $url;
 }

	/**
	 * 格式化时间
	 * @param $targetTime
	 * @return string
	 */
	public static function get_last_time($targetTime) {
		// 今天最大时间
		$todayLast = strtotime(date('Y-m-d 23:59:59'));
		$agoTimeTrue = time() - $targetTime;
		$agoTime = $todayLast - $targetTime;
		$agoDay = floor($agoTime / 86400);

		if ($agoTimeTrue < 60) {
			$result = '刚刚';
		} elseif ($agoTimeTrue < 3600) {
			$result = (ceil($agoTimeTrue / 60)) . '分钟前';
		} elseif ($agoTimeTrue < 3600 * 12) {
			$result = (ceil($agoTimeTrue / 3600)) . '小时前';
		} elseif ($agoDay == 0) {
			$result = '今天 ' . date('H:i', $targetTime);
		} elseif ($agoDay == 1) {
			$result = '昨天 ' . date('H:i', $targetTime);
		} elseif ($agoDay == 2) {
			$result = '前天 ' . date('H:i', $targetTime);
		} elseif ($agoDay > 2 && $agoDay < 16) {
			$result = $agoDay . '天前 ' . date('H:i', $targetTime);
		} else {
			$format = date('Y') != date('Y', $targetTime) ? "Y-m-d H:i" : "m-d H:i";
			$result = date($format, $targetTime);
		}
		return $result;
	}

	/**
	 * 赏金任务订单状态值转描述
	 */
	public static function earn_order_desc($status) {
		$status_arr = [
			-1 => '已取消',
			0 => '待付款',
			1 => '已付款',
			2 => '配送中',
			3 => '已送达,待确认',
			4 => '退款中',
			5 => '已退款',
			6 => '待评价',
			7 => '已完成',
		];
		return isset($status_arr[$status]) ? $status_arr[$status] : '';
	}

	/**
	 * 支付方式描述
	 */
	public static function paytype_desc($type) {
		$paytype_arr = [
			0 => '余额支付',
			1 => '微信支付'
		];
		return isset($paytype_arr[$type]) ? $paytype_arr[$type] : '';
	}

	public static function refund_desc($status) {
		$refund_arr = [
			1 => '退款中',
			2 => '退款成功',
			3 => '退款失败'
		];
		return isset($refund_arr[$status]) ? $refund_arr[$status] : '';
	}


	public static function status_desc($status) {
		$status_arr = [
			0 => '未入驻',
			1 => '入驻成功',
			2 => '入驻失败',
			3 => '暂停入驻'
		];

		return isset($status_arr[$status]) ? $status_arr[$status] : '';
	}

	public static function allow_desc($allow){
		$allow_arr = [
			0 => '未营业(关闭中)',
			1 => '营业中'
		];

		return isset($allow_arr[$allow]) ? $allow_arr[$allow] : '';
	}

	public static function arrive_time_desc($time_status) {
		$arrive_arr = [
			0 => '上午',
			1 => '中午',
			2 => '下午'
 		];

		return isset($arrive_arr[$time_status]) ? $arrive_arr[$time_status] : '';
	}

	public static function goods_order_desc($status) {
		$status = intval($status);
		$status_arr = [
			-1 => '已取消',
			0 => '待付款',
			1 => '已付款(待接单)',
			2 => '已接单(制作中)',
			3 => '已发货(配送中)',
			4 => '退款中',
			5 => '已退款',
			6 => '待评价',
			7 => '已完成',
		];

		return isset($status_arr[$status]) ? $status_arr[$status] : '';
	}
}
?>
