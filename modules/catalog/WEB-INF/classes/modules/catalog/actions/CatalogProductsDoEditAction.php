<?php

class CatalogProductsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CatalogProductsDoEditAction() {
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

		$moduleSection = "Products";
    $smarty->assign("moduleSection",$section);
    
    $params = $_POST["product"];
    $params['price'] = Common::convertToMysqlNumericFormat($params['price']);
    $params['image'] = $_FILES['image'];

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un producto existente

			ProductPeer::update($_POST["id"], $params);
     	return $mapping->findForwardConfig('success');
		}
		else {
		  //estoy creando un nuevo producto

      if ( !ProductPeer::create($params) ) {
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}
