<?php

class ClientsBranchesDoEditAction extends BaseAction {

	function ClientsBranchesDoEditAction() {
		;
	}

	function returnFailure($mapping,$smarty,$branch) {
		$smarty->assign("branch",$branch);

		$id = $branch->getId();
		if (empty($id))
			$smarty->assign("action","create");
		else
			$smarty->assign("action","edit");

		$smarty->assign("message","error");
		return $mapping->findForwardConfig('failure');
	}


	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";
		$section = "Branches";

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$branchParams = $_POST["params"];

		if (!empty($_SESSION["loginUser"])) {
			$clientPeer = new ClientPeer();
			$clients = $clientPeer->getAll();
			$smarty->assign("clients",$clients);
		}
		else
			$branchParams['clientId'] = $_SESSION["loginClientUser"]->getClientId();

		if (!empty($_POST["id"]))
			$branch = ClientBranchPeer::get($_POST["id"]);
		else
			$branch = new ClientBranch;

		Common::setObjectFromParams($branch, $branchParams);

		if ($branch->isModified() && !$branch->save()) {
			$smarty->assign("branch", $branch);
			return $this->returnFailure($mapping,$smarty,$branch);
		}

		return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
	}
}