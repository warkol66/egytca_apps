<?php

require_once("BaseAction.php");
require_once("RequestPeer.php");
require_once("ProductPeer.php");
require_once("SupplierUserPeer.php");
require_once("CommentPeer.php");

class ImportRequestEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportRequestEditAction() {
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

		//generales
		$products = ProductPeer::getAll();
		$smarty->assign('products',$products);			


		//caso edicion
    		if ( !empty($_GET["id"]) ) {
			//voy a editar un request

			$request = RequestPeer::get($_GET["id"]);
			
			if (Common::isSupplier()) {
				//si es supplier solo muestro aquellos que tiene asignado.
				$supplierUser = SupplierUserPeer::getSupplierByUser(Common::getSupplierUserId());
				$productRequests = RequestPeer::getAllProductRequestsForSupplier($_GET['id'],$supplierUser->getSupplierId());
				//TODO obtenemos los comentarios del supplier
				
			}
			else {
				//si es el cliente o el admin ve los productRequest
				//TODO ver si no es necesaria una validacion de que sea el usuario duenio de esa req
				$productRequests = RequestPeer::getAllProductRequests($_GET['id']);

			}
			$smarty->assign("request",$request);
			$smarty->assign("productRequests",$productRequests);
	    		$smarty->assign("action","edit");
		}
		else {
			//Caso creacion request nuevo						
			$smarty->assign("action","create");
		}

		//set de peer para obtener informacion de los productos en si
		$productPeer = new ProductPeer();
		$smarty->assign('productPeer',$productPeer);	
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
?>
