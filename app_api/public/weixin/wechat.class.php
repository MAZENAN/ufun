<?php
class Wechat {

    public function __construct($appid, $appkey) {
        $this->app_id = $appid;
        $this->app_secret = $appkey;
    }

//验证签名
    public function valid() {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = c("TOKEN");
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo $echoStr;
            exit;
        }
    }

    //获取用户信息

    public function UnionID($code) {

        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->app_id . "&secret=" . $this->app_secret . "&code=" . $code . "&grant_type=authorization_code";
        $data = $this->curl_get_contents($url);
        return $data;
    }

//响应消息
    public function responseMsg() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $this->logger("R \r\n" . $postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            if (($postObj->MsgType == "event") && ($postObj->Event == "subscribe" || $postObj->Event == "unsubscribe")) {
//过滤关注和取消关注事件
            } else {
                
            }

//消息类型分离
            switch ($RX_TYPE) {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknown msg type: " . $RX_TYPE;
                    break;
            }
            $this->logger("T \r\n" . $result);
            echo $result;
        } else {
            echo "";
            exit;
        }
    }

//接收事件消息
    private function receiveEvent($object) {
        $content = "";
        switch ($object->Event) {
            case "subscribe":
                $content = "欢迎关注营天下，中国首家营地教育平台！\r\n全球优质营地教育资源分享，先进教育理念传播，青少年全假期解决方案，尽在营天下！\r\n1. <a href='http://webchat.51camp.cn/cncamp.html'>点击了解国内主题营</a>\r\n2. <a href='http://webchat.51camp.cn/glcamp.html'>点击了解全球营地/游学</a>\r\n3. <a href='http://webchat.51camp.cn/ad/index.html?id=27'>点击营长推荐热门项目</a>\r\n客服热线：400-878-3633\r\n客服邮箱：help@51camp.cn\r\n点击进入<a href='http://webchat.51camp.cn/'>营天下官网</a>\r\n";
                $content .= (!empty($object->EventKey)) ? ("\n来自二维码场景 " . str_replace("qrscene_", "", $object->EventKey)) : "";
                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
            case "CLICK":
                $content = "点击菜单：" . $object->EventKey;
                break;
            case "VIEW":
                $content = "跳转链接 " . $object->EventKey;
                break;
            case "SCAN":
                $content = "扫描场景 " . $object->EventKey;
                break;
            case "LOCATION":
                $content = "上传位置：纬度 " . $object->Latitude . ";经度 " . $object->Longitude;
                break;
            case "scancode_waitmsg":
                if ($object->ScanCodeInfo->ScanType == "qrcode") {
                    $content = "扫码带提示：类型 二维码 结果：" . $object->ScanCodeInfo->ScanResult;
                } else if ($object->ScanCodeInfo->ScanType == "barcode") {
                    $codeinfo = explode(",", strval($object->ScanCodeInfo->ScanResult));
                    $codeValue = $codeinfo[1];
                    $content = "扫码带提示：类型 条形码 结果：" . $codeValue;
                } else {
                    $content = "扫码带提示：类型 " . $object->ScanCodeInfo->ScanType . " 结果：" . $object->ScanCodeInfo->ScanResult;
                }
                break;
            case "scancode_push":
                $content = "扫码推事件";
                break;
            case "pic_sysphoto":
                $content = "系统拍照";
                break;
            case "pic_weixin":
                $content = "相册发图：数量 " . $object->SendPicsInfo->Count;
                break;
            case "pic_photo_or_album":
                $content = "拍照或者相册：数量 " . $object->SendPicsInfo->Count;
                break;
            case "location_select":
                $content = "发送位置：标签 " . $object->SendLocationInfo->Label;
                break;
            default:
                $content = "receive a new event: " . $object->Event;
                break;
        }

        if (is_array($content)) {
            if (isset($content[0]['PicUrl'])) {
                $result = $this->transmitNews($object, $content);
            } else if (isset($content['MusicUrl'])) {
                $result = $this->transmitMusic($object, $content);
            }
        } else {
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

    public function get_access_token() {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->app_id . "&secret=" . $this->app_secret;
        $data = json_decode($this->curl_get_contents($url), true);
        if ($data['access_token']) {
            return $data['access_token'];
        } else {
            return false;
        }
    }

    /**
     * @param $access_token
     * @param $jsondata
     * @return mixed
     * 真实发送模板消息
     */
     public function send_template_msg($access_token,$jsondata) {


















        $url='https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token='.$access_token;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch,CURLOPT_POST, 1);
//        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE );
//        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false );
//        curl_setopt($ch,CURLOPT_POSTFIELDS, $jsondata);


         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
         curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $result=json_decode($output,true);
        return $result;
    }

    /*
       发送模板消息
    */
//    public function push_template($jsondata){
//
//        //step1:获取token，失败直接返回
//       // $this->mysql_token();
//        //step2:发送模板消息,失败return;
//        $token['access_token']=$this->mysql_token();
//        $result=$this->send_template_msg($token['access_token'],$jsondata);
//        return $result;
//
//    }

    /**
     * @param $jsondata
     * @return mixed
     * 获取token并发送模板消息
     */
    public function push_template($jsondata) {
        $token = $this->local_token();
        $result = $this->send_template_msg($token,$jsondata);
        return $result;
    }

    /**
     * @return array|bool
     * 本地缓存获取微信token
     */
    public function local_token() {
        $file= ROOT_DIR . 'app_api/public/access_token.php';
        $local_token = file_get_contents($file);
        $local_token=json_decode($local_token,true);
        if ($local_token['expire_time']<=time()) {
            $token=$this->get_access_token();
            if ($token) {
                $access_token=[];
                $access_token['access_token']=$token;
                $access_token['expire_time']=time()+7000;
                file_put_contents($file, json_encode($access_token));
            }else{
                return [];
            }
        }else{
            $token=$local_token['access_token'];
        }
        return $token;
    }

    public function mysql_token(){

        $conn=mysql_connect(C('PUSH_DB_HOST').':'.C('PUSH_DB_PORT'),C('PUSH_DB_USER'),C('PUSH_DB_PWD'));  
        mysql_select_db(C('PUSH_DB_NAME')); 
        mysql_query('set names ' . C('PUSH_DB_CHAR')); 

        $sql="select token from sl_wx_token where appid='".$this->app_id."'";  

        $result=mysql_query($sql); 

        $row=mysql_fetch_assoc($result);

        mysql_close($conn);

        return $row['token'];
    }

    public function userinfo($access_token) {

        $url = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=' . $access_token;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{}');

        $output = curl_exec($ch);

        curl_close($ch);

        return ($output);
    }

    /**

     * 创建菜单 

     * @param $access_token 已获取的ACCESS_TOKEN 

     */
    public function createmenu($access_token, $_buttom = array()) {

        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;

        $arr = array(
            'button' => $_buttom
        );


        $jsondata = urldecode(json_encode($arr));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);

        $output = curl_exec($ch);

        curl_close($ch);

        return ($output);
    }
    //上传永久素材
    public function add_material($access_token,$file_info){
        $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=" . $access_token."&type=image";   
         
         $content = file_get_contents($file_info);
         
         $tmp_path=$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'tmp.jpg';
         file_put_contents($tmp_path, $content);
        
          $cfile = curl_file_create("{$tmp_path}");
          $arr = array('media' => $cfile);

          $ch = curl_init ();
          curl_setopt ( $ch, CURLOPT_URL, $url );
          curl_setopt ( $ch, CURLOPT_POST, 1 );
          curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
          curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
          curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
          curl_setopt ( $ch, CURLOPT_POSTFIELDS, $arr );
          $output = curl_exec ( $ch );
          curl_close ( $ch );
          
          unlink($tmp_path);//删除临时文件 
          
          return ($output);
}

