<?php

class PlanningConstructionsOnExecutionByMinistryXmlAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->template->template = 'TemplatePlain.tpl';
		
		$positions = PositionQuery::findMinistries();
		foreach ($positions as $position) {
			$q[$position->getInternalCode()] = 0;
			
			foreach ($position->getPlanningConstructionsWithDescendants() as $planningConstruction) {
				if ($planningConstruction->isOnExecution()) {
					$q[$position->getInternalCode()]++;
				}
			}
		}
		
		$smarty->assign('q', $q);
		
		header('Content-type: application/xml');
		return $mapping->findForwardConfig('success');
	}

}
