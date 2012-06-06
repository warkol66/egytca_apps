<?php
/** 
 * UsersGroupsDoAddCategoryToGroupAction
 *
 * @package users 
 * @subpackage groups 
 */

class UsersGroupsDoAddCategoryToGroupAction extends BaseAction {

	function UsersGroupsDoAddCategoryToGroupAction() {
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

		if ( !empty($_POST["group"]) && !empty($_POST["category"]) ) {
			if ( $groupPeer->addCategoryToGroup($_POST["category"],$_POST["group"]) ) {
				Common::doLog('success','category: ' . $_POST["category"] . ' group: ' . $_POST["group"]);
				header("Location: Main.php?do=usersGroupsList&group=".$_POST["group"]);
				exit;
			}
		}

		Common::doLog('failure','category: ' . $_POST["category"] . ' group: ' . $_POST["group"]);
		header("Location: Main.php?do=usersGroupsList&group=".$_POST["group"]."&message=notAddedToGroup");
		exit;

	}

}
