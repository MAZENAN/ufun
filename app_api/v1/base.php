<?php

//define('API_DIR', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR."app_api/v2/");

require_once("./fun/CommonUtil.php");
require_once("./fun/include.inc.php");
Config::load('upload');


  function is_exist_mobile($mobile)
  {
     $sql="select 1 from cixi_user where mobile='".$mobile."'";
     $user=  PdbcTemplate::query($sql,null,PDO::FETCH_OBJ, 1);
      if(!empty($user) ) 
      {
          return true;
      }
      else
      {
             $sql="select 1 from cixi_sub_user where sub_mobile='".$mobile."'";
             $sub_user=  PdbcTemplate::query($sql,null,PDO::FETCH_OBJ, 1);
             if(!empty($sub_user))
             {
                return true;
             }   
      }
      return false;
  }
  function is_exist_mobile_user($mobile)
  {
     $user = DB::getone('select * from @pf_member where mobile=?', array($mobile));
      if(!empty($user) ) 
      {
          return true;
      }
      return false;
  }
  //验证手机号码
//function check_mobile($mobile)
//{
//  if(!empty($mobile) && !preg_match("/^1[34578]\d{9}$/",$mobile))
//  {
//    return false;
//  }
//  else{
//     return true;
//  }
//}

//验证手机号码
function check_mobile($mobile) {
  return preg_match("@^1[0-9]{10}$@",$mobile)==true ? true: false;
}
/**查询用户是否存在
 * @param $user_id 用户ID
 * @return bool
 */
function check_user_exist($user_id) {
    if (!$user_id){
        return false;
    }
    $row = DB::getone('SELECT id FROM @pf_member WHERE id=?',[$user_id]);
    return $row ? true : false;
}
//验证密码
function check_pwd($pwd){
  if(!preg_match("/^[A-Za-z0-9]{6,}$/",$pwd)){
    return false;
  }
  else{
    return true;
  }
}
//获取项目版本号
function check_version($deal_id){
    $sql="select version from cixi_deal where id=".$deal_id;
    $result=  PdbcTemplate::query($sql,null,PDO::FETCH_OBJ, 1);
    if(!empty($result))
    {
      $version=$result->version;
      return $version;
    }else{
      return false;
    }   
}
//验证手机验证码格式是否正确
function check_mbcode_format($code){
  if(!preg_match("/^[A-Za-z0-9]{6}$/",$code)){
    return false;
  }
  else{
    return true;
  }
}
//验证手机验证码是否正确
function check_mbcode($mobile,$code){
  $row = DB::getone('select * from @pf_mbcodelog where mobile=? and mbcode like ?', array($mobile,"%".$code."%"));
  if(!empty($row) )
      {
          return true;
      }
      return false;
}
//发送会员注册系统消息
function sendMsg($userid) {
    $msg = array(
            'userid' => $userid,
            'type' => '系统消息',
            'content' => '尊敬的会员欢迎您加入营天下',
            'title' => '欢迎您加入营天下',
            'accept' => 2,
            'addtime' => date('Y-m-d H:i:s', time())
    );
    DB::insert('@pf_msg', $msg);
}
function msg_unread_num($uid){
  $member_row = DB::getone('select msg_read_time from @pf_member where  id=?', [$uid]);
  $select = new Select('@pf_msg');
  $select->find('1');
  $select->where('and (userid=? or userid=0)', [$uid]);
  $select->where('and addtime > ?', [$member_row['msg_read_time']]);
  return $select->getCount();
}
function replace_html($str){
  return preg_replace('/(<img.*?src=")(\/upfiles\/)(.*?(?:[.gif|.jpg|.png]))(".*?>)/i',"\${1}".C('QiniuRoot')."/upfiles/\${3}\${4}",$str);
}
function replace_image($type,$img){
    if ($type==0) {
        return C('QiniuRoot').$img;
    }elseif ($type==1) {
        return C('QiniuRoot').$img."?imageView2/1/w/100/h/100";
    }elseif($type==2){
        return C('QiniuRoot').$img."?imageView2/1/w/720/h/540";
    }
    elseif($type==3){
        return C('QiniuRoot').$img."?imageView2/1/w/240/h/240";
    }
}
function add_style($html){
  return '<script type="text/javascript">window.onload=function(){ 
  var oimg=document.querySelectorAll("img");
  for(i=0;i<oimg.length;i++){
      oimg[i].parentNode.parentNode.style.textIndent="0";
      oimg[i].parentNode.style.textIndent="0";
  }
} </script>
  <style>
        img{max-width: 100%;height: auto;margin:5px 0;}
        p{ color: #666; line-height: 25px; font-size: 15px; text-align: justify;}
img{  width: 100%;}
a{ font-size:15px;  color: #666; text-decoration: none; }
    </style>'.$html;
}


function string_truncate_cn($string, $length = 60, $etc = '...', $code = 'UTF-8') {
    $string = trim($string);
        if ($length == 0) {
            return $string;
        }
        if ($code == 'UTF-8') {
            $pax = "/[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        } else {
            $pax = "/[\xa1-\xff][\xa1-\xff]/";
        }
        $str = preg_replace($pax, '**', $string);
        if (strlen($str) <= $length) {
            return $string;
        }
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        } else {
            $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";
        }
        preg_match_all($pa, $string, $t_string);
        $curentLength = 0;                //用于计算真正的字符长度
        $arrayPoint = 0;                  //如过长时，以该坐标为截取长度
        $arrayLength = count($t_string[0]); //所有文本长度
        for ($arrayPoint = 0; ($arrayPoint < $arrayLength) && ($curentLength < $length); $arrayPoint++) {
            if (strlen($t_string[0][$arrayPoint]) > 1) {
                $curentLength+=2;
            } else {
                $curentLength++;
            }
        }
        if ($arrayLength > $arrayPoint) {
            if ($etc != '') {
                return join('', array_slice($t_string[0], 0, ($arrayPoint - 1))) . $etc;
            } else {
                return join('', array_slice($t_string[0], 0, ($arrayPoint)));
            }
        }
        return join('', array_slice($t_string[0], 0, $arrayLength));
}

