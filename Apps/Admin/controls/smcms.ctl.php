<?php

abstract class SmcmsController extends AdmController {

    var $tpl_key = NULL;
    var $ModelName = NULL;
    var $id = 0;
    var $sch = array();
    private $_list_model = null;

    /**
     * 初始化
     * @param string $tplkey  //列表标识符
     * @param string $modelname //模型名称
     */
    public function __construct($tplkey = NULL, $modelname = NULL) {
        if (!empty($tplkey)) {
            $this->tpl_key = $tplkey;
        }
        if (!empty($modelname)) {
            $this->ModelName = $modelname;
        }
        $this->isLogin();
        $this->id = IReq('id');
        if (empty($this->tpl_key)) {
            $this->tpl_key = to_camel(Route::get('ctl'));
        }
        $file = correct_file(APP_DIR . 'lists/' . to_under($this->tpl_key) . '.list.php');
        if (file_exists($file)) {
            $this->_list_model = require $file;
        }
        if (empty($this->ModelName)) {
            $this->ModelName = $this->_list_model['model'];
        }
        $this->rbac_check();
    }

    /**
     * 呈现列表
     * @param string $key 列表 key 标识符 一般留空，即默认控制器对于的列表标识符
     * @param string $extends 使用的母板
     */
    public function displayList($key = NULL, $extends = NULL) {
        if ($this->_smarty == NULL) {
            $this->initSmarty();
        }
        if (empty($key)) {
            $key = $this->tpl_key;
        }
        $tplname = 'layout/' . to_under($key) . '_list.tpl';
        $this->display($tplname);
    }

    //拷贝模型
    private function copyModel($model, $searchdata) {
        $model->init();
        //创建搜索模型项
        $schmodel = new Model();
        //从字段模型中提取筛选的字段
        foreach ($searchdata as $rs) {
            $name = $rs['name'];
            if (empty($name)) {
                $name = $rs['boxname'];
                //throw new Exception('列表模型配置中没有选定字段名称');
            }
            $boxname = empty($rs['boxname']) ? $name : $rs['boxname'];
            //默认字段属性
            $attr = array(
                'type' => $rs['type'],
                'name' => $boxname,
                'boxname' => $boxname,
                'id' => $boxname,
                'close_html' => false,
                'close' => false,
                'dbfield' => true,
                'class' => '',
                'data_val' => null,
                'data_vals' => null,
                'data_val_msg' => null,
                'data_val_msgs' => null,
                'default' => null,
            );
            if ($rs['type'] == 'hidden') {
                $attr['data_url'] = '';
            }
            if ($rs['options'] != '') {
                $attr['options'] = $rs['options'];
            }
            //提取模型字段
            $field = $model->getfield($name);
            if ($field === null) {
                $nfield = new ModelField($attr, $schmodel);
            } else {
                //拷贝 不要修改原字段模型
                $nfield = $field->copy($attr, $schmodel);
            }
            //将字段加入到搜索模型中
            $schmodel->addfield($boxname, $nfield);
        }
        //自动完成表单
        $schmodel->autoComplete($this->sch);
        //注册搜索模型到模板中
        $schmodel->assignTo($this, 'schmodel');
        return $schmodel;
    }

    //列表页面
    public function indexAction() {
        $this->doact('*');
        if (SGet('client')&&!SGet('title')) {
            $this->display('layout/camp_select_list.tpl');
            return;
        }
        $model = Model($this->ModelName, 0, false);
        //处理自动搜索----------
        $sqlcoms = '*';
        $tbname = '@pf_' . $model->tbname;
        $select = new Select($tbname);
        $select->find($sqlcoms);

        if (!empty($this->_list_model['search'])) {
            $searchdata = $this->_list_model['search'];
            if (gettype($searchdata) == 'array' && count($searchdata) > 0) {
                $schmodel = $this->copyModel($model, $searchdata);
                foreach ($searchdata as $rs) {
                    $name = $rs['name'];
                    $boxname = empty($rs['boxname']) ? $name : $rs['boxname'];
                    if ($rs['type'] != 'linkage') {
                        $fname = $name;
                        $this->addsearch($select, $rs['schtp'], $fname, $boxname);
                    } else {
                        $field = $schmodel->getfield($name);
                        if ($field !== null) {
                            $names = $field->names;
                            if (gettype($names) == 'array') {
                                foreach ($names as $fid) {
                                    $fname = $fid;
                                    $this->addsearch($select, $rs['schtp'], $fname, $fid);
                                }
                            }
                        }
                    }
                }
            }
        }
        $ret = $this->listData($select);
        if ($ret['pagelist']) {
            $list = $select->getPagelist($ret['size'], $ret['pagekey'], $ret['count'], $ret['only_count']);
            $rows = $list->getlist();
            $this->assign('bar', $list->getinfo());
        } else {
            $rows = $select->getlist();
        }
        $this->assign('sch', $this->sch);

        //分销商-城市
        foreach ($rows as $key => $value) {
            $area = str_replace(array('[',']','"','"'), '', $value['area']);
            $arr = explode(',',$area);
            $rows[$key]['province'] = $arr[0];
            $rows[$key]['city'] = $arr[1];
        }
        if (!SGet('client')) {
            $this->assign('rows', $rows);
            $this->displayList();
        }else{
            foreach ($rows as &$rs) {
                $rs['times'] = Comm::getCampDate('glcamp', $rs['id']);
            }
            $this->assign('rows', $rows);
            $this->display('layout/camp_select_list.tpl');
        }
    }

