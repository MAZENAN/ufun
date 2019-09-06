<?php

class WxmenuController extends SmcmsController {

    public function indexAction() {
        $this->doact("*");
        $brows = array();
        $rows = DB::getlist('select * from @pf_wxmenu A where pid=0 order by sort asc');
        foreach ($rows as $row) {
            $title = $row['title'];
            $row['title'] = '<b>' . $row['title'] . '</b>';
            $row['create'] = 1;
            $brows[] = $row;
            $temp = DB::getlist('select * from @pf_wxmenu where pid=? order by sort asc', array($row['id']));
            foreach ($temp as $rs) {
                $rs['title'] = '+--- <span class="blu">' . $rs['title'] . '</span>';
                $rs['create'] = 0;
                $brows[] = $rs;
                /* $tempx = DB::getlist('select * from @pf_wxmenu where pid=? order by sort asc', array($rs['id']));
                  foreach ($tempx as $rsx) {
                  $rsx['title'] = '+---+--- ' . $rsx['title'];
                  $rsx['create'] = 0;
                  $brows[] = $rsx;
                  } */
            }
        }
        $this->assign('rows', $brows);
        $this->displayList();
    }

    public function updataAction() {

        $wechatObj = new Wechat();
        $access = $wechatObj->get_access_token();
        //$access ='Yd6yStW8TBeZGo49-PV_bXt9cPsCPK3NYQcxroTNLAJhAxd-nCYIHJ24_OT1ZMog372a924D-nXhwziCc0kK4GQWhYxu-3WZlwJMx85xAK2qs1LMScoIbqgFsJu3buVvKNRdAAARUY';
        if ($access == 1) {
            $this->error('更新菜单失败');
        } else {

            
            $_arr = array();
            $rows = DB::getlist('select * from @pf_wxmenu A where pid=0 and allow=1 order by sort asc');
            foreach ($rows as $key => $row) {
                $_buttom = array();
                $temp = DB::getlist('select * from @pf_wxmenu where pid=? and allow=1 order by sort asc', array($row['id']));
                $_array = array();
  
                foreach ($temp as $skey => $rs) {
                    
                    $url=$rs['url'];
                    if(substr($url,0,5)!="http:"){
                        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.c("APP_ID").'&redirect_uri=http://webchat.51camp.cn/do.html?urlback='.urlencode($rs['url']).'&response_type=code&scope=snsapi_base&state=yeecolor&connect_redirect=1#wechat_redirect';
                    }
                            
                    $_array[$skey] = array(
                        'name' => urlencode($rs['title']),
                        'type' => 'view',
                        'url' => $url
                    );
                }
                $_buttom['name'] = urlencode($row['title']);
                $_buttom['sub_button'] = $_array;
                
                $_arr[] = $_buttom;
            }
           




            $_is = $wechatObj->createmenu($access, $_arr);


            $_data = json_decode($_is);


            if ($_data->errcode == 0) {
                $this->success('更新菜单成功');
            } else {
                $this->error('更新菜单失败');
            }
            //die(11);
        }
    }

    /**
     * @param Model $model
     */
    public function setModel($model) {
        if (IS_GET) {
            $pobts = array();
            $opts2 = DB::getlist('select `id`,title from @pf_wxmenu where id<>? and pid=0 order by sort asc', array($this->id), PDO::FETCH_NUM);
            foreach ($opts2 as $opt) {
                $pobts[] = $opt;
                /* $temp = DB::getlist('select `id`,title from @pf_wxmenu where id<>? and pid=? order by sort asc', array($this->id, $opt[0]), PDO::FETCH_NUM);
                  foreach ($temp as $mopt) {
                  $pobts[] = array($mopt[0], '+--- ' . $mopt[1]);
                  } */
            }

            // print_r($opts2);

            $model->Fields['pid']->options = array_merge($model->Fields['pid']->options, $pobts);
            $pid = empty($_GET['pid']) ? 0 : intval($_GET['pid']);
            $model->Fields['pid']->value = $pid;
            if (Route::get('act') == 'add') {
                list($model->Fields['sort']->default) = DB::getone('select (ifnull(max(sort),0)+10) as mysort from @pf_wxmenu where pid=?', array($pid), PDO::FETCH_NUM);
            }
        }
    }

}