function format_money($money){
  return (string)floatval($money);
}
function format_date($date){
  if ($date) {
      $year=date('Y', strtotime($date));
      $now_year=date('Y');
      if ($year==$now_year) {
         $new_date=date('m-d', strtotime($date));
      }else{
          $new_date=date('Y-m-d', strtotime($date));
      }
  }else{
      $new_date="";
  }
  return $new_date;
}
function order_num($uid){
  $result=[];
  $order = new Select('@pf_order');
  $order->where('and userid=? and state=0 and refund = 0 and cert_state = 0', [$uid]);
  $result['order1']=$order->getCount();

  $order->clear()->where('and userid=? and (crm_state in(1,0) and refund=0 and cert_state = 1 and state = 0) ', [$uid]);
  $result['order2']=$order->getCount();

  $order->clear()->where('and userid=? and state in (3,1) and refund=0 and start_date > curdate() and apply_state = 1', [$uid]);
  $result['order3']=$order->getCount();//待出发

  $order->clear()->leftJoinMore('@pf_comment_mark as m', ' @pf_order.id=m.order_id')->where('and userid=? and ((state =8  or (start_date < curdate() and state = 3 ))) and  ISNULL(m.order_id)', [$uid]);
  $result['order4']=$order->getCount();//待评价

  return $result;
}

 function account($uid){
        $member = DB::getone("select pass,mobile from @pf_member where id= ".$uid);
        if($member['pass'] != md5(substr($member['mobile'],-4).'123')){
            $pass = 0;
        }else{
          $pass = 1;
        }
  
  return $pass;
}

