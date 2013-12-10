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

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		$module = "Users";
		$smarty->assign("module",$module);

		if (ConfigModule::get("global","unifiedUsernames")) {
			if (!empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"])) {
				$usernameExists = Common::getByUsername($_POST['loginUsername']);
				if (!empty($usernameExists)) { //Si existe el username
					//Me fijo si el usuario que intenta ingresar esta bloqueado
					if(Common::isBlockedUser($_POST["loginUsername"]))
						return $mapping->findForwardConfig('blockedUser');
					$class = get_class($usernameExists);
					if (get_class($usernameExists) == "User") {
						$user = UserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
						if (!empty($user)) {
							$_SESSION["loginUser"] = $user;
							Common::doLog('success','username: ' . $_POST["loginUsername"]);
							if (is_null($user->getPasswordUpdated()))
								$forwardValue = 'successUsersFirstLogin';
							else
								$forwardValue = 'successUsers';
						}
					}
					elseif (get_class($usernameExists) == "AffiliateUser") {
						$user = AffiliateUserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
						if (!empty($user)) {
							$_SESSION["loginAffiliateUser"] = $user;
							Common::doLog('success','affiliateUsername: ' . $_POST["loginUsername"]);
							if (is_null($user->getPasswordUpdated()))
								$forwardValue = 'successAffiliateUsersFirstLogin';
							else
								$forwardValue = 'successAffiliateUsers';
						}
					}
					elseif (get_class($usernameExists) == "ClientUser") {
						$user = ClientUserPeer::auth($_POST["loginUsername"],$_POST["loginPassword"]);
						if (!empty($user)) {
							$_SESSION["loginClientUser"] = $user;
							Common::doLog('success','clientUsername: ' . $_POST["loginUsername"]);
							if (is_null($user->getPasswordUpdated()))
								$forwardValue = 'successClientUsersFirstLogin';
							else
								$forwardValue = 'successClientUsers';
						}
					}
					if (empty($user)) { // Si no consiguio autenticar, el $user esta vacio
						Common::loginFailure($_POST["loginUsername"], $_POST["loginPassword"], $class);
						$forwardValue = 'failureDataMissmatch';
					}
					else { // Si esta seteado un valor de $_SESSION["loginRequestReferrer"] redireccionar
						if(isset($_SESSION["loginRequestReferrer"]) && strlen($_SESSION["loginRequestReferrer"]) > 3) {
							$referrer = substr($_SESSION["loginRequestReferrer"],3);
							unset($_SESSION["loginRequestReferrer"]);
							if ($referrer != 'usersLogin' && $referrer != 'commonLogin')
								header("Location:Main.php?do=". $referrer);
								exit();
						}
					}
					//Si encontre usuario valido regreso con la informacion del $forwardValue
					return $mapping->findForwardConfig($forwardValue);
				}
				else //No consigo usuario valido
					return $mapping->findForwardConfig('failureDataMissmatch');
			}
			else //Faltaron datos
				return $mapping->findForwardConfig('failureMissingData');
		}
		else //No se usa el commonLogin
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
