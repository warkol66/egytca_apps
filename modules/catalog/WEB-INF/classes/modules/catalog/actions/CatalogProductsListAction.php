<?php

class CatalogProductsListAction extends BaseAction {

	function CatalogProductsListAction() {
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

		$moduleSection = "Products";
    $smarty->assign("moduleSection",$section);
		
		$productCategories = CategoryPeer::getAllByModule("catalog");
    $smarty->assign("productCategories",$productCategories);

		$productPeer = new ProductPeer();
    $filters = $_GET['filters'];
    $this->applyFilters($productPeer, $filters, $smarty);
		
		if ($_GET["csv"] == "1") {
			$products = $productPeer->getAll();
			$smarty->assign("products",$products);
			$this->template->template = "TemplateCsv.tpl";	
			header("content-disposition: attachment; filename=products.csv");
			header("Content-type: text/csv; charset=UTF-8");			
			return $mapping->findForwardConfig('csv');
		}
    $pager = $productPeer->getAllPaginatedFiltered($_GET["page"]);

		$smarty->assign("products",$pager->getResult());
		$smarty->assign("pager",$pager);
    
    $url = "Main.php?do=catalogProductsList";
    foreach ($filters as $key => $value)
      $url .= "&filters[$key]=$value";
    $smarty->assign("url",$url);

    $smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
