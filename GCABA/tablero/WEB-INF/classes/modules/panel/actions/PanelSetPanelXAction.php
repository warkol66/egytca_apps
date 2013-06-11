<?php
/**
 * PanelSetPanelXAction
 *
 * Pone el sistema en modo planeamiento
 *
 * @package    Panel
 */

class PanelSetPanelXAction extends BaseAction {
	
	function PanelSetPanelXAction() {
		;
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		Common::setPanelMode($_REQUEST["period"]);
		$smarty->assign('panelMode', true);
		return $mapping->findForwardConfig('success');
	}
}