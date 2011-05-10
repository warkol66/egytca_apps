<?php

require_once("BaseAction.php");
require_once("RequestPeer.php");
require_once("ProductPeer.php");
require_once("ProductRequestPeer.php");

class ImportDoAddProductToRequestXAction extends BaseAction {


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
		//por ser una action ajax.		
		$this->template->template = "template_ajax.tpl";

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
		
		if (empty($_POST['productId']) && empty($_POST['quantity']))
			return $mapping->findForwardConfig('failure');

		if (empty($_POST['requestId'])) {
			//no hay una request creada creamos una
			//TODO ver validaciones de si los usuarios son afiliados o no
			$request = RequestPeer::create(Common::getAffiliatedId());
			if ($request == false)
				//se produjo un error
				return $mapping->findForwardConfig('failure');
			//inicializamos la variable en post para continuar el proceso.
			$_POST['requestId'] = $request->getId();
			//flag para indicar caso de creacion
			$created = true;
		}

		//agregamos el producto al request.
		$productReq = ProductRequestPeer::create($_POST['requestId'], $_POST['productId'],$_POST['quantity']);
		if (!$productReq)
			//se produjo un error al agregar el producto
			return $mapping->findForwardConfig('failure');

		//asignaciones a smarty
		$smarty->assign('requestId',$_POST['requestId']);
		$smarty->assign('productReq',$productReq);

		//set de peer para obtener informacion de los productos en si
		$productPeer = new ProductPeer();
		$smarty->assign('productPeer',$productPeer);

		if ($created)
			$smarty->assign('message',"created");
		else 
			$smarty->assign('message',"added");			

		return $mapping->findForwardConfig('success');

	}

}
?>
