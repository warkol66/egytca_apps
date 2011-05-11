<?php

class ConfigModule {

	private static $configModule = array(
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
			"useContractors" => true,
			"activeContractorTypes" => array(
				1 => 'Candidate',
				2 => 'Preclasified'
				),
			"useDocuments" => true,
			"useDisbursements" => true,
			"useCodeAux" => true,
			"useContractorsList" => true,
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