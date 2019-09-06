<?php

class GoodsSpecController extends SmcmsController{

    public function indexAction() {
        $this->doact('*');
        $gid = IGet('gid');

        $goodsSpects = DB::getlist('SELECT * FROM @pf_goods_spec WHERE goods_id=? ORDER BY pid ASC',[$gid]);
        $arr = [];
        $rows = [];
        foreach($goodsSpects as $v) {
            if($v['pid'] == 0) {
                $v['level'] = '';
                $arr[$v['id']] = $v;
            }else{
                $v['level'] = '+--- ';
                $arr[$v['pid']]['child'][] = $v;
            }

        }
        foreach ($arr as $r){
            $childs = $r['child'];
            unset($r['child']);
            $rows[] = $r;
        if (is_array($childs)){
            foreach($childs as $ch){
                $rows[] = $ch;
            }
}
}

        $this->assign(compact('rows','gid'));
       $this->displayList();
    }

//    public function listData($select) {
//        $goodsId = IGet('gid');
//        $this->assign('gid',$goodsId);
//        $select->where('AND goods_id=?',[$goodsId]);
//        return parent::listData($select);
//    }

    public function addGetAction() {
        $gid = IGet('gid');

        $model = Model($this->ModelName);
        $model->Fields['goods_id']->value = $gid;
        $model->Fields['pid']->options = DB::getopts('@pf_goods_spec','id,title',0,'goods_id=? AND pid=0 AND allow=1',[$gid]);
        $this->setModel($model);
        $this->displayModel($model);
    }

    public function editGetAction() {
        $gid = IGet('gid');
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $model->Fields['pid']->options = DB::getopts('@pf_goods_spec','id,title',0,'goods_id=? AND pid=0 AND allow=1 AND id!=?',[$gid,$this->id]);
        $this->setModel($model);
        $model->action = 'edit';
        $row = $model->getone($this->id);
        $model->setFieldVals($row);
        $this->displayModel($model);
    }
    //COCO 饮料 规格模板
    public function add_cocoGetAction(){
        $gid = IGet('gid');

        $model = Model('Coco');

        $this->setModel($model);
        $this->displayModel($model);
    }
    //COCO 饮料 规格模板
    public function add_cocoPostAction(){

        $goods_id = IPost('goods_id');

        $JiaLiaoPrice = ['X'=>0,'珍珠'=>1,'椰果'=>1,'红豆'=>2,'布丁'=>2,'西米'=>2,'仙草'=>2];

        $insertSpec = false;
        if(isset($_POST['mid_price']) && $_POST['mid_price']!=0){
            $insertSpec = true;
            $insertMid = array('title'=>'中杯','price'=>$_POST['mid_price'],'goods_id'=>$goods_id);
        }
        if(isset($_POST['big_price']) && $_POST['big_price']!=0){
            $insertSpec = true;
            $insertBig = array('title'=>'大杯','price'=>$_POST['big_price'],'goods_id'=>$goods_id);
        }
        if($insertSpec){
            DB::insert('sl_goods_spec',['title'=>'规格','goods_id'=>$goods_id]);
            $lastInsertId = DB::lastId();
            if($lastInsertId && isset($insertMid)){
                $insertMid['pid'] = $lastInsertId;
                DB::insert('sl_goods_spec',$insertMid);
            }
            if($lastInsertId && isset($insertBig)){
                $insertBig['pid'] = $lastInsertId;
                DB::insert('sl_goods_spec',$insertBig);
            }
        }
        if(isset($_POST['jia_liao'])){
            DB::insert('sl_goods_spec',['title'=>'加料','goods_id'=>$goods_id]);
            $JiaLiaoInsertId = DB::lastId();
            foreach ($_POST['jia_liao'] as $value){
                if(isset($JiaLiaoPrice[$value])){
                    DB::insert('sl_goods_spec',['title'=>$value,'price'=>$JiaLiaoPrice[$value],'goods_id'=>$goods_id,'pid'=>$JiaLiaoInsertId]);
                    $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
                }
            }
        }
        if(isset($_POST['wen_du'])) {
            DB::insert('sl_goods_spec', ['title' => '温度', 'goods_id' => $goods_id]);
            $WenDuInsertId = DB::lastId();
            foreach ($_POST['wen_du'] as $value) {

                    DB::insert('sl_goods_spec', ['title' => $value,  'goods_id' => $goods_id, 'pid' => $WenDuInsertId]);
                    $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
                }
            }
        if(isset($_POST['tang_du'])) {
            DB::insert('sl_goods_spec', ['title' => '糖度', 'goods_id' => $goods_id]);
            $TangDuInsertId = DB::lastId();
            foreach ($_POST['tang_du'] as $value) {

                DB::insert('sl_goods_spec', ['title' => $value,  'goods_id' => $goods_id, 'pid' => $TangDuInsertId]);
                $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
            }
        }

        $this->success('插入数据成功');

    }

    //一点点 饮料 规格模板
    public function add_diandianGetAction(){
        $gid = IGet('gid');

        $model = Model('Diandian');

        $this->setModel($model);
        $this->displayModel($model);
    }

