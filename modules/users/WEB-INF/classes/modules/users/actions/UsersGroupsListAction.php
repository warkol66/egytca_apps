<?php
/** 
 * UsersGroupsListAction
 *
 * @package users 
 * @subpackage groups 
 */

class UsersGroupsListAction extends BaseAction {

	function UsersGroupsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

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

		if (!empty($_GET["group"])) {
			//voy a editar un grupo
			$group = GroupPeer::get($_GET["group"]);
			$smarty->assign("currentGroup",$group);
			$groupCategories = $group->getCategories();
			$smarty->assign("currentGroupCategories",$groupCategories);
			$categories = $group->getCandidateCategories();
			$smarty->assign("categories",$categories);
			$smarty->assign("accion","edicion");
		}
		return $mapping->findForwardConfig('success');
	}
}
