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

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$smarty->assign("module",$module);

		if (ConfigModule::get("global","unifiedUsernames")) {

			if (!empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"])) {

				$usernameExists = Common::getByUsername($_POST['loginUsername']);

				if (!empty($usernameExists)) { //Si existe el username

					if (get_class($usernameExists) == "User") {
						$user = UserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
						if (!empty($user)) {
							$_SESSION["loginUser"] = $user;
							$smarty->assign("loginUser",$user);
							Common::doLog('success','username: ' . $_POST["loginUsername"]);
							if (is_null($user->getPasswordUpdated()))
								$forwardValue = 'successUsersFirstLogin';
							else
								$forwardValue = 'successUsers';
						}
						else //si no autentifico
							$forwardValue = 'failureDataMissmatch';
					}
					else if (get_class($usernameExists) == "AffiliateUser") {
						$user = AffiliateUserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
						if (!empty($user)) {
							$_SESSION["loginAffiliateUser"] = $user;
							$smarty->assign("loginAffiliateUser",$user);
							Common::doLog('success','affiliateUsername: ' . $_POST["loginUsername"]);
							if (is_null($user->getPasswordUpdated()))
								$forwardValue = 'successAffiliateUsersFirstLogin';
							else
								$forwardValue = 'successAffiliateUsers';
						}
						else //si no autentifico
							$forwardValue = 'failureDataMissmatch';
					}
					else if (get_class($usernameExists) == "ClientUser") {
						$user = ClientUserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
						if (!empty($user)) {
							$_SESSION["loginClientUser"] = $user;
							$smarty->assign("loginClientUser",$user);
							Common::doLog('success','clientUsername: ' . $_POST["loginUsername"]);
							if (is_null($user->getPasswordUpdated()))
								$forwardValue = 'successClientUsersFirstLogin';
							else
								$forwardValue = 'successClientUsers';
						}
						else //si no autentifico
							$forwardValue = 'failureDataMissmatch';
					}
					//Si encontre usuario valido regreso con la informacion del $forwardValue
					return $mapping->findForwardConfig($forwardValue);
				}
				else //No consigo usuario valido
					return $mapping->findForwardConfig('failureDataMissmatch');
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
