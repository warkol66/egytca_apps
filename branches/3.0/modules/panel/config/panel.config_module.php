<?php

class ConfigModule {

	private static $configModule = array(
		"reportSections" => array(
			"useDocuments" => true,
			"treeRootType" => 1,
			"lowestType" => 1,
			"highestType" => 5,
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
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}