function save_log($e){
    if (!file_exists('error_log.txt')){
        touch('error_log.txt');
    }

    $error_info = '错误时间：' . "\r\n" . date('Y-m-d H:i:s') . "\r\n".
                    '错误文件' . "\r\n" . $e->getFile(). "\r\n".
                    '错误行：'. "\r\n" . $e->getLine(). "\r\n".
                    '错误信息：' . "\r\n" . $e->getMessage(). "\r\n".
                    '错误栈：'. "\r\n" . $e->getTraceAsString() . "\r\n" .
                    str_repeat('_',100) . "\r\n";

    file_put_contents('error_log.txt',$error_info ,FILE_APPEND);
}

/**
 * 生成订单号
 * @return string
 * @throws Exception
 * type 1:外卖类 2:赏金类
 */
function getOrderID($type=1) {
    $count1=0;

    if ($type==1){
        $count1 = DB::getval('select count(1) from @pf_order where add_date=?', [date('Y-m-d')]);
    }elseif ($type==2){
        $count1 = DB::getval('select count(1) from @pf_earn_order where add_date=?', [date('Y-m-d')]);
    }

    $count = $count1  + 1;
    $stoid = date('YmdHis') . str_pad($count, 4, '0', STR_PAD_LEFT);

    $stoid = $type==2 ? 'SJ'.$stoid : $stoid;
    $stoid .= CommonUtil::random(4,true);
    return $stoid;
}

function getCurl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    curl_close ($ch);
    return $result;
}

/**模板消息推送
 * @param $template 模板
 * @param $uid 用户id
 * @param $data 模板数据
 * @param null $page 小程序路径
 * @return bool
 * @throws Exception
 */
function push($template,$uid,$data,$page=null) {
    $wx_form_row = DB::getone('SELECT form_id,openid FROM @pf_wx_form WHERE user_id=? ORDER BY id DESC',[$uid]);
    if ($wx_form_row){
        $openid = $wx_form_row['openid'];
        $form_id = $wx_form_row['form_id'];
    }else{
        return false;
    }
    $json = Comm::templates($template,$openid,$form_id,$data,$page);
    if ($json==false){
        return false;
    }
    include ROOT_DIR . 'app_api/public/weixin/wechat.class.php';
    $wechat = new Wechat(APPID,SECRET);
    $result = $wechat->push_template($json);
    if ($result['errcode']) {
    }else{
        DB::delete('@pf_wx_form','form_id=?',[$form_id]);
    }
}

/**
 * 获取商户有效配送信息本周+下周，按星期时间升序排序
 * @param $mid 商户id
 * @throws Exception
 */
