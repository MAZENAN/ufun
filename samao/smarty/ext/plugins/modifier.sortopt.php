<?php

function smarty_modifier_sortopt($string, $id, $type = 0, $bypid = 0) {
    $html = '';
    if ($type == 0) {
        $html = '<input name="sort" class="form-control digits" value="' . $string . '" type="text" style="width:40px;"/>'
                . '<input class="samao-mini-btn samao-mini-btn-change" title="修改" type="button" onclick="this.form.submit();" />&nbsp;&nbsp;';
        if ($bypid == 1) {
            $html.='<a href="' . __SELF__ . '/upsortbypid?id=' . $id . '" class="up">上移</a> <a href="' . __SELF__ . '/dnsortbypid?id=' . $id . '" class="down">下移</a>';
        } else {
            $html.='<a href="' . __SELF__ . '/upsort?id=' . $id . '" class="up">上移</a>  <a href="' . __SELF__ . '/dnsort?id=' . $id . '" class="down">下移</a>';
        }
    } elseif ($type == 1) {
        $html = '<input name="sort" class="form-control digits" value="' . $string . '" type="text" style="width:40px;"/>'
                . '<input class="samao-mini-btn samao-mini-btn-change" title="修改" type="button" onclick="this.form.submit();" />&nbsp;&nbsp;';
        if ($bypid == 1) {
            $html.='<a href="' . __SELF__ . '/dnsortbypid?id=' . $id . '" class="up">上移</a>  <a href="' . __SELF__ . '/upsortbypid?id=' . $id . '" class="down">下移</a>';
        } else {
            $html.='<a href="' . __SELF__ . '/dnsort?id=' . $id . '" class="up">上移</a>  <a href="' . __SELF__ . '/upsort?id=' . $id . '" class="down">下移</a>';
        }
    } elseif ($type == 2) {
        $html = '<input id="sort' . $id . '" class="form-control digits" value="' . $string . '" type="text" style="width:40px;"/>&nbsp;';
        if ($bypid == 1) {
            $html.='<a href="' . __SELF__ . '/upsortbypid?id=' . $id . '" class="up">上移</a>  <a href="' . __SELF__ . '/dnsortbypid?id=' . $id . '" class="down">下移</a>';
        } else {
            $html.='<a href="' . __SELF__ . '/upsort?id=' . $id . '" class="up">上移</a>  <a href="' . __SELF__ . '/dnsort?id=' . $id . '" class="down">下移</a>';
        }
    } elseif ($type == 3) {
        $html = '<input id="sort' . $id . '" class="form-control digits" value="' . $string . '" type="text" style="width:40px;"/>&nbsp;';
        if ($bypid == 1) {
            $html.='<a href="' . __SELF__ . '/dnsortbypid?id=' . $id . '" class="up">上移</a>  <a href="' . __SELF__ . '/upsortbypid?id=' . $id . '" class="down">下移</a>';
        } else {
            $html.='<a href="' . __SELF__ . '/dnsort?id=' . $id . '" class="up">上移</a>  <a href="' . __SELF__ . '/upsort?id=' . $id . '" class="down">下移</a>';
        }
    } elseif ($type == 4) {
        $html = '<input id="sort' . $id . '" class="form-control digits" value="' . $string . '" type="text" style="width:40px;"/>';
    }
	elseif ($type == 5) {
		 if ($bypid == 1) {
            $html.='<a href="' . __SELF__ . '/upsortbypid?id=' . $id . '" class="up">上移</a> ' . $string . ' <a href="' . __SELF__ . '/dnsortbypid?id=' . $id . '" class="down">下移</a>';
        } else {
            $html.='<a href="' . __SELF__ . '/upsort?id=' . $id . '" class="up">上移</a> ' . $string . ' <a href="' . __SELF__ . '/dnsort?id=' . $id . '" class="down">下移</a>';
        }
    }
	elseif ($type == 6) {
		 if ($bypid == 1) {
            $html.='<a href="' . __SELF__ . '/dnsortbypid?id=' . $id . '" class="up">上移</a> ' . $string . ' <a href="' . __SELF__ . '/upsortbypid?id=' . $id . '" class="down">下移</a>';
        } else {
            $html.='<a href="' . __SELF__ . '/dnsort?id=' . $id . '" class="up">上移</a> ' . $string . '  <a href="' . __SELF__ . '/upsort?id=' . $id . '" class="down">下移</a>';
        }
    }

    return $html;
}
