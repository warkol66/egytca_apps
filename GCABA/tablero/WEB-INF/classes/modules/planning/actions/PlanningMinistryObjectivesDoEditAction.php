<?php
/**
 * PlanningMinistryObjectivesDoEditAction
 *
 * Crea o guarda cambios de Objetivos Operativos (MinistryObjective)
 *
 * @package    planning
 * @subpackage    planningMinistryObjectives
 */

/*
require_once 'BaseDoEditAction.php';

class PlanningMinistryObjectivesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective');
	}

	protected function postUpdate() {
		parent::postUpdate();
		$this->updateRegions();
	}

	protected function onFailure($e) {
		parent::onFailure($e);
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
*/

class PlanningMinistryObjectivesDoEditAction extends BaseAction {

	function PlanningMinistryObjectivesDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$id = $request->getParameter("id");
		$params = Common::addUserInfoToParams($_POST["params"]);

		if (!empty($id)) {
			$ministryObjective = BaseQuery::create("MinistryObjective")->findOneByID($id);
			if (!empty($ministryObjective)) {
				$ministryObjectiveLog = new MinistryObjectiveLog();
			}
		}
		else {
			$ministryObjective = new MinistryObjective();
		}

		if (!$ministryObjective->isNew()) {
			$ministryObjectiveLog->fromJSON($ministryObjective->toJSON());
			$ministryObjectiveLog->setId(NULL);
			$ministryObjectiveLog->setMinistryObjectiveId($id);
		}

		$ministryObjective->fromArray($params, BasePeer::TYPE_FIELDNAME);
		$ministryObjective->setVersion($ministryObjective->getVersion() + 1);

		try {
			$ministryObjective->save();
			if (isset($ministryObjectiveLog)) {
				try {
					$ministryObjectiveLog->save();
				} catch (Exception $e) {
					if (ConfigModule::get("global","showPropelExceptions")) {
						print_r($e->__toString());
					}
				}
			}
		} catch (Exception $e) {
			if (ConfigModule::get("global","showPropelExceptions")) {
				print_r($e->__toString());
			}
			return $this->returnFailure($mapping, $smarty, $this->entity, 'failure-edit');
		}

		if (isset($id))
			$logSufix = ', ' . Common::getTranslation('action: create','common');
		else
			$logSufix = ', ' . Common::getTranslation('action: edit','common');

		$this->updateRegions($ministryObjective);

		Common::doLog('success', $ministryObjective->getName() . $logSufix);

		$params = array();
		$params["id"] = $ministryObjective->getId();
		if (!empty($_POST["fromImpactObjectiveId"]))
			$params["fromImpactObjectiveId"] = $_POST["fromImpactObjectiveId"];
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');

	}

	private function updateRegions($ministryObjective) {
		$regionsIds = $_POST['params']['regionsIds'];
		if (empty($regionsIds))
			$regionsIds = array();

		$query = MinistryObjectiveRegionQuery::create()->filterByMinistryobjective($ministryObjective);

		$query->delete();

		foreach ($regionsIds as $regionId) {
			$region = RegionQuery::create()->findOneById($regionId);
			$assigned = $query->findOneByRegionid($regionId);
			if (empty($assigned))
				try {
					$ministryObjective->addRegion($region);
				} catch (Exception $e) {
				}
		}
		$ministryObjective->save();
	}

}
