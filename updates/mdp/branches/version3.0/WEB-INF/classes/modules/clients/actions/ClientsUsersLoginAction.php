<?php
/**
 * ClientsUsersLoginAction
 *
 * @package users
 */

class ClientsUsersLoginAction extends BaseAction {

	function ClientsUsersLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (ConfigModule::get("global","unifiedUsernames"))
			header("Location:Main.php?do=commonLogin");

		$this->template->template = "TemplateLogin.tpl";

		$module = "Clients";
		$smarty->assign("module",$module);

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_SESSION["loginUser"]) || !empty($_SESSION["loginClientUser"]) )
			return $mapping->findForwardConfig('welcome');

		return $mapping->findForwardConfig('success');
	}

}
