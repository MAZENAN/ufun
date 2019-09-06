<?php

include_once "wxBizDataCrypt.php";

$appid = 'wx1c0f39c4e08e5689';
$sessionKey = 'x4jT7XX+sY4yE/mLbUwL6Q==';

$encryptedData = "qwQ7Lt+9uQaJDqzCTloYfM0xI+S0H/tP0ERcLaMF4NEo/ncDt1xVfdkv8qK3Xg0wDMLzfkKzcaC1L4xy7nDERLDGfrx8KTNgLT5PdFFizvrljHuYEfBaNGvIUjH4TP540nFtACXwM3zivBeVoOyOKLirjAEM+S/qV/bJGnK3NyhW6uGppVXLWFpStajzY3ZbMjMDcC+i5XyCc8gsWN4HY/xiwjpUrm9mLGB0i/j46UzhND10Iq9fDYTjhXYC567FJUdHRGG8Zb5vcYmEbSy7UG5Kv/UriovQOjtNJMK/Fwazndons5SrTGE+rbi2ma6QYkWfAXYKuM8Co1+zhfun/cnGhSIiFJawx0XVUo5ANcpP16MSejV2Vih1qU3vvmXYsl5+gp5lYQhnBJakSnlJA/5wtC6DAOja6LN/Fnmb3zjImd1nY+oBljqvZdy6TSAeASbPFMbJy7BC1EJClU7NnA==";

$iv = '/agOKNKJ49mA637bmth8wQ==';

$pc = new WXBizDataCrypt($appid, $sessionKey);
$errCode = $pc->decryptData($encryptedData, $iv, $data);

if ($errCode == 0) {
	print($data . "\n");
} else {
	print($errCode . "\n");
}
