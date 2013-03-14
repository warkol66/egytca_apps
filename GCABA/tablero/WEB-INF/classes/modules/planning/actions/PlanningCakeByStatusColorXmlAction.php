<?php

class PlanningCakeByStatusColorXmlAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->template->template = 'TemplatePlain.tpl';
		
		if (!empty($_GET['positionId'])) {
			$smarty->assign('type', $_GET['type']);
			$position = PositionQuery::create()->findOneById($_GET['positionId'])->getGraphParent();
			
			$method = $_GET['type'] == 'projects' ? 'getPlanningProjectsWithDescendants' : 'getPlanningConstructionsWithDescendants';
			$entities = $position->$method();
		}
		else {
			$entityQuery = $_GET['type'] == 'projects' ? PlanningProjectQuery : PlanningConstructionQuery;
			$entities = $entityQuery::create()->find();
		}

		$colorsCount = array();
		foreach ($entities as $entity) {
			$colorsCount[$entity->statusColor()]++;
		}
		foreach ($colorsCount as $color => $count) {
			$smarty->assign($color.'Count', $count);
		}
		
		header('Content-type: application/xml');
		return $mapping->findForwardConfig('success');
	}

}
