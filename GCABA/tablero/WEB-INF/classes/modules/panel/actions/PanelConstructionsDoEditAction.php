<?php
/**
 * PanelConstructionsDoEditAction
 *
 * Crea o guarda cambios de Obras (PlanningConstruction)
 *
 * @package    panel
 * @subpackage    planningConstructions
 */

/*
require_once 'BaseDoEditAction.php';

class PanelConstructionsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction');
	}

}
*/

class PanelConstructionsDoEditAction extends BaseAction {

	function PanelConstructionsDoEditAction() {
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

		$params["surface"] = Common::convertToMysqlNumericFormat($params["surface"]);
		$params["amount"] = Common::convertToMysqlNumericFormat($params["amount"]);
		$params["appliedAmount"] = Common::convertToMysqlNumericFormat($params["appliedAmount"]);
		$params["managementAmount"] = Common::convertToMysqlNumericFormat($params["managementAmount"]);
		$params["raisedAmount"] = Common::convertToMysqlNumericFormat($params["raisedAmount"]);
		$params["sanctionAmount"] = Common::convertToMysqlNumericFormat($params["sanctionAmount"]);

		if (!empty($id)) {
			$planningConstruction = BaseQuery::create("PlanningConstruction")->findOneByID($id);
			if (!empty($planningConstruction)) {
				$planningConstructionLog = new PlanningConstructionLog();
			}
		}
		else {
			$planningConstruction = new PlanningConstruction();
		}

		if (!$planningConstruction->isNew()) {
			$planningConstructionLog->fromJSON($planningConstruction->toJSON());
			$planningConstructionLog->setId(NULL);
			$planningConstructionLog->setConstructionId($id);
		}

		$planningConstruction->fromArray($params, BasePeer::TYPE_FIELDNAME);
		$planningConstruction->setVersion($planningConstruction->getVersion() + 1);

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
		//Fin actividades

		/***
		 * Registros de ejcucion
		 */
		foreach ($_POST["progressRecord"] as $item) {
			foreach ($item as $itemValue => $value) {
				if ($itemValue == "physicalProgress" || $itemValue == "financialProgress") 
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
		foreach ($itemParams as $progressRecord) {
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