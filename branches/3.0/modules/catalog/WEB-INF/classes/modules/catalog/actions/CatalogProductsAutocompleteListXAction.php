<?php

//Accion que devuelve el listado de productos para mostrar en el autocomplete

class CatalogProductsAutocompleteListXAction extends BaseAction {

	function CatalogProductsAutocompleteListXAction() {
		;
	}

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
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);
		
		$alredySelectedIds = $_REQUEST['alredySelectedIds'];

		$products = ProductQuery::create()->where('Product.Description LIKE ?', "%" . $searchString . "%")
									->_if(!empty($alredySelectedIds))
										->add(ProductPeer::ID, $alredySelectedIds,Criteria::NOT_IN)
									->_endif()
									->limit($_REQUEST['limit'])
									->find();
		
		$smarty->assign("products",$products);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
