<?php

require_once("BaseAction.php");
require_once("RegionPeer.php");

class LausiRegionsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiRegionsDoEditAction() {
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
		$section = "Regions";
		$smarty->assign("section",$section);		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un region existente
			RegionPeer::update($_POST["id"],$_POST["name"]);
      		
			return $mapping->findForwardConfig('success');
		}
		else {
		  //estoy creando un nuevo region

			if ( !RegionPeer::create($_POST["name"]) ) {
				$region = new Region();
				$region->setid($_POST["id"]);
				$region->setname($_POST["name"]);
				$smarty->assign("region",$region);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      		}

			return $mapping->findForwardConfig('success');
		}

	}

}