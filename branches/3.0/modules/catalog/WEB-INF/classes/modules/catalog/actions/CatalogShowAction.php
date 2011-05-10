<?php

class CatalogShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CatalogShowAction() {
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
		$productCategories = CategoryPeer::getAllByModule("catalog");
		$smarty->assign("productCategories",$productCategories);
		$productPeer = new ProductPeer;
			
		if (Common::isAffiliatedUser() && AffiliateProductPeer::affiliateHasPriceList(Common::getAffiliatedId())) {
				//CASO ESPECIAL DE LISTA DE PRECIOS SEPARADA POR AFILIADO
        $productPeer->setSearchAffiliateId(Common::getAffiliatedId());
		}
    
    if (!empty($_GET["categoryId"])) {
      $category = CategoryPeer::get($_GET["categoryId"]);
      $smarty->assign("category",$category);
      $productPeer->setSearchCategoryId($_GET["categoryId"]);
      $smarty->assign("filters",$filters = array(categoryId => $_GET["categoryId"]));
    } 
    else {
      // vamos a buscar las que no tienen categorias.
      $productPeer->setSearchCategoryId(null);
    }
    
    $pager = $productPeer->getAllPaginatedFiltered($_GET["page"]);
		$products = $pager->getResult();
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=catalogShow";
		if (!empty($category))
			$url .= "&categoryId=".$category->getId();
		$smarty->assign("url",$url);
		$smarty->assign("products",$products);
	  $smarty->assign("message",$_GET["message"]);	
		
		return $mapping->findForwardConfig('success');
		
	}

}
