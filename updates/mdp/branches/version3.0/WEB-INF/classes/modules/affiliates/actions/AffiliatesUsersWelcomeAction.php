<?php
/** 
 * AffiliatesUsersWelcomeAction
 *
 * @package affiliates 
 */

class AffiliatesUsersWelcomeAction extends BaseAction {

	function AffiliatesUsersWelcomeAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateWelcome.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		
		return $mapping->findForwardConfig('success');
	}

}
