<?php

include 'include.inc.php';
import('libs.*');

class SendMsgController {
      
    function indexAction() {
        $sql = "select @pf_order.id,mobile,title from @pf_order,@pf_member 
                where state=3 and @pf_order.type='glcamp' and @pf_member.id=@pf_order.userid and @pf_member.type<>2  and mobile<>'' 
                and datediff(start_date,CURDATE())=6 ";//group by mobile
        $info = DB::getlist($sql);
        
        $data = array();
        foreach ($info as $key => $value) {
            $data[$value['title']][] = $value['mobile'];
        }
        
        if(empty($data)){
            die(json_encode(array('error'=>'没有需要发送短信的会员。')));
        }else{
            foreach($data as $k=>$v){
                //一次群发最多200条
                $content = "【营天下】您在营天下报名的“".$k."”还有5天就要出营了！记得做好出营准备哦，有任何疑问请致电客服400-878-3633。";
                $v = array_chunk($v, 200, false);
                foreach ($v as $val) {
                    $mobile = implode(',', $val);
                   // $mobile='18810885751';
                    if (!empty($mobile)) {
                        $rs = SMS::send($mobile, $content);
                    }
                    $mobile = "";
                }
                echo json_encode(array('ok'=>$k.'，此营期出营提醒已发送'));
            }
        }
    }
}   

APP::SimpleRun();