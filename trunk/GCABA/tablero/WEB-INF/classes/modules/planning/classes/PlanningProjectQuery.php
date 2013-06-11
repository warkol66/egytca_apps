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
		$minYear = Common::getStartingYear();
		$maxYear = Common::getEndingYear();
		
		return $this->condition('cond1', PlanningProjectPeer::STARTINGYEAR.' >= ?', $minYear)
			->condition('cond2', PlanningProjectPeer::STARTINGYEAR.' <= ?', $maxYear)
			->combine(array('cond1', 'cond2'), 'and', 'startingYearInRange')
			->condition('cond3', PlanningProjectPeer::ENDINGYEAR.' >= ?', $minYear)
			->condition('cond4', PlanningProjectPeer::ENDINGYEAR.' <= ?', $maxYear)
			->combine(array('cond3', 'cond4'), 'and', 'endingYearInRange')
			->where(array('startingYearInRange', 'endingYearInRange'), 'or');
	}

	protected function preSelect(PropelPDO $con) {
		parent::preSelect($con);
		
		$loginUser = Common::getLoggedUser();
		if (!ConfigModule::get('projects', 'verifyGroupWriteAccess') || $loginUser->isAdmin())
			$this->leftJoinOperativeObjective()
						->addAscendingOrderByColumn(OperativeObjectivePeer::RESPONSIBLECODE)
						->leftJoinPosition('Position')
						->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
						->addAscendingOrderByColumn(OperativeObjectivePeer::INTERNALCODE)
						->orderByInternalCode();
		else {
			$groupIds = $loginUser->getUserGroupIds();
			$this->leftJoinOperativeObjective()
							->addAscendingOrderByColumn(OperativeObjectivePeer::RESPONSIBLECODE)
							->usePositionQuery()
								->filterByUsergroupid($groupIds)
								->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
							->endUse()
							->addAscendingOrderByColumn(OperativeObjectivePeer::INTERNALCODE)
							->orderByInternalCode();
		}
	}

 /**
	* Agrega filtros por dependencia y sus descendientes
	*
	* @param   type integer $positionCode code del Position
	* @return condicion de filtrado por position y descendientes
	*/
	public function broodPositions($positionCode) {
		$position = PositionQuery::create()->findOneByCode($positionCode);
		return $this->filterByPosition($position->getBranch());
	}
	
	/**
	 * filtra por id de tags
	 * @param array $tagIds
	 */
	public function tagIds($tagIds) {
		return $this->usePlanningProjectTagRelationQuery()
			->filterByPlanningprojecttagid($tagIds)
			->endUse()
			->groupBy('id');
	}

} // PlanningProjectQuery
