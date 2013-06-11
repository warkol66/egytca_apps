<?php
/**
 * PlanningConstructionsDoEditAction
 *
 * Crea o guarda cambios de Obras (PlanningConstruction)
 *
 * @package    planning
 * @subpackage    planningConstructions
 */

/*
require_once 'BaseDoEditAction.php';

class PlanningConstructionsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction');
	}

}
*/

class PlanningConstructionsDoEditAction extends BaseAction {

	function PlanningConstructionsDoEditAction() {
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
			$planningConstruction = BaseQuery::create("PlanningConstruction")->findOneByID($id);
			if (!empty($planningConstruction)) {
				$planningConstructionLog = new PlanningConstructionLog();
			}

			//Para no generar versiones cuando no se modifica nada, pueden venir valores vacios y generan log
			if (isset($params["surface"]) && $planningConstruction->getSurface() != Common::convertToMysqlNumericFormat($params["surface"]))
				$params["surface"] = Common::convertToMysqlNumericFormat($params["surface"]);
			else
				unset($params["surface"]);
			if (isset($params["amount"]) && $planningConstruction->getamount() != Common::convertToMysqlNumericFormat($params["amount"]))
				$params["amount"] = Common::convertToMysqlNumericFormat($params["amount"]);
			else
				unset($params["amount"]);
			if (isset($params["appliedAmount"]) && $planningConstruction->getappliedAmount() != Common::convertToMysqlNumericFormat($params["appliedAmount"]))
				$params["appliedAmount"] = Common::convertToMysqlNumericFormat($params["appliedAmount"]);
			else
				unset($params["appliedAmount"]);
			if (isset($params["managementAmount"]) && $planningConstruction->getManagementAmount() != Common::convertToMysqlNumericFormat($params["managementAmount"]))
				$params["managementAmount"] = Common::convertToMysqlNumericFormat($params["managementAmount"]);
			else
				unset($params["managementAmount"]);
			if (isset($params["raisedAmount"]) && $planningConstruction->getRaisedAmount() != Common::convertToMysqlNumericFormat($params["raisedAmount"]))
				$params["raisedAmount"] = Common::convertToMysqlNumericFormat($params["raisedAmount"]);
			else
				unset($params["raisedAmount"]);
			if (isset($params["sanctionAmount"]) && $planningConstruction->getSanctionAmount() != Common::convertToMysqlNumericFormat($params["sanctionAmount"]))
				$params["sanctionAmount"] = Common::convertToMysqlNumericFormat($params["sanctionAmount"]);
			else
				unset($params["sanctionAmount"]);
		}
		else {
			$planningConstruction = new PlanningConstruction();

			//Para no mandar valores vacíos
			if (isset($params["surface"]))
				$params["surface"] = Common::convertToMysqlNumericFormat($params["surface"]);
			if (isset($params["amount"]))
				$params["amount"] = Common::convertToMysqlNumericFormat($params["amount"]);
			if (isset($params["appliedAmount"]))
				$params["appliedAmount"] = Common::convertToMysqlNumericFormat($params["appliedAmount"]);
			if (isset($params["managementAmount"]))
				$params["managementAmount"] = Common::convertToMysqlNumericFormat($params["managementAmount"]);
			if (isset($params["raisedAmount"]))
				$params["raisedAmount"] = Common::convertToMysqlNumericFormat($params["raisedAmount"]);
			if (isset($params["sanctionAmount"]))
				$params["sanctionAmount"] = Common::convertToMysqlNumericFormat($params["sanctionAmount"]);
		}

		$planningConstruction->fromArray($params, BasePeer::TYPE_FIELDNAME);

		if ($planningConstruction->isModified()) {
			if (!$planningConstruction->isNew()) {
				$planningConstructionLog->fromJSON($planningConstruction->toJSON());
				$planningConstructionLog->setId(NULL);
				$planningConstructionLog->setConstructionId($id);
			}
			$userParams = Common::addUserInfoToParams(array());
			$planningConstruction->fromArray($userParams, BasePeer::TYPE_FIELDNAME);
			$planningConstruction->setVersion($planningConstruction->getVersion() + 1);
		}

		try {
			$planningConstruction->save();
			if (isset($planningConstructionLog)) {
				try {
					$planningConstructionLog->save();
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
		//Guardo los datos de montos asociados a la obra
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
			$budgetRelation->setObjectType('Construction');
			$budgetRelation->setObjectid($planningConstruction->getId());
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
		//Guardo los datos de actividades asociadas a la obra
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
				$activityObj->setObjectType('Construction');
				$activityObj->setObjectid($planningConstruction->getId());
				try {
					$activityObj->save();
				} catch (PropelException $exp) {
					if (ConfigModule::get("global","showPropelExceptions"))
						print_r($exp->__toString());
				}
			}
		}
		//Fin actividades

		/***
		 * Registros de ejcucion
		 */
		//Guardo los datos de avance fisico financiero asociados a la obra
		foreach ($_POST["progressRecord"] as $progressRecord) {

			if (!empty($progressRecord["physicalProgress"])) 
				$progressRecord["physicalProgress"] = Common::convertToMysqlNumericFormat($progressRecord["physicalProgress"]);

			if (!empty($progressRecord["financialProgress"])) 
				$progressRecord["financialProgress"] = Common::convertToMysqlNumericFormat($progressRecord["financialProgress"]);

			if (!empty($progressRecord["realPhysicalProgress"])) 
				$progressRecord["realPhysicalProgress"] = Common::convertToMysqlNumericFormat($progressRecord["realPhysicalProgress"]);

			if (!empty($progressRecord["realFinancialProgress"])) 
				$progressRecord["realFinancialProgress"] = Common::convertToMysqlNumericFormat($progressRecord["realFinancialProgress"]);

			if (!empty($progressRecord["id"])) {
				$record = ConstructionProgressQuery::create()->findOneById($progressRecord["id"]);	
				if (empty($record))
					$record = new ConstructionProgress();
			}
			else
				$record = new ConstructionProgress();
			$record->fromArray($progressRecord,BasePeer::TYPE_FIELDNAME);
			$record->setConstructionid($planningConstruction->getId());
			try {
				$record->save();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->__toString());
			}
		}
		//Fin Registros de ejcucion


		$regionsIds = $_POST['params']['regionsIds'];
		if (empty($regionsIds))
			$regionsIds = array();

		$query = ConstructionRegionQuery::create()->filterByPlanningConstruction($planningConstruction);
		$query->delete();

		foreach ($regionsIds as $regionId) {
			$region = RegionQuery::create()->findOneById($regionId);
			$assigned = $query->findOneByRegionid($regionId);
			if (empty($assigned))
				try {
					$planningConstruction->addRegion($region);
				} catch (Exception $e) {
				}
		}
		$planningConstruction->save();


		if (isset($id))
			$logSufix = ', ' . Common::getTranslation('action: create','common');
		else
			$logSufix = ', ' . Common::getTranslation('action: edit','common');

		Common::doLog('success', $planningConstruction->getName() . $logSufix);

		$params = array();
		$params["id"] = $planningConstruction->getId();
		if (!empty($_POST["fromPlanningProjectId"]))
			$params["fromPlanningProjectId"] = $_POST["fromPlanningProjectId"];
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');

	}

}