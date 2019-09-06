<?php

require 'include.inc.php';
@session_start();

class DownController extends Controller {

    public function indexAction() {
        $fid = isset($_GET['fid']) ? intval($_GET['fid']) : 0;
        $row = DB::getone('select path,name from @pf_upfiles where id=?', array($fid));
        if ($row == null) {
            $this->alert('不存在的下载文件！', '/verify.html');
        }
        $filepath = ROOT_DIR . 'upfiles' . $row['path'];
        if (file_exists($filepath)) {
            $file = fopen($filepath, "r");
            header("Content-type: application/octet-stream");
            header("Accept-Ranges: bytes");
            header("Accept-Length: " . filesize($filepath));
            header("Content-Disposition: attachment; filename=" . urlencode($row['name']));
            echo fread($file, filesize($filepath));
            fclose($file);
            exit();
        }
    }

}

APP::SimpleRun();
