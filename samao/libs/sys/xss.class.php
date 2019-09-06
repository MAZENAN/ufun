<?php

class Xss {

    //允许通过的标签
    public static $allowtags = '<img><a><p><div><ul><li><ol><dl><dd><dt><strong><i><s><em><pre><code><br><span><table><tbody><thead><tr><th><td>';
    //允许通过的属性
    public static $allowattrs = array(
        'img' => 'src|width|height|alt|title|style',
        'a' => 'href|title|style|target',
        'p' => 'style',
        'div' => 'style',
        'ul' => 'style',
        'li' => 'style',
        'ol' => 'style',
        'dl' => 'style',
        'dd' => 'style',
        'dt' => 'style',
        'strong' => 'style',
        'i' => 'style',
        's' => 'style',
        'em' => 'style',
        'pre' => 'style',
        'code' => 'style',
        'span' => 'style',
        'table' => 'style|width|height|border|cellpadding|cellspacing|align',
        'tbody' => 'style',
        'thead' => 'style',
        'tr' => 'style',
        'th' => 'style|width|height|align|valign|colspan|rowspan',
        'td' => 'style|width|height|align|valign|colspan|rowspan',
    );

    //过滤全部POST数据
    public static function RemoveAllPost() {
        if (IS_POST) {
            foreach ($_POST as $key => $value) {
                if (gettype($value) == 'string') {
                    $_POST[$key] = self::Remove($value);
                }
            }
        }
    }

    protected static function ReplaceTagAttr($match) {
        $tag = strtolower($match[1]);
        if (!isset(Xss::$allowattrs[$tag])) {
            return '<' . $match[1] . '>';
        }
        $exp = Xss::$allowattrs[$tag];
        $str = $match[2];
        //提取标签属性---------
        $reg = '@(' . $exp . ')="([^"]+)"@si';
        if (!preg_match_all($reg, $str, $arr)) {
            return '<' . $match[1] . '>';
        }
        $attr = '';
        foreach ($arr[0] as $key => $value) {
            if (strtolower($arr[1][$key]) === 'href' && !empty($arr[2][$key])) {
                $value = 'href="' . preg_replace('@^(?!(http|https|ftp|mailto)[^:]+):.*@si', '#', trim($arr[2][$key])) . '"';
            }
            if (strtolower($arr[1][$key]) === 'style' && !empty($arr[2][$key])) {
                $value = 'style="' . preg_replace('@^.*(expression|javascript|vbscript|progid|microsoft).*$@si', '', $arr[2][$key]) . '"';
            }
            $attr.=' ' . $value;
        }
        if ($tag == 'img') {
            $attr.='/';
        }
        return '<' . $match[1] . $attr . '>';
    }

    public static function Remove($data) {
        $data = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $data);
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            $data = preg_replace('/(&#[x|X]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $data); // with a ;
            $data = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $data); // with a ;
        }
        $searchs = array('@<script[^>]*?>.*?</script>@si', // Strip out javascript 
            '@<style[^>]*?>.*?</style>@si', // Strip style tags properly 
        );
        $data = preg_replace($searchs, '', $data);
        $data = strip_tags($data, self::$allowtags);
        $data = preg_replace_callback('@<([a-z]+)\s([^>]+)>@siU', 'Xss::ReplaceTagAttr', $data);
        return $data;
    }

}
