<?php

class SecurityNoPermissionAction extends BaseAction {

	function SecurityNoPermissionAction() {
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
		$section = "No Permission";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		if (empty($_SESSION["loginUser"]) && empty($_SESSION["loginAffiliateUser"]))
			$this->template->template = "TemplatePublic.tpl";

		return $mapping->findForwardConfig('success');

	}

}
