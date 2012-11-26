<?php
/**
 * PanelSetPanelAction
 *
 * Pone el sistema en modo planeamiento
 *
 * @package    panel
 */

class PanelSetPanelAction extends BaseAction {
	
	function PanelSetPanelAction() {
		;
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		Common::setPanelMode();
		$smarty->assign('panelMode', true);
		return $mapping->findForwardConfig('success');
	}
}