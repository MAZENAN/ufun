<?php
require_once(ROOT_DIR . 'service/geo_hash.php');

class SchoolController extends SmcmsController{

    public function beforeSaveModel($model) {
       $lng =  $model->Fields['lng']->value;
       $lat =  $model->Fields['lat']->value;
       $geo = new Geohash();
       $hash =$geo->encode($lat,$lng);
       $model->Fields['geohash']->value = $hash;
    }
}