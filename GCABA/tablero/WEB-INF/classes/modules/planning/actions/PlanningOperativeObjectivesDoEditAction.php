<?php
/**
 * PlanningOperativeObjectivesDoEditAction
 *
 * Crea o guarda cambios de Objetivos Operativos (OperativeObjective)
 *
 * @package    planning
 * @subpackage    planningOperativeObjectives
 */

/*
require_once 'BaseDoEditAction.php';

class PlanningOperativeObjectivesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('OperativeObjective');
	}

}
*/

class PlanningOperativeObjectivesDoEditAction extends BaseAction {

	function PlanningOperativeObjectivesDoEditAction() {
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
			$operativeObjective = BaseQuery::create("OperativeObjective")->findOneByID($id);
			if (!empty($operativeObjective)) {
				$operativeObjectiveLog = new OperativeObjectiveLog();
			}
		}
		else {
			$operativeObjective = new OperativeObjective();
		}

		if (!$operativeObjective->isNew()) {
			$operativeObjectiveLog->fromJSON($operativeObjective->toJSON());
			$operativeObjectiveLog->setId(NULL);
			$operativeObjectiveLog->setOperativeObjectiveId($id);
		}

		$operativeObjective->fromArray($params, BasePeer::TYPE_FIELDNAME);
		$operativeObjective->setVersion($operativeObjective->getVersion() + 1);

		try {
			$operativeObjective->save();
			if (isset($operativeObjectiveLog)) {
				try {
					$operativeObjectiveLog->save();
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

		Common::doLog('success', $operativeObjective->getName() . $logSufix);

		$params = array();
		$params["id"] = $operativeObjective->getId();
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');

	}

}