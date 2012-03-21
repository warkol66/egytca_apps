<?php

class CatalogProductsEditAction extends BaseAction {

	function CatalogProductsEditAction() {
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

		$moduleSection = "Products";
		$smarty->assign("moduleSection",$section);

		$productCategories = CategoryPeer::getAllByModule("catalog");
		$smarty->assign("productCategories",$productCategories);

		$units = UnitPeer::getAll();
		$smarty->assign("units",$units);

		$measureUnits = MeasureUnitPeer::getAll();
		$smarty->assign("measureUnits",$measureUnits);

		if (!empty($_GET["id"])) {
			//voy a editar un producto
			$product = ProductPeer::get($_GET["id"]);
			$smarty->assign("action","edit");

			if (!is_null($product)) {
				$actualCategories = $product->getProductCategorys();
				$smarty->assign("actualCategories",$actualCategories);
				if ($actualCategories->isEmpty())
					$excludeCategories = array( -1);
				else {
					$excludeCategoriesIds = $product->getAssignedCategoriesArray($_GET["id"]);
					array_push($excludeCategoriesIds, -1);
				}
				$criteria = new Criteria();
				$criteria->add(CategoryPeer::ID, $excludeCategoriesIds, Criteria::NOT_IN);
				$criteria->add(CategoryPeer::MODULE, "catalog");
				$categoryCandidates = CategoryPeer::doSelect($criteria);
				$smarty->assign("categoryCandidates",$categoryCandidates);
			}
			else
				$smarty->assign("notValidId",true);
		}
		else {
			//voy a crear un producto nuevo
			$product = new Product;
			$smarty->assign("action","create");
		}
		$smarty->assign("product",$product);

		$smarty->assign("filters",$_REQUEST["filters"]);
		$smarty->assign("page",$_REQUEST["page"]);
		$smarty->assign("message",$_REQUEST["message"]);

		return $mapping->findForwardConfig('success');
	}
}
