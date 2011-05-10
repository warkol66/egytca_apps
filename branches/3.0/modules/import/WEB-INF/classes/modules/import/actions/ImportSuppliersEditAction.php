<?php

require_once("BaseAction.php");
require_once("SupplierPeer.php");
require_once("IncotermPeer.php");
require_once("PortPeer.php");


class ImportSuppliersEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportSuppliersEditAction() {
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

		$module = "Import";
		$smarty->assign('module',$module);
		$section = "Suppliers";
		$smarty->assign('section',$section);

    if ( !empty($_GET["id"]) ) {
			//voy a editar un supplier

			$supplier = SupplierPeer::get($_GET["id"]);

			$smarty->assign("supplier",$supplier);

									
	    $smarty->assign("action","edit");
		}
		else {
			//voy a crear un supplier nuevo
			$supplier = new Supplier();
			$smarty->assign("supplier",$supplier);			
									
			$smarty->assign("action","create");
		}

		$incoterms = IncotermPeer::getAll();
		$ports = PortPeer::getAll();

		$smarty->assign('incoterms',$incoterms);
		$smarty->assign('ports',$ports);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
