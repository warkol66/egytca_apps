<?php

class CatalogProductsDoAddCategoriesXAction extends BaseAction {

	function CatalogProductsDoAddCategoriesXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Categories";
		$smarty->assign("module",$module);

		$productId = $_POST['productId'];
		$categoryId = $_POST['categoryId'];

		$product = ProductPeer::get($productId);
		$category = CategoryPeer::get($categoryId);

		if (!empty($product) && !empty($category) && $category->getModule() == 'catalog') {
			$product->addCategory($category);
			$product->save();
			$product->reload(true);  //Necesario para que considere todas las categorias y no solo la agregada recientemente.
			$smarty->assign('message', 'success');
			$smarty->assign('product', $product);
			$smarty->assign('category', $category);
		}
		else
			$smarty->assign('message', 'failure');

		return $mapping->findForwardConfig('success');
	}
}