<?php
/** 
 * UsersPasswordDoChangeForRecoveryAction
 *
 * @package users 
 */

require_once("BaseAction.php");

class UsersPasswordDoChangeForRecoveryAction extends BaseAction {

	function UsersPasswordDoChangeForRecoveryAction() {
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

		$userPeer = New UserPeer();
		if (($_POST["pass"] == $_POST["pass2"])) {
			$user = $userPeer->getByRecoveryHash($_POST["recoveryHash"]);
			if (!empty($user) && $user->recoveryRequestIsValid()) {
				$user->changePassword($_POST["pass"]);
				$user->setRecoveryhash(null);
				$user->save();
				return $mapping->findForwardConfig('success');
			}
		}
		if (empty($user)) {
			return $this->addParamsToForwards(array('message'=>'wrongHash'),$mapping,"failure");
		}
		if (!$user->recoveryRequestIsValid()){
			return $this->addParamsToForwards(array('message'=>'expiredHash'),$mapping,"failure");
		}
		
		return $this->addParamsToForwards(array('message'=>'anotherError'),$mapping,"failure");
			
	}

}
