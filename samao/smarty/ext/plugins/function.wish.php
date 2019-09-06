<?php

function smarty_function_wish($params) {
    
	$mid =$params['mid'];
	
    if ($params['args']=='all'){
		
		
				$sch = array();
        $sch['pid'] = $_REQUEST['pid'];
        $sch['mid'] = $_REQUEST['mid'];
        $sch['tgname'] = '';
        if ($sch['mid'] != 0) {
            $sch['tgname'] = DB::getval('@pf_wish_group', 'name', $sch['mid']);
        }
        $select = new Select('@pf_wish_child A,@pf_wish B');
        $select->find('A.*');
        $select->group('A.id');
        $select->where('and A.id=B.children and ((B.allow=1 and B.wished=0) or contributions=1) and A.allow=1');
        if ($sch['pid'] != 0) {
            $select->where('and B.forum=?', array($sch['pid']));
        }
        if ($sch['tgname'] != '') {
            $select->where('and B.name=?', array($sch['tgname']));
        }
		
        $str = ( $select->getPagelist(20)->getinfo());
		
		
		

		$sch = array();
        $sch['pid'] = $_REQUEST['pid'];
        $sch['mid'] = $_REQUEST['mid'];
        $sch['tgname'] = '';
        if ($sch['mid'] != 0) {
            $sch['tgname'] = DB::getval('@pf_wish_group', 'name', $sch['mid']);
        }
        $select = new Select('@pf_wish_child A,@pf_wish B');
        $select->find('A.*');
        $select->group('A.id');
        $select->where('and A.id=B.children and ((B.allow=1 and B.wished=0) or contributions=1) and A.allow=0');
        if ($sch['pid'] != 0) {
            $select->where('and B.forum=?', array($sch['pid']));
        }
        if ($sch['tgname'] != '') {
            $select->where('and B.name=?', array($sch['tgname']));
        }
		
        $str2 = ( $select->getPagelist(20)->getinfo());
		
		return $str2['records_count'] + $str['records_count'];

		
	}else if ($params['args']=='real'){
		
		$sch = array();
        $sch['pid'] = $_REQUEST['pid'];
        $sch['mid'] = $_REQUEST['mid'];
        $sch['tgname'] = '';
        if ($sch['mid'] != 0) {
            $sch['tgname'] = DB::getval('@pf_wish_group', 'name', $sch['mid']);
        }
        $select = new Select('@pf_wish_child A,@pf_wish B');
        $select->find('A.*');
        $select->group('A.id');
        $select->where('and A.id=B.children and ((B.allow=1 and B.wished=0) or contributions=1) and A.allow=0');
        if ($sch['pid'] != 0) {
            $select->where('and B.forum=?', array($sch['pid']));
        }
        if ($sch['tgname'] != '') {
            $select->where('and B.name=?', array($sch['tgname']));
        }
		
        $str = ( $select->getPagelist(20)->getinfo());
		
		return $str['records_count'];
		
	}else if ($params['args']=='ach'){
		
		$sch = array();
        $sch['pid'] = $_REQUEST['pid'];
        $sch['mid'] = $_REQUEST['mid'];
        $sch['tgname'] = '';
        if ($sch['mid'] != 0) {
            $sch['tgname'] = DB::getval('@pf_wish_group', 'name', $sch['mid']);
        }
        $select = new Select('@pf_wish_child A,@pf_wish B');
        $select->find('A.*');
        $select->group('A.id');
        $select->where('and A.id=B.children and ((B.allow=1 and B.wished=0) or contributions=1) and A.allow=1');
        if ($sch['pid'] != 0) {
            $select->where('and B.forum=?', array($sch['pid']));
        }
        if ($sch['tgname'] != '') {
            $select->where('and B.name=?', array($sch['tgname']));
        }
		
        $str = ( $select->getPagelist(20)->getinfo());
	   
		
		return $str['records_count'];
		
	}
}
