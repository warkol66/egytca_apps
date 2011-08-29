<?php

class ClientsBranchsListAction extends BaseAction {

	function ClientsBranchsListAction() {
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
		$section = "Branchs";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$branchPeer = new ClientBranchPeer();
		$filters = $_GET['filters'];

		$this->applyFilters($branchPeer, $filters, $smarty);
		$url = "Main.php?do=clientsBranchsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		if (!empty($_SESSION["loginUser"])) {
			$clientPeer = new ClientPeer();
			$clients = $clientPeer->getAll();
			$smarty->assign("clients",$clients);
		}
		else if (!empty($_SESSION["loginClientUser"]))
			$branchPeer->setSearchClientId($_SESSION["loginClientUser"]->getClientId());
		else
			return $mapping->findForwardConfig('failure');

		$pager = $branchPeer->getSearchPaginated($_GET["page"]);

		$smarty->assign("branchs",$pager->getResult());
		$smarty->assign("pager",$pager);
		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
