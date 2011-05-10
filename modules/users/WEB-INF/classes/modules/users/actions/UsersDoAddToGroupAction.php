<?php
/** 
 * UsersDoAddToGroupAction
 *
 * @package users 
 * @subpackage groups 
 */

class UsersDoAddToGroupAction extends BaseAction {

	function UsersDoAddToGroupAction() {
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

		$userPeer = new UserPeer();

		if ( !empty($_POST["group"]) && !empty($_POST["user"]) ) {
			if ( $userPeer->addUserToGroup($_POST["user"],$_POST["group"]) ) {
				Common::doLog('success','userId: ' . $_POST["user"] . ' group: ' . $_POST["group"]);
				header("Location: Main.php?do=usersList&user=".$_POST["user"]);
				exit;
		 }
		}

		Common::doLog('failure','userId: ' . $_POST["user"] . ' group: ' . $_POST["group"]);
		header("Location: Main.php?do=usersList&user=".$_POST["user"]."&message=notAddedToGroup");
		exit;

	}

}
