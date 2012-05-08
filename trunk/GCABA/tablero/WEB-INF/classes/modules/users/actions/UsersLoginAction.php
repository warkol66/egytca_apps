<?php
/**
 * UsersLoginAction
 *
 * @package users
 */

require_once("BaseAction.php");

class UsersLoginAction extends BaseAction {

	function UsersLoginAction() {
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

		$module = "Users";

		if (Common::hasUnifiedLogin()) {
			$smarty->assign("unifiedLogin",true);
			Common::setValueUnifiedLoginCookie($_POST['select']);
		}

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_SESSION["loginUser"]) || !empty($_SESSION["loginAffiliateUser"]) )
			return $mapping->findForwardConfig('welcome');

		if (Common::hasUnifiedLogin()) {
			$smarty->assign("unifiedLogin",true);

			$value = Common::getValueUnifiedLoginCookie();

			if (!empty($value) || $value == "0") {
				$smarty->assign('cookieSelection',$value);
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
