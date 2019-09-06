<?php

//require_once('PdbcTemplate.php');
  define('TOKEN_200',"1"); 
  define('TOKEN_505', "0"); 
  define('TOKEN_508', "2"); 
class Session{
	
	public static function set_token($uid) 
	{

			$row = DB::getone('select id from @pf_session where uid=? ', array($uid));
			
			$token = md5($uid.time().mt_rand(1, 10000));
   			if (!empty($row))
   			 {
            $vals = array();
            $vals['session'] = $token;
            $vals['create_time'] = time();
            $vals['uid'] = $uid;
            $result=DB::update('@pf_session', $vals, $row['id']);
   			 }
   			 else
   			 {
            $vals = array();
            $vals['session'] = $token;
            $vals['create_time'] = time();
            $vals['uid'] = $uid;
            $result=DB::insert('@pf_session', $vals);
   			 }

        return $token;
}



	public static function valid_token($uid,$sign_sn) 
	{  
    	$result = DB::getone('select session from @pf_session where uid=? ', array($uid));
   		if (empty($result))
   		{
   			return 0;
   		}
   		if($result['session']!=$sign_sn)
   		{
   			 return 2;
   		}
         return 1; 
     } 

     public static function del_token($uid) 
	{  
		DB::delete('@pf_session','uid=?', array($uid));

    }  	 	
}
?>
