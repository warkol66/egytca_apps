<?php

class ConfigModule {

	private static $configModule = array(
		"positions" => array(
			"useFemale" => true,
			"treeRootType" => 14,
			"lowestType" => 15,
			"highestType" => 16,
			"activePositionTypes" => array(
				14 => 'Director',
				15 => 'Sub Director',
				16 => 'Coordinator'
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