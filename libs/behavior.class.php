<?php

class Behavior {

    static function userBrowser() {
        $user_OSagent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_OSagent, "Maxthon") && strpos($user_OSagent, "MSIE")) {
            $visitor_browser = "Maxthon(Microsoft IE)";
        } elseif (strpos($user_OSagent, "Maxthon 2.0")) {
            $visitor_browser = "Maxthon 2.0";
        } elseif (strpos($user_OSagent, "Maxthon")) {
            $visitor_browser = "Maxthon";
        } elseif (strpos($user_OSagent, "MSIE 9.0")) {
            $visitor_browser = "MSIE 9.0";
        } elseif (strpos($user_OSagent, "MSIE 8.0")) {
            $visitor_browser = "MSIE 8.0";
        } elseif (strpos($user_OSagent, "MSIE 7.0")) {
            $visitor_browser = "MSIE 7.0";
        } elseif (strpos($user_OSagent, "MSIE 6.0")) {
            $visitor_browser = "MSIE 6.0";
        } elseif (strpos($user_OSagent, "MSIE 5.5")) {
            $visitor_browser = "MSIE 5.5";
        } elseif (strpos($user_OSagent, "MSIE 5.0")) {
            $visitor_browser = "MSIE 5.0";
        } elseif (strpos($user_OSagent, "MSIE 4.01")) {
            $visitor_browser = "MSIE 4.01";
        } elseif (strpos($user_OSagent, "MSIE")) {
            $visitor_browser = "MSIE �ϸ߰汾";
        } elseif (strpos($user_OSagent, "NetCaptor")) {
            $visitor_browser = "NetCaptor";
        } elseif (strpos($user_OSagent, "Netscape")) {
            $visitor_browser = "Netscape";
        } elseif (strpos($user_OSagent, "Chrome")) {
            $visitor_browser = "Chrome";
        } elseif (strpos($user_OSagent, "Lynx")) {
            $visitor_browser = "Lynx";
        } elseif (strpos($user_OSagent, "Opera")) {
            $visitor_browser = "Opera";
        } elseif (strpos($user_OSagent, "Konqueror")) {
            $visitor_browser = "Konqueror";
        } elseif (strpos($user_OSagent, "Mozilla/5.0")) {
            $visitor_browser = "Mozilla";
        } elseif (strpos($user_OSagent, "Firefox")) {
            $visitor_browser = "Firefox";
        } elseif (strpos($user_OSagent, "U")) {
            $visitor_browser = "Firefox";
        } else {
            $visitor_browser = "����";
        }
        return $visitor_browser;
    }

    static function is_mobile_request() {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
            $mobile_browser++;
        if ((isset($_SERVER['HTTP_ACCEPT'])) and ( strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_PROFILE']))
            $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
        );
        if (in_array($mobile_ua, $mobile_agents))
            $mobile_browser++;
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
            $mobile_browser++;
        // Pre-final check to reset everything if the user is on Windows   
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
            $mobile_browser = 0;

        // But WP7 is also Windows, with a slightly different characteristic   
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
            $mobile_browser++;
        if ($mobile_browser > 0)
            return true;
        else
            return false;
    }
    static function get_device_type() {
        //获取USER AGENT
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
         
        //分析数据
        if (strpos($agent, 'windows nt')) {
             $visitor_device='windows';
        } 
        elseif(strpos($agent, 'iphone')||strpos($agent, 'iPhone')){
            $visitor_device='iphone';
        }
        elseif(strpos($agent, 'ipad')){
            $visitor_device='ipad';
        }
        elseif(strpos($agent, 'android')||strpos($agent, 'Android')){
            $visitor_device='android';
        }
        return $visitor_device;
    }

}
