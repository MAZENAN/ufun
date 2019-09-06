<?php

function smarty_function_battery($params) {
    
    if ($params['args']>=100){
		
		return "5";
		
	}else if ($params['args']>=80){
		
		return "4";
		
	}else if ($params['args']>=50){
		
		return "3";
		
	}else if ($params['args']>=30){
		
		return "2";
		
	}else if ($params['args']>=20){
		
		return "1";
		
	}
}
