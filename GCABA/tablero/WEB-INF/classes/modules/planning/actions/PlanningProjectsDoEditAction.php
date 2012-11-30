<?php
/**
 * PlanningConstructionsDoEditAction
 *
 * Crea o guarda cambios de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningPlanningProjects
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

		$params["appliedAmount"] = Common::convertToMysqlNumericFormat($params["appliedAmount"]);
		$params["managementAmount"] = Common::convertToMysqlNumericFormat($params["managementAmount"]);
		$params["raisedAmount"] = Common::convertToMysqlNumericFormat($params["raisedAmount"]);
		$params["sanctionAmount"] = Common::convertToMysqlNumericFormat($params["sanctionAmount"]);

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

		/***
		 * Partidas presupuestarias
		 */
		foreach ($_POST["budgetItem"] as $item) {
			foreach ($item as $itemValue => $value) {
				if ($itemValue == "amount") 
					$value = Common::convertToMysqlNumericFormat($value);
				$itemValues[$itemValue] = $value;
			}
			//Cuando complete todos los valores asociados a un monto, lo guardo en $itemParams
			if ($itemValue == "eol") {
				$itemParams[] = $itemValues;
				$itemValues = array();
			}
		}
		//Guardo los datos de montos asociados a la obra
		foreach ($itemParams as $budgetItem) {
			if (!empty($budgetItem["id"])) {
				$budgetRelation = BudgetRelationQuery::create()->findOneById($budgetItem["id"]);
				if (empty($budgetRelation))
					$budgetRelation = new BudgetRelation();
			}
			else
				$budgetRelation = new BudgetRelation();
			$budgetRelation->fromArray($budgetItem,BasePeer::TYPE_FIELDNAME);
			$budgetRelation->setObjectType('Project');
			$budgetRelation->setObjectid($planningProject->getId());
			try {
				$budgetRelation->save();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->__toString());
			}
		}
		//Fin partidas

		/***
		 * Actividades
		 */
		foreach ($_POST["activity"] as $item) {
			foreach ($item as $itemValue => $value) {
				$itemValues[$itemValue] = $value;
			}
			//Cuando complete todos los valores asociados a una actividad y lo guardo en $activityParams
			if ($itemValue == "eol") {
				$activityParams[] = $itemValues;
				$itemValues = array();
			}
		}
		//Guardo los datos de montos asociados a la obra
		foreach ($activityParams as $activity) {
			if (!empty($activity["id"])) {
				$activityObj = PlanningActivityQuery::create()->findOneById($activity["id"]);
				if (empty($activityObj))
					$activityObj = new PlanningActivity();
			}
			else
				$activityObj = new PlanningActivity();
			$activityObj->fromArray($activity,BasePeer::TYPE_FIELDNAME);
			$activityObj->setObjectType('Project');
			$activityObj->setObjectid($planningProject->getId());
			try {
				$activityObj->save();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->__toString());
			}
		}
		//Fin actividades

		if (isset($id))
			$logSufix = ', ' . Common::getTranslation('action: create','common');
		else
			$logSufix = ', ' . Common::getTranslation('action: edit','common');

		Common::doLog('success', $planningProject->getName() . $logSufix);

		$params = array();
		$params["id"] = $planningProject->getId();
		if (!empty($_POST["fromOperativeObjectiveId"]))
			$params["fromOperativeObjectiveId"] = $_POST["fromOperativeObjectiveId"];
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');

	}

}
