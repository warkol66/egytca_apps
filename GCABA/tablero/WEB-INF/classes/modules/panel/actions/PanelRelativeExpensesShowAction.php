<?php

require_once 'ExpensesSum.php';
require_once 'PanelExpensesShowAction.php';

class PanelRelativeExpensesShowAction extends PanelExpensesShowAction {
	
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Panel";
		$section = "Strategic Vision";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);
		
		$regionsExpenses = RelativeExpensesSum::absoluteToRelative($this->getRegionsExpenses());
//		$regionsExpensesTotal = RelativeExpensesSum::total($regionsExpenses);
		$smarty->assign('regionsExpenses', $regionsExpenses);
//		$smarty->assign('regionsExpensesTotal', $regionsExpensesTotal);
		
		$ministriesExpenses = RelativeExpensesSum::absoluteToRelative($this->getMinistriesExpenses());
//		$ministriesExpensesTotal = RelativeExpensesSum::total($ministriesExpenses);
		$smarty->assign('ministriesExpenses', $ministriesExpenses);
//		$smarty->assign('ministriesExpensesTotal', $ministriesExpensesTotal);
		
		$operativeObjectivesExpenses = RelativeExpensesSum::absoluteToRelative($this->getOperativeObjectivesExpenses());
//		$operativeObjectivesExpensesTotal = RelativeExpensesSum::total($operativeObjectivesExpenses);
		$smarty->assign('operativeObjectivesExpenses', $operativeObjectivesExpenses);
//		$smarty->assign('operativeObjectivesExpensesTotal', $operativeObjectivesExpensesTotal);
		
		$impactObjectivesExpenses = RelativeExpensesSum::absoluteToRelative($this->getImpactObjectivesExpenses());
//		$impactObjectivesExpensesTotal = RelativeExpensesSum::total($impactObjectivesExpenses);
		$smarty->assign('impactObjectivesExpenses', $impactObjectivesExpenses);
//		$smarty->assign('impactObjectivesExpensesTotal', $impactObjectivesExpensesTotal);
		
		$ministryObjectivesExpenses = RelativeExpensesSum::absoluteToRelative($this->getMinistryObjectivesExpenses());
//		$ministryObjectivesExpensesTotal = RelativeExpensesSum::total($ministryObjectivesExpenses);
		$smarty->assign('ministryObjectivesExpenses', $ministryObjectivesExpenses);
//		$smarty->assign('ministryObjectivesExpensesTotal', $ministryObjectivesExpensesTotal);
		
		$smarty->assign('updatedSigaf', BudgetRelationQuery::create()->findOne()->getUpdatedsigaf());

		return $mapping->findForwardConfig('success');
	}

}