    //处理自动筛选
    private function addsearch($select, $schtp, $name, $boxname) {
        if (isset($this->sch[$boxname])) {
            $val = trim($this->sch[$boxname]);
            switch ($schtp) {
                case 0:
                    $select->like_search("and `{$name}` like ?", $val);
                    break;
                case 1:
                    $select->search("and `{$name}` = ?", $val, Select::SEARCH_NOT_EMPTY_STRING);
                    break;
                case 2:
                    $select->search("and `{$name}` = ?", $val, Select::SEARCH_NOT_ZERO);
                    break;
                case 3:
                    $select->search("and `{$name}` = ?", $val, Select::SEARCH_NOT_EMPTY);
                    break;
                case 4:
                    $select->search("and `{$name}` > ?", $val);
                    break;
                case 5:
                    $select->search("and `{$name}` < ?", $val);
                    break;
                case 6:
                    $select->search("and `{$name}` >= ?", $val);
                    break;
                case 7:
                    $select->search("and `{$name}` <= ?", $val);
                    break;
                case 8:
                    $select->search("and `{$name}` <> ?", $val);
                    break;
                case 10:
                    $select->search("and `{$name}` > ?", $val);
                    break;
                case 11:
                    $select->search("and `{$name}` < date_add(?, INTERVAL 1 day)", $val);
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * 
     * @param Select $select
     * @return array
     */
    public function listData($select) {
        $ret = array();
        $ret['pagelist'] = false;
        $ret['size'] = 20;
        $ret['pagekey'] = 'page';
        $ret['count'] = -1;
        $ret['only_count'] = -1;
        $row = $this->_list_model;
        $ret['pagelist'] = $row['usingfy'] == 1 ? true : false;
        if (!empty($row['orderby'])) {
            $select->orderby($row['orderby']);
        }
        if ($row['usesql'] != 1 || empty($row['sql'])) {
            return $ret;
        }
        $select->setSql($row['sql']);
        $args = array();
        if (is_array($row['sqlargs'])) {
            $args = $row['sqlargs'];
        }
        $select->setArgs($args);
        return $ret;
    }

    //修正模型数据
    public function setModel($model) {
        
    }

    public function beforeSaveModel($model) {
        
    }

    public function addGetAction() {
        $model = Model($this->ModelName);
        $this->setModel($model);
        $this->displayModel($model);
    }

    public function addPostAction() {
        $model = Model($this->ModelName);
        $this->setModel($model);
        $model->autoComplete();
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $model->add();
        $this->success('插入数据成功');
    }

    public function editGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';
        $row = $model->getone($this->id);
        $model->setFieldVals($row);
        $this->displayModel($model);
    }

    public function showGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        foreach ($model->Fields as $key => $field) {
            if ($field->type == Model::TextArea_Box) {
                $field->value = str_replace(" ", "&nbsp;", str_replace(array("\r\n", "\n", "\r"), '<br>', htmlspecialchars($field->value)));
            }
            $field->type = Model::Label_Box;
        }
        $this->setModel($model);
        $model->action = '';
        $row = $model->getone($this->id);
        $model->setFieldVals($row);
        $this->displayModel($model, '@model_show.tpl');
    }

    public function editPostAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->autoComplete();
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $model->update($this->id);
        $this->success('编辑数据成功');
    }

