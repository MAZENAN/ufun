<?php

require 'include.inc.php';
Config::load('upload');
require_once ROOT_DIR."libs/qiniu/vendor/autoload.php";
include  ROOT_DIR."libs/qiniu/vendor/qiniu/php-sdk/src/Qiniu/Auth.php"; 

class UpimgController {

    function indexAction() {
        $img_file = $_FILES['file'];//得到传输的数据
        //得到文件名称
        $files = array();
        foreach ($img_file as $key => $value) {
            $length = count($value);
            if($length>10){
                die(json_encode(array('error'=>'上传的图片超过10张！','status'=>3)));
            }else{
                for($i =0;$i<$length;$i++){
                    $files[$i][$key]=$value[$i];
                }          
            }
        }
         $auth = new Auth(C('accessKey'), C('secretKey'));        
        $token = $auth->uploadToken(C('Bucket'));
        include  ROOT_DIR."libs/qiniu/vendor/qiniu/php-sdk/src/Qiniu/Storage/UploadManager.php";
        $data = array();
        foreach ($files as $key => $file) {
            $uploadMgr = new UploadManager();
            $type = strtolower(substr($file['name'],strrpos($file['name'],'.')+1));
            $fullname = '/upfiles/images/'.date("Y").date("m").'/'.date("d").time().rand(1000,9999).'.'.$type;
            //$file="D:\wamp\wamp\www\svnrepos\admin_web\admin\Lib\Action\DealAction.class.php";
            list($ret, $err) = $uploadMgr->putFile($token,$fullname, $file['tmp_name']);

            if ($err === null) {
                if($ret['key']){
                    //缓存到页面
                    $data['status'] = 1; 		 
                    $data['key'][] =$ret['key'];
                    
                }else{
                    $data['status'] =2; 
                    $data['error'] ='文件上传失败';
                    
                }	
            }else{
                return false;
            } 
    
        }
       echo json_encode($data); 
      
    }

// public function uploadQiniu($file,$bucket='ytx-51camp')
//    { 
//        require_once ROOT_DIR."libs/qiniu/vendor/autoload.php";
//        include  ROOT_DIR."libs/qiniu/vendor/qiniu/php-sdk/src/Qiniu/Auth.php"; 
//
//        $auth = new Auth(C('accessKey'), C('secretKey'));        
//        $token = $auth->uploadToken(C('Bucket'));
//        include  ROOT_DIR."libs/qiniu/vendor/qiniu/php-sdk/src/Qiniu/Storage/UploadManager.php";
//        $uploadMgr = new UploadManager();
//        $type = strtolower(substr($file['name'],strrpos($file['name'],'.')+1));
//        $fullname = '/upfiles/images/'.date("Y").date("m").'/'.date("d").time().rand(1000,9999).'.'.$type;
//        //$file="D:\wamp\wamp\www\svnrepos\admin_web\admin\Lib\Action\DealAction.class.php";
//        list($ret, $err) = $uploadMgr->putFile($token,$fullname, $file['tmp_name']);
//                
//        if ($err === null) {
//            return $ret;
//        }else{
//            return false;
//        } 
//    }    
       }
APP::SimpleRun();
