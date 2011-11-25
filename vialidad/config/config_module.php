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
			"unifiedUsernames" => true,
			"backupTimeLimit" => 720
		),
		"affiliates" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24
		),
		"users" => array(
			"licences" => 10,
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useGroupCategories" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24
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
		"vialidad" => array(
			"units" => array(
				"m" => "metro",
				"m2" => "metro cuadrado",
				"m3" => "metro c�bico",
				"Kg" => "Kilogramo",
				"T" => "Tonelada",
				"l" => "litro",
				"a" => "�rea",
				"Ha" => "Hect�rea",
				"u" => "unidad",
				"Km" => "Kil�metro",
				"Km2" => "Kil�metro cuadrado",
				"pulg2m" => "Pulgada por metro cuadrado",
				"Gs" => "Guaran�",
				"Gs/h" => "Guaran�es por hora",
				"%" => "Porcentaje"
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