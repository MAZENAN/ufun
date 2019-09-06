<?php

//后台系统基类================
abstract class AdmController extends Controller {

    public $AdmID = 0;

    public function isLogin() {
        if (!isset($_SESSION)) {
            @session_start();
        }
        $sessname = C('RBAC_SESSION_NAME');
        if (empty($_SESSION [$sessname])) {
            if (isset($_SESSION ['ERR']) && $_SESSION ['ERR'] > 5) {
                header('HTTP/1.0 401 Unauthorized');
                die('错误次数过多！无法登陆，请改天再试');
            }
            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') {
                $this->display('login.tpl');
                exit;
            } else {
                $username = isset($_POST['username']) ? $_POST['username'] : '';
                $pass = isset($_POST['password']) ? $_POST['password'] : '';
                $code = isset($_POST['code']) ? $_POST['code'] : '';
                if ($username != '' && $pass != '') {
                    if ($code == '') {
                        $this->alert('验证码不能为空!');
                    }
                    if (strtolower($code) != strtolower($_SESSION['validationcode'])) {
                        $_SESSION['validationcode'] = '';
                        $this->alert('验证码不正确');
                    }
                    $row = DB::getone('select * from @pf_manage where `name`=?', array($username));
                    if ($row != null) {
                        /*  if ($row['errtice'] > 5) {
                          $this->alert('登录错误次数过多!');
                          } */
                        if ($row['pwd'] == md5($pass)) {
                            $this->setLogin($row['id']);
                            $_SESSION['group'] = $row['type'];
                            $_SESSION['email'] = $row['email'];
                            DB::update('@pf_manage', array('errtice' => 0,
                                'lastip' => DB::sql('thisip'),
                                'lasttime' => DB::sql('thistime'),
                                'thisip' => Funcs::getIP(),
                                'thistime' => DB::sql('now()')
                                    ), $row['id']);
                            unset($_SESSION ['ERR']);
                            header("location:" . $_SERVER['REQUEST_URI']);
                            exit;
                        } else {
                            DB::update('@pf_manage', array('errtice' => DB::sql('ifnull(errtice,0)+1')), $row['id']);
                            $_SESSION ['ERR'] = isset($_SESSION ['ERR']) ? $_SESSION ['ERR'] + 1 : 1;
                            $this->alert('登录密码错误');
                        }
                    }
                }
                $_SESSION ['ERR'] = isset($_SESSION ['ERR']) ? $_SESSION ['ERR'] + 1 : 1;
                $this->alert('登录用户名或密码为空!');
            }
        }
        $this->AdmID = intval($_SESSION [$sessname]);
        return $this->AdmID;
    }

    //执行权限检查
    public function rbac_check() {
        //ID是1的账号自动具备超级权限==
        if ($this->AdmID == 1) {
            return;
        }
        $ctl = Route::get('ctl');
        $act = Route::get('act');
        if ($act == 'index' || $act == '') {
            $path = $ctl;
        } else {
            $path = $ctl . '/' . $act;
        }
        if (!RBAC::check($path, 'opt')) {
            $this->error('您没有足够的权限执行此操作！', __APPROOT__ . '/index/welcome');
        }
    }

    public function setLogin($aid) {
        if (!isset($_SESSION)) {
            @session_start();
        }
        $_SESSION[C('RBAC_SESSION_NAME')] = $aid;
    }

    public function setLogout() {
        if (!isset($_SESSION)) {
            @session_start();
        }
        $_SESSION[C('RBAC_SESSION_NAME')] = '';
        unset($_SESSION[C('RBAC_SESSION_NAME')]);
        // RBAC::cleanAuth();
        die('<html><head><script type="text/javascript">alert("退出系统成功");top.window.location="' . __APPROOT__ . '/";</script></head><body></body></html>');
    }

    public function returnDialog($value, $msg) {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
alert("' . $msg . '");
window.returnValue=' . json_encode($value) . ';
window.onload=function(){window.setTimeout(function(){window.close();},100);}
 </script>';
        exit;
    }

}
