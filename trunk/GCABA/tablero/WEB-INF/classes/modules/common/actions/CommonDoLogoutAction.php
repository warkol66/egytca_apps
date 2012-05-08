<?php
/**
 * UsersDoLogoutAction
 *
 * @package users
 */

class CommonDoLogoutAction extends BaseAction {

	function CommonDoLogoutAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$user = Common::getLoggedUser();

		if (!empty($user) && is_object($user)) {
			$username = $user->getUsername();
			$classname = get_class($user);

			if($_SESSION["loginUser"])
				unset($_SESSION["loginUser"]);

			if($_SESSION["loginAffiliateUser"])
				unset($_SESSION["loginAffiliateUser"]);

			Common::doLog('success', $classname . 'name: ' . $username);

		}

		if($_SESSION["lastLogin"])
			unset($_SESSION["lastLogin"]);

		return $mapping->findForwardConfig('success');

	}

}
