<?php

class SurveysGenerateProductsSurveyAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SurveysGenerateProductsSurveyAction() {
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
		
		$smarty->assign("message",$_GET['message']);
		
		if ($_GET['usingAutocompleter']) {
			$smarty->assign('usingAutocompleter', true);
			return $mapping->findForwardConfig('success');
		}
		
		//Si estamos acá es el caso en que no se usa autocompleter
		$productCategories = CategoryPeer::getAllByModule('catalog');
		$smarty->assign('productCategories', $productCategories);
		
		//traemos los productos de la primera categoria
		//que es la que viene seleccionada por defecto.
		$products = $productCategories->getFirst()->getProducts();
		$smarty->assign('products', $products);

		return $mapping->findForwardConfig('success');
	}
}
