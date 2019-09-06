<?php
require_once('include.inc.php');
$pwd=SGet('pwd');
$page=IGet('page');
if($pwd!='ytx201508' || $page < 1 ){
    echo 'you are welcome';
    return;
}

$num=200;//一次数量
$start=$num *( $page-1 );

$sql='SELECT mobile from sl_send_mobile GROUP BY mobile ORDER BY id limit '.$start.','.$num;

echo $sql."<br>\n";
$result=DB::getlist($sql);


$mobile='';
        foreach ($result as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    $mobile.=$v1. ',';
                }
               
            }
             $mobile = rtrim($mobile, ',');
         
                   echo $mobile;
           
        

?>