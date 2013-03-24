<?php

class PlanningConstructionsToBeInauguratedByMonthXmlAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->template->template = 'TemplatePlain.tpl';
		
		$positions = PositionQuery::findMinistries();
		
		$months = array();
		for ($i = 1; $i <= 12; $i++) {	
			
			$monthStr = "2013-$i";
			$month['label'] = date('M', strtotime($monthStr)).'13';
			$month['dateRange']['min'] = strtotime("first day of $monthStr");
			$month['dateRange']['max'] = strtotime("last day of $monthStr");
			$month['value'] = 0;
			
			foreach ($positions as $position) {
				$dateFilteredQuery = PlanningConstructionQuery::create()->filterByPotentialendingdate($month['dateRange']);
				$month['value'] += count($position->getPlanningConstructionsWithDescendants($dateFilteredQuery));
			}
		
			$months[] = $month;
		}
		
		$smarty->assign('months', $months);
		
		header('Content-type: application/xml');
		return $mapping->findForwardConfig('success');
	}
	
}
