<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
$period = array ();
global $current_user;
//if($current_user->isAdmin()==1){
    
  
                   
$db_start = to_db_time("00","00","");
		$db_end = to_db_time("24","00","");
		
		$current_user->setPreference('day_start_time', $db_start, 0, 'global', $current_user);
		$current_user->setPreference('day_end_time', $db_end, 0, 'global', $current_user);
//        }
      echo "good";  
 function to_db_time($hours,$minutes,$mer){
		$hours = intval($hours);
		$minutes = intval($minutes);
		$mer = strtolower($mer);
		if(!empty($mer)){
			if(($mer) == 'am')
				if($hours == 12)
					$hours = $hours - 12;
			if(($mer) == 'pm')
				if($hours != 12)
					$hours = $hours + 12;		
		}
		if($hours < 10)
			$hours = "0".$hours;
		if($minutes < 10)
			$minutes = "0".$minutes;	
		return $hours . ":". $minutes; 
	}