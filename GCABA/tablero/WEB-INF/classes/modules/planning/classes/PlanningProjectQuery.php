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

	protected function preSelect(PropelPDO $con) {
		parent::preSelect($con);
		
		$this->leftJoinOperativeObjective()
			->leftJoinPosition('Position')
				->addAscendingOrderByColumn('positions_position.CODE')
				->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
//				->orderBy(PositionPeer::NAME)
//			->orderBy(OperativeObjectivePeer::INTERNALCODE)
				->addAscendingOrderByColumn(OperativeObjectivePeer::INTERNALCODE)
		->orderBy(PlanningProjectPeer::INTERNALCODE)
		;
		
//		$this->useOperativeObjectiveQuery()
//			->usePositionQuery()
//				->filterByLastVersion()
//				->orderByName()
//			->endUse()
//			->orderByInternalCode()
//		->endUse()
//		->orderByInternalCode();
	}

} // PlanningProjectQuery
