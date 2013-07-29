<?php

class DBConfig {

	private static $config;

	static function init($configFile) {

		$json = file_get_contents($configFile);
		self::$config = json_decode($json, true);
		if (is_null(self::$config))
			throw new Exception('invalid config file ('.realpath($configFile).')');
	}

	static function get($environment = null, $key = null) {

		if (!array_key_exists($environment, self::$config))
			throw new Exception('invalid environment - use prod|dev|test');
		else
			return is_null($key) ? self::$config[$environment] : self::$config[$environment][$key];
	}
}

DBConfig::init(__DIR__.'/../config/db.json');
