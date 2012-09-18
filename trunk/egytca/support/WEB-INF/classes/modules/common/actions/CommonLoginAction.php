<?php
/**
 * CommonLoginAction
 *
 * @package Common
 */

class CommonLoginAction extends BaseAction {

	function CommonLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->template->template = "TemplateLogin.tpl";

		$module = "Common";
		$smarty->assign("message",$_GET["message"]);

		if (!empty($_SESSION["loginUser"]))
			return $mapping->findForwardConfig('usersWelcome');

		if (!empty($_SESSION["loginAffiliateUser"]))
			return $mapping->findForwardConfig('affiliateUsersWelcome');

		if (!ConfigModule::get("global","unifiedUsernames"))
			return $mapping->findForwardConfig('failureRedirect');

		return $mapping->findForwardConfig('success');
	}

}
