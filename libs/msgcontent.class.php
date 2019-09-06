<?php
/**
 * Created by PhpStorm.
 * User: sphynx
 * Date: 6/24/15
 * Time: 19:21
 * 公共消息模板
 */
class MsgContent{
    /**
     * 发送激活邮件
     * @param Array $CFG 邮箱配置信息
     * @param String $mail 发送邮箱
     * @param String $url 激活地址
     */
    public static function sendActivityMail($CFG,$mail,$url){
        $string = bin2hex(Xxtea::encrypt($mail . "|" . time(), "Yeecolor"));
        $msg = '恭喜您成功注册为营天下用户！<br/><br/>';
        $msg .= '您的注册邮箱是【' . $mail . '】。为了您的账户安全，请点<a href="' . $url . '">击此处验证邮箱</a>。<br/>';
        $msg .= '<br/><br/><br/>营天下团队<br/>';
        $msg .= '客服电话：400-878-3633<br/>';
        $msg .= '电子邮箱：help@51camp.cn<br/>';
        $msg .= '此为系统邮件，请勿直接回复';
        $email = new Email();
        $s = $email->sendEmial($CFG, $mail, '【营天下】注册邮箱验证', $msg);
        return $s;
    }

    /**
     * 发送注册邮件
     * @param Array $CFG 邮箱配置信息
     * @param String $mail 发送邮箱
     * @param String $url 激活地址
     */
    public static function sendRegMail($CFG,$mail,$url){
        $msg = '恭喜您成功注册为营天下用户！<br/><br/>';
        $msg .= '您的注册邮箱是【' . $mail . '】。为了您的账户安全，请点<a href="' . $url . '">击此处验证邮箱</a>。<br/>';
        $msg .= '<br/><br/><br/>营天下团队<br/>';
        $msg .= '客服电话：400-878-3633<br/>';
        $msg .= '电子邮箱：help@51camp.cn<br/>';
        $msg .= '此为系统邮件，请勿直接回复<br/>';
        $msg .= '说明:<br/>';
        $msg .= ' 发件人:营天下<br/>';
        $msg .= ' 发件邮箱:noreply@51camp.cn';
        $email = new Email();
        $s = $email->sendEmial($_CFG, $mail, '【营天下】注册邮箱验证', $msg);
        return $s;
    }

    /**
     * 重置密码邮件
     * @param Array $CFG 邮箱配置信息
     * @param String $mail 发送邮箱
     * @param String $url 重置地址
     */
    public static function sendReset($CFG,$mail,$url){
        $tic = $CFG['webname'] . '：密码重置邮件';
        $msg = '您刚才申请了“忘记密码”功能,请点击以下链接重新设置您的密码(该链 接24小时有效,过期后请重新申请找回密码)<br/><br/>';
        $msg .= '以下链接为重置密码的链接，请点<a style="color:#F90004; font-size:14px" href="' . $url . '">击此处重置密码</a><br/><br/>如无法打开链接请复制如下链接到浏览器地址栏中打开：<br/>' . $url . '<br/>';
        $msg .= '<br/><br/><br/>如果您没有使用“忘记密码”功能，请忽略此邮件。<br/><br/><br/>营天下团队<br/>';
        $msg .= '客服电话：400-878-3633<br/>';
        $msg .= '电子邮箱：help@51camp.cn<br/>';
        $msg .= '此为系统邮件，请勿直接回复<br/>';
        $msg .= '说明:<br/>';
        $msg .= ' 发件人:营天下<br/>';
        $msg .= ' 发件邮箱:noreply@51camp.cn';
        $s = Email::sendEmial($CFG, $mail, $tic, $msg);
        return $s;
    }

    /**
     * 支付预付款
     * @param Array $CFG 邮箱配置信息
     * @param String $mail 发送邮箱
     * @param String $price 订单金额
     * @param String $title 订单标题
     */
    public static function sendPay($CFG,$mail,$price,$title){
        $tic = '【营天下】'.$title.'  –  支付成功 ';
        $msg = '【营天下】您在营天下网站支付的 '.$price.' 元已经收到，我们的课程顾问将会尽快与您联系，确认报名参加'.$title.'相关事项。<br/>';
        $msg .= '如有问题，请拨打我们的客服电话 400‐878‐3633<br/>';
        $msg .= '营天下团队 <br/>';
        $msg .= '客服电话：400‐878‐3633 <br/>';
        $msg .= '电子邮箱：help@51camp.cn <br/>';
        $s = Email::sendEmial($CFG, $mail, $tic, $msg);
        return $s;
    }

    /**
     * 尾款支付成功
     * @param Array $CFG 邮箱配置信息
     * @param String $mail 发送邮箱
     * @param String $price 订单金额
     * @param String $title 订单标题
     */
    public static function send($CFG,$mail,$price,$title){
        $tic = '【营天下】'.$title.'  –  尾款支付成功 ';
        $msg = '您在营天下网站支付的 '.$price.' 元尾款已经收到， 我们的课程顾问将会尽快与您联系，告知您出发前需要做哪些准备。<br/>';
        $msg .= '如有问题，请拨打我们的客服电话 400‐878‐3633<br/>';
        $msg .= '营天下团队 <br/>';
        $msg .= '客服电话：400‐878‐3633 <br/>';
        $msg .= '电子邮箱：help@51camp.cn <br/>';
        $s = Email::sendEmial($CFG, $mail, $tic, $msg);
        return $s;
    }
    
     /**
     * 发送后台消息邮件
     * @param Array $CFG 邮箱配置信息
     * @param String $mail 发送邮箱
     * @param String $url 激活地址
     */
    public static function sendActivityMail($CFG,$mail,$url){
        $string = bin2hex(Xxtea::encrypt($mail . "|" . time(), "Yeecolor"));
        $msg = '恭喜您成功注册为营天下用户！<br/><br/>';
        $msg .= '您的注册邮箱是【' . $mail . '】。为了您的账户安全，请点<a href="' . $url . '">击此处验证邮箱</a>。<br/>';
        $msg .= '<br/><br/><br/>营天下团队<br/>';
        $msg .= '客服电话：400-878-3633<br/>';
        $msg .= '电子邮箱：help@51camp.cn<br/>';
        $msg .= '此为系统邮件，请勿直接回复';
        $email = new Email();
        $s = $email->sendEmial($CFG, $mail, '【营天下】后台需结算审核', $msg);
        return $s;
    }

}