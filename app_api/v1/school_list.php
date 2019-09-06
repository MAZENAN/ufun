<?php
/**
 * 学校列表
 */
require_once('base.php');

$obj = new stdClass;
$obj->status = 500;

//$school_rows = DB::getlist("SELECT id,CONCAT(title,IFNULL(campaus,'')) AS name FROM @pf_school WHERE allow=1");
//$obj->data['list'] = $school_rows;
//
//$obj->status = 200;
//CommonUtil::return_info($obj);
$do = isset($_POST['do']) ? trim($_POST['do']) : '';

try{
    switch ($do){
        case 'location':
            location();
            break;
        case 'all':
            all();
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    print_r($e->getMessage());
}


$obj->status = 200;
CommonUtil::return_info($obj);

function location() {
    global $obj;

    $lng = isset($_POST['lng']) ? FPost('lng') : null;
    $lat = isset($_POST['lat']) ? FPost('lat') : null;
    $n = IPost('n',2);
    if (is_null($lng) || is_null($lat)){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    require_once(ROOT_DIR . 'service/geo_hash.php');
    $geo = new Geohash();
    $hash = $geo->encode($lat,$lng);
    $like_geohash = substr($hash, 0, $n);
    $school_rows = DB::getlist("SELECT id,title AS name,lat,lng FROM @pf_school WHERE allow=1 AND geohash LIKE '$like_geohash%'");
//算出实际距离
    foreach($school_rows as $key =>$v) {
        $distance = Comm::getDistance($lat, $lng, $v['lat'], $v['lng']);
        $school_rows[$key]['distance'] = $distance;
        //排序列
        $sortdistance[$key] = $distance;
    }
//距离排序
    array_multisort($sortdistance,SORT_ASC,$school_rows);
    foreach ($school_rows as $k=>$v){
        unset($school_rows[$k]['lat']);
        unset($school_rows[$k]['lng']);
        $school_rows[$k]['distance'] = Comm::formatDis($v['distance']);
    }
    $obj->data = ['list'=>$school_rows];

}

function all(){
    global $obj;

    $school_ret = [];
    $p_rows = DB::getlist('SELECT id,name FROM @pf_area WHERE pid=0');
    $temp_id = [];
    foreach ($p_rows as $k=>$v){
       $temp_id[0] = $v['id'];
       $c_rows = DB::getlist('SELECT id,name FROM @pf_area WHERE pid=' . $v['id']);
       foreach ($c_rows as $vv){
          $temp_id[1] = $vv['id'];
            $school_rows = DB::getlist('SELECT id,title FROM @pf_school WHERE area=?',[json_encode($temp_id)]);
           $school_ret[$v['name']][$vv['name']] = $school_rows;
       }
    }

    $obj->data = ['list'=>$school_ret];
}


