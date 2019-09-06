<?php

require 'include.inc.php';
import('libs.*');

class AllAreaController {

    // function indexAction() {
    //     $tbname = "@pf_area";

    //     function getdata(&$rows, $tbname) {
    //         if (count($rows) == 0) {
    //             return;
    //         }
    //         foreach ($rows as &$row) {
    //             $temp = DB::getopts($tbname, 'id,name', 0, 'pid=?', [$row[0]]);
    //             $row[0] = $row[1];
    //             if (count($temp) > 0) {
    //                 $row[2] = $temp;
    //                 getdata($row[2], $tbname);

    //             }
    //         }
    //     }

    //     $rows = DB::getopts($tbname, 'id,name', 0, 'pid=0');
    //     getdata($rows, $tbname);
    //     echo json_encode($rows);
    // }
    function indexAction(){
        $areaJson = file_get_contents('area.json');
        $areaArray = json_decode($areaJson,true);

        $result = [];
        foreach ($areaArray as $key => $value) {
            $province = [];
            $province[0] = $value['name'];
            $province[1] = $value['name'];
            $province[2] = [];
            foreach ($value['city'] as $key2 => $value2) {
                $city = [];
                $city[0] = $value2['name'];
                $city[1] = $value2['name'];
                $city[2] = [];
                foreach ($value2['area'] as $key3 => $value3) {
                    $area = [];
                    $area[0] = $value3;
                    $area[1] = $value3;
                    array_push($city[2], $area);
                }
                array_push($province[2], $city);
            }
            array_push($result, $province);
        }
        echo json_encode($result);
    }
}

APP::SimpleRun();
