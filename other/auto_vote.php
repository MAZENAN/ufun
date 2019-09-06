<?php
require_once('include.inc.php');

$result=DB::execute('update @pf_vote set count=count+3 ' );

var_dump(DB::getlastsql());

?>