<?php
/**
 * UsersDoSubstituteAction
 *
 * @package users
 */

require_once('UsersDoLoginAction.php');

class UsersDoExitAction extends UsersDoLoginAction {

	function UsersDoSubstituteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$smarty->assign("module",$module);

		$requesterUser = Common::getLoggedUser();

		if (!empty($_SESSION["supervisorUser"])) {
			$user = $_SESSION["supervisorUser"];
			if ($user->isSupervisor()) {
				$_SESSION["login_user"] = $user;
				$_SESSION["loginUser"] = $user;
				unset($_SESSION['supervisorUser']);
				$smarty->assign("loginUser",$user);
				$smarty->assign("SESSION",$_SESSION);
				return $mapping->findForwardConfig('success');
			}
		}

	}

}
