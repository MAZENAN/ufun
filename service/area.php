<?php

require 'include.inc.php';
import('libs.*');

class AreaController {

    

    function indexAction() {
        $tbname = "@pf_area";

        function getdata(&$rows, $tbname) {
            if (count($rows) == 0) {
                return;
            }
            foreach ($rows as &$row) {
                $temp = DB::getopts($tbname, 'id,name', 0, 'pid=?', [$row[0]]);
                if (count($temp) > 0) {
                    $row[2] = $temp;
                    getdata($row[2], $tbname);
                }
            }
        }

        $rows = DB::getopts($tbname, 'id,name', 0, 'pid=0');
        getdata($rows, $tbname);
        echo json_encode($rows);
    }
}

APP::SimpleRun();
