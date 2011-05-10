<?php



/**
 * Skeleton subclass for performing query and update operations on the 'projects_contractor' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class ProjectContractorPeer extends BaseProjectContractorPeer {
	const CANDIDATE      = 1;
	const PRECLASIFIED   = 2;
	
	protected static $types = array(
		ProjectContractorPeer::CANDIDATE      => 'Candidate',
		ProjectContractorPeer::PRECLASIFIED   => 'Preclasified',
	);
		
	/**
	 * Devuelve los tipos de contratista
	 */
	public static function getTypes(){
		$contractorTypes = ProjectContractorPeer::$types;
		$activeContractorTypes = ConfigModule::get("contractors","activeContractorTypes");
		$contractorTypes = array_intersect_key($contractorTypes,$activeContractorTypes);
		return $contractorTypes;
	}
	
	/**
	 * Devuelve los nombres de los tipos de contratista traducidas
	 */
	public function getTypesTranslated(){
		$contractorTypes = ProjectContractorPeer::getTypes();

		foreach(array_keys($contractorTypes) as $key)
			$contractorTypesTranslated[$key] = Common::getTranslation($contractorTypes[$key],'contractors');

		return $contractorTypesTranslated;
	}
} // ProjectContractorPeer
