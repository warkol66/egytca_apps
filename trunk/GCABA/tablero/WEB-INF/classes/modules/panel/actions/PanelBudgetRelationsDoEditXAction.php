<?php
/**
 * PanelBudgetRelationsDoEditXAction
 *
 * Crea o guarda cambios de Partidas Presupuestarias (BudgetRelations)
 *
 * @package    panel
 * @subpackage    panelBudgetRelations
 */

class PanelBudgetRelationsDoEditXAction extends BaseAction {

	function PanelBudgetRelationsDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		foreach ($_POST["budgetItem"] as $item) {
			foreach ($item as $itemValue => $value) {
				if ($itemValue == "amount") 
					$value = Common::convertToMysqlNumericFormat($value);
				$itemValues[$itemValue] = $value;
			}
		}
		
		if(!empty($itemValues["id"])) {
			$budgetRelation = BudgetRelationQuery::create()->findOneById($itemValues["id"]);
			if (empty($budgetRelation))
				$budgetRelation = new BudgetRelation();
		} else
			$budgetRelation = new BudgetRelation();
			
		$budgetRelation->fromArray($itemValues,BasePeer::TYPE_FIELDNAME);
		$budgetRelation->setObjectType($_POST["objectType"]);
		$budgetRelation->setObjectid($_POST["objectId"]);
		try {
			$budgetRelation->save();
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->__toString());
		}
		$smarty->assign("bEdit", "ok");
		return $mapping->findForwardConfig('success');
		
		/*$smarty->assign("bEdit", "error");
		return $mapping->findForwardConfig('success');*/
		
	}
	
}
	

