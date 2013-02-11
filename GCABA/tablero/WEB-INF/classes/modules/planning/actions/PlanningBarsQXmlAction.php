<?php

class PlanningBarsQXmlAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->template->template = 'TemplatePlain.tpl';
		
		$positions = PositionQuery::create()->filterByType(9)
			->_or()->filterByPlanning(true)->find();
		
		foreach ($positions as $position) {
			$q[$position->getInternalCode()] = count($position->getOnlyConstructionsWithDescendants());
			$projects = $position->getOnlyProjectsWithDescendants();
			foreach ($projects as $project) {
				$q[$position->getInternalCode()] += $project->countPlanningConstructions();
			}
		}
		
		$smarty->assign('q', $q);
		
		header('Content-type: application/xml');
		return $mapping->findForwardConfig('success');
	}

}