//接收文本消息
    private function receiveText($object) {
        $keyword = trim($object->Content);


//自动回复模式


        $row = DB::getone('select * from @pf_auto where `keyword` like ?', ["%" . $keyword . "%"]);

        if ($row['reply'] == 1) {
            $content = $row['content'];
        } else if ($row['reply'] == 2) {
            $content = array();
            $content[] = array("Title" => $row['title'], "Description" => $row['content'], "PicUrl" => C('QiniuRoot'). $row['thumb'], "Url" => $row['links']);
        }else if ($row['reply'] == 3) {
            $content = array();
            $content = array("MediaId" =>$row['title']);
        } else {
            //$content = date("Y-m-d H:i:s", time()) . "\nOpenID：" . $object->FromUserName . "\n技术支持 银彩互通";
            $content = "欢迎关注营天下，中国首家营地教育平台！\r\n全球优质营地教育资源分享，先进教育理念传播，青少年全假期解决方案，尽在营天下！\r\n1. <a href='http://webchat.51camp.cn/cncamp.html'>点击了解国内主题营</a>\r\n2. <a href='http://webchat.51camp.cn/glcamp.html'>点击了解全球营地/游学</a>\r\n3. <a href='http://webchat.51camp.cn/ad/index.html?id=27'>点击营长推荐热门项目</a>\r\n客服热线：400-878-3633\r\n客服邮箱：help@51camp.cn\r\n点击进入<a href='http://webchat.51camp.cn/'>营天下官网</a>\r\n";
        }

        if (is_array($content)) {
            if (isset($content[0])) {
                $result = $this->transmitNews($object, $content);
            } else if (isset($content['MusicUrl'])) {
                $result = $this->transmitMusic($object, $content);
            }else if (isset($content['MediaId'])) {
                $result = $this->transmitImage($object, $content);
            }
        } else {
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }

//接收图片消息
    private function receiveImage($object) {
        $content = array("MediaId" => $object->MediaId);
        $result = $this->transmitImage($object, $content);
        return $result;
    }

//接收位置消息
    private function receiveLocation($object) {
        $content = "你发送的是位置，经度为：" . $object->Location_Y . "；纬度为：" . $object->Location_X . "；缩放级别为：" . $object->Scale . "；位置为：" . $object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }

//接收语音消息
    private function receiveVoice($object) {
        if (isset($object->Recognition) && !empty($object->Recognition)) {
            $content = "你刚才说的是：" . $object->Recognition;
            $result = $this->transmitText($object, $content);
        } else {
            $content = array("MediaId" => $object->MediaId);
            $result = $this->transmitVoice($object, $content);
        }
        return $result;
    }

//接收视频消息
    private function receiveVideo($object) {
        $content = array("MediaId" => $object->MediaId, "ThumbMediaId" => $object->ThumbMediaId, "Title" => "", "Description" => "");
        $result = $this->transmitVideo($object, $content);
        return $result;
    }

//接收链接消息
    private function receiveLink($object) {
        $content = "你发送的是链接，标题为：" . $object->Title . "；内容为：" . $object->Description . "；链接地址为：" . $object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }

//回复文本消息
    private function transmitText($object, $content) {
        if (!isset($content) || empty($content)) {
            return "";
        }

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);

        return $result;
    }

