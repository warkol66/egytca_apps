<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_impactObjective' table.
 *
 * Objetivos de Impacto
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class ImpactObjectiveQuery extends BaseImpactObjectiveQuery {
	
	public function __construct($dbName = 'application', $modelName = 'ImpactObjective', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
		$minYear = ConfigModule::get('planning', 'startingYear');
		$maxYear = ConfigModule::get('planning', 'endingYear');
		
		return $this->condition('cond1', ImpactObjectivePeer::STARTINGYEAR.' >= ?', $minYear)
			->condition('cond2', ImpactObjectivePeer::STARTINGYEAR.' <= ?', $maxYear)
			->combine(array('cond1', 'cond2'), 'and', 'startingYearInRange')
			->condition('cond3', ImpactObjectivePeer::ENDINGYEAR.' >= ?', $minYear)
			->condition('cond4', ImpactObjectivePeer::ENDINGYEAR.' <= ?', $maxYear)
			->combine(array('cond3', 'cond4'), 'and', 'endingYearInRange')
			->where(array('startingYearInRange', 'endingYearInRange'), 'or');
	}
	
	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		
		$this->leftJoinPosition('Position')
			->orderByResponsiblecode()
			->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
			->orderByInternalCode()
		;
	}

} // ImpactObjectiveQuery
