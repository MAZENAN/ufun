<?php

function smarty_function_average($params) {
    
	

   
   return   round($params['expenses'] /  $params['fund']);
   
}
