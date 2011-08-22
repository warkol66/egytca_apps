<?php

class ClientsEditAction extends BaseAction {

	function ClientsEditAction() {
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

		$clientPeer= new ClientPeer();

		$msg = $request->getParameter("message");
		if(empty($msg)){
			$msg="noError";
		}
		$smarty->assign("message",$msg);

		$id = $request->getParameter("id");
		$client = $clientPeer->get($id);
		if (empty($client)) {
			$smarty->assign("action","create");
			$client = new Client();
		}
		else
			$smarty->assign("action","edit");
		
		$smarty->assign("client",$client);
		return $mapping->findForwardConfig('success');

	}

}