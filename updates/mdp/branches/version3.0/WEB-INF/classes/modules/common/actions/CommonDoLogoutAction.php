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

		if (isset($_SESSION["loginUser"]) && is_object($_SESSION["loginUser"]) && get_class($_SESSION["loginUser"]) == "User")
			$user = $_SESSION["loginUser"];
		elseif (isset($_SESSION["loginAffiliateUser"]) && is_object($_SESSION["loginAffiliateUser"]) && get_class($_SESSION["loginAffiliateUser"]) == "AffiliateUser")
			$user = $_SESSION["loginAffiliateUser"];

		if($_SESSION["lastLogin"])
			unset($_SESSION["lastLogin"]);

		if($_SESSION["loginUser"])
			unset($_SESSION["loginUser"]);

		if($_SESSION["loginAffiliateUser"])
			unset($_SESSION["loginAffiliateUser"]);

		if (is_object($user)) {
			$username = $user->getUsername();
			$classname = lcfirst(get_class($username));
			Common::doLog('success', $classname . 'name: ' . $username);
		}

		return $mapping->findForwardConfig('success');

	}

}
