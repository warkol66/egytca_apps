<?php
/** 
 * AffiliatesUsersDoLogoutAction
 *
 * @package affiliates 
 */

class AffiliatesUsersDoLogoutAction extends BaseAction {

	function AffiliatesUsersDoLogoutAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";

		if (isset($_SESSION["loginAffiliateUser"]) && is_object($_SESSION["loginAffiliateUser"]) && get_class($_SESSION["loginAffiliateUser"]) == "AffiliateUser")
			$username = $_SESSION["loginAffiliateUser"]->getUsername();	

		if($_SESSION["lastLogin"])
		unset($_SESSION["lastLogin"]);
		
		Common::doLog('success','username: ' . $username);
		if($_SESSION["loginAffiliateUser"])
			unset($_SESSION["loginAffiliateUser"]);

		if (ConfigModule::get("global","unifiedUsernames"))
			header("Location:Main.php?do=commonLogin");

		return $mapping->findForwardConfig('success');

	}

}
