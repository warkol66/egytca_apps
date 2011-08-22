<?php

class ClientsListAction extends BaseAction {

	function ClientsListAction() {
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

		$module = "Clients";
  	$smarty->assign("module",$module);

  	$smarty->assign("message",$_GET["message"]);
		
		$clientPeer = new ClientPeer;
		$filters = $_GET["filters"];
		
		$this->applyFilters($clientPeer, $filters, $smarty);

		$pager = $clientPeer->getSearchPaginated($_GET["page"]);
		
		$url = "Main.php?do=clientsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("clients",$pager->getResult());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
