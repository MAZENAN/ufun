<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email
 *
 * @author wj354
 */
class Email {

    //put your code here
    public static function sendEmial(&$_CFG, $email, $tic, $body, $ishtml = true) {



        Config::load('smtp');

        $_CFG = array();
        $_CFG['smtphost'] = (C('smtphost'));
        $_CFG['smtpport'] = (C('smtpport'));
        $_CFG['smtpuser'] = (C('smtpuser'));
        $_CFG['smtppwd'] = (C('smtppwd'));
        $_CFG['smtpemail'] = (C('smtpemail'));
        $_CFG['smtpfrom'] = (C('smtpfrom'));
       // var_dump($_CFG);
       
        $mail = new PHPMailer ();
        $mail->IsSMTP();
        $mail->SMTPDebug=1;
        $mail->SMTPSecure='ssl';
        
        $mail->Host = $_CFG ["smtphost"];
        $mail->Port = $_CFG ["smtpport"];
        $mail->SMTPAuth = true;
        $mail->Username = $_CFG ["smtpuser"];
        $mail->Password = $_CFG ["smtppwd"];
        $mail->From = $_CFG ["smtpemail"];
        $mail->FromName = $_CFG ["smtpfrom"];
        $mail->Subject = $tic;
        $mail->Body = $body;
        $mail->CharSet = "UTF-8";
        $mail->WordWrap = 50;
        $mail->AddAddress($email);
        $mail->IsHTML($ishtml);
        return $mail->Send();
    }

}
