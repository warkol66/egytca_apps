<?php
/**
 * AffiliatesUsersPasswordRecoveryAction
 *
 * @package affiliates
 */

class AffiliatesUsersPasswordRecoveryAction extends BaseAction {

	function AffiliatesUsersPasswordRecoveryAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateLogin.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";

		return $mapping->findForwardConfig('success');
	}

}
