<?php

function smarty_function_pagebar($params, $template) {
    //加载配置项
    $PageConfig = C('PageBar');
    $PArgs = gettype($PageConfig) == 'array' ? $PageConfig : array();
    //设置默认值
    $PArgs['info'] = isset($PArgs['info']) ? $PArgs['info'] : '共有信息：#Count#  页次：#Page#/#PageCount# 每页 #PageSize#';
    $PArgs['showinfo'] = isset($PArgs['showinfo']) ? $PArgs['showinfo'] : 1;
    $PArgs['size'] = isset($PArgs['size']) ? $PArgs['size'] : 10;
    $PArgs['showfirst'] = isset($PArgs['showfirst']) ? $PArgs['showfirst'] : 2;
    $PArgs['showlast'] = isset($PArgs['showlast']) ? $PArgs['showlast'] : 2;
    $PArgs['showprev'] = isset($PArgs['showprev']) ? $PArgs['showprev'] : 1;
    $PArgs['shownext'] = isset($PArgs['shownext']) ? $PArgs['shownext'] : 1;
    $PArgs['shownbpage'] = isset($PArgs['shownbpage']) ? $PArgs['shownbpage'] : 1;
    $PArgs['first'] = isset($PArgs['first']) ? $PArgs['first'] : '首页';
    $PArgs['prev'] = isset($PArgs['prev']) ? $PArgs['prev'] : '上页';
    $PArgs['next'] = isset($PArgs['next']) ? $PArgs['next'] : '下页';
    $PArgs['last'] = isset($PArgs['last']) ? $PArgs['last'] : '尾页';
    $PArgs['class'] = isset($PArgs['class']) ? $PArgs['class'] : 'pagebar';
    $PArgs['infoclass'] = isset($PArgs['infoclass']) ? $PArgs['infoclass'] : 'pagebar_info';
    $pdata = array();
    $link = '';
    foreach ($params as $_key => $_val) {
        switch ($_key) {
            case 'pdata':$pdata = (array) $_val;
                break;
            case 'size':
            case 'showfirst':
            case 'showlast':
            case 'showprev':
            case 'shownext':
            case 'shownbpage':
            case 'showinfo': $PArgs[$_key] = intval($_val);
                break;
            case 'info':
            case 'first':
            case 'prev':
            case 'next':
            case 'last':
            case 'class':
            case 'infoclass':
                $PArgs[$_key] = (string) $_val;
                break;
            case 'link':
            case 'control':
                $link = (string) $_val;
                break;
        }
    }

    if (empty($link)) {
        $link = $pdata['other_query'];
        if ($link != '' && substr($link, -1) != '&') {
            $link = $link . '&';
        }
        $pagelink = $link . $pdata['page_key'] . '=';
        $pargs = explode('&', $pagelink);
        foreach ($pargs as $key => $value) {
            $pargs[$key] = htmlspecialchars($value);
        }
        $pagelink = join('&', $pargs);
        $pagelink = '?' . $pagelink . '#Page#';
    } else {
        $pagelink = $link;
    }
    //最大页数
    $maxpage = intval($pdata['page_count']);
    //当前页数
    $page = intval($pdata['page']);
    //显示首页
    $Html = '';
    if ($PArgs['showfirst'] == 1 || $PArgs['showfirst'] == 3) {
        $Html.= '<a class="first" href="' . str_replace("#Page#", 1, $pagelink) . '">' . $PArgs['first'] . '</a>';
    }
    //显示上一页
    if ($PArgs['showprev'] == 2) {
        $p_page = $page - 1;
        if ($p_page < 1) {
            $Html.='<a class="prev disabled" href="javascript:;">' . $PArgs['prev'] . '</a>';
        } else {
            $Html.='<a class="prev" href="' . str_replace("#Page#", $p_page, $pagelink) . '">' . $PArgs['prev'] . '</a>';
        }
    } elseif ($PArgs['showprev'] == 1) {
        if ($page > 1) {
            $p_page = $page - 1;
            $Html.='<a class="prev" href="' . str_replace("#Page#", $p_page, $pagelink) . '">' . $PArgs['prev'] . '</a>';
        }
    }
    if ($PArgs['shownbpage'] == 1) {
        $size = $PArgs['size'];
        $inc = round($size / 2);
        $start = ($maxpage < $size || $page <= $inc) ? 1 : ($page + $inc > $maxpage ? $maxpage - ($size - 1) : $page - ($inc - 1));
        $temp = $start + ($size - 1);
        $temp2 = $temp > $maxpage ? $maxpage : $temp;
        $end = ($page + $inc > $maxpage) ? $maxpage : $temp2;
        if ($PArgs['showfirst'] == 2 || $PArgs['showfirst'] == 3) {
            if ($start > 1) {
                $Html.='<a href="' . str_replace("#Page#", 1, $pagelink) . '">1</a><span class="break">...</span>';
            }
        }
        for ($i = $start; $i <= $end; $i++) {
            $p_page = $i;
            if ($p_page == $page) {
                $Html.='<b>' . $p_page . '</b>';
            } else {
                $Html.='<a href="' . str_replace("#Page#", $p_page, $pagelink) . '">' . $p_page . '</a>';
            }
        }
        if ($PArgs['showlast'] == 2 || $PArgs['showlast'] == 3) {
            if ($end < $maxpage) {
                $Html.='<span class="break">...</span><a href="' . str_replace("#Page#", $maxpage, $pagelink) . '">' . $maxpage . '</a>';
            }
        }
    }
    //显示下一页
    if ($PArgs['shownext'] == 2) {
        $p_page = $page + 1;
        if ($p_page > $maxpage) {
            $Html.='<a class="next disabled" href="javascript:;">' . $PArgs['next'] . '</a>';
        } else {
            $Html.='<a class="next" href="' . str_replace("#Page#", $p_page, $pagelink) . '">' . $PArgs['next'] . '</a>';
        }
    } elseif ($PArgs['shownext'] == 1) {
        if ($page < $maxpage) {
            $p_page = $page + 1;
            $Html.='<a  class="next" href="' . str_replace("#Page#", $p_page, $pagelink) . '">' . $PArgs['next'] . '</a>';
        }
    }
    //显示尾页
    if ($PArgs['showlast'] == 1 || $PArgs['showlast'] == 3) {
        $Html.='<a class="last" href="' . str_replace("#Page#", $maxpage, $pagelink) . '">' . $PArgs['last'] . '</a>';
    }
    $Ctext = '';
    if ($PArgs['showinfo'] == 1) {
        $str = str_replace("#Count#", $pdata['records_count'], $PArgs['info']);
        $str = str_replace("#Page#", $pdata['page'], $str);
        $str = str_replace("#PageCount#", $pdata['page_count'], $str);
        $str = str_replace("#MaxPage#", $pdata['page_count'], $str);
        $Ctext = '<div class="pagebar_info">' . str_replace("#PageSize#", $pdata['size'], $str) . '</div>';
    }
    return '<div class="' . $PArgs['class'] . '">' . $Html . '</div>' . $Ctext;
}
