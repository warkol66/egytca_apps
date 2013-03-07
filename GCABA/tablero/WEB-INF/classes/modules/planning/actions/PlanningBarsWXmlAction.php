<?php

class PlanningBarsWXmlAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->template->template = 'TemplatePlain.tpl';
		
		$positionType = key(ConfigModule::get("planning","positionsTypes"));
		$positions = PositionQuery::create()->filterByType($positionType)
			->_or()->filterByPlanning(true)->find();
		
		$months = array();
		for ($i = 1; $i <= 12; $i++) {
			
			$monthStr = "2013-$i";
			$month['label'] = date('M', strtotime($monthStr)).'13';
			$month['dateRange']['min'] = strtotime("first day of $monthStr");
			$month['dateRange']['max'] = strtotime("last day of $monthStr");
			
			foreach ($positions as $position) {

				$month['value'] = 0;
				
				$dateFilteredQuery = PlanningConstructionQuery::create()->filterByPotentialendingdate($month['dateRange']);
				
				$month['value'] += count($position->getOnlyConstructionsWithDescendants($dateFilteredQuery));

				foreach ($position->getOnlyProjectsWithDescendants() as $project) {
//					$month['value'] +=  count($project->getPlanningConstructions($dateFilteredQuery));
				}
			}
			
			$months []= $month;
		}
		
		$smarty->assign('months', $months);
		
		header('Content-type: application/xml');
		return $mapping->findForwardConfig('success');
	}

}
