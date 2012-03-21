<?php

class SurveysGenerateProductsSurveyAction extends BaseAction {

	function SurveysGenerateProductsSurveyAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Catalog";
		$smarty->assign("module",$module);

		$section = "Products";
		$smarty->assign("section",$section);

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
