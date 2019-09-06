<?php

class Comm
{

    static function links($args, $mgargs = [], $word = true)
    {
        $pare = [];
        foreach ($args as $key => $value) {
            if (isset($mgargs[$key])) {
                $value = $mgargs[$key];
            }
            if ($value == '') {
                $value = 0;
            } elseif ($key == 'start_date' || $key = 'start_date_to') {
                $value = preg_replace('/(\d{4})(-)(\d{2})(-)(\d{2})/i', "\${1}\${3}\${5}", $value);
            }
            $pare[] = $value;
        }
        $link = join('-', $pare) . '.html';
        if ($word) {
            $keyword = SGet('keyword');
            $lesson_tag = IGet('lesson_tag');
            if (!empty($lesson_tag)) {
                $link .= '?lesson_tag=' . $lesson_tag;
            }
        }
        return $link;
    }

    static function getOrderID()
    {
        $count = DB::getval('select count(1) from @pf_order where add_date=?', [date('Y-m-d')]);
        $count = $count + 1;
        $stoid = date('YmdHis') . str_pad($count, 4, '0', STR_PAD_LEFT);
        return $stoid;
    }

    static function clearHtml($content)
    {

    }

    //生成订单数据
    static function getOrder($userid, $type, $id, $depid, &$err)
    {
        if (empty($type)) {
            $err = '不存在的订单类型！';
            return null;
        }
        $data = [];
        $row = DB::getone('select * from @pf_camp where id=?', [$id]);
        if (!$row) {
            $err = '不存在的订单！';
            return null;
        }
        $bmtime = strtotime($row['deadline'] . ' 23:59:59');
        if ($bmtime < time()) {
            $err = '订单已经截止报名！';
            return null;
        }
        $departure_option = '';
        $times = self::getCampDate($type, $row['id'], $depid);
        if (!$times) {
            $err = '选择了无效的出发日期！';
            return null;
        }
        $departure_option = self::formatCampDate($times);

        #这里获得订单人数
        $drow = self::getCampDatePeple($type, $depid);
        if (!$drow) {
            $err = '订单人数无效！';
            return null;
        }
        if ($drow["tourists"] + $drow["parent"] == 0) {
            $drow["tourists"] = 1;
            $drow["parent"] = 0;
        }

        /*
          $campcitys = json_decode($row['starting_city'], true);
          if (!is_array($campcitys)) {
          $err = '选择了无效的出发城市！';
          return null;
          }
          $nohave = true;
          foreach ($campcitys as $ct) {
          if (intval($ct) === intval($city)) {
          $nohave = false;
          break;
          }
          }
          if ($nohave) {
          $err = '选择的出发城市不在本订单中！';
          return null;
          }

          $cityrow = DB::getone('select `name` from @pf_starting_city where id=?', [$city]);
          if (!$cityrow) {
          $err = '选择了无效的出发城市！';
          return null;
          }
          $cityname = $cityrow['name'];
         */
        $data['orderid'] = self::getOrderID();
        $data['type'] = $row['type'] == 1 ? 'glcamp' : 'cncamp';
        $data['campid'] = $id;
        $data['title'] = $row['title'];
        if ($type == 'glcamp' && $row['en_title']) {
            $data['title'] .= ' – ' . $row['en_title'];
        }
        $data['need_topay'] = $times['cost'];
        $data['deposit'] = $times['deposit'];
        $data['retainage'] = $times['cost'] - $times['deposit'];
        $data['paid'] = 0;
        $data['mechanism'] = $row['mechanism'];
        $data['start_date'] = $times['start'];
        /// $data['end_date'] = $times['end'];

        $data['days'] = $times['days'];
        $data['scommision'] = $times['scommision'];

        // $data['tourists'] = $row['tourists'] < 1 ? 1 : $row['tourists'];
        //  $data['parent'] = $row['parent'];
        $data["tourists"] = $drow["tourists"];
        $data["parent"] = $drow["parent"];

        //$data['starting_city'] = $cityname;
        $data['state'] = 0;
        $data['userid'] = $userid;
        $data['addtime'] = date('Y-m-d H:i:s');
        $data['add_date'] = date('Y-m-d');
        $data['departure_option'] = $departure_option;

        return $data;
    }

