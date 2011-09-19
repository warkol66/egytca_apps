<?php
/** 
 * ClientsUsersWelcomeAction
 *
 * @package clients 
 */

class ClientsUsersWelcomeAction extends BaseAction {

	function ClientsUsersWelcomeAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateWelcome.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";
		
		return $mapping->findForwardConfig('success');
	}

}
