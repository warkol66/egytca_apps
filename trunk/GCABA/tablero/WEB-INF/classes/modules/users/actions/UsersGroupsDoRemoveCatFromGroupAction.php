<?php
/** 
 * UsersGroupsDoEditAction
 *
 * @package users 
 * @subpackage groups 
 */

class UsersGroupsDoRemoveCatFromGroupAction extends BaseAction {

	function UsersGroupsDoRemoveCatFromGroupAction() {
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

		$groupPeer = new GroupPeer();

		if ( !empty($_GET["group"]) && !empty($_GET["category"]) ) {
			if ( $groupPeer->removeCategoryFromGroup($_GET["category"],$_GET["group"]) ) {	
				Common::doLog('success','category: ' . $_POST["category"] . ' group: ' . $_POST["group"]);
				header("Location: Main.php?do=usersGroupsList&group=".$_GET["group"]);
				exit;
			}
		}

		Common::doLog('failure','category: ' . $_POST["category"] . ' group: ' . $_POST["group"]);
		header("Location: Main.php?do=usersGroupsList&group=".$_GET["group"]."&message=notRemovedFromGroup");
		exit;

	}

}
