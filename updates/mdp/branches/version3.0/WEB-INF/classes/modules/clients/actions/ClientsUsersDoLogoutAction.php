<?php
/** 
 * ClientsUsersDoLogoutAction
 *
 * @package clients 
 */

class ClientsUsersDoLogoutAction extends BaseAction {

	function ClientsUsersDoLogoutAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";

		if (isset($_SESSION["loginClientUser"]) && is_object($_SESSION["loginClientUser"]) && get_class($_SESSION["loginClientUser"]) == "ClientUser")
			$username = $_SESSION["loginClientUser"]->getUsername();	

		if($_SESSION["lastLogin"])
		unset($_SESSION["lastLogin"]);
		
		Common::doLog('success','username: ' . $username);
		if($_SESSION["loginClientUser"])
			unset($_SESSION["loginClientUser"]);

		if (ConfigModule::get("global","unifiedUsernames"))
			header("Location:Main.php?do=commonLogin");

		return $mapping->findForwardConfig('success');

	}

}
