<?php
/** 
 * UsersDoLogoutAction
 *
 * @package users 
 */

require_once("BaseAction.php");

class UsersDoLogoutAction extends BaseAction {

	function UsersDoLogoutAction() {
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

		if (isset($_SESSION["loginUser"])) {
			$user = $_SESSION["loginUser"];	
			$username = $user->getUsername();
		}		

		if($_SESSION["lastLogin"])
		unset($_SESSION["lastLogin"]);
		
		Common::doLog('success','username: ' . $username);
		if($_SESSION["loginUser"])
			unset($_SESSION["loginUser"]);

		return $mapping->findForwardConfig('success');

	}

}