    //一点点 饮料 规格模板
    public function add_diandianPostAction(){


        $goods_id = IPost('goods_id');

        $materialChargePrice = ['X'=>0,'布丁'=>8,'奶霜'=>6,'燕麦'=>1];

        $insertSpec = false;
        if(isset($_POST['mid_price']) && $_POST['mid_price']!=0){
            $insertSpec = true;
            $insertMid = array('title'=>'中杯','price'=>$_POST['mid_price'],'goods_id'=>$goods_id);
        }
        if(isset($_POST['big_price']) && $_POST['big_price']!=0){
            $insertSpec = true;
            $insertBig = array('title'=>'大杯','price'=>$_POST['big_price'],'goods_id'=>$goods_id);
        }
        if($insertSpec){
            DB::insert('sl_goods_spec',['title'=>'规格','goods_id'=>$goods_id]);
            $lastInsertId = DB::lastId();
            if($lastInsertId && isset($insertMid)){
                $insertMid['pid'] = $lastInsertId;
                DB::insert('sl_goods_spec',$insertMid);
            }
            if($lastInsertId && isset($insertBig)){
                $insertBig['pid'] = $lastInsertId;
                DB::insert('sl_goods_spec',$insertBig);
            }
        }
        if(isset($_POST['material_charge'])){
            DB::insert('sl_goods_spec',['title'=>'加价配料','goods_id'=>$goods_id]);
            $JiaLiaoInsertId = DB::lastId();
            foreach ($_POST['material_charge'] as $value){
                if(isset($materialChargePrice[$value])){
                    DB::insert('sl_goods_spec',['title'=>$value,'price'=>$materialChargePrice[$value],'goods_id'=>$goods_id,'pid'=>$JiaLiaoInsertId]);
                    $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
                }
            }
        }
        if(isset($_POST['material_free'])) {
            DB::insert('sl_goods_spec', ['title' => '免费配料', 'goods_id' => $goods_id]);
            $TangDuInsertId = DB::lastId();
            foreach ($_POST['material_free'] as $value) {

                DB::insert('sl_goods_spec', ['title' => $value,  'goods_id' => $goods_id, 'pid' => $TangDuInsertId]);
                $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
            }
        }
        if(isset($_POST['wen_du'])) {
            DB::insert('sl_goods_spec', ['title' => '温度', 'goods_id' => $goods_id]);
            $WenDuInsertId = DB::lastId();
            foreach ($_POST['wen_du'] as $value) {

                DB::insert('sl_goods_spec', ['title' => $value,  'goods_id' => $goods_id, 'pid' => $WenDuInsertId]);
                $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
            }
        }
        if(isset($_POST['tang_du'])) {
            DB::insert('sl_goods_spec', ['title' => '糖度', 'goods_id' => $goods_id]);
            $TangDuInsertId = DB::lastId();
            foreach ($_POST['tang_du'] as $value) {

                DB::insert('sl_goods_spec', ['title' => $value,  'goods_id' => $goods_id, 'pid' => $TangDuInsertId]);
                $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
            }
        }

        $this->success('插入数据成功');

    }

    //快乐柠檬 饮料 规格模板
    public function add_lemonGetAction(){
        $gid = IGet('gid');

        $model = Model('Lemon');

        $this->setModel($model);
        $this->displayModel($model);
    }
    //快乐柠檬 饮料 规格模板
    public function add_lemonPostAction(){


        $goods_id = IPost('goods_id');

        $materialPrice = ['X'=>0,'Q果'=>1,'红豆'=>1,'OREO'=>1,'珍珠'=>2,'布丁'=>2,'芋圆'=>3,'芝士'=>6,'轻奶霜'=>6,];

        $insertSpec = false;
        if(isset($_POST['mid_price']) && $_POST['mid_price']!=0){
            $insertSpec = true;
            $insertMid = array('title'=>'中杯','price'=>$_POST['mid_price'],'goods_id'=>$goods_id);
        }
        if(isset($_POST['big_price']) && $_POST['big_price']!=0){
            $insertSpec = true;
            $insertBig = array('title'=>'大杯','price'=>$_POST['big_price'],'goods_id'=>$goods_id);
        }
        if($insertSpec){
            DB::insert('sl_goods_spec',['title'=>'规格','goods_id'=>$goods_id]);
            $lastInsertId = DB::lastId();
            if($lastInsertId && isset($insertMid)){
                $insertMid['pid'] = $lastInsertId;
                DB::insert('sl_goods_spec',$insertMid);
            }
            if($lastInsertId && isset($insertBig)){
                $insertBig['pid'] = $lastInsertId;
                DB::insert('sl_goods_spec',$insertBig);
            }
        }
        if(isset($_POST['material'])){
            DB::insert('sl_goods_spec',['title'=>'加料','goods_id'=>$goods_id]);
            $JiaLiaoInsertId = DB::lastId();
            foreach ($_POST['material'] as $value){
                if(isset($materialPrice[$value])){
                    DB::insert('sl_goods_spec',['title'=>$value,'price'=>$materialPrice[$value],'goods_id'=>$goods_id,'pid'=>$JiaLiaoInsertId]);
                    $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
                }
            }
        }
        if(isset($_POST['wen_du'])) {
            DB::insert('sl_goods_spec', ['title' => '温度', 'goods_id' => $goods_id]);
            $WenDuInsertId = DB::lastId();
            foreach ($_POST['wen_du'] as $value) {

                DB::insert('sl_goods_spec', ['title' => $value,  'goods_id' => $goods_id, 'pid' => $WenDuInsertId]);
                $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
            }
        }
        if(isset($_POST['tang_du'])) {
            DB::insert('sl_goods_spec', ['title' => '糖度', 'goods_id' => $goods_id]);
            $TangDuInsertId = DB::lastId();
            foreach ($_POST['tang_du'] as $value) {

                DB::insert('sl_goods_spec', ['title' => $value,  'goods_id' => $goods_id, 'pid' => $TangDuInsertId]);
                $lastInsertId = DB::lastId();//同步 防止 循环执行太快 丢失数据 DB 类不支持多条插入
            }
        }

        $this->success('插入数据成功');

    }
}