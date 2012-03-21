<?php
/**
 * UsersLoginAction
 *
 * @package users
 */

class AffiliatesUsersLoginAction extends BaseAction {

	function AffiliatesUsersLoginAction() {
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

		$module = "Affiliates";
		$smarty->assign("module",$module);

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_SESSION["loginUser"]) || !empty($_SESSION["loginAffiliateUser"]) )
			return $mapping->findForwardConfig('welcome');

		if (Common::hasUnifiedLogin()) {
			$smarty->assign("unifiedLogin",true);

			$value = Common::getValueUnifiedLoginCookie();
			if (!empty($value) || $value == "0")
				$smarty->assign('cookieSelection',$value);

			return $mapping->findForwardConfig('success-unified');
		}

		return $mapping->findForwardConfig('success');
	}

}
