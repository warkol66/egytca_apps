<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_operativeObjective' table.
 *
 * Objetivos operativos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class OperativeObjectiveQuery extends BaseOperativeObjectiveQuery {
	
	public function __construct($dbName = 'application', $modelName = 'OperativeObjective', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
		$minYear = ConfigModule::get('planning', 'startingYear');
		$maxYear = ConfigModule::get('planning', 'endingYear');
		
		return $this->condition('cond1', OperativeObjectivePeer::STARTINGYEAR.' >= ?', $minYear)
			->condition('cond2', OperativeObjectivePeer::STARTINGYEAR.' <= ?', $maxYear)
			->combine(array('cond1', 'cond2'), 'and', 'startingYearInRange')
			->condition('cond3', OperativeObjectivePeer::ENDINGYEAR.' >= ?', $minYear)
			->condition('cond4', OperativeObjectivePeer::ENDINGYEAR.' <= ?', $maxYear)
			->combine(array('cond3', 'cond4'), 'and', 'endingYearInRange')
			->where(array('startingYearInRange', 'endingYearInRange'), 'or');
	}
	
	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		
		$loginUser = Common::getLoggedUser();
		if (!ConfigModule::get('objectives', 'verifyGroupWriteAccess') || $loginUser->isAdmin())
			$this->leftJoinMinistryObjective()
								->addAscendingOrderByColumn(MinistryObjectivePeer::RESPONSIBLECODE)
								->leftJoinPosition('Position')
								->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
								->addAscendingOrderByColumn(MinistryObjectivePeer::INTERNALCODE)
								->orderByInternalCode();
		else {
			$groupIds = $loginUser->getUserGroupIds();
			$this->leftJoinMinistryObjective()
								->addAscendingOrderByColumn(MinistryObjectivePeer::RESPONSIBLECODE)
								->usePositionQuery()
									->filterByUsergroupid($groupIds)
									->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
								->endUse()
								->addAscendingOrderByColumn(MinistryObjectivePeer::INTERNALCODE)
								->orderByInternalCode();
		}
		
	}

} // OperativeObjectiveQuery
