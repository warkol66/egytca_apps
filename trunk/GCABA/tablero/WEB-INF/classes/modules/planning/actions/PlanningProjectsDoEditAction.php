<?php
/*
require_once 'BaseDoEditAction.php';

class PlanningProjectsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('PlanningProject');
	}

}
*/
class PlanningProjectsDoEditAction extends BaseAction {

	function PlanningProjectsDoEditAction() {
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
			$planningProject = BaseQuery::create("PlanningProject")->findOneByID($id);
			if (!empty($planningProject)) {
				$planningProjectLog = new PlanningProjectLog();
			}
		}
		else {
			$planningProject = new PlanningProject();
		}

		if (!$planningProject->isNew()) {
			$planningProjectLog->fromJSON($planningProject->toJSON());
			$planningProjectLog->setId(NULL);
			$planningProjectLog->setProjectId($id);
		}

		$planningProject->fromArray($params, BasePeer::TYPE_FIELDNAME);
		$planningProject->setVersion($planningProject->getVersion() + 1);

		try {
			$planningProject->save();
			if (isset($planningProjectLog)) {
				try {
					$planningProjectLog->save();
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

		Common::doLog('success', $planningProject->getName() . $logSufix);

		$params["id"] = $planningProject->getId();
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');

	}

}