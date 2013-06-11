<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_ministryObjective' table.
 *
 * Objetivos ministeriales
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjectiveQuery extends BaseMinistryObjectiveQuery {
	
	public function __construct($dbName = 'application', $modelName = 'MinistryObjective', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
		$minYear = Common::getStartingYear();
		$maxYear = Common::getEndingYear();
		
		return $this->condition('cond1', MinistryObjectivePeer::STARTINGYEAR.' >= ?', $minYear)
			->condition('cond2', MinistryObjectivePeer::STARTINGYEAR.' <= ?', $maxYear)
			->combine(array('cond1', 'cond2'), 'and', 'startingYearInRange')
			->condition('cond3', MinistryObjectivePeer::ENDINGYEAR.' >= ?', $minYear)
			->condition('cond4', MinistryObjectivePeer::ENDINGYEAR.' <= ?', $maxYear)
			->combine(array('cond3', 'cond4'), 'and', 'endingYearInRange')
			->where(array('startingYearInRange', 'endingYearInRange'), 'or');
	}
	
	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		
		$loginUser = Common::getLoggedUser();
		if (!ConfigModule::get('objectives', 'verifyGroupWriteAccess') || $loginUser->isAdmin())
			$this->leftJoinImpactObjective()
				->addAscendingOrderByColumn(ImpactObjectivePeer::RESPONSIBLECODE)
				->leftJoinPosition('Position')
				->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
				->addAscendingOrderByColumn(ImpactObjectivePeer::INTERNALCODE)
				->orderByInternalCode();
		else {
			$groupIds = $loginUser->getUserGroupIds();
			$this->leftJoinImpactObjective()
				->addAscendingOrderByColumn(ImpactObjectivePeer::RESPONSIBLECODE)
								->usePositionQuery()
									->filterByUsergroupid($groupIds)
									->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
								->endUse()
				->addAscendingOrderByColumn(ImpactObjectivePeer::INTERNALCODE)
				->orderByInternalCode();
		}
	}

} // MinistryObjectiveQuery
