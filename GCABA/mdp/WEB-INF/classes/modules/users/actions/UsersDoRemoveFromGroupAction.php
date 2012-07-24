<?php
/** 
 * UsersDoRemoveFromGroupAction
 *
 * @package users 
 * @subpackage groups 
 */

class UsersDoRemoveFromGroupAction extends BaseAction {

	function UsersDoRemoveFromGroupAction() {
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

		if ( !empty($_GET["group"]) && !empty($_GET["user"]) ) {
			if ( $userPeer->removeUserFromGroup($_GET["user"],$_GET["group"]) ) {
				Common::doLog('success','userId: ' . $_POST["user"] . ' group: ' . $_POST["group"]);
				header("Location: Main.php?do=usersList&user=".$_GET["user"]);
				exit;
		 }
		}
		
		Common::doLog('failure','userId: ' . $_POST["user"] . ' group: ' . $_POST["group"]);
		header("Location: Main.php?do=usersList&user=".$_GET["user"]."&message=notRemovedFromGroup");
		exit;

	}

}
