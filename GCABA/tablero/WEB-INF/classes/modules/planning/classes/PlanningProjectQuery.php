<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_project' table.
 *
 * Proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningProjectQuery extends BasePlanningProjectQuery {
	
	public function __construct($dbName = 'application', $modelName = 'PlanningProject', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
		$minYear = ConfigModule::get('planning', 'startingYear');
		$maxYear = ConfigModule::get('planning', 'endingYear');
		return $this->filterByStartingyear($minYear, Criteria::GREATER_EQUAL)
			->filterByEndingyear($maxYear, Criteria::LESS_EQUAL);
	}

	protected function preSelect(PropelPDO $con) {
		parent::preSelect($con);
		
		$this->leftJoinOperativeObjective()
			->addAscendingOrderByColumn(OperativeObjectivePeer::RESPONSIBLECODE)
			->leftJoinPosition('Position')
			->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
			->addAscendingOrderByColumn(OperativeObjectivePeer::INTERNALCODE)
			->orderByInternalCode();
	}

} // PlanningProjectQuery
