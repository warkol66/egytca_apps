<?php
/** 
 * UsersListAction
 *
 * @package users 
 */

class UsersPasswordDoChangeAction extends BaseAction {

	function UsersPasswordDoChangeAction() {
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

		$user = $_SESSION['loginUser'];
		$currentPass = $_POST['currentPass'] . "ASD";

		$userPeer = New UserPeer();

		if ( (md5($currentPass) == $user->getPassword()) && ($_POST["pass"] == $_POST["pass2"]) ) {
			
			if ($_POST['currentPass'] == $_POST["pass"]){
				$params = array ("message" => "changePassword");
				if ($_POST['firstLogin'] == "firstLogin")
					$firstLogin = array( "firstLogin" => $_POST["firstLogin"]);

				$params = array_merge($params,$firstLogin);
				return $this->addParamsToForwards($params,$mapping,'changePassword');
			}
			else {
				if ($userPeer->updatePass($user->getId(),$_POST["pass"],$_POST['mailAddress'],$_POST['timezone']) ) {
					$user = UserPeer::get($user->getId());
					$_SESSION['loginUser'] = $user;
					Common::doLog('success','username: ' . $_POST["username"] . ' pass: edit');
					if ($_POST['firstLogin'] == "firstLogin")
						$params = array( "firstLogin" => $_POST["firstLogin"]);
					return $this->addParamsToForwards($params,$mapping,'success');
				}
				else {
					header("Location: Main.php?do=usersPasswordChange&message=errorUpdate");
					exit;
				}
			}
		}
		else if (md5($currentPass) == $user->getPassword() && (!empty($_POST["mailAddress"])) ) {
			if ( $userPeer->updateMail($user->getId(),$_POST['mailAddress'],$_POST['timezone']) ) {
				$user = UserPeer::get($user->getId());
				$_SESSION['loginUser'] = $user;
				Common::doLog('success','username: ' . $_POST["username"] . ' pass: edit');
				return $mapping->findForwardConfig('success');
			}
			else {
				header("Location: Main.php?do=usersPasswordChange&message=errorUpdate");
				exit;
			}
			
		}
		else {
			header("Location: Main.php?do=usersPasswordChange&message=wrongPassword");
			exit;
		}

	}

}
