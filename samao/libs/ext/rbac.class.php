<?php

@session_start();

defined('RBAC_CACHE_TYPE') or define('RBAC_CACHE_TYPE', C('RBAC_CACHE_TYPE'));
defined('RBAC_SESSION_NAME') or define('RBAC_SESSION_NAME', C('RBAC_SESSION_NAME'));
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rbac
 *
 * @author wj354
 */
class RBAC {

    //获取用户所有角色==
    protected static function getRoles($uid) {
        $row = DB::getone('select `group`,roles from @pf_manage where id=?', array($uid));
        if ($row == null) {
            return array();
        }
        $role1 = $row['roles'];
        $role2 = DB::getval('select roles from @pf_group where id=?', array($row['group']));
        $roles1 = empty($role1) ? array() : json_decode($role1, TRUE);
        $roles2 = empty($role2) ? array() : json_decode($role2, TRUE);
        $roles = array_merge($roles1, $roles2);
        return array_unique($roles);
    }

    //获取角色权限节点
    protected static function getAuthnoteByRole($roleid) {
        $row = DB::getone('select authnotes from @pf_role where id=?', array($roleid));
        if ($row == null) {
            return array();
        }
        $ret = $row['authnotes'];
        $rets = empty($ret) ? array() : json_decode($ret, TRUE);
        return $rets;
    }

    protected static function getAuthnoteByUser($uid) {
        $note = array();
        $roles = self::getRoles($uid);
        foreach ($roles as $roleid) {
            $temp = self::getAuthnoteByRole($roleid);
            if (isset($temp[0])) {
                $note = array_merge($note, $temp);
            }
        }
        return array_unique($note);
    }

    //获取所有资源
    protected static function getResourceByAuthnote($noteid) {
        $row = DB::getone('select resource_ids from @pf_authnote where id=?', array($noteid));
        if ($row == null) {
            return array();
        }
        $ret = $row['resource_ids'];
        $rets = empty($ret) ? array() : json_decode($ret, TRUE);
        return $rets;
    }

    //获取所有操作
    protected static function getOperationByAuthnote($noteid) {
        $row = DB::getone('select operation_ids from @pf_authnote where id=?', array($noteid));
        if ($row == null) {
            return array();
        }
        $ret = $row['operation_ids'];
        $rets = empty($ret) ? array() : json_decode($ret, TRUE);
        return $rets;
    }

    //获取所有有效资源
    protected static function getResourceByUser($uid) {
        $ress = array();
        $notes = self::getAuthnoteByUser($uid);
        foreach ($notes as $noteid) {
            $temp = self::getResourceByAuthnote($noteid);
            if (isset($temp[0])) {
                $ress = array_merge($ress, $temp);
            }
        }
        return array_unique($ress);
    }

    //获取所有有效操作
    protected static function getOperationByUser($uid) {
        $opts = array();
        $notes = self::getAuthnoteByUser($uid);
        //print_r($notes);
        foreach ($notes as $noteid) {
            $temp = self::getOperationByAuthnote($noteid);
            if (isset($temp[0])) {
                $opts = array_merge($opts, $temp);
            }
        }
        return array_unique($opts);
    }

    protected static function getAllAuth($uid) {
        return array('res' => self::getResourceByUser($uid), 'opt' => self::getOperationByUser($uid));
    }

    protected static function initAllAuth($uid) {
        $ress = self::getResourceByUser($uid);
        $opts = self::getOperationByUser($uid);
        $resnames = array();
        $optnames = array();
        if (isset($ress[0])) {
            $resnames = DB::getlist('select code from @pf_resource where id in(' . join(',', $ress) . ')', array(), PDO::FETCH_COLUMN);
        }
        if (isset($opts[0])) {
            $optnames = DB::getlist('select code from @pf_operation where id in(' . join(',', $opts) . ')', array(), PDO::FETCH_COLUMN);
        }
        $str_resnames = '';
        if (in_array('*', $resnames)) {
            $str_resnames = '*';
        }
        $str_optnames = '';
        if (in_array('*', $optnames)) {
            $str_optnames = '*';
        }
        if ($str_resnames == '*' && $str_optnames == '*') {
            $authdata = '*';
        } elseif ($str_resnames == '*') {
            $authdata = array('res' => '*', 'opt' => $optnames);
        } elseif ($str_resnames == '*') {
            $authdata = array('res' => $resnames, 'opt' => '*');
        } else {
            $authdata = array('res' => $resnames, 'opt' => $optnames);
        }

        if (RBAC_CACHE_TYPE == 'DB') {
            DB::replace('@pf_authcache', array('user_id' => $uid, 'authdata' => serialize($authdata)));
        } else {
            $RBAC_SESSION_NAME = RBAC_SESSION_NAME == '' ? 'WEB' : RBAC_SESSION_NAME;
            $_SESSION[$RBAC_SESSION_NAME . '_AuthData'] = $authdata;
        }
        return $authdata;
    }

