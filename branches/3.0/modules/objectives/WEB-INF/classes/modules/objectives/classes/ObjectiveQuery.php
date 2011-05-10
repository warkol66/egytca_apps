<?php


/**
 * Skeleton subclass for performing query and update operations on the 'objectives_objective' table.
 *
 * Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class ObjectiveQuery extends BaseObjectiveQuery {
	public function filterByPolicyGuidelineId($policyGuidelineId = null, $comparison = null) {
		$this->join('StrategicObjective')
			 ->useQuery('StrategicObjective')
    		 	->filterByPolicyGuidelineId($policyGuidelineId, $comparison)
			 ->endUse();
		return $this;
	}
} // ObjectiveQuery
