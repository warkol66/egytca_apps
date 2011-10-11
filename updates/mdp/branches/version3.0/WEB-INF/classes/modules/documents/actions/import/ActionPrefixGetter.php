<?php

class ActionPrefixGetter {
	
	public static function scan($url, $action) {
		
		$doParamPos = strpos($url, '?do=');
		if ($doParamPos === false) {
			$doParamPos = strpos($url, '&do=');
			if ($doParamPos === false)
				throw new Exception('invalid url');
		}
		
		$actionPrefixPos = $doParamPos + 4;
		
		$actionPos = strpos($url, $action);
		if ($actionPos === false)
			throw new Exception('invalid action');
		
		$actionPrefixLength = $actionPos - $actionPrefixPos;
		
		return substr($url, $actionPrefixPos, $actionPrefixLength);
	}
	
}