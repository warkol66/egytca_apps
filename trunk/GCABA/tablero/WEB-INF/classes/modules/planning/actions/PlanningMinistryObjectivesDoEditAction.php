<?php

require_once 'BaseDoEditAction.php';

class PlanningMinistryObjectivesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective');
	}

	protected function postSave() {
		parent::postSave();
		$this->updateRegions();
	}

	private function updateRegions($calendarEvent) {
		$regionsIds = $_POST['params']['regionsIds'];
		if (empty($regionsIds))
			$regionsIds = array();
		
		$oldRegionsIds = MinistryObjectiveRegionQuery::create()->filterByMinistryobjective($this->entity)->select('id')->find();
		
		$regionsIdsForRemoval = array_diff($oldRegionsIds, $regionsIds);
		foreach ($regionsIdsForRemoval as $regionIdForRemoval) {
			$objectiveRegion = MinistryObjectiveRegionQuery::create()->findOneByRegionid($regionIdForRemoval);
			$objectiveRegion->delete();
		}

		foreach ($regionsIds as $regionId) {
			$region = RegionQuery::create()->findOneById($regionId);
			if (!$ministryObjective->hasRegion($region)) {
				$ministryObjective->addRegion($region);
			}
		}
	}

}
