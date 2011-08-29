<?php

class ClientsUsersGroupsEditAction extends BaseAction {

	function ClientsUsersGroupsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";
		$section = "Groups";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$group = ClientGroupPeer::get($_GET["id"]);
		if (empty($group))
			$group = new ClientGroup;

		$smarty->assign("currentGroup",$group);
		if (class_exists("ClientUserGroupCategory")) {
			$groupCategories = $group->getCategories();
			$smarty->assign("currentGroupCategories",$groupCategories);
			$notAssignedCategories = $group->getNotAssignedCategories();
			$smarty->assign("categories",$notAssignedCategories);
		}

		return $mapping->findForwardConfig('success');
	}
}
