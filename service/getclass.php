<?php

require 'include.inc.php';
import('libs.*');

class GetclassController {

    var $enum;

    function indexAction() {
        $this->enum = isset($_REQUEST['enum']) ? $_REQUEST['enum'] : '';
        if (empty($this->enum)) {
            echo json_encode(array());
            exit;
        }
        $rows = $this->getclass();
        echo json_encode($rows);
    }

    function getclass($pid = 0) {
        $row = DB::getlist('select id,name from @pf_categories where enum=? and pid=? and allow=1 order by sort asc', array($this->enum, $pid), PDO::FETCH_NUM);
        for ($i = 0, $len = count($row); $i < $len; $i++) {
            $row[$i][2] = $this->getclass($row[$i][0]);
        }
        return $row;
    }

}

APP::SimpleRun();
