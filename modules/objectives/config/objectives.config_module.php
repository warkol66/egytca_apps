<?php

class ConfigModule {

	private static $configModule = array(
		"objectives" => array(
			"verifyGroupWriteAccess" => false,
			"useLogs" => true,
			"logsPerPage" => 5,
			"useMinorChanges" => true,
			"useExchangeRate" => true
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}