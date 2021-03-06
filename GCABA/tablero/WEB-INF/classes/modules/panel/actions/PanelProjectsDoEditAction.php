<?php
/**
 * PanelProjectsDoEditAction
 *
 * Crea o guarda cambios de Proyectos (PlanningProject)
 *
 * @package    panel
 * @subpackage    planningProjects
 */

class PanelProjectsDoEditAction extends BaseAction {

	function PanelProjectsDoEditAction() {
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
		$params = $_POST["params"];


		if (!empty($id)) {
			$planningProject = BaseQuery::create("PlanningProject")->findOneByID($id);
			if (!empty($planningProject)) {
				$planningProjectLog = new PlanningProjectLog();
			}
			//Para no generar versiones cuando no se modifica nada, pueden venir valores vacios y generan log
			if (isset($params["appliedAmount"]) && $planningProject->getAppliedAmount() != Common::convertToMysqlNumericFormat($params["appliedAmount"]))
				$params["appliedAmount"] = Common::convertToMysqlNumericFormat($params["appliedAmount"]);
			else
				unset($params["appliedAmount"]);
			if (isset($params["managementAmount"]) && $planningProject->getManagementAmount() != Common::convertToMysqlNumericFormat($params["managementAmount"]))
				$params["managementAmount"] = Common::convertToMysqlNumericFormat($params["managementAmount"]);
			else
				unset($params["managementAmount"]);
			if (isset($params["raisedAmount"]) && $planningProject->getRaisedAmount() != Common::convertToMysqlNumericFormat($params["raisedAmount"]))
				$params["raisedAmount"] = Common::convertToMysqlNumericFormat($params["raisedAmount"]);
			else
				unset($params["raisedAmount"]);
			if (isset($params["sanctionAmount"]) && $planningProject->getSanctionAmount() != Common::convertToMysqlNumericFormat($params["sanctionAmount"]))
				$params["sanctionAmount"] = Common::convertToMysqlNumericFormat($params["sanctionAmount"]);
			else
				unset($params["sanctionAmount"]);
			if (isset($params["order"]) && ($params["order"]) === 0 || empty($params["order"]))
				unset($params["order"]);
		}
		else {
			$planningProject = new PlanningProject();

			//Para no mandar valores vacios
			if (isset($params["appliedAmount"]))
				$params["appliedAmount"] = Common::convertToMysqlNumericFormat($params["appliedAmount"]);
			if (isset($params["managementAmount"]))
				$params["managementAmount"] = Common::convertToMysqlNumericFormat($params["managementAmount"]);
			if (isset($params["raisedAmount"]))
				$params["raisedAmount"] = Common::convertToMysqlNumericFormat($params["raisedAmount"]);
			if (isset($params["sanctionAmount"]))
				$params["sanctionAmount"] = Common::convertToMysqlNumericFormat($params["sanctionAmount"]);
		}

		$planningProject->fromArray($params, BasePeer::TYPE_FIELDNAME);

		if ($planningProject->isModified()) {
			if (!$planningProject->isNew()) {
				$planningProjectLog->fromJSON($planningProject->toJSON());
				$planningProjectLog->setId(NULL);
				$planningProjectLog->setProjectId($id);
			}
			$planningProject->setVersion($planningProject->getVersion() + 1);
			$userParams = Common::addUserInfoToParams(array());
			$planningProject->fromArray($userParams, BasePeer::TYPE_FIELDNAME);
		}

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
		//Guardo los datos de montos asociados al proyecto
		foreach ($_POST["budgetItem"] as $budgetItem) {

			if (!empty($budgetItem["amount"])) 
				$budgetItem["amount"] = Common::convertToMysqlNumericFormat($budgetItem["amount"]);


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
		//Guardo los datos de actividades asociadas al proyecto
		foreach ($_POST["activity"] as $activity) {
			if (!empty($activity['name'])) {
				if (!empty($activity["id"])) {
					$activityObj = PlanningActivityQuery::create()->findOneById($activity["id"]);
					if (empty($activityObj))
						$activityObj = new PlanningActivity();
				}
				else
					$activityObj = new PlanningActivity();
				$activity = Common::addUserInfoToParams($activity);
				if (!is_numeric($activity['order']))
					$activity['order'] = 999;
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
