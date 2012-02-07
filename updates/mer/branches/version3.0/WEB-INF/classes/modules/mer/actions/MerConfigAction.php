<?php

class MerConfigAction extends BaseAction {

	function MerConfigAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Mer";
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);		

		return $mapping->findForwardConfig('success');
	}

}
