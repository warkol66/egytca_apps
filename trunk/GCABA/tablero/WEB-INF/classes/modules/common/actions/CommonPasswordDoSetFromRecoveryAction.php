<?php
/**
 * CommonPasswordDoSetFromRecoveryAction
 *
 * @package users
 */

class CommonPasswordDoSetFromRecoveryAction extends BaseAction {

	function CommonPasswordDoSetFromRecoveryAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$section = "Users";

		if (($_POST["pass"] == $_POST["pass2"])) {
			$user = Common::getByRecoveryHash($_POST["recoveryHash"]);
			if (!empty($user) && $user->recoveryRequestIsValid()) {
				$user->changePassword($_POST["pass"]);
				$user->setRecoveryhash(null);
				$user->setrecoveryHashCreatedOn(null);
				$user->save();
				return $mapping->findForwardConfig('success');
			}
		}
		if (empty($user))
			return $this->addParamsToForwards(array('message'=>'wrongHash'),$mapping,"failure");

		if (!$user->recoveryRequestIsValid())
			return $this->addParamsToForwards(array('message'=>'expiredHash'),$mapping,"failure");

		return $this->addParamsToForwards(array('message'=>'anotherError'),$mapping,"failure");

	}

}
