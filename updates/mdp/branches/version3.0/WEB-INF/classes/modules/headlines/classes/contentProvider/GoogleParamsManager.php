<?php

class GoogleParamsManager {
	
	private static $DATE_FILTER_MAP = array(
		'dateFilter' => 'tbs',
		'hour'       => 'qdr:h',
		'day'        => 'qdr:d',
		'week'       => 'qdr:w',
		'month'      => 'qdr:m',
		'year'       => 'qdr:y',
	);
	
	public static function convertGlobal($params) {
		
		$newParams = array();
		
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'dateFilter':
					$newParams = array_merge_recursive($newParams, array(
						GoogleParamsManager::$DATE_FILTER_MAP['dateFilter'] => GoogleParamsManager::$DATE_FILTER_MAP[$value]
					));
					break;
				default:
					$newParams = array_merge_recursive($newParams, array($key => $value));
			}
		}
		
		return $newParams;
	}
	
}