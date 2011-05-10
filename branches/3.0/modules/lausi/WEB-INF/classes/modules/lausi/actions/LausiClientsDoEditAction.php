<?php

require_once("BaseAction.php");
require_once("ClientPeer.php");

class LausiClientsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiClientsDoEditAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Clients";
		$smarty->assign("section",$section);		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un client existente
			ClientPeer::update($_POST["id"],$_POST["name"],$_POST["contact"]);
      		
			return $mapping->findForwardConfig('success');
		}
		else {
		  //estoy creando un nuevo client

			if ( !ClientPeer::create($_POST["name"],$_POST["contact"]) ) {
				$client = new Client();
				$client->setid($_POST["id"]);
				$client->setname($_POST["name"]);
				$client->setcontact($_POST["contact"]);
				$smarty->assign("client",$client);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      		}

			return $mapping->findForwardConfig('success');
		}

	}

}