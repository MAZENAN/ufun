<?php

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * 上传类
 *
 * @author wj008
 */
class Upload {

    //put your code here
    private $input_name = 'upload_file';
    private $base_path;
    private $base_url;
    private $max_size = 52428800;
    private $allow_ext = array('txt', 'rar', 'zip', 'jpg', 'jpeg', 'gif', 'png', 'doc', 'bmp', 'ppt', 'xls', 'xlsx', 'psd', 'swf', 'avi');
    private $file;
    private $fileinfo;
    private $dirType = 1; //0:全部堆放一起 1:按月存入目录 2:按天存入目录 3:按月分目录再按天存入目录 4：仅按类型分
    private $immediate = false;

    function __construct($base_path, $base_url, $input_name = 'upload_file') {
        $this->input_name = $input_name;
        $this->base_path = str_replace('/', DS, $base_path);
        $this->base_url = str_replace('\\', '/', $base_url);
    }

    public function set_maxSize($maxsize) {
        $this->max_size = $maxsize;
    }

    public function set_dirType($type) {
        $this->dirType = $type;
    }

    public function set_allowExt($exts) {
        $this->allow_ext = $exts;
    }

    private function get_runname() {
        if ($this->dirType == 0 || $this->dirType == 4) {
            return date("YmdHis") . mt_rand(1000, 9999);
        } elseif ($this->dirType == 1) {
            return date("dHis") . mt_rand(1000, 9999);
        } else {
            return date("His") . mt_rand(1000, 9999);
        }
    }

    private function get_dirname() {
        if ($this->dirType == 0 || $this->dirType == 4) {
            return '';
        } elseif ($this->dirType == 1) {
            return '/' . date("Ym");
        } elseif ($this->dirType == 2) {
            return '/' . date("Ymd");
        } else {
            return '/' . date("Ym") . '/' . date("d");
        }
    }

    private function check_file() {
        $this->immediate = (isset($_GET['immediate']) && $_GET['immediate'] == '1') ? true : false;
        //HTML5上传
        if (isset($_SERVER['HTTP_CONTENT_DISPOSITION']) && preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i', $_SERVER['HTTP_CONTENT_DISPOSITION'], $info)) {
            $tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();
            $tempPath = $tmp_dir . DS . microtime();
            file_put_contents($tempPath, file_get_contents("php://input"));
            $localName = urldecode($info[2]);
            $this->file = array(
                'error' => 0,
                'tmp_name' => $tempPath,
                'name' => $localName,
                'size' => filesize($tempPath),
                'type' => 'application/octet-stream'
            );
        } else {
            if (!isset($_FILES[$this->input_name])) {
                return '文件域的name错误';
            }
            $this->file = @$_FILES[$this->input_name];
        }
        if (empty($this->file['error']) || $this->file['error'] == 0) {
            if (empty($this->file['tmp_name']) || $this->file['tmp_name'] == 'none') {
                return '无文件上传!';
            }
            $this->fileinfo = pathinfo($this->file['name']);
            $ext = strtolower($this->fileinfo['extension']);
            if (!in_array($ext, $this->allow_ext)) {
                @unlink($this->file['tmp_name']);
                return '服务器不允许上传该文件类型！';
            }
            $this->fileinfo['isimg'] = preg_match('/jpg|jpeg|gif|png|bmp/i', $ext) ? true : false;
            $bytes = filesize($this->file['tmp_name']);
            $this->fileinfo['bytes'] = $this->formatBytes($bytes);
            if ($bytes > $this->max_size) {
                @unlink($this->file['tmp_name']);
                return '请不要上传大小超过' . $this->formatBytes($this->max_size) . '的文件!';
            }
            return '';
        }

        if ($this->file['error'] == 1) {
            @unlink($this->file['tmp_name']);
            return '文件超过系统限定的大小!';
        }
        if ($this->file['error'] == 2) {
            @unlink($this->file['tmp_name']);
            return '文件大小超过了HTML定义的MAX_FILE_SIZE值!';
        }
        if ($this->file['error'] == 3) {
            @unlink($this->file['tmp_name']);
            return '文件上传不完全!';
        }
        if ($this->file['error'] == 4) {
            @unlink($this->file['tmp_name']);
            return '无文件上传!';
        }
        if ($this->file['error'] == 6) {
            @unlink($this->file['tmp_name']);
            return '缺少临时文件夹!';
        }
        if ($this->file['error'] == 7) {
            @unlink($this->file['tmp_name']);
            return '写文件失败!';
        }
        if ($this->file['error'] == 8) {
            @unlink($this->file['tmp_name']);
            return '上传被其它扩展中断!';
        }
        @unlink($this->file['tmp_name']);
        return '无有效错误代码!';
    }

    private function createdir($filedir) {
        if (!is_dir($filedir)) {
            $pfiledir = dirname($filedir);
            $this->createdir($pfiledir);
            @mkdir($filedir, 0777);
            @fclose(fopen($filedir . DS . 'index.htm', 'w'));
        }
    }

    public function savefile() {
        $err = $this->check_file();
        if ($err != '') {
            $this->showerr($err);
        }
        $mpath = $this->fileinfo['isimg'] ? 'images' : 'files';
        $mpath = $mpath . $this->get_dirname();
        $newname = $this->get_runname();
        $filename = $newname . '.' . strtolower($this->fileinfo['extension']);
        if ($this->dirType == 0) {
            $fileurl = $this->base_url . '/' . $filename;
            $filedir = $this->base_path;
        } else {
            $fileurl = $this->base_url . '/' . $mpath . '/' . $filename;
            $filedir = $this->base_path . DS . $mpath;
        }

        $this->createdir($filedir);
        $file_path = str_replace('/', DS, $filedir . DS . $filename);

        $rm = @rename($this->file['tmp_name'], $file_path);
        if ($rm == false) {
            move_uploaded_file($this->file['tmp_name'], $file_path);
        }

        $filepath = str_replace(realpath($this->base_path), '', realpath($file_path));

        $vals = array(
            'key' => $newname,
            'url' => $fileurl,
            'path' => $filepath,
            'name' => $this->file['name'],
            'isimg' => $this->fileinfo['isimg'] ? 1 : 0,
            'flag' => 0,
            'size' => $this->fileinfo['bytes'],
        );

        return $vals;
    }

    public function showerr($str) {
        die('{err:\'' . addcslashes($str, '\'\\') . '\',msg:null}');
    }

    public function result($info) {
        $msg = array();
        $msg['url'] = $this->immediate ? '!' . $info['url'] : $info['url'];
        $msg['localname'] = $info['name'];
        $msg['id'] = isset($info['id']) ? $info['id'] : 0;
        $msg['key'] = $info['key'];
        $r = array();
        $r['err'] = '';
        $r['msg'] = $msg;
        die(json_encode($r));
    }

    private function formatBytes($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
        } elseif ($bytes >= 1048576) {
            $bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
        } elseif ($bytes >= 1024) {
            $bytes = round($bytes / 1024 * 100) / 100 . 'KB';
        } else {
            $bytes = $bytes . 'Bytes';
        }
        return $bytes;
    }

}
