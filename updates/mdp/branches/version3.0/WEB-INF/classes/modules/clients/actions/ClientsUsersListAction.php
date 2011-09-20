<?php

class ClientsUsersListAction extends BaseAction {

	function ClientsUsersListAction() {
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
		$filters = $_GET['filters'];
		$this->applyFilters($usersPeer, $filters, $smarty);

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}

		//Si esta logueado un usuario de sistema
		if (!empty($_SESSION["loginUser"])) {
			if (!empty($_GET['filters']["searchClientId"])) {
				if ($_GET['filters']["searchClientId"] > 0)
					$deletedUsers = $usersPeer->getDeletedsByClient($_GET['filters']["searchClientId"]);
			}
			else
				$deletedUsers = $usersPeer->getDeleteds();

			$clientPeer = new ClientPeer();
			$clients = $clientPeer->getAll();
			$smarty->assign("clients",$clients);
		}
		else if (!empty($_SESSION["loginClientUser"])) {
			$clientId = $_SESSION["loginClientUser"]->getClientId();
			$deletedUsers = $usersPeer->getDeletedsByClient($clientId);
		}
		else
			return $mapping->findForwardConfig('failure');

		$pager = $usersPeer->getAllPaginatedFiltered($page);
		$smarty->assign("deletedUsers",$deletedUsers);

		$smarty->assign("clientId",$clientId);

		$url = "Main.php?do=clientsUsersList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("users", $pager->getResult());
		$smarty->assign("pager", $pager);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
