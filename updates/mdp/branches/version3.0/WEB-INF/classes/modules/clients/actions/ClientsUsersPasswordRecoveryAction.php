<?php
/** 
 * ClientsUsersPasswordRecoveryAction
 *
 * @package clients 
 */

class ClientsUsersPasswordRecoveryAction extends BaseAction {

	function ClientsUsersPasswordRecoveryAction() {
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

		$module = "Clients";

		return $mapping->findForwardConfig('success');
	}

}
