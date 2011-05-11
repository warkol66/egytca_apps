<?php

class ConfigModule {

	private static $configModule = array(
		"regions" => array(
			"treeRootType" => 3,
			"lowestType" => 4,
			"highestType" => 9,
			"activeRegionTypes" => array(
				4 => 'Subregion',
				5 => 'State',
				6 => 'Municipality',
				9 => 'City'
			)
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}