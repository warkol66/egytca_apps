<?php
/** 
 * UsersGroupsDoEditAction
 *
 * @package users 
 * @subpackage groups 
 */

require_once("BaseAction.php");
require_once("GroupPeer.php");
require_once("GroupCategoryPeer.php");

class UsersGroupsListAction extends BaseAction {

	function UsersGroupsListAction() {
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
		$section = "Groups";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$groups = GroupPeer::getAll();
		$smarty->assign("groups",$groups);

		$smarty->assign("message",$_GET["message"]);

		if ( !empty($_GET["group"]) ) {
			//voy a editar un grupo

			try {
				$group = GroupPeer::get($_GET["group"]);
				$smarty->assign("currentGroup",$group);
				$groupCategories = $group->getCategories();
				$smarty->assign("currentGroupCategories",$groupCategories);
				$notAssignedCategories = $group->getNotAssignedCategories();
				$smarty->assign("categories",$notAssignedCategories);
				$smarty->assign("accion","edicion");
			}
			catch (PropelException $e) {
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