    public function deleteAction() {
        $model = Model($this->ModelName);
        $model->delete($this->id);
        $this->success('删除数据成功');
    }

    //排序
    public function upsortAction() {
        $model = Model($this->ModelName);
        $model->upsort($this->id);
        $this->success();
    }

    public function dnsortAction() {
        $model = Model($this->ModelName);
        $model->dnsort($this->id);
        $this->success();
    }

    //排序
    public function upsortbypidAction() {
        $model = Model($this->ModelName);
        $model->upsortByPid($this->id);
        $this->success();
    }

    public function dnsortbypidAction() {
        $model = Model($this->ModelName);
        $model->dnsortByPid($this->id);
        $this->success();
    }

    public function editsortAction() {
        $sort = empty($_REQUEST['sort']) ? 0 : intval($_REQUEST['sort']);
        if ($sort == 0) {
            $this->alert('数据提交有误!');
        }
        $model = Model($this->ModelName);
        $model->editsort($this->id, $sort);
        $this->success();
    }

    public function updatesortAction() {
        $ids = $this->getids();
        $sorts = empty($_REQUEST['sort']) ? '' : $_REQUEST['sort'];
        $sortarrs = explode(',', $sorts);
        $model = Model($this->ModelName);
        foreach ($ids as $key => $id) {
            $sort = intval(empty($sortarrs[$key]) ? 0 : $sortarrs[$key]);
            $model->editsort($id, $sort);
        }
        $this->success();
    }

    public function selected_deleteAction() {
        $ids = $this->getids();
        $model = Model($this->ModelName);
        foreach ($ids as $id) {
            $model->delete($id);
        }
        $this->success();
    }

    public function getids() {
        $ids = empty($_REQUEST['ids']) ? '' : $_REQUEST['ids'];
        $idsarr = explode(',', $ids);
        foreach ($idsarr as $key => $idstr) {
            $idsarr[$key] = intval($idstr);
        }
        return $idsarr;
    }

    public function seton_allowAction() {
        $model = Model($this->ModelName);
        $model->setON($this->id, 'allow');
        $this->success();
    }

    public function setoff_allowAction() {
        $model = Model($this->ModelName);
        $model->setOFF($this->id, 'allow');
        $this->success();
    }

    public function selectedon_allowAction() {
        $model = Model($this->ModelName);
        $ids = $this->getids();
        $model->setArrON($ids, 'allow');
        $this->success();
    }

    public function selectedoff_allowAction() {
        $model = Model($this->ModelName);
        $ids = $this->getids();
        $model->setArrOFF($ids, 'allow');
        $this->success();
    }

    public function editfieldAjaxAction() {
        $field = isset($_REQUEST['boxname']) ? $_REQUEST['boxname'] : '';
        if (empty($field) || !preg_match('@^[a-z_]+$@', $field)) {
            return array('err' => '缺少控件名称或名称不符');
        }
        $val = isset($_REQUEST[$field]) ? $_REQUEST[$field] : '';
        $model = Model($this->ModelName);
        $model->updateFiled($this->id, $field, $val);
        return array('err' => '', 'val' => $val);
    }

    // 权限认证方法
    public function rbac_check() {
        if ($this->AdmID == 1) {
            return;
        }
        $select = new Select('@pf_node');
        $act = '^([a-z0-9_]+\\|)*' . Route::get('act') . '(\\|[a-z0-9_]+)*$';
        $select->where('and `controller`=? and `model` regexp ?', array(Route::get('ctl'), $act));
        if (SGet('type')) {
            $select->search('and parameter=?', 'type');
            $select->search('and value=?', SGet('type'));
        }
        if (SGet('key')) {
            $select->search('and parameter=?', 'key');
            $select->search('and value=?', SGet('key'));
        }
        $row = $select->getone();
        $node = DB::getone('select id from @pf_group_node where `group`=? and `node`=?', array($_SESSION['group'], $row['id']));
        if (!$node) {
            $this->error("您没有足够的权限进行此操作！", __APPROOT__ . '/index/welcome');
        }
    }
    public function exchangeHost(){

        $string=$_SERVER['HTTP_HOST'];
        if (strpos($string, '51camp')) {
            $string=preg_replace('/(www.|test.)(51camp.cn)/i', "\${2}", $string);
        }else{
            $string=preg_replace('/(www.)(test.com)/i', "\${2}", $string);
        }
       return $string;
    }

}
