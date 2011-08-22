<?php

class ClientsBranchsEditAction extends BaseAction {

	function ClientsBranchsEditAction() {
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
		$section = "Branchs";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		if (!empty($_SESSION["loginUser"])) {
			$clients = ClientPeer::getAll();
			$smarty->assign("clients",$clients);
		}

		if (!empty($_GET["id"]) ) {
			//voy a editar un branch
			$branch = ClientBranchPeer::get($_GET["id"]);
			$smarty->assign("branch",$branch);
			$smarty->assign("action","edit");
		}
		else{
			$branch = new ClientBranch();
			$smarty->assign("branch",$branch);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_REQUEST["filters"]);
		$smarty->assign("page",$_REQUEST["page"]);
		$smarty->assign("message",$_REQUEST["message"]);
		return $mapping->findForwardConfig('success');
	}

}
