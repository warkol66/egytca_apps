<?php

class ClientsUsersEditAction extends BaseAction {

	function ClientsUsersEditAction() {
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
		$section = "Users";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$usersPeer = new ClientUserPeer();

		//Si esta logueado un usuario de sistema
		if (!empty($_SESSION["loginUser"])) {
			$clientId = $_GET["clientId"];
			if (!empty($clientId)) {
				if ($clientId == -1) {
					$users = $usersPeer->getAll();
					$deletedUsers = $usersPeer->getDeleteds();
				}
				else {
					$users = $usersPeer->getClient($clientId);
					$deletedUsers = $usersPeer->getDeletedsByClient($clientId);
				}
			}
			else {
				$users = $usersPeer->getAll();
				$deletedUsers = $usersPeer->getDeleteds();
			}
			$clients = ClientPeer::getAll();
			$smarty->assign("clients",$clients);
		}
		else {
			$clientId = $_SESSION["loginClientUser"]->getClientId();
/*			$users = $usersPeer->getClient($clientId);
			$deletedUsers = $usersPeer->getDeletedsByClient($clientId);*/
		}

		$smarty->assign("clientId",$clientId);

		if (!empty($_GET["id"])) {

			$user = $usersPeer->get($_GET["id"]);

			$groups = $usersPeer->getGroupsByUser($_GET["id"]);
			$smarty->assign("currentUserGroups",$groups);

			$smarty->assign("action","edit");
		}
		else {
			$user = new ClientUser;
			$smarty->assign("action","create");
		}

		$smarty->assign("currentClientUser", $user);

		$levels = ClientLevelPeer::getAll();
		$smarty->assign("levels",$levels);

		$groups = $user->getNotAssignedGroups();
		$smarty->assign("groups",$groups);

		$smarty->assign('ownerCreation', $_GET["ownerCreation"]);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
