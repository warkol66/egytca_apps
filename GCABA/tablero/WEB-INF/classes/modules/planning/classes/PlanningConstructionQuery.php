<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_construction' table.
 *
 * Obras
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningConstructionQuery extends BasePlanningConstructionQuery {

	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		
		$loginUser = Common::getLoggedUser();
		if (!ConfigModule::get('projects', 'verifyGroupWriteAccess') || $loginUser->isAdmin())
			$this;
		else {
			$groupIds = $loginUser->getUserGroupIds();
			$this->usePositionQuery()
									->filterByUsergroupid($groupIds)
									->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
								->endUse();
		}
	}

 /**
	* Agrega filtros por position y sus descendientes
	*
	* @param   type integer $positionCode code del Position
	* @return condicion de filtrado por position y descendientes
	*/
	public function broodPositions($positionCode) {
		$position = PositionQuery::create()->findOneByCode($positionCode);
		return $this->filterByPosition($position->getBranch());
	}

 /**
	* Agrega filtros por prioridad jefatura
	*
	* @param   type integer $positionCode code del Position
	* @return condicion de filtrado por position y descendientes
	*/
	public function priorityProject($priority) {
		return $this->usePlanningProjectQuery()
									->filterByPriority($priority)
							->endUse();
	}

} // PlanningConstructionQuery