    static function areaNames($areastr)
    {
        $area = is_array($areastr) ? $areastr : json_decode($areastr, true);
        $names = [];
        if (!is_array($area)) {
            return "";
        }
        foreach ($area as $id) {
            $name = DB::getval('select name from @pf_area where id=?', [$id]);
            if ($name) {
                $names[] = $name;
            }
        }
        return join(' - ', $names);
    }

    static function addScore($userid, $title, $score)
    {
        $vals = [];
        $vals['userid'] = $userid;
        $vals['title'] = $title;
        $vals['score'] = $score;
        $vals['addtime'] = date('Y-m-d H:i:s');
        DB::insert('@pf_score_record', $vals);
        $user = [];
        $user['score'] = DB::sql('ifnull(score,0)+' . $score);
        DB::update('@pf_member', $user, $userid);
    }

    static function AuthData($userid, $url = '', $type = 'auth')
    {
        $code = Funcs::randNum(24);
        DB::insert('@pf_authdata', [
            'userid' => $userid,
            'type' => $type,
            'code' => $code,
            'expired' => time() + 86400,
            'url' => $url
        ]);
        return $code;
    }

    static function AuthChk($userid, $code, &$err = '', $type = 'auth')
    {
        $row = DB::getone('select * from @pf_authdata where userid=? and code=? and type=?', [$userid, $code, $type]);
        if (!$row) {
            $err = '邮箱认证链接有误。';
            return false;
        }
        if ($row['expired'] < time()) {
            $err = '邮箱认证已超时，请重新发送邮件。';
            return false;
        }
        DB::update('@pf_authdata', ['auth' => 1], $row['id']);
        return $row['url'];
    }

    static function getCampDate($type, $id, $depid = 0, &$err = '')
    {
        $dtbs = ['cncamp' => '@pf_camp_date', 'glcamp' => '@pf_camp_date'];
        if (empty($type) || empty($dtbs[$type])) {
            $err = '不存在的订单类型！';
            return null;
        }
        if ($depid == 0) {
            return DB::getlist('select id,periods,start,on_sell_time,off_sell_time,days,cost,deposit,remark,split_ratio,peoples,money,tourists,parent,if(start>curdate(),1,0) as allow from ' . $dtbs[$type] . ' where campid=?  order by start asc,cost asc', [$id]);
        } elseif ($depid == -1) {
            return DB::getone('select id,periods,start,on_sell_time,off_sell_time,days,cost,deposit,remark,split_ratio,peoples,money from ' . $dtbs[$type] . ' where campid=? and start>=curdate() order by cost asc, start asc limit 0,1', [$id]);
        } else {
            return DB::getone('select id,periods,start,on_sell_time,off_sell_time,days,cost,deposit,remark,split_ratio,scommision,peoples,money from ' . $dtbs[$type] . ' where id=? and campid=? and start>=curdate() order by cost asc, start asc', [$depid, $id]);
        }
    }

    static function getCampDatePeple($type, $depid, &$err = '')
    {
        if (empty($type)) {
            $err = '不存在的订单类型！';
            return null;
        }
        if ($depid == 0) {
            $err = '不存在的订单类型！';
            return null;
        }
        return DB::getone('select id,tourists,`parent` from @pf_camp_date where id=?', [$depid]);
    }

    static function formatCampDate($row)
    {
        return '第' . $row['periods'] . '期 ' . $row['start'] . ' 共 ' . $row['days'] . ' 天 ' . $row['remark'];
    }

