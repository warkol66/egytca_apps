<?php

require_once("BaseAction.php");
require_once("UnitPeer.php");

class CatalogUnitsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CatalogUnitsDoEditAction() {
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

		$module = "Catalog";
    $smarty->assign("module",$module);

		$moduleSection = "Units";
    $smarty->assign("moduleSection",$section);


		if ( $_POST["action"] == "edit" ) {
			//estoy editando un unit existente

			if ( UnitPeer::update($_POST["id"],$_POST["name"],$_POST["unitQuantity"]) )
				return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('success');
		
		}
		else {
		  //estoy creando un nuevo unit

			if ( !UnitPeer::create($_POST["name"],$_POST["unitQuantity"]) ) {
				$unit = UnitPeer::get($_GET["id"]);
				$smarty->assign("unit",$unit);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}
