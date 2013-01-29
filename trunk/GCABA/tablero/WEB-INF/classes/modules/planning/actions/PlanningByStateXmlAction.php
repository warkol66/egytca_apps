<?php

class PlanningByStateXmlAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->template->template = 'TemplatePlain.tpl';
		
		global $system;
		if (!empty($_GET['positionId'])) {
			$smarty->assign('type', $_GET['type']);
			$position = PositionQuery::create()->findOneById($_GET['positionId']);
			
			foreach ($system['config']['tablero']['colors'] as $color) {
				if ($_GET['type'] == 'projects')
					$smarty->assign($color.'Count', $position->countProjectsByStatusColor($color));
				else
					die;
//					$smarty->assign($color.'Count', $position->countProjectsByStatusColor($color));
			}
			
			header('Content-type: application/xml');
			return $mapping->findForwardConfig('success');
		}
	}

}