    /**
     * 返回输入数组中某个单一列的值
     * @param array $array =(0=>array('id'=>1,'name'=>'shiyao'),1=>array('id'=>2,'name'=>'jdl'));
     * @param type $column_key 'id'
     * @param type $index_key
     * @return array
     */
    static function _array_column(array $array, $column_key, $index_key = null)
    {
        $result = [];
        foreach ($array as $arr) {
            if (!is_array($arr)) continue;

            if (is_null($column_key)) {
                $value = $arr;
            } else {
                $value = $arr[$column_key];
            }

            if (!is_null($index_key)) {
                $key = $arr[$index_key];
                $result[$key] = $value;
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }

    /**
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return float
     * 计算两个坐标之间的距离
     */
    public static function getDistance($lat1, $lng1, $lat2, $lng2) {
        //地球半径
        $R = 6378137;
        //将角度转为狐度
        $radLat1 = deg2rad($lat1);
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        //结果
        $s = acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*$R;
        //精度
        $s = round($s* 10000)/10000;
        return  round($s);
    }
//    public static function getDistance($lat1, $lng1, $lat2, $lng2)
//    {
//        $theta = $lng1 - $lng2;
//        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
//        $miles = acos($miles);
//        $miles = rad2deg($miles);
//        $miles = $miles * 60 * 1.1515;
//        $feet = $miles * 5280;
//        $yards = $feet / 3;
//        $kilometers = $miles * 1.609344;
//        $meters = $kilometers * 1000;
//        return compact('miles', 'feet', 'yards', 'kilometers', 'meters');
//    }

    public static function formatDis($distance) {
       return $dis = $distance<1000 ? ($distance . 'm') : ($distance/1000) .'km';
    }

    /**
     * 生成模板数据json
     * @param $template 选取的模板
     * @param $touser   推送用户的openid
     * @param $formId   formid
     * @param $data     模板数据:索引数组，按模板顺序排放
     * @param null $page 跳转路径 为空时则取用系统设置路径
     * @return bool || json      不存在模板时返回false,存在直接返回json
     * TODO 改为配置文件
     */
    public static function templates ($template,$touser,$formId,$data,$page=null){
        if (!is_string($template)||!is_string($touser)||!is_string($formId)||!is_array($data)||(!is_null($page) && !is_string($page))) {
            return false;
        }

        $templateArr = [
            //接单成功模板
            'order_success' => [
                'touser' => $touser,
                'template_id' => 'Z5I_9drDLJjRGZ2MF-zxLq1RGrO-tWZTbrf_O7o5mys',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'取餐号'],
                    'keyword2' => ['value'=>'商品名称'],
                    'keyword3' => ['value'=>'取餐时间'],
                    'keyword4' => ['value'=>'取餐地址'],
                    'keyword5' => ['value'=>'订单金额'],
                    'keyword6' => ['value'=>'订单编号']
                ],
                'emphasis_keyword' => 'keyword1.DATA'
            ],
            //订单发货模板
            'notify_take' => [
                'touser' => $touser,
                'template_id' => '6PV8JrqCBuzTk5iy_i0EWSlA0HSoZn1lawYZS_6rIxE',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'取餐号'],
                    'keyword2' => ['value'=>'配送商品'],
                    'keyword3' => ['value'=>'商家名称'],
                    'keyword4' => ['value'=>'配送地址'],
                    'keyword5' => ['value'=>'联系人']
                ],
                'emphasis_keyword' => 'keyword1.DATA'
            ],
            //外卖订单退款成功模板
            'waimai_refund_success' => [
                'touser' => $touser,
                'template_id' => 'eALjk3NscJ3QIR1FuCoC_4NktJL4qr3B6UBrS1CSn28',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'商户名称'],
                    'keyword2' => ['value'=>'商品名称'],
                    'keyword3' => ['value'=>'退款金额'],
                    'keyword4' => ['value'=>'退款说明'],
                    'keyword5' => ['value'=>'退款时间'],
                    'keyword6' => ['value'=>'交易单号']
                ]
            ],
            //外卖订单退款失败模板
            'waimai_refund_fail' => [
                'touser' => $touser,
                'template_id' => '6hYEVoPjze9Hv_9Du1OPghJSXL3rEHjdMPxbsJ2TB2o',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'商户名称'],
                    'keyword2' => ['value'=>'订单编码'],
                    'keyword3' => ['value'=>'商品名称'],
                    'keyword4' => ['value'=>'申请时间'],
                    'keyword5' => ['value'=>'拒绝理由']
                ]
            ],
            //赏金订单接单成功
            'earn_accept' => [
                'touser' => $touser,
                'template_id' => 'DO4dphViOHD0kApP-N9PBXNSidEz0seLGfQLKTwBIIY',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'接单人'],
                    'keyword2' => ['value'=>'联系电话'],
                    'keyword3' => ['value'=>'时间']
                ]
            ],
            //赏金任务订单送达通知
            'earn_arrived' => [
                'touser' => $touser,
                'template_id' => 'BoYQRoitx73lQlfqsHhUQk5OAvXQGfoRhWDUuqpQkcY',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'服务人员'],
                    'keyword2' => ['value'=>'电话'],
                    'keyword3' => ['value'=>'订单编号']
                ]
            ],
            //赏金任务退款
            'earn_refund' => [
                'touser' => $touser,
                'template_id' => 'KhMqy97aLrtJvte-o0n5WA9s3SH6-UcIUozi6DZI-xI',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'任务名称'],
                    'keyword2' => ['value'=>'退还现金'],
                    'keyword3' => ['value'=>'处理时间'],
                    'keyword4' => ['value'=>'原订单号'],
                    'keyword5' => ['value'=>'退款状态'],
                ],
                'emphasis_keyword' => 'keyword1.DATA'
            ],
            //实名认证审核
            'authenticate' => [
                'touser' => $touser,
                'template_id' => 'G7gI61ZTvvWwzyNc_QjYJVcUto5NUIpq1bqiiXu48W0',
                'form_id' => $formId,
                'data' => [
                    'keyword1' => ['value'=>'认证状态'],
                    'keyword2' => ['value'=>'被认证人'],
                    'keyword3' => ['value'=>'备注'],
                    'keyword4' => ['value'=>'审核时间']
                ],
                'emphasis_keyword' => 'keyword1.DATA'
            ]
        ];

        if (!isset($templateArr[$template])) {
            return false;
        }
        $ret = $templateArr[$template];
        if (count($ret['data'])!=count($data)){
            return false;
        }

        $n = 0;
        foreach ($ret['data'] as $k=>$v){
            $ret['data'][$k]['value'] = strval($data[$n]);
            $n++;
        }
        if (!empty($page)){
            $ret['page'] = $page;
        }
        return json_encode($ret);
    }

    /**模板消息推送
     * @param $template 模板
     * @param $uid 用户id
     * @param $data 模板数据
     * @param null $page 小程序路径
     * @return bool
     * @throws Exception
     */
    public static function push($template,$uid,$data,$page=null) {
        $wx_form_row = DB::getone('SELECT form_id,openid FROM @pf_wx_form WHERE user_id=? ORDER BY id DESC',[$uid]);
        if ($wx_form_row){
            $openid = $wx_form_row['openid'];
            $form_id = $wx_form_row['form_id'];
        }else{
            return false;
        }
        $json = self::templates($template,$openid,$form_id,$data,$page);
        if ($json==false){
            return false;
        }
        include ROOT_DIR . 'app_api/public/weixin/wechat.class.php';
        Config::load('x');
        $webchat=C('v1');
        $wechat = new Wechat($webchat['appid'],$webchat['secret']);
        $result = $wechat->push_template($json);
        if ($result['errcode']) {
        }else{
            DB::delete('@pf_wx_form','form_id=?',[$form_id]);
        }
    }

}
