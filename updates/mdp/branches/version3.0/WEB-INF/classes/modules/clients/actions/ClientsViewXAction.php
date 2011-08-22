<?php

class ClientsViewXAction extends BaseAction {


	function ClientsViewXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";
		$section = "";
		
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$clientPeer= new ClientPeer();	

		$id = $_GET["id"];

		$client=$clientPeer->get($id);
		$smarty->assign("client",$client);

		return $mapping->findForwardConfig('success');
	}

}
