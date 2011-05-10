<?php
/**
 * CommonLoginAction
 *
 * @package Common
 */

require_once("BaseAction.php");

class CommonLoginAction extends BaseAction {

	function CommonLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateLogin.tpl";
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_SESSION["loginUser"]))
			return $mapping->findForwardConfig('usersWelcome');

		if (!empty($_SESSION["loginAffiliateUser"]))
			return $mapping->findForwardConfig('affiliateUsersWelcome');

		if (!Common::hasUnifiedUsernames())
			return $mapping->findForwardConfig('failureRedirect');


		return $mapping->findForwardConfig('success');
	}

}
