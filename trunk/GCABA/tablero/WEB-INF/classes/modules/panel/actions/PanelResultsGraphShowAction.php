<?php

require_once 'ExpensesSum.php';
require_once 'PanelExpensesShowAction.php';

class PanelResultsGraphShowAction extends PanelExpensesShowAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Panel";
		$section = "Strategic Vision";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$regionsExpenses = $this->getRegionsExpenses();
		$regionsExpensesTotal = ExpensesSum::total($regionsExpenses);
		$smarty->assign('regionsExpenses', $regionsExpenses);
		$smarty->assign('regionsExpensesTotal', $regionsExpensesTotal);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		return $mapping->findForwardConfig('success');
	}

}