    //检查权限==
    public static function check($checkname, $type = 'res') {

        static $_RES = array();
        static $_OPT = array();var_dump($_RES[$checkname],$_OPT[$checkname]);die();
        if ($type == 'res' && isset($_RES[$checkname])) {
            return $_RES[$checkname];
        }
        if ($type == 'opt' && isset($_OPT[$checkname])) {
            return $_OPT[$checkname];
        }

        $RBAC_SESSION_NAME = RBAC_SESSION_NAME == '' ? 'WEB' : RBAC_SESSION_NAME;
        $uid = empty($_SESSION[$RBAC_SESSION_NAME]) ? 0 : $_SESSION[$RBAC_SESSION_NAME];
        //ID是1的具备超级管理员权限
        if ($uid == 1) {
            if ($type == 'res') {
                $_RES[$checkname] = true;
            }
            if ($type == 'opt') {
                $_OPT[$checkname] = true;
            }
            return true;
        }

        if ($uid == 0) {
            if ($type == 'res') {
                $_RES[$checkname] = false;
            }
            if ($type == 'opt') {
                $_OPT[$checkname] = false;
            }
            return false;
        }
        $authdata = array();
        if (RBAC_CACHE_TYPE == 'DB') {
            $temp = DB::getone('select authdata from @pf_authcache where user_id=?', array($uid));
            if ($temp == null) {
                if ($type == 'res') {
                    $_RES[$checkname] = false;
                }
                if ($type == 'opt') {
                    $_OPT[$checkname] = false;
                }
                return false;
            }
            if ($temp['authdata'] == '') {
                if ($type == 'res') {
                    $_RES[$checkname] = false;
                }
                if ($type == 'opt') {
                    $_OPT[$checkname] = false;
                }
                return false;
            }
            $authdata = unserialize($temp['authdata']);
        } else {
            $authdata = empty($_SESSION[$RBAC_SESSION_NAME . '_AuthData']) ? '' : $_SESSION[$RBAC_SESSION_NAME . '_AuthData'];
        }
        //如果是全授权==========
        if (gettype($authdata) == 'string') {
            if ($authdata == '*') {
                if ($type == 'res') {
                    $_RES[$checkname] = true;
                }
                if ($type == 'opt') {
                    $_OPT[$checkname] = true;
                }
                return true;
            }
        }

        //不存在设置项的情况====
        if (!isset($authdata[$type])) {
            if ($type == 'res') {
                $_RES[$checkname] = false;
            }
            if ($type == 'opt') {
                $_OPT[$checkname] = false;
            }
            return false;
        }

        //全部授权的情况========
        if (gettype($authdata[$type]) == 'string') {
            if ($authdata[$type] == '*') {
                if ($type == 'res') {
                    $_RES[$checkname] = true;
                }
                if ($type == 'opt') {
                    $_OPT[$checkname] = true;
                }
                return false;
            }
        }

        if (in_array($checkname, $authdata[$type])) {
            if ($type == 'res') {
                $_RES[$checkname] = true;
            }
            if ($type == 'opt') {
                $_OPT[$checkname] = true;
            }
            return true;
        }

        //处理多项操作==
        if ($type == 'opt') {
            foreach ($authdata[$type] as $value) {
                if (strpos($value, '|') !== FALSE) {
                    $paths = explode('/', $value);
                    if (isset($paths[1])) {
                        $acts = explode('|', $paths[1]);
                        foreach ($acts as $act) {
                            $path = $paths[0] . '/' . $act;
                            if ($path == $checkname) {
                                $_OPT[$checkname] = true;
                                return true;
                            }
                        }
                    }
                }
            }
        }


        if ($type == 'res') {
            $_RES[$checkname] = false;
        }
        if ($type == 'opt') {
            $_OPT[$checkname] = false;
        }
        return false;
    }

    public static function startAuth($uid) {
        $RBAC_SESSION_NAME = RBAC_SESSION_NAME == '' ? 'WEB' : RBAC_SESSION_NAME;
        $_SESSION[$RBAC_SESSION_NAME] = $uid;
        self::initAllAuth($uid);
    }

    public static function cleanAuth() {
        session_destroy();
    }

}
