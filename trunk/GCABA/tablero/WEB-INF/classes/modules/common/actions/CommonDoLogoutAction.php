<?php
/**
 * CommonDoLogoutAction
 *
 * @package common
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

		if (is_object($user)) {
			if(method_exists($user,"getUsername"))
				$username = $user->getUsername();
			else
				$username ="";
			$classname = lcfirst(get_class($username));
			Common::doLog('success', $classname . 'username: ' . $username);
		}

		if($_SESSION["lastLogin"])
			unset($_SESSION["lastLogin"]);

		if($_SESSION["loginUser"])
			unset($_SESSION["loginUser"]);

		if($_SESSION["loginAffiliateUser"]) {
			unset($_SESSION["loginAffiliateUser"]);
			unset($_SESSION["affiliate"]);
		}
		if($_SESSION["loginUserByRegistration"])
			unset($_SESSION["loginUserByRegistration"]);

		if($_SESSION["loginClientUser"])
			unset($_SESSION["loginClientUser"]);

		if($_SESSION["panelMode"])
			unset($_SESSION["panelMode"]);
		if($_SESSION["planningMode"])
			unset($_SESSION["planningMode"]);

		return $mapping->findForwardConfig('success');

	}

}
