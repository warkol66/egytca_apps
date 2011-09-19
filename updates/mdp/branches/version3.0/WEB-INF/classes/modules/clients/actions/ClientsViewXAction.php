<?php

class ClientsViewXAction extends BaseAction {

	function ClientsViewXAction() {
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
		$smarty->assign("module",$module);

		$id = $_GET["id"];

		$client = ClientPeer::get($id);
		$smarty->assign("client",$client);

		return $mapping->findForwardConfig('success');
	}

}
