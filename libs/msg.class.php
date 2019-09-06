<?php

/**
 * 系统发送消息类
 */
class Msg {

    /**
     * 发送系统消息方法
     * @param array $data 消息内容数组
     * @param int $accept 接收对象 1全部用户 2指定用户
     * @param int $time 发送的时间戳，默认当前时间
     */
    public static function send($data, $accept = 1, $time = 0) {
        $data['accept'] = $accept;
        $data['addtime'] = $time ? $time : date('Y-m-d H:i:s', time());
        DB::insert('@pf_msg', $data);
    }

    /**
     *  发送通知消息
     * @param ini $userid 用户id
     * @param string $title 消息名称
     * @param string $content 消息内容
     * @param string $type 消息类型
     */
    public static function sendMsg($userid, $title, $content, $type = '通知') {
        $_data = [];
        $data['title'] = $title;
        $data['userid'] = $userid;
        $data['content'] = $content;
        $data['accept'] = 2;
        $data['type'] = $type;
        $data['addtime'] = date('Y-m-d H:i:s', time());
        DB::insert('@pf_msg', $data);
    }

}
