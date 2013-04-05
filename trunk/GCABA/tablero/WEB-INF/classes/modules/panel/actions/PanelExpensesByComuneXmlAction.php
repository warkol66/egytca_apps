<?php

require_once 'ExpensesSum.php';
require_once 'PanelExpensesShowAction.php';

class PanelExpensesByComuneXmlAction extends PanelExpensesShowAction {
	
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$regionsExpenses = $_REQUEST['relative'] == 1 ?
				RelativeExpensesSum::absoluteToRelative($this->getRegionsExpenses()) : $this->getRegionsExpenses();
		$total = ExpensesSum::total($regionsExpenses);
		
		$smarty->assign('regionsExpenses', $regionsExpenses);
		$smarty->assign('allZero', $total['accrued'] == 0);
		$smarty->assign('colors', new ColorSupplier());
		
		header('Content-type: application/xml');
		$this->template->template = 'TemplatePlain.tpl';
		return $mapping->findForwardConfig('success');
	}
}

class ColorSupplier {
	
	private $colors = array(
		'FFD1D1', 'D1BAFF', '3B48FF', 'F9FF87', '2EC740',
		'638AFF', 'B5B5B5', '96F1FF', 'FFD000', 'FC77E8',
		'AB7800', 'A247D6', 'ED3939', 'B8FFBE', '74FF5C'
	);
	private $i = 0;
	
	function next() {
		if ($this->i == count($this->colors))
			$this->i = 0;
		return($this->colors[$this->i++]);
	}
}