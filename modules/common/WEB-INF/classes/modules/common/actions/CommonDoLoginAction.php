<?php
/**
 * CommonDoLoginAction
 *
 * @package Common
 */

class CommonDoLoginAction extends BaseAction {

	function CommonDoLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateWelcome.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$smarty->assign("module",$module);

		if ((Common::hasUnifiedUsernames())) {
			if (!empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"])) {

				$usernameExists = UserPeer::getByUsername($_POST['loginUsername']);

				if (empty($usernameExists)) { //Si no existe el username del user
					if (class_exists(AffiliateUserPeer)){
						$AffiliateUsernameExists = AffiliateUserPeer::getByUsername($_POST['loginUsername']);
						if (!empty($AffiliateUsernameExists)) { //Si exite el affiliateUser
							if ( !empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"]) ) {
								$user = AffiliateUserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
								if ( !empty($user) ) {
									$_SESSION["loginAffiliateUser"] = $user;
									$smarty->assign("loginAffiliateUser",$user);
	
									Common::doLog('successAffiliateUser','username: ' . $_POST["loginUsername"]);
									return $mapping->findForwardConfig('successAffiliateUsers');
								}
	
							}
	
						}
					}
					else //No consigo usuario valido
						return $mapping->findForwardConfig('failureNoUserame');
					}
					else { //Si encontre user
						$user = UserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
						if (!empty($user)) {
							$_SESSION["loginUser"] = $user;
							$smarty->assign("loginUser",$user);

							Common::doLog('successUser','username: ' . $_POST["loginUsername"]);
							$smarty->assign("SESSION",$_SESSION);

						if (is_null($user->getPasswordUpdated()))
							return $mapping->findForwardConfig('successUserFirstLogin');
						else
							return $mapping->findForwardConfig('successUser');
						}
					}
				}
				else
					return $mapping->findForwardConfig('failureMissingData');
			}
			else
				return $mapping->findForwardConfig('failureRedirectUserLogin');


		$this->template->template = "TemplateLogin.tpl";
		$smarty->assign("message","wrongUser");

		global $system;
		$maintenance = $system["config"]["system"]["parameters"]["underMaintenance"]["value"];

		if ($maintenance == "YES")
			$smarty->assign("onlyAdmin",true);

		Common::doLog('failure','username: ' . $_POST["loginUsername"]);
		return $mapping->findForwardConfig('failure');
	}

}
