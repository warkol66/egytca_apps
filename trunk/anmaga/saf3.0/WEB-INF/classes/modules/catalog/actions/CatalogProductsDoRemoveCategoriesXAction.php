<?php

class CatalogProductsDoRemoveCategoriesXAction extends BaseAction {

	function CatalogProductsDoRemoveCategoriesXAction() {
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

		$category = CategoryPeer::get($_POST['categoryId']);
		$product = ProductPeer::get($productId);
		$smarty->assign('product', $product);

		if (!empty($productId) && !empty($categoryId)) {
			$productCode = $product->getCode();
			ProductCategoryQuery::create()->filterByProductCode($productCode)->filterByCategoryId($categoryId)->delete();
			$smarty->assign('message', 'success');
			$smarty->assign('category', $category);
		}
		else
			$smarty->assign('message', 'failure');

		return $mapping->findForwardConfig('success');
	}
}