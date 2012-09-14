<?php

class ConfigModule {

	private static $configModule = array(
		"global" => array(
			"debugMode" => true,
			"noSecurity" => true,
			"noCheckLogin" => true,
			"nonConcurrentSession" => false,
			"developmentMode" => true,
			"showPropelExceptions" => true,
			"showSwiftExceptions" => true,
			"doLog" => true,
			"unifiedUsernames" => true,
			"backupTimeLimit" => 720,
			"tmpwatch" => "/usr/sbin/tmpwatch",
			"internalMailUseAffiliates" => false
		),
		"actors" => array(
			"usePhoto" => true,
			"photosDir" => "images/actors/resizes",
			"thumbnailsDir" => "images/actors/thumbnails"
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
		"regions" => array(
			"treeRootType" => 9,
			"lowestType" => 11,
			"highestType" => 12,
			"activeRegionTypes" => array(
				11 => 'Comune',
				12 => 'Neighborhood'
			)
		),
		"calendar" => array(
			"useHTML"  => false,
			"eventPhotosDir" => 'images/calendarEvent'
		),
		"constructions" => array(
			"inspectionPhotosDir" => 'images/constructionInspection'
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}