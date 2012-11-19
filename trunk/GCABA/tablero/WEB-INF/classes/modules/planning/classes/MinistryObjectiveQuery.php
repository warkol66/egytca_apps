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
	
	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		
		$this->leftJoinImpactObjective()
			->leftJoinPosition('Position')
			->addCond('cond1', PositionPeer::VERSIONID, PositionVersionQuery::getLastVersionId(), Criteria::EQUAL)
			->orderByInternalCode()
		;
	}

} // MinistryObjectiveQuery
