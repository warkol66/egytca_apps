<?php

class ClientsUsersDoEditAction extends BaseAction {

	function ClientsUsersDoEditAction() {
		;
	}

	function assignObjects($smarty) {
		if (empty($_POST["id"]))
			$clientUser = new ClientUser;
		else
			$clientUser = ClientUserPeer::get($_POST["id"]);
		Common::setObjectFromParams($clientUser, $clientUserParams);
		$smarty->assign("currentClientUser", $clientUser);
		$timezonePeer = new TimezonePeer();
		$smarty->assign('timezones',$timezonePeer->getAll());
		$levels = ClientLevelPeer::getAll();
		$smarty->assign("levels",$levels);
		$smarty->assign('ownerCreation', $_POST["ownerCreation"]);

		if (!empty($_SESSION["loginUser"])) {
			$clientPeer = new ClientPeer();
			$clients = $clientPeer->getAll();
			$smarty->assign("clients",$clients);
		}

		if (empty($_POST["id"])){
			$smarty->assign("action","create");
			$smarty->assign("accion","creacion");
		}
		else{
			$smarty->assign("action","edit");
			$smarty->assign("accion","edicion");
		}
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);


		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";
		$smarty->assign("module",$module);
		$section = "Users";
		$smarty->assign("section",$section);

		$usersPeer= new ClientUserPeer();

		$clientUserParams = $_POST["clientUser"];

		if ( !empty($_SESSION["loginUser"]) )
			$clientId = $_POST["clientUser"]["clientId"];
		else
			$clientId = $_SESSION["loginClientUser"]->getClientId();
		$smarty->assign("clientId",$clientId);

		$filters = array('searchClientId' => $clientId);

		if ((empty($_POST["id"]) && empty($_POST["pass"])) || ($_POST["pass"] != $_POST["pass2"])) {
			$this->assignObjects($smarty);
			$smarty->assign("message","wrongPassword");
			return $mapping->findForwardConfig('failure');
		}

		if (empty($_POST["id"]))
			$clientUser = new ClientUser;
		else
			$clientUser = ClientUserPeer::get($_POST["id"]);

		Common::setObjectFromParams($clientUser, $clientUserParams);
		$clientUser->setPasswordString($_POST["pass"]);
		$clientUser->setPasswordUpdatedTime();

		$client = $_SESSION['newClient'];
		if (!empty($client) && !empty($_POST["ownerCreation"])) {
			$clientUser->validate();
			$failures = $clientUser->getValidationFailures();
			//Nos aseguramos que la unica falla que tenga sea por el clientId.
			if (count($failures) > 1 || (!empty($failures[0]) && $failures[0]->getColumn() != ClientUserPeer::AFFILIATEID)) {
				$this->assignObjects($smarty);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
			$client->save(); //necesitamos que tenga id
			$clientUser->setClientRelatedByClientid($client);
		}

		if (!$clientUser->save()) {
			$this->assignObjects($smarty);
			$smarty->assign("message","errorUpdate");
			return $mapping->findForwardConfig('failure');
		}

		if (!empty($client) && !empty($_POST["ownerCreation"])) {
			$client->setOwnerId($clientUser->getId());
			if (!$client->save()) {
				$this->assignObjects($smarty);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
			return $this->addFiltersToForwards($filters, $mapping, 'success-owner');
		}

		return $this->addFiltersToForwards($filters, $mapping, 'success');
	}
}
