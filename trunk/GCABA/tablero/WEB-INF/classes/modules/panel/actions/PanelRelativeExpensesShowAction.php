<?php

class PanelRelativeExpensesShowAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Panel";
		$section = "Strategic Vision";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		return $mapping->findForwardConfig('success');
	}

}
