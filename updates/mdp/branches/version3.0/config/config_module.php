<?php

class ConfigModule {

	private static $configModule = array(
		"global" => array(
			"debugMode" => true,
			"noSecurity" => true,
			"noCheckLogin" => true,
			"developmentMode" => true,
			"showPropelExceptions" => true,
			"showSwiftExceptions" => true,
			"doLog" => true,
			"unifiedLogin" => true,
			"unifiedUsernames" => true,
			"backupTimeLimit" => 720,
			"tmpwatch" => "/usr/sbin/tmpwatch",
			"internalMailUseAffiliates" => false 
		),
		"users" => array(
			"licences" => 10,
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordHashExpirationTime" => 24,
			"toStringFormat" => "Surname, Name (Username)" // "Name Surname (Username)"
		),
		"actors" => array(
			"toStringFormat" => "Name Surname (Institution)" // "Surname, Name (Institution)"
		),
		"issues" => array(
			"logsPerPage" => 5
		),
		"clients" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordHashExpirationTime" => 24,
			"toStringFormat" => "Surname, Name (Username)" // "Name Surname (Username)"
		),
		"affiliates" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => true,
			"useFilterByUserGroup" => true,
			"passwordHashExpirationTime" => 24,
			"toStringFormat" => "Surname, Name (Username)" // "Name Surname (Username)"
		),
		"documents" => array(
			"useKeywords" => false,
			"useAuthors" => false,
			"useFullTextSearch" => true,
			"catdocPath" => "/usr/local/bin/",
			"pdftotextPath" => "/usr/local/bin/",
			"maxUploadSize" => '15M',
			"useSWFUploader" => false,
			"documentTypes" => array(
				"Word" => "doc,docx",
				"Excel" => "xls,xlsx",
				"Powerpoint" => "ppt,pptx",
				"Pdf" => "pdf",
				"Images" => "jpeg,jpg,png,gif"
				)
		),
		"headlines" => array(
			"clippingsPath" => "./WEB-INF/classes/modules/headlines/files/clipping/",
			"clippingsTmpPath" => "./WEB-INF/classes/modules/headlines/files/clipping/tmp/"
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}