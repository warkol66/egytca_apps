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
			"applicationName" => "wb"
		),
		"affiliates" => array(
			"unifiedLogin" => false
		),
		"users" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24
		),
		"planning" => array(
			"startingYear" => 2013,
			"endingYear" => 2013
		),
		"positions" => array(
			"useFemale" => true,
			"treeRootType" => 6,
			"lowestType" => 7,
			"highestType" => 16,
			"activePositionTypes" => array(
				6 => 'Mayor',
				7 => 'Vice Mayor',
				8 => 'Chief of Staff',
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director',
				14 => 'Director',
				15 => 'Sub Director',
				16 => 'Coordinator'
			)
		),
		"reportSections" => array(
			"useDocuments" => true,
			"treeRootType" => 1,
			"lowestType" => 1,
			"highestType" => 4,
			"activeReportSectionsTypes" => array(
				1 => 'Report',
				2 => 'Sub Report',
				3 => 'Section',
				4 => 'Sub Section',
				5 => 'Sub Sub Section'
			)
		),
		"resultFrameIndicators" => array(
			"treeRootType" => 1,
			"lowestType" => 1,
			"highestType" => 4,
			"activeResultFrameIndicatorsTypes" => array(
				1 => 'Result Frame',
				2 => 'Credit',
				3 => 'Component',
				4 => 'Sub Component',
			)
		),
		"notifications" => array(
			"activeNotificationTypes" => array(
				1 => 'Alert',
				2 => 'Schedule',
			)
		),
		"regions" => array(
			"treeRootType" => 3,
			"lowestType" => 4,
			"highestType" => 9,
			"activeRegionTypes" => array(
				5 => 'State',
				7 => 'District',
				8 => 'Municipality',
				9 => 'City'
			)
		),
		"projects" => array(
			"verifyGroupWriteAccess" => false,
			"useLogs" => true,
			"logsPerPage" => 5,
			"useMinorChanges" => true,
			"useCoordinates" => true,
			"useRegions" => true,
			"regionsTypes" => array(
				"Commune" => 11,
				"Neighborhood" => 12
				),
			"positionsTypes" => array(
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director',
				14 => 'Director',
				15 => 'Sub Director'
				),
			"useContractors" => true,
			"activeContractorTypes" => array(
				1 => 'Candidate',
				2 => 'Preclasified'
				),
			"useDocuments" => true,
			"useDisbursements" => true,
			"useCodeAux" => true,
			"useContractorsList" => true,
			"useExchangeRate" => true,
			"useFinancingSources" => true,
			"showActivitiesDates" => true
		),
		"projectsActivities" => array(
			"useDocuments" => true
		),
		"objectives" => array(
			"verifyGroupWriteAccess" => false,
			"useLogs" => true,
			"logsPerPage" => 5,
			"useMinorChanges" => true,
			"useRegions" => true,
			"regionsTypes" => array(
				"Commune" => 11,
				"Neighborhood" => 12
				),
			"positionsTypes" => array(
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director',
				14 => 'Director',
				15 => 'Sub Director'
				),
			"useExchangeRate" => true
		),
		"banners" => array(
			"saveClicks" => false
		),
		"import" => array(
			"quotesUseQuantities" => false
		),
		"documents" => array(
			"usePasswords" => true,
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
		)

	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}