function get_delivery_info($mid) {
    $cur_week = date('w')==0 ? 7 : date('w');
    $delivery_rows = DB::getlist('SELECT week,is_noon,noon_stop_time,is_pm,pm_stop_time,noon_order_nums,pm_order_nums FROM @pf_delivery WHERE merchant_id =? ORDER BY week ASC',[$mid]);

    if (empty($delivery_rows)){
        return [];
    }
    $delivery_info = [];
    $week = ['1'=>'周一','周二','周三','周四','周五','周六','周日'];
    $index = 1;
    foreach ($delivery_rows as $v){
        if ($v['is_noon']==1){
            $delivery_info[$index] = [
                'is_noon' => 1,
                'week' => $v['week'],
                'type' => 1,
                'this_week' => 0,
                'info' => $week[$v['week']] . '中午送达',
                'noon_stop_time' => $v['noon_stop_time'],
                'noon_order_nums' => $v['noon_order_nums'],
            ];
            if ($delivery_info[$index]['week']==$cur_week){
                $delivery_info[$index]['info'] = '今天中午送达';
            }
            $offset = $delivery_info[$index]['week'] - $cur_week;
            $delivery_info[$index]['delivery_date'] = date('Y-m-d',strtotime("{$offset} day"));
            $index++;
        }
        if ($v['is_pm']==1){
            $delivery_info[$index] = [
                'is_pm' => 1,
                'week' => $v['week'],
                'type' => 2,
                'this_week' => 0,
                'info' => $week[$v['week']] . '下午送达',
                'pm_stop_time' => $v['pm_stop_time'],
                'pm_order_nums' => $v['pm_order_nums'],
            ];
            if ($delivery_info[$index]['week']==$cur_week){
                $delivery_info[$index]['info'] = '今天下午送达';
            }
            $offset = $delivery_info[$index]['week'] - $cur_week;
            $delivery_info[$index]['delivery_date'] = date('Y-m-d',strtotime("{$offset} day"));
            $delivery_info[$index]['mid'] = $mid;
            $index++;
        }
    }

    foreach ($delivery_info as $k=>$v){
        if (isset($v['is_noon'])){
            $temp = '中午';
            $v['type'] = 1;
        }
        if (isset($v['is_pm'])){
            $temp = '下午';
            $v['type'] = 2;
        }
        $v['info'] = '下' . $week[$v['week']] .$temp .'送达';

        $v['this_week'] = 1;
        $offset = 7-$cur_week;
        $offset += $v['week'];
        $v['delivery_date'] = date('Y-m-d',strtotime("+{$offset} day"));
        $v['mid'] = $mid;
        $delivery_info[] = $v;

    }
    return $delivery_info;
}

/**
 * 获取距离现在时间最近的配送时间的第一个索引
 * @param $delivery_arr
 * @param $week
 * @return int|string
 */
function get_time_index($delivery_arr,$week){
    $cur_week = date('w')==0 ? 7 : date('w');

    $index = -1;
    if (!is_array($delivery_arr)||!$delivery_arr){
        return -1;
    }
    while ($index==-1){
        if ($week<=7){
            $this_week = 0;//标识为本周
        }else{
            $this_week = 1;//标识为下周
        }

        $real_week = $week % 7;
        if ($real_week==0){
            $real_week = 7;
        }

        foreach ($delivery_arr as $k=>$v) {
            if (($v['week']==$real_week) && ($v['this_week']==$this_week)){
                if ($v['is_noon']==1){
                    $stop_time = $v['noon_stop_time'];
                    $order_total = $v['noon_order_nums'];
                    $arrive_time = 1;
                }
                if ($v['is_pm']==1){
                    $stop_time = $v['pm_stop_time'];
                    $order_total = $v['pm_order_nums'];
                    $arrive_time = 2;
                }
                if (($v['this_week']==0) && ($v['week']==$cur_week)){ //如果为今天则检查时间
                   $total = get_order_total($v['mid'],$v['delivery_date'],$arrive_time);
                    if (time()<=strtotime($stop_time) && $total<$order_total){
                        $index = $k;
                        break;
                    }
                }else{
                    $index = $k;
                    break;
                }
            }
        }
        $week++;
    }
    return $index;
}

function get_min_price($goods_id) {
   $spec_rows = DB::getlist('SELECT * FROM @pf_goods_spec WHERE goods_id=?',[$goods_id]);
   $temp = [];
   $min_price = 0;
    foreach ($spec_rows as $v){
        if ($v['pid']!=0){
            $temp[$v['pid']][] = $v;
        }
    }
    foreach ($temp as $v){
        $min_price += min(array_column($v,'price'));
    }
    return $min_price;
}

/**
 * 获取商铺单量
 */
function get_order_total($merch_id,$arrive_date,$arrive_time) {

  $row = DB::getone('SELECT SUM(total) total FROM @pf_order WHERE merchant_id=? AND arrive_date=? AND arrive_time=?',[$merch_id,$arrive_date,$arrive_time]);
  if (!$row || empty($row['total'])){
      $total = 0;
  }else{
      $total = $row['total'];
  }
    return $total;
}