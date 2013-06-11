<?php
/**
 * PlanningSetPlanningAction
 *
 * Pone el sistema en modo planeamiento
 *
 * @package    planning
 */

class PlanningSetPlanningAction extends BaseAction {
	
	function PlanningSetPlanningAction() {
		;
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		Common::setPlanningMode($_REQUEST["period"]);
		$smarty->assign('planningMode', true);
		return $mapping->findForwardConfig('success');
	}
}