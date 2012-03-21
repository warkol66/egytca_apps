<?php

class ConfigModule {

	private static $configModule = array(
		"global" => array(
			"debugMode" => true,
			"noSecurity" => true,
			"noCheckLogin" => false,
			"developmentMode" => true,
			"showPropelExceptions" => true,
			"doLog" => true,
			"unifiedUsernames" => true,
			"backupTimeLimit" => 720
		),
		"affiliates" => array(
			"unifiedLogin" => false,
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24
		),
		"users" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24
		),
		"notifications" => array(
			"activeNotificationTypes" => array(
				1 => 'Alert',
				2 => 'Schedule',
			)
		),
		"catalog" => array(
			"showStock" => true
		),
		"import" => array(
			"quotesUseQuantities" => false
		),
		"surveys" => array(
			"productSurveys" => true,
			"sendInternalMessages" => false,
			"graphOrientation" => Column  //Options: Bar = horizontal, Column=vertical
		)

	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}