//回复图文消息
    private function transmitNews($object, $newsArray) {
        if (!is_array($newsArray)) {
            return "";
        }
        $itemTpl = "        <item>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
        </item>
";
        $item_str = "";
        foreach ($newsArray as $item) {
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <ArticleCount>%s</ArticleCount>
    <Articles>
$item_str    </Articles>
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

//回复音乐消息
    private function transmitMusic($object, $musicArray) {
        if (!is_array($musicArray)) {
            return "";
        }
        $itemTpl = "<Music>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <MusicUrl><![CDATA[%s]]></MusicUrl>
        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
    </Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[music]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

//回复图片消息
    private function transmitImage($object, $imageArray) {
        $itemTpl = "<Image>
        <MediaId><![CDATA[%s]]></MediaId>
    </Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[image]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

//回复语音消息
    private function transmitVoice($object, $voiceArray) {
        $itemTpl = "<Voice>
        <MediaId><![CDATA[%s]]></MediaId>
    </Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[voice]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

//回复视频消息
    private function transmitVideo($object, $videoArray) {
        $itemTpl = "<Video>
        <MediaId><![CDATA[%s]]></MediaId>
        <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
    </Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[video]]></MsgType>
    $item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

//回复多客服消息
    private function transmitService($object) {
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    private function curl_get_contents($url, $timeout = 30) {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);
        curl_setopt ( $curlHandle, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $curlHandle, CURLOPT_SSL_VERIFYHOST, false );
        $result = curl_exec($curlHandle);
        curl_close($curlHandle);
        return $result;
    }

//回复第三方接口消息
    private function relayPart3($url, $rawData) {
        $headers = array("Content-Type: text/xml; charset=utf-8");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

//字节转Emoji表情
    function bytes_to_emoji($cp) {
        if ($cp > 0x10000) {       # 4 bytes
            return chr(0xF0 | (($cp & 0x1C0000) >> 18)) . chr(0x80 | (($cp & 0x3F000) >> 12)) . chr(0x80 | (($cp & 0xFC0) >> 6)) . chr(0x80 | ($cp & 0x3F));
        } else if ($cp > 0x800) {   # 3 bytes
            return chr(0xE0 | (($cp & 0xF000) >> 12)) . chr(0x80 | (($cp & 0xFC0) >> 6)) . chr(0x80 | ($cp & 0x3F));
        } else if ($cp > 0x80) {    # 2 bytes
            return chr(0xC0 | (($cp & 0x7C0) >> 6)) . chr(0x80 | ($cp & 0x3F));
        } else {                    # 1 byte
            return chr($cp);
        }
    }

//日志记录
    private function logger($log_content) {
        if (isset($_SERVER['HTTP_APPNAME'])) {   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        } else if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") { //LOCAL
            $max_size = 1000000;
            $log_filename = "log.xml";
            if (file_exists($log_filename) and ( abs(filesize($log_filename)) > $max_size)) {
                unlink($log_filename);
            }
            file_put_contents($log_filename, date('Y-m-d H:i:s') . " " . $log_content . "\r\n", FILE_APPEND);
        }
    }

    /*
       客服消息
    */
    public function customer_msg($jsondata){

        $token=$this->mysql_token();

        $url='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$token;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);

        $output = curl_exec($ch);

        curl_close($ch);

        $result=json_decode($output,true);
        
        return $result;

    }

}

?>