<?php
/**
 * PanelSetPanelXAction
 *
 * Pone el sistema en modo planeamiento
 *
 * @package    Panel
 */

class PanelImpactObjectivesListXAction extends BaseAction {
	
	function PanelImpactObjectivesListXAction() {
		;
	}
	
	function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$position = PositionQuery::create()->findOneById($_POST['id']);
		$objectives = $position->getImpactObjectives();
		$smarty->assign('objectives',$objectives);
		$smarty->assign('posId',$_POST['id']);
		return $mapping->findForwardConfig('success');
	}
}
