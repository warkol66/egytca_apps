<?php
/**
 * UsersDoLoginAction
 *
 * @package users
 */

class UsersDoLoginAction extends BaseAction {

	function UsersDoLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$smarty->assign("module",$module);

		if (Common::hasUnifiedLogin()) {
			$smarty->assign("unifiedLogin",true);
			Common::setValueUnifiedLoginCookie($_POST['select']);
		}

		if (Common::hasUnifiedUsernames()) {
			$smarty->assign("unifiedLogin",true);
			Common::setValueUnifiedLoginCookie($_POST['select']);
		}

		if (!empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"])) {
			$user = UserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
			if (!empty($user)) {
				$_SESSION["login_user"] = $user;
				$_SESSION["loginUser"] = $user;
				$smarty->assign("loginUser",$user);
				Common::doLog('success','username: ' . $_POST["loginUsername"]);
				$smarty->assign("SESSION",$_SESSION);

			if (is_null($user->getPasswordUpdated()))
				return $mapping->findForwardConfig('successFirstLogin');
			else
				return $mapping->findForwardConfig('success');
			}
		}

		$this->template->template = "TemplateLogin.tpl";
		$smarty->assign("message","wrongUser");

		global $system;
		$maintenance = $system["config"]["system"]["parameters"]["underMaintenance"]["value"];

		if ($maintenance == "YES")
			$smarty->assign("onlyAdmin",true);

		if (Common::hasUnifiedLogin())
			//si hay unificado, obligamos a la opcion que se intento loguear
			$smarty->assign('cookieSelection','admin');

		Common::doLog('failure','username: ' . $_POST["loginUsername"]);
		return $mapping->findForwardConfig('failure');
	}

}
