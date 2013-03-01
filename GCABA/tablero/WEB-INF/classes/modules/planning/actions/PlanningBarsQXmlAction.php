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
		
		$positions = PositionQuery::create()->filterByType(9) // cambiar filtro +++++++++++++++++++++++++++++++++++++
			->_or()->filterByPlanning(true)->find();
		
		foreach ($positions as $position) {
//			$q[$position->getInternalCode()] = count($position->getOnlyConstructionsWithDescendants());
//			$projects = $position->getOnlyProjectsWithDescendants();
//			foreach ($projects as $project) {
//				$q[$position->getInternalCode()] += $project->countPlanningConstructions();
//			}
			
			$q[$position->getInternalCode()] = 0;
			
			foreach ($position->getOnlyConstructionsWithDescendants() as $construction) {
				if ($construction->isOnExecution())
					$q[$position->getInternalCode()]++;
			}
			
			foreach ($position->getOnlyProjectsWithDescendants() as $project) {
				foreach ($project->getPlanningConstructions() as $planningConstruction) {
					if ($planningConstruction->isOnExecution())
						$q[$position->getInternalCode()]++;
				}
			}
		}
		
		$smarty->assign('q', $q);
		
		header('Content-type: application/xml');
		return $mapping->findForwardConfig('success');
	}

}
