<?php

class ConfigModule {

	static $configModule = array(
		"global" => array(
			"debugMode" => true,
			"noSecurity" => true,
			"noCheckLogin" => false,
			"developmentMode" => true,
			"showPropelExceptions" => true,
			"showSwiftExceptions" => true,
			"doLog" => true,
			"unifiedUsernames" => true,
			"backupTimeLimit" => 720,
			"tmpwatch" => "/usr/sbin/tmpwatch",
			"securityFailureThreshold" => 5,
			"securityFailureThresholdTime" => 15,
			"securityFailureBlockedTime" => 15
		),
		"documents" => array(
			"useKeywords" => false,
			"useAuthors" => false,
			"useFullTextSearch" => true,
			"catdocPath" => "/usr/local/bin/",
			"pdftotextPath" => "/usr/local/bin/",
			"maxUploadSize" => '20M',
			"useSWFUploader" => false,
			"documentTypes" => array(
				"Word" => "doc,docx",
				"Excel" => "xls,xlsx",
				"Powerpoint" => "ppt,pptx",
				"Pdf" => "pdf",
				"Images" => "jpeg,jpg,png,gif"
				)
		),
		"users" => array(
			"licences" => 10,
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24,
			"toStringFormat" => "Surname, Name (Username)"
		),
		"regions" => array(
			"treeRootType" => 3,
			"lowestType" => 5,
			"highestType" => 7,
			"activeRegionTypes" => array(
				5 => 'Province',
				6 => 'Canton',
				7 => 'Parrish'
			)
		),
		"affiliates" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24
		),
		"banners" => array(
			"saveClicks" => false
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}
