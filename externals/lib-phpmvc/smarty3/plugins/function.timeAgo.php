<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {timeAgo} function plugin
 *
 * Type:     function<br>
 * Name:     timeAgo<br>
 * Purpose:  print out how long ago the input date happened
 *
 * @author 
 * @link 
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 * @return string|null
 */
function smarty_function_timeAgo($params, $template){
	
	$createdAt = $params['mysqlTime'];
	
	$datetime1 = new DateTime("now");
	$datetime2 = date_create($createdAt);
	
	//return $datetime2;
	
	$diff = date_diff($datetime1, $datetime2);
	$timemsg = '';
	
	if($diff->y > 0){
		$timemsg = $diff->y .' año'. ($diff->y > 1?"s":'');

	}
	else if($diff->m > 0){
		$timemsg = $diff->m . ' mes'. ($diff->m > 1?"es":'');
	}
	else if($diff->d > 0){
		$timemsg = $diff->d .' día'. ($diff->d > 1?"s":'');
	}
	else if($diff->h > 0){
		$timemsg = $diff->h .' hora'.($diff->h > 1 ? "s":'');
	}
	else if($diff->i > 0){
		$timemsg = $diff->i .' minuto'. ($diff->i > 1?"s":'');
	}
	else if($diff->s > 0){
		$timemsg = $diff->s .' segundo'. ($diff->s > 1?"s":'');
	}else if($diff->s == 0){
		return ' Recién';
	}

	$timemsg = 'Hace ' . $timemsg;
	return $timemsg;
    
}

?>
