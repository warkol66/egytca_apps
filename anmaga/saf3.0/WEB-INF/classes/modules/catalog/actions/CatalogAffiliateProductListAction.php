<?php

class CatalogAffiliateProductListAction extends BaseAction {

	function CatalogAffiliateProductListAction() {
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

		$affiliates = AffiliatePeer::getAll();
		$smarty->assign('affiliates',$affiliates);

		$affiliate = AffiliatePeer::get($_GET['affiliateId']);
		$smarty->assign('affiliate',$affiliate);

		$productCategories = CategoryPeer::getAllByModule("catalog");
		$smarty->assign("productCategories",$productCategories);

		$productPeer = new ProductPeer;

		if (!empty($_GET['affiliateId'])) {
			$productPeer->setSearchAffiliateId($_GET['affiliateId']);
			$pager = $productPeer->getAllPaginatedFiltered($_GET["page"]);

			$products = $pager->getResult();
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=catalogAffiliateProductList&affiliateId=" . $_GET['affiliateId'];
			$smarty->assign("url",$url);
			$smarty->assign("products",$products);
			$smarty->assign("affiliateId",$_GET['affiliateId']);
		}

		return $mapping->findForwardConfig('success');

	}

}
