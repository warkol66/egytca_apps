<?php

class SecurityBlockedAction extends BaseAction {

	function SecurityBlockedAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = "Security";
		$section = "Blocked";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);
		
		$this->template->template = "TemplatePublic.tpl";

		return $mapping->findForwardConfig('success');

	}

}
