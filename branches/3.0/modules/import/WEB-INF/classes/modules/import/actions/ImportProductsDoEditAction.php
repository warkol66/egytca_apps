<?php

require_once("BaseAction.php");
require_once("ProductPeer.php");
require_once("SupplierPeer.php");
class ImportProductsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportProductsDoEditAction() {
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

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un product existente

			if ( ProductPeer::update($_POST["product"],$_POST['productSupplier']) )
      			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo product

			if ( !ProductPeer::create($_POST["product"],$_POST['productSupplier']) ) {
				$product = new Product();
				$product->setid($_POST["id"]);
				$product->setcode($_POST['product']["code"]);
				$product->setname($_POST['product']["name"]);
				$product->setnamespanish($_POST['product']["nameSpanish"]);
				$product->setdescription($_POST['product']["description"]);
				$product->setdescriptionSpanish($_POST['product']["descriptionSpanish"]);
				$product->setstatus($_POST['product']["active"]);
				$smarty->assign("product",$product);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				$suppliers = SupplierPeer::getAll();		
				$smarty->assign("suppliers",$suppliers);
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}
?>
