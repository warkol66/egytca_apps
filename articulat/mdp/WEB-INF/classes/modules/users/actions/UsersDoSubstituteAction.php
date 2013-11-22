<?php
/**
 * UsersDoSubstituteAction
 *
 * @package users
 */

require_once('UsersDoLoginAction.php');

class UsersDoSubstituteAction extends UsersDoLoginAction {

	function UsersDoSubstituteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

$ret =		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$smarty->assign("module",$module);

		$requesterUser = Common::getLoggedUser();

		if (!empty($_REQUEST["suUsername"]) && $requesterUser->isSupervisor()) {
			$user = UserPeer::su($_REQUEST["suUsername"],$requesterUser);
			if (!empty($user)) {
				$_SESSION["loginUser"] = $user;
				$smarty->assign("loginUser",$user);
				Common::doLog('success',$requesterUser . ' as: ' . $_REQUEST["suUsername"]);
				$smarty->assign("SESSION",$_SESSION);

/*			if (is_null($user->getPasswordUpdated()))
				return $mapping->findForwardConfig('successFirstLogin');
			else
				return $mapping->findForwardConfig('success');
				*/
return $ret;
			}
		}

	}

}
