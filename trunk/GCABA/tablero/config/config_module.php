<?php

class ConfigModule {

	private static $configModule = array(
		"global" => array(
			"defaultMode" => "panel",
			"debugMode" => true,
			"warnDeprecated" => true,
			"noSecurity" => true,
			"noCheckLogin" => false,
			"nonConcurrentSession" => false,
			"developmentMode" => true,
			"showSwiftExceptions" => true,
			"showPropelExceptions" => true,
			"doLog" => true,
			"unifiedLogin" => true,
			"unifiedUsernames" => true,
			"backupTimeLimit" => 720,
			"tmpwatch" => "/usr/sbin/tmpwatch",
			"securityFailureThreshold" => 5,
			"securityFailureThresholdTime" => 15,
			"securityFailureBlockedTime" => 15,
			"defaultPeriod" => 2013,
			"periodOptions" => array(
				"2013" => array(
					"startingYear" => 2013,
					"endingYear" => 2013),
				"2014" => array(
					"startingYear" => 2014,
					"endingYear" => 2014), 
		/*		"2015" => array(
					"startingYear" => 2015,
					"endingYear" => 2015) */
		/*		"2016" => array(
					"startingYear" => 2016,
					"endingYear" => 2016) */
			)
		),
		"users" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordRecoveryExpirationTimeInHours" => 24,
			"loginFailureThreshold" => 5,
			"loginFailureThresholdTime" => 15,
			"loginFailureBlockedTimeTime" => 15
		),
		"planning" => array(
			"useDemoValues" => false,
			"defaultPeriod" => 2013,
			"startingYear" => 2013,
			"endingYear" => 2013,
			"planningUsersGroup" => 31,
			"panelUsersGroup" => 32,
			"verifyGroupWriteAccess" => true,
			"useLogs" => true,
			"logsPerPage" => 5,
			"useMinorChanges" => true,
			"useRegions" => true,
			"regionsTypes" => array(
				"Commune" => 11,
				"Neighborhood" => 12
				),
			"positionsTypes" => array(
				9 => 'Minister',
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director',
				14 => 'Director',
				15 => 'Sub Director'
				),
			"preTreeName" => array(
				"ImpactObjective" => "OI => ",
				"MinistryObjective" => "OM => ",
				"OperativeObjective" => "OO => ",
				"PlanningProject" => "Pr => ",
				"PlanningConstruction" => "Ob => ",
				"PlanningActivity" => "Ac => "
				)
		),
		"panel" => array(
			"defaultPeriod" => 2013,
			"startingYear" => 2013,
			"endingYear" => 2013,
			"positionsTypes" => array(
				9 => 'Minister',
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director',
				14 => 'Director',
				15 => 'Sub Director'
				),
			"inaugurationDateBefore" => 15,
			"inaugurationDateAfter" => 15
		),
		"positions" => array(
			"stopOnPlanning" => true,
			"useFemale" => true,
			"treeRootType" => 6,
			"lowestType" => 7,
			"highestType" => 16,
			"activePositionTypes" => array(
				6 => 'Mayor',
				7 => 'Vice Mayor',
				8 => 'Chief of Staff',
				9 => 'Minister',
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director',
				14 => 'Director',
				15 => 'Sub Director',
				16 => 'Coordinator'
			)
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
		"projects" => array(
			"verifyGroupWriteAccess" => true,
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
				8 => 'Chief of Staff',
				9 => 'Minister',
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director',
				14 => 'Director',
				15 => 'Sub Director'
				),
			"useDocuments" => true,
			"useDisbursements" => true,
			"useCodeAux" => true,
			"showActivitiesDates" => true
		),
		"projectsActivities" => array(
			"useDocuments" => true
		),
		"objectives" => array(
			"verifyGroupWriteAccess" => true,
			"useLogs" => true,
			"logsPerPage" => 5,
			"useMinorChanges" => true,
			"useRegions" => true,
			"regionsTypes" => array(
				"Commune" => 11,
				"Neighborhood" => 12
				),
			"positionsTypes" => array(
				8 => 'Chief of Staff',
				9 => 'Minister',
				11 => 'Secretary',
				12 => 'Sub secretary',
				13 => 'General Director'
				)
		),
		"documents" => array(
			"usePasswords" => false,
			"useFullTextSearch" => false,
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
		"remoteSystems" => array(
			"prensa" => array( "Tablero de Prensa" => "prensagcba.com" ),
			"agenda" => array( "Agenda de Gobierno" => "agendagcba.com" )
		),
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}