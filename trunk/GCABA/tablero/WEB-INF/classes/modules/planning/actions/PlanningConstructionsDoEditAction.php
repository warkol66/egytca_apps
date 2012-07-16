<?php
/**
 * PlanningConstructionsDoEditAction
 *
 * Crea o guarda cambios de Obras (PlanningConstruction)
 *
 * @package    planning
 * @subpackage    planningPlanningConstructions
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
		$params = Common::addUserInfoToParams($_POST["params"]);

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

		$totalValues = 15;

		foreach ($_POST["budgetItem"] as $item) {

				foreach ($item as $itemValue => $value) {
					if ($itemValue == "amount") 
						$value = Common::convertToMysqlNumericFormat($value);
					$itemValues[$itemValue] = $value;
				}
				$j++;
				//Cuando complete todos los valores asociados a un monto, lo guardo en $itemParams
				if ($itemValue == "eol") {
					$itemParams[] = $itemValues;
					$itemValues = array();
					$j = 0;
				}
		}
		//Guardo los datos de montos asociados a la obra
		foreach ($itemParams as $budgetItem) {
		
			$id = $budgetItem["id"];
		
			if (!empty($id))
				$budgetRelation = BudgetRelationQuery::create()->findOneById($id);
			else
				$budgetRelation = new BudgetRelation();
		
			$budgetRelation->fromArray($budgetItem,BasePeer::TYPE_FIELDNAME);
			if ($budgetRelation->isNew())
				$budgetRelation->setId(null);
		
			$budgetRelation->setObjectType('Construction');
			$budgetRelation->setObjectid($_POST["id"]);

			try {
				$budgetRelation->save();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->__toString());
			}
		
		}

		if (isset($id))
			$logSufix = ', ' . Common::getTranslation('action: create','common');
		else
			$logSufix = ', ' . Common::getTranslation('action: edit','common');

		Common::doLog('success', $planningConstruction->getName() . $logSufix);

		$params = array();
		$params["id"] = $planningConstruction->getId();
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');

	}

}