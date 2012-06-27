<?php

require_once 'BaseDoEditAction.php';

class PlanningMinistryObjectivesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective');
	}

	protected function postUpdate() {
		parent::postUpdate();
		$this->updateRegions();
	}

	protected function onFailure() {
		parent::onFailure();
		$this->template->template = 'TemplateJQuery.tpl';
		$this->smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}

	private function updateRegions() {
		$regionsIds = $_POST['params']['regionsIds'];
		if (empty($regionsIds))
			$regionsIds = array();

		$query = MinistryObjectiveRegionQuery::create()->filterByMinistryobjective($this->entity);

		$query->delete();

		foreach ($regionsIds as $regionId) {
			$region = RegionQuery::create()->findOneById($regionId);
			$assigned = $query->findOneByRegionid($regionId);
			if (empty($assigned))
				try {
					$this->entity->addRegion($region);
				} catch (Exception $e) {
				}
		}
		$this->entity->save();
	}

}
