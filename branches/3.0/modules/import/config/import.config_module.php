<?php

class ConfigModule {

	private static $configModule = array(
		"import" => array(
			"quotesUseQuantities" => false
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}