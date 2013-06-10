<?php

class ActionPrefixGetter {
	
	public static function scan($url, $action) {
		
		$doParamPos = strpos($url, '?do=');
		if ($doParamPos === false) {
			$doParamPos = strpos($url, '&do=');
			if ($doParamPos === false)
				throw new Exception('invalid url');
		}
		
		$actionPos = $doParamPos + 4;
		
		$paramsPos = strpos($url, '&', $actionPos);
		
		if ($paramsPos === false) {
			$actionLength = ( strlen($string) - 1 ) - $actionPos;
		} else {
			$actionLength = $paramsPos - $actionPos;
		}
		
		return substr($url, $actionPos, $actionLength);
	}
	
}